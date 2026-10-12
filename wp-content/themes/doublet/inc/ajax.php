<?php
/**
 * AJAX Handlers for Double T Theme
 * Handles Free Consultation Form submissions via SMTP configured in Theme Options
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Verify Google reCAPTCHA v3 Token
 *
 * @param string $token Token from client-side grecaptcha.execute
 * @param string $action Expected action name
 * @return bool True if valid or not configured, false if bot/spam detected
 */
function doublet_verify_recaptcha( $token, $action = '' ) {
    $secret_key = trim( (string) tr_options_field( 'tr_theme_options.recaptcha_secret_key' ) );
    if ( empty( $secret_key ) ) {
        // If admin hasn't configured secret key in Theme Options, allow submission
        return true;
    }

    if ( empty( $token ) ) {
        return false;
    }

    $response = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', [
        'timeout' => 8,
        'body'    => [
            'secret'   => $secret_key,
            'response' => $token,
            'remoteip' => isset( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_ADDR'] : '',
        ],
    ] );

    if ( is_wp_error( $response ) ) {
        // Don't block users if Google's API has a network hiccup
        return true;
    }

    $res_data = json_decode( wp_remote_retrieve_body( $response ), true );
    if ( ! empty( $res_data['success'] ) ) {
        if ( isset( $res_data['score'] ) ) {
            return $res_data['score'] >= 0.3;
        }
        return true;
    }

    return false;
}

/**
 * Check and enforce Rate Limiting (Max 5 submissions per 60 seconds per IP)
 *
 * @param string $action Action key (e.g. 'consultation' or 'contact')
 * @param int $max_requests Maximum allowed requests (default 5)
 * @param int $window_seconds Time window in seconds (default 60s)
 * @return bool True if allowed, false if limit exceeded
 */
function doublet_check_rate_limit( $action = 'mail', $max_requests = 5, $window_seconds = 60 ) {
    $ip = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( $_SERVER['REMOTE_ADDR'] ) : 'unknown';
    $transient_key = 'doublet_rl_' . md5( $ip . '_' . $action );

    $requests = get_transient( $transient_key );
    $now = time();

    if ( ! is_array( $requests ) ) {
        $requests = [];
    }

    // Filter out requests older than window_seconds
    $requests = array_filter( $requests, function( $ts ) use ( $now, $window_seconds ) {
        return ( $now - $ts ) < $window_seconds;
    } );

    if ( count( $requests ) >= $max_requests ) {
        return false;
    }

    $requests[] = $now;
    set_transient( $transient_key, $requests, $window_seconds );
    return true;
}

/**
 * Build Corporate Email Footer from Theme Options with Dynamic Site URL
 *
 * @param string $lang Language code ('vi' or 'en')
 * @param bool $is_admin Whether this footer is for internal admin notification
 * @return string HTML table row
 */
function doublet_build_email_footer_html( $lang = 'vi', $is_admin = false ) {
    $lang = strtolower( trim( (string) $lang ) ) === 'vi' ? 'vi' : 'en';

    // 1. Dynamic Site URL (Never hardcoded!)
    $site_url = esc_url( home_url( '/' ) );

    // 2. Company Name from Theme Options
    if ( $lang === 'vi' ) {
        $company_name = tr_options_field( 'tr_theme_options.footer_copy_line1_vi' )
            ?: ( trim( tr_options_field( 'tr_theme_options.footer_company_name_red' ) . ' ' . tr_options_field( 'tr_theme_options.footer_company_name_teal' ) ) ?: 'CÔNG TY TNHH KỸ THUẬT DOUBLE T (DOUBLE T METAL CO., LTD)' );
    } else {
        $company_name = tr_options_field( 'tr_theme_options.footer_copy_line1' )
            ?: ( trim( tr_options_field( 'tr_theme_options.footer_company_name_red' ) . ' ' . tr_options_field( 'tr_theme_options.footer_company_name_teal' ) ) ?: 'DOUBLE T ENGINEERING CO., LTD (DOUBLE T METAL)' );
    }

    // 3. Headquarters from Theme Options
    if ( $lang === 'vi' ) {
        $hq_title   = tr_options_field( 'tr_theme_options.footer_hq_title_vi' ) ?: 'Trụ sở chính';
        $hq_address = tr_options_field( 'tr_theme_options.footer_hq_address_vi' ) ?: tr_options_field( 'tr_theme_options.footer_hq_address' );
    } else {
        $hq_title   = tr_options_field( 'tr_theme_options.footer_hq_title' ) ?: 'Headquarters';
        $hq_address = tr_options_field( 'tr_theme_options.footer_hq_address' ) ?: tr_options_field( 'tr_theme_options.footer_hq_address_vi' );
    }
    $hq_phone = tr_options_field( 'tr_theme_options.footer_hq_phone' );

    // 4. HCM Office from Theme Options
    if ( $lang === 'vi' ) {
        $hcm_title   = tr_options_field( 'tr_theme_options.footer_hcm_title_vi' ) ?: 'Văn phòng TP.HCM';
        $hcm_address = tr_options_field( 'tr_theme_options.footer_hcm_address_vi' ) ?: tr_options_field( 'tr_theme_options.footer_hcm_address' );
    } else {
        $hcm_title   = tr_options_field( 'tr_theme_options.footer_hcm_title' ) ?: 'Ho Chi Minh Office';
        $hcm_address = tr_options_field( 'tr_theme_options.footer_hcm_address' ) ?: tr_options_field( 'tr_theme_options.footer_hcm_address_vi' );
    }
    $hcm_phone = tr_options_field( 'tr_theme_options.footer_hcm_phone' );
    $hcm_email = tr_options_field( 'tr_theme_options.footer_hcm_email' ) ?: '2t@2tsteel.com';

    $phone_display = trim( ($hcm_phone ?: $hq_phone) ?: '028.3816.5435 – 028.3816.5436' );
    $phone_label   = $lang === 'vi' ? 'Điện thoại' : 'Phone';
    $website_label = $lang === 'vi' ? 'Website' : 'Website';
    $email_label   = $lang === 'vi' ? 'Email' : 'Email';

    $disclaimer = $lang === 'vi'
        ? 'Email thông báo tự động từ hệ thống website Double T. Quý vị vui lòng không trả lời trực tiếp email hệ thống này.'
        : 'This is an automated notification from the Double T website. Please do not reply directly to this email.';

    ob_start();
    ?>
    <!-- Corporate Footer from Theme Options with Dynamic Site URL -->
    <tr>
        <td style="padding: 24px 36px; background-color: #14171F; color: #8A90A3; font-size: 12px; line-height: 1.6; border-top: 1px solid #232833;">
            <div style="font-weight: 700; font-size: 13px; color: #FFFFFF; margin-bottom: 6px; text-transform: uppercase;">
                <?php echo esc_html( $company_name ); ?>
            </div>
            <?php if ( $hq_address ) : ?>
                <div style="margin-bottom: 4px;">
                    <strong><?php echo esc_html( $hq_title ); ?>:</strong> <?php echo esc_html( $hq_address ); ?>
                </div>
            <?php endif; ?>
            <?php if ( $hcm_address ) : ?>
                <div style="margin-bottom: 4px;">
                    <strong><?php echo esc_html( $hcm_title ); ?>:</strong> <?php echo esc_html( $hcm_address ); ?>
                </div>
            <?php endif; ?>
            <div style="margin-bottom: 10px;">
                <strong><?php echo esc_html( $phone_label ); ?>:</strong> <?php echo esc_html( $phone_display ); ?>
                | <strong><?php echo esc_html( $website_label ); ?>:</strong> <a href="<?php echo $site_url; ?>" target="_blank" style="color: #20B7C6; text-decoration: none;"><?php echo $site_url; ?></a>
                <?php if ( $hcm_email ) : ?>
                    | <strong><?php echo esc_html( $email_label ); ?>:</strong> <a href="mailto:<?php echo esc_attr( $hcm_email ); ?>" style="color: #20B7C6; text-decoration: none;"><?php echo esc_html( $hcm_email ); ?></a>
                <?php endif; ?>
            </div>
            <div style="font-size: 11px; color: #697082; border-top: 1px solid #232833; padding-top: 10px;">
                <?php echo esc_html( $disclaimer ); ?>
            </div>
        </td>
    </tr>
    <?php
    return ob_get_clean();
}

add_action( 'wp_ajax_doublet_submit_consultation', 'doublet_ajax_handle_consultation' );
add_action( 'wp_ajax_nopriv_doublet_submit_consultation', 'doublet_ajax_handle_consultation' );

