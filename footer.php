<footer class="l-footer">
        <div class="l-wrapper">
            <div class="l-footer__ctn">
                <a href="<?php echo esc_url(site_url()); ?>"><span class="l-footer__title">TAKAFOLIO</span></a>
                <nav class="l-footer__fNav">
                    <ul class="l-footer__fNav__navList">
                        <li class="l-footer__fNav__item"><a href="#secWorks">works</a></li>
                        <li class="l-footer__fNav__item"><a href="#secSkill">skill</a></li>
                        <li class="l-footer__fNav__item"><a href="#secAbout">about</a></li>
                    </ul>
                </nav>
            </div>
            <div class="l-footer__ctn2">
                <a href="<?php the_permalink(get_page_by_path('credit')); ?>" class="l-footer__ctn2__linkCredit">このサイトで使用している画像に関するクレジット表記はこちら</a>
                <p class="l-footer__ctn2__copy">&copy;2024 Takahiro Izuhara</p>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>

</html>
