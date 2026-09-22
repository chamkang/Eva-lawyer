<?php
declare(strict_types=1);

$groups = faqs();
$all = array_merge(...array_values($groups));
$groupIcons = ['scale', 'globe', 'briefcase', 'gavel', 'award'];

$page = [
    'title'       => 'FAQs – Hiring a Lawyer in Cameroon, OHADA, Land, Debts & Business | BAME KANG & Co',
    'description' => 'Answers to common questions: how to find a good lawyer in Cameroon, hiring a Cameroonian lawyer from abroad, company registration, OHADA, land titles, debt recovery, fees and more.',
    'path'        => 'faq',
    'nav'         => 'faq',
    'breadcrumbs' => [['Home', ''], ['FAQs', 'faq']],
    'eyebrow'     => 'Frequently asked questions',
    'h1'          => 'Questions about lawyers & law in Cameroon',
    'lead'        => 'Clear answers for businesses, individuals, foreign investors and the diaspora. Can\'t find your question? Ask us directly.',
    'schema'      => [faq_schema($all, 'faq')],
];
require dirname(__DIR__) . '/includes/header.php';
?>

<section class="section">
  <div class="container" style="max-width:920px">
    <nav class="faq-nav" aria-label="FAQ topics">
      <?php $i = 0; foreach ($groups as $title => $items): ?>
        <a class="chip" href="#faq-<?= $i++ ?>"><?= e($title) ?></a>
      <?php endforeach; ?>
    </nav>

    <?php $i = 0; foreach ($groups as $title => $items): ?>
      <div class="faq-group" id="faq-<?= $i ?>">
        <h2><span class="icon-box"><?= icon($groupIcons[$i] ?? 'scale') ?></span><?= e($title) ?></h2>
        <div class="faq-list">
          <?php foreach ($items as [$q, $a]): ?>
            <details class="faq-item">
              <summary><?= e($q) ?></summary>
              <div class="faq-answer"><p><?= e($a) ?></p></div>
            </details>
          <?php endforeach; ?>
        </div>
      </div>
    <?php $i++; endforeach; ?>

    <div class="side-card dark" style="text-align:center;padding:40px">
      <h2>Still have a question?</h2>
      <p>Our lawyers are happy to help, in English or French.</p>
      <div class="btn-row" style="justify-content:center">
        <a class="btn btn-gold" href="<?= url('contact') ?>">Ask a lawyer <?= icon('arrow') ?></a>
        <a class="btn btn-outline-light" href="<?= tel_link(FIRM['phone']) ?>"><?= icon('phone') ?> <?= e(FIRM['phone_display']) ?></a>
      </div>
    </div>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
