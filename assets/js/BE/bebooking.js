//package script
jQuery(function(){
	// disable and enable form in package module
	var vwp = 0;
	jQuery('.frm_booking_view select, .frm_booking_view input[type="text"], .frm_booking_view textarea').prop("disabled", true);
	jQuery('.view_enable_booking').bind("click", function(){
		if( vwp == 0 ){ 
			jQuery('.frm_booking_view select, .frm_booking_view input[type="text"], .frm_booking_view textarea').prop("disabled", false);
			jQuery(".view_enable_booking").text("Disable from Editing");
			vwp = 1;
		}else if( vwp == 1 ){ 
			jQuery('.frm_booking_view select, .frm_booking_view input[type="text"], .frm_booking_view textarea').prop("disabled", true);
			jQuery(".view_enable_booking").text("Enable for editing");
			vwp = 0;
		}
	});
	// while submit form...
	jQuery(".frm_booking_view").bind("submit", function(){
		jQuery('.frm_booking_view select, .frm_booking_view input[type="text"], .frm_booking_view textarea').prop("disabled", false);
	});

	// // for add activities in the package module
	// jQuery(".actOnchange").bind("change", function(e){
	// 	e.preventDefault();
	// 	var dateOfPK = jQuery("#pk-date").val();
	// 	var url_SubEp = jQuery(this).attr("data-url");
	// 	url_SubEp = url_SubEp+'package/viewSubEp';
	// 	var request = jQuery.ajax({
	// 			url: url_SubEp,
	// 			type: "POST",
	// 			datatype: "html",
	// 			data:{
	// 				'pk_act_id' : jQuery(this).val(),
	// 				'dateofpk'  : dateOfPK
	// 			}, 
	// 			success:function(response){
	// 				jQuery("#display_sub_ep_activities").html(response);
	// 			}
	// 		});
	// 	request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller activities.php		
	// 		alert("connecting failed...");
	// 	});
	// });

	// // for add accommodation in the package module
	// jQuery(".accOnchange").bind("change", function(e){
	// 	e.preventDefault();
	// 	var dateOfPK = jQuery("#pk-date").val();
	// 	var url_SubEp = jQuery(this).attr("data-url");
	// 	url_SubEp = url_SubEp+'package/viewSubEpAcc';
	// 	var request = jQuery.ajax({
	// 			url: url_SubEp,
	// 			type: "POST",
	// 			datatype: "html",
	// 			data:{
	// 				'pk_acc_id' : jQuery(this).val(),
	// 				'dateofpk'  : dateOfPK
	// 			}, 
	// 			success:function(response){
	// 				jQuery("#display_sub_ep_accommodation").html(response);
	// 			}
	// 		});
	// 	request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller activities.php		
	// 		alert("connecting failed...");
	// 	});
	// });

	// // for add accommodation in the package module
	// jQuery(".tpsOnchange").bind("change", function(e){
	// 	e.preventDefault();
	// 	var dateOfPK = jQuery("#pk-date").val();
	// 	var url_SubEp = jQuery(this).attr("data-url");
	// 	url_SubEp = url_SubEp+'package/viewSubEpTps';
	// 	var request = jQuery.ajax({
	// 			url: url_SubEp,
	// 			type: "POST",
	// 			datatype: "html",
	// 			data:{
	// 				'pk_tps_id' : jQuery(this).val(),
	// 				'dateofpk'  : dateOfPK
	// 			}, 
	// 			success:function(response){
	// 				jQuery("#display_sub_ep_transport").html(response);
	// 			}
	// 		});
	// 	request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller activities.php		
	// 		alert("connecting failed...");
	// 	});
	// });
	// // check main activities, than have action on subactivities and extraproduct
	// jQuery("#accordion").on("click", ".act_click", function(){
	// 	var parentsubep = jQuery(this).attr('data-subchecked');
	// 	subep = parentsubep + ' .check_checkbox';
	// 	if(jQuery(this).is( ":checked" )){
	// 		jQuery(subep).prop('checked', true);
	// 	}else{
	// 		jQuery(subep).prop('checked', false);			
	// 	}
	// });

	// // check main accommodation, than have action on subaccommodation and extraproduct
	// jQuery('.acc_click').bind('click', function(){
	// 	var parentsubep = jQuery(this).attr('data-subchecked');
	// 	subep = parentsubep + ' .check_checkbox';
	// 	if(jQuery(this).is( ":checked" )){
	// 		jQuery(subep).prop('checked', true);
	// 	}else{
	// 		jQuery(subep).prop('checked', false);			
	// 	}
	// });


	// jQuery('.checkbox_all_pk_act, .checkbox_all_pk_tps, .checkbox_all_pk_acc, .checkbox_all_pk_epacc, .checkbox_all_pk_epact, .checkbox_all_pk_eptps').bind('click', function(){
	// 	var parentsubep = jQuery(this).attr('data-id');
	// 	subep = parentsubep + ' .check_checkbox';
	// 	if(jQuery(this).is( ":checked" )){
	// 		jQuery(subep).prop('checked', true);
	// 	}else{
	// 		jQuery(subep).prop('checked', false);			
	// 	}
	// });

	// // check main transportation, than have action on subtransportation and extraproduct
	// jQuery('.tp_click').bind('click', function(){
	// 	var parentsubep = jQuery(this).attr('data-subchecked');
	// 	subep = parentsubep + ' .check_checkbox';
	// 	if(jQuery(this).is( ":checked" )){
	// 		jQuery(subep).prop('checked', true);
	// 	}else{
	// 		jQuery(subep).prop('checked', false);			
	// 	}
	// });
	// // check all checkbox sub view add activities
	// jQuery("#display_sub_ep_activities, #display_sub_ep_accommodation, #display_sub_ep_transport").on("click", ".checkallsub", function(){
	// 	if(jQuery(this).is( ":checked" )){
	// 		jQuery(".checksuballtd").prop('checked', true);
	// 	}else{
	// 		jQuery(".checksuballtd").prop('checked', false);			
	// 	}
	// });

	// // check all checkbox extraproduct view add activities
	// jQuery("#display_sub_ep_activities, #display_sub_ep_accommodation, #display_sub_ep_transport").on("click", ".checkallep", function(){
	// 	if(jQuery(this).is( ":checked" )){
	// 		jQuery(".checkepalltd").prop('checked', true);
	// 	}else{
	// 		jQuery(".checkepalltd").prop('checked', false);			
	// 	}
	// });
	// // form pop up submit while add activities
	// jQuery(".frm_pk_act").bind('submit', function(){
	// 	var actname = jQuery('.actOnchange').val(); 
	// 	if(actname == ""){
	// 		alert('The activities name is required...');
	// 		return false;
	// 	}
	// });
	// // form pop up submit while add accommodation
	// jQuery(".frm_pk_acc").bind('submit', function(){
	// 	var actname = jQuery('.accOnchange').val(); 
	// 	if(actname == ""){
	// 		alert('The accommodation name is required...');
	// 		return false;
	// 	}
	// });
	// // form pop up submit while add accommodation
	// jQuery(".frm_pk_tps").bind('submit', function(){
	// 	var actname = jQuery('.tpsOnchange').val(); 
	// 	if(actname == ""){
	// 		alert('The transportation ame is required...');
	// 		return false;
	// 	}
	// });
	// // detail of activities, accommodation and transportation 
	// jQuery('.clickDetailact, .clickDetailsubact, .clickDetailep, .clickDetailacc, .clickDetailsubacc, .clickDetailtp, .clickDetailsubtps').bind('click',function(){
	// 	var urlrequest = jQuery(this).attr('data-url');
	// 	var request = jQuery.ajax({
	// 			url: urlrequest,
	// 			type: "POST",
	// 			datatype: "html",
	// 			success:function(response){
	// 				jQuery(".modal-detail-body").html(response);
	// 			}
	// 		});
	// 	request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller activities.php		
	// 		alert("connecting failed...");
	// 	});
	// });
}); 	