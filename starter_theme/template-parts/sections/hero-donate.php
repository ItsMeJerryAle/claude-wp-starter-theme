<?php
/**
 * Section: Donate Hero — Full-width Ken Burns background with donation widget
 */

$heading     = get_field( 'donate_hero_heading' )  ?: "Donate to\nBridgeWell\nFoundation";
$description = get_field( 'donate_hero_desc' )     ?: 'Your support advances community-wide care. Join the movement toward a healthier, more connected Northern Colorado.';
$btn_text    = get_field( 'donate_hero_btn_text' ) ?: 'Other Ways to Give';
$btn_url     = get_field( 'donate_hero_btn_url' )  ?: '#ways-to-give';
$bg_image    = get_the_post_thumbnail_url( get_the_ID(), 'full' )
               ?: '/wp-content/uploads/2026/03/bridgewell-hero.png';
$form_url      = get_field( 'donate_hero_form_url' )     ?: '#';
$virtuous_url  = get_field( 'donate_hero_virtuous_url' ) ?: '';
?>

<style>
@keyframes tail-kenburns-donate {
    0%   { transform: scale(1)    translate(0%, 0%); }
    100% { transform: scale(1.12) translate(-2%, -1%); }
}
.tail-kenburns-donate {
    animation: tail-kenburns-donate 20s ease-in-out infinite alternate;
    will-change: transform;
}
@keyframes tail-donate-in {
    from { opacity: 0; transform: translateY(28px); }
    to   { opacity: 1; transform: translateY(0); }
}
.donate-animate {
    animation: tail-donate-in 0.7s ease-out both;
}
#donate-modal {
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.25s ease;
}
#donate-modal.is-open {
    opacity: 1;
    pointer-events: auto;
}
#donate-modal-box {
    transform: translateY(20px);
    transition: transform 0.25s ease;
}
#donate-modal.is-open #donate-modal-box {
    transform: translateY(0);
}
</style>

