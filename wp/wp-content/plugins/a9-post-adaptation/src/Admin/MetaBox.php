<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Admin;

use A9\PostAdaptation\Meta\Registry;
use WP_Post;

final class MetaBox
{
    public function register(): void
    {
        add_action('add_meta_boxes', [$this, 'registerMetaBox']);
    }

    public function registerMetaBox(): void
    {
        add_meta_box(
            'a9-post-adaptation',
            __('A9 Post Adaptation', 'a9-post-adaptation'),
            [$this, 'render'],
            'post',
            'normal',
            'default'
        );
    }

    public function render(WP_Post $post): void
    {
        wp_nonce_field(
            'a9_post_adaptation_save',
            'a9_post_adaptation_nonce'
        );

        $fields = Registry::fields();

        echo '<table class="form-table">';

        foreach ($fields as $field) {

            $value = get_post_meta(
                $post->ID,
                $field['meta_key'],
                true
            );

            echo '<tr>';
            echo '<th>';
            echo '<label for="' . esc_attr($field['meta_key']) . '">';
            echo esc_html($field['label']);
            echo '</label>';
            echo '</th>';

            echo '<td>';

            switch ($field['type']) {

                case 'number':

                    printf(
                        '<input type="number" class="regular-text" id="%1$s" name="%1$s" value="%2$s">',
                        esc_attr($field['meta_key']),
                        esc_attr((string) $value)
                    );
                    break;

                case 'text':
                    printf(
                        '<input type="text" class="regular-text" id="%1$s" name="%1$s" value="%2$s">',
                        esc_attr($field['meta_key']),
                        esc_attr((string) $value)
                    );
                    break;

                case 'url':
                    printf(
                        '<input type="url" class="regular-text" id="%1$s" name="%1$s" value="%2$s">',
                        esc_attr($field['meta_key']),
                        esc_attr((string) $value)
                    );
                    break;

                case 'datetime-local':
                    printf(
                        '<input type="datetime-local" class="regular-text" id="%1$s" name="%1$s" value="%2$s">',
                        esc_attr($field['meta_key']),
                        esc_attr((string) $value)
                    );
                    break;

                case 'select':

                    echo '<select id="' . esc_attr($field['meta_key']) . '" name="' . esc_attr($field['meta_key']) . '">';

                    foreach ($field['options'] as $key => $label) {
                        printf(
                            '<option value="%1$s" %2$s>%3$s</option>',
                            esc_attr((string) $key),
                            selected($value, $key, false),
                            esc_html((string) $label)
                        );
                    }

                    echo '</select>';

                    break;
            }

            if (! empty($field['description'])) {
                echo '<p class="description">';
                echo esc_html($field['description']);
                echo '</p>';
            }

            echo '</td>';
            echo '</tr>';
        }

        echo '</table>';
    }
}
