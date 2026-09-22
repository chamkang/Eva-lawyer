<?php
/**
 * Front controller: every request is routed here (via .htaccess on Apache/LiteSpeed,
 * or directly when running `php -S localhost:8000 index.php` locally).
 */
declare(strict_types=1);

$uriPath = rawurldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');

// Local development server: let it serve real static files (css, js, images…).
if (PHP_SAPI === 'cli-server') {
    $file = realpath(__DIR__ . $uriPath);
    if ($file && is_file($file) && str_starts_with($file, __DIR__)
        && !preg_match('#[\\\\/](includes|data|pages|storage|\.[^\\\\/]+)[\\\\/]#', $file)
        && !preg_match('#(\.php|\.md|[\\\\/]\.[^\\\\/]+)$#', $file)) {
        return false;
    }
}

require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/seo.php';

// Preview/free hosts must never be indexed (see PREVIEW MODE in includes/config.php).
if (is_preview()) {
    header('X-Robots-Tag: noindex, nofollow', true);
}

$path = trim(substr($uriPath, strlen(BASE_PATH)), '/');

// ---------------------------------------------------------------------------
// Permanent redirects from the old static .html site (keeps any existing rankings).
$legacy = [
    'index.html' => '', 'main.html' => '', 'about.html' => 'about', 'attorney.html' => 'team',
    'contact.html' => 'contact', 'practice-area.html' => 'services',
    'practice-corporate-law.html' => 'services/corporate-law',
    'practice-banking-finance.html' => 'services/banking-finance',
    'practice-tax-law.html' => 'services/tax-law',
    'practice-real-estate.html' => 'services/real-estate',
    'practice-oil-gas.html' => 'services/oil-gas',
    'practice-arbitration.html' => 'services/arbitration-adr',
    'practice-blockchain.html' => 'services/fintech-blockchain',
    'practice-maritime.html' => 'services/maritime-shipping',
    'practice-mining.html' => 'services/mining-law',
    'practice-intellectual-property.html' => 'services/intellectual-property',
    'practice-insurance.html' => 'services/insurance-law',
    'practice-employment.html' => 'services/employment-law',
    'practice-esg.html' => 'services/esg-sustainability',
    'practice-telecommunications.html' => 'services/telecommunications',
    'practice-environmental.html' => 'services/environmental-law',
    'practice-aviation.html' => 'services/aviation-law',
    'practice-international-trade.html' => 'services/international-trade',
    'practice-litigation.html' => 'services/litigation',
    'index.php' => '', 'home' => '', 'attorneys' => 'team', 'practice-areas' => 'services',
];
$lower = strtolower($path);
if (isset($legacy[$lower])) {
    header('Location: ' . url($legacy[$lower]), true, 301);
    exit;
}
// Trailing slashes / upper case → canonical form.
if ($path !== '' && (str_ends_with($uriPath, '/') || $path !== $lower)) {
    $qs = $_SERVER['QUERY_STRING'] ?? '';
    header('Location: ' . url($lower) . ($qs !== '' ? '?' . $qs : ''), true, 301);
    exit;
}

// ---------------------------------------------------------------------------
$routes = [
    ''                      => 'home',
    'about'                 => 'about',
    'services'              => 'services',
    'team'                  => 'team',
    'faq'                   => 'faq',
    'international-clients' => 'international',
    'areas-we-serve'        => 'areas',
    'legal-guides'          => 'guides',
    'contact'               => 'contact',
    'privacy-policy'        => 'privacy',
    'fr'                    => 'french',
    'sitemap.xml'           => 'sitemap',
    'robots.txt'            => 'robots',
    'llms.txt'              => 'llms',
    'llms-full.txt'         => 'llms-full',
];

$params = [];
if (isset($routes[$path])) {
    $view = $routes[$path];
} elseif (preg_match('#^services/([a-z0-9-]+)$#', $path, $m) && isset(services()[$m[1]])) {
    $view = 'service';
    $params['slug'] = $m[1];
} elseif (preg_match('#^legal-guides/([a-z0-9-]+)$#', $path, $m) && isset(guides()[$m[1]])) {
    $view = 'guide';
    $params['slug'] = $m[1];
} else {
    http_response_code(404);
    $view = '404';
}

require __DIR__ . '/pages/' . $view . '.php';
