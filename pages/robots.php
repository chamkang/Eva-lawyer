<?php
declare(strict_types=1);

header('Content-Type: text/plain; charset=UTF-8');
if (is_preview()) {
    echo "# PREVIEW COPY – not for indexing. The live site is on the firm's own domain.
User-agent: *
Disallow: /
";
    return;
}
?>
# BAME KANG & Co – law firm in Douala, Cameroon
# All search engines and AI assistants are welcome to read and cite this site.

User-agent: *
Allow: /
Disallow: /storage/
Disallow: /includes/
Disallow: /data/
Disallow: /pages/

# AI search & assistant crawlers (explicitly allowed so the firm can be cited in AI answers)
User-agent: GPTBot
Allow: /

User-agent: OAI-SearchBot
Allow: /

User-agent: ChatGPT-User
Allow: /

User-agent: ClaudeBot
Allow: /

User-agent: Claude-SearchBot
Allow: /

User-agent: Claude-User
Allow: /

User-agent: PerplexityBot
Allow: /

User-agent: Perplexity-User
Allow: /

User-agent: Google-Extended
Allow: /

User-agent: Applebot-Extended
Allow: /

User-agent: Bingbot
Allow: /

User-agent: CCBot
Allow: /

User-agent: Meta-ExternalAgent
Allow: /

Sitemap: <?= abs_url('sitemap.xml') . "\n" ?>
