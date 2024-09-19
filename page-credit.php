<?php get_header(); ?>

<main>
    <div class="p-credit">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : ?>
                <?php the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</main>
</div>
<!-- .l-wrapperここまで -->

<?php get_footer(); ?>