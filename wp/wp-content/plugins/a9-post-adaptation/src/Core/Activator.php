<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Core;

final class Activator
{
    public static function activate(): void
    {
        if (get_option('a9_post_adaptation_version') === false) {
            add_option(
                'a9_post_adaptation_version',
                A9_POST_ADAPTATION_VERSION
            );
        } else {
            update_option(
                'a9_post_adaptation_version',
                A9_POST_ADAPTATION_VERSION
            );
        }

        flush_rewrite_rules();
    }
}