<?php
/**
 * Template Name: Product Service
 */
get_header();

// 1. Hero Section Fields
$ps_hero_bg_id = tr_posts_field('ps_hero_bg');
$ps_hero_bg_url = $ps_hero_bg_id ? wp_get_attachment_image_url($ps_hero_bg_id, 'full') : get_template_directory_uri() . '/imgs/product-banner.jpg';
$ps_hero_breadcrumb = tr_posts_field('ps_hero_breadcrumb') ?: 'Product Service';
$ps_hero_title = tr_posts_field('ps_hero_title') ?: 'BUILT FOR INDUSTRY';

// 2. Products Section Fields
$ps_products_label = tr_posts_field('ps_products_label') ?: 'PRODUCT DOUBLE T';
$ps_products_title = tr_posts_field('ps_products_title') ?: 'Professional steel supplier<br>and processor.';
$ps_products_btn_text = tr_posts_field('ps_products_btn_text') ?: 'VIEW MORE';
$ps_products_btn_link = tr_posts_field('ps_products_btn_link') ?: '#serviceCatalog';

// Lấy danh sách sản phẩm từ Post Type 'product-and-service' (ACF CPT)
$ps_posts = get_posts([
    'post_type'      => ['product-and-service', 'productandservice'],
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC'
]);

$ps_products_items = [];

if (!empty($ps_posts)) {
    foreach ($ps_posts as $prod_post) {
        $p_id = $prod_post->ID;

        // Ảnh lấy theo psd_hero_img (TypeRocket field)
        $p_img_id = tr_posts_field('psd_hero_img', $p_id);
        $p_img_url = '';
        if (!empty($p_img_id)) {
            $p_img_url = wp_get_attachment_image_url($p_img_id, 'full');
        }
        // Fallback sang Featured Image nếu psd_hero_img chưa chọn
        if (empty($p_img_url)) {
            $p_img_url = get_the_post_thumbnail_url($p_id, 'full');
        }
        // Fallback ACF field nếu có
        if (empty($p_img_url) && function_exists('get_field')) {
            $acf_img = get_field('psd_hero_img', $p_id) ?: get_field('image', $p_id);
            if (!empty($acf_img)) {
                $p_img_url = is_array($acf_img) ? $acf_img['url'] : (is_numeric($acf_img) ? wp_get_attachment_image_url($acf_img, 'full') : $acf_img);
            }
        }
        // Fallback ảnh mặc định
        if (empty($p_img_url)) {
            $p_img_url = get_template_directory_uri() . '/imgs/hero-img.jpg';
        }

        $ps_products_items[] = [
            'title'       => get_the_title($p_id),
            'link'        => get_permalink($p_id),
            'image'       => $p_img_id,
            'image_url'   => $p_img_url,
            'alt'         => get_the_title($p_id),
            'default_img' => get_template_directory_uri() . '/imgs/hero-img.jpg'
        ];
    }
}

// Nếu chưa có bài đăng trong Post Type, fallback về TypeRocket repeater hoặc 6 sản phẩm mặc định
if (empty($ps_products_items)) {
    $tr_products = tr_posts_field('ps_products_items');
    if (is_array($tr_products) && !empty($tr_products)) {
        $ps_products_items = $tr_products;
    } else {
        $ps_products_items = [
            [
                'title' => 'Hot Rolled-HR / Hot Rolled Pickled and Oiled-HRPO',
                'link' => '#',
                'image' => '',
                'default_img' => get_template_directory_uri() . '/imgs/hero-img.jpg',
                'alt' => 'Hot rolled steel processing'
            ],
            [
                'title' => 'Cold-Rolled',
                'link' => '#service-cut-to-length',
                'image' => '',
                'default_img' => get_template_directory_uri() . '/imgs/cta.jpg',
                'alt' => 'Cold-rolled steel processing'
            ],
            [
                'title' => 'Hot-Dip Galvanized',
                'link' => '#service-amada',
                'image' => '',
                'default_img' => get_template_directory_uri() . '/imgs/service-item1.jpg',
                'alt' => 'Hot-dip galvanized steel'
            ],
            [
                'title' => 'Electrical Steel-Es',
                'link' => '#service-flat-bar',
                'image' => '',
                'default_img' => get_template_directory_uri() . '/imgs/service-item1.jpg',
                'alt' => 'Electrical steel processing'
            ],
            [
                'title' => 'Electrical Galvanized Steel-Eg',
                'link' => '#service-support',
                'image' => '',
                'default_img' => get_template_directory_uri() . '/imgs/cta.jpg',
                'alt' => 'Electrical galvanized steel processing'
            ],
            [
                'title' => 'Stainless Steel-Inox',
                'link' => '#service-slitting',
                'image' => '',
                'default_img' => get_template_directory_uri() . '/imgs/hero-img.jpg',
                'alt' => 'Stainless steel processing'
            ]
        ];
    }
}

