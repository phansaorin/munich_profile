jQuery(document).ready(function(){
	// jQuery for menu manage
	jQuery(".mtitle").blur(function(){
		var menu_title = jQuery(".mtitle").val();
		menu_title = menu_title.replace(new RegExp(" ", 'g'), "_");
		jQuery(".maliase").val(menu_title);
	});
	// edit and add menu
	jQuery(".menu_add, .menu_edit").submit(function(){
		var title_menu = jQuery(".mtitle").val();
		if(title_menu == ""){
			jQuery(".mtitleError").show();
			return false;
		}else{
			jQuery(".mtitleError").hide();
			return true;
		}
	});
	// multiple delete from menu
	jQuery(".multi_delete").bind("click", function(e){
		e.preventDefault();
		var uri_checkbox = jQuery(".check_checkbox:checked").serialize();
		if(uri_checkbox != ""){
			if(confirm("Are you sure to delete the record?")){
				var uri_hidden = jQuery(".tdelete").attr("href");
				jQuery.ajax({
					url: uri_hidden,
					type: "POST",
					datatype: "text",
					data: uri_checkbox,
					success:function(response){
						if(response.trim() == "t"){
							window.location.reload(true);
						}
					}
				});
			}
		}else{
			alert('there is not any record was checked.');
		}
	});

	// multiple delete permanent from menu
	jQuery(".perm_delete").bind("click", function(e){
		e.preventDefault();
		var uri_checkbox = jQuery(".check_checkbox:checked").serialize();
		if(uri_checkbox != ""){
			if(confirm("Are you sure to delete the record?")){
				var uri_hidden = jQuery(".pdelete").attr("href");
				jQuery.ajax({
					url: uri_hidden,
					type: "POST",
					datatype: "text",
					data: uri_checkbox,
					success:function(response){
						if(response.trim() == "t"){
							window.location.reload(true);
						}
					}
				});
			}
		}else{
			alert('there is not any record was checked.');
		}
		$(function(){
        	$('ul > li > a[href=<?=$this->segment->uri(1)?>]').addClass('active');
    	});
	});
	// end of menu manage

	// check all checkbox
	jQuery("#checkbox_all").bind("click", function(){
		if(jQuery(this).is( ":checked" )){
			jQuery(".check_checkbox").prop('checked', true);
		}else{
			jQuery(".check_checkbox").prop('checked', false);			
		}
	});

	// script for tiny mce
	tinymce.init({
	    selector: ".cText",
	    menubar : false,
	    plugins: "link table",
    	tools: "inserttable"

	});
	// end of script for tinymce	
});





////////////////////////////////Style Menu sidebar//////////////////////////////////////////////////////////////
// $( document ).ready(function() {
// $('#cssmenu > ul > li > a').click(function() {
 // $('#cssmenu li').removeClass('active');
  //$(this).closest('li').addClass('active');	
  // var checkElement = $(this).next();

  // if((checkElement.is('ul'))) {
  //   $(this).closest('li').removeClass('active');
  //   checkElement.slideUp('normal');
  // }
  // if(false == $(this).next().is(':visible')){
  // 	$('#css > ul').slideUp(300);
  // }
  // $(this).next().slideToggle(300);
  // if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
  //   $(this).closest('li').removeClass('active');
  //   checkElement.slideUp('normal');
  // }
  // if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
  //   $('#cssmenu ul ul:visible').slideUp('normal');
  //   checkElement.slideDown('normal');
  // }
  // if($(this).closest('li').find('ul').children().length == 1) {
  //   return true;
  // } else {
  //   return false;	
  // }	
// });
// });

$('#cssmenu > ul > li > a').click(function() {
  $('#cssmenu li').removeClass('active');
  $(this).closest('li').addClass('active');	
  var checkElement = $(this).next();
  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
    $(this).closest('li').removeClass('active');
    checkElement.slideUp('normal');
  }
  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
    $('#cssmenu ul ul:visible').slideUp('normal');
    checkElement.slideDown('normal');
  }
  if($(this).closest('li').find('ul').children().length == 0) {
    return true;
  } else {
    return false;	
  }		
});


////////////////////////////////////////End Menu Sidebar///////////////////////////////////////////////

////////////////////////////////////////Dropdown Images of Photo///////////////////////////////////////
$(function()
{	
	$('#demo-htmlselect-basic').ddslick();
});
////////////////////////////////////////End Dropdown Images of Photo///////////////////////////////////