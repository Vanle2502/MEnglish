# Tài liệu bàn giao source M-English cho Animation Developer

## 1. Mục tiêu

Tài liệu này dành cho developer phụ trách bổ sung animation cho giao diện M-English. Phạm vi ưu tiên là animation khi cuộn trang, chuyển cảnh giữa các thành phần, micro-interaction và tinh chỉnh slider hiện có.

Không thay đổi nội dung, luồng gửi form, cấu hình đa ngôn ngữ hoặc tích hợp Google Sheets nếu công việc không yêu cầu trực tiếp.

## 2. Chạy dự án trên máy local

- Web root: `D:\xampp\htdocs\wordpress`
- Theme: `wp-content/themes/m-english`
- URL local: `http://localhost/wordpress/`
- Database: `m-english`
- Database user local mặc định: `root`, mật khẩu trống
- Web server/database: Apache và MySQL trong XAMPP

Các bước:

1. Khởi động Apache và MySQL trong XAMPP.
2. Mở `http://localhost/wordpress/`.
3. Kiểm tra cả giao diện tiếng Việt và tiếng Anh bằng nút đổi ngôn ngữ trên header.
4. Nếu URL trả về máy cũ hoặc domain khác, kiểm tra `home` và `siteurl` trong bảng `wp_options`; giá trị local hiện tại là `http://localhost/wordpress`.

### Lưu ý về ngrok

File `wp-content/mu-plugins/m-english-ngrok-preview.php` chỉ phục vụ preview qua một tunnel ngrok cụ thể. Domain trong file có thể thuộc máy/tunnel cũ và không quyết định source nào được chạy. Khi làm local, dùng trực tiếp `http://localhost/wordpress/`; không sửa domain ngrok nếu chưa được người quản lý dự án cung cấp tunnel mới.

## 3. Công nghệ và dependency

- WordPress classic theme, PHP template.
- CSS thuần, không dùng Sass/Tailwind.
- JavaScript thuần, không dùng React/Vue và không có bước build.
- Polylang quản lý quan hệ trang VI/EN.
- Fluent Forms quản lý các biểu mẫu.
- Google Sheets nhận submission từ Fluent Forms qua integration riêng.
- Font Google Sans Flex được tải từ Google Fonts.

Không cần chạy `npm install`. Thay đổi trong file CSS/JS có hiệu lực trực tiếp sau khi refresh; nếu chưa thấy thay đổi, hard refresh và xóa cache trình duyệt/WordPress.

## 4. Cấu trúc source quan trọng

```text
m-english/
├── functions.php                 # Enqueue asset, form ID, dịch VI/EN, integration
├── header.php                    # Header, menu, language switcher
├── footer.php                    # Footer và wp_footer()
├── front-page.php                # Trang chủ
├── page-about.php                # Về M-English
├── page-ecosystem.php            # Hệ sinh thái/sản phẩm
├── page-partnership.php          # Hợp tác/bảng giá
├── page-contact.php              # Liên hệ/tư vấn
├── template-parts/
│   ├── home/                     # Các section trang chủ
│   ├── about/                    # Các section trang giới thiệu
│   ├── ecosystem/                # Các section/chương trình hệ sinh thái
│   ├── partnership/              # Các section trang hợp tác
│   ├── contact/                  # Các section trang liên hệ
│   └── forms/                    # Form dùng chung
├── assets/
│   ├── css/                      # CSS global và theo trang
│   ├── js/                       # JavaScript global và theo trang
│   └── images/                   # Ảnh chia theo trang/module
├── translations/                # Bảng chuỗi tiếng Anh
└── integrations/google-sheets/   # Gửi dữ liệu form sang Google Sheets
```

## 5. Asset được nạp theo trang

Đăng ký asset nằm trong `functions.php`.

| Khu vực | CSS | JavaScript |
|---|---|---|
| Toàn site | `global.css`, `header.css`, `footer.css`, `typography.css` | `main.js` |
| Trang chủ | `home.css` | `home.js` |
| Giới thiệu | `about.css` | `about.js` |
| Hệ sinh thái | `ecosystem.css`, `ecosystem-cards.css`, `forms.css`, `form-system.css` | `forms.js` |
| Hợp tác | `partnership.css`, `partnership-refinements.css`, `form-system.css` | `partnership.js` |
| Liên hệ | `contact.css`, `contact-slider.css`, `form-system.css` | `contact.js` |

