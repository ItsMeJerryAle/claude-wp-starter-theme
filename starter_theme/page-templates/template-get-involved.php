<?php
/**
 * Template Name: Get Involved Page
 *
 * Sections (in order): hero → services → engage → partners → impact → cta-contact
 */

get_header();

get_template_part( 'template-parts/sections/hero-inner', null, array(
    'heading'     => get_field( 'hero_gi_heading' )     ?: "GET\nINVOLVED",
    'description' => get_field( 'hero_gi_description' ) ?: '',
    'btn_text'    => get_field( 'hero_gi_btn_text' )    ?: 'Donate Now',
    'btn_url'     => get_field( 'hero_gi_btn_url' )     ?: '#',
) );

get_template_part( 'template-parts/sections/services-section' );
get_template_part( 'template-parts/sections/engage-section' );
get_template_part( 'template-parts/sections/partners-section' );
get_template_part( 'template-parts/sections/impact-section' );
get_template_part( 'template-parts/sections/cta-contact' );

get_footer();
