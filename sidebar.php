<?php
/**
 * The sidebar template file - Amorf's Blog Theme
 * 
 * @package Amorfs_Blog
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="sidebar widget-area" role="complementary">
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside>
