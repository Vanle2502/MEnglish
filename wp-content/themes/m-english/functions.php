<?php
defined('ABSPATH') || exit;

require_once get_template_directory() . '/integrations/google-sheets/wordpress-sender.php';

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    register_nav_menus(['primary' => __('Primary menu', 'm-english')]);
});

add_action('wp_enqueue_scripts', function () {
    $uri = get_template_directory_uri();
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('m-english-font', 'https://fonts.googleapis.com/css2?family=Google+Sans+Flex:opsz,wght@6..144,100..900&display=swap', [], null);
    wp_enqueue_style('m-english-global', $uri . '/assets/css/global.css', ['m-english-font'], $version);
    wp_enqueue_style('m-english-header', $uri . '/assets/css/header.css', ['m-english-global'], $version);
    wp_enqueue_style('m-english-footer', $uri . '/assets/css/footer.css', ['m-english-global'], $version);
    wp_enqueue_script('m-english-main', $uri . '/assets/js/main.js', [], $version, true);
    if (is_front_page()) {
        $home_css = get_template_directory() . '/assets/css/home.css';
        $home_js = get_template_directory() . '/assets/js/home.js';
        wp_enqueue_style('m-english-home', $uri . '/assets/css/home.css', ['m-english-global'], file_exists($home_css) ? (string) filemtime($home_css) : $version);
        wp_enqueue_script('m-english-home', $uri . '/assets/js/home.js', [], file_exists($home_js) ? (string) filemtime($home_js) : $version, true);
    }
    if (is_page_template('page-about.php')) {
        wp_enqueue_style('m-english-about', $uri . '/assets/css/about.css', ['m-english-global'], $version);
        wp_enqueue_script('m-english-about', $uri . '/assets/js/about.js', [], $version, true);
    }
    if (is_page_template('page-ecosystem.php')) {
        wp_enqueue_style('m-english-ecosystem', $uri . '/assets/css/ecosystem.css', ['m-english-global'], $version);
        wp_enqueue_style('m-english-ecosystem-cards', $uri . '/assets/css/ecosystem-cards.css', ['m-english-ecosystem'], $version);
        wp_enqueue_style('m-english-forms', $uri . '/assets/css/forms.css', ['m-english-ecosystem-cards'], $version);
        wp_enqueue_style('m-english-form-system', $uri . '/assets/css/form-system.css', ['m-english-forms'], $version);
        wp_enqueue_script('m-english-forms', $uri . '/assets/js/forms.js', ['m-english-main'], $version, true);
        $form_strings = [
            'productLabel'   => 'Lựa chọn sản phẩm quan tâm',
            'name'           => 'Họ tên',
            'phone'          => 'Số điện thoại',
            'school'         => 'Tên trường',
            'city'           => 'Tỉnh/Thành phố',
            'requiredProduct'=> 'Vui lòng chọn ít nhất một sản phẩm.',
            'requiredName'   => 'Vui lòng nhập họ tên.',
            'requiredPhone'  => 'Vui lòng nhập số điện thoại.',
            'requiredSchool' => 'Vui lòng nhập tên trường.',
            'requiredCity'   => 'Vui lòng nhập tỉnh/thành phố.',
            'invalidPhone'   => 'Số điện thoại chưa đúng định dạng Việt Nam.',
            'shortName'      => 'Họ tên cần có ít nhất 2 ký tự.',
        ];
        foreach ($form_strings as $key => $value) {
            $form_strings[$key] = m_english_ecosystem_text($value);
        }
        wp_localize_script('m-english-forms', 'mEnglishFormI18n', $form_strings);
    }
    if (is_page_template('page-partnership.php')) {
        wp_enqueue_style('m-english-partnership', $uri . '/assets/css/partnership.css', ['m-english-global'], $version);
        wp_enqueue_style('m-english-partnership-refinements', $uri . '/assets/css/partnership-refinements.css', ['m-english-partnership'], $version);
        wp_enqueue_style('m-english-form-system', $uri . '/assets/css/form-system.css', ['m-english-partnership-refinements'], $version);
        wp_enqueue_script('m-english-partnership', $uri . '/assets/js/partnership.js', ['m-english-main'], $version, true);
    }
    if (is_page_template('page-contact.php')) {
        wp_enqueue_style('m-english-contact', $uri . '/assets/css/contact.css', ['m-english-global'], $version);
        wp_enqueue_style('m-english-contact-slider', $uri . '/assets/css/contact-slider.css', ['m-english-contact'], $version);
        wp_enqueue_style('m-english-form-system', $uri . '/assets/css/form-system.css', ['m-english-contact-slider'], $version);
        wp_enqueue_script('m-english-contact', $uri . '/assets/js/contact.js', ['m-english-main'], $version, true);
    }
    // Load last so typography stays consistent across every page template.
    wp_enqueue_style('m-english-typography', $uri . '/assets/css/typography.css', ['m-english-header', 'm-english-footer'], $version);
    $animations_css = get_template_directory() . '/assets/css/animations.css';
    $animations_js = get_template_directory() . '/assets/js/animations.js';
    wp_enqueue_style(
        'm-english-animations',
        $uri . '/assets/css/animations.css',
        ['m-english-typography'],
        file_exists($animations_css) ? (string) filemtime($animations_css) : $version
    );
    wp_enqueue_script(
        'm-english-animations',
        $uri . '/assets/js/animations.js',
        ['m-english-main'],
        file_exists($animations_js) ? (string) filemtime($animations_js) : $version,
        true
    );
});

