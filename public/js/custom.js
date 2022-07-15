(function($) {

	$(document).ready(function() {
	  $('body').addClass('js');
	  var $menu = $('#menu'),
	    $menulink = $('.menu-link');

	$menulink.click(function() {
	  $menulink.toggleClass('active');
	  $menu.toggleClass('active');
	  return false;
	});});


	videoPopup();


	$('.owl-carousel').owlCarousel({
	    loop:true,
	    margin:30,
	    nav:true,
	    autoplay:true,
		autoplayTimeout:5000,
		autoplayHoverPause:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        550:{
	            items:2
	        },
	        750:{
	            items:3
	        },
	        1000:{
	            items:4
	        },
	        1200:{
	            items:5
	        }
	    }
	})


	$(".Modern-Slider").slick({
	    autoplay:true,
	    autoplaySpeed:10000,
	    speed:600,
	    slidesToShow:1,
	    slidesToScroll:1,
	    pauseOnHover:false,
	    dots:true,
	    pauseOnDotsHover:true,
	    cssEase:'fade',
	   // fade:true,
	    draggable:false,
	    prevArrow:'<button class="PrevArrow"></button>',
	    nextArrow:'<button class="NextArrow"></button>',
	});


	$("div.features-post").hover(
	    function() {
	        $(this).find("div.content-hide").slideToggle("medium");
	    },
	    function() {
	        $(this).find("div.content-hide").slideToggle("medium");
	    }
	 );


	$( "#tabs" ).tabs();


	(function init() {
	  function getTimeRemaining(endtime) {
	    var t = Date.parse(endtime) - Date.parse(new Date());
	    var seconds = Math.floor((t / 1000) % 60);
	    var minutes = Math.floor((t / 1000 / 60) % 60);
	    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
	    var days = Math.floor(t / (1000 * 60 * 60 * 24));
	    return {
	      'total': t,
	      'days': days,
	      'hours': hours,
	      'minutes': minutes,
	      'seconds': seconds
	    };
	  }

	  function initializeClock(endtime){
	  var timeinterval = setInterval(function(){
	    var t = getTimeRemaining(endtime);
	    document.querySelector(".days > .value").innerText=t.days;
	    document.querySelector(".hours > .value").innerText=t.hours;
	    document.querySelector(".minutes > .value").innerText=t.minutes;
	    document.querySelector(".seconds > .value").innerText=t.seconds;
	    if(t.total<=0){
	      clearInterval(timeinterval);
	    }
	  },1000);
	}
	initializeClock(((new Date()).getFullYear()+1) + "/1/1")
	})()

})(jQuery);
//###########################################################clients slider############################################################
$('.owl-carousel').owlCarousel({
    loop:true,
    margin:50,
    autoplay: true,
    autoplayTimeout: 5000,
    slideTransition: 'linear',
    autoplaySpeed: 5000,
    autoplayHoverPause: false,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:3,
            nav:true,
        }
    }
})

document.getElementsByClassName('owl-prev')[0].innerHTML = '<i class="fa-solid fa-circle-chevron-left"></i>'

document.getElementsByClassName('owl-next')[0].innerHTML = '<i class="fas fa-4x fa-caret-right"></i>'

var slideSpeed = 5000;

var main = function(){
    //Carousel
    setInterval(function() {timedDelay()}, slideSpeed);
    //arrow-next
    $('.arrow-next').click(function(e){
        e.preventDefault();

        var currentSlide = $('.active-slide');
        var nextSlide= currentSlide.next();

        var currentDot = $('.active-dot');
        var nextDot = currentDot.next();

        if(nextSlide.length === 0){
            nextSlide = $('.slide').first();
            nextDot = $('.dot').first();
        }

        currentSlide.fadeOut(600, function() {
            $(this).removeClass('active-slide');
            nextSlide.fadeIn(600).addClass('active-slide');

            currentDot.removeClass('active-dot');
            nextDot.addClass('active-dot');
        });
    });
    //arrow-prev
    $('.arrow-prev').click(function(e){
        e.preventDefault();

        var currentSlide = $('.active-slide');
        var prevSlide= currentSlide.prev();

        var currentDot = $('.active-dot');
        var prevDot = currentDot.prev();

        if(prevSlide.length === 0){
            prevSlide = $('.slide').last();
            prevDot = $('.dot').last();
        }

        currentSlide.fadeOut(600, function() {
            $(this).removeClass('active-slide');
            prevSlide.fadeIn(600).addClass('active-slide');

            currentDot.removeClass('active-dot');
            prevDot.addClass('active-dot');
        });
    });
};

//timedDelay function
function timedDelay() {

    var currentSlide = $('.active-slide');
    var nextTimedSlide = currentSlide.next();

    var currentDot = $('.active-dot');
    var nextDot = currentDot.next();

    if(nextTimedSlide.length === 0 ) {
        nextTimedSlide = $('.slide').first();
        nextDot = $('.dot').first();
    }

    currentSlide.fadeOut(600, function() {
        $(this).removeClass('active-slide');
        nextTimedSlide.fadeIn(600).addClass('active-slide');

        currentDot.removeClass('active-dot');
        nextDot.addClass('active-dot');
    });
}

$(document).ready(main);