function doublet_ajax_handle_consultation() {
    // 1. Verify Nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'doublet_consultation_nonce' ) ) {
        wp_send_json_error( [
            'message' => 'Phiên làm việc đã hết hạn. Vui lòng tải lại trang và thử lại (Invalid security token).'
        ] );
    }

    // Determine current language ('vi' or 'en')
    $lang = ( isset( $_POST['lang'] ) && strtolower( trim( (string) $_POST['lang'] ) ) === 'vi' ) ? 'vi' : 'en';

    // 1.1 Rate Limiting (5 requests per 60 seconds per IP)
    if ( ! doublet_check_rate_limit( 'consultation', 5, 60 ) ) {
        $rate_msg = ( $lang === 'vi' )
            ? 'Bạn đã gửi quá nhiều yêu cầu trong thời gian ngắn (tối đa 5 lần/phút). Vui lòng đợi ít phút trước khi thử lại.'
            : 'You have submitted too many requests in a short time (maximum 5 requests per minute). Please wait a moment before trying again.';
        wp_send_json_error( [ 'message' => $rate_msg ] );
    }

    // 1.2 Verify Google reCAPTCHA v3 if configured
    $recaptcha_token = isset( $_POST['recaptcha_token'] ) ? sanitize_text_field( $_POST['recaptcha_token'] ) : ( isset( $_POST['g-recaptcha-response'] ) ? sanitize_text_field( $_POST['g-recaptcha-response'] ) : '' );
    if ( ! doublet_verify_recaptcha( $recaptcha_token, 'consultation' ) ) {
        $rc_msg = ( $lang === 'vi' )
            ? 'Hệ thống phát hiện bảo mật không an toàn qua reCAPTCHA (nghi vấn spam). Vui lòng thử lại.'
            : 'Security verification failed via reCAPTCHA (potential spam detected). Please try again.';
        wp_send_json_error( [ 'message' => $rc_msg ] );
    }

    // 2. Sanitize and Validate Inputs
    $full_name = isset( $_POST['fullName'] ) ? sanitize_text_field( trim( $_POST['fullName'] ) ) : '';
    $email     = isset( $_POST['email'] ) ? sanitize_email( trim( $_POST['email'] ) ) : '';
    $phone     = isset( $_POST['phoneNumber'] ) ? sanitize_text_field( trim( $_POST['phoneNumber'] ) ) : '';
    $company   = isset( $_POST['company'] ) ? sanitize_text_field( trim( $_POST['company'] ) ) : '';
    $service   = isset( $_POST['service'] ) ? sanitize_text_field( trim( $_POST['service'] ) ) : '';

    if ( empty( $full_name ) ) {
        wp_send_json_error( [ 'message' => ( $lang === 'vi' ? 'Vui lòng nhập họ và tên của bạn.' : 'Please enter your full name.' ) ] );
    }

    if ( empty( $email ) || ! is_email( $email ) ) {
        wp_send_json_error( [ 'message' => ( $lang === 'vi' ? 'Địa chỉ email không hợp lệ. Vui lòng kiểm tra lại.' : 'Invalid email address. Please check and try again.' ) ] );
    }

    if ( empty( $phone ) ) {
        wp_send_json_error( [ 'message' => ( $lang === 'vi' ? 'Vui lòng nhập số điện thoại liên hệ.' : 'Please enter your phone number.' ) ] );
    }

    if ( empty( $service ) ) {
        wp_send_json_error( [ 'message' => ( $lang === 'vi' ? 'Vui lòng chọn dịch vụ bạn đang quan tâm.' : 'Please select a service you are interested in.' ) ] );
    }

    // 3. Resolve Human-Readable Service Name from Theme Options based on language
    if ( $lang === 'vi' ) {
        $service_map = [
            'slitting'      => tr_options_field( 'tr_theme_options.modal_service_opt1_vi' ) ?: tr_options_field( 'tr_theme_options.modal_service_opt1' ) ?: 'Dây chuyền xẻ cuộn (Slitting Line)',
            'cut-to-length' => tr_options_field( 'tr_theme_options.modal_service_opt2_vi' ) ?: tr_options_field( 'tr_theme_options.modal_service_opt2' ) ?: 'Dây chuyền cắt tấm (Cut-to-Length Line)',
            'amada'         => tr_options_field( 'tr_theme_options.modal_service_opt3_vi' ) ?: tr_options_field( 'tr_theme_options.modal_service_opt3' ) ?: 'Máy cắt Amada & Tấm Reshear Line',
            'rolling'       => tr_options_field( 'tr_theme_options.modal_service_opt4_vi' ) ?: tr_options_field( 'tr_theme_options.modal_service_opt4' ) ?: 'Dây chuyền cán vuốt thép La và Thép tròn đặc',
            'technical'     => tr_options_field( 'tr_theme_options.modal_service_opt5_vi' ) ?: tr_options_field( 'tr_theme_options.modal_service_opt5' ) ?: 'Dịch vụ hỗ trợ kỹ thuật phụ trợ',
            'other'         => tr_options_field( 'tr_theme_options.modal_service_opt6_vi' ) ?: tr_options_field( 'tr_theme_options.modal_service_opt6' ) ?: 'Dịch vụ khác',
        ];
    } else {
        $service_map = [
            'slitting'      => tr_options_field( 'tr_theme_options.modal_service_opt1' ) ?: 'Slitting Line',
            'cut-to-length' => tr_options_field( 'tr_theme_options.modal_service_opt2' ) ?: 'Cut-to-Length Line',
            'amada'         => tr_options_field( 'tr_theme_options.modal_service_opt3' ) ?: 'Amada Shearing & Reshear Line',
            'rolling'       => tr_options_field( 'tr_theme_options.modal_service_opt4' ) ?: 'Flat & Round Steel Cold Drawing Line',
            'technical'     => tr_options_field( 'tr_theme_options.modal_service_opt5' ) ?: 'Auxiliary Technical Support',
            'other'         => tr_options_field( 'tr_theme_options.modal_service_opt6' ) ?: 'Other Services',
        ];
    }
    $service_label = isset( $service_map[ $service ] ) ? $service_map[ $service ] : $service;

    // Current metadata
    $now_date   = current_time( 'd/m/Y H:i:s' );
    $ip_address = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( $_SERVER['REMOTE_ADDR'] ) : 'N/A';
    $user_agent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( $_SERVER['HTTP_USER_AGENT'] ) : 'N/A';
    $device     = wp_is_mobile() ? 'Mobile' : 'Desktop';
    $source_url = wp_get_referer() ? esc_url( wp_get_referer() ) : home_url();

    // 4. Save to Database Post Type 'register' (Liên hệ) as persistent log
    $post_data = [
        'post_title'   => $full_name,
        'post_type'    => 'register',
        'post_status'  => 'publish',
        'post_content' => sprintf(
            "Yêu cầu tư vấn miễn phí từ website (%s):\n- Dịch vụ: %s\n- Công ty: %s\n- SĐT: %s\n- Email: %s\n- Ngôn ngữ: %s\n- Nguồn: %s\n- IP: %s",
            strtoupper( $lang ),
            $service_label,
            $company ?: 'N/A',
            $phone,
            $email,
            strtoupper( $lang ),
            $source_url,
            $ip_address
        ),
    ];
    $post_id = wp_insert_post( $post_data );
    if ( $post_id && ! is_wp_error( $post_id ) ) {
        update_post_meta( $post_id, 'mobile', $phone );
        update_post_meta( $post_id, 'email', $email );
        update_post_meta( $post_id, 'company', $company );
        update_post_meta( $post_id, 'interest', $service_label );
        update_post_meta( $post_id, 'lang', $lang );
        update_post_meta( $post_id, 'device', $device );
        update_post_meta( $post_id, 'source', $source_url );
        update_post_meta( $post_id, 'user_agent', $user_agent );
        update_post_meta( $post_id, 'ip_address', $ip_address );
    }

    // 5. Retrieve SMTP and Recipient Email Settings from Theme Options
    $receive_email_opt = tr_options_field( 'tr_theme_options.receive_email' );
    if ( empty( $receive_email_opt ) ) {
        $receive_email_opt = tr_options_field( 'tr_theme_options.footer_hcm_email' ) ?: get_option( 'admin_email' );
    }

    $to_emails = [];
    foreach ( explode( ',', $receive_email_opt ) as $em ) {
        $em = sanitize_email( trim( $em ) );
        if ( is_email( $em ) ) {
            $to_emails[] = $em;
        }
    }
    if ( empty( $to_emails ) ) {
        $to_emails[] = get_option( 'admin_email' );
    }

    $raw_from   = trim( (string) tr_options_field( 'tr_theme_options.from_email' ) );
    $username   = trim( (string) tr_options_field( 'tr_theme_options.username' ) );
    $from_email = is_email( $raw_from ) ? $raw_from : ( is_email( $username ) ? $username : get_option( 'admin_email' ) );
    $from_name  = ( ! empty( $raw_from ) && ! is_email( $raw_from ) ) ? $raw_from : ( get_bloginfo( 'name' ) ?: 'Double T Metal Co., LTD' );

    // 6. Build High-End HTML Email Template for Admin/Sales
    $admin_subject = ( $lang === 'vi' )
        ? sprintf( '[Double T] Yêu cầu tư vấn mới từ %s (%s)', $full_name, $service_label )
        : sprintf( '[Double T] New consultation request from %s (%s)', $full_name, $service_label );

    $admin_body = doublet_build_admin_consultation_email( [
        'full_name'     => $full_name,
        'email'         => $email,
        'phone'         => $phone,
        'company'       => $company,
        'service_label' => $service_label,
        'lang'          => $lang,
        'now_date'      => $now_date,
        'source_url'    => $source_url,
        'device'        => $device,
        'ip_address'    => $ip_address,
    ] );

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $from_name . ' <' . $from_email . '>',
        'Reply-To: ' . $full_name . ' <' . $email . '>',
    ];

    // Send email to admin/sales
    $mail_sent = wp_mail( $to_emails, $admin_subject, $admin_body, $headers );

    // 7. Send Polite Confirmation Email to Customer in the selected language
    if ( is_email( $email ) ) {
        $customer_subject = ( $lang === 'vi' )
            ? 'Double T Metal - Xác nhận yêu cầu tư vấn thành công'
            : 'Double T Metal - Consultation Request Confirmation';

        $customer_body = doublet_build_customer_confirmation_email( [
            'full_name'     => $full_name,
            'service_label' => $service_label,
            'phone'         => $phone,
            'company'       => $company,
            'lang'          => $lang,
            'now_date'      => $now_date,
        ] );

        $customer_headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $from_name . ' <' . $from_email . '>',
            'Reply-To: ' . $from_name . ' <' . $from_email . '>',
        ];

        wp_mail( $email, $customer_subject, $customer_body, $customer_headers );
    }

    if ( $mail_sent || $post_id ) {
        $success_msg = ( $lang === 'vi' )
            ? 'Gửi yêu cầu tư vấn thành công! Double T sẽ liên hệ với bạn trong thời gian sớm nhất.'
            : 'Your consultation request has been sent successfully! Double T will contact you shortly.';
        wp_send_json_success( [
            'message' => $success_msg
        ] );
    } else {
        $err_msg = ( $lang === 'vi' )
            ? 'Có lỗi xảy ra khi gửi email qua hệ thống máy chủ SMTP. Xin vui lòng liên hệ hotline hoặc thử lại.'
            : 'An error occurred while sending email via SMTP. Please contact our hotline or try again.';
        wp_send_json_error( [
            'message' => $err_msg
        ] );
    }
}

/**
 * Build Admin Notification Email Template
 * Designed specifically to match the Double T luxury steel branding:
 * Primary Teal (#0B6F7E), Light Cyan (#20B7C6), Red Accent (#EB1F30), Dark (#14171F)
 */
