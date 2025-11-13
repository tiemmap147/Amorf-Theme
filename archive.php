<?php
/**
 * The template for displaying archive pages - Amorf's Blog Theme
 * 
 * @package Amorfs_Blog
 */

get_header(); ?>

<main id="primary" class="site-main archive-page">
    <div class="main-container">
        <div class="content-wrapper">
            
            <!-- Category Filter Sidebar (Left) -->
            <aside class="category-sidebar">
                <div class="category-filter">
                    <h3 class="category-filter-title"><?php amorfs_e('all_categories'); ?></h3>
                    <ul class="category-list">
                        <li class="<?php echo !is_category() ? 'active' : ''; ?>">
                            <a href="<?php echo esc_url(home_url('/')); ?>"><?php amorfs_e('all_posts'); ?></a>
                        </li>
                        <?php
                        $categories = get_categories(array(
                            'orderby' => 'name',
                            'order'   => 'ASC',
                            'hide_empty' => true,
                        ));
                        
                        foreach ($categories as $category) {
                            $active_class = (is_category($category->term_id)) ? 'active' : '';
                            printf(
                                '<li class="%s"><a href="%s">%s</a></li>',
                                esc_attr($active_class),
                                esc_url(get_category_link($category->term_id)),
                                esc_html($category->name)
                            );
                        }
                        ?>
                    </ul>
                </div>
            </aside>
            
            <!-- Main Content Area -->
            <div class="main-content-area">
                <?php if (have_posts()) : ?>
                    
                    <header class="archive-header">
                        <?php
                        the_archive_title('<h1 class="archive-title">', '</h1>');
                        the_archive_description('<div class="archive-description">', '</div>');
                        ?>
                    </header>
                    
                    <!-- Blog Grid -->
                    <div class="blog-grid">
                        <?php
                        while (have_posts()) :
                            the_post();
                            get_template_part('template-parts/content', 'grid');
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
            
        </div>
    </div>
</main>

<?php
get_footer();
