<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Navigation
|--------------------------------------------------------------------------
|
| Expected:
|
| $menu
|
*/

if (
    empty($menu) ||
    empty($menu['data']) ||
    empty($menu['data']['items'])
) {
    return;
}

/**
 * Convert API URL to Frontend URL
 */
$toFrontendUrl = static function (string $url): string {

    $path = parse_url($url, PHP_URL_PATH);

    if (!$path) {
        return '#';
    }

    return rtrim($path, '/') ?: '/';
};

/**
 * Recursive Menu Renderer
 */
$render = function (array $items) use (&$render, $toFrontendUrl): void {

    if (empty($items)) {
        return;
    }

    echo '<ul>';

    foreach ($items as $item) {

        $href = $toFrontendUrl($item['url']);

        echo '<li>';

        echo '<a href="';
        echo htmlspecialchars($href);
        echo '">';

        echo htmlspecialchars($item['title']);

        echo '</a>';

        if (!empty($item['children'])) {

            $render($item['children']);

        }

        echo '</li>';
    }

    echo '</ul>';
};

?>

<nav class="main-navigation">

    <?php

    $render($menu['data']['items']);

    ?>

</nav>