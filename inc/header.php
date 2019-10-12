<?php

add_action('init', 'jk_remove_storefront_header_search');
function jk_remove_storefront_header_search()
{
  remove_action('storefront_header', 'storefront_product_search', 40);
}
