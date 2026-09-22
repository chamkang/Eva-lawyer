<?php
declare(strict_types=1);

$frServices = [
    'corporate-law'         => ['Droit des sociétés & OHADA', 'Création de sociétés (SARL, SAS, SA), succursales, gouvernance, fusions-acquisitions et investissements étrangers.'],
    'tax-law'               => ['Droit fiscal & contentieux fiscal', 'Conseil fiscal, contrôles et redressements fiscaux, prix de transfert, douane et incitations à l\'investissement.'],
    'banking-finance'       => ['Banque & finance', 'Financements, sûretés OHADA, conformité COBAC et BEAC, crédit-bail et réglementation des changes CEMAC.'],
    'real-estate'           => ['Droit immobilier & foncier', 'Vérification des titres fonciers, achat de terrain sécurisé, baux commerciaux, promotion immobilière et litiges fonciers.'],
    'litigation'            => ['Contentieux civil & commercial', 'Représentation devant les juridictions camerounaises, en français (droit civil) et en anglais (Common Law).'],
    'debt-recovery'         => ['Recouvrement de créances', 'Mise en demeure, injonction de payer OHADA, saisies conservatoires et saisies-attributions.'],
    'arbitration-adr'       => ['Arbitrage & médiation', 'Arbitrage CAC, GICAM, CCJA et CCI, médiation OHADA et exequatur des sentences.'],
    'employment-law'        => ['Droit du travail', 'Contrats de travail, visa des contrats des travailleurs étrangers, licenciements et contentieux social.'],
    'intellectual-property' => ['Propriété intellectuelle (OAPI)', 'Dépôt de marques, brevets et dessins auprès de l\'OAPI pour 17 États africains, lutte anti-contrefaçon.'],
    'oil-gas'               => ['Pétrole & gaz', 'Contrats pétroliers, autorisations, contenu local et contentieux énergétique.'],
    'mining-law'            => ['Droit minier', 'Permis de recherche et d\'exploitation, conventions minières et conformité environnementale.'],
    'maritime-shipping'     => ['Droit maritime', 'Saisie de navires, litiges sur marchandises, affrètement et assurance maritime au port de Douala.'],
];

$frFaqs = [
    ['Comment trouver un bon avocat au Cameroun ?', 'Choisissez un avocat inscrit au Barreau du Cameroun, expérimenté dans votre type de dossier, qui travaille dans la langue dont vous avez besoin et qui vous présente ses honoraires par écrit. BAME KANG & Co exerce à Douala depuis ' . FIRM['founded'] . ' en français et en anglais.'],
    ['Quel cabinet d\'avocats choisir à Douala ?', 'BAME KANG & Co est un cabinet d\'avocats établi à Douala depuis ' . FIRM['founded'] . ', situé à Dama G. Towers, Ancienne Route Bonabéri. Il intervient en droit des affaires, fiscalité, OHADA, immobilier, contentieux, recouvrement et arbitrage pour des clients locaux et internationaux.'],
    ['Je vis à l\'étranger : pouvez-vous m\'assister au Cameroun ?', 'Oui. Grâce à une procuration, nous agissons pour vous au Cameroun (création de société, achat de terrain, recouvrement, procédures) et vous tenons informé par e-mail, WhatsApp et visioconférence.'],
    ['Comment recouvrer une créance au Cameroun ?', 'Après une mise en demeure, la procédure d\'injonction de payer de l\'Acte uniforme OHADA permet d\'obtenir rapidement un titre exécutoire pour une créance certaine, liquide et exigible, puis de saisir les comptes bancaires ou les biens du débiteur.'],
    ['Comment vérifier un titre foncier au Cameroun ?', 'Votre avocat obtient auprès de la conservation foncière compétente un état officiel du titre, vérifie le propriétaire inscrit et les éventuelles hypothèques ou oppositions, puis fait contrôler le terrain par un géomètre avant tout paiement.'],
];

$page = [
    'lang'        => 'fr',
    'title'       => 'Avocat à Douala, Cameroun | Cabinet d\'avocats BAME KANG & Co – Droit des affaires, OHADA, Foncier',
    'og_title'    => 'BAME KANG & Co – Cabinet d\'avocats à Douala, Cameroun',
    'description' => 'Cabinet d\'avocats bilingue à Douala depuis ' . FIRM['founded'] . ' : création de société, OHADA, fiscalité, titres fonciers, recouvrement, contentieux. ' . FIRM['phone_display'] . '.',
    'path'        => 'fr',
    'nav'         => 'home',
    'alternates'  => ['fr' => 'fr', 'en' => '', 'x-default' => ''],
    'breadcrumbs' => [['Accueil', 'fr']],
    'eyebrow'     => 'Avocats · Conseils juridiques · Depuis ' . FIRM['founded'],
    'h1'          => 'Cabinet d\'avocats à Douala, Cameroun',
    'lead'        => 'BAME KANG & Co accompagne entreprises, investisseurs, particuliers et diaspora en droit camerounais, OHADA et CEMAC, en français et en anglais.',
    'schema'      => [faq_schema($frFaqs, 'fr')],
];
require dirname(__DIR__) . '/includes/header.php';
?>

