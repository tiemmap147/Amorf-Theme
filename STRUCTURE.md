# 📂 CẤU TRÚC THEME

## Tổng quan cấu trúc file

```
WP_Theme/
│
├── 📄 style.css                    ← CSS chính & thông tin theme (BẮT BUỘC)
├── 📄 functions.php                ← Tất cả hàm PHP & logic (BẮT BUỘC)
├── 📄 index.php                    ← Template mặc định (BẮT BUỘC)
│
├── 📄 header.php                   ← Header (logo, menu, navigation)
├── 📄 footer.php                   ← Footer (copyright, widgets, menu)
├── 📄 sidebar.php                  ← Sidebar (widgets area)
│
├── 📄 single.php                   ← Template cho single post
├── 📄 page.php                     ← Template cho page
├── 📄 archive.php                  ← Template cho archive (category, tag, date...)
├── 📄 search.php                   ← Template cho search results
├── 📄 404.php                      ← Template cho error 404
│
├── 📄 comments.php                 ← Template cho comments section
├── 📄 searchform.php               ← Template cho search form
│
├── 📁 template-parts/              ← Các component tái sử dụng
│   ├── content.php                 ← Hiển thị post trong danh sách
│   ├── content-single.php          ← Hiển thị single post
│   ├── content-page.php            ← Hiển thị page content
│   ├── content-search.php          ← Hiển thị search result item
│   ├── content-none.php            ← Hiển thị khi không có content
│   ├── author-bio.php              ← Box thông tin tác giả
│   └── related-posts.php           ← Section bài viết liên quan
│
├── 📁 page-templates/              ← Custom page templates
│   └── full-width.php              ← Template full width (no sidebar)
│
├── 📁 css/                         ← Stylesheets
│   ├── custom.css                  ← CSS tùy chỉnh (thêm CSS ở đây)
│   └── editor-style.css            ← Styles cho WordPress editor
│
├── 📁 js/                          ← JavaScript files
│   └── scripts.js                  ← JavaScript chính (menu, smooth scroll...)
│
├── 📄 README.md                    ← Hướng dẫn đầy đủ (English)
├── 📄 HUONG_DAN_TIENG_VIET.md      ← Hướng dẫn chi tiết (Tiếng Việt)
├── 📄 QUICK_START.md               ← Hướng dẫn bắt đầu nhanh
├── 📄 STRUCTURE.md                 ← File này - giải thích cấu trúc
│
├── 📄 LICENSE.txt                  ← GPL v2 License
├── 📄 .gitignore                   ← Git ignore file
└── 📄 screenshot.txt               ← Hướng dẫn tạo screenshot (xóa sau khi tạo)
```

---

## 📋 Chi tiết từng file

### ⭐ Core Files (Bắt buộc)

#### `style.css`

-   **Mục đích**: CSS chính + Metadata theme
-   **Quan trọng**: WordPress đọc thông tin theme từ header comment
-   **Chỉnh sửa**: Có thể chỉnh CSS, nhưng nên dùng `css/custom.css`

#### `functions.php`

-   **Mục đích**: Chứa tất cả hàm PHP, hooks, filters
-   **Nội dung**:
    -   Theme setup (menus, thumbnails, widgets...)
    -   Enqueue scripts & styles
    -   Helper functions (map dữ liệu WordPress)
    -   Custom functions
-   **Quan trọng**: Đây là "bộ não" của theme

#### `index.php`

-   **Mục đích**: Fallback template chính
-   **Sử dụng khi**: Không có template cụ thể nào khác
-   **Thường hiển thị**: Danh sách bài viết (blog listing)

---

### 🎨 Layout Templates

#### `header.php`

-   Logo/Site title
-   Primary navigation menu
-   Mobile menu toggle
-   Breadcrumbs (nếu không phải homepage)

#### `footer.php`

-   Footer widgets (3 areas)
-   Footer menu
-   Copyright & credits
-   Closing tags (</body>, </html>)

#### `sidebar.php`

-   Widget area "sidebar-1"
-   Hiển thị ở most pages (trừ full-width template)

---

### 📄 Content Templates

