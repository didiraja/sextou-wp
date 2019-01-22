$('.menu-view-btn').click(function(){
    $('.lista-categoria').slideToggle()
})

$('.abre-busca').click(function(){
    $('.search-row').slideToggle()
})

$('.main-slider').slick({
    autoplay: true,
    fade: true,
    arrows: true,
    dots: true
});