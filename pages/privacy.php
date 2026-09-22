<?php
declare(strict_types=1);

$page = [
    'title'       => 'Privacy Policy & Legal Notice | BAME KANG & Co',
    'description' => 'How BAME KANG & Co handles personal data submitted through this website, and the legal notice governing use of the site.',
    'path'        => 'privacy-policy',
    'nav'         => '',
    'breadcrumbs' => [['Home', ''], ['Privacy Policy & Legal Notice', 'privacy-policy']],
    'h1'          => 'Privacy Policy & Legal Notice',
    'lead'        => 'Last updated: ' . date('F Y', filemtime(__FILE__)),
];
require dirname(__DIR__) . '/includes/header.php';
?>

<section class="section">
  <div class="container prose" style="max-width:860px">
    <h2>1. Who we are</h2>
    <p><?= e(FIRM['name']) ?> (<?= e(FIRM['tagline']) ?>) is a law firm whose lawyers are members of the <?= e(FIRM['bar']) ?>. Office: <?= e(full_address()) ?>. Email: <a href="mailto:<?= e(FIRM['email']) ?>"><?= e(FIRM['email']) ?></a>. Telephone: <?= e(FIRM['phone_display']) ?>.</p>

    <h2>2. Personal data we collect</h2>
    <p>When you use our contact or consultation form, we collect the information you choose to provide: your name, email address, telephone number, the area of law concerned and your message. When you contact us by phone, WhatsApp or email, we receive the information contained in your communication.</p>
    <p>This website does not use advertising or tracking cookies. Our hosting provider may keep standard technical logs (such as IP address and browser type) for security purposes. Web fonts are loaded from Google Fonts, and the map on the contact page is provided by Google Maps; these services are subject to Google's privacy policy.</p>

    <h2>3. How we use it</h2>
    <ul>
      <li>To respond to your enquiry and arrange a consultation</li>
      <li>To check for conflicts of interest before accepting instructions</li>
      <li>To comply with our professional and legal obligations</li>
    </ul>
    <p>We do not sell your data or use it for unrelated marketing.</p>

    <h2>4. Confidentiality</h2>
    <p>We treat all enquiries confidentially. However, sending an enquiry does not by itself create a lawyer–client relationship. Please do not send confidential documents until we confirm that we can act for you.</p>

    <h2>5. Retention and your rights</h2>
    <p>We keep enquiry data only as long as necessary for the purposes above and our legal obligations. You may ask us to access, correct or delete your personal data by writing to <a href="mailto:<?= e(FIRM['email']) ?>"><?= e(FIRM['email']) ?></a>.</p>

    <h2>6. Legal notice &amp; disclaimer</h2>
    <p>The content of this website, including the legal guides and FAQs, is provided for general information only. It is not legal advice and should not be relied upon as such. Laws and procedures change, and every situation is different, so please seek specific advice before acting. <?= e(FIRM['name']) ?> accepts no liability for decisions taken on the basis of the general information on this website.</p>
    <p>All content on this website is the property of <?= e(FIRM['name']) ?> unless otherwise stated. Photographs are licensed stock images and do not depict the firm's clients.</p>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
