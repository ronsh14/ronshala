<?php get_header(); ?>

<h2>Latest Posts</h2>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <article>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php if (has_post_thumbnail()) {
                the_post_thumbnail('medium');
            } ?>
            <p><?php the_excerpt(); ?></p>
        </article>
    <?php endwhile; ?>

    <!-- Pagination -->
    <div class="pagination">
        <?php
        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => __('« Previous', 'real-estate-theme'),
            'next_text' => __('Next »', 'real-estate-theme'),
        ));
        ?>
    </div>

<?php else : ?>
    <p>No posts found.</p>
<?php endif; ?>

<?php get_footer(); ?>
