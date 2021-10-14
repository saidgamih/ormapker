<?php

/**
 * Plugin Name: Ormapker
 * Plugin URI: https://github.com/saidgamih/ormapker
 * Description: Ormapker is a wordpress plugin to embbed a multilocations map easily.
 * Version: 1.0
 * Author: Said Gamih
 * Author: URI: https://saidgamih.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Settings Page: Orampker
require plugin_dir_path(__FILE__) . '/Ormapker_Setting_Page.php';
new Ormapker_Settings_Page();

// create a custom post [marker]
require plugin_dir_path(__FILE__) . '/Ormapker_Create_Marker.php';
new Ormapker_Create_Marker();

// meta boxes
require plugin_dir_path(__FILE__) . '/OrmapkerMetaBox.php';
if (class_exists('OrmapkerMetabox')) {
	new OrmapkerMetabox;
};

// Create a short code
 function ormapker_show_map_func($atts)
 {
    ob_start();
    require 'templates/scaffolding.inc.php';
    $content = ob_get_clean();
    return $content;
 }

 add_shortcode('ormapker_short_code', 'ormapker_show_map_func');
//  short code => [ormapker_short_code]
