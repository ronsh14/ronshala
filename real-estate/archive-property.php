<?php get_header(); ?>

<h2>Properties for Sale</h2>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <article>
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <?php if (has_post_thumbnail()) {
        the_post_thumbnail('medium');
    } ?>
    <p><?php the_excerpt(); ?></p>
  </article>
<?php endwhile; else: ?>
  <p>No properties found.</p>
<?php endif; ?>

<?php get_footer(); ?>
