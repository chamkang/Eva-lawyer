<?php
/**
 * Minimal, self-contained admin back end: password login + article editor.
 * Articles written here are stored as JSON files in storage/posts/ and merged
 * into the site's guides, so no code file is ever rewritten by the browser.
 */
declare(strict_types=1);

const ADMIN_FILE      = __DIR__ . '/../storage/admin.json';
const POSTS_DIR       = __DIR__ . '/../storage/posts';
const LOGIN_LOG       = __DIR__ . '/../storage/login-attempts.json';
const MAX_ATTEMPTS    = 5;
const LOCKOUT_SECONDS = 900;   // 15 minutes

/* ---------------------------------------------------------------- session */
function admin_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }
    session_name('bk_admin');
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Strict',
        'cookie_secure'   => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'use_strict_mode' => true,
    ]);
}

function admin_password_hash(): string
{
    if (!is_file(ADMIN_FILE)) {
        return '';
    }
    $data = json_decode((string) file_get_contents(ADMIN_FILE), true);
    return is_array($data) ? (string) ($data['hash'] ?? '') : '';
}

function admin_set_password(string $password): bool
{
    @mkdir(dirname(ADMIN_FILE), 0750, true);
    return (bool) file_put_contents(ADMIN_FILE, json_encode([
        'hash' => password_hash($password, PASSWORD_DEFAULT),
        'set'  => date('c'),
    ], JSON_PRETTY_PRINT));
}

function admin_logged_in(): bool
{
    admin_session();
    return !empty($_SESSION['admin']) && ($_SESSION['ua'] ?? '') === substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 120);
}

function admin_login(string $password): bool
{
    $hash = admin_password_hash();
    if ($hash === '' || !password_verify($password, $hash)) {
        admin_record_attempt();
        return false;
    }
    admin_session();
    session_regenerate_id(true);
    $_SESSION['admin'] = true;
    $_SESSION['ua'] = substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 120);
    admin_clear_attempts();
    return true;
}

function admin_logout(): void
{
    admin_session();
    $_SESSION = [];
    session_destroy();
}

/* ------------------------------------------------------- brute-force guard */
function admin_attempts(): array
{
    $log = is_file(LOGIN_LOG) ? json_decode((string) file_get_contents(LOGIN_LOG), true) : [];
    return is_array($log) ? $log : [];
}

function admin_ip(): string
{
    return (string) ($_SERVER['REMOTE_ADDR'] ?? 'cli');
}

function admin_record_attempt(): void
{
    $log = admin_attempts();
    $ip = admin_ip();
    $entry = $log[$ip] ?? ['count' => 0, 'first' => time()];
    if (time() - $entry['first'] > LOCKOUT_SECONDS) {
        $entry = ['count' => 0, 'first' => time()];
    }
    $entry['count']++;
    $log[$ip] = $entry;
    @mkdir(dirname(LOGIN_LOG), 0750, true);
    @file_put_contents(LOGIN_LOG, json_encode($log));
}

function admin_clear_attempts(): void
{
    $log = admin_attempts();
    unset($log[admin_ip()]);
    @file_put_contents(LOGIN_LOG, json_encode($log));
}

/** Seconds remaining in a lockout, or 0 when the visitor may try again. */
function admin_lockout(): int
{
    $entry = admin_attempts()[admin_ip()] ?? null;
    if (!$entry || $entry['count'] < MAX_ATTEMPTS) {
        return 0;
    }
    $left = LOCKOUT_SECONDS - (time() - $entry['first']);
    return $left > 0 ? $left : 0;
}

/* ------------------------------------------------------------ post storage */
function slugify(string $text): string
{
    $text = strtr($text, ['é' => 'e', 'è' => 'e', 'ê' => 'e', 'à' => 'a', 'ç' => 'c', 'ô' => 'o', 'û' => 'u', 'î' => 'i', '&' => ' and ']);
    $text = strtolower(preg_replace('/[^A-Za-z0-9]+/', '-', $text) ?? '');
    return trim(substr($text, 0, 80), '-');
}

function post_path(string $slug): string
{
    return POSTS_DIR . '/' . slugify($slug) . '.json';
}

/** All browser-written posts, newest first. */
function admin_posts(bool $includeDrafts = true): array
{
    if (!is_dir(POSTS_DIR)) {
        return [];
    }
    $out = [];
    foreach (glob(POSTS_DIR . '/*.json') ?: [] as $file) {
        $p = json_decode((string) file_get_contents($file), true);
        if (!is_array($p) || empty($p['slug'])) {
            continue;
        }
        if (!$includeDrafts && empty($p['published'])) {
            continue;
        }
        $out[$p['slug']] = $p;
    }
    uasort($out, fn ($a, $b) => strcmp((string) ($b['updated'] ?? ''), (string) ($a['updated'] ?? '')));
    return $out;
}