function doublet_build_admin_consultation_email( $data ) {
    $full_name     = esc_html( $data['full_name'] );
    $email         = esc_html( $data['email'] );
    $phone         = esc_html( $data['phone'] );
    $company       = ! empty( $data['company'] ) ? esc_html( $data['company'] ) : '<em>(Chưa cung cấp)</em>';
    $service_label = esc_html( $data['service_label'] );
    $now_date      = esc_html( $data['now_date'] );
    $source_url    = esc_url( $data['source_url'] );
    $device        = esc_html( $data['device'] );
    $ip_address    = esc_html( $data['ip_address'] );
    $site_url      = esc_url( home_url( '/' ) );

    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Yêu Cầu Tư Vấn Mới - Double T Metal</title>
    </head>
    <body style="margin: 0; padding: 0; background-color: #EDEFF4; font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; color: #14171F;">
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #EDEFF4; padding: 36px 12px;">
            <tr>
                <td align="center">
                    <!-- Main Container Card -->
                    <table role="presentation" width="100%" max-width="620" cellspacing="0" cellpadding="0" border="0" style="max-width: 620px; width: 100%; background-color: #FFFFFF; border-radius: 8px; overflow: hidden; box-shadow: 0 10px 30px rgba(20, 23, 31, 0.08); border: 1px solid #DCDFE8;">
                        
                        <!-- Top Gradient Accent Bar -->
                        <tr>
                            <td style="height: 5px; background: linear-gradient(93deg, #20B7C6 0%, #0B6F7E 100%);"></td>
                        </tr>

                        <!-- Brand Header -->
                        <tr>
                            <td style="padding: 28px 36px; background-color: #14171F; border-bottom: 2px solid #20B7C6;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td>
                                            <div style="font-size: 26px; font-weight: 800; letter-spacing: 1.5px; color: #FFFFFF; text-transform: uppercase;">
                                                DOUBLE <span style="color: #EB1F30;">T</span>
                                            </div>
                                            <div style="font-size: 11px; font-weight: 600; color: #20B7C6; letter-spacing: 2px; text-transform: uppercase; margin-top: 4px;">
                                                METAL COMPANY LIMITED
                                            </div>
                                        </td>
                                        <td align="right" valign="middle">
                                            <span style="display: inline-block; background-color: rgba(235, 31, 48, 0.15); border: 1px solid #EB1F30; color: #EB1F30; padding: 6px 12px; font-size: 11px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; border-radius: 4px;">
                                                HOT LEAD
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- Title Section -->
                        <tr>
                            <td style="padding: 24px 36px 18px 36px; background-color: #F8FAFB; border-bottom: 1px solid #DCDFE8;">
                                <h1 style="margin: 0 0 6px 0; font-size: 20px; font-weight: 700; color: #0B6F7E; text-transform: uppercase; letter-spacing: 0.5px;">
                                    Thông Tin Đăng Ký Tư Vấn Miễn Phí
                                </h1>
                                <p style="margin: 0; font-size: 13px; color: #4A5163; line-height: 1.5;">
                                    Hệ thống vừa ghi nhận một yêu cầu tư vấn mới từ khách hàng qua biểu mẫu Free Consultation.
                                </p>
                            </td>
                        </tr>

                        <!-- Customer Details Content -->
                        <tr>
                            <td style="padding: 28px 36px 20px 36px;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
                                    
                                    <!-- Full Name -->
                                    <tr>
                                        <td width="35%" style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px;">
                                            Họ và tên
                                        </td>
                                        <td width="65%" style="padding: 12px 14px; font-size: 15px; font-weight: 700; color: #14171F; border-bottom: 1px solid #EDEFF4;">
                                            <?php echo $full_name; ?>
                                        </td>
                                    </tr>

                                    <!-- Phone Number -->
                                    <tr>
                                        <td style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px;">
                                            Số điện thoại
                                        </td>
                                        <td style="padding: 12px 14px; font-size: 15px; font-weight: 700; color: #EB1F30; border-bottom: 1px solid #EDEFF4;">
                                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" style="color: #EB1F30; text-decoration: none;">
                                                <?php echo $phone; ?>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Email -->
                                    <tr>
                                        <td style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px;">
                                            Địa chỉ Email
                                        </td>
                                        <td style="padding: 12px 14px; font-size: 14px; font-weight: 600; color: #0B6F7E; border-bottom: 1px solid #EDEFF4;">
                                            <a href="mailto:<?php echo esc_attr( $email ); ?>" style="color: #0B6F7E; text-decoration: underline;">
                                                <?php echo $email; ?>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Company -->
                                    <tr>
                                        <td style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px;">
                                            Công ty / Đơn vị
                                        </td>
                                        <td style="padding: 12px 14px; font-size: 14px; color: #14171F; border-bottom: 1px solid #EDEFF4;">
                                            <?php echo $company; ?>
                                        </td>
                                    </tr>

                                    <!-- Interested Service (Highlighted) -->
                                    <tr>
                                        <td style="padding: 14px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px; vertical-align: top;">
                                            Dịch vụ quan tâm
                                        </td>
                                        <td style="padding: 14px 14px; border-bottom: 1px solid #EDEFF4;">
                                            <div style="display: inline-block; background: #0B6F7E; color: #FFFFFF; padding: 6px 14px; font-size: 13px; font-weight: 700; border-radius: 4px; box-shadow: 0 2px 8px rgba(11, 111, 126, 0.25);">
                                                <?php echo $service_label; ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Submission Date -->
                                    <tr>
                                        <td style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px;">
                                            Thời gian gửi
                                        </td>
                                        <td style="padding: 12px 14px; font-size: 13px; color: #14171F; border-bottom: 1px solid #EDEFF4;">
                                            <?php echo $now_date; ?>
                                        </td>
                                    </tr>

                                    <!-- Source Page -->
                                    <tr>
                                        <td style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; text-transform: uppercase; letter-spacing: 0.5px;">
                                            Nguồn trang
                                        </td>
                                        <td style="padding: 12px 14px; font-size: 12px; color: #8A90A3; word-break: break-all;">
                                            <a href="<?php echo $source_url; ?>" target="_blank" style="color: #0B6F7E; text-decoration: none;">
                                                <?php echo $source_url; ?>
                                            </a>
                                            <span style="display: block; margin-top: 4px; color: #8A90A3;">Thiết bị: <?php echo $device; ?> | IP: <?php echo $ip_address; ?></span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- Quick Actions Section -->
                        <tr>
                            <td style="padding: 0 36px 32px 36px;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #F8FAFB; border: 1px dashed #DCDFE8; border-radius: 6px; padding: 18px 20px;">
                                    <tr>
                                        <td align="center" style="padding-bottom: 12px; font-size: 13px; font-weight: 700; color: #14171F; text-transform: uppercase; letter-spacing: 0.5px;">
                                            Hành Động Nhanh Cho Đội Ngũ Bán Hàng & Kỹ Thuật
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <!-- Call Button -->
                                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" style="display: inline-block; background-color: #EB1F30; color: #FFFFFF; font-size: 13px; font-weight: 700; text-decoration: none; padding: 10px 22px; border-radius: 4px; margin: 4px 6px;">
                                                &#9742; GỌI ĐIỆN NGAY
                                            </a>
                                            <!-- Reply Email Button -->
                                            <a href="mailto:<?php echo esc_attr( $email ); ?>?subject=Double%20T%20Metal%20-%20T%C6%B0%20v%E1%BA%A5n%20d%E1%BB%8Bch%20v%E1%BB%A5%20<?php echo rawurlencode( $service_label ); ?>" style="display: inline-block; background-color: #0B6F7E; color: #FFFFFF; font-size: 13px; font-weight: 700; text-decoration: none; padding: 10px 22px; border-radius: 4px; margin: 4px 6px;">
                                                &#9993; TRẢ LỜI EMAIL
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- Corporate Footer from Theme Options -->
                        <?php echo doublet_build_email_footer_html( $data['lang'] ?? 'vi', true ); ?>

                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>
    <?php
    return ob_get_clean();
}

/**
 * Build Customer Confirmation Email Template
 * Sent to the customer after submitting the consultation request
 */
function doublet_build_customer_confirmation_email( $data ) {
    $lang          = ( isset( $data['lang'] ) && strtolower( trim( (string) $data['lang'] ) ) === 'vi' ) ? 'vi' : 'en';
    $full_name     = esc_html( $data['full_name'] );
    $service_label = esc_html( $data['service_label'] );
    $phone         = esc_html( $data['phone'] );
    $company       = ! empty( $data['company'] ) ? esc_html( $data['company'] ) : '';
    $site_url      = esc_url( home_url( '/' ) );

    $email_title = ( $lang === 'vi' ) ? 'Xác Nhận Đăng Ký Tư Vấn - Double T Metal' : 'Consultation Request Confirmation - Double T Metal';
    $phone_call  = trim( (string) tr_options_field( 'tr_theme_options.footer_hcm_phone' ) ?: tr_options_field( 'tr_theme_options.footer_hq_phone' ) ?: '028.3816.5435 – 028.3816.5436' );

    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="<?php echo $lang; ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo esc_html( $email_title ); ?></title>
    </head>
    <body style="margin: 0; padding: 0; background-color: #EDEFF4; font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; color: #14171F;">
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #EDEFF4; padding: 36px 12px;">
            <tr>
                <td align="center">
                    <table role="presentation" width="100%" max-width="620" cellspacing="0" cellpadding="0" border="0" style="max-width: 620px; width: 100%; background-color: #FFFFFF; border-radius: 8px; overflow: hidden; box-shadow: 0 10px 30px rgba(20, 23, 31, 0.08); border: 1px solid #DCDFE8;">
                        
                        <!-- Top Accent Bar -->
                        <tr>
                            <td style="height: 5px; background: linear-gradient(93deg, #20B7C6 0%, #0B6F7E 100%);"></td>
                        </tr>

                        <!-- Brand Header -->
                        <tr>
                            <td style="padding: 28px 36px; background-color: #14171F;">
                                <div style="font-size: 26px; font-weight: 800; letter-spacing: 1.5px; color: #FFFFFF; text-transform: uppercase;">
                                    DOUBLE <span style="color: #EB1F30;">T</span>
                                </div>
                                <div style="font-size: 11px; font-weight: 600; color: #20B7C6; letter-spacing: 2px; text-transform: uppercase; margin-top: 4px;">
                                    METAL COMPANY LIMITED
                                </div>
                            </td>
                        </tr>

                        <!-- Message Body -->
                        <tr>
                            <td style="padding: 32px 36px 24px 36px;">
                                <?php if ( $lang === 'vi' ) : ?>
                                    <h1 style="margin: 0 0 16px 0; font-size: 20px; font-weight: 700; color: #0B6F7E;">
                                        Kính gửi Quý khách <?php echo $full_name; ?>,
                                    </h1>
                                    <p style="margin: 0 0 16px 0; font-size: 14px; line-height: 1.7; color: #4A5163;">
                                        Cảm ơn Quý khách đã quan tâm đến dịch vụ và sản phẩm của <strong>Công ty TNHH Kỹ Thuật Double T</strong>. Chúng tôi đã nhận được thông tin đăng ký tư vấn của Quý khách cho dịch vụ:
                                    </p>
                                    
                                    <div style="background-color: #F8FAFB; border-left: 4px solid #0B6F7E; padding: 14px 18px; margin: 20px 0; border-radius: 0 4px 4px 0;">
                                        <div style="font-size: 12px; font-weight: 600; color: #8A90A3; text-transform: uppercase; letter-spacing: 0.5px;">Dịch vụ đã chọn:</div>
                                        <div style="font-size: 16px; font-weight: 700; color: #0B6F7E; margin-top: 4px;"><?php echo $service_label; ?></div>
                                        <?php if ( $company ) : ?>
                                            <div style="font-size: 13px; color: #4A5163; margin-top: 4px;">Công ty: <?php echo $company; ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <p style="margin: 0 0 16px 0; font-size: 14px; line-height: 1.7; color: #4A5163;">
                                        Đội ngũ chuyên gia kỹ thuật và bộ phận kinh doanh của Double T sẽ liên hệ trực tiếp qua số điện thoại <strong><?php echo $phone; ?></strong> trong thời gian sớm nhất (trong vòng 24 giờ làm việc) để tư vấn chi tiết và cung cấp giải pháp tối ưu cho dự án của Quý vị.
                                    </p>

                                    <p style="margin: 0 0 24px 0; font-size: 14px; line-height: 1.7; color: #4A5163;">
                                        Nếu Quý khách cần hỗ trợ kỹ thuật hoặc báo giá khẩn cấp, xin vui lòng gọi ngay hotline:
                                        <br>
                                        <strong style="color: #EB1F30; font-size: 16px;"><?php echo esc_html( $phone_call ); ?></strong>
                                    </p>

                                    <div style="border-top: 1px solid #EDEFF4; padding-top: 20px; font-size: 14px; color: #14171F;">
                                        Trân trọng,<br>
                                        <strong>Ban Quản Trị Double T Metal</strong>
                                    </div>
                                <?php else : ?>
                                    <h1 style="margin: 0 0 16px 0; font-size: 20px; font-weight: 700; color: #0B6F7E;">
                                        Dear <?php echo $full_name; ?>,
                                    </h1>
                                    <p style="margin: 0 0 16px 0; font-size: 14px; line-height: 1.7; color: #4A5163;">
                                        Thank you for your interest in the services and products of <strong>Double T Engineering Co., Ltd</strong>. We have successfully received your consultation request for:
                                    </p>
                                    
                                    <div style="background-color: #F8FAFB; border-left: 4px solid #0B6F7E; padding: 14px 18px; margin: 20px 0; border-radius: 0 4px 4px 0;">
                                        <div style="font-size: 12px; font-weight: 600; color: #8A90A3; text-transform: uppercase; letter-spacing: 0.5px;">Requested Service:</div>
                                        <div style="font-size: 16px; font-weight: 700; color: #0B6F7E; margin-top: 4px;"><?php echo $service_label; ?></div>
                                        <?php if ( $company ) : ?>
                                            <div style="font-size: 13px; color: #4A5163; margin-top: 4px;">Company: <?php echo $company; ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <p style="margin: 0 0 16px 0; font-size: 14px; line-height: 1.7; color: #4A5163;">
                                        Our engineering experts and commercial team will contact you directly via phone <strong><?php echo $phone; ?></strong> within 24 business hours to provide in-depth consultation and tailored steel solutions for your project.
                                    </p>

                                    <p style="margin: 0 0 24px 0; font-size: 14px; line-height: 1.7; color: #4A5163;">
                                        If you require immediate technical support or urgent quotations, please reach out via our hotline:
                                        <br>
                                        <strong style="color: #EB1F30; font-size: 16px;"><?php echo esc_html( $phone_call ); ?></strong>
                                    </p>

                                    <div style="border-top: 1px solid #EDEFF4; padding-top: 20px; font-size: 14px; color: #14171F;">
                                        Sincerely,<br>
                                        <strong>Double T Metal Management</strong>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <!-- Corporate Footer from Theme Options -->
                        <?php echo doublet_build_email_footer_html( $lang, false ); ?>

                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>
    <?php
    return ob_get_clean();
}

