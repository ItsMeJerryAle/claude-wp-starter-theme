<?php
/**
 * Template Name: Full Page (All Sections)
 *
 * Use this template for pages that need the full set of content sections:
 * Services, Story, Impact, Events, Resources, Partners, Support.
 */

get_header();
?>

<?php get_template_part( 'template-parts/sections/services-section' ); ?>
<?php get_template_part( 'template-parts/sections/story-section' ); ?>
<?php get_template_part( 'template-parts/sections/impact-section' ); ?>
<?php get_template_part( 'template-parts/sections/events-section' ); ?>
<?php get_template_part( 'template-parts/sections/resources-section' ); ?>
<?php get_template_part( 'template-parts/sections/partners-section' ); ?>
<?php get_template_part( 'template-parts/sections/support-section' ); ?>

<?php get_footer(); ?>
