jQuery(document).ready(function($) {
    // Enable dropdowns on hover
    $('.navbar .dropdown').hover(function() {
      $(this).find('.dropdown-menu').first().stop(true, true).fadeIn();
  
    }, function() {
      $(this).find('.dropdown-menu').first().stop(true, true).fadeOut();
  
    });
  
    // Enable sub-menus to be shown
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
      if (!$(this).next().hasClass('show')) {
        $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
      }
      var $subMenu = $(this).next('.dropdown-menu');
      $subMenu.toggleClass('show');
  
    });
  
    // Hide dropdowns if outside of navbar
    $('body').on('click', function(e) {
      if (!$('.navbar').is(e.target) && $('.navbar').has(e.target).length === 0 && $('.show').has(e.target).length === 0) {
        $('.dropdown-menu .show').removeClass('show');
      }
    });
  });