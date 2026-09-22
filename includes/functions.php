<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

/** HTML-escape. */
function e(?string $s): string
{
    return htmlspecialchars((string) $s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Site root URL (scheme + host + base path), no trailing slash. */
function site_url(): string
{
    if (SITE_URL_OVERRIDE !== '') {
        return rtrim(SITE_URL_OVERRIDE, '/');
    }
    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');
    $host = preg_replace('/[^A-Za-z0-9.\-:]/', '', $_SERVER['HTTP_HOST'] ?? 'localhost');
    return ($https ? 'https' : 'http') . '://' . $host . BASE_PATH;
}

/** True on preview/free hosts (see PREVIEW MODE in config.php) – the site is then hidden from search engines. */
function is_preview(): bool
{
    if (FORCE_PREVIEW) {
        return true;
    }
    $host = strtolower(preg_replace('/:\d+$/', '', $_SERVER['HTTP_HOST'] ?? 'localhost'));
    foreach (PREVIEW_HOSTS as $pattern) {
        if (fnmatch($pattern, $host) || $host === ltrim($pattern, '*.')) {
            return true;
        }
    }
    return false;
}

/** Root-relative link to a route, e.g. url('services/tax-law'). */
function url(string $path = ''): string
{
    $path = trim($path, '/');
    return BASE_PATH . '/' . $path;
}

/** Absolute URL for canonical links, sitemap and schema. */
function abs_url(string $path = ''): string
{
    $path = trim($path, '/');
    return site_url() . '/' . $path;
}

/** Versioned asset URL (cache-busting based on file modification time). */
function asset(string $path): string
{
    $file = dirname(__DIR__) . '/assets/' . $path;
    $v = is_file($file) ? filemtime($file) : 1;
    return BASE_PATH . '/assets/' . $path . '?v=' . $v;
}

function img(string $name): string
{
    return BASE_PATH . '/assets/img/' . $name . '.webp';
}

function data(string $name): array
{
    static $cache = [];
    return $cache[$name] ??= require dirname(__DIR__) . '/data/' . $name . '.php';
}

function services(): array { return data('services'); }
function team(): array     { return data('team'); }
function guides(): array   { return data('guides'); }
function faqs(): array     { return data('faqs'); }

function years_in_practice(): int
{
    return (int) date('Y') - FIRM['founded'];
}

function service_categories(): array
{
    return [
        'business'   => ['Business & Corporate', 'Setting up, financing, running and protecting a business.'],
        'disputes'   => ['Disputes & Recovery', 'Courts, arbitration, mediation and getting paid.'],
        'property'   => ['Property & Land', 'Buying, developing and defending real estate.'],
        'energy'     => ['Energy, Resources & Environment', 'Oil, gas, mining and sustainability.'],
        'trade'      => ['Trade & Transport', 'Import, export, shipping and aviation.'],
        'technology' => ['Technology & Innovation', 'Fintech, telecoms and intellectual property.'],
    ];
}

function tel_link(string $number): string
{
    return 'tel:' . preg_replace('/[^0-9+]/', '', $number);
}

function whatsapp_link(string $text = ''): string
{
    $msg = $text !== '' ? $text : 'Hello BAME KANG & Co, I would like to book a consultation.';
    return 'https://wa.me/' . FIRM['whatsapp'] . '?text=' . rawurlencode($msg);
}

function full_address(): string
{
    return FIRM['street'] . ', ' . FIRM['po_box'] . ', ' . FIRM['city'] . ', ' . FIRM['country'];
}

/**
 * Inline SVG icons (24×24, stroke based). Using inline SVG instead of icon fonts
 * removes two render-blocking stylesheets and several font files.
 */
function icon(string $name, string $class = 'icon'): string
{
    static $p = [
        'phone'     => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2"/>',
        'mail'      => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
        'pin'       => '<path d="M12 21s-7-6.2-7-11.5a7 7 0 0 1 14 0C19 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/>',
        'clock'     => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'arrow'     => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'check'     => '<path d="m5 12.5 4.5 4.5L19 7.5"/>',
        'chevron'   => '<path d="m9 6 6 6-6 6"/>',
        'menu'      => '<path d="M4 7h16M4 12h16M4 17h16"/>',
        'close'     => '<path d="M6 6l12 12M18 6 6 18"/>',
        'search'    => '<circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>',
        'scale'     => '<path d="M12 3v18M7 21h10M5 7h14M12 5l-7 2M12 5l7 2"/><path d="m5 7-3 7a3 3 0 0 0 6 0zM19 7l-3 7a3 3 0 0 0 6 0z"/>',
        'briefcase' => '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 13h18"/>',
        'bank'      => '<path d="M3 10 12 4l9 6M5 10v8M9.5 10v8M14.5 10v8M19 10v8M3 20h18"/>',
        'percent'   => '<path d="M19 5 5 19"/><circle cx="7" cy="7" r="2.5"/><circle cx="17" cy="17" r="2.5"/>',
        'home'      => '<path d="M3 11 12 4l9 7"/><path d="M5 10v10h14V10M10 20v-6h4v6"/>',
        'flame'     => '<path d="M12 3c1 4 5 5.5 5 10a5 5 0 0 1-10 0c0-2.5 1.5-4 2.5-5 .3 1.5 1 2.5 2 3 .5-3-1-5.5.5-8z"/>',
        'handshake' => '<path d="m3 11 4-4 5 2 3-2 6 5M3 11l5 5c1 1 2 1 3 0l1-1M21 12l-5 5c-1 1-2 1-3 0M12 9l-2.5 2.5a1.5 1.5 0 0 0 2 2L14 11"/>',
        'gavel'     => '<path d="m14 4 6 6M11.5 6.5l6 6M13 5l-5 5 6 6 5-5M10.5 12.5 4 19M3 21h8"/>',
        'coins'     => '<ellipse cx="9" cy="7" rx="6" ry="3"/><path d="M3 7v4c0 1.7 2.7 3 6 3s6-1.3 6-3V7"/><path d="M9 14v3c0 1.7 2.7 3 6 3s6-1.3 6-3v-4c0-1.7-2.7-3-6-3"/>',
        'chain'     => '<path d="M10 14a4 4 0 0 0 5.7 0l3-3a4 4 0 0 0-5.7-5.7l-1 1"/><path d="M14 10a4 4 0 0 0-5.7 0l-3 3a4 4 0 0 0 5.7 5.7l1-1"/>',
        'anchor'    => '<circle cx="12" cy="5" r="2"/><path d="M12 7v14M8 11h8M4 13a8 8 0 0 0 16 0"/>',
        'mountain'  => '<path d="m3 20 6-11 4 6 2-3 6 8z"/><path d="m7.5 12 1.5 1.5 1.5-1.5"/>',
        'bulb'      => '<path d="M9 18h6M10 21h4M12 3a6 6 0 0 0-3.5 10.9c.6.5 1 1.2 1 2.1h5c0-.9.4-1.6 1-2.1A6 6 0 0 0 12 3z"/>',
        'shield'    => '<path d="M12 3 4 6v6c0 5 3.5 8 8 9 4.5-1 8-4 8-9V6z"/><path d="m9 12 2 2 4-4"/>',
        'users'     => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20a6.5 6.5 0 0 1 13 0"/><path d="M16 4.5a3.5 3.5 0 0 1 0 7M18 14a6 6 0 0 1 3.5 6"/>',
        'leaf'      => '<path d="M5 19c0-9 6-14 15-14 0 9-5 15-14 15"/><path d="M5 19 13 11"/>',
        'signal'    => '<path d="M12 12v9M8 21h8"/><circle cx="12" cy="10" r="2"/><path d="M8.5 6.5a5 5 0 0 0 0 7M15.5 6.5a5 5 0 0 1 0 7M5.5 3.5a9 9 0 0 0 0 13M18.5 3.5a9 9 0 0 1 0 13"/>',
        'tree'      => '<path d="M12 3 6 11h3l-4 6h14l-4-6h3z"/><path d="M12 17v4"/>',
        'plane'     => '<path d="M10.5 13.5 3 11l1.5-1.5 8 .5 4-4.5a2 2 0 0 1 3 3L15 13l.5 8L14 22.5l-2.5-7.5L8 18.5V21l-1.5 1-1-3.5L2 17.5l1-1.5h2.5z"/>',
        'globe'     => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/>',
        'star'      => '<path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1 6.2L12 17.3 6.5 20.2l1-6.2L3 9.6l6.2-.9z"/>',
        'quote'     => '<path d="M9 7H5v6h4v4H6M19 7h-4v6h4v4h-3"/>',
        'calendar'  => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/>',
        'award'     => '<circle cx="12" cy="9" r="6"/><path d="m8.5 14-1.5 7 5-3 5 3-1.5-7"/>',
        'language'  => '<path d="M4 5h8M8 3v2M6 5c0 4 3 7 6 8M10 5c-.5 3-3 6.5-6 8"/><path d="m13 21 4-9 4 9M14.5 18h5"/>',
        'book'      => '<path d="M4 5a2 2 0 0 1 2-2h14v16H6a2 2 0 0 0-2 2z"/><path d="M4 19V5M8 7h8"/>',
        'doc'       => '<path d="M14 3H6v18h12V7z"/><path d="M14 3v4h4M9 12h6M9 16h6"/>',
        'video'     => '<rect x="3" y="6" width="13" height="12" rx="2"/><path d="m16 10 5-3v10l-5-3"/>',
        'lock'      => '<rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/>',
        'target'    => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/>',
        'facebook'  => '<path d="M14 8h3V4h-3a4 4 0 0 0-4 4v3H7v4h3v6h4v-6h3l1-4h-4V8z"/>',
        'linkedin'  => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M8 10v7M8 7v.01M12 17v-4a2 2 0 0 1 4 0v4M12 10v7"/>',
        'x'         => '<path d="M4 4l16 16M20 4 4 20"/>',
        'instagram' => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><path d="M17.5 6.5v.01"/>',
    ];
    if ($name === 'whatsapp') {
        return '<svg class="' . e($class) . '" viewBox="0 0 24 24" aria-hidden="true" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2zm0 18.2a8.2 8.2 0 0 1-4.2-1.2l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1l-.8 1c-.1.2-.3.2-.5.1a6.7 6.7 0 0 1-3.3-2.9c-.3-.4.3-.4.8-1.4.1-.2 0-.3 0-.4l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5a1 1 0 0 0-.7.3 3 3 0 0 0-.9 2.2 5.2 5.2 0 0 0 1.1 2.7 11.8 11.8 0 0 0 4.5 4c1.7.7 2.3.8 3.2.6.5-.1 1.5-.6 1.7-1.2.2-.6.2-1.1.2-1.2-.1-.1-.3-.2-.5-.3z"/></svg>';
    }
    $path = $p[$name] ?? $p['scale'];
    return '<svg class="' . e($class) . '" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">' . $path . '</svg>';
}

/** Secret key used to sign form tokens (created automatically on first use). */
function app_secret(): string
{
    $file = dirname(__DIR__) . '/storage/secret.key';
    if (!is_file($file)) {
        @mkdir(dirname($file), 0750, true);
        @file_put_contents($file, bin2hex(random_bytes(32)));
    }
    $key = @file_get_contents($file);
    return $key ?: hash('sha256', __DIR__ . php_uname());
}

/** Stateless anti-CSRF / anti-bot token: "timestamp.signature". */
function form_token(): string
{
    $ts = (string) time();
    return $ts . '.' . hash_hmac('sha256', $ts, app_secret());
}

function verify_form_token(string $token): bool
{
    [$ts, $sig] = array_pad(explode('.', $token, 2), 2, '');
    if (!ctype_digit($ts) || !hash_equals(hash_hmac('sha256', $ts, app_secret()), $sig)) {
        return false;
    }
    $age = time() - (int) $ts;
    return $age >= 3 && $age <= 60 * 60 * 6; // humans take > 3s; tokens expire after 6h
}

/** Renders the consultation form (used on home, contact, service pages). */
function consultation_form(string $preselect = '', string $idPrefix = 'cf'): void
{
    global $FORM_OLD;
    $old = is_array($FORM_OLD ?? null) ? $FORM_OLD : [];
    $selected = $old['service'] ?? $preselect;
    ?>
    <form class="form" action="<?= url('contact') ?>#form" method="post" novalidate data-validate>
        <input type="hidden" name="token" value="<?= e(form_token()) ?>">
        <div class="hp" aria-hidden="true"><label>Leave this empty <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
        <div class="form-row">
            <div class="field">
                <label for="<?= $idPrefix ?>-name">Full name *</label>
                <input id="<?= $idPrefix ?>-name" name="name" type="text" required maxlength="120" autocomplete="name" value="<?= e($old['name'] ?? '') ?>">
            </div>
            <div class="field">
                <label for="<?= $idPrefix ?>-email">Email *</label>
                <input id="<?= $idPrefix ?>-email" name="email" type="email" required maxlength="160" autocomplete="email" value="<?= e($old['email'] ?? '') ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="field">
                <label for="<?= $idPrefix ?>-phone">Phone / WhatsApp</label>
                <input id="<?= $idPrefix ?>-phone" name="phone" type="tel" maxlength="40" autocomplete="tel" value="<?= e($old['phone'] ?? '') ?>">
            </div>
            <div class="field">
                <label for="<?= $idPrefix ?>-service">Area of law</label>
                <select id="<?= $idPrefix ?>-service" name="service">
                    <option value="">Not sure – please advise</option>
                    <?php foreach (services() as $slug => $s): ?>
                        <option value="<?= e($slug) ?>"<?= $selected === $slug ? ' selected' : '' ?>><?= e($s['short']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="field">
            <label for="<?= $idPrefix ?>-message">How can we help? *</label>
            <textarea id="<?= $idPrefix ?>-message" name="message" rows="5" required maxlength="5000" placeholder="Briefly describe your situation, the other party (if any) and any deadlines."><?= e($old['message'] ?? '') ?></textarea>
        </div>
        <label class="consent"><input type="checkbox" name="consent" value="1" required<?= !empty($old['consent']) ? ' checked' : '' ?>> I agree that BAME KANG & Co may use these details to respond to my enquiry (<a href="<?= url('privacy-policy') ?>">privacy policy</a>).</label>
        <button class="btn btn-gold btn-block" type="submit">Request a consultation <?= icon('arrow') ?></button>
        <p class="form-note"><?= icon('lock', 'icon icon-sm') ?> Confidential. Sending this form does not create a lawyer–client relationship.</p>
    </form>
    <?php
}
