<?php get_header(); ?>


<div class="row g-4">
<div class="col-lg-7">
<section class="mb-4">
<div id="front-map" style="height:420px; border-radius:8px; overflow:hidden;"></div>
</section>


<section>
<h2 class="h5 mb-3">Latest properties</h2>
<?php
$args = array('post_type'=>'property','posts_per_page'=>6);
$loop = new WP_Query($args);
if ($loop->have_posts()):
echo '<div class="row row-cols-1 row-cols-md-2 g-3">';
while ($loop->have_posts()): $loop->the_post();
?>
<div class="col">
<div class="card h-100 shadow-sm">
<?php if (has_post_thumbnail()) : ?>
<img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" alt="<?php the_title_attribute(); ?>">
<?php endif; ?>
<div class="card-body">
<h3 class="h6 card-title mb-1"><a href="<?php the_permalink(); ?>" class="stretched-link text-dark text-decoration-none"><?php the_title(); ?></a></h3>
<p class="small text-muted mb-0"><?php echo get_post_meta(get_the_ID(),'price',true) ? '€'.esc_html(get_post_meta(get_the_ID(),'price',true)) : ''; ?></p>
</div>
</div>
</div>
<?php
endwhile;
echo '</div>';
else:
echo '<p>No properties yet.</p>';
endif;
wp_reset_postdata();
?>
</section>
</div>


<aside class="col-lg-5">
<div class="card sticky-top" style="top:1rem;">
<div class="card-body">
<h4 class="h6 mb-3">Search properties</h4>
<?php get_template_part('template-parts/property-search','form'); ?>
</div>
</div>
</aside>
</div>


<?php get_footer(); ?>