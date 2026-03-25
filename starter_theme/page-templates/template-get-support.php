<?php
/**
 * Template Name: Get Support Page
 */

get_header();

get_template_part( 'template-parts/sections/hero-inner', null, array(
    'heading'     => get_field( 'hero_gs_heading' )     ?: "FIND THE\nSUPPORT YOU\nNEED",
    'description' => get_field( 'hero_gs_description' ) ?: '',
    'btn_text'    => get_field( 'hero_gs_btn_text' )    ?: 'Apply for Funds',
    'btn_url'     => get_field( 'hero_gs_btn_url' )     ?: '#',
) );

get_template_part( 'template-parts/sections/services-section' );
get_template_part( 'template-parts/sections/application-process', null, array(
    'eyebrow'  => get_field( 'app_eyebrow' )  ?: 'What to Expect',
    'heading'  => get_field( 'app_heading' )  ?: 'Application Process',
    'btn_text' => get_field( 'app_btn_text' ) ?: '',
    'btn_url'  => get_field( 'app_btn_url' )  ?: '',
    'steps'    => get_field( 'app_steps' )    ?: array(),
    'theme'    => 'light',
) );
get_template_part( 'template-parts/sections/cta-contact' );

get_footer();
