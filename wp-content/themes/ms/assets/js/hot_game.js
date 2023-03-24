$(document).ready(function () {

    //获取列表宽度判断数量
    var list = $('.game-on-shelf');
    var listWidth = list.width();

    //数量
    var num = 4;

    //基础信息
    var itemWidth = 250;
    var itemMargin = 56;


    var next = num * itemWidth + num * itemMargin;


    var hot_game_width = 1160;
    var hot_game_list_margin = 56;

    //当前位置
    var now = 0;


    //当前数量
    var itemNum = listWidth / (itemWidth + itemMargin);


    //当前页
    var page = 1;
    var pageMax = Math.ceil(itemNum / num);


    //上一页
    $(".swiper-prev").click(function () {
        if (page != 1) {
            now = now + next;
            $('.game-on-shelf').css({
                "transform": "translate3d(" + now + "px, 0px, 0px)",
                "transitionDuration": "500ms"
            });
            page--;
            check_button();
        }
    });


    //下一页
    $(".swiper-next").click(function () {
        if (page < pageMax) {
            now = now - next;
            $('.game-on-shelf').css({
                "transform": "translate3d(" + now + "px, 0px, 0px)",
                "transitionDuration": "500ms"
            });
            page++;
            check_button();
        }
    });

    check_button();

    function check_button() {
        if (page === 1) {
            $(".swiper-prev").addClass("disable");
        } else {
            $(".swiper-prev").removeClass("disable");
        }

        if (page === pageMax) {
            $(".swiper-next").addClass("disable");
        } else {
            $(".swiper-next").removeClass("disable");
        }
    }


    //上一页按钮判断
    function check_prev() {
        if (now === 0) {
            $(".swiper-prev").addClass("disable");
            return false;
        } else {
            $(".swiper-prev").removeClass("disable");
            return true;
        }
    }


    //下一页按钮判断
    function check_next() {
        if (now > next) {
            $(".swiper-next").addClass("disable");
            return false;
        } else {
            $(".swiper-next").removeClass("disable");
            return true;
        }
    }

});