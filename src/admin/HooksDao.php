<?php

namespace Wppool\Pizzapool\Admin;

use WC_Coupon;
use Wppool\Pizzapool\Core\Helper;
use Wppool\Pizzapool\Core\PoolModel;

class HooksDao
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'pplfod_adding_scripts'));

        add_action('wp_ajax_change_total', array($this, 'change_total'));
        add_action('wp_ajax_nopriv_change_total', 'change_total');

        add_action('woocommerce_before_order_notes', array($this, 'OrderTypeFieldsGenerator'));
        add_action('woocommerce_cart_calculate_fees', array($this, 'CartCalculation'));
        add_action('woocommerce_before_cart', array($this, 'ApplyNewUserDiscount'));
        add_action('template_redirect', array($this, 'AddProductToCart'));
        add_action('admin_menu', array($this, 'setAdminMenu'));
        add_action('admin_enqueue_scripts', array($this, 'setAdminStylesScripts'));
        add_action('woocommerce_checkout_process', array($this,'checkorderType'));

    }

    public function checkorderType()
    {
        $ordertype = $_POST['order_type_checkout_field'];
        if($ordertype==='')
        wc_add_notice(__('Please Select you Order Type'), 'error');

    }

    public function setAdminStylesScripts()
    {
        if (isset($_GET['page']) && ($_GET['page'] === 'pizzapool-custom-order-setup')):
            wp_register_style('pizzapool-custom-order-setup' . '-adminscript', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', false, '1.0.0');
            wp_register_style('pizzapool-custom-order-setup-fontawesome' . '-adminscript', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, '1.0.0');
            wp_register_script('pizzapool-order-script-admin', plugin_dir_url(__DIR__) . 'assets/js/pizzapool-custom-order-admin-js.js', array('jquery'), '1.1', true);
            wp_register_script('pizzapool-alert-script-admin', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', array('jquery'), '1.1', false);
            wp_enqueue_script('pizzapool-order-script-admin');
            wp_enqueue_script('pizzapool-alert-script-admin');
            wp_enqueue_script('pizzapool-alert-script-admin-bttrp');
            wp_localize_script('pizzapool-order-script-admin', 'ajax_object_admin',
                array('ajax_url_admin' => admin_url('admin-ajax.php')));
        endif;
        wp_enqueue_style('pizzapool-custom-order-setup' . '-adminscript');
        wp_enqueue_style('pizzapool-custom-order-setup-fontawesome' . '-adminscript');
    }

    public function setAdminMenu()
    {
        add_menu_page("PizzaPool Custom Order Setup", 'Pizza Pool Setup', 'activate_plugins', 'pizzapool-custom-order-setup', array($this, 'setAdminPage'));
    }

    public function setAdminPage()
    {
        include __DIR__ . '/setup-page.php';
    }

    public function change_total()
    {
        setcookie("order_fee", $_POST['order_fee'] , time() + (30 * 1), '/');
        setcookie("order_name", $_POST['order_name'], time() + (30 * 1), '/');
        setcookie("order_id", $_POST['order_id'], time() + (30 * 1), '/');
        wp_die();
    }

    public function pplfod_adding_scripts()
    {
        wp_register_script('pizzapool-order-script', plugin_dir_url(__DIR__) . 'assets/js/pizzapool-custom-order-js.js', array('jquery'), '1.1', true);
        wp_enqueue_script('pizzapool-order-script');
        wp_localize_script('pizzapool-order-script', 'ajax_object',
            array('ajax_url' => admin_url('admin-ajax.php')));
    }

    public function OrderTypeFieldsGenerator($checkout): void
    {
        echo '<div id="order_type_checkout_field_wrap">';
        woocommerce_form_field('order_type_checkout_field', array(
            'type' => 'select',
            'class' => array(
                'form-row-wide', 'validate-required'
            ),
            'required' => true,
            'label' => __('Select Order Type'),
            'options' =>  (new \Wppool\Pizzapool\Core\PoolModel)->getOrderTypes(true),
            'default' => $_COOKIE['order_id'] ?? ''

        ),
            $checkout->get_value('order_type_checkout_field'));
        echo '</div>';
    }

    public function CartCalculation(): void
    {
        if (isset($_COOKIE['order_fee']) && $_COOKIE['order_fee'] !== 0 && isset($_COOKIE['order_name']) && $_COOKIE['order_name'] !== '') {
            $percentage_fee = (WC()->cart->get_cart_contents_total() + WC()->cart->get_shipping_total()) * $_COOKIE['order_fee'];
            WC()->cart->add_fee(__($_COOKIE['order_name'], 'txtdomain'), $percentage_fee);
        }
    }

    public function ApplyNewUserDiscount(): void
    {
        global $wpdb;
        if (is_null(WC()->session)) {
            return;
        }
        if (Helper::pplfod_has_bought()) {
            return;
        }
        $productInCart = false;
        foreach (WC()->cart->get_cart() as $cart_item_key => $values) {
            $_product = $values['data'];
        }
        $couponId = get_option('_pplfod_coupon_id');
        $strCoupon = "SELECT post_title FROM {$wpdb->prefix}posts WHERE ID = '" . $couponId . "'";
        $arrCoupon = $wpdb->get_results($strCoupon);
        $coupon_code = $arrCoupon[0]->post_title;
        $coupon = new WC_Coupon($couponId);
        $users = $coupon->get_used_by();
        $user = wp_get_current_user();
        if ((isset(WC()->cart->applied_coupons) && !empty(WC()->cart->applied_coupons)) || !$coupon->is_valid() || (isset($user) && !empty($user) && in_array($user->user_email, $users))) {
            return;
        }
        WC()->cart->add_discount($coupon_code);
        WC()->session->__set('pplfod_coupon_added', true);
    }

    public function AddProductToCart(): void
    {
        if (!is_admin()) {
            if (!WC()->cart->is_empty() and Helper::CheckOpenClose()) {
                foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                    WC()->cart->remove_cart_item($cart_item_key);
                    wc_clear_notices();
                    wc_add_notice(apply_filters('wc_add_to_cart_message', "We are Close Now", 'error'));
                }
            }
        }
    }
}