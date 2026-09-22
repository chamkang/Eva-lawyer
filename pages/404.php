<?php
declare(strict_types=1);

$page = [
    'title'       => 'Page not found | BAME KANG & Co',
    'description' => 'The page you are looking for could not be found.',
    'path'        => '',
    'nav'         => '',
    'noindex'     => true,
];
require dirname(__DIR__) . '/includes/header.php';
?>

<section class="section not-found">
  <div class="container">
    <p class="code">404</p>
    <h1>We couldn't find that page</h1>
    <p class="lead">The page may have moved. Try one of these instead:</p>
    <div class="btn-row" style="justify-content:center">
      <a class="btn btn-navy" href="<?= url() ?>">Home</a>
      <a class="btn btn-outline" href="<?= url('services') ?>">Our Services</a>
      <a class="btn btn-outline" href="<?= url('faq') ?>">FAQs</a>
      <a class="btn btn-gold" href="<?= url('contact') ?>">Contact a Lawyer</a>
    </div>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
