<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <article class="single-item">
    <h1><?php the_title(); ?></h1>
    <?php
      $price = get_post_meta(get_the_ID(),'price',true);
      $size = get_post_meta(get_the_ID(),'size',true);
      $color = get_post_meta(get_the_ID(),'color',true);
      $gallery = get_post_meta(get_the_ID(),'gallery_images',true);
      $contact = get_post_meta(get_the_ID(),'contact_email',true);
    ?>
    <div style="margin-bottom:1em;">
      <?php if ($price) echo '<strong>Price:</strong> $'.esc_html($price).' &nbsp;'; ?>
      <?php if ($size) echo '<strong>Size:</strong> '.esc_html($size).' &nbsp;'; ?>
      <?php if ($color) echo '<strong>Color:</strong> '.esc_html($color); ?>
    </div>

    <?php if (!empty($gallery) && is_array($gallery)) : ?>
      <div class="gallery">
        <?php foreach ($gallery as $img_id) { echo wp_get_attachment_image($img_id, 'large'); } ?>
      </div>
    <?php else: ?>
      <?php if (has_post_thumbnail()) the_post_thumbnail('large'); ?>
    <?php endif; ?>

    <div class="content" style="margin-top:1em;"><?php the_content(); ?></div>

    <?php if ($contact) : ?>
      <div style="margin-top:1.2em; padding:0.8em; background:#f9f9f9; border-radius:8px;">
        <strong>Seller contact:</strong> <?php echo esc_html($contact); ?>
      </div>
    <?php endif; ?>
  </article>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