Nếu tạo file animation dùng chung, enqueue file đó trong `functions.php` với dependency `m-english-main`. Nếu animation chỉ dùng cho một trang, thêm vào nhánh `is_front_page()` hoặc `is_page_template(...)` tương ứng để không tải thừa trên toàn site.

## 6. Trạng thái animation/interaction hiện có

- Header CTA có hiệu ứng pulse và shine trong `header.css`.
- Trang chủ có hero slider trong `home.js` và transition trong `home.css`.
- Trang giới thiệu có slider trong `about.js` và `about.css`.
- Trang liên hệ có slider, swipe, pause khi hover/focus, keyboard navigation và FAQ accordion trong `contact.js`.
- Các nút, card và link có hover transition trong `typography.css` cùng CSS theo trang.
- Fluent Forms được tăng cường bằng JavaScript và `MutationObserver` trong `forms.js`, `partnership.js`, `contact.js`.
- Một số module đã xử lý `prefers-reduced-motion` trong cả CSS và JavaScript.

Không khởi tạo lại slider hoặc gắn listener trùng lên các thành phần trên. Khi cần nâng cấp, mở rộng module hiện tại hoặc dùng class/attribute riêng và bảo đảm logic chỉ chạy một lần.

## 7. Quy ước triển khai animation

### HTML

- Ưu tiên thêm data attribute như `data-animate="fade-up"`, `data-animate-delay="120"` thay vì selector phụ thuộc cấu trúc DOM quá sâu.
- Không thay đổi class đang được JavaScript hoặc Fluent Forms sử dụng.
- Không sao chép markup chỉ để tạo hiệu ứng nếu có thể dùng pseudo-element.
- Các phần tử trang trí phải có `aria-hidden="true"`; không làm thay đổi thứ tự đọc của screen reader.

### CSS

- Chỉ animate `transform` và `opacity` khi có thể; tránh liên tục animate `width`, `height`, `top`, `left` gây layout/repaint.
- Dùng class trạng thái thống nhất, ví dụ `.is-in-view`, `.is-active`, `.is-leaving`.
- Luôn có fallback giảm chuyển động:

```css
@media (prefers-reduced-motion: reduce) {
  [data-animate] {
    animation: none !important;
    transition: none !important;
    transform: none !important;
  }
}
```

- Không dùng `transition: all`.
- Không làm nội dung quan trọng bị ẩn vĩnh viễn nếu JavaScript lỗi hoặc bị tắt.
- Giữ breakpoint và layout responsive hiện tại; kiểm tra tối thiểu ở 360 px, 768 px, 1024 px và desktop lớn.

### JavaScript

- Bao code trong `DOMContentLoaded` như các file hiện tại.
- Với reveal on scroll, dùng một `IntersectionObserver` dùng chung thay vì tạo observer riêng cho từng node.
- Kiểm tra `prefers-reduced-motion: reduce`; trong chế độ này hiển thị nội dung ngay và dừng autoplay/chuyển động không cần thiết.
- Tránh listener `scroll` chạy trực tiếp. Nếu bắt buộc, dùng passive listener và gom cập nhật qua `requestAnimationFrame`.
- Animation phải được khởi tạo idempotent: đánh dấu phần tử đã init để không gắn event nhiều lần.
- Dừng timer/animation khi tab bị ẩn nếu có chuyển động lặp (`document.visibilityState`).
- Không thêm thư viện animation bên ngoài trước khi được duyệt. Nếu đề xuất GSAP/AOS/Lottie, cần nêu rõ dung lượng, license, cách cache và lý do CSS/Web Animations API không đáp ứng được.

## 8. Những khu vực nhạy cảm không được làm hỏng

### Đa ngôn ngữ

Các page template dùng output buffering rồi thay chuỗi bằng các file trong `translations/`. Vì vậy:

- Thay đổi text/markup có thể làm key dịch tiếng Anh không còn khớp.
- Sau mỗi thay đổi template phải kiểm tra cả VI và EN.
- Không đưa text giao diện mới trực tiếp vào JavaScript nếu chưa có phương án dịch/localize.
- Không thay slug hoặc quan hệ trang Polylang.

