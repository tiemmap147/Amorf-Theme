<?php
/**
 * Template part for displaying posts in grid layout
 * 
 * @package Amorfs_Blog
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-card'); ?>>
    
    <div class="card-thumbnail">
        <a href="<?php echo esc_url(get_permalink()); ?>">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large'); ?>
            <?php else : ?>
                <div class="card-thumbnail-placeholder">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.svg'); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="placeholder-logo-medium">
                </div>
            <?php endif; ?>
        </a>
        <?php
        $categories = get_the_category();
        if (!empty($categories)) :
            ?>
            <span class="card-category-badge"><?php echo esc_html($categories[0]->name); ?></span>
        <?php endif; ?>
    </div>
    
    <div class="card-content">
        <h3 class="card-title">
            <a href="<?php echo esc_url(get_permalink()); ?>">
                <?php the_title(); ?>
            </a>
        </h3>
        
        <div class="card-excerpt">
            <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
        </div>
        
        <div class="card-meta">
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                <?php echo esc_html(amorfs_get_post_date('d M Y')); ?>
            </time>
            <span class="meta-separator">•</span>
            <span class="reading-time"><?php echo esc_html(my_custom_blog_get_reading_time()); ?></span>
        </div>
    </div>
    
</article>


