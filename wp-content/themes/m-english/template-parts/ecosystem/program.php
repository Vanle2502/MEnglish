<?php
$program = $args['program'];
?>
    <section class="ecosystem-program ecosystem-program--<?php echo esc_attr($program['id']); ?>" id="<?php echo esc_attr($program['id']); ?>" aria-labelledby="<?php echo esc_attr($program['id']); ?>-title">
        <div class="container">
            <div class="ecosystem-program__heading">
                <div class="ecosystem-program__brand"><?php if ($program['logo']) : ?><img src="<?php echo m_english_ecosystem_image($program['logo']); ?>" alt="<?php echo esc_attr($program['name']); ?>" loading="lazy"><?php else : ?><strong><?php echo esc_html($program['name']); ?></strong><?php endif; ?></div>
                <div><p><?php echo esc_html($program['eyebrow']); ?></p><h2 id="<?php echo esc_attr($program['id']); ?>-title"><?php echo esc_html($program['headline']); ?></h2></div>
            </div>
            <div class="ecosystem-feature">
                <div class="ecosystem-feature__photo"><img src="<?php echo m_english_ecosystem_image($program['photo']); ?>" alt="<?php echo esc_attr($program['name'] . ' tại M-English'); ?>" loading="lazy"></div>
                <div class="ecosystem-feature__copy"><h3><?php echo esc_html($program['age']); ?></h3><p><?php echo esc_html($program['intro']); ?></p><p><?php echo esc_html($program['detail']); ?></p></div>
            </div>
        </div>
        <div class="ecosystem-benefits"><div class="container ecosystem-benefits__grid">
            <?php foreach ($program['benefits'] as $benefit_index => $benefit) : ?><article class="ecosystem-benefit"><img src="<?php echo m_english_ecosystem_image($program['icons'][$benefit_index]); ?>" alt="" loading="lazy"><p><?php echo esc_html($benefit); ?></p></article><?php endforeach; ?>
        </div></div>
        <div class="ecosystem-program__cta" style="--banner:url('<?php echo m_english_ecosystem_image($program['banner']); ?>')"><div class="container"><a href="<?php echo m_english_page_url('he-sinh-thai') . '#' . esc_attr($program['id']); ?>"><img src="<?php echo m_english_ecosystem_image('mascot-mouse.png'); ?>" alt="" loading="lazy"><?php echo esc_html($program['cta'][0]); ?> <span aria-hidden="true">›</span></a><a href="<?php echo m_english_page_url('lien-he'); ?>"><img src="<?php echo m_english_ecosystem_image('mascot-reader.png'); ?>" alt="" loading="lazy"><?php echo esc_html($program['cta'][1]); ?> <span aria-hidden="true">›</span></a></div></div>
    </section>