/* ==========================================================================
   2. Contact Page Form Submission Handler (Trang Liên Hệ)
   ========================================================================== */

add_action( 'wp_ajax_doublet_submit_contact', 'doublet_ajax_handle_contact' );
add_action( 'wp_ajax_nopriv_doublet_submit_contact', 'doublet_ajax_handle_contact' );

function doublet_ajax_handle_contact() {
    // 0. Detect Language
    $lang = ( isset( $_POST['lang'] ) && strtolower( trim( (string) $_POST['lang'] ) ) === 'en' ) ? 'en' : 'vi';

    // 1. Verify Nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'doublet_contact_nonce' ) ) {
        $nonce_msg = ( $lang === 'vi' )
            ? 'Phiên làm việc đã hết hạn. Vui lòng tải lại trang và thử lại (Invalid security token).'
            : 'Session expired or security token invalid. Please refresh the page and try again.';
        wp_send_json_error( [ 'message' => $nonce_msg ] );
    }

    // 1.1 Rate Limiting: Maximum 5 requests per 1 minute (60s)
    if ( ! doublet_check_rate_limit( 'contact', 5, 60 ) ) {
        $rate_msg = ( $lang === 'vi' )
            ? 'Bạn đã gửi quá nhiều yêu cầu trong thời gian ngắn (tối đa 5 lần/phút). Vui lòng đợi ít phút trước khi thử lại.'
            : 'You have submitted too many requests in a short time (maximum 5 requests per minute). Please wait a moment before trying again.';
        wp_send_json_error( [ 'message' => $rate_msg ] );
    }

    // 1.2 Verify Google reCAPTCHA v3 if configured
    $recaptcha_token = isset( $_POST['recaptcha_token'] ) ? sanitize_text_field( $_POST['recaptcha_token'] ) : ( isset( $_POST['g-recaptcha-response'] ) ? sanitize_text_field( $_POST['g-recaptcha-response'] ) : '' );
    if ( ! doublet_verify_recaptcha( $recaptcha_token, 'contact' ) ) {
        $rc_msg = ( $lang === 'vi' )
            ? 'Hệ thống phát hiện bảo mật không an toàn qua reCAPTCHA (nghi vấn spam). Vui lòng thử lại.'
            : 'Security verification failed via reCAPTCHA (potential spam detected). Please try again.';
        wp_send_json_error( [ 'message' => $rc_msg ] );
    }

    // 2. Sanitize and Validate Inputs
    $full_name = isset( $_POST['fullName'] ) ? sanitize_text_field( trim( $_POST['fullName'] ) ) : '';
    $email     = isset( $_POST['email'] ) ? sanitize_email( trim( $_POST['email'] ) ) : '';
    $phone     = isset( $_POST['phoneNumber'] ) ? sanitize_text_field( trim( $_POST['phoneNumber'] ) ) : '';
    $company   = isset( $_POST['company'] ) ? sanitize_text_field( trim( $_POST['company'] ) ) : '';
    $message   = isset( $_POST['message'] ) ? sanitize_textarea_field( trim( $_POST['message'] ) ) : '';

    if ( empty( $full_name ) ) {
        wp_send_json_error( [ 'message' => ( $lang === 'vi' ? 'Vui lòng nhập họ và tên của bạn.' : 'Please enter your full name.' ) ] );
    }

    if ( empty( $email ) || ! is_email( $email ) ) {
        wp_send_json_error( [ 'message' => ( $lang === 'vi' ? 'Địa chỉ email không hợp lệ. Vui lòng kiểm tra lại.' : 'Invalid email address. Please check and try again.' ) ] );
    }

    if ( empty( $phone ) ) {
        wp_send_json_error( [ 'message' => ( $lang === 'vi' ? 'Vui lòng nhập số điện thoại liên hệ.' : 'Please enter your phone number.' ) ] );
    }

    // Current metadata
    $now_date   = current_time( 'd/m/Y H:i:s' );
    $ip_address = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( $_SERVER['REMOTE_ADDR'] ) : 'N/A';
    $user_agent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( $_SERVER['HTTP_USER_AGENT'] ) : 'N/A';
    $device     = wp_is_mobile() ? 'Mobile' : 'Desktop';
    $source_url = wp_get_referer() ? esc_url( wp_get_referer() ) : home_url( '/contact/' );

    // 3. Save to Database Post Type 'register' (Liên hệ) as persistent log
    $post_data = [
        'post_title'   => $full_name,
        'post_type'    => 'register',
        'post_status'  => 'publish',
        'post_content' => $message,
    ];
    $post_id = wp_insert_post( $post_data );
    if ( $post_id && ! is_wp_error( $post_id ) ) {
        update_post_meta( $post_id, 'mobile', $phone );
        update_post_meta( $post_id, 'email', $email );
        update_post_meta( $post_id, 'company', $company );
        update_post_meta( $post_id, 'content', $message );
        update_post_meta( $post_id, 'interest', 'Liên hệ từ trang Contact' );
        update_post_meta( $post_id, 'device', $device );
        update_post_meta( $post_id, 'source', $source_url );
        update_post_meta( $post_id, 'user_agent', $user_agent );
        update_post_meta( $post_id, 'ip_address', $ip_address );
        update_post_meta( $post_id, 'lang', $lang );
    }

    // 4. Retrieve SMTP & Recipient Settings from Theme Options
    $receive_email_opt = tr_options_field( 'tr_theme_options.receive_email' );
    if ( empty( $receive_email_opt ) ) {
        $receive_email_opt = tr_options_field( 'tr_theme_options.footer_hcm_email' ) ?: get_option( 'admin_email' );
    }

    $to_emails = [];
    foreach ( explode( ',', $receive_email_opt ) as $em ) {
        $em = sanitize_email( trim( $em ) );
        if ( is_email( $em ) ) {
            $to_emails[] = $em;
        }
    }
    if ( empty( $to_emails ) ) {
        $to_emails[] = get_option( 'admin_email' );
    }

    $raw_from   = trim( (string) tr_options_field( 'tr_theme_options.from_email' ) );
    $username   = trim( (string) tr_options_field( 'tr_theme_options.username' ) );
    $from_email = is_email( $raw_from ) ? $raw_from : ( is_email( $username ) ? $username : get_option( 'admin_email' ) );
    $from_name  = ( ! empty( $raw_from ) && ! is_email( $raw_from ) ) ? $raw_from : ( get_bloginfo( 'name' ) ?: 'Double T Metal Co., LTD' );

    // 5. Build Admin Notification Email
    $admin_subject = sprintf( '[Double T] %s - %s', ( $lang === 'vi' ? 'Tin nhắn liên hệ mới từ' : 'New Contact Inquiry from' ), $full_name );
    $admin_body    = doublet_build_admin_contact_email( [
        'full_name'  => $full_name,
        'email'      => $email,
        'phone'      => $phone,
        'company'    => $company,
        'message'    => $message,
        'now_date'   => $now_date,
        'source_url' => $source_url,
        'device'     => $device,
        'ip_address' => $ip_address,
        'lang'       => $lang,
    ] );

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $from_name . ' <' . $from_email . '>',
        'Reply-To: ' . $full_name . ' <' . $email . '>',
    ];

    // Send email to admin
    $mail_sent = wp_mail( $to_emails, $admin_subject, $admin_body, $headers );

    // 6. Send Confirmation Email to Customer
    if ( is_email( $email ) ) {
        $customer_subject = ( $lang === 'vi' )
            ? 'Double T Metal - Xác nhận đã nhận được tin nhắn liên hệ'
            : 'Double T Metal - Confirmation: We have received your contact inquiry';
        $customer_body    = doublet_build_customer_contact_confirmation_email( [
            'full_name' => $full_name,
            'message'   => $message,
            'phone'     => $phone,
            'company'   => $company,
            'now_date'  => $now_date,
            'lang'      => $lang,
        ] );

        $customer_headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $from_name . ' <' . $from_email . '>',
            'Reply-To: ' . $from_name . ' <' . $from_email . '>',
        ];

        wp_mail( $email, $customer_subject, $customer_body, $customer_headers );
    }

    if ( $mail_sent || $post_id ) {
        $succ_msg = ( $lang === 'vi' )
            ? 'Gửi thông tin liên hệ thành công! Double T sẽ phản hồi Quý khách trong thời gian sớm nhất.'
            : 'Your message has been sent successfully! Double T will respond to you as soon as possible.';
        wp_send_json_success( [ 'message' => $succ_msg ] );
    } else {
        $err_msg = ( $lang === 'vi' )
            ? 'Có lỗi xảy ra khi gửi email qua hệ thống máy chủ SMTP. Xin vui lòng liên hệ hotline hoặc thử lại.'
            : 'An error occurred while sending email through the SMTP server. Please contact our hotline or try again.';
        wp_send_json_error( [ 'message' => $err_msg ] );
    }
}

/**
 * Build Admin Notification Email for Contact Form
 */
