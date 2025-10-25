$(document).ready(function(){
    /*$(window).scroll(function() {    
        var scroll = $(window).scrollTop();

        if (scroll >= 30) {
            $(".top-nav").addClass("fixed");
        } else {
            $(".top-nav").removeClass("fixed");
        }
    });*/
    $('.menubar').click(function(){
        $('.sidebar-menu').toggleClass('active');
        $('.menu-overlay').addClass('active');
        $('body').addClass('no-scroll');
    })
    $('.bi-x-lg').click(function(){
        $('.sidebar-menu').removeClass('active');
        $('.menu-overlay').removeClass('active');
        $('body').removeClass('no-scroll');
    })
    $('.menu-overlay').click(function(){
        $('.sidebar-menu').removeClass('active');
        $(this).removeClass('active');
        $('body').removeClass('no-scroll');
    })
})
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})