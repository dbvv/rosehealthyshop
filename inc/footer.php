<?php

function storefront_credit() {
  $links_output = '';

  if ( apply_filters( 'storefront_credit_link', true ) ) {
    $rules_permalink = get_permalink( get_theme_mod('rules_page') );
    $links_output .= '<a href="' . $rules_permalink . '" target="_blank" title="' . esc_attr__( 'Правила и условия', 'storefront' ) . '" rel="author">' . esc_html__( 'Правила и условия', 'storefront' ) . '</a>.';
  }

  if ( apply_filters( 'storefront_privacy_policy_link', true ) && function_exists( 'the_privacy_policy_link' ) ) {
    $separator = '<span role="separator" aria-hidden="true"></span>';
    $links_output = get_the_privacy_policy_link( '', ( ! empty( $links_output ) ? $separator : '' ) ) . $links_output;
  }
  
  $links_output = apply_filters( 'storefront_credit_links_output', $links_output );
  ?>
  <div class="site-info">
    <?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ) ); ?>

    <?php if ( ! empty( $links_output ) ) { ?>
      <br />
      <?php echo wp_kses_post( $links_output ); ?>
    <?php } ?>
  </div><!-- .site-info -->
  <?php
}

add_filter('storefront_handheld_footer_bar_links', 'rhs_storefront_handheld_footer_bar_links');

function rhs_storefront_handheld_footer_bar_links($links) {
  $links['search']['callback'] = 'rhs_home_link';
  return $links;
}

function rhs_storefront_handheld_footer_bar_search() {
  echo '<a href="">' . esc_attr__( 'Search', 'storefront' ) . '</a>';
  storefront_product_search();
}

function rhs_home_link() {
  echo '<a href="/"></a>';
}