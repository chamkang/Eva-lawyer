<?php
declare(strict_types=1);

$status = null;       // 'sent' | 'error'
$errors = [];
$FORM_OLD = [];

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $in = fn (string $k, int $max) => mb_substr(trim((string) ($_POST[$k] ?? '')), 0, $max);
    $data = [
        'name'    => $in('name', 120),
        'email'   => $in('email', 160),
        'phone'   => $in('phone', 40),
        'service' => $in('service', 60),
        'message' => $in('message', 5000),
        'consent' => !empty($_POST['consent']),
    ];
    $FORM_OLD = $data;

    $isBot = ($_POST['website'] ?? '') !== '' || !verify_form_token((string) ($_POST['token'] ?? ''));
    if ($data['name'] === '') $errors[] = 'Please enter your name.';
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email address.';
    if (mb_strlen($data['message']) < 10) $errors[] = 'Please describe your matter in a few words.';
    if (!$data['consent']) $errors[] = 'Please tick the consent box so we can reply to you.';
    if (preg_match_all('#https?://#i', $data['message']) > 3) $isBot = true;

    if ($isBot) {
        // Pretend success to bots, do nothing.
        $status = 'sent';
        $FORM_OLD = [];
    } elseif (!$errors) {
        $serviceName = services()[$data['service']]['name'] ?? 'Not specified';
        $clean = fn (string $s) => str_replace(["\r", "\n"], ' ', $s);
        $body = "New consultation request from the website\n"
            . "------------------------------------------\n"
            . 'Name:    ' . $data['name'] . "\n"
            . 'Email:   ' . $data['email'] . "\n"
            . 'Phone:   ' . ($data['phone'] ?: '-') . "\n"
            . 'Service: ' . $serviceName . "\n"
            . 'Date:    ' . date('Y-m-d H:i') . "\n\n"
            . $data['message'] . "\n";
        $subject = '=?UTF-8?B?' . base64_encode('Website enquiry: ' . $clean($data['name']) . ' – ' . $serviceName) . '?=';
        $headers = implode("\r\n", [
            'From: ' . FIRM['name'] . ' Website <' . CONTACT_FROM . '>',
            'Reply-To: ' . $clean($data['email']),
            'Content-Type: text/plain; charset=UTF-8',
            'X-Mailer: PHP',
        ]);

        // Keep a private backup copy (storage/ is blocked from the web by .htaccess).
        $dir = dirname(__DIR__) . '/storage/messages';
        if (!is_dir($dir)) @mkdir($dir, 0750, true);
        @file_put_contents($dir . '/' . date('Ymd-His') . '-' . bin2hex(random_bytes(3)) . '.txt', $body);

        $sent = @mail(CONTACT_TO, $subject, $body, $headers);
        $status = $sent ? 'sent' : 'error';
        if ($sent) $FORM_OLD = [];
    }
}

if (!$FORM_OLD && isset($_GET['service']) && isset(services()[$_GET['service']])) {
    $FORM_OLD = ['service' => $_GET['service']];
}

$mapQuery = rawurlencode('Dama G. Towers, Ancienne Route Bonaberi, Douala, Cameroon');
$page = [
    'title'       => 'Contact BAME KANG & Co – Lawyers in Douala, Cameroon | ' . FIRM['phone_display'],
    'description' => 'Contact BAME KANG & Co, Dama G. Towers, Bonabéri, Douala. Call or WhatsApp ' . FIRM['phone_display'] . ' or email ' . FIRM['email'] . ' to book a consultation.',
    'path'        => 'contact',
    'nav'         => 'contact',
    'page_type'   => 'ContactPage',
    'breadcrumbs' => [['Home', ''], ['Contact', 'contact']],
    'eyebrow'     => 'Contact us',
    'h1'          => 'Book a consultation with a lawyer in Douala',
    'lead'        => 'Call, WhatsApp, email or send the form below. We work in English and French, in person or remotely.',
    'hide_cta'    => true,
];
require dirname(__DIR__) . '/includes/header.php';
?>

<section class="section">
  <div class="container contact-layout">
    <div>
      <div class="contact-cards">
        <div class="contact-card reveal"><span class="icon-box"><?= icon('phone') ?></span><div><h3>Phone</h3><p><a href="<?= tel_link(FIRM['phone']) ?>"><?= e(FIRM['phone_display']) ?></a><br><a href="<?= tel_link(FIRM['phone2']) ?>"><?= e(FIRM['phone2_display']) ?></a></p></div></div>
        <div class="contact-card reveal"><span class="icon-box"><?= icon('whatsapp') ?></span><div><h3>WhatsApp</h3><p><a href="<?= e(whatsapp_link()) ?>" target="_blank" rel="noopener">Message us on WhatsApp</a></p></div></div>
        <div class="contact-card reveal"><span class="icon-box"><?= icon('mail') ?></span><div><h3>Email</h3><p><a href="mailto:<?= e(FIRM['email']) ?>"><?= e(FIRM['email']) ?></a></p></div></div>
        <div class="contact-card reveal"><span class="icon-box"><?= icon('pin') ?></span><div><h3>Office</h3><p><?= e(FIRM['street']) ?><br><?= e(FIRM['po_box']) ?>, <?= e(FIRM['city']) ?>, <?= e(FIRM['country']) ?></p></div></div>
        <div class="contact-card reveal"><span class="icon-box"><?= icon('clock') ?></span><div><h3>Office hours</h3><p><?= e(FIRM['hours_display']) ?></p></div></div>
        <div class="contact-card reveal"><span class="icon-box"><?= icon('video') ?></span><div><h3>Abroad?</h3><p>We hold consultations by phone and video call. <a href="<?= url('international-clients') ?>">How it works</a></p></div></div>
      </div>
    </div>

    <div class="form-panel" id="form">
      <h2>Send us your enquiry</h2>
      <p style="color:var(--muted)">Tell us briefly about your situation. Please do not send confidential documents until we have confirmed we can act for you.</p>
      <?php if ($status === 'sent'): ?>
        <div class="alert alert-success" role="status">Thank you. Your message has been sent. A member of our team will contact you shortly, usually within one business day.</div>
      <?php elseif ($status === 'error'): ?>
        <div class="alert alert-error" role="alert">Sorry, your message could not be sent right now. Please email us at <a href="mailto:<?= e(FIRM['email']) ?>"><?= e(FIRM['email']) ?></a> or call <?= e(FIRM['phone_display']) ?>.</div>
      <?php elseif ($errors): ?>
        <div class="alert alert-error" role="alert"><?= implode('<br>', array_map('e', $errors)) ?></div>
      <?php endif; ?>
      <?php consultation_form('', 'contact'); ?>
    </div>
  </div>
</section>

<section class="section-sm bg-ivory">
  <div class="container">
    <div class="section-head reveal" style="margin-bottom:32px">
      <p class="eyebrow">Find us</p>
      <h2>Our office in Bonabéri, Douala</h2>
      <p>Dama G. Towers, No. 1 Nangah Company Avenue, Ancienne Route Bonabéri.</p>
    </div>
    <div class="map reveal">
      <iframe title="Map to BAME KANG &amp; Co, Douala" src="https://maps.google.com/maps?q=<?= $mapQuery ?>&amp;z=15&amp;output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
    </div>
    <p class="text-center" style="margin-top:20px"><a class="link-arrow" href="https://www.google.com/maps/search/?api=1&amp;query=<?= $mapQuery ?>" target="_blank" rel="noopener">Open in Google Maps <?= icon('arrow') ?></a></p>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
