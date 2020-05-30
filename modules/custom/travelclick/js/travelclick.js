$(document).ready(function(){
	// Ajax for clicking on rate details - Standard Plans
	$('.stnplans').each(function(){
		$(this).find('.rate-details').on('click',function(event){
			event.preventDefault();
			$( "#plans" ).empty();
      		var plancode = $(this).attr('rateplancode');
			var plan = $(this);
			$.ajax({
				url : 'rate-detail',
				data:{"code":plancode},
				type: 'GET',
				dataType: 'html',
				beforeSend: function(){
					// Show image container
					plan.next().show();
				},
				success: function(data){
					//alert(data);
					$('#plans').html(data); //return correct data
							$("#changeRoom").modal('show');
				},
				complete:function(data){
					// Hide image container
					plan.next().hide();
				}
			});
		});	
	// Redirect Rate functionality	
		$(this).find('.rate-redirect').on('click',function(event){
			event.preventDefault();
			var ratecode = $(this).attr('rateplancode');
			var ratetype = $(this).attr('rateplantype');
			var ratename = $(this).attr('rateplanname');
			var totalRoomCount = $(this).attr('totalRoomCount');
			var roomCounter = $(this).attr('roomCounter');
			roomCounter++;
			roomcount = roomCounter;
			if(roomcount == totalRoomCount){
				var redirect = 'Nextpage';
			}else{
				var redirect = 'previouspage';
			}
			$('.stnplans').find('.rate-redirect').css('pointer-events', 'none').css('cursor', 'default'); // To prevent double click
			//roomcount -= 1;
			$.ajax({
				url : 'rate-redirect',
				data:{"code":ratecode, "rtype":ratetype, "rname":ratename, "rcount":roomcount},
				type: 'GET',
				//async: false,
				success: function(data){
					var getRes = JSON.parse(data);
					//alert(getRes.reservationResponses[0].errorInfo.message);return false;
					if(typeof getRes.errors =='object'){
						var errormessage = getRes.errors[0].errorMessage;
						if(errormessage.length > 0){
							alert(errormessage);
							window.location='reservation/booking';
						}
					}else{
						if(redirect == 'Nextpage'){
							window.location='reservation/confirm-stay';
						}else{
							window.location='reservation/booking';
						}
					}
				},
				error: function(request, textStatus, errorThrown) {
					//alert(jqXHR.status);
					//alert(textStatus);
					alert(request.responseText);
				}
			});
		});
	}); 
	// Ajax for Select Rate button rate details popup - Standard Plans
	$(document).on('click', '.selectrate', function(event){ 
		event.preventDefault();
		var ratecode = $(this).attr('rateplancode');
		var ratetype = $(this).attr('rateplantype');
		var ratename = $(this).attr('rateplanname');
		var totalRoomCount = $(this).attr('totalRoomCount');
		var roomCounter = $(this).attr('roomCounter');
		var flag = $(this).attr('flag');
		roomCounter++;
		roomcount = roomCounter;
		if(roomcount == totalRoomCount){
			if(flag.length > 0 && flag == 'clicked'){
				redirect = 'compare';
			}else{
				var redirect = 'Nextpage';
			}
		}else{
			var redirect = 'previouspage';
		}
		$(this).off("click").attr('href', "javascript: void(0);"); // To prevent double click
		$(this).css('pointer-events', 'none').css('cursor', 'default');
		$.ajax({
			url : 'rate-redirect',
			data:{"code":ratecode, "rtype":ratetype, "rname":ratename, "rcount":roomcount},
			type: 'GET',
			success: function(data){
				var getRes = JSON.parse(data);
				if(typeof getRes.errors =='object'){
					var errormessage = getRes.errors[0].errorMessage;
					if(errormessage.length > 0){
						alert(errormessage);
						window.location='reservation/booking';
					}
				}else{
					if(redirect == 'Nextpage'){
						window.location='reservation/confirm-stay';
					}else if(redirect == 'compare'){
						window.location='reservation/comparison';
					}else{
						window.location='reservation/booking';
					}
				}
			},
			error: function(request, textStatus, errorThrown) {
				//alert(jqXHR.status);
				//alert(textStatus);
				alert(request.responseText);
			}
		});
	});
	
	// Ajax for clicking on show more - Deal & Packages
	$('.dealpackages').each(function(){
		$(this).find(".deal-details").on('click',function(event){
			event.preventDefault();
			$( "#deal" ).empty();
			var dealcode = $(this).attr('dealcode');
			var packagedeal = $(this);
			$.ajax({
				 url : 'deal-package',
				 data:{"code":dealcode},
				 type: 'GET',
				 beforeSend: function(){
					// Show image container
					packagedeal.next().show();
				 },
				 success: function(data){
					 //alert(data);
					 $('#deal').html(data); //return correct data
					 $("#changeRoom1").modal('show');
				 },
				 complete:function(data){
					// Hide image container
					packagedeal.next().hide();
				 }
			});
		});
		// Redirect Rate functionality	
		$(this).find('.package-redirect').on('click',function(event){
			event.preventDefault();
			var ratecode = $(this).attr('rateplancode');
			var ratetype = $(this).attr('rateplantype');
			var ratename = $(this).attr('rateplanname');
			var totalRoomCount = $(this).attr('totalRoomCount');
			var roomCounter = $(this).attr('roomCounter');
			roomCounter++;
			roomcount = roomCounter;
			if(roomcount == totalRoomCount){
				var redirect = 'Nextpage';
			}else{
				var redirect = 'previouspage';
			}
			//$(this).off("click").attr('href', "javascript: void(0);"); // To prevent double click
			$('.dealpackages').find('.package-redirect').css('pointer-events', 'none').css('cursor', 'default'); // To prevent double click
			$.ajax({
				url : 'package-redirect',
				data:{"code":ratecode, "rtype":ratetype, "rname":ratename, "rcount":roomcount},
				type: 'GET',
				success: function(data){
					var getRes = JSON.parse(data);
					if(typeof getRes.errors =='object'){
						var errormessage = getRes.errors[0].errorMessage;
						if(errormessage.length > 0){
							alert(errormessage);
							window.location='reservation/booking';
						}
					}else{
						if(redirect == 'Nextpage'){
							window.location='reservation/confirm-stay';
						}else{
							window.location='reservation/booking';
						}
					}
				},
				error: function(request, textStatus, errorThrown) {
					//alert(jqXHR.status);
					//alert(textStatus);
					alert(request.responseText);
				}
			});
		});
	});
	// Ajax for Select Rate button rate details popup - Deal & Packages	
	$(document).on('click', '.selectdeal', function(){ 
		event.preventDefault();
		var ratecode = $(this).attr('rateplancode');
		var ratetype = $(this).attr('rateplantype');
		var ratename = $(this).attr('rateplanname');
		var totalRoomCount = $(this).attr('totalRoomCount');
		var roomCounter = $(this).attr('roomCounter');
		roomCounter++;
		roomcount = roomCounter;
		if(roomcount == totalRoomCount){
			var redirect = 'Nextpage';
		}else{
			var redirect = 'previouspage';
		}
		$(this).off("click").attr('href', "javascript: void(0);"); // To prevent double click
		$(this).css('pointer-events', 'none').css('cursor', 'default');
		$.ajax({
			url : 'package-redirect',
			data:{"code":ratecode, "rtype":ratetype, "rname":ratename, "rcount":roomcount},
			type: 'GET',
			success: function(data){
				var getRes = JSON.parse(data);
				if(typeof getRes.errors =='object'){
					var errormessage = getRes.errors[0].errorMessage;
					if(errormessage.length > 0){
						alert(errormessage);
						window.location='reservation/booking';
					}
				}else{
					if(redirect == 'Nextpage'){
						window.location='reservation/confirm-stay';
					}else{
						window.location='reservation/booking';
					}
				}
			},
			error: function(request, textStatus, errorThrown) {
				//alert(jqXHR.status);
				//alert(textStatus);
				alert(request.responseText);
			}
		});
	});
	// Ajax for clicking on Select room button - Select rate redirection
	$('.roombooking').each(function(){
		var roombooking=$(this);
			
		$(this).find(".selectroom").on('click',function(event){
			   event.preventDefault();
			var title=roombooking.find('.roomtitle').text().trim();
			var roomtypecode=roombooking.find('.roomtypecode').text().trim();
			var path=drupalSettings.path.baseUrl;
			var baseurl = window.location.origin;
            var base_path= baseurl+path;
			//alert(base_path);
			
			
			//alert(roomtypecode);
			$.ajax({
				 url : base_path+'room-redirect',
				 data:{"title":title,"roomtypecode":roomtypecode},
				 type: 'GET',
				 
				 beforeSend: function(){
					// Show image container
					roombooking.find('.roomgif').show();
				 },
				 success: function(data){
					 //alert(data);
					 window.location=base_path+'select-rate';
				 },
				 complete:function(data){
					// Hide image container
					roombooking.find('.roomgif').hide();
				 }
			});
			
		});
	});
});