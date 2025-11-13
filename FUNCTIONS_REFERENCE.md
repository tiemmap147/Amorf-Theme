# 📖 FUNCTIONS REFERENCE - TÀI LIỆU THAM KHẢO HÀM

Danh sách đầy đủ tất cả các hàm helper có trong theme.

---

## 🎯 POST META & INFO

### `my_custom_blog_get_post_meta()`

**Mô tả**: Lấy post meta HTML (author, date, comments, categories)  
**Return**: `string` HTML markup  
**Ví dụ**:

```php
$meta = my_custom_blog_get_post_meta();
echo $meta;
```

### `my_custom_blog_post_meta()`

**Mô tả**: Hiển thị post meta  
**Return**: `void` (echo ra HTML)  
**Ví dụ**:

```php
<?php my_custom_blog_post_meta(); ?>
```

**Output**:

-   👤 Author name (link to author page)
-   📅 Post date
-   💬 Comments count
-   📁 Categories

---

## 🖼️ POST THUMBNAIL

### `my_custom_blog_get_post_thumbnail($size, $link)`

**Mô tả**: Lấy post thumbnail HTML  
**Parameters**:

-   `$size` (string) - Image size name (default: 'my-custom-blog-featured')
-   `$link` (bool) - Có link đến post không? (default: true)

**Return**: `string` HTML markup  
**Ví dụ**:

```php
// Ảnh lớn có link
$thumb = my_custom_blog_get_post_thumbnail('my-custom-blog-featured', true);

// Thumbnail không link
$thumb = my_custom_blog_get_post_thumbnail('my-custom-blog-thumbnail', false);
```

### `my_custom_blog_post_thumbnail($size, $link)`

**Mô tả**: Hiển thị post thumbnail  
**Parameters**: Giống trên  
**Return**: `void`  
**Ví dụ**:

```php
<?php my_custom_blog_post_thumbnail('my-custom-blog-featured', true); ?>
```

**Image sizes có sẵn**:

-   `my-custom-blog-featured` - 1200x630px
-   `my-custom-blog-medium` - 800x600px
-   `my-custom-blog-thumbnail` - 400x300px

---

## 📝 EXCERPT

### `my_custom_blog_get_excerpt($length)`

**Mô tả**: Lấy excerpt với độ dài tùy chỉnh  
**Parameters**:

-   `$length` (int) - Số từ (default: 55)

**Return**: `string` Excerpt text  
**Ví dụ**:

```php
$excerpt = my_custom_blog_get_excerpt(30);
echo '<p>' . esc_html($excerpt) . '</p>';
```

### `my_custom_blog_excerpt($length)`

**Mô tả**: Hiển thị excerpt  
**Parameters**:

-   `$length` (int) - Số từ (default: 55)

**Return**: `void`  
**Ví dụ**:

```php
<?php my_custom_blog_excerpt(40); ?>
```

---

## 🏷️ TAGS

### `my_custom_blog_get_post_tags()`

**Mô tả**: Lấy post tags HTML  
**Return**: `string` HTML markup (empty string nếu không có tags)  
**Ví dụ**:

```php
$tags = my_custom_blog_get_post_tags();
if ($tags) {
    echo $tags;
}
```

### `my_custom_blog_post_tags()`

**Mô tả**: Hiển thị post tags  
**Return**: `void`  
**Ví dụ**:

```php
<?php my_custom_blog_post_tags(); ?>
```

**Output**: Danh sách tags dạng badges

---

## 📁 CATEGORIES

### `my_custom_blog_get_post_categories()`

**Mô tả**: Lấy post categories HTML  
**Return**: `string` HTML markup (empty string nếu không có)  
**Ví dụ**:

```php
$categories = my_custom_blog_get_post_categories();
echo $categories;
```

### `my_custom_blog_post_categories()`

**Mô tả**: Hiển thị post categories  
**Return**: `void`  
**Ví dụ**:

