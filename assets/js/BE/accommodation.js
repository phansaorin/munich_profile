// accommodation script
jQuery(function(){
	jQuery('.view_accommodation textarea, .view_accommodation select, .view_accommodation input[type="text"], .view_accommodation input[type="checkbox"]').prop("disabled", true);
	// check all checkbox for activities
	jQuery("#everyday").bind("click", function(){
		if(jQuery(this).is( ":checked" )){
		jQuery(".weekday").prop('disabled', true);
		}else{
		jQuery(".weekday").prop('disabled', false);
		}
	});
	// check all checkbox for with add sub accommodation
	jQuery(".everyday").bind("click", function(){
		if(jQuery(this).is( ":checked" )){
		jQuery(".day").prop('disabled', true);
		}else{
		jQuery(".day").prop('disabled', false);
		}
	});

	// view detail of accommodation
	jQuery(".eachAccommodationView").bind("click",function(e){
		e.preventDefault();
		var url_accommodation = jQuery(this).attr("href");
		var request = jQuery.ajax({
				url: url_accommodation,
				type: "POST",
				datatype: "html",
				success:function(response){
					if(response){
						jQuery(".modal-accommodation-body").html(response);
					}
				}
			});
		request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller accommodation.php		
			jQuery(".modal-accommodation-body").html("Connecting failed...");
		});
	}); // end of detail

	
	// view detail of subaccommodation
	jQuery(".sub_body").on("click",".eachAccommodationSubView",function(e){
		e.preventDefault();
		var url_accommodation = jQuery(this).attr("href");
		var request = jQuery.ajax({
				url: url_accommodation,
				type: "POST",
				datatype: "html",
				success:function(response){
					if(response){
						jQuery(".modal-accommodation-body").html(response);
					}
				}
			});
		request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller accommodation.php		
			jQuery(".modal-accommodation-body").html("Connecting failed...");
		});
	}); // end of detail
	// delete subaccommodation
	jQuery(".sub_body").on("click",".deleteEACHaccommodation",function(e){
		e.preventDefault();
		var url_accommodation = jQuery(this).attr("href");
		var removeClass = jQuery(this).attr('data-remove');
		removeClass = '.'+removeClass;
		var request = jQuery.ajax({
				url: url_accommodation,
				type: "POST",
				datatype: "html",
				success:function(response){
					if(response.trim() == "t"){	
						alert('successfully deleted.');
					}else{
						alert('Sorry! the record cannot be deleted...');
						return false;
					}
				}
			});
		jQuery(this).closest(removeClass).remove();
		request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller accommodation.php		
			alert("Could not connecting...");
			return false;
		});
		return false;
	});

	// view detail of extraproduct
	jQuery(".extra_body").on("click",".extraModalview",function(e){
		e.preventDefault();
		var url_extp = jQuery(this).attr("href");
		var request = jQuery.ajax({
				url: url_extp,
				type: "POST",
				datatype: "html",
				success:function(response){
					if(response){
						jQuery(".modal-accommodation-body").html(response);
					}
				}
			});
		request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller accommodation.php		
			jQuery(".modal-accommodation-body").html("Connecting failed...");
		});
	}); // end of detail

	// delete extraproduct
	jQuery(".extra_body").on("click",".deleteEACHextraproduct",function(e){
		e.preventDefault();
		var url_ep = jQuery(this).attr("href");
		var removeClass = jQuery(this).attr('data-remove');	
		
		var request = jQuery.ajax({
				url: url_ep,
				type: "POST",
				datatype: "html",
				success:function(response){
					if(response.trim() == "t"){	
						alert('successfully deleted.');
					}else{
						alert('Sorry! the record cannot be deleted...');
						return false;
					}
				}
			});
		jQuery(this).closest(removeClass).remove();
		request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller accommodation.php		
			alert("Could not connecting...");
			return false;
		});
		return false;
	});

	// to enable the form in the view Accommadation
	var vw = 0;
	jQuery(".view_enable").bind("click", function(){
		if( vw == 0 ){ 
			jQuery('.view_accommodation textarea, .view_accommodation select, .view_accommodation input[type="text"], .view_accommodation input[type="checkbox"]').prop("disabled", false);
			jQuery(".view_enable").text("Disable from Editing");
			vw = 1;
		}else if( vw == 1 ){ 
			jQuery('.view_accommodation textarea, .view_accommodation select, .view_accommodation input[type="text"], .view_accommodation input[type="checkbox"]').prop("disabled", true);
			jQuery(".view_enable").text("Enable for editing");
			vw = 0;
		}
	});
	// while submit form...
	jQuery(".view_accommodation").bind("submit", function(){
		jQuery('.view_accommodation textarea, .view_accommodation select, .view_accommodation input[type="text"], .view_accommodation input[type="checkbox"]').prop("disabled", false);
	
	});
});

// onload function 
jQuery(function(){
	jQuery( window ).load(function() {
		if(jQuery('.view_accommodation input[name="acc_subof"]').val()){
			var request = jQuery.ajax({
				url: jQuery('.view_accommodation input[name="sub_deteted"]').val(),
				type: "POST",
				data: { 'acc_id' : jQuery('.view_accommodation input[name="acc_subof"]').val() },
				datatype: "text",
				success:function(response){}
			});
			request.fail(function( jqXHR, textStatus ) {  // fail connect to a function in controller accommodation.php		
				alert("connecting field... here")
			});
		}
	});
});
	