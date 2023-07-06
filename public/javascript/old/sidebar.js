
// sideBar menu Collapse starts----------------
// menu_index
$(function () {
    $(".menu_index").click(function () {
		$(".sub-menu_index").slideToggle();
        $(".sub-menu_member").slideUp();
        $(".sub-menu_content").slideUp();
		$(".sub-menu_course").slideUp();
        $(".sub-menu_media-center").slideUp();
        $(".sub-menu_keyword").slideUp();
        $(".sub-menu_advertisement").slideUp();
    });
});

// menu_member
$(function () {
    $(".menu_member").click(function () {
		$(".sub-menu_index").slideUp();
        $(".sub-menu_member").slideToggle();
        $(".sub-menu_content").slideUp();
		$(".sub-menu_course").slideUp();
        $(".sub-menu_media-center").slideUp();
        $(".sub-menu_keyword").slideUp();
        $(".sub-menu_advertisement").slideUp();
    });
});

// menu_content
$(function () {
    $(".menu_content").click(function () {
		$(".sub-menu_index").slideUp();
        $(".sub-menu_member").slideUp();
        $(".sub-menu_content").slideToggle();
		$(".sub-menu_course").slideUp();
        $(".sub-menu_media-center").slideUp();
        $(".sub-menu_keyword").slideUp();
        $(".sub-menu_advertisement").slideUp();
    });
});

// menu_course
$(function () {
    $(".menu_course").click(function () {
		$(".sub-menu_index").slideUp();
        $(".sub-menu_member").slideUp();
        $(".sub-menu_content").slideUp();
		$(".sub-menu_course").slideToggle();
        $(".sub-menu_media-center").slideUp();
        $(".sub-menu_keyword").slideUp();
        $(".sub-menu_advertisement").slideUp();
    });
});

// menu_media-center
$(function () {
    $(".menu_media-center").click(function () {
		$(".sub-menu_index").slideUp();
        $(".sub-menu_member").slideUp();
        $(".sub-menu_content").slideUp();
		$(".sub-menu_course").slideUp();
        $(".sub-menu_media-center").slideToggle();
        $(".sub-menu_keyword").slideUp();
        $(".sub-menu_advertisement").slideUp();
    });
});

// menu_keyword
$(function () {
    $(".menu_keyword").click(function () {
		$(".sub-menu_index").slideUp();
        $(".sub-menu_member").slideUp();
        $(".sub-menu_content").slideUp();
		$(".sub-menu_course").slideUp();
        $(".sub-menu_media-center").slideUp();
        $(".sub-menu_keyword").slideToggle();
        $(".sub-menu_advertisement").slideUp();
    });
});

// menu_advertisement
$(function () {
    $(".menu_advertisement").click(function () {
		$(".sub-menu_index").slideUp();
        $(".sub-menu_member").slideUp();
        $(".sub-menu_content").slideUp();
		$(".sub-menu_course").slideUp();
        $(".sub-menu_media-center").slideUp();
        $(".sub-menu_keyword").slideUp();
        $(".sub-menu_advertisement").slideToggle();
    });
});
// sideBar menu Collapse ends------------------
$("#filter").bind("keyup", function() {
    var text = $(this).val().toLowerCase();
    var items = $(".link_name");//link_name item_name
    
    //first, hide all:
    items.parent().hide();
    
    //show only those matching user input:
    items.filter(function () {
        return $(this).text().toLowerCase().indexOf(text) == 0;
    }).parent().show();
});
// search menu ends------------------