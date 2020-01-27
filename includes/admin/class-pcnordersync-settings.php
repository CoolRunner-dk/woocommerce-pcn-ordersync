<?php

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

if (!class_exists('WC_Settings_PCNOrderSync')) {

    function pcnordersync_add_coolrunner_settings() {

        class WC_Settings_PCNOrderSync extends WC_Settings_Page
        {
            public function __construct() {
                $this->id = 'pcnordersync';
                $this->label = __('PCN OrderSync - Settings', 'coolrunner-pcn-ordersync');

                add_filter('woocommerce_settings_tabs_array', array($this, 'add_settings_page'), 20);
                add_action('woocommerce_settings_' . $this->id, array($this, 'output'));

                add_action('woocommerce_sections_' . $this->id, array($this, 'output_sections'));
                add_action('woocommerce_get_settings_for_' . $this->id, array($this, 'get_option'));
                add_action('woocommerce_settings_save_' . $this->id, array($this, 'save'));
            }

            // Get settings array - Returns all input fields
            public function get_settings($current_section = '') {
                $menu = array(
                    array(
                        'name' => __('PCN OrderSync - Settings', 'coolrunner-pcn-ordersync'),
                        'type' => 'title',
                        'desc' => '',
                        'id' => 'pcnordersync_setting',
                    ),
                    array(
                        'name'    => __( 'Status for new orders', 'coolrunner-pcn-ordersync' ),
                        'desc'    => __( 'Add the status new orders in your webshop gets', 'coolrunner-pcn-ordersync' ),
                        'id'      => 'pcn_settings_neworderstatus',
                        'css'     => 'min-width:150px;',
                        'std'     => 'left', // WooCommerce < 2.0
                        'default' => 'left', // WooCommerce >= 2.0
                        'type'    => 'select',
                        'options' => array(
                            'pending'        => __( 'Pending payment', 'coolrunner-pcn-ordersync' ),
                            'processing'       => __( 'Processing', 'coolrunner-pcn-ordersync' ),
                            'on-hold'  => __( 'On hold', 'coolrunner-pcn-ordersync' ),
                            'completed' => __( 'Completed', 'coolrunner-pcn-ordersync' ),
                            'cancelled' => __( 'Cancelled', 'coolrunner-pcn-ordersync' ),
                            'refunded' => __( 'Refunded', 'coolrunner-pcn-ordersync' ),
                            'failed' => __( 'Failed', 'coolrunner-pcn-ordersync' ),
                        ),
                        'desc_tip' =>  true,
                    ),
                    array(
                        'name'    => __( 'Wanted status when order is packed and ready to charge?', 'coolrunner-pcn-ordersync' ),
                        'desc'    => __( 'What status do you want the plugin to set the order when order is packed.', 'coolrunner-pcn-ordersync' ),
                        'id'      => 'pcn_settings_wantedorderstatus',
                        'css'     => 'min-width:150px;',
                        'std'     => 'left', // WooCommerce < 2.0
                        'default' => 'left', // WooCommerce >= 2.0
                        'type'    => 'select',
                        'options' => array(
                            'pending'        => __( 'Pending payment', 'coolrunner-pcn-ordersync' ),
                            'processing'       => __( 'Processing', 'coolrunner-pcn-ordersync' ),
                            'on-hold'  => __( 'On hold', 'coolrunner-pcn-ordersync' ),
                            'completed' => __( 'Completed', 'coolrunner-pcn-ordersync' ),
                            'cancelled' => __( 'Cancelled', 'coolrunner-pcn-ordersync' ),
                            'refunded' => __( 'Refunded', 'coolrunner-pcn-ordersync' ),
                            'failed' => __( 'Failed', 'coolrunner-pcn-ordersync' ),
                        ),
                        'desc_tip' =>  true,
                    )
                );

                $settings = apply_filters('pcnordersync_settings', $menu);
                return apply_filters('woocommerce_get_settings_' . $this->id, $settings, $current_section);
            }

            // Save settings
            public function save()
            {
                parent::save();
            }
        }

        return new WC_Settings_PCNOrderSync();
    }

    add_filter('woocommerce_get_settings_pages', 'pcnordersync_add_coolrunner_settings', 17);

}

