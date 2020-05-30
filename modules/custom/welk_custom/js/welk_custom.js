
var resort_name, resort_checkindate, resort_rooms_guests, total_rooms, guest_breakup_rooms;
(function ($, Drupal, drupalSettings) {
  /**
   * @namespace
  */
  Drupal.behaviors.mymoduleAccessData = {
    attach: function (context) {
      resort_name = drupalSettings.destinations;
      resort_checkindate = drupalSettings.check_in_check_out;
      resort_rooms_guests = drupalSettings.rooms_guests;
      total_rooms = drupalSettings.total_rooms;
      guest_breakup_rooms = drupalSettings.guest_breakup_rooms;
    }
  };
})(jQuery, Drupal, drupalSettings);

//Update Search
$('.booking-div').find('a.btn-primary').on('click', function () {
  // Default Value Setting From Stored Session
  $(".check-in-out input[name='check_in_check_out']").val(resort_checkindate).datepick();
  $('.booking-slots.header').find('.edit-rooms-guests').val(resort_rooms_guests);
  $('.dropdown-menu.rooms').find('.total-rooms').find('input.rooms').val(total_rooms);

  // Room & guests Breakup
  $('.dropdown-menu.rooms').find('.rooms-guests.guest').addClass('hide');
  var roomsCount = $('.dropdown-menu.rooms').find('.rooms-guests.guest').length;
  $('.dropdown-menu.rooms .rooms-guests.guest:lt(' + total_rooms + ')').removeClass('hide').addClass('show');
  var guestValues = guest_breakup_rooms.split(",");
  $.each(guestValues, function (i) {
    if ($('.rooms-guests.guest input.guests').eq(i).length) {
      $('.rooms-guests.guest input.guests').eq(i).val(guestValues[i]);
    }
  });
});
// Room Gallery 1st Active Item
$('.views-element-container').each(function(){  
 $(this).find('.view-select-room-view .room-gallery').find('.carousel.slide').find('.carousel-item:first').addClass('active');  
});

//Accordion Counter
var counter=1;
var innerCounter=1;

 // Accordion Default Select
 
$('.views-element-container').each(function(){   
  $(this).find('.view-select-room-view .room-gallery').find('.carousel.slide').find('.carousel-item:first').addClass('active');      
  $(this).find('.accordion').attr('id','accordion' + counter);    
  
  //First Accordion Active
  $('#accordion' + counter).find(".card").first().find(".card-header").addClass("active");
  $('#accordion' + counter).find(".card").first().find(".card-header").next().addClass("show");
  
  $('#accordion' + counter).find('.card').each(function(){
    $(this).find(".card-header").find("button").attr("data-target", "#collapse" + counter + "_" + innerCounter);
    $(this).find(".card-header").next().attr("id", "collapse" + counter + "_" + innerCounter);   
    innerCounter++;
  });   
  
  $('#accordion' + counter).find(".card-header").find("button").on("click", function () {        
     $(this).parents('.card').siblings().find(".card-header").next().removeClass('show');
     $(this).parents('.card').siblings().find(".card-header").removeClass('active');
      var selector = $(this).parents(".card-header").next();
      if (!selector.hasClass("show")) {
         $(this).parents(".card-header").addClass("active");
      }
    });
      counter++;
 });
 $(document).ready(function(){
$('.eu-cookie-compliance-default-button').on('click', function () {
	        var path=drupalSettings.path.baseUrl;
			var baseurl = window.location.origin;
            var base_path= baseurl+path;
	        var cookiesval="user";
	  //alert("divya");
			$.ajax({
				 url : base_path+'cookies/result',
				 data:{"title":cookiesval},
				 type: 'GET',
				 
				 beforeSend: function(){
					// Show image container
					//roombooking.find('.roomgif').show();
				 },
				 success: function(data){
					 alert(data);
					// window.location=base_path+'select-rate';
				 },
				 complete:function(data){
					// Hide image container
					//roombooking.find('.roomgif').hide();
				 }
			});
 

});
});


