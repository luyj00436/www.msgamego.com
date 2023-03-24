<?php
$mode_rotation = _cao('mode_rotation');
$__f = get_template_directory_uri() . '/assets';
$__v = _the_theme_version();
wp_enqueue_script('rotation', $__f . '/js/rotation.js', array(), $__v, '');

wp_enqueue_script('rotation', $__f . '/js/rotationsj.js', array(), $__v, '');
?>

    <div class="sj_dn home-banner">
        <div class="gradual-show-swiper-box ubc-show-item <?php echo esc_attr($mode_rotation['autoplay'] ? ' autoplay' : ''); ?>">
            <?php foreach ($mode_rotation['diy_data'] as $key => $item) {
                echo '<div data-index="' . ($key + 1) . '" class="gradual-show-item-box">';
                echo '<div class="x-swiper-item gradual-show-item">';
                echo '<div class="banner-item x-swiper-item big-card">';
                echo '<a class="banner-img-box" href="' . esc_url($item['_href']) . '" ' . ($item['_blank'] ? ' target="view_window"' : '') . ' rel="noreferrer noopener">';
                echo '<div class="cover xlazy xlazy-loaded" alt="icon" style="background-size: cover; background-position: center center; background-image: url(' . $item['_img'] . ');"></div></a>';
                #echo '<img src="'. esc_url( $item['_img'] ) .'" alt="" importance="high" data-src="'. esc_url( $item['_img'] ) .'" class="banner-img xlazy xlazy-loaded" />';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            } ?>

            <div class="x-pagination-swiper hiden">
                <div class="x-pagination-box">
                    <?php foreach ($mode_rotation['diy_data'] as $key => $item) {
                        echo '<div data-index="' . ($key + 1) . '" class="x-pagination-item"> ';
                        echo '<div class="lewan-home-banner-box">';
                        echo '<div class="banner-indicator-box">';
                        echo '<a class="banner-indicator unchecked" href="' . esc_url($item['_href']) . '" ' . ($item['_blank'] ? ' target="view_window"' : '') . ' rel="noreferrer noopener">';
                        echo '<div class="title">';
                        echo $item['_tab'] ? '<span class="tips tips-bluebg">' . $item['_tab'] . '</span>' : '';
                        echo $item['_title'];
                        echo '</div>';
                        echo '<div class="subtitle">';
                        echo $item['_desc'];
                        echo '</div></a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="pc_dn home-banner">
        <div class="gradual-show-swiper-boxsj ubc-show-item <?php echo esc_attr($mode_rotation['autoplay'] ? ' autoplay' : ''); ?>">
            <?php foreach ($mode_rotation['diy_data'] as $key => $item) {
                echo '<div data-index="' . ($key + 1) . '" class="gradual-show-item-box">';
                echo '<div class="x-swiper-item gradual-show-item">';
                echo '<div class="banner-item x-swiper-item big-card">';
                echo '<a class="banner-img-box" href="' . esc_url($item['_href']) . '" ' . ($item['_blank'] ? ' target="view_window"' : '') . ' rel="noreferrer noopener">';
                echo '<div class="cover xlazy xlazy-loaded" alt="icon" style="background-size: cover; background-position: center center; background-image: url(' . $item['_img'] . ');"></div></a>';
                #echo '<img src="'. esc_url( $item['_img'] ) .'" alt="" importance="high" data-src="'. esc_url( $item['_img'] ) .'" class="banner-img xlazy xlazy-loaded" />';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            } ?>

            <div class="x-pagination-swiper hiden">
                <div class="x-pagination-box">
                    <?php foreach ($mode_rotation['diy_data'] as $key => $item) {
                        echo '<div data-index="' . ($key + 1) . '" class="x-pagination-item"> ';
                        echo '<div class="lewan-home-banner-box">';
                        echo '<div class="banner-indicator-box">';
                        echo '<a class="banner-indicator unchecked" href="' . esc_url($item['_href']) . '" ' . ($item['_blank'] ? ' target="view_window"' : '') . ' rel="noreferrer noopener">';
                        echo '<div class="title">';
                        echo $item['_tab'] ? '<span class="tips tips-bluebg">' . $item['_tab'] . '</span>' : '';
                        echo $item['_title'];
                        echo '</div>';
                        echo '<div class="subtitle">';
                        echo $item['_desc'];
                        echo '</div></a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    } ?>
                </div>
            </div>
        </div>
    </div>

<?php
wp_reset_postdata();