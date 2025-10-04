<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <article>
    <h2><?php the_title(); ?></h2>
    <?php if (has_post_thumbnail()) {
        the_post_thumbnail('large');
    } ?>
    <div>
      <?php the_content(); ?>
    </div>

    <h3>Property Details</h3>
    <ul>
      <li>Price: <?php echo get_post_meta(get_the_ID(), 'price', true); ?></li>
      <li>Location: <?php echo get_post_meta(get_the_ID(), 'location', true); ?></li>
      <li>Bedrooms: <?php echo get_post_meta(get_the_ID(), 'bedrooms', true); ?></li>
      <li>Bathrooms: <?php echo get_post_meta(get_the_ID(), 'bathrooms', true); ?></li>
    </ul>
  </article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
