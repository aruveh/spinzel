<?php
    declare(strict_types=1);

    if (empty($menu) || empty($menu['data']) || empty($menu['data']['items'])){
        return;
    }

    /* Convert API URL to Frontend URL */
    $toFrontendUrl = static function (string $url): string {
        $path = parse_url($url, PHP_URL_PATH);

        if (!$path) {
            return 'javascript:void(0);';
        }

        return rtrim($path, '/') ?: '/';
    };

    /* Recursive Menu item Renderer */
    $render = function (array $items) use (&$render, $toFrontendUrl): void {
        if (empty($items)) {
            return;
        }
        foreach ($items as $item): 
            $href = $toFrontendUrl($item['url']);
?>

            <?php if (!empty($item['children'])): ?>
                <div class="nav-dropdown">
                    <a href="<?= htmlspecialchars($href); ?>"><?= htmlspecialchars($item['title']); ?></a>
                    <div class="nav-dropdown-menu"><?php $render($item['children']); ?></div>
                </div>
            <?php else: ?>
                <a href="<?= htmlspecialchars($href); ?>"><?= htmlspecialchars($item['title']); ?></a>
            <?php endif; ?>
        <?php endforeach;
    } ?>
<nav class="main-nav">
    <?php $render($menu['data']['items']); ?>
</nav>