<?php
/** Browser-based article editor. Route: /admin (+ ?action=…) */
declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/admin.php';

header('X-Robots-Tag: noindex, nofollow', true);
$action = $_GET['action'] ?? 'list';
$notice = '';
$error = '';
$hasPassword = admin_password_hash() !== '';

/* ---------------------------------------------------------------- actions */
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    admin_session();
    $form = $_POST['form'] ?? '';

    if ($form === 'setup' && !$hasPassword) {
        $pw = (string) ($_POST['password'] ?? '');
        if (strlen($pw) < 8) {
            $error = 'Choose a password of at least 8 characters.';
        } elseif ($pw !== ($_POST['password2'] ?? '')) {
            $error = 'The two passwords do not match.';
        } else {
            admin_set_password($pw);
            admin_login($pw);
            $hasPassword = true;
            $notice = 'Password saved. You are signed in.';
        }
    } elseif ($form === 'login') {
        if (admin_lockout() > 0) {
            $error = 'Too many attempts. Try again in ' . ceil(admin_lockout() / 60) . ' minutes.';
        } elseif (admin_login((string) ($_POST['password'] ?? ''))) {
            $notice = 'Signed in.';
        } else {
            $error = 'Wrong password.';
        }
    } elseif ($form === 'save' && admin_logged_in()) {
        if (!hash_equals((string) ($_SESSION['admin_csrf'] ?? ''), (string) ($_POST['csrf'] ?? ''))) {
            $error = 'Session expired, please try again.';
        } else {
            $faqs = [];
            foreach ((array) ($_POST['faq_q'] ?? []) as $i => $q) {
                $q = trim((string) $q);
                $a = trim((string) ($_POST['faq_a'][$i] ?? ''));
                if ($q !== '' && $a !== '') {
                    $faqs[] = [$q, $a];
                }
            }
            $title = trim((string) ($_POST['title'] ?? ''));
            $bodyText = (string) ($_POST['body'] ?? '');
            if ($title === '' || trim($bodyText) === '') {
                $error = 'A title and some text are required.';
            } else {
                $post = [
                    'slug'      => trim((string) ($_POST['slug'] ?? '')) ?: $title,
                    'title'     => $title,
                    'short'     => trim((string) ($_POST['short'] ?? '')),
                    'seo_title' => trim((string) ($_POST['seo_title'] ?? '')),
                    'meta'      => trim((string) ($_POST['meta'] ?? '')),
                    'excerpt'   => trim((string) ($_POST['excerpt'] ?? '')),
                    'icon'      => trim((string) ($_POST['icon'] ?? 'doc')),
                    'minutes'   => (int) ($_POST['minutes'] ?? 0),
                    'updated'   => trim((string) ($_POST['updated'] ?? '')) ?: date('Y-m-d'),
                    'services'  => array_values(array_intersect((array) ($_POST['services'] ?? []), array_keys(services()))),
                    'body'      => text_to_html($bodyText),
                    'faqs'      => $faqs,
                    'published' => !empty($_POST['published']),
                ];
                $old = trim((string) ($_POST['original_slug'] ?? ''));
                $slug = admin_save_post($post);
                if ($old !== '' && $old !== $slug) {
                    admin_delete_post($old);
                }
                $notice = $post['published'] ? 'Saved and published.' : 'Saved as a draft.';
                $action = 'list';
            }
        }
    } elseif ($form === 'delete' && admin_logged_in()) {
        if (hash_equals((string) ($_SESSION['admin_csrf'] ?? ''), (string) ($_POST['csrf'] ?? ''))) {
            admin_delete_post((string) ($_POST['slug'] ?? ''));
            $notice = 'Article deleted.';
        }
        $action = 'list';
    }
}

if (isset($_GET['logout'])) {
    admin_logout();
    header('Location: ' . url('admin'));
    exit;
}

admin_session();
if (empty($_SESSION['admin_csrf'])) {
    $_SESSION['admin_csrf'] = bin2hex(random_bytes(16));
}
$csrf = (string) $_SESSION['admin_csrf'];
$loggedIn = admin_logged_in();

