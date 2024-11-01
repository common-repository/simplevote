<?php
/**
 * @package simplevote
 * @version 1.7
 */

/*
Plugin Name: SimpleVote
Plugin URI: http://plugins.funsite.eu/simplevote/
Description: Creates a widget for a simple voting system.
Author: Gerhard Hoogterp
Version: 1.7
Author URI: http://plugins.funsite.eu/simplevote/
Text Domain: simplevote
Domain Path: /languages
*/
if ( ! defined( 'ABSPATH' ) ) exit;

if (!class_exists('basic_plugin_class')):
	require(plugin_dir_path(__FILE__).'basics/basic_plugin.class');
endif;

include_once('simplevote-plugin.php');
$simplevote = new simplevote_class();
$simplevote->currentPlugin = __FILE__; // bit of a hack to find the plugin info in getPlugins

?>