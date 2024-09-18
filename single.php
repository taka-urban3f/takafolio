<?php get_header(); ?>

<main>
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>

            <div id="post-<?php the_ID(); ?>" <?php post_class('p-worksDetail'); ?>>
                <h2 class="p-worksDetail__heading"><?php the_title(); ?></h2>
                <div class="p-worksDetail__overViewCtn">
                    <div class="p-worksDetail__overViewImg">
                        <?php the_post_thumbnail('full'); ?>
                    </div>

                    <a class="p-worksDetail__SiteLink"><span class="p-worksDetail__SiteLink__caption">サイトを見る</span></a>
                </div>

                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</main>
</div>
<!-- .l-wrapperここまで -->

<?php get_footer(); ?>