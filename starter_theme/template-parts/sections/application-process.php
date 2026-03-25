<?php
/**
 * Application Process Section
 * Reusable via $args. Falls back to get_field() when called without args.
 *
 * Expected $args keys:
 *   eyebrow  (string)
 *   heading  (string)
 *   btn_text (string)
 *   btn_url  (string)
 *   steps    (array)  — each item: [ 'step_title' => '', 'step_desc' => '' ]
 *   theme    (string) — 'light' (default) | 'dark'
 */

$eyebrow  = $args['eyebrow']  ?? get_field( 'app_eyebrow' )  ?? 'What to Expect';
$heading  = $args['heading']  ?? get_field( 'app_heading' )  ?? 'Application Process';
$btn_text = $args['btn_text'] ?? get_field( 'app_btn_text' ) ?? '';
$btn_url  = $args['btn_url']  ?? get_field( 'app_btn_url' )  ?? '';
$steps    = $args['steps']    ?? get_field( 'app_steps' )    ?? array(
    array( 'step_title' => '1 – Eligibility',   'step_desc' => 'Review requirements and gather necessary documents.' ),
    array( 'step_title' => '2 – Apply',          'step_desc' => 'Submit your online application.' ),
    array( 'step_title' => '3 – Review',         'step_desc' => 'We carefully review your submitted application.' ),
    array( 'step_title' => '4 – Decision',       'step_desc' => 'We notify you of our funding decision.' ),
    array( 'step_title' => '5 – Disbursement',   'step_desc' => 'We send funds directly to recipients or service providers.' ),
);
$theme = $args['theme'] ?? 'light';
$dark  = $theme === 'dark';

// Theme tokens
$section_bg  = $dark ? 'bg-secondary'  : 'bg-white';
$heading_cl  = $dark ? 'text-surface'  : 'text-forest';
$step_title  = $dark ? 'text-surface'  : 'text-forest';
$step_desc   = $dark ? 'text-surface/80' : 'text-secondary';
$btn_classes = $dark
    ? 'bg-primary text-secondary hover:brightness-110'
    : 'bg-secondary text-surface hover:brightness-125';
?>

<section class="<?php echo esc_attr( $section_bg ); ?> py-16">
    <div class="max-w-default mx-auto px-4">

        <!-- ── Section Header ──────────────────────────────────────────────── -->
        <div data-animate data-delay="0" class="mb-10">
            <p class="font-barlow-condensed font-semibold uppercase text-accent text-[22px] leading-none tracking-tight mb-2">
                <?php echo esc_html( $eyebrow ); ?>
            </p>
            <h2 class="font-barlow-condensed font-semibold uppercase <?php echo esc_attr( $heading_cl ); ?> leading-none text-5xl xl:text-6xl tracking-tight">
                <?php echo esc_html( $heading ); ?>
            </h2>
        </div>

        <!-- ── Steps Grid ──────────────────────────────────────────────────── -->
        <?php if ( $steps ) : ?>
        <div class="grid grid-cols-1 md:grid-cols-<?php echo count( $steps ) <= 5 ? count( $steps ) : '5'; ?> gap-10">
            <?php
            $delay = 0;
            foreach ( $steps as $step ) :
                $title = $step['step_title'] ?? '';
                $desc  = $step['step_desc']  ?? '';
            ?>
            <div data-animate data-delay="<?php echo esc_attr( $delay ); ?>"
                 class="border-t-2 border-primary pt-10">
                <h3 class="font-barlow-condensed font-semibold uppercase <?php echo esc_attr( $step_title ); ?> text-[32px] leading-none tracking-tight mb-3">
                    <?php echo esc_html( $title ); ?>
                </h3>
                <p class="font-vollkorn <?php echo esc_attr( $step_desc ); ?> text-lg leading-relaxed">
                    <?php echo esc_html( $desc ); ?>
                </p>
            </div>
            <?php $delay += 100; endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- ── CTA Button ──────────────────────────────────────────────────── -->
        <?php if ( $btn_url && $btn_text ) : ?>
        <div data-animate data-delay="0" class="mt-10">
            <a href="<?php echo esc_url( $btn_url ); ?>"
               class="<?php echo esc_attr( $btn_classes ); ?> font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-lg px-8 h-12 inline-flex items-center justify-center rounded-lg transition-all">
                <?php echo esc_html( $btn_text ); ?>
            </a>
        </div>
        <?php endif; ?>

    </div>
</section>
