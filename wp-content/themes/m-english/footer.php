<footer class="site-footer">
    <div class="site-footer__panel">
        <div class="container site-footer__inner">
            <div class="site-footer__brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="M-English — Trang chủ"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/system/logo.png'); ?>" alt="M-English — Magic stories that sing" width="132" height="68"></a>
                <a class="site-footer__button" href="<?php echo m_english_page_url('lien-he'); ?>">Đặt lịch tư vấn ›</a>
            </div>
            <div><h2>Khám phá</h2><a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a><a href="<?php echo m_english_page_url('ve-m-english'); ?>">Về M-English</a><a href="<?php echo m_english_page_url('hop-tac'); ?>">Giải pháp hợp tác</a><a href="<?php echo m_english_page_url('lien-he'); ?>">Đối tác & Liên hệ</a></div>
            <div><h2>Sản phẩm</h2><a href="<?php echo m_english_page_url('he-sinh-thai'); ?>">Hệ sinh thái</a><a href="<?php echo m_english_page_url('he-sinh-thai/m-english'); ?>">M-English</a><a href="<?php echo m_english_page_url('he-sinh-thai/m-phonics'); ?>">M-Phonics</a><a href="<?php echo m_english_page_url('he-sinh-thai/m-cook'); ?>">M-Cook</a></div>
            <div><h2>Đào tạo</h2><a href="<?php echo m_english_page_url('he-sinh-thai/m-learning'); ?>">M-Learning</a><a href="<?php echo m_english_page_url('he-sinh-thai/m-intesol'); ?>">M-INTESOL</a><a href="<?php echo m_english_page_url('dao-tao'); ?>">INTESOL UK</a></div>
        </div>
        <p class="site-footer__copyright">© <?php echo esc_html(date('Y')); ?> M-English. All rights reserved.</p>
    </div>
</footer>
<?php wp_footer(); ?>
</body></html>
