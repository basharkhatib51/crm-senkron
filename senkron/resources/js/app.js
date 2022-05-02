require('./bootstrap');
require('../bootstrap/js/bootstrap');

$(document).ready(function () {

    AOS.init();
    $(".product_images").click(function () {
        $("#product_image_show").attr('src', $(this).attr('url_data'))
    });
    $("#open-menu").click(function () {
        $("#MobilMenu").slideDown("slow");
    });
    $("#close-menu").click(function () {
        $("#MobilMenu").slideUp("slow");
    });

    $('.sub-menu ul').hide();
    $(".sub-menu a").click(function () {
        $(this).parent(".sub-menu").children("ul").slideToggle("100");
        $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
    });

    $("#play-youtube").click(function () {
        $("#iframe-youtube").slideDown("slow");
        $(".video-iframe").attr('src', 'https://www.youtube.com/embed/2XUs1JBRl0A');
    });
    $("#iframe-youtube-close").click(function () {
        $("#iframe-youtube").slideUp("slow");
        $(".video-iframe").attr('src', null);
    });



    $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
});
