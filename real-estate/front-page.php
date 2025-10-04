<?php get_header(); ?>

<h2>Welcome to Our Real Estate Website</h2>
<p>Find your dream home with us.</p>

<h3>Latest Properties</h3>

<?php
$args = array('post_type' => 'property', 'posts_per_page' => 3);
$latest_properties = new WP_Query($args);

if ($latest_properties->have_posts()) :
  while ($latest_properties->have_posts()) : $latest_properties->the_post(); ?>
    <article>
      <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
      <?php if (has_post_thumbnail()) the_post_thumbnail('thumbnail'); ?>
    </article>
  <?php endwhile;
  wp_reset_postdata();
else : ?>
  <p>No properties found.</p>
<?php endif; ?>

<?php get_footer(); ?>
