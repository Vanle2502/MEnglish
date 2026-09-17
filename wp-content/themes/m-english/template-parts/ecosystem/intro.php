<?php
$programs = $args['programs'];
?>
    <section class="ecosystem-intro" aria-labelledby="ecosystem-title">
        <div class="container">
            <p class="ecosystem-kicker">HỆ SINH THÁI GIÁO DỤC M-ENGLISH</p>
            <h1 id="ecosystem-title">Giải pháp <span>Anh ngữ toàn diện</span><br>cho trường Mầm non &amp; Tiểu học</h1>
            <p>Tích hợp 5 sản phẩm cốt lõi từ chương trình học chính khóa, ngữ âm, trải nghiệm thực tế đến nền tảng đào tạo số & chứng chỉ quốc tế.</p>
            <nav class="ecosystem-nav" aria-label="Khám phá các chương trình">
                <?php foreach ($programs as $program) : ?><a href="#<?php echo esc_attr($program['id']); ?>"><strong><?php echo esc_html($program['name']); ?></strong><small><?php echo esc_html($program['headline']); ?></small></a><?php endforeach; ?>
            </nav>
        </div>
    </section>
