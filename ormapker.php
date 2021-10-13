<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Plugin Name: Ormapker
 * Plugin URI: http://www.mywebsite.com/my-first-plugin
 * Description: The very first plugin that I have ever created.
 * Version: 1.0
 * Author: Lorem
 */

// Settings Page: Orampker
require plugin_dir_path(__FILE__) . '/Orampker_Setting_Page.php';
new Orampker_Settings_Page();

// create a custom post [marker]
require plugin_dir_path(__FILE__) . '/Orampker_Create_Marker.php';
new Orampker_Create_Marker();

// Create a short code
 function ormapker_show_map_func($atts)
 {
     if(get_option('orampker_active')) {
        ob_start();
        require 'templates/scaffolding.inc.php';
        $content = ob_get_clean();
        return $content;
     }
 }

 add_shortcode('ormapker_short_code', 'ormapker_show_map_func');
//  short code => [ormapker_short_code]
