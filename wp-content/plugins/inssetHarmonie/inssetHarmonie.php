<?php

/**
 * @package inssetHarmonie
 * @version 1.0.0
 */

/*
Plugin Name: inssetHarmonie
Author: Harmonie
Version: 1.0.0
*/

remove_action('wp_head', 'wp_generator');

if (!defined('ABSPATH'))
    exit;

define('inssetHarmonie_VERSION', '1.0.2');
define('inssetHarmonie_FILE',__FILE__);
define('inssetHarmonie_DIR', dirname(inssetHarmonie_FILE));
define('inssetHarmonie_BASENAME', pathinfo((inssetHarmonie_FILE))['filename']);
define('inssetHarmonie_PLUGIN_NAME', inssetHarmonie_BASENAME);
if (!defined('INSSET_URL'))
define('INSSET_URL','page-test');

foreach (glob(inssetHarmonie_DIR .'/classes/*/*.php') as $filename)
    if (!preg_match('/export|cron/i', $filename))
        if (!@require_once $filename)
            throw new Exception(sprintf(__('Failed to include %s'), $filename));

register_activation_hook(inssetHarmonie_FILE, function() {
    $inssetHarmonie_Install = new inssetHarmonie_Install();
    $inssetHarmonie_Install->setup();
});

if (is_admin())
    new inssetHarmonie_Admin();
else
    new inssetHarmonie_Front();


