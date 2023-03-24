<?php
$post_id = $post->ID;
$__f = get_template_directory_uri() . '/assets';
$__v = _the_theme_version();

$gamebg = _cao('game_bg');


$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'large');
$img = $large_image_url[0];

?>
<style>
    .site-content {
        padding: 0 !important;
    }

    .cname {
        margin-bottom: 10px;
    }
</style>
<div class="pczone-new-head-bac">
    <div class="bac-main">
        <div class="head-image"
             style="background-size: cover; background-position: center center; background-image: url(<?php echo $gamebg; ?>);"></div>
    </div>
    <div class="game-base-info game-type-12 false">
        <div class="main">
            <div class="main-left-area null">
                <div class="left icon xlazy xlazy-loaded" alt="icon"
                     style="background-size: cover; background-position: center center; background-image: url(<?php echo $img; ?>);"></div>
                <div class="right">
                    <div class="cname">
                        <span><?php echo get_the_title($post_id) ?></span>
                    </div>
                    <div>
                        <div class="ename">
                            <?php echo get_post_meta($post_id, 'game_ename', true); ?>
                        </div>

                        <div class="plat-tags">

                            <?php
                            $tags = get_the_tags();
                            foreach ($tags as $tag) :

                                $pwd1 = esc_url(get_tag_link($tag->term_id));
                                $pwd2 = 'https://www.msgamego.com/tag/pc';
                                $pwd3 = 'https://www.msgamego.com/tag/switch';

                                $pwd4 = 'https://www.msgamego.com/tag/%e6%89%8b%e6%b8%b8';

                                if ($pwd1 == $pwd2 or $pwd1 == $pwd3 or $pwd1 == $pwd4) {

                                    $colors = 'color:red';

                                } else {

                                    $colors = 'color:#fff';

                                }


                                ?>
                                <div class="type plat">
                                    <a style="<?php echo $colors; ?>"
                                       href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" rel="tag">
                                        <?php echo esc_html($tag->name); ?>
                                </div>
                                </a>

                            <?php endforeach; ?>

                        </div>
                        <div class="desc">
                            <?php echo get_post_meta($post_id, 'game_miaoshu', true); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>