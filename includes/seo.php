<?php
declare(strict_types=1);

/**
 * schema.org structured data. Every page outputs one JSON-LD @graph containing
 * the firm (LegalService + LocalBusiness), the website, and page-specific nodes.
 */

function firm_id(): string    { return abs_url() . '#firm'; }
function website_id(): string { return abs_url() . '#website'; }
function person_id(string $slug): string { return abs_url('team') . '#' . $slug; }

function firm_schema(): array
{
    $sameAs = array_values(array_filter(FIRM['social']));
    $areas = [
        ['@type' => 'City', 'name' => 'Douala'],
        ['@type' => 'City', 'name' => 'Yaoundé'],
        ['@type' => 'City', 'name' => 'Buea'],
        ['@type' => 'City', 'name' => 'Limbe'],
        ['@type' => 'City', 'name' => 'Bamenda'],
        ['@type' => 'City', 'name' => 'Kribi'],
        ['@type' => 'Country', 'name' => 'Cameroon'],
        ['@type' => 'Country', 'name' => 'Gabon'],
        ['@type' => 'Country', 'name' => 'Republic of the Congo'],
        ['@type' => 'Country', 'name' => 'Chad'],
        ['@type' => 'Country', 'name' => 'Central African Republic'],
        ['@type' => 'Country', 'name' => 'Equatorial Guinea'],
        ['@type' => 'Place', 'name' => 'CEMAC region'],
        ['@type' => 'Place', 'name' => 'OHADA member states'],
        ['@type' => 'Continent', 'name' => 'Africa'],
    ];
    $offers = [];
    foreach (services() as $slug => $s) {
        $offers[] = [
            '@type' => 'Offer',
            'itemOffered' => [
                '@type' => 'Service',
                'name' => $s['name'] . ' in Cameroon',
                'url' => abs_url('services/' . $slug),
            ],
        ];
    }
    $employees = [];
    foreach (team() as $slug => $m) {
        $employees[] = ['@id' => person_id($slug)];
    }

    $node = [
        '@type' => ['LegalService', 'LocalBusiness'],
        '@id' => firm_id(),
        'name' => FIRM['name'],
        'legalName' => FIRM['legal_name'],
        'alternateName' => FIRM['alt_names'],
        'description' => 'BAME KANG & Co is a bilingual (English & French) law firm in Douala, Cameroon, founded in ' . FIRM['founded'] . '. It advises local and international clients on corporate and commercial law, OHADA and CEMAC regulation, tax, banking and finance, real estate, litigation, debt recovery, arbitration, oil and gas, mining, intellectual property (OAPI), employment, maritime and international trade.',
        'slogan' => 'Vigorous & integrated corporate, tax and business law firm',
        'url' => abs_url(),
        'logo' => abs_url('assets/img/logo-512.png'),
        'image' => [abs_url('assets/img/og-image.jpg'), abs_url('assets/img/lawyer-douala-cameroon-hero.webp')],
        'telephone' => FIRM['phone'],
        'email' => FIRM['email'],
        'foundingDate' => (string) FIRM['founded'],
        'founder' => ['@id' => person_id('everistus-bame-kang')],
        'employee' => $employees,
        'numberOfEmployees' => ['@type' => 'QuantitativeValue', 'value' => FIRM['partners'] + FIRM['associates'] + FIRM['paralegals']],
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => FIRM['street'],
            'postOfficeBoxNumber' => FIRM['po_box'],
            'addressLocality' => FIRM['city'],
            'addressRegion' => FIRM['region'],
            'addressCountry' => FIRM['country_code'],
        ],
        'geo' => ['@type' => 'GeoCoordinates', 'latitude' => FIRM['lat'], 'longitude' => FIRM['lng']],
        'hasMap' => 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode('Dama G. Towers Bonaberi Douala'),
        'openingHoursSpecification' => [[
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => array_map(fn ($d) => ['Mo' => 'Monday', 'Tu' => 'Tuesday', 'We' => 'Wednesday', 'Th' => 'Thursday', 'Fr' => 'Friday', 'Sa' => 'Saturday', 'Su' => 'Sunday'][$d], FIRM['hours'][0]),
            'opens' => FIRM['hours'][1],
            'closes' => FIRM['hours'][2],
        ]],
        'contactPoint' => [
            ['@type' => 'ContactPoint', 'telephone' => FIRM['phone'], 'contactType' => 'customer service', 'availableLanguage' => ['English', 'French'], 'areaServed' => ['CM', 'Worldwide']],
            ['@type' => 'ContactPoint', 'telephone' => FIRM['phone2'], 'contactType' => 'reservations', 'availableLanguage' => ['English', 'French']],
        ],
        'areaServed' => $areas,
        'knowsLanguage' => ['en', 'fr'],
        'knowsAbout' => array_merge(
            array_map(fn ($s) => $s['name'], array_values(services())),
            ['OHADA law', 'CEMAC regulation', 'Cameroon law', 'Common Law', 'Civil Law', 'Company registration in Cameroon', 'Foreign direct investment in Cameroon', 'OAPI trademarks', 'Land titles in Cameroon']
        ),
        'memberOf' => [
            ['@type' => 'Organization', 'name' => FIRM['bar']],
        ],
        'priceRange' => 'Fees agreed in writing',
        'currenciesAccepted' => 'XAF',
        'paymentAccepted' => 'Bank transfer',
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name' => 'Legal services in Cameroon',
            'itemListElement' => $offers,
        ],
    ];
    if ($sameAs) {
        $node['sameAs'] = $sameAs;
    }
    return $node;
}

