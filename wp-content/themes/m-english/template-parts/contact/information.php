<?php $cards=[
['Hotline<br>Tư vấn & Hợp tác','Số điện thoại: [Điền số Hotline chính thức]','Hỗ trợ Zalo/Viber 24/7'],
['Email Chuyên môn','Email: [Điền địa chỉ Email chính thức]','Hỗ trợ giải đáp thắc mắc chuyên môn và tiếp nhận hồ sơ hợp tác.'],
['Văn phòng Trụ sở chính','Địa chỉ: S4S Building, 18 Đ. Thánh Gióng, Đông Hòa, Hồ Chí Minh','Tiếp đón đối tác ghé thăm và trải nghiệm trực tiếp hệ thống giáo cụ handmade.'],
['Thời gian làm việc','Thứ Hai – Thứ Bảy<br>08:00 – 17:30<br>Chủ Nhật: Nghỉ','(Hỗ trợ tư vấn khẩn cấp qua Hotline/Zalo)'],
]; ?>
<section class="contact-information" aria-labelledby="contact-information-title">
    <div class="container">
        <div class="contact-information__photo-wrap"><img src="<?php echo m_english_contact_image('mascot-team-boy.png'); ?>" alt="" class="contact-information__mascot contact-information__mascot--left"><img src="<?php echo m_english_contact_image('contact-team.png'); ?>" alt="Đội ngũ M-English" class="contact-information__photo"><img src="<?php echo m_english_contact_image('mascot-contact-bus.png'); ?>" alt="" class="contact-information__mascot contact-information__mascot--right"></div>
        <div class="contact-heading"><p>Kết nối trực tiếp</p><h2 id="contact-information-title">ĐỊA CHỈ &amp; KÊNH THÔNG TIN<br>CHÍNH THỨC M-ENGLISH</h2><div>Điền thông tin bên dưới để nhận Catalogue, Bảng giá chi tiết và<br>được xếp lịch tư vấn trực tiếp cùng Chuyên gia M-English trong vòng 24 giờ</div></div>
        <div class="contact-information__grid"><?php foreach($cards as $card): ?><article><h3><?php echo wp_kses($card[0],['br'=>[]]); ?></h3><p><?php echo wp_kses($card[1],['br'=>[]]); ?></p><small><?php echo wp_kses($card[2],['br'=>[]]); ?></small></article><?php endforeach; ?></div>
    </div>
</section>
