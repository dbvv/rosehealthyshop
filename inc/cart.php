<?php

// remove refresh buttons and useless others
remove_action('woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10);

add_filter('woocommerce_add_to_cart_validation', 'wc_limit_one_per_order', 10, 2);
function wc_limit_one_per_order($passed_validation, $product_id)
{

    $product_cart_id = WC()->cart->generate_cart_id($product_id);
    $in_cart         = WC()->cart->find_product_in_cart($product_cart_id);

    if (is_bought($product_id)) {
        wc_add_notice(__("Товар уже заказан!"), 'notice');
        wp_redirect(get_permalink($product_id));
    }

    if ($in_cart) {
        $notice = __('Товар уже в корзине!');
        wc_add_notice($notice, 'notice');
        // wp_redirect(wc_get_checkout_url(), $status = 302);
        return false;
    } else {
        return $passed_validation;
    }
}

function add_content_after_addtocart()
{

    // get the current post/product ID
    $current_product_id = get_the_ID();

    // get the product based on the ID
    $product = wc_get_product($current_product_id);

    // get the "Checkout Page" URL
    $checkout_url = wc_get_checkout_url();

    // run only on simple products
    // if( $product->is_type( 'simple' ) ){
    echo '<a href="' . $checkout_url . '?add-to-cart=' . $current_product_id . '" class="single_add_to_cart_button  go-to-checkout button alt">' . __('Купить') . '</a>';
    // }
}
add_action('woocommerce_before_add_to_cart_button', 'add_content_after_addtocart');

function find_product_in_cart($product_id)
{
    $product_cart_id = WC()->cart->generate_cart_id($product_id);
    $in_cart         = WC()->cart->find_product_in_cart($product_cart_id);
    return $in_cart;
}
