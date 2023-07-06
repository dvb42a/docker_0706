// sideMenu Collapse

// web-setting
$(function () {
    $(".web-setting").click(function () {
        $(".web-setting-li").slideToggle("slow");
    });
});

// member-manage
$(function () {
    $(".member-manage").click(function () {
        $(".member-manage-li").slideToggle("slow");
    });
});


// content-manage
$(function () {
    $(".content-manage").click(function () {
        $(".content-manage-li").slideToggle("slow");
    });
});

// course-manage
$(function () {
    $(".course-manage").click(function () {
        $(".course-manage-li").slideToggle("slow");
    });
});

// keyword-manage
$(function () {
    $(".keyword-manage").click(function () {
        $(".keyword-manage-li").slideToggle("slow");
    });
});

// trade-manage
$(function () {
    $(".trade-manage").click(function () {
        $(".trade-manage-li").slideToggle("slow");
    });
});


//  is-active status setting
$(".menu-list a").click(function () {
    $(".menu-list a").removeClass("is-active");
    $(this).addClass("is-active");
});
