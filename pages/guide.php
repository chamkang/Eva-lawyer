<?php
declare(strict_types=1);

$slug = $params['slug'];
$g = guides()[$slug];
$path = 'legal-guides/' . $slug;
$modified = $g['updated'];

$article = [
    '@type' => 'Article',
    '@id' => abs_url($path) . '#article',
    'headline' => $g['title'],
    'description' => $g['meta'],
    'author' => ['@id' => firm_id()],
    'publisher' => ['@id' => firm_id()],
    'datePublished' => '2026-01-15',
    'dateModified' => $modified,
    'mainEntityOfPage' => abs_url($path),
    'image' => abs_url('assets/img/og-image.jpg'),
    'inLanguage' => 'en',
    'about' => array_map(fn ($s) => ['@type' => 'Thing', 'name' => services()[$s]['name'] . ' in Cameroon'], $g['services']),
];

$page = [
    'title'       => str_replace('{year}', date('Y'), $g['seo_title']) . ' | BAME KANG & Co',
    'description' => $g['meta'],
    'path'        => $path,
    'nav'         => 'guides',
    'og_type'     => 'article',
    'breadcrumbs' => [['Home', ''], ['Legal Guides', 'legal-guides'], [$g['short'], $path]],
    'eyebrow'     => 'Legal guide',
    'h1'          => $g['title'],
    'schema'      => [$article, faq_schema($g['faqs'], $path)],
];
require dirname(__DIR__) . '/includes/header.php';
?>

<section class="section">
  <div class="container detail-layout">
    <article class="prose">
      <div class="key-answer">
        <strong>In short</strong>
        <p><?= e($g['faqs'][0][1]) ?></p>
      </div>

      <?= $g['body'] /* trusted, firm-authored HTML */ ?>

      <h2>Frequently asked questions</h2>
      <div class="faq-list">
        <?php foreach ($g['faqs'] as [$q, $a]): ?>
          <details class="faq-item" open>
            <summary><?= e($q) ?></summary>
            <div class="faq-answer"><p><?= e($a) ?></p></div>
          </details>
        <?php endforeach; ?>
      </div>

      <h2>Get help from a lawyer in Cameroon</h2>
      <p>BAME KANG &amp; Co has advised clients in Cameroon since <?= FIRM['founded'] ?>. Relevant services:</p>
      <ul>
        <?php foreach ($g['services'] as $sSlug): ?>
          <li><a href="<?= url('services/' . $sSlug) ?>"><?= e(services()[$sSlug]['name']) ?></a></li>
        <?php endforeach; ?>
      </ul>
      <p class="note">By <?= e(FIRM['name']) ?>, <?= e(FIRM['tagline']) ?>, Douala, Cameroon. Last updated <?= e(date('j F Y', strtotime($modified))) ?>. This guide is general information, not legal advice. Laws and procedures change, so contact us for advice on your situation.</p>
    </article>

    <aside class="sidebar">
      <div class="side-card dark">
        <h2>Need advice on this?</h2>
        <p>Speak to a lawyer in English or French. We can act for you even if you are abroad.</p>
        <a class="btn btn-gold btn-block" href="<?= url('contact') ?>?service=<?= e($g['services'][0]) ?>#form">Book a Consultation</a>
        <a class="btn btn-outline-light btn-block" href="<?= e(whatsapp_link('Hello BAME KANG & Co, I read your guide "' . $g['short'] . '" and need advice.')) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> WhatsApp</a>
      </div>
      <div class="side-card">
        <h2>More guides</h2>
        <ul class="side-links">
          <?php foreach (guides() as $oSlug => $o): if ($oSlug === $slug) continue; ?>
            <li><a href="<?= url('legal-guides/' . $oSlug) ?>"><?= e($o['short']) ?> <?= icon('chevron') ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </aside>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
