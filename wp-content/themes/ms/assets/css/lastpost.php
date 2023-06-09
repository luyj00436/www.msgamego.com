<?php
$sidebar = 'none';

$mo_postlist_no_cat = _cao('home_last_post');
if (!empty($mo_postlist_no_cat['home_postlist_no_cat'])) {
    $args['cat'] = '-' . implode($mo_postlist_no_cat['home_postlist_no_cat'], ',-');
}
$args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 0;
// query_posts($args);
///////////S CACHE ////////////////
if (CaoCache::is()) {
    $_the_cache_key = 'ripro_home_last_posts_' . $args['paged'];
    $_the_cache_data = CaoCache::get($_the_cache_key);
    if (false === $_the_cache_data) {
        $_the_cache_data = new WP_Query($args); //缓存数据
        CaoCache::set($_the_cache_key, $_the_cache_data);
    }
    $psots_data = $_the_cache_data;
} else {
    $psots_data = new WP_Query($args); //原始输出
}
///////////S CACHE ////////////////

/////////////
$is_cao_site_list_blog = is_cao_site_list_blog();
if ($is_cao_site_list_blog) {
    $col_class = 'content-column col-lg-9';
    $latest_layout = 'bloglist';
} else {
    $col_class = 'col-lg-12';
    $latest_layout = _cao('latest_layout', 'grid');
}
/////////////

$more_cat_link = get_category_link($mo_postlist_no_cat['more_cat_id']);

?>
    <div class="section" style="padding-top:0px;">
        <div class="container" style="background:#fff;border-radius:4px;padding-top:10px;">
            <div class="row">
                <!-- 文章 -->
                <div class="<?php echo $col_class; ?>">
                    <div class="content-area">
                        <main class="site-main">
                            <?php if ($psots_data->have_posts()) : ?>
                                <?php if (is_home()) : ?>
                                    <?php if ($mo_postlist_no_cat['is_home_cat_nav']) : ?>
                                        <div class="home-cat-nav-wrap">


                                            <div class="lw-module-header title-containers">
                                                <div class="lw-module-header-title">游戏介绍</div>
                                            </div>
                                            <ul class="cat-nav">
                                                <?php foreach ($mo_postlist_no_cat['nav_cat_id'] as $cat_id) {
                                                    $category = get_category($cat_id);
                                                    echo '<li class="active"><button class="btn btn--white" data-id="' . $cat_id . '" style="font-size:16px;">' . $category->cat_name . '</button></li>';
                                                } ?>
                                            </ul>

                                        </div>
                                    <?php else: ?>
                                        <h3 class="section-title">
                                            <span><?php echo $mo_postlist_no_cat['home_title_s']; ?></span></h3>
                                    <?php endif; ?>
                                    <?php do_action('ripro_echo_ads', 'ad_last_1'); ?>
                                <?php endif; ?>
                                <div class="row posts-wrapper">
                                    <?php while ($psots_data->have_posts()) : $psots_data->the_post();
                                        get_template_part('parts/template-parts/content', $latest_layout);
                                    endwhile; ?>
                                </div>
                                <?php do_action('ripro_echo_ads', 'ad_last_2'); ?>
                                <?php #get_template_part( 'parts/pagination' ); ?>

                                <div class="infinite-scroll-action" style="margin-bottom:20px;">
                                    <div class="infinite-scroll-button button"><a href="<?php echo $more_cat_link ?>">
                                            <span style="color: rgb(255, 255, 255);"><strong>查看更多游戏</strong></span></a>
                                    </div>
                                </div>

                            <?php else : ?>
                                <?php get_template_part('parts/template-parts/content', 'none'); ?>
                            <?php endif; ?>
                        </main>
                    </div>
                </div>


                <!-- 文章 -->
                <div class="<?php echo $col_class; ?>">
                    <div class="content-area">
                        <main class="site-main">
                            <?php if ($psots_data->have_posts()) : ?>
                                <?php if (is_home()) : ?>
                                    <?php if ($mo_postlist_no_cat['is_home_cat_nav']) : ?>
                                        <div class="home-cat-nav-wrap">
                                            <div class="lewan-box-header" style="float:left;padding-top:8px;">
                                                <div class="lewan-box-title">

                                                </div>
                                            </div>
                                            <ul class="cat-nav">
                                                <li>
                                                    <button class="btn btn--white" data-id="0"
                                                            style="font-size:16px;"><?php echo $mo_postlist_no_cat['home_title_s']; ?></button>
                                                </li>
                                                <?php foreach ($mo_postlist_no_cat['nav_cat_id'] as $cat_id) {
                                                    $category = get_category($cat_id);
                                                    echo '<li><button class="btn btn--white" data-id="' . $cat_id . '" style="font-size:16px;">' . $category->cat_name . '</button></li>';
                                                } ?>
                                            </ul>
                                        </div>
                                    <?php else: ?>
                                        <h3 class="section-title">
                                            <span><?php echo $mo_postlist_no_cat['home_title_s']; ?></span></h3>
                                    <?php endif; ?>
                                    <?php do_action('ripro_echo_ads', 'ad_last_1'); ?>
                                <?php endif; ?>
                                <div class="row posts-wrapper">
                                    <?php while ($psots_data->have_posts()) : $psots_data->the_post();
                                        get_template_part('parts/template-parts/content', $latest_layout);
                                    endwhile; ?>
                                </div>
                                <?php do_action('ripro_echo_ads', 'ad_last_2'); ?>
                                <?php #get_template_part( 'parts/pagination' ); ?>

                                <div class="infinite-scroll-action" style="margin-bottom:20px;">
                                    <div class="infinite-scroll-button button"><a href="<?php echo $more_cat_link ?>">
                                            <span style="color: rgb(255, 255, 255);"><strong>查看更多游戏</strong></span></a>
                                    </div>
                                </div>

                            <?php else : ?>
                                <?php get_template_part('parts/template-parts/content', 'none'); ?>
                            <?php endif; ?>
                        </main>
                    </div>
                </div>

                <?php if ($is_cao_site_list_blog) : ?>
                    <!-- 侧边栏 -->
                    <div class="sidebar-column col-lg-3">
                        <aside class="widget-area">
                            <?php dynamic_sidebar('blog'); ?>
                        </aside>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php
wp_reset_postdata();