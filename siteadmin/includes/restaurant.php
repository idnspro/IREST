<?php
  	$rest_id   	= $_REQUEST['rest_id'];
  	$photo_id  	= $_REQUEST['photo_id'];

	//form submission
	$form_array = array();
	$errorMsg 	= "no";

	// Add new restaurant submit : Start here 
	if($_POST['securityKey']==md5("ADDNEWRESTAURANT")){	
		if(trim($_POST['rest_name']) == '') {
			$form_array['rest_name_error'] = 'Name required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['rest_country_id']) == '') {
			$form_array['rest_country_id_error'] = 'Country required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['rest_state_id']) == '') {
			$form_array['rest_state_id_error'] = 'State required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['rest_city_id']) == '') {
			$form_array['rest_city_id_error'] = 'City required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['rest_address1']) == '') {
			$form_array['rest_address1_error'] = 'Address required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['rest_zip']) == '') {
			$form_array['rest_zip_error'] = 'Zip Code required';
			$errorMsg = 'yes';
		}

	   if($errorMsg == 'no' && $errorMsg != 'yes') {
			$rest_name			= $_POST['rest_name'];
			$rest_country_id	= $_POST['rest_country_id'];
			$rest_state_id 	    = $_POST['rest_state_id'];
			$rest_city_id		= $_POST['rest_city_id'];
			$rest_address1		= $_POST['rest_address1'];
			$rest_address2		= $_POST['rest_address2'];
			$rest_zip			= $_POST['rest_zip'];
			// Add New Restaurant 
			$rest_id 			= $restObj->fun_addRestaurant($rest_name, $rest_country_id, $rest_state_id, $rest_city_id, $rest_address1, $rest_address2, $rest_zip);

			// update friendly_link
			$restObj->fun_generateFriendlyLink($rest_id, $rest_name);

			$redirect_url 		= "admin-restaurant.php?sec=edit&subsec=det&rest_id=".$rest_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}

	// Add new restaurant submit : End here 
	// Edit restaurant details submit : Start here 
	if($_POST['securityKey']==md5("EDITRESTAURANTDETAILS")){	
		if(trim($_POST['rest_name']) == '') {
			$form_array['rest_name_error'] = 'Name required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['rest_country_id']) == '') {
			$form_array['rest_country_id_error'] = 'Country required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['rest_state_id']) == '') {
			$form_array['rest_state_id_error'] = 'State required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['rest_city_id']) == '') {
			$form_array['rest_city_id_error'] = 'City required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['rest_address1']) == '') {
			$form_array['rest_address1_error'] = 'Address required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['rest_zip']) == '') {
			$form_array['rest_zip_error'] = 'Zip Code required';
			$errorMsg = 'yes';
		}

		if($errorMsg == 'no' && $errorMsg != 'yes') {
			$rest_id		= $_POST['rest_id'];
			// Edit Restaurant 
			$restObj->fun_editRestaurant($rest_id);
			$redirect_url 	= "admin-restaurant.php?sec=edit&subsec=det&rest_id=".$rest_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}

	if($_POST['securityKey']==md5("UPDATERESTDESC")){
		if(trim($_POST['rest_title']) == '') {
			$form_array['rest_title_error'] = 'Title required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['rest_short_desc']) == '') {
			$form_array['rest_short_desc_error'] = 'Welcome message required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['page_discription']) == '') {
			$form_array['page_discription_error'] = 'About restaurant required';
			$errorMsg = 'yes';
		}

		if($errorMsg == 'no' && $errorMsg != 'yes') {
			$rest_id		= $_POST['rest_id'];
			// Edit Restaurant 
			$restObj->fun_editRestaurant($rest_id);
			$redirect_url 	= "admin-restaurant.php?sec=edit&subsec=det&rest_id=".$rest_id;
			redirectURL($redirect_url);
		} else{
			$form_array['error_msg'] = "Error: We are unable to update logo!";
		}
	}

	if($_POST['securityKey']==md5("UPLOADRESTAURANTLOGO")){
		if(isset($_POST['rest_id']) && $_POST['rest_id'] != ''){
			$rest_id 		= $_POST['rest_id'];
			if(isset($_FILES['rest_logo']) && ($_FILES['rest_logo'] !="")){ // edit logo
				$logo_img 		= basename($_FILES['rest_logo']['name']);
				$extn 			= split("\.",$logo_img);
				$rest_logo 		= $rest_id."_logo.".$extn[1];
				$uploadlogodir 	= '../upload/restaurant_images/logo';
				$uploadlogofile = $uploadlogodir ."/". $rest_logo;
				if (move_uploaded_file($_FILES['rest_logo']['tmp_name'], $uploadlogofile)){
					$restObj->fun_editRestaurantLogo($rest_id, $rest_logo);
				} else{
					$form_array['error_msg'] = "Error: We are unable to update logo!";
				}
			}

			if(isset($_FILES['rest_photo']) && ($_FILES['rest_photo'] !="")){ // edit photo
				$photos_img 		= basename($_FILES['rest_photo']['name']);
				$extn 				= split("\.",$photos_img);
				$rest_photo 		= $rest_id."_photos.".$extn[1];
	
				$uploadphotodir 		= '../upload/restaurant_images/large';
				$uploadthumbdir 		= '../upload/restaurant_images/thumbnail';
				$uploadphotofile 		= $uploadphotodir ."/". $rest_photo;
				$uploadphotofile600x270 = $uploadphotodir ."/600x270/". $rest_photo;
				$uploadphotofile480x360 = $uploadphotodir ."/480x360/". $rest_photo;
				$uploadthumbfile168x126 = $uploadthumbdir ."/168x126/". $rest_photo;
				if (move_uploaded_file($_FILES['rest_photo']['tmp_name'], $uploadphotofile)){
					$imgObj->getCrop($uploadphotodir,$rest_photo,600,270,$uploadphotofile480x360);
					$imgObj->getCrop($uploadphotodir,$rest_photo,480,360,$uploadphotofile480x360);
					$imgObj->getCrop($uploadphotodir,$rest_photo,168,126,$uploadthumbfile168x126);
					$restObj->fun_editRestaurantPhoto($rest_id, $rest_photo);
				} else{
					$form_array['error_msg'] = "Error: We are unable to update photo!";
				}
			}
			$redirect_url 	= "admin-restaurant.php?sec=edit&subsec=det&rest_id=".$rest_id;
			redirectURL($redirect_url);
		} else{
			$form_array['error_msg'] = "Error: We are unable to update logo/photo!";
		}
	}
	
	if($_POST['securityKey'] == md5("UPLOADRESTAURANTPHOTOS")){
		if(isset($_POST['rest_id']) && ($_POST['rest_id'] != '') && isset($_FILES['photo_thumb']) && ($_FILES['photo_thumb'] !="")){
			$rest_id 		= $_POST['rest_id'];
			$photo_id 		= $_POST['photo_id'];
			if(isset($photo_id) && $photo_id != "") {  // edit photo
				$photos_img 	= basename($_FILES['photo_thumb']['name']);
				$extn 			= split("\.",$photos_img);
				$photo_caption  = $_POST['photo_caption'];
				$photo_main 	= $rest_id."_".$photo_id."_photo.".$extn[1];
				$photo_thumb 	= $rest_id."_".$photo_id."_photo_thumb.".$extn[1];

				$uploadphotodir 		= '../upload/restaurant_images/large';
				$uploadthumbdir 		= '../upload/restaurant_images/thumbnail';
				$uploadphotofile 		= $uploadphotodir ."/". $photo_main;
				$uploadphotofile600x270 = $uploadphotodir ."/600x270/". $photo_main;
				$uploadphotofile480x360 = $uploadphotodir ."/480x360/". $photo_main;
				$uploadthumbfile168x126 = $uploadthumbdir ."/168x126/". $photo_thumb;

				if (move_uploaded_file($_FILES['photo_thumb']['tmp_name'], $uploadphotofile)){
					$imgObj->getCrop($uploadphotodir,$photo_main,600,270,$uploadphotofile600x270);
					$imgObj->getCrop($uploadphotodir,$photo_main,480,360,$uploadphotofile480x360);
					$imgObj->getCrop($uploadphotodir,$photo_main,168,126,$uploadthumbfile168x126);

					if($restObj->fun_updateRestaurantPhotos($rest_id, $photo_id, $photo_caption, $photo_main, $photo_thumb) === true){
						$restObj->fun_updateRestaurantLastUpdate($rest_id);
						$redirect_url 	= "admin-restaurant.php?sec=edit&subsec=det&rest_id=".$rest_id;
						redirectURL($redirect_url);
					}
				}
			} else {
				$photo_id = $restObj->fun_addRestaurantPhotos($rest_id);
				if(isset($photo_id) && $photo_id !="") {
					$photos_img 	= basename($_FILES['photo_thumb']['name']);
					$extn 			= split("\.",$photos_img);
					$photo_caption  = $_POST['photo_caption'];
					$photo_main 	= $rest_id."_".$photo_id."_photo.".$extn[1];
					$photo_thumb 	= $rest_id."_".$photo_id."_photo_thumb.".$extn[1];
	
					$uploadphotodir 		= '../upload/restaurant_images/large';
					$uploadthumbdir 		= '../upload/restaurant_images/thumbnail';
					$uploadphotofile 		= $uploadphotodir ."/". $photo_main;
					$uploadphotofile600x270 = $uploadphotodir ."/600x270/". $photo_main;
					$uploadphotofile480x360 = $uploadphotodir ."/480x360/". $photo_main;
					$uploadthumbfile168x126 = $uploadthumbdir ."/168x126/". $photo_thumb;
	
					if (move_uploaded_file($_FILES['photo_thumb']['tmp_name'], $uploadphotofile)){
						$imgObj->getCrop($uploadphotodir,$photo_main,600,270,$uploadphotofile600x270);
						$imgObj->getCrop($uploadphotodir,$photo_main,480,360,$uploadphotofile480x360);
						$imgObj->getCrop($uploadphotodir,$photo_main,168,126,$uploadthumbfile168x126);
	
						if($restObj->fun_updateRestaurantPhotos($rest_id, $photo_id, $photo_caption, $photo_main, $photo_thumb) === true){
							$restObj->fun_updateRestaurantLastUpdate($rest_id);
							$redirect_url 	= "admin-restaurant.php?sec=edit&subsec=det&rest_id=".$rest_id;
							redirectURL($redirect_url);
						}
					}
				}
			}
		} else {
			$form_array['error_msg'] = "Error: We are unable to update photo!";
		}
	}

	if($_POST['securityKey']==md5("EDITRESTAURANTPHOTOS")){
		if(isset($_POST['photo_id']) && ($_POST['photo_id'] != '') && isset($_FILES['photo_thumb']) && ($_FILES['photo_thumb'] !="")){ // edit
			$photo_id 		= $_POST['photo_id'];
		    $photo_caption 	= $_POST['photo_caption'];
			
			$photos_img 	= basename($_FILES['photo_thumb']['name']);
			$extn 			= split("\.",$photos_img);
            $photo_caption  = $_POST['photo_caption'];
			$photo_thumb 	= $photo_id."_photos.".$extn[0];
		
			$uploadlogodir 	= '../upload/restaurant_images/thumbnail/168x126';
			$uploadlogofile = $uploadlogodir ."/". $photo_thumb;
			if (move_uploaded_file($_FILES['photo_thumb']['tmp_name'], $uploadlogofile)){
				
				$restObj->fun_editRestaurantPhotos($photo_id, $photo_thumb, $photo_caption);
				
				$redirect_url 	= "admin-restaurant-photos-edit.php?sec=edit&subsec=det&rest_id=".$rest_id."&photo_id=".$photo_id;
				redirectURL($redirect_url);
			} else{
				$form_array['error_msg'] = "Error: We are unable to update Photos!";
			}
		}
	}
	
	if($_POST['securityKey']==md5("PHOTODELETE")){
		if(isset($_POST['photo_id']) && $_POST['photo_id'] != "") {
			$txtPhotoId = $_POST['photo_id'];
			$restObj->fun_delResource($txtPhotoId);
		}
		echo "<script> location.href='admin-restaurant-photos-edit.php?sec=edit&subsec=det&rest_id=".$rest_id."&photo_id=".$photo_id." ';</script>";
	} 
	// Edit restaurant details submit : End here 

	if(isset($_GET['sec']) && $_GET['sec'] !="") {
		switch($_GET['sec']) {
			case "add":
			case "edit":
				require_once(SITE_ADMIN_INCLUDES_PATH.'restaurant-form.php');
			break;
			case "photo":
				require_once(SITE_ADMIN_INCLUDES_PATH.'resaurant-photo-edit.php');
			break;
			default:
				require_once(SITE_ADMIN_INCLUDES_PATH.'restaurant-list.php');
		}
	} else {
		require_once(SITE_ADMIN_INCLUDES_PATH.'restaurant-list.php');
	}
?>