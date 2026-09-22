<?php
declare(strict_types=1);

$slug = $params['slug'];
$s = services()[$slug];
$lead = $s['lead'] ? (team()[$s['lead']] ?? null) : null;
$path = 'services/' . $slug;
$relatedGuides = array_filter(guides(), fn ($g) => in_array($slug, $g['services'], true));

$serviceNode = [
    '@type' => 'Service',
    '@id' => abs_url($path) . '#service',
    'name' => $s['name'] . ' in Cameroon',
    'serviceType' => $s['name'],
    'description' => $s['summary'] . ' ' . $s['intro'][0],
    'provider' => ['@id' => firm_id()],
    'areaServed' => [
        ['@type' => 'Country', 'name' => 'Cameroon'],
        ['@type' => 'Place', 'name' => 'CEMAC region'],
        ['@type' => 'Place', 'name' => 'OHADA member states'],
    ],
    'availableLanguage' => ['English', 'French'],
    'url' => abs_url($path),
    'image' => abs_url('assets/img/' . $s['image'] . '.webp'),
    'hasOfferCatalog' => [
        '@type' => 'OfferCatalog',
        'name' => $s['name'],
        'itemListElement' => array_map(fn ($it) => ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => $it[0], 'description' => $it[1]]], $s['services']),
    ],
];

$page = [
    'title'       => $s['seo_title'] . ' | BAME KANG & Co',
    'description' => $s['meta'],
    'path'        => $path,
    'nav'         => 'services',
    'hero_image'  => $s['image'],
    'breadcrumbs' => [['Home', ''], ['Services', 'services'], [$s['short'], $path]],
    'eyebrow'     => 'Practice area',
    'h1'          => $s['name'] . ' in Cameroon',
    'lead'        => $s['summary'],
    'schema'      => [$serviceNode, faq_schema($s['faqs'], $path)],
];
require dirname(__DIR__) . '/includes/header.php';
?>