### Fluent Forms

Registry hiện tại trong `m_english_form_ids()`:

| Form | ID |
|---|---:|
| Ecosystem | 1 |
| Partnership | 2 |
| Contact | 3 |
| Training | Chưa cấu hình (`0`) |

- Không đổi `name`, `id`, class hoặc cấu trúc field tùy tiện.
- Form có thể render bất đồng bộ; code hiện dùng `MutationObserver` để chờ Choices.js/Fluent Forms tạo DOM.
- Không chặn submit, validation, focus lỗi hoặc thông báo thành công.
- Test hoàn chỉnh bằng bàn phím, đặc biệt custom select và checkbox giả lập.

### Google Sheets

`integrations/google-sheets/wordpress-sender.php` xử lý submission sau khi Fluent Forms lưu dữ liệu. Animation developer không cần chỉnh file này. Không log hoặc đưa webhook/secret vào commit, screenshot hay tài liệu công khai.

### Header/footer

- `main.js` điều khiển menu mobile và dropdown.
- Không che menu bằng stacking context mới; header đang dùng `z-index` cao.
- Giữ `wp_head()`, `wp_body_open()` và `wp_footer()` trong template.

## 9. Quy trình đề xuất cho mỗi animation

1. Xác định section trong `template-parts/` và asset CSS/JS tương ứng.
2. Thêm hook ổn định (`data-animate` hoặc class BEM).
3. Viết trạng thái mặc định sao cho nội dung vẫn đọc được khi JS lỗi.
4. Thêm logic kích hoạt có hỗ trợ reduced motion.
5. Test VI/EN, desktop/mobile và thao tác bàn phím.
6. Test lại slider, header menu và các form trên trang vừa sửa.
7. Kiểm tra Console không có lỗi và Network không có asset 404.
8. Ghi rõ file/section đã sửa trong commit hoặc phần mô tả bàn giao.

## 10. Checklist nghiệm thu animation

- [ ] Nội dung không nhảy layout đáng kể khi tải trang.
- [ ] Không xuất hiện flash nội dung ẩn hoặc phần tử bị kẹt ở `opacity: 0`.
- [ ] `prefers-reduced-motion: reduce` hoạt động.
- [ ] Animation không che hoặc chặn click form/menu/link.
- [ ] Focus ring vẫn nhìn thấy và tab order không thay đổi.
- [ ] Slider dùng được bằng nút, bàn phím và touch.
- [ ] Menu desktop/mobile hoạt động.
- [ ] Cả tiếng Việt và tiếng Anh hiển thị đúng.
- [ ] Form ID 1, 2 và 3 vẫn submit/validate đúng.
- [ ] Không có lỗi JavaScript trong Console.
- [ ] Không có ảnh/font/script 404.
- [ ] Không thêm URL local/ngrok cố định vào theme.
- [ ] Không commit database dump, log, cache, credential hoặc secret.
- [ ] Kiểm tra hiệu năng trên thiết bị mobile hoặc chế độ CPU throttling.

## 11. Phạm vi bàn giao của animation developer

Khi hoàn thành, gửi lại:

- Danh sách trang và section đã thêm animation.
- Danh sách file đã sửa/thêm.
- Mô tả trigger, duration, easing và breakpoint đặc biệt.
- Thư viện/tài nguyên ngoài đã dùng, nếu có, kèm license.
- Video hoặc ảnh quay kết quả trên desktop và mobile.
- Các giới hạn/case chưa xử lý.
- Xác nhận đã hoàn thành checklist ở mục 10.

## 12. Điểm liên hệ kỹ thuật trước khi sửa lớn

Cần xin xác nhận trước khi:

- Thay đổi markup hoặc text đang dùng cho bản dịch VI/EN.
- Thêm dependency hoặc CDN mới.
- Thay đổi cấu trúc/field Fluent Forms.
- Sửa `functions.php`, integration Google Sheets hoặc MU-plugin.
- Đổi kích thước/nén/thay thế ảnh gốc.
- Thay đổi timing/behavior của slider hiện có trên toàn site.

