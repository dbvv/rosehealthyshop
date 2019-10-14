<?php

add_action('customize_register', 'rhs_customizer_settings');

function rhs_customizer_settings($wp_customize)
{
  $wp_customize->add_setting('rules_page', array());

  $wp_customize->add_control('rules_page', array(
    'section' => 'static_front_page',
    'label'   => __('Правила и условия'),
    'type'    => 'dropdown-pages',
  ));
}
