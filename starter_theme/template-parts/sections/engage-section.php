<?php
/**
 * Engage Section — Get Involved Page
 *
 * Top row (3-col):
 *   Col 1 & 2 — image cards (title, description, arrow link)
 *   Col 3     — two stacked mini cards (title, description, arrow link)
 * Bottom row (2-col):
 *   Col 1 — CTA text card (eyebrow, title, desc, outline button)
 *   Col 2 — image card
 */

$eyebrow     = get_field( 'engage_eyebrow' )     ?: 'Ways to Engage';
$heading     = get_field( 'engage_heading' )     ?: 'Business & Organization Partnerships';
$description = get_field( 'engage_description' ) ?: '';

$card1_image = get_field( 'engage_card1_image' )   ?: '';
$card1_title = get_field( 'engage_card1_title' )   ?: 'Corporate Sponsorships';
$card1_desc  = get_field( 'engage_card1_desc' )    ?: '';
$card1_url   = get_field( 'engage_card1_url' )     ?: '#';

$card2_image = get_field( 'engage_card2_image' )   ?: '';
$card2_title = get_field( 'engage_card2_title' )   ?: 'Community Partners';
$card2_desc  = get_field( 'engage_card2_desc' )    ?: '';
$card2_url   = get_field( 'engage_card2_url' )     ?: '#';

$mini1_title = get_field( 'engage_mini1_title' )   ?: 'Fund Our Work';
$mini1_desc  = get_field( 'engage_mini1_desc' )    ?: '';
$mini1_url   = get_field( 'engage_mini1_url' )     ?: '#';

$mini2_title = get_field( 'engage_mini2_title' )   ?: 'For Professional Advisors';
$mini2_desc  = get_field( 'engage_mini2_desc' )    ?: '';
$mini2_url   = get_field( 'engage_mini2_url' )     ?: '#';

$cta_eyebrow = get_field( 'engage_cta_eyebrow' )   ?: 'Have Questions?';
$cta_title   = get_field( 'engage_cta_title' )     ?: 'Partnership Opportunities';
$cta_desc    = get_field( 'engage_cta_desc' )      ?: '';
$cta_btn_text= get_field( 'engage_cta_btn_text' )  ?: 'Contact Us';
$cta_btn_url = get_field( 'engage_cta_btn_url' )   ?: '#';

$bottom_image= get_field( 'engage_bottom_image' )  ?: '';

// SVG arrow
$arrow_svg = '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>';
?>

