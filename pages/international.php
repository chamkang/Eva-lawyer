<?php
declare(strict_types=1);

$intlFaqs = faqs()['Foreign clients, investors & the diaspora'];

$page = [
    'title'       => 'Lawyer in Cameroon for Foreigners, Investors & the Diaspora | English-Speaking Law Firm',
    'description' => 'Need a lawyer in Cameroon while living abroad? English- and French-speaking law firm in Douala acting remotely for foreign companies, investors and the diaspora.',
    'path'        => 'international-clients',
    'nav'         => 'international',
    'hero_image'  => 'international-trade-lawyer-cameroon',
    'breadcrumbs' => [['Home', ''], ['International Clients', 'international-clients']],
    'eyebrow'     => 'For foreign clients, investors & the diaspora',
    'h1'          => 'Your English- and French-speaking law firm in Cameroon',
    'lead'        => 'Whether you are a company entering Central Africa, an investor with a dispute, or a Cameroonian abroad buying land back home, we act for you on the ground, and you do not need to travel.',
    'schema'      => [faq_schema($intlFaqs, 'international-clients')],
];
require dirname(__DIR__) . '/includes/header.php';
?>

<section class="section">
  <div class="container split">
    <div class="reveal">
      <p class="eyebrow">Why Cameroon, why us</p>
      <h2>Cameroon is the gateway to Central Africa</h2>
      <p class="lead">Cameroon is the largest economy in the CEMAC zone, with the region's main port at Douala and a deep-sea port at Kribi. It is also a member of OHADA, whose business laws apply in 17 African countries.</p>
      <p>But Cameroon is legally unique: it is bilingual (English and French) and bijural (Common Law and Civil Law). International clients need a firm that can move easily between both. That is how BAME KANG &amp; Co has worked since <?= FIRM['founded'] ?>, for clients across Europe, North and South America, Asia and Africa.</p>
      <ul class="check-list">
        <li><?= icon('check') ?><span><strong>English-speaking lawyers in Cameroon</strong>: advice, contracts and reports in fluent English</span></li>
        <li><?= icon('check') ?><span><strong>French-speaking counsel</strong> for francophone courts and administrations</span></li>
        <li><?= icon('check') ?><span><strong>Remote engagement</strong> by email, WhatsApp and video call</span></li>
        <li><?= icon('check') ?><span><strong>Written fee agreements</strong> and payment by international transfer</span></li>
      </ul>
    </div>
    <div class="photo-stack reveal">
      <div class="photo-frame" style="aspect-ratio:4/3.4">
        <img src="<?= img('maritime-shipping-lawyer-douala') ?>" alt="Container port – international trade lawyers in Douala, Cameroon" width="1200" height="900" loading="lazy">
      </div>
      <div class="badge-card"><strong>4</strong><span>continents where our clients are based</span></div>
    </div>
  </div>
</section>

