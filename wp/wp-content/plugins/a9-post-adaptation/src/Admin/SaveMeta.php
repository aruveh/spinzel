<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Admin;

use A9\PostAdaptation\Meta\Registry;

final class SaveMeta
{
    public function register(): void
    {
        add_action('save_post', [$this, 'save']);
    }

    public function save(int $postId): void
    {
        if (
            ! isset($_POST['a9_post_adaptation_nonce']) ||
            ! wp_verify_nonce(
                sanitize_text_field(wp_unslash($_POST['a9_post_adaptation_nonce'])),
                'a9_post_adaptation_save'
            )
        ) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (! current_user_can('edit_post', $postId)) {
            return;
        }

        foreach (Registry::fields() as $field) {

            if (! isset($_POST[$field['meta_key']])) {
                continue;
            }

            $value = \A9\PostAdaptation\Helpers\Sanitizer::sanitize(
                wp_unslash($_POST[$field['meta_key']]),
                $field['type']
            );
            switch ($field['type']) {

                case 'number':
                    $value = (float) $value;
                    break;

                case 'text':
                    $value = sanitize_text_field($value);
                    break;

                case 'select':
                case 'url':
                case 'datetime-local':
                    $value = sanitize_text_field((string) $value);
                    break;
            }

            update_post_meta(
                $postId,
                $field['meta_key'],
                $value
            );
        }
    }
}