var i = 0;
var p;
$('.main_menu li').each(function(i) {
    if ($(this).hasClass("active")) {
        p = i;
    }
    $(this).hover(function() {
        $('.main_menu li').removeClass('active');
        $('.main_menu li').eq(i).addClass('active');
    }, function() {
        $('.main_menu li').removeClass('active');
        if (p >= 0) {
        $('.main_menu li').eq(p).addClass('active');
        }
    })
});

$('.phone_btn').click(function(){
    $('.phone_menu').addClass('active');
    $('.Mask').fadeIn(200);
})
$('.Mask').bind("touchend",function(){
    $('.phone_menu').removeClass('active');
    $('.Mask').fadeOut(200);
})



$(function(){
    var menuSwiper = new Swiper(".menuSwiper",{
        slidesPerView : 'auto',
    })
})