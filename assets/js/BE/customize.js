//customize script
jQuery(function(){
	// disable and enable form in customize module
	var vwp = 0;
	jQuery('.view_customize select, .view_customize input[type="text"], .view_customize textarea').prop("disabled", true);
	jQuery('.view_enable_customize').bind("click", function(){
		if( vwp == 0 ){ 
			jQuery('.view_customize select, .view_customize input[type="text"], .view_customize textarea').prop("disabled", false);
			jQuery(".view_enable_customize").text("Disable from Editing");
			vwp = 1;
		}else if( vwp == 1 ){ 
			jQuery('.view_customize select, .view_customize input[type="text"], .view_customize textarea').prop("disabled", true);
			jQuery(".view_enable_customize").text("Enable for editing");
			vwp = 0;
		}
	});
	// while submit form...
	jQuery(".view_customize").bind("submit", function(){
		jQuery('.view_customize select, .view_customize input[type="text"], .view_customize textarea').prop("disabled", false);
	});

	// for add activities in the customize module
	jQuery(".actCusconOnchange").bind("change", function(e){
		e.preventDefault();
		var dateOfCuscon = jQuery("#cuscon-date").val();
		var url_SubEp = jQuery(this).attr("data-url");
		url_SubEp = url_SubEp+'customize/viewSubEp';
		var request = jQuery.ajax({
				url: url_SubEp,
				type: "POST",
				datatype: "html",
				data:{
					'cuscon_act_id' : jQuery(this).val(),
					'dateofcuscon'  : dateOfCuscon
				}, 
				success:function(response){
					jQuery("#display_sub_ep_activities").html(response);
				}
			});
		request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller activities.php		
			alert("connecting failed...");
		});
	});

	// for add accommodation in the customize module
	jQuery(".accCusconOnchange").bind("change", function(e){
		e.preventDefault();
		var dateOfCuscon = jQuery("#cuscon-date").val();
		var url_SubEp = jQuery(this).attr("data-url");
		url_SubEp = url_SubEp+'customize/viewSubEpAcc';
		var request = jQuery.ajax({
				url: url_SubEp,
				type: "POST",
				datatype: "html",
				data:{
					'cuscon_acc_id' : jQuery(this).val(),
					'dateofcuscon'  : dateOfCuscon
				}, 
				success:function(response){
					jQuery("#display_sub_ep_accommodation").html(response);
				}
			});
		request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller activities.php		
			alert("connecting failed...");
		});
	});

	// for add accommodation in the customize module
	jQuery(".tpsCusconOnchange").bind("change", function(e){
		e.preventDefault();
		var dateOfCuscon = jQuery("#cuscon-date").val();
		var url_SubEp = jQuery(this).attr("data-url");
		url_SubEp = url_SubEp+'customize/viewSubEpTps';
		var request = jQuery.ajax({
				url: url_SubEp,
				type: "POST",
				datatype: "html",
				data:{
					'cuscon_tps_id' : jQuery(this).val(),
					'dateofcuscon'  : dateOfCuscon
				}, 
				success:function(response){
					jQuery("#display_sub_ep_transport").html(response);
				}
			});
		request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller activities.php		
			alert("connecting failed...");
		});
	});
	// check main activities, than have action on subactivities and extraproduct
	jQuery("#accordion").on("click", ".act_click", function(){
		var parentsubep = jQuery(this).attr('data-subchecked');
		subep = parentsubep + ' .check_checkbox';
		if(jQuery(this).is( ":checked" )){
			jQuery(subep).prop('checked', true);
		}else{
			jQuery(subep).prop('checked', false);			
		}
	});

	// check main accommodation, than have action on subaccommodation and extraproduct
	jQuery('.acc_click').bind('click', function(){
		var parentsubep = jQuery(this).attr('data-subchecked');
		subep = parentsubep + ' .check_checkbox';
		if(jQuery(this).is( ":checked" )){
			jQuery(subep).prop('checked', true);
		}else{
			jQuery(subep).prop('checked', false);			
		}
	});


	jQuery('.checkbox_all_cuscon_act, .checkbox_all_cuscon_tps, .checkbox_all_cuscon_acc, .checkbox_all_cuscon_epacc, .checkbox_all_cuscon_epact, .checkbox_all_cuscon_eptps').bind('click', function(){
		var parentsubep = jQuery(this).attr('data-id');
		subep = parentsubep + ' .check_checkbox';
		if(jQuery(this).is( ":checked" )){
			jQuery(subep).prop('checked', true);
		}else{
			jQuery(subep).prop('checked', false);			
		}
	});

	// check main transportation, than have action on subtransportation and extraproduct
	jQuery('.tp_click').bind('click', function(){
		var parentsubep = jQuery(this).attr('data-subchecked');
		subep = parentsubep + ' .check_checkbox';
		if(jQuery(this).is( ":checked" )){
			jQuery(subep).prop('checked', true);
		}else{
			jQuery(subep).prop('checked', false);			
		}
	});
	// check all checkbox sub view add activities
	jQuery("#display_sub_ep_activities, #display_sub_ep_accommodation, #display_sub_ep_transport").on("click", ".checkallsub", function(){
		if(jQuery(this).is( ":checked" )){
			jQuery(".checksuballtd").prop('checked', true);
		}else{
			jQuery(".checksuballtd").prop('checked', false);			
		}
	});

	// check all checkbox extraproduct view add activities
	jQuery("#display_sub_ep_activities, #display_sub_ep_accommodation, #display_sub_ep_transport").on("click", ".checkallep", function(){
		if(jQuery(this).is( ":checked" )){
			jQuery(".checkepalltd").prop('checked', true);
		}else{
			jQuery(".checkepalltd").prop('checked', false);			
		}
	});
	// form pop up submit while add activities
	jQuery(".frm_cuscon_act").bind('submit', function(){
		var actname = jQuery('.actOnchange').val(); 
		if(actname == ""){
			alert('The activities name is required...');
			return false;
		}
	});
	// form pop up submit while add accommodation
	jQuery(".frm_cuscon_acc").bind('submit', function(){
		var actname = jQuery('.accOnchange').val(); 
		if(actname == ""){
			alert('The accommodation name is required...');
			return false;
		}
	});
	// form pop up submit while add accommodation
	jQuery(".frm_cuscon_tps").bind('submit', function(){
		var actname = jQuery('.tpsOnchange').val(); 
		if(actname == ""){
			alert('The transportation ame is required...');
			return false;
		}
	});
	// detail of activities, accommodation and transportation 
	jQuery('.clickDetailact, .clickDetailsubact, .clickDetailep, .clickDetailacc, .clickDetailsubacc, .clickDetailtp, .clickDetailsubtps').bind('click',function(){
		var urlrequest = jQuery(this).attr('data-url');
		var request = jQuery.ajax({
				url: urlrequest,
				type: "POST",
				datatype: "html",
				success:function(response){
					jQuery(".modal-detail-body").html(response);
				}
			});
		request.fail(function( jqXHR, textStatus ) { // fail connect to a function in controller activities.php		
			alert("connecting failed...");
		});
	});
}); 	



