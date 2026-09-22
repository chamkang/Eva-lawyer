<?php
declare(strict_types=1);

$page = [
    'title'       => 'Our Lawyers – Partners of BAME KANG & Co, Douala, Cameroon',
    'description' => 'Meet the partners of BAME KANG & Co in Douala: Everistus Bame Kang, Ernest Molombe Nganje and Takoussap Jean Jacques – bilingual, bijural Cameroonian lawyers.',
    'path'        => 'team',
    'nav'         => 'team',
    'breadcrumbs' => [['Home', ''], ['Our Team', 'team']],
    'eyebrow'     => 'Our people',
    'h1'          => 'Meet our lawyers',
    'lead'        => 'Three partners and five associates, supported by a paralegal. Bilingual, bijural and committed to your matter.',
];
require dirname(__DIR__) . '/includes/header.php';
?>

<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">The partners</p>
      <h2>Partner-led advice on every matter</h2>
      <p>Each client matter is supervised by a partner with direct experience of the issues involved.</p>
    </div>
    <div class="grid grid-3">
      <?php foreach (team() as $slug => $m): ?>
        <article class="team-card reveal" id="<?= e($slug) ?>">
          <div class="team-top">
            <span class="team-since">Called to the Bar <?= $m['bar'] ?></span>
            <span class="team-scale"><?= icon('scale') ?></span>
            <span class="monogram" aria-hidden="true"><?= e($m['initials']) ?></span>
          </div>
          <div class="team-body">
            <h3><?= e($m['name']) ?></h3>
            <p class="team-role"><?= e($m['role']) ?></p>
            <p><?= e($m['bio']) ?></p>
            <ul class="team-meta">
              <?php foreach ($m['education'] as $ed): ?>
                <li><?= icon('book') ?><span><?= e($ed) ?></span></li>
              <?php endforeach; ?>
              <li><?= icon('calendar') ?><span>Joined the firm in <?= $m['joined'] ?></span></li>
              <li><?= icon('language') ?><span><?= e(implode(' & ', $m['languages'])) ?></span></li>
              <?php foreach ($m['highlights'] as $h): if (str_starts_with($h, 'Head') || str_starts_with($h, 'Certified')): ?>
                <li><?= icon('award') ?><span><?= e($h) ?></span></li>
              <?php endif; endforeach; ?>
            </ul>
            <ul class="tags"><?php foreach ($m['focus'] as $f): ?><li><?= e($f) ?></li><?php endforeach; ?></ul>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section bg-ivory">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Our team composition</p>
      <h2>A complete legal team</h2>
      <p>Given Cameroon's bilingual and bijural nature, the firm is staffed by practitioners with an excellent command of English and French and practical experience of both the Common Law and Civil Law systems.</p>
    </div>
    <div class="team-summary reveal">
      <div><strong><?= FIRM['partners'] ?></strong><span>Partners</span></div>
      <div><strong><?= FIRM['associates'] ?></strong><span>Associates</span></div>
      <div><strong><?= FIRM['paralegals'] ?></strong><span>Paralegal</span></div>
    </div>
    <div class="grid grid-3" style="margin-top:48px">
      <div class="feature reveal"><span class="icon-box"><?= icon('users') ?></span><div><h3>Young &amp; dynamic</h3><p>Our attorneys work with domestic and transnational companies and regularly attend conferences and workshops to keep developing professionally.</p></div></div>
      <div class="feature reveal"><span class="icon-box"><?= icon('scale') ?></span><div><h3>Both legal traditions</h3><p>English-speaking Common Law litigators and a French-speaking Civil Law partner under one roof.</p></div></div>
      <div class="feature reveal"><span class="icon-box"><?= icon('handshake') ?></span><div><h3>One point of contact</h3><p>Your matter is coordinated by one lawyer, who brings in colleagues as needed.</p></div></div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container split">
    <div class="reveal">
      <p class="eyebrow">Careers</p>
      <h2>Join BAME KANG &amp; Co</h2>
      <p class="lead">We welcome applications from motivated, bilingual lawyers, pupils and interns who share our commitment to excellence.</p>
      <p>Send your CV and cover letter to <a href="mailto:<?= e(FIRM['email']) ?>?subject=Application"><?= e(FIRM['email']) ?></a> with "Application" in the subject line.</p>
    </div>
    <div class="reveal">
      <ul class="check-list">
        <li><?= icon('check') ?><span>Exposure to corporate, tax, property and dispute work</span></li>
        <li><?= icon('check') ?><span>Work with local and international clients</span></li>
        <li><?= icon('check') ?><span>Practice in English and French</span></li>
        <li><?= icon('check') ?><span>Mentoring by experienced partners</span></li>
      </ul>
    </div>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
