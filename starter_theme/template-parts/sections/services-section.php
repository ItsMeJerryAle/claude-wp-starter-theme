<?php
/**
 * Services Section
 * Displays Services CPT posts as image cards with label + title + arrow.
 * Section header (eyebrow + heading) controlled via ACF page fields.
 * Reusable across any page.
 */

$eyebrow = get_field( 'services_eyebrow' ) ?: 'How We Help';
$heading = get_field( 'services_heading' ) ?: 'For Individuals & Organizations';

$services = new WP_Query( array(
    'post_type'      => 'service',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
) );

if ( ! $services->have_posts() ) return;
?>

<section class="bg-[#203942] py-16">
    <div class="max-w-default mx-auto px-4">

        <!-- ── Section Header ──────────────────────────────────────────────── -->
        <div data-animate data-delay="0" class="mb-10">
            <p class="font-barlow-condensed font-semibold uppercase text-accent text-[22px] leading-none tracking-tight mb-2">
                <?php echo esc_html( $eyebrow ); ?>
            </p>
            <h2 class="font-barlow-condensed font-semibold uppercase text-surface leading-none text-5xl xl:text-6xl tracking-tight">
                <?php echo esc_html( $heading ); ?>
            </h2>
        </div>

        <!-- ── Service Cards ───────────────────────────────────────────────── -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            <?php
            $svc_delay = 0;
            while ( $services->have_posts() ) : $services->the_post();
                $label      = get_field( 'service_label' );
                $image_url  = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                $permalink  = get_permalink();
            ?>

            <a href="<?php echo esc_url( $permalink ); ?>"
               data-animate data-delay="<?php echo esc_attr( $svc_delay ); ?>"
               class="group relative rounded-2xl overflow-hidden min-h-[400px]"<?php $svc_delay += 100; ?>
               style="<?php if ( $image_url ) : ?>background-image: url('<?php echo esc_url( $image_url ); ?>'); background-size: cover; background-position: center;<?php else : ?>background-color: #172d35;<?php endif; ?>">

                <!-- Gradient overlay — dark top, fades to transparent bottom -->
                <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(32,57,66,0.95) 0%, rgba(32,57,66,0.4) 55%, transparent 100%);"></div>

                <!-- Text — top-left -->
                <div class="relative z-10 p-6">
                    <h3 class="font-barlow-condensed font-semibold uppercase text-white leading-none text-5xl tracking-tight mb-1 max-w-[300px]">
                        <?php the_title(); ?>
                    </h3>
                    <?php if ( $label ) : ?>
                        <p class="font-barlow-condensed font-semibold uppercase text-surface text-[22px] leading-none tracking-tight">
                            <?php echo esc_html( $label ); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Arrow button — bottom-right -->
                <div class="absolute bottom-5 right-5 z-10 w-12 h-12 bg-primary rounded-full flex items-center justify-center transition-all group-hover:brightness-110 group-hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-secondary" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/>
                    </svg>
                </div>

            </a>

            <?php endwhile; wp_reset_postdata(); ?>

        </div>

    </div>
</section>
