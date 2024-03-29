<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

global $product;

if (!$product->is_purchasable()) {
    return;
}

$current_product_id = $product->get_id();

if (is_bought($current_product_id)) {
    echo '<p>' . __('Товар уже куплен!') . '</p>';
    // get all downloadable files from the product
    $files        = $product->get_downloads();
    $files_output = '';

    //Loop through each downloadable file
    foreach ($files as $file) {
        //store the html with link and name in $output variable assuming the $output variable is declared above
        $download_file_name = count($files) > 1 ? $product->get_name() . ' - ' . $file['name'] : $product->get_name();
        $files_output .= '<p><a href="' . $file['file'] . '" class="button" download target="_blank"><i class="fa fa-download"></i> ' . $download_file_name . '</a></p>';

        echo $files_output;
    }
} elseif (find_product_in_cart($current_product_id)) {
    echo "<button class=\"button\" disabled>В корзине</button>";
} else {
    // get the product based on the ID
    $product = wc_get_product($current_product_id);

// get the "Checkout Page" URL
    $checkout_url = wc_get_checkout_url();

    echo wc_get_stock_html($product); // WPCS: XSS ok.

    if ($product->is_in_stock()): ?>

  <?php do_action('woocommerce_before_add_to_cart_form');?>

  <form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
    <?php do_action('woocommerce_before_add_to_cart_button');?>

    <?php
do_action('woocommerce_before_add_to_cart_quantity');

    // woocommerce_quantity_input( array(
    //     'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
    //     'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
    //     'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
    // ) );

    do_action('woocommerce_after_add_to_cart_quantity');
    ?>

    <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>


    <?php do_action('woocommerce_after_add_to_cart_button');?>
  </form>

  <?php do_action('woocommerce_after_add_to_cart_form');?>

<?php endif;
}