<section class="bg-secondary py-16">
    <div class="max-w-default mx-auto px-4">

        <!-- ── Section Header ──────────────────────────────────────────────── -->
        <div data-animate data-delay="0" class="mb-10">
            <p class="font-barlow-condensed font-semibold uppercase text-accent text-[22px] leading-none tracking-tight mb-2">
                <?php echo esc_html( $eyebrow ); ?>
            </p>
            <h2 class="font-barlow-condensed font-semibold uppercase text-surface leading-none text-5xl xl:text-6xl tracking-tight mb-4">
                <?php echo esc_html( $heading ); ?>
            </h2>
            <?php if ( $description ) : ?>
            <p class="font-vollkorn text-white/70 text-lg leading-relaxed max-w-xl">
                <?php echo esc_html( $description ); ?>
            </p>
            <?php endif; ?>
        </div>

        <!-- ── Top Row ─────────────────────────────────────────────────────── -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

            <!-- Image Card 1 -->
            <a href="<?php echo esc_url( $card1_url ); ?>"
               data-animate data-delay="0"
               class="group relative rounded-2xl overflow-hidden min-h-[520px] flex flex-col justify-start"
               style="<?php if ( $card1_image ) echo 'background-image:url(' . esc_url( $card1_image ) . ');background-size:cover;background-position:center;'; else echo 'background-color:#2d4a35;'; ?>">
                <div class="absolute inset-0 bg-gradient-to-b from-[#203942] to-transparent"></div>
                <div class="relative z-10 md:max-w-xs p-6">
                    <h3 class="font-barlow-condensed font-semibold uppercase text-white leading-none text-5xl tracking-tight mb-2">
                        <?php echo esc_html( $card1_title ); ?>
                    </h3>
                    <?php if ( $card1_desc ) : ?>
                    <p class="font-vollkorn text-white text-lg leading-relaxed"><?php echo esc_html( $card1_desc ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="absolute bottom-5 right-5 z-10 w-12 h-12 bg-primary rounded-full flex items-center justify-center text-secondary transition-all group-hover:brightness-110 group-hover:scale-105">
                    <?php echo $arrow_svg; ?>
                </div>
            </a>

            <!-- Image Card 2 -->
            <a href="<?php echo esc_url( $card2_url ); ?>"
               data-animate data-delay="100"
               class="group relative rounded-2xl overflow-hidden min-h-[520px] flex flex-col justify-start"
               style="<?php if ( $card2_image ) echo 'background-image:url(' . esc_url( $card2_image ) . ');background-size:cover;background-position:center;'; else echo 'background-color:#2d4a35;'; ?>">
                <div class="absolute inset-0 bg-gradient-to-b from-[#203942] to-transparent"></div>
                <div class="relative z-10 md:max-w-xs p-6">
                    <h3 class="font-barlow-condensed font-semibold uppercase text-white leading-none text-5xl tracking-tight mb-2">
                        <?php echo esc_html( $card2_title ); ?>
                    </h3>
                    <?php if ( $card2_desc ) : ?>
                    <p class="font-vollkorn text-white text-lg leading-relaxed"><?php echo esc_html( $card2_desc ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="absolute bottom-5 right-5 z-10 w-12 h-12 bg-primary rounded-full flex items-center justify-center text-secondary transition-all group-hover:brightness-110 group-hover:scale-105">
                    <?php echo $arrow_svg; ?>
                </div>
            </a>

            <!-- Col 3: Two stacked mini cards -->
            <div class="flex flex-col gap-6" data-animate data-delay="200">

                <a href="<?php echo esc_url( $mini1_url ); ?>"
                   class="group relative bg-forest rounded-2xl p-6 flex flex-col justify-between flex-1 min-h-[190px] hover:brightness-110 transition-all">
                    <div>
                        <h3 class="font-barlow-condensed font-semibold uppercase text-primary leading-none text-[32px] tracking-tight mb-3">
                            <?php echo esc_html( $mini1_title ); ?>
                        </h3>
                        <?php if ( $mini1_desc ) : ?>
                        <p class="font-vollkorn text-white text-lg leading-relaxed"><?php echo esc_html( $mini1_desc ); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="self-end w-10 h-10 bg-leaf rounded-full flex items-center justify-center text-white mt-4 group-hover:scale-105 transition-all">
                        <?php echo $arrow_svg; ?>
                    </div>
                </a>

                <a href="<?php echo esc_url( $mini2_url ); ?>"
                   class="group relative bg-forest rounded-2xl p-6 flex flex-col justify-between flex-1 min-h-[190px] hover:brightness-110 transition-all">
                    <div>
                        <h3 class="font-barlow-condensed font-semibold uppercase text-primary leading-none text-[32px] tracking-tight mb-3">
                            <?php echo esc_html( $mini2_title ); ?>
                        </h3>
                        <?php if ( $mini2_desc ) : ?>
                        <p class="font-vollkorn text-white text-lg leading-relaxed"><?php echo esc_html( $mini2_desc ); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="self-end w-10 h-10 bg-leaf rounded-full flex items-center justify-center text-white mt-4 group-hover:scale-105 transition-all">
                        <?php echo $arrow_svg; ?>
                    </div>
                </a>

            </div>

        </div>

        <!-- ── Bottom Row ──────────────────────────────────────────────────── -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- CTA Card -->
            <div data-animate data-delay="0"
                 class="bg-forest rounded-2xl px-8 py-12 flex flex-col md:flex-row md:items-stretch md:justify-between gap-6 md:gap-8">
                <div>
                    <p class="font-barlow-condensed font-semibold uppercase text-surface text-[22px] leading-none tracking-tight mb-2">
                        <?php echo esc_html( $cta_eyebrow ); ?>
                    </p>
                    <h3 class="font-barlow-condensed font-semibold uppercase text-white leading-none text-5xl tracking-tight mb-4">
                        <?php echo esc_html( $cta_title ); ?>
                    </h3>
                    <?php if ( $cta_desc ) : ?>
                    <p class="font-vollkorn text-white text-sm leading-relaxed"><?php echo esc_html( $cta_desc ); ?></p>
                    <?php endif; ?>
                </div>
                <?php if ( $cta_btn_url && $cta_btn_text ) : ?>
                <a href="<?php echo esc_url( $cta_btn_url ); ?>"
                    class="self-start md:self-end flex-shrink-0 bg-secondary/30 border border-white rounded-lg text-white font-barlow-condensed font-semibold leading-none text-lg tracking-tight uppercase px-6 h-12 inline-flex items-center justify-center transition-all hover:bg-secondary hover:text-white">
                    <?php echo esc_html( $cta_btn_text ); ?>
                </a>
                <?php endif; ?>
            </div>

            <!-- Bottom image card -->
            <div data-animate data-delay="100"
                 class="relative rounded-2xl overflow-hidden min-h-[280px]"
                 style="<?php if ( $bottom_image ) echo 'background-image:url(' . esc_url( $bottom_image ) . ');background-size:cover;background-position:center;'; else echo 'background-color:#4E612C;'; ?>">
            </div>

        </div>

    </div>
</section>