function doublet_build_admin_contact_email( $data ) {
    $full_name  = esc_html( $data['full_name'] );
    $email      = esc_html( $data['email'] );
    $phone      = esc_html( $data['phone'] );
    $company    = ! empty( $data['company'] ) ? esc_html( $data['company'] ) : '<em>(Chưa cung cấp)</em>';
    $message    = ! empty( $data['message'] ) ? nl2br( esc_html( $data['message'] ) ) : '<em>(Không có nội dung tin nhắn)</em>';
    $now_date   = esc_html( $data['now_date'] );
    $source_url = esc_url( $data['source_url'] );
    $device     = esc_html( $data['device'] );
    $ip_address = esc_html( $data['ip_address'] );
    $site_url   = esc_url( home_url( '/' ) );

    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tin Nhắn Liên Hệ Mới - Double T Metal</title>
    </head>
    <body style="margin: 0; padding: 0; background-color: #EDEFF4; font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; color: #14171F;">
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #EDEFF4; padding: 36px 12px;">
            <tr>
                <td align="center">
                    <table role="presentation" width="100%" max-width="620" cellspacing="0" cellpadding="0" border="0" style="max-width: 620px; width: 100%; background-color: #FFFFFF; border-radius: 8px; overflow: hidden; box-shadow: 0 10px 30px rgba(20, 23, 31, 0.08); border: 1px solid #DCDFE8;">
                        
                        <!-- Top Gradient Accent Bar -->
                        <tr>
                            <td style="height: 5px; background: linear-gradient(93deg, #20B7C6 0%, #0B6F7E 100%);"></td>
                        </tr>

                        <!-- Brand Header -->
                        <tr>
                            <td style="padding: 28px 36px; background-color: #14171F; border-bottom: 2px solid #20B7C6;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td>
                                            <div style="font-size: 26px; font-weight: 800; letter-spacing: 1.5px; color: #FFFFFF; text-transform: uppercase;">
                                                DOUBLE <span style="color: #EB1F30;">T</span>
                                            </div>
                                            <div style="font-size: 11px; font-weight: 600; color: #20B7C6; letter-spacing: 2px; text-transform: uppercase; margin-top: 4px;">
                                                METAL COMPANY LIMITED
                                            </div>
                                        </td>
                                        <td align="right" valign="middle">
                                            <span style="display: inline-block; background-color: rgba(32, 183, 198, 0.15); border: 1px solid #20B7C6; color: #20B7C6; padding: 6px 12px; font-size: 11px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; border-radius: 4px;">
                                                LIÊN HỆ MỚI
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- Title Section -->
                        <tr>
                            <td style="padding: 24px 36px 18px 36px; background-color: #F8FAFB; border-bottom: 1px solid #DCDFE8;">
                                <h1 style="margin: 0 0 6px 0; font-size: 20px; font-weight: 700; color: #0B6F7E; text-transform: uppercase; letter-spacing: 0.5px;">
                                    Thông Tin Tin Nhắn Liên Hệ Mới
                                </h1>
                                <p style="margin: 0; font-size: 13px; color: #4A5163; line-height: 1.5;">
                                    Khách hàng vừa gửi lời nhắn từ biểu mẫu Liên Hệ (Contact Page) trên website.
                                </p>
                            </td>
                        </tr>

                        <!-- Customer Details Content -->
                        <tr>
                            <td style="padding: 28px 36px 20px 36px;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
                                    
                                    <!-- Full Name -->
                                    <tr>
                                        <td width="35%" style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px;">
                                            Họ và tên
                                        </td>
                                        <td width="65%" style="padding: 12px 14px; font-size: 15px; font-weight: 700; color: #14171F; border-bottom: 1px solid #EDEFF4;">
                                            <?php echo $full_name; ?>
                                        </td>
                                    </tr>

                                    <!-- Phone Number -->
                                    <tr>
                                        <td style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px;">
                                            Số điện thoại
                                        </td>
                                        <td style="padding: 12px 14px; font-size: 15px; font-weight: 700; color: #EB1F30; border-bottom: 1px solid #EDEFF4;">
                                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" style="color: #EB1F30; text-decoration: none;">
                                                <?php echo $phone; ?>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Email -->
                                    <tr>
                                        <td style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px;">
                                            Địa chỉ Email
                                        </td>
                                        <td style="padding: 12px 14px; font-size: 14px; font-weight: 600; color: #0B6F7E; border-bottom: 1px solid #EDEFF4;">
                                            <a href="mailto:<?php echo esc_attr( $email ); ?>" style="color: #0B6F7E; text-decoration: underline;">
                                                <?php echo $email; ?>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Company -->
                                    <tr>
                                        <td style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px;">
                                            Công ty / Đơn vị
                                        </td>
                                        <td style="padding: 12px 14px; font-size: 14px; color: #14171F; border-bottom: 1px solid #EDEFF4;">
                                            <?php echo $company; ?>
                                        </td>
                                    </tr>

                                    <!-- Message Box -->
                                    <tr>
                                        <td style="padding: 14px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px; vertical-align: top;">
                                            Nội dung tin nhắn
                                        </td>
                                        <td style="padding: 14px 14px; border-bottom: 1px solid #EDEFF4;">
                                            <div style="background-color: #F8FAFB; border-left: 4px solid #0B6F7E; padding: 12px 16px; border-radius: 0 4px 4px 0; font-size: 14px; line-height: 1.7; color: #14171F;">
                                                <?php echo $message; ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Submission Date -->
                                    <tr>
                                        <td style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px;">
                                            Thời gian gửi
                                        </td>
                                        <td style="padding: 12px 14px; font-size: 13px; color: #14171F; border-bottom: 1px solid #EDEFF4;">
                                            <?php echo $now_date; ?>
                                        </td>
                                    </tr>

                                    <!-- Source Page -->
                                    <tr>
                                        <td style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; text-transform: uppercase; letter-spacing: 0.5px;">
                                            Nguồn trang
                                        </td>
                                        <td style="padding: 12px 14px; font-size: 12px; color: #8A90A3; word-break: break-all;">
                                            <a href="<?php echo $source_url; ?>" target="_blank" style="color: #0B6F7E; text-decoration: none;">
                                                <?php echo $source_url; ?>
                                            </a>
                                            <span style="display: block; margin-top: 4px; color: #8A90A3;">Thiết bị: <?php echo $device; ?> | IP: <?php echo $ip_address; ?></span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- Quick Actions Section -->
                        <tr>
                            <td style="padding: 0 36px 32px 36px;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #F8FAFB; border: 1px dashed #DCDFE8; border-radius: 6px; padding: 18px 20px;">
                                    <tr>
                                        <td align="center" style="padding-bottom: 12px; font-size: 13px; font-weight: 700; color: #14171F; text-transform: uppercase; letter-spacing: 0.5px;">
                                            Hành Động Nhanh Cho Đội Ngũ Chăm Sóc Khách Hàng
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <!-- Call Button -->
                                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" style="display: inline-block; background-color: #EB1F30; color: #FFFFFF; font-size: 13px; font-weight: 700; text-decoration: none; padding: 10px 22px; border-radius: 4px; margin: 4px 6px;">
                                                &#9742; GỌI ĐIỆN NGAY
                                            </a>
                                            <!-- Reply Email Button -->
                                            <a href="mailto:<?php echo esc_attr( $email ); ?>?subject=Double%20T%20Metal%20-%20Ph%E1%BA%A3n%20h%E1%BB%93i%20th%C3%B4ng%20tin%20li%C3%AAn%20h%E1%BB%87" style="display: inline-block; background-color: #0B6F7E; color: #FFFFFF; font-size: 13px; font-weight: 700; text-decoration: none; padding: 10px 22px; border-radius: 4px; margin: 4px 6px;">
                                                &#9993; TRẢ LỜI EMAIL
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- Corporate Footer from Theme Options -->
                        <?php echo doublet_build_email_footer_html( $data['lang'] ?? 'vi', true ); ?>

                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>
    <?php
    return ob_get_clean();
}

/**
 * Build Customer Confirmation Email for Contact Form
 */
