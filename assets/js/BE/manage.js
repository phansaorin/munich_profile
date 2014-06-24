// activities script
jQuery(function(){
	jQuery('.view_activities textarea, .view_activities select, .view_activities input[type="text"], .view_activities input[type="checkbox"]').prop("disabled", true);
	// check all checkbox for activities
	jQuery("#everyday").bind("click", function(){
		if(jQuery(this).is( ":checked" )){
		jQuery(".weekday").prop('disabled', true);
		}else{
		jQuery(".weekday").prop('disabled', false);
		}
	});
	// check all checkbox for with add sub activities
	jQuery(".everyday").bind("click", function(){
		if(jQuery(this).is( ":checked" )){
		jQuery(".day").prop('disabled', true);
		}else{
		jQuery(".day").prop('disabled', false);
		}
	});

	// view detail of activities
	jQuery(".eachActivitiesView").bind("click",function(e){
		e.preventDefault();
		var url_activities = jQuery(this).attr("href");
		var request = jQuery.ajax({
				url: url_activities,
				type: "POST",
				datatype: "html",
				success:function(response){
					if(response){
						jQuery(".modal-activities-body").html(response);
					}
				}
			});
		request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller activities.php		
			jQuery(".modal-activities-body").html("Connecting failed...");
		});
	}); // end of detail

	// add sub activities
	jQuery('.save_subof').bind("click", function(e){
		e.preventDefault();
		var datasubof = jQuery(".subof_add").serialize();
		var subofUrl = jQuery(".subof_add").attr('action');
		var request = jQuery.ajax({
				url: subofUrl,
				type: "POST",
				data: datasubof,
				datatype: "html",
				success:function(response){
					if(response.trim() != "required"){
						jQuery(".sub_body").append(response);
						jQuery(".subof_add")[0].reset();
						jQuery(".day").prop('disabled', false);
						alert('successfully add record...')
					}else{
						alert("field to add the record...");
					}
				}
			});
		request.fail(function( jqXHR, textStatus ) {  // fail connect to a function in controller activities.php		
			alert("Could not connecting...");
		});
		return false;
	});
	// view detail of subactivities
	jQuery(".sub_body").on("click",".eachActivitiesSubView",function(e){
		e.preventDefault();
		var url_activities = jQuery(this).attr("href");
		var request = jQuery.ajax({
				url: url_activities,
				type: "POST",
				datatype: "html",
				success:function(response){
					if(response){
						jQuery(".modal-activities-body").html(response);
					}
				}
			});
		request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller activities.php		
			jQuery(".modal-activities-body").html("Connecting failed...");
		});
	}); // end of detail
	// delete subactivities
	jQuery(".sub_body").on("click",".deleteEACHactivities",function(e){
		e.preventDefault();
		var url_activities = jQuery(this).attr("href");
		var removeClass = jQuery(this).attr('data-remove');
		removeClass = '.'+removeClass;
		var request = jQuery.ajax({
				url: url_activities,
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
		request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller activities.php		
			alert("Could not connecting...");
			return false;
		});
		return false;
	});

	// add extraproduct
	jQuery('.save_ep').bind("click", function(e){
		e.preventDefault();
		var dataep = jQuery(".ep_add").serialize();
		var epUrl = jQuery(".ep_add").attr('action');
		var request = jQuery.ajax({
				url: epUrl,
				type: "POST",
				data: dataep,
				datatype: "html",
				success:function(response){
					if(response.trim() != "required"){
						jQuery(".extra_body").append(response);
						jQuery(".ep_add")[0].reset();
						alert('successfully add the record...');
					}else{
						alert("failed to add the record...");
					}
				}
			});
		request.fail(function( jqXHR, textStatus ) {  // fail connect to a function in controller activities.php		
			alert("Could not connecting...");
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
						jQuery(".modal-activities-body").html(response);
					}
				}
			});
		request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller activities.php		
			jQuery(".modal-activities-body").html("Connecting failed...");
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
		request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller activities.php		
			alert("Could not connecting...");
			return false;
		});
		return false;
	});

	// to enable the form in the view functionality
	var vw = 0;
	jQuery(".view_enable").bind("click", function(){
		if( vw == 0 ){ 
			jQuery('.view_activities textarea, .view_activities select, .view_activities input[type="text"], .view_activities input[type="checkbox"]').prop("disabled", false);
			jQuery(".view_enable").text("Disable from Editing");
			vw = 1;
		}else if( vw == 1 ){ 
			jQuery('.view_activities textarea, .view_activities select, .view_activities input[type="text"], .view_activities input[type="checkbox"]').prop("disabled", true);
			jQuery(".view_enable").text("Enable for editing");
			vw = 0;
		}
	});
	// while submit form...
	jQuery(".view_activities").bind("submit", function(){
		jQuery('.view_activities textarea, .view_activities select, .view_activities input[type="text"], .view_activities input[type="checkbox"]').prop("disabled", false);
	
	});
});

// onload function 
jQuery(function(){
	jQuery( window ).load(function() {
		if(jQuery('.view_activities input[name="act_subof"]').val()){
			var request = jQuery.ajax({
				url: jQuery('.view_activities input[name="sub_deteted"]').val(),
				type: "POST",
				data: { 'act_id' : jQuery('.view_activities input[name="act_subof"]').val() },
				datatype: "text",
				success:function(response){}
			});
			request.fail(function( jqXHR, textStatus ) {  // fail connect to a function in controller activities.php		
				alert("connecting field... here")
			});
		}
	});
});
	

	