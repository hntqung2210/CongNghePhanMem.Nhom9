jQuery(function ($) {
	$(document).ready(function(){ 
 var swiper = new Swiper(".wnSwiper", {
      loop: true,
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: false,
      watchSlidesProgress: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
    var swiper2 = new Swiper(".wnSwiper2", {
      loop: true,
      spaceBetween: 10,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      thumbs: {
        swiper: swiper,
      },
    });
	});
	
	var now = new Date();

	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);

	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

	$('.wn-banner-form-date #wn-checkin-date').val(today);
	$('.wn-banner-form-date #wn-checkout-date').val(today);
	const checkin = $('.wn-banner-form-date #wn-checkin-date');
	const checkout = $('.wn-banner-form-date #wn-checkout-date');
	$('.wn-banner-form-submit').on('click', function(){
		const checkIn = $('#wn-checkin-date').val();
		const checkOut = $('#wn-checkout-date').val();
		const number = $('#wn-num-of-cus').val();
		
		$('#wn-cf7-booking-check-in').val(checkIn);
		$('#wn-cf7-booking-check-out').val(checkOut);
		$('#wn-cf7-booking-cus').val(number);
	});
});