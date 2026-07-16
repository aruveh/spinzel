<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Blocks;

final class QueryLoop
{
    /**
     * Register block-related functionality.
     */
    public function register(): void
    {
        add_action('init', [$this, 'registerEditorScript']);

        (new DynamicCountry())->register();
        (new DynamicPrice())->register();
        (new DynamicAgeGroup())->register();
        (new DynamicMetaRow())->register();
        (new DynamicPublished())->register();
        (new DynamicReadingTime())->register();
        (new DynamicViews())->register();
        (new DynamicStartDate())->register();
        (new DynamicEndDate())->register();
        (new DynamicSurveyLink())->register();
        (new DynamicSurveyStatus())->register();
    }

    /**
     * Register the editor script.
     */
    public function registerEditorScript(): void
    {
        $asset = require A9_POST_ADAPTATION_PATH . 'build/index.asset.php';

        wp_register_script(
            'a9-post-adaptation-editor',
            plugins_url(
                'build/index.js',
                A9_POST_ADAPTATION_FILE
            ),
            $asset['dependencies'],
            $asset['version'],
            true
        );
    }
}