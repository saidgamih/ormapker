<?php
/**
 * Plugin Name: Maper
 * Plugin URI: http://www.mywebsite.com/my-first-plugin
 * Description: The very first plugin that I have ever created.
 * Version: 1.0
 * Author: Lorem
 */

 function maper_show_map_func($atts)
 {
     ob_start();
     require 'templates/scaffolding.inc.php';
     $content = ob_get_clean();
     return $content;
 }

 add_shortcode('maper_short_code', 'maper_show_map_func');
//  short code => [maper_short_code]