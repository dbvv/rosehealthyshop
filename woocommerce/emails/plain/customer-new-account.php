<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/plain/customer-new-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails/Plain
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

echo "=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n";
echo 'Ваша учётная запись создана!\n';
echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

echo "Ваша учётная запись создана автоматически.\n";

/* translators: %s Customer first name */
echo sprintf( esc_html__( 'Ваш никнейм/логин: %s,', 'woocommerce' ), esc_html( $user_login ) ) . "\n\n";
/* translators: %1$s: Site title, %2$s: Username, %3$s: My account link */

if ( 'yes' === get_option( 'woocommerce_registration_generate_password' ) && $password_generated ) {
	/* translators: %s Auto generated password */
	echo sprintf( esc_html__( 'Ваш пароль: %s.', 'woocommerce' ), esc_html( $user_pass ) ) . "\n\n";
}

echo "Мой кабинет: " . wc_get_page_permalink( 'myaccount' ) . " \n";

echo "\n\n----------------------------------------\n\n";

/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo esc_html( wp_strip_all_tags( wptexturize( $additional_content ) ) );
	echo "\n\n----------------------------------------\n\n";
}

echo wp_kses_post( apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) ) );
