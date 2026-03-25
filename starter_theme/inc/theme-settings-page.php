<?php
/**
 * Theme Settings Admin Page
 *
 * Registers a single "Theme Settings" entry in the WP admin sidebar.
 * Navigation between sections is handled by tabs within the page itself —
 * no sub-pages are created in the sidebar menu.
 *
 * Tabs:
 *   site   → Site Settings   (group_site_settings)
 *   header → Header & Topbar (group_topbar, group_header)
 *   footer → Footer          (group_footer)
 */

// ── Process ACF form before headers are sent ──────────────────────────────────
add_action( 'admin_init', function () {
    if (
        is_admin() &&
        isset( $_GET['page'] ) &&
        $_GET['page'] === 'theme-settings' &&
        function_exists( 'acf_form_head' )
    ) {
        acf_form_head();
    }
} );

// ── Register admin menu page ───────────────────────────────────────────────────
add_action( 'admin_menu', function () {
    add_menu_page(
        'Theme Settings',                   // Page title
        'Theme Settings',                   // Menu title
        'edit_posts',                       // Capability
        'theme-settings',                   // Menu slug
        'tail_render_theme_settings_page',  // Callback
        'dashicons-admin-appearance',       // Icon
        61                                  // Position (below Appearance)
    );
} );

// ── Page renderer ─────────────────────────────────────────────────────────────
function tail_render_theme_settings_page() {

    if ( ! function_exists( 'acf_form' ) ) {
        echo '<div class="wrap"><p><strong>ACF Pro</strong> is required for Theme Settings.</p></div>';
        return;
    }

    // Tab definitions — slug => label
    $tabs = [
        'site'   => 'Site Settings',
        'header' => 'Header & Topbar',
        'footer' => 'Footer',
    ];

    // ACF field groups to render per tab
    $tab_groups = [
        'site'   => [ 'group_site_settings' ],
        'header' => [ 'group_topbar', 'group_header' ],
        'footer' => [ 'group_footer' ],
    ];

    // Resolve active tab (default: site)
    $current = (
        isset( $_GET['tab'] ) &&
        array_key_exists( sanitize_key( $_GET['tab'] ), $tabs )
    ) ? sanitize_key( $_GET['tab'] ) : 'site';

    $base_url = admin_url( 'admin.php?page=theme-settings' );

    ?>
    <div class="wrap">

        <h1>Theme Settings</h1>

        <?php if ( isset( $_GET['settings-updated'] ) ) : ?>
            <div class="notice notice-success is-dismissible" style="margin-top:16px;">
                <p><strong><?php echo esc_html( $tabs[ $current ] ); ?></strong> saved successfully.</p>
            </div>
        <?php endif; ?>

        <!-- Tab navigation -->
        <nav class="nav-tab-wrapper wp-clearfix" style="margin-top:16px; margin-bottom:0;">
            <?php foreach ( $tabs as $slug => $label ) :
                $url    = add_query_arg( 'tab', $slug, $base_url );
                $active = $current === $slug ? ' nav-tab-active' : '';
            ?>
                <a href="<?php echo esc_url( $url ); ?>"
                   class="nav-tab<?php echo esc_attr( $active ); ?>">
                    <?php echo esc_html( $label ); ?>
                </a>
            <?php endforeach; ?>
        </nav>

        <!-- ACF form for the active tab -->
        <div style="background:#fff; border:1px solid #c3c4c7; border-top:none; padding:24px;">
            <?php
            acf_form( [
                'post_id'      => 'options',
                'field_groups' => $tab_groups[ $current ],
                'submit_value' => 'Save ' . $tabs[ $current ],
                'return'       => add_query_arg(
                    [ 'tab' => $current, 'settings-updated' => '1' ],
                    $base_url
                ),
            ] );
            ?>
        </div>

    </div>
    <?php
}
