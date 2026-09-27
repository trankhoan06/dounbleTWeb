<?php
/**
 * TypeRocket fields configuration for Insight Detail (Single Post)
 */

add_action('edit_form_after_title', function($post) {
    if (!$post || $post->post_type !== 'post') {
        return;
    }

    $form = tr_form();
    echo '<div class="typerocket-container">';

    // 1. Hero Section
    echo beginBox("1. Hero Banner (Đầu bài viết)", false);
    echo $form->image('insight_hero_img')->setLabel("Hình ảnh Hero bên phải (Mặc định: Ảnh đại diện bài viết hoặc hero-img.jpg)");
    echo $form->text('insight_hero_title')->setLabel("Tiêu đề Hero tùy chỉnh (Để trống sẽ tự động lấy tiêu đề bài viết)");
    echo endBox();

    // 2. Article Intro / Sapo
    echo beginBox("2. Article Intro / Sapo (Dẫn nhập)", true);
    echo $form->image('insight_featured_img')->setLabel("Hình ảnh nổi bật đầu bài viết (Desktop) - Để trống lấy thumbnail bài viết");
    echo $form->textarea('insight_sapo')->setLabel("Đoạn Sapo / Headline in đậm mở đầu (Để trống lấy Excerpt bài viết hoặc nội dung mẫu)");
    echo endBox();

    // 3. Article Sections with Table of Contents (TOC)
    echo beginBox("3. Article Sections & TOC (Các mục nội dung và Mục lục)", true);
    echo "<p><em>Ghi chú: Nếu nhập các mục dưới đây, hệ thống sẽ tự động hiển thị nội dung và tạo Mục lục (Table of Contents) cuộn mượt. Nếu để trống, hệ thống sẽ sử dụng trình soạn thảo bài viết tiêu chuẩn (WordPress Content Editor) hoặc nội dung mẫu.</em></p>";
    echo $form->repeater('insight_sections')->setLabel("Danh sách các mục nội dung (Sections)")->setFields([
        $form->text('title')->setLabel("Tiêu đề mục (Hiển thị thẻ H3 & Xuất hiện trong Mục lục)"),
        $form->editor('content')->setLabel("Nội dung bài viết của mục này"),
        $form->row(
            $form->image('image')->setLabel("Hình ảnh minh họa kèm theo (Tùy chọn)"),
            $form->text('caption')->setLabel("Chú thích hình ảnh (Caption)")
        ),
        $form->text('headline_after')->setLabel("Tiêu đề phụ lớn tiếp theo (Tùy chọn - Headline đặt giữa các phần)")
    ]);
    echo endBox();

    echo '</div>';
});
