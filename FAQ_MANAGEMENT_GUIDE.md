# 📚 Hướng Dẫn Quản Lý FAQ - WordPress Admin

## 🎯 Tổng Quan

Bạn hiện có hệ thống quản lý FAQ hoàn toàn động! Không cần chỉnh sửa code, bạn có thể thêm/sửa/xóa câu hỏi FAQ trực tiếp từ WordPress Admin.

## 🚀 Cách Sử Dụng

### Bước 1: Truy cập WordPress Admin

Đăng nhập vào: `http://localhost/amorf-test/wp-admin`

### Bước 2: Tìm menu "FAQs"

Sau khi đăng nhập, bạn sẽ thấy menu **"FAQs"** (icon dấu chấm hỏi) ở sidebar bên trái, dưới menu **Posts**.

---

## ➕ Thêm Câu Hỏi Mới

### 1. Click vào **FAQs** → **Add New**

### 2. Điền thông tin:

**a) Tiêu đề (Title)**

-   Nhập câu hỏi của bạn
-   VD: "Is there a free trial available?"

**b) Nội dung (Content)**

-   Bạn có thể để trống hoặc thêm mô tả nếu cần
-   Phần này không hiển thị trên trang FAQ

**c) FAQ Answer (Meta Box)**

-   Scroll xuống dưới, bạn sẽ thấy box **"FAQ Answer"**
-   Nhập câu trả lời vào đây
-   Hỗ trợ rich text editor (bold, italic, links, etc.)

**d) Order (Thứ tự hiển thị)**

-   Ở sidebar bên phải, tìm **"Page Attributes"** → **"Order"**
-   Nhập số thứ tự (0, 1, 2, 3...)
-   Số nhỏ hơn = hiển thị trước
-   VD:
    -   Order 0 → hiển thị đầu tiên
    -   Order 1 → hiển thị thứ hai
    -   Order 2 → hiển thị thứ ba

### 3. Click **Publish**

✅ Câu hỏi mới sẽ tự động xuất hiện trên trang FAQ!

---

## ✏️ Chỉnh Sửa Câu Hỏi

### 1. Vào **FAQs** → **All FAQs**

### 2. Click vào câu hỏi muốn sửa

### 3. Chỉnh sửa:

-   **Title**: Đổi câu hỏi
-   **FAQ Answer**: Đổi câu trả lời
-   **Order**: Đổi thứ tự hiển thị

### 4. Click **Update**

---

## 🗑️ Xóa Câu Hỏi

### 1. Vào **FAQs** → **All FAQs**

### 2. Hover vào câu hỏi muốn xóa

### 3. Click **Trash**

Hoặc:

### 1. Mở câu hỏi cần xóa

### 2. Click **Move to Trash** ở sidebar bên phải

---

## 📊 Quản Lý Danh Sách FAQ

Trong trang **All FAQs**, bạn sẽ thấy bảng với các cột:

| Cột                | Mô tả                             |
| ------------------ | --------------------------------- |
| **Question**       | Câu hỏi (Title)                   |
| **Answer Preview** | Preview 15 từ đầu của câu trả lời |
| **Order**          | Thứ tự hiển thị                   |
| **Date**           | Ngày tạo/cập nhật                 |

### Sắp xếp:

-   Click vào **"Order"** để sắp xếp theo thứ tự
-   Click vào **"Date"** để sắp xếp theo ngày

---

## 🎨 Tính Năng Đặc Biệt

### ✅ Tự động mở câu hỏi đầu tiên

-   Câu hỏi có Order nhỏ nhất sẽ tự động mở khi tải trang

### ✅ Fallback Content

-   Nếu chưa có FAQ nào, trang sẽ hiển thị 6 câu hỏi mẫu mặc định
-   Khi bạn thêm FAQ, nó sẽ tự động thay thế câu hỏi mẫu

### ✅ Rich Text Editor

-   Câu trả lời hỗ trợ:
    -   **Bold**, _Italic_, ~~Strikethrough~~
    -   Links
    -   Bullet lists
    -   Numbered lists
    -   HTML cơ bản

---

## 💡 Ví Dụ Thực Tế

### Thêm FAQ "Can I get a refund?"

1. **FAQs** → **Add New**

2. **Title**:

    ```
    Can I get a refund?
    ```

3. **FAQ Answer**:

    ```
    Yes! We offer a 30-day money-back guarantee.
    If you're not satisfied, contact our support team
    and we'll process your refund within 5-7 business days.
    ```

