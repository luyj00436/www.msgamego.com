$(document).ready(function () {

    // //轮播初始化
    $(".x-pagination-item a.banner-indicator:first").removeClass("unchecked");
    $(".x-pagination-item a.banner-indicator:first").addClass("checked");
    $(".gradual-show-item-box:first").addClass("cur-item");

    //切换事件
    $(".x-pagination-item").hover(function () {
        slider($(this))
        clearInterval(timer);
    }, function () {
        slider_autoplay();
    });

    //轮播切换
    function slider(document) {
        $(".x-pagination-item a.banner-indicator").removeClass("checked");
        $(".x-pagination-item a.banner-indicator").addClass("unchecked");
        document.find(".banner-indicator").removeClass("unchecked");
        document.find(".banner-indicator").addClass("checked");
        var index = document.attr("data-index");
        $(".gradual-show-item-box").removeClass("cur-item");
        $(".gradual-show-item-box[data-index=" + index + "]").addClass("cur-item");
    }

    //轮播自动播放
    var timer;

    function slider_autoplay() {
        //获取图片长度
        var len = $(".gradual-show-item-box").length;
        if (len === 1) {
            return
        }
        //自动播放定时
        var index = $('.gradual-show-item-box.cur-item').index() + 1;

        timer = setInterval(function () {

            var item = $(".x-pagination-item[data-index=" + index + "]")
            slider($(item))
            index++;

            if (index > 6) {
                index = 1;
            }
        }, 4000)
    }

    //自动轮播开启条件
    if ($('.gradual-show-swiper-box').hasClass('autoplay')) {
        slider_autoplay();
    }


});