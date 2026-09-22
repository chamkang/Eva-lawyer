<?php
declare(strict_types=1);

$page = [
    'title'       => 'About BAME KANG & Co – Bilingual Law Firm in Douala, Cameroon Since ' . FIRM['founded'],
    'description' => 'BAME KANG & Co is a bilingual, bijural corporate, tax and business law firm founded in ' . FIRM['founded'] . ' in Douala, Cameroon, serving clients from Europe, the Americas, Asia and Africa.',
    'path'        => 'about',
    'nav'         => 'about',
    'page_type'   => 'AboutPage',
    'hero_image'  => 'law-firm-cameroon-library',
    'breadcrumbs' => [['Home', ''], ['About', 'about']],
    'eyebrow'     => 'About the firm',
    'h1'          => 'A vigorous and integrated law firm in Cameroon',
    'lead'        => 'Corporate, tax and business lawyers for domestic and international clients doing business in Cameroon and the Central African sub-region since ' . FIRM['founded'] . '.',
];
require dirname(__DIR__) . '/includes/header.php';
?>

<section class="section">
  <div class="container split">
    <div class="reveal">
      <p class="eyebrow">Our story</p>
      <h2>More than <?= years_in_practice() ?> years of legal practice in Cameroon</h2>
      <p class="lead">BAME KANG &amp; Co is a vigorous and integrated corporate, tax and business law firm serving domestic and international clients who do business in Cameroon and the Central African sub-region.</p>
      <p>The firm was founded in <?= FIRM['founded'] ?> by <strong>Everistus Bame Kang</strong>, after four years at the Shafack &amp; Ndongla Law Firm. Today it holds a respected position among the dynamic, creative and professionally committed law firms in Cameroon.</p>
      <p>Our reputation, experience and expertise allow us to provide a high standard of legal service to clients across Europe, North and South America, Asia, and West and Central Africa. We navigate both the Common Law and Civil Law systems that operate in Cameroon and offer truly bilingual legal services in English and French.</p>
    </div>
    <div class="photo-stack reveal">
      <div class="photo-frame" style="aspect-ratio:4/3">
        <img src="<?= img('corporate-lawyer-cameroon') ?>" alt="Client signing a legal agreement with BAME KANG &amp; Co lawyers" width="1200" height="900" loading="lazy">
      </div>
      <div class="badge-card"><strong><?= years_in_practice() ?>+</strong><span>years advising businesses, investors and families</span></div>
    </div>
  </div>
</section>

