<?php ob_start(); get_header(); ?>
<main id="main-content">
    <?php
    foreach (['hero', 'ecosystem', 'stats', 'impress', 'process', 'experts', 'differences'] as $section) {
        get_template_part('template-parts/home/' . $section);
    }
    ?>
</main>
<?php get_footer(); echo m_english_translate_home_markup(ob_get_clean()); ?>