<section class="relative overflow-hidden flex items-center min-h-screen bg-[#203942]">

    <!-- Background: Ken Burns -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="tail-kenburns-donate absolute inset-0 bg-cover bg-[100%_50%] bg-no-repeat"
             <?php if ( $bg_image ) : ?>style="background-image: url('<?php echo esc_url( $bg_image ); ?>');"<?php endif; ?>>
        </div>
    </div>

    <!-- Mobile: bottom gradient -->
    <div class="block md:hidden absolute inset-0 bg-black/40"></div>

    <!-- Desktop: left 50% overlay -->
    <div class="hidden md:block absolute inset-y-0 left-0 w-2/5 bg-[#203942]/80 backdrop-blur-sm"></div>

    <!-- Desktop: bottom gradient fade -->
    <div class="hidden md:block absolute bottom-0 left-0 right-0 h-[400px] bg-gradient-to-t from-[#203942] to-transparent"></div>

    <!-- Content -->
    <div class="relative z-10 w-full max-w-default mx-auto px-4 pb-12 pt-24 md:py-20">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-12">

            <!-- Left: text content (max-w-xl) -->
            <div class="max-w-sm">

                <h1 class="donate-animate font-barlow-condensed font-semibold uppercase text-white leading-none text-[3rem] md:text-[5rem] xl:text-[6rem] tracking-tight mb-6 md:mb-8 mt-8 md:mt-0"
                    style="animation-delay: 0.1s;">
                    <?php echo wp_kses( nl2br( esc_html( trim( $heading ) ) ), array( 'br' => array() ) ); ?>
                </h1>

                <p class="donate-animate font-vollkorn text-white text-lg leading-relaxed mb-8 md:mb-10"
                   style="animation-delay: 0.3s;">
                    <?php echo esc_html( $description ); ?>
                </p>

                <?php if ( $btn_url ) : ?>
                <a href="<?php echo esc_url( $btn_url ); ?>"
                   class="donate-animate bg-primary text-secondary font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-lg px-8 h-12 inline-flex items-center justify-center rounded-lg hover:brightness-110 transition-all"
                   style="animation-delay: 0.5s;">
                    <?php echo esc_html( $btn_text ); ?>
                </a>
                <?php endif; ?>

            </div>

            <!-- Right: donation card -->
            <div class="donate-animate flex-shrink-0 w-full md:w-[520px]"
                 style="animation-delay: 0.4s;">
                <div id="donate-widget"
                     data-form-url="<?php echo esc_attr( $form_url ); ?>"
                     data-virtuous-url="<?php echo esc_attr( $virtuous_url ); ?>"
                     class="bg-secondary/90 backdrop-blur-md rounded-2xl p-8">

                    <!-- Heading -->
                    <h2 class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-white text-3xl mb-6">
                        Choose Your Gift
                    </h2>

                    <!-- Toggle: Monthly / One-Time -->
                    <div class="flex rounded-full border border-white/30 p-1 mb-6">
                        <button type="button" data-tab="monthly"
                                class="donate-tab flex-1 rounded-full font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-base h-10 transition-all">
                            Monthly
                        </button>
                        <button type="button" data-tab="onetime"
                                class="donate-tab flex-1 rounded-full font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-base h-10 transition-all">
                            One-Time
                        </button>
                    </div>

                    <!-- Amount grid -->
                    <div class="grid grid-cols-3 gap-3 mb-6">
                        <?php foreach ( array( '$50', '$100', '$250', '$500', '$1000', 'Custom' ) as $amount ) : ?>
                        <button type="button"
                                data-amount="<?php echo esc_attr( $amount ); ?>"
                                class="donate-amount rounded-full font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-base h-12 border transition-all">
                            <?php echo esc_html( $amount ); ?>
                        </button>
                        <?php endforeach; ?>
                    </div>

                    <!-- Custom amount input -->
                    <div id="donate-custom-wrap" class="hidden mb-6">
                        <div class="relative">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 font-barlow-condensed font-semibold text-white/60 text-lg pointer-events-none">$</span>
                            <input type="number" id="donate-custom-input" min="1" placeholder="Enter amount"
                                   class="w-full bg-transparent border border-white/30 rounded-full pl-9 pr-5 h-12 text-white font-barlow-condensed font-semibold text-lg placeholder-white/40 focus:outline-none focus:border-primary transition-colors">
                        </div>
                    </div>

                    <!-- Donate button -->
                    <button type="button" id="donate-btn"
                            class="block w-full bg-white text-secondary font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-xl h-14 flex items-center justify-center rounded-xl hover:brightness-95 transition-all mb-4">
                        Donate Monthly
                    </button>

                    <!-- SSL notice -->
                    <p class="flex items-center justify-center gap-2 font-vollkorn text-white/60 text-sm">
                        <svg class="w-4 h-4 text-primary flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M20 6 9 17l-5-5"/>
                        </svg>
                        Secure SSL Donation
                    </p>

                </div>
            </div>

        </div>
    </div>

</section>

<!-- Donation Modal -->
<div id="donate-modal" class="fixed inset-0 z-[9999] flex items-center justify-center" role="dialog" aria-modal="true" aria-label="Donation Form">

    <!-- Backdrop -->
    <div id="donate-modal-backdrop" class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>

    <!-- Modal box -->
    <div id="donate-modal-box" class="relative z-10 w-full max-w-2xl mx-4 rounded-2xl overflow-hidden shadow-2xl">

        <!-- Header -->
        <div class="flex items-center justify-between bg-secondary px-6 py-4">
            <h3 id="donate-modal-title" class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-white text-2xl">
                Complete Your Gift
            </h3>
            <button type="button" id="donate-modal-close"
                    class="w-9 h-9 flex items-center justify-center text-white/60 hover:text-white hover:bg-white/10 rounded-lg transition-all"
                    aria-label="Close">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M18 6 6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Virtuous iframe -->
        <iframe id="donate-modal-iframe"
                src=""
                title="Donation Form"
                class="w-full border-0 block"
                style="height: 560px;">
        </iframe>

    </div>
</div>
