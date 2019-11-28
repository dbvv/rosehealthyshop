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
    // unset($fields['billing']['billing_first_name']);
    // unset($fields['billing']['billing_last_name']);
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

function sv_remove_cart_notice_on_checkout()
{
    if (function_exists('wc_cart_notices')) {
        remove_action('woocommerce_before_checkout_form', array(wc_cart_notices(), 'add_cart_notice'));
    }
}
add_action('init', 'sv_remove_cart_notice_on_checkout');

function remove_added_to_cart_notice()
{
    $notices = WC()->session->get('wc_notices', array());

    if (isset($notices['success'])) {
      foreach ($notices['success'] as $key => &$notice) {
          if (strpos($notice, 'has been added') !== false) {
              $added_to_cart_key = $key;
              break;
          }
      }
      unset($notices['success'][$added_to_cart_key]);
    }

    WC()->session->set('wc_notices', $notices);
}
add_action('woocommerce_before_single_product', 'remove_added_to_cart_notice', 1);
add_action('woocommerce_shortcode_before_product_cat_loop', 'remove_added_to_cart_notice', 1);
add_action('woocommerce_before_shop_loop', 'remove_added_to_cart_notice', 1);

add_action('woocommerce_review_order_before_payment', 'propositions_text_after_billing_forms');
function propositions_text_after_billing_forms() {
  echo '<p> На указанный вами Email будет отправлен товар сразу после оплаты. Так же вы можете в любой момент скачать товар в личном кабинете в разделе Загрузки.</p>';
}