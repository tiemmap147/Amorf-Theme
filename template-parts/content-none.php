<?php
/**
 * Template part for displaying a message that posts cannot be found
 * 
 * @package Amorfs_Blog
 */
?>

<section class="no-results not-found">
    <div class="empty-state">
        <!-- Empty State Icon -->
        <div class="empty-state-icon">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/empty.svg'); ?>" 
                 alt="<?php esc_attr_e('No posts found', 'amorfs-blog'); ?>" 
                 class="empty-icon">
        </div>
        
        <!-- Empty State Content -->
        <div class="empty-state-content">
            <h2 class="empty-state-title"><?php amorfs_e('empty_state_title'); ?></h2>
            <p class="empty-state-text"><?php amorfs_e('empty_state_description'); ?></p>
        </div>
    </div>
</section>



