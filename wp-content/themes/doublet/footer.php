<?php
$current_lang = function_exists('pll_current_language') ? pll_current_language('slug') : 'en';
$current_lang = strtolower($current_lang ?: 'en');

// Watermark & Logo
$footer_watermark_id = tr_options_field('tr_theme_options.footer_watermark');
$footer_watermark_url = $footer_watermark_id ? wp_get_attachment_image_url($footer_watermark_id, 'full') : (get_template_directory_uri() . '/imgs/logo_future.png');

$footer_logo_id = tr_options_field('tr_theme_options.footer_logo');
$footer_logo_url = $footer_logo_id ? wp_get_attachment_image_url($footer_logo_id, 'full') : (get_template_directory_uri() . '/imgs/logo.png');

// Company Info
$footer_company_name_red = tr_options_field('tr_theme_options.footer_company_name_red') ?: 'DOUBLE T';
$footer_company_name_teal = tr_options_field('tr_theme_options.footer_company_name_teal') ?: 'METAL COMPANY LIMITED';
$footer_tax_id = tr_options_field('tr_theme_options.footer_tax_id') ?: '1101808892';

// Socials
$footer_social_fb = tr_options_field('tr_theme_options.footer_social_fb') ?: '#';
// $footer_social_insta = tr_options_field('tr_theme_options.footer_social_insta') ?: '#';
// $footer_social_x = tr_options_field('tr_theme_options.footer_social_x') ?: '#';
$footer_social_yt = tr_options_field('tr_theme_options.footer_social_yt') ?: '#';

// Helper to properly format footer links (handles relative paths like /privacy-policy/ or vi/chinh-sach-bao-mat/)
$themax_format_footer_link = function($link) {
    if (empty($link) || $link === '#') {
        return '#';
    }
    if (preg_match('/^(https?:\/\/|#|mailto:|tel:)/i', $link)) {
        return $link;
    }
    return home_url('/' . ltrim($link, '/'));
};

