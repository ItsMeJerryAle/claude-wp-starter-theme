<?php
/**
 * Template Name: Apply for Funds
 * Template Post Type: service
 *
 * Single template for the "apply-for-funds" service post.
 * Assign via the Template dropdown in the service post editor.
 */

get_header();

$description = get_field( 'service_short_desc' ) ?: get_the_excerpt();
?>

<!-- ── Breadcrumb ──────────────────────────────────────────────────────────── -->
<div class="bg-secondary pt-[97px]">
    <div class="bg-surface">
        <div class="max-w-default mx-auto px-4 py-3 flex items-center gap-2 font-barlow-condensed font-semibold uppercase text-lg leading-none tracking-tight text-secondary">

            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
            class="hover:text-accent transition-colors flex-shrink-0"
            aria-label="Home">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </a>

            <span class="text-primary">|</span>
            <a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>"
            class="hover:text-accent transition-colors">
                Get Support
            </a>

            <span class="text-primary">|</span>
            <span class="text-accent"><?php the_title(); ?></span>

        </div>
    </div>
</div>

<!-- ── Page Hero ───────────────────────────────────────────────────────────── -->
<section class="bg-white py-16 mt-10">
    <div class="max-w-default mx-auto px-4">

        <h1 data-animate data-delay="0"
            class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-forest text-5xl xl:text-[88px] mb-6">
            <?php the_title(); ?>
        </h1>

        <?php if ( $description ) : ?>
        <p data-animate data-delay="100"
           class="font-vollkorn text-secondary text-lg leading-relaxed max-w-2xl">
            <?php echo esc_html( $description ); ?>
        </p>
        <?php endif; ?>

    </div>
</section>

<?php
// ── How We Can Help Section ───────────────────────────────────────────────────
$hwh_heading = get_field( 'hwh_heading' ) ?: 'How We Can Help';
$hwh_columns = get_field( 'hwh_columns' );
if ( $hwh_columns ) :
?>

<section class="bg-white py-16">
    <div class="max-w-default mx-auto px-4">

        <h2 data-animate data-delay="0"
            class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-accent text-4xl xl:text-5xl mb-10">
            <?php echo esc_html( $hwh_heading ); ?>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">

            <?php foreach ( $hwh_columns as $i => $col ) :
                $is_open   = ( $i === 0 );
                $col_title    = $col['column_title']    ?? '';
                $col_subtitle = $col['column_subtitle'] ?? '';
                $col_body     = $col['column_body']     ?? '';
                $col_buttons  = $col['column_buttons']  ?? array();
            ?>

            <div class="bg-surface rounded-2xl py-8 px-6 accordion-card min-h-[160px]"
                 data-open="<?php echo $is_open ? 'true' : 'false'; ?>">

                <!-- Header row — always visible -->
                <div class="flex items-start justify-between gap-4 accordion-trigger cursor-pointer select-none">
                    <div>
                        <h3 class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-secondary text-[32px]">
                            <?php echo esc_html( $col_title ); ?>
                        </h3>
                        <?php if ( $col_subtitle ) : ?>
                        <p class="font-vollkorn text-secondary text-lg mt-2">
                            <?php echo esc_html( $col_subtitle ); ?>
                        </p>
                        <?php endif; ?>
                    </div>
                    <span class="accordion-icon flex-shrink-0 text-accent w-5 h-5 mt-1">
                        <?php if ( $is_open ) : ?>
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"><line x1="2" y1="10" x2="18" y2="10"/></svg>
                        <?php else : ?>
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"><line x1="10" y1="2" x2="10" y2="18"/><line x1="2" y1="10" x2="18" y2="10"/></svg>
                        <?php endif; ?>
                    </span>
                </div>

                <!-- Collapsible body -->
                <div class="accordion-body" style="overflow:hidden; transition: max-height 0.3s ease; max-height: <?php echo $is_open ? '600px' : '0'; ?>;">
                    <?php if ( $col_body ) : ?>
                    <p class="font-vollkorn text-secondary text-sm leading-relaxed mt-5 mb-6">
                        <?php echo nl2br( esc_html( $col_body ) ); ?>
                    </p>
                    <?php endif; ?>

                    <?php if ( $col_buttons ) : ?>
                    <div class="flex flex-wrap gap-3">
                        <?php foreach ( $col_buttons as $btn ) :
                            $btn_text  = $btn['btn_text']  ?? '';
                            $btn_url   = $btn['btn_url']   ?? '#';
                            $btn_style = $btn['btn_style'] ?? 'solid';
                            if ( ! $btn_text ) continue;
                            $btn_classes = $btn_style === 'outline'
                                ? 'border border-secondary text-secondary bg-transparent hover:bg-secondary hover:text-surface'
                                : 'bg-secondary text-surface hover:bg-secondary/90';
                        ?>
                        <a href="<?php echo esc_url( $btn_url ); ?>"
                           class="<?php echo esc_attr( $btn_classes ); ?> font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-lg px-5 h-10 inline-flex items-center rounded transition-all">
                            <?php echo esc_html( $btn_text ); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>

            </div>

            <?php endforeach; ?>

        </div>

    </div>
