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

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
        include_once VIP_PLUGIN_DIR . 'class/AutoLoad.php';
        register_activation_hook(__FILE__, [$this, 'wp_vip_activation']);
        register_deactivation_hook(__FILE__, [$this, 'wp_vip_deactivation']);
        add_action('wp_enqueue_scripts', [$this, 'wp_vip_register_assets']);
        add_action('admin_enqueue_scripts', [$this, 'wp_vip_register_assets_admin']);
        add_action('after_setup_theme', [$this, 'wp_check_is_user_vip']);
        add_filter('template_redirect', [$this, 'ob_start']);

        // Include
        include_once VIP_PLUGIN_DIR . '_lib/jdf.php';
        include_once VIP_PLUGIN_DIR . 'view/front/vip-card.php';
        include_once VIP_PLUGIN_DIR . 'view/front/vip-checkout.php';
        include_once VIP_PLUGIN_DIR . 'view/front/vip-gateway.php';
        include_once VIP_PLUGIN_DIR . 'view/front/vip-payment-result.php';
        include_once VIP_PLUGIN_DIR . '_inc/zibal-config.php';
        include_once(VIP_PLUGIN_DIR . '_inc/metabox/vip-metabox.php');
        include_once(VIP_PLUGIN_DIR . '_inc/filter-vip-content.php');
        include_once(VIP_PLUGIN_DIR . '_inc/panel/menu.php');
        include_once(ABSPATH . 'wp-includes/pluggable.php');
    }
    public function wp_vip_register_assets()
    {
        // CSS
        wp_register_style('vip-style', VIP_PLUGIN_URL . '/assets/css/front/front-style.css', '', '1.0.0');
        wp_enqueue_style('vip-style');

        // JS
        wp_register_script('vip-main-js', VIP_PLUGIN_URL . '/assets/js/front/main.js', ['jquery'], '1.0.0', true);
        wp_enqueue_script('vip-main-js');
    }
    public function wp_vip_register_assets_admin()
    {
        // UIkit CSS
        wp_register_style('uikit-style-rtl', VIP_PLUGIN_URL . 'assets/css/admin/uikit-rtl.min.css', '', '1.0.0');
        wp_enqueue_style('uikit-style-rtl');

        // CSS
        wp_register_style('jalalidatepicker', 'https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css', '', '1.0.0');
        wp_enqueue_style('jalalidatepicker');

        wp_register_style('vip-style-admin', VIP_PLUGIN_URL . '/assets/css/admin/admin.css', '', '1.0.0');
        wp_enqueue_style('vip-style-admin');


        // UIkit JS
        wp_register_script('uikit-js', 'https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js', ['jquery'], '1.0.0', true);
        wp_enqueue_script('uikit-js');

        wp_register_script('uikit-icon-js', 'https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js', ['jquery'], '1.0.0', true);
        wp_enqueue_script('uikit-icon-js');

        // JS
        wp_register_script('jalalidatepicker-js', 'https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js', '', '1.0.0', true);
        wp_enqueue_script('jalalidatepicker-js');

        wp_register_script('vip-admin-js', VIP_PLUGIN_URL . '/assets/js/admin/admin.js', ['jquery'], '1.0.0', true);
        wp_enqueue_script('vip-admin-js');
    }
    public function wp_vip_activation()
    {
    }
    public function wp_vip_deactivation()
    {
    }
    function wp_check_is_user_vip()
    {
        User::is_user_vip(get_current_user_id());
    }
    public function ob_start()
    {
        return ob_start(null, 0, 0);
    }
}
$core = new Core();
