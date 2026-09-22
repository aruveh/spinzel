<?php
    declare(strict_types=1);

    $pageTitle = (!empty($pageTitle) && trim((string) $pageTitle) !== '') ? $pageTitle : 'Spinzel';
    $pageDescription = (!empty($pageDescription) && trim((string) $pageDescription) !== '') ? trim(strip_tags((string) $pageDescription)) : '';
    $pageKeywords = (!empty($pageKeywords) && trim((string) $pageKeywords) !== '') ? $pageKeywords : '';
    $pageView = !empty($pageView) ? $pageView : '';

    $baseUrl = \App\Support\Url::base();
    if (empty($baseUrl)) {
        $baseUrl = 'https://www.spinzel.com';
    }

    if (!empty($pageCanonical)) {
        $canonicalUrl = $pageCanonical;
    } else {
        $requestUriPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        $cleanPath = rtrim((string) $requestUriPath, '/');
        $canonicalPath = ($cleanPath === '') ? '/' : $cleanPath . '/';
        $canonicalUrl = $baseUrl . $canonicalPath;
    }

    if (!empty($pageImage)) {
        $shareImage = (string) $pageImage;
    } elseif (!empty($post['featured_image'])) {
        $shareImage = is_array($post['featured_image'])
            ? ($post['featured_image']['sizes']['large']['url'] ?? $post['featured_image']['url'] ?? '')
            : (string) $post['featured_image'];
    } elseif (!empty($page['featured_image'])) {
        $shareImage = is_array($page['featured_image'])
            ? ($page['featured_image']['sizes']['large']['url'] ?? $page['featured_image']['url'] ?? '')
            : (string) $page['featured_image'];
    } else {
        $shareImage = $baseUrl . '/assets/images/spinzel-white-logo.png';
    }

    if (!empty($shareImage) && !str_starts_with($shareImage, 'http://') && !str_starts_with($shareImage, 'https://')) {
        $shareImage = $baseUrl . '/' . ltrim($shareImage, '/');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/assets/images/favicon.png">
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>">

    <title><?= htmlspecialchars($pageTitle) ?></title>
    <?php if (!empty($pageDescription)): ?>
    <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">
    <?php endif; ?>

    <!-- Static Open Graph & Twitter Tags -->
    <meta property="og:site_name" content="Spinzel">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Dynamic Open Graph Tags -->
    <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
    <?php if (!empty($pageDescription)): ?>
    <meta property="og:description" content="<?= htmlspecialchars($pageDescription) ?>">
    <?php endif; ?>
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($shareImage) ?>">

    <!-- Dynamic Twitter Tags -->
    <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle) ?>">
    <?php if (!empty($pageDescription)): ?>
    <meta name="twitter:description" content="<?= htmlspecialchars($pageDescription) ?>">
    <?php endif; ?>
    <meta name="twitter:image" content="<?= htmlspecialchars($shareImage) ?>">
    
    <link rel="stylesheet" href="/assets/css/styles.css">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe data-lazyloaded="1" src="about:blank" data-src="https://www.googletagmanager.com/ns.html?id=GTM-5FPV78BN"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-WF1606GQ95"></script>
    <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-WF1606GQ95'); </script>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-5FPV78BN');</script>
    <!-- End Google Tag Manager -->
    <!-- clarity ms tag -->
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "vxldfgpppp");
    </script>
    <!-- End clarity ms tag -->
</head>