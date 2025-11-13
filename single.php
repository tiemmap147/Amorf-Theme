<?php
/**
 * The template for displaying single posts - Amorf's Blog Theme
 * 
 * @package Amorfs_Blog
 */

get_header(); ?>

<main id="primary" class="site-main single-post-page">
    <div class="container-full single-container">
        <?php while (have_posts()) : the_post(); ?>
            
            <!-- Back Navigation -->
            <div class="single-back-wrapper">
                <?php
                $blog_page = get_option('page_for_posts');
                $fallback_url = $blog_page ? get_permalink($blog_page) : home_url('/');
                ?>
                <a href="<?php echo esc_url($fallback_url); ?>" class="back-link" aria-label="<?php echo esc_attr(amorfs_t('back')); ?>"
                   onclick="if (window.history.length > 1) { event.preventDefault(); window.history.back(); }">
                    <span class="back-icon">←</span> 
                    <span class="back-title"><?php amorfs_e('back'); ?></span>
                    
                </a>
            </div>

            <!-- Article Header -->
            <header class="article-header">
                <h1 class="article-title"><?php the_title(); ?></h1>
                
                <div class="article-meta-row">
                    <div class="article-meta-left">
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) :
                        ?>
                            <span class="meta-category">
                                <?php echo esc_html($categories[0]->name); ?>
                            </span>
                            <span class="meta-separator">•</span>
                        <?php endif; ?>
                        <time class="meta-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                            <?php
                            $days_ago = floor((time() - get_the_time('U')) / DAY_IN_SECONDS);
                            if ($days_ago == 0) {
                                amorfs_e('today');
                            } elseif ($days_ago == 1) {
                                echo '1 ' . amorfs_t('day_ago');
                            } else {
                                echo $days_ago . ' ' . amorfs_t('days_ago');
                            }
                            ?>
                        </time>
                        <span class="meta-separator">•</span>
                        <span class="meta-reading-time"><?php echo esc_html(my_custom_blog_get_reading_time()); ?></span>
                    </div>
                    
                    <div class="article-social-icons">
                        <span class="social-share-label">
                        <?php amorfs_e('share_to'); ?>
                        </span>
                        <!-- X (Twitter) -->
                        <button class="social-icon x-share" aria-label="Share on X" 
                                onclick="window.open('https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>', '_blank', 'width=1200,height=800')">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/X.svg'); ?>" alt="X" width="18" height="18">
                        </button>
                        <!-- LinkedIn -->
                        <button class="social-icon linkedin-share" aria-label="Share on LinkedIn" 
                                onclick="window.open('https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>', '_blank', 'width=1200,height=800')">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/linkedin.svg'); ?>" alt="LinkedIn" width="18" height="18">
                        </button>
                        <!-- Facebook -->
                        <button class="social-icon facebook-share" aria-label="Share on Facebook" 
                                onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>', '_blank', 'width=1200,height=800')">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/facebook.svg'); ?>" alt="Facebook" width="18" height="18">
                        </button>
                        <!-- Copy Link -->
                        <button class="social-icon copy-link" aria-label="Copy link" 
                                onclick="navigator.clipboard.writeText('<?php echo esc_js(get_permalink()); ?>').then(() => { 
                                    this.classList.add('copied'); 
                                    const originalHTML = this.innerHTML;
                                    this.innerHTML = '<svg width=\'18\' height=\'18\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\'><polyline points=\'20 6 9 17 4 12\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'/></svg>';
                                    setTimeout(() => { this.innerHTML = originalHTML; this.classList.remove('copied'); }, 2000);
                                }).catch(err => console.error('Failed to copy:', err));">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/share-icon.svg'); ?>" alt="Copy link" width="18" height="18">
                        </button>
                    </div>
                </div>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="article-featured-image">
                    <?php the_post_thumbnail('full'); ?>
                </div>
            <?php endif; ?>

            <!-- Two Column Layout -->
            <div class="article-layout">
                <!-- Main Content -->
                <div class="article-main-content">
                    <div class="article-body-content">
                        <?php the_content(); ?>
                    </div>

                    <!-- Social Share Footer -->
                    <div class="article-share-footer">
                        <span class="share-label"><?php amorfs_e('share'); ?>:</span>
                        <div class="share-icons">
                            <!-- X (Twitter) -->
                            <button class="share-icon-btn x" aria-label="Share on X"
                                    onclick="window.open('https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>', '_blank', 'width=1200,height=800')">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/X.svg'); ?>" alt="X" width="20" height="20">
                            </button>
                            <!-- LinkedIn -->
                            <button class="share-icon-btn linkedin" aria-label="Share on LinkedIn"
                                    onclick="window.open('https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>', '_blank', 'width=1200,height=800')">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/linkedin.svg'); ?>" alt="LinkedIn" width="20" height="20">
                            </button>
                            <!-- Facebook -->
                            <button class="share-icon-btn facebook" aria-label="Share on Facebook"
                                    onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>', '_blank', 'width=1200,height=800')">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/facebook.svg'); ?>" alt="Facebook" width="20" height="20">
                            </button>
                            <!-- Copy Link -->
                            <button class="share-icon-btn link" aria-label="Copy link"
                                    onclick="navigator.clipboard.writeText('<?php echo esc_js(get_permalink()); ?>').then(() => { 
                                        this.classList.add('copied');
                                        const originalHTML = this.innerHTML;
                                        this.innerHTML = '<svg width=\'20\' height=\'20\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\'><polyline points=\'20 6 9 17 4 12\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'/></svg>';
                                        setTimeout(() => { this.innerHTML = originalHTML; this.classList.remove('copied'); }, 2000);
                                    }).catch(err => console.error('Failed to copy:', err));">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/share-icon.svg'); ?>" alt="Copy link" width="20" height="20">
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <aside class="article-sidebar">
                    <div class="sidebar-sticky">
                        <div class="sidebar-toc">
                            <h3 class="toc-title">
                                <svg class="toc-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <line x1="3" y1="6" x2="21" y2="6" stroke-width="2" stroke-linecap="round"/>
                                    <line x1="3" y1="12" x2="21" y2="12" stroke-width="2" stroke-linecap="round"/>
                                    <line x1="3" y1="18" x2="21" y2="18" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                                <?php amorfs_e('contents'); ?>
                            </h3>
                            <ul class="toc-list" id="table-of-contents">
                                <!-- Will be populated by JavaScript -->
                            </ul>
                        </div>
                        <a href="#top" class="back-to-top-btn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M12 19V5M5 12l7-7 7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <?php amorfs_e('back_to_top'); ?>
                        </a>
                    </div>
                </aside>
            </div>

            <!-- Related Posts - Full Width Section -->
            <?php
            $related_posts = my_custom_blog_get_related_posts(get_the_ID(), 6);
            if (!empty($related_posts)) :
                ?>
                <section class="related-posts-section-fullwidth">
                    <div class="related-posts-header">
                        <h2 class="related-posts-title"><?php amorfs_e('related_posts'); ?></h2>
                        <div class="related-posts-nav">
                            <button class="related-posts-nav-btn prev" aria-label="Previous">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <polyline points="15 18 9 12 15 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <button class="related-posts-nav-btn next" aria-label="Next">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <polyline points="9 18 15 12 9 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="related-posts-grid">
                        <?php
                        foreach ($related_posts as $related_post) :
                            setup_postdata($related_post);
                            $categories = get_the_category($related_post->ID);
                            ?>
                            <article class="blog-card-item">
                                <div class="blog-card-image">
                                    <a href="<?php echo esc_url(get_permalink($related_post->ID)); ?>">
                                        <?php if (has_post_thumbnail($related_post->ID)) : ?>
                                            <?php echo get_the_post_thumbnail($related_post->ID, 'large'); ?>
                                        <?php else : ?>
                                            <div class="blog-card-placeholder">
                                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.svg'); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="placeholder-logo">
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                </div>
                                
                                <div class="blog-card-content">
                                    <?php if (!empty($categories)) : ?>
                                        <span class="blog-card-category"><?php echo esc_html(strtoupper($categories[0]->name)); ?></span>
                                    <?php endif; ?>
                                    
                                    <h3 class="blog-card-title">
                                        <a href="<?php echo esc_url(get_permalink($related_post->ID)); ?>">
                                            <?php echo esc_html(get_the_title($related_post->ID)); ?>
                                        </a>
                                    </h3>
                                    
                                    <div class="blog-card-excerpt">
                                        <?php echo wp_trim_words(get_the_excerpt($related_post->ID), 25, '...'); ?>
                                    </div>
                                    
                                    <div class="blog-card-meta">
                                        <time datetime="<?php echo esc_attr(get_the_date('c', $related_post->ID)); ?>">
                                            <?php echo esc_html(amorfs_get_post_date('d M Y', $related_post->ID)); ?>
                                        </time>
                                        <span class="meta-separator">•</span>
                                        <span class="reading-time"><?php echo esc_html(my_custom_blog_get_reading_time($related_post->ID)); ?></span>
                                    </div>
                                </div>
                            </article>
                            <?php
                        endforeach;
                        wp_reset_postdata();
                        ?>
                    </div>
                </section>
                <?php
            endif;
            ?>

        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
