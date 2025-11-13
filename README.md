# Amorf's Blog WordPress Theme

A modern, beautiful, and fully-featured WordPress blog theme implementing the Amorf's design system.

![Theme Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
![WordPress](https://img.shields.io/badge/WordPress-5.0%2B-blue.svg)
![PHP](https://img.shields.io/badge/PHP-7.4%2B-purple.svg)
![License](https://img.shields.io/badge/license-GPL--2.0%2B-green.svg)

## 🎨 Design Features

### Visual Design

-   **Modern Interface**: Clean, professional design with Amorf's branding
-   **Color Palette**: Blue-based design system (#2563EB primary color)
-   **Typography**: Inter font family with systematic sizing
-   **Responsive**: Mobile-first design, fully responsive across all devices
-   **Dark Footer**: Elegant dark blue footer with white text

### Layout Components

-   **Header**: Logo with gear icon, navigation menu, language selector, contact button
-   **Hero Section**: Large featured post with image overlay and content
-   **Recent Posts Sidebar**: Compact cards showing latest posts
-   **Category Filter**: Left sidebar with category navigation
-   **Blog Grid**: 2-column responsive grid with card design
-   **Pagination**: Numbered pagination with prev/next arrows
-   **Footer**: Multi-column layout with newsletter signup

## ✨ Key Features

### Content Features

-   ✅ Featured post highlighting on homepage
-   ✅ Automatic reading time calculation
-   ✅ Category-based filtering and navigation
-   ✅ Related posts based on categories
-   ✅ Custom post excerpts with ellipsis
-   ✅ Author information display
-   ✅ Comments system with threading

### Functional Features

-   ✅ Sticky header on scroll
-   ✅ Mobile hamburger menu
-   ✅ Smooth scroll animations
-   ✅ Back to top button
-   ✅ Reading progress bar (single posts)
-   ✅ Newsletter signup form
-   ✅ External links open in new tab
-   ✅ Lazy loading support for images
-   ✅ SEO-friendly semantic HTML5

### Technical Features

-   ✅ Widget-ready footer areas
-   ✅ Multiple navigation menu locations
-   ✅ Custom image sizes
-   ✅ Featured post meta box
-   ✅ Translation ready
-   ✅ Custom logo support
-   ✅ Editor styles
-   ✅ Responsive embeds

## 📋 Requirements

-   **WordPress**: 5.0 or higher
-   **PHP**: 7.4 or higher
-   **MySQL**: 5.6 or higher

## 🚀 Installation

### Method 1: Upload via WordPress Admin

1. Download the theme files
2. Go to **Appearance > Themes > Add New**
3. Click **Upload Theme**
4. Choose the theme ZIP file
5. Click **Install Now**
6. Click **Activate**

### Method 2: FTP Upload

1. Download the theme files
2. Extract the ZIP file
3. Upload the folder to `/wp-content/themes/`
4. Go to **Appearance > Themes**
5. Click **Activate** on Amorf's Blog Theme

### Method 3: WordPress CLI

```bash
wp theme install amorfs-blog.zip --activate
```

## ⚙️ Setup & Configuration

### 1. Initial Setup

After activation, configure these essential settings:

1. **Create Menus** (Appearance > Menus):

    - Primary Menu (header navigation)
    - Footer Product Links
    - Footer Support Links
    - Footer About Links

2. **Create Required Pages**:

    - Home
    - About Amorf's
    - FAQ
    - Contact Us
    - Privacy Policy
    - Terms and Conditions

3. **Set Reading Settings** (Settings > Reading):

    - Select "A static page" for homepage
    - Choose your Home page

4. **Create Categories** (Posts > Categories):
    - Add at least 3-5 categories for best navigation

### 2. Content Setup

1. **Add Featured Posts**:

    - Edit a post
    - Check "Mark as featured post" in the sidebar
    - Add a featured image (1200x630px recommended)

2. **Add Blog Posts**:
    - Create posts with featured images
    - Assign to categories
    - Add custom excerpts (optional)

### 3. Customization

1. **Logo** (Appearance > Customize > Site Identity):

    - Upload custom logo (200x60px recommended)
    - Or use default Amorf's logo

2. **Site Colors** (Optional):

    - Edit `style.css` to modify CSS variables
    - Change `--color-brand-blue` for different color scheme

3. **Newsletter** (Optional):
    - Edit `functions.php` to integrate with email service
    - Add MailChimp, ConvertKit, or other API

## 📁 File Structure

```
WP_Theme/
├── header.php                    # Header template
├── footer.php                    # Footer with newsletter
├── index.php                     # Homepage with hero section
├── single.php                    # Single post template
├── archive.php                   # Category archive
├── page.php                      # Static pages
├── sidebar.php                   # Sidebar template
├── functions.php                 # Theme functions
├── style.css                     # Main stylesheet
├── css/
│   ├── custom.css               # Additional styles
│   └── editor-style.css         # Editor styles
├── js/
│   └── scripts.js               # JavaScript
├── template-parts/
│   ├── content.php              # Post card
│   ├── content-grid.php         # Grid card
│   ├── content-single.php       # Single post
│   ├── content-none.php         # No content
│   ├── author-bio.php           # Author info
│   └── related-posts.php        # Related posts
└── page-templates/
    └── full-width.php           # Full width template
```

## 🎨 Design System

### Colors

```css
Primary Blue:     #2563EB
Blue Hover:       #1D4ED8
Light Blue:       #60A5FA
Very Light Blue:  #DBEAFE
Footer Blue:      #1E3A8A

Text Dark:        #1F2937
Text Body:        #4B5563
Text Light:       #6B7280
Text Muted:       #9CA3AF

Background:       #FFFFFF
Light Gray:       #F9FAFB
Border Light:     #E5E7EB
```

### Typography

-   **Font Family**: Inter (Google Fonts)
-   **Hero Title**: 32px / Bold
-   **Card Title**: 20px / Bold
-   **Body Text**: 14-15px / Regular
-   **Small Text**: 12-13px / Medium

### Spacing

Based on 8px system:

-   XS: 8px
-   SM: 12px
-   MD: 16px
-   LG: 24px
-   XL: 32px
-   2XL: 40px
-   3XL: 60px

## 📖 Documentation

Detailed documentation available in:

-   **AMORFS_IMPLEMENTATION_GUIDE.md** - Complete implementation guide
-   **STRUCTURE.md** - Theme structure and architecture
-   **FUNCTIONS_REFERENCE.md** - Function reference guide
-   **QUICK_START.md** - Quick start guide

## 🔧 Customization Examples

### Change Primary Color

Edit `style.css`:

```css
:root {
	--color-brand-blue: #YOUR_COLOR;
	--color-brand-blue-hover: #YOUR_HOVER_COLOR;
}
```

### Modify Grid Layout

Edit `style.css`:

```css
.blog-grid {
	grid-template-columns: repeat(3, 1fr); /* 3 columns instead of 2 */
}
```

### Add Custom Widget Area

Edit `functions.php`:

```php
register_sidebar(array(
    'name'          => 'My Custom Area',
    'id'            => 'custom-area',
    'before_widget' => '<div class="widget">',
    'after_widget'  => '</div>',
));
```

## 🌐 Browser Support

-   ✅ Chrome (latest)
-   ✅ Firefox (latest)
-   ✅ Safari (latest)
-   ✅ Edge (latest)
-   ✅ Mobile browsers

## 📱 Responsive Breakpoints

-   **Desktop**: 1200px+ (full layout)
-   **Tablet**: 768px - 1199px (adjusted layout)
-   **Mobile**: < 768px (stacked layout)

## 🔌 Recommended Plugins

While the theme works standalone, these plugins enhance functionality:

-   **Yoast SEO** - SEO optimization
-   **Contact Form 7** - Contact forms
-   **WP Super Cache** - Performance
-   **Akismet** - Anti-spam
-   **MailChimp for WP** - Newsletter integration

## 🐛 Troubleshooting

### Featured post not showing?

-   Check "Featured Post" meta box is checked
-   Ensure post has featured image
-   Verify you're on the homepage

### Menu not appearing?

-   Go to Appearance > Menus
-   Create menu and assign to location
-   Add menu items

### Styles not loading?

-   Clear WordPress cache
-   Hard refresh browser (Ctrl+Shift+R)
-   Check file permissions

See **AMORFS_IMPLEMENTATION_GUIDE.md** for more troubleshooting.

## 📝 Changelog

### Version 1.0.0 (October 2025)

-   Initial release
-   Complete Amorf's design implementation
-   Hero section with featured posts
-   Category filter sidebar
-   Blog grid layout
-   Dark blue footer with newsletter
-   Mobile responsive design
-   Reading time calculation
-   Related posts
-   Comments system

## 🤝 Contributing

Contributions are welcome! Please follow WordPress coding standards.

## 📄 License

This theme is licensed under the GNU General Public License v2 or later.

**License URI**: http://www.gnu.org/licenses/gpl-2.0.html

## 👨‍💻 Developer

**Theme Name**: Amorf's Blog Theme  
**Version**: 1.0.0  
**Author**: Your Name  
**Author URI**: https://example.com  
**Theme URI**: https://example.com/amorfs-blog-theme

## 🙏 Credits

-   **Design System**: Amorf's Blog Design Specification
-   **Font**: Inter by Rasmus Andersson (Google Fonts)
-   **Icons**: Custom SVG icons
-   **Framework**: WordPress Theme Development Standards

## 📞 Support

For support and questions:

-   📧 Email: support@example.com
-   🌐 Website: https://example.com
-   📖 Documentation: See included MD files
-   🐛 Issues: Report via theme support

## 🌟 Features Roadmap

Future enhancements planned:

-   [ ] Dark mode toggle
-   [ ] Advanced theme customizer options
-   [ ] Additional page templates
-   [ ] Widget bundle
-   [ ] WooCommerce support
-   [ ] Gutenberg block patterns
-   [ ] Multi-language support (WPML)

---

**Made with ❤️ following WordPress and Amorf's design standards**
