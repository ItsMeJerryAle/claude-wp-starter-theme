<?php
/**
 * Section: CTA Contact — Full-width image banner with heading, description, and CTA button
 */

$heading   = get_field( 'cta_contact_heading' )  ?: "Questions\nAbout Giving?";
$desc      = get_field( 'cta_contact_desc' )      ?: 'Our team is available to help answer your questions about giving and support.';
$btn_text  = get_field( 'cta_contact_btn_text' )  ?: 'Contact Us';
$btn_url   = get_field( 'cta_contact_btn_url' );
$bg_image  = get_field( 'cta_contact_bg_image' );
?>

<section class="relative overflow-hidden min-h-[420px] md:min-h-[480px] flex items-stretch"
         <?php if ( $bg_image ) : ?>style="background-image: url('<?php echo esc_url( $bg_image ); ?>'); background-size: cover; background-position: center;"<?php endif; ?>>

    <!-- Gradient overlay — left to transparent -->
    <div class="absolute inset-0" style="background: linear-gradient(69.72deg, rgba(27, 21, 3, 0.8) 10.95%, rgba(0, 0, 0, 0) 80.51%);"></div>

    <!-- Content: 70/30 two-column layout -->
    <div data-animate data-delay="0" class="relative z-10 w-full max-w-default mx-auto px-4 flex flex-col md:flex-row md:items-end gap-6 pb-32 pt-48">

        <!-- Left 70%: Heading + Description -->
        <div class="w-[80%] md:w-[70%] ">
            <h2 class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-surface mb-6 text-[50px] md:text-[144px]">
                <?php echo wp_kses( nl2br( esc_html( trim( $heading ) ) ), array( 'br' => array() ) ); ?>
            </h2>
            <p class="font-vollkorn text-white text-2xl leading-relaxed max-w-lg">
                <?php echo esc_html( $desc ); ?>
            </p>
        </div>

        <!-- Right 30%: Button aligned to bottom -->
        <?php if ( $btn_url ) : ?>
            <div class="w-auto md:w-[30%] flex justify-start md:justify-end">
                <a href="<?php echo esc_url( $btn_url ); ?>"
                   class="bg-primary text-secondary font-barlow-condensed font-semibold leading-none text-lg tracking-tight uppercase px-6 h-12 inline-flex items-center justify-center transition-all hover:brightness-110 rounded-lg">
                    <?php echo esc_html( $btn_text ); ?>
                </a>
            </div>
        <?php endif; ?>

    </div>

</section>
