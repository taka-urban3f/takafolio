<?php get_header(); ?>

<main>
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>

            <div id="post-<?php the_ID(); ?>" <?php post_class('p-worksDetail'); ?>>
                <h2 class="p-worksDetail__heading"><?php the_title(); ?></h2>
                <div class="p-worksDetail__overViewCtn">
                    <?php
                    $url = get_field('site_url');
                    $hrefAttr = '';
                    if ($url != '') :
                        $hrefAttr = 'href="' . esc_url($url) . '"';
                    ?>
                        <div class="p-worksDetail__overViewImg">
                            <a <?php echo $hrefAttr; ?> target="_blank" rel="noopener noreferrer"><?php the_post_thumbnail('full'); ?></a>
                        </div>

                        <a <?php echo $hrefAttr; ?> target="_blank" rel="noopener noreferrer" class="p-worksDetail__SiteLink"><span class="p-worksDetail__SiteLink__caption">サイトを見る</span></a>
                    <?php else: ?>
                        <div class="p-worksDetail__overViewImg">
                            <?php the_post_thumbnail('full'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</main>
</div>
<!-- .l-wrapperここまで -->

<?php get_footer(); ?>