function website_schema(): array
{
    return [
        '@type' => 'WebSite',
        '@id' => website_id(),
        'url' => abs_url(),
        'name' => FIRM['name'],
        'alternateName' => 'Bame Kang & Co – Lawyers in Douala, Cameroon',
        'publisher' => ['@id' => firm_id()],
        'inLanguage' => ['en', 'fr'],
    ];
}

function person_schema(string $slug, array $m): array
{
    return [
        '@type' => 'Person',
        '@id' => person_id($slug),
        'name' => $m['name'],
        'jobTitle' => $m['role'],
        'worksFor' => ['@id' => firm_id()],
        'description' => $m['bio'],
        'knowsLanguage' => $m['languages'],
        'knowsAbout' => $m['focus'],
        'alumniOf' => array_map(fn ($ed) => ['@type' => 'CollegeOrUniversity', 'name' => trim(explode('–', $ed)[1] ?? $ed)], $m['education']),
        'memberOf' => ['@type' => 'Organization', 'name' => FIRM['bar']],
        'url' => abs_url('team') . '#' . $slug,
    ];
}

function breadcrumb_schema(array $crumbs): array
{
    $items = [];
    foreach (array_values($crumbs) as $i => [$name, $path]) {
        $items[] = ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $name, 'item' => abs_url($path)];
    }
    return ['@type' => 'BreadcrumbList', 'itemListElement' => $items];
}

function faq_schema(array $qa, string $path): array
{
    return [
        '@type' => 'FAQPage',
        '@id' => abs_url($path) . '#faq',
        'mainEntity' => array_map(fn ($f) => [
            '@type' => 'Question',
            'name' => $f[0],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]],
        ], $qa),
    ];
}

function webpage_schema(array $page): array
{
    return [
        '@type' => $page['page_type'] ?? 'WebPage',
        '@id' => abs_url($page['path']) . '#webpage',
        'url' => abs_url($page['path']),
        'name' => $page['title'],
        'description' => $page['description'],
        'isPartOf' => ['@id' => website_id()],
        'about' => ['@id' => firm_id()],
        'inLanguage' => $page['lang'] ?? 'en',
        'primaryImageOfPage' => ['@type' => 'ImageObject', 'url' => $page['image_abs']],
        'dateModified' => date('Y-m-d', filemtime(dirname(__DIR__) . '/data/services.php')),
    ];
}

function render_schema(array $page): string
{
    if (!empty($page['noindex'])) {
        return '';
    }
    $graph = [firm_schema(), website_schema(), webpage_schema($page)];
    foreach (team() as $slug => $m) {
        $graph[] = person_schema($slug, $m);
    }
    if (!empty($page['breadcrumbs'])) {
        $graph[] = breadcrumb_schema($page['breadcrumbs']);
    }
    foreach ($page['schema'] ?? [] as $node) {
        $graph[] = $node;
    }
    $json = json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG);
    return '<script type="application/ld+json">' . $json . '</script>';
}
