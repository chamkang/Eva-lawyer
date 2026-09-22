<?php
declare(strict_types=1);

$services = services();
$homeFaqs = [
    faqs()['Finding & hiring a lawyer in Cameroon'][1],
    faqs()['Finding & hiring a lawyer in Cameroon'][2],
    faqs()['Foreign clients, investors & the diaspora'][0],
    faqs()['Foreign clients, investors & the diaspora'][2],
    faqs()['Business & corporate'][0],
    faqs()['Disputes, debts & property'][0],
];

$page = [
    'title'       => 'BAME KANG & Co | Law Firm & Lawyers in Douala, Cameroon',
    'og_title'    => 'BAME KANG & Co – Trusted Law Firm in Douala, Cameroon',
    'description' => 'Bilingual law firm in Douala, Cameroon since ' . FIRM['founded'] . ': company registration, OHADA, tax, land titles, debt recovery, litigation & arbitration. Call ' . FIRM['phone_display'] . '.',
    'path'        => '',
    'nav'         => 'home',
    'preload'     => img('lawyer-douala-cameroon-hero'),
    'alternates'  => ['en' => '', 'fr' => 'fr', 'x-default' => ''],
    'schema'      => [faq_schema($homeFaqs, '')],
];
require dirname(__DIR__) . '/includes/header.php';

$situations = [
    ['briefcase', 'Business', 'I want to register a company in Cameroon', 'legal-guides/how-to-register-a-company-in-cameroon'],
    ['home', 'Property', 'I want to buy land and check the land title', 'legal-guides/buying-land-in-cameroon-safely'],
    ['coins', 'Debt', 'Someone owes me money and won\'t pay', 'services/debt-recovery'],
    ['percent', 'Tax', 'I received a tax audit or reassessment notice', 'services/tax-law'],
    ['gavel', 'Dispute', 'I have been sued or need to go to court', 'services/litigation'],
    ['globe', 'Abroad', 'I live abroad and need a lawyer in Cameroon', 'international-clients'],
    ['users', 'Employment', 'I need to hire an expatriate or dismiss an employee', 'services/employment-law'],
    ['bulb', 'Brand', 'I want to protect my trademark in Africa (OAPI)', 'services/intellectual-property'],
];
$featured = ['corporate-law', 'tax-law', 'real-estate', 'litigation', 'debt-recovery', 'banking-finance', 'arbitration-adr', 'oil-gas', 'intellectual-property'];
?>

<section class="hero">
  <div class="container hero-inner">
    <div class="hero-copy">
      <p class="eyebrow eyebrow-light">Barristers · Solicitors · Since <?= FIRM['founded'] ?></p>
      <h1>Trusted lawyers in <em>Douala, Cameroon</em> for business, property &amp; disputes</h1>
      <p class="hero-lead">BAME KANG &amp; Co is a bilingual corporate, tax and business law firm. For more than <?= years_in_practice() ?> years we have guided local companies, families, the diaspora and international investors through Cameroonian, OHADA and CEMAC law, in English and in French.</p>
      <div class="btn-row">
        <a class="btn btn-gold" href="<?= url('contact') ?>">Book a Consultation <?= icon('arrow') ?></a>
        <a class="btn btn-outline-light" href="<?= url('services') ?>">Explore Our Services</a>
      </div>
      <ul class="hero-trust">
        <li><?= icon('check') ?> Member of the Cameroon Bar</li>
        <li><?= icon('check') ?> English &amp; French</li>
        <li><?= icon('check') ?> Common Law &amp; Civil Law</li>
        <li><?= icon('check') ?> OHADA &amp; CEMAC expertise</li>
      </ul>
    </div>
    <div class="hero-visual">
      <div class="hero-photo">
        <img src="<?= img('lawyer-douala-cameroon-hero') ?>" alt="Lady Justice statue and legal documents – BAME KANG &amp; Co law firm in Douala, Cameroon" width="1100" height="1650" fetchpriority="high">
      </div>
      <div class="float-card float-card-1">
        <span class="icon-wrap"><?= icon('award') ?></span>
        <span><strong>Certified arbitrator</strong>CAC &amp; GICAM Arbitration Centres</span>
      </div>
      <div class="float-card float-card-2">
        <span class="icon-wrap"><?= icon('globe') ?></span>
        <span><strong>Clients on 4 continents</strong>Europe · Americas · Asia · Africa</span>
      </div>
    </div>
  </div>
</section>

<div class="container stats-wrap">
  <div class="stats reveal">
    <div class="stat"><span class="stat-num"><span data-count="<?= years_in_practice() ?>"><?= years_in_practice() ?></span><span class="gold">+</span></span><span class="stat-label">Years of practice</span></div>
    <div class="stat"><span class="stat-num"><span data-count="<?= count($services) ?>"><?= count($services) ?></span></span><span class="stat-label">Practice areas</span></div>
    <div class="stat"><span class="stat-num"><span data-count="<?= FIRM['partners'] + FIRM['associates'] + FIRM['paralegals'] ?>"><?= FIRM['partners'] + FIRM['associates'] + FIRM['paralegals'] ?></span></span><span class="stat-label">Legal professionals</span></div>
    <div class="stat"><span class="stat-num"><span data-count="2">2</span></span><span class="stat-label">Languages &amp; legal systems</span></div>
  </div>
