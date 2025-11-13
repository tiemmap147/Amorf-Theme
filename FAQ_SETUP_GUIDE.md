# Hướng dẫn cài đặt trang FAQ

## Các file đã được tạo

1. **Template Page**: `/page-templates/faq.php` - Template trang FAQ
2. **CSS**: `/css/faq.css` - Styles cho trang FAQ
3. **JavaScript**: `/js/faq.js` - Accordion functionality
4. **Functions**: Đã cập nhật `functions.php` để enqueue CSS và JS

## Cách sử dụng

### Bước 1: Vào WordPress Admin

Đăng nhập vào WordPress admin của bạn tại `http://localhost/amorf-test/wp-admin`

### Bước 2: Tạo hoặc chỉnh sửa trang FAQ

1. Vào **Pages** → **All Pages**
2. Tìm trang FAQ (hoặc tạo mới nếu chưa có)
3. Click để chỉnh sửa

### Bước 3: Chọn Template

1. Ở sidebar bên phải, tìm box **Page Attributes**
2. Trong dropdown **Template**, chọn **FAQ Page**
3. Click **Update** hoặc **Publish**

### Bước 4: Xem trang

Truy cập `http://localhost/amorf-test/index.php/faq/` để xem trang FAQ với design mới

## Tính năng

-   ✅ Design theo đúng mockup với màu xanh navy (#1e3a8a)
-   ✅ Accordion với 6 câu hỏi mặc định
-   ✅ Hiệu ứng smooth expand/collapse
-   ✅ Icon + và - tự động chuyển đổi
-   ✅ Câu hỏi đầu tiên mở sẵn
-   ✅ Responsive design cho mobile
-   ✅ Keyboard accessible (Enter/Space để toggle)
-   ✅ ARIA attributes cho accessibility

## Tùy chỉnh nội dung

### Thay đổi câu hỏi và câu trả lời

Chỉnh sửa file `/page-templates/faq.php`:

```php
// Tìm các phần như này:
<span class="faq-question-text"><?php esc_html_e('Câu hỏi của bạn?', 'amorfs-blog'); ?></span>

// Và phần trả lời:
<div class="faq-answer-content">
    <?php esc_html_e('Câu trả lời của bạn', 'amorfs-blog'); ?>
</div>
```

### Thêm câu hỏi mới

Copy một block `.faq-item` và paste vào trước closing tag `</div><!-- .faq-accordion -->`:

```php
<!-- New Question -->
<div class="faq-item">
    <button class="faq-question" aria-expanded="false">
        <span class="faq-icon">
            <svg class="icon-minus" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <svg class="icon-plus" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        <span class="faq-question-text"><?php esc_html_e('Câu hỏi mới?', 'amorfs-blog'); ?></span>
    </button>
    <div class="faq-answer">
        <div class="faq-answer-content">
            <?php esc_html_e('Câu trả lời cho câu hỏi mới.', 'amorfs-blog'); ?>
        </div>
    </div>
</div>
```

## Tùy chỉnh màu sắc

Chỉnh sửa file `/css/faq.css`:

```css
/* Màu tiêu đề chính */
.faq-title {
	color: #1e3a8a; /* Thay đổi màu này */
}

/* Màu subtitle */
.faq-subtitle {
	color: #6b7280; /* Thay đổi màu này */
}

/* Màu câu hỏi */
.faq-question-text {
	color: #111827; /* Thay đổi màu này */
}

/* Màu câu trả lời */
.faq-answer-content {
	color: #4b5563; /* Thay đổi màu này */
}
```

## Troubleshooting

### Trang không hiển thị đúng template

1. Đảm bảo bạn đã chọn đúng template "FAQ Page" trong Page Attributes
2. Thử refresh cache của WordPress
3. Kiểm tra file `/page-templates/faq.php` có tồn tại không

### CSS không load

1. Vào WordPress admin → Appearance → Editor
2. Kiểm tra file `css/faq.css` có tồn tại
3. Hard refresh browser (Ctrl+Shift+R hoặc Cmd+Shift+R)
4. Clear cache của WordPress nếu dùng caching plugin

### Accordion không hoạt động

1. Kiểm tra file `js/faq.js` có tồn tại
2. Mở browser console (F12) xem có lỗi JavaScript không
3. Đảm bảo JavaScript không bị conflict với plugin khác

## Hỗ trợ

Nếu gặp vấn đề, kiểm tra:

-   WordPress version >= 5.0
-   Theme đã được activate
-   Không có lỗi trong browser console (F12)


