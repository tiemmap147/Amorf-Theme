<?php
/**
 * The header template file - Amorf's Blog Theme
 * 
 * @package Amorfs_Blog
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="top">
<?php wp_body_open(); ?>

<div id="page" class="site-wrapper">
    
    <a class="skip-link screen-reader-text" href="#primary">
        <?php esc_html_e('Skip to content', 'amorfs-blog'); ?>
    </a>
    
    <header id="masthead" class="site-header">
        <div class="header-container">
            <div class="header-inner">
                <!-- Logo & Branding -->
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) {
                        // Hiển thị custom logo từ WordPress Customizer
                        the_custom_logo();
                    } else {
                        // Hiển thị logo mặc định từ file SVG
                        ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.svg'); ?>" 
                                 alt="<?php echo esc_attr(get_bloginfo('name')); ?>" 
                                 class="logo-icon">
                        </a>
                        <?php
                    }
                    ?>
                </div>
                
                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="menu-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <span class="screen-reader-text"><?php esc_html_e('Menu', 'amorfs-blog'); ?></span>
                </button>
                
                <!-- Mobile Menu Overlay -->
                <div class="mobile-menu-overlay"></div>
                
                <!-- Navigation Menu -->
                <nav id="site-navigation" class="main-navigation">
                    <!-- Close Button for Mobile -->
                    <button class="mobile-menu-close" aria-label="<?php esc_attr_e('Close menu', 'amorfs-blog'); ?>">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                    
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'nav-menu',
                        'container'      => false,
                        'fallback_cb'    => false,
                        'walker'         => new Amorfs_Multilang_Walker(),
                    ));
                    ?>
                    
                    <!-- Header Buttons -->
                    <?php if (has_nav_menu('primary')) : ?>
                        <div class="header-buttons">
                            <?php 
                            // Language Switcher
                            echo amorfs_language_switcher();
                            
                            // Get current language
                            $current_lang = amorfs_get_current_lang();
                            $lang_suffix = ($current_lang === 'vi') ? '_vi' : '_en';
                            
                            // Data Studio Button
                            $show_datastudio_button = get_theme_mod('amorfs_datastudio_button_show', true);
                            
                            if ($show_datastudio_button) : 
                                $datastudio_url = get_theme_mod('amorfs_datastudio_button_url', '');
                                $datastudio_text = get_theme_mod('amorfs_datastudio_button_text' . $lang_suffix, 'Data Studio');
                                
                                if (!empty($datastudio_url)) :
                            ?>
                                <a href="<?php echo esc_url($datastudio_url); ?>" class="datastudio-button">
                                    <?php echo esc_html($datastudio_text); ?>
                                </a>
                            <?php 
                                endif;
                            endif; 
                            
                            // Install Extension Button
                            $show_install_button = get_theme_mod('amorfs_install_button_show', true);
                            
                            if ($show_install_button) : 
                                $install_url = get_theme_mod('amorfs_install_button_url', '');
                                $install_text = get_theme_mod('amorfs_install_button_text' . $lang_suffix, 
                                    ($current_lang === 'vi') ? 'Cài Đặt Extension' : 'Install Extension');
                                
                                if (!empty($install_url)) :
                            ?>
                                <a href="<?php echo esc_url($install_url); ?>" class="install-button">
                                    <?php echo esc_html($install_text); ?>
                                </a>
                            <?php 
                                endif;
                            endif; 
                            ?>
                        </div>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>
    
    <div id="content" class="site-content">
