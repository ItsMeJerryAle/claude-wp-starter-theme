<?php
/**
 * FAQ Section — simple single-level accordion, data-agnostic via $args.
 *
 * Expected $args keys:
 *   eyebrow (string) — section eyebrow label (optional)
 *   heading (string) — section heading, default "FAQ"
 *   items   (array)  — repeater rows, each with keys: faq_question (string), faq_answer (string)
 *
 * Used by: page-templates/single-service-default.php (via get_template_part ... $args)
 */

$eyebrow = $args['eyebrow'] ?? '';
$heading = $args['heading'] ?? 'FAQ';
$items   = $args['items']   ?? array();
$bg      = $args['bg']      ?? 'bg-white';

if ( empty( $items ) ) return;
?>

<section class="<?php echo esc_attr( $bg ); ?> py-16">
	<div class="max-w-default mx-auto px-4">

		<?php if ( $eyebrow ) : ?>
		<p data-animate data-delay="0"
		   class="font-barlow-condensed font-semibold uppercase text-accent text-[22px] leading-none tracking-tight mb-3">
			<?php echo esc_html( $eyebrow ); ?>
		</p>
		<?php endif; ?>

		<h2 data-animate data-delay="100"
		    class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-forest text-5xl xl:text-6xl mb-10">
			<?php echo esc_html( $heading ); ?>
		</h2>

		<div id="faq-accordion" class="divide-y divide-primary/30">
			<?php foreach ( $items as $i => $item ) :
				$question = $item['faq_question'] ?? '';
				$answer   = $item['faq_answer']   ?? '';
				$is_open  = ( $i === 0 );
				if ( ! $question ) continue;
			?>
			<div class="faq-item" data-open="<?php echo $is_open ? 'true' : 'false'; ?>">

				<button type="button"
				        class="faq-trigger w-full flex items-center justify-between gap-6 py-6 text-left"
				        aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>">
					<span class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-forest text-2xl md:text-[32px]">
						<?php echo esc_html( $question ); ?>
					</span>
					<span class="faq-icon flex-shrink-0 text-accent w-5 h-5">
						<?php if ( $is_open ) : ?>
						<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round">
							<line x1="2" y1="10" x2="18" y2="10"/>
						</svg>
						<?php else : ?>
						<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round">
							<line x1="10" y1="2" x2="10" y2="18"/>
							<line x1="2" y1="10" x2="18" y2="10"/>
						</svg>
						<?php endif; ?>
					</span>
				</button>

				<div class="faq-body overflow-hidden transition-[max-height] duration-300 ease-in-out"
				     style="max-height: <?php echo $is_open ? '600px' : '0'; ?>;">
					<p class="font-vollkorn text-secondary text-lg leading-relaxed pb-6">
						<?php echo nl2br( esc_html( $answer ) ); ?>
					</p>
				</div>

			</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>

<script>
(function () {
	var accordion = document.getElementById('faq-accordion');
	if ( ! accordion ) return;

	var svgPlus  = '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"><line x1="10" y1="2" x2="10" y2="18"/><line x1="2" y1="10" x2="18" y2="10"/></svg>';
	var svgMinus = '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"><line x1="2" y1="10" x2="18" y2="10"/></svg>';

	accordion.querySelectorAll('.faq-trigger').forEach( function ( trigger ) {
		trigger.addEventListener( 'click', function () {
			var item   = trigger.closest('.faq-item');
			var body   = item.querySelector('.faq-body');
			var icon   = item.querySelector('.faq-icon');
			var isOpen = trigger.getAttribute('aria-expanded') === 'true';

			// Close all items
			accordion.querySelectorAll('.faq-item').forEach( function ( el ) {
				el.querySelector('.faq-trigger').setAttribute( 'aria-expanded', 'false' );
				el.querySelector('.faq-body').style.maxHeight = '0';
				el.querySelector('.faq-icon').innerHTML = svgPlus;
			} );

			// Open the clicked item if it was closed
			if ( ! isOpen ) {
				trigger.setAttribute( 'aria-expanded', 'true' );
				body.style.maxHeight = body.scrollHeight + 'px';
				icon.innerHTML = svgMinus;
			}
		} );
	} );
})();
</script>
