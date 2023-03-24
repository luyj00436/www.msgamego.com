<?php
$mode_hot_game = _cao('mode_hot_game');
$__f = get_template_directory_uri() . '/assets';
$__v = _the_theme_version();
wp_enqueue_script('hot_game', $__f . '/js/hot_game.js', array(), $__v, '');
wp_enqueue_script('hot_game', $__f . '/js/hot_gamesj.js', array(), $__v, '');
$args = array(
    'cat' => $mode_hot_game['category'],
    'ignore_sticky_posts' => true,
    'post_status' => 'publish',
    'posts_per_page' => $mode_hot_game['count']
);

///////////S CACHE ////////////////
if (CaoCache::is()) {
    $_the_cache_key = 'ripro_home_catpost_posts_' . $args['cat'];
    $_the_cache_data = CaoCache::get($_the_cache_key);
    if (false === $_the_cache_data) {
        $_the_cache_data = new WP_Query($args); //缓存数据
        CaoCache::set($_the_cache_key, $_the_cache_data);
    }
    $data = $_the_cache_data;
} else {
    $data = new WP_Query($args); //原始输出
}

$postData = $data->posts;

?>
<link rel='stylesheet' id='hot_game-css'
      href='https://www.msgamego.com/wp-content/themes/ms/assets/css/hot_gamesj.css?ver=1.0.0' type='text/css'
      media=''/>

<script type='text/javascript' src='https://www.msgamego.com/wp-content/themes/ms/assets/js/hot_gamesj.js?ver=1.0.0'
        id='hot_game-js'></script>
<div class="section">
    <div class="container lewan-box">
        <div class="lewan-box-header">
            <div class="lewan-box-title">
                热门游戏
            </div>
        </div>


        <div class="sj_dn">
            <div class="lewan-box-body lewan-box-hot-game">
                <div class="swiper-navigate swiper-prev">
                </div>
                <div class="swiper-navigate swiper-next">
                </div>
                <div class="game-on-shelf">
                    <?php foreach ($postData as $item) {

                        $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'large');
                        $img = $large_image_url[0];
                        //获取标签
                        $tags = get_the_tags($item->ID);
                        $tags = array_slice($tags, -2);
                        ?>

                        <a class="game-card-wrap  x-swiper-item " href="<?php echo get_the_permalink($item->ID) ?>"
                           target="view_window" rel="noreferrer noopener">
                            <div class="game-main">
                                <div class="cover xlazy xlazy-loaded" alt="icon"
                                     style="background-size: cover; background-position: center center; background-image: url(<?php echo $img; ?>);"></div>
                                <div class="info-box">
                                    <div class="info-main">
                                        <div class="game-name">
                                            <?php echo $item->post_title; ?>
                                        </div>
                                        <div class="game-tags">
                                            <?php foreach ($tags as $tag) : ?>
                                                <span class="tag-item">
									<?php echo esc_html($tag->name); ?>
									</span>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="game-desc"><?php echo get_post_meta($item->ID, 'game_desc', true); ?></div>
                                        <div class="go-target"><?php echo $item->post_title ?></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="pc_dn">
            <div class="lewan-box-bodysj lewan-box-hot-gamesj">
                <div class="swiper-navigate swiper-prevsj">
                </div>
                <div class="swiper-navigate swiper-nextsj">
                </div>
                <div class="game-on-shelfsj">
                    <?php foreach ($postData as $item) {

                        $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'large');
                        $img = $large_image_url[0];
                        //获取标签
                        $tags = get_the_tags($item->ID);
                        $tags = array_slice($tags, -2);
                        ?>

                        <a class="game-card-wrap  x-swiper-item " href="<?php echo get_the_permalink($item->ID) ?>"
                           target="view_window" rel="noreferrer noopener">
                            <div class="game-main">
                                <div class="cover xlazy xlazy-loaded" alt="icon"
                                     style="width: 99%;background-size: cover; background-position: center center; background-image: url(<?php echo $img; ?>);"></div>
                                <div class="info-box">
                                    <div class="info-main">
                                        <div class="game-name">
                                            <?php echo $item->post_title; ?>
                                        </div>
                                        <div class="game-tags">
                                            <?php foreach ($tags as $tag) : ?>
                                                <span class="tag-item">
									<?php echo esc_html($tag->name); ?>
									</span>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="game-desc"><?php echo get_post_meta($item->ID, 'game_desc', true); ?></div>
                                        <div class="go-target"><?php echo $item->post_title ?></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
</div>

