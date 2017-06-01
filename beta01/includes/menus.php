<?php
$menu_id = $_REQUEST['menu_id'];
//form submission
$form_array = array();
$errorMsg   = "no";
// Add new Menu : Start here 
if ( $_POST['securityKey'] == md5("ADDMENU") ) {
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
        $rest_id      = $_POST['rest_id'];
        $category_id  = $_POST['category_id'];
        $menu_name    = $_POST['menu_name'];
        $menu_desc    = $_POST['menu_desc'];
        $active       = $_POST['active'];
        $back_url     = $_POST['back_url'];
        $menu_id      = $restObj->fun_addMenu($rest_id, $category_id, $menu_name, $menu_desc, $active); // Add New Menu 
        $redirect_url = "manager-restaurants-menu.php?sec=edit&menu_id=".$menu_id."&rest_id=".$rest_id."&back_url=".$back_url;
        redirectURL($redirect_url);
    } else {
        $form_array['error_msg'] = "Please submit your form again!";
    }
}
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
        $menu_id     = $_POST['menu_id'];
        $rest_id     = $_POST['rest_id'];
        $category_id = $_POST['category_id'];
        $menu_name   = $_POST['menu_name'];
        $menu_desc   = $_POST['menu_desc'];
        $active      = $_POST['active'];
        $back_url    = $_POST['back_url'];
        $restObj->fun_editMenu($menu_id); // Edit Menu 
        $redirect_url = "manager-restaurants-menu.php?sec=edit&menu_id=".$menu_id."&rest_id=".$rest_id."&back_url=".$back_url;
        redirectURL($redirect_url);
    } else {
        $form_array['error_msg'] = "Please submit your form again!";
    }
}
if ( $_POST['securityKey'] == md5("EDITMENUPRICE") ) {
    if($errorMsg == 'no' && $errorMsg != 'yes') {
        $menu_id  = $_POST['menu_id'];
        $rest_id  = $_POST['rest_id'];
        $back_url = $_POST['back_url'];
        $restObj->fun_editMenuPrice($menu_id); // Edit Menu Price
        $redirect_url = "manager-restaurants-menu.php?sec=price&menu_id=".$menu_id."&rest_id=".$rest_id."&back_url=".$back_url;
        redirectURL($redirect_url);
    } else {
        $form_array['error_msg'] = "Please submit your form again!";
    }
}
?>
<?php
    if(isset($_GET['sec']) && $_GET['sec'] !="") {
        switch($_GET['sec']) {
            case "add":
            case "edit":
                $addtitle = "Manage Menu";
                require_once(SITE_INCLUDES_PATH.'menu-form.php');
            break;
            case "price":
                $addtitle = "Manage Menu Price";
                require_once(SITE_INCLUDES_PATH.'menu-price.php');
            break;
            default:
                $addtitle = "Manage Menu";
                require_once(SITE_INCLUDES_PATH.'menu-list.php');
        }
    } else {
        $addtitle = "Manage Menu";
        require_once(SITE_INCLUDES_PATH.'menu-list.php');
    }
?>