```php
<?php my_custom_blog_post_categories(); ?>
```

---

## 📑 PAGINATION

### `my_custom_blog_get_pagination()`

**Mô tả**: Lấy pagination HTML  
**Return**: `string` HTML markup (empty nếu chỉ có 1 trang)  
**Ví dụ**:

```php
$pagination = my_custom_blog_get_pagination();
echo $pagination;
```

### `my_custom_blog_pagination()`

**Mô tả**: Hiển thị pagination  
**Return**: `void`  
**Ví dụ**:

```php
<?php my_custom_blog_pagination(); ?>
```

**Features**:

-   Previous/Next buttons
-   Numbered pages
-   Current page highlighted
-   Responsive

---

## ⬅️➡️ POST NAVIGATION

### `my_custom_blog_get_post_navigation()`

**Mô tả**: Lấy post navigation (prev/next post)  
**Return**: `string` HTML markup  
**Ví dụ**:

```php
$nav = my_custom_blog_get_post_navigation();
echo $nav;
```

### `my_custom_blog_post_navigation()`

**Mô tả**: Hiển thị post navigation  
**Return**: `void`  
**Ví dụ**:

```php
<?php my_custom_blog_post_navigation(); ?>
```

**Output**:

-   Link to previous post (with title)
-   Link to next post (with title)

---

## 🍞 BREADCRUMBS

### `my_custom_blog_get_breadcrumbs()`

**Mô tả**: Lấy breadcrumbs HTML  
**Return**: `string` HTML markup (empty nếu là front page)  
**Ví dụ**:

```php
$breadcrumbs = my_custom_blog_get_breadcrumbs();
if ($breadcrumbs) {
    echo $breadcrumbs;
}
```

### `my_custom_blog_breadcrumbs()`

**Mô tả**: Hiển thị breadcrumbs  
**Return**: `void`  
**Ví dụ**:

```php
<?php my_custom_blog_breadcrumbs(); ?>
```

**Output format**: Home / Category / Current Page

---

## 🔗 RELATED POSTS

### `my_custom_blog_get_related_posts($post_id, $number)`

**Mô tả**: Lấy related posts  
**Parameters**:

-   `$post_id` (int) - Post ID (default: current post)
-   `$number` (int) - Số bài lấy (default: 3)

**Return**: `array` Array of post objects  
**Ví dụ**:

```php
$related = my_custom_blog_get_related_posts(get_the_ID(), 4);

foreach ($related as $post) {
    setup_postdata($post);
    echo '<h3>' . get_the_title() . '</h3>';
}
wp_reset_postdata();
```

**Logic**: Lấy bài cùng category

**Template có sẵn**:

```php
<?php get_template_part('template-parts/related', 'posts'); ?>
```

---

## 👤 AUTHOR INFO

### `my_custom_blog_get_author_info($author_id)`

**Mô tả**: Lấy thông tin tác giả  
**Parameters**:

-   `$author_id` (int) - Author ID (default: current author)

**Return**: `array` Author data  
**Array keys**:

-   `id` - Author ID
-   `name` - Display name
-   `description` - Bio
-   `url` - Author archive URL
-   `avatar` - Avatar HTML
-   `posts_count` - Số bài viết

**Ví dụ**:

```php
$author = my_custom_blog_get_author_info();

echo $author['name'];
echo $author['description'];
echo $author['avatar'];
echo $author['url'];
echo $author['posts_count'];
```

**Template có sẵn**:

```php
<?php get_template_part('template-parts/author', 'bio'); ?>
```

---

## ⏱️ READING TIME

### `my_custom_blog_get_reading_time($post_id)`

**Mô tả**: Lấy ước tính thời gian đọc  
**Parameters**:

-   `$post_id` (int) - Post ID (default: current post)

**Return**: `string` Reading time text  
**Ví dụ**:

```php
$time = my_custom_blog_get_reading_time();
echo '<span>' . esc_html($time) . '</span>';
```

