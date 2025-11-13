<?php
/**
 * The footer template file - Amorf's Blog Theme
 * 
 * @package Amorfs_Blog
 */
?>

    </div><!-- #content -->
    
    <footer id="colophon" class="site-footer">
        <div class="footer-main">
            <div class="footer-container">
                <div class="footer-content-wrapper">
                    
                    <!-- Left Column: Logo + Menu + Copyright -->
                    <div class="footer-left-column">
                        <!-- Logo -->
                        <div class="footer-brand">
                            <div class="footer-logo">
                                <a href="https://amorfs.com/" target="_blank" rel="noopener">
                                    <?php
                                    if (has_custom_logo()) {
                                        the_custom_logo();
                                    } else {
                                        ?>
                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo-white.svg'); ?>" 
                                             alt="<?php echo esc_attr(get_bloginfo('name')); ?>" 
                                             class="logo-icon">
                                        <?php
                                    }
                                    ?>
                                </a>
                            </div>
                        </div>
                        
                        <!-- 3 Columns Menu -->
                        <div class="footer-menu-row">
                            <!-- Column 1: Products -->
                            <div class="footer-column">
                                <h3 class="footer-column-title"><?php amorfs_e('products'); ?></h3>
                                <?php
                                if (has_nav_menu('footer-product')) {
                                    wp_nav_menu(array(
                                        'theme_location' => 'footer-product',
                                        'menu_class'     => 'footer-menu',
                                        'container'      => false,
                                        'depth'          => 1,
                                        'walker'         => new Amorfs_Multilang_Walker(),
                                    ));
                                } else {
                                    ?>
                                    <ul class="footer-menu">
                                        <li><a href="#"><?php amorfs_e('browser_extension'); ?></a></li>
                                        <li><a href="#"><?php amorfs_e('data_studio'); ?></a></li>
                                    </ul>
                                    <?php
                                }
                                ?>
                            </div>
                            
                            <!-- Column 2: Support -->
                            <div class="footer-column">
                                <h3 class="footer-column-title"><?php amorfs_e('support'); ?></h3>
                                <?php
                                if (has_nav_menu('footer-support')) {
                                    wp_nav_menu(array(
                                        'theme_location' => 'footer-support',
                                        'menu_class'     => 'footer-menu',
                                        'container'      => false,
                                        'depth'          => 1,
                                        'walker'         => new Amorfs_Multilang_Walker(),
                                    ));
                                } else {
                                    ?>
                                    <ul class="footer-menu">
                                        <li><a href="#"><?php esc_html_e('FAQ', 'amorfs-blog'); ?></a></li>
                                        <li><a href="#"><?php amorfs_e('contact_us'); ?></a></li>
                                    </ul>
                                    <?php
                                }
                                ?>
                            </div>
                            
                            <!-- Column 3: Policy -->
                            <div class="footer-column">
                                <h3 class="footer-column-title"><?php amorfs_e('policy'); ?></h3>
                                <?php
                                if (has_nav_menu('footer-policy')) {
                                    wp_nav_menu(array(
                                        'theme_location' => 'footer-policy',
                                        'menu_class'     => 'footer-menu',
                                        'container'      => false,
                                        'depth'          => 1,
                                        'walker'         => new Amorfs_Multilang_Walker(),
                                    ));
                                } else {
                                    ?>
                                    <ul class="footer-menu">
                                        <li><a href="#"><?php amorfs_e('terms_conditions'); ?></a></li>
                                        <li><a href="<?php echo esc_url(get_privacy_policy_url()); ?>"><?php amorfs_e('privacy_policy'); ?></a></li>
                                    </ul>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        
                        <!-- Copyright -->
                        <div class="footer-copyright">
                            <div class="copyright-text">
                                <?php
                                printf(
                                    esc_html(amorfs_t('copyright')),
                                    date('Y')
                                );
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column: Newsletter Box -->
                    <div class="footer-newsletter">
                        <h3 class="newsletter-title"><?php amorfs_e('newsletter_title'); ?></h3>
                        <p class="newsletter-description">
                            <?php amorfs_e('newsletter_description'); ?>
                        </p>
                        <!-- Flodesk Newsletter Form -->
                        <div id="fd-form-690d5fc9d82b8879a36e5f8c"></div>
                    </div>
                    
                </div>
            </div>
        </div>
    </footer>
    
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