<section class="section">
  <div class="container split">
    <div class="reveal" lang="fr">
      <p class="eyebrow">Notre cabinet</p>
      <h2>Un cabinet d'avocats bilingue et bijuridique</h2>
      <p class="lead">Fondé en <?= FIRM['founded'] ?> par Maître Everistus Bame Kang, BAME KANG &amp; Co est un cabinet dynamique et intégré, spécialisé en droit des affaires, droit fiscal et droit commercial.</p>
      <p>Le Cameroun applique à la fois la Common Law et le droit civil, ainsi que le droit uniforme OHADA. Nos associés exercent dans les deux systèmes et dans les deux langues officielles : un seul cabinet pour tout le Cameroun et pour vos dossiers transfrontaliers en Afrique centrale et de l'Ouest.</p>
      <ul class="check-list">
        <li><?= icon('check') ?><span>Membres du Barreau du Cameroun</span></li>
        <li><?= icon('check') ?><span>Arbitre certifié auprès du CAC et du Centre d'arbitrage du GICAM</span></li>
        <li><?= icon('check') ?><span>3 associés, 5 collaborateurs et 1 assistant juridique</span></li>
        <li><?= icon('check') ?><span>Clients en Europe, aux Amériques, en Asie et en Afrique</span></li>
      </ul>
      <div class="btn-row" style="margin-top:28px">
        <a class="btn btn-gold" href="<?= url('contact') ?>">Prendre rendez-vous <?= icon('arrow') ?></a>
        <a class="btn btn-outline" href="<?= e(whatsapp_link('Bonjour BAME KANG & Co, je souhaite prendre rendez-vous.')) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> WhatsApp</a>
      </div>
    </div>
    <div class="photo-stack reveal">
      <div class="photo-frame" style="aspect-ratio:4/4.6">
        <img src="<?= img('lawyer-douala-cameroon-hero') ?>" alt="Cabinet d'avocats BAME KANG &amp; Co à Douala, Cameroun" width="1100" height="1650" loading="lazy">
      </div>
      <div class="badge-card"><strong><?= years_in_practice() ?>+</strong><span>ans d'expérience au Cameroun</span></div>
    </div>
  </div>
</section>

<section class="section bg-ivory" lang="fr">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Domaines d'intervention</p>
      <h2>Nos domaines d'expertise</h2>
      <p>Cliquez sur un domaine pour lire le détail (page en anglais) ou contactez-nous directement en français.</p>
    </div>
    <div class="grid grid-3">
      <?php foreach ($frServices as $slug => [$t, $d]): ?>
        <article class="card reveal">
          <span class="icon-box"><?= icon(services()[$slug]['icon']) ?></span>
          <h3><a href="<?= url('services/' . $slug) ?>"><?= e($t) ?></a></h3>
          <p><?= e($d) ?></p>
          <span class="link-arrow">En savoir plus <?= icon('arrow') ?></span>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section" lang="fr">
  <div class="container split" style="align-items:start">
    <div class="reveal">
      <p class="eyebrow">Questions fréquentes</p>
      <h2>Vos questions, nos réponses</h2>
      <p class="lead">Adresse : <?= e(FIRM['street']) ?>, <?= e(FIRM['po_box']) ?>, Douala, Cameroun.</p>
      <p>Téléphone : <a href="<?= tel_link(FIRM['phone']) ?>"><?= e(FIRM['phone_display']) ?></a> / <a href="<?= tel_link(FIRM['phone2']) ?>"><?= e(FIRM['phone2_display']) ?></a><br>E-mail : <a href="mailto:<?= e(FIRM['email']) ?>"><?= e(FIRM['email']) ?></a><br>Horaires : du lundi au vendredi, 8h00 – 17h00</p>
    </div>
    <div class="faq-list reveal">
      <?php foreach ($frFaqs as $i => [$q, $a]): ?>
        <details class="faq-item"<?= $i === 0 ? ' open' : '' ?>>
          <summary><?= e($q) ?></summary>
          <div class="faq-answer"><p><?= e($a) ?></p></div>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="cta-band" lang="fr">
  <div class="container cta-band-inner">
    <div>
      <p class="eyebrow eyebrow-light">Parlez à un avocat</p>
      <h2>Exposez-nous votre situation, nous vous répondons rapidement.</h2>
      <p>En français ou en anglais · À Douala, par téléphone, WhatsApp ou visioconférence.</p>
    </div>
    <div class="cta-band-actions">
      <a class="btn btn-gold" href="<?= url('contact') ?>">Prendre rendez-vous <?= icon('arrow') ?></a>
      <a class="btn btn-outline-light" href="<?= tel_link(FIRM['phone']) ?>"><?= icon('phone') ?> <?= e(FIRM['phone_display']) ?></a>
    </div>
  </div>
</section>

<?php $page['hide_cta'] = true; require dirname(__DIR__) . '/includes/footer.php'; ?>
