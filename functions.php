<?php
/**
 * Amorf's Blog Theme Functions
 * 
 * @package Amorfs_Blog
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Force disable template caching for development
if (!defined('WP_CACHE')) {
    define('WP_CACHE', false);
}

// Clear template cache on theme switch/update
function amorfs_clear_template_cache() {
    if (function_exists('wp_cache_flush')) {
        wp_cache_flush();
    }
    
    // Clear transients
    global $wpdb;
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '%_transient_%'");
    
    // Clear LiteSpeed Cache
    if (defined('LSCWP_V')) {
        do_action('litespeed_purge_all');
    }
}
add_action('after_switch_theme', 'amorfs_clear_template_cache');
add_action('upgrader_process_complete', 'amorfs_clear_template_cache');

// Add admin menu for cache clearing
function amorfs_add_cache_clear_button() {
    add_management_page(
        'Clear Cache',
        'Clear Cache',
        'manage_options',
        'amorfs-clear-cache',
        'amorfs_clear_cache_page'
    );
}
add_action('admin_menu', 'amorfs_add_cache_clear_button');

// Cache clearing page
function amorfs_clear_cache_page() {
    if (!current_user_can('manage_options')) {
        wp_die('You do not have permission to access this page.');
    }
    
    ?>
    <div class="wrap">
        <h1>Clear All Caches</h1>
        
        <?php
        if (isset($_POST['clear_cache']) && check_admin_referer('amorfs_clear_cache_action')) {
            // Clear WordPress cache
            if (function_exists('wp_cache_flush')) {
                wp_cache_flush();
                echo '<div class="notice notice-success"><p>✓ WordPress object cache cleared</p></div>';
            }
            
            // Clear transients
            global $wpdb;
            $deleted = $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '%_transient_%'");
            echo '<div class="notice notice-success"><p>✓ Transients cleared (' . $deleted . ' items)</p></div>';
            
            // Clear LiteSpeed Cache
            if (defined('LSCWP_V')) {
                do_action('litespeed_purge_all');
                echo '<div class="notice notice-success"><p>✓ LiteSpeed Cache purged</p></div>';
            }
            
            // Clear OPcache
            if (function_exists('opcache_reset')) {
                opcache_reset();
                echo '<div class="notice notice-success"><p>✓ OPcache cleared</p></div>';
            }
            
            echo '<div class="notice notice-success is-dismissible"><p><strong>All caches cleared successfully!</strong><br>Now refresh your website with Ctrl+Shift+R (or Cmd+Shift+R on Mac)</p></div>';
        }
        ?>
        
        <form method="post" action="">
            <?php wp_nonce_field('amorfs_clear_cache_action'); ?>
            <p>Click the button below to clear all caches (WordPress, Transients, LiteSpeed, OPcache).</p>
            <p class="submit">
                <input type="submit" name="clear_cache" class="button button-primary" value="Clear All Caches">
            </p>
        </form>
        
        <hr>
        
        <h2>Alternative Methods:</h2>
        <ol>
            <li><strong>Switch Theme:</strong> Go to Appearance → Themes, activate another theme, then activate this theme again.</li>
            <li><strong>LiteSpeed Plugin:</strong> Go to LiteSpeed Cache → Toolbox → Purge → Purge All</li>
            <li><strong>Browser Cache:</strong> Press Ctrl+Shift+R (Windows) or Cmd+Shift+R (Mac) on your website</li>
        </ol>
    </div>
    <?php
}

// ============================================================================
// Theme Setup
// ============================================================================

/**
 * Setup theme defaults and register support for various WordPress features
 */
function amorfs_blog_setup() {
    // Make theme available for translation
    load_theme_textdomain('amorfs-blog', get_template_directory() . '/languages');
    
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');
    
    // Let WordPress manage the document title
    add_theme_support('title-tag');
    
    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    
    // Set default thumbnail size
    set_post_thumbnail_size(1200, 630, true);
    
    // Add additional image sizes
    add_image_size('amorfs-featured', 1200, 630, true);
    add_image_size('amorfs-card', 600, 400, true);
    add_image_size('amorfs-thumbnail', 150, 150, true);
    
    // Register navigation menus
    register_nav_menus(array(
        'primary'        => esc_html__('Primary Menu', 'amorfs-blog'),
        'footer-product' => esc_html__('Footer Product Links', 'amorfs-blog'),
        'footer-support' => esc_html__('Footer Support Links', 'amorfs-blog'),
        'footer-policy'  => esc_html__('Footer Policy Links', 'amorfs-blog'),
    ));
    
    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');
    
    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-width'  => true,
        'flex-height' => true,
    ));
    
    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('css/editor-style.css');
    
    // Add support for responsive embeds
    add_theme_support('responsive-embeds');
    
    // Add support for align wide blocks
    add_theme_support('align-wide');
    
    // Add support for custom background
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
    ));
}
add_action('after_setup_theme', 'amorfs_blog_setup');

// ============================================================================
// Content Width
// ============================================================================

/**
 * Set the content width in pixels
 */
function amorfs_blog_content_width() {
    $GLOBALS['content_width'] = apply_filters('amorfs_blog_content_width', 1200);
}
add_action('after_setup_theme', 'amorfs_blog_content_width', 0);

// ============================================================================
// Enqueue Scripts and Styles
// ============================================================================

/**
 * Enqueue styles and scripts
 */
