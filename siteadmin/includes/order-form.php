<script type="text/javascript" language="javascript">
function chkblnkTxtError(strFieldId, strErrorFieldId){
	if(document.getElementById(strFieldId).value != ""){
	  document.getElementById(strErrorFieldId).innerHTML = "";
	}
}

function validatefrm(){
	if(document.getElementById("delivery_fname_id").value == "") {
		document.getElementById("delivery_fname_errorid").innerHTML = "First name required";
		document.getElementById("delivery_fname_id").focus();
		return false;
	}
	document.frmOrd.submit();
}
</script>
<?php
if(isset($order_id) && $order_id !=""){
	$ordInfo 				= $restObj->fun_getOrderInfoById($order_id);
	$user_id 				= $ordInfo['user_id'];
	$delivery_fname 		= $ordInfo['delivery_fname'];
	$delivery_lname 		= $ordInfo['delivery_lname'];
	$delivery_address1 		= $ordInfo['delivery_address1'];
	$delivery_address2 		= $ordInfo['delivery_address2'];
	$delivery_city 			= $ordInfo['delivery_city'];
	$delivery_state 		= $ordInfo['delivery_state'];
	$delivery_country 		= $ordInfo['delivery_country'];
	$delivery_zip 			= $ordInfo['delivery_zip'];
	$delivery_phone			= $ordInfo['delivery_phone'];
	$dtype 					= $ordInfo['dtype'];
	$schedule 				= $ordInfo['schedule'];
	$order_comments 		= $ordInfo['order_comments'];
	$payment_method 		= $ordInfo['payment_method'];
	$cc_type 				= $ordInfo['cc_type'];
	$cc_owner 				= $ordInfo['cc_owner'];
	$cc_number 				= $ordInfo['cc_number'];
	$cc_expires 			= $ordInfo['cc_expires'];
	$final_price 			= $ordInfo['final_price'];
	$currency_id 			= $ordInfo['currency_id'];
	$orders_status 			= $ordInfo['orders_status'];
	?>
    <form name="frmOrd" id="frmOrd" method="post" action="admin-report.php?sec=order&action=edit&order_id=<?php echo $order_id; ?>" enctype="multipart/form-data">
        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITORDER"); ?>">
        <input type="hidden" name="order_id" id="order_id_id" value="<?php echo $order_id; ?>">
        <input type="hidden" name="user_id" id="user_id_id" value="<?php echo $user_id; ?>">
        <input type="hidden" name="cc_type" id="cc_type_id" value="<?php echo $cc_type; ?>">
        <input type="hidden" name="cc_owner" id="cc_owner_id" value="<?php echo $cc_owner; ?>">
        <input type="hidden" name="cc_number" id="cc_number_id" value="<?php echo $cc_number; ?>">
        <input type="hidden" name="cc_expires" id="cc_expires_id" value="<?php echo $cc_expires; ?>">
        <input type="hidden" name="currency_id" id="currency_id" value="<?php echo $currency_id; ?>">
        <fieldset>
        <legend><?php echo $addtitle; ?></legend>
            <div class="floatRight pad-top5 pad-btm5" align="right">
                <a href="admin-report.php" class="button-blue" style="text-decoration:none;">Back to list</a>&nbsp;
            </div>
            <p>
                <label for="delivery_fname">First name</label>
                <input type="text" name="delivery_fname" id="delivery_fname_id" value="<?php echo $delivery_fname; ?>" />
                &nbsp;<span class="error" id="delivery_fname_errorid"><?php if(array_key_exists('delivery_fname_error', $form_array)) echo $form_array['delivery_fname_error'];?> </span>
            </p>
            <p>
                <label for="delivery_lname">Last name</label>
                <input type="text" name="delivery_lname" id="delivery_lname_id" value="<?php echo $delivery_lname; ?>" />
                &nbsp;<span class="error" id="delivery_lname_errorid"><?php if(array_key_exists('delivery_lname_error', $form_array)) echo $form_array['delivery_lname_error'];?> </span>
            </p>
            <p>
                <label for="delivery_lname">Phone</label>
                <input type="text" name="delivery_phone" id="delivery_phone_id" value="<?php echo $delivery_phone; ?>" />
                &nbsp;<span class="error" id="delivery_phone_errorid"><?php if(array_key_exists('delivery_phone_error', $form_array)) echo $form_array['delivery_phone_error'];?> </span>
            </p>
            <p>
                <label for="delivery_address1">Address</label>
                <input type="text" name="delivery_address1" id="delivery_address1_id" value="<?php echo $delivery_address1; ?>" />
                &nbsp;<span class="error" id="delivery_address1_errorid"><?php if(array_key_exists('delivery_address1_error', $form_array)) echo $form_array['delivery_address1_error'];?> </span>
            </p>
            <p>
                <label for="delivery_address2">&nbsp;</label>
                <input type="text" name="delivery_address2" id="delivery_address2_id" value="<?php echo $delivery_address2; ?>" />
                &nbsp;<span class="error" id="delivery_address2_errorid"><?php if(array_key_exists('delivery_address2_error', $form_array)) echo $form_array['delivery_address2_error'];?> </span>
            </p>
            <p>
                <label for="delivery_city">Town / City</label>
                <input type="text" name="delivery_city" id="delivery_city_id" value="<?php echo $delivery_city; ?>" />
                &nbsp;<span class="error" id="delivery_city_errorid"><?php if(array_key_exists('delivery_city_error', $form_array)) echo $form_array['delivery_city_error'];?> </span>
            </p>
            <p>
                <label for="delivery_state">County / State</label>
                <input type="text" name="delivery_state" id="delivery_state_id" value="<?php echo $delivery_state; ?>" />
                &nbsp;<span class="error" id="delivery_state_errorid"><?php if(array_key_exists('delivery_state_error', $form_array)) echo $form_array['delivery_state_error'];?> </span>
            </p>
            <p>
                <label for="delivery_zip">Postal code</label>
                <input type="text" name="delivery_zip" id="delivery_zip_id" value="<?php echo $delivery_zip; ?>" />
                &nbsp;<span class="error" id="delivery_zip_errorid"><?php if(array_key_exists('delivery_zip_error', $form_array)) echo $form_array['delivery_zip_error'];?> </span>
            </p>
            <p>
                <label for="delivery_country">Country</label>
                <select name="delivery_country" id="delivery_country_id" class="select310">
                    <option value="0" selected>Select ... </option>
                    <?php 
                        $locationObj->fun_getCountryOptionsList($delivery_country, '');
                    ?>
                </select>
                &nbsp;<span class="error" id="delivery_country_errorid"><?php if(array_key_exists('delivery_country_error', $form_array)) echo $form_array['delivery_country_error'];?> </span>
            </p>
            <p>
                <label for="dtype">Delivery Type</label>
                <select name="dtype" id="dtype_id" class="select310">
                    <option value="pickup" <?php if(isset($dtype) && ($dtype =="pickup")) {echo ' selected';} ?> >PICKUP</option>
                    <option value="delivery" <?php if(!isset($dtype) || ($dtype =="delivery")) {echo ' selected';} ?> >DELIVERY</option>
                </select>
                &nbsp;<span class="error" id="dtype_errorid"><?php if(array_key_exists('dtype_error', $form_array)) echo $form_array['dtype_error'];?> </span>
            </p>
            <p>
                <label for="schedule">Schedule for</label>
                <input type="text" name="schedule" id="schedule_id" value="<?php echo $schedule; ?>" />
                &nbsp;<span class="error" id="schedule_errorid"><?php if(array_key_exists('schedule_error', $form_array)) echo $form_array['schedule_error'];?> </span>
            </p>
            <p>
                <label for="final_price">Final price</label>
                <input type="text" name="final_price" id="final_price_id" value="<?php echo $final_price; ?>" />$
                &nbsp;<span class="error" id="final_price_errorid"><?php if(array_key_exists('final_price_error', $form_array)) echo $form_array['final_price_error'];?> </span>
            </p>
            <p>
                <label for="payment_method">Payment method</label>
                <select name="payment_method" id="payment_method_id" class="select310">
                    <option value="1" <?php if(isset($payment_method) && ($payment_method =="1")) {echo ' selected';} ?> >Cash</option>
                    <option value="2" <?php if(isset($payment_method) && ($payment_method =="2")) {echo ' selected';} ?> >PayPal</option>
                    <option value="3" <?php if(isset($payment_method) && ($payment_method =="3")) {echo ' selected';} ?> >Credit Card</option>
                </select>
                &nbsp;<span class="error" id="payment_method_errorid"><?php if(array_key_exists('payment_method_error', $form_array)) echo $form_array['payment_method_error'];?> </span>
            </p>
            <p>&nbsp;</p>
            <p>
                <label for="order_comments">Comments</label>
                <textarea type="text" name="order_comments" id="order_comments_id" cols="" rows="" style="width:440px; height:150px;"/><?php echo $order_comments; ?></textarea>
                &nbsp;<span class="error" id="order_comments_errorid"><?php if(array_key_exists('order_comments_error', $form_array)) echo $form_array['order_comments_error'];?></span>
            </p> 
            <p>&nbsp;</p>
            <p>
                <label for="orders_status">Order Status</label>
                <select name="orders_status" id="orders_status_id" class="select310">
                    <option value="1" <?php if(isset($orders_status) && ($orders_status =="1")) {echo ' selected';} ?> >New Order</option>
                    <option value="2" <?php if(isset($orders_status) && ($orders_status =="2")) {echo ' selected';} ?> >Pending</option>
                    <option value="3" <?php if(isset($orders_status) && ($orders_status =="3")) {echo ' selected';} ?> >PayPal Preparation</option>
                    <option value="4" <?php if(isset($orders_status) && ($orders_status =="4")) {echo ' selected';} ?> >Complete</option>
                    <option value="5" <?php if(isset($orders_status) && ($orders_status =="5")) {echo ' selected';} ?> >Cancel</option>
                </select>
                &nbsp;<span class="error" id="orders_status_errorid"><?php if(array_key_exists('orders_status_error', $form_array)) echo $form_array['orders_status_error'];?> </span>
            </p>
            <p>&nbsp;</p>
            <p>
                <label>&nbsp;</label>
                <a href="javascript:void(0);" onclick="return validatefrm();" class="button-red">Update Now</a>
            </p>
        </fieldset>
    </form>
<?php
}
?>
