<?php
/**
 * TypeRocket fields configuration for Career Detail
 */

add_action('edit_form_after_title', function($post) {
    if (!$post) return;

    $template_file = get_post_meta($post->ID, '_wp_page_template', true);
    $is_career_detail = (
        $post->post_type === 'career' || 
        $post->post_type === 'careers' ||
        basename(get_page_template()) == 'career-detail.php' ||
        $template_file == 'page-templates/career-detail.php' ||
        $template_file == 'career-detail.php'
    );

    if ($is_career_detail) {
        $form = tr_form();
        echo '<div class="typerocket-container">';

        // 1. Hero Section
        echo beginBox("1. Hero Banner", false);
        echo $form->text('career_hero_title')->setLabel("Tiêu đề công việc Hero (Mặc định: STEEL PRODUCTION ENGINEER)");
        echo $form->text('career_hero_breadcrumb')->setLabel("Tên vị trí trên Breadcrumb (Mặc định: Steel Production Engineer)");
        echo endBox();

        // 2. Job Info Sidebar (Thanh thông tin bên phải)
        echo beginBox("2. Job Info Sidebar (Thông tin tuyển dụng tóm tắt)", true);
        echo $form->row(
            $form->text('career_salary')->setLabel("Mức lương (Mặc định: Negotiate)"),
            $form->text('career_experience')->setLabel("Kinh nghiệm (Mặc định: 2 Years)")
        );
        echo $form->row(
            $form->text('career_quantity')->setLabel("Số lượng tuyển (Mặc định: 02)"),
            $form->text('career_deadline')->setLabel("Hạn nộp hồ sơ (Mặc định: 20/10/2026)")
        );
        echo endBox();

        // 3. Job Details Content (Nội dung chi tiết)
        echo beginBox("3. Job Details (Nội dung mô tả công việc)", true);
        echo $form->text('career_obj_title')->setLabel("Tiêu đề mục 1 (Mặc định: Job Objective)");
        echo $form->textarea('career_obj_desc')->setLabel("Nội dung mục 1 (Mục tiêu công việc)");

        echo "<hr>";
        echo $form->text('career_resp_title')->setLabel("Tiêu đề mục 2 (Mặc định: Key Responsibilities)");
        echo $form->editor('career_resp_content')->setLabel("Nội dung mục 2 (Trách nhiệm công việc)");

        echo "<hr>";
        echo $form->text('career_req_title')->setLabel("Tiêu đề mục 3 (Mặc định: Job Requirements)");
        echo $form->editor('career_req_content')->setLabel("Nội dung mục 3 (Yêu cầu công việc)");

        echo "<hr>";
        echo $form->text('career_prior_title')->setLabel("Tiêu đề mục 4 (Mặc định: Prioritize)");
        echo $form->editor('career_prior_content')->setLabel("Nội dung mục 4 (Ưu tiên)");

        echo "<hr>";
        echo $form->text('career_ben_title')->setLabel("Tiêu đề mục 5 (Mặc định: Benefit)");
        echo $form->editor('career_ben_content')->setLabel("Nội dung mục 5 (Quyền lợi)");
        echo endBox();

        echo '</div>';
    }
});
