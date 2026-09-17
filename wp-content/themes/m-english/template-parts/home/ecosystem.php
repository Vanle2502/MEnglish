<section class="home-ecosystem section"><div class="container"><div class="section-heading"><p class="section-heading__eyebrow">Hệ sinh thái <strong>M-English</strong></p><h2>CHƯƠNG TRÌNH & ĐÀO TẠO ĐỒNG BỘ</h2></div>
<div class="home-ecosystem__grid">
<?php $items = [
 ['M-English','Tiếng Anh 1–6 tuổi qua truyện, nhạc, kịch & trải nghiệm.','m-english'],
 ['M-Phonics','Ngữ âm 3–8 tuổi theo Science of Reading.','m-phonics'],
 ['M-Cook','Taste The Language — tiếng Anh qua nấu ăn.','m-cook'],
 ['M-Learning','Đào tạo tổ chức, năng lực giáo dục & đội ngũ.','m-learning'],
 ['M-INTESOL','Chứng chỉ quốc tế INTESOL UK kiểm định ALAP.','m-intesol']]; foreach ($items as $item) : ?>
<a class="home-ecosystem__item" href="<?php echo m_english_page_url('he-sinh-thai/' . $item[2]); ?>"><h3><?php echo esc_html($item[0]); ?></h3><p><?php echo esc_html($item[1]); ?></p></a>
<?php endforeach; ?></div></div></section>
<div class="home-cta-strip home-cta-strip--ecosystem"><div class="container"><a href="<?php echo m_english_page_url('he-sinh-thai'); ?>"><img class="home-decoration home-cta-strip__mascot" data-motion-target="ecosystem" src="<?php echo m_english_home_image('cta-trai.png'); ?>" width="123" height="136" alt="" loading="lazy"><span>XEM HỆ SINH THÁI</span> ›</a><a href="<?php echo m_english_page_url('lien-he'); ?>"><img class="home-decoration home-cta-strip__mascot" data-motion-target="consultation" src="<?php echo m_english_home_image('cta-phai.png'); ?>" width="125" height="140" alt="" loading="lazy"><span>ĐĂNG KÝ TƯ VẤN</span> ›</a></div></div>
