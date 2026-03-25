<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'vollkorn':          ['"Vollkorn"', 'serif'],
                        'barlow-condensed':  ['"Barlow Condensed"', 'sans-serif'],
                    },
                    maxWidth: {
                        'default': '1400px',
                    },
                    colors: {
                        primary:   '#C2D432',
                        secondary: '#203942',
                        accent:    '#F16A46',
                        surface:   '#FBEBBF',
                        forest:    '#4E612C',
                        leaf:      '#879B3B',
                        moss:      '#6D8237',
                    },
                },
            },
        }
    </script>

    <?php wp_head(); ?>

    <style>
        /* ── Primary Nav reset ────────────────────────────── */
        #primary-nav > ul {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        #primary-nav li { position: relative; }
        #primary-nav > ul > li > a {
            display: block;
            color: #ffffff;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 600;
            font-size: 1.125rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            text-decoration: none;
            white-space: nowrap;
            padding-bottom: 3px;
            border-bottom: 2px solid transparent;
            transition: border-color 0.2s;
        }
        #primary-nav > ul > li > a:hover,
        #primary-nav li.current-menu-item > a,
        #primary-nav li.current-page-ancestor > a { border-bottom-color: #F16A46; }

        /* ── Chevron on parent items ──────────────────────── */
        #primary-nav li.menu-item-has-children > a::after {
            content: '';
            display: inline-block;
            width: 6px;
            height: 6px;
            margin-left: 5px;
            vertical-align: middle;
            border-right: 2px solid currentColor;
            border-bottom: 2px solid currentColor;
            transform: rotate(45deg) translateY(-2px);
            transition: transform 0.25s ease;
        }
        #primary-nav li.menu-item-has-children:hover > a::after {
            transform: rotate(-135deg) translateY(2px);
        }

        /* ── Submenu dropdown ─────────────────────────────── */
        #primary-nav .sub-menu {
            position: absolute;
            top: 100%;
            left: 0;
            padding-top: 10px; /* invisible hover bridge — keeps :hover active while cursor moves into dropdown */
            min-width: 200px;
            list-style: none;
            margin: 0;
            z-index: 100;
            opacity: 0;
            transform: translateY(-6px);
            pointer-events: none;
            transition: opacity 0.22s ease, transform 0.22s ease;
        }
        /* Visual box via ::before so it sits below the transparent padding */
        #primary-nav .sub-menu::before {
            content: '';
            position: absolute;
            top: 10px; /* = padding-top */
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(23, 45, 53, 0.97);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.35);
        }
        #primary-nav li.menu-item-has-children:hover > .sub-menu {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }
        #primary-nav .sub-menu li { display: block; position: relative; z-index: 1; }
        #primary-nav .sub-menu a {
            display: block;
            color: rgba(255,255,255,0.85);
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            text-decoration: none;
            white-space: nowrap;
            padding: 9px 20px;
            border-bottom: none;
            transition: color 0.15s, background 0.15s;
        }
        #primary-nav .sub-menu a:hover {
            color: #C2D432;
            background: rgba(255,255,255,0.06);
            border-bottom: none;
        }
        #primary-nav .sub-menu li:first-child a { border-radius: 10px 10px 0 0; }
        #primary-nav .sub-menu li:last-child  a { border-radius: 0 0 10px 10px; }

        /* ── CSS var for header height (used in hero calc) ── */
        :root { --header-h: 0px; }

        /* ── Entrance animation ──────────────────────────── */
        @keyframes tail-fade-up {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        [data-animate] {
            opacity: 0;
        }
        [data-animate].is-visible {
            animation: tail-fade-up 0.6s ease-out forwards;
        }
    </style>
</head>

<body <?php body_class( 'antialiased' ); ?>>

<?php wp_body_open(); ?>

<!-- ═══════════════════════════════════════════════════════
     TOPBAR + HEADER (grouped fixed container)
════════════════════════════════════════════════════════ -->
<div id="site-header-group" class="fixed top-0 z-50 w-full flex flex-col">

<?php get_template_part( 'template-parts/components/topbar' ); ?>

<header id="site-header" class="w-full bg-[#203942]/60 backdrop-blur-md border-b border-white/10">
    <div class="max-w-default mx-auto flex items-center justify-between px-8 py-4">

        <!-- Logo -->
        <div class="flex-shrink-0">
            <?php
            if ( has_custom_logo() ) :
                the_custom_logo();
            else :
            ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-white font-barlow-condensed font-semibold leading-none text-xl tracking-tight uppercase">
                    <?php bloginfo( 'name' ); ?>
                </a>
            <?php endif; ?>
        </div>

        <!-- Primary Navigation (desktop only) -->
        <nav id="primary-nav" class="hidden md:block" aria-label="Primary">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'fallback_cb'    => function () {
                    echo '<ul>
                        <li><a href="#">Get Support</a></li>
                        <li><a href="#">Get Involved</a></li>
                        <li><a href="#">Stories &amp; Impact</a></li>
                        <li><a href="#">Events</a></li>
                        <li><a href="#">Resources</a></li>
                    </ul>';
                },
            ) );
            ?>
        </nav>

        <!-- Right Actions -->
        <div class="flex items-center gap-3 md:gap-5">

            <!-- Search Icon (desktop only) -->
            <button type="button"
                    class="hidden md:block text-white/70 hover:text-white transition-colors"
                    aria-label="Search">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
            </button>

            <!-- Donate Button -->
            <a href="<?php echo esc_url( get_field( 'header_donate_url', 'option' ) ?: '#' ); ?>"
               class="bg-primary text-secondary font-barlow-condensed font-semibold leading-none text-lg tracking-tight uppercase px-6 h-10 inline-flex items-center justify-center transition-all hover:brightness-110 rounded-lg">
                DONATE
            </a>

            <!-- Hamburger (mobile only) -->
            <button id="mobile-menu-open" type="button"
                    class="md:hidden text-white p-1"
                    aria-label="Open menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="6"  x2="21" y2="6"/>
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>

        </div>
    </div>
