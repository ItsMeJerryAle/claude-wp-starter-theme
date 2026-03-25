<?php
/**
 * Template Name: Get Support Service Template
 * Template Post Type: service
 *
 * Default single template for service CPT posts.
 * Sections: Breadcrumb → Hero → Who Can Apply → Service Details → Application Process → FAQ → Resources → Support
 */

get_header();

$hero_heading     = get_field( 'service_hero_heading' )     ?: get_the_title();
$hero_description = get_field( 'service_hero_description' ) ?: '';
$hero_btn_text    = get_field( 'service_hero_btn_text' )    ?: '';
$hero_btn_url     = get_field( 'service_hero_btn_url' )     ?: '#';
?>

<!-- ── Hero ───────────────────────────────────────────────────────────────── -->
<?php
get_template_part( 'template-parts/sections/hero-inner', null, array(
	'heading'        => $hero_heading,
	'description'    => $hero_description,
	'btn_text'       => $hero_btn_text,
	'btn_url'        => $hero_btn_url,
	'rounded_bottom' => true,
	'items_start'    => true,
) );
?>

<!-- ── Who Can Apply + Service Details + Sticky Sidebar ──────────────────── -->
<?php
$sidebar_heading  = get_field( 'wca_sidebar_heading' )    ?: 'Get Started';
$sidebar_desc     = get_field( 'wca_sidebar_desc' )       ?: '';
$checklist_label  = get_field( 'wca_checklist_label' )    ?: 'What to Have Ready';
$checklist_items  = get_field( 'wca_checklist_items' )    ?: array();
$primary_text     = get_field( 'wca_primary_btn_text' )   ?: 'Apply Now';
$primary_url      = get_field( 'wca_primary_btn_url' )    ?: '#';
$secondary_text   = get_field( 'wca_secondary_btn_text' ) ?: '';
$secondary_url    = get_field( 'wca_secondary_btn_url' )  ?: '#';
?>
<section class="bg-transparent relative z-10 -mt-72">
	<div class="max-w-default mx-auto px-4">
		<div class="grid grid-cols-1 lg:grid-cols-[7fr_3fr] gap-10 items-start">

			<!-- Left 70%: Who Can Apply → Service Details ──────────────────── -->
			<div>
				<?php get_template_part( 'template-parts/sections/who-can-apply' ); ?>
				<?php get_template_part( 'template-parts/sections/service-details-section' ); ?>
			</div>

			<!-- Right 30%: sticky Get Started sidebar ──────────────────────── -->
			<div class="hidden lg:block sticky top-[180px] self-start">
				<div class="bg-[#203942B8] backdrop-blur-md rounded-2xl p-8  shadow-sm">

					<h3 class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-white text-[32px] mb-4">
						<?php echo esc_html( $sidebar_heading ); ?>
					</h3>

					<?php if ( $sidebar_desc ) : ?>
					<p class="font-vollkorn text-white text-lg leading-relaxed mb-6">
						<?php echo esc_html( $sidebar_desc ); ?>
					</p>
					<?php endif; ?>

					<?php if ( $checklist_items ) : ?>
					<p class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-surface text-[22px] mb-4">
						<?php echo esc_html( $checklist_label ); ?>
					</p>
					<ul class="space-y-4 mb-8">
						<?php foreach ( $checklist_items as $check ) :
							$item_text = $check['item_text'] ?? '';
							$item_icon = $check['item_icon'] ?? '';
							if ( ! $item_text ) continue;
						?>
						<li class="flex items-center gap-4">
							<?php if ( $item_icon ) : ?>
								<img src="<?php echo esc_url( $item_icon ); ?>"
								     alt=""
								     class="flex-shrink-0 w-5 h-5 object-contain">
							<?php else : ?>
								<span class="flex-shrink-0 w-5 h-5 rounded-full bg-primary flex items-center justify-center">
									<svg class="w-3 h-3 text-secondary" viewBox="0 0 12 12" fill="none"
									     stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
										<polyline points="1.5,6 4.5,9.5 10.5,2"/>
									</svg>
								</span>
							<?php endif; ?>
							<span class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-white text-lg">
								<?php echo esc_html( $item_text ); ?>
							</span>
						</li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>

					<div class="flex flex-col gap-2">
						<?php if ( $primary_text && $primary_url ) : ?>
						<a href="<?php echo esc_url( $primary_url ); ?>"
						   class="bg-white text-secondary font-barlow-condensed font-bold text-lg tracking-tight uppercase px-8 h-12 inline-flex items-center justify-center transition-all hover:brightness-110 rounded-lg w-full">
							<?php echo esc_html( $primary_text ); ?>
						</a>
						<?php endif; ?>

						<?php if ( $secondary_text && $secondary_url ) : ?>
						<a href="<?php echo esc_url( $secondary_url ); ?>"
						   class="bg-transparent/30 border border-white rounded-lg text-white font-barlow-condensed font-bold text-lg tracking-tight uppercase px-8 h-12 inline-flex items-center justify-center transition-all hover:bg-secondary hover:text-surface w-full">
							<?php echo esc_html( $secondary_text ); ?>
						</a>
						<?php endif; ?>
					</div>

				</div>
			</div>

		</div>
	</div>
</section>

<!-- ── Application Process ───────────────────────────────────────────────── -->
<?php
get_template_part( 'template-parts/sections/application-process', null, array(
	'eyebrow'  => get_field( 'app_eyebrow' )  ?: 'What to Expect',
	'heading'  => get_field( 'app_heading' )  ?: 'Application Process',
	'btn_text' => get_field( 'app_btn_text' ) ?: 'Get Started',
	'btn_url'  => get_field( 'app_btn_url' )  ?: '#',
	'steps'    => get_field( 'app_steps' )    ?: array(),
	'theme'    => 'light',
) );
?>

<!-- ── FAQ ───────────────────────────────────────────────────────────────── -->
<?php
$faq_eyebrow = get_field( 'faq_eyebrow' ) ?: get_the_title();
$faq_heading = get_field( 'faq_heading' ) ?: 'FAQ';
$faq_items   = get_field( 'faq_items' )   ?: array();

if ( $faq_items ) :
	get_template_part( 'template-parts/sections/faq-section', null, array(
		'eyebrow' => $faq_eyebrow,
		'heading' => $faq_heading,
		'items'   => $faq_items,
		'bg'      => 'bg-surface',
	) );
endif;
?>

<!-- ── Resources ─────────────────────────────────────────────────────────── -->
<?php get_template_part( 'template-parts/sections/resources-section' ); ?>

<!-- ── Support ───────────────────────────────────────────────────────────── -->
<?php get_template_part( 'template-parts/sections/support-section' ); ?>

<?php get_footer(); ?>
