<?php
/**
 * Template part for displaying results in search pages
 * 
 * @package My_Custom_Blog
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php
    // Post thumbnail
    if (has_post_thumbnail()) {
        my_custom_blog_post_thumbnail('my-custom-blog-thumbnail', true);
    }
    ?>
    
    <header class="entry-header">
        <?php
        the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
        
        if ('post' === get_post_type()) {
            my_custom_blog_post_meta();
        }
        ?>
    </header>
    
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div>
    
    <footer class="entry-footer">
        <a href="<?php echo esc_url(get_permalink()); ?>" class="read-more">
            <?php esc_html_e('Read More', 'my-custom-blog'); ?> &rarr;
        </a>
    </footer>
    
</article>



