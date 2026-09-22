<?php declare(strict_types=1); ?>
<?php if (empty($page['hide_cta'])): ?>
<section class="cta-band">
  <div class="container cta-band-inner">
    <div>
      <p class="eyebrow eyebrow-light">Speak to a lawyer in Cameroon</p>
      <h2>Tell us about your matter. We aim to respond within one business day.</h2>
      <p>In English or French · In person in Douala, by phone, WhatsApp or video call – wherever you are in the world.</p>
    </div>
    <div class="cta-band-actions">
      <a class="btn btn-gold" href="<?= url('contact') ?>">Book a Consultation <?= icon('arrow') ?></a>
      <a class="btn btn-outline-light" href="<?= e(whatsapp_link()) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> WhatsApp Us</a>
    </div>
  </div>
</section>
<?php endif; ?>
</main>

<footer class="site-footer">
  <div class="container footer-grid">
    <div class="footer-brand">
      <a class="brand brand-light" href="<?= url() ?>">
        <span class="brand-mark" aria-hidden="true">BK</span>
        <span class="brand-text"><strong>BAME KANG <span>&amp;</span> Co</strong><small><?= e(FIRM['tagline']) ?></small></span>
      </a>
      <p>A bilingual, bijural law firm in Douala, Cameroon, advising local and international clients on business, tax, property and disputes since <?= FIRM['founded'] ?>.</p>
      <?php $social = array_filter(FIRM['social']); unset($social['google']); ?>
      <?php if ($social): ?>
      <ul class="social">
        <?php foreach ($social as $net => $link): ?>
          <li><a href="<?= e($link) ?>" target="_blank" rel="noopener" aria-label="<?= e(ucfirst($net)) ?>"><?= icon($net) ?></a></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </div>
    <div>
      <h2 class="footer-title">The Firm</h2>
      <ul class="footer-links">
        <li><a href="<?= url('about') ?>">About Us</a></li>
        <li><a href="<?= url('team') ?>">Our Team</a></li>
        <li><a href="<?= url('international-clients') ?>">International Clients</a></li>
        <li><a href="<?= url('areas-we-serve') ?>">Areas We Serve</a></li>
        <li><a href="<?= url('legal-guides') ?>">Legal Guides</a></li>
        <li><a href="<?= url('faq') ?>">FAQs</a></li>
        <li><a href="<?= url('fr') ?>" hreflang="fr" lang="fr">Avocat au Cameroun (FR)</a></li>
      </ul>
    </div>
    <div>
      <h2 class="footer-title">Key Services</h2>
      <ul class="footer-links">
        <?php foreach (['corporate-law', 'tax-law', 'real-estate', 'litigation', 'debt-recovery', 'arbitration-adr', 'intellectual-property'] as $slug): ?>
          <li><a href="<?= url('services/' . $slug) ?>"><?= e(services()[$slug]['short']) ?></a></li>
        <?php endforeach; ?>
        <li><a href="<?= url('services') ?>"><strong>All services →</strong></a></li>
      </ul>
    </div>
    <div>
      <h2 class="footer-title">Contact</h2>
      <address class="footer-contact">
        <p><?= icon('pin', 'icon icon-sm') ?> <span><?= e(FIRM['street']) ?>, <?= e(FIRM['po_box']) ?>, <?= e(FIRM['city']) ?>, <?= e(FIRM['country']) ?></span></p>
        <p><?= icon('phone', 'icon icon-sm') ?> <span><a href="<?= tel_link(FIRM['phone']) ?>"><?= e(FIRM['phone_display']) ?></a><br><a href="<?= tel_link(FIRM['phone2']) ?>"><?= e(FIRM['phone2_display']) ?></a></span></p>
        <p><?= icon('mail', 'icon icon-sm') ?> <a href="mailto:<?= e(FIRM['email']) ?>"><?= e(FIRM['email']) ?></a></p>
        <p><?= icon('clock', 'icon icon-sm') ?> <span><?= e(FIRM['hours_display']) ?></span></p>
      </address>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container footer-bottom-inner">
      <p>&copy; <?= date('Y') ?> <?= e(FIRM['name']) ?>. All rights reserved. Member of the <?= e(FIRM['bar']) ?>.</p>
      <p><a href="<?= url('privacy-policy') ?>">Privacy Policy &amp; Legal Notice</a> · <a href="<?= url('sitemap.xml') ?>">Sitemap</a></p>
    </div>
    <p class="container disclaimer">The information on this website is general and does not constitute legal advice. Contacting us does not create a lawyer–client relationship until an engagement is confirmed in writing.</p>
  </div>
</footer>

<a class="whatsapp-float" href="<?= e(whatsapp_link()) ?>" target="_blank" rel="noopener" aria-label="Chat with BAME KANG &amp; Co on WhatsApp"><?= icon('whatsapp') ?><span>Chat with a lawyer</span></a>
<a class="to-top" href="#top" aria-label="Back to top"><?= icon('chevron') ?></a>

<script src="<?= asset('js/main.js') ?>" defer></script>
</body>
</html>
