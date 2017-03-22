<script type="text/javascript" src="<?php echo SITE_URL;?>jquery/js/jquery.ui.timepicker.addon.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#schedule_id').datetimepicker({
			controlType: 'select',
			minDateTime: 0,
			maxDate: 10,
			dateFormat: 'yy-mm-dd',
			timeFormat: 'HH:mm:ss'
		});
	});
</script>
<script type="text/javascript" language="javascript">
	function chkblnkTxtError(strFieldId, strErrorFieldId) {
		if(document.getElementById(strFieldId).value != "") {
			document.getElementById(strErrorFieldId).innerHTML = "";
		}
	}

	function validatefrm(){
		if(document.getElementById("user_fname_id").value == "") {
			document.getElementById("user_fname_errorid").innerHTML = "First Name required";
			document.getElementById("user_fname_id").focus();
			return false;
		}

		if(document.getElementById("user_lname_id").value == "") {
			document.getElementById("user_lname_errorid").innerHTML = "Last Name required";
			document.getElementById("user_lname_id").focus();
			return false;
		}

		if(document.getElementById("user_email_id").value == "") {
			document.getElementById("user_email_errorid").innerHTML = "Enter valid email address";
			document.getElementById("user_email_id").focus();
			return false;
		}
		if(document.getElementById("phone_id").value == "") {
			document.getElementById("phone_errorid").innerHTML = "Phone required";
			document.getElementById("phone_id").focus();
			return false;
		}
		if(document.getElementById("schedule_id").value == "") {
			document.getElementById("schedule_errorid").innerHTML = "Date & Time required";
			document.getElementById("schedule_id").focus();
			return false;
		}
		if(document.getElementById("total_bookings_id").value == "" || parseInt(document.getElementById("total_bookings_id").value) < 1) {
			document.getElementById("total_bookings_errorid").innerHTML = "Number of reservation required";
			document.getElementById("total_bookings_id").focus();
			return false;
		}


		/*
		if(document.getElementById("instructions_id").value == "") {
			document.getElementById("instructions_errorid").innerHTML = "Review required";
			document.getElementById("instructions_id").focus();
			return false;
		}
		*/
		document.frmBooking.submit();
	}
</script>
<style>
	select {
		width:auto;
		height:28px;
		font-size:12px;
		margin:0px;
		padding:3px;
	}
