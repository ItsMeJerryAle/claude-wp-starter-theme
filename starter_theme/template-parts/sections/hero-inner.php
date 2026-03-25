<?php
/**
 * Hero Section — Inner Pages
 * Reusable Ken Burns + left-overlay hero for any inner page template.
 * Data is passed via get_template_part() $args — no direct ACF calls here.
 *
 * Expected $args keys:
 *   heading     (string) — supports \n for line breaks
 *   description (string)
 *   btn_text    (string)
 *   btn_url     (string)
 *
 * Background image is sourced automatically from the page's Featured Image.
 * Set a Featured Image on the page — no ACF field needed.
 */

$heading        = $args['heading']        ?? '';
$description    = $args['description']    ?? '';
$btn_text       = $args['btn_text']       ?? 'Learn More';
$btn_url        = $args['btn_url']        ?? '#';
$rounded_bottom  = $args['rounded_bottom']  ?? false;
$items_start     = $args['items_start']     ?? false;
$bg_image    = get_the_post_thumbnail_url( get_the_ID(), 'full' )
               ?: '/wp-content/uploads/2026/03/bridgewell-hero.png';
?>

<style>
@keyframes tail-kenburns {
    0%   { transform: scale(1)    translate(0%, 0%); }
    100% { transform: scale(1.12) translate(-2%, -1%); }
}
.tail-kenburns {
    animation: tail-kenburns 20s ease-in-out infinite alternate;
    will-change: transform;
}
@keyframes tail-hero-in {
    from { opacity: 0; transform: translateY(28px); }
    to   { opacity: 1; transform: translateY(0); }
}
.hero-animate {
    animation: tail-hero-in 0.7s ease-out both;
}
</style>

<section class="relative overflow-hidden flex items-end <?php echo $items_start ? 'md:items-start' : 'md:items-center'; ?> min-h-screen bg-secondary<?php echo $rounded_bottom ? ' rounded-b-[40px]' : ''; ?>">

    <!-- ── Background ────────────────────────────────────────────────────── -->
    <div class="absolute top-0 inset-x-0 h-[75vh] md:inset-0 md:h-auto overflow-hidden">
        <div class="tail-kenburns absolute inset-0 bg-cover bg-[75%_50%] bg-no-repeat"
             style="background-image: url('<?php echo esc_url( $bg_image ); ?>');">
        </div>
    </div>

    <!-- ── Mobile: bottom gradient overlay ──────────────────────────────── -->
    <div class="block md:hidden absolute inset-0"
         style="background: linear-gradient(to top, #203942 30%, rgba(32,57,66,0.2) 40%, transparent 100%);"></div>

    <!-- ── Desktop: left 50% overlay ────────────────────────────────────── -->
    <div class="hidden md:block absolute inset-y-0 left-0 w-1/2 bg-secondary/80 backdrop-blur-sm"></div>

    <!-- ── Desktop: bottom gradient fade ────────────────────────────────── -->
    <div class="hidden md:block absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-secondary to-transparent"></div>

    <!-- ── Content ───────────────────────────────────────────────────────── -->
    <div class="relative z-10 w-full max-w-default mx-auto px-4 pb-12 md:pb-20 md:mt-12"
         style="padding-top: max(6rem, calc(var(--header-h, 6rem) + 2rem));"
    >
        <div class="max-w-xl">

            <?php if ( $heading ) : ?>
            <h1 class="hero-animate font-barlow-condensed font-semibold uppercase text-white leading-none text-[3rem] md:text-[5rem] xl:text-[6rem] tracking-tight mb-6 md:mb-8 whitespace-pre-line"
                style="animation-delay: 0.1s;"><?php echo esc_html( trim( $heading ) ); ?></h1>
            <?php endif; ?>

            <?php if ( $description ) : ?>
            <p class="hero-animate font-vollkorn text-white text-lg leading-relaxed mb-8 md:mb-10"
               style="animation-delay: 0.3s;">
                <?php echo esc_html( $description ); ?>
            </p>
            <?php endif; ?>

            <?php if ( $btn_url && $btn_text ) : ?>
            <a href="<?php echo esc_url( $btn_url ); ?>"
               class="hero-animate bg-primary text-secondary font-barlow-condensed font-semibold leading-none text-lg tracking-tight uppercase px-8 h-12 inline-flex items-center justify-center transition-all hover:brightness-110 rounded-lg"
               style="animation-delay: 0.5s;">
                <?php echo esc_html( $btn_text ); ?>
            </a>
            <?php endif; ?>

        </div>
    </div>

</section>
