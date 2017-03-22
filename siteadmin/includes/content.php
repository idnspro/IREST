<?php
if(isset($_REQUEST['page_id']) && $_REQUEST['page_id'] != ''){
	$page_id  = $_REQUEST['page_id'];
}
//form submission
$form_array = array();
$errorMsg 	= "no";

// Edit page submit : Start here 
if($_POST['securityKey']==md5("EDITPAGE")){	
	if(trim($_POST['page_title']) == '') {
		$form_array['page_title_error'] = 'Page title required';
		$errorMsg = 'yes';
	}

	if(trim($_POST['page_content_title']) == '') {
		$form_array['page_content_title_error'] = 'Content title required';
		$errorMsg = 'yes';
	}

	if(trim($_POST['page_discription']) == '') {
		$form_array['page_discription_error'] = 'Page description required';
		$errorMsg = 'yes';
	}

	if(trim($_POST['page_seo_title']) == '') {
		$form_array['page_seo_title_error'] = 'SEO title required';
		$errorMsg = 'yes';
	}

	if(trim($_POST['page_seo_keyword']) == '') {
		$form_array['page_seo_keyword_error'] = 'SEO Keyword required';
		$errorMsg = 'yes';
	}

	if(trim($_POST['page_seo_discription']) == '') {
		$form_array['page_seo_discription_error'] = 'SEO description required';
		$errorMsg = 'yes';
	}

   if($errorMsg == 'no' && $errorMsg != 'yes') {
		$page_id 				= $_POST['page_id'];
		$page_title 			= $_POST['page_title'];
		$page_content_title 	= $_POST['page_content_title'];
		$page_discription 		= $_POST['page_discription'];
		$page_seo_title 		= $_POST['page_seo_title'];
		$page_seo_keyword 		= $_POST['page_seo_keyword'];
		$page_seo_discription 	= $_POST['page_seo_discription'];
		$page_type 				= $_POST['page_type'];

		$cmsObj->fun_editPage($page_id, $page_title, $page_content_title, $page_discription, $page_seo_title, $page_seo_keyword, $page_seo_discription, $page_type);
		$redirect_url 			= "admin-content.php?page_type=".$page_type."&sec=edit&page_id=".$page_id;
		redirectURL($redirect_url);
	} else {
		$form_array['error_msg'] = "Please submit your form again!";
	}	
}
// Edit restaurant details submit : End here 

// add a new page submit : Start here 
if($_POST['securityKey']==md5("ADDPAGE")){	

	if(trim($_POST['page_title']) == '') {
		$form_array['page_title_error'] = 'Page title required';
		$errorMsg = 'yes';
	}

	if(trim($_POST['page_content_title']) == '') {
		$form_array['page_content_title_error'] = 'Content title required';
		$errorMsg = 'yes';
	}

	if(trim($_POST['page_discription']) == '') {
		$form_array['page_discription_error'] = 'Page description required';
		$errorMsg = 'yes';
	}

	if(trim($_POST['page_seo_title']) == '') {
		$form_array['page_seo_title_error'] = 'SEO title required';
		$errorMsg = 'yes';
	}

	if(trim($_POST['page_seo_keyword']) == '') {
		$form_array['page_seo_keyword_error'] = 'SEO Keyword required';
		$errorMsg = 'yes';
	}

	if(trim($_POST['page_seo_discription']) == '') {
		$form_array['page_seo_discription_error'] = 'SEO description required';
		$errorMsg = 'yes';
	}

   if($errorMsg == 'no' && $errorMsg != 'yes') {
		$page_title 			= $_POST['page_title'];
		$page_content_title 	= $_POST['page_content_title'];
		$page_discription 		= $_POST['page_discription'];
		$page_seo_title 		= $_POST['page_seo_title'];
		$page_seo_keyword 		= $_POST['page_seo_keyword'];
		$page_seo_discription 	= $_POST['page_seo_discription'];
		$page_type 				= $_POST['page_type'];

		$page_id 				= $cmsObj->fun_addPage($page_title, $page_content_title, $page_discription, $page_seo_title, $page_seo_keyword, $page_seo_discription, $page_type);
		$redirect_url 			= "admin-content.php?page_type=".$page_type."&sec=edit&page_id=".$page_id;
		redirectURL($redirect_url);
	} else {
		$form_array['error_msg'] = "Please submit your form again!";
	}	
}
// add a new page submit : End here 

if(isset($_GET['sec']) && $_GET['sec'] !="") {
	switch($_GET['sec']) {
		case "add":
		case "edit":
			require_once(SITE_ADMIN_INCLUDES_PATH.'content-form.php');
		break;
		default:
			require_once(SITE_ADMIN_INCLUDES_PATH.'content-list.php');
	}
} else {
	require_once(SITE_ADMIN_INCLUDES_PATH.'content-list.php');
}

?>