// 3. Services Overview Fields
$ps_services_label = tr_posts_field('ps_services_label') ?: 'SERVICES';
$ps_services_title = tr_posts_field('ps_services_title') ?: 'Manufacturing<br> Capabilities of <br><span>2T Metal Co., Ltd.</span>';
$ps_services_desc = tr_posts_field('ps_services_desc') ?: 'The facility features a comprehensive, well-planned investment in machinery and state-of-the-art production lines imported directly from Japan and Taiwan, located at the Hai Son Industrial Cluster in Duc Hoa District, Long An Province.';
$ps_services_emphasis = tr_posts_field('ps_services_emphasis') ?: "Below is a detailed overview of Double T's professional manufacturing capabilities:";
$ps_services_img_id = tr_posts_field('ps_services_img');
$ps_services_img_url = $ps_services_img_id ? wp_get_attachment_image_url($ps_services_img_id, 'full') : get_template_directory_uri() . '/imgs/home-service.webp';

// 4. Service Catalog Fields
$ps_service_catalog_items = tr_posts_field('ps_service_catalog_items');
if (!is_array($ps_service_catalog_items) || empty($ps_service_catalog_items)) {
    $ps_service_catalog_items = [
        [
            'tab_title' => 'SLITTING LINE',
            'slug' => 'service-slitting',
            'title' => 'Slitting Line',
            'image' => '',
            'default_img' => get_template_directory_uri() . '/imgs/service-item1.jpg',
            'content' => '<p><span class="txt-semi">Chủng loại thép gia công:</span> Đa dạng các loại thép cán nóng (HR), thép tẩy gỉ (PO), thép cán nguội (CR), thép mạ kẽm (GI), mạ hợp kim nhôm kẽm (GL), mạ màu (PPGL), mạ điện (EG), Silic (ES), và thép không gỉ (SUS).</p>
<div>
    <span class="txt-semi">Thông số kỹ thuật:</span>
    <ul>
        <li>Độ dày: Từ <span class="txt-semi">0.25 đến 4.00 mm.</span></li>
        <li>Khổ rộng băng con tối thiểu: <span class="txt-semi">20 mm.</span></li>
        <li>Khổ rộng cuộn mẹ tối đa: <span class="txt-semi">1,650 mm.</span></li>
        <li>Trọng lượng cuộn mẹ tối đa: Lên đến <span class="txt-semi">25,000 kg.</span></li>
    </ul>
</div>
<p><span class="txt-semi">Điểm nhấn công nghệ:</span> Dây chuyền được tích hợp bộ phận đặc biệt (RB21), có khả năng chống trầy xước tuyệt đối khi cắt xẻ các bề mặt nhạy cảm như thép mạ kẽm, mạ điện và thép mạ màu.</p>',
            'btn_text' => 'SERVICE CONSULTATION',
            'btn_link' => '#consultationModal'
        ],
        [
            'tab_title' => 'CUT-TO-LENGTH LINE',
            'slug' => 'service-cut-to-length',
            'title' => 'Cut-to-Length Line',
            'image' => '',
            'default_img' => get_template_directory_uri() . '/imgs/cta.jpg',
            'content' => '<div>
    <span class="txt-semi">Cut-to-Length Line 1:</span>
    <ul>
        <li>Chủng loại: PO, CR, GI, EG, GA, GL, EGS, ES, PPGL, SUS.</li>
        <li>Độ dày: <span class="txt-semi">0.3 – 3.2 mm.</span></li>
        <li>Chiều rộng tấm: <span class="txt-semi">100 – 1,300 mm;</span> Chiều dài: <span class="txt-semi">500 – 3,100 mm.</span></li>
        <li>Trọng lượng cuộn tối đa: <span class="txt-semi">20,000 kg.</span></li>
    </ul>
</div>
<div>
    <span class="txt-semi">Cut-to-Length Line 2:</span>
    <ul>
        <li>Chủng loại: HR, PO, CR, GI, SUS.</li>
        <li>Độ dày: <span class="txt-semi">1.0 – 6.5 mm.</span></li>
        <li>Chiều rộng tấm: <span class="txt-semi">400 – 1,600 mm;</span> Chiều dài: <span class="txt-semi">800 – 6,500 mm.</span></li>
        <li>Trọng lượng cuộn tối đa: <span class="txt-semi">25,000 kg.</span></li>
    </ul>
</div>
<p><span class="txt-semi">Mini Leveler Line:</span> Độ dày 0.3 – 2.3 mm, chiều rộng 50 – 600 mm, chiều dài 250 – 2,800 mm.</p>',
            'btn_text' => 'SERVICE CONSULTATION',
            'btn_link' => '#consultationModal'
        ],
        [
            'tab_title' => 'AMADA CUTTING MACHINE &amp; RESHEAR LINE',
            'slug' => 'service-amada',
            'title' => 'Amada cutting machine<br>&amp; Reshear Line',
            'image' => '',
            'default_img' => get_template_directory_uri() . '/imgs/hero-img.jpg',
            'content' => '<div>
    <span class="txt-semi">Máy cắt Amada:</span>
    <ul>
        <li>Chủng loại: HR, PO, CR, GI, EG, GA, GL, EGS, ES, PPGL, SUS.</li>
        <li>Độ dày: <span class="txt-semi">0.5 – 6.0 mm;</span> Chiều rộng: <span class="txt-semi">10 – 1,000 mm;</span> Chiều dài: <span class="txt-semi">50 – 3,000 mm.</span></li>
    </ul>
</div>
<p><span class="txt-semi">Reshear Line:</span> Cung cấp các khổ kích thước linh hoạt, đáp ứng chính xác bản vẽ kỹ thuật khắt khe của từng khách hàng.</p>',
            'btn_text' => 'SERVICE CONSULTATION',
            'btn_link' => '#consultationModal'
        ],
        [
            'tab_title' => 'FLAT BAR &amp; ROUND BAR COIL',
            'slug' => 'service-flat-bar',
            'title' => 'Flat Bar &amp; Round Bar Coil',
            'image' => '',
            'default_img' => get_template_directory_uri() . '/imgs/application.jpg',
            'content' => '<p><span class="txt-semi">Gia công thép thanh:</span> Cắt, xẻ và định hình thép dẹt, thép cuộn tròn theo kích thước kỹ thuật của từng dự án.</p>
<ul>
    <li>Nguồn vật liệu đa dạng, truy xuất rõ ràng.</li>
    <li>Kiểm soát dung sai và chất lượng bề mặt trong toàn bộ quy trình.</li>
    <li>Đóng gói theo tiêu chuẩn vận chuyển trong nước và xuất khẩu.</li>
</ul>',
            'btn_text' => 'SERVICE CONSULTATION',
            'btn_link' => '#consultationModal'
        ],
        [
            'tab_title' => 'SUPPORT SERVICES',
            'slug' => 'service-support',
            'title' => 'Support Services',
            'image' => '',
            'default_img' => get_template_directory_uri() . '/imgs/video-thumb.jpg',
            'content' => '<p><span class="txt-semi">Dịch vụ đồng hành:</span> Double T hỗ trợ khách hàng từ lựa chọn vật liệu, tối ưu quy cách đến kế hoạch giao nhận.</p>
<ul>
    <li>Tư vấn kỹ thuật và giải pháp vật liệu.</li>
    <li>Quản lý tồn kho và tiến độ đơn hàng.</li>
    <li>Đóng gói, vận chuyển và hỗ trợ sau bán hàng.</li>
</ul>',
            'btn_text' => 'SERVICE CONSULTATION',
            'btn_link' => '#consultationModal'
        ]
    ];
}