#### `single.php`

-   **Hiển thị**: Single blog post
-   **Components**:
    -   Breadcrumbs
    -   Post thumbnail
    -   Post meta (author, date...)
    -   Full content
    -   Categories & tags
    -   Post navigation (prev/next)
    -   Author bio
    -   Related posts
    -   Comments

#### `page.php`

-   **Hiển thị**: Single page
-   **Components**:
    -   Page content
    -   Comments (if enabled)
    -   Sidebar (có thể tắt với full-width template)

#### `archive.php`

-   **Hiển thị**: Category, Tag, Date, Author archives
-   **Components**:
    -   Archive title & description
    -   List of posts
    -   Pagination
    -   Sidebar

#### `search.php`

-   **Hiển thị**: Search results
-   **Components**:
    -   Search query title
    -   List of results
    -   Pagination
    -   Sidebar

#### `404.php`

-   **Hiển thị**: Error 404 page
-   **Components**:
    -   Error message
    -   Search form
    -   Recent posts
    -   Popular categories

---

### 🧩 Template Parts (Components)

#### `template-parts/content.php`

-   **Sử dụng**: Hiển thị 1 bài viết trong list/archive
-   **Được gọi từ**: `index.php`, `archive.php`
-   **Hiển thị**:
    -   Post thumbnail (linked)
    -   Post title (linked)
    -   Post meta
    -   Excerpt
    -   Read more link
    -   Tags

#### `template-parts/content-single.php`

-   **Sử dụng**: Hiển thị single post
-   **Được gọi từ**: `single.php`
-   **Hiển thị**:
    -   Post thumbnail (not linked)
    -   Post title
    -   Post meta + reading time
    -   Full content
    -   Categories & tags

#### `template-parts/content-page.php`

-   **Sử dụng**: Hiển thị page content
-   **Được gọi từ**: `page.php`, `page-templates/full-width.php`

#### `template-parts/content-search.php`

-   **Sử dụng**: Hiển thị 1 item trong search results
-   **Được gọi từ**: `search.php`

#### `template-parts/content-none.php`

-   **Sử dụng**: Hiển thị khi không có content
-   **Được gọi từ**: Tất cả templates khi `have_posts()` = false

#### `template-parts/author-bio.php`

-   **Sử dụng**: Box thông tin tác giả
-   **Được gọi từ**: `single.php`
-   **Hiển thị**:
    -   Avatar
    -   Author name (linked)
    -   Bio
    -   Posts count
    -   View all posts link

#### `template-parts/related-posts.php`

-   **Sử dụng**: Hiển thị bài viết liên quan
-   **Được gọi từ**: `single.php`
-   **Logic**: Lấy 3 bài cùng category

---

### 🎯 Page Templates

#### `page-templates/full-width.php`

-   **Template Name**: Full Width (No Sidebar)
-   **Sử dụng**: Trang full width không sidebar
-   **Cách dùng**: Chọn template khi edit page
-   **Có thể tạo thêm**: Template khác theo nhu cầu

---

### 💅 Styles

#### `css/custom.css`

-   **Mục đích**: Thêm CSS tùy chỉnh của bạn
-   **Ưu điểm**: Tách riêng khỏi `style.css`, dễ quản lý
-   **Nội dung có sẵn**:
    -   Post navigation styles
    -   Author bio styles
    -   Related posts styles
    -   Breadcrumbs styles
    -   And more...

#### `css/editor-style.css`

-   **Mục đích**: Styles cho WordPress block editor
-   **Ưu điểm**: WYSIWYG - editor giống frontend

---

### ⚡ JavaScript

#### `js/scripts.js`

-   **Features có sẵn**:
    -   Mobile menu toggle
    -   Smooth scroll for anchors
    -   Header scroll effect
    -   Back to top button
    -   External links (open in new tab)
    -   Responsive video embeds (FitVids)
    -   Search form enhancement
-   **jQuery**: Được WordPress enqueue sẵn

---

### 📚 Documentation

#### `README.md`

-   Hướng dẫn đầy đủ (English)
-   Tất cả functions
-   Examples
-   FAQ

