<?php

/**
 * Page builder by SiteOrigin support
 * @package Ushop
 */

/**
 * Support siteorigin panels
 */
add_theme_support( 'siteorigin-panels', array(
    'title-html' => '<h2 class="title-heading text-center">{{title}}</h2>'
) );

/**
 * @param $widgets
 * @return mixed
 * Ushop So Panel Theme widgets
 */
function ushop_so_panel_theme_widgets($widgets) {
    $ushop_theme_widgets = array(
        'uShop_Widget_Services',
        'uShop_Widget_Trending_Products',
        'uShop_Widget_Category_Filter',
        'uShop_Widget_Category_List',
        'uShop_Widget_Feature_Box',
        'uShop_Widget_Recent_Blog'
    );
    foreach($ushop_theme_widgets as $theme_widget) {
        if( isset( $widgets[$theme_widget] ) ) {
            $widgets[$theme_widget]['groups'] 	= array('ushop-theme');
            $widgets[$theme_widget]['icon'] 	= 'dashicons dashicons-align-none';
        }
    }
    return $widgets;
}
add_filter('siteorigin_panels_widgets', 'ushop_so_panel_theme_widgets');

/* Add a tab for the theme widgets in the page builder */
function ushop_so_panel_theme_widgets_tab($tabs){
    $tabs[] = array(
        'title' => __('Ushop Theme', 'ushop'),
        'filter' => array(
            'groups' => array('ushop-theme')
        )
    );
    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'ushop_so_panel_theme_widgets_tab', 20);

/**
 * Theme Widgets
 */
$ushop_theme_widgets = array(
    'widget-services',
    'widget-treading-products',
    'widget-category-filter',
    'widget-category-list',
    'widget-category-list',
    'widget-feature-box',
    'widget-recent-blog'
);

$template_dir = get_template_directory();

foreach ( $ushop_theme_widgets as $widget ) {
    require_once $template_dir . '/inc/widgets/' . $widget . '.php';
}