</header>

<?php if ( is_singular( 'service' ) ) : ?>
<div class="bg-surface w-full">
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
<?php endif; ?>

</div><!-- /#site-header-group -->

<?php
/**
 * Walker: Tailwind-styled mobile nav menu
 */
class Tail_Mobile_Menu_Walker extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="mt-8 pl-0 hidden divide-y divide-white/15 border-y border-white/15">';
    }
    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $has_children = in_array( 'menu-item-has-children', (array) $item->classes );
        if ( $depth === 0 ) {
            $output .= '<li class="list-none mb-4' . ( $has_children ? ' menu-item-has-children' : '' ) . '">';
            if ( $has_children ) {
                $output .= '<a href="' . esc_url( $item->url ) . '" class="flex items-center justify-between w-full font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-accent text-[32px] py-2 no-underline transition-colors">';
                $output .= '<span>' . esc_html( $item->title ) . '</span>';
                $output .= '<svg class="mobile-arrow w-4 h-4 flex-shrink-0 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>';
                $output .= '</a>';
            } else {
                $output .= '<a href="' . esc_url( $item->url ) . '" class="block font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-accent text-[32px] py-2 no-underline hover:text-primary transition-colors">';
                $output .= esc_html( $item->title );
                $output .= '</a>';
            }
        } else {
            $output .= '<li class="list-none py-2">';
            $output .= '<a href="' . esc_url( $item->url ) . '" class="block font-vollkorn text-surface text-2xl py-1 no-underline hover:text-white transition-colors">';
            $output .= esc_html( $item->title );
            $output .= '</a>';
        }
    }
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</li>';
    }
}
?>

<!-- ═══════════════════════════════════════════════════════
     MOBILE MENU OVERLAY
