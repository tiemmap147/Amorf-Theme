<?php
/**
 * Template part for displaying single post content
 * 
 * @package Amorfs_Blog
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
    
    <header class="entry-header">
        <?php
        $categories = get_the_category();
        if (!empty($categories)) :
            ?>
            <div class="entry-categories">
                <span class="category-badge"><?php echo esc_html($categories[0]->name); ?></span>
            </div>
        <?php endif; ?>
        
        <h1 class="entry-title"><?php the_title(); ?></h1>
        
        <div class="entry-meta">
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                <?php echo esc_html(amorfs_get_post_date('d M Y')); ?>
            </time>
            <span class="meta-separator">•</span>
            <span class="reading-time"><?php echo esc_html(my_custom_blog_get_reading_time()); ?></span>
            <span class="meta-separator">•</span>
            <span class="author-name">
                <?php amorfs_e('by'); ?> 
                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                    <?php echo esc_html(get_the_author()); ?>
                </a>
            </span>
        </div>
    </header>
    
    <?php if (has_post_thumbnail()) : ?>
        <div class="entry-featured-image">
            <?php the_post_thumbnail('full'); ?>
        </div>
    <?php endif; ?>
    
    <div class="entry-content">
        <?php
        the_content();
        
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html(amorfs_t('pages')),
            'after'  => '</div>',
        ));
        ?>
    </div>
    
    <footer class="entry-footer">
        <?php
        // Tags
        $tags_list = get_the_tag_list('', ' ');
        if ($tags_list) :
            ?>
            <div class="tags-links">
                <span class="tags-label"><?php amorfs_e('tags_label'); ?></span>
                <?php echo $tags_list; ?>
            </div>
        <?php endif; ?>
    </footer>
    
</article>
