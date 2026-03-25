<?php
/**
 * Service Details Section — content only (no section wrapper, no max-w container).
 * Rendered inside the sticky layout in single-service-default.php.
 * Used by: page-templates/single-service-default.php
 *
 * ACF fields: sds_eyebrow, sds_heading, sds_description,
 *             sds_cards repeater (card_title, card_description, card_col1_heading,
 *                                  card_col1_items, card_col2_heading, card_col2_items)
 */

$eyebrow     = get_field( 'sds_eyebrow' )     ?: 'We Are Here For You';
$heading     = get_field( 'sds_heading' )     ?: '';
$description = get_field( 'sds_description' ) ?: '';
$cards       = get_field( 'sds_cards' )       ?: array();

if ( ! $heading && ! $cards ) return;
?>

<div class="pb-16">

	<!-- Header ──────────────────────────────────────────────────────────── -->
	<div class="mb-10">

		<?php if ( $eyebrow ) : ?>
		<p data-animate data-delay="0"
		   class="font-barlow-condensed font-semibold uppercase text-accent text-[22px] leading-none tracking-tight mb-3">
			<?php echo esc_html( $eyebrow ); ?>
		</p>
		<?php endif; ?>

		<?php if ( $heading ) : ?>
		<h2 data-animate data-delay="100"
		    class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-secondary text-5xl xl:text-6xl mb-4">
			<?php echo esc_html( $heading ); ?>
		</h2>
		<?php endif; ?>

		<?php if ( $description ) : ?>
		<p data-animate data-delay="150"
		   class="font-vollkorn text-secondary text-lg leading-relaxed max-w-2xl">
			<?php echo esc_html( $description ); ?>
		</p>
		<?php endif; ?>

	</div>

	<!-- Service Cards ───────────────────────────────────────────────────── -->
	<?php if ( $cards ) : ?>
	<div class="flex flex-col gap-6">
		<?php foreach ( $cards as $i => $card ) :
			$title        = $card['card_title']        ?? '';
			$card_desc    = $card['card_description']  ?? '';
			$col1_heading = $card['card_col1_heading'] ?? 'What We Cover';
			$col1_items   = $card['card_col1_items']   ?? '';
			$col2_heading = $card['card_col2_heading'] ?? 'Living Expenses We Can Help With';
			$col2_items   = $card['card_col2_items']   ?? '';

			$col1_list = array_filter( array_map( 'trim', explode( "\n", $col1_items ) ) );
			$col2_list = array_filter( array_map( 'trim', explode( "\n", $col2_items ) ) );
		?>
		<div data-animate data-delay="<?php echo esc_attr( $i * 100 ); ?>"
		     class="<?php echo ( $i % 2 === 0 ) ? 'bg-forest' : 'bg-secondary'; ?> rounded-2xl p-8 md:p-10">

			<?php if ( $title ) : ?>
			<h3 class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-white text-4xl xl:text-5xl mb-4">
				<?php echo esc_html( $title ); ?>
			</h3>
			<?php endif; ?>

			<?php if ( $card_desc ) : ?>
			<p class="font-vollkorn text-white text-base leading-relaxed mb-8">
				<?php echo esc_html( $card_desc ); ?>
			</p>
			<?php endif; ?>

			<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

				<!-- Column 1 -->
				<?php if ( $col1_heading || $col1_list ) : ?>
				<div>
					<p class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-primary text-lg mb-4">
						<?php echo esc_html( $col1_heading ); ?>
					</p>
					<?php if ( $col1_list ) : ?>
					<ul class="space-y-2">
						<?php foreach ( $col1_list as $bullet ) : ?>
						<li class="flex items-start gap-2">
							<span class="text-primary mt-0.5 flex-shrink-0 leading-none">•</span>
							<span class="font-vollkorn text-white text-base leading-relaxed">
								<?php echo esc_html( $bullet ); ?>
							</span>
						</li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
				</div>
				<?php endif; ?>

				<!-- Column 2 -->
				<?php if ( $col2_heading || $col2_list ) : ?>
				<div>
					<p class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-primary text-lg mb-4">
						<?php echo esc_html( $col2_heading ); ?>
					</p>
					<?php if ( $col2_list ) : ?>
					<ul class="space-y-2">
						<?php foreach ( $col2_list as $bullet ) : ?>
						<li class="flex items-start gap-2">
							<span class="text-primary mt-0.5 flex-shrink-0 leading-none">•</span>
							<span class="font-vollkorn text-white text-base leading-relaxed">
								<?php echo esc_html( $bullet ); ?>
							</span>
						</li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
				</div>
				<?php endif; ?>

			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>

</div>
