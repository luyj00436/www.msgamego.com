<link rel='stylesheet' id='app-css' href='https://www.msgamego.com/wp-content/themes/ms/assets/css/apps.css?ver=1.0.0'
      type='text/css' media='all'/>
<script type='text/javascript' src='https://www.msgamego.com/wp-content/themes/ms/assets/js/apps.js?ver=1.0.0'
        id='app-js'></script>
<?php
$sidebar = 'none';

$mo_postlist_no_cat = _cao('home_last_post');
$mo_postlist_youxi_cat = _cao('home_youxi_post');


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

}
///////////S CACHE ////////////////
$psots_data = new WP_Query($args); //原始输出
/////////////
$is_cao_site_list_blog = is_cao_site_list_blog();
if ($is_cao_site_list_blog) {
    $col_class = 'content-column col-lg-9';
    $latest_layout = 'bloglist';
} else {
    $col_class = 'col-lg-12';
    $latest_layout = _cao('latest_layout', 'grid');
    $latest_layouts = _cao('latest_layout', 'grids');
}
/////////////

$more_cat_link = get_category_link($mo_postlist_no_cat['more_cat_id']);
$more_cat_links = get_category_link($mo_postlist_youxi_cat['more_cat_id']);

/////////////
if (!empty($mo_postlist_youxi_cat['home_postlist_no_cats'])) {
    $argss['cat'] = '-' . implode($mo_postlist_youxi_cat['home_postlist_no_cats'], ',-');
}
$argss['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 0;
// query_posts($args);
///////////S CACHE ////////////////
if (CaoCache::is()) {
    $_the_cache_keys = 'ripro_home_last_posts_' . $argss['paged'] . '' . $argss['cats'];
    $_the_cache_datas = CaoCache::get($_the_cache_keys);
    if (false === $_the_cache_data) {
        $_the_cache_data = new WP_Query($argss); //缓存数据
        CaoCache::set($_the_cache_keys, $_the_cache_datas);
    }
    $psots_datas = $_the_cache_datas;
} else {
    $psots_datas = new WP_Query($argss); //原始输出
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
    $latest_layouts = _cao('latest_layout', 'grids');
}
/////////////


/////////////


$post = get_queried_object();

$c_id_object = get_queried_object();
$c_id = $c_id_object->ID;
echo $c_id;


$cat = !empty($_POST['cat']) ? esc_sql($_POST['cat']) : '';

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
                                            <div class="lw-module-header-title"><?php echo $mo_postlist_no_cat['home_title_s']; ?></div>
                                        </div>

                                        <style type="text/css">
                                            /* CSS样式制作 */

                                            #tab {
                                            }

                                            #tab ul {
                                            }

                                            #tab ul li {
                                            }

                                            .off {

                                                color: #555;
                                                border: none;
                                                border-radius: 4px;
                                                cursor: pointer;
                                                display: inline-block;
                                                font-size: 11px;
                                                letter-spacing: 1px;
                                                line-height: 36px;
                                                outline: none;
                                                text-align: center;
                                                position: relative;

                                                background-color: #FFF;
                                            }

                                            .on {
                                                background-color: #ef0a0a;
                                                color: #ffffff;
                                                border: none;
                                                border-radius: 4px;
                                                cursor: pointer;
                                                display: inline-block;
                                                font-size: 11px;
                                                letter-spacing: 1px;
                                                line-height: 36px;
                                                outline: none;
                                                text-align: center;
                                                position: relative;


                                            }

                                            .off:hover {
                                                background-color: #ef0a0a;
                                                color: #ffffff;
                                            }


                                            #tab div {
                                            }

                                        </style>
                                        <script type="text/javascript">
                                            // JS实现选项卡切换
                                            window.onload = function () {
                                                var myTab = document.getElementById("tab");    //整个div
                                                var myLi = myTab.getElementsByTagName("button");    //数组

                                                for (var i = 0; i < myLi.length; i++) {
                                                    myLi[i].index = i;
                                                    myLi[i].onclick = function () {
                                                        for (var j = 0; j < myLi.length; j++) {
                                                            myLi[j].className = 'off';

                                                        }
                                                        this.className = 'on';

                                                    }
                                                }


                                                var myTabs = document.getElementById("category");    //整个div
                                                var myLis = myTabs.getElementsByTagName("button");    //数组

                                                for (var i = 0; i < myLis.length; i++) {
                                                    myLis[i].index = i;
                                                    myLis[i].onclick = function () {
                                                        for (var j = 0; j < myLis.length; j++) {
                                                            myLis[j].className = 'off';

                                                        }
                                                        myLis[this.index].className = 'on';

                                                    }
                                                }

                                            }
                                        </script>
                                        <div class="sj_dn" id="tab">
                                            <ul class="cat-nav">

                                                <?php foreach ($mo_postlist_no_cat['nav_cat_id'] as $cat_id) {
                                                    $category = get_category($cat_id);
                                                    echo '<li class=""><button class="off" data-id="' . $cat_id . '" style="font-size:16px;">' . $category->cat_name . '</button></li>';

                                                } ?>
                                            </ul>
                                        </div>

                                        <div class="pc_dn">
                                            <ul class="cat-navsj">

                                                <?php foreach ($mo_postlist_no_cat['nav_cat_id'] as $cat_id) {
                                                    $category = get_category($cat_id);

                                                    echo '<li ><button class="btn btn--white ' . $active . '" data-id="' . $cat_id . '" style="font-size:16px;">' . $category->cat_name . '</button></li>';

                                                } ?>
                                            </ul>
                                        </div>


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


                        <?php else : ?>
                            <?php get_template_part('parts/template-parts/content', 'none'); ?>
                        <?php endif; ?>

                        <div class="infinite-scroll-action" style="margin-bottom:20px;">
                            <div class="infinite-scroll-button button"><a href="<?php echo $more_cat_link ?>"> <span
                                            style="color: rgb(255, 255, 255);"><strong>查看更多游戏</strong></span></a>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section" style="padding-top:0px;">
    <div class="container" style="background:#fff;border-radius:4px;padding-top:10px;">
        <div class="row">
            <!-- 文章 -->
            <div class="<?php echo $col_class; ?>">
                <div class="content-area">
                    <main class="site-mains">
                        <?php if ($psots_datas->have_posts()) : ?>
                            <?php if (is_home()) : ?>
                                <?php if ($mo_postlist_youxi_cat['is_home_cat_nav']) : ?>
                                    <div class="home-cat-nav-wraps">

                                        <?php $i = 1; ?>
                                        <div class="lw-module-header title-containers">
                                            <div class="lw-module-header-title"><?php echo $mo_postlist_youxi_cat['home_title_s']; ?></div>
                                        </div>


                                        <div class="sj_dn" id="category">
                                            <ul class="cat-nav">

                                                <?php foreach ($mo_postlist_youxi_cat['nav_cat_id'] as $cat_id) {
                                                    $category = get_category($cat_id);


                                                    ?>


                                                    <?php
                                                    echo '<li ><button class="off" data-id="' . $cat_id . '" style="font-size:16px;">' . $category->cat_name . '</button></li>';


                                                } ?>

                                            </ul>
                                        </div>

                                        <div class="pc_dn">
                                            <ul class="cat-navsj">

                                                <?php foreach ($mo_postlist_youxi_cat['nav_cat_id'] as $cat_id) {
                                                    $category = get_category($cat_id);


                                                    ?>


                                                    <?php
                                                    echo '<li ><button class="off" data-id="' . $cat_id . '" style="font-size:16px;">' . $category->cat_name . '</button></li>';

                                                    $i = $i + 1;
                                                } ?>

                                            </ul>
                                        </div>

                                    </div>
                                <?php else: ?>
                                    <h3 class="section-title">
                                        <span><?php echo $mo_postlist_youxi_cat['home_title_s']; ?></span></h3>
                                <?php endif; ?>
                                <?php do_action('ripro_echo_ads', 'ad_last_1'); ?>
                            <?php endif; ?>


                            <div class="row posts-wrappers">
                                <?php while ($psots_datas->have_posts()) : $psots_datas->the_post();
                                    get_template_part('parts/template-parts/content', $latest_layouts);
                                endwhile; ?>
                            </div>


                            <?php do_action('ripro_echo_ads', 'ad_last_2'); ?>
                            <?php #get_template_part( 'parts/pagination' ); ?>


                        <?php else : ?>
                            <?php get_template_part('parts/template-parts/content', 'none'); ?>
                        <?php endif; ?>

                        <div class="infinite-scroll-action" style="margin-bottom:20px;">
                            <div class="infinite-scroll-button button"><a href="<?php echo $more_cat_links ?>"> <span
                                            style="color: rgb(255, 255, 255);"><strong>查看更多游戏</strong></span></a>
                            </div>
                        </div>
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