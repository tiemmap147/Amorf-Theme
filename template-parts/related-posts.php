<?php
/**
 * Template part for displaying related posts
 * 
 * @package Amorfs_Blog
 */

$related_posts = my_custom_blog_get_related_posts(get_the_ID(), 3);

if (empty($related_posts)) {
    return;
}
?>

<div class="related-posts">
    <h3 class="related-posts-title"><?php amorfs_e('related_posts'); ?></h3>
    
    <div class="related-posts-grid">
        <?php foreach ($related_posts as $post) : setup_postdata($post); ?>
            <article class="related-post">
                <div class="related-post-thumbnail">
                    <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                        <?php if (has_post_thumbnail($post->ID)) : ?>
                            <?php echo get_the_post_thumbnail($post->ID, 'my-custom-blog-thumbnail'); ?>
                        <?php else : ?>
                            <div class="related-post-placeholder">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.svg'); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="placeholder-logo-related">
                            </div>
                        <?php endif; ?>
                    </a>
                </div>
                
                <div class="related-post-content">
                    <h4 class="related-post-title">
                        <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                            <?php echo esc_html(get_the_title($post->ID)); ?>
                        </a>
                    </h4>
                    
                    <div class="related-post-meta">
                        <time datetime="<?php echo esc_attr(get_the_date('c', $post->ID)); ?>">
                            <?php echo esc_html(amorfs_get_post_date('d M Y', $post->ID)); ?>
                        </time>
                    </div>
                </div>
            </article>
        <?php endforeach; wp_reset_postdata(); ?>
    </div>
</div>



