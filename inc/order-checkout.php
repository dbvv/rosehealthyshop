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
  // dump($fields['billing']);
  return $fields;
}
