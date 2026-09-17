<?php
$values = [
    ['Tài nguyên<br>chạm cảm xúc', 'Bộ bài hát lồng ghép cốt truyện, nhân vật hoạt hình bản quyền và giáo cụ handmade kích hoạt đa giác quan, giúp trẻ tự nhiên thấm thấu ngôn ngữ.'],
    ['Phương pháp<br>dễ ứng dụng', 'Giáo viên mầm non không cần quá xuất sắc tiếng Anh vẫn đứng lớp trơn tru nhờ kịch bản giáo án đóng gói chi tiết tới từng phút.'],
    ['Tài nguyên<br>số toàn diện', 'Tích hợp hệ thống E-Learning, phim hoạt hình HD, nhạc kịch và file audio bản xứ phục vụ cả giảng dạy tại lớp lẫn ôn tập tại nhà.'],
    ['Tiết kiệm 80%<br>thời gian chuẩn bị', 'Khung chương trình đồng bộ giúp nhà trường tối ưu vận hành, giảm tải hoàn toàn áp lực soạn giáo án cho giáo viên.'],
    ['Đào tạo &amp; đồng hành<br>sát sao', 'M-English không chỉ bàn giao giáo án mà trực tiếp tập huấn, dự giờ, kiểm định chất lượng giảng dạy và hỗ trợ chuyên môn định kỳ hàng tháng.'],
];
?>
<section class="partnership-values" aria-labelledby="partnership-values-title">
    <div class="container">
        <div class="partnership-heading partnership-heading--light"><p>Tại sao lại chọn M-English</p><h2 id="partnership-values-title">5 GIÁ TRỊ VƯỢT TRỘI KHI<br>CHUYỂN GIAO CHƯƠNG TRÌNH</h2></div>
        <div class="partnership-values__grid">
            <?php foreach ($values as $value) : ?><article><h3><?php echo wp_kses($value[0], ['br' => []]); ?></h3><p><?php echo esc_html($value[1]); ?></p></article><?php endforeach; ?>
        </div>
        <a class="partnership-button partnership-button--dark" href="#partnership-form">ĐĂNG KÝ DỰ GIỜ MẪU <span>›</span></a>
    </div>
</section>
