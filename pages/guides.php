<?php
declare(strict_types=1);

$list = [];
foreach (guides() as $slug => $g) {
    $list[] = ['@type' => 'ListItem', 'position' => count($list) + 1, 'name' => $g['title'], 'url' => abs_url('legal-guides/' . $slug)];
}

$page = [
    'title'       => 'Legal Guides for Cameroon – Company Registration, Land, Debts, OHADA & More | BAME KANG & Co',
    'description' => 'Free plain-language legal guides by Cameroonian lawyers: registering a company, buying land safely, debt recovery, OAPI trademarks, tax audits, hiring foreigners and OHADA law.',
    'path'        => 'legal-guides',
    'nav'         => 'guides',
    'page_type'   => 'CollectionPage',
    'breadcrumbs' => [['Home', ''], ['Legal Guides', 'legal-guides']],
    'eyebrow'     => 'Insights',
    'h1'          => 'Legal guides: Cameroon law explained',
    'lead'        => 'Practical answers to the questions businesses, investors, the diaspora and individuals ask us most, written by our lawyers.',
    'schema'      => [['@type' => 'ItemList', 'itemListElement' => $list]],
];
require dirname(__DIR__) . '/includes/header.php';
?>

<section class="section">
  <div class="container">
    <div class="grid grid-3">
      <?php foreach (guides() as $slug => $g): ?>
        <article class="card guide-card reveal">
          <span class="icon-box"><?= icon($g['icon']) ?></span>
          <h3><a href="<?= url('legal-guides/' . $slug) ?>"><?= e($g['short']) ?></a></h3>
          <p><?= e($g['excerpt']) ?></p>
          <div class="meta"><span><?= icon('clock') ?> <?= (int) $g['minutes'] ?> min read</span><span><?= icon('calendar') ?> Updated <?= e(date('M Y', strtotime($g['updated']))) ?></span></div>
          <span class="link-arrow" style="margin-top:18px">Read the guide <?= icon('arrow') ?></span>
        </article>
      <?php endforeach; ?>
    </div>
    <p class="note text-center">Guides provide general information and are not a substitute for legal advice on your specific situation.</p>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
