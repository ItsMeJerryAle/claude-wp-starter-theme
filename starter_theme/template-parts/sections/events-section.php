<?php
/**
 * Section: Events — Featured event + sidebar stack + volunteer block
 */

// ── Section fields ────────────────────────────────────────────────────────────
$eyebrow      = get_field( 'events_eyebrow' )      ?: 'Upcoming Events & Volunteering';
$heading      = get_field( 'events_heading' )      ?: 'Join Us in Making a Difference';
$view_all_url   = get_field( 'events_view_all_url' );
$view_all_label = get_field( 'events_view_all_label' ) ?: 'View All Events';

$featured_id  = get_field( 'events_featured' );
$sidebar_1_id = get_field( 'events_sidebar_1' );
$sidebar_2_id = get_field( 'events_sidebar_2' );

$vol_eyebrow  = get_field( 'events_vol_eyebrow' )   ?: 'Title Goes Here';
$vol_title    = get_field( 'events_vol_title' )     ?: 'Volunteer Opportunities';
$vol_desc     = get_field( 'events_vol_desc' )      ?: 'Admin, event, and ambassador roles available.';
$vol_btn_text = get_field( 'events_vol_btn_text' )  ?: 'Sign Up Today';
$vol_btn_url  = get_field( 'events_vol_btn_url' );
$vol_image    = get_field( 'events_vol_image' );

// ── Helper: get event data ────────────────────────────────────────────────────
if ( ! function_exists( 'tail_get_event' ) ) {
    function tail_get_event( $post_id ) {
        if ( ! $post_id ) return null;
        $raw_date = get_field( 'event_date', $post_id );
        return array(
            'title'    => get_the_title( $post_id ),
            'date'     => $raw_date ? strtoupper( date( 'M j', strtotime( $raw_date ) ) ) : '',
            'time'     => get_field( 'event_time', $post_id ),
            'location' => get_field( 'event_location', $post_id ),
            'link'     => get_field( 'event_link', $post_id ) ?: get_permalink( $post_id ),
            'image'    => get_the_post_thumbnail_url( $post_id, 'large' ),
        );
    }
}

$featured  = tail_get_event( $featured_id );
$sidebar_1 = tail_get_event( $sidebar_1_id );
$sidebar_2 = tail_get_event( $sidebar_2_id );
?>

