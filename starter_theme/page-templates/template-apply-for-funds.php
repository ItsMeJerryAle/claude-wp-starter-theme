<?php
/**
 * Template Name: Apply for Funds
 * Specific to: /services/apply-for-funds/
 * Sections: Breadcrumb → Page Hero (heading + description)
 */

get_header();

$heading     = get_field( 'apply_funds_heading' )     ?: 'APPLY FOR FUNDS';
$description = get_field( 'apply_funds_description' ) ?: '';
?>

<!-- ── Breadcrumb ──────────────────────────────────────────────────────────── -->
<div class="bg-surface" style="padding-top: var(--header-h, 72px);">
    <div class="max-w-default mx-auto px-4 py-3 flex items-center gap-2 font-barlow-condensed font-semibold uppercase text-sm leading-none tracking-tight text-secondary/60">

        <!-- Home -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
           class="hover:text-secondary transition-colors flex-shrink-0"
           aria-label="Home">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
        </a>

        <?php
        // Build ancestor chain
        $ancestors = array_reverse( get_post_ancestors( get_the_ID() ) );
        foreach ( $ancestors as $ancestor_id ) :
        ?>
            <span class="opacity-40">|</span>
            <a href="<?php echo esc_url( get_permalink( $ancestor_id ) ); ?>"
               class="hover:text-secondary transition-colors">
                <?php echo esc_html( get_the_title( $ancestor_id ) ); ?>
            </a>
        <?php endforeach; ?>

        <!-- Current page -->
        <span class="opacity-40">|</span>
        <span class="text-accent"><?php the_title(); ?></span>

    </div>
</div>

<!-- ── Page Hero ───────────────────────────────────────────────────────────── -->
<section class="bg-white py-16">
    <div class="max-w-default mx-auto px-4">

        <h1 data-animate data-delay="0"
            class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-forest text-5xl xl:text-6xl mb-6">
            <?php echo esc_html( $heading ); ?>
        </h1>

        <?php if ( $description ) : ?>
        <p data-animate data-delay="100"
           class="font-vollkorn text-secondary text-base leading-relaxed max-w-2xl">
            <?php echo esc_html( $description ); ?>
        </p>
        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>