4. **Order**: `7` (hiển thị sau 6 câu hỏi hiện tại)

5. **Publish** ✅

---

## 🔧 Tùy Chỉnh Nâng Cao

### Thay đổi tiêu đề trang FAQ

**Cách 1: Trong template**
Chỉnh sửa file `/page-templates/faq.php`, dòng 15:

```php
<h1 class="faq-title"><?php esc_html_e('Your Custom Title', 'amorfs-blog'); ?></h1>
```

**Cách 2: Sử dụng filter (khuyến nghị)**
Thêm vào `functions.php`:

```php
add_filter('faq_page_title', function($title) {
    return 'Câu Hỏi Thường Gặp';
});
```

### Thay đổi subtitle

Chỉnh sửa file `/page-templates/faq.php`, dòng 16:

```php
<p class="faq-subtitle"><?php esc_html_e('Your custom subtitle', 'amorfs-blog'); ?></p>
```

---

## 🛠️ Troubleshooting

### ❓ Menu "FAQs" không xuất hiện?

**Giải pháp:**

1. Vào **Settings** → **Permalinks**
2. Click **Save Changes** (không cần đổi gì)
3. Refresh trang admin

### ❓ Câu hỏi không hiển thị đúng thứ tự?

**Giải pháp:**

1. Kiểm tra **Order** của mỗi FAQ
2. Đảm bảo mỗi FAQ có số Order khác nhau
3. Số nhỏ → hiển thị trước

### ❓ Câu trả lời bị mất format?

**Giải pháp:**

-   Dùng Visual Editor thay vì Text Editor
-   Tránh paste trực tiếp từ Word (dùng Paste as Plain Text)

### ❓ Trang FAQ hiển thị câu hỏi mẫu thay vì FAQ của tôi?

**Giải pháp:**

1. Kiểm tra FAQ có status là **"Published"** không
2. Vào **FAQs** → **All FAQs** → kiểm tra column **Status**
3. Nếu là "Draft", click **Quick Edit** → đổi thành **Published**

---

## 🎓 Best Practices

### 1. Đặt tên rõ ràng

✅ Good: "What payment methods do you accept?"
❌ Bad: "Payment?"

### 2. Câu trả lời ngắn gọn

-   Tối đa 2-3 câu
-   Trực tiếp, dễ hiểu
-   Thêm link nếu cần chi tiết hơn

### 3. Sắp xếp theo độ phổ biến

-   Câu hỏi được hỏi nhiều nhất → Order 0
-   Câu hỏi ít hỏi → Order cao hơn

### 4. Nhóm theo chủ đề

Ví dụ:

-   Order 0-10: Pricing & Billing
-   Order 11-20: Account Management
-   Order 21-30: Technical Support

---

## 📱 Plugin Khuyến Nghị (Tùy Chọn)

Nếu muốn thêm tính năng nâng cao, bạn có thể cài plugin:

### 1. **Advanced Custom Fields (ACF)** - Free

-   Thêm nhiều fields tùy chỉnh hơn
-   Video, images trong câu trả lời
-   Conditional logic

### 2. **Simple Custom Post Order** - Free

-   Drag & drop để sắp xếp FAQ
-   Dễ dàng hơn việc nhập số Order

### 3. **Duplicate Post** - Free

-   Clone FAQ để tạo câu hỏi tương tự nhanh chóng

---

## 🆘 Cần Hỗ Trợ?

### Kiểm tra:

1. ✅ WordPress version >= 5.0
2. ✅ Theme "Amorf's Blog" đã được activated
3. ✅ File `/page-templates/faq.php` tồn tại
4. ✅ File `/css/faq.css` tồn tại
5. ✅ File `/js/faq.js` tồn tại

### Log Errors:

Mở browser console (F12) → tab Console → kiểm tra lỗi JavaScript

---

## 🎉 Hoàn Thành!

Bây giờ bạn đã có hệ thống quản lý FAQ hoàn chỉnh:

-   ✅ Thêm/sửa/xóa FAQ dễ dàng từ Admin
-   ✅ Không cần chỉnh sửa code
-   ✅ Sắp xếp thứ tự linh hoạt
-   ✅ Rich text editor cho câu trả lời
-   ✅ Tự động responsive
-   ✅ SEO friendly

**Happy FAQ Managing! 🚀**



