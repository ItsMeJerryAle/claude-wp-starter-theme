<?php
/**
 * Block: Hero
 * Registered in: inc/blocks.php
 * ACF fields: hero_heading, hero_subtext, hero_btn1_text, hero_btn1_url, hero_btn2_text, hero_btn2_url, hero_bg_image
 */

$heading   = get_field( 'hero_heading' )   ?: "BRIDGING GAPS.\nBUILDING HOPE.";
$subtext   = get_field( 'hero_subtext' )   ?: 'For many, health feels out of reach. BridgeWell Foundation of Northern Colorado bridges critical gaps in health and wellness, connecting supporters to meaningful impact and neighbors to the care they deserve.';
$btn1_text = get_field( 'hero_btn1_text' ) ?: 'DONATE';
$btn1_url  = get_field( 'hero_btn1_url' )  ?: '#';
$btn2_text = get_field( 'hero_btn2_text' ) ?: 'GET SUPPORT';
$btn2_url  = get_field( 'hero_btn2_url' )  ?: '#';
$bg_image  = get_field( 'hero_bg_image' )  ?: '/wp-content/uploads/2026/03/bridgewell-hero.png';
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

<section class="relative overflow-hidden flex items-end md:items-center min-h-screen bg-secondary">

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
    <div class="relative z-10 w-full max-w-default mx-auto px-4 pb-12 pt-24 md:py-20">
        <div class="max-w-xl">

            <h1 class="hero-animate font-barlow-condensed font-semibold uppercase text-white leading-none text-[3rem] md:text-[5rem] xl:text-[6rem] tracking-tight mb-6 md:mb-8 whitespace-pre-line"
                style="animation-delay: 0.1s;"><?php echo nl2br( esc_html( trim( $heading ) ) ); ?></h1>

            <p class="hero-animate text-white font-vollkorn text-lg leading-relaxed mb-8 md:mb-10"
               style="animation-delay: 0.3s;">
                <?php echo esc_html( $subtext ); ?>
            </p>

            <div class="flex items-center gap-4 flex-wrap">
                <a href="<?php echo esc_url( $btn1_url ); ?>"
                   class="hero-animate bg-primary text-secondary font-barlow-condensed font-semibold leading-none text-lg tracking-tight uppercase px-8 h-12 inline-flex items-center justify-center transition-all hover:brightness-110 rounded-lg"
                   style="animation-delay: 0.5s;">
                    <?php echo esc_html( $btn1_text ); ?>
                </a>
                <a href="<?php echo esc_url( $btn2_url ); ?>"
                   class="hero-animate bg-transparent border border-white rounded-lg text-white font-barlow-condensed font-semibold leading-none text-lg tracking-tight uppercase px-8 h-12 inline-flex items-center justify-center transition-all hover:bg-white hover:text-secondary"
                   style="animation-delay: 0.65s;">
                    <?php echo esc_html( $btn2_text ); ?>
                </a>
            </div>

        </div>
    </div>

</section>