function doublet_build_customer_contact_confirmation_email( $data ) {
    $lang       = ( isset( $data['lang'] ) && strtolower( trim( (string) $data['lang'] ) ) === 'vi' ) ? 'vi' : 'en';
    $full_name  = esc_html( $data['full_name'] );
    $phone      = esc_html( $data['phone'] );
    $message    = ! empty( $data['message'] ) ? nl2br( esc_html( $data['message'] ) ) : '';
    $site_url   = esc_url( home_url( '/' ) );
    $email_title = ( $lang === 'vi' ) ? 'Xác Nhận Liên Hệ - Double T Metal' : 'Contact Inquiry Confirmation - Double T Metal';
    $phone_call  = trim( (string) tr_options_field( 'tr_theme_options.footer_hcm_phone' ) ?: tr_options_field( 'tr_theme_options.footer_hq_phone' ) ?: '028.3816.5435 – 028.3816.5436' );

    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="<?php echo $lang; ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo esc_html( $email_title ); ?></title>
    </head>
    <body style="margin: 0; padding: 0; background-color: #EDEFF4; font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; color: #14171F;">
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #EDEFF4; padding: 36px 12px;">
            <tr>
                <td align="center">
                    <table role="presentation" width="100%" max-width="620" cellspacing="0" cellpadding="0" border="0" style="max-width: 620px; width: 100%; background-color: #FFFFFF; border-radius: 8px; overflow: hidden; box-shadow: 0 10px 30px rgba(20, 23, 31, 0.08); border: 1px solid #DCDFE8;">
                        
                        <!-- Top Accent Bar -->
                        <tr>
                            <td style="height: 5px; background: linear-gradient(93deg, #20B7C6 0%, #0B6F7E 100%);"></td>
                        </tr>

                        <!-- Brand Header -->
                        <tr>
                            <td style="padding: 28px 36px; background-color: #14171F;">
                                <div style="font-size: 26px; font-weight: 800; letter-spacing: 1.5px; color: #FFFFFF; text-transform: uppercase;">
                                    DOUBLE <span style="color: #EB1F30;">T</span>
                                </div>
                                <div style="font-size: 11px; font-weight: 600; color: #20B7C6; letter-spacing: 2px; text-transform: uppercase; margin-top: 4px;">
                                    METAL COMPANY LIMITED
                                </div>
                            </td>
                        </tr>

                        <!-- Message Body -->
                        <tr>
                            <td style="padding: 32px 36px 24px 36px;">
                                <?php if ( $lang === 'vi' ) : ?>
                                    <h1 style="margin: 0 0 16px 0; font-size: 20px; font-weight: 700; color: #0B6F7E;">
                                        Kính gửi Quý khách <?php echo $full_name; ?>,
                                    </h1>
                                    <p style="margin: 0 0 16px 0; font-size: 14px; line-height: 1.7; color: #4A5163;">
                                        Cảm ơn Quý khách đã gửi tin nhắn liên hệ đến <strong>Công ty TNHH Kỹ Thuật Double T</strong>. Chúng tôi đã nhận được thông điệp của Quý vị và sẽ phản hồi trong thời gian sớm nhất.
                                    </p>
                                    
                                    <?php if ( $message ) : ?>
                                        <div style="background-color: #F8FAFB; border-left: 4px solid #0B6F7E; padding: 14px 18px; margin: 20px 0; border-radius: 0 4px 4px 0;">
                                            <div style="font-size: 12px; font-weight: 600; color: #8A90A3; text-transform: uppercase; letter-spacing: 0.5px;">Nội dung Quý khách đã gửi:</div>
                                            <div style="font-size: 14px; color: #14171F; margin-top: 6px; line-height: 1.6;"><?php echo $message; ?></div>
                                        </div>
                                    <?php endif; ?>

                                    <p style="margin: 0 0 16px 0; font-size: 14px; line-height: 1.7; color: #4A5163;">
                                        Đội ngũ chuyên viên phụ trách của chúng tôi sẽ liên hệ lại qua email hoặc số điện thoại <strong><?php echo $phone; ?></strong> để trao đổi chi tiết.
                                    </p>

                                    <p style="margin: 0 0 24px 0; font-size: 14px; line-height: 1.7; color: #4A5163;">
                                        Nếu có yêu cầu khẩn cấp, Quý khách vui lòng gọi trực tiếp hotline hỗ trợ:
                                        <br>
                                        <strong style="color: #EB1F30; font-size: 16px;"><?php echo esc_html( $phone_call ); ?></strong>
                                    </p>

                                    <div style="border-top: 1px solid #EDEFF4; padding-top: 20px; font-size: 14px; color: #14171F;">
                                        Trân trọng,<br>
                                        <strong>Ban Quản Trị Double T Metal</strong>
                                    </div>
                                <?php else : ?>
                                    <h1 style="margin: 0 0 16px 0; font-size: 20px; font-weight: 700; color: #0B6F7E;">
                                        Dear <?php echo $full_name; ?>,
                                    </h1>
                                    <p style="margin: 0 0 16px 0; font-size: 14px; line-height: 1.7; color: #4A5163;">
                                        Thank you for contacting <strong>Double T Metal Co., Ltd</strong>. We have successfully received your inquiry and will respond to you as soon as possible.
                                    </p>
                                    
                                    <?php if ( $message ) : ?>
                                        <div style="background-color: #F8FAFB; border-left: 4px solid #0B6F7E; padding: 14px 18px; margin: 20px 0; border-radius: 0 4px 4px 0;">
                                            <div style="font-size: 12px; font-weight: 600; color: #8A90A3; text-transform: uppercase; letter-spacing: 0.5px;">Your submitted message:</div>
                                            <div style="font-size: 14px; color: #14171F; margin-top: 6px; line-height: 1.6;"><?php echo $message; ?></div>
                                        </div>
                                    <?php endif; ?>

                                    <p style="margin: 0 0 16px 0; font-size: 14px; line-height: 1.7; color: #4A5163;">
                                        Our representative will get in touch with you via email or phone <strong><?php echo $phone; ?></strong> to assist you promptly.
                                    </p>

                                    <p style="margin: 0 0 24px 0; font-size: 14px; line-height: 1.7; color: #4A5163;">
                                        For urgent inquiries, please contact our hotline directly:
                                        <br>
                                        <strong style="color: #EB1F30; font-size: 16px;"><?php echo esc_html( $phone_call ); ?></strong>
                                    </p>

                                    <div style="border-top: 1px solid #EDEFF4; padding-top: 20px; font-size: 14px; color: #14171F;">
                                        Best regards,<br>
                                        <strong>Double T Metal Management Team</strong>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <!-- Corporate Footer from Theme Options -->
                        <?php echo doublet_build_email_footer_html( $lang, false ); ?>

                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>
    <?php
    return ob_get_clean();
}

/* ==========================================================================
   3. Single Career Apply Form Submission Handler (Trang Tuyển Dụng)
   ========================================================================== */

add_action( 'wp_ajax_doublet_submit_career_apply', 'doublet_ajax_handle_career_apply' );
add_action( 'wp_ajax_nopriv_doublet_submit_career_apply', 'doublet_ajax_handle_career_apply' );

function doublet_ajax_handle_career_apply() {
    // 0. Detect Language
    $lang = ( isset( $_POST['lang'] ) && strtolower( trim( (string) $_POST['lang'] ) ) === 'en' ) ? 'en' : 'vi';

    // 1. Verify Nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'doublet_career_nonce' ) ) {
        $nonce_msg = ( $lang === 'vi' )
            ? 'Phiên làm việc đã hết hạn. Vui lòng tải lại trang và thử lại (Invalid security token).'
            : 'Session expired or security token invalid. Please refresh the page and try again.';
        wp_send_json_error( [ 'message' => $nonce_msg ] );
    }

    // 1.1 Rate Limiting: Maximum 5 requests per 1 minute (60s)
    if ( ! doublet_check_rate_limit( 'career', 5, 60 ) ) {
        $rate_msg = ( $lang === 'vi' )
            ? 'Bạn đã gửi quá nhiều yêu cầu trong thời gian ngắn (tối đa 5 lần/phút). Vui lòng đợi ít phút trước khi thử lại.'
            : 'You have submitted too many requests in a short time (maximum 5 requests per minute). Please wait a moment before trying again.';
        wp_send_json_error( [ 'message' => $rate_msg ] );
    }

    // 1.2 Verify Google reCAPTCHA v3 if configured
    $recaptcha_token = isset( $_POST['recaptcha_token'] ) ? sanitize_text_field( $_POST['recaptcha_token'] ) : ( isset( $_POST['g-recaptcha-response'] ) ? sanitize_text_field( $_POST['g-recaptcha-response'] ) : '' );
    if ( ! doublet_verify_recaptcha( $recaptcha_token, 'career' ) ) {
        $rc_msg = ( $lang === 'vi' )
            ? 'Hệ thống phát hiện bảo mật không an toàn qua reCAPTCHA (nghi vấn spam). Vui lòng thử lại.'
            : 'Security verification failed via reCAPTCHA (potential spam detected). Please try again.';
        wp_send_json_error( [ 'message' => $rc_msg ] );
    }

    // 2. Sanitize and Validate Inputs
    $full_name  = isset( $_POST['fullName'] ) ? sanitize_text_field( trim( $_POST['fullName'] ) ) : '';
    $email      = isset( $_POST['email'] ) ? sanitize_email( trim( $_POST['email'] ) ) : '';
    $phone      = isset( $_POST['phoneNumber'] ) ? sanitize_text_field( trim( $_POST['phoneNumber'] ) ) : '';
    $intro      = isset( $_POST['intro'] ) ? sanitize_textarea_field( trim( $_POST['intro'] ) ) : '';
    $job_title  = isset( $_POST['job_title'] ) ? sanitize_text_field( trim( $_POST['job_title'] ) ) : ( $lang === 'vi' ? 'Vị trí tuyển dụng' : 'Career Position' );
    $job_id     = isset( $_POST['job_id'] ) ? absint( $_POST['job_id'] ) : 0;

    if ( empty( $full_name ) ) {
        wp_send_json_error( [ 'message' => ( $lang === 'vi' ? 'Vui lòng nhập họ và tên của bạn.' : 'Please enter your full name.' ) ] );
    }

    if ( empty( $email ) || ! is_email( $email ) ) {
        wp_send_json_error( [ 'message' => ( $lang === 'vi' ? 'Địa chỉ email không hợp lệ. Vui lòng kiểm tra lại.' : 'Invalid email address. Please check and try again.' ) ] );
    }

    if ( empty( $phone ) ) {
        wp_send_json_error( [ 'message' => ( $lang === 'vi' ? 'Vui lòng nhập số điện thoại liên hệ.' : 'Please enter your phone number.' ) ] );
    }

    if ( empty( $intro ) ) {
        wp_send_json_error( [ 'message' => ( $lang === 'vi' ? 'Vui lòng nhập đôi nét giới thiệu về bản thân bạn.' : 'Please introduce yourself.' ) ] );
    }

    // 2.1 Handle CV File Upload
    $cv_file_url  = '';
    $cv_file_path = '';

    if ( ! empty( $_FILES['cv_file']['name'] ) ) {
        if ( ! function_exists( 'wp_handle_upload' ) ) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }

        $uploaded_file = $_FILES['cv_file'];
        $upload_overrides = [
            'test_form' => false,
            'mimes'     => [
                'pdf'  => 'application/pdf',
                'doc'  => 'application/msword',
                'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            ],
        ];

        // Size check (max 15MB)
        if ( $uploaded_file['size'] > 15 * 1024 * 1024 ) {
            $size_err = ( $lang === 'vi' )
                ? 'Kích thước tệp CV vượt quá dung lượng cho phép (tối đa 15MB).'
                : 'CV file size exceeds the 15MB limit.';
            wp_send_json_error( [ 'message' => $size_err ] );
        }

        $movefile = wp_handle_upload( $uploaded_file, $upload_overrides );

        if ( $movefile && ! isset( $movefile['error'] ) ) {
            $cv_file_path = $movefile['file'];
            $cv_file_url  = $movefile['url'];
        } else {
            $upload_err = ( $lang === 'vi' )
                ? 'Không thể tải lên tệp CV: ' . ( $movefile['error'] ?? 'Vui lòng kiểm tra định dạng tệp (PDF, DOC, DOCX).' )
                : 'Unable to upload CV file: ' . ( $movefile['error'] ?? 'Please check file format (PDF, DOC, DOCX).' );
            wp_send_json_error( [ 'message' => $upload_err ] );
        }
    } else {
        $no_cv_err = ( $lang === 'vi' )
            ? 'Vui lòng đính kèm tệp CV ứng tuyển của bạn.'
            : 'Please upload your CV file.';
        wp_send_json_error( [ 'message' => $no_cv_err ] );
    }

    // Current metadata
    $now_date   = current_time( 'd/m/Y H:i:s' );
    $ip_address = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( $_SERVER['REMOTE_ADDR'] ) : 'N/A';
    $user_agent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( $_SERVER['HTTP_USER_AGENT'] ) : 'N/A';
    $device     = wp_is_mobile() ? 'Mobile' : 'Desktop';
    $source_url = wp_get_referer() ? esc_url( wp_get_referer() ) : ( $job_id ? get_permalink( $job_id ) : home_url( '/careers/' ) );

    // 3. Save to Database Post Type 'register'
    $post_data = [
        'post_title'   => '[Ứng tuyển] ' . $full_name . ' - ' . $job_title,
        'post_type'    => 'register',
        'post_status'  => 'publish',
        'post_content' => $intro,
    ];
    $post_id = wp_insert_post( $post_data );
    if ( $post_id && ! is_wp_error( $post_id ) ) {
        update_post_meta( $post_id, 'mobile', $phone );
        update_post_meta( $post_id, 'email', $email );
        update_post_meta( $post_id, 'content', $intro );
        update_post_meta( $post_id, 'interest', 'Ứng tuyển: ' . $job_title );
        update_post_meta( $post_id, 'job_title', $job_title );
        update_post_meta( $post_id, 'job_id', $job_id );
        update_post_meta( $post_id, 'cv_url', $cv_file_url );
        update_post_meta( $post_id, 'cv_path', $cv_file_path );
        update_post_meta( $post_id, 'device', $device );
        update_post_meta( $post_id, 'source', $source_url );
        update_post_meta( $post_id, 'user_agent', $user_agent );
        update_post_meta( $post_id, 'ip_address', $ip_address );
        update_post_meta( $post_id, 'lang', $lang );
    }

    // 4. Retrieve SMTP & Recipient Settings from Theme Options
    $receive_email_opt = tr_options_field( 'tr_theme_options.receive_email' );
    if ( empty( $receive_email_opt ) ) {
        $receive_email_opt = tr_options_field( 'tr_theme_options.footer_hcm_email' ) ?: get_option( 'admin_email' );
    }

    $to_emails = [];
    foreach ( explode( ',', $receive_email_opt ) as $em ) {
        $em = sanitize_email( trim( $em ) );
        if ( is_email( $em ) ) {
            $to_emails[] = $em;
        }
    }
    if ( empty( $to_emails ) ) {
        $to_emails[] = get_option( 'admin_email' );
    }

    $raw_from   = trim( (string) tr_options_field( 'tr_theme_options.from_email' ) );
    $username   = trim( (string) tr_options_field( 'tr_theme_options.username' ) );
    $from_email = is_email( $raw_from ) ? $raw_from : ( is_email( $username ) ? $username : get_option( 'admin_email' ) );
    $from_name  = ( ! empty( $raw_from ) && ! is_email( $raw_from ) ) ? $raw_from : ( get_bloginfo( 'name' ) ?: 'Double T Metal Co., LTD' );

    // 5. Build Admin Notification Email
    $admin_subject = sprintf( '[Double T] %s: %s - %s', ( $lang === 'vi' ? 'Hồ sơ ứng tuyển mới' : 'New Job Application' ), $job_title, $full_name );
    $admin_body    = doublet_build_admin_career_email( [
        'full_name'    => $full_name,
        'email'        => $email,
        'phone'        => $phone,
        'intro'        => $intro,
        'job_title'    => $job_title,
        'cv_file_url'  => $cv_file_url,
        'cv_file_name' => ! empty( $_FILES['cv_file']['name'] ) ? sanitize_file_name( $_FILES['cv_file']['name'] ) : 'CV_Attachment',
        'now_date'     => $now_date,
        'source_url'   => $source_url,
        'device'       => $device,
        'ip_address'   => $ip_address,
        'lang'         => $lang,
    ] );

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $from_name . ' <' . $from_email . '>',
        'Reply-To: ' . $full_name . ' <' . $email . '>',
    ];

    $attachments = [];
    if ( ! empty( $cv_file_path ) && file_exists( $cv_file_path ) ) {
        $attachments[] = $cv_file_path;
    }

    // Send email to admin
    $mail_sent = wp_mail( $to_emails, $admin_subject, $admin_body, $headers, $attachments );

    // 6. Send Confirmation Email to Candidate
    if ( is_email( $email ) ) {
        $customer_subject = ( $lang === 'vi' )
            ? sprintf( 'Double T Metal - Xác nhận đã nhận hồ sơ ứng tuyển: %s', $job_title )
            : sprintf( 'Double T Metal - Application Received: %s', $job_title );

        $customer_body = doublet_build_customer_career_confirmation_email( [
            'full_name' => $full_name,
            'job_title' => $job_title,
            'phone'     => $phone,
            'email'     => $email,
            'intro'     => $intro,
            'now_date'  => $now_date,
            'lang'      => $lang,
        ] );

        $customer_headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $from_name . ' <' . $from_email . '>',
            'Reply-To: ' . $from_name . ' <' . $from_email . '>',
        ];

        wp_mail( $email, $customer_subject, $customer_body, $customer_headers );
    }

    if ( $mail_sent || $post_id ) {
        $succ_msg = ( $lang === 'vi' )
            ? 'Nộp đơn ứng tuyển thành công! Double T đã nhận được hồ sơ của bạn và sẽ liên hệ trong thời gian sớm nhất.'
            : 'Application submitted successfully! Double T has received your application and will contact you shortly.';
        wp_send_json_success( [ 'message' => $succ_msg ] );
    } else {
        $err_msg = ( $lang === 'vi' )
            ? 'Có lỗi xảy ra khi gửi hồ sơ qua hệ thống máy chủ SMTP. Xin vui lòng liên hệ hotline hoặc thử lại.'
            : 'An error occurred while sending your application. Please contact our hotline or try again.';
        wp_send_json_error( [ 'message' => $err_msg ] );
    }
}

