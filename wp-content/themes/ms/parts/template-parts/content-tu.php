<?php

$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'large');
$img = $large_image_url[0];


if (_cao('is_mobele_list') && wp_is_mobile()) {
    get_template_part('parts/template-parts/content', 'list');
} else {
    ?>

    <style>


    </style>

    <div class="col-lg-1-5 col-66 col-sm-6 col-md-4 col-lg-4 tu-item">
        <a target="_blank" href="<?php echo get_the_permalink($item->ID) ?>">
            <div class="tu"
                 style="width:100%;height:220px; background-size: cover; background-position: center center; background-image: url(<?php echo $img; ?>);"></div>
        </a>
    </div>


<?php } ?>