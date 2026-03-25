<?php
/**
 * Main template fallback.
 * WordPress requires this file to recognise the theme.
 */
get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        the_content();
    endwhile;
endif;

get_footer();
