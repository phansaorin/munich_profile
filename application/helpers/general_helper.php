<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Generates include javascript
 *
 * @access	public
 * @param	string
 * @param	string
 * @return	string
 */
if (!function_exists('include_js')) {

	function include_js($src = '', $type='text/javascript', $language = '') {
		$CI = & get_instance();
		$scripts = '';
		if (is_array($src)) {
			for ($i = 0; $i < count($src); $i++) {
				$scripts .= '<script src="' . $CI->config->site_url($src[$i]) . '" type="'.$type.'"></script>';
			}
		} else {
			$scripts = '<script src="' . $CI->config->site_url($src) . '" type="'.$type.'"></script>';
		}
		return $scripts;
	}
}

/*
	@: show message error
*/
if ( ! function_exists('show_message'))
{
	function show_message($msg, $type){
		
		$messge = "";
		$class = "";
		if ( $type === "error" ) {
			$class = "error";
		} elseif ( $type === "success" ) {
			$class = "success";
		} elseif ($type === 'notice'){
			$class = 'notice';
		}elseif($type === 'hiddens'){
			$class = 'hiddens';
		} else {
			$class = 'warning';
		}
		$messge .= '<dl id="system-message"><dd class="'.$class.' message"><ul><li>';
		$messge .= $msg;
		$messge .='</li></ul></dd></dl>';
		return $messge;
	}
}
		if ( !function_exists('recursive_element'))  {  
	   function recursive_element($needle,$haystack) {  
	    foreach($haystack as $key=>$value) {  
	      $current_key=$key;  
	      if($needle === $value   
	        OR (is_array($value)   
	          && recursive_element($needle,$value) !== false)) {  
	        return $current_key;  
	      }  
	    }  
	    return false;  
	  }  
}


//selected country would be retrieved from a database or as post data
function  country_dropdown($name, $id, $class, $selected_country,$top_countries=array(), $all, $selection=NULL, $show_all=TRUE ){
    // You may want to pull this from an array within the helper
    $countries = config_item('country_list');

    $html = "<select name='{$name}' id='{$id}' class='{$class}'>";
    $selected = NULL;
    if(in_array($selection,$top_countries)){
        $top_selection = $selection;
        $all_selection = NULL;
    }else{
        $top_selection = NULL;
        $all_selection = $selection;
    }
    if(!empty($selected_country)&&$selected_country!='all'&&$selected_country!='select'){
        $html .= "<optgroup label='Selected Country'>";
        if($selected_country === $top_selection){
            $selected = "SELECTED";
        }
        $html .= "<option value='{$selected_country}'{$selected}>{$countries[$selected_country]}</option>";
        $selected = NULL;
        $html .= "</optgroup>";
    }else if($selected_country=='all'){
        $html .= "<optgroup label='Selected Country'>";
        if($selected_country === $top_selection){
            $selected = "SELECTED";
        }
        $html .= "<option value='all'>All</option>";
        $selected = NULL;
        $html .= "</optgroup>";
    }else if($selected_country=='select'){
        $html .= "<optgroup label='Selected Country'>";
        if($selected_country === $top_selection){
            $selected = "SELECTED";
        }
        $html .= "<option value='select'>Select</option>";
        $selected = NULL;
        $html .= "</optgroup>";
    }
    if(!empty($all)&&$all=='all'&&$selected_country!='all'){
        $html .= "<option value='all'>All</option>";
        $selected = NULL;
    }
    if(!empty($all)&&$all=='select'&&$selected_country!='select'){
        $html .= "<option value='select'>Select</option>";
        $selected = NULL;
    }

    if(!empty($top_countries)){
        $html .= "<optgroup label='Top Countries'>";
        foreach($top_countries as $value){
            if(array_key_exists($value, $countries)){
                if($value === $top_selection){
                    $selected = "SELECTED";
                }
            $html .= "<option value='{$value}'{$selected}>{$countries[$value]}</option>";
            $selected = NULL;
            }
        }
        $html .= "</optgroup>";
    }

    if($show_all){
        $html .= "<optgroup label='All Countries'>";
        foreach($countries as $key => $country){
            if($key === $all_selection){
                $selected = "SELECTED";
            }
            $html .= "<option value='{$key}'{$selected}>{$country}</option>";
            $selected = NULL;
        }
        $html .= "</optgroup>";
    }

    $html .= "</select>";
    return $html;
}


/* End of file general_helper.php */
/* Location: ./application/helpers/general_helper.php */
