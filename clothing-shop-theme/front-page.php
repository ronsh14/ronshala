<?php get_header(); ?>

<section class="hero">
  <h2>Sell Your Clothes — Fast & Easy</h2>
  <p style="color:rgba(255,255,255,0.95)">Submit your clothing items for sale. Listings are reviewed before publishing.</p>
</section>

<?php echo do_shortcode('[cs_submission_message]'); ?>

<section class="item-form" aria-label="submit clothing form">
  <h2>Submit Clothing Item</h2>

  <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="cs_submit_item">
    <?php wp_nonce_field('cs_submit_action', 'cs_submit_nonce'); ?>

    <label for="item_title">* Item Title</label>
    <input type="text" id="item_title" name="item_title" required>

    <label for="item_price">Price ($)</label>
    <input type="number" id="item_price" name="item_price" step="0.01">

    <label for="item_size">Size</label>
    <select id="item_size" name="item_size">
      <option value="">Select size</option>
      <option>XS</option>
      <option>S</option>
      <option>M</option>
      <option>L</option>
      <option>XL</option>
    </select>

    <label for="item_color">Color</label>
    <input type="text" id="item_color" name="item_color">

    <label for="item_description">* Description</label>
    <textarea id="item_description" name="item_description" rows="5" required></textarea>

    <label for="item_images">Upload Images (multiple allowed)</label>
    <input type="file" id="item_images" name="item_images[]" accept="image/*" multiple>

    <label for="contact_email">Contact Email</label>
    <input type="email" id="contact_email" name="contact_email">

    <button type="submit">Submit Item</button>
  </form>
</section>

<section>
  <h2 style="margin-top:2em;">Latest Items</h2>
  <?php
    $recent = new WP_Query(array('post_type'=>'clothing','post_status'=>'publish','posts_per_page'=>8));
    if ($recent->have_posts()) : echo '<div class="product-grid">';
      while($recent->have_posts()) : $recent->the_post();
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
              <?php if ($size || $color) {
                echo '<div class="specs">';
                if ($size) echo esc_html($size).' ';
                if ($color) echo '&middot; '.esc_html($color);
                echo '</div>';
              } ?>
            </div>
          </a>
        </article>
      <?php endwhile;
      echo '</div>';
      wp_reset_postdata();
    else:
      echo '<p>No items published yet.</p>';
    endif;
  ?>
</section>

<?php get_footer(); ?>
