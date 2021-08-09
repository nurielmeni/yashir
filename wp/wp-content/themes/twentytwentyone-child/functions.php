<?php
include_once 'includes/customizerAdjustments.php';
include_once 'includes/nlsFbfFlow.php';

const NLS_FLOW_ELEMENTS = 3;

/**
 * Add child theme styles
 */
add_action('wp_enqueue_scripts', 'nls_fbf_theme_enqueue_styles', 20);

function nls_fbf_theme_enqueue_styles()
{
    $parent_style = 'twenty-twenty-one-style';

    wp_enqueue_style(
        'child-style',
        get_stylesheet_directory_uri() . '/style-rtl.css',
        array($parent_style),
        wp_get_theme()->get('Version')
    );
}


/**
 * Add child theme translations
 */
/**
 * Loads the child theme textdomain.
 */
function nls_fbf_child_theme_setup()
{
    load_child_theme_textdomain('nls_fbf', get_stylesheet_directory() . '/languages/');
}
add_action('after_setup_theme', 'nls_fbf_child_theme_setup');

/**
 * Returns a custom logo, linked to home unless the theme supports removing the link on the home page.
 *
 * @return string Custom logo markup.
 */
function get_footer_logo()
{
    $html          = '';

    $custom_logo_id = get_theme_mod('nls_fbf_footer_logo');

    $html .= '<a href="/" class="nls-fbf-footer-logo">';
    $html .= '<img width="250" src="' . $custom_logo_id . '" class="custom-logo footer" alt="Fenix footer logo" />';
    $html .= '</a>';

    return $html;
}