### `my_custom_blog_reading_time($post_id)`

**Mô tả**: Hiển thị reading time  
**Return**: `void`  
**Ví dụ**:

```php
<?php my_custom_blog_reading_time(); ?>
```

**Output**: "5 minutes read" hoặc "1 minute read"

**Calculation**: 200 words per minute

---

## 🧭 MENU

### `my_custom_blog_get_menu($location)`

**Mô tả**: Lấy menu HTML  
**Parameters**:

-   `$location` (string) - Menu location ('primary' or 'footer')

**Return**: `string` Menu HTML (empty nếu không có menu)  
**Ví dụ**:

```php
$menu = my_custom_blog_get_menu('primary');
echo $menu;
```

**Menu locations**:

-   `primary` - Main menu (header)
-   `footer` - Footer menu

**Alternative** (more options):

```php
<?php
wp_nav_menu(array(
    'theme_location' => 'primary',
    'container'      => 'nav',
    'menu_class'     => 'main-menu',
));
?>
```

---

## 🎨 LOGO

### `my_custom_blog_get_logo()`

**Mô tả**: Lấy logo HTML hoặc site title  
**Return**: `string` Logo/title HTML  
**Ví dụ**:

```php
$logo = my_custom_blog_get_logo();
echo $logo;
```

**Output**:

-   Nếu có custom logo: Logo HTML
-   Nếu không: Site title trong H1 tag (homepage) hoặc P tag

---

## 📊 WORDPRESS QUERY

### Custom Query Example

```php
<?php
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 5,
    'category_name'  => 'news',
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();

        // Hiển thị post
        the_title();
        the_excerpt();

    endwhile;
    wp_reset_postdata();
endif;
?>
```

**Common Query Parameters**:

```php
array(
    'post_type'           => 'post',        // post, page, custom
    'posts_per_page'      => 10,            // Số bài
    'paged'               => 1,             // Trang hiện tại
    'category_name'       => 'slug',        // Category slug
    'tag'                 => 'slug',        // Tag slug
    'author'              => 1,             // Author ID
    'orderby'             => 'date',        // date, title, rand...
    'order'               => 'DESC',        // DESC, ASC
    'meta_key'            => 'key',         // Custom field key
    'meta_value'          => 'value',       // Custom field value
    'post__in'            => array(1,2,3),  // Specific post IDs
    'post__not_in'        => array(4,5),    // Exclude post IDs
    'tax_query'           => array(...),    // Taxonomy query
    'date_query'          => array(...),    // Date query
)
```

---

## 🏗️ WORDPRESS TEMPLATE TAGS

### Basic Output

```php
the_ID()                    // Post ID
the_title()                 // Post title
the_content()               // Full content
the_excerpt()               // Excerpt
the_permalink()             // Post URL
the_author()                // Author name
the_date()                  // Post date
the_time()                  // Post time
the_category()              // Categories list
the_tags()                  // Tags list
the_post_thumbnail()        // Featured image
```

### Get Functions (không echo)

```php
get_the_ID()
get_the_title()
get_the_content()
get_the_excerpt()
get_permalink()
get_the_author()
get_the_date()
get_the_category()
get_the_tags()
get_the_post_thumbnail()
```

### Conditional Tags

```php
is_home()                   // Blog homepage
is_front_page()             // Front page
is_single()                 // Single post
is_page()                   // Single page
is_category()               // Category archive
is_tag()                    // Tag archive
is_author()                 // Author archive
is_date()                   // Date archive
is_archive()                // Any archive
is_search()                 // Search results
is_404()                    // 404 page
is_singular()               // Single post/page/custom
has_post_thumbnail()        // Check if has featured image
comments_open()             // Check if comments open
```

### Post Meta

```php
get_post_meta($post_id, $key, $single)
add_post_meta($post_id, $key, $value)
update_post_meta($post_id, $key, $value)
delete_post_meta($post_id, $key)
```

