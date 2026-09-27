<?php
/**
 * TypeRocket fields configuration for Product Service Detail Page
 */

add_action('edit_form_after_title', function($post) {
    if (!$post) {
        return;
    }

    $template_file = get_post_meta($post->ID, '_wp_page_template', true);
    $is_psd = (
        $post->post_type === 'product-and-service' ||
        $post->post_type === 'productandservice' ||
        $post->post_type === 'product-service' ||
        $post->post_type === 'product_service' ||
        basename(get_page_template()) == 'product-service-detail.php' ||
        $template_file == 'page-templates/product-service-detail.php' ||
        $template_file == 'product-service-detail.php'
    );

    if ($is_psd) {
        if ($post->post_type === 'page') {
            remove_post_type_support('page', 'editor');
        }
        $form = tr_form();
        echo '<div class="typerocket-container">';

        // 1. Hero Section
        echo beginBox("1. Hero Section (Banner đầu trang)", false);
        echo $form->image('psd_hero_img')->setLabel("Hình ảnh Hero bên phải (Mặc định: hero-img.jpg)");
        echo $form->text('psd_hero_breadcrumb')->setLabel("Breadcrumb tên sản phẩm (Mặc định: Hot Rrolled - HR/ Hot Rolled Pickled and oiled - hrpo)");
        echo $form->text('psd_hero_title')->setLabel("Tiêu đề chính (Hỗ trợ HTML <br>, Mặc định: HOT ROLLED - HR/ HOT ROLLED<br>PICKLED AND OILED - HRPO)");
        echo endBox();

        // 2. Specification Section
        echo beginBox("2. Specifications (Thông số kỹ thuật & Tiêu chuẩn)", true);
        echo $form->text('psd_spec_label')->setLabel("Nhãn phụ (Mặc định: SPECIFICATION)");
        echo $form->repeater('psd_spec_items')->setLabel("Danh sách các tiêu chuẩn (Nếu để trống sẽ hiển thị 6 tiêu chuẩn mặc định)")->setFields([
            $form->text('title')->setLabel("Tên tiêu chuẩn (VD: JIS G3131 SPHC/D/E/F)"),
            $form->textarea('desc')->setLabel("Đặc điểm chi tiết")
        ]);
        echo $form->image('psd_spec_visual_img')->setLabel("Hình ảnh lớn bên phải (Mặc định: product-detail.webp)");
        echo $form->repeater('psd_spec_card_rows')->setLabel("Bảng thông số nổi trên hình (Floating Card)")->setFields([
            $form->row(
                $form->text('label')->setLabel("Tên thông số (VD: Thickness:)"),
                $form->text('value')->setLabel("Giá trị thông số (VD: 1.40 - 6.50mm)")
            )
        ]);
        echo endBox();

        // 3. Application Examples Section
        echo beginBox("3. Application Examples (Ứng dụng thực tế)", true);
        echo $form->text('psd_app_label')->setLabel("Nhãn phụ (Mặc định: APPLICATION EXAMPLES)");
        echo $form->textarea('psd_app_desc')->setLabel("Mô tả ngắn (Mặc định: Thanks to its superior mechanical properties...)");
        echo $form->repeater('psd_app_items')->setLabel("Danh sách các ứng dụng (Nếu để trống sẽ hiển thị 6 ứng dụng mặc định)")->setFields([
            $form->text('title')->setLabel("Tên ứng dụng (VD: Manufacturing vehicle wheel rims)"),
            $form->image('image')->setLabel("Hình ảnh ứng dụng")
        ]);
        echo endBox();

        // 4. Other Products Section
        echo beginBox("4. Other Products (Sản phẩm khác)", true);
        echo $form->text('psd_other_label')->setLabel("Nhãn phụ (Mặc định: OTHER PRODUCTS)");
        echo $form->repeater('psd_other_items')->setLabel("Danh sách sản phẩm khác (Nếu để trống sẽ hiển thị 5 sản phẩm mặc định)")->setFields([
            $form->row(
                $form->text('title')->setLabel("Tên sản phẩm"),
                $form->text('link')->setLabel("Link sản phẩm")
            ),
            $form->image('image')->setLabel("Hình ảnh sản phẩm")
        ]);
        echo endBox();

        echo '</div>';
    }
});
