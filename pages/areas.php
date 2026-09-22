<?php
declare(strict_types=1);

$cities = [
    ['Douala', 'Our office is in Bonabéri, Douala, Cameroon\'s economic capital and main port. We serve businesses, banks, shipping and trading companies, and individuals across the Littoral region: company formation, contracts, debt recovery, property and litigation before the Douala courts.'],
    ['Yaoundé', 'The political capital, home to ministries, regulators, OAPI and many public institutions. We handle licensing, regulatory approvals, trademark filings at OAPI and litigation for clients in Yaoundé and the Centre region.'],
    ['Buea &amp; Limbe', 'In the South-West region, where Common Law applies, our English-speaking litigators appear before the Common Law courts and advise on property, business and petroleum-sector matters.'],
    ['Bamenda', 'In the North-West region, another Common Law jurisdiction, we assist clients in English with property, business and commercial matters and disputes.'],
    ['Kribi', 'Home to Cameroon\'s deep-sea port and major industrial and energy projects. We advise on port, logistics, maritime, land and investment matters in the South region.'],
    ['Across Cameroon', 'Garoua, Bafoussam, Ngaoundéré, Bertoua, Ebolowa, Maroua and beyond: we act for clients nationwide, travelling where needed and coordinating local formalities.'],
];

$page = [
    'title'       => 'Lawyers Serving Douala, Yaoundé, Buea, All of Cameroon & Central Africa | BAME KANG & Co',
    'description' => 'BAME KANG & Co serves clients in Douala, Yaoundé, Buea, Limbe, Bamenda, Kribi and across Cameroon, plus cross-border matters in the CEMAC region, OHADA states and Africa.',
    'path'        => 'areas-we-serve',
    'nav'         => 'international',
    'hero_image'  => 'maritime-shipping-lawyer-douala',
    'breadcrumbs' => [['Home', ''], ['Areas We Serve', 'areas-we-serve']],
    'eyebrow'     => 'Areas we serve',
    'h1'          => 'Lawyers for Douala, all of Cameroon & Central Africa',
    'lead'        => 'From our Douala office we act for clients throughout Cameroon, in the English-speaking and French-speaking regions, and on cross-border matters across Africa.',
];
require dirname(__DIR__) . '/includes/header.php';
?>

<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">In Cameroon</p>
      <h2>A law firm for the whole country</h2>
      <p>Cameroonian lawyers are admitted to practise throughout the national territory. Our bilingual team covers both the Common Law regions (North-West and South-West) and the Civil Law regions.</p>
    </div>
    <div class="grid grid-3">
      <?php foreach ($cities as [$city, $text]): ?>
        <article class="card area-card reveal">
          <h3><?= icon('pin') ?> <?= $city ?></h3>
          <p><?= $text ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section bg-navy">
  <div class="container split">
    <div class="reveal">
      <p class="eyebrow eyebrow-light">Central &amp; West Africa</p>
      <h2>Cross-border matters across Africa</h2>
      <p>Many of our clients operate in several African countries. Harmonised OHADA business law and CEMAC regulations mean our expertise applies to company, contract, security, debt recovery, insolvency and arbitration questions in:</p>
      <ul class="flag-row">
        <li>Gabon</li><li>Republic of Congo</li><li>Chad</li><li>Central African Republic</li><li>Equatorial Guinea</li><li>Côte d'Ivoire</li><li>Senegal</li><li>DR Congo</li><li>Benin</li><li>Togo</li><li>Burkina Faso</li><li>Mali</li><li>Niger</li><li>Guinea</li><li>Guinea-Bissau</li><li>Comoros</li>
      </ul>
      <p style="margin-top:22px">Our founding partner also holds an LLM from Ahmadu Bello University, Nigeria, which gives useful insight into Nigerian and West African Common Law practice for Nigeria–Cameroon matters.</p>
    </div>
    <div class="reveal">
      <div class="grid" style="gap:16px">
        <div class="feature"><span class="icon-box"><?= icon('scale') ?></span><div><h3>OHADA Uniform Acts</h3><p>Company law, securities, debt recovery, insolvency and arbitration across 17 states.</p></div></div>
        <div class="feature"><span class="icon-box"><?= icon('bank') ?></span><div><h3>CEMAC regulation</h3><p>Banking (COBAC), monetary and exchange rules (BEAC), customs.</p></div></div>
        <div class="feature"><span class="icon-box"><?= icon('bulb') ?></span><div><h3>OAPI intellectual property</h3><p>One trademark or patent filing for 17 African states.</p></div></div>
        <div class="feature"><span class="icon-box"><?= icon('shield') ?></span><div><h3>CIMA insurance code</h3><p>Harmonised insurance regulation across francophone Africa.</p></div></div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Worldwide</p>
      <h2>International clients</h2>
      <p>Our clients span Europe, North and South America, Asia and Africa. Wherever you are based, if you need a reliable lawyer in Cameroon, we can act for you remotely, in English or French.</p>
    </div>
    <p class="text-center"><a class="btn btn-navy" href="<?= url('international-clients') ?>">How we work with international clients <?= icon('arrow') ?></a></p>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
