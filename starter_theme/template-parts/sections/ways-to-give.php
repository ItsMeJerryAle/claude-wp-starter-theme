<?php
/**
 * Section: Ways to Give — Featured giving methods grid
 */

$eyebrow     = get_field( 'ways_eyebrow' )     ?: 'Make an Impact';
$heading     = get_field( 'ways_heading' )     ?: "Other Ways\nto Give";
$description = get_field( 'ways_description' ) ?: 'There are many ways to support our mission beyond direct donations. Explore the options below to find what works best for you.';

// Featured card (Qualified Charitable Distributions)
$feat_image   = get_field( 'ways_featured_image' );
$feat_heading = get_field( 'ways_featured_heading' ) ?: 'Qualified Charitable Distributions';
$feat_desc    = get_field( 'ways_featured_desc' )    ?: 'If you are 70½ or older, you can make a tax-free gift directly from your IRA to BridgeWell Foundation.';
$feat_btn_txt = get_field( 'ways_featured_btn_text' ) ?: 'Contact Us';
$feat_btn_url = get_field( 'ways_featured_btn_url' );

// Mail a Check card
$mail_heading = get_field( 'ways_mail_heading' )  ?: 'Mail a Check';
$mail_desc    = get_field( 'ways_mail_desc' )     ?: 'Make your check payable to BridgeWell Foundation and mail it to the address below.';
$mail_address = get_field( 'ways_mail_address' )  ?: "BridgeWell Foundation\n808 W Eisenhower Blvd, Ste 202\nLoveland, CO 80537";

// Bottom 3 cards (repeater)
$bottom_cards = get_field( 'ways_bottom_cards' ) ?: array(
    array( 'icon' => '', 'heading' => 'Stocks & Securities', 'desc' => 'Donating appreciated securities is a tax-smart way to support our mission while avoiding capital gains tax.', 'btn_text' => 'Learn More', 'btn_url' => '' ),
    array( 'icon' => '', 'heading' => 'Planned Giving',      'desc' => 'Leave a lasting legacy by including BridgeWell Foundation in your estate plan or will.', 'btn_text' => 'Learn More', 'btn_url' => '' ),
    array( 'icon' => '', 'heading' => 'Donate Your Car',     'desc' => 'Turn your vehicle into meaningful support. Car donations are easy, fast, and fully tax-deductible.', 'btn_text' => 'Learn More', 'btn_url' => '' ),
);
?>