function admin_save_post(array $p): string
{
    @mkdir(POSTS_DIR, 0750, true);
    $slug = slugify($p['slug'] ?: $p['title']);
    $p['slug'] = $slug;
    $p['updated'] = $p['updated'] ?: date('Y-m-d');
    $p['saved_at'] = date('c');
    file_put_contents(post_path($slug), json_encode($p, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    return $slug;
}

function admin_delete_post(string $slug): void
{
    $f = post_path($slug);
    if (is_file($f)) {
        unlink($f);
    }
}

/** Converts an admin post into the same shape as data/guides.php entries. */
function post_to_guide(array $p): array
{
    return [
        'title'     => $p['title'],
        'short'     => $p['short'] ?: $p['title'],
        'seo_title' => $p['seo_title'] ?: $p['title'],
        'meta'      => $p['meta'],
        'excerpt'   => $p['excerpt'],
        'icon'      => $p['icon'] ?: 'doc',
        'minutes'   => (int) ($p['minutes'] ?: reading_minutes($p['body'])),
        'updated'   => $p['updated'],
        'services'  => $p['services'] ?: [],
        'body'      => $p['body'],
        'faqs'      => $p['faqs'] ?: [],
    ];
}

function reading_minutes(string $html): int
{
    return max(1, (int) round(str_word_count(strip_tags($html)) / 200));
}

/* ------------------------------------------------- simple text -> safe HTML */
/**
 * Writers use plain text with "## heading", "- bullet", "1. item", **bold**,
 * *italic* and [link](url). Everything is escaped first, so no raw HTML or
 * script can be injected through the editor.
 */
function text_to_html(string $text): string
{
    $text = str_replace(["\r\n", "\r"], "\n", trim($text));
    $out = [];
    $list = null;
    foreach (explode("\n", $text) as $line) {
        $line = rtrim($line);
        $esc = htmlspecialchars($line, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $esc = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $esc);
        $esc = preg_replace('/(?<!\*)\*(?!\s)(.+?)(?<!\s)\*(?!\*)/', '<em>$1</em>', $esc);
        $esc = preg_replace_callback('/\[([^\]]+)\]\(((?:https?:\/\/|\/)[^\s)]+)\)/', fn ($m) => '<a href="' . $m[2] . '">' . $m[1] . '</a>', $esc) ?? $esc;

        $close = function (?string $tag) use (&$out) { if ($tag) { $out[] = '</' . $tag . '>'; } };

        if ($line === '') {
            $close($list); $list = null;
            continue;
        }
        if (preg_match('/^###\s+(.*)/', $line, $m)) {
            $close($list); $list = null;
            $out[] = '<h3>' . htmlspecialchars($m[1], ENT_QUOTES, 'UTF-8') . '</h3>';
        } elseif (preg_match('/^##\s+(.*)/', $line, $m)) {
            $close($list); $list = null;
            $out[] = '<h2>' . htmlspecialchars($m[1], ENT_QUOTES, 'UTF-8') . '</h2>';
        } elseif (preg_match('/^[-*]\s+(.*)/', $esc, $m)) {
            if ($list !== 'ul') { $close($list); $out[] = '<ul>'; $list = 'ul'; }
            $out[] = '<li>' . preg_replace('/^[-*]\s+/', '', $m[1] ?? '') . '</li>';
        } elseif (preg_match('/^\d+\.\s+(.*)/', $esc, $m)) {
            if ($list !== 'ol') { $close($list); $out[] = '<ol>'; $list = 'ol'; }
            $out[] = '<li>' . $m[1] . '</li>';
        } else {
            $close($list); $list = null;
            $out[] = '<p>' . $esc . '</p>';
        }
    }
    if ($list) {
        $out[] = '</' . $list . '>';
    }
    return implode("\n", $out);
}

/** Rough reverse conversion so saved articles can be edited again as plain text. */
function html_to_text(string $html): string
{
    $t = preg_replace(['#<h2>(.*?)</h2>#s', '#<h3>(.*?)</h3>#s'], ["\n## $1\n", "\n### $1\n"], $html) ?? $html;
    $t = preg_replace('#<li>(.*?)</li>#s', "- $1", $t) ?? $t;
    $t = preg_replace('#</?(ul|ol)>#', '', $t) ?? $t;
    $t = preg_replace('#<p>(.*?)</p>#s', "$1\n", $t) ?? $t;
    $t = preg_replace('#<strong>(.*?)</strong>#s', '**$1**', $t) ?? $t;
    $t = preg_replace('#<em>(.*?)</em>#s', '*$1*', $t) ?? $t;
    $t = preg_replace('#<a href="([^"]+)">(.*?)</a>#s', '[$2]($1)', $t) ?? $t;
    return trim(html_entity_decode(strip_tags($t), ENT_QUOTES, 'UTF-8'));
}
