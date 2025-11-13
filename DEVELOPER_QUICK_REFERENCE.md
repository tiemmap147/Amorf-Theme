# Amorf's Blog Theme - Developer Quick Reference

## 🎨 Design Tokens (CSS Variables)

### Colors

```css
--color-brand-blue: #2563EB          /* Primary brand color */
--color-brand-blue-hover: #1D4ED8    /* Hover state */
--color-light-blue: #60A5FA           /* Light accent */
--color-very-light-blue: #DBEAFE     /* Badge backgrounds */
--color-footer-blue: #1E3A8A          /* Footer background */

--color-text-dark: #1F2937            /* Headings */
--color-text-body: #4B5563            /* Body text */
--color-text-light: #6B7280           /* Meta text */
--color-text-muted: #9CA3AF           /* Subtle text */

--color-white: #FFFFFF
--color-light-gray: #F9FAFB
--color-border-light: #E5E7EB
```

### Typography

```css
--font-primary: 'Inter', sans-serif

/* Sizes */
--font-size-hero: 32px        /* Featured titles */
--font-size-card-title: 20px  /* Card titles */
--font-size-base: 14px        /* Body text */
--font-size-micro: 11px       /* Badges */

/* Weights */
--font-weight-bold: 700
--font-weight-semibold: 600
--font-weight-medium: 500
```

### Spacing (8px base)

```css
--spacing-xs: 8px     /* 1 unit */
--spacing-sm: 12px    /* 1.5 units */
--spacing-md: 16px    /* 2 units */
--spacing-lg: 24px    /* 3 units */
--spacing-xl: 32px    /* 4 units */
--spacing-2xl: 40px   /* 5 units */
--spacing-3xl: 60px   /* 7.5 units */
```

### Border Radius

```css
--radius-large: 16px   /* Featured cards */
--radius-medium: 12px  /* Regular cards */
--radius-small: 8px    /* Inputs, buttons */
--radius-tiny: 6px     /* Small badges */
```

---

## 🔧 Key WordPress Functions

### Reading Time

```php
// Get reading time
$time = my_custom_blog_get_reading_time($post_id);

// Display reading time
my_custom_blog_reading_time($post_id);
```

### Thumbnails

```php
// Get thumbnail HTML
$html = my_custom_blog_get_post_thumbnail('amorfs-featured', true);

// Display thumbnail
my_custom_blog_post_thumbnail('amorfs-card', true);
```

### Post Meta

```php
// Get formatted meta
$meta = my_custom_blog_get_post_meta();

// Display meta
my_custom_blog_post_meta();
```

### Pagination

```php
// Display pagination
my_custom_blog_pagination();
```

### Related Posts

```php
// Get related posts
$posts = my_custom_blog_get_related_posts($post_id, 3);
```

---

## 📐 Layout Structure

### Homepage Grid

```html
<div class="content-wrapper">           <!-- Grid container -->
  <aside class="category-sidebar">      <!-- Left: 200px -->
    <!-- Categories -->
  </aside>

  <div class="main-content-area">       <!-- Right: 1fr -->
    <div class="hero-section">          <!-- 65% / 35% -->
      <article class="featured-post">   <!-- Featured -->
      <aside class="recent-posts">      <!-- Recent -->
    </div>

    <div class="blog-grid">             <!-- 2 columns -->
      <!-- Cards -->
    </div>
  </div>
</div>
```

### Breakpoints

```css
/* Desktop */
@media (min-width: 1200px) {
	/* Full layout */
}

/* Tablet */
@media (max-width: 1199px) {
	/* Adjusted */
}

/* Mobile */
@media (max-width: 767px) {
	/* Stacked */
}
```

---

## 🎯 Component Classes

### Header

```html
<header class="site-header">
  <div class="header-container">
    <div class="site-branding">
      <a class="logo-link">
        <svg class="logo-icon">
        <span class="brand-text">
        <span class="blog-badge">
      </a>
    </div>
    <nav class="main-navigation">
      <ul class="nav-menu">
      <a class="contact-button">
    </nav>
  </div>
</header>
```

### Featured Post

```html
<article class="featured-post">
  <div class="featured-post-image">
    <img>
    <div class="featured-overlay">
      <div class="featured-content">
        <span class="featured-category">
        <h2 class="featured-title">
        <div class="featured-meta">
      </div>
    </div>
  </div>
</article>
```

### Blog Card

```html
<article class="blog-post-card">
  <div class="card-thumbnail">
    <img>
    <span class="card-category-badge">
  </div>
  <div class="card-content">
    <h3 class="card-title">
    <div class="card-excerpt">
    <div class="card-meta">
  </div>
</article>
```

### Footer

```html
<footer class="site-footer">
  <div class="footer-main">
    <div class="footer-grid">
      <div class="footer-column footer-brand">
      <div class="footer-column">
      <div class="footer-newsletter">
    </div>
  </div>
  <div class="footer-copyright">
</footer>
```

