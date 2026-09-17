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


<?php
/* Template Name: Products & Ecosystem */
ob_start();
get_header();
$programs = require get_template_directory() . '/template-parts/ecosystem/programs.php';
?>
<main id="main-content" class="ecosystem-page">
    <?php get_template_part('template-parts/ecosystem/intro', null, ['programs' => $programs]); ?>
    <?php foreach ($programs as $program) {
        get_template_part('template-parts/ecosystem/program', null, ['program' => $program]);
    } ?>
    <?php get_template_part('template-parts/forms/consultation', null, ['form' => 'ecosystem']); ?>
</main>
<?php get_footer(); echo m_english_translate_ecosystem_markup(ob_get_clean()); ?>

<?php
/* Template Name: Partnership & Pricing */
ob_start();
get_header();
?>
<main id="main-content" class="partnership-page">
    <?php foreach (['hero', 'values', 'process', 'form'] as $section) {
        get_template_part('template-parts/partnership/' . $section);
    } ?>
</main>
<?php get_footer(); echo m_english_translate_partnership_markup(ob_get_clean()); ?>
