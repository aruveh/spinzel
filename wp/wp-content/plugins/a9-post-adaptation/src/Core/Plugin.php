<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Core;

final class Plugin
{
    public static function boot(): void
    {
        register_activation_hook(
            A9_POST_ADAPTATION_FILE,
            [Activator::class, 'activate']
        );

        register_deactivation_hook(
            A9_POST_ADAPTATION_FILE,
            [Deactivator::class, 'deactivate']
        );

        (new Loader())->register();
    }
}