════════════════════════════════════════════════════════ -->
<div id="mobile-menu-overlay"
     class="fixed inset-0 z-[100] bg-secondary flex flex-col px-8 py-8 overflow-y-auto md:hidden opacity-0 pointer-events-none transition-opacity duration-300">

    <!-- Close button -->
    <div class="flex justify-end mb-8">
        <button id="mobile-menu-close" type="button" class="text-white" aria-label="Close menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6"  y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>

    <!-- Mobile Nav Menu -->
    <nav id="mobile-nav" aria-label="Mobile">
        <?php
        wp_nav_menu( array(
            'theme_location' => 'mobile_dialog',
            'container'      => false,
            'depth'          => 2,
            'walker'         => new Tail_Mobile_Menu_Walker(),
            'fallback_cb'    => function () {
                echo '<ul>
                    <li class="list-none mb-4 menu-item-has-children">
                        <a href="#" class="flex items-center justify-between w-full font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-accent text-[32px] py-2 no-underline transition-colors">
                            <span>About</span>
                            <svg class="mobile-arrow w-4 h-4 flex-shrink-0 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                        </a>
                        <ul class="mt-8 pl-0 hidden divide-y divide-white/15 border-y border-white/15">
                            <li class="list-none py-2"><a href="#" class="block font-vollkorn text-surface text-2xl py-1 no-underline hover:text-white transition-colors">About Us</a></li>
                            <li class="list-none py-2"><a href="#" class="block font-vollkorn text-surface text-2xl py-1 no-underline hover:text-white transition-colors">Careers</a></li>
                            <li class="list-none py-2"><a href="#" class="block font-vollkorn text-surface text-2xl py-1 no-underline hover:text-white transition-colors">Contact</a></li>
                        </ul>
                    </li>
                    <li class="list-none mb-4"><a href="#" class="block font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-accent text-[32px] py-2 no-underline hover:text-primary transition-colors">Get Support</a></li>
                    <li class="list-none mb-4"><a href="#" class="block font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-accent text-[32px] py-2 no-underline hover:text-primary transition-colors">Get Involved</a></li>
                    <li class="list-none mb-4"><a href="#" class="block font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-accent text-[32px] py-2 no-underline hover:text-primary transition-colors">Resources</a></li>
                    <li class="list-none mb-4"><a href="#" class="block font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-accent text-[32px] py-2 no-underline hover:text-primary transition-colors">Contact</a></li>
                    <li class="list-none mb-4"><a href="#" class="block font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-accent text-[32px] py-2 no-underline hover:text-primary transition-colors">Donate</a></li>
                </ul>';
            },
        ) );
        ?>
    </nav>

    <!-- Contact Details -->
    <div class="mt-auto pt-8">
        <?php
        $phone = get_field( 'site_phone', 'option' );
        $email = get_field( 'site_email', 'option' );
        ?>
        <?php if ( $phone ) : ?>
            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"
               class="block font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-surface text-[32px] mb-2 hover:text-primary transition-colors">
                <?php echo esc_html( $phone ); ?>
            </a>
        <?php endif; ?>
        <?php if ( $email ) : ?>
            <a href="mailto:<?php echo esc_attr( $email ); ?>"
               class="block font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-surface text-[32px] mb-6 hover:text-primary transition-colors">
                <?php echo esc_html( $email ); ?>
            </a>
        <?php endif; ?>

        <!-- Social Icons -->
        <div class="flex items-center gap-3">
            <?php
            $socials = array(
                'facebook'  => array( 'url' => get_field( 'site_facebook_url', 'option' ), 'label' => 'Facebook', 'svg' => '<svg fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="w-5 h-5"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>' ),
                'youtube'   => array( 'url' => get_field( 'site_youtube_url', 'option' ),  'label' => 'YouTube',  'svg' => '<svg fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="w-5 h-5"><rect x="2" y="7" width="20" height="14" rx="3"/><polygon points="10 9 10 17 17 13"/></svg>' ),
                'linkedin'  => array( 'url' => get_field( 'site_linkedin_url', 'option' ), 'label' => 'LinkedIn', 'svg' => '<svg fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="w-5 h-5"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>' ),
                'instagram' => array( 'url' => get_field( 'site_instagram_url', 'option' ),'label' => 'Instagram','svg' => '<svg fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="w-5 h-5"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.5" fill="currentColor" stroke="none"/></svg>' ),
            );
            foreach ( $socials as $social ) :
                if ( empty( $social['url'] ) ) continue;
            ?>
            <a href="<?php echo esc_url( $social['url'] ); ?>"
               aria-label="<?php echo esc_attr( $social['label'] ); ?>"
               class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-secondary hover:brightness-110 transition-all">
                <?php echo $social['svg']; ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<script>
(function () {
    var overlay = document.getElementById('mobile-menu-overlay');
    var openBtn  = document.getElementById('mobile-menu-open');
    var closeBtn = document.getElementById('mobile-menu-close');
    if ( ! overlay || ! openBtn || ! closeBtn ) return;

    function openMenu() {
        overlay.classList.remove('opacity-0', 'pointer-events-none');
        overlay.classList.add('opacity-100');
        document.body.style.overflow = 'hidden';
    }
    function closeMenu() {
        overlay.classList.remove('opacity-100');
        overlay.classList.add('opacity-0', 'pointer-events-none');
        document.body.style.overflow = '';
    }

    openBtn.addEventListener('click', openMenu);
    closeBtn.addEventListener('click', closeMenu);

    // Accordion: toggle sub-menus (Walker already injected arrow SVG)
    document.querySelectorAll('#mobile-nav li.menu-item-has-children > a').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            var li      = link.parentElement;
            var submenu = li.querySelector('ul');
            var arrow   = link.querySelector('.mobile-arrow');
            var isOpen  = !submenu.classList.contains('hidden');

            // Close all open items
            document.querySelectorAll('#mobile-nav li.menu-item-has-children').forEach(function (el) {
                var sm = el.querySelector('ul');
                var ar = el.querySelector('a .mobile-arrow');
                if ( sm ) sm.classList.add('hidden');
                if ( ar ) ar.classList.remove('rotate-180');
                el.querySelector('a').classList.remove('text-primary');
                el.querySelector('a').classList.add('text-accent');
            });

            // Open clicked if it was closed
            if ( ! isOpen && submenu ) {
                submenu.classList.remove('hidden');
                if ( arrow ) arrow.classList.add('rotate-180');
                link.classList.remove('text-accent');
                link.classList.add('text-primary');
            }
        });
    });
})();
</script>

<script>
// Expose header height as CSS var so hero section can fill remaining viewport
(function () {
    var h = document.getElementById('site-header-group');
    if ( h ) {
        document.documentElement.style.setProperty('--header-h', h.offsetHeight + 'px');
    }
})();
</script>
