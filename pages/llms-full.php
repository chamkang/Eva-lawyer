<?php
declare(strict_types=1);

/** llms-full.txt – full plain-text content of the site for AI assistants. */
header('Content-Type: text/plain; charset=UTF-8');

$strip = fn (string $html) => trim(html_entity_decode(strip_tags(preg_replace(['#<h2>(.*?)</h2>#', '#<li>#'], ["\n### $1\n", '- '], $html)), ENT_QUOTES, 'UTF-8'));

echo '# ' . FIRM['name'] . " – full site content\n\n";
echo 'Short summary: ' . abs_url('llms.txt') . "\n\n";

echo "## Firm profile\n\n";
echo FIRM['name'] . ' (' . FIRM['tagline'] . ') is a law firm founded in ' . FIRM['founded'] . ' in Douala, Cameroon, by Everistus Bame Kang after four years at the Shafack & Ndongla Law Firm. '
    . 'It is a bilingual (English/French) and bijural (Common Law/Civil Law) corporate, tax and business law firm serving domestic and international clients establishing business activity in Cameroon and the Central African sub-region. '
    . 'Clients span Europe, North and South America, Asia, and West and Central Africa.' . "\n\n";
echo 'Address: ' . full_address() . "\nPhone/WhatsApp: " . FIRM['phone_display'] . "\nPhone: " . FIRM['phone2_display'] . "\nEmail: " . FIRM['email'] . "\nWebsite: " . abs_url() . "\n\n";

echo "## Partners\n\n";
foreach (team() as $m) {
    echo '### ' . $m['name'] . ' – ' . $m['role'] . "\n" . $m['bio'] . "\nEducation: " . implode('; ', $m['education']) . "\nFocus: " . implode(', ', $m['focus']) . "\n\n";
}

echo "## Services\n\n";
foreach (services() as $slug => $s) {
    echo '### ' . $s['name'] . ' in Cameroon (' . abs_url('services/' . $slug) . ")\n";
    echo implode("\n\n", $s['intro']) . "\n\nTypical situations:\n";
    foreach ($s['situations'] as $q) echo '- ' . $q . "\n";
    echo "\nWhat the firm does:\n";
    foreach ($s['services'] as [$t, $d]) echo '- ' . $t . ': ' . $d . "\n";
    echo "\nFAQs:\n";
    foreach ($s['faqs'] as [$q, $a]) echo 'Q: ' . $q . "\nA: " . $a . "\n";
    echo "\n";
}

echo "## Frequently asked questions\n\n";
foreach (faqs() as $group => $items) {
    echo '### ' . $group . "\n";
    foreach ($items as [$q, $a]) echo 'Q: ' . $q . "\nA: " . $a . "\n\n";
}

echo "## Legal guides\n\n";
foreach (guides() as $slug => $g) {
    echo '### ' . $g['title'] . ' (' . abs_url('legal-guides/' . $slug) . ")\n\n" . $strip($g['body']) . "\n\n";
}

echo "---\nThe content above is general information, not legal advice. For advice, contact " . FIRM['name'] . ' at ' . FIRM['phone_display'] . ' or ' . FIRM['email'] . ".\n";