// Multilingual text fields for footer & modal
if ($current_lang === 'vi') {
    $footer_company_desc = tr_options_field('tr_theme_options.footer_company_desc_vi') ?: 'Doanh nghiệp hàng đầu trong cung cấp và gia công các loại thép tấm, thép cuộn tại Việt Nam.';
    $footer_hq_title = tr_options_field('tr_theme_options.footer_hq_title_vi') ?: 'TRỤ SỞ CHÍNH';
    $footer_hq_address = tr_options_field('tr_theme_options.footer_hq_address_vi') ?: 'Lô J9-10-17A-18, Đường số 6, KCN Hải Sơn, Xã Đức Hòa Hạ, Huyện Đức Hòa, Tỉnh Long An, Việt Nam';
    $footer_hcm_title = tr_options_field('tr_theme_options.footer_hcm_title_vi') ?: 'VĂN PHÒNG TP. HỒ CHÍ MINH';
    $footer_hcm_address = tr_options_field('tr_theme_options.footer_hcm_address_vi') ?: '221/6-8 Lê Trọng Tấn, Phường Sơn Kỳ, Quận Tân Phú, TP. Hồ Chí Minh';
    $footer_col3_title = tr_options_field('tr_theme_options.footer_col3_title_vi') ?: 'LIÊN KẾT NHANH';
    $footer_col4_title = tr_options_field('tr_theme_options.footer_col4_title_vi') ?: 'DỊCH VỤ';
    $footer_copy_line1 = tr_options_field('tr_theme_options.footer_copy_line1_vi') ?: 'Bản quyền © 2009 thuộc về CÔNG TY TNHH KỸ THUẬT DOUBLE T';
    $footer_copy_line2 = tr_options_field('tr_theme_options.footer_copy_line2_vi') ?: 'Tối đa hoá sức mạnh trực tuyến bởi <strong>THEMAX</strong>';
    $footer_profile_text = tr_options_field('tr_theme_options.footer_profile_text_vi') ?: 'Hồ sơ 2T';
    $footer_terms_text = tr_options_field('tr_theme_options.footer_terms_text_vi') ?: 'Điều khoản sử dụng';
    $footer_terms_raw = tr_options_field('tr_theme_options.footer_terms_link_vi') ?: tr_options_field('tr_theme_options.footer_terms_link');
    $footer_terms_url = $themax_format_footer_link($footer_terms_raw);
    $footer_privacy_text = tr_options_field('tr_theme_options.footer_privacy_text_vi') ?: 'Chính sách bảo mật';
    $footer_privacy_raw = tr_options_field('tr_theme_options.footer_privacy_link_vi') ?: tr_options_field('tr_theme_options.footer_privacy_link');
    $footer_privacy_url = $themax_format_footer_link($footer_privacy_raw);
    $footer_custom_profile_link = tr_options_field('tr_theme_options.footer_profile_link_vi') ?: tr_options_field('tr_theme_options.header_profile_link_vi');

    // Modal consultation
    $modal_badge = tr_options_field('tr_theme_options.modal_badge_vi') ?: 'TƯ VẤN MIỄN PHÍ';
    $modal_title = tr_options_field('tr_theme_options.modal_title_vi') ?: 'Tiếp Bước Thành Công<br> cùng <span class="txt-teal">Double</span> <span class="txt-red">T</span>';
    $modal_desc = tr_options_field('tr_theme_options.modal_desc_vi') ?: 'Cung cấp các sản phẩm thép chất lượng cao và giải pháp đáng tin cậy, đảm bảo độ bền, chính xác và hiệu quả lâu dài cho mọi dự án.';
    $modal_disclaimer = tr_options_field('tr_theme_options.modal_disclaimer_vi') ?: 'Chúng tôi cam kết bảo mật tuyệt đối thông tin và chỉ sử dụng dữ liệu cho mục đích tư vấn.';
    $modal_submit_text = tr_options_field('tr_theme_options.modal_submit_text_vi') ?: 'GỬI THÔNG TIN';
    $modal_subnote = tr_options_field('tr_theme_options.modal_subnote_vi') ?: 'Bạn sẽ nhận được email xác nhận trong thời gian sớm nhất.';

    $modal_form_name_label = tr_options_field('tr_theme_options.modal_form_name_label_vi') ?: 'Họ và tên';
    $modal_form_name_placeholder = tr_options_field('tr_theme_options.modal_form_name_placeholder_vi') ?: 'Nhập họ và tên của bạn';
    $modal_form_email_label = tr_options_field('tr_theme_options.modal_form_email_label_vi') ?: 'Email';
    $modal_form_email_placeholder = tr_options_field('tr_theme_options.modal_form_email_placeholder_vi') ?: 'Nhập địa chỉ email';
    $modal_form_phone_label = tr_options_field('tr_theme_options.modal_form_phone_label_vi') ?: 'Số điện thoại';
    $modal_form_phone_placeholder = tr_options_field('tr_theme_options.modal_form_phone_placeholder_vi') ?: 'Nhập số điện thoại';
    $modal_form_company_label = tr_options_field('tr_theme_options.modal_form_company_label_vi') ?: 'Công ty / Đơn vị';
    $modal_form_company_placeholder = tr_options_field('tr_theme_options.modal_form_company_placeholder_vi') ?: 'Nhập tên công ty';
    $modal_form_service_label = tr_options_field('tr_theme_options.modal_form_service_label_vi') ?: 'Bạn đang quan tâm đến dịch vụ nào?';
    $modal_form_service_placeholder = tr_options_field('tr_theme_options.modal_form_service_placeholder_vi') ?: 'Vui lòng chọn dịch vụ';

    $modal_service_opt1 = tr_options_field('tr_theme_options.modal_service_opt1_vi') ?: 'Dây chuyền xẻ cuộn (Slitting Line)';
    $modal_service_opt2 = tr_options_field('tr_theme_options.modal_service_opt2_vi') ?: 'Dây chuyền cắt tấm (Cut-to-Length)';
    $modal_service_opt3 = tr_options_field('tr_theme_options.modal_service_opt3_vi') ?: 'Máy cắt Amada & Tấm Reshear Line';
    $modal_service_opt4 = tr_options_field('tr_theme_options.modal_service_opt4_vi') ?: 'Dây chuyền cán vuốt thép La và Thép tròn đặc';
    $modal_service_opt5 = tr_options_field('tr_theme_options.modal_service_opt5_vi') ?: 'Dịch vụ hỗ trợ kỹ thuật phụ trợ';
    $modal_service_opt6 = tr_options_field('tr_theme_options.modal_service_opt6_vi') ?: 'Dịch vụ khác';
} else {
    $footer_company_desc = tr_options_field('tr_theme_options.footer_company_desc') ?: 'A leading provider and processor of steel plates and coils in Vietnam.';
    $footer_hq_title = tr_options_field('tr_theme_options.footer_hq_title') ?: 'HEADQUARTERS';
    $footer_hq_address = tr_options_field('tr_theme_options.footer_hq_address') ?: 'Lot J9-10-17A-18, Road No. 6, Hai Son Industrial Park, Duc Hoa Commune, Tay Ninh Province, Vietnam';
    $footer_hcm_title = tr_options_field('tr_theme_options.footer_hcm_title') ?: 'HO CHI MINH OFFICE';
    $footer_hcm_address = tr_options_field('tr_theme_options.footer_hcm_address') ?: '221/6-8 Le Trong Tan, Son Ky Ward, Ho Chi Minh City';
    $footer_col3_title = tr_options_field('tr_theme_options.footer_col3_title') ?: 'QUICK LINKS';
    $footer_col4_title = tr_options_field('tr_theme_options.footer_col4_title') ?: 'SERVICES';
    $footer_copy_line1 = tr_options_field('tr_theme_options.footer_copy_line1') ?: 'Copyright © 2009 by DOUBLE T ENGINEERING CO., LTD';
    $footer_copy_line2 = tr_options_field('tr_theme_options.footer_copy_line2') ?: 'Maximize Online Power by <strong>THEMAX</strong>';
    $footer_profile_text = tr_options_field('tr_theme_options.footer_profile_text') ?: '2T Profile';
    $footer_privacy_text = tr_options_field('tr_theme_options.footer_privacy_text') ?: 'Privacy Policy';
    $footer_privacy_raw = tr_options_field('tr_theme_options.footer_privacy_link') ?: tr_options_field('tr_theme_options.footer_privacy_link_vi');
    $footer_privacy_url = $themax_format_footer_link($footer_privacy_raw);
    $footer_custom_profile_link = tr_options_field('tr_theme_options.footer_profile_link') ?: tr_options_field('tr_theme_options.header_profile_link');

    // Modal consultation
    $modal_badge = tr_options_field('tr_theme_options.modal_badge') ?: 'FREE CONSULTATION';
    $modal_title = tr_options_field('tr_theme_options.modal_title') ?: 'Powering Progress<br> with <span class="txt-teal">Double</span> <span class="txt-red">T</span>';
    $modal_desc = tr_options_field('tr_theme_options.modal_desc') ?: 'Delivering high-quality steel products and reliable solutions engineered for strength, precision, and long-term performance across every project.';
    $modal_disclaimer = tr_options_field('tr_theme_options.modal_disclaimer') ?: 'We are committed to maintaining the confidentiality of information and using the data solely for advisory purposes.';
    $modal_submit_text = tr_options_field('tr_theme_options.modal_submit_text') ?: 'SEND INFORMATION';
    $modal_subnote = tr_options_field('tr_theme_options.modal_subnote') ?: 'You will receive a confirmation email shortly.';

    $modal_form_name_label = tr_options_field('tr_theme_options.modal_form_name_label') ?: 'Full name';
    $modal_form_name_placeholder = tr_options_field('tr_theme_options.modal_form_name_placeholder') ?: 'Your name';
    $modal_form_email_label = tr_options_field('tr_theme_options.modal_form_email_label') ?: 'Email';
    $modal_form_email_placeholder = tr_options_field('tr_theme_options.modal_form_email_placeholder') ?: 'Enter your email';
    $modal_form_phone_label = tr_options_field('tr_theme_options.modal_form_phone_label') ?: 'Phone Number';
    $modal_form_phone_placeholder = tr_options_field('tr_theme_options.modal_form_phone_placeholder') ?: 'Enter your phone number';
    $modal_form_company_label = tr_options_field('tr_theme_options.modal_form_company_label') ?: 'Company';
    $modal_form_company_placeholder = tr_options_field('tr_theme_options.modal_form_company_placeholder') ?: 'Enter your company name';
    $modal_form_service_label = tr_options_field('tr_theme_options.modal_form_service_label') ?: 'Which service are you interested in?';
    $modal_form_service_placeholder = tr_options_field('tr_theme_options.modal_form_service_placeholder') ?: 'Please select a service';

    $modal_service_opt1 = tr_options_field('tr_theme_options.modal_service_opt1') ?: 'Slitting Line';
    $modal_service_opt2 = tr_options_field('tr_theme_options.modal_service_opt2') ?: 'Cut-to-Length Line';
    $modal_service_opt3 = tr_options_field('tr_theme_options.modal_service_opt3') ?: 'Máy cắt Amada & Tấm Reshear Line';
    $modal_service_opt4 = tr_options_field('tr_theme_options.modal_service_opt4') ?: 'Dây chuyền cán vuốt thép La và Thép tròn đặc';
    $modal_service_opt5 = tr_options_field('tr_theme_options.modal_service_opt5') ?: 'Dịch vụ hỗ trợ kỹ thuật phụ trợ';
    $modal_service_opt6 = tr_options_field('tr_theme_options.modal_service_opt6') ?: 'Other Services';
}

$footer_hq_phone = tr_options_field('tr_theme_options.footer_hq_phone') ?: '0272.249.6667 – 0272.249.6668 – 0272.249.6669';
$footer_hcm_email = tr_options_field('tr_theme_options.footer_hcm_email') ?: '2t@2tsteel.com';
$footer_hcm_phone = tr_options_field('tr_theme_options.footer_hcm_phone') ?: '028.3816.5435 – 028.3816.5436';
$footer_profile_url = $footer_custom_profile_link ? $themax_format_footer_link($footer_custom_profile_link) : ($header_profile_file ? wp_get_attachment_url($header_profile_file) : $themax_format_footer_link(tr_options_field('tr_theme_options.header_profile_link')));
$footer_vr360_url = tr_options_field('tr_theme_options.header_vr360_link') ?: '#';

