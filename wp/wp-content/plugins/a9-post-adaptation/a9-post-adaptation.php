<?php

declare(strict_types=1);

/**
 * Plugin Name: A9 Post Adaptation
 * Plugin URI: https://a9.com
 * Description: Adds custom adaptation fields such as Price, Country/Region, and Age Group to WordPress posts with Gutenberg, REST API, Query Loop, and shortcode support.
 * Version: 1.0.0
 * Author: A9
 * Author URI: https://a9.com
 * Text Domain: a9-post-adaptation
 * Domain Path: /languages
 * Requires at least: 6.6
 * Requires PHP: 8.1
 */

if (! defined('ABSPATH')) {
    exit;
}

define('A9_POST_ADAPTATION_VERSION', '1.0.0');
define('A9_POST_ADAPTATION_FILE', __FILE__);
define('A9_POST_ADAPTATION_PATH', plugin_dir_path(__FILE__));
define('A9_POST_ADAPTATION_URL', plugin_dir_url(__FILE__));

require_once A9_POST_ADAPTATION_PATH . 'vendor/autoload.php';

A9\PostAdaptation\Core\Plugin::boot();