<section class="section">
  <div class="container detail-layout">
    <article class="prose">
      <div class="detail-image">
        <img src="<?= img($s['image']) ?>" alt="<?= e($s['name']) ?> – BAME KANG &amp; Co lawyers in Douala, Cameroon" width="1200" height="900">
      </div>

      <?php foreach ($s['intro'] as $i => $para): ?>
        <p<?= $i === 0 ? ' class="intro"' : '' ?>><?= e($para) ?></p>
      <?php endforeach; ?>

      <div class="situations-box">
        <h2>Is this your situation?</h2>
        <ul>
          <?php foreach ($s['situations'] as $q): ?>
            <li><?= icon('check') ?><span><?= e($q) ?></span></li>
          <?php endforeach; ?>
        </ul>
        <p style="margin:22px 0 0"><a class="btn btn-gold btn-sm" href="<?= url('contact') ?>?service=<?= e($slug) ?>#form">Yes, I need help with this <?= icon('arrow') ?></a></p>
      </div>

      <h2>How we help: our <?= e(strtolower($s['short'])) ?> services</h2>
      <div class="service-items">
        <?php foreach ($s['services'] as [$t, $d]): ?>
          <div class="service-item"><h3><?= e($t) ?></h3><p><?= e($d) ?></p></div>
        <?php endforeach; ?>
      </div>

      <h2>Key laws &amp; institutions</h2>
      <p>Our advice draws on the legal framework that governs <?= e(strtolower($s['short'])) ?> in Cameroon and the region, including:</p>
      <ul class="law-list">
        <?php foreach ($s['laws'] as $law): ?>
          <li><?= icon('book') ?><span><?= e($law) ?></span></li>
        <?php endforeach; ?>
      </ul>

      <h2>Why choose BAME KANG &amp; Co?</h2>
      <ul class="check-list cols-2">
        <li><?= icon('check') ?><span>Practising in Cameroon since <?= FIRM['founded'] ?></span></li>
        <li><?= icon('check') ?><span>Bilingual: English and French</span></li>
        <li><?= icon('check') ?><span>Common Law and Civil Law experience</span></li>
        <li><?= icon('check') ?><span>OHADA and CEMAC regional expertise</span></li>
        <li><?= icon('check') ?><span>Partner-led, personal attention</span></li>
        <li><?= icon('check') ?><span>We work remotely with clients abroad</span></li>
      </ul>

      <h2 id="faq">Frequently asked questions</h2>
      <div class="faq-list">
        <?php foreach ($s['faqs'] as $i => [$q, $a]): ?>
          <details class="faq-item"<?= $i === 0 ? ' open' : '' ?>>
            <summary><?= e($q) ?></summary>
            <div class="faq-answer"><p><?= e($a) ?></p></div>
          </details>
        <?php endforeach; ?>
      </div>

      <?php if ($relatedGuides): ?>
        <h2>Related legal guides</h2>
        <ul>
          <?php foreach ($relatedGuides as $gSlug => $g): ?>
            <li><a href="<?= url('legal-guides/' . $gSlug) ?>"><?= e($g['short']) ?></a></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>

      <p class="note">This page provides general information about <?= e(strtolower($s['name'])) ?> in Cameroon and is not legal advice. Laws and procedures change; contact us for advice on your specific situation.</p>
    </article>

    <aside class="sidebar">
      <div class="side-card dark">
        <h2>Speak to a lawyer</h2>
        <p>Get advice on <?= e(strtolower($s['short'])) ?> in Cameroon, in English or French.</p>
        <div class="side-contact">
          <p><?= icon('phone') ?><a href="<?= tel_link(FIRM['phone']) ?>"><?= e(FIRM['phone_display']) ?></a></p>
          <p><?= icon('mail') ?><a href="mailto:<?= e(FIRM['email']) ?>"><?= e(FIRM['email']) ?></a></p>
        </div>
        <a class="btn btn-gold btn-block" href="<?= url('contact') ?>?service=<?= e($slug) ?>#form">Book a Consultation</a>
        <a class="btn btn-outline-light btn-block" href="<?= e(whatsapp_link('Hello BAME KANG & Co, I need advice on ' . $s['short'] . '.')) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> WhatsApp</a>
      </div>

      <?php if ($lead): ?>
        <div class="side-card">
          <h2>Partner in charge</h2>
          <div style="display:flex;gap:14px;align-items:center">
            <span class="brand-mark" style="width:56px;height:56px;border-radius:50%;font-size:1rem"><?= e($lead['initials']) ?></span>
            <div><strong style="color:var(--ink)"><?= e($lead['name']) ?></strong><br><span style="font-size:.88rem;color:var(--muted)"><?= e($lead['role']) ?></span></div>
          </div>
          <p style="margin:14px 0 0"><a class="link-arrow" href="<?= url('team') ?>#<?= e($s['lead']) ?>">View profile <?= icon('arrow') ?></a></p>
        </div>
      <?php endif; ?>

      <div class="side-card">
        <h2>All services</h2>
        <ul class="side-links">
          <?php foreach (services() as $oSlug => $o): ?>
            <li><a href="<?= url('services/' . $oSlug) ?>"<?= $oSlug === $slug ? ' aria-current="page"' : '' ?>><?= e($o['short']) ?> <?= icon('chevron') ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </aside>
  </div>
</section>

<section class="section bg-ivory">
  <div class="container">
    <div class="section-head">
      <p class="eyebrow">Related services</p>
      <h2>Often needed together</h2>
    </div>
    <div class="grid grid-4">
      <?php foreach ($s['related'] as $rSlug): $r = services()[$rSlug]; ?>
        <article class="card reveal">
          <span class="icon-box"><?= icon($r['icon']) ?></span>
          <h3><a href="<?= url('services/' . $rSlug) ?>"><?= e($r['short']) ?></a></h3>
          <p><?= e($r['summary']) ?></p>
          <span class="link-arrow">Learn more <?= icon('arrow') ?></span>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
