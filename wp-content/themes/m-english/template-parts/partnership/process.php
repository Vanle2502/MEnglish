<?php
$steps = [
    ['BƯỚC 01', 'Khảo sát & Tư vấn', 'Đánh giá hiện trạng Anh ngữ, quy mô học sinh, năng lực đội ngũ giáo viên và định hướng phát triển của nhà trường.'],
    ['BƯỚC 02', 'Lựa chọn Gói giải pháp', 'Tư vấn và thống nhất gói chuyển giao (Standard, Advanced, Premium / Diamond) phù hợp với quy mô và ngân sách.'],
    ['BƯỚC 03', 'Tập huấn Chuyển giao', 'Tổ chức các buổi đào tạo chuyên sâu (Online/Offline) về phương pháp IMPRESS, kỹ năng kịch nghệ và thao tác giáo cụ cho giáo viên.'],
    ['BƯỚC 04', 'Đồng hành & Dự giờ định kỳ', 'Chuyên gia M-English trực tiếp dự giờ, kiểm định chất lượng tiết dạy hàng tháng và tổ chức sự kiện M-Day cho nhà trường.'],
];
?>
<section class="partnership-process" aria-labelledby="partnership-process-title">
    <div class="container">
        <div class="partnership-heading"><p>Quy trình <strong>triển khai</strong></p><h2 id="partnership-process-title"><span>4 BƯỚC</span> CHUYỂN GIAO TRƠN TRU &amp; CHUYÊN NGHIỆP</h2></div>
        <div class="partnership-process__grid">
            <?php foreach ($steps as $step) : ?><article><span><?php echo esc_html($step[0]); ?></span><h3><?php echo esc_html($step[1]); ?></h3><p><?php echo esc_html($step[2]); ?></p></article><?php endforeach; ?>
        </div>
    </div>
</section>
<div class="partnership-cta partnership-cta--process"><div class="container"><a href="#partnership-form"><img src="<?php echo m_english_partnership_image('mascot-student.png'); ?>" alt="">ĐĂNG KÝ TƯ VẤN QUY TRÌNH <span>›</span></a></div></div>