</section>

<script>
(function () {
    var cards = document.querySelectorAll('.accordion-card');

    function closeCard(c) {
        c.querySelector('.accordion-body').style.maxHeight = '0';
        c.querySelector('.accordion-icon').innerHTML = '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"><line x1="10" y1="2" x2="10" y2="18"/><line x1="2" y1="10" x2="18" y2="10"/></svg>';
        c.setAttribute('data-open', 'false');
    }
    function openCard(c) {
        var body = c.querySelector('.accordion-body');
        body.style.maxHeight = body.scrollHeight + 'px';
        c.querySelector('.accordion-icon').innerHTML = '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"><line x1="2" y1="10" x2="18" y2="10"/></svg>';
        c.setAttribute('data-open', 'true');
    }

    cards.forEach(function (card) {
        card.querySelector('.accordion-trigger').addEventListener('click', function () {
            var isOpen = card.getAttribute('data-open') === 'true';
            cards.forEach(closeCard);
            if (!isOpen) openCard(card);
        });
    });
})();
</script>

<?php endif; ?>

<?php
// ── Application Process Section ───────────────────────────────────────────────
get_template_part( 'template-parts/sections/application-process', null, array(
    'eyebrow'  => get_field( 'app_eyebrow' )  ?: 'What to Expect',
    'heading'  => get_field( 'app_heading' )  ?: 'Application Process',
    'btn_text' => get_field( 'app_btn_text' ) ?: '',
    'btn_url'  => get_field( 'app_btn_url' )  ?: '',
    'steps'    => get_field( 'app_steps' )    ?: array(),
    'theme'    => 'dark',
) );
?>

