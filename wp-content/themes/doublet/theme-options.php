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
        
        echo "<h4>Top Bar</h4>";
        echo $form->text('header_slogan')->setLabel('Top Bar Slogan')->setDefault('Professional steel supplying & processing');
        
        echo $form->row(
            $form->file('header_profile_file')->setLabel('2T Profile File (PDF)'),
            $form->text('header_profile_link')->setLabel('Or External Profile Link')
        );
        echo $form->text('header_vr360_link')->setLabel('VR360 Link (URL)');

        echo "<h4>Main Bar & CTA Button</h4>";
        echo $form->text('header_cta_text')->setLabel('CTA Button Text')->setDefault('FREE CONSULTATION');
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
        echo $form->textarea('footer_company_desc')->setLabel('Company Description')->setDefault('A leading provider and processor of steel plates and coils in Vietnam.');
        echo $form->text('footer_tax_id')->setLabel('Tax ID')->setDefault('1101808892');

        echo "<h4>Social Links</h4>";
        echo $form->row(
            $form->text('footer_social_fb')->setLabel('Facebook URL'),
            $form->text('footer_social_insta')->setLabel('Instagram URL')
        );
        echo $form->row(
            $form->text('footer_social_x')->setLabel('X (Twitter) URL'),
            $form->text('footer_social_yt')->setLabel('YouTube URL')
        );

        echo "<hr><h4>Headquarters</h4>";
        echo $form->text('footer_hq_title')->setLabel('Title')->setDefault('HEADQUARTERS');
        echo $form->textarea('footer_hq_address')->setLabel('Address')->setDefault('Lot J9-10-17A-18, Road No. 6, Hai Son Industrial Park, Duc Hoa Commune, Tay Ninh Province, Vietnam');
        echo $form->text('footer_hq_phone')->setLabel('Hotline / Phone')->setDefault('0272.249.6667 – 0272.249.6668 – 0272.249.6669');

        echo "<hr><h4>Ho Chi Minh Office</h4>";
        echo $form->text('footer_hcm_title')->setLabel('Title')->setDefault('HO CHI MINH OFFICE');
        echo $form->textarea('footer_hcm_address')->setLabel('Address')->setDefault('221/6-8 Le Trong Tan, Son Ky Ward, Ho Chi Minh City');
        echo $form->row(
            $form->text('footer_hcm_email')->setLabel('Email')->setDefault('2t@2tsteel.com'),
            $form->text('footer_hcm_phone')->setLabel('Phone')->setDefault('028.3816.5435 – 028.3816.5436')
        );

        echo "<hr><h4>Navigation Columns Titles</h4>";
        echo $form->row(
            $form->text('footer_col3_title')->setLabel('Cột 3 Tiêu đề (Quick Links)')->setDefault('QUICK LINKS'),
            $form->text('footer_col4_title')->setLabel('Cột 4 Tiêu đề (Services)')->setDefault('SERVICES')
        );

        echo "<hr><h4>Copyright & Policy</h4>";
        echo $form->text('footer_copy_line1')->setLabel('Copyright Line 1')->setDefault('Copyright © 2009 by DOUBLE T ENGINEERING CO., LTD');
        echo $form->text('footer_copy_line2')->setLabel('Copyright Line 2')->setDefault('Maximize Online Power by <strong>THEMAX</strong>');
        echo $form->row(
            $form->text('footer_profile_text')->setLabel('Profile Text')->setDefault('2T Profile'),
            $form->text('footer_profile_link')->setLabel('Profile Link URL (Để trống nếu dùng Profile từ Header)')
        );
        echo $form->row(
            $form->text('footer_terms_text')->setLabel('Terms Text')->setDefault('Terms of Use'),
            $form->text('footer_terms_link')->setLabel('Terms of Use Link')->setDefault('#')
        );
        echo $form->row(
            $form->text('footer_privacy_text')->setLabel('Privacy Text')->setDefault('Privacy Policy'),
            $form->text('footer_privacy_link')->setLabel('Privacy Policy Link')->setDefault('#')
        );
    };

    // 3. Consultation Modal Settings
    $consultation_modal_settings = function() use ($form) {
        echo "<h3>Consultation Modal</h3>";
        echo "<p>Configure text displayed on the free consultation popup. Contact details (Headquarters, HCM Office, Phone, Email, Watermark) are automatically synchronized from Footer settings.</p>";

        echo "<h4>Top Info</h4>";
        echo $form->text('modal_badge')->setLabel('Badge Label')->setDefault('FREE CONSULTATION');
        echo $form->textarea('modal_title')->setLabel('Modal Title (HTML supported)')->setDefault('Powering Progress<br> with <span class="txt-teal">Double</span> <span class="txt-red">T</span>');
        echo $form->textarea('modal_desc')->setLabel('Modal Description')->setDefault('Delivering high-quality steel products and reliable solutions engineered for strength, precision, and long-term performance across every project.');

        echo "<hr><h4>Form Labels & Placeholders</h4>";
        echo $form->row(
            $form->text('modal_form_name_label')->setLabel('Name Field Label')->setDefault('Full name'),
            $form->text('modal_form_name_placeholder')->setLabel('Name Placeholder')->setDefault('Your name')
        );
        echo $form->row(
            $form->text('modal_form_email_label')->setLabel('Email Field Label')->setDefault('Email'),
            $form->text('modal_form_email_placeholder')->setLabel('Email Placeholder')->setDefault('Enter your email')
        );
        echo $form->row(
            $form->text('modal_form_phone_label')->setLabel('Phone Field Label')->setDefault('Phone Number'),
            $form->text('modal_form_phone_placeholder')->setLabel('Phone Placeholder')->setDefault('Enter your phone number')
        );
        echo $form->row(
            $form->text('modal_form_company_label')->setLabel('Company Field Label')->setDefault('Company'),
            $form->text('modal_form_company_placeholder')->setLabel('Company Placeholder')->setDefault('Enter your company name')
        );
        echo $form->row(
            $form->text('modal_form_service_label')->setLabel('Service Question Label')->setDefault('Which service are you interested in?'),
            $form->text('modal_form_service_placeholder')->setLabel('Service Placeholder')->setDefault('Please select a service')
        );

        echo "<hr><h4>Service Dropdown Options</h4>";
        echo $form->row(
            $form->text('modal_service_opt1')->setLabel('Option 1')->setDefault('Slitting Line'),
            $form->text('modal_service_opt2')->setLabel('Option 2')->setDefault('Cut-to-Length Line')
        );
        echo $form->row(
            $form->text('modal_service_opt3')->setLabel('Option 3')->setDefault('Máy cắt Amada & Tấm Reshear Line'),
            $form->text('modal_service_opt4')->setLabel('Option 4')->setDefault('Dây chuyền cán vuốt thép La và Thép tròn đặc')
        );
        echo $form->row(
            $form->text('modal_service_opt5')->setLabel('Option 5')->setDefault('Dịch vụ hỗ trợ kỹ thuật phụ trợ'),
            $form->text('modal_service_opt6')->setLabel('Option 6')->setDefault('Other Services')
        );

        echo "<hr><h4>Form Actions & Notes</h4>";
        echo $form->textarea('modal_disclaimer')->setLabel('Disclaimer Text')->setDefault('We are committed to maintaining the confidentiality of information and using the data solely for advisory purposes.');
        echo $form->text('modal_submit_text')->setLabel('Submit Button Text')->setDefault('SEND INFORMATION');
        echo $form->text('modal_subnote')->setLabel('Subnote below button')->setDefault('You will receive a confirmation email shortly.');
    };

    // 4. CTA Single Career & Popup
    $cta_career = function() use ($form) {
        echo "<h3>CTA Section (Global for Single Careers)</h3>";
        echo "<p>Configure CTA banner at the bottom of career detail pages.</p>";
        echo $form->image('career_cta_img')->setLabel('CTA Image');
        echo $form->text('career_cta_btn_text')->setLabel('CTA Button Text');
        echo $form->textarea('career_cta_title')->setLabel('CTA Title');
        echo $form->textarea('career_cta_des')->setLabel('CTA Description');

        echo "<hr><h4>Popup Form Text</h4>";
        echo $form->text('career_popup_title_text')->setLabel('Title')->setDefault('Submit Your Resume');
        echo $form->text('career_popup_name')->setLabel('Name Placeholder')->setDefault('Your name');
        echo $form->text('career_popup_email')->setLabel('Email Placeholder')->setDefault('Email address');
        echo $form->text('career_popup_phone')->setLabel('Phone Placeholder')->setDefault('Phone number');
        echo $form->text('career_popup_upload_btn')->setLabel('Upload Button Text')->setDefault('Upload CV');
        echo $form->text('career_popup_upload_note')->setLabel('Upload Note Text')->setDefault('Upload PDF, PPT, PPTX, DOC, DOCX, JPG, PNG files (maximum 5 MB)');
        echo $form->text('career_popup_portfolio')->setLabel('Portfolio Placeholder')->setDefault('Link Portfolio');
        echo $form->text('career_popup_job_placeholder')->setLabel('Job Select Placeholder')->setDefault('Please select the title job');
        echo $form->text('career_popup_intro')->setLabel('Introduction Placeholder')->setDefault('A brief introduction about myself');
        echo $form->text('career_popup_submit')->setLabel('Submit Button Text')->setDefault('SUBMIT JOB APPLICATION');
    };

    // 5. SMTP Settings
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

    // 6. reCAPTCHA Settings
    $recaptcha_settings = function() use ($form) {
        echo "<h3>reCAPTCHA v3 Settings</h3>";
        echo "<p>Google reCAPTCHA v3 configuration.</p>";
        echo $form->text('recaptcha_site_key')->setLabel('reCAPTCHA Site Key');
        echo $form->text('recaptcha_secret_key')->setLabel('reCAPTCHA Secret Key');
    };

    // Consultation CTA Settings (Global)
    $cta_settings = function() use ($form) {
        echo "<h3>Consultation CTA Section</h3>";
        echo "<p>Cấu hình khối kêu gọi tư vấn (Consultation CTA Banner) hiển thị ở các trang có khối CTA.</p>";
        echo $form->image('global_cta_bg')->setLabel('Hình nền CTA (Mặc định: cta.jpg)');
        echo $form->text('global_cta_title')->setLabel('Tiêu đề CTA')->setDefault('Request A Consultation');
        echo $form->textarea('global_cta_desc')->setLabel('Mô tả CTA')->setDefault('Our team is ready to understand your requirements, provide expert recommendations, and help you find the most suitable steel products and solutions.');
        echo $form->row(
            $form->text('global_cta_btn_text')->setLabel('Text nút bấm')->setDefault('FREE CONSULTATION'),
            $form->text('global_cta_btn_link')->setLabel('Link nút bấm (Để trống hoặc # để mở Consultation Popup)')->setDefault('#')
        );
    };

    // Save
    $save = $form->submit( 'Save Options' );

    // Layout
    tr_tabs()->setSidebar( $save )
        ->addTab( 'Header', $header_settings )
        ->addTab( 'Footer', $footer_settings )
        ->addTab( 'Consultation CTA', $cta_settings )
        ->addTab( 'Consultation Modal', $consultation_modal_settings )
        ->addTab( 'Single Career', $cta_career )
        ->addTab( 'SMTP', $smtp_settings )
        ->addTab( 'reCAPTCHA', $recaptcha_settings )
        ->render( 'box' );
        
    echo $form->close();
    ?>
</div>
