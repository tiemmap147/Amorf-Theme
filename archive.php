<?php
/**
 * The template for displaying archive pages - Amorf's Blog Theme
 * 
 * @package Amorfs_Blog
 */

get_header(); ?>

<main id="primary" class="site-main">
    <div class="main-container">
        
        <!-- Main Content Area with Sidebar -->
        <div class="content-with-sidebar">
            
            <!-- Category Sidebar (Left) -->
            <aside class="category-sidebar-left">
                <div class="category-filter-box">
                    <ul class="category-list">
                        <!-- All Categories - Always first and styled differently -->
                        <li class="category-all <?php echo !is_category() ? 'active' : ''; ?>">
                            <a href="<?php echo esc_url(home_url('/')); ?>" data-category-id="0">
                                <?php amorfs_e('all_categories'); ?>
                            </a>
                        </li>
                        
                        <?php
                        // Get actual categories
                        $categories = get_categories(array(
                            'orderby' => 'name',
                            'order'   => 'ASC',
                            'hide_empty' => true,
                        ));
                        
                        // Display categories with their real names
                        foreach ($categories as $category) {
                            $active_class = (is_category($category->term_id)) ? 'active' : '';
                            printf(
                                '<li class="%s"><a href="%s" data-category-id="%d">%s</a></li>',
                                esc_attr($active_class),
                                esc_url(get_category_link($category->term_id)),
                                esc_attr($category->term_id),
                                esc_html($category->name)
                            );
                        }
                        ?>
                    </ul>
                </div>
            </aside>
            
            <!-- Main Blog Grid (Right) -->
            <div class="main-blog-content">
                
                <!-- Header with Category Title and Search -->
                <div class="blog-content-header">
                    <div class="category-title-wrapper">
                        <?php
                        // Get current category info
                        global $wp_query;
                        
                        if (is_category()) {
                            $current_category = get_queried_object();
                            $category_name = $current_category->name;
                            $post_count = $current_category->count;
                        } elseif (is_tag()) {
                            $current_tag = get_queried_object();
                            $category_name = sprintf('%s: %s', amorfs_t('tag_archive'), $current_tag->name);
                            $post_count = $current_tag->count;
                        } elseif (is_author()) {
                            $category_name = sprintf('%s: %s', amorfs_t('author_archive'), get_the_author());
                            $post_count = count_user_posts(get_the_author_meta('ID'));
                        } elseif (is_date()) {
                            $category_name = get_the_archive_title();
                            $post_count = $wp_query->found_posts;
                        } else {
                            $category_name = amorfs_t('archive');
                            $post_count = $wp_query->found_posts;
                        }
                        ?>
                        <h2 class="current-category-title">
                            <?php echo esc_html($category_name); ?> 
                            <span class="post-count">(<?php echo esc_html($post_count); ?>)</span>
                        </h2>
                    </div>
                    
                    <div class="blog-search-wrapper">
                        <div class="blog-search-form">
                            <svg class="blog-search-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M19 19L14.65 14.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <input type="search" 
                                   class="blog-search-input" 
                                   placeholder="<?php echo esc_attr_x('Search', 'placeholder', 'amorfs-blog'); ?>" 
                                   autocomplete="off"
                                   data-search-active="false" />
                        </div>
                    </div>
                </div>
                
                <?php if (have_posts()) : ?>
                    
                    <!-- Blog Grid -->
                    <div class="blog-grid-2col">
                        <?php
                        while (have_posts()) :
                            the_post();
                            ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card-item'); ?>>
                                
                                <div class="blog-card-image">
                                    <a href="<?php echo esc_url(get_permalink()); ?>">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('large'); ?>
                                        <?php else : ?>
                                            <div class="blog-card-placeholder">
                                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.svg'); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="placeholder-logo">
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                </div>
                                
                                <div class="blog-card-content">
                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) :
                                    ?>
                                        <span class="blog-card-category"><?php echo esc_html(strtoupper($categories[0]->name)); ?></span>
                                    <?php endif; ?>
                                    
                                    <h3 class="blog-card-title">
                                        <a href="<?php echo esc_url(get_permalink()); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    
                                    <div class="blog-card-excerpt">
                                        <?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?>
                                    </div>
                                    
                                    <div class="blog-card-meta">
                                        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                            <?php echo esc_html(amorfs_get_post_date('d M Y')); ?>
                                        </time>
                                        <span class="meta-separator">•</span>
                                        <span class="reading-time"><?php echo esc_html(my_custom_blog_get_reading_time()); ?></span>
                                    </div>
                                </div>
                                
                            </article>
                            <?php
                        endwhile;
                        ?>
                    </div>
                    
                    <?php
                    // Pagination
                    my_custom_blog_pagination();
                    ?>
                    
                <?php else : ?>
                    
                    <?php get_template_part('template-parts/content', 'none'); ?>
                    
                <?php endif; ?>
                
            </div>
            
        </div>
        
    </div>
</main>

<?php
get_footer();
