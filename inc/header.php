<?php

add_action('init', 'rhs_remove_storefront_header_search');
function rhs_remove_storefront_header_search()
{
  remove_action('storefront_header', 'storefront_product_search', 40);

  /**
   * Change a currency symbol
   */
  add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 40, 2);

  function change_existing_currency_symbol($currency_symbol, $currency)
  {
    switch ($currency) {
      case 'RUB':
        $currency_symbol = '₽';
    }
    return $currency_symbol;
  }
}

add_action('wp_enqueue_scripts', 'rhs_disable_woocommerce_cart_fragments', 11);

function rhs_disable_woocommerce_cart_fragments()
{
  if (WC()->cart->get_cart_contents_count() == 0) {
    // disable fragments
    wp_dequeue_script('wc-cart-fragments');
  }
}

add_action('template_redirect', 'remove_shop_breadcrumbs');
function remove_shop_breadcrumbs()
{
  if (is_shop()) {
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
  }
}
