<?php
if ( ! function_exists( 'add_action' )) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

// Setup Form
$form = tr_form()->useJson()->setGroup( $this->getName() );
?>

<h1>Theme Options</h1>
<div class="typerocket-container">
    <?php
    echo $form->open();

    // 1. Header Settings
    $header_settings = function() use ($form) {
        echo "<h3>Header Settings</h3>";
        echo $form->image('header_logo')->setLabel('Logo Header');
        
        echo "<h4>Top Bar Slogan</h4>";
        echo $form->row(
            $form->text('header_slogan')->setLabel('Top Bar Slogan (EN)')->setDefault('Professional steel supplying & processing'),
            $form->text('header_slogan_vi')->setLabel('Top Bar Slogan (VI)')->setDefault('Cung cấp & Gia công thép chuyên nghiệp')
        );
        
        echo "<h4>Profile 2T (File / Link)</h4>";
        echo $form->row(
            $form->file('header_profile_file')->setLabel('2T Profile File (PDF) - EN'),
            $form->file('header_profile_file_vi')->setLabel('2T Profile File (PDF) - VI')
        );
        echo $form->row(
            $form->text('header_profile_link')->setLabel('External Profile Link - EN'),
            $form->text('header_profile_link_vi')->setLabel('External Profile Link - VI')
        );
        echo $form->text('header_vr360_link')->setLabel('VR360 Link (URL)');

        echo "<h4>Main Bar & CTA Button</h4>";
        echo $form->row(
            $form->text('header_cta_text')->setLabel('CTA Button Text (EN)')->setDefault('FREE CONSULTATION'),
            $form->text('header_cta_text_vi')->setLabel('CTA Button Text (VI)')->setDefault('TƯ VẤN MIỄN PHÍ')
        );
        echo $form->text('header_cta_link')->setLabel('CTA Button Link (Leave empty or # to open Consultation Popup)')->setDefault('#');
    };

    // 2. Footer Settings
    $footer_settings = function() use ($form) {
        echo "<h3>Footer Settings</h3>";

        echo "<h4>Logo & Images</h4>";
        echo $form->row(
            $form->image('footer_logo')->setLabel('Footer Logo'),
            $form->image('footer_watermark')->setLabel('Footer Watermark (Background shape)')
        );

        echo "<h4>Company Information</h4>";
        echo $form->row(
            $form->text('footer_company_name_red')->setLabel('Company Name (Red part)')->setDefault('DOUBLE T'),
            $form->text('footer_company_name_teal')->setLabel('Company Name (Teal part)')->setDefault('METAL COMPANY LIMITED')
        );
        echo $form->row(
            $form->textarea('footer_company_desc')->setLabel('Company Description (EN)')->setDefault('A leading provider and processor of steel plates and coils in Vietnam.'),
            $form->textarea('footer_company_desc_vi')->setLabel('Company Description (VI)')->setDefault('Doanh nghiệp hàng đầu trong cung cấp và gia công các loại thép tấm, thép cuộn tại Việt Nam.')
        );
        echo $form->text('footer_tax_id')->setLabel('Tax ID')->setDefault('1101808892');

        echo "<h4>Social Links</h4>";
        echo $form->row(
            $form->text('footer_social_fb')->setLabel('Facebook URL'),
            // $form->text('footer_social_insta')->setLabel('Instagram URL')
        );
        echo $form->row(
            // $form->text('footer_social_x')->setLabel('X (Twitter) URL'),
            $form->text('footer_social_yt')->setLabel('YouTube URL')
        );

        echo "<hr><h4>Headquarters</h4>";
        echo $form->row(
            $form->text('footer_hq_title')->setLabel('Title (EN)')->setDefault('HEADQUARTERS'),
            $form->text('footer_hq_title_vi')->setLabel('Title (VI)')->setDefault('TRỤ SỞ CHÍNH')
        );
        echo $form->row(
            $form->textarea('footer_hq_address')->setLabel('Address (EN)')->setDefault('Lot J9-10-17A-18, Road No. 6, Hai Son Industrial Park, Duc Hoa Commune, Tay Ninh Province, Vietnam'),
            $form->textarea('footer_hq_address_vi')->setLabel('Address (VI)')->setDefault('Lô J9-10-17A-18, Đường số 6, KCN Hải Sơn, Xã Đức Hòa Hạ, Huyện Đức Hòa, Tỉnh Long An, Việt Nam')
        );
        echo $form->text('footer_hq_phone')->setLabel('Hotline / Phone')->setDefault('0272.249.6667 – 0272.249.6668 – 0272.249.6669');

        echo "<hr><h4>Ho Chi Minh Office</h4>";
        echo $form->row(
            $form->text('footer_hcm_title')->setLabel('Title (EN)')->setDefault('HO CHI MINH OFFICE'),
            $form->text('footer_hcm_title_vi')->setLabel('Title (VI)')->setDefault('VĂN PHÒNG TP. HỒ CHÍ MINH')
        );
        echo $form->row(
            $form->textarea('footer_hcm_address')->setLabel('Address (EN)')->setDefault('221/6-8 Le Trong Tan, Son Ky Ward, Ho Chi Minh City'),
            $form->textarea('footer_hcm_address_vi')->setLabel('Address (VI)')->setDefault('221/6-8 Lê Trọng Tấn, Phường Sơn Kỳ, Quận Tân Phú, TP. Hồ Chí Minh')
        );
        echo $form->row(
            $form->text('footer_hcm_email')->setLabel('Email')->setDefault('2t@2tsteel.com'),
            $form->text('footer_hcm_phone')->setLabel('Phone')->setDefault('028.3816.5435 – 028.3816.5436')
        );

        echo "<hr><h4>Navigation Columns Titles</h4>";
        echo $form->row(
            $form->text('footer_col3_title')->setLabel('Cột 3 Tiêu đề (EN)')->setDefault('QUICK LINKS'),
            $form->text('footer_col3_title_vi')->setLabel('Cột 3 Tiêu đề (VI)')->setDefault('LIÊN KẾT NHANH')
        );
        echo $form->row(
            $form->text('footer_col4_title')->setLabel('Cột 4 Tiêu đề (EN)')->setDefault('SERVICES'),
            $form->text('footer_col4_title_vi')->setLabel('Cột 4 Tiêu đề (VI)')->setDefault('DỊCH VỤ')
        );

        echo "<hr><h4>Copyright & Policy</h4>";
        echo $form->row(
            $form->text('footer_copy_line1')->setLabel('Copyright Line 1 (EN)')->setDefault('Copyright © 2009 by DOUBLE T ENGINEERING CO., LTD'),
            $form->text('footer_copy_line1_vi')->setLabel('Copyright Line 1 (VI)')->setDefault('Bản quyền © 2009 thuộc về CÔNG TY TNHH KỸ THUẬT DOUBLE T')
        );
        echo $form->row(
            $form->text('footer_copy_line2')->setLabel('Copyright Line 2 (EN)')->setDefault('Maximize Online Power by <strong>THEMAX</strong>'),
            $form->text('footer_copy_line2_vi')->setLabel('Copyright Line 2 (VI)')->setDefault('Tối đa hoá sức mạnh trực tuyến bởi <strong>THEMAX</strong>')
        );
        echo $form->row(
            $form->text('footer_profile_text')->setLabel('Profile Text (EN)')->setDefault('2T Profile'),
            $form->text('footer_profile_text_vi')->setLabel('Profile Text (VI)')->setDefault('Hồ sơ 2T')
        );
        echo $form->row(
            $form->text('footer_profile_link')->setLabel('Profile Link URL (EN)'),
            $form->text('footer_profile_link_vi')->setLabel('Profile Link URL (VI)')
        );
        echo $form->row(
            $form->text('footer_terms_text')->setLabel('Terms Text (EN)')->setDefault('Terms of Use'),
            $form->text('footer_terms_text_vi')->setLabel('Terms Text (VI)')->setDefault('Điều khoản sử dụng')
        );
        echo $form->row(
            $form->text('footer_terms_link')->setLabel('Terms Link (EN)')->setDefault('#'),
            $form->text('footer_terms_link_vi')->setLabel('Terms Link (VI)')->setDefault('#')
        );
        echo $form->row(
            $form->text('footer_privacy_text')->setLabel('Privacy Text (EN)')->setDefault('Privacy Policy'),
            $form->text('footer_privacy_text_vi')->setLabel('Privacy Text (VI)')->setDefault('Chính sách bảo mật')
        );
        echo $form->row(
            $form->text('footer_privacy_link')->setLabel('Privacy Link (EN)')->setDefault('#'),
            $form->text('footer_privacy_link_vi')->setLabel('Privacy Link (VI)')->setDefault('#')
        );
    };

    // 3. Consultation Modal Settings
    $consultation_modal_settings = function() use ($form) {
        echo "<h3>Consultation Modal</h3>";
        echo "<p>Configure text displayed on the free consultation popup.</p>";

        echo "<h4>Top Info</h4>";
        echo $form->row(
            $form->text('modal_badge')->setLabel('Badge Label (EN)')->setDefault('FREE CONSULTATION'),
            $form->text('modal_badge_vi')->setLabel('Badge Label (VI)')->setDefault('TƯ VẤN MIỄN PHÍ')
        );
        echo $form->row(
            $form->textarea('modal_title')->setLabel('Modal Title (EN)')->setDefault('Powering Progress<br> with <span class="txt-teal">Double</span> <span class="txt-red">T</span>'),
            $form->textarea('modal_title_vi')->setLabel('Modal Title (VI)')->setDefault('Tiếp Bước Thành Công<br> cùng <span class="txt-teal">Double</span> <span class="txt-red">T</span>')
        );
        echo $form->row(
            $form->textarea('modal_desc')->setLabel('Modal Description (EN)')->setDefault('Delivering high-quality steel products and reliable solutions engineered for strength, precision, and long-term performance across every project.'),
            $form->textarea('modal_desc_vi')->setLabel('Modal Description (VI)')->setDefault('Cung cấp các sản phẩm thép chất lượng cao và giải pháp đáng tin cậy, đảm bảo độ bền, chính xác và hiệu quả lâu dài cho mọi dự án.')
        );

        echo "<hr><h4>Form Labels & Placeholders</h4>";
        echo $form->row(
            $form->text('modal_form_name_label')->setLabel('Name Label (EN)')->setDefault('Full name'),
            $form->text('modal_form_name_label_vi')->setLabel('Name Label (VI)')->setDefault('Họ và tên')
        );
        echo $form->row(
            $form->text('modal_form_name_placeholder')->setLabel('Name Placeholder (EN)')->setDefault('Your name'),
            $form->text('modal_form_name_placeholder_vi')->setLabel('Name Placeholder (VI)')->setDefault('Nhập họ và tên của bạn')
        );
        echo $form->row(
            $form->text('modal_form_email_label')->setLabel('Email Label (EN)')->setDefault('Email'),
            $form->text('modal_form_email_label_vi')->setLabel('Email Label (VI)')->setDefault('Email')
        );
        echo $form->row(
            $form->text('modal_form_email_placeholder')->setLabel('Email Placeholder (EN)')->setDefault('Enter your email'),
            $form->text('modal_form_email_placeholder_vi')->setLabel('Email Placeholder (VI)')->setDefault('Nhập địa chỉ email')
        );
        echo $form->row(
            $form->text('modal_form_phone_label')->setLabel('Phone Label (EN)')->setDefault('Phone Number'),
            $form->text('modal_form_phone_label_vi')->setLabel('Phone Label (VI)')->setDefault('Số điện thoại')
        );
        echo $form->row(
            $form->text('modal_form_phone_placeholder')->setLabel('Phone Placeholder (EN)')->setDefault('Enter your phone number'),
            $form->text('modal_form_phone_placeholder_vi')->setLabel('Phone Placeholder (VI)')->setDefault('Nhập số điện thoại')
        );
        echo $form->row(
            $form->text('modal_form_company_label')->setLabel('Company Label (EN)')->setDefault('Company'),
            $form->text('modal_form_company_label_vi')->setLabel('Company Label (VI)')->setDefault('Công ty / Đơn vị')
        );
        echo $form->row(
            $form->text('modal_form_company_placeholder')->setLabel('Company Placeholder (EN)')->setDefault('Enter your company name'),
            $form->text('modal_form_company_placeholder_vi')->setLabel('Company Placeholder (VI)')->setDefault('Nhập tên công ty')
        );
        echo $form->row(
            $form->text('modal_form_service_label')->setLabel('Service Question Label (EN)')->setDefault('Which service are you interested in?'),
            $form->text('modal_form_service_label_vi')->setLabel('Service Question Label (VI)')->setDefault('Bạn đang quan tâm đến dịch vụ nào?')
        );
        echo $form->row(
            $form->text('modal_form_service_placeholder')->setLabel('Service Placeholder (EN)')->setDefault('Please select a service'),
            $form->text('modal_form_service_placeholder_vi')->setLabel('Service Placeholder (VI)')->setDefault('Vui lòng chọn dịch vụ')
        );

        echo "<hr><h4>Service Dropdown Options</h4>";
        echo $form->row(
            $form->text('modal_service_opt1')->setLabel('Option 1 (EN)')->setDefault('Slitting Line'),
            $form->text('modal_service_opt1_vi')->setLabel('Option 1 (VI)')->setDefault('Dây chuyền xẻ cuộn (Slitting Line)')
        );
        echo $form->row(
            $form->text('modal_service_opt2')->setLabel('Option 2 (EN)')->setDefault('Cut-to-Length Line'),
            $form->text('modal_service_opt2_vi')->setLabel('Option 2 (VI)')->setDefault('Dây chuyền cắt tấm (Cut-to-Length)')
        );
        echo $form->row(
            $form->text('modal_service_opt3')->setLabel('Option 3 (EN)')->setDefault('Máy cắt Amada & Tấm Reshear Line'),
            $form->text('modal_service_opt3_vi')->setLabel('Option 3 (VI)')->setDefault('Máy cắt Amada & Tấm Reshear Line')
        );
        echo $form->row(
            $form->text('modal_service_opt4')->setLabel('Option 4 (EN)')->setDefault('Dây chuyền cán vuốt thép La và Thép tròn đặc'),
            $form->text('modal_service_opt4_vi')->setLabel('Option 4 (VI)')->setDefault('Dây chuyền cán vuốt thép La và Thép tròn đặc')
        );
        echo $form->row(
            $form->text('modal_service_opt5')->setLabel('Option 5 (EN)')->setDefault('Dịch vụ hỗ trợ kỹ thuật phụ trợ'),
            $form->text('modal_service_opt5_vi')->setLabel('Option 5 (VI)')->setDefault('Dịch vụ hỗ trợ kỹ thuật phụ trợ')
        );
        echo $form->row(
            $form->text('modal_service_opt6')->setLabel('Option 6 (EN)')->setDefault('Other Services'),
            $form->text('modal_service_opt6_vi')->setLabel('Option 6 (VI)')->setDefault('Dịch vụ khác')
        );

        echo "<hr><h4>Form Actions & Notes</h4>";
        echo $form->row(
            $form->textarea('modal_disclaimer')->setLabel('Disclaimer Text (EN)')->setDefault('We are committed to maintaining the confidentiality of information and using the data solely for advisory purposes.'),
            $form->textarea('modal_disclaimer_vi')->setLabel('Disclaimer Text (VI)')->setDefault('Chúng tôi cam kết bảo mật tuyệt đối thông tin và chỉ sử dụng dữ liệu cho mục đích tư vấn.')
        );
        echo $form->row(
            $form->text('modal_submit_text')->setLabel('Submit Button Text (EN)')->setDefault('SEND INFORMATION'),
            $form->text('modal_submit_text_vi')->setLabel('Submit Button Text (VI)')->setDefault('GỬI THÔNG TIN')
        );
        echo $form->row(
            $form->text('modal_subnote')->setLabel('Subnote below button (EN)')->setDefault('You will receive a confirmation email shortly.'),
            $form->text('modal_subnote_vi')->setLabel('Subnote below button (VI)')->setDefault('Bạn sẽ nhận được email xác nhận trong thời gian sớm nhất.')
        );
    };

    // 4. Consultation CTA Settings (Global)
    $cta_settings = function() use ($form) {
        echo "<h3>Consultation CTA Section</h3>";
        echo "<p>Cấu hình khối kêu gọi tư vấn (Consultation CTA Banner) hiển thị ở các trang có khối CTA.</p>";
        echo $form->image('global_cta_bg')->setLabel('Hình nền CTA (Mặc định: cta.jpg)');
        echo $form->row(
            $form->text('global_cta_title')->setLabel('Tiêu đề CTA (EN)')->setDefault('Request A Consultation'),
            $form->text('global_cta_title_vi')->setLabel('Tiêu đề CTA (VI)')->setDefault('Đăng Ký Tư Vấn')
        );
        echo $form->row(
            $form->textarea('global_cta_desc')->setLabel('Mô tả CTA (EN)')->setDefault('Our team is ready to understand your requirements, provide expert recommendations, and help you find the most suitable steel products and solutions.'),
            $form->textarea('global_cta_desc_vi')->setLabel('Mô tả CTA (VI)')->setDefault('Đội ngũ chuyên gia của chúng tôi luôn sẵn sàng lắng nghe nhu cầu, tư vấn chuyên sâu và hỗ trợ bạn lựa chọn sản phẩm cũng như giải pháp thép tối ưu nhất.')
        );
        echo $form->row(
            $form->text('global_cta_btn_text')->setLabel('Text nút bấm (EN)')->setDefault('FREE CONSULTATION'),
            $form->text('global_cta_btn_text_vi')->setLabel('Text nút bấm (VI)')->setDefault('TƯ VẤN MIỄN PHÍ')
        );
        echo $form->text('global_cta_btn_link')->setLabel('Link nút bấm (Để trống hoặc # để mở Consultation Popup)')->setDefault('#');
    };

    // 5. Career Apply Form Settings
    $career_form_settings = function() use ($form) {
        echo "<h3>Career Apply Form</h3>";
        echo "<p>Cấu hình văn bản hiển thị trên form ứng tuyển ở trang chi tiết tuyển dụng (Single Career).</p>";

        echo "<h4>Tiêu đề Form</h4>";
        echo $form->row(
            $form->text('career_form_title')->setLabel('Tiêu đề Form (EN)')->setDefault('Apply for this Position'),
            $form->text('career_form_title_vi')->setLabel('Tiêu đề Form (VI)')->setDefault('Ứng Tuyển Vị Trí Này')
        );

        echo "<hr><h4>Họ và tên (Full Name)</h4>";
        echo $form->row(
            $form->text('career_form_name_label')->setLabel('Label (EN)')->setDefault('Full name'),
            $form->text('career_form_name_label_vi')->setLabel('Label (VI)')->setDefault('Họ và tên')
        );
        echo $form->row(
            $form->text('career_form_name_placeholder')->setLabel('Placeholder (EN)')->setDefault('Your name'),
            $form->text('career_form_name_placeholder_vi')->setLabel('Placeholder (VI)')->setDefault('Họ và tên của bạn')
        );

        echo "<hr><h4>Email & Số điện thoại</h4>";
        echo $form->row(
            $form->text('career_form_email_label')->setLabel('Email Label (EN)')->setDefault('Email'),
            $form->text('career_form_email_label_vi')->setLabel('Email Label (VI)')->setDefault('Email')
        );
        echo $form->row(
            $form->text('career_form_email_placeholder')->setLabel('Email Placeholder (EN)')->setDefault('Enter your email'),
            $form->text('career_form_email_placeholder_vi')->setLabel('Email Placeholder (VI)')->setDefault('Nhập địa chỉ email')
        );
        echo $form->row(
            $form->text('career_form_phone_label')->setLabel('Phone Label (EN)')->setDefault('Phone Number'),
            $form->text('career_form_phone_label_vi')->setLabel('Phone Label (VI)')->setDefault('Số điện thoại')
        );
        echo $form->row(
            $form->text('career_form_phone_placeholder')->setLabel('Phone Placeholder (EN)')->setDefault('Enter your phone number'),
            $form->text('career_form_phone_placeholder_vi')->setLabel('Phone Placeholder (VI)')->setDefault('Nhập số điện thoại')
        );

        echo "<hr><h4>Upload CV</h4>";
        echo $form->row(
            $form->text('career_form_cv_label')->setLabel('CV Label (EN)')->setDefault('Upload CV'),
            $form->text('career_form_cv_label_vi')->setLabel('CV Label (VI)')->setDefault('Tải lên CV')
        );
        echo $form->row(
            $form->text('career_form_cv_placeholder')->setLabel('Upload Text (EN)')->setDefault('Select or drag and drop files to upload'),
            $form->text('career_form_cv_placeholder_vi')->setLabel('Upload Text (VI)')->setDefault('Chọn hoặc kéo thả tập tin để tải lên')
        );

        echo "<hr><h4>Giới thiệu bản thân</h4>";
        echo $form->row(
            $form->text('career_form_intro_label')->setLabel('Intro Label (EN)')->setDefault('Introduce yourself'),
            $form->text('career_form_intro_label_vi')->setLabel('Intro Label (VI)')->setDefault('Giới thiệu bản thân')
        );
        echo $form->row(
            $form->text('career_form_intro_placeholder')->setLabel('Intro Placeholder (EN)')->setDefault('Enter message'),
            $form->text('career_form_intro_placeholder_vi')->setLabel('Intro Placeholder (VI)')->setDefault('Nhập thông tin giới thiệu ngắn về bạn')
        );

        echo "<hr><h4>Nút nộp đơn & Ghi chú</h4>";
        echo $form->row(
            $form->text('career_form_submit')->setLabel('Submit Button Text (EN)')->setDefault('APPLY NOW'),
            $form->text('career_form_submit_vi')->setLabel('Submit Button Text (VI)')->setDefault('NỘP ĐƠN ỨNG TUYỂN')
        );
        echo $form->row(
            $form->textarea('career_form_subtext')->setLabel('Subtext dưới nút (EN)')->setDefault('You will receive a confirmation email, and we will contact you within 5-7 business days if you are a potential candidate.'),
            $form->textarea('career_form_subtext_vi')->setLabel('Subtext dưới nút (VI)')->setDefault('Bạn sẽ nhận được email xác nhận và chúng tôi sẽ liên hệ trong vòng 5-7 ngày làm việc nếu bạn là ứng viên phù hợp.')
        );

        echo "<hr><h4>Sidebar Info Card (Nhãn thông tin tuyển dụng)</h4>";
        echo $form->row(
            $form->text('career_label_salary')->setLabel('Mức lương / Salary Label (EN)')->setDefault('SALARY'),
            $form->text('career_label_salary_vi')->setLabel('Mức lương / Salary Label (VI)')->setDefault('MỨC LƯƠNG')
        );
        echo $form->row(
            $form->text('career_label_experience')->setLabel('Kinh nghiệm / Experience Label (EN)')->setDefault('EXPERIENCE'),
            $form->text('career_label_experience_vi')->setLabel('Kinh nghiệm / Experience Label (VI)')->setDefault('KINH NGHIỆM')
        );
        echo $form->row(
            $form->text('career_label_quantity')->setLabel('Số lượng / Quantity Label (EN)')->setDefault('QUANTITY'),
            $form->text('career_label_quantity_vi')->setLabel('Số lượng / Quantity Label (VI)')->setDefault('SỐ LƯỢNG')
        );
        echo $form->row(
            $form->text('career_label_deadline')->setLabel('Hạn nộp hồ sơ / Deadline Label (EN)')->setDefault('DEADLINE'),
            $form->text('career_label_deadline_vi')->setLabel('Hạn nộp hồ sơ / Deadline Label (VI)')->setDefault('HẠN NỘP HỒ SƠ')
        );
        echo $form->row(
            $form->text('career_btn_apply')->setLabel('Nút ứng tuyển Sidebar (EN)')->setDefault('APPLY NOW'),
            $form->text('career_btn_apply_vi')->setLabel('Nút ứng tuyển Sidebar (VI)')->setDefault('ỨNG TUYỂN NGAY')
        );
    };

    // 6. SMTP Settings
    $smtp_settings = function() use ($form) {
        echo "<h3>SMTP Settings</h3>";
        echo "<p>Configure SMTP settings for outgoing emails.</p>";
        echo $form->text('smtp_host')->setLabel('SMTP Host (e.g. smtp.gmail.com)');
        echo $form->text('smtp_port')->setLabel('SMTP Port (e.g. 465 or 587)');
        echo $form->text('username')->setLabel('Username (SMTP Email)');
        echo $form->text('smtp_password')->setLabel('Password (SMTP App Password)')->setAttribute('type', 'password');
        echo $form->checkbox('authentication')->setLabel('SMTP Authentication')->setText('Enable SMTP authentication');
        echo $form->select('encryption')->setLabel('Encryption')->setOptions(['SSL' => 'ssl', 'TLS' => 'tls', 'None' => '']);
        echo $form->text('from_email')->setLabel('From Email (e.g. no-reply@example.com)');
        
        echo "<hr><h4>Notification Recipient Email</h4>";
        echo $form->text('receive_email')->setLabel('Email to receive contact / job application notifications');
    };

    // 7. reCAPTCHA Settings
    $recaptcha_settings = function() use ($form) {
        echo "<h3>reCAPTCHA v3 Settings</h3>";
        echo "<p>Google reCAPTCHA v3 configuration.</p>";
        echo $form->text('recaptcha_site_key')->setLabel('reCAPTCHA Site Key');
        echo $form->text('recaptcha_secret_key')->setLabel('reCAPTCHA Secret Key');
    };

    // Save
    $save = $form->submit( 'Save Options' );

    // Layout
    tr_tabs()->setSidebar( $save )
        ->addTab( 'Header', $header_settings )
        ->addTab( 'Footer', $footer_settings )
        ->addTab( 'Consultation CTA', $cta_settings )
        ->addTab( 'Consultation Modal', $consultation_modal_settings )
        ->addTab( 'Career Apply Form', $career_form_settings )
        ->addTab( 'SMTP', $smtp_settings )
        ->addTab( 'reCAPTCHA', $recaptcha_settings )
        ->render( 'box' );
        
    echo $form->close();
    ?>
</div>
