<?php

function custom_my_account_menu_items($items)
{
  $items = array(
    'orders'          => __('Orders', 'woocommerce'),
    'downloads'       => __('Downloads', 'woocommerce'),
    'edit-account'    => __('Settings', 'woocommerce'),
    'customer-logout' => __('Logout', 'woocommerce'),
  );
  return $items;
}
add_filter('woocommerce_account_menu_items', 'custom_my_account_menu_items');