#### `HUONG_DAN_TIENG_VIET.md`

-   Hướng dẫn chi tiết tiếng Việt
-   Giải thích từng hàm
-   Ví dụ thực tế
-   Tips & tricks

#### `QUICK_START.md`

-   Hướng dẫn bắt đầu nhanh
-   10 hàm quan trọng nhất
-   Quick examples

#### `STRUCTURE.md`

-   File này
-   Giải thích cấu trúc theme

---

## 🔄 WordPress Template Hierarchy

Thứ tự WordPress tìm template:

### For Single Post:

```
single-{post-type}-{slug}.php
→ single-{post-type}.php
→ single.php
→ singular.php
→ index.php
```

### For Page:

```
page-{slug}.php
→ page-{id}.php
→ page.php
→ singular.php
→ index.php
```

### For Category:

```
category-{slug}.php
→ category-{id}.php
→ category.php
→ archive.php
→ index.php
```

### For Search:

```
search.php
→ index.php
```

### For 404:

```
404.php
→ index.php
```

---

## 🎯 Khi nào dùng file nào?

| Mục đích                               | File chỉnh sửa                      |
| -------------------------------------- | ----------------------------------- |
| Thay đổi giao diện bài viết trong list | `template-parts/content.php`        |
| Thay đổi giao diện single post         | `template-parts/content-single.php` |
| Thay đổi header (logo, menu)           | `header.php`                        |
| Thay đổi footer                        | `footer.php`                        |
| Thêm CSS                               | `css/custom.css`                    |
| Thêm JavaScript                        | `js/scripts.js`                     |
| Thêm hàm PHP mới                       | `functions.php`                     |
| Thay đổi layout archive                | `archive.php`                       |
| Tạo template page mới                  | `page-templates/`                   |

---

## 🔧 Workflow thường dùng

### 1. Làm giao diện bài viết:

```
1. Mở template-parts/content.php
2. Chỉnh HTML structure
3. Mở css/custom.css
4. Thêm CSS styles
5. Refresh browser
```

### 2. Làm giao diện single post:

```
1. Mở template-parts/content-single.php
2. Chỉnh layout, thêm/bớt elements
3. Style trong css/custom.css
```

### 3. Thêm functionality:

```
1. Mở functions.php
2. Thêm function mới
3. Gọi function trong template
```

### 4. Tạo page template mới:

```
1. Copy page-templates/full-width.php
2. Đổi tên file và Template Name
3. Customize layout
4. Chọn template khi edit page
```

---

## 📦 Widget Areas

Theme có 4 widget areas:

1. **sidebar-1** (Main Sidebar)

    - Hiển thị: Most pages (trừ full-width)
    - Location: Bên phải content

2. **footer-1** (Footer Widget Area 1)
    - Hiển thị: Footer - cột 1
3. **footer-2** (Footer Widget Area 2)
    - Hiển thị: Footer - cột 2
4. **footer-3** (Footer Widget Area 3)
    - Hiển thị: Footer - cột 3

---

## 🎨 Image Sizes

Theme định nghĩa 3 sizes:

-   **my-custom-blog-featured**: 1200x630px (16:9)
-   **my-custom-blog-medium**: 800x600px (4:3)
-   **my-custom-blog-thumbnail**: 400x300px (4:3)

Dùng: `my_custom_blog_post_thumbnail('size-name', $link)`

---

## 🔗 Menu Locations

Theme có 2 menu locations:

1. **primary** - Main navigation (header)
2. **footer** - Footer navigation

Setup: WP Admin → Giao diện → Menu

---

## ✅ Checklist trước khi deploy

-   [ ] Screenshot.png đã tạo (880x660px)
-   [ ] Thông tin theme trong style.css đã update
-   [ ] Logo đã upload
-   [ ] Menu đã setup
-   [ ] Widgets đã cấu hình
-   [ ] Test trên mobile
-   [ ] Test tất cả templates
-   [ ] Check linter errors
-   [ ] Backup database
-   [ ] Ready to go! 🚀

---

**Cấu trúc này giúp theme dễ maintain, extend và customize!**


