<?php
/**
 * Plugin Name: CoolRunner: PCN OrderSync
 * Plugin URI: http://coolrunner.dk
 * Description: Ordresynkronisering af orderstatus imod PakkecenterNord
 * Version: 1.0
 * Author: CoolRunner
 * Author URI: http://coolrunner.dk
 * Developer: Kevin Hansen / CoolRunner
 * Developer URI: http://coolrunner.dk
 * Text Domain: coolrunner-pcn-ordersync
 * Domain Path: /languages
 *
 * Developed with: Wordpress 5.3.2
 * Developed with: WooCommerce 3.9.0
 *
 * Copyright: © 2018- CoolRunner.dk
 * License: MIT
 */

// Check if absolute path of wordpress directory else exit
if (!defined('ABSPATH')) {
    exit;
}

// Define version of plugin
define('PCN_WOOCOMMERCE_ORDER', '1.0');
define('PLUGIN_FILE_URL', __FILE__);

add_action('plugins_loaded', 'pcn_ordersync_load_textdomain');
function pcn_ordersync_load_textdomain() {
    load_plugin_textdomain('coolrunner-pcn-ordersync', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}

// Check if woocommerce is active
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (!is_plugin_active('woocommerce/woocommerce.php')) {
    // If WooCommerce isn't active then give admin a warning
    add_action('admin_notices', function () {
        ?>
        <div class="notice notice-warning">
            <p><?php echo __('PCN OrderSync requires that WooCommerce is installed.', 'coolrunner-pcn-ordersync'); ?></p>
            <p><?php echo __('You can download WooCommerce here: ', 'coolrunner-pcn-ordersync') . sprintf('<a href="%s/wp-admin/plugin-install.php?s=WooCommerce&tab=search&type=term">Download</a>', get_site_url()) ?></p>
        </div>
        <?php
    });
    return;

} elseif (!is_plugin_active('coolrunner-pcn-stocksync/woocommerce_pcn_stocksync.php')) {
    // If Coolrunner: PCN StockSync isn't active then give admin a warning
    add_action('admin_notices', function () {
        ?>
        <div class="notice notice-warning">
            <p><?php echo __('PCN OrderSync requires that PCN StockSync is installed.', 'coolrunner-pcn-ordersync'); ?></p>
            <p><?php echo __('You can download PCN StockSync here: ', 'coolrunner-pcn-ordersync') . sprintf('<a href="https://github.com/CoolRunner-dk/woocommerce-pcn-stocksync">Download</a>', get_site_url()) ?></p>
        </div>
        <?php
    });
    return;

} else {
    // Define plugin path
    if (!defined('PCN_ORDERSYNC_DIR')) {
        define('PCN_ORDERSYNC_DIR', plugin_dir_path(__FILE__));
    }

    // Add settings link to plugin in overview of plugins
    add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'pcnordersync_action_links');
    function pcnordersync_action_links($links) {
        $links[] = '<a href="' . admin_url('admin.php?page=wc-settings&tab=pcnordersync') . '">Indstillinger</a>';
        return $links;
    }

    include(PCN_ORDERSYNC_DIR . 'includes/curl.php');
    include(PCN_ORDERSYNC_DIR . 'includes/functions.php');
    include(PCN_ORDERSYNC_DIR . 'includes/admin/class-pcnordersync-settings.php');
}