// Customize booking on FE with validation of form
$(function() {
	// Check passenger exists in Customize FE
	var num_success = 1;
	$("body").on("click", "input[name='btnPersonalInfoModal']", function(event) {
		var url = $('form[name="frm_personal_info_modal"]').attr("action");
		var data = $('form[name="frm_personal_info_modal"]').serialize();
		var msg = validateEmptyFields();
		if(msg) {
	        var div_sms = '<div class="alert alert-danger alert-dismissable">';
			div_sms += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
			div_sms += '<strong>Error!</strong> '+msg;
			div_sms += '</div>';
			$("div#feedback_bar_modal").append(div_sms);
			setTimeout(function()
	        {
	            $('#each_personalInfo_feedback').slideUp(250, function()
	            {
	                $('#each_personalInfo_feedback').removeClass();
	            });
	        },msg.length*125);

	        return false;
	    }

		if (num_success >= $('input#add_pass_amount_pass').val()) {
			var text = 'You cannot add more passenger than amount you selected.';
			var div_sms = '<div class="alert alert-warning alert-dismissable">';
			div_sms += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
			div_sms += '<strong>Sorry</strong> '+text;
			div_sms += '</div>';
			$("div#feedback_bar_modal").append(div_sms);
			setTimeout(function()
            {
                $('#each_personalInfo_feedback').slideUp(250, function()
                {
                    $('#each_personalInfo_feedback').removeClass();
                });
            },text.length*125);

            return false;
		} else {
			// checkExistsEmail(check_url, email);
			$.ajax({
				type: "POST",
				url: url,
				dataType: "json",
				data: data,
				success: function(response) {
					if (response.sms_type == 'success') {
						num_success = num_success + 1;
					};
					if (response) {
						var div_sms = '<div class="alert alert-'+response.sms_type+' alert-dismissable">';
						div_sms += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
						div_sms += '<strong>'+response.sms_title+'</strong> '+response.sms_value;
						div_sms += '</div>';
						$("div#feedback_bar_modal").append(div_sms);
						setTimeout(function()
			            {
			                $('#each_personalInfo_feedback').slideUp(250, function()
			                {
			                    $('#each_personalInfo_feedback').removeClass();
			                });
			            },response.sms_value.length*125);
					}
				}
			});
		}
		event.preventDefault();
	});

	// Check validation of Email
	$('.input_email').focusout(function(e) {
        $(this).parent().next().children(":first").remove();
        var sEmail = $(this).val();
        if ($.trim(sEmail).length == 0) {
            $(this).parent().next().append("<span class='error'>Cannot be empty.</span>");
            e.preventDefault();
        } else if (validateEmail(sEmail)) {
        	var url = $('form[name="frm_personal_info_modal"]').attr("action");
			var check_url = url.replace('customize_more_passenger', 'checkExistPassengerByEmail');
			checkExistsEmail(check_url, $(this).val());

        	$(this).parent().next().append("<span class='success'>Email look like good.</span>");
        }
        else {
            $(this).parent().next().append("<span class='error'>Invalid Email Address.</span>");
            e.preventDefault();
        }
    });

	$('.input_require').focusout(function(e) {
        $(this).parent().next().children(":first").remove();
        var value = $(this).val();
        if ($.trim(value).length == 0) {
            $(this).parent().next().append("<span class='error'>Cannot be empty.</span>");
            e.preventDefault();
        }
    });

	// Start for each member booking info
	$("body").on('click', "input[name='btnEachPersonalInfo']", function(event) {
		alert('hhhii');
		event.preventDefault();
		var url = $(this).parent().attr('action');
		var data = $(this).parent().serialize();
		$.ajax({
			type: "POST",
			url: url,
			dataType: "json",
			data: data,
			success: function(response) {
				if (response) {
					var div_sms = '<div class="alert alert-'+response.sms_type+' alert-dismissable">';
					div_sms += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					div_sms += '<strong>'+response.sms_title+'</strong> '+response.sms_value;
					div_sms += '</div>';
					$("div#each_personalInfo_feedback").append(div_sms);
					setTimeout(function()
		            {
		                $('#each_personalInfo_feedback').slideUp(250, function()
		                {
		                    $('#each_personalInfo_feedback').removeClass();
		                });
		            },response.sms_value.length*125);
				}	
			}
		});
	});

	//Click on close button on add more passenger on BE
	$('body').on('click', 'button#close', function() {
		window.location.reload(true);
	})


});

// Validate Email input
function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    } else {
        return false;
    }
}

// Check exists passenger by email
function checkExistsEmail(url, data) {
	$.ajax({
		type: 'POST',
		url: url,
		dataType: 'json',
		data: {'email':data},
		success: function(response) {
			if (response) {
				var div_sms = '<div class="alert alert-'+response.sms_type+' alert-dismissable">';
				div_sms += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
				div_sms += '<strong>'+response.sms_title+'</strong> '+response.sms_value;
				div_sms += '</div>';
				$("div#feedback_bar_modal").append(div_sms);
				setTimeout(function()
	            {
	                $('#each_personalInfo_feedback').slideUp(250, function()
	                {
	                    $('#each_personalInfo_feedback').removeClass();
	                });
	            },response.sms_value.length*125);
			}
		}
	});
}

// Check empty input field
function validateEmptyFields()
{
    var msg= "",
        fields = document.getElementById("frm_personal_info_modal").getElementsByClassName('input_require');

    for (var i=0; i<fields.length; i++){
        if (fields[i].value == "") 
            msg += '<p>'+fields[i].title + ' is required. </p>';
    }
    return msg;
}