</div>

<section class="section">
  <div class="container split">
    <div class="photo-stack reveal">
      <div class="photo-frame" style="aspect-ratio:4/4.6">
        <img src="<?= img('law-firm-cameroon-library') ?>" alt="Lady Justice statue in a law library – legal expertise in Cameroon" width="1100" height="1650" loading="lazy">
      </div>
      <div class="badge-card"><strong><?= FIRM['founded'] ?></strong><span>Founded in Douala by Everistus Bame Kang</span></div>
    </div>
    <div class="reveal">
      <p class="eyebrow">Why clients choose us</p>
      <h2>A vigorous, integrated law firm with personal attention</h2>
      <p class="lead">Our lawyers have established specialist expertise in many areas, yet the firm stays small enough to give every client the personal attention they need.</p>
      <p>Cameroon is bijural and bilingual: Common Law applies in the North-West and South-West regions, Civil Law elsewhere, and OHADA business law across the country. Our partners practise in both systems and both languages, so you get one firm for the whole country, and for cross-border matters across Central and West Africa.</p>
      <div class="grid grid-2" style="margin-top:32px">
        <div class="feature"><span class="icon-box"><?= icon('scale') ?></span><div><h3>Bijural expertise</h3><p>Common Law and Civil Law courts and procedures.</p></div></div>
        <div class="feature"><span class="icon-box"><?= icon('language') ?></span><div><h3>Truly bilingual</h3><p>Advice, contracts and court work in English and French.</p></div></div>
        <div class="feature"><span class="icon-box"><?= icon('briefcase') ?></span><div><h3>Commercially minded</h3><p>Practical solutions focused on your business goals.</p></div></div>
        <div class="feature"><span class="icon-box"><?= icon('globe') ?></span><div><h3>Regional reach</h3><p>OHADA, CEMAC and OAPI matters across Africa.</p></div></div>
      </div>
      <p style="margin-top:32px"><a class="link-arrow" href="<?= url('about') ?>">More about the firm <?= icon('arrow') ?></a></p>
    </div>
  </div>
</section>

<section class="section bg-ivory">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">How can we help you?</p>
      <h2>Find help for your situation</h2>
      <p>Tell us what is happening and we will point you to the right lawyer. Choose the situation closest to yours.</p>
    </div>
    <div class="grid grid-2">
      <?php foreach ($situations as [$ic, $label, $text, $link]): ?>
        <a class="situation reveal" href="<?= url($link) ?>">
          <span class="icon-box"><?= icon($ic) ?></span>
          <span><small><?= e($label) ?></small><?= e($text) ?></span>
          <?= icon('arrow', 'icon chev') ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Practice areas</p>
      <h2>Legal services for every stage of your business</h2>
      <p>From incorporation to financing, tax, property, employment and disputes, one integrated team handles your matter in Cameroon and across the region.</p>
    </div>
    <div class="grid grid-3">
      <?php foreach ($featured as $slug): $s = $services[$slug]; ?>
        <article class="card reveal">
          <span class="icon-box"><?= icon($s['icon']) ?></span>
          <h3><a href="<?= url('services/' . $slug) ?>"><?= e($s['name']) ?></a></h3>
          <p><?= e($s['summary']) ?></p>
          <span class="link-arrow">Learn more <?= icon('arrow') ?></span>
        </article>
      <?php endforeach; ?>
    </div>
    <p class="text-center" style="margin-top:48px"><a class="btn btn-navy" href="<?= url('services') ?>">View all <?= count($services) ?> services <?= icon('arrow') ?></a></p>
  </div>
</section>

<section class="section bg-navy intl">
  <div class="container split split-60">
    <div class="reveal">
      <p class="eyebrow eyebrow-light">International &amp; diaspora clients</p>
      <h2>Need a lawyer in Cameroon but you are abroad?</h2>
      <p>Foreign companies, investors and Cameroonians in the diaspora instruct us from Europe, North and South America, Asia and across Africa. We act for you on the ground with a power of attorney and keep you informed by email, WhatsApp and video call, so you do not have to travel.</p>
      <ul class="check-list cols-2" style="margin-top:24px">
        <li><?= icon('check') ?> Set up a company or branch</li>
        <li><?= icon('check') ?> Buy land safely, verified title</li>
        <li><?= icon('check') ?> Recover debts from Cameroonian buyers</li>
        <li><?= icon('check') ?> Enforce judgments &amp; arbitral awards</li>
        <li><?= icon('check') ?> Register trademarks in 17 OAPI states</li>
        <li><?= icon('check') ?> Hire staff and obtain approvals</li>
      </ul>
      <div class="btn-row" style="margin-top:32px">
        <a class="btn btn-gold" href="<?= url('international-clients') ?>">Guide for international clients <?= icon('arrow') ?></a>
      </div>
    </div>
    <div class="reveal">
      <div class="side-card dark" style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1)">
        <h3 style="margin-top:0">Our clients span</h3>
        <ul class="flag-row">
          <li>Europe</li><li>North America</li><li>South America</li><li>Asia</li><li>West Africa</li><li>Central Africa</li><li>The Cameroonian diaspora</li>
        </ul>
        <p style="margin:22px 0 0;font-size:.9rem;color:#a9b4c5">We advise on matters involving the six CEMAC states and the 17 OHADA member states.</p>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">How we work</p>
      <h2>Clear, simple and transparent</h2>
    </div>
    <ol class="steps steps-light reveal">
      <li><h3>Tell us your situation</h3><p>Call, WhatsApp, email or use our form. Everything you share is confidential.</p></li>
      <li><h3>Initial consultation</h3><p>We review your documents and explain your options and the likely outcome.</p></li>
      <li><h3>Written engagement</h3><p>You receive a clear engagement letter with the scope of work and fees.</p></li>
      <li><h3>We act &amp; report</h3><p>We handle your matter and keep you updated at every important step.</p></li>
    </ol>
  </div>
