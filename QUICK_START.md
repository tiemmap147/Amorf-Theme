# 🚀 QUICK START GUIDE - BẮT ĐẦU NHANH

## ⚡ Cài đặt trong 5 phút

### Bước 1: Upload Theme

```
1. Nén thư mục WP_Theme thành file .zip
2. WordPress Admin → Giao diện → Themes → Thêm mới
3. Upload file zip → Cài đặt → Kích hoạt
```

### Bước 2: Thiết lập Menu

```
WordPress Admin → Giao diện → Menu
→ Tạo menu mới → Thêm items → Chọn "Primary Menu" → Lưu
```

### Bước 3: Bắt đầu làm giao diện

```
Chỉnh sửa các file này để áp dụng thiết kế của bạn:
- template-parts/content.php (giao diện bài viết trong danh sách)
- template-parts/content-single.php (giao diện single post)
- css/custom.css (CSS tùy chỉnh)
```

---

## 📝 10 Hàm Quan Trọng Nhất

### 1. Hiển thị thông tin bài viết (tác giả, ngày, comments...)

```php
<?php my_custom_blog_post_meta(); ?>
```

### 2. Hiển thị ảnh đại diện

```php
<?php my_custom_blog_post_thumbnail('my-custom-blog-featured', true); ?>
```

### 3. Hiển thị excerpt (trích đoạn)

```php
<?php my_custom_blog_excerpt(30); ?>
```

### 4. Hiển thị tags

```php
<?php my_custom_blog_post_tags(); ?>
```

### 5. Hiển thị categories

```php
<?php my_custom_blog_post_categories(); ?>
```

### 6. Hiển thị phân trang

```php
<?php my_custom_blog_pagination(); ?>
```

### 7. Hiển thị breadcrumbs

```php
<?php my_custom_blog_breadcrumbs(); ?>
```

### 8. Hiển thị thời gian đọc

```php
<?php my_custom_blog_reading_time(); ?>
```

### 9. Hiển thị bài viết liên quan

```php
<?php get_template_part('template-parts/related', 'posts'); ?>
```

### 10. Hiển thị thông tin tác giả

```php
<?php get_template_part('template-parts/author', 'bio'); ?>
```

---

## 🎨 Ví dụ: Tùy chỉnh giao diện bài viết

Mở file: `template-parts/content.php`

```php
<article class="my-post-card">

    <!-- Ảnh -->
    <div class="post-image">
        <?php my_custom_blog_post_thumbnail('my-custom-blog-featured', true); ?>
    </div>

    <!-- Nội dung -->
    <div class="post-body">

        <!-- Tiêu đề -->
        <h2 class="post-title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>

        <!-- Meta -->
        <?php my_custom_blog_post_meta(); ?>

        <!-- Excerpt -->
        <?php my_custom_blog_excerpt(40); ?>

        <!-- Button -->
        <a href="<?php the_permalink(); ?>" class="btn-read-more">
            Đọc tiếp
        </a>

    </div>

</article>
```

Sau đó thêm CSS vào `css/custom.css`:

```css
.my-post-card {
	background: #fff;
	border-radius: 12px;
	overflow: hidden;
	box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
	transition: transform 0.3s;
}

.my-post-card:hover {
	transform: translateY(-8px);
}

.post-image img {
	width: 100%;
	height: 250px;
	object-fit: cover;
}

.post-body {
	padding: 1.5rem;
}

.post-title a {
	color: #222;
	font-size: 1.5rem;
	font-weight: 700;
}

.btn-read-more {
	display: inline-block;
	padding: 0.75rem 2rem;
	background: #0073aa;
	color: #fff;
	border-radius: 50px;
	margin-top: 1rem;
}
```

---

## 📁 File nào làm việc gì?

| File                                | Chức năng                       |
| ----------------------------------- | ------------------------------- |
| `style.css`                         | CSS chính của theme             |
| `functions.php`                     | Chứa tất cả hàm PHP             |
| `index.php`                         | Trang danh sách bài viết        |
| `single.php`                        | Trang single post               |
| `page.php`                          | Trang page                      |
| `header.php`                        | Header (logo, menu)             |
| `footer.php`                        | Footer                          |
| `sidebar.php`                       | Sidebar                         |
| `template-parts/content.php`        | Giao diện 1 bài viết trong list |
| `template-parts/content-single.php` | Giao diện single post           |
| `css/custom.css`                    | CSS tùy chỉnh của bạn           |
| `js/scripts.js`                     | JavaScript                      |

---

## 🔄 WordPress Loop Cơ Bản

Đây là cấu trúc lặp qua các bài viết trong WordPress:

```php
<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <!-- Hiển thị bài viết -->
        <h2><?php the_title(); ?></h2>
        <div><?php the_content(); ?></div>

    <?php endwhile; ?>

    <!-- Phân trang -->
    <?php my_custom_blog_pagination(); ?>

<?php else : ?>

    <p>Không có bài viết nào.</p>

<?php endif; ?>
```

---

## 🎯 WordPress Tags Thông Dụng

```php
// Hiển thị
the_title()          // Tiêu đề
the_content()        // Nội dung
the_excerpt()        // Trích đoạn
the_permalink()      // Link
the_author()         // Tác giả
the_date()           // Ngày đăng

// Lấy giá trị (không echo)
get_the_title()
get_permalink()
get_the_author()
get_the_date()

// Kiểm tra
is_home()            // Trang chủ
is_single()          // Single post
is_page()            // Single page
is_category()        // Trang category
has_post_thumbnail() // Có ảnh đại diện?
```

---

## ⚙️ Tùy chỉnh theme

### Thay đổi màu sắc

Thêm vào `css/custom.css`:

```css
/* Màu chủ đạo */
a,
.read-more {
	color: #e74c3c; /* Màu của bạn */
}
```

### Thay đổi font chữ

Thêm vào `functions.php`:

```php
function my_fonts() {
    wp_enqueue_style('google-font',
        'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap'
    );
}
add_action('wp_enqueue_scripts', 'my_fonts');
```

Thêm vào `css/custom.css`:

```css
body {
	font-family: "Roboto", sans-serif;
}
```

### Thay đổi layout

-   Tắt sidebar: Dùng template "Full Width"
-   Thay đổi grid: Chỉnh CSS của `.posts-list`

---

## 📚 Tài liệu đầy đủ

-   `README.md` - Hướng dẫn đầy đủ (tiếng Anh)
-   `HUONG_DAN_TIENG_VIET.md` - Hướng dẫn chi tiết (tiếng Việt)

---

## ❓ Câu hỏi thường gặp

**Q: Làm sao upload theme?**  
A: Nén thành .zip → WP Admin → Giao diện → Themes → Thêm mới → Upload

**Q: File nào chỉnh giao diện bài viết?**  
A: `template-parts/content.php` (list) và `template-parts/content-single.php` (single)

**Q: Làm sao thêm CSS?**  
A: Thêm vào `css/custom.css` hoặc Giao diện → Tùy chỉnh → Additional CSS

**Q: Làm sao tắt sidebar?**  
A: Khi edit page → Page Attributes → Template: "Full Width"

**Q: Làm sao thêm logo?**  
A: Giao diện → Tùy chỉnh → Site Identity → Logo

---

## 🎉 Bắt đầu ngay!

1. ✅ Cài đặt theme
2. ✅ Thiết lập menu
3. ✅ Thêm vài bài viết test
4. ✅ Mở `template-parts/content.php` và bắt đầu code giao diện của bạn!

**Chúc bạn thành công!** 🚀