<section class="bg-white py-16">
    <div class="max-w-default mx-auto px-4">

        <!-- Section Header -->
        <div data-animate data-delay="0" class="mb-10">
            <p class="font-barlow-condensed font-semibold uppercase text-accent text-[22px] leading-none tracking-tight mb-3">
                <?php echo esc_html( $eyebrow ); ?>
            </p>
            <h2 class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-forest text-5xl xl:text-6xl mb-4">
                <?php echo wp_kses( nl2br( esc_html( $heading ) ), array( 'br' => array() ) ); ?>
            </h2>
            <?php if ( $description ) : ?>
            <p class="font-vollkorn text-black text-xl md:text-2xl leading-relaxed max-w-2xl">
                <?php echo esc_html( $description ); ?>
            </p>
            <?php endif; ?>
        </div>

        <!-- Top Row: 2-col (60/40) -->
        <div class="grid grid-cols-1 md:grid-cols-[3fr_2fr] gap-6 mb-6">

            <!-- Left: Featured card (bg image) -->
            <div data-animate data-delay="0"
                 class="relative rounded-2xl overflow-hidden min-h-[600px] flex flex-col"
                 <?php if ( $feat_image ) : ?>style="background-image:url('<?php echo esc_url( $feat_image ); ?>');background-size:cover;background-position:center;"<?php endif; ?>>

                <!-- Overlay -->
                <div class="absolute inset-0" style="background: linear-gradient(180deg, rgba(58, 43, 2, 0.8) 35.32%, rgba(0, 0, 0, 0) 100%);"></div>
                <!-- Progressive blur overlay -->
                <div class="absolute inset-0" style="backdrop-filter: blur(7px); -webkit-backdrop-filter: blur(7px); mask-image: linear-gradient(to right, transparent -50%, black 20%, black 40%, transparent 80%); -webkit-mask-image: linear-gradient(to right, transparent -50%, black 20%, black 40%, transparent 80%);"></div>

                <!-- Content: top text -->
                <div class="relative z-10 p-8">
                    <h3 class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-white text-4xl xl:text-6xl mb-4">
                        <?php echo esc_html( $feat_heading ); ?>
                    </h3>
                    <?php if ( $feat_desc ) : ?>
                    <p class="font-vollkorn text-white text-lg md:text-2xl leading-relaxed max-w-md">
                        <?php echo esc_html( $feat_desc ); ?>
                    </p>
                    <?php endif; ?>
                </div>

                <!-- Button: bottom right -->
                <?php if ( $feat_btn_url ) : ?>
                <div class="relative z-10 mt-auto p-8 flex justify-end">
                    <a href="<?php echo esc_url( $feat_btn_url ); ?>"
                       class="inline-flex items-center gap-3 font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-white text-[22px] hover:gap-5 transition-all">
                        <?php echo esc_html( $feat_btn_txt ); ?>
                        <span class="w-10 h-10 bg-leaf rounded-full flex items-center justify-center text-white flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </span>
                    </a>
                </div>
                <?php endif; ?>

            </div>

            <!-- Right: Mail a Check -->
            <div data-animate data-delay="100" class="bg-secondary rounded-2xl p-8 flex flex-col min-h-[460px]">

                <!-- Envelope icon -->
                <div class="mb-6">
                    <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <rect x="2" y="4" width="20" height="16" rx="2"/>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                    </svg>
                </div>               

                <?php if ( $mail_address ) : ?>
                <div class="mt-auto">
                    <h3 class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-white text-4xl xl:text-5xl mb-4">
                        <?php echo esc_html( $mail_heading ); ?>
                    </h3>

                    <?php if ( $mail_desc ) : ?>
                    <p class="font-vollkorn text-white text-lg leading-relaxed mb-6">
                        <?php echo esc_html( $mail_desc ); ?>
                    </p>
                    <?php endif; ?>
                    
                    <div class="flex flex-row gap-6 items-end">
                        <div class="border flex-grow border-surface bg-surface/5 rounded-xl p-4 opacity-70">
                            <p class="font-barlow-condensed text-surface text-xl leading-none font-semibold uppercase tracking-tight">
                                <?php echo wp_kses( nl2br( esc_html( $mail_address ) ), array( 'br' => array() ) ); ?>
                            </p>
                        </div>
                        <div class="relative flex flex-col items-center gap-1">
                            <span id="ways-copy-alert"
                                  style="opacity:0;transition:opacity 0.3s ease;"
                                  class="absolute -top-8 left-1/2 -translate-x-1/2 whitespace-nowrap font-barlow-condensed font-semibold text-sm uppercase tracking-tight text-secondary bg-primary rounded px-2 py-1 pointer-events-none">
                                Copied!
                            </span>
                            <button type="button"
                                    id="ways-copy-btn"
                                    data-copy="<?php echo esc_attr( $mail_address ); ?>"
                                    class="text-primary hover:text-white transition-colors"
                                    title="Copy address">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <rect x="9" y="9" width="13" height="13" rx="2"/>
                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </div>

        </div>

        <!-- Bottom Row: 3 equal cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
            <?php
            $delays = array( 0, 100, 200 );
            foreach ( $bottom_cards as $i => $card ) :
                $delay   = $delays[ $i ] ?? ( $i * 100 );
                $btn_url = ! empty( $card['btn_url'] ) ? $card['btn_url'] : '';
                $tag     = $btn_url ? 'a' : 'div';
                $attrs   = $btn_url ? ' href="' . esc_url( $btn_url ) . '"' : '';
            ?>
            <<?php echo $tag . $attrs; ?> data-animate data-delay="<?php echo esc_attr( $delay ); ?>"
                 class="bg-forest rounded-2xl p-8 flex flex-col min-h-[280px]<?php echo $btn_url ? ' transition-all' : ''; ?>">

                <?php if ( ! empty( $card['icon'] ) ) : ?>
                <img src="<?php echo esc_url( $card['icon'] ); ?>" alt="" class="w-12 h-12 mb-16 object-contain">
                <?php endif; ?>

                <h3 class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-white text-3xl xl:text-[32px] mb-3">
                    <?php echo esc_html( $card['heading'] ); ?>
                </h3>

                <?php if ( ! empty( $card['desc'] ) ) : ?>
                <p class="font-vollkorn text-white text-lg leading-relaxed mb-6">
                    <?php echo esc_html( $card['desc'] ); ?>
                </p>
                <?php endif; ?>

                <?php if ( $btn_url ) : ?>
                <div class="mt-auto flex items-center justify-end gap-3">
                    <span class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-white text-[22px]">
                        <?php echo esc_html( ! empty( $card['btn_text'] ) ? $card['btn_text'] : 'Learn More' ); ?>
                    </span>
                    <span class="w-10 h-10 bg-leaf rounded-full flex items-center justify-center text-white flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </span>
                </div>
                <?php endif; ?>

            </<?php echo $tag; ?>>
            <?php endforeach; ?>
        </div>

    </div>
</section>
