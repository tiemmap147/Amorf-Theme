# Hướng Dẫn Sử Dụng Tính Năng Đa Ngôn Ngữ

# Multi-Language System Guide

## Tổng Quan | Overview

Theme hiện hỗ trợ **2 ngôn ngữ**: Tiếng Việt và English
Hệ thống đa ngôn ngữ này **KHÔNG CẦN PLUGIN**, được code trực tiếp vào theme.

**Lưu ý quan trọng**: Hệ thống này chỉ dịch các text giao diện UI (menu, nút bấm, tiêu đề...), KHÔNG dịch nội dung bài viết.

---

## Cách Sử Dụng | How to Use

### 1. Chuyển Đổi Ngôn Ngữ

-   Click vào biểu tượng **quả địa cầu** (🌐) ở header, bên trái các button "Data Studio" và "Install Extension"
-   Chọn ngôn ngữ mong muốn từ dropdown menu
-   Website sẽ tự động reload với ngôn ngữ đã chọn
-   Ngôn ngữ được lưu trong **cookie** và **session**, nên sẽ giữ nguyên khi bạn duyệt các trang khác

### 2. Ngôn Ngữ Mặc Định

Nếu người dùng chưa chọn ngôn ngữ, hệ thống sẽ:

1. Kiểm tra cookie đã lưu (nếu đã chọn trước đó)
2. Phát hiện ngôn ngữ trình duyệt
3. Mặc định là **Tiếng Anh** nếu không phát hiện được

---

## Cấu Trúc Files | File Structure

```
/wp-content/themes/amorfs-blog/
├── functions.php              (Hệ thống đa ngôn ngữ)
├── header.php                 (Language switcher UI)
├── style.css                  (Styling cho language switcher)
└── languages/
    ├── translations-en.php    (Bản dịch Tiếng Anh)
    └── translations-vi.php    (Bản dịch Tiếng Việt)
```

---

## Sử Dụng Trong Code | Using in Code

### Các Hàm Dịch | Translation Functions

#### 1. `amorfs_t($key)` - Trả về text đã dịch

```php
<?php
$translated_text = amorfs_t('read_more');
echo $translated_text; // "Read More" hoặc "Đọc thêm"
?>
```

#### 2. `amorfs_e($key)` - Echo text đã dịch với HTML escape

```php
<?php amorfs_e('search'); ?>
<!-- Output: "Search" hoặc "Tìm kiếm" -->
```

#### 3. `amorfs_translate($key)` - Hàm dịch đầy đủ

```php
<?php
$text = amorfs_translate('categories');
?>
```

#### 4. `amorfs_get_current_lang()` - Lấy mã ngôn ngữ hiện tại

```php
<?php
$current_lang = amorfs_get_current_lang(); // 'en' hoặc 'vi'
?>
```

### Ví Dụ Sử Dụng | Usage Examples

#### Trong Template Files:

```php
<h2><?php amorfs_e('related_posts'); ?></h2>

<button class="read-more">
    <?php echo esc_html(amorfs_t('read_more')); ?>
</button>

<span class="meta">
    <?php amorfs_e('posted_on'); ?>
    <?php echo get_the_date(); ?>
</span>
```

#### Trong JavaScript:

```javascript
// JavaScript sẽ tự động reload trang khi chuyển ngôn ngữ
// Không cần thêm code JavaScript nào khác
```

---

## Thêm Từ Dịch Mới | Adding New Translations

### Bước 1: Mở file translations

-   **Tiếng Anh**: `/languages/translations-en.php`
-   **Tiếng Việt**: `/languages/translations-vi.php`

### Bước 2: Thêm key mới vào array

```php
// translations-en.php
return array(
    // ... existing translations ...
    'your_new_key' => 'Your English Text',
);

// translations-vi.php
return array(
    // ... existing translations ...
    'your_new_key' => 'Văn bản tiếng Việt của bạn',
);
```

### Bước 3: Sử dụng trong code

```php
<?php amorfs_e('your_new_key'); ?>
```

---

## Danh Sách Từ Khóa Có Sẵn | Available Translation Keys

### Navigation & Menu

-   `menu`, `close_menu`, `skip_to_content`
-   `data_studio`, `install_extension`

### Search

-   `search`, `search_for`, `search_results_for`
-   `search_button`, `no_results_found`

### Posts

-   `posted_on`, `by`, `in`, `tagged`
-   `categories`, `tags`, `read_more`, `continue_reading`
-   `related_posts`, `published`, `updated`

