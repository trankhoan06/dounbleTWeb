<?php
/**
 * Template Name: Contact
 */
get_header();

// 1. Hero Section Fields
$contact_hero_bg_id = tr_posts_field('contact_hero_bg');
$contact_hero_bg_url = $contact_hero_bg_id ? wp_get_attachment_image_url($contact_hero_bg_id, 'full') : get_template_directory_uri() . '/imgs/commit-vison.jpg';
$contact_hero_breadcrumb = tr_posts_field('contact_hero_breadcrumb') ?: 'contact';
$contact_hero_title = tr_posts_field('contact_hero_title') ?: 'CONTACT US';

// 2. Company Information Fields
$contact_info_label = tr_posts_field('contact_info_label') ?: 'DOUBLE T METAL CO.,LTD';
$contact_info_title = tr_posts_field('contact_info_title') ?: 'Our Company Information';

$contact_hq_title = tr_posts_field('contact_hq_title') ?: 'HEADQUARTERS';
$contact_hq_address = tr_posts_field('contact_hq_address') ?: 'Lot J9-10-17A-18, Road No. 6, Hai Son Industrial Park, Duc Hoa Commune, Tay Ninh Province, Vietnam';
$contact_hq_phone = tr_posts_field('contact_hq_phone') ?: '0272.249.6667 – 0272.249.6668 – 0272.249.6669';

$contact_hcm_title = tr_posts_field('contact_hcm_title') ?: 'HO CHI MINH OFFICE';
$contact_hcm_address = tr_posts_field('contact_hcm_address') ?: '221/6-8 Le Trong Tan, Son Ky Ward, Ho Chi Minh City';
$contact_hcm_email = tr_posts_field('contact_hcm_email') ?: '2t@2tsteel.com';
$contact_hcm_phone = tr_posts_field('contact_hcm_phone') ?: '028.3816.5435 – 028.3816.5436';

$contact_social_title = tr_posts_field('contact_social_title') ?: 'SOCIAL NETWORK';
$contact_facebook_url = tr_posts_field('contact_facebook_url') ?: '#';
$contact_instagram_url = tr_posts_field('contact_instagram_url') ?: '#';
$contact_x_url = tr_posts_field('contact_x_url') ?: '#';
$contact_youtube_url = tr_posts_field('contact_youtube_url') ?: '#';

// 3. Contact Form Text Fields
$contact_form_privacy = tr_posts_field('contact_form_privacy') ?: 'We are committed to maintaining the confidentiality of information and using the data solely for advisory purposes.';
$contact_form_submit_btn = tr_posts_field('contact_form_submit_btn') ?: 'SEND INFORMATION';
$contact_form_submit_note = tr_posts_field('contact_form_submit_note') ?: 'You will receive a confirmation email shortly.';

