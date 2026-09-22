<?php
/**
 * Page header. Expects $page = [
 *   'title', 'description', 'path', 'nav', 'image' (optional img name),
 *   'breadcrumbs' => [[name, path], ...], 'schema' => [...], 'lang', 'alternates', 'noindex'
 * ]
 */
declare(strict_types=1);

$page['lang'] ??= 'en';
$page['image_abs'] = abs_url('assets/img/' . ($page['og_image'] ?? 'og-image.jpg'));
$canonical = abs_url($page['path']);
$nav = [
    'home'          => ['Home', ''],
    'about'         => ['About', 'about'],
    'services'      => ['Services', 'services'],
    'team'          => ['Our Team', 'team'],
    'international' => ['International Clients', 'international-clients'],
    'faq'           => ['FAQs', 'faq'],
    'contact'       => ['Contact', 'contact'],
];
?><!DOCTYPE html>
<html lang="<?= e($page['lang']) ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>document.documentElement.classList.add('js')</script>
<title><?= e($page['title']) ?></title>
<meta name="description" content="<?= e($page['description']) ?>">
<link rel="canonical" href="<?= e($canonical) ?>">
<?php if (!empty($page['noindex'])): ?>
<meta name="robots" content="noindex, follow">
<?php else: ?>
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<?php endif; ?>
<?php foreach ($page['alternates'] ?? [] as $hl => $altPath): ?>
<link rel="alternate" hreflang="<?= e($hl) ?>" href="<?= e(abs_url($altPath)) ?>">
<?php endforeach; ?>
<meta name="author" content="<?= e(FIRM['name']) ?>">
<meta name="geo.region" content="CM-LT">
<meta name="geo.placename" content="Douala, Cameroon">
<meta name="geo.position" content="<?= FIRM['lat'] ?>;<?= FIRM['lng'] ?>">
<meta name="ICBM" content="<?= FIRM['lat'] ?>, <?= FIRM['lng'] ?>">
<meta name="theme-color" content="#0b1526">

<meta property="og:type" content="<?= e($page['og_type'] ?? 'website') ?>">
<meta property="og:site_name" content="<?= e(FIRM['name']) ?>">
<meta property="og:title" content="<?= e($page['og_title'] ?? $page['title']) ?>">
<meta property="og:description" content="<?= e($page['description']) ?>">
<meta property="og:url" content="<?= e($canonical) ?>">
<meta property="og:image" content="<?= e($page['image_abs']) ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="<?= e(FIRM['name']) ?> – law firm in Douala, Cameroon">
<meta property="og:locale" content="<?= $page['lang'] === 'fr' ? 'fr_FR' : 'en_US' ?>">
<meta property="og:locale:alternate" content="<?= $page['lang'] === 'fr' ? 'en_US' : 'fr_FR' ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= e($page['og_title'] ?? $page['title']) ?>">
<meta name="twitter:description" content="<?= e($page['description']) ?>">
<meta name="twitter:image" content="<?= e($page['image_abs']) ?>">

<link rel="icon" href="<?= url('favicon.svg') ?>" type="image/svg+xml">
<link rel="icon" href="<?= url('favicon.ico') ?>" sizes="32x32">
<link rel="apple-touch-icon" href="<?= url('assets/img/apple-touch-icon.png') ?>">
<link rel="manifest" href="<?= url('site.webmanifest') ?>">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap">
<link rel="stylesheet" href="<?= asset('css/style.css') ?>">
<?php if (!empty($page['preload'])): ?>
<link rel="preload" as="image" href="<?= e($page['preload']) ?>" fetchpriority="high">
<?php endif; ?>
<?= render_schema($page) ?>
</head>
<body class="page-<?= e($page['nav'] ?? 'default') ?>">
<a class="skip-link" href="#main">Skip to content</a>

<div class="topbar">
  <div class="container topbar-inner">
    <div class="topbar-contact">
      <a href="<?= tel_link(FIRM['phone']) ?>"><?= icon('phone', 'icon icon-sm') ?> <?= e(FIRM['phone_display']) ?></a>
      <a href="mailto:<?= e(FIRM['email']) ?>" class="hide-sm"><?= icon('mail', 'icon icon-sm') ?> <?= e(FIRM['email']) ?></a>
      <span class="hide-md"><?= icon('clock', 'icon icon-sm') ?> <?= e(FIRM['hours_display']) ?></span>
    </div>
    <div class="topbar-lang">
      <?php if ($page['lang'] === 'fr'): ?>
        <a href="<?= url() ?>" hreflang="en" lang="en">English</a><span aria-hidden="true">·</span><strong>Français</strong>
      <?php else: ?>
        <strong>English</strong><span aria-hidden="true">·</span><a href="<?= url('fr') ?>" hreflang="fr" lang="fr">Français</a>
      <?php endif; ?>
    </div>
  </div>
</div>

<header class="site-header" id="top">
  <div class="container header-inner">
    <a class="brand" href="<?= url() ?>" aria-label="<?= e(FIRM['name']) ?> – home">
      <span class="brand-mark" aria-hidden="true">BK</span>
      <span class="brand-text"><strong>BAME KANG <span>&amp;</span> Co</strong><small><?= e(FIRM['tagline']) ?></small></span>
    </a>
    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" aria-label="Open menu"><?= icon('menu', 'icon icon-menu') ?><?= icon('close', 'icon icon-close') ?></button>
    <nav class="site-nav" id="site-nav" aria-label="Main">
      <ul>
        <?php foreach ($nav as $key => [$label, $path]): ?>
          <li><a href="<?= url($path) ?>"<?= ($page['nav'] ?? '') === $key ? ' aria-current="page"' : '' ?>><?= e($label) ?></a></li>
        <?php endforeach; ?>
      </ul>
      <a class="btn btn-gold btn-sm nav-cta" href="<?= url('contact') ?>">Book a Consultation</a>
    </nav>
  </div>
</header>

<main id="main">
<?php if (!empty($page['breadcrumbs']) && empty($page['custom_hero'])): ?>
<section class="page-hero"<?= !empty($page['hero_image']) ? ' style="--hero-img:url(\'' . e(img($page['hero_image'])) . '\')"' : '' ?>>
  <div class="container">
    <nav class="breadcrumbs" aria-label="Breadcrumb">
      <ol>
        <?php foreach ($page['breadcrumbs'] as $i => [$name, $path]): ?>
          <?php if ($i === array_key_last($page['breadcrumbs'])): ?>
            <li aria-current="page"><?= e($name) ?></li>
          <?php else: ?>
            <li><a href="<?= url($path) ?>"><?= e($name) ?></a></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ol>
    </nav>
    <?php if (!empty($page['eyebrow'])): ?><p class="eyebrow eyebrow-light"><?= e($page['eyebrow']) ?></p><?php endif; ?>
    <h1><?= e($page['h1'] ?? $page['title']) ?></h1>
    <?php if (!empty($page['lead'])): ?><p class="page-hero-lead"><?= e($page['lead']) ?></p><?php endif; ?>
  </div>
</section>
<?php endif; ?>