/* ------------------------------------------------------------------ view  */
$ICONS = ['doc', 'briefcase', 'home', 'coins', 'bulb', 'globe', 'percent', 'scale', 'users', 'gavel', 'bank', 'shield', 'anchor', 'leaf', 'plane', 'mountain', 'flame', 'handshake'];
$editing = null;
if ($loggedIn && $action === 'edit') {
    $slug = (string) ($_GET['slug'] ?? '');
    $editing = admin_posts()[$slug] ?? null;
}
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>Articles · <?= e(FIRM['name']) ?></title>
<link rel="icon" href="<?= url('favicon.svg') ?>" type="image/svg+xml">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600&display=swap">
<link rel="stylesheet" href="<?= asset('css/style.css') ?>">
<style>
body { background: var(--ivory); }
.admin-bar { background: var(--navy-900); color: #fff; padding: 14px 0; }
.admin-bar .container { display: flex; align-items: center; justify-content: space-between; gap: 16px; }
.admin-bar a { color: #d8dee8; text-decoration: none; font-size: .92rem; }
.admin-bar a:hover { color: var(--gold-400); }
.admin-wrap { max-width: 960px; margin: 0 auto; padding: 40px 20px 80px; }
.panel { background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 28px; margin-bottom: 24px; }
.panel h1, .panel h2 { margin-top: 0; }
.post-row { display: flex; gap: 16px; align-items: center; justify-content: space-between; padding: 16px 0; border-bottom: 1px solid var(--line); }
.post-row:last-child { border-bottom: 0; }
.post-row h3 { margin: 0 0 4px; font-size: 1.1rem; }
.post-row .meta { font-size: .85rem; color: var(--muted); }
.badge { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: .74rem; font-weight: 600; }
.badge-live { background: #e7f5ee; color: #1d7a4f; }
.badge-draft { background: #fdf3e2; color: #a97f38; }
.row-actions { display: flex; gap: 8px; flex: none; }
.hint { font-size: .84rem; color: var(--muted); margin: 4px 0 0; }
textarea.body { min-height: 420px; font-family: ui-monospace, Consolas, monospace; font-size: .95rem; line-height: 1.6; }
.faq-row { display: grid; grid-template-columns: 1fr 1.4fr auto; gap: 10px; margin-bottom: 10px; }
@media (max-width: 720px) { .faq-row { grid-template-columns: 1fr; } }
.toolbar { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 10px; }
.toolbar button { padding: 6px 12px; border: 1px solid var(--line); background: #fff; border-radius: 8px; cursor: pointer; font-size: .85rem; }
.toolbar button:hover { border-color: var(--gold-500); }
.grid-2a { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
@media (max-width: 720px) { .grid-2a { grid-template-columns: 1fr; } }
</style>
</head>
<body>
<div class="admin-bar">
  <div class="container">
    <strong style="font-family:var(--font-display)">Articles · <?= e(FIRM['name']) ?></strong>
    <span>
      <?php if ($loggedIn): ?>
        <a href="<?= url('legal-guides') ?>" target="_blank">View site ↗</a> &nbsp;·&nbsp;
        <a href="<?= url('admin') ?>">All articles</a> &nbsp;·&nbsp;
        <a href="<?= url('admin') ?>?logout=1">Sign out</a>
      <?php endif; ?>
    </span>
  </div>
</div>

<div class="admin-wrap">
<?php if ($notice): ?><div class="alert alert-success"><?= e($notice) ?></div><?php endif; ?>
<?php if ($error): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>

<?php if (!$hasPassword): ?>
  <div class="panel">
    <h1>Set your admin password</h1>
    <p>This is the first time the editor is opened. Choose a password – you will use it to sign in and write articles.</p>
    <form method="post" class="form">
      <input type="hidden" name="form" value="setup">
      <div class="field"><label for="p1">Password (8+ characters)</label><input id="p1" type="password" name="password" required minlength="8" autocomplete="new-password"></div>
      <div class="field"><label for="p2">Repeat password</label><input id="p2" type="password" name="password2" required minlength="8" autocomplete="new-password"></div>
      <button class="btn btn-gold" type="submit">Save password</button>
    </form>
  </div>

<?php elseif (!$loggedIn): ?>
  <div class="panel" style="max-width:440px;margin-inline:auto">
    <h1>Sign in</h1>
    <form method="post" class="form">
      <input type="hidden" name="form" value="login">
      <div class="field"><label for="pw">Password</label><input id="pw" type="password" name="password" required autocomplete="current-password" autofocus></div>
      <button class="btn btn-gold btn-block" type="submit">Sign in</button>
    </form>
  </div>

<?php elseif ($action === 'edit' || $action === 'new'): ?>
  <?php
  $p = $editing ?: ['slug' => '', 'title' => '', 'short' => '', 'seo_title' => '', 'meta' => '', 'excerpt' => '',
                    'icon' => 'doc', 'minutes' => 0, 'updated' => date('Y-m-d'), 'services' => [], 'body' => '',
                    'faqs' => [], 'published' => false];
  ?>
  <div class="panel">
    <h1><?= $editing ? 'Edit article' : 'New article' ?></h1>
    <form method="post" class="form" id="editor">
      <input type="hidden" name="form" value="save">
      <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
      <input type="hidden" name="original_slug" value="<?= e((string) $p['slug']) ?>">

      <div class="field">
        <label for="title">Title *</label>
        <input id="title" name="title" value="<?= e((string) $p['title']) ?>" required maxlength="160" placeholder="How to recover a debt from a company in Cameroon">
        <p class="hint">Write it as the question or task a client would type into Google.</p>
      </div>

      <div class="grid-2a">
        <div class="field">
          <label for="slug">Web address</label>
          <input id="slug" name="slug" value="<?= e((string) $p['slug']) ?>" maxlength="90" placeholder="left empty = made from the title">
          <p class="hint">/legal-guides/<span id="slug-preview"><?= e((string) $p['slug']) ?></span></p>
        </div>
        <div class="field">
          <label for="short">Short title (cards &amp; menus)</label>
          <input id="short" name="short" value="<?= e((string) $p['short']) ?>" maxlength="90">
        </div>
      </div>

      <div class="field">
        <label for="seo_title">Google title</label>
        <input id="seo_title" name="seo_title" value="<?= e((string) $p['seo_title']) ?>" maxlength="120">
        <p class="hint">Aim for under 60 characters. Use <code>{year}</code> to insert the current year automatically.</p>
      </div>

      <div class="field">
        <label for="meta">Google description *</label>
        <textarea id="meta" name="meta" rows="2" maxlength="200" required><?= e((string) $p['meta']) ?></textarea>
        <p class="hint"><span id="meta-count">0</span>/160 characters shown in search results.</p>
      </div>

      <div class="field">
        <label for="excerpt">Card summary</label>
        <textarea id="excerpt" name="excerpt" rows="2" maxlength="220"><?= e((string) $p['excerpt']) ?></textarea>
      </div>

      <div class="field">
        <label for="body">Article *</label>
        <div class="toolbar">
          <button type="button" data-ins="## ">Heading</button>
          <button type="button" data-ins="### ">Sub-heading</button>
          <button type="button" data-ins="- ">Bullet</button>
          <button type="button" data-ins="1. ">Numbered</button>
          <button type="button" data-wrap="**">Bold</button>
          <button type="button" data-wrap="*">Italic</button>
          <button type="button" data-ins="[text](https://)">Link</button>
        </div>
        <textarea id="body" class="body" name="body" required placeholder="Write normally.

## This becomes a heading
- This becomes a bullet
**This is bold** and [this is a link](https://example.com)"><?= e($editing ? html_to_text((string) $p['body']) : '') ?></textarea>
        <p class="hint">Plain text. Start a line with ## for a heading, - for a bullet, 1. for a numbered list.</p>
      </div>

      <div class="grid-2a">
        <div class="field">
          <label for="icon">Icon</label>
          <select id="icon" name="icon">
            <?php foreach ($ICONS as $ic): ?>
              <option value="<?= e($ic) ?>"<?= $p['icon'] === $ic ? ' selected' : '' ?>><?= e($ic) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="field">
          <label for="updated">Date</label>
          <input id="updated" type="date" name="updated" value="<?= e((string) $p['updated']) ?>">
        </div>
      </div>

      <div class="field">
        <label>Related services (helps internal linking &amp; SEO)</label>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(230px,1fr));gap:6px">
          <?php foreach (services() as $slug => $s): ?>
            <label style="display:flex;gap:8px;align-items:center;font-weight:400;font-size:.92rem">
              <input type="checkbox" name="services[]" value="<?= e($slug) ?>"<?= in_array($slug, (array) $p['services'], true) ? ' checked' : '' ?>>
              <?= e($s['short']) ?>
            </label>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="field">
        <label>Questions &amp; answers (shown on the page and sent to Google/AI as FAQ data)</label>
        <div id="faqs">
          <?php $faqs = (array) $p['faqs']; if (!$faqs) { $faqs = [['', '']]; } ?>
          <?php foreach ($faqs as [$q, $a]): ?>
            <div class="faq-row">
              <input name="faq_q[]" value="<?= e((string) $q) ?>" placeholder="Question people ask">
              <input name="faq_a[]" value="<?= e((string) $a) ?>" placeholder="Short, direct answer">
              <button type="button" class="btn btn-sm btn-outline" data-remove>Remove</button>
            </div>
          <?php endforeach; ?>
        </div>
        <button type="button" class="btn btn-sm btn-outline" id="add-faq">+ Add question</button>
      </div>

      <label class="consent"><input type="checkbox" name="published" value="1"<?= !empty($p['published']) ? ' checked' : '' ?>> Publish on the website (leave unticked to keep it as a draft)</label>

      <div class="btn-row">
        <button class="btn btn-gold" type="submit">Save article</button>
        <a class="btn btn-outline" href="<?= url('admin') ?>">Cancel</a>
      </div>
    </form>
  </div>

<?php else: ?>
  <div class="panel">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap">
      <h1 style="margin:0">Your articles</h1>
      <a class="btn btn-gold" href="<?= url('admin') ?>?action=new">+ New article</a>
    </div>
    <?php $posts = admin_posts(); ?>
    <?php if (!$posts): ?>
      <p class="hint" style="margin-top:20px">No articles written here yet. Click “New article” to write your first one.</p>
    <?php else: ?>
      <div style="margin-top:14px">
        <?php foreach ($posts as $slug => $post): ?>
          <div class="post-row">
            <div>
              <h3><?= e((string) $post['title']) ?></h3>
              <p class="meta">
                <span class="badge <?= !empty($post['published']) ? 'badge-live' : 'badge-draft' ?>"><?= !empty($post['published']) ? 'Published' : 'Draft' ?></span>
                &nbsp;/legal-guides/<?= e($slug) ?> &nbsp;·&nbsp; updated <?= e((string) $post['updated']) ?>
              </p>
            </div>
            <div class="row-actions">
              <?php if (!empty($post['published'])): ?>
                <a class="btn btn-sm btn-outline" href="<?= url('legal-guides/' . $slug) ?>" target="_blank">View</a>
              <?php endif; ?>
              <a class="btn btn-sm btn-navy" href="<?= url('admin') ?>?action=edit&amp;slug=<?= urlencode($slug) ?>">Edit</a>
              <form method="post" onsubmit="return confirm('Delete this article permanently?')" style="display:inline">
                <input type="hidden" name="form" value="delete">
                <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
                <input type="hidden" name="slug" value="<?= e($slug) ?>">
                <button class="btn btn-sm btn-outline" type="submit">Delete</button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <div class="panel">
    <h2>Built-in guides</h2>
    <p class="hint">These <?= count(data('guides')) ?> guides were written into the site's code (<code>data/guides.php</code>). They stay published and can be edited by a developer. Articles you write here appear above them on the guides page.</p>
  </div>
<?php endif; ?>
</div>

<script>
(function () {
  var t = document.getElementById('title'), s = document.getElementById('slug'), sp = document.getElementById('slug-preview');
  function slugify(v) { return v.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '').slice(0, 80); }
  if (t && s) {
    t.addEventListener('input', function () { if (!s.dataset.touched) { s.value = slugify(t.value); sp.textContent = s.value; } });
    s.addEventListener('input', function () { s.dataset.touched = '1'; s.value = slugify(s.value); sp.textContent = s.value; });
  }
  var meta = document.getElementById('meta'), mc = document.getElementById('meta-count');
  if (meta && mc) { var upd = function () { mc.textContent = meta.value.length; }; meta.addEventListener('input', upd); upd(); }
  var body = document.getElementById('body');
  document.querySelectorAll('.toolbar button').forEach(function (b) {
    b.addEventListener('click', function () {
      var start = body.selectionStart, end = body.selectionEnd, sel = body.value.slice(start, end);
      if (b.dataset.wrap) { body.setRangeText(b.dataset.wrap + (sel || 'text') + b.dataset.wrap, start, end, 'end'); }
      else { body.setRangeText(b.dataset.ins + sel, start, end, 'end'); }
      body.focus();
    });
  });
  var faqs = document.getElementById('faqs');
  var add = document.getElementById('add-faq');
  if (add) {
    add.addEventListener('click', function () {
      var row = document.createElement('div');
      row.className = 'faq-row';
      row.innerHTML = '<input name="faq_q[]" placeholder="Question people ask"><input name="faq_a[]" placeholder="Short, direct answer"><button type="button" class="btn btn-sm btn-outline" data-remove>Remove</button>';
      faqs.appendChild(row);
    });
    faqs.addEventListener('click', function (e) {
      if (e.target.matches('[data-remove]')) { e.target.closest('.faq-row').remove(); }
    });
  }
})();
</script>
</body>
</html>
