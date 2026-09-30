<?php
/**
 * TypeRocket fields configuration for Home Page
 */

add_action('edit_form_after_title', function($post) {
    if (!$post || $post->post_type !== 'page') {
        return;
    }
    
    $template_file = get_post_meta($post->ID, '_wp_page_template', true);
    $is_home = (
        basename(get_page_template()) == 'index.php' ||
        $template_file == 'page-templates/index.php' ||
        $template_file == 'index.php' ||
        get_option('page_on_front') == $post->ID
    );

    if ($is_home) {
        remove_post_type_support('page', 'editor');
        $form = tr_form();
        echo '<div class="typerocket-container">';

        // 1. Hero Section
        echo beginBox("1. Hero Section (Banner đầu trang)", false);
        echo $form->image('home_hero_bg')->setLabel("Hình nền Hero (Để trống sẽ dùng ảnh mặc định)");
        echo $form->text('home_hero_scroll_text')->setLabel("Chữ Scroll Down (Mặc định: Scroll Down)");
        echo endBox();

        // 2. Future Section
        echo beginBox("2. Future Section (Giới thiệu & Tầm nhìn)", true);
        echo $form->text('home_future_label')->setLabel("Nhãn phụ (Mặc định: BUILDING TOMORROW)");
        echo $form->text('home_future_title')->setLabel("Tiêu đề chính (Hỗ trợ thẻ html span, mặc định: Embrace the future with <span class=\"txt-primary\">Double</span> <span class=\"txt-secodary\">T</span>)");
        echo $form->textarea('home_future_desc')->setLabel("Đoạn văn giới thiệu");
        echo $form->row(
            $form->text('home_future_btn_text')->setLabel("Text nút bấm (Mặc định: READMORE)"),
            $form->text('home_future_btn_link')->setLabel("Link nút bấm (Mặc định: #)")
        );
        echo $form->image('home_future_logo')->setLabel("Hình Logo Future ở tâm (Mặc định: logo_future.png)");
        echo endBox();

        // 3. Video Section
        echo beginBox("3. Video Section", true);
        echo $form->image('home_video_thumb')->setLabel("Ảnh Poster / Thumbnail Video");
        echo $form->text('home_video_youtube_url')->setLabel("YouTube URL (VD: https://www.youtube.com/watch?v=... hoặc https://youtu.be/...)");
        echo $form->file('home_video_file')->setLabel("Upload File Video (.mp4)");
        echo $form->text('home_video_url')->setLabel("Hoặc nhập trực tiếp URL Video (.mp4)");
        echo endBox();

        // 4. Product Section
        echo beginBox("4. Product Section (Sản phẩm nổi bật)", true);
        echo $form->text('home_product_label')->setLabel("Nhãn phụ (Mặc định: PRODUCT DOUBLE T)");
        echo $form->text('home_product_title')->setLabel("Tiêu đề chính (Mặc định: Professional steel supplier and processor.)");
        echo $form->row(
            $form->text('home_product_btn_text')->setLabel("Text nút Xem tất cả (Mặc định: VIEW ALL PRODUCTS)"),
            $form->text('home_product_btn_link')->setLabel("Link nút Xem tất cả")
        );
        echo $form->repeater('home_product_items')->setLabel("Danh sách sản phẩm nổi bật (Kéo thả sắp xếp, nếu chưa nhập sẽ lấy danh sách mẫu mặc định)")->setFields([
            $form->row(
                $form->text('title')->setLabel("Tên sản phẩm"),
                $form->text('link')->setLabel("Link sản phẩm")
            ),
            $form->image('image')->setLabel("Hình ảnh sản phẩm")
        ]);
        echo endBox();

        // 5. Manufacturing Capabilities
        echo beginBox("5. Manufacturing Capabilities (Năng lực gia công / Dịch vụ)", true);
        echo $form->image('home_service_top_img')->setLabel("Hình ảnh đại diện phía trên");
        echo $form->text('home_service_label')->setLabel("Nhãn phụ (Mặc định: BUILDING TOMORROW)");
        echo $form->text('home_service_title')->setLabel("Tiêu đề chính (Mặc định: Manufacturing Capabilities of <br><span class=\"txt-primary\">2T Metal Co., Ltd.</span>)");
        echo $form->textarea('home_service_desc')->setLabel("Mô tả tổng quan");
        echo $form->row(
            $form->text('home_service_btn_text')->setLabel("Text nút Xem tất cả (Mặc định: VIEW ALL SERVICES)"),
            $form->text('home_service_btn_link')->setLabel("Link nút Xem tất cả")
        );
        echo $form->repeater('home_service_slides')->setLabel("Danh sách Dây chuyền & Dịch vụ (Nếu chưa nhập sẽ hiển thị 2 slide mặc định)")->setFields([
            $form->row(
                $form->text('num')->setLabel("Số thứ tự (VD: 01)"),
                $form->text('tag')->setLabel("Tag nhãn (Mặc định: SERVICES)")
            ),
            $form->row(
                $form->text('title')->setLabel("Tên dây chuyền (VD: Slitting Line)"),
                $form->image('image')->setLabel("Hình ảnh minh họa")
            ),
            $form->row(
                $form->text('types_label')->setLabel("Nhãn chủng loại thép (VD: Chủng loại thép gia công:)"),
                $form->textarea('types_text')->setLabel("Nội dung chủng loại thép")
            ),
            $form->row(
                $form->text('specs_label')->setLabel("Nhãn thông số kỹ thuật (VD: Thông số kỹ thuật:)"),
                $form->textarea('specs_text')->setLabel("Nội dung thông số (mỗi dòng một gạch đầu dòng)")
            ),
            $form->row(
                $form->text('tech_label')->setLabel("Nhãn công nghệ (VD: Điểm nhấn công nghệ:)"),
                $form->textarea('tech_text')->setLabel("Nội dung điểm nhấn công nghệ")
            ),
            $form->row(
                $form->text('btn_text')->setLabel("Text nút tư vấn (VD: SERVICE CONSULTATION)"),
                $form->text('btn_link')->setLabel("Link nút tư vấn")
            )
        ]);
        echo endBox();

        // 6. Applications Section
        echo beginBox("6. Steel Applications (Ứng dụng thực tế)", true);
        echo $form->text('home_app_label')->setLabel("Nhãn phụ (Mặc định: 2T STEEL APPLICATIONS)");
        echo $form->text('home_app_title')->setLabel("Tiêu đề chính (Mặc định: Practical Production)");
        echo $form->repeater('home_app_items')->setLabel("Danh sách các Tab Ứng dụng (Nếu chưa nhập sẽ hiển thị 5 Tab mặc định)")->setFields([
            $form->text('tab_title')->setLabel("Tên Tab (VD: FACTORY & INDUSTRIAL)"),
            $form->row(
                $form->text('panel_title')->setLabel("Tiêu đề nội dung Tab"),
                $form->image('image')->setLabel("Hình ảnh minh họa")
            ),
            $form->textarea('panel_desc')->setLabel("Đoạn văn mô tả"),
            $form->row(
                $form->text('btn_text')->setLabel("Text nút xem thêm (Mặc định: EXPLORE SERVICES)"),
                $form->text('btn_link')->setLabel("Link nút xem thêm")
            ),
            $form->row(
                $form->image('feat1_icon')->setLabel("Icon đặc điểm 1"),
                $form->text('feat1_title')->setLabel("Tiêu đề 1 (VD: FLEXIBLE APERTURE)"),
                $form->text('feat1_desc')->setLabel("Mô tả 1 (VD: Suitable for various factory scales.)")
            ),
            $form->row(
                $form->image('feat2_icon')->setLabel("Icon đặc điểm 2"),
                $form->text('feat2_title')->setLabel("Tiêu đề 2 (VD: HIGH LOAD CAPACITY)"),
                $form->text('feat2_desc')->setLabel("Mô tả 2 (VD: Suitable for industrial environments.)")
            ),
            $form->row(
                $form->image('feat3_icon')->setLabel("Icon đặc điểm 3"),
                $form->text('feat3_title')->setLabel("Tiêu đề 3 (VD: QUICK INSTALLATION)"),
                $form->text('feat3_desc')->setLabel("Mô tả 3 (VD: Optimize construction time.)")
            )
        ]);
        echo endBox();

        // 7. Featured Media Section
        echo beginBox("7. Featured Media (Tin tức & Truyền thông)", true);
        echo $form->text('home_media_label')->setLabel("Nhãn phụ (Mặc định: NEWS EVENTS)");
        echo $form->text('home_media_title')->setLabel("Tiêu đề chính (Mặc định: Featured Media)");

        echo $form->row(
            $form->text('home_media_b1_tag')->setLabel("Khối 1: Tên khối (Mặc định: MARKET NEWS)"),
            $form->text('home_media_b1_link')->setLabel("Khối 1: Link Xem tất cả (View All)")
        );
        echo $form->repeater('home_media_b1_items')->setLabel("Khối 1: Danh sách bài viết MARKET NEWS (Nếu chưa nhập sẽ lấy bài viết mẫu mặc định)")->setFields([
            $form->row(
                $form->text('title')->setLabel("Tiêu đề bài viết"),
                $form->text('link')->setLabel("Link bài viết")
            ),
            $form->image('image')->setLabel("Hình ảnh thumbnail")
        ]);

        echo $form->row(
            $form->text('home_media_b2_tag')->setLabel("Khối 2: Tên khối (Mặc định: COMPANY OPERATIONS)"),
            $form->text('home_media_b2_link')->setLabel("Khối 2: Link Xem tất cả (View All)")
        );
        echo $form->repeater('home_media_b2_items')->setLabel("Khối 2: Danh sách bài viết COMPANY OPERATIONS (Nếu chưa nhập sẽ lấy bài viết mẫu mặc định)")->setFields([
            $form->row(
                $form->text('title')->setLabel("Tiêu đề bài viết"),
                $form->text('link')->setLabel("Link bài viết")
            ),
            $form->image('image')->setLabel("Hình ảnh thumbnail")
        ]);
        echo endBox();

        // 8. Partners Section
        echo beginBox("8. Partners Section (Đối tác)", true);
        echo $form->text('home_partners_label')->setLabel("Nhãn phụ (Mặc định: PARTNERS)");
        echo $form->text('home_partners_title')->setLabel("Tiêu đề chính (Mặc định: Partnering to create<br>sustainable value.)");
        echo $form->textarea('home_partners_desc')->setLabel("Đoạn mô tả đối tác");
        echo $form->gallery('home_partners_logos')->setLabel("Danh sách Logo đối tác (Nếu chưa chọn sẽ dùng các logo đối tác mặc định)");
        echo endBox();

        echo '</div>';
    }
});
