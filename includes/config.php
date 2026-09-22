<?php
/**
 * Site-wide configuration for BAME KANG & Co.
 * Edit the values in this file only – every page, the structured data (schema.org),
 * the sitemap and llms.txt read from here, so the firm's details stay consistent
 * everywhere (consistency of Name / Address / Phone is a key local-SEO signal).
 */
declare(strict_types=1);

date_default_timezone_set('Africa/Douala');

// Production domain WITHOUT trailing slash, e.g. 'https://www.bamekanglaw.com'.
// Leave empty to auto-detect from the request (fine for local testing).
const SITE_URL_OVERRIDE = '';

// If the site lives in a sub-folder (e.g. example.com/lawfirm) set '/lawfirm'.
const BASE_PATH = '';

/*
 * ============================================================================
 *  PREVIEW MODE: hides the site from Google / Bing / AI crawlers
 * ============================================================================
 *  It switches ON AUTOMATICALLY when the site runs on a free or temporary
 *  preview address (localhost, Cloudflare tunnel, InfinityFree subdomains…),
 *  so a preview copy never gets indexed and competes with the real site.
 *  On the client's real domain it is OFF automatically, so there is
 *  NOTHING TO CHANGE when you move to real hosting.
 *
 *  REMINDER when going live on the real domain:
 *    1. Keep FORCE_PREVIEW = false.
 *    2. Make sure the real domain is NOT listed in PREVIEW_HOSTS below.
 *    3. Check https://REAL-DOMAIN/robots.txt shows "Allow: /" (not "Disallow: /").
 *  If you use a different free host for a preview, add its domain below.
 * ============================================================================
 */
const FORCE_PREVIEW = false;
const PREVIEW_HOSTS = [
    'localhost', '127.0.0.1',
    '*.trycloudflare.com', '*.ngrok-free.app', '*.ngrok.io',
    '*.infinityfreeapp.com', '*.free.nf', '*.rf.gd', '*.epizy.com', '*.wuaze.com', '*.ct.ws',
    '*.kesug.com', '*.lovestoblog.com', '*.42web.io', '*.great-site.net', '*.page.gd', '*.gt.tc',
];

const FIRM = [
    'name'          => 'BAME KANG & Co',
    'legal_name'    => 'BAME KANG & Co – Barristers, Solicitors & Legal Practitioners',
    'alt_names'     => ['Bame Kang and Co', 'Bame Kang & Co Law Firm', 'Cabinet Bame Kang & Co', 'Bame Kang Law Firm Douala'],
    'tagline'       => 'Barristers, Solicitors & Legal Practitioners',
    'founded'       => 2000,
    'founder'       => 'Everistus Bame Kang',
    'phone'         => '+237677674623',
    'phone_display' => '+237 677 67 46 23',
    'phone2'        => '+237243076482',
    'phone2_display'=> '+237 243 07 64 82',
    'whatsapp'      => '237677674623',          // digits only, used for wa.me links
    'email'         => 'bamekangevalaw@gmail.com',
    'street'        => 'Apt. A-1, 2nd Floor, Dama G. Towers, No. 1 Nangah Company Avenue, Ancienne Route Bonabéri',
    'po_box'        => 'P.O. Box 17782',
    'city'          => 'Douala',
    'region'        => 'Littoral',
    'country'       => 'Cameroon',
    'country_code'  => 'CM',
    'lat'           => 4.0747,
    'lng'           => 9.6760,
    // Please confirm opening hours with the firm (used by Google & AI assistants).
    'hours'         => [['Mo', 'Tu', 'We', 'Th', 'Fr'], '08:00', '17:00'],
    'hours_display' => 'Mon – Fri: 8:00 – 17:00',
    'languages'     => ['English', 'French'],
    'bar'           => 'Cameroon Bar Association',
    // Add full profile URLs when available – they strengthen the firm's "entity" for Google & AI search.
    'social'        => [
        'facebook'  => '',
        'linkedin'  => '',
        'x'         => '',
        'instagram' => '',
        'google'    => '',   // Google Business Profile share link
    ],
    'partners'      => 3,
    'associates'    => 5,
    'paralegals'    => 1,
];

// Where contact-form messages are sent.
const CONTACT_TO = 'bamekangevalaw@gmail.com';
// Sender used by the server's mailer – should be an address on the site's own domain in production.
const CONTACT_FROM = 'no-reply@localhost';
