<?php

/**
 * order checkout
 */

add_action('woocommerce_checkout_fields', 'rhs_checkout_fields');

function rhs_checkout_fields($fields)
{
  // unset($fields['billing']);
  unset($fields['shipping']);
  unset($fields['notes']);
  unset($fields['billing']['billing_first_name']);
  unset($fields['billing']['billing_last_name']);
  unset($fields['billing']['billing_company']);
  unset($fields['billing']['billing_country']);
  unset($fields['billing']['billing_address_1']);
  unset($fields['billing']['billing_address_2']);
  unset($fields['billing']['billing_city']);
  unset($fields['billing']['billing_state']);
  unset($fields['billing']['billing_postcode']);
  unset($fields['billing']['billing_phone']);
  unset($fields['order']);
  return $fields;
}

remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);

function woocommerce_button_proceed_to_checkout()
{
?>
 <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="checkout-button button alt wc-forward">
 <?php esc_html_e('Оплатить заказ', 'woocommerce');?>
 </a>
 <?php
}

function woocommerce_widget_shopping_cart_proceed_to_checkout()
{
  echo '<a href="' . esc_url(wc_get_checkout_url()) . '" class="button checkout wc-forward">' . esc_html__('Оплатить заказ', 'woocommerce') . '</a>';
}