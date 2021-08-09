<?php

/**
 * Customize the theme customizer
 */
add_action('customize_register', 'nls_fbf_customizer_additions');

function nls_fbf_customizer_additions($wp_customize)
{

  // Add the new Flow Panel
  $panel = $wp_customize->add_panel(
    'nls_fbf_theme_options',
    array(
      //'priority'       => 100,
      'title'            => __('Theme Options', 'nls_fbf'),
      'description'      => __('Theme Modifications for Niloos FBF sites', 'nls_fbf'),
    )
  );

  add_flow_elements_general_section($wp_customize, $panel->id);

  /**
   * Add the Flow elements sections
   */
  for ($i = 1; $i <= NLS_FLOW_ELEMENTS; $i++) {
    add_flow_element_item_section($wp_customize, $panel->id, $i);
  }
}

function add_flow_element_item_section($wp_customize, $panel, $index)
{
  /**
   * Add the new Flow element section
   */
  $section = $wp_customize->add_section('nls_flow_element_' . $index, [
    'title' => __('Flow Element - ', 'nls_fbf') . $index,
    'description' => __('Settings for the flow elements', 'nls_fbf'),
    'panel' => $panel
  ]);

  /**
   * Add the Flow element title
   */
  $wp_customize->add_setting('nls_flow_element_field_title_' . $index, array(
    'default' => '',
    'type' => 'theme_mod',
    'sanitize_callback' => 'our_sanitize_function',
  ));

  /**
   * Add the Flow element title
   */
  $wp_customize->add_control('nls_flow_element_field_title_' . $index, array(
    'label' => __('Title', 'nls_fbf'),
    'section' => $section->id,
    'settings' => 'nls_flow_element_field_title_' . $index,
    'type' => 'text'
  ));

  /**
   * Add the Flow element content
   */
  $wp_customize->add_setting('nls_flow_element_field_content_' . $index, array(
    'default' => '',
    'type' => 'theme_mod',
    'sanitize_callback' => 'our_sanitize_function',
  ));

  /**
   * Add the Flow element content
   */
  $wp_customize->add_control('nls_flow_element_field_content_' . $index, array(
    'label' => __('Content', 'nls_fbf'),
    'section' => $section->id,
    'settings' => 'nls_flow_element_field_content_' . $index,
    'type' => 'text'
  ));
}

function our_sanitize_function($input)
{
  return wp_kses_post(force_balance_tags($input));
}

function add_flow_elements_general_section($wp_customize, $panel)
{
  /**
   * Add the new Flow section
   */
  $section = $wp_customize->add_section('nls_flow_general', [
    'title' => __('Niloos FBF Flow - General', 'nls_fbf'),
    'description' => __('Settings for the flow elements', 'nls_fbf'),
    'panel' => $panel
  ]);

  /**
   * Add the separator image
   */
  $wp_customize->add_setting('nls_flow_element_separete_image', array(
    'default' => '',
    'type' => 'theme_mod',
  ));

  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'nls_flow_element_separete_image',
      array(
        'label' => __('Separator Image', 'nls_fbf'),
        'section' => $section->id,
        'settings' => 'nls_flow_element_separete_image',
      )
    )
  );

  /**
   * Add the separator image size
   */
  $wp_customize->add_setting('nls_flow_element_media_image_size', array(
    'default' => 42,
    'type' => 'theme_mod',
  ));

  $wp_customize->add_control('nls_flow_element_media_image_size', array(
    'label' => __('Separetor image width (px)', 'nls_fbf'),
    'section' => 'nls_flow_general',
    'settings' => 'nls_flow_element_media_image_size',
    'type' => 'number'
  ));
}
