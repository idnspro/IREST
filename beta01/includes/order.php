<?php
$rest_id   = $_REQUEST['rest_id'];
$order_id  = $_REQUEST['order_id'];
$back_url  = $_REQUEST['back_url'];
$rest_name = $restObj->fun_getRestaurantNameById($rest_id);
//form submission
$form_array = array();
$errorMsg   = "no";
// Edit Option Category submit : Start here 
if($_POST['securityKey']==md5("EDITORDER")){	
    if(trim($_POST['delivery_fname']) == '') {
        $form_array['delivery_fname_error'] = 'First name required';
        $errorMsg = 'yes';
    }
    if(trim($_POST['delivery_address1']) == '') {
        $form_array['delivery_address1_error'] = 'Delivery address required';
        $errorMsg = 'yes';
    }
    if(trim($_POST['dtype']) == '') {
        $form_array['dtype_error'] = 'Delivery type required';
        $errorMsg = 'yes';
    }
    if($errorMsg == 'no' && $errorMsg != 'yes') {
        $order_id          = $_POST['order_id'];
        $user_id           = $_POST['user_id'];
        $delivery_fname    = $_POST['delivery_fname'];
        $delivery_lname    = $_POST['delivery_lname'];
        $delivery_address1 = $_POST['delivery_address1'];
        $delivery_address2 = $_POST['delivery_address2'];
        $delivery_city     = $_POST['delivery_city'];
        $delivery_state    = $_POST['delivery_state'];
        $delivery_country  = $_POST['delivery_country'];
        $delivery_zip      = $_POST['delivery_zip'];
        $delivery_phone    = $_POST['delivery_phone'];
        $dtype             = $_POST['dtype'];
        $schedule          = $_POST['schedule'];
        $order_comments    = $_POST['order_comments'];
        $payment_method    = $_POST['payment_method'];
        $cc_type           = $_POST['cc_type'];
        $cc_owner          = $_POST['cc_owner'];
        $cc_number         = $_POST['cc_number'];
        $cc_expires        = $_POST['cc_expires'];
        $final_price       = $_POST['final_price'];
        $currency_id       = $_POST['currency_id'];
        $orders_status     = $_POST['orders_status'];
        $back_url          = $_POST['back_url'];
        // Edit Order
        $restObj->fun_editOrder($order_id, $user_id, $delivery_fname, $delivery_lname, $delivery_address1, $delivery_address2, $delivery_city, $delivery_state, $delivery_country, $delivery_zip, $delivery_phone, $dtype, $schedule, $order_comments, $payment_method, $cc_type, $cc_owner, $cc_number, $cc_expires, $final_price, $currency_id, $orders_status);
        $redirect_url = "manager-restaurants-order.php?sec=edit&order_id=".$order_id."&rest_id=".$rest_id."&back_url=".$back_url;
        redirectURL($redirect_url);
    } else {
        $form_array['error_msg'] = "Please submit your form again!";
    }
}
// Edit Order submit : End here 
if(isset($_GET['sec']) && $_GET['sec'] !="") {
    switch($_GET['sec']) {
        case "add":
        case "edit":
            $addtitle = "Manage Order";
            require_once(SITE_INCLUDES_PATH.'order-form.php');
        break;
        case "view":
            $addtitle = "Manage Order";
            require_once(SITE_INCLUDES_PATH.'order-view.php');
        break;
        default:
            $addtitle = "Manage Order";
            require_once(SITE_INCLUDES_PATH.'order-list.php');
    }
} else {
    $addtitle = "Manage Order";
    require_once(SITE_INCLUDES_PATH.'order-list.php');
}
?>
