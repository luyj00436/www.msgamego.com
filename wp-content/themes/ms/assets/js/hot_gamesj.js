$(document).ready(function () {

    //获取列表宽度判断数量
    var list = $('.game-on-shelfsj');
    var listWidth = list.width();

    //数量
    var num = 1;

    //基础信息
    var itemWidth = 379;
    var itemMargin = 56;


    var next = itemWidth;


    var hot_game_width = 379;
    var hot_game_list_margin = 56;

    //当前位置
    var now = 0;


    //当前数量
    var itemNum = 6;


    //当前页
    var page = 1;
    var pageMax = Math.ceil(itemNum / num);


    //上一页
    $(".swiper-prevsj").click(function () {
        if (page != 1) {
            now = now + next;
            $('.game-on-shelfsj').css({
                "transform": "translate3d(" + now + "px, 0px, 0px)",
                "transitionDuration": "500ms"
            });
            page--;
            check_button();
        }
    });


    //下一页
    $(".swiper-nextsj").click(function () {
        if (page < pageMax) {
            now = now - next;
            $('.game-on-shelfsj').css({
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
            $(".swiper-prevsj").addClass("disable");
        } else {
            $(".swiper-prevsj").removeClass("disable");
        }

        if (page === pageMax) {
            $(".swiper-nextsj").addClass("disable");
        } else {
            $(".swiper-nextsj").removeClass("disable");
        }
    }


    //上一页按钮判断
    function check_prev() {
        if (now === 0) {
            $(".swiper-prevsj").addClass("disable");
            return false;
        } else {
            $(".swiper-prevsj").removeClass("disable");
            return true;
        }
    }


    //下一页按钮判断
    function check_next() {
        if (now > next) {
            $(".swiper-nextsj").addClass("disable");
            return false;
        } else {
            $(".swiper-nextsj").removeClass("disable");
            return true;
        }
    }

});