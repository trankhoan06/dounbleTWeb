<?php
/**
 * Shared Partners settings for the Home and Our Commitment pages.
 */

if (!defined('ABSPATH')) {
    exit;
}

const DOUBLET_PARTNER_OPTIONS = 'tr_partner_options';

// Allow TypeRocket to persist this custom option group.
add_filter('tr_model', function ($model) {
    if ($model instanceof \TypeRocket\Models\WPOption) {
        $model->appendFillableField(DOUBLET_PARTNER_OPTIONS);
    }

    return $model;
}, 9999999999);

// Add a dedicated top-level menu to the WordPress admin sidebar.
add_action('admin_menu', function () {
    add_menu_page(
        'Partners',
        'Partners',
        'manage_options',
        'doublet-partners',
        'doublet_render_partner_options_page',
        'dashicons-groups',
        58
    );
});

/**
 * Return the translated front-page ID when Polylang is available.
 */
function doublet_partner_front_page_id($language = '')
{
    $front_page_id = (int) get_option('page_on_front');

    if ($front_page_id && $language && function_exists('pll_get_post')) {
        $translated_id = pll_get_post($front_page_id, $language);
        if ($translated_id) {
            return (int) $translated_id;
        }
    }

    return $front_page_id;
}

/**
 * Read the former Homepage fields so existing Partner content is preserved.
 */
function doublet_get_legacy_home_partner_data($language = '')
{
    $page_id = doublet_partner_front_page_id($language);
    if (!$page_id) {
        return array();
    }

    return array(
        'partner_label' => get_post_meta($page_id, 'home_partners_label', true),
        'partner_title' => get_post_meta($page_id, 'home_partners_title', true),
        'partner_desc'  => get_post_meta($page_id, 'home_partners_desc', true),
        'partner_logos' => get_post_meta($page_id, 'home_partners_logos', true),
    );
}

/**
 * Seed the shared option group from the existing Homepage settings once.
 */
function doublet_migrate_partner_options()
{
    if (get_option(DOUBLET_PARTNER_OPTIONS, null) !== null) {
        return;
    }

    $english = doublet_get_legacy_home_partner_data('en');
    $vietnamese = doublet_get_legacy_home_partner_data('vi');
    $options = array_filter(array(
        'partner_label'    => $english['partner_label'] ?? '',
        'partner_title'    => $english['partner_title'] ?? '',
        'partner_desc'     => $english['partner_desc'] ?? '',
        'partner_label_vi' => $vietnamese['partner_label'] ?? '',
        'partner_title_vi' => $vietnamese['partner_title'] ?? '',
        'partner_desc_vi'  => $vietnamese['partner_desc'] ?? '',
        'partner_logos'    => $english['partner_logos'] ?? ($vietnamese['partner_logos'] ?? array()),
    ), static function ($value) {
        return $value !== '' && $value !== null && $value !== array();
    });

    if ($options) {
        update_option(DOUBLET_PARTNER_OPTIONS, $options, false);
    }
}

/**
 * Render the shared Partners settings page.
 */
function doublet_render_partner_options_page()
{
    if (!current_user_can('manage_options')) {
        return;
    }

    doublet_migrate_partner_options();
    $form = tr_form()->useJson()->setGroup(DOUBLET_PARTNER_OPTIONS);
    ?>
    <div class="wrap">
        <h1>Partners</h1>
        <p>Dữ liệu dùng chung cho section Partners trên Homepage và Our Commitment.</p>
        <div class="typerocket-container">
            <?php echo $form->open(); ?>
            <?php echo beginBox('Partners Content', false); ?>
            <?php
            echo $form->row(
                $form->text('partner_label')->setLabel('Nhãn phụ (EN)')->setDefault('PARTNERS'),
                $form->text('partner_label_vi')->setLabel('Nhãn phụ (VI)')
            );
            echo $form->row(
                $form->text('partner_title')->setLabel('Tiêu đề (EN)')->setDefault('Partnering to create<br>sustainable value.'),
                $form->text('partner_title_vi')->setLabel('Tiêu đề (VI)')
            );
            echo $form->row(
                $form->textarea('partner_desc')->setLabel('Mô tả (EN)'),
                $form->textarea('partner_desc_vi')->setLabel('Mô tả (VI)')
            );
            echo $form->gallery('partner_logos')->setLabel('Danh sách logo đối tác dùng chung');
            ?>
            <?php echo endBox(); ?>
            <?php echo $form->submit('Save Partners'); ?>
            <?php echo $form->close(); ?>
        </div>
    </div>
    <?php
}

/**
 * Get the shared Partner content for the current frontend language.
 */
function doublet_get_partner_settings()
{
    $language = function_exists('pll_current_language') ? pll_current_language('slug') : 'en';
    $language = strtolower((string) ($language ?: 'en'));
    $suffix = $language === 'vi' ? '_vi' : '';
    $legacy = doublet_get_legacy_home_partner_data($language);

    $label = tr_options_field(DOUBLET_PARTNER_OPTIONS . '.partner_label' . $suffix);
    $title = tr_options_field(DOUBLET_PARTNER_OPTIONS . '.partner_title' . $suffix);
    $desc = tr_options_field(DOUBLET_PARTNER_OPTIONS . '.partner_desc' . $suffix);

    if ($suffix) {
        $label = $label ?: tr_options_field(DOUBLET_PARTNER_OPTIONS . '.partner_label');
        $title = $title ?: tr_options_field(DOUBLET_PARTNER_OPTIONS . '.partner_title');
        $desc = $desc ?: tr_options_field(DOUBLET_PARTNER_OPTIONS . '.partner_desc');
    }

    return array(
        'label' => $label ?: ($legacy['partner_label'] ?? '') ?: 'PARTNERS',
        'title' => $title ?: ($legacy['partner_title'] ?? '') ?: 'Partnering to create<br>sustainable value.',
        'desc'  => $desc ?: ($legacy['partner_desc'] ?? '') ?: 'Partnering with <strong class="txt-primary txt-semi">Double T</strong> is the key to unlocking success, enabling you to confidently embrace new opportunities and challenges in the future of the metal industry.',
        'logos' => tr_options_field(DOUBLET_PARTNER_OPTIONS . '.partner_logos') ?: ($legacy['partner_logos'] ?? array()),
    );
}
