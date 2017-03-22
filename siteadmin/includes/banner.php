<?php
	//form submission
	$form_array = array();
	$errorMsg 	= "no";
	
	// Edit banner : Start here 
	if($_POST['securityKey']==md5("EDITPBANNER")){	
		if(trim($_POST['banner_title']) == '') {
			$form_array['banner_title_error'] = 'Banner title required';
			$errorMsg = 'yes';
		}
	
		if(trim($_POST['banner_desc']) == '') {
			$form_array['banner_desc_error'] = 'Banner description required';
			$errorMsg = 'yes';
		}
	
		if(trim($_POST['banner_link']) == '') {
			$form_array['banner_link_error'] = 'Banner link required';
			$errorMsg = 'yes';
		}
	
	   if($errorMsg == 'no' && $errorMsg != 'yes') {
			$banner_id 				= $_POST['banner_id'];
			$banner_title 			= $_POST['banner_title'];
			$banner_desc 			= $_POST['banner_desc'];
			$banner_link 			= $_POST['banner_link'];
			$start_date 			= $_POST['start_date'];
			$end_date 				= $_POST['end_date'];
			$banner_type 			= $_POST['banner_type'];
			$active 				= 1;
	
			if(isset($_FILES['banner_img']) && ($_FILES['banner_img']['name'] !="")) {
				$img 				= basename($_FILES['banner_img']['name']);
				$extn 				= @split("\.",$img);
				$banner_img 		= $banner_id."_banner.".$extn[1];
				$uploadbannerdir 	= '../upload/banners-logos/banners';
				$uploadbannerfile 	= $uploadbannerdir ."/". $banner_img;
				@move_uploaded_file($_FILES['banner_img']['tmp_name'], $uploadbannerfile);
			} else {
				$banner_img 		= $dbObj->getField(TABLE_BANNER, "banner_id", $banner_id, "banner_img");
			}
			$bannerObj->fun_editBanner($banner_id, $banner_title, $banner_desc, $banner_img, $banner_link, $banner_type, $start_date, $end_date, $active);
			$redirect_url 			= "admin-settings.php?sec=banner&action=edit&banner_id=".$banner_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}
	// Edit banner submit : End here 
	
	// add a new banner submit : Start here 
	if($_POST['securityKey']==md5("ADDBANNER")){	
	
		if(trim($_POST['banner_title']) == '') {
			$form_array['banner_title_error'] = 'Banner title required';
			$errorMsg = 'yes';
		}
	
		if(trim($_POST['banner_desc']) == '') {
			$form_array['banner_desc_error'] = 'Banner description required';
			$errorMsg = 'yes';
		}
	
		if(trim($_POST['banner_link']) == '') {
			$form_array['banner_link_error'] = 'Banner link required';
			$errorMsg = 'yes';
		}
	
		if($_FILES['banner_img']['name'] == '') {
			$form_array['banner_img_error'] = 'Banner photo required';
			$errorMsg = 'yes';
		}
	
		if($errorMsg == 'no' && $errorMsg != 'yes') {
			$banner_title 			= $_POST['banner_title'];
			$banner_desc 			= $_POST['banner_desc'];
			$banner_link 			= $_POST['banner_link'];
			$start_date 			= $_POST['start_date'];
			$end_date 				= $_POST['end_date'];
			$banner_type 			= $_POST['banner_type'];
			$active 				= 1;
	
			$banner_id 				= $bannerObj->fun_addBanner($banner_title, $banner_desc, $banner_img, $banner_link, $banner_type, $start_date, $end_date, $active);
			if(isset($_FILES['banner_img']) && ($_FILES['banner_img']['name'] !="")) {
				$img 				= basename($_FILES['banner_img']['name']);
				$extn 				= @split("\.",$img);
				$banner_img 		= $banner_id."_banner.".$extn[1];
				$uploadbannerdir 	= '../upload/banners-logos/banners';
				$uploadbannerfile 	= $uploadbannerdir ."/". $banner_img;
				@move_uploaded_file($_FILES['banner_img']['tmp_name'], $uploadbannerfile);
			} else {
				$banner_img 		= $dbObj->getField(TABLE_BANNER, "banner_id", $banner_id, "banner_img");
			}
			$bannerObj->fun_editBanner($banner_id, $banner_title, $banner_desc, $banner_img, $banner_link, $banner_type, $start_date, $end_date, $active);
			$redirect_url 			= "admin-settings.php?sec=banner&action=edit&banner_id=".$banner_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}
	// add a new banner submit : End here 
	

	if(isset($_GET['action']) && $_GET['action'] !="") {
		$banner_id = $_REQUEST['banner_id'];
		require_once(SITE_ADMIN_INCLUDES_PATH.'banner-form.php');
	} else {
		require_once(SITE_ADMIN_INCLUDES_PATH.'banner-list.php');
	}
?>
