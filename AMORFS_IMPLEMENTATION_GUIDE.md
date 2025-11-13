# Amorf's Blog WordPress Theme - Implementation Guide

## 🎨 Design Overview

This WordPress theme implements the complete Amorf's Blog design system with a modern, clean interface featuring:

-   **Header**: Logo with gear icon, brand text, blog badge, navigation menu, and contact button
-   **Hero Section**: Large featured post with overlay and recent posts sidebar
-   **Category Filter**: Left sidebar with category navigation
-   **Blog Grid**: 2-column responsive grid layout
-   **Footer**: Dark blue footer with multi-column layout and newsletter signup
-   **Color Palette**: Blue-based design system (#2563EB primary)
-   **Typography**: Inter font family with systematic sizing
-   **Responsive**: Mobile-first design with breakpoints at 768px and 1199px

## 📁 Theme Structure

```
WP_Theme/
├── header.php                  # Header with logo, navigation, contact button
├── footer.php                  # Footer with newsletter and multi-column layout
├── index.php                   # Homepage with hero section and blog grid
├── single.php                  # Single post template with related posts
├── archive.php                 # Category archive page
├── sidebar.php                 # Sidebar template
├── functions.php               # Theme functions and features
├── style.css                   # Main stylesheet with complete design system
├── css/
│   ├── custom.css             # Additional custom styles
│   └── editor-style.css       # Editor styles
├── js/
│   └── scripts.js             # JavaScript interactions
└── template-parts/
    ├── content.php            # Default post card template
    ├── content-grid.php       # Grid post card template
    ├── content-single.php     # Single post content template
    └── content-none.php       # No content template
```

## 🚀 Installation

1. **Upload Theme**

    ```bash
    # Upload the entire WP_Theme folder to:
    wp-content/themes/amorfs-blog/
    ```

2. **Activate Theme**

    - Go to WordPress Admin > Appearance > Themes
    - Find "Amorf's Blog Theme"
    - Click "Activate"

3. **Install Required Font**
    - The theme automatically loads Inter font from Google Fonts
    - No additional setup required

## ⚙️ Theme Configuration

### 1. Menu Setup

Navigate to: **Appearance > Menus**

Create the following menus:

-   **Primary Menu** (Header navigation)
    -   Assign to "Primary Menu" location
    -   Add pages: About Amorf's, FAQ, Contact Us
-   **Footer Product Links**

    -   Assign to "Footer Product Links" location
    -   Add: Browser Extension, Data Studio

-   **Footer Support Links**

    -   Assign to "Footer Support Links" location
    -   Add: Contact Us

-   **Footer About Links**
    -   Assign to "Footer About Links" location
    -   Add: Terms and Conditions, Privacy and Policy

### 2. Create Required Pages

Create the following pages:

1. **Home** (Set as front page in Settings > Reading)
2. **About Amorf's**
3. **FAQ**
4. **Contact Us**
5. **Privacy Policy** (WordPress default)
6. **Terms and Conditions**

### 3. Categories Setup

Navigate to: **Posts > Categories**

Create categories such as:

-   Technology
-   Tutorials
-   Updates
-   News
-   Reviews

### 4. Widget Areas

The theme registers these widget areas:

-   **Main Sidebar** - Not used in main layout (Amorf's design uses custom sidebars)
-   **Footer Newsletter** - For custom newsletter widget

## 🎨 Design System Reference

### Color Palette

```css
/* Primary Colors */
--color-brand-blue: #2563EB
--color-brand-blue-hover: #1D4ED8
--color-light-blue: #60A5FA
--color-very-light-blue: #DBEAFE

/* Footer Colors */
--color-footer-blue: #1E3A8A

/* Grays */
--color-text-dark: #1F2937
--color-text-body: #4B5563
--color-text-light: #6B7280
--color-text-muted: #9CA3AF

/* Backgrounds */
--color-white: #FFFFFF
--color-light-gray: #F9FAFB
--color-subtle-gray: #F3F4F6

/* Borders */
--color-border-light: #E5E7EB
--color-border-medium: #D1D5DB
--color-border-strong: #CBD5E1
```

### Typography

```css
/* Font Sizes */
--font-size-hero: 32px        /* Featured post title */
--font-size-card-title: 20px  /* Blog card titles */
--font-size-section-title: 18px
--font-size-large: 15px
--font-size-base: 14px
--font-size-small: 13px
--font-size-tiny: 12px
--font-size-micro: 11px       /* Category badges */

/* Font Weights */
--font-weight-bold: 700
--font-weight-semibold: 600
--font-weight-medium: 500
--font-weight-regular: 400
```

### Spacing System (8px base)

```css
--spacing-xs: 8px
--spacing-sm: 12px
--spacing-md: 16px
--spacing-lg: 24px
--spacing-xl: 32px
--spacing-2xl: 40px
--spacing-3xl: 60px
```

### Border Radius

```css
--radius-large: 16px   /* Featured card */
--radius-medium: 12px  /* Cards */
--radius-small: 8px    /* Inputs, badges */
--radius-tiny: 6px     /* Small badges */
```

## 📝 Content Guidelines

### Creating Featured Post

1. Create or edit a post
2. In the right sidebar, find "Featured Post" meta box
3. Check "Mark as featured post"
4. Set a featured image (recommended size: 1200x630px)
5. The post will appear in the hero section on the homepage

### Blog Post Best Practices

1. **Featured Image**: Always add a featured image (1200x630px recommended)
2. **Category**: Assign at least one category to each post
3. **Excerpt**: Write a custom excerpt (or it will be auto-generated)
4. **Title**: Keep titles concise (under 60 characters for best display)

### Image Sizes

The theme registers these image sizes:

-   **amorfs-featured**: 1200x630px (Featured posts)
-   **amorfs-card**: 600x400px (Blog grid cards)
-   **amorfs-thumbnail**: 150x150px (Recent posts sidebar)

## 🔧 Customization

### Changing Colors

Edit `style.css` and modify the CSS variables in the `:root` section:

```css
:root {
	--color-brand-blue: #YOUR_COLOR;
	/* etc. */
}
```

### Modifying Layout

**Change Grid Columns** (in `style.css`):

```css
.blog-grid {
	grid-template-columns: repeat(2, 1fr); /* Change to 3 for 3 columns */
}
```

**Featured Post Height** (in `style.css`):

```css
.featured-post {
	height: 420px; /* Adjust as needed */
}
```

### Adding Custom Logo

1. Go to **Appearance > Customize > Site Identity**
2. Click "Select Logo"
3. Upload your logo (recommended: 200x60px)
4. The theme will use your logo instead of the default SVG gear icon

### Newsletter Integration

The newsletter form is ready to integrate with email services:

1. Edit `functions.php`
2. Find `amorfs_handle_newsletter_signup()` function
3. Add your email service API integration (MailChimp, ConvertKit, etc.)

Example for MailChimp:

```php
// In amorfs_handle_newsletter_signup() function
$api_key = 'YOUR_MAILCHIMP_API_KEY';
$list_id = 'YOUR_LIST_ID';
// Add MailChimp API call here
```

## 🎯 Features

### Automatic Features

-   ✅ Reading time calculation (200 words/minute)
-   ✅ Responsive images with lazy loading support
-   ✅ Mobile menu with smooth transitions
-   ✅ Sticky header on scroll
-   ✅ Back to top button
-   ✅ Reading progress bar (single posts)
-   ✅ Smooth scroll for anchor links
-   ✅ External links open in new tab
-   ✅ Newsletter signup with validation
-   ✅ Related posts based on categories
-   ✅ Responsive design (mobile/tablet/desktop)

### SEO Features

-   ✅ Semantic HTML5 markup
-   ✅ Schema.org microdata ready
-   ✅ Optimized heading structure
-   ✅ Alt text support for images
-   ✅ Breadcrumbs (can be enabled)
-   ✅ Clean URL structure

## 📱 Responsive Breakpoints

The theme uses these breakpoints:

-   **Desktop**: 1200px and above (full layout)
-   **Tablet**: 768px - 1199px (adjusted layout)
-   **Mobile**: Below 768px (stacked layout)

### Mobile Optimizations

-   Hamburger menu replaces navigation
-   Single column layout
-   Stacked newsletter form
-   Reduced font sizes (15% smaller)
-   Touch-optimized buttons
-   Optimized image sizes

## 🔍 Browser Support

-   ✅ Chrome (latest)
-   ✅ Firefox (latest)
-   ✅ Safari (latest)
-   ✅ Edge (latest)
-   ✅ Mobile browsers (iOS Safari, Chrome Mobile)

## 🐛 Troubleshooting

### Issue: Featured post not showing

**Solution**:

1. Check if "Featured Post" checkbox is checked
2. Ensure post has a featured image
3. Verify you're on the home page (not a category archive)

### Issue: Styles not loading

**Solution**:

1. Clear WordPress cache
2. Hard refresh browser (Ctrl+Shift+R or Cmd+Shift+R)
3. Check file permissions on CSS files

### Issue: Newsletter not working

**Solution**:

1. Check form action URL in `footer.php`
2. Verify nonce is being generated
3. Check PHP error logs for issues
4. Ensure email service integration is configured

### Issue: Categories not showing in sidebar

**Solution**:

1. Create at least one category
2. Assign posts to categories
3. Ensure "hide_empty" is set to true in category query

## 🚀 Performance Tips

1. **Use CDN**: Consider using a CDN for images
2. **Image Optimization**: Compress images before upload
3. **Caching Plugin**: Install WP Super Cache or W3 Total Cache
4. **Lazy Loading**: The theme supports native lazy loading
5. **Minify CSS/JS**: Use a minification plugin in production

## 📚 Additional Resources

### WordPress Codex

-   [Theme Development](https://developer.wordpress.org/themes/)
-   [Template Hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/)
-   [Template Tags](https://developer.wordpress.org/themes/basics/template-tags/)

### Customization Guides

-   [Child Themes](https://developer.wordpress.org/themes/advanced-topics/child-themes/)
-   [Customizer API](https://developer.wordpress.org/themes/customize-api/)
-   [Theme Functions](https://developer.wordpress.org/themes/basics/theme-functions/)

## 📄 License

This theme is licensed under the GNU General Public License v2 or later.

## 🙋 Support

For theme support and questions:

-   Check documentation in `/FUNCTIONS_REFERENCE.md`
-   Review structure in `/STRUCTURE.md`
-   See quick start guide in `/QUICK_START.md`

## 🎉 Credits

-   **Design System**: Amorf's Blog Design
-   **Font**: Inter by Rasmus Andersson (Google Fonts)
-   **Icons**: SVG custom icons
-   **Framework**: WordPress 5.0+

---

**Theme Version**: 1.0.0  
**Last Updated**: October 2025  
**Requires WordPress**: 5.0 or higher  
**Requires PHP**: 7.4 or higher