### Author

-   `about_author`, `written_by`, `author`
-   `view_all_posts`, `posts_by`

### Comments

-   `comments`, `comment`, `leave_comment`, `leave_reply`
-   `reply`, `post_comment`, `comments_closed`

### Pagination

-   `previous`, `next`, `page`, `of`
-   `newer_posts`, `older_posts`

### General

-   `loading`, `load_more`, `show_more`, `show_less`
-   `submit`, `cancel`, `close`, `save`

### FAQ

-   `faq_title`, `faq_subtitle`, `search_faq`
-   `no_faq_found`, `all_categories`

**Xem đầy đủ**: Mở file `/languages/translations-en.php` hoặc `/languages/translations-vi.php`

---

## Customization

### Thay Đổi Vị Trí Language Switcher

Mở file `header.php`, tìm dòng:

```php
echo amorfs_language_switcher();
```

Di chuyển dòng này đến vị trí bạn muốn trong header.

### Thay Đổi Style

Mở file `style.css`, tìm section:

```css
/* LANGUAGE SWITCHER */
```

Chỉnh sửa CSS theo ý muốn.

### Thêm Ngôn Ngữ Mới (Ví dụ: Tiếng Nhật)

**Bước 1**: Tạo file `/languages/translations-ja.php`

```php
<?php
return array(
    'search' => '検索',
    'read_more' => '続きを読む',
    // ... add all translations
);
```

**Bước 2**: Cập nhật hàm `amorfs_language_switcher()` trong `functions.php`

```php
$languages = array(
    'en' => 'English',
    'vi' => 'Tiếng Việt',
    'ja' => '日本語',  // Add this
);
```

**Bước 3**: Cập nhật validation trong `amorfs_init_language()`

```php
if (isset($_GET['lang']) && in_array($_GET['lang'], array('en', 'vi', 'ja'))) {
```

---

## Troubleshooting | Xử Lý Lỗi

### Lỗi: Ngôn ngữ không thay đổi

**Giải pháp**:

1. Clear browser cache (Ctrl + Shift + R)
2. Clear WordPress cache qua **Tools → Clear Cache**
3. Kiểm tra session có hoạt động không (hosting phải hỗ trợ PHP sessions)

### Lỗi: Text không được dịch

**Giải pháp**:

1. Kiểm tra key có tồn tại trong file translations không
2. Đảm bảo file translations có `return array(...)` đúng cú pháp
3. Kiểm tra quyền đọc file (chmod 644)

### Lỗi: Dropdown không hiển thị

**Giải pháp**:

1. Clear cache
2. Kiểm tra JavaScript console có lỗi không
3. Đảm bảo `wp_enqueue_scripts` hook hoạt động

---

## Technical Details

### Session Management

-   Sử dụng PHP Sessions để lưu ngôn ngữ hiện tại
-   Cookie lưu 1 năm để persist across sessions
-   Auto-detect browser language lần đầu tiên

### Performance

-   Translation files được cache bằng static variable
-   Chỉ load 1 lần per page load
-   Minimal overhead (~0.001s)

### Security

-   Tất cả user input được sanitize
-   XSS protection với `esc_html()`, `esc_attr()`, `esc_url()`
-   CSRF protection với nonce (built-in WordPress)

---

## FAQ

**Q: Có cần plugin WPML hay Polylang không?**
A: Không! Hệ thống này hoạt động độc lập, không cần plugin.

**Q: Nội dung bài viết có được dịch không?**
A: Không. Hệ thống này chỉ dịch UI text (menu, button, label...). Nếu muốn dịch nội dung bài viết, bạn cần dùng plugin như WPML.

**Q: Có thể thêm nhiều ngôn ngữ hơn không?**
A: Có! Follow phần "Thêm Ngôn Ngữ Mới" ở trên.

**Q: SEO có bị ảnh hưởng không?**
A: Không. Vì không dịch content, SEO không thay đổi. URL vẫn giữ nguyên.

**Q: Có tương thích với cache plugins không?**
A: Có! Works với WP Rocket, W3 Total Cache, LiteSpeed Cache...

---

## Support

Nếu gặp vấn đề, kiểm tra:

1. PHP version >= 7.4
2. WordPress version >= 5.8
3. Session support enabled
4. File permissions correct (644 for PHP files)

---

**Version**: 1.0
**Last Updated**: November 2025
**Author**: Amorf's Blog Team

