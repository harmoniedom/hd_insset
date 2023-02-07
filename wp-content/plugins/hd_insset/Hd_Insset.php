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

define('Hd_Insset_VERSION', '1.0.2');
define('Hd_Insset_FILE',__FILE__);
define('Hd_Insset_DIR', dirname(Hd_Insset_FILE));
define('Hd_Insset_BASENAME', pathinfo((Hd_Insset_FILE))['filename']);
define('Hd_Insset_PLUGIN_NAME', Hd_Insset_BASENAME);


foreach (glob(Hd_Insset_DIR .'/classes/*/*.php') as $filename)
    if (!preg_match('/export|cron/i', $filename))
        if (!@require_once $filename)
            throw new Exception(sprintf(__('Failed to include %s'), $filename));

if (is_admin())
    new Hd_Insset_Admin();
else
    new Hd_Insset_Front();