/**
 * Build Admin Notification Email for Career Application
 */
function doublet_build_admin_career_email( $data ) {
    $full_name    = esc_html( $data['full_name'] );
    $email        = esc_html( $data['email'] );
    $phone        = esc_html( $data['phone'] );
    $job_title    = esc_html( $data['job_title'] );
    $intro        = ! empty( $data['intro'] ) ? nl2br( esc_html( $data['intro'] ) ) : '<em>(Không có giới thiệu)</em>';
    $cv_file_url  = ! empty( $data['cv_file_url'] ) ? esc_url( $data['cv_file_url'] ) : '';
    $cv_file_name = ! empty( $data['cv_file_name'] ) ? esc_html( $data['cv_file_name'] ) : 'Xem tệp đính kèm';
    $now_date     = esc_html( $data['now_date'] );
    $source_url   = esc_url( $data['source_url'] );
    $device       = esc_html( $data['device'] );
    $ip_address   = esc_html( $data['ip_address'] );
    $site_url     = esc_url( home_url( '/' ) );
    $lang         = $data['lang'] ?? 'vi';

    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="<?php echo $lang; ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hồ Sơ Ứng Tuyển Mới - Double T Metal</title>
    </head>
    <body style="margin: 0; padding: 0; background-color: #EDEFF4; font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; color: #14171F;">
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #EDEFF4; padding: 36px 12px;">
            <tr>
                <td align="center">
                    <table role="presentation" width="100%" max-width="620" cellspacing="0" cellpadding="0" border="0" style="max-width: 620px; width: 100%; background-color: #FFFFFF; border-radius: 8px; overflow: hidden; box-shadow: 0 10px 30px rgba(20, 23, 31, 0.08); border: 1px solid #DCDFE8;">
                        
                        <!-- Top Gradient Accent Bar -->
                        <tr>
                            <td style="height: 5px; background: linear-gradient(93deg, #20B7C6 0%, #0B6F7E 100%);"></td>
                        </tr>

                        <!-- Brand Header -->
                        <tr>
                            <td style="padding: 28px 36px; background-color: #14171F; border-bottom: 2px solid #20B7C6;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td>
                                            <div style="font-size: 26px; font-weight: 800; letter-spacing: 1.5px; color: #FFFFFF; text-transform: uppercase;">
                                                DOUBLE <span style="color: #EB1F30;">T</span>
                                            </div>
                                            <div style="font-size: 11px; font-weight: 600; color: #20B7C6; letter-spacing: 2px; text-transform: uppercase; margin-top: 4px;">
                                                METAL COMPANY LIMITED
                                            </div>
                                        </td>
                                        <td align="right" valign="middle">
                                            <span style="display: inline-block; background-color: rgba(32, 183, 198, 0.15); border: 1px solid #20B7C6; color: #20B7C6; padding: 6px 12px; font-size: 11px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; border-radius: 4px;">
                                                <?php echo ( $lang === 'vi' ? 'ỨNG VIÊN MỚI' : 'NEW APPLICANT' ); ?>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- Title Section -->
                        <tr>
                            <td style="padding: 24px 36px 18px 36px; background-color: #F8FAFB; border-bottom: 1px solid #DCDFE8;">
                                <h1 style="margin: 0 0 6px 0; font-size: 20px; font-weight: 700; color: #0B6F7E; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <?php echo ( $lang === 'vi' ? 'Thông Tin Hồ Sơ Ứng Tuyển Mới' : 'New Career Application Details' ); ?>
                                </h1>
                                <p style="margin: 0; font-size: 13px; color: #4A5163; line-height: 1.5;">
                                    <?php echo ( $lang === 'vi' ? 'Ứng viên vừa nộp đơn ứng tuyển từ website Double T.' : 'A candidate has just submitted their application through the Double T website.' ); ?>
                                </p>
                            </td>
                        </tr>

                        <!-- Candidate Details Table -->
                        <tr>
                            <td style="padding: 28px 36px 20px 36px;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
                                    
                                    <!-- Position -->
                                    <tr>
                                        <td width="35%" style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px;">
                                            <?php echo ( $lang === 'vi' ? 'Vị trí ứng tuyển' : 'Position' ); ?>
                                        </td>
                                        <td width="65%" style="padding: 12px 14px; font-size: 15px; font-weight: 700; color: #0B6F7E; border-bottom: 1px solid #EDEFF4;">
                                            <?php echo $job_title; ?>
                                        </td>
                                    </tr>

                                    <!-- Candidate Name -->
                                    <tr>
                                        <td style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px;">
                                            <?php echo ( $lang === 'vi' ? 'Họ và tên ứng viên' : 'Candidate Name' ); ?>
                                        </td>
                                        <td style="padding: 12px 14px; font-size: 15px; font-weight: 700; color: #14171F; border-bottom: 1px solid #EDEFF4;">
                                            <?php echo $full_name; ?>
                                        </td>
                                    </tr>

                                    <!-- Phone Number -->
                                    <tr>
                                        <td style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px;">
                                            <?php echo ( $lang === 'vi' ? 'Số điện thoại' : 'Phone Number' ); ?>
                                        </td>
                                        <td style="padding: 12px 14px; font-size: 15px; font-weight: 700; color: #EB1F30; border-bottom: 1px solid #EDEFF4;">
                                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" style="color: #EB1F30; text-decoration: none;">
                                                <?php echo $phone; ?>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Email -->
                                    <tr>
                                        <td style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px;">
                                            Email
                                        </td>
                                        <td style="padding: 12px 14px; font-size: 14px; font-weight: 600; color: #0B6F7E; border-bottom: 1px solid #EDEFF4;">
                                            <a href="mailto:<?php echo esc_attr( $email ); ?>" style="color: #0B6F7E; text-decoration: underline;">
                                                <?php echo $email; ?>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Attached CV File -->
                                    <tr>
                                        <td style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px;">
                                            <?php echo ( $lang === 'vi' ? 'Tệp đính kèm CV' : 'Attached CV File' ); ?>
                                        </td>
                                        <td style="padding: 12px 14px; font-size: 14px; border-bottom: 1px solid #EDEFF4;">
                                            <?php if ( $cv_file_url ) : ?>
                                                <a href="<?php echo $cv_file_url; ?>" target="_blank" style="display: inline-block; background-color: #0B6F7E; color: #FFFFFF; font-size: 12px; font-weight: 700; text-decoration: none; padding: 6px 14px; border-radius: 4px;">
                                                    &#128196; <?php echo ( $lang === 'vi' ? 'Xem / Tải CV: ' : 'View / Download CV: ' ) . $cv_file_name; ?>
                                                </a>
                                                <div style="font-size: 11px; color: #8A90A3; margin-top: 4px;">(Tệp CV cũng đã được đính kèm trực tiếp vào email này)</div>
                                            <?php else : ?>
                                                <em>(Chưa có liên kết tệp)</em>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <!-- Cover Intro -->
                                    <tr>
                                        <td style="padding: 14px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px; vertical-align: top;">
                                            <?php echo ( $lang === 'vi' ? 'Giới thiệu bản thân' : 'Cover Intro' ); ?>
                                        </td>
                                        <td style="padding: 14px 14px; border-bottom: 1px solid #EDEFF4;">
                                            <div style="background-color: #F8FAFB; border-left: 4px solid #0B6F7E; padding: 12px 16px; border-radius: 0 4px 4px 0; font-size: 14px; line-height: 1.7; color: #14171F;">
                                                <?php echo $intro; ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Submission Date -->
                                    <tr>
                                        <td style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; border-bottom: 1px solid #EDEFF4; text-transform: uppercase; letter-spacing: 0.5px;">
                                            <?php echo ( $lang === 'vi' ? 'Thời gian gửi' : 'Submission Time' ); ?>
                                        </td>
                                        <td style="padding: 12px 14px; font-size: 13px; color: #14171F; border-bottom: 1px solid #EDEFF4;">
                                            <?php echo $now_date; ?>
                                        </td>
                                    </tr>

                                    <!-- Source Page -->
                                    <tr>
                                        <td style="padding: 12px 14px; font-size: 13px; font-weight: 600; color: #4A5163; text-transform: uppercase; letter-spacing: 0.5px;">
                                            <?php echo ( $lang === 'vi' ? 'Nguồn trang' : 'Source Page' ); ?>
                                        </td>
                                        <td style="padding: 12px 14px; font-size: 12px; color: #8A90A3; word-break: break-all;">
                                            <a href="<?php echo $source_url; ?>" target="_blank" style="color: #0B6F7E; text-decoration: none;">
                                                <?php echo $source_url; ?>
                                            </a>
                                            <span style="display: block; margin-top: 4px; color: #8A90A3;">Thiết bị: <?php echo $device; ?> | IP: <?php echo $ip_address; ?></span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- Quick Actions Section -->
                        <tr>
                            <td style="padding: 0 36px 32px 36px;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #F8FAFB; border: 1px dashed #DCDFE8; border-radius: 6px; padding: 18px 20px;">
                                    <tr>
                                        <td align="center" style="padding-bottom: 12px; font-size: 13px; font-weight: 700; color: #14171F; text-transform: uppercase; letter-spacing: 0.5px;">
                                            <?php echo ( $lang === 'vi' ? 'Hành Động Nhanh Cho Đội Ngũ Nhân Sự (HR)' : 'Quick Actions for HR Team' ); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <!-- Call Button -->
                                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" style="display: inline-block; background-color: #EB1F30; color: #FFFFFF; font-size: 13px; font-weight: 700; text-decoration: none; padding: 10px 22px; border-radius: 4px; margin: 4px 6px;">
                                                &#9742; <?php echo ( $lang === 'vi' ? 'GỌI ỨNG VIÊN' : 'CALL CANDIDATE' ); ?>
                                            </a>
                                            <!-- Reply Email Button -->
                                            <a href="mailto:<?php echo esc_attr( $email ); ?>?subject=Double%20T%20Metal%20-%20Ph%E1%BA%A3n%20h%E1%BB%93i%20h%E1%BB%93%20s%C6%A1%20%E1%BB%A9ng%20tuy%E1%BB%83n%20<?php echo rawurlencode( $job_title ); ?>" style="display: inline-block; background-color: #0B6F7E; color: #FFFFFF; font-size: 13px; font-weight: 700; text-decoration: none; padding: 10px 22px; border-radius: 4px; margin: 4px 6px;">
                                                &#9993; <?php echo ( $lang === 'vi' ? 'TRẢ LỜI EMAIL' : 'REPLY EMAIL' ); ?>
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- Corporate Footer from Theme Options -->
                        <?php echo doublet_build_email_footer_html( $lang, true ); ?>

                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>
    <?php
    return ob_get_clean();
}

