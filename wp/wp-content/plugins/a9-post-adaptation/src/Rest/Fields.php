<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Rest;

use A9\PostAdaptation\Data\Countries;
use A9\PostAdaptation\Meta\Registry;
use WP_Post;

final class Fields
{
    /**
     * Register REST API fields.
     */
    public function register(): void
    {
        add_action('rest_api_init', [$this, 'registerFields']);
    }

    /**
     * Register custom REST fields.
     */
    public function registerFields(): void
    {
        foreach (Registry::fields() as $field) {
            register_rest_field(
                'post',
                $field['meta_key'],
                [
                    'get_callback'    => [$this, 'getField'],
                    'update_callback' => [$this, 'updateField'],
                    'schema'          => [
                        'description' => $field['description'],
                        'type'        => $this->restType(
                            $field['meta_key'],
                            $field['type']
                        ),
                        'context'     => ['view', 'edit'],
                    ],
                ]
            );
        }
    }

    /**
     * Get the field value.
     */
    public function getField(array $post, string $fieldName): mixed
    {
        $value = get_post_meta(
            (int) $post['id'],
            $fieldName,
            true
        );

        if ($fieldName === 'a9_country') {
            if ($value === '') {
                return null;
            }

            return [
                'code'       => $value,
                'name'       => Countries::name($value),
                'short'      => Countries::short($value),
                'official'   => Countries::official($value),

                'flag' => [
                    'emoji' => Countries::emoji($value),
                    'svg'   => Countries::flagSvg($value),
                    'png'   => Countries::flagPng($value),
                ],

                'continent' => Countries::continent($value),
                'region'    => Countries::region($value),

                'currency'  => Countries::currency($value),
            ];
        }

        return $value;
    }

    /**
     * Update the field value.
     */
    public function updateField(
        mixed $value,
        \WP_Post $post,
        string $fieldName
    ): bool {
        return (bool) update_post_meta(
            $post->ID,
            $fieldName,
            $value
        );
    }

    /**
     * Convert field types to REST schema types.
     */
    private function restType(
        string $metaKey,
        string $type
    ): string {
        if ($metaKey === 'a9_country') {
            return 'object';
        }

        return match ($type) {
            'number' => 'number',
            default  => 'string',
        };
    }
}