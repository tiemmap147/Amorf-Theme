<?php
/**
 * The template for displaying pages
 * 
 * @package My_Custom_Blog
 */

get_header(); ?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="content-area">
            <div class="main-content">
                <?php
                while (have_posts()) :
                    the_post();
                    
                    get_template_part('template-parts/content', 'page');
                    
                    // If comments are open or we have at least one comment, load up the comment template
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    
                endwhile;
                ?>
            </div>
            
            <?php
            // Only show sidebar if not using full-width template
            if (!is_page_template('page-templates/full-width.php')) {
                get_sidebar();
            }
            ?>
        </div>
    </div>
</main>

<?php
get_footer();



