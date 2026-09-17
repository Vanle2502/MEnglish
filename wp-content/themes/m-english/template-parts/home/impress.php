<section class="home-impress">
    <div class="home-impress__banner">
        <p>Khung phương pháp</p>
        <h2>IMPRESS — 7 THÀNH PHẦN CỐT LÕI</h2>
    </div>
    <div class="container home-impress__grid">
        <?php $items = [['I', 'Identity', 'Nuôi dưỡng căn tính và bản sắc Việt qua câu chuyện, âm nhạc và chất liệu văn hóa gần gũi.'], ['M', 'Music', 'Âm nhạc kích hoạt cảm xúc tiếp nhận ngôn ngữ tự nhiên.'], ['P', 'Performance', 'Giải phóng hình thể, tự tin biểu diễn trên sân khấu lớp học.'], ['R', 'Routine', 'Chuyển tiếp hoạt động nhịp nhàng qua bài hát và giai điệu.'], ['E', 'Emotions', 'Nuôi dưỡng cảm xúc tích cực — không ép học vẹt.'], ['S', 'Stories', 'Thế giới truyện kể độc quyền chạm trái tim trẻ nhỏ.'], ['S', 'Self-Expression', 'Khơi dậy khao khát tự do thể hiện bản thân bằng tiếng Anh.']];
        foreach ($items as $item) : ?>
            <div class="home-impress__item" data-pan-scope>
                <div class="home-impress__badge">
                    <span class="home-impress__circle" data-pan-part style="--pan-delay: 0ms;" aria-hidden="true"></span>
                    <span class="home-impress__letter" data-pan-part style="--pan-delay: 90ms;"><?php echo esc_html($item[0]); ?></span>
                </div>
                <div>
                    <h3 data-pan-part style="--pan-delay: 170ms;"><?php echo esc_html($item[1]); ?></h3>
                    <p data-pan-part style="--pan-delay: 250ms;"><?php echo esc_html($item[2]); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
