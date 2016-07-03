<?php
/*
 * Plugin Name: Daneshjooyar post Gallery
 * Plugin URI: http://daneshjooyar.com
 * Author: Hamed Moodi
 * Author URI: http://ircodex.ir
 * Description: this is simple plugin for add gallery for any post such as product gallery
 * Version: 1.0.0
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: daneshjooyar-post-gallery
 * Domain Path: /languages
 */

defined(  'ABSPATH'  ) || exit;

/*
 * Base contants
 */
define( 'DYPG_VER', '1.0.0' );

/*
 * Plugin absolute patth
 */
define( 'DYPG_DIR', plugin_dir_path( __FILE__ ) );

/*
 * Plugin url path
 */
define( 'DYPG_CSS', plugin_dir_url( __FILE__ ) . 'css/' );
define( 'DYPG_JS', plugin_dir_url( __FILE__ ) . 'js/' );
define( 'DYPG_IMG', plugin_dir_url( __FILE__ ) . 'images/' );

include( DYPG_DIR . 'core/DYPG_Core.php' );

$dypgCore = new DYPG_Core( DYPG_VER );

/**
 * Run daneshjooyar post gallery plugin
 */
$dypgCore->run();
