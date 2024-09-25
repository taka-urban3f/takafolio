<?php get_header(); ?>

<main>
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>

            <div id="post-<?php the_ID(); ?>" <?php post_class('p-worksDetail'); ?>>
                <!-- カテゴリーの出力 -->
                <?php $cat_list = get_the_category();
                foreach ($cat_list as $cat) : ?>
                    <span class="p-worksDetail__cat">
                        <?php echo esc_html($cat->name); ?>
                    </span>
                <?php endforeach; ?>

                <h2 class="p-worksDetail__heading"><?php the_title(); ?></h2>
                <div class="p-worksDetail__overViewCtn">
                    <!-- カスタムフィールドにサイトURLが設定されている場合、リンクボタン作成。メイン画像にもリンクを張る -->
                    <?php
                    $url = get_field('site_url');
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

                    <!-- カスタムフィールドにコードへのURLが設定されている場合、リンクボタンを作成。 -->
                    <?php
                    $url = get_field('code_url');
                    if ($url != '') :
                        $hrefAttr = 'href="' . esc_url($url) . '"';
                    ?>
                        <a <?php echo $hrefAttr; ?> target="_blank" rel="noopener noreferrer" class="p-worksDetail__SiteLink"><span class="p-worksDetail__SiteLink__caption">コードを見る</span></a>
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