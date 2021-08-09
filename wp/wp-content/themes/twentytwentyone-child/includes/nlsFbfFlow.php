<?php

/**
 * Returns a custom logo, linked to home unless the theme supports removing the link on the home page.
 *
 * @return string Custom logo markup.
 */

// [nls-fbf-flow numberElements=""] shortcode

function nls_fbf_flow($atts)
{
  $a = shortcode_atts(array(
    'num' => NLS_FLOW_ELEMENTS
  ), $atts);
  $numberElements = $a['num'];

  $separete_image = get_theme_mod('nls_flow_element_separete_image');
  $image_size = get_theme_mod('nls_flow_element_media_image_size');

  $html = '<section class="nls-fbf-flow-wrapper nls-main-row">';

  for ($index = 1; $index <= $numberElements; $index++) {
    $title = get_theme_mod('nls_flow_element_field_title_' . $index);
    $content = get_theme_mod('nls_flow_element_field_content_' . $index);

    $html .= elementDesign($title, $content);
    $html .= $index < $numberElements ? '<img width="' . $image_size . '" src="' . $separete_image . '" role="presentation" />' : '';
  }

  $html .= '</section>';

  return $html;
}

function elementDesign($title, $content)
{
  $html =  '<div class="flow-element-card">';
  $html .= ' <h3 class="flow-element-title">' . $title . '</h3>';
  $html .= ' <p class="flow-element-content">' . $content . '</p>';
  $html .= '</div>';

  return $html;
}

add_shortcode('nls_fbf_flow', 'nls_fbf_flow');
