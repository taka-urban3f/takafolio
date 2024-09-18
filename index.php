<?php get_header(); ?>
<main>
    <section class="p-secWorks" id="secWorks">
        <h2 class="c-headingSec">WORKS</h2>
        <ul class="p-secWorks__catList">
            <?php
            $cat_coding = get_category_by_slug('coding');
            $cat_coding_link = get_category_link($cat_coding->term_id);

            $cat_wdesign = get_category_by_slug('web-design');
            $cat_cat_wdesign_link = get_category_link($cat_wdesign->term_id);

            $cat_bdesign = get_category_by_slug('banner-design');
            $cat_bdesign_link = get_category_link($cat_bdesign->term_id);
            ?>
            <li class="p-secWorks__catList__item js_active_ctg"><a href="<?php echo esc_url(site_url()); ?>" class="js-do-barba">all</a></li>
            <li class="p-secWorks__catList__item"><a href="<?php echo esc_url($cat_coding_link); ?>" class="js-do-barba">coding</a></li>
            <li class="p-secWorks__catList__item"><a href="<?php echo esc_url($cat_cat_wdesign_link); ?>" class="js-do-barba">web design</a></li>
            <li class="p-secWorks__catList__item"><a href="<?php echo esc_url($cat_bdesign_link); ?>" class="js-do-barba">banner design</a></li>
        </ul>
        <div data-barba="container" data-barba-namespace="top">
            <div class="p-secWorks__grid">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>
                        <div class="p-secWorks__grid__item">
                            <a href="<?php the_permalink() ?>">
                                <div class="p-secWorks__imgCtn">
                                    <?php the_post_thumbnail('mv_thumbnail', 'class=p-secWorks__imgCtn__img') ?>
                                </div>
                                <p class="p-secWorks__grid__item__title"><?php the_title(); ?></p>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <!-- .p-secWorks__gridここまで -->

            <ol class="p-secWorks__pagination">
                <li class="p-secWorks__pagination__box">
                    <a href="" class="p-secWorks__pagination__link">&lt;</a>
                </li>
                <li class="p-secWorks__pagination__box p-secWorks__pagination__box--active">
                    <a href="" class="p-secWorks__pagination__link">1</a>
                </li>
                <li class="p-secWorks__pagination__box">
                    <a href="" class="p-secWorks__pagination__link">2</a>
                </li>
                <li class="p-secWorks__pagination__box">
                    <a href="" class="p-secWorks__pagination__link">3</a>
                </li>
                <li class="p-secWorks__pagination__box">
                    <a href="" class="p-secWorks__pagination__link">&gt;</a>
                </li>
            </ol>
        </div>
        <!-- data-barba="container"ここまで -->

    </section>
    <section class="p-secSkill" id="secSkill">
        <h2 class="c-headingSec">SKILL</h2>
        <div class="p-secSkill__grid">
            <div class="p-secSkill__grid__item">
                <div class="p-secSkill__grid__item__ctn">
                    <h3 class="p-secSkill__grid__item__heading">HTML/CSS</h3>
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logo/html.svg" alt="" class="p-secSkill__grid__item__img">
                    <img src="img/logo/css.svg" alt="" class="p-secSkill__grid__item__img">
                </div>
                <p class="p-secSkill__grid__item__text">一般的なサイトで使われる主要なタグやCSSプロパティを理解しており、正しい構造で記述できます。クラスの命名はBEMやFLOCSSに準拠しています。また、SASSが利用できます。</p>
            </div>
            <div class="p-secSkill__grid__item">
                <div class="p-secSkill__grid__item__ctn">
                    <h3 class="p-secSkill__grid__item__heading">JavaScript</h3>
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logo/js.svg" alt="" class="p-secSkill__grid__item__img">
                </div>
                <p class="p-secSkill__grid__item__text">各種イベントハンドラの記述や、DOM操作によるローディング画面表示や、スクロールアニメーションなどが可能。jQuery,Swiper,Slickの使用経験あり。</p>
            </div>
            <div class="p-secSkill__grid__item">
                <div class="p-secSkill__grid__item__ctn">
                    <h3 class="p-secSkill__grid__item__heading">WordPress</h3>
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logo/wp_mark.svg" alt="" class="p-secSkill__grid__item__img">
                </div>
                <p class="p-secSkill__grid__item__text">PHPによるクラシックテーマの作成が可能。プラグインによるカスタム投稿タイプ・カスタムタクソノミーの追加やパンくずリストの設置に対応できます。サブループによる一覧表示の調整等も可能。</p>
            </div>
            <div class="p-secSkill__grid__item">
                <div class="p-secSkill__grid__item__ctn">
                    <h3 class="p-secSkill__grid__item__heading">Git/GitHub</h3>
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logo/git.svg" alt="" class="p-secSkill__grid__item__img">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logo/github.svg" alt="" class="p-secSkill__grid__item__img">
                </div>
                <p class="p-secSkill__grid__item__text">ポートフォリオを作成する時にGitを利用し、基本的にローカルリポジトリのみで変更履歴の管理をしています。職業訓練中はチームでのWeb制作があり、GitHubにてリモートリポジトリを作成しファイルの編集を共有しました。<br>
                    チームでリモートリポジトリを扱う際は、同じファイルを同時に編集しないように、言葉でのコミュニケーションが不可欠でした。</p>
            </div>
        </div>
        <!-- .p-secSkill__gridここまで -->
    </section>
    <section class="p-secAbout" id="secAbout">
        <h2 class="c-headingSec">ABOUT</h2>
        <div class="p-secAbout__inner">
            <div class="p-secAbout__ctn">
                <div class="p-secAbout__ctn__block1">
                    <p class="p-secAbout__ctn__block1__text1">Web技術についてもっと色々知りたい、Webマニア予備軍。<br>
                        様々な技術を身に付け、社会貢献に活かしていきたいと思います！</p>
                    <p class="p-secAbout__ctn__block1__text2">イライラしにくい性格なので、<br>
                        粘り強く仕事に取り組む事が出来ます。<br>
                        また、人当たりが柔和なため、<br>
                        不必要に現場のストレスを高めません。</p>
                </div>
                <div class="p-secAbout__ctn__block2">
                    <span class="p-secAbout__ctn__block2__name">Takahiro Izuhara</span>
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/face.png" alt="" class="p-secAbout__ctn__block2__face">
                </div>
            </div>
        </div>
    </section>
</main>
</div>
<!-- .l-wrapperここまで -->
<?php get_footer(); ?>