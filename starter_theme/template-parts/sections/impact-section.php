<?php
/**
 * Section: Impact — Testimonial cards + animated stats counter
 */

// ── Section fields ────────────────────────────────────────────────────────────
$eyebrow       = get_field( 'impact_eyebrow' )       ?: 'Our Impact';
$heading       = get_field( 'impact_heading' )       ?: 'Real Stories. Real Support.';
$stories_url   = get_field( 'impact_stories_url' );
$stories_label = get_field( 'impact_stories_label' ) ?: 'Read All Stories';

$stats = array(
    array(
        'number' => get_field( 'impact_stat1_number' ) ?: '$900K',
        'label'  => get_field( 'impact_stat1_label' )  ?: 'Shared',
        'desc'   => get_field( 'impact_stat1_desc' )   ?: 'with the community in 2025',
    ),
    array(
        'number' => get_field( 'impact_stat2_number' ) ?: '72',
        'label'  => get_field( 'impact_stat2_label' )  ?: 'Families',
        'desc'   => get_field( 'impact_stat2_desc' )   ?: 'directly supported in 2025',
    ),
    array(
        'number' => get_field( 'impact_stat3_number' ) ?: '$40M',
        'label'  => get_field( 'impact_stat3_label' )  ?: 'Donated',
        'desc'   => get_field( 'impact_stat3_desc' )   ?: 'to the community since 1981',
    ),
);