/** Central registry for forms embedded throughout the theme. */
function m_english_form_ids() {
    return apply_filters('m_english_form_ids', [
        'ecosystem' => 1,
        'partnership' => 2,
        'training'  => 0,
        'contact'   => 3,
    ]);
}

/** Render a registered Fluent Form without scattering shortcode IDs in templates. */
function m_english_render_form($key) {
    $forms = m_english_form_ids();
    $form_id = absint($forms[$key] ?? 0);

    if (!$form_id || !shortcode_exists('fluentform')) {
        return;
    }

    echo do_shortcode('[fluentform id="' . $form_id . '"]'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/** Translate dynamic ecosystem strings that are not part of buffered HTML. */
function m_english_ecosystem_text($text) {
    if (!function_exists('pll_current_language') || pll_current_language() !== 'en') {
        return $text;
    }

    $translations = require get_template_directory() . '/translations/ecosystem-en.php';
    return $translations[$text] ?? $text;
}

function m_english_partnership_image($filename) {
    return esc_url(get_template_directory_uri() . '/assets/images/partnership/' . rawurlencode($filename));
}

function m_english_contact_image($filename) {
    return esc_url(get_template_directory_uri() . '/assets/images/contact/' . rawurlencode($filename));
}

function m_english_translate_partnership_markup($markup) {
    if (!function_exists('pll_current_language') || pll_current_language() !== 'en') {
        return $markup;
    }
    $common = require get_template_directory() . '/translations/home-en.php';
    $partnership = require get_template_directory() . '/translations/partnership-en.php';
    foreach ($partnership as $source => $translated) {
        $escaped = esc_html($source);
        if ($escaped !== $source) {
            $partnership[$escaped] = esc_html($translated);
        }
    }
    return strtr($markup, array_merge($common, $partnership));
}

function m_english_partnership_text($text) {
    if (!function_exists('pll_current_language') || pll_current_language() !== 'en') {
        return $text;
    }
    $translations = require get_template_directory() . '/translations/partnership-en.php';
    return $translations[$text] ?? $text;
}

add_filter('fluentform/validation_errors', function ($errors, $form_data, $form) {
    $forms = m_english_form_ids();
    if (absint($form->id ?? 0) !== absint($forms['partnership'] ?? 0)) {
        return $errors;
    }

    $phone = preg_replace('/[^0-9+]/', '', (string) ($form_data['phone'] ?? ''));
    if ($phone && !preg_match('/^(?:\+?84|0)(?:[35789][0-9]{8}|2[0-9]{9})$/', $phone)) {
        $errors['phone'] = [m_english_partnership_text('Số điện thoại chưa đúng định dạng Việt Nam.')];
    }

    foreach ($errors as $field => $messages) {
        foreach ((array) $messages as $index => $message) {
            $errors[$field][$index] = m_english_partnership_text($message);
        }
    }
    return $errors;
}, 20, 3);

function m_english_translate_contact_markup($markup) {
    if (!function_exists('pll_current_language') || pll_current_language() !== 'en') return $markup;
    $common = require get_template_directory() . '/translations/home-en.php';
    $contact = require get_template_directory() . '/translations/contact-en.php';
    foreach ($contact as $source => $translated) {
        $escaped = esc_html($source);
        if ($escaped !== $source) $contact[$escaped] = esc_html($translated);
    }
    return strtr($markup, array_merge($common, $contact));
}

add_filter('fluentform/validation_errors', function ($errors, $form_data, $form) {
    $forms = m_english_form_ids();
    if (absint($form->id ?? 0) !== absint($forms['contact'] ?? 0)) return $errors;
    $phone = preg_replace('/[^0-9+]/', '', (string) ($form_data['phone'] ?? ''));
    if ($phone && !preg_match('/^(?:\+?84|0)(?:[35789][0-9]{8}|2[0-9]{9})$/', $phone)) {
        $errors['phone'] = ['Số điện thoại chưa đúng định dạng Việt Nam.'];
    }
    return $errors;
}, 20, 3);

/** Server-side validation for the ecosystem consultation form. */
add_filter('fluentform/validation_errors', function ($errors, $form_data, $form) {
    $forms = m_english_form_ids();
    if (absint($form->id ?? 0) !== absint($forms['ecosystem'] ?? 0)) {
        return $errors;
    }

    $required = [
        'multi_select' => 'Vui lòng chọn ít nhất một sản phẩm.',
        'name'         => 'Vui lòng nhập họ tên.',
        'phone'        => 'Vui lòng nhập số điện thoại.',
        'school'       => 'Vui lòng nhập tên trường.',
        'city'         => 'Vui lòng nhập tỉnh/thành phố.',
    ];

    foreach ($required as $field => $message) {
        $value = $form_data[$field] ?? '';
        if ((is_array($value) && !$value) || (!is_array($value) && trim((string) $value) === '')) {
            $errors[$field] = [m_english_ecosystem_text($message)];
        }
    }

    $phone = preg_replace('/[^0-9+]/', '', (string) ($form_data['phone'] ?? ''));
    if ($phone && !preg_match('/^(?:\+?84|0)(?:[35789][0-9]{8}|2[0-9]{9})$/', $phone)) {
        $errors['phone'] = [m_english_ecosystem_text('Số điện thoại chưa đúng định dạng Việt Nam.')];
    }

    if (!empty($form_data['name']) && mb_strlen(trim((string) $form_data['name'])) < 2) {
        $errors['name'] = [m_english_ecosystem_text('Họ tên cần có ít nhất 2 ký tự.')];
    }

    return $errors;
}, 10, 3);

function m_english_page_url($slug) {
    if (function_exists('pll_current_language') && function_exists('pll_get_post')) {
        $source = get_page_by_path(trim($slug, '/'));
        if ($source) {
            $translated_id = pll_get_post($source->ID, pll_current_language());
            if ($translated_id) {
                return esc_url(get_permalink($translated_id));
            }
        }
    }
    return esc_url(home_url('/' . trim($slug, '/') . '/'));
}

function m_english_placeholder($width, $height, $label = 'M-English image') {
    return esc_url('https://placehold.co/' . absint($width) . 'x' . absint($height) . '/f5eadc/b8a999?text=' . rawurlencode($label));
}

function m_english_home_image($filename) {
    return esc_url(get_template_directory_uri() . '/assets/images/home/' . rawurlencode($filename));
}

function m_english_about_image($filename) {
    return esc_url(get_template_directory_uri() . '/assets/images/about/' . rawurlencode($filename));
}

function m_english_ecosystem_image($filename) {
    return esc_url(get_template_directory_uri() . '/assets/images/ecosystem/' . rawurlencode($filename));
}

function m_english_translate_ecosystem_markup($markup) {
    if (!function_exists('pll_current_language') || pll_current_language() !== 'en') {
        return $markup;
    }
    $common = require get_template_directory() . '/translations/home-en.php';
    $ecosystem = require get_template_directory() . '/translations/ecosystem-en.php';
    foreach ($ecosystem as $source => $translated) {
        $escaped = esc_html($source);
        if ($escaped !== $source) {
            $ecosystem[$escaped] = esc_html($translated);
        }
    }
    return strtr($markup, array_merge($common, $ecosystem));
}

/** Translate the current code-based homepage while keeping the Vietnamese source intact. */
function m_english_translate_home_markup($markup) {
    if (!function_exists('pll_current_language') || pll_current_language() !== 'en') {
        return $markup;
    }
    $translations = require get_template_directory() . '/translations/home-en.php';
    return strtr($markup, $translations);
}

function m_english_translate_about_markup($markup) {
    if (!function_exists('pll_current_language') || pll_current_language() !== 'en') {
        return $markup;
    }
    $common = require get_template_directory() . '/translations/home-en.php';
    $about = require get_template_directory() . '/translations/about-en.php';
    return strtr($markup, array_merge($common, $about));
}
