# 🎨 Hướng Dẫn Sử Dụng WordPress Customizer

## 📋 Tổng Quan

Theme hiện có hệ thống Customizer cho phép bạn tùy chỉnh các phần tử mà không cần chỉnh sửa code.

---

## 🔘 Tùy Chỉnh Contact Button

### Truy Cập Customizer

1. Đăng nhập WordPress Admin
2. Vào **Appearance** → **Customize**
3. Tìm section **"Contact Button"**

### Các Tùy Chọn

#### 1️⃣ Button Text (Text Nút)

**Mô tả:** Thay đổi text hiển thị trên nút contact

**Mặc định:** "Contact Us"

**Cách dùng:**

-   Click vào field **"Button Text"**
-   Nhập text mới (VD: "Liên Hệ", "Get in Touch", "Talk to Us")
-   Click **Publish** để lưu

**Ví dụ:**

```
Contact Us     → Liên Hệ Ngay
Get Started    → Bắt Đầu
Schedule Call  → Đặt Lịch Gọi
```

#### 2️⃣ Button URL (Đường Dẫn)

**Mô tả:** Thay đổi link khi click vào nút

**Mặc định:** Tự động tìm trang "Contact" hoặc `/contact`

**Cách dùng:**

-   Click vào field **"Button URL"**
-   Nhập URL đầy đủ
-   Click **Publish** để lưu

**Các loại URL:**

**Internal Link (Trang trong website):**

```
http://localhost/amorf-test/contact/
http://localhost/amorf-test/get-started/
```

**External Link (Link ngoài):**

```
https://calendly.com/your-name
https://forms.google.com/your-form
mailto:contact@example.com
tel:+84123456789
```

**Để Trống:**

-   Hệ thống tự động tìm trang có slug "contact"
-   Nếu không tìm thấy → link đến `/contact`

#### 3️⃣ Show Contact Button (Hiển Thị Nút)

**Mô tả:** Bật/tắt hiển thị nút contact

**Mặc định:** ✅ Checked (Hiển thị)

**Cách dùng:**

-   ✅ **Checked** = Hiển thị nút
-   ⬜ **Unchecked** = Ẩn nút
-   Click **Publish** để lưu

---

## 🎯 Use Cases (Các Trường Hợp Sử Dụng)

### Case 1: Link đến Calendly

**Mục tiêu:** Cho phép khách đặt lịch hẹn trực tiếp

**Cài đặt:**

-   **Button Text:** "Schedule a Call"
-   **Button URL:** `https://calendly.com/your-username/30min`
-   **Show Button:** ✅

### Case 2: Link đến Email

**Mục tiêu:** Mở email client khi click

**Cài đặt:**

-   **Button Text:** "Email Us"
-   **Button URL:** `mailto:hello@yourdomain.com?subject=Inquiry`
-   **Show Button:** ✅

### Case 3: Link đến Phone

**Mục tiêu:** Gọi điện trực tiếp (mobile-friendly)

**Cài đặt:**

-   **Button Text:** "Call Now"
-   **Button URL:** `tel:+84123456789`
-   **Show Button:** ✅

### Case 4: Link đến Google Form

**Mục tiêu:** Thu thập thông tin qua form

**Cài đặt:**

-   **Button Text:** "Apply Now"
-   **Button URL:** `https://forms.google.com/your-form-id`
-   **Show Button:** ✅

### Case 5: Link đến WhatsApp

**Mục tiêu:** Chat trực tiếp qua WhatsApp

**Cài đặt:**

-   **Button Text:** "Chat on WhatsApp"
-   **Button URL:** `https://wa.me/84123456789`
-   **Show Button:** ✅

### Case 6: Ẩn Nút Hoàn Toàn

**Mục tiêu:** Tạm thời không hiển thị nút

**Cài đặt:**

-   **Show Button:** ⬜ (Unchecked)

---

## 📱 Live Preview

Customizer có tính năng **Live Preview**:

✅ Thay đổi text → Thấy ngay kết quả
✅ Thay đổi URL → Test link ngay
✅ Ẩn/hiện nút → Thấy ngay

**Lưu ý:** Phải click **Publish** mới lưu thay đổi vĩnh viễn!

---

## 🔧 Troubleshooting

### ❓ Không thấy section "Contact Button"?

**Giải pháp:**

1. Đảm bảo đã có Primary Menu (Appearance → Menus)
2. Refresh trang Customizer (F5)
3. Scroll xuống tìm section

### ❓ Thay đổi không hiển thị?

**Giải pháp:**

1. Đảm bảo đã click **Publish**
2. Clear cache browser (Ctrl+Shift+R hoặc Cmd+Shift+R)
3. Clear cache plugin (nếu có)

### ❓ Link không hoạt động?

**Giải pháp:**

1. Kiểm tra URL có đầy đủ `http://` hoặc `https://`
2. Test link trong tab mới trước
3. Với internal links, dùng full URL

### ❓ Muốn reset về mặc định?

**Giải pháp:**

1. **Button Text:** Xóa hết và để trống → sẽ hiển thị "Contact Us"
2. **Button URL:** Xóa hết và để trống → tự động tìm trang contact
3. **Show Button:** Check lại checkbox

---

## 💡 Best Practices

### 1. Button Text

✅ **Good:**

-   Ngắn gọn (2-3 từ)
-   Action-oriented (Call to Action)
-   Rõ ràng

❌ **Bad:**

-   Quá dài: "Click here to contact us for more information"
-   Mơ hồ: "Click", "Here"

### 2. Button URL

✅ **Good:**

-   Full URL với protocol: `https://example.com`
-   Test trước khi publish
-   Dùng shortlink nếu URL quá dài

❌ **Bad:**

-   Thiếu protocol: `example.com` (sai)
-   Broken links
-   URL quá dài không rút gọn

### 3. Consistency

-   Giữ style nhất quán với brand
-   Button text phù hợp với landing page
-   Tracking được clicks (dùng UTM nếu cần)

---

## 🎓 Advanced Tips

### Tracking Clicks với Google Analytics

Thêm UTM parameters vào URL:

```
https://yourdomain.com/contact/?utm_source=website&utm_medium=header&utm_campaign=contact_button
```

### Multiple Languages

Nếu dùng WPML hoặc Polylang:

**Tiếng Việt:**

-   Button Text: "Liên Hệ"
-   Button URL: `https://example.com/lien-he`

**English:**

-   Button Text: "Contact Us"
-   Button URL: `https://example.com/contact`

### A/B Testing

Test các biến thể:

**Variant A:**

-   Text: "Contact Us"
-   URL: `/contact`

**Variant B:**

-   Text: "Get Started"
-   URL: `/get-started`

Xem variant nào conversion cao hơn!

---

## 🚀 Tương Lai

Các tính năng có thể thêm vào:

-   [ ] Button color customization
-   [ ] Button size options
-   [ ] Icon before/after text
-   [ ] Open in new tab option
-   [ ] Multiple CTA buttons
-   [ ] Conditional display (show on specific pages)

---

## 📞 Support

Nếu cần thêm tính năng customization, có thể:

1. Chỉnh sửa `functions.php` để thêm settings
2. Dùng plugin như **Customizer Export/Import**
3. Contact developer để custom thêm

**Happy Customizing! 🎨**


