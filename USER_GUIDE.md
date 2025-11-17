# 📚 Amorfs Blog Theme - User Guide

A comprehensive guide for customizing your WordPress site using the Amorfs Blog Theme through the WordPress admin interface.

---

## 📖 Table of Contents

1. [Site Logo Customization](#1-site-logo-customization)
2. [Navigation Menu Setup](#2-navigation-menu-setup)
3. [Header Buttons Configuration](#3-header-buttons-configuration)
4. [Footer Menu Setup](#4-footer-menu-setup)
5. [Newsletter Widget](#5-newsletter-widget)
6. [FAQ Management](#6-faq-management)

---

## 1. Site Logo Customization

### How to Change Your Site Logo

1. Go to **Appearance → Customize**
2. Click on **Site Identity**
3. Click **Select Logo** button
4. Upload your logo image or choose from Media Library
5. Adjust the logo size if needed
6. Click **Publish** to save changes

**Recommended Logo Size:** 400px width × 100px height (or proportional)

**Supported Formats:** PNG, JPG, SVG (SVG recommended for best quality)

---

## 2. Navigation Menu Setup

### Creating Your Main Menu

1. Go to **Appearance → Menus**
2. Click **Create a new menu** or edit existing "Primary Menu"
3. Enter a menu name (e.g., "Main Navigation")
4. Check **Primary Menu** under "Display location"
5. Add pages/posts/custom links from the left panel
6. Drag and drop to reorder menu items
7. Click **Save Menu**

### Adding Vietnamese Title to Menu Items

Each menu item can have a Vietnamese translation that will be displayed when the site language is set to Vietnamese.

**In Appearance → Menus:**

1. Click on a menu item to expand its settings
2. Find the **Vietnamese Title** field
3. Enter the Vietnamese translation for that menu item
4. Click **Save Menu**

**In Appearance → Customize → Menus:**

1. Open the menu you want to edit
2. Click on a menu item to expand it
3. Find the **Vietnamese Title** field below the Navigation Label
4. Enter the Vietnamese translation
5. Click **Publish**

**Example:**

-   Navigation Label: `Products`
-   Vietnamese Title: `Sản phẩm`

### Setting Menu Items as "Coming Soon"

You can mark menu items as "Coming Soon" to prevent navigation and show a tooltip message.

**In Appearance → Menus:**

1. Click on a menu item to expand its settings
2. Find the **Coming Soon** checkbox
3. Check the box to enable Coming Soon mode
4. Click **Save Menu**

**In Appearance → Customize → Menus:**

1. Open the menu you want to edit
2. Click on a menu item to expand it
3. Find the **Coming Soon** checkbox below the Vietnamese Title field
4. Check the box to enable Coming Soon mode
5. Click **Publish**

**What Happens:**

-   The menu item link will be disabled (changes to `#`)
-   When users click on it, a tooltip will appear with "Coming soon!" (English) or "Sắp ra mắt!" (Vietnamese)
-   The menu item will display normally but won't navigate anywhere

**Use Cases:**

-   Features that are under development
-   Upcoming products or services
-   Placeholder menu items for future content

### Menu Items Best Practices

-   Keep menu items to 5-7 for optimal user experience
-   Use clear, concise labels
-   Organize related items in sub-menus (drag slightly right to create dropdown)
-   Add Vietnamese translations for bilingual support
-   Use "Coming Soon" for items that aren't ready yet

---

## 3. Header Buttons Configuration

The theme includes two customizable action buttons in the header: **Data Studio** and **Install Extension**.

### Accessing Header Buttons Settings

1. Go to **Appearance → Customize**
2. Find and click **Header Buttons** section

### Data Studio Button

#### Available Settings:

**Button Text**

-   Default: "Data Studio"
-   Enter the text you want to display
-   Examples: "Try Demo", "Open Dashboard", "Launch App"

**Button URL**

-   Enter the full URL where users should be directed
-   Can be external: `https://yourdomain.com/dashboard`
-   Can be internal: Link to any page on your site

**Show/Hide Button**

-   Check to display the button
-   Uncheck to hide it completely

### Install Extension Button

#### Available Settings:

**Button Text**

-   Default: "Install Extension"
-   Enter the text you want to display
-   Examples: "Download", "Get Started", "Try Free"

**Button URL**

-   Enter the full URL for the extension download or installation page
-   Examples: Chrome Web Store link, App Store link, Download page

**Show/Hide Button**

-   Check to display the button
-   Uncheck to hide it completely

### Common Use Cases:

**Link to External App:**

-   Button Text: "Open Dashboard"
-   Button URL: `https://app.yourdomain.com`
-   Show Button: ✓ Checked

**Link to Download Page:**

-   Button Text: "Download Now"
-   Button URL: `https://chrome.google.com/webstore/your-extension`
-   Show Button: ✓ Checked

**Temporarily Hide Button:**

-   Show Button: Unchecked

---

## 4. Footer Menu Setup

The footer has three menu locations: **Products**, **Support**, and **Policy**.

### Creating Footer Menus

1. Go to **Appearance → Menus**
2. Create a new menu or select existing one
3. Add menu items (pages, custom links)
4. Check the appropriate footer location:
    - **Footer Product Links** - for product-related pages
    - **Footer Support Links** - for help and support pages
    - **Footer Policy Links** - for legal pages
5. Click **Save Menu**

### Recommended Footer Menu Structure:

**Products Column:**

-   Browser Extension
-   Data Studio
-   Features
-   Pricing

**Support Column:**

-   FAQ
-   Contact Us
-   Help Center
-   Documentation

**Policy Column:**

-   Terms and Conditions
-   Privacy Policy
-   Cookie Policy
-   Disclaimer

---

## 5. Newsletter Widget

## 6. FAQ Management

The theme includes a custom FAQ system with accordion-style display.

### Adding New FAQ Items

1. Go to **FAQs** in the WordPress admin menu
2. Click **Add New**
3. Enter the **Question** in the title field
4. Enter the **Answer** in the FAQ Answer box below
5. Set the **Order** number (lower numbers appear first)
6. Click **Publish**

### Managing FAQ Order

FAQs are displayed in ascending order based on the "Order" field:

1. Edit any FAQ post
2. Find **Page Attributes** box on the right
3. Enter a number in the **Order** field
    - Order: 1 (appears first)
    - Order: 2 (appears second)
    - Order: 3 (appears third)
4. Update the FAQ post

### FAQ Display Features:

-   First FAQ opens by default
-   Click any question to expand/collapse
-   Smooth accordion animation
-   Mobile-friendly design

---

**Version:** 1.0  
**Last Updated:** November 2025  
**Theme:** Amorfs Blog Theme
