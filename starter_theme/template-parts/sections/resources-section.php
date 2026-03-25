<?php
/**
 * Section: Resources — Latest posts in 3-column card grid
 */

$eyebrow        = get_field( 'resources_eyebrow' )         ?: 'Resources';
$heading        = get_field( 'resources_heading' )         ?: 'Latest Guides & Reports';
$view_all_label = get_field( 'resources_view_all_label' )  ?: 'View All Resources';
$view_all_url   = get_field( 'resources_view_all_url' );
$post_count     = intval( get_field( 'resources_post_count' ) ) ?: 3;

$query = new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => $post_count,
    'post_status'    => 'publish',
) );

if ( ! $query->have_posts() ) return;
?>

<section class="bg-white py-16">
    <div class="max-w-default mx-auto px-4">

        <!-- Section Header -->
        <div data-animate data-delay="0" class="flex items-end justify-between mb-8">
            <div>
                <p class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-accent text-[22px] mb-2">
                    <?php echo esc_html( $eyebrow ); ?>
                </p>
                <h2 class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-secondary text-5xl xl:text-6xl">
                    <?php echo esc_html( $heading ); ?>
                </h2>
            </div>
            <?php if ( $view_all_url ) : ?>
                <a href="<?php echo esc_url( $view_all_url ); ?>"
                   class="hidden md:inline font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-secondary text-lg hover:text-accent transition-colors flex-shrink-0 ml-8">
                    <?php echo esc_html( $view_all_label ); ?>
                </a>
            <?php endif; ?>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <?php
            $res_delay = 0;
            while ( $query->have_posts() ) : $query->the_post();
                $categories = get_the_category();
                $cat_name   = $categories ? $categories[0]->name : '';
                $excerpt    = wp_trim_words( get_the_excerpt(), 20, '.' );
            ?>
                <a href="<?php the_permalink(); ?>"
                   data-animate data-delay="<?php echo esc_attr( $res_delay ); ?>"
                   class="border border-gray-200 rounded-2xl p-6 flex flex-col justify-between min-h-[300px] hover:border-secondary/40 transition-colors group"><?php $res_delay += 100; ?>
                    <div>
                        <?php if ( $cat_name ) : ?>
                            <p class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-leaf text-[22px] mb-12">
                                <?php echo esc_html( $cat_name ); ?>
                            </p>
                        <?php endif; ?>
                        <h3 class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-secondary text-3xl mb-4">
                            <?php the_title(); ?>
                        </h3>
                        <p class="font-vollkorn text-secondary text-base leading-relaxed">
                            <?php echo esc_html( $excerpt ); ?>
                        </p>
                    </div>
                    <div class="flex justify-end mt-6">
                        <div class="w-12 h-12 bg-surface rounded-full flex items-center justify-center transition-all group-hover:brightness-95 group-hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/>
                            </svg>
                        </div>
                    </div>
                </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <?php if ( $view_all_url ) : ?>
            <div class="flex justify-end mt-6 md:hidden">
                <a href="<?php echo esc_url( $view_all_url ); ?>"
                   class="font-barlow-condensed font-semibold leading-none tracking-tight uppercase text-secondary text-lg hover:text-accent transition-colors">
                    <?php echo esc_html( $view_all_label ); ?>
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>
