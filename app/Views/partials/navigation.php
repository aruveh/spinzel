<?php
    declare(strict_types=1);

    if (empty($menu) || empty($menu['data']) || empty($menu['data']['items'])){
        return;
    }

    /* Convert API URL to Frontend URL */
    $toFrontendUrl = static function (string $url): string {
        return \App\Support\Url::frontend($url);
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

    <div class="header-actions">
        <?php if (isset($_SESSION['auth'])): ?>
            <a href="/profile/" class="btn-primary">User Profile</a>
            <form method="post" action="/logout/">
                <button type="submit" class="btn-ghost">Logout</button>
            </form>
        <?php else: ?>
            <a href="/login/" class="btn-ghost">Log In</a>
            <a href="/register/" class="btn-primary">Sign Up Free</a>
        <?php endif; ?>
    </div>
</nav>