// ── Query all testimonials ───────────────────────────────────────────────────
$testimonials = array();
$tq = new WP_Query( array(
    'post_type'      => 'testimonial',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
if ( $tq->have_posts() ) {
    while ( $tq->have_posts() ) {
        $tq->the_post();
        $pid = get_the_ID();
        $testimonials[] = array(
            'name'  => get_the_title(),
            'quote' => get_field( 'testimonial_quote', $pid ),
            'role'  => get_field( 'testimonial_role', $pid ),
            'link'  => get_field( 'testimonial_link', $pid ),
            'image' => get_field( 'testimonial_bg_image', $pid ),
        );
    }
    wp_reset_postdata();
}
if ( empty( $testimonials ) ) {
    $testimonials = array(
        array( 'name' => 'Jenny', 'quote' => 'The assistance we received didn\'t just pay a bill—it gave us the breathing room to focus on recovery instead of financial ruin.', 'role' => 'Cancer Care Recipient', 'link' => '#', 'image' => '' ),
        array( 'name' => 'David', 'quote' => 'Finding a safe place to sleep was the first step. The ongoing support helped me rebuild my life and find a job I love.', 'role' => 'Housing Support Recipient', 'link' => '#', 'image' => '' ),
    );
}
?>

<section class="bg-white py-16">
    <div class="max-w-default mx-auto px-4">

        <!-- Section Header -->
        <div data-animate data-delay="0" class="flex items-end justify-between mb-8">
            <div>
                <p class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-accent text-[22px] mb-2">
                    <?php echo esc_html( $eyebrow ); ?>
                </p>
                <h2 class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-forest text-5xl xl:text-6xl">
                    <?php echo esc_html( $heading ); ?>
                </h2>
            </div>
            <?php if ( $stories_url ) : ?>
                <a href="<?php echo esc_url( $stories_url ); ?>"
                   class="hidden md:inline font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-secondary text-lg hover:text-accent transition-colors flex-shrink-0 ml-8">
                    Read All Stories
                </a>
            <?php endif; ?>
        </div>

        <!-- ── Desktop: 2-card grid (md and above) ─────────────────────────── -->
        <?php
        $t1 = $testimonials[0] ?? null;
        $t2 = $testimonials[1] ?? null;
        ?>
        <div data-animate data-delay="0" class="hidden md:grid grid-cols-5 gap-6">

            <?php if ( $t1 ) : ?>
            <!-- Card 1 — image background, col-span-3 (60%) -->
            <div class="col-span-3 relative rounded-2xl overflow-hidden min-h-[520px] flex flex-col justify-between"
                 <?php if ( $t1['image'] ) : ?>style="background-image: url('<?php echo esc_url( $t1['image'] ); ?>'); background-size: cover; background-position: center;"<?php endif; ?>>

                <div class="absolute inset-0" style="background: linear-gradient(338.24deg, rgba(0,0,0,0) 14.26%, rgba(58,43,2,0.8) 77.31%), linear-gradient(177.68deg, rgba(0,0,0,0) 24.02%, rgba(0,0,0,0.4) 82.52%);"></div>

                <div class="relative z-10 p-8">
                    <?php if ( $t1['quote'] ) : ?>
                        <p class="font-vollkorn text-white text-2xl leading-relaxed max-w-[33rem]">
                            "<?php echo esc_html( $t1['quote'] ); ?>"
                        </p>
                    <?php endif; ?>
                </div>

                <div class="relative z-10 p-8 flex items-end justify-between gap-4">
                    <div>
                        <?php if ( $t1['name'] ) : ?>
                            <p class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-white text-[32px]">
                                <?php echo esc_html( $t1['name'] ); ?>
                            </p>
                        <?php endif; ?>
                        <?php if ( $t1['role'] ) : ?>
                            <p class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-surface text-[22px] mt-1">
                                <?php echo esc_html( $t1['role'] ); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <?php if ( $t1['link'] ) : ?>
                        <a href="<?php echo esc_url( $t1['link'] ); ?>"
                           class="flex-shrink-0 bg-transparent border border-white rounded-lg text-white font-barlow-condensed font-semibold leading-none text-lg tracking-tight uppercase px-6 h-12 inline-flex items-center justify-center transition-all hover:bg-white hover:text-secondary">
                            Read Full Story
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if ( $t2 ) : ?>
            <!-- Card 2 — solid dark, col-span-2 (40%) -->
            <div class="col-span-2 bg-secondary rounded-2xl min-h-[520px] flex flex-col justify-between p-8">

                <?php if ( $t2['quote'] ) : ?>
                    <p class="font-vollkorn text-white/80 text-2xl leading-relaxed max-w-[20rem]">
                        "<?php echo esc_html( $t2['quote'] ); ?>"
                    </p>
                <?php endif; ?>

                <div class="flex items-end justify-between gap-4">
                    <div>
                        <?php if ( $t2['name'] ) : ?>
                            <p class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-white text-[32px]">
                                <?php echo esc_html( $t2['name'] ); ?>
                            </p>
                        <?php endif; ?>
                        <?php if ( $t2['role'] ) : ?>
                            <p class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-surface text-[22px] mt-1">
                                <?php echo esc_html( $t2['role'] ); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <?php if ( $t2['link'] ) : ?>
                        <a href="<?php echo esc_url( $t2['link'] ); ?>"
                           class="flex-shrink-0 bg-transparent border border-white rounded-lg text-white font-barlow-condensed font-semibold leading-none text-lg tracking-tight uppercase px-6 h-12 inline-flex items-center justify-center transition-all hover:bg-white hover:text-secondary">
                            Read Full Story
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

        </div>

        <!-- ── Mobile: panel slider (below md) ──────────────────────────────── -->
        <div class="md:hidden">

            <div data-animate data-delay="0" class="relative overflow-hidden" id="impact-slider-viewport">
                <div class="flex gap-6" id="impact-slider-track">
                    <?php foreach ( $testimonials as $t ) : ?>
                    <div class="impact-slide relative rounded-2xl overflow-hidden flex flex-col justify-between flex-none"
                         data-bg="<?php echo esc_attr( $t['image'] ); ?>"
                         style="height:480px; flex-shrink:0;">

                        <div class="slide-bg absolute inset-0 bg-cover bg-center"></div>
                        <div class="slide-gradient absolute inset-0" style="display:none; background: linear-gradient(338.24deg, rgba(0,0,0,0) 14.26%, rgba(58,43,2,0.8) 77.31%), linear-gradient(177.68deg, rgba(0,0,0,0) 24.02%, rgba(0,0,0,0.4) 82.52%);"></div>
                        <div class="slide-solid absolute inset-0 bg-secondary"></div>

                        <div class="relative z-10 p-6">
                            <?php if ( $t['quote'] ) : ?>
                                <p class="slide-quote font-vollkorn text-white text-xl leading-relaxed">
                                    "<?php echo esc_html( $t['quote'] ); ?>"
                                </p>
                            <?php endif; ?>
                        </div>

                        <div class="relative z-10 p-6 flex items-end justify-between gap-4">
                            <div>
                                <?php if ( $t['name'] ) : ?>
                                    <p class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-white text-[28px]">
                                        <?php echo esc_html( $t['name'] ); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if ( $t['role'] ) : ?>
                                    <p class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-surface text-lg mt-1">
                                        <?php echo esc_html( $t['role'] ); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <?php if ( $t['link'] ) : ?>
                                <a href="<?php echo esc_url( $t['link'] ); ?>"
                                   class="flex-shrink-0 bg-transparent border border-white rounded-lg text-white font-barlow-condensed font-semibold leading-none text-base tracking-tight uppercase px-4 h-10 inline-flex items-center justify-center transition-all hover:bg-white hover:text-secondary">
                                    Read
                                </a>
                            <?php endif; ?>
                        </div>

                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Nav row: arrows left, Read All Stories right -->
            <?php if ( count( $testimonials ) > 1 ) : ?>
            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center gap-3">
                    <button id="impact-prev"
                            class="w-12 h-12 rounded-full bg-primary text-secondary flex items-center justify-center hover:brightness-110 transition-all"
                            aria-label="Previous">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5M11 6l-6 6 6 6"/>
                        </svg>
                    </button>
                    <button id="impact-next"
                            class="w-12 h-12 rounded-full bg-primary text-secondary flex items-center justify-center hover:brightness-110 transition-all"
                            aria-label="Next">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/>
                        </svg>
                    </button>
                </div>
                <?php if ( $stories_url ) : ?>
                    <a href="<?php echo esc_url( $stories_url ); ?>"
                       class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-secondary text-lg hover:text-accent transition-colors">
                        <?php echo esc_html( $stories_label ); ?>
                    </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>

        </div>

        <!-- Stats Row -->
        <div class="mt-12">
            <div data-animate data-delay="0"
                 class="grid grid-cols-1 md:grid-cols-3 gap-6 js-impact-stats" data-counted="false">
                <?php foreach ( $stats as $i => $stat ) :
                    // Parse: "$900K" → prefix "$", numeric "900", suffix "K"
                    preg_match( '/^([^0-9]*)([0-9,\.]+)([^0-9]*)$/', $stat['number'], $m );
                    $prefix  = $m[1] ?? '';
                    $raw_num = str_replace( ',', '', $m[2] ?? '0' );
                    $suffix  = $m[3] ?? '';
                ?>
                    <div class="border-t border-primary px-8 pt-8">
                        <p class="font-barlow-condensed font-semibold leading-none tracking-tight text-leaf"
                           style="font-size: 88px;">
                            <span><?php echo esc_html( $prefix ); ?></span><span class="js-stat-number" data-target="<?php echo esc_attr( $raw_num ); ?>">0</span><span><?php echo esc_html( $suffix ); ?></span>
                        </p>
                        <p class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-forest mt-3" style="font-size: 32px;">
                            <?php echo esc_html( $stat['label'] ); ?>
                        </p>
                        <p class="font-vollkorn text-secondary mt-2 leading-relaxed" style="font-size: 18px;">
                            <?php echo esc_html( $stat['desc'] ); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>

<!-- Testimonial Slider -->
<script>
(function () {
    var viewport   = document.getElementById( 'impact-slider-viewport' );
    var track      = document.getElementById( 'impact-slider-track' );
    var realSlides = Array.from( document.querySelectorAll( '.impact-slide' ) );
    var prevBtn    = document.getElementById( 'impact-prev' );
    var nextBtn    = document.getElementById( 'impact-next' );
    var GAP        = 24;

    if ( ! viewport || ! track || realSlides.length === 0 ) return;
    if ( viewport.offsetParent === null ) return; // hidden on desktop — skip init

    var realCount = realSlides.length;

    // ── Clone first & last for infinite loop ────────────────────────────────
    var firstClone = realSlides[0].cloneNode( true );
    var lastClone  = realSlides[ realCount - 1 ].cloneNode( true );
    track.appendChild( firstClone );
    track.insertBefore( lastClone, realSlides[0] );

    // DOM order: [lastClone, slide1, slide2, …, firstClone]
    var allSlides = Array.from( track.querySelectorAll( '.impact-slide' ) );

    var pos  = 1; // index into allSlides; real slides are 1…realCount
    var busy = false;

    // ── Width helper ─────────────────────────────────────────────────────────
    // Mobile: ~85% width so ~15% of next card peeks on the right.
    function getSlideW() { return Math.round( viewport.offsetWidth * 0.85 ) + 15; }
    function getOffset() { return pos * ( getSlideW() + GAP ); }

    // Map allSlides index → real slide index (0-based)
    function realIdx( i ) {
        if ( i === 0 )             return realCount - 1;
        if ( i === realCount + 1 ) return 0;
        return i - 1;
    }

    function initSizes() {
        var w = getSlideW();
        allSlides.forEach( function ( s ) { s.style.width = w + 'px'; } );
    }

    function applyTranslate( animated ) {
        track.style.transition = animated ? 'transform 0.5s ease-out' : 'none';
        track.style.transform  = 'translateX(-' + getOffset() + 'px)';
        if ( ! animated ) track.offsetHeight; // force reflow
    }

    // ── Visual states (image / gradient / solid overlay) ─────────────────────
    function updateStyles() {
        var activeReal = realIdx( pos );
        allSlides.forEach( function ( slide, i ) {
            var bg    = slide.querySelector( '.slide-bg' );
            var grad  = slide.querySelector( '.slide-gradient' );
            var solid = slide.querySelector( '.slide-solid' );
            var quote = slide.querySelector( '.slide-quote' );
            if ( realIdx( i ) === activeReal ) {
                if ( slide.dataset.bg ) bg.style.backgroundImage = "url('" + slide.dataset.bg + "')";
                grad.style.display  = 'block';
                solid.style.display = 'none';
                if ( quote ) { quote.style.maxWidth = '33rem'; quote.style.opacity = '1'; }
            } else {
                bg.style.backgroundImage = 'none';
                grad.style.display  = 'none';
                solid.style.display = 'block';
                if ( quote ) { quote.style.maxWidth = '20rem'; quote.style.opacity = '0.8'; }
            }
        } );
    }

    function goTo( direction ) {
        if ( busy ) return;
        busy = true;
        pos += direction;
        updateStyles();
        applyTranslate( true );
    }

    // ── Infinite snap after transition ───────────────────────────────────────
    track.addEventListener( 'transitionend', function ( e ) {
        if ( e.propertyName !== 'transform' ) return;
        busy = false;
        if ( pos === 0 || pos === realCount + 1 ) {
            pos = ( pos === 0 ) ? realCount : 1;
            applyTranslate( false );
            requestAnimationFrame( function () {
                requestAnimationFrame( function () {
                    track.style.transition = 'transform 0.5s ease-out';
                } );
            } );
        }
    } );

    // ── Init ─────────────────────────────────────────────────────────────────
    initSizes();
    applyTranslate( false );
    updateStyles();
    requestAnimationFrame( function () {
        requestAnimationFrame( function () {
            track.style.transition = 'transform 0.5s ease-out';
        } );
    } );

    if ( prevBtn ) prevBtn.addEventListener( 'click', function () { goTo( -1 ); } );
    if ( nextBtn ) nextBtn.addEventListener( 'click', function () { goTo( 1 ); } );

    // ── Touch drag ───────────────────────────────────────────────────────────
    var touchStartX = 0;
    var touchStartY = 0;
    var isDragging  = false;

    viewport.addEventListener( 'touchstart', function ( e ) {
        touchStartX = e.touches[0].clientX;
        touchStartY = e.touches[0].clientY;
        isDragging  = false;
    }, { passive: true } );

    viewport.addEventListener( 'touchmove', function ( e ) {
        var dx = e.touches[0].clientX - touchStartX;
        var dy = e.touches[0].clientY - touchStartY;

        // Ignore if primarily vertical scroll
        if ( ! isDragging && Math.abs( dx ) < Math.abs( dy ) ) return;

        isDragging = true;
        e.preventDefault(); // prevent page scroll during horizontal drag
        track.style.transition = 'none';
        track.style.transform  = 'translateX(-' + ( getOffset() - dx ) + 'px)';
    }, { passive: false } );

    viewport.addEventListener( 'touchend', function ( e ) {
        if ( ! isDragging ) return;
        isDragging   = false;
        var dx = e.changedTouches[0].clientX - touchStartX;
        if ( Math.abs( dx ) > 50 ) {
            goTo( dx < 0 ? 1 : -1 );
        } else {
            applyTranslate( true ); // snap back
        }
    } );

    window.addEventListener( 'resize', function () {
        initSizes();
        applyTranslate( false );
    } );
})();
</script>

<!-- Stats Counter Animation -->
<script>
(function () {
    var block = document.querySelector('.js-impact-stats');
    if (!block) return;

    function animateCounters() {
        if (block.dataset.counted === 'true') return;
        block.dataset.counted = 'true';

        block.querySelectorAll('.js-stat-number').forEach(function (el) {
            var target   = parseFloat(el.dataset.target) || 0;
            var duration = 1500;
            var start    = null;

            function step(ts) {
                if (!start) start = ts;
                var progress = Math.min((ts - start) / duration, 1);
                var ease     = 1 - Math.pow(1 - progress, 3); // ease-out cubic
                el.textContent = Math.round(ease * target).toLocaleString();
                if (progress < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
        });
    }

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) { if (e.isIntersecting) animateCounters(); });
    }, { threshold: 0.3 });

    observer.observe(block);
})();
</script>
