jQuery(document).ready(function($) {
  var slider = $('.slider');
  var sliderItems = $('.slider-item');
  var sliderCaptions = $('.slider-caption');
  var sliderBullets = $('.slider-bullet');

  var currentSlide = 0;
  var slideInterval = setInterval(nextSlide, 5000);

  function nextSlide() {
    sliderItems.eq(currentSlide).removeClass('active');
    sliderCaptions.eq(currentSlide).removeClass('active');
    sliderBullets.eq(currentSlide).removeClass('active');
    currentSlide = (currentSlide + 1) % sliderItems.length;
    sliderItems.eq(currentSlide).addClass('active');
    sliderCaptions.eq(currentSlide).addClass('active');
    sliderBullets.eq(currentSlide).addClass('active');
  }

  sliderBullets.on('click', function() {
    sliderItems.eq(currentSlide).removeClass('active');
    sliderCaptions.eq(currentSlide).removeClass('active');
    sliderBullets.eq(currentSlide).removeClass('active');
    currentSlide = $(this).index();
    sliderItems.eq(currentSlide).addClass('active');
    sliderCaptions.eq(currentSlide).addClass('active');
    sliderBullets.eq(currentSlide).addClass('active');
    clearInterval(slideInterval);
    slideInterval = setInterval(nextSlide, 5000);
  });
});