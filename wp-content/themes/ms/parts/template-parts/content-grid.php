<?php if (_cao('is_mobele_list') && wp_is_mobile()) {
    get_template_part('parts/template-parts/content', 'list');
} else {


    $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'large');
    $img = $large_image_url[0];

    print_r($item);

    ?>
    <div class="col-lg-1-5 col-6 col-sm-6 col-md-4 col-lg-3">
        <article id="post-<?php the_ID(); ?>" <?php post_class('post post-grid'); ?>>
            <div class="entry-media">
                <div class="placeholder" style="padding-bottom: 66.666666666667%;">
                    <a target="_blank" href="<?php echo esc_url(get_permalink()) ?>">
                        <div class="cover xlazy xlazy-loaded" alt="icon"
                             style="background-size: cover; background-position: center center; background-image: url(<?php echo $img; ?>);"></div>
                    </a>
                </div>
            </div>

            <div class="entry-wrapper">
                <?php if (!_cao('grid_is_author', true)) { ?>
                    <a<?php echo _target_blank(); ?> class="grid_author_avt"
                                                     href="<?php echo esc_url(get_the_permalink()); ?>">
                        <div class="grid_author_bggo avatar bg-cover"
                             style="background-image: url(<?php echo _get_user_avatar_url('user', get_the_author_meta('ID', get_post()->post_author)) ?>);"></div>
                    </a>
                <?php } ?>
                <?php cao_entry_header(array('category' => true)); ?>

                <?php if (_cao('grid_is_excerpt')) : ?>
                    <div class="entry-excerpt u-text-format"><?php echo _get_excerpt(); ?></div>
                <?php endif; ?>
                <?php get_template_part('parts/entry-footer'); ?>
            </div>
        </article>
    </div>
<?php } ?>