<section class="section bg-ivory">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">What we do for international clients</p>
      <h2>Common reasons foreigners hire a lawyer in Cameroon</h2>
    </div>
    <div class="grid grid-3">
      <?php
      $cards = [
          ['briefcase', 'Set up a business', 'Register a subsidiary, branch or liaison office, get licences and open accounts, all handled remotely.', 'services/corporate-law'],
          ['home', 'Buy land or property safely', 'Title checks at the land registry, safe purchase and registration for diaspora and foreign buyers.', 'services/real-estate'],
          ['coins', 'Recover a debt', 'Get paid by a Cameroonian customer using OHADA recovery procedures.', 'services/debt-recovery'],
          ['gavel', 'Resolve a dispute', 'Litigation in English or French, or arbitration under OHADA, CCJA or ICC rules.', 'services/litigation'],
          ['bulb', 'Protect your brand in Africa', 'One OAPI trademark filing covers 17 African states.', 'services/intellectual-property'],
          ['users', 'Send staff to Cameroon', 'Expatriate contract approvals, visas, residence permits and payroll compliance.', 'services/employment-law'],
          ['percent', 'Manage tax exposure', 'Structuring, withholding tax, treaties and tax audits.', 'services/tax-law'],
          ['anchor', 'Ship & trade through Douala', 'Cargo claims, ship arrest, customs and distribution agreements.', 'services/maritime-shipping'],
          ['handshake', 'Enforce a foreign judgment or award', 'Recognition and enforcement of foreign court decisions and arbitral awards in Cameroon.', 'services/arbitration-adr'],
      ];
      foreach ($cards as [$ic, $t, $d, $l]): ?>
        <article class="card reveal">
          <span class="icon-box"><?= icon($ic) ?></span>
          <h3><a href="<?= url($l) ?>"><?= e($t) ?></a></h3>
          <p><?= e($d) ?></p>
          <span class="link-arrow">Learn more <?= icon('arrow') ?></span>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section bg-navy">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow eyebrow-light">Working with us from abroad</p>
      <h2>Four simple steps, wherever you are</h2>
    </div>
    <ol class="steps reveal">
      <li><h3>Video or phone consultation</h3><p>We discuss your matter at a time that suits your time zone (Cameroon is on GMT+1).</p></li>
      <li><h3>Engagement letter &amp; ID checks</h3><p>A clear written scope, timeline and fee agreement.</p></li>
      <li><h3>Power of attorney</h3><p>We send you the exact wording and legalisation steps so we can act for you.</p></li>
      <li><h3>We act &amp; report</h3><p>Scanned documents, photos and updates at every key step.</p></li>
    </ol>
  </div>
</section>

<section class="section">
  <div class="container split" style="align-items:start">
    <div class="reveal">
      <p class="eyebrow">Diaspora</p>
      <h2>For Cameroonians living abroad</h2>
      <p class="lead">Buying land, building a house, investing in a business or protecting family property from abroad is risky if you rely on relatives or intermediaries alone.</p>
      <p>We give you an independent, professional pair of hands in Cameroon: we verify land titles before you pay, handle the notary and registry formalities, supervise contracts with builders, set up your company, and represent you if a dispute arises.</p>
      <p><a class="link-arrow" href="<?= url('legal-guides/buying-land-in-cameroon-safely') ?>">Read: how to buy land in Cameroon safely <?= icon('arrow') ?></a></p>
      <p><a class="link-arrow" href="<?= url('legal-guides/hiring-a-lawyer-in-cameroon-from-abroad') ?>">Read: hiring a lawyer in Cameroon from abroad <?= icon('arrow') ?></a></p>
    </div>
    <div class="faq-list reveal">
      <?php foreach ($intlFaqs as $i => [$q, $a]): ?>
        <details class="faq-item"<?= $i === 0 ? ' open' : '' ?>>
          <summary><?= e($q) ?></summary>
          <div class="faq-answer"><p><?= e($a) ?></p></div>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section bg-ivory">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Regional reach</p>
      <h2>Cameroon and beyond: CEMAC &amp; OHADA</h2>
      <p>Because business law is harmonised across OHADA and CEMAC, our Cameroon-based advice is relevant to matters in many African countries.</p>
    </div>
    <div class="grid grid-2">
      <div class="card reveal"><span class="icon-box"><?= icon('globe') ?></span><h3>CEMAC (6 countries)</h3><p>Cameroon, Gabon, Republic of Congo, Chad, Central African Republic and Equatorial Guinea share the CFA franc (XAF), the BEAC central bank, COBAC banking supervision and common customs rules.</p></div>
      <div class="card reveal"><span class="icon-box"><?= icon('scale') ?></span><h3>OHADA (17 countries)</h3><p>Benin, Burkina Faso, Cameroon, CAR, Chad, Comoros, Congo, Côte d'Ivoire, DR Congo, Equatorial Guinea, Gabon, Guinea, Guinea-Bissau, Mali, Niger, Senegal and Togo share uniform business laws.</p></div>
    </div>
    <p class="text-center" style="margin-top:40px"><a class="btn btn-navy" href="<?= url('areas-we-serve') ?>">See all areas we serve <?= icon('arrow') ?></a></p>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
