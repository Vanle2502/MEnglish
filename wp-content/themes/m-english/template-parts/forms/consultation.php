<?php
defined('ABSPATH') || exit;
$form_key = sanitize_key($args['form'] ?? 'contact');
?>
<section class="consultation-form consultation-form--<?php echo esc_attr($form_key); ?>" aria-labelledby="<?php echo esc_attr($form_key); ?>-form-title">
    <div class="consultation-form__heading container">
        <p>Tùy chỉnh <strong>giải pháp</strong></p>
        <h2 id="<?php echo esc_attr($form_key); ?>-form-title">Chọn sản phẩm phù hợp nhất<br>với mô hình trường bạn</h2>
    </div>
    <div class="consultation-form__body">
        <div class="consultation-form__panel">
            <?php m_english_render_form($form_key); ?>
        </div>
    </div>
</section>
