// transportation script
jQuery(function(){
	jQuery('.view_transportation textarea, .view_transportation select, .view_transportation input[type="text"], .view_transportation input[type="checkbox"]').prop("disabled", true);
	// check all checkbox for transportation
	jQuery("#everyday").bind("click", function(){
		if(jQuery(this).is( ":checked" )){
		jQuery(".weekday").prop('disabled', true);
		}else{
		jQuery(".weekday").prop('disabled', false);
		}
	});
	// check all checkbox for with add sub transportation
	jQuery(".everyday").bind("click", function(){
		if(jQuery(this).is( ":checked" )){
		jQuery(".day").prop('disabled', true);
		}else{
		jQuery(".day").prop('disabled', false);
		}
	});

	// view detail of transportation
	jQuery(".eachTransportationView").bind("click",function(e){
		e.preventDefault();
		var url_transportation = jQuery(this).attr("href");
		var request = jQuery.ajax({
				url: url_transportation,
				type: "POST",
				datatype: "html",
				success:function(response){
					if(response){
						jQuery(".modal-transportation-body").html(response);
					}
				}
			});
		request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller transportation.php		
			jQuery(".modal-transportation-body").html("Connecting failed...");
		});
	}); // end of detail

	
	// view detail of subtransportation
	jQuery(".sub_body").on("click",".eachTransportationSubView",function(e){
		e.preventDefault();
		var url_transportation = jQuery(this).attr("href");
		var request = jQuery.ajax({
				url: url_transportation,
				type: "POST",
				datatype: "html",
				success:function(response){
					if(response){
						jQuery(".modal-transportation-body").html(response);
					}
				}
			});
		request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller transportation.php		
			jQuery(".modal-transportation-body").html("Connecting failed...");
		});
	}); // end of detail
	// delete subtransportation
	jQuery(".sub_body").on("click",".deleteEACHtransportation",function(e){
		e.preventDefault();
		var url_transportation = jQuery(this).attr("href");
		var removeClass = jQuery(this).attr('data-remove');
		removeClass = '.'+removeClass;
		var request = jQuery.ajax({
				url: url_transportation,
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
		request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller transportation.php		
			alert("Could not connecting...");
			return false;
		});
		return false;
	});

	// to enable the form in the view functionality
	var vw = 0;
	jQuery(".view_enable").bind("click", function(){
		if( vw == 0 ){ 
			jQuery('.view_transportation textarea, .view_transportation select, .view_transportation input[type="text"], .view_transportation input[type="checkbox"]').prop("disabled", false);
			jQuery(".view_enable").text("Disable from Editing");
			vw = 1;
		}else if( vw == 1 ){ 
			jQuery('.view_transportation textarea, .view_transportation select, .view_transportation input[type="text"], .view_transportation input[type="checkbox"]').prop("disabled", true);
			jQuery(".view_enable").text("Enable for editing");
			vw = 0;
		}
	});
	// view detail of extraproduct
	jQuery(".extra_body").on("click",".extraTpsModalview",function(e){
		e.preventDefault();
		var url_extp = jQuery(this).attr("href");
		var request = jQuery.ajax({
				url: url_extp,
				type: "POST",
				datatype: "html",
				success:function(response){
					if(response){
						jQuery(".modal-transportation-body").html(response);
					}
				}
			});
		request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller transportation.php		
			jQuery(".modal-transportation-body").html("Connecting failed...");
		});
	}); // end of detail
	// while submit form...
	jQuery(".view_transportation").bind("submit", function(){
		jQuery('.view_transportation textarea, .view_transportation select, .view_transportation input[type="text"], .view_transportation input[type="checkbox"]').prop("disabled", false);
	
	});
});

// onload function 
jQuery(function(){
	jQuery( window ).load(function() {
		if(jQuery('.view_transportation input[name="tp_subof"]').val()){
			var request = jQuery.ajax({
				url: jQuery('.view_transportation input[name="sub_deteted"]').val(),
				type: "POST",
				data: { 'tp_id' : jQuery('.view_transportation input[name="tp_subof"]').val() },
				datatype: "text",
				success:function(response){}
			});
			request.fail(function( jqXHR, textStatus ) {  // fail connect to a function in controller transportation.php		
				alert("connecting field... here")
			});
		}
	});
});
	

	