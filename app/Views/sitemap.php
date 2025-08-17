<?php
header('Content-Type: application/xml; charset=utf-8');

// Bersihkan semua output buffer
while (ob_get_level()) {
    ob_end_clean();
}

// Escape XML function
function xmlEscape($string)
{
    return htmlspecialchars($string, ENT_XML1, 'UTF-8');
}

// Build XML sebagai string
$xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

// Static URLs
if (isset($static_urls) && is_array($static_urls)) {
    foreach ($static_urls as $url) {
        if (isset($url['loc'])) {
            $xml .= '    <url>' . "\n";
            $xml .= '        <loc>' . xmlEscape($url['loc']) . '</loc>' . "\n";
            $xml .= '        <lastmod>' . date('c') . '</lastmod>' . "\n";
            $xml .= '        <changefreq>' . (isset($url['changefreq']) ? xmlEscape($url['changefreq']) : 'monthly') . '</changefreq>' . "\n";
            $xml .= '        <priority>' . (isset($url['priority']) ? $url['priority'] : '1.0') . '</priority>' . "\n";
            $xml .= '    </url>' . "\n";
        }
    }
}

// Layanan URLs
if (isset($layanan_urls) && is_array($layanan_urls)) {
    foreach ($layanan_urls as $url) {
        if (isset($url['id'])) {
            $xml .= '    <url>' . "\n";
            $xml .= '        <loc>' . xmlEscape(base_url('layanan/' . $url['id'])) . '</loc>' . "\n";
            if (isset($url['updated_at'])) {
                $xml .= '        <lastmod>' . date('c', strtotime($url['updated_at'])) . '</lastmod>' . "\n";
            }
            $xml .= '        <changefreq>weekly</changefreq>' . "\n";
            $xml .= '        <priority>0.8</priority>' . "\n";
            $xml .= '    </url>' . "\n";
        }
    }
}

// Artikel URLs
if (isset($artikel_urls) && is_array($artikel_urls)) {
    foreach ($artikel_urls as $url) {
        if (isset($url['slug'])) {
            $xml .= '    <url>' . "\n";
            $xml .= '        <loc>' . xmlEscape(base_url('artikel/' . $url['slug'])) . '</loc>' . "\n";
            if (isset($url['created_at'])) {
                $xml .= '        <lastmod>' . date('c', strtotime($url['created_at'])) . '</lastmod>' . "\n";
            }
            $xml .= '        <changefreq>monthly</changefreq>' . "\n";
            $xml .= '        <priority>0.6</priority>' . "\n";
            $xml .= '    </url>' . "\n";
        }
    }
}

$xml .= '</urlset>';

// Output XML langsung
echo $xml;
