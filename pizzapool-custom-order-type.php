<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.asifmuztaba.com
 * @since             1.0.0
 * @package           Itbz_active_campaign_event_tracker
 *
 * @wordpress-plugin
 * Plugin Name:       PizzaPool Custom Order Type
 * Plugin URI:        https://github.com/asifmuztaba1/wppool_pizzapool
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Md Asif Muztaba
 * Author URI:        www.asifmuztaba.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       itbz_active_campaign_event_tracker
 * Domain Path:       /languages
 */
require_once plugin_dir_path(__FILE__).'vendor/autoload.php';
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

use Wppool\Pizzapool\Core\BootLoader;

if ( ! defined( 'WPINC' ) ) {
    die;
}
$plugin=new BootLoader();
register_activation_hook( __FILE__, array($plugin,'PizzaPoolOrderCustomActivator' ));
register_deactivation_hook( __FILE__, array($plugin,'PizzaPoolOrderCustomDeActivator' ));