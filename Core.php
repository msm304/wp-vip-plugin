<?php

/*
Plugin Name: پلاگین اشتراک ویژه
Plugin URI: https://owebra.com/plugins/wp-vip-plugin
Description: پلاگین اشتراک ویژه
Author: Amirhosein Soltani
Version: 1.0.0
Licence: GPLv2 or Later
Author URI: https://owebra.com/resume
*/

defined('ABSPATH') || exit;

class Core
{
    public function __construct()
    {
        $this->define_constants();
        $this->init();
    }
    private function define_constants()
    {
        define('VIP_PLUGIN_DIR', plugin_dir_path(__FILE__));
        define('VIP_PLUGIN_URL', plugin_dir_url(__FILE__));
    }
    private function init()
    {
        register_activation_hook(__FILE__, [$this, 'wp_vip_activation']);
        register_deactivation_hook(__FILE__, [$this, 'wp_vip_deactivation']);
        add_action('wp_enqueue_scripts', [$this, 'wp_vip_register_assets']);
        add_action('admin_enqueue_scripts', [$this, 'wp_vip_register_assets_admin']);
    }
    private function wp_vip_register_assets()
    {
        // CSS
        wp_register_style('vip-style', VIP_PLUGIN_URL . '/assets/css/front/front-style.css', '', '1.0.0');
        wp_enqueue_style('vip-style');

        // JS
        wp_register_script('vip-main-js', VIP_PLUGIN_URL . '/assets/js/front/main.js', ['jquery'], '1.0.0', true);
        wp_enqueue_script('vip-main-js');
    }
    private function wp_vip_register_assets_admin()
    {
        // CSS
        wp_register_style('vip-style', VIP_PLUGIN_URL . '/assets/css/front/front-style.css', '', '1.0.0');
        wp_enqueue_style('vip-style');

        // JS
        wp_register_script('vip-admin-js', VIP_PLUGIN_URL . '/assets/js/admin/admin.js', ['jquery'], '1.0.0', true);
        wp_enqueue_script('vip-admin-js');
    }
    private function wp_vip_activation()
    {
    }
    private function wp_vip_deactivation()
    {
    }
}
