<?php
global $current_user, $paged;
$user_id = $current_user->ID;
$PostPay = new PostPay($user_id, 0);
?>

<div class="col-xs-12 col-sm-12 col-md-9">
    <div class="mypay-list form-box">
        <div class="row">

            <?php
            $post_pay_ids = $PostPay->get_pay_ids($user_id);
            if (!$post_pay_ids) {
                $post_pay_ids = array(0);
            }
            # 输出列表...
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 5,
                'paged' => $paged,
                //'showposts' => count($current_post_ids),
                'post__in' => $post_pay_ids,
                'has_password' => false,
                'ignore_sticky_posts' => 1,
                'orderby' => 'date', // modified - 如果按最新编辑时间排序
                'order' => 'DESC'
            );
            query_posts($args);

            if (have_posts()):

                while (have_posts()): the_post();
                    ?>
                    <div class="col-12">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('post post-list'); ?>>
                            <?php
                            // 获取购买天数有效期天数
                            $post_expire = get_post_meta(get_the_ID(), 'cao_expire_day', 1);
                            $shop_expire = (empty($post_expire)) ? _cao('ripro_expire_day', '0') : $post_expire;
                            if (!empty($shop_expire)) {
                                global $wpdb, $paylog_table_name;
                                // 最近一次购买时间
                                $p_time = $wpdb->get_row($wpdb->prepare("SELECT pay_time FROM {$paylog_table_name} WHERE post_id = %d AND status = 1 ", get_the_ID()));
                                $_time = time();
                                //有效期结束时间
                                $post_expire_time = $p_time->pay_time + ($shop_expire * 24 * 3600);
                                if ($post_expire_time < $_time) {
                                    echo '<span class="post-expire-time">权限已过期</span>';
                                }
                            } else {
                                echo '<span class="post-expire-time ok">可查看下载</span>';
                            }

                            ?>
                            <?php
                            $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'large');
                            $img = $large_image_url[0];
                            ?>
                            <div class="entry-media">
                                <div class="placeholder" style="padding-bottom: 66.666666666667%;">
                                    <a target="_blank" href="<?php echo get_the_permalink($item->ID) ?>">
                                        <div class="cover xlazy xlazy-loaded" alt="icon"
                                             style="background-size: cover; background-position: center center; background-image: url(<?php echo $img; ?>);"></div>
                                    </a>
                                </div>
                            </div>


                            <?php #cao_entry_media( array( 'layout' => 'rect_300' ) ); ?>
                            <div class="entry-wrapper">
                                <?php cao_entry_header(array('category' => true, 'author' => false, 'comment' => false)); ?>
                                <div class="entry-excerpt u-text-format"><?php echo _get_excerpt(80); ?></div>
                                <?php get_template_part('parts/entry-footer'); ?>
                            </div>
                        </article>
                    </div>
                <?php
                endwhile;

                _paging();

            else:
                get_template_part('parts/template-parts/content', 'none');

            endif;
            wp_reset_query();
            ?>

        </div>
    </div>
</div>
