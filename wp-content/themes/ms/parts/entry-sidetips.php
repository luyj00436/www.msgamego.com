<?php

echo '<span class="article-copyright",style=" padding: 5px;margin-top: 10px;margin-bottom:10px;display: block;background-color: #fffacd;color: #999999;border-radius: 4px;text-align: left;border: 1px dashed #ffc12b;font-size: 13px;clear: both;overflow: hidden;">' . _cao('post_sidetips') . '<br/><a href="' . get_bloginfo('url') . '">' . get_bloginfo('name') . '</a> &raquo; <a href="' . get_permalink() . '">' . get_the_title() . '</a></span>';
?>