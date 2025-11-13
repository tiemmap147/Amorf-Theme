<?php
/**
 * The template for displaying 404 pages (not found)
 * 
 * @package My_Custom_Blog
 */

get_header(); ?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="content-area">
            <div class="main-content">
                <section class="error-404 not-found">
                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'my-custom-blog'); ?></h1>
                    </header>
                    
                    <div class="page-content">
                        <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'my-custom-blog'); ?></p>
                        
                        <?php get_search_form(); ?>
                        
                        <div class="widget widget_categories">
                            <h2 class="widget-title"><?php esc_html_e('Most Used Categories', 'my-custom-blog'); ?></h2>
                            <ul>
                                <?php
                                wp_list_categories(array(
                                    'orderby'    => 'count',
                                    'order'      => 'DESC',
                                    'show_count' => 1,
                                    'title_li'   => '',
                                    'number'     => 10,
                                ));
                                ?>
                            </ul>
                        </div>
                        
                        <?php
                        // Recent posts
                        $recent_posts = wp_get_recent_posts(array(
                            'numberposts' => 5,
                            'post_status' => 'publish',
                        ));
                        
                        if ($recent_posts) :
                            ?>
                            <div class="widget widget_recent_entries">
                                <h2 class="widget-title"><?php esc_html_e('Recent Posts', 'my-custom-blog'); ?></h2>
                                <ul>
                                    <?php foreach ($recent_posts as $recent) : ?>
                                        <li>
                                            <a href="<?php echo esc_url(get_permalink($recent['ID'])); ?>">
                                                <?php echo esc_html($recent['post_title']); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php
                        endif;
                        ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();



