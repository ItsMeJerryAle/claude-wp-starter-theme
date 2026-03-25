<?php
/**
 * Block: Partners
 * Registered in: inc/blocks.php
 * ACF fields: partners_heading, partners_description, partners_logos (repeater)
 */

$heading     = get_field( 'partners_heading' )     ?: "Trusted By\nCommunity Partners";
$description = get_field( 'partners_description' ) ?: 'We work with leading organizations to build a stronger, more supportive network for everyone. Without duplicating efforts.';
$partners    = get_field( 'partners_logos' );

if ( ! $partners ) return;
?>

<section class="bg-surface py-20">
    <div class="max-w-default mx-auto px-4">

        <div data-animate data-delay="0" class="grid grid-cols-1 md:grid-cols-2 gap-8 items-end mb-16">
            <h2 class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-forest" style="font-size: clamp(2.5rem, 4vw, 4rem);">
                <?php echo wp_kses( nl2br( esc_html( trim( $heading ) ) ), array( 'br' => array() ) ); ?>
            </h2>
            <p class="font-vollkorn text-secondary text-lg leading-relaxed">
                <?php echo esc_html( $description ); ?>
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <?php
            $p_delay = 0;
            foreach ( $partners as $partner ) :
                $logo  = $partner['partner_logo'] ?? '';
                $name  = $partner['partner_name'] ?? '';
                $url   = $partner['partner_url']  ?? '';
                $tag   = $url ? 'a' : 'div';
                $attrs = $url ? 'href="' . esc_url( $url ) . '" target="_blank" rel="noopener noreferrer"' : '';
            ?>
                <<?php echo $tag; ?> <?php echo $attrs; ?>
                   data-animate data-delay="<?php echo esc_attr( $p_delay ); ?>"
                   class="group bg-white rounded-2xl p-6 flex items-center justify-center min-h-[140px] transition-all hover:shadow-md"><?php $p_delay += 80; ?>
                    <?php if ( $logo ) : ?>
                        <img src="<?php echo esc_url( $logo ); ?>"
                             alt="<?php echo esc_attr( $name ); ?>"
                             loading="lazy"
                             class="max-h-16 w-auto object-contain grayscale opacity-70 group-hover:opacity-100 group-hover:grayscale-0 transition-all">
                    <?php elseif ( $name ) : ?>
                        <p class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-secondary/40 text-center text-sm">
                            <?php echo esc_html( $name ); ?>
                        </p>
                    <?php endif; ?>
                </<?php echo $tag; ?>>
            <?php endforeach; ?>
        </div>

    </div>
</section>
