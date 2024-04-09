<?php

/**
 * Plugin Name: MV Slider
 * Plugin URI: http://www.wordpress.org/mv-slider
 * Description: My Plugin's description
 * Version: 1.0
 * Requires atleast: 5.6
 * Author: Marcelo Vieira
 * Author: URI: https://www.codigowp.net
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mv-slider
 * Domain Path: /languages
 */

/*
MV Slider is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
MV Slider is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with MV Slider. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

 //Makes sure that any info is not exposed if called directly
 if( ! defined( 'ABSPATH' ) ){
    die('Hey, you can\'t access this file, you silly human!');
    exit;
 }

 if( ! class_exists( 'MV_Slider' ) ){
    class MV_Slider{
        function __construct(){
            $this->define_constants();
            require_once( MV_SLIDER_PATH . 'post-types/class.mv-slider-cpt.php');
            $MV_Slider_Post_Type = new MV_Slider_Post_type();
        }

        public function define_constants(){
            define( 'MV_SLIDER_PATH', plugin_dir_path( __FILE__));
            define( 'MV_SLIDER_URL', plugin_dir_url( __FILE__));
            define( 'MV_SLIDER_VERSION', '1.0.0');
        }

        public static function activate(){
            update_option( 'rewrite_rules', '');
        }

        public static function deactivate(){
            flush_rewrite_rules();
            unregister_post_type( 'mv-slider');
        }

        public static function uninstall(){

        }
    }
 }

 if ( class_exists( 'MV_Slider' ) ) {
    register_activation_hook( __FILE__, array( 'MV_Slider', 'activate'));
    register_deactivation_hook( __FILE__, array( 'MV_Slider', 'deactivate'));
    register_uninstall_hook( __FILE__, array( 'MV_Slider', 'uninstall'));
    $mv_slider = new MV_Slider();
 }
