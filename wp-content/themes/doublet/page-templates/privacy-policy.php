<?php
/**
 * Template Name: Privacy Policy
 */
get_header();

$privacy_title = tr_posts_field('privacy_title');
if (empty($privacy_title)) {
    $privacy_title = get_the_title();
}
if (empty($privacy_title) || $privacy_title === 'Auto Draft') {
    $is_vi = function_exists('pll_current_language') && pll_current_language('slug') === 'vi';
    $privacy_title = $is_vi ? 'Chính sách bảo mật' : 'Privacy Policy';
}
?>

<main class="main privacy-page" id="mainContent">
    <div class="container">
        <h1 class="heading privacy-title"><?php echo esc_html($privacy_title); ?></h1>
        <div class="privacy-content txt txt-16 txt-14_mb">
            <?php
            while (have_posts()) : the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
