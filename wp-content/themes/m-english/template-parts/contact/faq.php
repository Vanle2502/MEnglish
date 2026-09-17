<?php $faqs=[
['Trường mầm non tư thục quy mô nhỏ dưới 50 học sinh có thể hợp tác không?','Có. M-English thiết kế các gói chuyển giao linh hoạt (Standard, Advanced, Premium) phù hợp với đa dạng quy mô từ trường nhóm lớp nhỏ đến các hệ thống mầm non lớn.'],
['Giáo viên mầm non của trường chưa giỏi tiếng Anh thì có đứng lớp M-English được không?','Hoàn toàn được. Giáo án M-English được đóng gói chi tiết tới từng phút kèm theo kịch bản lời thoại, file nghe bản xứ và video hướng dẫn mẫu, giúp mọi giáo viên mầm non đều đứng lớp trơn tru sau khóa tập huấn.'],
['Thời lượng tập huấn và chuyển giao chương trình kéo dài bao lâu?','Tổng thời lượng tập huấn tiêu chuẩn kéo dài từ 26 đến 34 giờ, kết hợp các module Online và Offline, giúp giáo viên làm chủ phương pháp và đứng lớp thực chiến ngay sau khóa học.'],
['M-English hỗ trợ nhà trường như thế nào sau khi đã hoàn tất chuyển giao?','M-English duy trì đồng hành định kỳ hàng tháng thông qua các buổi dự giờ, đánh giá chất lượng tiết dạy, hỗ trợ sinh hoạt chuyên môn trực tuyến và tư vấn các sự kiện Anh ngữ cho nhà trường.'],
]; ?>
<section class="contact-faq" aria-labelledby="faq-title"><div class="contact-faq__banner"><p>Câu hỏi thường gặp</p><h2 id="faq-title">GIẢI ĐÁP THẮC MẮC TRƯỚC KHI TRIỂN KHAI HỢP TÁC</h2></div><div class="container contact-faq__list">
<?php foreach($faqs as $i=>$faq): ?><article class="contact-faq__item"><h3><button type="button" aria-expanded="false" aria-controls="faq-answer-<?php echo $i; ?>"><span>Câu <?php echo $i+1; ?>: <?php echo esc_html($faq[0]); ?></span><i aria-hidden="true"></i></button></h3><div class="contact-faq__answer" id="faq-answer-<?php echo $i; ?>" hidden><p><?php echo esc_html($faq[1]); ?></p></div></article><?php endforeach; ?>
</div></section>
