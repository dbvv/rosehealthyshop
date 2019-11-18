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

add_action('woocommerce_account_downloads_columns', 'custom_downloads_columns', 10, 1); // Orders and account
add_action('woocommerce_email_downloads_columns', 'custom_downloads_columns', 10, 1); // Email notifications
function custom_downloads_columns($columns)
{
  // Removing "Download expires" column
  if (isset($columns['download-expires'])) {
    unset($columns['download-expires']);
  }

  // Removing "Download remaining" column
  if (isset($columns['download-remaining'])) {
    unset($columns['download-remaining']);
  }

  return $columns;
}

add_filter('woocommerce_save_account_details_required_fields', 'remove_required_fields');

function remove_required_fields($required_fields)
{
  unset($required_fields['account_first_name']);
  unset($required_fields['account_last_name']);

  return $required_fields;
}

add_filter( 'woocommerce_endpoint_edit-account_title', 'change_my_account_edit_account_title', 10, 2 );
function change_my_account_edit_account_title( $title, $endpoint ) {
    $title = __( "Настройки", "woocommerce" );

    return $title;
}