// Nav menus for footer
$footer_nav_items = function_exists('themax_get_nav_menu_items') ? themax_get_nav_menu_items('footer_menu') : false;
$footer_service_items = function_exists('themax_get_nav_menu_items') ? themax_get_nav_menu_items('footer_service') : false;
?>
    <footer class="footer">
        <div class="footer-main">
            <div class="footer-watermark">
                <img src="<?php echo esc_url($footer_watermark_url); ?>" alt="Double T Watermark">
            </div>

            <div class="container grid">
                <div class="footer-col footer-col-1">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo-link">
                        <img src="<?php echo esc_url($footer_logo_url); ?>" alt="Double T Logo" class="footer-logo">
                    </a>
                    <div class="footer-company-name txt txt-18 txt-16_mb txt-semi">
                        <span class="txt-red"><?php echo esc_html($footer_company_name_red); ?></span> <span class="txt-teal"><?php echo esc_html($footer_company_name_teal); ?></span>
                    </div>
                    <p class="txt txt-14 footer-company-desc">
                        <?php echo esc_html($footer_company_desc); ?>
                    </p>
                    <div class="txt txt-14 footer-tax">
                        <strong>Tax ID:</strong> <?php echo esc_html($footer_tax_id); ?>
                    </div>
                    <div class="footer-socials">
                        <a href="<?php echo esc_url($footer_social_fb); ?>" <?php if ($footer_social_fb !== '#') echo 'target="_blank" rel="noopener"'; ?> class="footer-social-btn cut-diagonal" aria-label="Facebook">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                            </svg>
                        </a>
                        <!-- <a href="<?php echo esc_url($footer_social_insta); ?>" <?php if ($footer_social_insta !== '#') echo 'target="_blank" rel="noopener"'; ?> class="footer-social-btn cut-diagonal" aria-label="Instagram">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                            </svg>
                        </a>
                        <a href="<?php echo esc_url($footer_social_x); ?>" <?php if ($footer_social_x !== '#') echo 'target="_blank" rel="noopener"'; ?> class="footer-social-btn cut-diagonal" aria-label="X">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a> -->
                        <a href="<?php echo esc_url($footer_social_yt); ?>" <?php if ($footer_social_yt !== '#') echo 'target="_blank" rel="noopener"'; ?> class="footer-social-btn cut-diagonal" aria-label="YouTube">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z" />
                                <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="#FFFFFF" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="footer-col footer-col-2">
                    <div class="footer-block">
                        <h4 class="footer-col-title txt-15_mb"><?php echo esc_html($footer_hq_title); ?></h4>
                        <div class="footer-contact-item">
                            <div class="footer-contact-icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.9999 11.8079C8.2249 11.8079 6.7749 10.3662 6.7749 8.58288C6.7749 6.79954 8.2249 5.36621 9.9999 5.36621C11.7749 5.36621 13.2249 6.80788 13.2249 8.59121C13.2249 10.3745 11.7749 11.8079 9.9999 11.8079ZM9.9999 6.61621C8.91657 6.61621 8.0249 7.49954 8.0249 8.59121C8.0249 9.68288 8.90824 10.5662 9.9999 10.5662C11.0916 10.5662 11.9749 9.68288 11.9749 8.59121C11.9749 7.49954 11.0832 6.61621 9.9999 6.61621Z"
                                        fill="#EB1F30" />
                                    <path
                                        d="M9.9999 18.967C8.76657 18.967 7.5249 18.5003 6.55824 17.5753C4.0999 15.2087 1.38324 11.4337 2.40824 6.94199C3.33324 2.86699 6.89157 1.04199 9.9999 1.04199C9.9999 1.04199 9.9999 1.04199 10.0082 1.04199C13.1166 1.04199 16.6749 2.86699 17.5999 6.95033C18.6166 11.442 15.8999 15.2087 13.4416 17.5753C12.4749 18.5003 11.2332 18.967 9.9999 18.967ZM9.9999 2.29199C7.5749 2.29199 4.45824 3.58366 3.63324 7.21699C2.73324 11.142 5.1999 14.5253 7.43324 16.667C8.8749 18.0587 11.1332 18.0587 12.5749 16.667C14.7999 14.5253 17.2666 11.142 16.3832 7.21699C15.5499 3.58366 12.4249 2.29199 9.9999 2.29199Z"
                                        fill="#EB1F30" />
                                </svg>
                            </div>
                            <div class="footer-contact-text txt txt-14">
                                <?php echo esc_html($footer_hq_address); ?>
                            </div>
                        </div>
                        <div class="footer-contact-item">
                            <div class="footer-contact-icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.5417 18.9587C13.6001 18.9587 12.6084 18.7337 11.5834 18.3003C10.5834 17.8753 9.57508 17.292 8.59175 16.5837C7.61675 15.867 6.67508 15.067 5.78341 14.192C4.90008 13.3003 4.10008 12.3587 3.39175 11.392C2.67508 10.392 2.10008 9.39199 1.69175 8.42532C1.25841 7.39199 1.04175 6.39199 1.04175 5.45033C1.04175 4.80033 1.15841 4.18366 1.38341 3.60866C1.61675 3.01699 1.99175 2.46699 2.50008 1.99199C3.14175 1.35866 3.87508 1.04199 4.65842 1.04199C4.98342 1.04199 5.31675 1.11699 5.60008 1.25033C5.92508 1.40033 6.20008 1.62533 6.40008 1.92533L8.33342 4.65033C8.50842 4.89199 8.64175 5.12533 8.73341 5.35866C8.84175 5.60866 8.90008 5.85866 8.90008 6.10033C8.90008 6.41699 8.80841 6.72533 8.63341 7.01699C8.50841 7.24199 8.31675 7.48366 8.07508 7.72533L7.50842 8.31699C7.51675 8.34199 7.52508 8.35866 7.53341 8.37533C7.63342 8.55033 7.83341 8.85033 8.21675 9.30033C8.62508 9.76699 9.00842 10.192 9.39175 10.5837C9.88342 11.067 10.2917 11.4503 10.6751 11.767C11.1501 12.167 11.4584 12.367 11.6417 12.4587L11.6251 12.5003L12.2334 11.9003C12.4917 11.642 12.7417 11.4503 12.9834 11.3253C13.4417 11.042 14.0251 10.992 14.6084 11.2337C14.8251 11.3253 15.0584 11.4503 15.3084 11.6253L18.0751 13.592C18.3834 13.8003 18.6084 14.067 18.7417 14.3837C18.8667 14.7003 18.9251 14.992 18.9251 15.2837C18.9251 15.6837 18.8334 16.0837 18.6584 16.4587C18.4834 16.8337 18.2667 17.1587 17.9917 17.4587C17.5167 17.9837 17.0001 18.3587 16.4001 18.6003C15.8251 18.8337 15.2001 18.9587 14.5417 18.9587ZM4.65842 2.29199C4.20008 2.29199 3.77508 2.49199 3.36675 2.89199C2.98341 3.25033 2.71675 3.64199 2.55008 4.06699C2.37508 4.50033 2.29175 4.95866 2.29175 5.45033C2.29175 6.22533 2.47508 7.06699 2.84175 7.93366C3.21675 8.81699 3.74175 9.73366 4.40841 10.6503C5.07508 11.567 5.83342 12.4587 6.66675 13.3003C7.50008 14.1253 8.40008 14.892 9.32508 15.567C10.2251 16.2253 11.1501 16.7587 12.0667 17.142C13.4917 17.7503 14.8251 17.892 15.9251 17.4337C16.3501 17.2587 16.7251 16.992 17.0667 16.6087C17.2584 16.4003 17.4084 16.1753 17.5334 15.9087C17.6334 15.7003 17.6834 15.4837 17.6834 15.267C17.6834 15.1337 17.6584 15.0003 17.5917 14.8503C17.5667 14.8003 17.5167 14.7087 17.3584 14.6003L14.5917 12.6337C14.4251 12.517 14.2751 12.4337 14.1334 12.3753C13.9501 12.3003 13.8751 12.2253 13.5917 12.4003C13.4251 12.4837 13.2751 12.6087 13.1084 12.7753L12.4751 13.4003C12.1501 13.717 11.6501 13.792 11.2667 13.6503L11.0417 13.5503C10.7001 13.367 10.3001 13.0837 9.85841 12.7087C9.45842 12.367 9.02508 11.967 8.50008 11.4503C8.09175 11.0337 7.68341 10.592 7.25842 10.1003C6.86675 9.64199 6.58342 9.25033 6.40841 8.92533L6.30841 8.67533C6.25842 8.48366 6.24175 8.37533 6.24175 8.25866C6.24175 7.95866 6.35008 7.69199 6.55841 7.48366L7.18341 6.83366C7.35008 6.66699 7.47508 6.50866 7.55841 6.36699C7.62508 6.25866 7.65008 6.16699 7.65008 6.08366C7.65008 6.01699 7.62508 5.91699 7.58342 5.81699C7.52508 5.68366 7.43341 5.53366 7.31675 5.37533L5.38341 2.64199C5.30008 2.52533 5.20008 2.44199 5.07508 2.38366C4.94175 2.32533 4.80008 2.29199 4.65842 2.29199ZM11.6251 12.5087L11.4917 13.0753L11.7167 12.492C11.6751 12.4837 11.6417 12.492 11.6251 12.5087Z"
                                        fill="#EB1F30" />
                                </svg>
                            </div>
                            <div class="footer-contact-text txt txt-14">
                                <?php echo esc_html($footer_hq_phone); ?>
                            </div>
                        </div>
                    </div>

                    <div class="footer-block">
                        <h4 class="footer-col-title txt-15_mb"><?php echo esc_html($footer_hcm_title); ?></h4>
                        <div class="footer-contact-item">
                            <div class="footer-contact-icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.9999 11.8079C8.2249 11.8079 6.7749 10.3662 6.7749 8.58288C6.7749 6.79954 8.2249 5.36621 9.9999 5.36621C11.7749 5.36621 13.2249 6.80788 13.2249 8.59121C13.2249 10.3745 11.7749 11.8079 9.9999 11.8079ZM9.9999 6.61621C8.91657 6.61621 8.0249 7.49954 8.0249 8.59121C8.0249 9.68288 8.90824 10.5662 9.9999 10.5662C11.0916 10.5662 11.9749 9.68288 11.9749 8.59121C11.9749 7.49954 11.0832 6.61621 9.9999 6.61621Z"
                                        fill="#EB1F30" />
                                    <path
                                        d="M9.9999 18.967C8.76657 18.967 7.5249 18.5003 6.55824 17.5753C4.0999 15.2087 1.38324 11.4337 2.40824 6.94199C3.33324 2.86699 6.89157 1.04199 9.9999 1.04199C9.9999 1.04199 9.9999 1.04199 10.0082 1.04199C13.1166 1.04199 16.6749 2.86699 17.5999 6.95033C18.6166 11.442 15.8999 15.2087 13.4416 17.5753C12.4749 18.5003 11.2332 18.967 9.9999 18.967ZM9.9999 2.29199C7.5749 2.29199 4.45824 3.58366 3.63324 7.21699C2.73324 11.142 5.1999 14.5253 7.43324 16.667C8.8749 18.0587 11.1332 18.0587 12.5749 16.667C14.7999 14.5253 17.2666 11.142 16.3832 7.21699C15.5499 3.58366 12.4249 2.29199 9.9999 2.29199Z"
                                        fill="#EB1F30" />
                                </svg>
                            </div>
                            <div class="footer-contact-text txt txt-14">
                                <?php echo esc_html($footer_hcm_address); ?>
                            </div>
                        </div>
                        <div class="footer-contact-item">
                            <div class="footer-contact-icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.1667 17.7087H5.83341C2.79175 17.7087 1.04175 15.9587 1.04175 12.917V7.08366C1.04175 4.04199 2.79175 2.29199 5.83341 2.29199H14.1667C17.2084 2.29199 18.9584 4.04199 18.9584 7.08366V12.917C18.9584 15.9587 17.2084 17.7087 14.1667 17.7087ZM5.83341 3.54199C3.45008 3.54199 2.29175 4.70033 2.29175 7.08366V12.917C2.29175 15.3003 3.45008 16.4587 5.83341 16.4587H14.1667C16.5501 16.4587 17.7084 15.3003 17.7084 12.917V7.08366C17.7084 4.70033 16.5501 3.54199 14.1667 3.54199H5.83341Z"
                                        fill="#EB1F30" />
                                    <path
                                        d="M9.99973 10.725C9.29973 10.725 8.5914 10.5083 8.04974 10.0666L5.4414 7.98331C5.17473 7.76664 5.12474 7.37497 5.3414 7.10831C5.55807 6.84164 5.94974 6.79164 6.21641 7.00831L8.82473 9.09164C9.45806 9.59998 10.5331 9.59998 11.1664 9.09164L13.7747 7.00831C14.0414 6.79164 14.4414 6.83331 14.6497 7.10831C14.8664 7.37497 14.8247 7.77498 14.5497 7.98331L11.9414 10.0666C11.4081 10.5083 10.6997 10.725 9.99973 10.725Z"
                                        fill="#EB1F30" />
                                </svg>
                            </div>
                            <div class="footer-contact-text txt txt-14">
                                <a href="mailto:<?php echo esc_attr($footer_hcm_email); ?>"><?php echo esc_html($footer_hcm_email); ?></a>
                            </div>
                        </div>
                        <div class="footer-contact-item">
                            <div class="footer-contact-icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.5417 18.9587C13.6001 18.9587 12.6084 18.7337 11.5834 18.3003C10.5834 17.8753 9.57508 17.292 8.59175 16.5837C7.61675 15.867 6.67508 15.067 5.78341 14.192C4.90008 13.3003 4.10008 12.3587 3.39175 11.392C2.67508 10.392 2.10008 9.39199 1.69175 8.42532C1.25841 7.39199 1.04175 6.39199 1.04175 5.45033C1.04175 4.80033 1.15841 4.18366 1.38341 3.60866C1.61675 3.01699 1.99175 2.46699 2.50008 1.99199C3.14175 1.35866 3.87508 1.04199 4.65842 1.04199C4.98342 1.04199 5.31675 1.11699 5.60008 1.25033C5.92508 1.40033 6.20008 1.62533 6.40008 1.92533L8.33342 4.65033C8.50842 4.89199 8.64175 5.12533 8.73341 5.35866C8.84175 5.60866 8.90008 5.85866 8.90008 6.10033C8.90008 6.41699 8.80841 6.72533 8.63341 7.01699C8.50841 7.24199 8.31675 7.48366 8.07508 7.72533L7.50842 8.31699C7.51675 8.34199 7.52508 8.35866 7.53341 8.37533C7.63342 8.55033 7.83341 8.85033 8.21675 9.30033C8.62508 9.76699 9.00842 10.192 9.39175 10.5837C9.88342 11.067 10.2917 11.4503 10.6751 11.767C11.1501 12.167 11.4584 12.367 11.6417 12.4587L11.6251 12.5003L12.2334 11.9003C12.4917 11.642 12.7417 11.4503 12.9834 11.3253C13.4417 11.042 14.0251 10.992 14.6084 11.2337C14.8251 11.3253 15.0584 11.4503 15.3084 11.6253L18.0751 13.592C18.3834 13.8003 18.6084 14.067 18.7417 14.3837C18.8667 14.7003 18.9251 14.992 18.9251 15.2837C18.9251 15.6837 18.8334 16.0837 18.6584 16.4587C18.4834 16.8337 18.2667 17.1587 17.9917 17.4587C17.5167 17.9837 17.0001 18.3587 16.4001 18.6003C15.8251 18.8337 15.2001 18.9587 14.5417 18.9587ZM4.65842 2.29199C4.20008 2.29199 3.77508 2.49199 3.36675 2.89199C2.98341 3.25033 2.71675 3.64199 2.55008 4.06699C2.37508 4.50033 2.29175 4.95866 2.29175 5.45033C2.29175 6.22533 2.47508 7.06699 2.84175 7.93366C3.21675 8.81699 3.74175 9.73366 4.40841 10.6503C5.07508 11.567 5.83342 12.4587 6.66675 13.3003C7.50008 14.1253 8.40008 14.892 9.32508 15.567C10.2251 16.2253 11.1501 16.7587 12.0667 17.142C13.4917 17.7503 14.8251 17.892 15.9251 17.4337C16.3501 17.2587 16.7251 16.992 17.0667 16.6087C17.2584 16.4003 17.4084 16.1753 17.5334 15.9087C17.6334 15.7003 17.6834 15.4837 17.6834 15.267C17.6834 15.1337 17.6584 15.0003 17.5917 14.8503C17.5667 14.8003 17.5167 14.7087 17.3584 14.6003L14.5917 12.6337C14.4251 12.517 14.2751 12.4337 14.1334 12.3753C13.9501 12.3003 13.8751 12.2253 13.5917 12.4003C13.4251 12.4837 13.2751 12.6087 13.1084 12.7753L12.4751 13.4003C12.1501 13.717 11.6501 13.792 11.2667 13.6503L11.0417 13.5503C10.7001 13.367 10.3001 13.0837 9.85841 12.7087C9.45842 12.367 9.02508 11.967 8.50008 11.4503C8.09175 11.0337 7.68341 10.592 7.25842 10.1003C6.86675 9.64199 6.58342 9.25033 6.40841 8.92533L6.30841 8.67533C6.25842 8.48366 6.24175 8.37533 6.24175 8.25866C6.24175 7.95866 6.35008 7.69199 6.55841 7.48366L7.18341 6.83366C7.35008 6.66699 7.47508 6.50866 7.55841 6.36699C7.62508 6.25866 7.65008 6.16699 7.65008 6.08366C7.65008 6.01699 7.62508 5.91699 7.58342 5.81699C7.52508 5.68366 7.43341 5.53366 7.31675 5.37533L5.38341 2.64199C5.30008 2.52533 5.20008 2.44199 5.07508 2.38366C4.94175 2.32533 4.80008 2.29199 4.65842 2.29199ZM11.6251 12.5087L11.4917 13.0753L11.7167 12.492C11.6751 12.4837 11.6417 12.492 11.6251 12.5087Z"
                                        fill="#EB1F30" />
                                </svg>
                            </div>
                            <div class="footer-contact-text txt txt-14">
                                <?php echo esc_html($footer_hcm_phone); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-col footer-col-3">
                    <?php if ($footer_col3_title) : ?>
                        <h4 class="footer-col-title txt-15_mb"><?php echo esc_html($footer_col3_title); ?></h4>
                    <?php endif; ?>
                    <ul class="footer-links item1">
                        <?php if (!empty($footer_nav_items)) : ?>
                            <?php foreach ($footer_nav_items as $item) : ?>
                                <li><a href="<?php echo esc_url($item->url); ?>" class="txt txt-14" <?php if (!empty($item->target)) echo 'target="' . esc_attr($item->target) . '"'; ?>><?php echo esc_html($item->title); ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if (!empty($footer_vr360_url) && $footer_vr360_url !== '#') : ?>
                            <li><a href="<?php echo esc_url($footer_vr360_url); ?>" target="_blank" rel="noopener" class="txt txt-14">VR360</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="footer-col footer-col-4">
                    <?php if ($footer_col4_title) : ?>
                        <h4 class="footer-col-title txt-15_mb"><?php echo esc_html($footer_col4_title); ?></h4>
                    <?php endif; ?>
                    <ul class="footer-links">
                        <?php if (!empty($footer_service_items)) : ?>
                            <?php foreach ($footer_service_items as $item) : ?>
                                <li><a href="<?php echo esc_url($item->url); ?>" class="txt txt-14" <?php if (!empty($item->target)) echo 'target="' . esc_attr($item->target) . '"'; ?>><?php echo esc_html($item->title); ?></a></li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <li><a href="<?php echo esc_url(home_url('/product-service/')); ?>" class="txt txt-14">Slitting Line</a></li>
                            <li><a href="<?php echo esc_url(home_url('/product-service/')); ?>" class="txt txt-14">Cut-to-Length Line</a></li>
                            <li><a href="<?php echo esc_url(home_url('/product-service/')); ?>" class="txt txt-14">Máy cắt Amada &amp; Tấm Reshear Line</a></li>
                            <li><a href="<?php echo esc_url(home_url('/product-service/')); ?>" class="txt txt-14">Dây chuyền cán vuốt thép La và Thép tròn đặc</a></li>
                            <li><a href="<?php echo esc_url(home_url('/product-service/')); ?>" class="txt txt-14">Dịch vụ hỗ trợ kỹ thuật phụ trợ</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container footer-bottom-inner">
                <div class="footer-copy txt txt-13">
                    <div class="footer-copy_line1"><?php echo esc_html($footer_copy_line1); ?></div>
                    <div class="dot desktop"></div>
                    <div class="footer-copy_line2"><?php echo wp_kses_post($footer_copy_line2); ?></div>
                </div>
                <div class="footer-policy txt txt-13 txt-med">
                    <?php if ($footer_profile_text) : ?>
                        <a href="<?php echo esc_url($footer_profile_url); ?>" <?php if ($header_profile_file && empty($footer_custom_profile_link)) echo 'target="_blank" download'; ?>><?php echo esc_html($footer_profile_text); ?></a>
                    <?php endif; ?>
                    <?php if ($footer_profile_text) : ?>
                        <span class="divider"></span>
                    <?php endif; ?>
                    <?php if ($footer_privacy_text) : ?>
                        <a href="<?php echo esc_url($footer_privacy_url); ?>"><?php echo esc_html($footer_privacy_text); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </footer>

    <button class="scroll-top-btn cut-diagonal" id="scrollTopBtn" aria-label="Scroll to top">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="18 15 12 9 6 15"></polyline>
        </svg>
    </button>

    <div class="modal-backdrop" id="consultationModal" style="display: none;" aria-hidden="true" role="dialog" aria-modal="true"
        aria-labelledby="modalTitle" data-lenis-prevent>
        <div class="modal-container" data-lenis-prevent>
            <button class="modal-close-btn cut-diagonal" id="modalCloseBtn" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <div class="modal-body">
                <div class="modal-col-left">
                    <div class="modal-watermark desktop">
                        <img src="<?php echo esc_url($footer_watermark_url); ?>" alt="Double T Watermark">
                    </div>

                    <div class="modal-info-top">
                        <div class="label red-light cut-diagonal cut-sm modal-label">
                            <span class="txt txt-13 txt-bold"><?php echo esc_html($modal_badge); ?></span>
                        </div>
                        <h2 class="heading h2 modal-title h4_mb" id="modalTitle">
                            <?php echo wp_kses_post($modal_title); ?>
                        </h2>
                        <p class="txt txt-14 modal-desc txt-13_mb">
                            <?php echo esc_html($modal_desc); ?>
                        </p>
                    </div>

                    <div class="modal-divider desktop"></div>

                    <div class="modal-contact-grid desktop">
                        <div class="modal-contact-col">
                            <h4 class="txt txt-13 txt-semi modal-contact-heading"><?php echo esc_html($footer_hq_title); ?></h4>
                            <div class="modal-contact-item">
                                <div class="modal-contact-icon">
                                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                        <path
                                            d="M9.9999 11.8079C8.2249 11.8079 6.7749 10.3662 6.7749 8.58288C6.7749 6.79954 8.2249 5.36621 9.9999 5.36621C11.7749 5.36621 13.2249 6.80788 13.2249 8.59121C13.2249 10.3745 11.7749 11.8079 9.9999 11.8079ZM9.9999 6.61621C8.91657 6.61621 8.0249 7.49954 8.0249 8.59121C8.0249 9.68288 8.90824 10.5662 9.9999 10.5662C11.0916 10.5662 11.9749 9.68288 11.9749 8.59121C11.9749 7.49954 11.0832 6.61621 9.9999 6.61621Z"
                                            fill="#EB1F30" />
                                        <path
                                            d="M9.9999 18.967C8.76657 18.967 7.5249 18.5003 6.55824 17.5753C4.0999 15.2087 1.38324 11.4337 2.40824 6.94199C3.33324 2.86699 6.89157 1.04199 9.9999 1.04199C9.9999 1.04199 9.9999 1.04199 10.0082 1.04199C13.1166 1.04199 16.6749 2.86699 17.5999 6.95033C18.6166 11.442 15.8999 15.2087 13.4416 17.5753C12.4749 18.5003 11.2332 18.967 9.9999 18.967ZM9.9999 2.29199C7.5749 2.29199 4.45824 3.58366 3.63324 7.21699C2.73324 11.142 5.1999 14.5253 7.43324 16.667C8.8749 18.0587 11.1332 18.0587 12.5749 16.667C14.7999 14.5253 17.2666 11.142 16.3832 7.21699C15.5499 3.58366 12.4249 2.29199 9.9999 2.29199Z"
                                            fill="#EB1F30" />
                                    </svg>
                                </div>
                                <span class="txt txt-13 modal-contact-text"><?php echo esc_html($footer_hq_address); ?></span>
                            </div>
                            <div class="modal-contact-item">
                                <div class="modal-contact-icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14.5417 18.9584C13.6 18.9584 12.6084 18.7334 11.5834 18.3001C10.5834 17.8751 9.57502 17.2917 8.59169 16.5834C7.61669 15.8667 6.67502 15.0667 5.78335 14.1917C4.90002 13.3001 4.10002 12.3584 3.39169 11.3917C2.67502 10.3917 2.10002 9.39175 1.69169 8.42508C1.25835 7.39175 1.04169 6.39175 1.04169 5.45008C1.04169 4.80008 1.15835 4.18341 1.38335 3.60841C1.61669 3.01675 1.99169 2.46675 2.50002 1.99175C3.14169 1.35841 3.87502 1.04175 4.65835 1.04175C4.98335 1.04175 5.31669 1.11675 5.60002 1.25008C5.92502 1.40008 6.20002 1.62508 6.40002 1.92508L8.33335 4.65008C8.50835 4.89175 8.64169 5.12508 8.73335 5.35841C8.84169 5.60841 8.90002 5.85841 8.90002 6.10008C8.90002 6.41675 8.80835 6.72508 8.63335 7.01675C8.50835 7.24175 8.31669 7.48342 8.07502 7.72508L7.50835 8.31675C7.51669 8.34175 7.52502 8.35841 7.53335 8.37508C7.63335 8.55008 7.83335 8.85008 8.21669 9.30008C8.62502 9.76675 9.00835 10.1917 9.39169 10.5834C9.88335 11.0667 10.2917 11.4501 10.675 11.7667C11.15 12.1667 11.4584 12.3667 11.6417 12.4584L11.625 12.5001L12.2334 11.9001C12.4917 11.6417 12.7417 11.4501 12.9834 11.3251C13.4417 11.0417 14.025 10.9917 14.6084 11.2334C14.825 11.3251 15.0584 11.4501 15.3084 11.6251L18.075 13.5917C18.3834 13.8001 18.6084 14.0667 18.7417 14.3834C18.8667 14.7001 18.925 14.9917 18.925 15.2834C18.925 15.6834 18.8334 16.0834 18.6584 16.4584C18.4834 16.8334 18.2667 17.1584 17.9917 17.4584C17.5167 17.9834 17 18.3584 16.4 18.6001C15.825 18.8334 15.2 18.9584 14.5417 18.9584ZM4.65835 2.29175C4.20002 2.29175 3.77502 2.49175 3.36669 2.89175C2.98335 3.25008 2.71669 3.64175 2.55002 4.06675C2.37502 4.50008 2.29169 4.95841 2.29169 5.45008C2.29169 6.22508 2.47502 7.06675 2.84169 7.93341C3.21669 8.81675 3.74169 9.73341 4.40835 10.6501C5.07502 11.5667 5.83335 12.4584 6.66669 13.3001C7.50002 14.1251 8.40002 14.8917 9.32502 15.5667C10.225 16.2251 11.15 16.7584 12.0667 17.1417C13.4917 17.7501 14.825 17.8917 15.925 17.4334C16.35 17.2584 16.725 16.9917 17.0667 16.6084C17.2584 16.4001 17.4084 16.1751 17.5334 15.9084C17.6334 15.7001 17.6834 15.4834 17.6834 15.2667C17.6834 15.1334 17.6584 15.0001 17.5917 14.8501C17.5667 14.8001 17.5167 14.7084 17.3584 14.6001L14.5917 12.6334C14.425 12.5167 14.275 12.4334 14.1334 12.3751C13.95 12.3001 13.875 12.2251 13.5917 12.4001C13.425 12.4834 13.275 12.6084 13.1084 12.7751L12.475 13.4001C12.15 13.7167 11.65 13.7917 11.2667 13.6501L11.0417 13.5501C10.7 13.3667 10.3 13.0834 9.85835 12.7084C9.45835 12.3667 9.02502 11.9667 8.50002 11.4501C8.09169 11.0334 7.68335 10.5917 7.25835 10.1001C6.86669 9.64175 6.58335 9.25008 6.40835 8.92508L6.30835 8.67508C6.25835 8.48341 6.24169 8.37508 6.24169 8.25841C6.24169 7.95841 6.35002 7.69175 6.55835 7.48341L7.18335 6.83341C7.35002 6.66675 7.47502 6.50841 7.55835 6.36675C7.62502 6.25841 7.65002 6.16675 7.65002 6.08341C7.65002 6.01675 7.62502 5.91675 7.58335 5.81675C7.52502 5.68341 7.43335 5.53341 7.31669 5.37508L5.38335 2.64175C5.30002 2.52508 5.20002 2.44175 5.07502 2.38341C4.94169 2.32508 4.80002 2.29175 4.65835 2.29175ZM11.625 12.5084L11.4917 13.0751L11.7167 12.4917C11.675 12.4834 11.6417 12.4917 11.625 12.5084Z" fill="#EB1F30"/>