---

## 🎨 Common Customizations

### Change Primary Color

```css
/* In style.css */
:root {
	--color-brand-blue: #YOUR_COLOR;
	--color-brand-blue-hover: #HOVER_COLOR;
}
```

### Adjust Grid Columns

```css
.blog-grid {
	grid-template-columns: repeat(3, 1fr); /* 3 columns */
}
```

### Modify Featured Height

```css
.featured-post {
	height: 500px; /* Default: 420px */
}
```

### Change Font

```css
:root {
	--font-primary: "Your Font", sans-serif;
}
```

---

## 📝 Menu Locations

```php
// In functions.php
register_nav_menus(array(
  'primary'        => 'Primary Menu',        // Header nav
  'footer-product' => 'Footer Product',      // Product links
  'footer-support' => 'Footer Support',      // Support links
  'footer-about'   => 'Footer About',        // About links
));
```

---

## 🖼️ Image Sizes

```php
// Registered sizes
'amorfs-featured'  => 1200 x 630px  // Featured posts
'amorfs-card'      => 600 x 400px   // Blog cards
'amorfs-thumbnail' => 150 x 150px   // Recent posts
```

---

## 🔐 Security Functions

### Nonce Verification

```php
wp_verify_nonce($_POST['nonce'], 'action_name')
```

### Data Sanitization

```php
sanitize_email($email)
sanitize_text_field($text)
esc_html($text)
esc_url($url)
esc_attr($attr)
```

---

## 🎭 Template Hierarchy

```
Homepage:          index.php
Single Post:       single.php → content-single.php
Category Archive:  archive.php → content-grid.php
Static Page:       page.php → content-page.php
Search:            search.php
404:               404.php
```

---

## 🔄 The Loop

```php
<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
    <!-- Post content -->
  <?php endwhile; ?>

  <?php my_custom_blog_pagination(); ?>
<?php else : ?>
  <?php get_template_part('template-parts/content', 'none'); ?>
<?php endif; ?>
```

---

## 🎨 Custom Post Meta

### Featured Post

```php
// Check if featured
$is_featured = get_post_meta($post_id, '_amorfs_featured_post', true);

// Set as featured (in admin)
update_post_meta($post_id, '_amorfs_featured_post', '1');
```

---

## 📱 Responsive Utilities

### Mobile Menu Toggle

```javascript
$(".mobile-menu-toggle").on("click", function () {
	$(".main-navigation").toggleClass("toggled");
});
```

### Scroll Detection

```javascript
$(window).on("scroll", function () {
	if ($(window).scrollTop() > 50) {
		$(".site-header").addClass("scrolled");
	}
});
```

---

## 🎯 Common Hooks

### After Theme Setup

```php
add_action('after_setup_theme', 'your_function');
```

### Enqueue Scripts

```php
add_action('wp_enqueue_scripts', 'your_function');
```

### Widget Registration

```php
add_action('widgets_init', 'your_function');
```

### Save Post

```php
add_action('save_post', 'your_function');
```

---

## 🔍 Debugging

### Enable Debug Mode

```php
// In wp-config.php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

### Check Errors

```bash
# Check error log
tail -f wp-content/debug.log
```

---

## 📦 Child Theme Setup

```php
/* Child Theme style.css */
/*
Theme Name: Amorf's Blog Child
Template: amorfs-blog
*/
```

```php
/* Child Theme functions.php */
<?php
function child_enqueue_styles() {
  wp_enqueue_style('parent-style',
    get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'child_enqueue_styles');
```

---

## 🚀 Performance Tips

1. **Use CDN** for images
2. **Enable caching** (W3 Total Cache)
3. **Optimize images** before upload
4. **Minify CSS/JS** in production
5. **Use lazy loading** for images
6. **Enable Gzip** compression
7. **Limit revisions** in wp-config.php

---

## 📚 File Locations

```
Theme Root:        /wp-content/themes/amorfs-blog/
Styles:            style.css, css/custom.css
Scripts:           js/scripts.js
Templates:         *.php in root
Template Parts:    template-parts/*.php
Functions:         functions.php
Documentation:     *.md files
```

---

## 🎓 WordPress Resources

-   [Theme Handbook](https://developer.wordpress.org/themes/)
-   [Template Tags](https://developer.wordpress.org/themes/basics/template-tags/)
-   [The Loop](https://developer.wordpress.org/themes/basics/the-loop/)
-   [Conditional Tags](https://developer.wordpress.org/themes/basics/conditional-tags/)

---

## ⚡ Quick Commands

### Clear Cache

```bash
wp cache flush
```

### Activate Theme

```bash
wp theme activate amorfs-blog
```

### List Menus

```bash
wp menu list
```

### Generate Posts

```bash
wp post generate --count=10
```

---

**Last Updated:** October 2025  
**Theme Version:** 1.0.0

