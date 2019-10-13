<?php

add_action('init', 'rhs_delay_remove');
function rhs_delay_remove()
{
  remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
  remove_action('woocommerce_after_shop_loop', 'woocommerce_result_count', 20);
  remove_action('woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10);
  remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10);
}
//This snippet removes the default sorting dropdown in StoreFront Theme
