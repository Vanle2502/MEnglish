<?php
/* Template Name: About M-English */
ob_start();
get_header();
?>
<main id="main-content" class="about-page">
    <?php foreach (['hero', 'founder', 'vision', 'philosophy'] as $section) {
        get_template_part('template-parts/about/' . $section);
    } ?>
</main>
<?php get_footer(); echo m_english_translate_about_markup(ob_get_clean()); ?>
