<?php
/*
 * goes in theme functions.php or a custom plugin
 *
 * Subject filters:
 *   woocommerce_email_subject_new_order
 *   woocommerce_email_subject_customer_processing_order
 *   woocommerce_email_subject_customer_completed_order
 *   woocommerce_email_subject_customer_invoice
 *   woocommerce_email_subject_customer_note
 *   woocommerce_email_subject_low_stock
 *   woocommerce_email_subject_no_stock
 *   woocommerce_email_subject_backorder
 *   woocommerce_email_subject_customer_new_account
 *   woocommerce_email_subject_customer_invoice_paid
 **/
add_filter('woocommerce_email_subject_new_order', 'change_admin_email_subject', 10, 2);

function change_admin_email_subject($subject, $order)
{
    global $woocommerce;

    $subject = sprintf('Ваш заказ №%s готов!', $order->id);

    return sprintf('Ваш заказ №%s готов!', $order->id);
}
