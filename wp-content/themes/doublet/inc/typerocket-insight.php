<?php
/**
 * TypeRocket fields configuration for Insight Page
 */

add_action('edit_form_after_title', function($post) {
    if (!$post || $post->post_type !== 'page') {
        return;
    }

    $template_file = get_post_meta($post->ID, '_wp_page_template', true);
    $is_insight = (
        basename(get_page_template()) == 'insight.php' ||
        $template_file == 'page-templates/insight.php' ||
        $template_file == 'insight.php'
    );

    if ($is_insight) {
        remove_post_type_support('page', 'editor');
        $form = tr_form();
        echo '<div class="typerocket-container">';

        // 1. Hero Section
        echo beginBox("1. Hero Section (Banner đầu trang)", false);
        echo $form->image('insight_hero_bg')->setLabel("Hình nền Banner Hero (Mặc định: commit-vison.jpg)");
        echo $form->text('insight_hero_breadcrumb')->setLabel("Breadcrumb trang hiện tại (Mặc định: Insight)");
        echo $form->text('insight_hero_title')->setLabel("Tiêu đề Hero (Mặc định: NEWS & OPERATIONS)");
        echo endBox();

        // 2. Insight Sections (Danh mục bài viết)
        echo beginBox("2. Insight Categories (Danh mục tin tức & bài viết)", true);
        echo $form->repeater('insight_categories')->setLabel("Danh sách các khối danh mục (Nếu để trống sẽ hiển thị 2 khối mặc định: MARKET NEWS & COMPANY OPERATIONS)")->setFields([
            $form->row(
                $form->text('tag')->setLabel("Tên danh mục (VD: MARKET NEWS)"),
                $form->text('slug')->setLabel("Mã định danh ID (VD: market-news)")
            ),
            $form->row(
                $form->text('view_all_text')->setLabel("Text nút xem tất cả (Mặc định: VIEW ALL)"),
                $form->text('view_all_link')->setLabel("Link nút xem tất cả (VD: ./insight-category.html?category=market-news)")
            ),
            $form->row(
                $form->text('featured_title')->setLabel("Bài viết nổi bật (Cột trái): Tiêu đề"),
                $form->text('featured_link')->setLabel("Bài viết nổi bật: Link")
            ),
            $form->image('featured_image')->setLabel("Bài viết nổi bật: Hình ảnh"),
            $form->textarea('featured_excerpt')->setLabel("Bài viết nổi bật: Tóm tắt"),
            $form->repeater('sub_articles')->setLabel("Danh sách bài viết phụ (Cột phải - lưới 2x2)")->setFields([
                $form->row(
                    $form->text('title')->setLabel("Tiêu đề bài viết phụ"),
                    $form->text('link')->setLabel("Link bài viết phụ")
                ),
                $form->image('image')->setLabel("Hình ảnh thumbnail")
            ])
        ]);
        echo endBox();

        echo '</div>';
    }
});
