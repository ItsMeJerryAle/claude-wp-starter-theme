<?php
/**
 * Topbar / Announcement Bar
 * Reads values from ACF Options Page.
 */

$enabled     = get_field( 'topbar_enabled', 'option' );
$message     = get_field( 'topbar_message', 'option' );
$dismissible = get_field( 'topbar_dismissible', 'option' );

if ( ! $enabled || ! $message ) return;
?>

<div id="site-topbar"
     class="relative w-full bg-[#172d35] py-2.5 px-6 text-left md:text-center">

    <p class="text-surface font-vollkorn text-sm leading-relaxed max-w-[65%] md:max-w-none">
        <?php echo esc_html( $message ); ?>
    </p>

    <?php if ( $dismissible ) : ?>
        <button type="button"
                id="topbar-close"
                class="absolute right-5 top-1/2 -translate-y-1/2 text-surface text-xl leading-none opacity-60 hover:opacity-100 transition-opacity"
                aria-label="<?php esc_attr_e( 'Dismiss', 'starter_theme' ); ?>">
            &times;
        </button>
    <?php endif; ?>
</div>

<script>
(function () {
    var bar   = document.getElementById('site-topbar');
    var close = document.getElementById('topbar-close');
    if ( ! bar ) return;
    if ( sessionStorage.getItem('topbar_dismissed') ) {
        bar.style.display = 'none';
        return;
    }
    if ( close ) {
        close.addEventListener('click', function () {
            bar.style.display = 'none';
            sessionStorage.setItem('topbar_dismissed', '1');
        });
    }
})();
</script>
