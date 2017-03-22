<?php
	//form submission
	$form_array = array();
	$errorMsg 	= "no";

	// Add SEO: Start here 
	if($_POST['securityKey']==md5("ADDSEO")){	
		if(trim($_POST['seo_url']) == '') {
			$form_array['seo_url_error'] = 'SEO link required';
			$errorMsg = 'yes';
		}
		if(trim($_POST['seo_title']) == '') {
			$form_array['seo_title_error'] = 'SEO title required';
			$errorMsg = 'yes';
		}
		if(trim($_POST['seo_keywords']) == '') {
			$form_array['seo_keywords_error'] = 'SEO keywords required';
			$errorMsg = 'yes';
		}
		if(trim($_POST['seo_description']) == '') {
			$form_array['seo_description_error'] = 'SEO description required';
			$errorMsg = 'yes';
		}
		if($errorMsg == 'no' && $errorMsg != 'yes') {
			$seo_url		= $_POST['seo_url'];
			$seo_title		= $_POST['seo_title'];
			$seo_keywords 	= $_POST['seo_keywords'];
			$seo_description= $_POST['seo_description'];
			$active			= $_POST['active'];
			$seo_id 		= $seoObj->fun_addSeo($seo_url, $seo_title, $seo_keywords, $seo_description, $active);
			$redirect_url 		= "admin-settings.php?sec=seo&action=edit&seo_id=".$seo_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}
	// Add SEO: End here 

	// Edit SEO: Start here 
	if($_POST['securityKey']==md5("EDITSEO")){	
		if(trim($_POST['seo_url']) == '') {
			$form_array['seo_url_error'] = 'SEO link required';
			$errorMsg = 'yes';
		}
		if(trim($_POST['seo_title']) == '') {
			$form_array['seo_title_error'] = 'SEO title required';
			$errorMsg = 'yes';
		}
		if(trim($_POST['seo_keywords']) == '') {
			$form_array['seo_keywords_error'] = 'SEO keywords required';
			$errorMsg = 'yes';
		}
		if(trim($_POST['seo_description']) == '') {
			$form_array['seo_description_error'] = 'SEO description required';
			$errorMsg = 'yes';
		}
		if($errorMsg == 'no' && $errorMsg != 'yes') {
			$seo_id			= $_POST['seo_id'];
			$seo_url		= $_POST['seo_url'];
			$seo_title		= $_POST['seo_title'];
			$seo_keywords 	= $_POST['seo_keywords'];
			$seo_description= $_POST['seo_description'];
			$active			= $_POST['active'];
			$seo_id 		= $seoObj->fun_editSeo($seo_id, $seo_url, $seo_title, $seo_keywords, $seo_description, $active);
			$redirect_url 		= "admin-settings.php?sec=seo&action=edit&seo_id=".$seo_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}
	// Edit SEO: End here 

	if(isset($_GET['action']) && $_GET['action'] !="") {
		$seo_id = $_REQUEST['seo_id'];
		require_once(SITE_ADMIN_INCLUDES_PATH.'seo-form.php');
	} else {
		require_once(SITE_ADMIN_INCLUDES_PATH.'seo-list.php');
	}
?>