</svg>

                                </div>
                                <span class="txt txt-13 modal-contact-text"><?php echo esc_html($footer_hq_phone); ?></span>
                            </div>
                        </div>

                        <div class="modal-contact-col">
                            <h4 class="txt txt-13 txt-semi modal-contact-heading"><?php echo esc_html($footer_hcm_title); ?></h4>
                            <div class="modal-contact-item">
                                <div class="modal-contact-icon">
                                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                        <path
                                            d="M9.9999 11.8079C8.2249 11.8079 6.7749 10.3662 6.7749 8.58288C6.7749 6.79954 8.2249 5.36621 9.9999 5.36621C11.7749 5.36621 13.2249 6.80788 13.2249 8.59121C13.2249 10.3745 11.7749 11.8079 9.9999 11.8079ZM9.9999 6.61621C8.91657 6.61621 8.0249 7.49954 8.0249 8.59121C8.0249 9.68288 8.90824 10.5662 9.9999 10.5662C11.0916 10.5662 11.9749 9.68288 11.9749 8.59121C11.9749 7.49954 11.0832 6.61621 9.9999 6.61621Z"
                                            fill="#EB1F30" />
                                        <path
                                            d="M9.9999 18.967C8.76657 18.967 7.5249 18.5003 6.55824 17.5753C4.0999 15.2087 1.38324 11.4337 2.40824 6.94199C3.33324 2.86699 6.89157 1.04199 9.9999 1.04199C9.9999 1.04199 9.9999 1.04199 10.0082 1.04199C13.1166 1.04199 16.6749 2.86699 17.5999 6.95033C18.6166 11.442 15.8999 15.2087 13.4416 17.5753C12.4749 18.5003 11.2332 18.967 9.9999 18.967ZM9.9999 2.29199C7.5749 2.29199 4.45824 3.58366 3.63324 7.21699C2.73324 11.142 5.1999 14.5253 7.43324 16.667C8.8749 18.0587 11.1332 18.0587 12.5749 16.667C14.7999 14.5253 17.2666 11.142 16.3832 7.21699C15.5499 3.58366 12.4249 2.29199 9.9999 2.29199Z"
                                            fill="#EB1F30" />
                                    </svg>
                                </div>
                                <span class="txt txt-13 modal-contact-text"><?php echo esc_html($footer_hcm_address); ?></span>
                            </div>
                            <div class="modal-contact-item">
                                <div class="modal-contact-icon">
                                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                        <path
                                            d="M14.1667 17.7087H5.83341C2.79175 17.7087 1.04175 15.9587 1.04175 12.917V7.08366C1.04175 4.04199 2.79175 2.29199 5.83341 2.29199H14.1667C17.2084 2.29199 18.9584 4.04199 18.9584 7.08366V12.917C18.9584 15.9587 17.2084 17.7087 14.1667 17.7087ZM5.83341 3.54199C3.45008 3.54199 2.29175 4.70033 2.29175 7.08366V12.917C2.29175 15.3003 3.45008 16.4587 5.83341 16.4587H14.1667C16.5501 16.4587 17.7084 15.3003 17.7084 12.917V7.08366C17.7084 4.70033 16.5501 3.54199 14.1667 3.54199H5.83341Z"
                                            fill="#EB1F30" />
                                        <path
                                            d="M9.99973 10.725C9.29973 10.725 8.5914 10.5083 8.04974 10.0666L5.4414 7.98331C5.17473 7.76664 5.12474 7.37497 5.3414 7.10831C5.55807 6.84164 5.94974 6.79164 6.21641 7.00831L8.82473 9.09164C9.45806 9.59998 10.5331 9.59998 11.1664 9.09164L13.7747 7.00831C14.0414 6.79164 14.4414 6.83331 14.6497 7.10831C14.8664 7.37497 14.8247 7.77498 14.5497 7.98331L11.9414 10.0666C11.4081 10.5083 10.6997 10.725 9.99973 10.725Z"
                                            fill="#EB1F30" />
                                    </svg>
                                </div>
                                <a href="mailto:<?php echo esc_attr($footer_hcm_email); ?>" class="txt txt-13 modal-contact-text"><?php echo esc_html($footer_hcm_email); ?></a>
                            </div>
                            <div class="modal-contact-item">
                                <div class="modal-contact-icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14.5417 18.9584C13.6 18.9584 12.6084 18.7334 11.5834 18.3001C10.5834 17.8751 9.57502 17.2917 8.59169 16.5834C7.61669 15.8667 6.67502 15.0667 5.78335 14.1917C4.90002 13.3001 4.10002 12.3584 3.39169 11.3917C2.67502 10.3917 2.10002 9.39175 1.69169 8.42508C1.25835 7.39175 1.04169 6.39175 1.04169 5.45008C1.04169 4.80008 1.15835 4.18341 1.38335 3.60841C1.61669 3.01675 1.99169 2.46675 2.50002 1.99175C3.14169 1.35841 3.87502 1.04175 4.65835 1.04175C4.98335 1.04175 5.31669 1.11675 5.60002 1.25008C5.92502 1.40008 6.20002 1.62508 6.40002 1.92508L8.33335 4.65008C8.50835 4.89175 8.64169 5.12508 8.73335 5.35841C8.84169 5.60841 8.90002 5.85841 8.90002 6.10008C8.90002 6.41675 8.80835 6.72508 8.63335 7.01675C8.50835 7.24175 8.31669 7.48342 8.07502 7.72508L7.50835 8.31675C7.51669 8.34175 7.52502 8.35841 7.53335 8.37508C7.63335 8.55008 7.83335 8.85008 8.21669 9.30008C8.62502 9.76675 9.00835 10.1917 9.39169 10.5834C9.88335 11.0667 10.2917 11.4501 10.675 11.7667C11.15 12.1667 11.4584 12.3667 11.6417 12.4584L11.625 12.5001L12.2334 11.9001C12.4917 11.6417 12.7417 11.4501 12.9834 11.3251C13.4417 11.0417 14.025 10.9917 14.6084 11.2334C14.825 11.3251 15.0584 11.4501 15.3084 11.6251L18.075 13.5917C18.3834 13.8001 18.6084 14.0667 18.7417 14.3834C18.8667 14.7001 18.925 14.9917 18.925 15.2834C18.925 15.6834 18.8334 16.0834 18.6584 16.4584C18.4834 16.8334 18.2667 17.1584 17.9917 17.4584C17.5167 17.9834 17 18.3584 16.4 18.6001C15.825 18.8334 15.2 18.9584 14.5417 18.9584ZM4.65835 2.29175C4.20002 2.29175 3.77502 2.49175 3.36669 2.89175C2.98335 3.25008 2.71669 3.64175 2.55002 4.06675C2.37502 4.50008 2.29169 4.95841 2.29169 5.45008C2.29169 6.22508 2.47502 7.06675 2.84169 7.93341C3.21669 8.81675 3.74169 9.73341 4.40835 10.6501C5.07502 11.5667 5.83335 12.4584 6.66669 13.3001C7.50002 14.1251 8.40002 14.8917 9.32502 15.5667C10.225 16.2251 11.15 16.7584 12.0667 17.1417C13.4917 17.7501 14.825 17.8917 15.925 17.4334C16.35 17.2584 16.725 16.9917 17.0667 16.6084C17.2584 16.4001 17.4084 16.1751 17.5334 15.9084C17.6334 15.7001 17.6834 15.4834 17.6834 15.2667C17.6834 15.1334 17.6584 15.0001 17.5917 14.8501C17.5667 14.8001 17.5167 14.7084 17.3584 14.6001L14.5917 12.6334C14.425 12.5167 14.275 12.4334 14.1334 12.3751C13.95 12.3001 13.875 12.2251 13.5917 12.4001C13.425 12.4834 13.275 12.6084 13.1084 12.7751L12.475 13.4001C12.15 13.7167 11.65 13.7917 11.2667 13.6501L11.0417 13.5501C10.7 13.3667 10.3 13.0834 9.85835 12.7084C9.45835 12.3667 9.02502 11.9667 8.50002 11.4501C8.09169 11.0334 7.68335 10.5917 7.25835 10.1001C6.86669 9.64175 6.58335 9.25008 6.40835 8.92508L6.30835 8.67508C6.25835 8.48341 6.24169 8.37508 6.24169 8.25841C6.24169 7.95841 6.35002 7.69175 6.55835 7.48341L7.18335 6.83341C7.35002 6.66675 7.47502 6.50841 7.55835 6.36675C7.62502 6.25841 7.65002 6.16675 7.65002 6.08341C7.65002 6.01675 7.62502 5.91675 7.58335 5.81675C7.52502 5.68341 7.43335 5.53341 7.31669 5.37508L5.38335 2.64175C5.30002 2.52508 5.20002 2.44175 5.07502 2.38341C4.94169 2.32508 4.80002 2.29175 4.65835 2.29175ZM11.625 12.5084L11.4917 13.0751L11.7167 12.4917C11.675 12.4834 11.6417 12.4917 11.625 12.5084Z" fill="#EB1F30"/>
