# Hướng Dẫn Sử Dụng Theme WordPress - Tiếng Việt

## 📋 Mục Lục

1. [Giới Thiệu](#giới-thiệu)
2. [Cài Đặt](#cài-đặt)
3. [Hàm Map Dữ Liệu](#hàm-map-dữ-liệu)
4. [Cấu Trúc File](#cấu-trúc-file)
5. [Ví Dụ Sử Dụng](#ví-dụ-sử-dụng)
6. [Tùy Chỉnh](#tùy-chỉnh)

---

## 🎯 Giới Thiệu

Theme này được tạo ra để giúp bạn dễ dàng áp dụng thiết kế HTML/CSS của mình vào WordPress. Tất cả các hàm lấy dữ liệu từ WordPress đã được chuẩn bị sẵn, bạn chỉ cần tập trung vào việc làm giao diện.

### Những gì theme đã cung cấp:

✅ **Hàm lấy dữ liệu hoàn chỉnh** - Không cần viết thêm code PHP  
✅ **Template có sẵn** - Single, Page, Archive, Search...  
✅ **Responsive** - Tương thích mọi thiết bị  
✅ **Menu & Sidebar** - Đã tích hợp sẵn  
✅ **Comments** - Hệ thống bình luận đầy đủ  
✅ **SEO Friendly** - Tối ưu cho SEO

---

## 📦 Cài Đặt

### Bước 1: Upload Theme

**Cách 1 - Qua Admin Panel:**

1. Nén thư mục `WP_Theme` thành file `.zip`
2. Đăng nhập WordPress Admin
3. Vào **Giao diện → Themes**
4. Click **Thêm mới → Tải lên Theme**
5. Chọn file zip → **Cài đặt**
6. Click **Kích hoạt**

**Cách 2 - Qua FTP:**

1. Upload thư mục vào `/wp-content/themes/`
2. Đăng nhập WordPress Admin
3. Vào **Giao diện → Themes**
4. Kích hoạt theme "My Custom Blog Theme"

### Bước 2: Thiết Lập Menu

1. Vào **Giao diện → Menu**
2. Tạo menu mới (VD: "Menu Chính")
3. Thêm các trang/bài viết vào menu
4. Chọn vị trí: **Primary Menu** (menu header)
5. Lưu menu

### Bước 3: Thiết Lập Widgets

1. Vào **Giao diện → Widgets**
2. Kéo thả widgets vào các khu vực:
    - **Main Sidebar** - Sidebar chính
    - **Footer Widget Area 1, 2, 3** - 3 cột footer

### Bước 4: Thiết Lập Logo (Tùy chọn)

1. Vào **Giao diện → Tùy chỉnh → Site Identity**
2. Upload logo của bạn
3. Publish

---

## 🔧 Hàm Map Dữ Liệu

Đây là phần quan trọng nhất - các hàm giúp bạn lấy dữ liệu từ WordPress.

### 1. 📝 Thông Tin Bài Viết (Post Meta)

**Hiển thị: Tác giả, Ngày đăng, Số comments, Categories**

```php
<!-- Hiển thị post meta -->
<?php my_custom_blog_post_meta(); ?>
```

**Hoặc lấy HTML để xử lý:**

```php
<?php
$meta_html = my_custom_blog_get_post_meta();
echo $meta_html;
?>
```

**Kết quả hiển thị:**

-   Tác giả: Link đến trang tác giả
-   Ngày đăng: Format theo cài đặt WP
-   Số comments: Link đến phần comments
-   Categories: Danh sách categories

---

### 2. 🖼️ Ảnh Đại Diện (Featured Image)

**Hiển thị ảnh đại diện của bài viết:**

```php
<!-- Hiển thị ảnh kích thước lớn, có link -->
<?php my_custom_blog_post_thumbnail('my-custom-blog-featured', true); ?>

<!-- Hiển thị ảnh thumbnail, không link -->
<?php my_custom_blog_post_thumbnail('my-custom-blog-thumbnail', false); ?>
```

**Các kích thước có sẵn:**

-   `my-custom-blog-featured` - 1200x630px (cho bài viết chính)
-   `my-custom-blog-medium` - 800x600px (cho bài viết trung bình)
-   `my-custom-blog-thumbnail` - 400x300px (cho thumbnail)

**Ví dụ trong HTML:**

```php
<div class="post-image">
    <?php my_custom_blog_post_thumbnail('my-custom-blog-featured', true); ?>
</div>
```

---

### 3. 📄 Trích Đoạn (Excerpt)

**Hiển thị đoạn trích ngắn của bài viết:**

```php
<!-- Hiển thị 30 từ đầu -->
<?php my_custom_blog_excerpt(30); ?>

<!-- Hiển thị 55 từ đầu (mặc định) -->
<?php my_custom_blog_excerpt(); ?>
```

**Lấy text để xử lý:**

```php
<?php
$excerpt = my_custom_blog_get_excerpt(50);
echo '<p class="summary">' . esc_html($excerpt) . '</p>';
?>
```

---

### 4. 🏷️ Tags và Categories

**Hiển thị tags:**

```php
<?php my_custom_blog_post_tags(); ?>
```

**Hiển thị categories:**

```php
<?php my_custom_blog_post_categories(); ?>
```

**Ví dụ trong HTML:**

```php
<div class="post-footer">
    <div class="categories">
        <?php my_custom_blog_post_categories(); ?>
    </div>
    <div class="tags">
        <?php my_custom_blog_post_tags(); ?>
    </div>
</div>
```

---

### 5. 📑 Phân Trang (Pagination)

**Hiển thị phân trang (dùng ở danh sách bài viết):**

```php
<?php my_custom_blog_pagination(); ?>
```

**Ví dụ:**

```php
<div class="posts-list">
    <?php while (have_posts()) : the_post(); ?>
        <!-- Hiển thị bài viết -->
    <?php endwhile; ?>
</div>

<!-- Phân trang -->
<?php my_custom_blog_pagination(); ?>
```

---

### 6. ⬅️➡️ Bài Viết Trước/Sau (Post Navigation)

**Hiển thị link bài viết trước/sau (dùng trong single post):**

```php
<?php my_custom_blog_post_navigation(); ?>
```

**Kết quả:**

-   Link đến bài viết trước (Previous Post)
-   Link đến bài viết sau (Next Post)

---

### 7. 🍞 Breadcrumbs (Đường Dẫn)

**Hiển thị breadcrumb navigation:**

```php
<?php my_custom_blog_breadcrumbs(); ?>
```

**Ví dụ kết quả:** Home / Category / Post Title

---

### 8. 🔗 Bài Viết Liên Quan (Related Posts)

**Lấy danh sách bài viết liên quan:**

```php
<?php
$related_posts = my_custom_blog_get_related_posts(get_the_ID(), 3);

if ($related_posts) {
    foreach ($related_posts as $post) {
        setup_postdata($post);
        // Hiển thị bài viết
        the_title();
        the_excerpt();
    }
    wp_reset_postdata();
}
?>
```

**Hoặc dùng template có sẵn:**

```php
<?php get_template_part('template-parts/related', 'posts'); ?>
```

---

### 9. 👤 Thông Tin Tác Giả (Author Info)

**Lấy thông tin tác giả:**

```php
<?php
$author = my_custom_blog_get_author_info();

echo $author['name'];        // Tên tác giả
echo $author['description']; // Bio
echo $author['avatar'];      // Avatar HTML
echo $author['url'];         // Link trang tác giả
echo $author['posts_count']; // Số bài viết
?>
```

**Hoặc dùng template có sẵn:**

```php
<?php get_template_part('template-parts/author', 'bio'); ?>
```

---

### 10. ⏱️ Thời Gian Đọc (Reading Time)

**Hiển thị ước tính thời gian đọc:**

```php
<?php my_custom_blog_reading_time(); ?>
```

**Kết quả:** "5 minutes read"

---

### 11. 🧭 Menu

**Hiển thị menu:**

```php
<!-- Menu chính -->
<?php
wp_nav_menu(array(
    'theme_location' => 'primary',
    'container'      => 'nav',
    'menu_class'     => 'main-menu',
));
?>

<!-- Menu footer -->
<?php
wp_nav_menu(array(
    'theme_location' => 'footer',
    'container'      => 'nav',
    'menu_class'     => 'footer-menu',
));
?>
```

---

### 12. 🔍 Search Form

**Hiển thị form tìm kiếm:**

```php
<?php get_search_form(); ?>
```

---

## 📁 Cấu Trúc File Quan Trọng

```
WP_Theme/
│
├── style.css              ← CSS chính (BẮT BUỘC)
├── functions.php          ← Chứa tất cả các hàm (BẮT BUỘC)
├── index.php              ← Template trang chủ blog (BẮT BUỘC)
│
├── header.php             ← Header (menu, logo)
├── footer.php             ← Footer
├── sidebar.php            ← Sidebar
│
├── single.php             ← Template single post
├── page.php               ← Template page
├── archive.php            ← Template archive (category, tag...)
├── search.php             ← Template search
├── 404.php                ← Template lỗi 404
│
├── template-parts/        ← Các phần tử nhỏ
│   ├── content.php        ← Hiển thị post trong danh sách
│   ├── content-single.php ← Hiển thị single post
│   ├── content-page.php   ← Hiển thị page
│   ├── author-bio.php     ← Box thông tin tác giả
│   └── related-posts.php  ← Bài viết liên quan
│
├── css/
│   └── custom.css         ← Thêm CSS tùy chỉnh ở đây
│
└── js/
    └── scripts.js         ← JavaScript
```

---

## 💡 Ví Dụ Thực Tế

### Ví dụ 1: Tạo danh sách bài viết với thiết kế riêng

Mở file `template-parts/content.php` và chỉnh sửa:

```php
<article id="post-<?php the_ID(); ?>" <?php post_class('my-post-card'); ?>>

    <!-- Ảnh đại diện -->
    <div class="post-image">
        <?php my_custom_blog_post_thumbnail('my-custom-blog-featured', true); ?>
    </div>

    <!-- Nội dung -->
    <div class="post-content">

        <!-- Tiêu đề -->
        <h2 class="post-title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>

        <!-- Meta (tác giả, ngày...) -->
        <div class="post-meta">
            <?php my_custom_blog_post_meta(); ?>
        </div>

        <!-- Trích đoạn -->
        <div class="post-excerpt">
            <?php my_custom_blog_excerpt(40); ?>
        </div>

        <!-- Nút đọc thêm -->
        <a href="<?php the_permalink(); ?>" class="read-more-btn">
            Đọc tiếp →
        </a>

    </div>

    <!-- Footer với categories & tags -->
    <div class="post-footer">
        <?php my_custom_blog_post_categories(); ?>
        <?php my_custom_blog_post_tags(); ?>
    </div>

</article>
```

### Ví dụ 2: Tùy chỉnh single post

Mở file `single.php`:

```php
<?php get_header(); ?>

<main class="site-main">
    <div class="container">

        <?php while (have_posts()) : the_post(); ?>

            <!-- Breadcrumbs -->
            <?php my_custom_blog_breadcrumbs(); ?>

            <article class="single-post">

                <!-- Tiêu đề -->
                <h1 class="post-title"><?php the_title(); ?></h1>

                <!-- Meta & Reading time -->
                <div class="post-info">
                    <?php my_custom_blog_post_meta(); ?>
                    <?php my_custom_blog_reading_time(); ?>
                </div>

                <!-- Ảnh đại diện -->
                <?php my_custom_blog_post_thumbnail('my-custom-blog-featured', false); ?>

                <!-- Nội dung bài viết -->
                <div class="post-content">
                    <?php the_content(); ?>
                </div>

                <!-- Categories & Tags -->
                <div class="post-taxonomy">
                    <?php my_custom_blog_post_categories(); ?>
                    <?php my_custom_blog_post_tags(); ?>
                </div>

            </article>

            <!-- Bài viết trước/sau -->
            <?php my_custom_blog_post_navigation(); ?>

            <!-- Thông tin tác giả -->
            <?php get_template_part('template-parts/author', 'bio'); ?>

            <!-- Bài viết liên quan -->
            <?php get_template_part('template-parts/related', 'posts'); ?>

            <!-- Comments -->
            <?php comments_template(); ?>

        <?php endwhile; ?>

    </div>
</main>

<?php get_footer(); ?>
```

### Ví dụ 3: Tạo trang chủ tùy chỉnh

Tạo file `front-page.php`:

```php
<?php get_header(); ?>

<main class="homepage">

    <!-- Hero Section -->
    <section class="hero">
        <h1>Chào mừng đến Blog của tôi</h1>
        <p>Chia sẻ kiến thức hàng ngày</p>
    </section>

    <!-- Bài viết mới nhất -->
    <section class="latest-posts">
        <div class="container">
            <h2>Bài Viết Mới Nhất</h2>

            <div class="posts-grid">
                <?php
                $args = array(
                    'posts_per_page' => 6,
                    'post_status'    => 'publish',
                );

                $latest_posts = new WP_Query($args);

                if ($latest_posts->have_posts()) :
                    while ($latest_posts->have_posts()) : $latest_posts->the_post();
                ?>

                    <div class="post-card">
                        <?php my_custom_blog_post_thumbnail('my-custom-blog-medium', true); ?>

                        <h3>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>

                        <?php my_custom_blog_excerpt(20); ?>

                        <a href="<?php the_permalink(); ?>" class="read-more">
                            Đọc thêm
                        </a>
                    </div>

                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
```

---

## 🎨 Tùy Chỉnh CSS

### Cách 1: Thêm vào file custom.css

Mở file `css/custom.css` và thêm CSS của bạn:

```css
/* Tùy chỉnh post card */
.my-post-card {
	background: #fff;
	border-radius: 10px;
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
	overflow: hidden;
	transition: transform 0.3s;
}

.my-post-card:hover {
	transform: translateY(-5px);
}

/* Tùy chỉnh post title */
.post-title a {
	color: #333;
	font-size: 1.5rem;
	font-weight: 700;
}

.post-title a:hover {
	color: #0073aa;
}
```

### Cách 2: Thêm qua WordPress Customizer

1. Vào **Giao diện → Tùy chỉnh**
2. Chọn **Additional CSS**
3. Thêm CSS và Preview realtime
4. Click **Publish**

---

## 📱 Responsive Design

Theme đã responsive sẵn, nhưng nếu cần tùy chỉnh thêm:

```css
/* Mobile */
@media (max-width: 767px) {
	.post-title {
		font-size: 1.2rem;
	}
}

/* Tablet */
@media (min-width: 768px) and (max-width: 1024px) {
	.container {
		padding: 0 20px;
	}
}

/* Desktop */
@media (min-width: 1025px) {
	.container {
		max-width: 1200px;
	}
}
```

---

## 🔐 WordPress Template Tags Cơ Bản

Những hàm WordPress cơ bản bạn cần biết:

### Thông tin bài viết:

```php
the_ID()           // ID bài viết
the_title()        // Tiêu đề
the_content()      // Nội dung đầy đủ
the_excerpt()      // Trích đoạn
the_permalink()    // Link bài viết
the_author()       // Tác giả
the_date()         // Ngày đăng
the_category()     // Categories
the_tags()         // Tags
```

### Kiểm tra điều kiện:

```php
is_home()          // Trang chủ blog
is_front_page()    // Trang chủ site
is_single()        // Single post
is_page()          // Single page
is_category()      // Trang category
is_search()        // Trang tìm kiếm
is_404()           // Trang lỗi 404
```

### Lấy thông tin (không echo):

```php
get_the_ID()
get_the_title()
get_the_permalink()
get_the_author()
```

---

## ❓ Câu Hỏi Thường Gặp

### Q: Làm sao để thêm CSS riêng mà không sửa file gốc?

**A:** Thêm vào file `css/custom.css` hoặc dùng **Giao diện → Tùy chỉnh → Additional CSS**.

---

### Q: Làm sao thay đổi số bài viết hiển thị trên 1 trang?

**A:** Vào **Cài đặt → Đọc → Số trang blog hiển thị nhiều nhất** → Nhập số → Lưu.

---

### Q: Làm sao tắt sidebar ở một trang?

**A:** Khi chỉnh sửa trang, ở phần **Page Attributes** → chọn Template: **Full Width (No Sidebar)**.

---

### Q: Làm sao thay đổi font chữ?

**A:** Thêm vào `functions.php`:

```php
function my_custom_fonts() {
    wp_enqueue_style('google-fonts',
        'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap'
    );
}
add_action('wp_enqueue_scripts', 'my_custom_fonts');
```

Sau đó thêm vào `css/custom.css`:

```css
body {
	font-family: "Roboto", sans-serif;
}
```

---

### Q: Làm sao thêm logo?

**A:** Vào **Giao diện → Tùy chỉnh → Site Identity → Logo** → Upload logo → Publish.

---

### Q: Làm sao thay đổi màu chủ đạo?

**A:** Thêm vào `css/custom.css`:

```css
/* Thay đổi màu chủ đạo từ xanh sang đỏ */
a,
.read-more,
.post-title a:hover {
	color: #e74c3c; /* Màu đỏ */
}

.read-more {
	background: #e74c3c;
}
```

---

### Q: Làm sao tạo menu đa cấp?

**A:**

1. Vào **Giao diện → Menu**
2. Kéo item menu vào bên phải để tạo submenu
3. Lưu menu

---

## 🚀 Tips & Tricks

### 1. Tạo shortcode riêng

Thêm vào `functions.php`:

```php
function my_shortcode() {
    return '<div class="custom-box">Nội dung của bạn</div>';
}
add_shortcode('mybox', 'my_shortcode');
```

Sử dụng: `[mybox]` trong bài viết/trang.

---

### 2. Thêm widget area mới

Thêm vào `functions.php`:

```php
function my_custom_widget_area() {
    register_sidebar(array(
        'name'          => 'My Custom Area',
        'id'            => 'custom-area',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
    ));
}
add_action('widgets_init', 'my_custom_widget_area');
```

Hiển thị: `<?php dynamic_sidebar('custom-area'); ?>`

---

### 3. Giới hạn excerpt

Thêm vào `functions.php`:

```php
function my_custom_excerpt_length($length) {
    return 20; // 20 từ
}
add_filter('excerpt_length', 'my_custom_excerpt_length', 999);
```

---

## 📞 Hỗ Trợ

Nếu cần hỗ trợ:

-   Email: your-email@example.com
-   Trang web: https://example.com

---

**Chúc bạn thành công! 🎉**

_Theme được phát triển với ❤️ để giúp việc thiết kế WordPress trở nên dễ dàng hơn._


