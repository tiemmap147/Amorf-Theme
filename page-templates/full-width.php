<?php
/**
 * Template Name: Full Width (No Sidebar)
 * Template Post Type: page, post
 * 
 * @package My_Custom_Blog
 */

get_header(); ?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="content-area full-width">
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
        </div>
    </div>
</main>

<?php
get_footer();



