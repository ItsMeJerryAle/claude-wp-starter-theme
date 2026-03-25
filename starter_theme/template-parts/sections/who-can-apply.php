<?php
/**
 * Who Can Apply Section — eligibility content only (no sidebar, no section wrapper).
 * Sidebar is rendered by the calling page template inside the sticky layout.
 * Used by: page-templates/single-service-default.php
 *
 * ACF fields: wca_eyebrow, wca_heading, wca_description, wca_criteria (repeater)
 */

$eyebrow     = get_field( 'wca_eyebrow' )     ?: 'Qualification';
$heading     = get_field( 'wca_heading' )     ?: 'Who Can Apply';
$description = get_field( 'wca_description' ) ?: '';
$criteria    = get_field( 'wca_criteria' )    ?: array();
?>

<div class="bg-surface rounded-2xl p-8 mb-24">

	<p data-animate data-delay="0"
	   class="font-barlow-condensed font-semibold uppercase text-accent text-[22px] leading-none tracking-tight mb-3">
		<?php echo esc_html( $eyebrow ); ?>
	</p>

	<h2 data-animate data-delay="100"
	    class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-forest text-5xl xl:text-6xl mb-6">
		<?php echo esc_html( $heading ); ?>
	</h2>

	<?php if ( $description ) : ?>
	<p data-animate data-delay="150"
	   class="font-vollkorn text-secondary text-lg leading-relaxed mb-10 max-w-xl">
		<?php echo esc_html( $description ); ?>
	</p>
	<?php endif; ?>

	<?php if ( $criteria ) : ?>
	<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
		<?php foreach ( $criteria as $i => $item ) :
			$text = $item['criterion_text'] ?? '';
			if ( ! $text ) continue;
		?>
		<div data-animate data-delay="<?php echo esc_attr( 200 + $i * 50 ); ?>"
		     class="flex items-start gap-3 bg-white rounded-xl p-8 pr-16">
			<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center mt-0.5">
				<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
					<polyline 
						points="20,55 40,75 80,25" 
						fill="none" 
						stroke="#F16A46" 
						stroke-width="8" 
						stroke-linecap="butt" 
						stroke-linejoin="miter"
					/>
				</svg>
			</span>
			<span class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-forest text-[22px]">
				<?php echo esc_html( $text ); ?>
			</span>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>

</div>
