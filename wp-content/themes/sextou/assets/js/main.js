$('.menu-view-btn').click(function(){
    $('.lista-categoria').slideToggle()
})

$('.abre-busca').click(function(){
    $('.search-row').slideToggle()
})

$('.main-slider').slick({
    autoplay: true,
    fade: true,
    /* slidesToShow: 1, */
    arrows: true,
    dots: true
});