</section>

<section class="section bg-ivory">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Our partners</p>
      <h2>Experienced lawyers who lead your matter personally</h2>
      <p>Three partners and five associates, supported by a paralegal, bring together Common Law and Civil Law experience.</p>
    </div>
    <div class="grid grid-3">
      <?php foreach (team() as $slug => $m): ?>
        <article class="team-card compact reveal">
          <div class="team-top">
            <span class="team-since">Bar <?= $m['bar'] ?></span>
            <span class="team-scale"><?= icon('scale') ?></span>
            <span class="monogram" aria-hidden="true"><?= e($m['initials']) ?></span>
          </div>
          <div class="team-body">
            <h3><?= e($m['name']) ?></h3>
            <p class="team-role"><?= e($m['role']) ?></p>
            <ul class="tags"><?php foreach (array_slice($m['focus'], 0, 4) as $f): ?><li><?= e($f) ?></li><?php endforeach; ?></ul>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
    <p class="text-center" style="margin-top:44px"><a class="link-arrow" href="<?= url('team') ?>">Meet the full team <?= icon('arrow') ?></a></p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Legal guides</p>
      <h2>Answers to the questions clients ask most</h2>
      <p>Plain-language guides to common legal situations in Cameroon.</p>
    </div>
    <div class="grid grid-3">
      <?php foreach (array_slice(guides(), 0, 3, true) as $slug => $g): ?>
        <article class="card guide-card reveal">
          <span class="icon-box"><?= icon($g['icon']) ?></span>
          <h3><a href="<?= url('legal-guides/' . $slug) ?>"><?= e($g['short']) ?></a></h3>
          <p><?= e($g['excerpt']) ?></p>
          <span class="link-arrow">Read the guide <?= icon('arrow') ?></span>
        </article>
      <?php endforeach; ?>
    </div>
    <p class="text-center" style="margin-top:44px"><a class="link-arrow" href="<?= url('legal-guides') ?>">All legal guides <?= icon('arrow') ?></a></p>
  </div>
</section>

<section class="section bg-sand">
  <div class="container split" style="align-items:start">
    <div class="reveal">
      <p class="eyebrow">Frequently asked questions</p>
      <h2>Questions about hiring a lawyer in Cameroon</h2>
      <p class="lead">Quick answers for local clients, foreign investors and the diaspora.</p>
      <p><a class="btn btn-navy" href="<?= url('faq') ?>">See all FAQs <?= icon('arrow') ?></a></p>
    </div>
    <div class="faq-list reveal">
      <?php foreach ($homeFaqs as $i => [$q, $a]): ?>
        <details class="faq-item"<?= $i === 0 ? ' open' : '' ?>>
          <summary><?= e($q) ?></summary>
          <div class="faq-answer"><p><?= e($a) ?></p></div>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section" id="consultation">
  <div class="container contact-layout">
    <div class="reveal">
      <p class="eyebrow">Request a consultation</p>
      <h2>Let's discuss your matter</h2>
      <p class="lead">Send us a short description and a lawyer will get back to you, usually within one business day.</p>
      <div class="contact-cards" style="margin-top:28px">
        <div class="contact-card"><span class="icon-box"><?= icon('phone') ?></span><div><h3>Call us</h3><p><a href="<?= tel_link(FIRM['phone']) ?>"><?= e(FIRM['phone_display']) ?></a> · <a href="<?= tel_link(FIRM['phone2']) ?>"><?= e(FIRM['phone2_display']) ?></a></p></div></div>
        <div class="contact-card"><span class="icon-box"><?= icon('whatsapp') ?></span><div><h3>WhatsApp</h3><p><a href="<?= e(whatsapp_link()) ?>" target="_blank" rel="noopener">Chat with our team</a></p></div></div>
        <div class="contact-card"><span class="icon-box"><?= icon('pin') ?></span><div><h3>Visit us</h3><p>Dama G. Towers, Ancienne Route Bonabéri, Douala</p></div></div>
      </div>
    </div>
    <div class="form-panel reveal">
      <h2>Request a consultation</h2>
      <?php consultation_form('', 'home'); ?>
    </div>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
