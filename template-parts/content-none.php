<?php
/**
 * Template part for displaying a message that posts cannot be found
 * 
 * @package Amorfs_Blog
 */
?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php amorfs_e('no_results_found'); ?></h1>
    </header>
    
    <div class="page-content">
        <?php
        if (is_home() && current_user_can('publish_posts')) :
            
            printf(
                '<p>' . wp_kses(
                    __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'amorfs-blog'),
                    array(
                        'a' => array(
                            'href' => array(),
                        ),
                    )
                ) . '</p>',
                esc_url(admin_url('post-new.php'))
            );
            
        elseif (is_search()) :
            ?>
            
            <p><?php amorfs_e('try_different_keywords'); ?></p>
            <?php
        
            
        else :
            ?>
            
            <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for.', 'amorfs-blog'); ?></p>
            <?php
            
        endif;
        ?>
    </div>
</section>



