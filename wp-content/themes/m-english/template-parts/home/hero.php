<section class="home-hero" aria-label="Giới thiệu M-English">
    <div class="home-hero__slides">
        <?php $slides = ['hero-magic-stories.png', 'founder-teaching-puppet.png']; foreach ($slides as $i => $slide) : ?>
        <div class="home-hero__slide<?php echo $i === 0 ? ' is-active' : ''; ?>" aria-hidden="<?php echo $i === 0 ? 'false' : 'true'; ?>">
            <img src="<?php echo m_english_home_image($slide); ?>" alt="" width="1920" height="886" <?php echo $i === 0 ? 'fetchpriority="high"' : 'loading="lazy"'; ?>>
            <div class="container home-hero__overlay"><h1>Magic stories<br>that sing</h1><p>Giải pháp Anh ngữ toàn diện cho<br>trường Mầm non & Tiểu học</p></div>
        </div><?php endforeach; ?>
    </div>
    <button class="home-hero__arrow home-hero__arrow--prev" aria-label="Ảnh trước" type="button"><span class="home-hero__arrow-icon" aria-hidden="true"></span></button><button class="home-hero__arrow home-hero__arrow--next" aria-label="Ảnh tiếp theo" type="button"><span class="home-hero__arrow-icon" aria-hidden="true"></span></button>
</section>
<section class="home-message section" data-motion-scope>
    <div class="container">
        <h2>
            <span data-motion="fade-down" style="--motion-duration: 650ms; --motion-distance: 18px;">CÙNG TRƯỜNG BẠN XÂY DỰNG</span>
            <span data-motion="fade-down" style="--motion-delay: 160ms; --motion-duration: 650ms; --motion-distance: 18px;">MÔI TRƯỜNG ANH NGỮ</span>
        </h2>
        <p class="home-message__values" data-motion="card-grow" style="--motion-delay: 500ms; --motion-duration: 700ms;">
            <span class="home-message__value" data-motion="fade-up" style="--motion-delay: 850ms; --motion-duration: 550ms; --motion-distance: 16px;">Sáng tạo</span>
            <span class="home-message__value" data-motion="fade-up" style="--motion-delay: 1050ms; --motion-duration: 550ms; --motion-distance: 16px;"><span class="home-message__separator" aria-hidden="true">•</span>Cảm xúc</span>
            <span class="home-message__value" data-motion="fade-up" style="--motion-delay: 1250ms; --motion-duration: 550ms; --motion-distance: 16px;"><span class="home-message__separator" aria-hidden="true">•</span>Khác biệt</span>
        </p>
    </div>
</section>
<div class="home-cta-strip home-cta-strip--first"><div class="container"><a href="<?php echo m_english_page_url('lien-he'); ?>"><img class="home-decoration home-cta-strip__mascot" data-motion-target="consultation" src="<?php echo m_english_home_image('cta-trai.png'); ?>" width="123" height="136" alt="" loading="lazy"><span>ĐẶT LỊCH TƯ VẤN</span> ›</a><a href="<?php echo m_english_page_url('hop-tac'); ?>"><img class="home-decoration home-cta-strip__mascot" data-motion-target="pricing" src="<?php echo m_english_home_image('cta-phai.png'); ?>" width="125" height="140" alt="" loading="lazy"><span>XEM BẢNG GIÁ HỢP TÁC</span> ›</a></div></div>