<section class="bg-white py-16">
    <div class="max-w-default mx-auto px-4">

        <!-- Section Header -->
        <div data-animate data-delay="0" class="flex items-end justify-between mb-8">
            <div>
                <p class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-accent text-[22px] mb-2">
                    <?php echo esc_html( $eyebrow ); ?>
                </p>
                <h2 class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-secondary text-5xl xl:text-6xl">
                    <?php echo esc_html( $heading ); ?>
                </h2>
            </div>
            <?php if ( $view_all_url ) : ?>
                <a href="<?php echo esc_url( $view_all_url ); ?>"
                   class="hidden md:inline font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-secondary text-lg hover:text-accent transition-colors flex-shrink-0 ml-8">
                    <?php echo esc_html( $view_all_label ); ?>
                </a>
            <?php endif; ?>
        </div>

        <!-- Top Row: Featured (70%) + Sidebar stack (30%) — stacked on mobile -->
        <div class="grid grid-cols-1 md:[grid-template-columns:7fr_3fr] gap-6">

            <!-- Featured Event Card -->
            <?php if ( $featured ) : ?>
                <div data-animate data-delay="0"
                     class="relative rounded-2xl overflow-hidden min-h-[520px] flex flex-col justify-end"
                     style="background-color: #203942;<?php if ( $featured['image'] ) echo ' background-image: url(' . esc_url( $featured['image'] ) . '); background-size: cover; background-position: center;'; ?>">
                    <div class="absolute inset-0" style="background: linear-gradient(61.95deg, rgba(58,43,2,0.8) 24.68%, rgba(0,0,0,0) 70.37%);"></div>
                    <div class="relative z-10 p-8 mb-12">
                        <?php if ( $featured['date'] ) : ?>
                            <p class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-surface text-[32px] mb-1">
                                <?php echo esc_html( $featured['date'] ); ?>
                            </p>
                        <?php endif; ?>
                        <h3 class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-white text-5xl mb-3">
                            <?php echo esc_html( $featured['title'] ); ?>
                        </h3>
                        <?php if ( $featured['location'] || $featured['time'] ) : ?>
                            <p class="font-vollkorn text-white text-lg leading-relaxed mb-5">
                                <?php echo esc_html( $featured['location'] ); ?><?php if ( $featured['location'] && $featured['time'] ) echo ' &bull; '; ?><?php echo esc_html( $featured['time'] ); ?>
                            </p>
                        <?php endif; ?>
                        <?php if ( $featured['link'] ) : ?>
                            <a href="<?php echo esc_url( $featured['link'] ); ?>"
                               class="bg-transparent border border-white rounded-lg text-white font-barlow-condensed font-semibold leading-none text-lg tracking-tight uppercase px-6 h-12 inline-flex items-center justify-center transition-all hover:bg-white hover:text-secondary">
                                Details
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Sidebar Event Cards — wrapper fills grid row height on desktop -->
            <div class="flex flex-col gap-6">
                <?php foreach ( array( $sidebar_1, $sidebar_2 ) as $idx => $event ) :
                    if ( ! $event ) continue; ?>
                    <div data-animate data-delay="<?php echo $idx === 0 ? '0' : '150'; ?>"
                         class="bg-secondary hover:bg-forest transition-colors rounded-2xl p-6 flex flex-col justify-center relative min-h-[250px] md:min-h-0 md:flex-1">
                        <div>
                            <?php if ( $event['date'] ) : ?>
                                <p class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-primary text-[22px] mb-1">
                                    <?php echo esc_html( $event['date'] ); ?>
                                </p>
                            <?php endif; ?>
                            <h3 class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-white text-[32px] mb-3">
                                <?php echo esc_html( $event['title'] ); ?>
                            </h3>
                            <?php if ( $event['location'] || $event['time'] ) : ?>
                                <p class="font-vollkorn text-white text-sm leading-relaxed">
                                    <?php echo esc_html( $event['location'] ); ?><?php if ( $event['location'] && $event['time'] ) echo ' &bull; '; ?><?php echo esc_html( $event['time'] ); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <?php if ( $event['link'] ) : ?>
                            <a href="<?php echo esc_url( $event['link'] ); ?>"
                               class="absolute bottom-5 right-5 w-10 h-10 bg-primary rounded-full flex items-center justify-center transition-all hover:brightness-110 hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

        <!-- Mobile: View All Events link (below events, above volunteer) -->
        <?php if ( $view_all_url ) : ?>
            <div class="flex justify-end mt-6 md:hidden">
                <a href="<?php echo esc_url( $view_all_url ); ?>"
                   class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-secondary text-lg hover:text-accent transition-colors">
                    <?php echo esc_html( $view_all_label ); ?>
                </a>
            </div>
        <?php endif; ?>

        <!-- Bottom Row: Volunteer block (50%) + Image (50%) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

            <!-- Volunteer Card -->
            <div data-animate data-delay="0" class="bg-secondary rounded-2xl px-8 py-12 flex flex-col md:flex-row md:items-stretch md:justify-between gap-6 md:gap-8">
                <div>
                    <p class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-surface text-[22px] mb-2">
                        <?php echo esc_html( $vol_eyebrow ); ?>
                    </p>
                    <h3 class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-white text-5xl mb-4">
                        <?php echo esc_html( $vol_title ); ?>
                    </h3>
                    <p class="font-vollkorn text-white text-base leading-relaxed">
                        <?php echo esc_html( $vol_desc ); ?>
                    </p>
                </div>
                <?php if ( $vol_btn_url ) : ?>
                    <a href="<?php echo esc_url( $vol_btn_url ); ?>"
                       class="self-start md:self-end flex-shrink-0 bg-transparent border border-white rounded-lg text-white font-barlow-condensed font-semibold leading-none text-lg tracking-tight uppercase px-6 h-12 inline-flex items-center justify-center transition-all hover:bg-white hover:text-secondary">
                        <?php echo esc_html( $vol_btn_text ); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Volunteer Image -->
            <?php if ( $vol_image ) : ?>
                <div data-animate data-delay="150" class="rounded-2xl overflow-hidden min-h-[280px]"
                     style="background-image: url(<?php echo esc_url( $vol_image ); ?>); background-size: cover; background-position: center;">
                </div>
            <?php else : ?>
                <div class="rounded-2xl bg-secondary/30 min-h-[280px]"></div>
            <?php endif; ?>

        </div>

    </div>
</section>
