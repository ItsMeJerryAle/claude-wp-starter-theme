<?php
/**
 * Story Section
 * Two action cards + full-width testimonial image block.
 * Reusable across any page — fields registered on post_type == page.
 */

// ── Cards ─────────────────────────────────────────────────────────────────────
$card1_title = get_field( 'story_card1_title' ) ?: 'GET SUPPORT';
$card1_body  = get_field( 'story_card1_body' )  ?: 'Explore financial assistance and grant opportunities for individuals, nonprofits, and community partners.';
$card1_url   = get_field( 'story_card1_url' )   ?: '#';

$card2_title = get_field( 'story_card2_title' ) ?: 'GET INVOLVED';
$card2_body  = get_field( 'story_card2_body' )  ?: 'Strengthen health across Northern Colorado by making a donation, volunteering your time, attending events, or becoming a sponsor.';
$card2_url   = get_field( 'story_card2_url' )   ?: '#';

// ── Testimonial ───────────────────────────────────────────────────────────────
$quote      = get_field( 'story_testimonial_quote' ) ?: '"When I reached out to the Foundation, it was like an outpouring of love. They gave us hope."';
$name       = get_field( 'story_testimonial_name' )  ?: 'VALERIE';
$role       = get_field( 'story_testimonial_role' )  ?: 'RECIPIENT & MOTHER OF CALEB';
$image      = get_field( 'story_testimonial_image' ) ?: '';
$link_text  = get_field( 'story_testimonial_link_text' ) ?: 'READ FULL STORY';
$link_url   = get_field( 'story_testimonial_link_url' )  ?: '#';
?>

<section class="bg-secondary py-16">
    <div class="max-w-default mx-auto px-4">

        <!-- ── Two Action Cards ────────────────────────────────────────────── -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

            <!-- Card 1 -->
            <a href="<?php echo esc_url( $card1_url ); ?>"
               data-animate data-delay="0"
               class="group flex flex-row items-center justify-between md:flex-col md:justify-between md:items-stretch border-[0.5px] border-solid border-surface/50 rounded-2xl p-8 min-h-[100px] md:min-h-[360px]">

                <h2 class="font-barlow-condensed font-semibold uppercase text-white text-5xl leading-none tracking-tight max-w-[200px]">
                    <?php echo esc_html( $card1_title ); ?>
                </h2>

                <!-- Arrow (mobile only) -->
                <div class="flex-shrink-0 md:hidden w-14 h-14 bg-primary rounded-full flex items-center justify-center group-hover:brightness-110 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-secondary" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/>
                    </svg>
                </div>

                <div class="hidden md:flex items-end justify-between gap-6 mt-6">
                    <p class="text-white/80 font-vollkorn text-lg leading-relaxed max-w-[300px]">
                        <?php echo esc_html( $card1_body ); ?>
                    </p>
                    <div class="flex-shrink-0 w-14 h-14 bg-primary rounded-full flex items-center justify-center group-hover:brightness-110 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-secondary" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/>
                        </svg>
                    </div>
                </div>

            </a>

            <!-- Card 2 -->
            <a href="<?php echo esc_url( $card2_url ); ?>"
               data-animate data-delay="200"
               class="group flex flex-row items-center justify-between md:flex-col md:justify-between md:items-stretch border-[0.5px] border-solid border-surface/50 rounded-2xl p-8 min-h-[100px] md:min-h-[360px]">

                <h2 class="font-barlow-condensed font-semibold uppercase text-white text-5xl leading-none tracking-tight max-w-[200px]">
                    <?php echo esc_html( $card2_title ); ?>
                </h2>

                <!-- Arrow (mobile only) -->
                <div class="flex-shrink-0 md:hidden w-14 h-14 bg-primary rounded-full flex items-center justify-center group-hover:brightness-110 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-secondary" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/>
                    </svg>
                </div>

                <div class="hidden md:flex items-end justify-between gap-6 mt-6">
                    <p class="text-white/80 font-vollkorn text-lg leading-relaxed max-w-[300px]">
                        <?php echo esc_html( $card2_body ); ?>
                    </p>
                    <div class="flex-shrink-0 w-14 h-14 bg-primary rounded-full flex items-center justify-center group-hover:brightness-110 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-secondary" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/>
                        </svg>
                    </div>
                </div>

            </a>

        </div>

        <!-- ── Testimonial Image Block ─────────────────────────────────────── -->
        <div data-animate data-delay="0"
             class="relative rounded-2xl overflow-hidden min-h-[550px] mt-12"
             <?php if ( $image ) : ?>
             style="background-image: url('<?php echo esc_url( $image ); ?>'); background-size: cover; background-position: center;"
             <?php else : ?>
             style="background-color: #172d35;"
             <?php endif; ?>>

            <!-- Dark gradient overlay -->
            <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(58,43,2,0.8) 0%, transparent 100%);"></div>

            <!-- Content -->
            <div class="absolute inset-0 z-10 flex flex-col justify-between md:justify-end md:gap-6 p-8 md:p-10 pt-24 md:pt-10">

                <!-- Quote -->
                <p class="text-white font-vollkorn text-2xl leading-relaxed max-w-lg">
                    <?php echo esc_html( $quote ); ?>
                </p>

                <!-- Name / Role / Button -->
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 md:gap-8">
                    <div>
                        <p class="font-barlow-condensed font-semibold uppercase text-white text-4xl leading-none tracking-tight">
                            <?php echo esc_html( $name ); ?>
                        </p>
                        <p class="font-barlow-condensed font-semibold uppercase text-surface text-[22px] leading-none tracking-tight mt-1">
                            <?php echo esc_html( $role ); ?>
                        </p>
                    </div>
                    <a href="<?php echo esc_url( $link_url ); ?>"
                       class="self-start flex-shrink-0 mt-8 bg-transparent border border-white rounded-lg text-white font-barlow-condensed font-semibold leading-none text-lg tracking-tight uppercase px-8 h-12 inline-flex items-center justify-center transition-all hover:bg-white hover:text-secondary">
                        <?php echo esc_html( $link_text ); ?>
                    </a>
                </div>

            </div>
        </div>

    </div>
</section>