<section class="section bg-ivory">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">What makes us different</p>
      <h2>Specialist expertise, personal attention</h2>
      <p>Our team has established specialist expertise in many areas, yet the firm is of a size that lets us give every client the personal attention they need. A strong focus on the commercial realities of business and private transactions is fundamental to how we work.</p>
    </div>
    <div class="grid grid-3">
      <div class="card reveal"><span class="icon-box"><?= icon('scale') ?></span><h3>Bijural by design</h3><p>Cameroon applies Common Law in its two English-speaking regions and Civil Law elsewhere. Our lawyers practise confidently in both.</p></div>
      <div class="card reveal"><span class="icon-box"><?= icon('language') ?></span><h3>Bilingual service</h3><p>We advise, draft and litigate in English and French, so nothing is lost in translation.</p></div>
      <div class="card reveal"><span class="icon-box"><?= icon('globe') ?></span><h3>OHADA &amp; CEMAC expertise</h3><p>Deep knowledge of OHADA Uniform Acts and CEMAC banking, customs and foreign-exchange rules.</p></div>
      <div class="card reveal"><span class="icon-box"><?= icon('target') ?></span><h3>Commercially focused</h3><p>Practical, solution-oriented advice that supports your business objectives.</p></div>
      <div class="card reveal"><span class="icon-box"><?= icon('award') ?></span><h3>Recognised arbitrator</h3><p>Our founding partner is a certified arbitrator with the Cameroon Arbitration Centre (CAC) and the GICAM Arbitration Centre.</p></div>
      <div class="card reveal"><span class="icon-box"><?= icon('users') ?></span><h3>Young, dynamic team</h3><p>Our attorneys take part in conferences and workshops to keep improving their professional development.</p></div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container split" style="align-items:start">
    <div class="reveal">
      <p class="eyebrow">Key facts</p>
      <h2>BAME KANG &amp; Co at a glance</h2>
      <p>The essential facts about the firm, for clients, partners and researchers.</p>
    </div>
    <div class="reveal">
      <table class="facts">
        <tr><th scope="row">Firm name</th><td><?= e(FIRM['name']) ?>, <?= e(FIRM['tagline']) ?></td></tr>
        <tr><th scope="row">Founded</th><td><?= FIRM['founded'] ?>, by Everistus Bame Kang</td></tr>
        <tr><th scope="row">Office</th><td><?= e(full_address()) ?></td></tr>
        <tr><th scope="row">Team</th><td><?= FIRM['partners'] ?> partners, <?= FIRM['associates'] ?> associates and <?= FIRM['paralegals'] ?> paralegal</td></tr>
        <tr><th scope="row">Languages</th><td>English and French</td></tr>
        <tr><th scope="row">Legal systems</th><td>Common Law, Civil Law, OHADA Uniform Acts, CEMAC regulations</td></tr>
        <tr><th scope="row">Professional body</th><td><?= e(FIRM['bar']) ?></td></tr>
        <tr><th scope="row">Arbitration</th><td>Founding partner certified with the CAC and GICAM Arbitration Centres</td></tr>
        <tr><th scope="row">Practice areas</th><td><?= count(services()) ?>, including corporate, tax, banking, real estate, litigation, debt recovery, arbitration, energy, mining and IP. <a href="<?= url('services') ?>">See all</a></td></tr>
        <tr><th scope="row">Clients</th><td>Local and multinational companies, financial institutions, investors, individuals and the diaspora</td></tr>
        <tr><th scope="row">Contact</th><td><a href="<?= tel_link(FIRM['phone']) ?>"><?= e(FIRM['phone_display']) ?></a> · <a href="mailto:<?= e(FIRM['email']) ?>"><?= e(FIRM['email']) ?></a></td></tr>
      </table>
    </div>
  </div>
</section>

<section class="section bg-navy">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow eyebrow-light">Our values</p>
      <h2>What every client can expect</h2>
    </div>
    <ol class="steps reveal">
      <li><h3>Integrity</h3><p>Honest advice about your prospects, even when it is not what you hoped to hear.</p></li>
      <li><h3>Confidentiality</h3><p>Your affairs are protected by strict professional secrecy.</p></li>
      <li><h3>Responsiveness</h3><p>Clear communication and regular updates on your matter.</p></li>
      <li><h3>Excellence</h3><p>Careful preparation and high professional standards at every stage.</p></li>
    </ol>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Who we serve</p>
      <h2>Clients we work with</h2>
    </div>
    <div class="grid grid-4">
      <div class="feature reveal"><span class="icon-box"><?= icon('globe') ?></span><div><h3>Foreign investors</h3><p>Companies entering Cameroon and the CEMAC market.</p></div></div>
      <div class="feature reveal"><span class="icon-box"><?= icon('briefcase') ?></span><div><h3>Local businesses</h3><p>SMEs and groups in every sector of the economy.</p></div></div>
      <div class="feature reveal"><span class="icon-box"><?= icon('bank') ?></span><div><h3>Financial institutions</h3><p>Banks, microfinance institutions and insurers.</p></div></div>
      <div class="feature reveal"><span class="icon-box"><?= icon('home') ?></span><div><h3>Individuals &amp; diaspora</h3><p>Property buyers, employees and families.</p></div></div>
    </div>
    <p class="text-center" style="margin-top:48px"><a class="btn btn-navy" href="<?= url('team') ?>">Meet our team <?= icon('arrow') ?></a></p>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
