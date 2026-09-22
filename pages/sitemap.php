<?php
declare(strict_types=1);

header('Content-Type: application/xml; charset=UTF-8');

$root = dirname(__DIR__);
$mod = fn (string $f) => date('Y-m-d', max(filemtime($root . '/' . $f), filemtime($root . '/includes/header.php')));
$urls = [
    ['', '1.0', 'weekly', $mod('pages/home.php'), ['en' => '', 'fr' => 'fr']],
    ['fr', '0.9', 'monthly', $mod('pages/french.php'), ['en' => '', 'fr' => 'fr']],
    ['services', '0.9', 'monthly', $mod('data/services.php'), []],
    ['international-clients', '0.9', 'monthly', $mod('pages/international.php'), []],
    ['about', '0.8', 'monthly', $mod('pages/about.php'), []],
    ['team', '0.8', 'monthly', $mod('data/team.php'), []],
    ['faq', '0.8', 'monthly', $mod('data/faqs.php'), []],
    ['contact', '0.8', 'yearly', $mod('pages/contact.php'), []],
    ['areas-we-serve', '0.7', 'monthly', $mod('pages/areas.php'), []],
    ['legal-guides', '0.7', 'weekly', $mod('data/guides.php'), []],
    ['privacy-policy', '0.2', 'yearly', $mod('pages/privacy.php'), []],
];
foreach (services() as $slug => $s) {
    $urls[] = ['services/' . $slug, '0.8', 'monthly', $mod('data/services.php'), [], 'assets/img/' . $s['image'] . '.webp', $s['name']];
}
foreach (guides() as $slug => $g) {
    $urls[] = ['legal-guides/' . $slug, '0.7', 'monthly', $g['updated'], []];
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
<?php foreach ($urls as $u): ?>
  <url>
    <loc><?= e(abs_url($u[0])) ?></loc>
    <lastmod><?= e($u[3]) ?></lastmod>
    <changefreq><?= $u[2] ?></changefreq>
    <priority><?= $u[1] ?></priority>
<?php foreach ($u[4] as $hl => $p): ?>
    <xhtml:link rel="alternate" hreflang="<?= $hl ?>" href="<?= e(abs_url($p)) ?>"/>
<?php endforeach; ?>
<?php if (!empty($u[5])): ?>
    <image:image><image:loc><?= e(abs_url($u[5])) ?></image:loc><image:title><?= e($u[6] . ' lawyer in Cameroon') ?></image:title></image:image>
<?php endif; ?>
  </url>
<?php endforeach; ?>
</urlset>
