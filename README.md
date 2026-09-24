# BAME KANG & Co – website

PHP 8.1+ site, no database or framework. Every URL is served by `index.php` (the router).

## Run locally
```
php -S localhost:8000 index.php
```
Then open http://localhost:8000

## Structure
| Path | Purpose |
|---|---|
| `includes/config.php` | **Firm details (name, phones, address, hours, social links) – edit here only** |
| `data/services.php` | The 19 practice areas; each one becomes its own page at `/services/{slug}` |
| `data/team.php`, `data/faqs.php`, `data/guides.php` | Partners, FAQs, legal guides |
| `pages/` | Page templates |
| `assets/` | CSS, JS, optimised WebP images |
| `storage/` | Private: form backups and signing key (blocked from the web) |

## Before going live (required)
1. Upload everything to the hosting root (Apache or LiteSpeed/cPanel with `mod_rewrite`).
2. In `includes/config.php` set `SITE_URL_OVERRIDE` to the real domain, e.g. `https://www.bamekanglaw.com`,
   and `CONTACT_FROM` to an address on that domain (e.g. `no-reply@bamekanglaw.com`) so form emails are not flagged as spam.
3. Install an SSL certificate (free Let's Encrypt in cPanel). HTTP → HTTPS redirect is already in `.htaccess`.
4. Confirm the **opening hours** (`hours` in config.php) and that **+237 677 67 46 23 is on WhatsApp**.
5. Send a test message from the contact form and confirm it arrives.

## SEO: done in the code
- Unique title, meta description, canonical, Open Graph/Twitter card on every page
- schema.org JSON-LD: LegalService + LocalBusiness, Person (partners), Service, FAQPage, Article, BreadcrumbList, ItemList
- `/sitemap.xml` (with hreflang and images), `/robots.txt` (AI crawlers explicitly allowed), `/llms.txt` and `/llms-full.txt` for AI assistants
- English + French (`/fr`) with hreflang; question-based FAQ and guide content answering real search queries
- 301 redirects from every old `.html` URL
- Fast: ~2.6 MB whole site (was 57 MB), WebP images, no jQuery/Bootstrap, lazy loading, gzip and 1-year caching

## Google Analytics & Search Console
Open `includes/config.php` and paste the codes:
* `GA_MEASUREMENT_ID` – from Google Analytics (looks like `G-ABC123XYZ`). Empty = no tracking scripts at all.
* `GOOGLE_SITE_VERIFICATION` / `BING_SITE_VERIFICATION` – the `content="..."` value of the HTML tag each tool gives you.

Once the GA ID is set, the site also reports these lead events automatically:
`contact_call`, `contact_whatsapp`, `contact_email` and `generate_lead` (contact form sent).
In GA4 they appear under **Reports → Engagement → Events**.

## Publishing a new guide / blog article
Guides live at `/legal-guides`. To add one, open `data/guides.php` and copy an existing block:

```php
'slug-of-the-article' => [          // becomes /legal-guides/slug-of-the-article
    'title'    => 'Full headline shown on the page',
    'short'    => 'Short title for cards and menus',
    'seo_title'=> 'Title for Google (use {year} for the current year)',
    'meta'     => 'One sentence, 150 characters, shown in Google results.',
    'excerpt'  => 'One line shown on the guides page card.',
    'icon'     => 'briefcase',       // any icon name used elsewhere in the site
    'minutes'  => 5,
    'updated'  => '2026-09-24',
    'services' => ['corporate-law'], // related service pages
    'body'     => <<<HTML
<p>Opening paragraph …</p>
<h2>A sub-heading</h2>
<ul><li>Points …</li></ul>
HTML,
    'faqs' => [
        ['A question people actually type into Google?', 'A direct answer in 2–3 sentences.'],
    ],
],
```
Nothing else to do: the sitemap, the guides page, the related-services links, the FAQ structured data
and `llms.txt` all pick it up automatically.

## SEO: steps only the firm can do (highest impact)
1. **Google Business Profile** (business.google.com): claim or create "BAME KANG & Co", category *Law firm*, exact same
   name/address/phone as the website, hours, photos of the office, and link the website. This is the #1 factor for
   "lawyer near me" / "lawyer in Douala" and for Google Maps and Google AI answers.
2. **Ask happy clients for Google reviews** (genuine only). Reply to each review.
3. **Google Search Console**: verify the domain and submit `https://DOMAIN/sitemap.xml`.
4. **Bing Webmaster Tools**: import from Search Console and submit the sitemap. Bing powers ChatGPT search and Copilot.
5. Create **LinkedIn company page and Facebook page**, then add their URLs to `social` in `config.php` (feeds `sameAs` in schema).
6. List the firm, with identical name/address/phone, in directories: Cameroon Bar Association directory, Pages Jaunes / Annuaire Cameroun,
   Legal500/Chambers submissions (Africa), Martindale, Justia/Lawyers.com, Bing Places, Apple Business Connect.
7. Publish a new legal guide every month in `data/guides.php` (e.g. succession of land, work permits updates, Finance Law changes).