// 4. Google Maps Embed
$contact_map_iframe_src = tr_posts_field('contact_map_iframe_src') ?: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.3!2d106.6!3d10.8!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTDCsDQ4JzAwLjAiTiAxMDbCsDM2JzAwLjAiRQ!5e0!3m2!1svi!2svn!4v1600000000000!5m2!1svi!2svn';
?>

    <main class="main" id="mainContent">
        <!-- 1. Hero Section -->
        <section class="contact-hero" aria-labelledby="contactHeroTitle">
            <div class="contact-hero-bg">
                <img src="<?php echo esc_url($contact_hero_bg_url); ?>" class="img-fill"
                    alt="Double T steel processing manufacturing facility">
            </div>
            <div class="container contact-hero-container">
                <div class="contact-hero-panel">
                    <div class="contact-hero-panel-bg cut-tr"></div>
                    <nav class="contact-breadcrumb txt txt-14 txt-14_tb txt-14_mb" aria-label="Breadcrumb">
                        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                        <span class="separator" aria-hidden="true">/</span>
                        <span class="current"><?php echo esc_html($contact_hero_breadcrumb); ?></span>
                    </nav>
                    <h1 class="heading h1 h3_mb contact-hero-title" id="contactHeroTitle">
                        <?php echo esc_html($contact_hero_title); ?>
                    </h1>
                </div>
            </div>
        </section>

        <!-- 2. Main Content: Company Info + Form -->
        <section class="contact-main">
            <div class="container grid">
                <!-- Left: Company Information -->
                <div class="contact-info-col">
                    <div class="contact-info-label cut-diagonal label red-light">
                        <span class="txt txt-13 txt-semi"><?php echo esc_html($contact_info_label); ?></span>
                    </div>
                    <h2 class="heading h2 h3_tb h3_mb contact-info-heading"><?php echo esc_html($contact_info_title); ?></h2>

                    <div class="contact-info-block">
                        <!-- Headquarters -->
                        <div class="contact-info-group">
                            <h3 class="txt txt-15 txt-semi contact-info-group-title"><?php echo esc_html($contact_hq_title); ?></h3>
                            <div class="contact-info-row">
                                <span class="contact-info-icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.9999 11.8079C8.2249 11.8079 6.7749 10.3662 6.7749 8.58288C6.7749 6.79954 8.2249 5.36621 9.9999 5.36621C11.7749 5.36621 13.2249 6.80788 13.2249 8.59121C13.2249 10.3745 11.7749 11.8079 9.9999 11.8079ZM9.9999 6.61621C8.91657 6.61621 8.0249 7.49954 8.0249 8.59121C8.0249 9.68288 8.90824 10.5662 9.9999 10.5662C11.0916 10.5662 11.9749 9.68288 11.9749 8.59121C11.9749 7.49954 11.0832 6.61621 9.9999 6.61621Z"
                                            fill="#EB1F30" />
                                        <path
                                            d="M9.9999 18.967C8.76657 18.967 7.5249 18.5003 6.55824 17.5753C4.0999 15.2087 1.38324 11.4337 2.40824 6.94199C3.33324 2.86699 6.89157 1.04199 9.9999 1.04199C9.9999 1.04199 9.9999 1.04199 10.0082 1.04199C13.1166 1.04199 16.6749 2.86699 17.5999 6.95033C18.6166 11.442 15.8999 15.2087 13.4416 17.5753C12.4749 18.5003 11.2332 18.967 9.9999 18.967ZM9.9999 2.29199C7.5749 2.29199 4.45824 3.58366 3.63324 7.21699C2.73324 11.142 5.1999 14.5253 7.43324 16.667C8.8749 18.0587 11.1332 18.0587 12.5749 16.667C14.7999 14.5253 17.2666 11.142 16.3832 7.21699C15.5499 3.58366 12.4249 2.29199 9.9999 2.29199Z"
                                            fill="#EB1F30" />
                                    </svg>
                                </span>
                                <span class="txt txt-14 txt-14_tb txt-14_mb"><?php echo esc_html($contact_hq_address); ?></span>
                            </div>
                            <div class="contact-info-row">
                                <span class="contact-info-icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.541 18.9583C13.5993 18.9583 12.6077 18.7333 11.5827 18.3C10.5827 17.875 9.57435 17.2916 8.59102 16.5833C7.61602 15.8666 6.67435 15.0666 5.78268 14.1916C4.89935 13.3 4.09935 12.3583 3.39102 11.3916C2.67435 10.3916 2.09935 9.39163 1.69102 8.42496C1.25768 7.39163 1.04102 6.39163 1.04102 5.44996C1.04102 4.79996 1.15768 4.18329 1.38268 3.60829C1.61602 3.01663 1.99102 2.46663 2.49935 1.99163C3.14102 1.35829 3.87435 1.04163 4.65768 1.04163C4.98268 1.04163 5.31602 1.11663 5.59935 1.24996C5.92435 1.39996 6.19935 1.62496 6.39935 1.92496L8.33268 4.64996C8.50768 4.89163 8.64102 5.12496 8.73268 5.35829C8.84102 5.60829 8.89935 5.85829 8.89935 6.09996C8.89935 6.41663 8.80768 6.72496 8.63268 7.01663C8.50768 7.24163 8.31602 7.48329 8.07435 7.72496L7.50768 8.31663C7.51602 8.34163 7.52435 8.35829 7.53268 8.37496C7.63268 8.54996 7.83268 8.84996 8.21602 9.29996C8.62435 9.76663 9.00768 10.1916 9.39102 10.5833C9.88268 11.0666 10.291 11.45 10.6743 11.7666C11.1494 12.1666 11.4577 12.3666 11.641 12.4583L11.6243 12.5L12.2327 11.9C12.491 11.6416 12.741 11.45 12.9827 11.325C13.441 11.0416 14.0244 10.9916 14.6077 11.2333C14.8244 11.325 15.0577 11.45 15.3077 11.625L18.0744 13.5916C18.3827 13.8 18.6077 14.0666 18.741 14.3833C18.866 14.7 18.9243 14.9916 18.9243 15.2833C18.9243 15.6833 18.8327 16.0833 18.6577 16.4583C18.4827 16.8333 18.266 17.1583 17.991 17.4583C17.516 17.9833 16.9993 18.3583 16.3994 18.6C15.8244 18.8333 15.1994 18.9583 14.541 18.9583ZM4.65768 2.29163C4.19935 2.29163 3.77435 2.49163 3.36602 2.89163C2.98268 3.24996 2.71602 3.64163 2.54935 4.06663C2.37435 4.49996 2.29102 4.95829 2.29102 5.44996C2.29102 6.22496 2.47435 7.06663 2.84102 7.93329C3.21602 8.81663 3.74102 9.73329 4.40768 10.65C5.07435 11.5666 5.83268 12.4583 6.66602 13.3C7.49935 14.125 8.39935 14.8916 9.32435 15.5666C10.2243 16.225 11.1493 16.7583 12.066 17.1416C13.491 17.75 14.8244 17.8916 15.9243 17.4333C16.3493 17.2583 16.7243 16.9916 17.066 16.6083C17.2577 16.4 17.4077 16.175 17.5327 15.9083C17.6327 15.7 17.6827 15.4833 17.6827 15.2666C17.6827 15.1333 17.6577 15 17.591 14.85C17.566 14.8 17.516 14.7083 17.3577 14.6L14.591 12.6333C14.4243 12.5166 14.2743 12.4333 14.1327 12.375C13.9493 12.3 13.8743 12.225 13.591 12.4C13.4243 12.4833 13.2743 12.6083 13.1077 12.775L12.4743 13.4C12.1494 13.7166 11.6494 13.7916 11.266 13.65L11.041 13.55C10.6993 13.3666 10.2993 13.0833 9.85768 12.7083C9.45768 12.3666 9.02435 11.9666 8.49935 11.45C8.09102 11.0333 7.68268 10.5916 7.25768 10.1C6.86602 9.64163 6.58268 9.24996 6.40768 8.92496L6.30768 8.67496C6.25768 8.48329 6.24102 8.37496 6.24102 8.25829C6.24102 7.95829 6.34935 7.69163 6.55768 7.48329L7.18268 6.83329C7.34935 6.66663 7.47435 6.50829 7.55768 6.36663C7.62435 6.25829 7.64935 6.16663 7.64935 6.08329C7.64935 6.01663 7.62435 5.91663 7.58268 5.81663C7.52435 5.68329 7.43268 5.53329 7.31602 5.37496L5.38268 2.64163C5.29935 2.52496 5.19935 2.44163 5.07435 2.38329C4.94102 2.32496 4.79935 2.29163 4.65768 2.29163ZM11.6243 12.5083L11.491 13.075L11.716 12.4916C11.6743 12.4833 11.641 12.4916 11.6243 12.5083Z"
                                            fill="#EB1F30" />
                                    </svg>
                                </span>
                                <span class="txt txt-14 txt-14_tb txt-14_mb"><?php echo esc_html($contact_hq_phone); ?></span>
                            </div>
                        </div>

                        <!-- Ho Chi Minh Office -->
                        <div class="contact-info-group">
                            <h3 class="txt txt-15 txt-semi contact-info-group-title title1"><?php echo esc_html($contact_hcm_title); ?></h3>
                            <div class="contact-info-row">
                                <span class="contact-info-icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.9999 11.8079C8.2249 11.8079 6.7749 10.3662 6.7749 8.58288C6.7749 6.79954 8.2249 5.36621 9.9999 5.36621C11.7749 5.36621 13.2249 6.80788 13.2249 8.59121C13.2249 10.3745 11.7749 11.8079 9.9999 11.8079ZM9.9999 6.61621C8.91657 6.61621 8.0249 7.49954 8.0249 8.59121C8.0249 9.68288 8.90824 10.5662 9.9999 10.5662C11.0916 10.5662 11.9749 9.68288 11.9749 8.59121C11.9749 7.49954 11.0832 6.61621 9.9999 6.61621Z"
                                            fill="#EB1F30" />
                                        <path
                                            d="M9.9999 18.967C8.76657 18.967 7.5249 18.5003 6.55824 17.5753C4.0999 15.2087 1.38324 11.4337 2.40824 6.94199C3.33324 2.86699 6.89157 1.04199 9.9999 1.04199C9.9999 1.04199 9.9999 1.04199 10.0082 1.04199C13.1166 1.04199 16.6749 2.86699 17.5999 6.95033C18.6166 11.442 15.8999 15.2087 13.4416 17.5753C12.4749 18.5003 11.2332 18.967 9.9999 18.967ZM9.9999 2.29199C7.5749 2.29199 4.45824 3.58366 3.63324 7.21699C2.73324 11.142 5.1999 14.5253 7.43324 16.667C8.8749 18.0587 11.1332 18.0587 12.5749 16.667C14.7999 14.5253 17.2666 11.142 16.3832 7.21699C15.5499 3.58366 12.4249 2.29199 9.9999 2.29199Z"
                                            fill="#EB1F30" />
                                    </svg>
                                </span>
                                <span class="txt txt-14 txt-14_tb txt-14_mb"><?php echo esc_html($contact_hcm_address); ?></span>
                            </div>
                            <div class="contact-info-row">
                                <span class="contact-info-icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.1667 17.7087H5.83341C2.79175 17.7087 1.04175 15.9587 1.04175 12.917V7.08366C1.04175 4.04199 2.79175 2.29199 5.83341 2.29199H14.1667C17.2084 2.29199 18.9584 4.04199 18.9584 7.08366V12.917C18.9584 15.9587 17.2084 17.7087 14.1667 17.7087ZM5.83341 3.54199C3.45008 3.54199 2.29175 4.70033 2.29175 7.08366V12.917C2.29175 15.3003 3.45008 16.4587 5.83341 16.4587H14.1667C16.5501 16.4587 17.7084 15.3003 17.7084 12.917V7.08366C17.7084 4.70033 16.5501 3.54199 14.1667 3.54199H5.83341Z"
                                            fill="#EB1F30" />
                                        <path
                                            d="M9.99973 10.725C9.29973 10.725 8.5914 10.5083 8.04974 10.0666L5.4414 7.98331C5.17473 7.76664 5.12474 7.37497 5.3414 7.10831C5.55807 6.84164 5.94974 6.79164 6.21641 7.00831L8.82473 9.09164C9.45806 9.59998 10.5331 9.59998 11.1664 9.09164L13.7747 7.00831C14.0414 6.79164 14.4414 6.83331 14.6497 7.10831C14.8664 7.37497 14.8247 7.77498 14.5497 7.98331L11.9414 10.0666C11.4081 10.5083 10.6997 10.725 9.99973 10.725Z"
                                            fill="#EB1F30" />
                                    </svg>
                                </span>
                                <a href="mailto:<?php echo esc_attr($contact_hcm_email); ?>"
                                    class="contact-mail txt txt-14 txt-14_tb txt-14_mb"><?php echo esc_html($contact_hcm_email); ?></a>
                            </div>
                            <div class="contact-info-row">
                                <span class="contact-info-icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.541 18.9583C13.5993 18.9583 12.6077 18.7333 11.5827 18.3C10.5827 17.875 9.57435 17.2916 8.59102 16.5833C7.61602 15.8666 6.67435 15.0666 5.78268 14.1916C4.89935 13.3 4.09935 12.3583 3.39102 11.3916C2.67435 10.3916 2.09935 9.39163 1.69102 8.42496C1.25768 7.39163 1.04102 6.39163 1.04102 5.44996C1.04102 4.79996 1.15768 4.18329 1.38268 3.60829C1.61602 3.01663 1.99102 2.46663 2.49935 1.99163C3.14102 1.35829 3.87435 1.04163 4.65768 1.04163C4.98268 1.04163 5.31602 1.11663 5.59935 1.24996C5.92435 1.39996 6.19935 1.62496 6.39935 1.92496L8.33268 4.64996C8.50768 4.89163 8.64102 5.12496 8.73268 5.35829C8.84102 5.60829 8.89935 5.85829 8.89935 6.09996C8.89935 6.41663 8.80768 6.72496 8.63268 7.01663C8.50768 7.24163 8.31602 7.48329 8.07435 7.72496L7.50768 8.31663C7.51602 8.34163 7.52435 8.35829 7.53268 8.37496C7.63268 8.54996 7.83268 8.84996 8.21602 9.29996C8.62435 9.76663 9.00768 10.1916 9.39102 10.5833C9.88268 11.0666 10.291 11.45 10.6743 11.7666C11.1494 12.1666 11.4577 12.3666 11.641 12.4583L11.6243 12.5L12.2327 11.9C12.491 11.6416 12.741 11.45 12.9827 11.325C13.441 11.0416 14.0244 10.9916 14.6077 11.2333C14.8244 11.325 15.0577 11.45 15.3077 11.625L18.0744 13.5916C18.3827 13.8 18.6077 14.0666 18.741 14.3833C18.866 14.7 18.9243 14.9916 18.9243 15.2833C18.9243 15.6833 18.8327 16.0833 18.6577 16.4583C18.4827 16.8333 18.266 17.1583 17.991 17.4583C17.516 17.9833 16.9993 18.3583 16.3994 18.6C15.8244 18.8333 15.1994 18.9583 14.541 18.9583ZM4.65768 2.29163C4.19935 2.29163 3.77435 2.49163 3.36602 2.89163C2.98268 3.24996 2.71602 3.64163 2.54935 4.06663C2.37435 4.49996 2.29102 4.95829 2.29102 5.44996C2.29102 6.22496 2.47435 7.06663 2.84102 7.93329C3.21602 8.81663 3.74102 9.73329 4.40768 10.65C5.07435 11.5666 5.83268 12.4583 6.66602 13.3C7.49935 14.125 8.39935 14.8916 9.32435 15.5666C10.2243 16.225 11.1493 16.7583 12.066 17.1416C13.491 17.75 14.8244 17.8916 15.9243 17.4333C16.3493 17.2583 16.7243 16.9916 17.066 16.6083C17.2577 16.4 17.4077 16.175 17.5327 15.9083C17.6327 15.7 17.6827 15.4833 17.6827 15.2666C17.6827 15.1333 17.6577 15 17.591 14.85C17.566 14.8 17.516 14.7083 17.3577 14.6L14.591 12.6333C14.4243 12.5166 14.2743 12.4333 14.1327 12.375C13.9493 12.3 13.8743 12.225 13.591 12.4C13.4243 12.4833 13.2743 12.6083 13.1077 12.775L12.4743 13.4C12.1494 13.7166 11.6494 13.7916 11.266 13.65L11.041 13.55C10.6993 13.3666 10.2993 13.0833 9.85768 12.7083C9.45768 12.3666 9.02435 11.9666 8.49935 11.45C8.09102 11.0333 7.68268 10.5916 7.25768 10.1C6.86602 9.64163 6.58268 9.24996 6.40768 8.92496L6.30768 8.67496C6.25768 8.48329 6.24102 8.37496 6.24102 8.25829C6.24102 7.95829 6.34935 7.69163 6.55768 7.48329L7.18268 6.83329C7.34935 6.66663 7.47435 6.50829 7.55768 6.36663C7.62435 6.25829 7.64935 6.16663 7.64935 6.08329C7.64935 6.01663 7.62435 5.91663 7.58268 5.81663C7.52435 5.68329 7.43268 5.53329 7.31602 5.37496L5.38268 2.64163C5.29935 2.52496 5.19935 2.44163 5.07435 2.38329C4.94102 2.32496 4.79935 2.29163 4.65768 2.29163ZM11.6243 12.5083L11.491 13.075L11.716 12.4916C11.6743 12.4833 11.641 12.4916 11.6243 12.5083Z"
                                            fill="#EB1F30" />
                                    </svg>
                                </span>
                                <span class="txt txt-14 txt-14_tb txt-14_mb"><?php echo esc_html($contact_hcm_phone); ?></span>
                            </div>
                        </div>

                        <!-- Social Network -->
                        <div>
                            <h3 class="txt txt-15 txt-semi contact-social-title"><?php echo esc_html($contact_social_title); ?></h3>
                            <div class="footer-socials">
                                <?php if ($contact_facebook_url): ?>
                                    <a href="<?php echo esc_url($contact_facebook_url); ?>" class="footer-social-btn cut-diagonal" aria-label="Facebook">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                        </svg>
                                    </a>
                                <?php endif; ?>
                                <?php if ($contact_instagram_url): ?>
                                    <a href="<?php echo esc_url($contact_instagram_url); ?>" class="footer-social-btn cut-diagonal" aria-label="Instagram">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                                        </svg>
                                    </a>
                                <?php endif; ?>
                                <?php if ($contact_x_url): ?>
                                    <a href="<?php echo esc_url($contact_x_url); ?>" class="footer-social-btn cut-diagonal" aria-label="X">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                        </svg>
                                    </a>
                                <?php endif; ?>
                                <?php if ($contact_youtube_url): ?>
                                    <a href="<?php echo esc_url($contact_youtube_url); ?>" class="footer-social-btn cut-diagonal" aria-label="YouTube">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z" />
                                            <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="#FFFFFF" />
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Contact Form -->
                <div class="contact-form-wrap">
                    <div class="contact-form-overlay"></div>
                    <form action="#" class="contact-form" id="contactForm">
                        <div class="form-group">
                            <label class="txt txt-14 txt-semi form-label">Full name <span class="req">*</span></label>
                            <input type="text" class="form-control txt-14" placeholder="Enter your name" required>
                        </div>
                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="txt txt-14 txt-semi form-label">Email <span class="req">*</span></label>
                                <input type="email" class="form-control" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <label class="txt txt-14 txt-semi form-label">Phone Number <span
                                        class="req">*</span></label>
                                <input type="tel" class="form-control" placeholder="Enter your phone number" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="txt txt-14 txt-semi form-label">Company</label>
                            <input type="text" class="form-control" placeholder="Enter your company name">
                        </div>
                        <div class="form-group">
                            <label class="txt txt-14 txt-semi form-label">Message</label>
                            <textarea class="form-control" placeholder="Enter message"></textarea>
                        </div>
                        <p class="txt txt-13 form-privacy"><?php echo esc_html($contact_form_privacy); ?></p>
                        <!-- Submit -->
                        <div class="form-submit-wrap">
                            <button type="submit" class="btn btn-primary">
                                <span class="txt txt-14 txt-semi"><?php echo esc_html($contact_form_submit_btn); ?></span>
                            </button>
                            <p class="txt txt-13 form-submit-note"><?php echo esc_html($contact_form_submit_note); ?></p>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- 3. Google Map -->
        <section class="contact-map-section">
            <iframe
                src="<?php echo esc_url($contact_map_iframe_src); ?>"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                title="Double T Ho Chi Minh Office location on Google Maps"></iframe>
        </section>
    </main>

<?php get_footer(); ?>