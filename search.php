<?php
/**
 * The template for displaying search results
 * 
 * @package Amorfs_Blog
 */

get_header(); ?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="content-area">
            <div class="main-content">
                <?php if (have_posts()) : ?>
                    
                    <header class="page-header">
                        <h1 class="page-title">
                            <?php
                            printf(
                                esc_html(amorfs_t('search_results_for')) . ': %s',
                                '<span>' . get_search_query() . '</span>'
                            );
                            ?>
                        </h1>
                    </header>
                    
                    <div class="posts-list">
                        <?php
                        // Start the Loop
                        while (have_posts()) :
                            the_post();
                            
                            get_template_part('template-parts/content', 'search');
                            
                        endwhile;
                        ?>
                    </div>
                    
                    <?php
                    // Pagination
                    my_custom_blog_pagination();
                    
                else :
                    
                    get_template_part('template-parts/content', 'none');
                    
                endif;
                ?>
            </div>
            
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php
get_footer();



