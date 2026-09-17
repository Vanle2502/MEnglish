<?php get_header(); ?>
<main id="main-content" class="container section"><h1><?php the_title(); ?></h1><?php if (have_posts()) : while (have_posts()) : the_post(); the_content(); endwhile; endif; ?></main>
<?php get_footer(); ?>
