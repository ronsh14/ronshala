<?php get_header(); ?>

<h1>Shop</h1>

<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$q = new WP_Query(array(
  'post_type' => 'clothing',
  'post_status' => 'publish',
  'posts_per_page' => 12,
  'paged' => $paged,
));

if ($q->have_posts()) {
  echo '<div class="product-grid">';
  while ($q->have_posts()) { $q->the_post();
    $price = get_post_meta(get_the_ID(),'price',true);
    $size = get_post_meta(get_the_ID(),'size',true);
    $color = get_post_meta(get_the_ID(),'color',true);
    ?>
    <article class="product-card">
      <a href="<?php the_permalink(); ?>">
        <?php if (has_post_thumbnail()) the_post_thumbnail('large'); else echo '<img src="https://via.placeholder.com/800x600?text=No+Image" alt="">'; ?>
        <div class="product-meta">
          <h3><?php the_title(); ?></h3>
          <?php if ($price) echo '<div class="price">$'.esc_html($price).'</div>'; ?>
          <?php if ($size || $color) echo '<div class="specs">'.esc_html($size).' &middot; '.esc_html($color).'</div>'; ?>
        </div>
      </a>
    </article>
  <?php }
  echo '</div>';
  the_posts_pagination();
  wp_reset_postdata();
} else {
  echo '<p>No items found.</p>';
}
?>

<?php get_footer(); ?>
