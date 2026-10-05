<?php
/**
 * TypeRocket fields configuration for Commitment Page
 */

add_action('edit_form_after_title', function($post) {
    if (!$post || $post->post_type !== 'page') {
        return;
    }

    $template_file = get_post_meta($post->ID, '_wp_page_template', true);
    $is_commitment = (
        basename(get_page_template()) == 'commitment.php' ||
        $template_file == 'page-templates/commitment.php' ||
        $template_file == 'commitment.php'
    );

    if ($is_commitment) {
        remove_post_type_support('page', 'editor');
        $form = tr_form();
        echo '<div class="typerocket-container">';

        // 1. Hero Section
        echo beginBox("1. Hero Section (Banner đầu trang)", false);
        echo $form->image('commit_hero_bg')->setLabel("Hình nền Banner Hero (Mặc định: commit-banner.jpg)");
        echo $form->text('commit_hero_breadcrumb')->setLabel("Breadcrumb trang hiện tại (Mặc định: Our Commitment)");
        echo $form->text('commit_hero_title')->setLabel("Tiêu đề Hero (Mặc định: ABOUT DOUBLE T)");
        echo endBox();

        // 2. Intro Section
        echo beginBox("2. Company Introduction (Giới thiệu công ty)", true);
        echo $form->text('commit_intro_label')->setLabel("Nhãn phụ (Mặc định: DOUBLE T METAL CO., LTD)");
        echo $form->text('commit_intro_title')->setLabel("Tiêu đề chính (Hỗ trợ HTML span, Mặc định: Introducing <span>Double T Co., LTD</span>)");
        echo $form->textarea('commit_intro_desc')->setLabel("Đoạn mô tả giới thiệu");
        echo $form->repeater('commit_intro_list')->setLabel("Các gạch đầu dòng danh sách sản phẩm (Nếu để trống sẽ dùng danh sách mặc định)")->setFields([
            $form->textarea('item')->setLabel("Nội dung dòng")
        ]);
        echo $form->image('commit_intro_img')->setLabel("Hình ảnh giới thiệu bên phải (Mặc định: commit-intro.jpg)");
        echo endBox();

        // 3. Capabilities Section
        echo beginBox("3. Manufacturing Capabilities (Năng lực gia công)", true);
        echo $form->text('commit_cap_label')->setLabel("Nhãn phụ (Mặc định: SERVICES)");
        echo $form->text('commit_cap_title')->setLabel("Tiêu đề chính (Mặc định: Advanced manufacturing<br> and processing capabilities)");
        echo $form->textarea('commit_cap_summary')->setLabel("Đoạn tóm tắt giới thiệu");
        echo $form->repeater('commit_cap_slides')->setLabel("Danh sách dây chuyền & năng lực gia công (Nếu để trống sẽ hiển thị 2 slide mặc định)")->setFields([
            $form->row(
                $form->text('number')->setLabel("Số thứ tự (VD: 01)"),
                $form->text('title')->setLabel("Tên dây chuyền (VD: Slitting Line)")
            ),
            $form->image('image')->setLabel("Hình ảnh minh họa"),
            $form->row(
                $form->text('types_label')->setLabel("Nhãn chủng loại (VD: Chủng loại thép gia công:)"),
                $form->textarea('types_text')->setLabel("Nội dung chủng loại thép")
            ),
            $form->row(
                $form->text('specs_label')->setLabel("Nhãn thông số kỹ thuật (VD: Thông số kỹ thuật:)"),
                $form->textarea('specs_text')->setLabel("Nội dung thông số (mỗi dòng một ý)")
            ),
            $form->row(
                $form->text('tech_label')->setLabel("Nhãn công nghệ (VD: Điểm nhấn công nghệ:)"),
                $form->textarea('tech_text')->setLabel("Nội dung điểm nhấn công nghệ")
            ),
            $form->row(
                $form->text('btn_text')->setLabel("Text nút tư vấn (VD: SERVICE CONSULTATION)"),
                $form->text('btn_link')->setLabel("Link nút tư vấn (Để trống hoặc # để mở Consultation Modal)")
            )
        ]);
        echo endBox();

        // 4. Mission & Vision Section
        echo beginBox("4. Mission & Vision (Sứ mệnh & Tầm nhìn)", true);
        echo $form->text('commit_mv_label')->setLabel("Nhãn phụ (Mặc định: MISSION & VISION)");
        echo $form->text('commit_mv_title')->setLabel("Tiêu đề chính (Hỗ trợ HTML, Mặc định: Our Mission <span class=\"commit-mission-vision-title-tail\">&amp; Vision</span>)");
        echo $form->image('commit_mission_img')->setLabel("Hình ảnh minh họa Mission (Mặc định: commit-vison.jpg)");
        echo $form->text('commit_mission_title')->setLabel("Tiêu đề khối Mission (Mặc định: MISSION)");
        echo $form->repeater('commit_mission_items')->setLabel("Danh sách các mục Sứ mệnh (Nếu để trống sẽ lấy 3 mục mặc định)")->setFields([
            $form->textarea('icon')->setLabel("Mã SVG Icon (Tùy chọn)"),
            $form->text('title')->setLabel("Tiêu đề mục (VD: FOR CUSTOMERS)"),
            $form->textarea('desc')->setLabel("Nội dung mô tả")
        ]);

        echo $form->row(
            $form->image('commit_vision_logo')->setLabel("Logo Vision (Mặc định: logo.png)"),
            $form->image('commit_vision_bg')->setLabel("Hình nền khối Logo (Mặc định: commit-vison-bg.jpg)")
        );
        echo $form->text('commit_vision_title')->setLabel("Tiêu đề khối Vision (Mặc định: VISION)");
        echo $form->textarea('commit_vision_desc')->setLabel("Nội dung Tầm nhìn");
        echo endBox();

        echo '</div>';
    }
});
