<?php
/*
 * Plugin Name: Daneshjooyar post Gallery
 * Plugin URI: http://daneshjooyar.com
 * Author: Hamed Moodi
 * Author URI: http://ircodex.ir
 * Description: this is simple plugin for add gallery for any post such as product gallery for wordpress
 * Version: 1.0.3
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: daneshjooyar-post-gallery
 * Domain Path: /languages
 */

/**
 * @author Hamed Moodi <hamedmoodi2011@gmail.com>
 * @version 1.0.3
 * @since 1.0
 */

defined(  'ABSPATH'  ) || exit;

/**
 * Base contants
 */
define( 'DYPG_VER', '1.0.3' );

/**
 * Plugin absolute path
 */
define( 'DYPG_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Plugin url path
 */
define( 'DYPG_CSS', plugin_dir_url( __FILE__ ) . 'assets/css/' );
define( 'DYPG_JS', plugin_dir_url( __FILE__ ) . 'assets/js/' );
define( 'DYPG_IMG', plugin_dir_url( __FILE__ ) . 'assets/img/' );

/**
 * Load plugin core
 */
include( DYPG_DIR . 'core/DYPG_Core.php' );

/**
 * Instantiate plugin core
 * @var DYPG_Core
 */
$dypgCore = new DYPG_Core( DYPG_VER );

/**
 * Run daneshjooyar post gallery plugin
 */
$dypgCore->run();
