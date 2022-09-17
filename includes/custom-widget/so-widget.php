<?php
/**
 * Hooks for site origin.
 *
 * This file contains hook functions attached to core hooks of site origin bundle.
 *
 * @package ushop
 */

if ( ! function_exists( 'ushop_add_tab_in_builer_widgets_panel' ) ) :

    /**
     * Add tab in builder widgets section.
     *
     * @since 1.0.0
     *
     * @param array $tabs Tabs.
     * @return array Modified tabs.
     */
    function ushop_add_tab_in_builer_widgets_panel( $tabs ) {
        $tabs['ushop'] = array(
            'title'  => __( 'uShop Widgets', 'ushop' ),
            'filter' => array(
                'groups' => array( 'ushop' ),
            ),
        );
        return $tabs;
    }
endif;
add_filter( 'siteorigin_panels_widget_dialog_tabs', 'ushop_add_tab_in_builer_widgets_panel' );

if ( ! function_exists( 'ushop_group_theme_widgets_in_builder' ) ) :

    /**
     * Grouping theme widgets in builder.
     *
     * @since 1.0.0
     *
     * @param array $widgets Widgets array.
     * @return array Modified widgets array.
     */
    function ushop_group_theme_widgets_in_builder( $widgets ) {
        if ( isset( $GLOBALS['wp_widget_factory'] ) && ! empty( $GLOBALS['wp_widget_factory']->widgets ) ) {
            $all_widgets = array_keys( $GLOBALS['wp_widget_factory']->widgets );
            foreach ( $all_widgets as $widget ) {
                if ( false !== strpos( $widget, 'uShop_' ) ) {
                    $widgets[ $widget ]['groups'] = array( 'ushop' );
                    $widgets[ $widget ]['icon']   = 'dashicons dashicons-align-none';
                }
            }
        }
        return $widgets;
    }
endif;
add_filter( 'siteorigin_panels_widgets', 'ushop_group_theme_widgets_in_builder' );
if ( ! function_exists( 'ushop_customize_so_widgets_status' ) ) :

    /**
     * Customize to make widgets active.
     *
     * @since 1.0.0
     *
     * @param array $active Array of widgets.
     * @return array Modified array.
     */
    function ushop_customize_so_widgets_status( $active ) {
        $active['so-google-map-widget']  = true;
        $active['google-map']            = true;

        return $active;
    }
endif;

add_filter( 'siteorigin_widgets_active_widgets', 'ushop_customize_so_widgets_status' );