</svg>

                                </div>
                                <span class="txt txt-13 modal-contact-text"><?php echo esc_html($footer_hcm_phone); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-col-right">
                    <form class="modal-form" id="consultationForm">
                        <div class="modal-form-group">
                            <label for="fullName" class="req txt txt-13 txt-14_mb txt-semi modal-label-field"><?php echo esc_html($modal_form_name_label); ?>
                                <span class="req">*</span></label>
                            <input type="text" id="fullName" class="modal-input txt txt-14" placeholder="<?php echo esc_attr($modal_form_name_placeholder); ?>"
                                required>
                        </div>

                        <div class="modal-form-row">
                            <div class="modal-form-group">
                                <label for="email" class="req txt txt-13 txt-14_mb txt-semi modal-label-field"><?php echo esc_html($modal_form_email_label); ?>
                                    <span class="req">*</span></label>
                                <input type="email" id="email" class="modal-input txt txt-14"
                                    placeholder="<?php echo esc_attr($modal_form_email_placeholder); ?>" required>
                            </div>
                            <div class="modal-form-group">
                                <label for="phoneNumber"
                                    class="req txt txt-13 txt-14_mb txt-semi modal-label-field"><?php echo esc_html($modal_form_phone_label); ?>
                                    <span class="req">*</span></label>
                                <input type="tel" id="phoneNumber" class="modal-input txt txt-14"
                                    placeholder="<?php echo esc_attr($modal_form_phone_placeholder); ?>" required>
                            </div>
                        </div>

                        <div class="modal-form-group">
                            <label for="company"
                                class="req txt txt-13 txt-14_mb txt-semi modal-label-field"><?php echo esc_html($modal_form_company_label); ?></label>
                            <input type="text" id="company" class="modal-input txt txt-14"
                                placeholder="<?php echo esc_attr($modal_form_company_placeholder); ?>">
                        </div>

                        <div class="modal-form-group">
                            <label class="req txt txt-13 txt-14_mb txt-semi modal-label-field" id="serviceLabel"><?php echo esc_html($modal_form_service_label); ?> <span class="req">*</span></label>
                            <div class="custom-dropdown" id="modalServiceDropdown">
                                <select id="service" name="service" class="custom-dropdown-native" required
                                    tabindex="-1" aria-hidden="true">
                                    <option value="" disabled selected><?php echo esc_html($modal_form_service_placeholder); ?></option>
                                    <?php if ($modal_service_opt1) : ?><option value="slitting"><?php echo esc_html($modal_service_opt1); ?></option><?php endif; ?>
                                    <?php if ($modal_service_opt2) : ?><option value="cut-to-length"><?php echo esc_html($modal_service_opt2); ?></option><?php endif; ?>
                                    <?php if ($modal_service_opt3) : ?><option value="amada"><?php echo esc_html($modal_service_opt3); ?></option><?php endif; ?>
                                    <?php if ($modal_service_opt4) : ?><option value="rolling"><?php echo esc_html($modal_service_opt4); ?></option><?php endif; ?>
                                    <?php if ($modal_service_opt5) : ?><option value="technical"><?php echo esc_html($modal_service_opt5); ?></option><?php endif; ?>
                                    <?php if ($modal_service_opt6) : ?><option value="other"><?php echo esc_html($modal_service_opt6); ?></option><?php endif; ?>
                                </select>

                                <button type="button" class="custom-dropdown-trigger" id="customDropdownTrigger"
                                    aria-haspopup="listbox" aria-expanded="false"
                                    aria-labelledby="serviceLabel customDropdownVal">
                                    <span class="txt txt-14 custom-dropdown-val" id="customDropdownVal"><?php echo esc_html($modal_form_service_placeholder); ?></span>
                                    <svg class="custom-dropdown-arrow" width="12" height="8" viewBox="0 0 12 8"
                                        fill="none">
                                        <path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.6"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <div class="custom-dropdown-menu" role="listbox" id="customDropdownMenu">
                                    <?php if ($modal_service_opt1) : ?>
                                        <div class="custom-dropdown-item" role="option" data-value="slitting">
                                            <span class="txt txt-14 txt-med custom-dropdown-text"><?php echo esc_html($modal_service_opt1); ?></span>
                                            <svg class="custom-dropdown-check" width="14" height="10" viewBox="0 0 14 10" fill="none">
                                                <path d="M1 5L5 9L13 1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($modal_service_opt2) : ?>
                                        <div class="custom-dropdown-item" role="option" data-value="cut-to-length">
                                            <span class="txt txt-14 txt-med custom-dropdown-text"><?php echo esc_html($modal_service_opt2); ?></span>
                                            <svg class="custom-dropdown-check" width="14" height="10" viewBox="0 0 14 10" fill="none">
                                                <path d="M1 5L5 9L13 1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($modal_service_opt3) : ?>
                                        <div class="custom-dropdown-item" role="option" data-value="amada">
                                            <span class="txt txt-14 txt-med custom-dropdown-text"><?php echo esc_html($modal_service_opt3); ?></span>
                                            <svg class="custom-dropdown-check" width="14" height="10" viewBox="0 0 14 10" fill="none">
                                                <path d="M1 5L5 9L13 1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($modal_service_opt4) : ?>
                                        <div class="custom-dropdown-item" role="option" data-value="rolling">
                                            <span class="txt txt-14 txt-med custom-dropdown-text"><?php echo esc_html($modal_service_opt4); ?></span>
                                            <svg class="custom-dropdown-check" width="14" height="10" viewBox="0 0 14 10" fill="none">
                                                <path d="M1 5L5 9L13 1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($modal_service_opt5) : ?>
                                        <div class="custom-dropdown-item" role="option" data-value="technical">
                                            <span class="txt txt-14 txt-med custom-dropdown-text"><?php echo esc_html($modal_service_opt5); ?></span>
                                            <svg class="custom-dropdown-check" width="14" height="10" viewBox="0 0 14 10" fill="none">
                                                <path d="M1 5L5 9L13 1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($modal_service_opt6) : ?>
                                        <div class="custom-dropdown-item" role="option" data-value="other">
                                            <span class="txt txt-14 txt-med custom-dropdown-text"><?php echo esc_html($modal_service_opt6); ?></span>
                                            <svg class="custom-dropdown-check" width="14" height="10" viewBox="0 0 14 10" fill="none">
                                                <path d="M1 5L5 9L13 1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <p class="txt txt-13 modal-disclaimer">
                            <?php echo esc_html($modal_disclaimer); ?>
                        </p>

                        <button type="submit" class="btn btn-primary modal-submit-btn">
                            <span class="txt txt-14 txt-semi"><?php echo esc_html($modal_submit_text); ?></span>
                        </button>

                        <div class="modal-subnote">
                            <span class="txt txt-13 txt-italic"><?php echo esc_html($modal_subnote); ?></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php wp_footer(); ?>
</body>

</html>
