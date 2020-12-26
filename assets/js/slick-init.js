document.addEventListener('DOMContentLoaded', function(){

    jQuery('.variable-width').on('init', function(slick){
        console.log(slick);
    });

    jQuery('.variable-width').slick({
        dots: false,
        infinite: true,
        lazyLoad: 'ondemand',
        variableWidth: true,
        autoplay: true,
        autoplaySpeed: 3000,
        slidesToShow: 15,
        slidesToScroll: 2,
        prevArrow:"<button type='button' class='slick-arrow slick-prev'><</button>",
        nextArrow:"<button type='button' class='slick-arrow slick-next'>></button>"
    });
});
