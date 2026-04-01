<?php

if (! function_exists('sanitize_html')) {
    /**
     * Sanitizes HTML content using HTMLPurifier to prevent XSS.
     *
     * @param string $html
     * @return string
     */
    function sanitize_html(string $html): string
    {
        $config = HTMLPurifier_Config::createDefault();

        // Allow common rich text tags
        $config->set('HTML.Allowed', 'p,b,i,u,h1,h2,h3,h4,h5,h6,ul,ol,li,a[href|title|target],blockquote,img[src|alt|width|height|style],span[style],strong,em,br,hr,table,thead,tbody,tr,th,td');

        // Ensure URLs are safe
        $config->set('URI.AllowedSchemes', ['http' => true, 'https' => true, 'mailto' => true, 'data' => true]);

        // Security enhancements
        $config->set('Attr.AllowedFrameTargets', ['_blank', '_self', '_parent', '_top']);
        $config->set('HTML.TargetBlank', true);
        $config->set('HTML.Nofollow', true);

        // Support for base64 images (common in some rich text editors)
        $config->set('URI.AllowedSchemes', ['http' => true, 'https' => true, 'mailto' => true, 'data' => true]);

        $purifier = new HTMLPurifier($config);
        return $purifier->purify($html);
    }
}