### URL Functions

```php
home_url()                  // Homepage URL
site_url()                  // Site URL
admin_url()                 // Admin URL
get_template_directory_uri() // Theme URL
get_stylesheet_uri()        // style.css URL
```

---

## 🛡️ SECURITY FUNCTIONS

### Escape Output

```php
esc_html($text)             // Escape HTML
esc_attr($text)             // Escape attributes
esc_url($url)               // Escape URL
esc_js($text)               // Escape JavaScript
wp_kses_post($html)         // Allow safe HTML tags
```

### Sanitize Input

```php
sanitize_text_field($str)   // Sanitize text
sanitize_email($email)      // Sanitize email
sanitize_url($url)          // Sanitize URL
sanitize_title($title)      // Sanitize title
```

### Verification

```php
wp_verify_nonce($nonce, $action)
check_admin_referer($action)
current_user_can('capability')
```

---

## 🔧 UTILITY FUNCTIONS

### Translation

```php
__('Text', 'my-custom-blog')           // Translate
_e('Text', 'my-custom-blog')           // Translate & echo
esc_html__('Text', 'my-custom-blog')   // Translate & escape
esc_html_e('Text', 'my-custom-blog')   // Translate, escape & echo
_n('Singular', 'Plural', $count, 'my-custom-blog') // Plural
```

### Scripts & Styles

```php
wp_enqueue_style('handle', $src, $deps, $ver)
wp_enqueue_script('handle', $src, $deps, $ver, $in_footer)
wp_localize_script('handle', 'object', $data)
```

### Options

```php
get_option('option_name')
update_option('option_name', $value)
add_option('option_name', $value)
delete_option('option_name')
```

---

## 📚 HOOKS

### Actions (Do something)

```php
add_action('hook_name', 'function_name', $priority, $args)

// Common hooks:
add_action('wp_head', 'my_function');
add_action('wp_footer', 'my_function');
add_action('init', 'my_function');
add_action('wp_enqueue_scripts', 'my_function');
add_action('widgets_init', 'my_function');
```

### Filters (Modify data)

```php
add_filter('hook_name', 'function_name', $priority, $args)

// Common filters:
add_filter('the_title', 'my_function');
add_filter('the_content', 'my_function');
add_filter('excerpt_length', 'my_function');
add_filter('body_class', 'my_function');
```

---

## 💡 QUICK EXAMPLES

### Example 1: Custom Loop

```php
<?php
$args = array('posts_per_page' => 5);
$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
        ?>
        <article>
            <?php my_custom_blog_post_thumbnail(); ?>
            <h2><?php the_title(); ?></h2>
            <?php my_custom_blog_post_meta(); ?>
            <?php my_custom_blog_excerpt(30); ?>
        </article>
        <?php
    endwhile;
    wp_reset_postdata();
endif;
?>
```

### Example 2: Get Categories

```php
<?php
$categories = get_categories(array(
    'orderby' => 'count',
    'order'   => 'DESC',
    'number'  => 5,
));

foreach ($categories as $cat) {
    echo '<a href="' . get_category_link($cat->term_id) . '">';
    echo $cat->name . ' (' . $cat->count . ')';
    echo '</a>';
}
?>
```

### Example 3: Custom Meta

```php
<?php
// Get custom field
$custom_value = get_post_meta(get_the_ID(), 'custom_field_key', true);

if ($custom_value) {
    echo '<div class="custom">' . esc_html($custom_value) . '</div>';
}
?>
```

---

## 📞 Support

Tham khảo thêm:

-   [WordPress Developer Resources](https://developer.wordpress.org/)
-   [WordPress Codex](https://codex.wordpress.org/)
-   Theme docs: `README.md`, `HUONG_DAN_TIENG_VIET.md`

---

**Tài liệu này liệt kê tất cả functions có trong theme! 📖**


