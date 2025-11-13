<?php
/**
 * Template part for displaying author bio
 * 
 * @package My_Custom_Blog
 */

$author_info = my_custom_blog_get_author_info();
?>

<div class="author-bio">
    <div class="author-bio-inner">
        <div class="author-avatar">
            <?php echo $author_info['avatar']; ?>
        </div>
        
        <div class="author-info">
            <h3 class="author-name">
                <a href="<?php echo esc_url($author_info['url']); ?>">
                    <?php echo esc_html($author_info['name']); ?>
                </a>
            </h3>
            
            <div class="author-description">
                <?php echo wp_kses_post($author_info['description']); ?>
            </div>
            
            <div class="author-meta">
                <span class="author-posts-count">
                    <?php
                    printf(
                        _n('%s Post', '%s Posts', $author_info['posts_count'], 'my-custom-blog'),
                        number_format_i18n($author_info['posts_count'])
                    );
                    ?>
                </span>
                
                <a href="<?php echo esc_url($author_info['url']); ?>" class="author-link">
                    <?php esc_html_e('View all posts', 'my-custom-blog'); ?> &rarr;
                </a>
            </div>
        </div>
    </div>
</div>



