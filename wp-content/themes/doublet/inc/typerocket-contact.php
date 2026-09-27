<?php
/**
 * TypeRocket fields configuration for Contact Page
 */

add_action('edit_form_after_title', function($post) {
    if (!$post || $post->post_type !== 'page') {
        return;
    }

    $template_file = get_post_meta($post->ID, '_wp_page_template', true);
    $is_contact = (
        basename(get_page_template()) == 'contact.php' ||
        $template_file == 'page-templates/contact.php' ||
        $template_file == 'contact.php'
    );

    if ($is_contact) {
        remove_post_type_support('page', 'editor');
        $form = tr_form();
        echo '<div class="typerocket-container">';

        // 1. Hero Section
        echo beginBox("1. Hero Section (Banner đầu trang)", false);
        echo $form->image('contact_hero_bg')->setLabel("Hình nền Banner Hero (Mặc định: commit-vison.jpg)");
        echo $form->text('contact_hero_breadcrumb')->setLabel("Breadcrumb trang hiện tại (Mặc định: contact)");
        echo $form->text('contact_hero_title')->setLabel("Tiêu đề Hero (Mặc định: CONTACT US)");
        echo endBox();

        // 2. Company Information
        echo beginBox("2. Company Information (Thông tin liên hệ)", true);
        echo $form->text('contact_info_label')->setLabel("Nhãn phụ (Mặc định: DOUBLE T METAL CO.,LTD)");
        echo $form->text('contact_info_title')->setLabel("Tiêu đề chính (Mặc định: Our Company Information)");

        echo $form->text('contact_hq_title')->setLabel("Tên Trụ sở chính (Mặc định: HEADQUARTERS)");
        echo $form->textarea('contact_hq_address')->setLabel("Địa chỉ Trụ sở chính");
        echo $form->text('contact_hq_phone')->setLabel("Số điện thoại Trụ sở chính");

        echo $form->text('contact_hcm_title')->setLabel("Tên Văn phòng HCM (Mặc định: HO CHI MINH OFFICE)");
        echo $form->textarea('contact_hcm_address')->setLabel("Địa chỉ Văn phòng HCM");
        echo $form->text('contact_hcm_email')->setLabel("Email liên hệ (Mặc định: 2t@2tsteel.com)");
        echo $form->text('contact_hcm_phone')->setLabel("Số điện thoại Văn phòng HCM");

        echo $form->text('contact_social_title')->setLabel("Tiêu đề khối Mạng xã hội (Mặc định: SOCIAL NETWORK)");
        echo $form->row(
            $form->text('contact_facebook_url')->setLabel("Link Facebook"),
            $form->text('contact_instagram_url')->setLabel("Link Instagram")
        );
        echo $form->row(
            $form->text('contact_x_url')->setLabel("Link X (Twitter)"),
            $form->text('contact_youtube_url')->setLabel("Link YouTube")
        );
        echo endBox();

        // 3. Contact Form Text
        echo beginBox("3. Form Notes & Text (Nội dung form)", true);
        echo $form->textarea('contact_form_privacy')->setLabel("Cam kết bảo mật form (Mặc định: We are committed to maintaining the confidentiality...)");
        echo $form->row(
            $form->text('contact_form_submit_btn')->setLabel("Text nút gửi (Mặc định: SEND INFORMATION)"),
            $form->text('contact_form_submit_note')->setLabel("Ghi chú dưới nút gửi (Mặc định: You will receive a confirmation email shortly.)")
        );
        echo endBox();

        // 4. Google Maps
        echo beginBox("4. Google Maps Embed (Bản đồ)", true);
        echo $form->textarea('contact_map_iframe_src')->setLabel("Link URL src nhúng Google Maps iframe");
        echo endBox();

        echo '</div>';
    }
});
