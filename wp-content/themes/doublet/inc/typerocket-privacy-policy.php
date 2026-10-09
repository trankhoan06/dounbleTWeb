<?php
/**
 * TypeRocket fields configuration for Privacy Policy Page
 */

add_action('edit_form_after_title', function($post) {
    if (!$post || $post->post_type !== 'page') {
        return;
    }

    $template_file = get_post_meta($post->ID, '_wp_page_template', true);
    $is_privacy_policy = (
        basename(get_page_template()) == 'privacy-policy.php' ||
        $template_file == 'page-templates/privacy-policy.php' ||
        $template_file == 'privacy-policy.php'
    );

    if ($is_privacy_policy) {
        // Giữ lại editor mặc định của WordPress để viết nội dung
        $form = tr_form();
        echo '<div class="typerocket-container">';

        echo beginBox("Cấu hình Chính sách bảo mật", false);
        echo $form->text('privacy_title')->setLabel("Tiêu đề trang (Để trống sẽ lấy tiêu đề trang mặc định)")->setAttribute('placeholder', 'Nhập tiêu đề trang...');
        echo endBox();

        echo '</div>';
    }
});