</style>
<?php
if(isset($booking_id) && $booking_id !=""){
	$bookInfo 	= $restObj->fun_getBookInfoById($booking_id);

	$booking_id			= $bookInfo['booking_id'];
	$user_id			= $bookInfo['user_id'];
	$rest_id			= $bookInfo['rest_id'];
	$phone				= $bookInfo['phone'];
	$total_bookings		= $bookInfo['total_bookings'];
	$schedule			= $bookInfo['schedule'];
	$instructions		= $bookInfo['instructions'];
	$total_amount		= $bookInfo['total_amount'];
	$currency_id		= $bookInfo['currency_id'];
	$pay_method			= $bookInfo['pay_method'];
	$payment_status		= $bookInfo['payment_status'];
	$status				= $bookInfo['status'];
	//$created_on			= $bookInfo['created_on'];
	//$created_by			= $bookInfo['created_by'];
	//$updated_on			= $bookInfo['updated_on'];
	//$updated_by			= $bookInfo['updated_by'];
	$view_status		= $bookInfo['view_status'];
	$delete_status		= $bookInfo['delete_status'];
	$active				= $bookInfo['active'];

	//Customer info
	$bookingUserInfoArr = $usersObj->fun_getUsersInfo($user_id);
	$user_fname 		= $bookingUserInfoArr['user_fname'];
	$user_lname 		= $bookingUserInfoArr['user_lname'];
	$user_email 		= $bookingUserInfoArr['user_email'];
	$user_name			= $user_fname." ".$user_lname;
	//User info
	$restInfoArr 		= $restObj->fun_getRestaurantInfo($rest_id);
	$rest_name			= $restInfoArr['rest_name'];

?>
<div class="floatRight pad-top5 pad-btm5" align="right">
    <a href="admin-book.php" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
</div>
<form name="frmBooking" id="frmBooking" method="post" action="admin-book.php?sec=edit&booking_id=<?php echo $booking_id;?>&rest_id=<?php echo $rest_id;?>">
    <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("RESTAURANTBOOKING");?>" />
    <input type="hidden" name="booking_id" id="booking_id" value="<?php echo $booking_id;?>" />
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>" />
    <input type="hidden" name="user_fname" id="user_fname_id" value="<?php echo $user_fname;?>" />
    <input type="hidden" name="user_lname" id="user_lname_id" value="<?php echo $user_lname;?>" />
    <input type="hidden" name="user_email" id="user_email_id" value="<?php echo $user_email;?>" />
    <input type="hidden" name="rest_id" id="rest_id" value="<?php echo $rest_id;?>" />
    <input type="hidden" name="status" id="status" value="<?php echo $status;?>">
    <input type="hidden" name="currency_id" id="currency_id" value="<?php if(isset($currency_id) && $currency_id !="") {echo $currency_id;} else {echo "1";}?>">
<fieldset>
<legend>Edit Book Table</legend>
    <p>
        <label for="rest_name">Restaurant</label>
        <input type="text" name="rest_name" id="rest_name_id" value="<?php echo $rest_name; ?>" disabled="disabled" />&nbsp;
        <span class="error" id="rest_id_errorid"><?php if(array_key_exists('rest_id_error', $form_array)) echo $form_array['rest_id_error'];?></span>
    </p>
    <p>
        <label for="fname">First Name<span class="compulsory">*</span></label>
        <input type="text" name="fname" id="fname_id" value="<?php echo $user_fname; ?>" disabled="disabled" />&nbsp;
        <span class="error" id="user_fname_errorid"><?php if(array_key_exists('user_fname_error', $form_array)) echo $form_array['user_fname_error'];?></span>
    </p>
    <p>
        <label for="lname">Last Name<span class="compulsory">*</span></label>
        <input type="text" name="lname" id="lname_id" value="<?php echo $user_lname; ?>" disabled="disabled" />&nbsp;
        <span class="error" id="user_lname_errorid"><?php if(array_key_exists('user_lname_error', $form_array)) echo $form_array['user_lname_error'];?></span>
    </p>
    <p>
        <label for="email">Email Address<span class="compulsory">*</span></label>
        <input type="text" name="email" id="email_id" value="<?php echo $user_email; ?>" disabled="disabled" />&nbsp;
        <span class="error" id="user_email_errorid"><?php if(array_key_exists('user_email_error', $form_array)) echo $form_array['user_email_error'];?></span>
    </p>
    <p>
        <label for="phone">Telephone<span class="compulsory">*</span></label>
        <input type="text" name="phone" id="phone_id" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];}else{echo $phone;}?>" />&nbsp;
        <span class="error" id="phone_errorid"><?php if(array_key_exists('phone_error', $form_array)) echo $form_array['phone_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
        <label for="schedule" style="margin-top:5px;">Schedule At<span class="compulsory">*</span></label>
        <input type="text" name="schedule" id="schedule_id" value="<?php if(isset($_POST['schedule'])){echo $_POST['schedule'];} else if(isset($schedule) && $schedule !="") {echo $schedule;} else {echo date('Y-m-d H:i:s');}?>" style="width:130px; background-color:#FFFFFF; padding:3px; margin:0px; font-size:12px;" />&nbsp;
        <span class="error" id="schedule_errorid"><?php if(array_key_exists('schedule_error', $form_array)) echo $form_array['schedule_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
        <label for="total_bookings" style="margin-top:5px;">Number in party<span class="compulsory">*</span></label>
        <?php $systemObj->fun_createSelectNumField("total_bookings", "total_bookings_id", "select60", $total_bookings, '', 1, 20); ?>&nbsp;
        <span class="error" id="total_bookings_errorid"><?php if(array_key_exists('total_bookings_error', $form_array)) echo $form_array['total_bookings_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
        <label for="total_amount"style="margin-top:5px;">Booking Amount</label>
        <input type="text" name="total_amount" id="total_amount_id" value="<?php if(isset($_POST['total_amount'])){echo $_POST['total_amount'];}else if(isset($total_amount) && $total_amount !="") {echo $total_amount;}?>" style="width:130px; background-color:#FFFFFF; padding:3px; margin:0px; font-size:12px;" />$&nbsp;
        <span class="error" id="total_amount_errorid"><?php if(array_key_exists('total_amount_error', $form_array)) echo $form_array['total_amount_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
        <label for="pay_method" style="margin-top:5px;">Payment Method</label>
        <select name="pay_method" id="pay_method_id" class="select216">
            <option value="0" <?php if($pay_method == 0 || $pay_method == "") {echo "selected=\"selected\"";} ?> >Payment method...</option>
            <option value="1" <?php if($pay_method == 1) {echo "selected=\"selected\"";} ?> >Cash</option>
            <option value="2" <?php if($pay_method == 2) {echo "selected=\"selected\"";} ?> >Credit Card</option>
            <option value="3" <?php if($pay_method == 3) {echo "selected=\"selected\"";} ?> >Cheque</option>
        </select>
        <br /><span class="error" id="pay_method_errorid"> <?php if(array_key_exists('pay_method_error', $form_array)) echo $form_array['pay_method_error'];?></span>
    </p>
    <p>
        <label for="payment_status"style="margin-top:5px;">Payment Status</label>
        <select name="payment_status" id="payment_status_id" class="select216">
            <option value="0" <?php if($payment_status == 0 || $payment_status == "") {echo "selected=\"selected\"";} ?> >Payment status...</option>
            <option value="1" <?php if($payment_status == 1) {echo "selected=\"selected\"";} ?> >Pending</option>
            <option value="2" <?php if($payment_status == 2) {echo "selected=\"selected\"";} ?> >Complete</option>
        </select>
        <br /><span class="error" id="payment_status_errorid"> <?php if(array_key_exists('payment_status_error', $form_array)) echo $form_array['payment_status_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
        <label for="instructions" style="margin-top:5px;">Special requests to the restaurant</label>
        <textarea name="instructions" id="instructions_id" style="width:310px; height:100px; border:thin #CCCCCC solid;" ><?php if(isset($_POST['instructions']) && $_POST['instructions'] != "") {echo $_POST['instructions'];} else{echo $instructions;} ?></textarea><br />
        <span class="font11"><em><strong>Note:</strong> We cannot guarantee restaurant can honor these requests</em></span><br />
        <span class="error" id="instructions_errorid"><?php if(array_key_exists('instructions_error', $form_array)) echo $form_array['instructions_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
        <label for="active" style="margin-top:5px;">Active</label>
        <select name="active" id="active_id" class="select216">
            <option value="0" <?php if($active == 0) {echo "selected=\"selected\"";} ?> >No</option>
            <option value="1" <?php if($active == 1) {echo "selected=\"selected\"";} ?> >Yes</option>
        </select>
        <br /><span class="error" id="active_errorid"> <?php if(array_key_exists('active_error', $form_array)) echo $form_array['active_error'];?></span>
    </p>
    <p style="clear:both; height:10px;">&nbsp;</p>
    <p>
        <label>&nbsp;</label>
        <a href="<?php echo "admin-book.php"; ?>" class="button-grey" style="color:#FFFFFF; text-decoration:none;">Cancel</a>&nbsp;<a href="javascript:void(0);" onclick="return validatefrm();" class="button-red" style="color:#FFFFFF; text-decoration:none;">Edit Now</a>
    </p>
</fieldset>
</form>
<?php
} else {
?>
<div class="floatRight pad-top5 pad-btm5" align="right">
    <a href="admin-book.php" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
</div>
<form name="frmBooking" id="frmBooking" method="post" action="admin-book.php?sec=add">
    <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("RESTAURANTBOOKING");?>" />
    <input type="hidden" name="status" id="status" value="1">
    <input type="hidden" name="currency_id" id="currency_id" value="1">
<fieldset>
<legend>Add Book Table</legend>
    <p>
        <label for="rest_id">Restaurant</label>
        <select name="rest_id" id="rest_id" class="select310">
            <option value="0">Select ... </option>
            <?php 
                $restObj->fun_getRestaurantOptionsList('', '');
            ?>
        </select>
        &nbsp;
        <span class="error" id="rest_id_errorid"><?php if(array_key_exists('rest_id_error', $form_array)) echo $form_array['rest_id_error'];?></span>
    </p>
    <p>
        <label for="user_fname">First Name<span class="compulsory">*</span></label>
        <input type="text" name="user_fname" id="user_fname_id" value="<?php if(isset($_POST['user_fname'])){echo $_POST['user_fname'];}?>" onkeydown="chkblnkTxtError('user_fname_id', 'user_fname_errorid');" onkeyup="chkblnkTxtError('user_fname_id', 'user_fname_errorid');" />&nbsp;
        <span class="error" id="user_fname_errorid"><?php if(array_key_exists('user_fname_error', $form_array)) echo $form_array['user_fname_error'];?></span>
    </p>
    <p>
        <label for="user_lname">Last Name<span class="compulsory">*</span></label>
        <input type="text" name="user_lname" id="user_lname_id" value="<?php if(isset($_POST['user_lname'])){echo $_POST['user_lname'];}?>" onkeydown="chkblnkTxtError('user_lname_id', 'user_lname_errorid');" onkeyup="chkblnkTxtError('user_lname_id', 'user_lname_errorid');" />&nbsp;
        <span class="error" id="user_lname_errorid"><?php if(array_key_exists('user_lname_error', $form_array)) echo $form_array['user_lname_error'];?></span>
    </p>
    <p>
        <label for="user_email">Email Address<span class="compulsory">*</span></label>
        <input type="text" name="user_email" id="user_email_id" value="<?php if(isset($_POST['user_email'])){echo $_POST['user_email'];}?>" />&nbsp;
        <span class="error" id="user_email_errorid"><?php if(array_key_exists('user_email_error', $form_array)) echo $form_array['user_email_error'];?></span>
    </p>
    <p>
        <label for="phone">Telephone<span class="compulsory">*</span></label>
        <input type="text" name="phone" id="phone_id" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];}?>" />&nbsp;
        <span class="error" id="phone_errorid"><?php if(array_key_exists('phone_error', $form_array)) echo $form_array['phone_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
        <label for="schedule" style="margin-top:5px;">Schedule At<span class="compulsory">*</span></label>
        <input type="text" name="schedule" id="schedule_id" value="<?php if(isset($_POST['schedule'])){echo $_POST['schedule'];} else {echo date('Y-m-d H:i:s');}?>" style="width:130px; background-color:#FFFFFF; padding:3px; margin:0px; font-size:12px;" />&nbsp;
        <span class="error" id="schedule_errorid"><?php if(array_key_exists('schedule_error', $form_array)) echo $form_array['schedule_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
        <label for="total_bookings" style="margin-top:5px;">Number in party<span class="compulsory">*</span></label>
        <?php $systemObj->fun_createSelectNumField("total_bookings", "total_bookings_id", "select60", $_POST['total_bookings'], 1, 1, 20); ?>&nbsp;
        <span class="error" id="total_bookings_errorid"><?php if(array_key_exists('total_bookings_error', $form_array)) echo $form_array['total_bookings_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
        <label for="total_amount" style="margin-top:5px;">Booking Amount</label>
        <input type="text" name="total_amount" id="total_amount_id" value="<?php if(isset($_POST['total_amount'])){echo $_POST['total_amount'];}?>" style="width:130px; background-color:#FFFFFF; padding:3px; margin:0px; font-size:12px;" />$&nbsp;
        <span class="error" id="total_amount_errorid"><?php if(array_key_exists('total_amount_error', $form_array)) echo $form_array['total_amount_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
        <label for="pay_method" style="margin-top:5px;">Payment Method</label>
        <select name="pay_method" id="pay_method_id" class="select216">
            <option value="0">Payment method...</option>
            <option value="1">Cash</option>
            <option value="2">Credit Card</option>
            <option value="3">Cheque</option>
        </select>
        <br /><span class="error" id="pay_method_errorid"> <?php if(array_key_exists('pay_method_error', $form_array)) echo $form_array['pay_method_error'];?></span>
    </p>
    <p>
        <label for="payment_status" style="margin-top:5px;">Payment Status</label>
        <select name="payment_status" id="payment_status_id" class="select216">
            <option value="0">Payment status...</option>
            <option value="1">Pending</option>
            <option value="2">Complete</option>
        </select>
        <br /><span class="error" id="payment_status_errorid"> <?php if(array_key_exists('payment_status_error', $form_array)) echo $form_array['payment_status_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
        <label for="instructions" style="margin-top:5px;">Special requests to the restaurant</label>
        <textarea name="instructions" id="instructions_id" style="width:310px; height:100px; border:thin #CCCCCC solid;" ><?php if(isset($_POST['instructions']) && $_POST['instructions'] != "") {echo $_POST['instructions'];}?></textarea><br />
        <!--<span class="font11"><em><strong>Note:</strong> We cannot guarantee restaurant can honor these requests</em></span><br />-->
        <span class="error" id="instructions_errorid"><?php if(array_key_exists('instructions_error', $form_array)) echo $form_array['instructions_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
        <label for="active" style="margin-top:5px;">Active</label>
        <select name="active" id="active_id" class="select216">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
        <br /><span class="error" id="active_errorid"> <?php if(array_key_exists('active_error', $form_array)) echo $form_array['active_error'];?></span>
    </p>
    <p style="clear:both; height:10px;">&nbsp;</p>
    <p>
        <label>&nbsp;</label>
        <a href="<?php echo "admin-book.php"; ?>" class="button-grey" style="color:#FFFFFF; text-decoration:none;">Cancel</a>&nbsp;<a href="javascript:void(0);" onclick="return validatefrm();" class="button-red" style="color:#FFFFFF; text-decoration:none;">Add Now</a>
    </p>
</fieldset>
</form>
<?php
}
?>