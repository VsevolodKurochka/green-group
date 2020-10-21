<?php
/**
 * Green Group Theme Customizer
 *
 * @package Green_Group
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function greengroup_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'greengroup_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'greengroup_customize_partial_blogdescription',
            )
        );
    }

    $wp_customize->add_section('header', array(
        'title'    => 'Header',
        'priority' => 55
    ));
    $wp_customize->add_setting('header_phone', array(
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'header_phone',
            array(
                'label'      => 'Header phone',
                'section'    => 'header',
                'settings'   => 'header_phone',
                'type'     	 => 'text'
            )
        )
    );

    $wp_customize->add_section('zapier', array(
        'title'    => 'Zapier',
        'priority' => 125
    ));

    $wp_customize->add_setting('zapier__contact_form', array(
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'zapier__contact_form',
            array(
                'label'      => 'Contact Form  Webhook URL',
                'section'    => 'zapier',
                'settings'   => 'zapier__contact_form',
                'type'     	 => 'text'
            )
        )
    );
}


add_action( 'customize_register', 'greengroup_customize_register' );