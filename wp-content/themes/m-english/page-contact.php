<?php
/* Template Name: Contact & Consultation */
ob_start();
get_header();
?>
<main id="main-content" class="contact-page">
    <?php foreach (['hero', 'form', 'information', 'map', 'faq'] as $section) {
        get_template_part('template-parts/contact/' . $section);
    } ?>
</main>
<?php get_footer(); echo m_english_translate_contact_markup(ob_get_clean()); ?>