<?php
// ── FAQ Section — apply-for-funds only ───────────────────────────────────────
$faq_heading = get_field( 'faq_heading' ) ?: 'FAQ';
$faq_tabs    = get_field( 'faq_tabs' );
if ( 'apply-for-funds' === get_post_field( 'post_name', get_the_ID() ) && $faq_tabs ) :
?>
<section class="bg-white py-16">
    <div class="max-w-default mx-auto px-4">

        <h2 data-animate data-delay="0"
            class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-forest text-5xl xl:text-6xl mb-8">
            <?php echo esc_html( $faq_heading ); ?>
        </h2>

        <!-- Tab bar -->
        <div class="inline-flex items-center border border-secondary rounded-full p-1 mb-10 gap-1" role="tablist">
            <?php foreach ( $faq_tabs as $ti => $tab ) : ?>
            <button type="button"
                    class="faq-tab font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-lg px-12 h-9 rounded-full transition-all <?php echo $ti === 0 ? 'bg-secondary text-white' : 'text-secondary hover:bg-secondary/10'; ?>"
                    data-tab="<?php echo esc_attr( $ti ); ?>"
                    role="tab"
                    aria-selected="<?php echo $ti === 0 ? 'true' : 'false'; ?>">
                <?php echo esc_html( $tab['tab_label'] ); ?>
            </button>
            <?php endforeach; ?>
        </div>

        <!-- Tab panels -->
        <?php foreach ( $faq_tabs as $ti => $tab ) :
            $items = $tab['tab_items'] ?? array();
        ?>
        <div class="faq-panel <?php echo $ti !== 0 ? 'hidden' : ''; ?>"
             data-panel="<?php echo esc_attr( $ti ); ?>">
            <?php if ( empty( $items ) ) : ?>
                <p class="font-vollkorn text-secondary/50 text-lg py-6">&nbsp;</p>
            <?php endif; ?>
            <?php foreach ( $items as $ii => $item ) :
                $question = $item['item_question'] ?? '';
                $answer   = $item['item_answer']   ?? '';
                $is_open  = ( $ti === 0 && $ii === 0 );
            ?>
            <div class="faq-item border-b border-primary/40">

                <!-- Question row -->
                <button type="button"
                        class="faq-item-trigger w-full flex items-center justify-between gap-6 py-5 text-left"
                        aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>">
                    <span class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-forest text-[32px]">
                        <?php echo esc_html( $question ); ?>
                    </span>
                    <span class="faq-item-icon flex-shrink-0 text-accent w-5 h-5">
                        <?php if ( $is_open ) : ?>
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"><line x1="2" y1="10" x2="18" y2="10"/></svg>
                        <?php else : ?>
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"><line x1="10" y1="2" x2="10" y2="18"/><line x1="2" y1="10" x2="18" y2="10"/></svg>
                        <?php endif; ?>
                    </span>
                </button>

                <!-- Answer -->
                <div class="faq-item-body overflow-hidden transition-[max-height] duration-300 ease-in-out"
                     style="max-height: <?php echo $is_open ? '400px' : '0'; ?>;">
                    <p class="font-vollkorn text-secondary text-lg leading-relaxed pb-5">
                        <?php echo nl2br( esc_html( $answer ) ); ?>
                    </p>
                </div>

            </div>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>

    </div>
</section>

<script>
(function () {
    // ── Tab switching ─────────────────────────────────────────────────────────
    var tabs   = document.querySelectorAll('.faq-tab');
    var panels = document.querySelectorAll('.faq-panel');

    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var idx = btn.getAttribute('data-tab');

            tabs.forEach(function (t) {
                t.classList.remove('bg-secondary', 'text-white');
                t.classList.add('text-secondary', 'hover:bg-secondary/10');
                t.setAttribute('aria-selected', 'false');
            });
            btn.classList.add('bg-secondary', 'text-white');
            btn.classList.remove('text-secondary', 'hover:bg-secondary/10');
            btn.setAttribute('aria-selected', 'true');

            panels.forEach(function (p) {
                p.classList.toggle('hidden', p.getAttribute('data-panel') !== idx);
            });
        });
    });

    // ── Accordion (one open at a time per panel) ──────────────────────────────
    document.querySelectorAll('.faq-panel').forEach(function (panel) {
        panel.querySelectorAll('.faq-item-trigger').forEach(function (trigger) {
            trigger.addEventListener('click', function () {
                var item    = trigger.closest('.faq-item');
                var body    = item.querySelector('.faq-item-body');
                var icon    = item.querySelector('.faq-item-icon');
                var isOpen  = trigger.getAttribute('aria-expanded') === 'true';

                var svgPlus  = '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"><line x1="10" y1="2" x2="10" y2="18"/><line x1="2" y1="10" x2="18" y2="10"/></svg>';
                var svgMinus = '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"><line x1="2" y1="10" x2="18" y2="10"/></svg>';

                // Close all in this panel
                panel.querySelectorAll('.faq-item-trigger').forEach(function (t) {
                    t.setAttribute('aria-expanded', 'false');
                    t.closest('.faq-item').querySelector('.faq-item-body').style.maxHeight = '0';
                    t.closest('.faq-item').querySelector('.faq-item-icon').innerHTML = svgPlus;
                });

                // Open clicked if it was closed
                if (!isOpen) {
                    trigger.setAttribute('aria-expanded', 'true');
                    body.style.maxHeight = body.scrollHeight + 'px';
                    icon.innerHTML = svgMinus;
                }
            });
        });
    });
})();
</script>

<?php endif; ?>

<?php get_template_part( 'template-parts/sections/cta-contact' ); ?>

<?php get_footer(); ?>
