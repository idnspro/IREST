<?php
	$menu_id = $_REQUEST['menu_id'];
	$item_id = $_REQUEST['item_id'];
	//form submission
	$form_array = array();
	$errorMsg 	= "no";
	// Add new Menu : Start here 
	if($_POST['securityKey']==md5(ADDNEWITEM)){
       if(trim($_POST['item_name']) == '') {
			$form_array['item_name_errorid'] = 'Item Name required';
			$errorMsg = 'yes';
		}
		if(trim($_POST['menu_catid']) == '') {
			$form_array['menu_catid_errorid'] = 'Menu Category required';
			$errorMsg = 'yes';
		}
		if(trim($_POST['item_prices']) == '') {
			$form_array['item_prices_errorid'] = 'Menu Prices required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['item_desc']) == '') {
			$form_array['item_desc_errorid'] = 'Description required';
			$errorMsg = 'yes';
		}
			
	if($errorMsg == 'no' && $errorMsg != 'yes') {
        $item_name 	     = $_POST['item_name'];
		$menu_catid      = $_POST['menu_catid'];
		$item_desc       = $_POST['item_desc'];
		$item_prices     = $_POST['item_prices'];
     	$rest_id         = $_POST['rest_id'];
		
		$item_id 		 = $restObj->fun_addMenuItem($menu_id , $rest_id, $item_name, $menu_catid, $item_prices, $item_desc);
		
		$redirect_url 	 = "admin-restaurant-menu-item.php?sec=edit&item_id=".$item_id;
		redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}
	}
		
	if($_POST['securityKey']==md5(EDITITEM)){
       if(trim($_POST['item_name']) == '') {
			$form_array['item_name_errorid'] = 'Item Name required';
			$errorMsg = 'yes';
		}
		if(trim($_POST['menu_catid']) == '') {
			$form_array['menu_catid_errorid'] = 'Menu Category required';
			$errorMsg = 'yes';
		}
		
		if(trim($_POST['item_prices']) == '') {
			$form_array['item_prices_errorid'] = 'Menu Prices required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['item_desc']) == '') {
			$form_array['item_desc_errorid'] = 'Description required';
			$errorMsg = 'yes';
		}
	
        if($errorMsg == 'no' && $errorMsg != 'yes') {
			// Edit Menu 
			$restObj->fun_editmenuItem($item_id);
			$redirect_url 	= "admin-restaurant-menu-item.php?sec=edit&subsec=det&item_id=".$item_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}		
	
	}

	if(isset($_GET['sec']) && $_GET['sec'] !="") {
	switch($_GET['sec']) {
		case "add":
		case "edit":
			require_once(SITE_ADMIN_INCLUDES_PATH.'item-form.php');
		break;
		default:
			require_once(SITE_ADMIN_INCLUDES_PATH.'item-list.php');
	}
  } else {
      require_once(SITE_ADMIN_INCLUDES_PATH.'item-list.php');
}
?>