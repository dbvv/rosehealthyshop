<?php

function custom_my_account_menu_items($items)
{
  $items = array(
    //'dashboard'         => __( 'Dashboard', 'woocommerce' ),
    'orders'          => __('Orders', 'woocommerce'),
    'downloads'       => __( 'Downloads', 'woocommerce' ),
    // //'edit-address'      => __( 'Moje dane', 'woocommerce' ),
    // //'payment-methods'   => __( 'Payment Methods', 'woocommerce' ),
    'edit-account'    => __('Settings', 'woocommerce'),
    'customer-logout' => __('Logout', 'woocommerce'),
    // 'kontakt'         => __('Masz pytanie', 'woocommerce'),
    // 'kontakt-orders'  => __('Zapytaj o zamówienie', 'woocommerce'),
  );

  return $items;
}
add_filter('woocommerce_account_menu_items', 'custom_my_account_menu_items');