function amorfs_blog_scripts() {
    // Main stylesheet
    wp_enqueue_style('amorfs-blog-style', get_stylesheet_uri(), array(), '2.0.0');
    
    // Custom CSS
    if (file_exists(get_template_directory() . '/css/custom.css')) {
        wp_enqueue_style('amorfs-blog-custom', get_template_directory_uri() . '/css/custom.css', array(), '2.0.0');
    }
    
    // Single Post specific CSS
    if (is_single() && file_exists(get_template_directory() . '/css/single-post.css')) {
        wp_enqueue_style('amorfs-blog-single-post', get_template_directory_uri() . '/css/single-post.css', array('amorfs-blog-style'), '2.0.0');
    }
    
    // FAQ Page specific CSS and JS
    if (is_page_template('page-templates/faq.php')) {
        wp_enqueue_style('amorfs-blog-faq', get_template_directory_uri() . '/css/faq.css', array('amorfs-blog-style'), '2.0.0');
        wp_enqueue_script('amorfs-blog-faq', get_template_directory_uri() . '/js/faq.js', array(), '2.0.0', true);
    }
    
    // Main JavaScript
    wp_enqueue_script('amorfs-blog-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '2.0.0', true);
    
    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    
    // Localize script for AJAX
    wp_localize_script('amorfs-blog-scripts', 'amorfsBlog', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('amorfs_blog_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'amorfs_blog_scripts');

// ============================================================================
// Widget Areas
// ============================================================================

/**
 * Register widget areas
 */
function amorfs_blog_widgets_init() {
    // Main Sidebar
    register_sidebar(array(
        'name'          => esc_html__('Main Sidebar', 'amorfs-blog'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'amorfs-blog'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // Footer Newsletter Widget Area
    register_sidebar(array(
        'name'          => esc_html__('Footer Newsletter', 'amorfs-blog'),
        'id'            => 'footer-newsletter',
        'description'   => esc_html__('Newsletter signup area in footer', 'amorfs-blog'),
        'before_widget' => '<div id="%1$s" class="footer-newsletter-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="newsletter-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'amorfs_blog_widgets_init');

// ============================================================================
// Custom Post Meta - Reading Time
// ============================================================================

/**
 * Get reading time estimate
 * 
 * @param int $post_id Post ID
 * @return string Reading time text
 */
function my_custom_blog_get_reading_time($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed: 200 words per minute
    
    if ($reading_time < 1) {
        $reading_time = 1;
    }
    
    return sprintf(
        '%s ' . amorfs_t('min_read'),
        $reading_time
    );
}

/**
 * Display reading time
 */
function my_custom_blog_reading_time($post_id = null) {
    echo '<span class="reading-time">' . esc_html(my_custom_blog_get_reading_time($post_id)) . '</span>';
}

// ============================================================================
// Custom Excerpt
// ============================================================================

/**
 * Custom excerpt length
 */
function amorfs_blog_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'amorfs_blog_excerpt_length', 999);

/**
 * Custom excerpt more
 */
function amorfs_blog_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'amorfs_blog_excerpt_more');


// ============================================================================
// Pagination
// ============================================================================

/**
 * Get pagination
 * 
 * @return string HTML markup for pagination
 */
function my_custom_blog_get_pagination() {
    global $wp_query;
    
    if ($wp_query->max_num_pages <= 1) {
        return '';
    }
    
    $output = '<nav class="pagination" role="navigation">';
    $output .= paginate_links(array(
        'mid_size'  => 2,
        'end_size'  => 1,
        'prev_text' => '←',
        'next_text' => '→',
        'type'      => 'plain',
        'before_page_number' => '',
        'after_page_number'  => '',
    ));
    $output .= '</nav>';
    
    return $output;
}

/**
 * Display pagination
 */
function my_custom_blog_pagination() {
    echo my_custom_blog_get_pagination();
}

// ============================================================================
// Body Classes
// ============================================================================

/**
 * Add custom body classes
 */
function amorfs_blog_body_classes($classes) {
    // Add class if sidebar is active
    if (is_active_sidebar('sidebar-1') && !is_page_template('page-templates/full-width.php')) {
        $classes[] = 'has-sidebar';
    }
    
    // Add class for singular pages
    if (is_singular()) {
        $classes[] = 'singular';
    }
    
    // Add class for home page
    if (is_home() || is_front_page()) {
        $classes[] = 'home-page';
    }
    
    return $classes;
}
add_filter('body_class', 'amorfs_blog_body_classes');

// ============================================================================
// Newsletter Signup Handler
// ============================================================================

/**
 * Handle newsletter signup form submission
 */
function amorfs_handle_newsletter_signup() {
    // Verify nonce
    if (!isset($_POST['newsletter_nonce']) || !wp_verify_nonce($_POST['newsletter_nonce'], 'amorfs_newsletter_signup')) {
        wp_die(esc_html__('Security check failed', 'amorfs-blog'));
    }
    
    // Get email
    $email = isset($_POST['newsletter_email']) ? sanitize_email($_POST['newsletter_email']) : '';
    
    if (!is_email($email)) {
        wp_redirect(add_query_arg('newsletter', 'invalid', wp_get_referer()));
        exit;
    }
    
    // Store email (you can integrate with your email service provider here)
    // For now, we'll just store it as a custom option or use it with an email service
    
    // Example: Store in options (for demonstration)
    $subscribers = get_option('amorfs_newsletter_subscribers', array());
    if (!in_array($email, $subscribers)) {
        $subscribers[] = $email;
        update_option('amorfs_newsletter_subscribers', $subscribers);
    }
    
    // Redirect back with success message
    wp_redirect(add_query_arg('newsletter', 'success', wp_get_referer()));
    exit;
}
add_action('admin_post_amorfs_newsletter_signup', 'amorfs_handle_newsletter_signup');
add_action('admin_post_nopriv_amorfs_newsletter_signup', 'amorfs_handle_newsletter_signup');

// ============================================================================
// Featured Post Meta Box
// ============================================================================

/**
 * Add featured post meta box
 */
function amorfs_add_featured_post_meta_box() {
    add_meta_box(
        'amorfs_featured_post',
        esc_html__('Featured Post', 'amorfs-blog'),
        'amorfs_featured_post_meta_box_callback',
        'post',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'amorfs_add_featured_post_meta_box');

/**
 * Featured post meta box callback
 */
function amorfs_featured_post_meta_box_callback($post) {
    wp_nonce_field('amorfs_save_featured_post', 'amorfs_featured_post_nonce');
    $is_featured = get_post_meta($post->ID, '_amorfs_featured_post', true);
    ?>
    <label>
        <input type="checkbox" name="amorfs_featured_post" value="1" <?php checked($is_featured, '1'); ?>>
        <?php esc_html_e('Mark as featured post', 'amorfs-blog'); ?>
    </label>
    <?php
}

/**
 * Save featured post meta
 */
function amorfs_save_featured_post_meta($post_id) {
    // Check nonce
    if (!isset($_POST['amorfs_featured_post_nonce']) || !wp_verify_nonce($_POST['amorfs_featured_post_nonce'], 'amorfs_save_featured_post')) {
        return;
    }
    
    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save or delete meta
    if (isset($_POST['amorfs_featured_post'])) {
        update_post_meta($post_id, '_amorfs_featured_post', '1');
    } else {
        delete_post_meta($post_id, '_amorfs_featured_post');
    }
}
add_action('save_post', 'amorfs_save_featured_post_meta');

// ============================================================================
// Helper Functions - Get Data from WordPress
// ============================================================================

/**
 * Get post metadata formatted
 * 
 * @return string HTML markup for post metadata
 */
function my_custom_blog_get_post_meta() {
    $output = '<div class="entry-meta">';
    
    // Date
    $output .= '<time datetime="' . esc_attr(get_the_date('c')) . '">';
    $output .= esc_html(get_the_date('d M Y'));
    $output .= '</time>';
    
    $output .= '<span class="meta-separator">•</span>';
    
    // Reading time
    $output .= '<span class="reading-time">' . esc_html(my_custom_blog_get_reading_time()) . '</span>';
    
    $output .= '</div>';
    
    return $output;
}

/**
 * Display post metadata
 */
function my_custom_blog_post_meta() {
    echo my_custom_blog_get_post_meta();
}

/**
 * Get post thumbnail with fallback
 * 
 * @param string $size Image size
 * @param bool $link Whether to link to post
 * @return string HTML markup for post thumbnail
 */
function my_custom_blog_get_post_thumbnail($size = 'amorfs-featured', $link = true) {
    if (!has_post_thumbnail()) {
        return '';
    }
    
    $output = '<div class="post-thumbnail">';
    
    if ($link) {
        $output .= '<a href="' . esc_url(get_permalink()) . '" aria-hidden="true" tabindex="-1">';
    }
    
    $output .= get_the_post_thumbnail(get_the_ID(), $size, array(
        'alt' => the_title_attribute(array('echo' => false)),
    ));
    
    if ($link) {
        $output .= '</a>';
    }
    
    $output .= '</div>';
    
    return $output;
}

/**
 * Display post thumbnail
 */
function my_custom_blog_post_thumbnail($size = 'amorfs-featured', $link = true) {
    echo my_custom_blog_get_post_thumbnail($size, $link);
}

/**
 * Get breadcrumbs
 * 
 * @return string HTML markup for breadcrumbs
 */
function my_custom_blog_get_breadcrumbs() {
    if (is_front_page()) {
        return '';
    }
    
    $output = '<nav class="breadcrumbs" aria-label="' . esc_attr__('Breadcrumb', 'amorfs-blog') . '">';
    $output .= '<ol>';
    
    // Home
    $output .= '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'amorfs-blog') . '</a></li>';
    
    if (is_category() || is_single()) {
        $categories = get_the_category();
        if ($categories) {
            $category = $categories[0];
            $output .= '<li><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
        }
        
        if (is_single()) {
            $output .= '<li>' . esc_html(get_the_title()) . '</li>';
        }
    } elseif (is_page()) {
        $output .= '<li>' . esc_html(get_the_title()) . '</li>';
    } elseif (is_tag()) {
        $output .= '<li>' . single_tag_title('', false) . '</li>';
    } elseif (is_author()) {
        $output .= '<li>' . get_the_author() . '</li>';
    } elseif (is_search()) {
        $output .= '<li>' . esc_html__('Search Results', 'amorfs-blog') . '</li>';
    } elseif (is_404()) {
        $output .= '<li>' . esc_html__('404 Error', 'amorfs-blog') . '</li>';
    }
    
    $output .= '</ol>';
    $output .= '</nav>';
    
    return $output;
}

/**
 * Display breadcrumbs
 */
function my_custom_blog_breadcrumbs() {
    echo my_custom_blog_get_breadcrumbs();
}

/**
 * Get related posts
 * 
 * @param int $post_id Post ID
 * @param int $number Number of posts to show
 * @return array Array of post objects
 */
function my_custom_blog_get_related_posts($post_id = null, $number = 3) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $categories = get_the_category($post_id);
    
    if (!$categories) {
        return array();
    }
    
    $category_ids = array();
    foreach ($categories as $category) {
        $category_ids[] = $category->term_id;
    }
    
    $args = array(
        'category__in'        => $category_ids,
        'post__not_in'        => array($post_id),
        'posts_per_page'      => $number,
        'ignore_sticky_posts' => 1,
    );
    
    $related_posts = new WP_Query($args);
    
    return $related_posts->posts;
}

// ============================================================================
// Security & Performance
// ============================================================================

/**
 * Remove WordPress version from head
 */
remove_action('wp_head', 'wp_generator');

/**
 * Disable XML-RPC
 */
add_filter('xmlrpc_enabled', '__return_false');

// ============================================================================
// AJAX Category Filter
// ============================================================================

/**
 * AJAX handler for category filtering
 */
function amorfs_ajax_filter_posts() {
    // Verify nonce
    check_ajax_referer('amorfs_blog_nonce', 'nonce');
    
    // Get parameters
    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    
    // Get 4 most recent post IDs to exclude (same as featured posts)
    // global $wpdb;
    // $featured_ids = $wpdb->get_col(
    //     "SELECT ID FROM {$wpdb->posts} 
    //     WHERE post_type = 'post' 
    //     AND post_status = 'publish' 
    //     ORDER BY post_date DESC 
    //     LIMIT 4"
    // );
    
    // Build query args
    $args = array(
        'posts_per_page' => get_option('posts_per_page', 10),
        'paged'          => $paged,
        'post_status'    => 'publish',
        // 'post__not_in'   => array_map('intval', $featured_ids), 
        // Exclude featured posts
    );
    
    // Add category filter if not "all"
    if ($category_id > 0) {
        $args['cat'] = $category_id;
    }
    
    // Query posts
    $query = new WP_Query($args);
    
    // Build response
    $response = array(
        'success' => true,
        'posts'   => array(),
        'pagination' => '',
    );
    
    if ($query->have_posts()) {
        ob_start();
        
        while ($query->have_posts()) {
            $query->the_post();
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
                            <?php echo esc_html(get_the_date('d M Y')); ?>
                        </time>
                        <span class="meta-separator">•</span>
                        <span class="reading-time"><?php echo esc_html(my_custom_blog_get_reading_time()); ?></span>
                    </div>
                </div>
                
            </article>
            <?php
        }
        
        $response['posts'] = ob_get_clean();
        
        // Get pagination
        if ($query->max_num_pages > 1) {
            ob_start();
            ?>
            <nav class="pagination" role="navigation">
                <?php
                echo paginate_links(array(
                    'total'     => $query->max_num_pages,
                    'current'   => $paged,
                    'mid_size'  => 2,
                    'end_size'  => 1,
                    'prev_text' => '←',
                    'next_text' => '→',
                    'type'      => 'plain',
                    'before_page_number' => '',
                    'after_page_number'  => '',
                ));
                ?>
            </nav>
            <?php
            $response['pagination'] = ob_get_clean();
        }
        
        wp_reset_postdata();
    } else {
        ob_start();
        ?>
        <div class="no-posts-found">
            <h2><?php esc_html_e('No posts found', 'amorfs-blog'); ?></h2>
            <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'amorfs-blog'); ?></p>
        </div>
        <?php
        $response['posts'] = ob_get_clean();
    }
    
    wp_send_json($response);
}
add_action('wp_ajax_filter_posts', 'amorfs_ajax_filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'amorfs_ajax_filter_posts');

// ============================================================================
// Comments Template
// ============================================================================

/**
 * Custom comment list
 */
function amorfs_blog_comment($comment, $args, $depth) {
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
            <footer class="comment-meta">
                <div class="comment-author vcard">
                    <?php echo get_avatar($comment, 50); ?>
                    <?php printf('<b class="fn">%s</b>', get_comment_author_link()); ?>
                </div>
                
                <div class="comment-metadata">
                    <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                        <time datetime="<?php comment_time('c'); ?>">
                            <?php printf('%1$s at %2$s', get_comment_date(), get_comment_time()); ?>
                        </time>
                    </a>
                    <?php edit_comment_link(esc_html__('Edit', 'amorfs-blog'), '<span class="edit-link">', '</span>'); ?>
                </div>
            </footer>

            <div class="comment-content">
                <?php comment_text(); ?>
            </div>

            <div class="reply">
                <?php
                comment_reply_link(array_merge($args, array(
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth'],
                )));
                ?>
            </div>
        </article>
    <?php
}

// ============================================================================
// Custom Post Type - FAQ
// ============================================================================

/**
 * Register FAQ Custom Post Type
 */
function amorfs_register_faq_post_type() {
    $labels = array(
        'name'                  => _x('FAQs', 'Post type general name', 'amorfs-blog'),
        'singular_name'         => _x('FAQ', 'Post type singular name', 'amorfs-blog'),
        'menu_name'             => _x('FAQs', 'Admin Menu text', 'amorfs-blog'),
        'name_admin_bar'        => _x('FAQ', 'Add New on Toolbar', 'amorfs-blog'),
        'add_new'               => __('Add New', 'amorfs-blog'),
        'add_new_item'          => __('Add New FAQ', 'amorfs-blog'),
        'new_item'              => __('New FAQ', 'amorfs-blog'),
        'edit_item'             => __('Edit FAQ', 'amorfs-blog'),
        'view_item'             => __('View FAQ', 'amorfs-blog'),
        'all_items'             => __('All FAQs', 'amorfs-blog'),
        'search_items'          => __('Search FAQs', 'amorfs-blog'),
        'parent_item_colon'     => __('Parent FAQs:', 'amorfs-blog'),
        'not_found'             => __('No FAQs found.', 'amorfs-blog'),
        'not_found_in_trash'    => __('No FAQs found in Trash.', 'amorfs-blog'),
        'featured_image'        => _x('FAQ Image', 'Overrides the "Featured Image" phrase', 'amorfs-blog'),
        'set_featured_image'    => _x('Set FAQ image', 'Overrides the "Set featured image" phrase', 'amorfs-blog'),
        'remove_featured_image' => _x('Remove FAQ image', 'Overrides the "Remove featured image" phrase', 'amorfs-blog'),
        'use_featured_image'    => _x('Use as FAQ image', 'Overrides the "Use as featured image" phrase', 'amorfs-blog'),
        'archives'              => _x('FAQ archives', 'The post type archive label used in nav menus', 'amorfs-blog'),
        'insert_into_item'      => _x('Insert into FAQ', 'Overrides the "Insert into post"/"Insert into page" phrase', 'amorfs-blog'),
        'uploaded_to_this_item' => _x('Uploaded to this FAQ', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase', 'amorfs-blog'),
        'filter_items_list'     => _x('Filter FAQs list', 'Screen reader text for the filter links', 'amorfs-blog'),
        'items_list_navigation' => _x('FAQs list navigation', 'Screen reader text for the pagination', 'amorfs-blog'),
        'items_list'            => _x('FAQs list', 'Screen reader text for the items list', 'amorfs-blog'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'faq-item'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-editor-help',
        'supports'           => array('title', 'editor', 'page-attributes'),
        'show_in_rest'       => true,
    );

    register_post_type('faq', $args);
}
add_action('init', 'amorfs_register_faq_post_type');

/**
 * Add FAQ Meta Box for Answer
 */
function amorfs_add_faq_meta_boxes() {
    add_meta_box(
        'faq_answer',
        __('FAQ Answer', 'amorfs-blog'),
        'amorfs_faq_answer_callback',
        'faq',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'amorfs_add_faq_meta_boxes');

/**
 * FAQ Answer Meta Box Callback
 */
function amorfs_faq_answer_callback($post) {
    wp_nonce_field('amorfs_save_faq_answer', 'amorfs_faq_answer_nonce');
    $answer = get_post_meta($post->ID, '_faq_answer', true);
    ?>
    <div style="margin-top: 10px;">
        <label for="faq_answer" style="display: block; margin-bottom: 10px; font-weight: 600; font-size: 14px;">
            <?php esc_html_e('Answer:', 'amorfs-blog'); ?>
        </label>
        <textarea 
            id="faq_answer" 
            name="faq_answer" 
            rows="8" 
            style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; line-height: 1.5; resize: vertical;"
            placeholder="<?php esc_attr_e('Enter the answer to this question...', 'amorfs-blog'); ?>"
        ><?php echo esc_textarea($answer); ?></textarea>
        <p class="description" style="margin-top: 8px; color: #666;">
            <?php esc_html_e('Enter the answer to this frequently asked question. You can use basic HTML tags like <strong>, <em>, <a>, <br>, etc.', 'amorfs-blog'); ?>
        </p>
    </div>
    <?php
}

/**
 * Save FAQ Answer Meta
 */
function amorfs_save_faq_answer($post_id) {
    // Check nonce
    if (!isset($_POST['amorfs_faq_answer_nonce']) || !wp_verify_nonce($_POST['amorfs_faq_answer_nonce'], 'amorfs_save_faq_answer')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save answer
    if (isset($_POST['faq_answer'])) {
        update_post_meta($post_id, '_faq_answer', wp_kses_post($_POST['faq_answer']));
    }
}
add_action('save_post_faq', 'amorfs_save_faq_answer');

/**
 * Customize FAQ columns in admin
 */
function amorfs_faq_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = __('Question', 'amorfs-blog');
    $new_columns['answer'] = __('Answer Preview', 'amorfs-blog');
    $new_columns['menu_order'] = __('Order', 'amorfs-blog');
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter('manage_faq_posts_columns', 'amorfs_faq_columns');

/**
 * Populate custom columns
 */
function amorfs_faq_custom_column($column, $post_id) {
    switch ($column) {
        case 'answer':
            $answer = get_post_meta($post_id, '_faq_answer', true);
            echo wp_trim_words(wp_strip_all_tags($answer), 15, '...');
            break;
        case 'menu_order':
            $post = get_post($post_id);
            echo $post->menu_order;
            break;
    }
}
add_action('manage_faq_posts_custom_column', 'amorfs_faq_custom_column', 10, 2);

/**
 * Make FAQ columns sortable
 */
function amorfs_faq_sortable_columns($columns) {
    $columns['menu_order'] = 'menu_order';
    return $columns;
}
add_filter('manage_edit-faq_sortable_columns', 'amorfs_faq_sortable_columns');

// ============================================================================
// Customizer Settings - Header Buttons
// ============================================================================

/**
 * Add Customizer settings for Header Buttons (Install Extension & Data Studio)
 */
function amorfs_customize_register($wp_customize) {
    // ============================================================================
    // MULTI-LANGUAGE CUSTOMIZER SETTINGS
    // ============================================================================
    
    // Add Section for Header Buttons
    $wp_customize->add_section('amorfs_header_buttons', array(
        'title'       => __('Header Buttons (Multi-Language)', 'amorfs-blog'),
        'description' => __('Customize header buttons for English and Vietnamese', 'amorfs-blog'),
        'priority'    => 130,
    ));
    
    // ========== Install Extension Button ==========
    
    // English
    $wp_customize->add_setting('amorfs_install_button_text_en', array(
        'default'           => 'Install Extension',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('amorfs_install_button_text_en', array(
        'label'       => __('Install Button Text (English)', 'amorfs-blog'),
        'section'     => 'amorfs_header_buttons',
        'type'        => 'text',
        'priority'    => 10,
    ));
    
    // Vietnamese
    $wp_customize->add_setting('amorfs_install_button_text_vi', array(
        'default'           => 'Cài Đặt Extension',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('amorfs_install_button_text_vi', array(
        'label'       => __('Install Button Text (Tiếng Việt)', 'amorfs-blog'),
        'section'     => 'amorfs_header_buttons',
        'type'        => 'text',
        'priority'    => 11,
    ));
    
    // URL
    $wp_customize->add_setting('amorfs_install_button_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('amorfs_install_button_url', array(
        'label'       => __('Install Button URL', 'amorfs-blog'),
        'section'     => 'amorfs_header_buttons',
        'type'        => 'url',
        'priority'    => 12,
    ));
    
    // Show/Hide
    $wp_customize->add_setting('amorfs_install_button_show', array(
        'default'           => true,
        'sanitize_callback' => 'amorfs_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('amorfs_install_button_show', array(
        'label'       => __('Show Install Button', 'amorfs-blog'),
        'section'     => 'amorfs_header_buttons',
        'type'        => 'checkbox',
        'priority'    => 13,
    ));
    
    // ========== Data Studio Button ==========
    
    // English
    $wp_customize->add_setting('amorfs_datastudio_button_text_en', array(
        'default'           => 'Data Studio',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('amorfs_datastudio_button_text_en', array(
        'label'       => __('Data Studio Button Text (English)', 'amorfs-blog'),
        'section'     => 'amorfs_header_buttons',
        'type'        => 'text',
        'priority'    => 20,
    ));
    
    // Vietnamese
    $wp_customize->add_setting('amorfs_datastudio_button_text_vi', array(
        'default'           => 'Data Studio',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('amorfs_datastudio_button_text_vi', array(
        'label'       => __('Data Studio Button Text (Tiếng Việt)', 'amorfs-blog'),
        'section'     => 'amorfs_header_buttons',
        'type'        => 'text',
        'priority'    => 21,
    ));
    
    // URL
    $wp_customize->add_setting('amorfs_datastudio_button_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('amorfs_datastudio_button_url', array(
        'label'       => __('Data Studio Button URL', 'amorfs-blog'),
        'section'     => 'amorfs_header_buttons',
        'type'        => 'url',
        'priority'    => 22,
    ));
    
    // Show/Hide
    $wp_customize->add_setting('amorfs_datastudio_button_show', array(
        'default'           => true,
        'sanitize_callback' => 'amorfs_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('amorfs_datastudio_button_show', array(
        'label'       => __('Show Data Studio Button', 'amorfs-blog'),
        'section'     => 'amorfs_header_buttons',
        'type'        => 'checkbox',
        'priority'    => 23,
    ));
}
add_action('customize_register', 'amorfs_customize_register');

/**
 * Sanitize checkbox
 */
function amorfs_sanitize_checkbox($checked) {
    return ((isset($checked) && true === $checked) ? true : false);
}

// ============================================================================
// Admin Menu - User Guide
// ============================================================================

/**
 * Add User Guide menu to admin sidebar
 */
function amorfs_add_user_guide_menu() {
    add_menu_page(
        __('User Guide', 'amorfs-blog'),           // Page title
        __('User Guide', 'amorfs-blog'),           // Menu title
        'manage_options',                          // Capability (only admin)
        'amorfs-user-guide',                       // Menu slug
        'amorfs_display_user_guide_page',          // Callback function
        'dashicons-book-alt',                      // Icon
        100                                        // Position (after FAQs)
    );
}
add_action('admin_menu', 'amorfs_add_user_guide_menu');

/**
 * Display User Guide page content
 */
function amorfs_display_user_guide_page() {
    // Read the USER_GUIDE.md file
    $guide_file = get_template_directory() . '/USER_GUIDE.md';
    
    if (!file_exists($guide_file)) {
        echo '<div class="wrap">';
        echo '<h1>' . esc_html__('User Guide', 'amorfs-blog') . '</h1>';
        echo '<div class="notice notice-error"><p>' . esc_html__('User Guide file not found.', 'amorfs-blog') . '</p></div>';
        echo '</div>';
        return;
    }
    
    $content = file_get_contents($guide_file);
    
    ?>
    <div class="wrap">
        <h1><?php echo esc_html__('Theme User Guide', 'amorfs-blog'); ?></h1>
        
        <div class="card" style="max-width: none;">
            <pre style="white-space: pre-wrap; word-wrap: break-word; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif; font-size: 14px; line-height: 1.6; padding: 20px; background: #f9f9f9; border-radius: 4px;"><?php echo esc_html($content); ?></pre>
        </div>
    </div>
    <?php
}

/**
 * ============================================================================
 * MULTI-LANGUAGE SYSTEM (Vietnamese & English)
 * ============================================================================
 * Simple language switcher without plugins - UI text translation only
 */

// Initialize language session
function amorfs_init_language() {
    if (!session_id()) {
        session_start();
    }
    
    // Handle language switch
    if (isset($_GET['lang']) && in_array($_GET['lang'], array('en', 'vi'))) {
        $_SESSION['amorfs_lang'] = sanitize_text_field($_GET['lang']);
        setcookie('amorfs_lang', $_SESSION['amorfs_lang'], time() + (86400 * 365), '/');
        
        // Redirect to clean URL
        wp_safe_redirect(remove_query_arg('lang'));
        exit;
    }
    
    // Get current language
    if (!isset($_SESSION['amorfs_lang'])) {
        if (isset($_COOKIE['amorfs_lang'])) {
            $_SESSION['amorfs_lang'] = $_COOKIE['amorfs_lang'];
        } else {
            // Detect browser language
            $browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'en', 0, 2);
            $_SESSION['amorfs_lang'] = ($browser_lang === 'vi') ? 'vi' : 'en';
        }
    }
}
add_action('init', 'amorfs_init_language');

// Get current language
function amorfs_get_current_lang() {
    return $_SESSION['amorfs_lang'] ?? 'en';
}

// Translation function
function amorfs_translate($key) {
    static $translations = null;
    
    if ($translations === null) {
        $lang = amorfs_get_current_lang();
        $translations_file = get_template_directory() . '/languages/translations-' . $lang . '.php';
        
        if (file_exists($translations_file)) {
            $translations = include($translations_file);
        } else {
            $translations = array();
        }
    }
    
    return isset($translations[$key]) ? $translations[$key] : $key;
}

// Shorthand function
function amorfs_t($key) {
    return amorfs_translate($key);
}

// Shorthand function with echo
function amorfs_e($key) {
    echo esc_html(amorfs_translate($key));
}

// Get language switcher HTML
function amorfs_language_switcher() {
    $current_lang = amorfs_get_current_lang();
    $current_url = add_query_arg(array());
    
    $languages = array(
        'en' => 'English',
        'vi' => 'Tiếng Việt'
    );
    
    ob_start();
    ?>
    <div class="language-switcher">
        <button class="language-toggle" aria-label="<?php echo esc_attr(amorfs_t('select_language')); ?>">
            <svg class="globe-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="2" y1="12" x2="22" y2="12"/>
                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
            </svg>
            <span class="current-lang"><?php echo esc_html($languages[$current_lang]); ?></span>
            <svg class="dropdown-arrow" width="12" height="12" viewBox="0 0 12 12" fill="none">
                <path d="M2.5 4.5L6 8L9.5 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <ul class="language-dropdown">
            <?php foreach ($languages as $code => $name) : ?>
                <li>
                    <a href="<?php echo esc_url(add_query_arg('lang', $code, $current_url)); ?>" 
                       class="language-option <?php echo ($code === $current_lang) ? 'active' : ''; ?>"
                       data-lang="<?php echo esc_attr($code); ?>">
                        <?php echo esc_html($name); ?>
                        <?php if ($code === $current_lang) : ?>
                            <svg class="check-icon" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M3 8L6.5 11.5L13 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php
    return ob_get_clean();
}

// Enqueue language switcher scripts
function amorfs_enqueue_language_scripts() {
    wp_add_inline_script('amorfs-blog-scripts', "
        // Language Switcher
        document.addEventListener('DOMContentLoaded', function() {
            const languageSwitcher = document.querySelector('.language-switcher');
            if (!languageSwitcher) return;
            
            const toggle = languageSwitcher.querySelector('.language-toggle');
            const dropdown = languageSwitcher.querySelector('.language-dropdown');
            
            // Toggle dropdown
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                languageSwitcher.classList.toggle('active');
            });
            
            // Close on outside click
            document.addEventListener('click', function(e) {
                if (!languageSwitcher.contains(e.target)) {
                    languageSwitcher.classList.remove('active');
                }
            });
            
            // Close on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    languageSwitcher.classList.remove('active');
                }
            });
        });
    ");
}
add_action('wp_enqueue_scripts', 'amorfs_enqueue_language_scripts');

// Format date based on current language
function amorfs_format_date($format = 'j M Y', $timestamp = null) {
    $lang = amorfs_get_current_lang();
    
    if ($timestamp === null) {
        $timestamp = get_the_time('U');
    }
    
    if ($lang === 'vi') {
        // Vietnamese month names
        $months_vi = array(
            'Jan' => 'Thg 1',
            'Feb' => 'Thg 2',
            'Mar' => 'Thg 3',
            'Apr' => 'Thg 4',
            'May' => 'Thg 5',
            'Jun' => 'Thg 6',
            'Jul' => 'Thg 7',
            'Aug' => 'Thg 8',
            'Sep' => 'Thg 9',
            'Oct' => 'Thg 10',
            'Nov' => 'Thg 11',
            'Dec' => 'Thg 12'
        );
        
        $date_en = date($format, $timestamp);
        return str_replace(array_keys($months_vi), array_values($months_vi), $date_en);
    }
    
    return date($format, $timestamp);
}

// Get localized date from post
function amorfs_get_post_date($format = 'j M Y', $post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $timestamp = get_post_time('U', false, $post_id);
    return amorfs_format_date($format, $timestamp);
}

/**
 * ============================================================================
 * MENU ITEM TRANSLATION FIELDS
 * ============================================================================
 * Add Vietnamese translation field to each menu item directly in Customizer Menus
 */

// Add Vietnamese translation field to menu items in Customizer
function amorfs_customize_nav_menu_item_settings($item_id, $item, $depth, $args, $id) {
    $vietnamese_title = get_post_meta($item_id, '_menu_item_vietnamese_title', true);
    ?>
    <p class="field-vietnamese-title description description-wide">
        <label for="edit-menu-item-vietnamese-title-<?php echo esc_attr($item_id); ?>">
            <?php _e('Vietnamese Title', 'amorfs-blog'); ?><br />
            <input 
                type="text" 
                id="edit-menu-item-vietnamese-title-<?php echo esc_attr($item_id); ?>" 
                class="widefat edit-menu-item-vietnamese-title" 
                name="menu-item-vietnamese-title[<?php echo esc_attr($item_id); ?>]" 
                value="<?php echo esc_attr($vietnamese_title); ?>" 
                placeholder="<?php esc_attr_e('Enter Vietnamese translation', 'amorfs-blog'); ?>"
            />
        </label>
    </p>
    <?php
}
add_action('wp_nav_menu_item_custom_fields', 'amorfs_customize_nav_menu_item_settings', 10, 5);

// Save Vietnamese translation when menu item is saved
function amorfs_save_menu_item_vietnamese_field($menu_id, $menu_item_db_id, $args) {
    // Check if our custom field is set
    if (isset($_POST['menu-item-vietnamese-title'][$menu_item_db_id])) {
        $vietnamese_title = sanitize_text_field($_POST['menu-item-vietnamese-title'][$menu_item_db_id]);
        update_post_meta($menu_item_db_id, '_menu_item_vietnamese_title', $vietnamese_title);
    } else {
        delete_post_meta($menu_item_db_id, '_menu_item_vietnamese_title');
    }
}
add_action('wp_update_nav_menu_item', 'amorfs_save_menu_item_vietnamese_field', 10, 3);

// Add Vietnamese field to Customizer menu items using JavaScript
function amorfs_customizer_menu_vietnamese_field_script() {
    ?>
    <script type="text/javascript">
    (function($) {
        wp.customize.bind('ready', function() {
            
            function addVietnameseFieldToControl(control) {
                // Only process nav menu item controls
                if (!control.params || !control.params.type || control.params.type !== 'nav_menu_item') {
                    return;
                }
                
                var itemId = control.params.menu_item_id;
                if (!itemId) {
                    return;
                }
                
                var container = control.container;
                
                // Check if field already added
                if (container.find('.field-vietnamese-title').length > 0) {
                    return;
                }
                
                // Function to actually insert the field
                function insertField() {
                    // Find the Navigation Label field (attr-title)
                    var navLabelField = container.find('.field-attr-title');
                    
                    if (navLabelField.length === 0) {
                        // Try again after a short delay
                        setTimeout(insertField, 100);
                        return;
                    }
                    
                    // Check again if field already exists (double check)
                    if (container.find('.field-vietnamese-title').length > 0) {
                        return;
                    }
                    
                    // Get current Vietnamese title from post meta
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'amorfs_get_menu_item_vietnamese',
                            item_id: itemId,
                            nonce: '<?php echo wp_create_nonce("amorfs_menu_vietnamese_nonce"); ?>'
                        },
                        success: function(response) {
                            if (response.success) {
                                // Final check before inserting
                                if (container.find('.field-vietnamese-title').length > 0) {
                                    return;
                                }
                                
                                // Create Vietnamese field HTML
                                var vietnameseField = $('<p class="field-vietnamese-title description description-wide">' +
                                    '<label>' +
                                        '<span class="customize-control-title"><?php esc_html_e('Vietnamese Title', 'amorfs-blog'); ?></span>' +
                                        '<input type="text" class="widefat edit-menu-item-vietnamese-title" data-item-id="' + itemId + '" value="' + (response.data.value || '') + '" placeholder="<?php esc_attr_e('Enter Vietnamese translation', 'amorfs-blog'); ?>" />' +
                                    '</label>' +
                                '</p>');
                                
                                // Insert right after Navigation Label field
                                vietnameseField.insertAfter(navLabelField);
                                
                                // Handle value change with debounce
                                var saveTimeout;
                                vietnameseField.find('input').on('input change', function() {
                                    clearTimeout(saveTimeout);
                                    var newValue = $(this).val();
                                    saveTimeout = setTimeout(function() {
                                        $.ajax({
                                            url: ajaxurl,
                                            type: 'POST',
                                            data: {
                                                action: 'amorfs_save_menu_item_vietnamese',
                                                item_id: itemId,
                                                vietnamese_title: newValue,
                                                nonce: '<?php echo wp_create_nonce("amorfs_menu_vietnamese_nonce"); ?>'
                                            }
                                        });
                                    }, 500);
                                });
                            }
                        }
                    });
                }
                
                // Start trying to insert the field
                insertField();
            }
            
            // Add field to all existing menu items after a delay
            setTimeout(function() {
                wp.customize.control.each(function(control) {
                    addVietnameseFieldToControl(control);
                });
            }, 1000);
            
            // Add field to new menu items when they are added
            wp.customize.control.bind('add', function(control) {
                setTimeout(function() {
                    addVietnameseFieldToControl(control);
                }, 300);
            });
            
            // Watch for menu item expansion/collapse
            $(document).on('expanded', function(e) {
                setTimeout(function() {
                    wp.customize.control.each(function(control) {
                        addVietnameseFieldToControl(control);
                    });
                }, 200);
            });
            
            // Also watch for clicks on menu item handles
            $(document).on('click', '.menu-item-handle', function() {
                var menuItem = $(this).closest('.customize-control-nav_menu_item');
                setTimeout(function() {
                    // Find the control for this specific item
                    wp.customize.control.each(function(control) {
                        if (control.container && control.container[0] === menuItem[0]) {
                            addVietnameseFieldToControl(control);
                        }
                    });
                }, 300);
            });
            
            // Watch for reordering and other DOM changes
            var observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.addedNodes && mutation.addedNodes.length > 0) {
                        setTimeout(function() {
                            wp.customize.control.each(function(control) {
                                addVietnameseFieldToControl(control);
                            });
                        }, 300);
                    }
                });
            });
            
            // Start observing the menu container
            setTimeout(function() {
                var menuContainer = $('.customize-control-nav_menu').parent();
                if (menuContainer.length > 0) {
                    observer.observe(menuContainer[0], {
                        childList: true,
                        subtree: true
                    });
                }
            }, 1000);
        });
    })(jQuery);
    </script>
    <?php
}
add_action('customize_controls_print_footer_scripts', 'amorfs_customizer_menu_vietnamese_field_script');

// AJAX handler to get Vietnamese title
function amorfs_get_menu_item_vietnamese_ajax() {
    check_ajax_referer('amorfs_menu_vietnamese_nonce', 'nonce');
    
    $item_id = isset($_POST['item_id']) ? intval($_POST['item_id']) : 0;
    if (!$item_id) {
        wp_send_json_error();
    }
    
    $vietnamese_title = get_post_meta($item_id, '_menu_item_vietnamese_title', true);
    wp_send_json_success(array('value' => $vietnamese_title));
}
add_action('wp_ajax_amorfs_get_menu_item_vietnamese', 'amorfs_get_menu_item_vietnamese_ajax');

// AJAX handler to save Vietnamese title
function amorfs_save_menu_item_vietnamese_ajax() {
    check_ajax_referer('amorfs_menu_vietnamese_nonce', 'nonce');
    
    $item_id = isset($_POST['item_id']) ? intval($_POST['item_id']) : 0;
    $vietnamese_title = isset($_POST['vietnamese_title']) ? sanitize_text_field($_POST['vietnamese_title']) : '';
    
    if (!$item_id) {
        wp_send_json_error();
    }
    
    if (!empty($vietnamese_title)) {
        update_post_meta($item_id, '_menu_item_vietnamese_title', $vietnamese_title);
    } else {
        delete_post_meta($item_id, '_menu_item_vietnamese_title');
    }
    
    wp_send_json_success();
}
add_action('wp_ajax_amorfs_save_menu_item_vietnamese', 'amorfs_save_menu_item_vietnamese_ajax');

// Add CSS to style the Vietnamese field in Customizer
function amorfs_menu_item_vietnamese_field_styles() {
    ?>
    <style>
      
    </style>
    <?php
}
add_action('admin_head-nav-menus.php', 'amorfs_menu_item_vietnamese_field_styles');
add_action('customize_controls_print_styles', 'amorfs_menu_item_vietnamese_field_styles');


// Custom Walker to display translated menu titles
class Amorfs_Multilang_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        // Get current language
        $current_lang = amorfs_get_current_lang();
        
        // Get Vietnamese title if exists and current language is Vietnamese
        if ($current_lang === 'vi') {
            $vietnamese_title = get_post_meta($item->ID, '_menu_item_vietnamese_title', true);
            if (!empty($vietnamese_title)) {
                $item->title = $vietnamese_title;
            }
        }
        
        // Call parent method
        parent::start_el($output, $item, $depth, $args, $id);
    }
}

// Helper function to get menu with translation
function amorfs_nav_menu($args = array()) {
    // Set custom walker if not already set
    if (!isset($args['walker'])) {
        $args['walker'] = new Amorfs_Multilang_Walker();
    }
    
    return wp_nav_menu($args);
}

/**
 * Flodesk Newsletter Integration
 * Adds Flodesk script loader to head section
 */
function amorfs_flodesk_script_loader() {
    ?>
    <script>
      (function(w, d, t, h, s, n) {
        w.FlodeskObject = n;
        var fn = function() {
          (w[n].q = w[n].q || []).push(arguments);
        };
        w[n] = w[n] || fn;
        var f = d.getElementsByTagName(t)[0];
        var v = '?v=' + Math.floor(new Date().getTime() / (120 * 1000)) * 60;
        var sm = d.createElement(t);
        sm.async = true;
        sm.type = 'module';
        sm.src = h + s + '.mjs' + v;
        f.parentNode.insertBefore(sm, f);
        var sn = d.createElement(t);
        sn.async = true;
        sn.noModule = true;
        sn.src = h + s + '.js' + v;
        f.parentNode.insertBefore(sn, f);
      })(window, document, 'script', 'https://assets.flodesk.com', '/universal', 'fd');
    </script>
    <?php
}
add_action('wp_head', 'amorfs_flodesk_script_loader');

/**
 * Initialize Flodesk form in footer
 * This script runs after the Flodesk loader is ready
 */
function amorfs_flodesk_form_init() {
    ?>
    <script>
      window.fd('form', {
        formId: '690d5fc9d82b8879a36e5f8c',
        containerEl: '#fd-form-690d5fc9d82b8879a36e5f8c'
      });
    </script>
    <?php
}
add_action('wp_footer', 'amorfs_flodesk_form_init');
