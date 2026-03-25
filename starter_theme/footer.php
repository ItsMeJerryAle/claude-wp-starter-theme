<?php
/**
 * Footer Template
 */

// ACF Options — Contact (Site Settings)
$address   = get_field( 'site_address',        'option' ) ?: "808 W Eisenhower Blvd, Ste 202\nLoveland, CO 80537";
$phone     = get_field( 'site_phone',          'option' ) ?: '(970) 617-2575';
$email     = get_field( 'site_email',          'option' ) ?: 'info@bridgewell.org';
$fb_url    = get_field( 'site_facebook_url',   'option' );
$yt_url    = get_field( 'site_youtube_url',    'option' );
$li_url    = get_field( 'site_linkedin_url',   'option' );
$ig_url    = get_field( 'site_instagram_url',  'option' );

// ACF Options — Newsletter
$mc_url            = get_field( 'footer_mailchimp_url',      'option' );
$newsletter_heading = get_field( 'footer_newsletter_heading', 'option' ) ?: 'Stay Connected';

// ACF Options — Legal
$copyright        = get_field( 'footer_copyright',         'option' ) ?: '© ' . date('Y') . ' BridgeWell Foundation. All rights reserved.';
$privacy_url      = get_field( 'footer_privacy_url',       'option' );
$accessibility_url = get_field( 'footer_accessibility_url', 'option' );
$badge_1          = get_field( 'footer_badge_1',           'option' );
$badge_2          = get_field( 'footer_badge_2',           'option' );
?>

