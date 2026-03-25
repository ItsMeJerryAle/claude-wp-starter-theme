<?php
/**
 * Template Name: Donate Page
 *
 * Sections: Support CTA columns only.
 * Add or remove get_template_part() calls to include other sections.
 */

get_header();
?>

<?php get_template_part( 'template-parts/sections/hero-donate' ); ?>
<?php get_template_part( 'template-parts/sections/ways-to-give' ); ?>
<?php get_template_part( 'template-parts/sections/impact-section' ); ?>
<?php get_template_part( 'template-parts/sections/cta-contact' ); ?>

<?php get_footer(); ?>
