<?php

// remove refresh buttons and useless others
remove_action('woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10);

add_filter('woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text');
add_filter('woocommerce_product_add_to_cart_text', 'woo_custom_cart_button_text');

function woo_custom_cart_button_text()
{
  return __('Купить', 'woocommerce');
}

add_filter('woocommerce_add_to_cart_redirect', 'rhs_add_to_cart_redirect');
function rhs_add_to_cart_redirect()
{
  global $woocommerce;
  $checkout_url = wc_get_checkout_url();
  return $checkout_url;
}

add_filter('woocommerce_add_to_cart_validation', 'wc_limit_one_per_order', 10, 2);
function wc_limit_one_per_order($passed_validation, $product_id)
{

  $product_cart_id = WC()->cart->generate_cart_id($product_id);
  $in_cart         = WC()->cart->find_product_in_cart($product_cart_id);

  if ($in_cart) {
    $notice = __('Товар уже в корзине!');
    wc_add_notice($notice, 'notice');
    return false;
  } else {
    return $passed_validation;
  }
}
