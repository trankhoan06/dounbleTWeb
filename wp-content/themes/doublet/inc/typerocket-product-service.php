<?php
/**
 * TypeRocket fields configuration for Product & Service Page
 */

add_action('edit_form_after_title', function($post) {
    if (!$post || $post->post_type !== 'page') {
        return;
    }

    $template_file = get_post_meta($post->ID, '_wp_page_template', true);
    $is_product_service = (
        basename(get_page_template()) == 'product-service.php' ||
        $template_file == 'page-templates/product-service.php' ||
        $template_file == 'product-service.php'
    );

    if ($is_product_service) {
        remove_post_type_support('page', 'editor');
        $form = tr_form();
        echo '<div class="typerocket-container">';

        // 1. Hero Section
        echo beginBox("1. Hero Section (Banner đầu trang)", false);
        echo $form->image('ps_hero_bg')->setLabel("Hình nền Banner Hero (Mặc định: product-banner.jpg)");
        echo $form->text('ps_hero_breadcrumb')->setLabel("Breadcrumb trang hiện tại (Mặc định: Product Service)");
        echo $form->text('ps_hero_title')->setLabel("Tiêu đề Hero (Mặc định: BUILT FOR INDUSTRY)");
        echo endBox();

        // 2. Product Range Section
        echo beginBox("2. Product Double T (Danh mục sản phẩm)", true);
        echo $form->text('ps_products_label')->setLabel("Nhãn phụ (Mặc định: PRODUCT DOUBLE T)");
        echo $form->text('ps_products_title')->setLabel("Tiêu đề chính (Hỗ trợ thẻ html <br>, Mặc định: Professional steel supplier<br>and processor.)");
        echo $form->row(
            $form->text('ps_products_btn_text')->setLabel("Text nút xem thêm (Mặc định: VIEW MORE)"),
            $form->text('ps_products_btn_link')->setLabel("Link nút xem thêm (Mặc định: #serviceCatalog)")
        );
        echo $form->repeater('ps_products_items')->setLabel("Danh sách sản phẩm (Nếu để trống sẽ hiển thị 6 sản phẩm mặc định)")->setFields([
            $form->row(
                $form->text('title')->setLabel("Tên sản phẩm"),
                $form->text('link')->setLabel("Link chi tiết sản phẩm")
            ),
            $form->image('image')->setLabel("Hình ảnh sản phẩm")
        ]);
        echo endBox();

        // 3. Manufacturing Capabilities Overview
        echo beginBox("3. Manufacturing Capabilities Overview (Tổng quan năng lực)", true);
        echo $form->text('ps_services_label')->setLabel("Nhãn phụ (Mặc định: SERVICES)");
        echo $form->text('ps_services_title')->setLabel("Tiêu đề chính (Hỗ trợ HTML, Mặc định: Manufacturing<br> Capabilities of <br><span>2T Metal Co., Ltd.</span>)");
        echo $form->textarea('ps_services_desc')->setLabel("Mô tả tổng quan");
        echo $form->text('ps_services_emphasis')->setLabel("Câu giới thiệu chi tiết bên dưới (Mặc định: Below is a detailed overview of Double T's professional manufacturing capabilities:)");
        echo $form->image('ps_services_img')->setLabel("Hình ảnh minh họa bên phải (Mặc định: home-service.webp)");
        echo endBox();

        // 4. Service Catalog
        echo beginBox("4. Service Catalog (Chi tiết các dây chuyền gia công & Dịch vụ)", true);
        echo $form->repeater('ps_service_catalog_items')->setLabel("Danh sách dịch vụ / Dây chuyền (Nếu để trống sẽ hiển thị 5 mục mặc định)")->setFields([
            $form->row(
                $form->text('tab_title')->setLabel("Tên Tab danh mục (VD: SLITTING LINE)"),
                $form->text('slug')->setLabel("ID liên kết Tab (VD: service-slitting, service-cut-to-length...)")
            ),
            $form->row(
                $form->text('title')->setLabel("Tiêu đề dây chuyền (VD: Slitting Line)"),
                $form->image('image')->setLabel("Hình ảnh minh họa")
            ),
            $form->editor('content')->setLabel("Nội dung chi tiết (Mô tả, chủng loại, thông số kỹ thuật, công nghệ...)"),
            $form->row(
                $form->text('btn_text')->setLabel("Text nút tư vấn (Mặc định: SERVICE CONSULTATION)"),
                $form->text('btn_link')->setLabel("Link nút tư vấn (Để trống hoặc # để mở Consultation Modal)")
            )
        ]);
        echo endBox();

        echo '</div>';
    }
});