?>

    <main class="main">
        <!-- 1. Hero Section -->
        <section class="ps-hero" aria-labelledby="psHeroTitle">
            <div class="ps-hero-bg">
                <img src="<?php echo esc_url($ps_hero_bg_url); ?>" class="img-fill" alt="Double T steel processing factory">
            </div>
            <div class="container ps-hero-inner">
                <div class="ps-hero-panel">
                    <div class="ps-hero-panel-bg cut-tr"></div>
                    <nav class="ps-breadcrumb txt txt-14 txt-14_tb txt-14_mb" aria-label="Breadcrumb">
                        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                        <span class="commit-hero-pagi-devi" aria-hidden="true">/</span>
                        <span class="current"><?php echo esc_html($ps_hero_breadcrumb); ?></span>
                    </nav>
                    <h1 class="heading h1 h3_mb ps-hero-title" id="psHeroTitle">
                        <?php echo esc_html($ps_hero_title); ?>
                    </h1>
                </div>
            </div>
        </section>

        <!-- 2. Products Section -->
        <section class="ps-products" id="productRange" aria-labelledby="psProductsTitle">
            <div class="container">
                <div class="ps-section-head">
                    <div class="label red-light cut-diagonal cut-sm ps-section-label">
                        <div class="txt txt-13 txt-semi"><?php echo esc_html($ps_products_label); ?></div>
                    </div>
                    <h2 class="heading h2 h3_tb h3_mb ps-products-title" id="psProductsTitle">
                        <?php echo wp_kses_post($ps_products_title); ?>
                    </h2>
                </div>

                <div class="ps-products-grid">
                    <?php foreach ($ps_products_items as $prod): 
                        $p_title = !empty($prod['title']) ? $prod['title'] : '';
                        $p_link = !empty($prod['link']) ? $prod['link'] : '#';
                        $p_alt = !empty($prod['alt']) ? $prod['alt'] : $p_title;
                        
                        $p_img_url = !empty($prod['image_url']) ? $prod['image_url'] : '';
                        if (!$p_img_url && !empty($prod['image'])) {
                            $p_img_url = wp_get_attachment_image_url($prod['image'], 'full');
                        }
                        if (!$p_img_url && !empty($prod['default_img'])) {
                            $p_img_url = $prod['default_img'];
                        }
                        if (!$p_img_url) {
                            $p_img_url = get_template_directory_uri() . '/imgs/hero-img.jpg';
                        }
                    ?>
                        <a href="<?php echo esc_url($p_link); ?>" class="ps-product-card hover-img">
                            <div class="ps-product-card-img cut-tl">
                                <div class="ps-product-card-img-block"></div>
                                <img src="<?php echo esc_url($p_img_url); ?>" class="img-abs img-fill" alt="<?php echo esc_attr($p_alt); ?>">
                            </div>
                            <div class="ps-product-card-content">
                                <div class="ps-product-card-title">
                                    <div class="heading h5 h6_tb"><?php echo esc_html($p_title); ?></div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="ps-products-action">
                    <a href="<?php echo esc_url($ps_products_btn_link); ?>" class="btn btn-primary ps-products-more">
                        <span class="txt txt-13 txt-semi txt-14_mb"><?php echo esc_html($ps_products_btn_text); ?></span>
                    </a>
                </div>
            </div>
        </section>

        <!-- 3. Services Overview Section -->
        <section class="ps-services-overview" id="manufacturingCapabilities" aria-labelledby="psServicesTitle">
            <div class="container grid ps-services-overview-inner">
                <div class="ps-services-overview-content">
                    <div class="label red-light cut-diagonal cut-sm ps-services-label">
                        <div class="txt txt-13 txt-semi"><?php echo esc_html($ps_services_label); ?></div>
                    </div>
                    <h2 class="heading h2 h3_tb h3_mb ps-services-title" id="psServicesTitle">
                        <?php echo wp_kses_post($ps_services_title); ?>
                    </h2>
                    <p class="txt txt-16 txt-14_tb txt-14_mb ps-services-desc">
                        <?php echo wp_kses_post(nl2br($ps_services_desc)); ?>
                    </p>
                    <p class="txt txt-16 txt-14_tb txt-14_mb txt-semi ps-services-emphasis">
                        <?php echo esc_html($ps_services_emphasis); ?>
                    </p>
                </div>

                <figure class="ps-services-overview-media">
                    <img src="<?php echo esc_url($ps_services_img_url); ?>" class="img-basic" alt="Double T manufacturing capabilities">
                </figure>
            </div>
        </section>

        <!-- 4. Service Catalog Section -->
        <section class="ps-service-catalog" id="serviceCatalog" aria-label="Manufacturing service details">
            <div class="container">
                <nav class="ps-service-tabs" aria-label="Service categories">
                    <?php 
                    $tab_count = 0;
                    foreach ($ps_service_catalog_items as $c_item): 
                        $tab_count++;
                        $is_active = ($tab_count === 1);
                        $t_title = !empty($c_item['tab_title']) ? $c_item['tab_title'] : (!empty($c_item['title']) ? $c_item['title'] : '');
                        $t_slug = !empty($c_item['slug']) ? $c_item['slug'] : 'service-' . $tab_count;
                    ?>
                        <a href="#<?php echo esc_attr($t_slug); ?>" 
                           class="txt txt-13 txt-semi ps-service-tab <?php echo $is_active ? 'active' : ''; ?>"
                           data-service-tab="<?php echo esc_attr($t_slug); ?>"><?php echo wp_kses_post($t_title); ?></a>
                    <?php endforeach; ?>
                </nav>

                <div class="ps-service-list">
                    <?php 
                    $row_count = 0;
                    foreach ($ps_service_catalog_items as $c_item): 
                        $row_count++;
                        $s_slug = !empty($c_item['slug']) ? $c_item['slug'] : 'service-' . $row_count;
                        $s_title = !empty($c_item['title']) ? $c_item['title'] : '';
                        $s_content = !empty($c_item['content']) ? $c_item['content'] : '';
                        $s_btn_text = !empty($c_item['btn_text']) ? $c_item['btn_text'] : 'SERVICE CONSULTATION';
                        $s_btn_link = !empty($c_item['btn_link']) ? $c_item['btn_link'] : '#consultationModal';
                        
                        $s_img_url = '';
                        if (!empty($c_item['image'])) {
                            $s_img_url = wp_get_attachment_image_url($c_item['image'], 'full');
                        }
                        if (!$s_img_url && !empty($c_item['default_img'])) {
                            $s_img_url = $c_item['default_img'];
                        }
                        if (!$s_img_url) {
                            $s_img_url = get_template_directory_uri() . '/imgs/service-item1.jpg';
                        }
                    ?>
                        <article class="ps-service-row" id="<?php echo esc_attr($s_slug); ?>" data-service-section>
                            <div class="ps-service-content cut-tl cut-xl">
                                <h3 class="heading h3 h4_tb h4_mb ps-service-title"><?php echo wp_kses_post($s_title); ?></h3>
                                <div class="txt txt-16 txt-14_tb txt-14_mb ps-service-copy">
                                    <?php echo wp_kses_post($s_content); ?>
                                </div>
                                <a href="<?php echo esc_url($s_btn_link); ?>" 
                                   class="btn btn-primary ps-service-btn"
                                   <?php echo ($s_btn_link === '#consultationModal' || $s_btn_link === '#' || empty($s_btn_link)) ? 'data-modal-target="consultationModal"' : ''; ?>>
                                    <span class="txt txt-13 txt-semi"><?php echo esc_html($s_btn_text); ?></span>
                                </a>
                            </div>
                            <figure class="ps-service-media cut-br cut-xl">
                                <img src="<?php echo esc_url($s_img_url); ?>" class="img-fill" alt="<?php echo esc_attr(strip_tags($s_title)); ?>">
                            </figure>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- 5. Consultation CTA Banner -->
        <?php render_consultation_cta(); ?>

    </main>

<?php get_footer(); ?>