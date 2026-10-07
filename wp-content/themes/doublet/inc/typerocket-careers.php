<?php
/**
 * TypeRocket fields configuration for Careers Page
 */

add_action('edit_form_after_title', function($post) {
    if (!$post || $post->post_type !== 'page') {
        return;
    }

    $template_file = get_post_meta($post->ID, '_wp_page_template', true);
    $is_careers = (
        basename(get_page_template()) == 'careers.php' ||
        $template_file == 'page-templates/careers.php' ||
        $template_file == 'careers.php'
    );

    if ($is_careers) {
        remove_post_type_support('page', 'editor');
        $form = tr_form();
        echo '<div class="typerocket-container">';

        // 1. Hero Section
        echo beginBox("1. Hero Section (Banner đầu trang)", false);
        echo $form->image('careers_hero_bg')->setLabel("Hình nền Banner Hero (Mặc định: product-banner.jpg)");
        echo $form->text('careers_hero_breadcrumb')->setLabel("Breadcrumb trang hiện tại (Mặc định: Careers)");
        echo $form->text('careers_hero_title')->setLabel("Tiêu đề Hero (Mặc định: JOB OPPORTUNITIES)");
        echo endBox();

        // 2. Working Environment Gallery Section
        echo beginBox("2. Working Environment (Giới thiệu & Bộ ảnh môi trường làm việc)", true);
        echo $form->textarea('careers_intro_desc')->setLabel("Đoạn mô tả giới thiệu môi trường làm việc");
        echo $form->row(
            $form->image('careers_gallery_img_1')->setLabel("Ảnh 1 (Dọc cao bên trái)"),
            $form->image('careers_gallery_img_2')->setLabel("Ảnh 2 (Ngang rộng góc trên)")
        );
        echo $form->row(
            $form->image('careers_gallery_img_3')->setLabel("Ảnh 3 (Góc dưới bên trái)"),
            $form->image('careers_gallery_img_4')->setLabel("Ảnh 4 (Góc dưới bên phải có con số)")
        );
        echo $form->text('careers_gallery_stat_number')->setLabel("Con số hiển thị trên ảnh 4 (Mặc định: 20+)");
        echo $form->gallery('careers_gallery_extra')->setLabel("Danh sách ảnh album phụ thêm (Sẽ được ẩn trên giao diện nhưng hiện lên khi xem slide ảnh)");
        echo endBox();

        // 3. Job Openings Section
        echo beginBox("3. Job Openings (Cơ hội nghề nghiệp & Tiêu đề bảng tuyển dụng)", true);
        echo $form->text('careers_openings_label')->setLabel("Nhãn phụ (Mặc định: JOB OPENINGS)");
        echo $form->text('careers_openings_title')->setLabel("Tiêu đề chính (Mặc định: Career Development)");
        echo $form->row(
            $form->text('careers_th_position')->setLabel("Tiêu đề cột 1 (Mặc định: POSITION)"),
            $form->text('careers_th_location')->setLabel("Tiêu đề cột 2 (Mặc định: LOCATION)"),
            $form->text('careers_th_deadline')->setLabel("Tiêu đề cột 3 (Mặc định: DEADLINE)")
        );
        echo endBox();

        // 4. Cultural Stats Banner
        echo beginBox("4. Success Stats Banner (Thống kê Together We Build Success)", true);
        echo $form->text('careers_success_title')->setLabel("Tiêu đề chính (Hỗ trợ HTML, Mặc định: Together We Build<br><span class=\"careers-success-accent\">Success</span>)");
        echo $form->image('careers_success_bg')->setLabel("Hình nền nhà máy (Mặc định: hero-img.jpg)");
        echo $form->repeater('careers_success_stats')->setLabel("Các con số thống kê (Nếu để trống sẽ lấy 3 con số mặc định)")->setFields([
            $form->row(
                $form->text('number')->setLabel("Con số (VD: 10+, 100+, 2)"),
                $form->text('label')->setLabel("Nhãn mô tả (VD: Year of Development, Human Resources, Branch)")
            )
        ]);
        echo endBox();

        echo '</div>';
    }
});
