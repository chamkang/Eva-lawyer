<?php
declare(strict_types=1);

$services = services();
$cats = service_categories();

$list = [];
foreach ($services as $slug => $s) {
    $list[] = ['@type' => 'ListItem', 'position' => count($list) + 1, 'name' => $s['name'], 'url' => abs_url('services/' . $slug)];
}

$page = [
    'title'       => 'Legal Services in Cameroon – ' . count($services) . ' Practice Areas | BAME KANG & Co, Douala',
    'description' => 'Legal services in Cameroon: corporate & OHADA, tax, banking, land & property, litigation, debt recovery, arbitration, oil & gas, mining, OAPI trademarks and more.',
    'path'        => 'services',
    'nav'         => 'services',
    'breadcrumbs' => [['Home', ''], ['Services', 'services']],
    'eyebrow'     => 'Practice areas',
    'h1'          => 'Our Legal Services in Cameroon',
    'lead'        => count($services) . ' practice areas, one integrated team. Select a service to read how we help, the laws involved and answers to common questions.',
    'schema'      => [['@type' => 'ItemList', 'name' => 'Legal services offered by BAME KANG & Co', 'itemListElement' => $list]],
];
require dirname(__DIR__) . '/includes/header.php';
?>

<section class="section">
  <div class="container" data-directory>
    <div class="service-tools">
      <label class="search-box">
        <span class="visually-hidden">Search services</span>
        <?= icon('search') ?>
        <input type="search" placeholder="Search, e.g. land, tax, trademark, debt…" autocomplete="off">
      </label>
      <div class="chips" role="group" aria-label="Filter by category">
        <button type="button" class="chip" data-filter="all" aria-pressed="true">All</button>
        <?php foreach ($cats as $key => [$label]): ?>
          <button type="button" class="chip" data-filter="<?= e($key) ?>" aria-pressed="false"><?= e($label) ?></button>
        <?php endforeach; ?>
      </div>
    </div>

    <?php foreach ($cats as $key => [$label, $desc]): ?>
      <?php $inCat = array_filter($services, fn ($s) => $s['category'] === $key); if (!$inCat) continue; ?>
      <div class="category-block" data-category="<?= e($key) ?>">
        <div class="category-title">
          <h2><?= e($label) ?></h2>
          <p><?= e($desc) ?></p>
        </div>
        <div class="grid grid-3">
          <?php foreach ($inCat as $slug => $s): ?>
            <article class="card service-card reveal" data-search="<?= e(strtolower($s['name'] . ' ' . $s['summary'] . ' ' . implode(' ', array_column($s['services'], 0)))) ?>">
              <div class="thumb">
                <img src="<?= img($s['image']) ?>" alt="<?= e($s['name']) ?> lawyer in Cameroon" width="1200" height="900" loading="lazy">
                <span class="icon-box"><?= icon($s['icon']) ?></span>
              </div>
              <div class="body">
                <h3><a href="<?= url('services/' . $slug) ?>"><?= e($s['name']) ?></a></h3>
                <p><?= e($s['summary']) ?></p>
                <span class="link-arrow">Read more <?= icon('arrow') ?></span>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
    <p class="no-results" hidden>No service matches your search. <a href="<?= url('contact') ?>">Describe your situation to us</a> and we will direct you to the right lawyer.</p>
  </div>
</section>

<section class="section bg-ivory">
  <div class="container split">
    <div class="reveal">
      <p class="eyebrow">Not sure which service you need?</p>
      <h2>Tell us what happened. We will find the right lawyer.</h2>
      <p class="lead">Many matters involve several areas of law at once, such as a land purchase with financing and tax, or a dispute with an employment angle. Our partners work together so you deal with one firm and one point of contact.</p>
      <div class="btn-row"><a class="btn btn-navy" href="<?= url('contact') ?>">Contact a lawyer <?= icon('arrow') ?></a><a class="btn btn-outline" href="<?= url('faq') ?>">Read the FAQs</a></div>
    </div>
    <div class="grid grid-2 reveal">
      <div class="feature"><span class="icon-box"><?= icon('language') ?></span><div><h3>English &amp; French</h3><p>Advice and court work in both official languages.</p></div></div>
      <div class="feature"><span class="icon-box"><?= icon('scale') ?></span><div><h3>Both legal systems</h3><p>Common Law and Civil Law practice.</p></div></div>
      <div class="feature"><span class="icon-box"><?= icon('globe') ?></span><div><h3>OHADA &amp; CEMAC</h3><p>Regional business, banking and customs rules.</p></div></div>
      <div class="feature"><span class="icon-box"><?= icon('shield') ?></span><div><h3>Confidential</h3><p>Your information is protected by professional secrecy.</p></div></div>
    </div>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
