<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Core;
use A9\PostAdaptation\Admin\Menu;
use A9\PostAdaptation\Admin\MetaBox;
use A9\PostAdaptation\Admin\SaveMeta;
use A9\PostAdaptation\Meta\Registry;
use A9\PostAdaptation\Shortcodes\Meta;
use A9\PostAdaptation\Shortcodes\Price;
use A9\PostAdaptation\Shortcodes\Country;
use A9\PostAdaptation\Shortcodes\AgeGroup;
use A9\PostAdaptation\Blocks\QueryLoop;
use A9\PostAdaptation\Rest\Fields;

final class Loader
{
    public function register(): void
    {
        add_action('plugins_loaded', [$this, 'loadTextDomain']);
        add_action('init', [Registry::class, 'register']);

        (new Menu())->register();
        (new MetaBox())->register();
        (new SaveMeta())->register();

        (new Meta())->register();
        (new Price())->register();
        (new Country())->register();
        (new AgeGroup())->register();

        (new QueryLoop())->register();
        (new Fields())->register();
    }

    public function loadTextDomain(): void
    {
        load_plugin_textdomain(
            'a9-post-adaptation',
            false,
            dirname(plugin_basename(A9_POST_ADAPTATION_FILE)) . '/languages'
        );
    }
}   