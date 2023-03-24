<?php
$mode_search = _cao('mode_search');
$image = $mode_search['bgimg'];
$categories = get_categories(array('hide_empty' => 0));//获取所有分类
$home_search_mod = _cao('home_search_mod');
?>
<div class="section pt-0 pb-0 sj_dn">
    <div class="row">

        <div class="container home-filter--content" style="background:none;height:60px;">

            <form class="mb-0" method="get" autocomplete="off" action="<?php echo home_url(); ?>"
                  style="background:none;border-radius:4px;">
                <div class="" style="margin:10px auto 0px; width:800px;display:flex;">
                    <input type="text" class="home_search_input" name="s" placeholder="输入关键词搜索..."
                           style="height:40px;border-radius:20px 0px 0px 20px;border:1px solid #34495e;outline:none;">
                    <input type="submit" value="搜索"
                           style="width:80px;border-radius:0px 20px 20px 0px;height:40px;font-size:16px;">
                </div>
            </form>
        </div>
    </div>
</div>


<div class="section pt-0 pb-0 pc_dn">
    <div class="row">

        <div class="container home-filter--content" style="background:none;height:60px;">

            <form class="mb-0" method="get" autocomplete="off" action="<?php echo home_url(); ?>"
                  style="background:none;border-radius:4px;">
                <div class="" style="margin:10px auto 0px; width:90%;display:flex;">
                    <input type="text" class="home_search_input" name="s" placeholder="输入关键词搜索..."
                           style="height:40px;border-radius:20px 0px 0px 20px;border:1px solid #34495e;outline:none;">
                    <input type="submit" value="搜索"
                           style="width:80px;border-radius:0px 20px 20px 0px;height:40px;font-size:16px;">
                </div>
            </form>
        </div>
    </div>
</div>