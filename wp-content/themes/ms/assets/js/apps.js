"use strict";

function open_signup_popup() {
    var e = $("#popup-signup"), t = e.html();
    Swal.fire({
        html: t, showConfirmButton: !1, width: 340, padding: "0", focusConfirm: !1, onBeforeOpen: function () {
            $(".swal2-container .swal2-input").remove(), $(".swal2-container .swal2-file").remove(), $(".swal2-container .swal2-range").remove(), $(".swal2-container .swal2-select").remove(), $(".swal2-container .swal2-radio").remove(), $(".swal2-container .swal2-checkbox").remove(), $(".swal2-container .swal2-textarea").remove(), $(".swal2-container .swal2-validation-message").remove(), e.empty()
        }, onClose: function () {
            e.html(t)
        }
    })
}


// 就这段代码，删除 登录无效，游戏排名有效。不删除 游戏排名有效，登录无效
function ajax_getposts() {
    $(".home-cat-nav-wraps ul li button").on("click", function () {
        var e = $(this), t = e.html();
        e.html(iconspin + t);
        var n = e.data("id");
        $.post(caozhuti.ajaxurl, {action: "ajax_getcat_posts", paged: 1, cat: n}, function (a) {
            e.parents(".site-mains").find(".posts-wrappers").html(a), e.html(t), 0 == n ? ($(".infinite-scroll-action").show(), $(".navigation").show(), $(".numeric-pagination").show()) : ($(".navigation").hide(), $(".numeric-pagination").hide())
        })
    })
}


;