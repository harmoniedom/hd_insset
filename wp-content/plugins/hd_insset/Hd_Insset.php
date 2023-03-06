<?php

/**
 * @package Hd_Insset
 * @version 1.0.0
 */

/*
Plugin Name: Hd_Insset
Author: Harmonie
Version: 1.0.0
*/

remove_action('wp_head', 'wp_generator');

if (!defined('ABSPATH'))
    exit;

define('Hd_Insset_VERSION', '1.3.16');
define('Hd_Insset_FILE',__FILE__);
define('Hd_Insset_DIR', dirname(Hd_Insset_FILE));
define('Hd_Insset_BASENAME', pathinfo((Hd_Insset_FILE))['filename']);
define('Hd_Insset_PLUGIN_NAME', Hd_Insset_BASENAME);
define('Hd_Insset_Url_1', '/choix-voyage');
define('Hd_Insset_Url_2', '/hd_insset');
define('Hd_Insset_Url_3', '/final');


foreach (glob(Hd_Insset_DIR .'/classes/*/*.php') as $filename)
    if (!preg_match('/export|cron/i', $filename))
        if (!@require_once $filename)
            throw new Exception(sprintf(__('Failed to include %s'), $filename));


register_activation_hook(Hd_Insset_FILE, function() {
    $Hd_Insset_Install = new Hd_Insset_Install();
    $Hd_Insset_Install->setup();
});

if (is_admin())
    new Hd_Insset_Admin();
else
    new Hd_Insset_Front();


