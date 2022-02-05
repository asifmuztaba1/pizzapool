<?php
namespace Wppool\Pizzapool\Admin;

class Generators
{
    public function CouponGenerator() {
        $coupon_code = __('First Order Discount', 'first-order-discount-woocommerce'); // Coupon Code
        $amount = '40'; // Amount of discount
        $discount_type = 'percent'; // Type: fixed_cart, percent, fixed_product, percent_product
        $coupon = array(
            'post_title' => $coupon_code,
            'post_content' => '',
            'post_status' => 'publish',
            'post_author' => 1,
            'post_type'		=> 'shop_coupon'
        );
        $new_coupon_id = wp_insert_post( $coupon );
        update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
        update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
        update_post_meta( $new_coupon_id, 'individual_use', 'no' );
        update_post_meta( $new_coupon_id, 'product_ids', '' );
        update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
        update_post_meta( $new_coupon_id, 'usage_limit', '' );
        update_post_meta( $new_coupon_id, 'expiry_date', '' );
        update_post_meta( $new_coupon_id, 'apply_before_tax', 'yes' );
        update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
        update_option('_pplfod_coupon_id', $new_coupon_id);
    }
    function CouponDeGenerator() {
        $couponId = get_option('_pplfod_coupon_id');
        wp_delete_post( $couponId, true );
        delete_option($couponId);
    }
}