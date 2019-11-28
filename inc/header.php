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

  remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10);
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

function storefront_primary_navigation() {
    ?>
    <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'storefront' ); ?>">
    <button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false">
      <span></span>
    </button>
      <?php
      wp_nav_menu(
        array(
          'theme_location'  => 'primary',
          'container_class' => 'primary-navigation',
        )
      );

      wp_nav_menu(
        array(
          'theme_location'  => 'handheld',
          'container_class' => 'handheld-navigation',
        )
      );
      ?>
    </nav><!-- #site-navigation -->
    <?php
  }