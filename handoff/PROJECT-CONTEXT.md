# Bối cảnh dự án M-English — đọc nhanh 5 phút

## 1. Dự án là gì?

M-English là website WordPress song ngữ Việt/Anh dành cho chương trình tiếng Anh mầm non và tiểu học. Source hiện tại là **classic theme viết riêng**, không dùng page builder và không có bước build frontend.

Mục tiêu công việc hiện tại: tiếp tục hoàn thiện giao diện và animation, trước mắt tập trung vào trang Home, đồng thời không làm ảnh hưởng menu, slider, bản dịch và form.

## 2. Công nghệ chính

- WordPress + PHP template.
- CSS và JavaScript thuần; không cần `npm install`.
- Theme chính: `wp-content/themes/m-english/`.
- Polylang: quản lý trang Việt/Anh.
- Fluent Forms: các form tư vấn/liên hệ.
- Các plugin cần chạy đã được lưu trong `wp-content/plugins/`.

## 3. Bắt đầu nhanh

Làm theo [SETUP.md](SETUP.md). Sau khi import database và tạo `wp-config.php`:

- Website: `http://localhost/wordpress/`
- Admin: `http://localhost/wordpress/wp-admin/`
- Tài khoản local: `admin`; tự đặt mật khẩu riêng theo hướng dẫn trong `SETUP.md`.

Database bàn giao không chứa mật khẩu dùng chung; đồng thời đã bỏ dữ liệu submission, log, webhook authentication và credential thật.

## 4. Những file cần biết

```text
wp-content/themes/m-english/
├── functions.php                 Nạp CSS/JS, khai báo form và xử lý bản dịch
├── front-page.php                Ghép các section của Home
├── header.php, footer.php        Header/footer dùng chung
├── template-parts/home/          Markup từng section Home
├── assets/css/home.css           Giao diện Home
├── assets/js/home.js             Slider và tương tác Home
├── assets/css/animations.css     Preset/trạng thái animation dùng chung
├── assets/js/animations.js       Trigger animation bằng IntersectionObserver
├── assets/css/header.css         Header sticky, menu và CTA
└── translations/                 Chuỗi/bản dịch tiếng Anh
```

Thứ tự section Home nằm trong `front-page.php`:

`hero → ecosystem → stats → impress → process → experts → differences`

## 5. Animation đã có

- Header sticky vẫn được giữ khi cuộn.
- Intro Home chỉ chạy trên Home: header reveal, ảnh hero phóng nhẹ và đi lên, tiêu đề/nội dung/nút slider xuất hiện đồng thời trong chuỗi khoảng 5 giây.
- Sau intro, class `is-home-intro-complete` giải phóng compositor layer.
- Cụm `CÙNG TRƯỜNG... / MÔI TRƯỜNG...` và ba giá trị bên dưới chạy khi người dùng cuộn tới.
- Các card IMPRESS dùng `data-pan-scope`; hình tròn, chữ cái, tiêu đề và mô tả dùng `data-pan-part` với delay riêng.
- Tất cả phải hiển thị ngay khi người dùng bật `prefers-reduced-motion`.

Hai hệ trigger đang dùng:

- `data-motion-scope` + `data-motion`: reveal một lần khi cuộn tới.
- `data-pan-scope` + `data-pan-part`: pan theo nhóm, có hiệu ứng vào/ra và chạy lại.

Nếu chỉ cần hiệu ứng tương tự, hãy dùng lại hai hệ này thay vì tạo observer mới.

## 6. Quy tắc sửa an toàn

- Chỉ animate `transform` và `opacity` nếu có thể.
- Không để nội dung kẹt ở `opacity: 0` khi JavaScript lỗi.
- Luôn xử lý `prefers-reduced-motion: reduce`.
- Không gắn URL localhost/ngrok cố định vào theme.
- Không sửa tên field, ID hoặc luồng submit của Fluent Forms khi chỉ làm giao diện.
- Không sửa trực tiếp plugin; ưu tiên sửa trong theme.
- Sau khi đổi text/markup, kiểm tra cả tiếng Việt và tiếng Anh vì theme có bước dịch output.
- Không thêm thư viện animation/CDN mới nếu chưa thống nhất.

## 7. Kiểm tra trước khi bàn giao

1. Test Home ở desktop và mobile (tối thiểu 360 px, 768 px và desktop).
2. Test reload đầu trang và cuộn từ trên xuống.
3. Test chế độ `prefers-reduced-motion`.
4. Kiểm tra menu desktop/mobile, sticky header và hero slider.
5. Kiểm tra cả VI/EN.
6. Đảm bảo Console không lỗi và Network không có asset 404.
7. Không commit `wp-config.php`, database thật, uploads, backup, credential hoặc URL ngrok cá nhân.

## 8. Khi cần tìm đúng chỗ để sửa

- Sửa markup một section Home: `template-parts/home/<section>.php`.
- Sửa bố cục/màu/kích thước Home: `assets/css/home.css`.
- Sửa preset hoặc timing animation: `assets/css/animations.css`.
- Sửa trigger animation khi cuộn: `assets/js/animations.js`.
- Sửa logic slider Home: `assets/js/home.js`.
- Sửa header/menu: `header.php`, `assets/css/header.css`, `assets/js/main.js`.

Tài liệu chi tiết hơn về animation nằm tại `wp-content/themes/m-english/docs/HANDOVER-ANIMATION.md`.