/**
 * Build Customer Confirmation Email for Career Application
 */
function doublet_build_customer_career_confirmation_email( $data ) {
    $lang       = ( isset( $data['lang'] ) && strtolower( trim( (string) $data['lang'] ) ) === 'vi' ) ? 'vi' : 'en';
    $full_name  = esc_html( $data['full_name'] );
    $job_title  = esc_html( $data['job_title'] );
    $phone      = esc_html( $data['phone'] );
    $email      = esc_html( $data['email'] );
    $intro      = ! empty( $data['intro'] ) ? nl2br( esc_html( $data['intro'] ) ) : '';
    $site_url   = esc_url( home_url( '/' ) );
    $email_title = ( $lang === 'vi' ) ? 'Xác Nhận Nhận Hồ Sơ Ứng Tuyển - Double T Metal' : 'Application Received Confirmation - Double T Metal';
    $phone_call  = trim( (string) tr_options_field( 'tr_theme_options.footer_hcm_phone' ) ?: tr_options_field( 'tr_theme_options.footer_hq_phone' ) ?: '028.3816.5435 – 028.3816.5436' );

    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="<?php echo $lang; ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo esc_html( $email_title ); ?></title>
    </head>
    <body style="margin: 0; padding: 0; background-color: #EDEFF4; font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; color: #14171F;">
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #EDEFF4; padding: 36px 12px;">
            <tr>
                <td align="center">
                    <table role="presentation" width="100%" max-width="620" cellspacing="0" cellpadding="0" border="0" style="max-width: 620px; width: 100%; background-color: #FFFFFF; border-radius: 8px; overflow: hidden; box-shadow: 0 10px 30px rgba(20, 23, 31, 0.08); border: 1px solid #DCDFE8;">
                        
                        <!-- Top Accent Bar -->
                        <tr>
                            <td style="height: 5px; background: linear-gradient(93deg, #20B7C6 0%, #0B6F7E 100%);"></td>
                        </tr>

                        <!-- Brand Header -->
                        <tr>
                            <td style="padding: 28px 36px; background-color: #14171F;">
                                <div style="font-size: 26px; font-weight: 800; letter-spacing: 1.5px; color: #FFFFFF; text-transform: uppercase;">
                                    DOUBLE <span style="color: #EB1F30;">T</span>
                                </div>
                                <div style="font-size: 11px; font-weight: 600; color: #20B7C6; letter-spacing: 2px; text-transform: uppercase; margin-top: 4px;">
                                    METAL COMPANY LIMITED
                                </div>
                            </td>
                        </tr>

                        <!-- Message Body -->
                        <tr>
                            <td style="padding: 32px 36px 24px 36px;">
                                <?php if ( $lang === 'vi' ) : ?>
                                    <h1 style="margin: 0 0 16px 0; font-size: 20px; font-weight: 700; color: #0B6F7E;">
                                        Kính gửi Quý ứng viên <?php echo $full_name; ?>,
                                    </h1>
                                    <p style="margin: 0 0 16px 0; font-size: 14px; line-height: 1.7; color: #4A5163;">
                                        Cảm ơn bạn đã nộp đơn ứng tuyển cho vị trí <strong><?php echo $job_title; ?></strong> tại <strong>Công ty TNHH Kỹ Thuật Double T</strong>. Chúng tôi đã nhận được hồ sơ cùng tệp CV đính kèm của bạn.
                                    </p>
                                    
                                    <div style="background-color: #F8FAFB; border-left: 4px solid #0B6F7E; padding: 14px 18px; margin: 20px 0; border-radius: 0 4px 4px 0;">
                                        <div style="font-size: 12px; font-weight: 600; color: #8A90A3; text-transform: uppercase; letter-spacing: 0.5px;">Thông tin hồ sơ ghi nhận:</div>
                                        <div style="font-size: 14px; color: #14171F; margin-top: 6px; line-height: 1.6;">
                                            <strong>Vị trí ứng tuyển:</strong> <?php echo $job_title; ?><br>
                                            <strong>Số điện thoại:</strong> <?php echo $phone; ?><br>
                                            <strong>Email:</strong> <?php echo $email; ?>
                                        </div>
                                    </div>

                                    <p style="margin: 0 0 16px 0; font-size: 14px; line-height: 1.7; color: #4A5163;">
                                        Bộ phận Nhân sự (HR) của chúng tôi sẽ xem xét cẩn thận hồ sơ và liên hệ với bạn trong vòng <strong>5 - 7 ngày làm việc</strong> nếu bạn là ứng viên phù hợp với tiêu chí tuyển dụng.
                                    </p>

                                    <p style="margin: 0 0 24px 0; font-size: 14px; line-height: 1.7; color: #4A5163;">
                                        Nếu có bất kỳ thắc mắc nào về vị trí hoặc quy trình phỏng vấn, bạn có thể liên hệ trực tiếp hotline công ty:
                                        <br>
                                        <strong style="color: #EB1F30; font-size: 16px;"><?php echo esc_html( $phone_call ); ?></strong>
                                    </p>

                                    <div style="border-top: 1px solid #EDEFF4; padding-top: 20px; font-size: 14px; color: #14171F;">
                                        Trân trọng,<br>
                                        <strong>Phòng Nhân Sự - Double T Metal</strong>
                                    </div>
                                <?php else : ?>
                                    <h1 style="margin: 0 0 16px 0; font-size: 20px; font-weight: 700; color: #0B6F7E;">
                                        Dear <?php echo $full_name; ?>,
                                    </h1>
                                    <p style="margin: 0 0 16px 0; font-size: 14px; line-height: 1.7; color: #4A5163;">
                                        Thank you for applying for the position of <strong><?php echo $job_title; ?></strong> at <strong>Double T Metal Co., Ltd</strong>. We have successfully received your application and attached CV.
                                    </p>
                                    
                                    <div style="background-color: #F8FAFB; border-left: 4px solid #0B6F7E; padding: 14px 18px; margin: 20px 0; border-radius: 0 4px 4px 0;">
                                        <div style="font-size: 12px; font-weight: 600; color: #8A90A3; text-transform: uppercase; letter-spacing: 0.5px;">Application Summary:</div>
                                        <div style="font-size: 14px; color: #14171F; margin-top: 6px; line-height: 1.6;">
                                            <strong>Position:</strong> <?php echo $job_title; ?><br>
                                            <strong>Phone:</strong> <?php echo $phone; ?><br>
                                            <strong>Email:</strong> <?php echo $email; ?>
                                        </div>
                                    </div>

                                    <p style="margin: 0 0 16px 0; font-size: 14px; line-height: 1.7; color: #4A5163;">
                                        Our Human Resources team will review your profile and contact you within <strong>5 - 7 business days</strong> if you are shortlisted for the next stage.
                                    </p>

                                    <p style="margin: 0 0 24px 0; font-size: 14px; line-height: 1.7; color: #4A5163;">
                                        For urgent inquiries regarding the recruitment process, please reach out to our hotline:
                                        <br>
                                        <strong style="color: #EB1F30; font-size: 16px;"><?php echo esc_html( $phone_call ); ?></strong>
                                    </p>

                                    <div style="border-top: 1px solid #EDEFF4; padding-top: 20px; font-size: 14px; color: #14171F;">
                                        Best regards,<br>
                                        <strong>Human Resources Department - Double T Metal</strong>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <!-- Corporate Footer from Theme Options -->
                        <?php echo doublet_build_email_footer_html( $lang, false ); ?>

                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>
    <?php
    return ob_get_clean();
}


