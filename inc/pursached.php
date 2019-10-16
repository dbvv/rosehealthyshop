<?php

/**
 * Check is authorized wordpress user bought product
 * @param  int  $product_id product id
 * @return boolean             is bought
 */
function is_bought($product_id) {
  if (!is_user_logged_in()) {
    return false;
  }

  $current_user = wp_get_current_user();

  if (wc_customer_bought_product($current_user->user_email, $current_user->ID, $product_id)) {
    return true;
  } else {
    return false;
  }
}