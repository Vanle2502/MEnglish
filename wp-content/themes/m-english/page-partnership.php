<?php
/* Template Name: Partnership & Pricing */
ob_start();
get_header();
?>
<main id="main-content" class="partnership-page">
    <?php foreach (['hero', 'values'] as $section) {
        get_template_part('template-parts/partnership/' . $section);
    } ?>
</main>
<?php get_footer(); echo m_english_translate_partnership_markup(ob_get_clean()); ?>