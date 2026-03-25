<?php
/**
 * Section: Support — Hero statement + two CTA columns
 */

$heading     = get_field( 'support_heading' )     ?: "Support\nAnd Care\nStart Here.";
$description = get_field( 'support_description' ) ?: "Whether you're donating, volunteering, or seeking help, BridgeWell connects you to meaningful opportunities for purpose and support.";

$left_title    = get_field( 'support_left_title' )    ?: 'Donate';
$left_desc     = get_field( 'support_left_desc' )     ?: 'For those who want to help expand access to care and community support.';
$left_btn_text = get_field( 'support_left_btn_text' ) ?: 'Donate Today';
$left_btn_url  = get_field( 'support_left_btn_url' );

$right_title    = get_field( 'support_right_title' )    ?: 'Get Support';
$right_desc     = get_field( 'support_right_desc' )     ?: 'Grants for local programs in Northern Colorado';
$right_btn_text = get_field( 'support_right_btn_text' ) ?: 'Explore Support';
$right_btn_url  = get_field( 'support_right_btn_url' );
?>

<section class="bg-white pt-20 relative overflow-hidden">

    <!-- Decorative Logo — full section height, right side -->
    <img src="/wp-content/uploads/2026/03/bridgewell-asset-logo.svg"
         alt=""
         aria-hidden="true"
         class="absolute right-0 top-0 h-full w-auto max-w-[55%] opacity-40 pointer-events-none select-none">

    <!-- Suppress heading line-breaks on mobile -->
    <style>.support-heading br { display: none; } @media (min-width: 768px) { .support-heading br { display: block; } }</style>

    <!-- Top: Heading + Description (constrained) -->
    <div data-animate data-delay="0" class="max-w-default mx-auto px-4 relative z-10 mb-12 md:mb-20">
        <h2 class="support-heading font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-forest mb-6 md:mb-8 text-[56px] md:text-[9rem]">
            <?php echo wp_kses( nl2br( esc_html( trim( $heading ) ) ), array( 'br' => array() ) ); ?>
        </h2>
        <p class="font-vollkorn text-secondary text-lg leading-relaxed max-w-md">
            <?php echo esc_html( $description ); ?>
        </p>
    </div>

    <!-- Bottom Row: Full-width CTA columns -->
    <div class="relative z-10 backdrop-blur-md grid grid-cols-1 md:grid-cols-2" style="background: rgba(255,255,255,0.55);">

        <!-- Left CTA -->
        <div data-animate data-delay="0"
             class="border-t border-white md:border md:border-white px-6 py-10 md:px-32 md:py-16 flex flex-col justify-center items-start"
             style="box-shadow: rgba(204, 219, 232, 0.3) 3px 3px 8px 0px inset, rgba(255, 255, 255, 0.3) -3px -3px 8px 1px inset;">
            <h3 class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-forest text-4xl md:text-5xl mb-4">
                <?php echo esc_html( $left_title ); ?>
            </h3>
            <p class="font-vollkorn text-secondary text-lg leading-relaxed mb-6">
                <?php echo esc_html( $left_desc ); ?>
            </p>
            <?php if ( $left_btn_url ) : ?>
                <a href="<?php echo esc_url( $left_btn_url ); ?>"
                   class="bg-primary text-secondary font-barlow-condensed font-semibold leading-none text-lg tracking-tight uppercase px-6 h-12 inline-flex items-center justify-center transition-all hover:brightness-110 rounded-lg">
                    <?php echo esc_html( $left_btn_text ); ?>
                </a>
            <?php endif; ?>
        </div>

        <!-- Right CTA -->
        <div data-animate data-delay="150"
             class="border-t border-white md:border md:border-white px-6 py-10 md:px-32 md:py-16 flex flex-col justify-center items-start"
             style="box-shadow: rgba(204, 219, 232, 0.3) 3px 3px 8px 0px inset, rgba(255, 255, 255, 0.3) -3px -3px 8px 1px inset;">
            <h3 class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-forest text-4xl md:text-5xl mb-4">
                <?php echo esc_html( $right_title ); ?>
            </h3>
            <p class="font-vollkorn text-secondary text-lg leading-relaxed mb-6">
                <?php echo esc_html( $right_desc ); ?>
            </p>
            <?php if ( $right_btn_url ) : ?>
                <a href="<?php echo esc_url( $right_btn_url ); ?>"
                   class="bg-primary text-secondary font-barlow-condensed font-semibold leading-none text-lg tracking-tight uppercase px-6 h-12 inline-flex items-center justify-center transition-all hover:brightness-110 rounded-lg">
                    <?php echo esc_html( $right_btn_text ); ?>
                </a>
            <?php endif; ?>
        </div>

    </div>

</section>