<style>
.footer-nav ul { list-style: none; margin: 0; padding: 0; }
.footer-nav li { margin-bottom: 0.75rem; }
.footer-nav li a {
    font-family: 'Vollkorn', serif;
    font-size: 1.125rem;
    color: #FBEBBF;
    text-decoration: none;
    transition: color 0.2s;
}
.footer-nav li a:hover { color: #fff; }

</style>

<footer class="bg-secondary text-white">
    <div class="max-w-default mx-auto px-4">

        <!-- Row 1: Nav Menus (4 columns) -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 py-16">

            <?php
            $footer_menus = array(
                'footer_about'        => 'About',
                'footer_get_support'  => 'Get Support',
                'footer_get_involved' => 'Get Involved',
                'footer_resources'    => 'Resources',
            );
            $footer_delay = 0;
            foreach ( $footer_menus as $location => $label ) :
            ?>
            <div data-animate data-delay="<?php echo esc_attr( $footer_delay ); ?>"><?php $footer_delay += 100; ?>
                <h4 class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-accent text-[32px] mb-6">
                    <?php echo esc_html( $label ); ?>
                </h4>
                <nav class="footer-nav" aria-label="<?php echo esc_attr( $label ); ?>">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => $location,
                        'container'      => false,
                        'fallback_cb'    => false,
                        'depth'          => 1,
                    ) );
                    ?>
                </nav>
            </div>
            <?php endforeach; ?>

        </div>

        <hr class="border-white/20">

        <!-- Row 2: Contact + Newsletter -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 py-12">

            <!-- Left: Contact -->
            <div data-animate data-delay="0">
                <h4 class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-accent text-[32px] mb-6">
                    Contact
                </h4>
                <?php if ( $address ) : ?>
                    <p class="font-vollkorn text-surface text-base leading-relaxed mb-3">
                        <?php echo wp_kses( nl2br( esc_html( $address ) ), array( 'br' => array() ) ); ?>
                    </p>
                <?php endif; ?>
                <?php if ( $phone ) : ?>
                    <p class="font-vollkorn text-surface text-base mb-1">
                        <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"
                           class="hover:text-white transition-colors">
                            <?php echo esc_html( $phone ); ?>
                        </a>
                    </p>
                <?php endif; ?>
                <?php if ( $email ) : ?>
                    <p class="font-vollkorn text-surface text-base mb-6">
                        <a href="mailto:<?php echo esc_attr( $email ); ?>"
                           class="hover:text-white transition-colors">
                            <?php echo esc_html( $email ); ?>
                        </a>
                    </p>
                <?php endif; ?>

                <!-- Social Icons -->
                <div class="flex gap-3">
                    <?php if ( $fb_url ) : ?>
                    <a href="<?php echo esc_url( $fb_url ); ?>" target="_blank" rel="noopener"
                       class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-secondary hover:brightness-110 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                        </svg>
                    </a>
                    <?php endif; ?>
                    <?php if ( $yt_url ) : ?>
                    <a href="<?php echo esc_url( $yt_url ); ?>" target="_blank" rel="noopener"
                       class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-secondary hover:brightness-110 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <rect x="2" y="6" width="20" height="12" rx="3"/>
                            <polygon points="10,9 16,12 10,15" stroke="currentColor" stroke-width="1.5" fill="none"/>
                        </svg>
                    </a>
                    <?php endif; ?>
                    <?php if ( $li_url ) : ?>
                    <a href="<?php echo esc_url( $li_url ); ?>" target="_blank" rel="noopener"
                       class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-secondary hover:brightness-110 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4V9h4v2a6 6 0 0 1 2-3z"/>
                            <rect x="2" y="9" width="4" height="12"/>
                            <circle cx="4" cy="4" r="2"/>
                        </svg>
                    </a>
                    <?php endif; ?>
                    <?php if ( $ig_url ) : ?>
                    <a href="<?php echo esc_url( $ig_url ); ?>" target="_blank" rel="noopener"
                       class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-secondary hover:brightness-110 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5"/>
                            <circle cx="12" cy="12" r="4"/>
                            <circle cx="17.5" cy="6.5" r="0.5" fill="currentColor"/>
                        </svg>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right: Stay Connected (MailChimp) -->
            <div data-animate data-delay="150">
                <h4 class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-accent text-[32px] mb-6">
                    <?php echo esc_html( $newsletter_heading ); ?>
                </h4>

                <?php if ( $mc_url ) : ?>
                <form action="<?php echo esc_url( $mc_url ); ?>" method="post" target="_blank" novalidate>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                        <input type="text" name="FNAME" placeholder="First Name"
                               class="w-full bg-transparent border border-white/30 rounded-lg px-4 h-12 text-white font-vollkorn text-base placeholder-white/40 focus:outline-none focus:border-primary transition-colors">
                        <input type="text" name="LNAME" placeholder="Last Name"
                               class="w-full bg-transparent border border-white/30 rounded-lg px-4 h-12 text-white font-vollkorn text-base placeholder-white/40 focus:outline-none focus:border-primary transition-colors">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4">
                        <input type="email" name="EMAIL" placeholder="Email" required
                               class="w-full bg-transparent border border-white/30 rounded-lg px-4 h-12 text-white font-vollkorn text-base placeholder-white/40 focus:outline-none focus:border-primary transition-colors">
                        <input type="tel" name="MPHONE" placeholder="Mobile (Optional)"
                               class="w-full bg-transparent border border-white/30 rounded-lg px-4 h-12 text-white font-vollkorn text-base placeholder-white/40 focus:outline-none focus:border-primary transition-colors">
                    </div>

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="gdpr[sms]" value="Y"
                                   class="w-4 h-4 accent-primary">
                            <span class="font-vollkorn text-white/70 text-sm">I agree to receive SMS updates.</span>
                        </label>
                        <button type="submit"
                                class="w-full md:w-auto flex-shrink-0 bg-primary text-secondary font-barlow-condensed font-semibold leading-none text-lg tracking-tight uppercase px-6 h-12 inline-flex items-center justify-center transition-all hover:brightness-110 rounded-lg">
                            Send Request
                        </button>
                    </div>

                    <!-- MailChimp bot trap -->
                    <div style="position:absolute;left:-5000px" aria-hidden="true">
                        <input type="text" name="b_placeholder" tabindex="-1" value="">
                    </div>

                </form>
                <?php else : ?>
                    <p class="font-vollkorn text-leaf text-sm italic">Newsletter form URL not configured. Add it in Theme Settings → Footer → Newsletter.</p>
                <?php endif; ?>
            </div>

        </div>

        <hr class="border-white/20">

        <!-- Row 3: Copyright Bar -->
        <div data-animate data-delay="0" class="flex flex-col md:flex-row md:flex-wrap md:items-center md:justify-between gap-4 py-6">

            <!-- Copyright -->
            <p class="font-vollkorn text-leaf text-sm">
                <?php echo esc_html( $copyright ); ?>
            </p>

            <!-- Legal Links -->
            <div class="flex gap-6">
                <?php if ( $privacy_url ) : ?>
                    <a href="<?php echo esc_url( $privacy_url ); ?>"
                       class="font-vollkorn text-leaf text-sm hover:text-white transition-colors">Privacy</a>
                <?php endif; ?>
                <?php if ( $accessibility_url ) : ?>
                    <a href="<?php echo esc_url( $accessibility_url ); ?>"
                       class="font-vollkorn text-leaf text-sm hover:text-white transition-colors">Accessibility</a>
                <?php endif; ?>
            </div>

            <!-- Badges -->
            <div class="flex items-center gap-3">
                <?php if ( $badge_1 ) : ?>
                    <img src="<?php echo esc_url( $badge_1 ); ?>" alt="Transparency Badge" class="h-14 w-auto">
                <?php endif; ?>
                <?php if ( $badge_2 ) : ?>
                    <img src="<?php echo esc_url( $badge_2 ); ?>" alt="Charity Navigator Badge" class="h-14 w-auto">
                <?php endif; ?>
            </div>

        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
