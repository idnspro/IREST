<?php
	$menu_id = $_REQUEST['menu_id'];

	//form submission
	$form_array = array();
	$errorMsg 	= "no";

	// Add new Menu : Start here 
	if($_POST['securityKey']==md5("ADDMENU")){
		if(trim($_POST['category_id']) == '') {
			$form_array['category_id_error'] = 'Menu Category required';
			$errorMsg = 'yes';
		}
		if(trim($_POST['menu_name']) == '') {
			$form_array['menu_name_error'] = 'Menu Name required';
			$errorMsg = 'yes';
		}
		
		if(trim($_POST['menu_desc']) == '') {
			$form_array['menu_desc_error'] = 'Description required';
			$errorMsg = 'yes';
		}
			
		if($errorMsg == 'no' && $errorMsg != 'yes') {
			$rest_id        = $_POST['rest_id'];
			$category_id 	= $_POST['category_id'];
			$menu_name 	    = $_POST['menu_name'];
			$menu_desc 	    = $_POST['menu_desc'];
			$active 	    = $_POST['active'];
			$back_url 	    = $_POST['back_url'];

		   // Add New Menu 
			$menu_id 			= $restObj->fun_addMenu($rest_id, $category_id, $menu_name, $menu_desc, $active);
			$redirect_url 		= "admin-restaurant-menu.php?sec=edit&menu_id=".$menu_id."&rest_id=".$rest_id."&back_url=".$back_url;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}
	}
	// Add new Menu : End here 

	if($_POST['securityKey']==md5("EDITMENU")){
		if(trim($_POST['category_id']) == '') {
			$form_array['category_id_error'] = 'Menu Category required';
			$errorMsg = 'yes';
		}
		if(trim($_POST['menu_name']) == '') {
			$form_array['menu_name_error'] = 'Menu Name required';
			$errorMsg = 'yes';
		}
		
		if(trim($_POST['menu_desc']) == '') {
			$form_array['menu_desc_error'] = 'Description required';
			$errorMsg = 'yes';
		}
			
		if($errorMsg == 'no' && $errorMsg != 'yes') {
			$menu_id        = $_POST['menu_id'];
			$rest_id        = $_POST['rest_id'];
			$category_id 	= $_POST['category_id'];
			$menu_name 	    = $_POST['menu_name'];
			$menu_desc 	    = $_POST['menu_desc'];
			$active 	    = $_POST['active'];
			$back_url 	    = $_POST['back_url'];

			// Edit Menu 
			$restObj->fun_editMenu($menu_id);
			$redirect_url 	= "admin-restaurant-menu.php?sec=edit&menu_id=".$menu_id."&rest_id=".$rest_id."&back_url=".$back_url;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}		
	}

	if($_POST['securityKey']==md5("EDITMENUPRICE")){
		/*
		if(trim($_POST['menu_name']) == '') {
			$form_array['menu_name_error'] = 'Menu Name required';
			$errorMsg = 'yes';
		}
		*/

		if($errorMsg == 'no' && $errorMsg != 'yes') {
			$menu_id        = $_POST['menu_id'];
			$rest_id        = $_POST['rest_id'];
			$back_url 	    = $_POST['back_url'];

			// Edit Menu Price
			$restObj->fun_editMenuPrice($menu_id);
			$redirect_url 	= "admin-restaurant-menu.php?sec=price&menu_id=".$menu_id."&rest_id=".$rest_id."&back_url=".$back_url;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}		
	}

	if($_POST['securityKey'] == md5("UPLOADRESTAURANTMENUPHOTOS")){
		if(isset($_POST['rest_id']) && ($_POST['rest_id'] != '') && isset($_FILES['photo_thumb']) && ($_FILES['photo_thumb'] !="")){
			$rest_id 		= $_POST['rest_id'];
			$back_url 	    = $_POST['back_url'];
			$photo_id 		= $restObj->fun_addRestMenuPhotos($rest_id);
			if(isset($photo_id) && $photo_id !="") {
				$photos_img 	= basename($_FILES['photo_thumb']['name']);
				$extn 			= split("\.",$photos_img);
				$photo_caption  = $_POST['photo_caption'];
				$photo_main 	= $rest_id."_".$photo_id."_menu.".$extn[1];
				$photo_thumb 	= $rest_id."_".$photo_id."_menu_thumb.".$extn[1];

				$uploadphotodir 		= '../upload/restaurant_images/large';
				$uploadthumbdir 		= '../upload/restaurant_images/thumbnail';
				$uploadphotofile 		= $uploadphotodir ."/". $photo_main;
				$uploadthumbfile168x126 = $uploadthumbdir ."/168x126/". $photo_thumb;

				if (move_uploaded_file($_FILES['photo_thumb']['tmp_name'], $uploadphotofile)){
					$imgObj->getCrop($uploadphotodir,$photo_main,168,126,$uploadthumbfile168x126);
					if($restObj->fun_updateRestMenuPhotos($rest_id, $photo_id, $photo_caption, $photo_main, $photo_thumb) === true){
						$redirect_url 	= "admin-restaurant-menu.php?sec=photo&rest_id=".$rest_id."&back_url=".$back_url;
						redirectURL($redirect_url);
					}
				}
			}
		} else {
			$form_array['error_msg'] = "Error: We are unable to update photo!";
		}
	}

	if($_POST['securityKey'] == md5("UPLOADRESTAURANTMENUPDF")){
		if(isset($_POST['rest_id']) && ($_POST['rest_id'] != '') && isset($_FILES['pdf_thumb']) && ($_FILES['pdf_thumb'] !="")){
			$rest_id 			= $_POST['rest_id'];
			$back_url 	    	= $_POST['back_url'];
			$pdf_id 			= $restObj->fun_addRestMenuPDF($rest_id);
			if(isset($pdf_id) && $pdf_id !="") {
				$pdf_file 		= basename($_FILES['pdf_thumb']['name']);
				$extn 			= split("\.", $pdf_file);
				$pdf_caption	= $_POST['pdf_caption'];
				$pdf_url 		= $rest_id."_".$pdf_id."_menu.".$extn[1];
				$uploadpdfdir 	= '../upload/restaurant_files';
				$uploadpdffile 	= $uploadpdfdir ."/". $pdf_url;
				if (move_uploaded_file($_FILES['pdf_thumb']['tmp_name'], $uploadpdffile)){
					if($restObj->fun_updateRestMenuPDF($rest_id, $pdf_id, $pdf_caption, $pdf_url) === true){
						$redirect_url 	= "admin-restaurant-menu.php?sec=pdf&rest_id=".$rest_id."&back_url=".$back_url;
						redirectURL($redirect_url);
					}
				}
			}
		} else {
			$form_array['error_msg'] = "Error: We are unable to update pdf!";
		}
	}

	if(isset($_GET['sec']) && $_GET['sec'] !="") {
		switch($_GET['sec']) {
			case "add":
			case "edit":
				require_once(SITE_ADMIN_INCLUDES_PATH.'menu-form.php');
			break;
			case "price":
				require_once(SITE_ADMIN_INCLUDES_PATH.'menu-price.php');
			break;
			case "photo":
				require_once(SITE_ADMIN_INCLUDES_PATH.'menu-photo.php');
			break;
			case "pdf":
				require_once(SITE_ADMIN_INCLUDES_PATH.'menu-pdf.php');
			break;
			default:
				require_once(SITE_ADMIN_INCLUDES_PATH.'menu-list.php');
		}
	} else {
		require_once(SITE_ADMIN_INCLUDES_PATH.'menu-list.php');
	}
?>