<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main-content">Bỏ qua điều hướng</a>
<header class="site-header">
    <div class="container site-header__inner">
        <a class="site-header__brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="M-English — Trang chủ">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/system/logo.png'); ?>" alt="M-English — Magic stories that sing" width="132" height="68">
        </a>
        <button class="site-header__toggle" type="button" aria-controls="site-navigation" aria-expanded="false" aria-label="Mở menu"><span></span><span></span><span></span></button>
        <nav class="site-header__nav" id="site-navigation" aria-label="Điều hướng chính">
            <ul>
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a></li>
                <li><a href="<?php echo m_english_page_url('ve-m-english'); ?>">Về M-English</a></li>
                <li class="site-header__dropdown"><a class="site-header__ecosystem-link" href="<?php echo m_english_page_url('he-sinh-thai'); ?>">Hệ sinh thái</a><button type="button" aria-controls="ecosystem-menu" aria-expanded="false" aria-label="Mở danh sách sản phẩm"><span class="site-header__chevron" aria-hidden="true"></span></button>
                    <div class="site-header__submenu" id="ecosystem-menu">
                        <ul class="site-header__submenu-list">
                            <?php foreach ([
                                ['M-English', 'Tiếng Anh 1–6 tuổi qua nhạc, kịch, truyện', 'm-english'],
                                ['M-Phonics', 'Ngữ âm 3–8 tuổi Science of Reading', 'm-phonics'],
                                ['M-INTESOL', 'Chứng chỉ giảng dạy quốc tế UK', 'm-intesol'],
                                ['M-Cook', 'Tiếng Anh qua trải nghiệm nấu ăn', 'm-cook'],
                                ['M-Learning', 'Đào tạo & E-Learning', 'm-learning'],
                            ] as $item) : ?>
                            <li><a href="<?php echo m_english_page_url('he-sinh-thai') . '#' . esc_attr($item[2]); ?>"><strong><?php echo esc_html($item[0]); ?></strong><span><?php echo esc_html($item[1]); ?></span></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
                <li><a href="<?php echo m_english_page_url('hop-tac'); ?>">Hợp tác</a></li>
            </ul>
            <div class="site-header__actions">
                <a class="site-header__cta" href="<?php echo m_english_page_url('lien-he'); ?>">Liên hệ/Tư vấn</a>
                <div class="site-header__languages" aria-label="Chọn ngôn ngữ">
                    <?php
                    $language_links = function_exists('pll_the_languages')
                        ? pll_the_languages(['raw' => 1, 'hide_if_empty' => 0, 'hide_if_no_translation' => 0])
                        : [];
                    $languages_by_slug = [];
                    foreach ((array) $language_links as $language_link) {
                        $languages_by_slug[$language_link['slug']] = $language_link;
                    }
                    foreach (['vi' => 'Tiếng Việt', 'en' => 'English'] as $slug => $name) :
                        $language = $languages_by_slug[$slug] ?? null;
                        $is_current = $language ? !empty($language['current_lang']) : $slug === 'vi';
                        $is_available = $language && empty($language['no_translation']) && !empty($language['url']);
                    ?>
                        <?php if ($is_available) : ?>
                            <a class="site-header__language<?php echo $is_current ? ' is-current' : ''; ?>" href="<?php echo esc_url($language['url']); ?>" lang="<?php echo esc_attr($slug); ?>" hreflang="<?php echo esc_attr($slug); ?>" aria-label="<?php echo esc_attr($name); ?>" <?php echo $is_current ? 'aria-current="page"' : ''; ?>><?php echo esc_html(strtoupper($slug)); ?></a>
                        <?php else : ?>
                            <span class="site-header__language<?php echo $is_current ? ' is-current' : ' is-unavailable'; ?>" lang="<?php echo esc_attr($slug); ?>" aria-label="<?php echo esc_attr($name . ($is_current ? ' — hiện tại' : ' — chưa có bản dịch')); ?>"><?php echo esc_html(strtoupper($slug)); ?></span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </nav>
    </div>
</header>
