<?php
/*
	$country_id = $_REQUEST['country_id'];
	$state_id	= $_REQUEST['state_id'];
	$city_id	= $_REQUEST['city_id'];
*/
	//form submission
	$form_array = array();
	$errorMsg 	= "no";

	// Edit Country submit : Start here 
	if($_POST['securityKey']==md5("EDITCOUNTRY")){	
		if(trim($_POST['country_name']) == '') {
			$form_array['country_name_error'] = 'Country name required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['country_desc']) == '') {
			$form_array['country_desc_error'] = 'Country Description required';
			$errorMsg = 'yes';
		}

	   if($errorMsg == 'no' && $errorMsg != 'yes') {
			$country_id			= $_POST['country_id'];
			$country_name		= $_POST['country_name'];
			$country_iso_code_2	= $_POST['country_iso_code_2'];
			$country_iso_code_3	= $_POST['country_iso_code_3'];
			$country_isd_code	= $_POST['country_isd_code'];
			$country_desc		= $_POST['country_desc'];
			$latitude			= $_POST['latitude'];
			$longitude			= $_POST['longitude'];
			$zoom_level			= $_POST['zoom_level'];
			// Edit Country
			$locationObj->fun_editCountry($country_id, $country_name, $country_iso_code_2, $country_iso_code_3, $country_isd_code, $country_desc, $latitude, $longitude, $zoom_level);
			$redirect_url 		= "admin-settings.php?sec=location&action=edit&country_id=".$country_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}
	// Edit Country submit : End here
	 
	// Add state submit : Start here 
	if($_POST['securityKey']==md5("ADDSTATE")){	
		if(trim($_POST['state_name']) == '') {
			$form_array['state_name_error'] = 'State name required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['country_id']) == '') {
			$form_array['country_id_error'] = 'Country required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['state_desc']) == '') {
			$form_array['state_desc_error'] = 'State Description required';
			$errorMsg = 'yes';
		}

	   if($errorMsg == 'no' && $errorMsg != 'yes') {
			$country_id	= $_POST['country_id'];
			$state_name	= $_POST['state_name'];
			$state_desc	= $_POST['state_desc'];
			$latitude	= $_POST['latitude'];
			$longitude	= $_POST['longitude'];
			$zoom_level	= $_POST['zoom_level'];
			// Edit state
			$state_id = $locationObj->fun_addState($country_id, $state_name, $state_desc, $latitude, $longitude, $zoom_level);
			$redirect_url 		= "admin-settings.php?sec=location&show=state&action=edit&state_id=".$state_id."&country_id=".$country_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}
	// Add state submit : End here 


	// Edit state submit : Start here 
	if($_POST['securityKey']==md5("EDITSTATE")){	
		if(trim($_POST['state_name']) == '') {
			$form_array['state_name_error'] = 'State name required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['country_id']) == '') {
			$form_array['country_id_error'] = 'Country required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['state_desc']) == '') {
			$form_array['state_desc_error'] = 'State Description required';
			$errorMsg = 'yes';
		}

	   if($errorMsg == 'no' && $errorMsg != 'yes') {
			$state_id	= $_POST['state_id'];
			$country_id	= $_POST['country_id'];
			$state_name	= $_POST['state_name'];
			$state_desc	= $_POST['state_desc'];
			$latitude	= $_POST['latitude'];
			$longitude	= $_POST['longitude'];
			$zoom_level	= $_POST['zoom_level'];
			// Edit state
			$locationObj->fun_editState($state_id, $country_id, $state_name, $state_desc, $latitude, $longitude, $zoom_level);
			$redirect_url 		= "admin-settings.php?sec=location&show=state&action=edit&state_id=".$state_id."&country_id=".$country_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}
	// Edit state submit : End here 


	// Add city submit : Start here 
	if($_POST['securityKey']==md5("ADDCITY")){	
		if(trim($_POST['city_name']) == '') {
			$form_array['city_name_error'] = 'City name required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['state_id']) == '') {
			$form_array['state_id_error'] = 'State required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['city_desc']) == '') {
			$form_array['city_desc_error'] = 'City description required';
			$errorMsg = 'yes';
		}

	   if($errorMsg == 'no' && $errorMsg != 'yes') {
			$state_id	= $_POST['state_id'];
			$city_name	= $_POST['city_name'];
			$city_desc	= $_POST['city_desc'];
			$latitude	= $_POST['latitude'];
			$longitude	= $_POST['longitude'];
			$zoom_level	= $_POST['zoom_level'];
			$status		= $_POST['status'];
			// Edit city
			$city_id = $locationObj->fun_addCity($state_id, $city_name, $city_desc, $latitude, $longitude, $zoom_level, $status);
			$redirect_url 		= "admin-settings.php?sec=location&show=city&action=edit&city_id=".$city_id."&state_id=".$state_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}
	// Add city submit : End here 

	// Edit city submit : Start here 
	if($_POST['securityKey']==md5("EDITCITY")){	
		if(trim($_POST['city_name']) == '') {
			$form_array['city_name_error'] = 'City name required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['state_id']) == '') {
			$form_array['state_id_error'] = 'State required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['city_desc']) == '') {
			$form_array['city_desc_error'] = 'City Description required';
			$errorMsg = 'yes';
		}

	   if($errorMsg == 'no' && $errorMsg != 'yes') {
			$city_id	= $_POST['city_id'];
			$state_id	= $_POST['state_id'];
			$city_name	= $_POST['city_name'];
			$city_desc	= $_POST['city_desc'];
			$latitude	= $_POST['latitude'];
			$longitude	= $_POST['longitude'];
			$zoom_level	= $_POST['zoom_level'];
			$status		= $_POST['status'];
			// Edit city
			$locationObj->fun_editCity($city_id, $state_id, $city_name, $city_desc, $latitude, $longitude, $zoom_level, $status);
			$redirect_url 		= "admin-settings.php?sec=location&show=city&action=edit&city_id=".$city_id."&state_id=".$state_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}
	// Edit city submit : End here 

	//Includes inner pages
	if(isset($_GET['action']) && $_GET['action'] !=""){
		if(isset($_GET['show']) && $_GET['show'] == "city") {
			$addtitle 		= "Manage City";
			$city_id		= $_REQUEST['city_id'];
			$state_id		= $_REQUEST['state_id'];
			$country_id 	= $locationObj->fun_getStateCountryIdById($state_id);
			$state_name 	= $locationObj->fun_getStateNameById($state_id);
			$country_name 	= $locationObj->fun_getCountryNameById($country_id);
			include(SITE_ADMIN_INCLUDES_PATH.'city-form.php');
		} else if(isset($_GET['show']) && $_GET['show'] == "state") {
			$addtitle 		= "Manage State";
			$state_id		= $_REQUEST['state_id'];
			$country_id 	= $_REQUEST['country_id'];
			$country_name 	= $locationObj->fun_getCountryNameById($country_id);
			include(SITE_ADMIN_INCLUDES_PATH.'state-form.php');
		} else {
			$addtitle 		= "Manage Country";
			$country_id 	= $_REQUEST['country_id'];
			$country_name 	= $locationObj->fun_getCountryNameById($country_id);
			include(SITE_ADMIN_INCLUDES_PATH.'country-form.php');
		}
	
	} else {
		if(isset($_GET['show']) && $_GET['show'] == "city") {
			$addtitle 		= "Manage City";
			$state_id		= $_GET['state_id'];
			$country_id 	= $locationObj->fun_getStateCountryIdById($state_id);
			$state_name 	= $locationObj->fun_getStateNameById($state_id);
			$country_name 	= $locationObj->fun_getCountryNameById($country_id);
			include(SITE_ADMIN_INCLUDES_PATH.'city-list.php');
		} else if(isset($_GET['show']) && $_GET['show'] == "state") {
			$addtitle 		= "Manage State";
			$country_id 	= $_GET['country_id'];
			$country_name 	= $locationObj->fun_getCountryNameById($country_id);
			include(SITE_ADMIN_INCLUDES_PATH.'state-list.php');
		} else {
			$addtitle = "Manage Country";
			include(SITE_ADMIN_INCLUDES_PATH.'country-list.php');
		}
	}
?>