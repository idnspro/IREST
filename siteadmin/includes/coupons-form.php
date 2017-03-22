<?php
$rest_id 	= $_REQUEST['rest_id'];
$rest_name 	= $restObj->fun_getRestaurantNameById($rest_id);
?>
<script type="text/javascript" language="javascript">
	function chkblnkTxtError(strFieldId, strErrorFieldId){
		if(document.getElementById(strFieldId).value != ""){
			document.getElementById(strErrorFieldId).innerHTML = "";
		}
	}

	function validatefrm(){
		var alreadyFocussed = false;
		document.frmCoupon.coupon_desc_id.value = tinyMCE.get('coupon_desc_id').getContent();

		if(document.getElementById("coupon_name_id").value == "") {
			document.getElementById("coupon_name_errorid").innerHTML = "Coupon name required";
			document.getElementById("coupon_name_id").focus();
			return false;
		}

		if(document.getElementById("coupon_code_id").value == "") {
			document.getElementById("coupon_code_errorid").innerHTML = "Coupon code required";
			document.getElementById("coupon_code_id").focus();
			return false;
		}
		
		if(document.getElementById("coupon_discount_id").value == "") {
			document.getElementById("coupon_discount_errorid").innerHTML = "Coupon discount required";
			document.getElementById("coupon_discount_id").focus();
			return false;
		}

		if(document.frmCoupon.coupon_desc_id.value == "") {
			document.getElementById("coupon_desc_errorid").innerHTML = "Description required";
			document.getElementById("coupon_desc_id").focus();
			if(!alreadyFocussed){
				document.frmCoupon.coupon_desc_id.focus();
				alreadyFocussed = true;
			}
			return false;
		}
		document.frmCoupon.submit();
	}

	// Will add a "Clear dates" button to any datepicker
	function addClearDatesButton() {
		var old_fn = $.datepicker._updateDatepicker;
	
		$.datepicker._updateDatepicker = function (inst) {
			old_fn.call(this, inst);
	
			var buttonPane = $(this).datepicker("widget").find(".ui-datepicker-buttonpane");
	
			// Remove the default buttons that we don't like
			buttonPane.find(".ui-datepicker-current").remove();
			buttonPane.find(".ui-datepicker-close").remove();
	
			// Add the clear button
			$("<button type='button' class='ui-datepicker-clean ui-state-default ui-priority-primary ui-corner-all'>Clear date</button>").appendTo(buttonPane).click(function (ev) {
				$.datepicker._clearDate(inst.input);
				$(inst.input).attr("value", "yy-mm-dd").css("color", "#999999");
			});
		}
	}
	
	// Function to use with onSelect of a date picker so that it sets the other date one week in advance and prevents selection of prior dates
	// inputStart and inputEnd are expected to be jquery objects (i.e. $("#foo"))
	function autoUpdateOther(selectedDate, inputStart, inputEnd) {
		if (inputStart.val() == null) { return; }
	
		var instance = inputStart.data("datepicker"),
			dateFormat = 'yy-mm-dd',
			date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings),
			nextDay;
	
		if (date == null) {
			inputEnd.datepicker("option", "minDate", new Date((new Date()).getTime() + 86400000));
			return;
		}
	
		nextDay = new Date(date.getTime());
		nextDay.setDate(nextDay.getDate() + 1);
		inputEnd.datepicker("option", "minDate", nextDay);
		if (inputEnd.val().length == 0) {
			date.setDate(date.getDate() + 1);
			inputEnd.datepicker("setDate", date);
		}
	}

</script>
<!-- TinyMCE -->
<script type="text/javascript" src="../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
    tinyMCE.init({
        mode : "exact",
        elements : "coupon_desc_id",
        theme : "advanced",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        
    });

    function myHandleEvent(e){
        if(e.type=="keyup"){
            chkblnkEditorTxtError("coupon_desc_id", "coupon_desc_errorid");	
        }
        return true;
    }
</script>
<!-- /TinyMCE -->

<script type="text/javascript">
	<?php /*?>
	$(document).ready(function(){
		$("#start_date").datepicker({
		dateFormat: 'yy-mm-dd'
		});
	});
	$(document).ready(function(){
		$("#end_date").datepicker({
		dateFormat: 'yy-mm-dd'
		});
	});
	<?php */?>

	$(document).ready(function(){
		var startPicker = $("#start_date"), endPicker = $("#end_date");

		startPicker.datepicker({
			minDate: new Date(),
			dateFormat: 'yy-mm-dd',
			onSelect: function (selectedDate) {
				autoUpdateOther(selectedDate, startPicker, endPicker);
				startPicker.css("color", "#000000");
				endPicker.css("color", "#000000");
			}
		}).attr("readonly", "readonly")
		.css("color", "#999999");
	
		endPicker.datepicker({
			minDate: new Date((new Date()).getTime() + 86400000), // Tomorrow
			dateFormat: 'yy-mm-dd',
			onSelect: function () {
				endPicker.css("color", "#000000");
			}
		}).attr("readonly", "readonly")
		.css("color", "#999999");

		addClearDatesButton();
	});
</script>
<?php
if(isset($coupon_id) && $coupon_id !=""){
   $couponInfo 	= $restObj->fun_getcouponInfoById($coupon_id);
?>
<div class="floatRight pad-top5 pad-btm5" align="right">
    <a href="admin-restaurant-coupons.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Back to Coupon List</a>&nbsp;
</div>
<form name="frmCoupon" id="frmCoupon" method="post" action="admin-restaurant-coupons.php?sec=edit&coupon_id=<?php echo $coupon_id;?>&rest_id=<?php echo $rest_id;?>" enctype="multipart/form-data">
<input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITCOUPON"); ?>" />
<input type="hidden" name="rest_id" id="rest_id_id" value="<?php echo $rest_id; ?>">
<input type="hidden" name="coupon_id" id="coupon_id_id" value="<?php echo $coupon_id; ?>">
<input type="hidden" name="coupon_auto_distributed" id="coupon_auto_distributed_id" value="0">
<input type="hidden" name="back_url" id="back_url" value="<?php echo $_GET['back_url']; ?>">
<fieldset>
<legend>Edit Coupon</legend>
    <p>
    	<label for="coupon_name">Coupon Name</label>
        <input type="text" name="coupon_name" id="coupon_name_id" value="<?php if(isset($_POST['coupon_name'])){echo $_POST['coupon_name'];}else{echo $couponInfo['coupon_name'];}?>" onkeydown="chkblnkTxtError('coupon_name_id', 'coupon_name_errorid');" onkeyup="chkblnkTxtError('coupon_name_id', 'coupon_name_errorid');" />&nbsp;
        <span class="error" id="coupon_name_errorid"><?php if(array_key_exists('coupon_name_error', $form_array)) echo $form_array['coupon_name_error'];?></span>
    </p>
    <p>
    	<label for="coupon_code">Coupon Code</label>
        <input type="text" name="coupon_code" id="coupon_code_id" value="<?php if(isset($_POST['coupon_code'])){echo $_POST['coupon_code'];}else{echo $couponInfo['coupon_code'];}?>" onkeydown="chkblnkTxtError('coupon_code_id', 'coupon_code_errorid');" onkeyup="chkblnkTxtError('coupon_code_id', 'coupon_code_errorid');" />&nbsp;
        <span class="error" id="coupon_code_errorid"><?php if(array_key_exists('coupon_code_error', $form_array)) echo $form_array['coupon_code_error'];?></span>
    </p>
    <p>
        <label for="coupon_discount">Coupon Discount</label>
        <input type="text" name="coupon_discount" id="coupon_discount_id" value="<?php if(isset($_POST['coupon_discount'])){echo $_POST['coupon_discount'];}else{echo $couponInfo['coupon_discount'];}?>"/>&nbsp;
        <select name="coupon_discount_type" id="coupon_discount_type_id" class="select310" style="width:60px;">
             <option value="0" <?php if($couponInfo['coupon_discount_type'] == "0") { echo " selected=\"selected\"";} ?>>%</option>
             <option value="1" <?php if($couponInfo['coupon_discount_type'] == "1") { echo " selected=\"selected\"";} ?>>$</option>
        </select>
    </p>
    <p>
        <label for="coupon_type">Coupon Type</label>
        <select name="coupon_type" id="coupon_type_id" class="select310">
             <option value="0" <?php if($couponInfo['coupon_type'] == "0") { echo " selected=\"selected\"";} ?>>Generic</option>
             <option value="1" <?php if($couponInfo['coupon_type'] == "1") { echo " selected=\"selected\"";} ?>>Specific</option>
        </select>
    </p>
    <p>
        <label for="coupon_pre_tax">Pre-Tax</label>
        <select name="coupon_pre_tax" id="coupon_pre_tax_id" class="select310">
             <option value="0" <?php if($couponInfo['coupon_pre_tax'] == "0") { echo " selected=\"selected\"";} ?>>No</option>
             <option value="1" <?php if($couponInfo['coupon_pre_tax'] == "1") { echo " selected=\"selected\"";} ?>>Yes</option>
        </select>
    </p>
    <p>
        <label for="coupon_start_date">Start Date</label>
        <input type="text" name="coupon_start_date" id="start_date" class="inpuTxt510" placeholder="yyyy-mm-dd" value="<?php if(isset($_POST['coupon_start_date'])){echo $_POST['coupon_start_date'];}else{echo $couponInfo['coupon_start_date'];}?>" style="width:200px;"/>
    </p>
    <p>
        <label for="coupon_end_date">End Date</label>
        <input type="text" name="coupon_end_date" id="end_date" class="inpuTxt510" placeholder="yyyy-mm-dd" value="<?php if(isset($_POST['coupon_end_date'])){echo $_POST['coupon_end_date'];}else{echo $couponInfo['coupon_end_date'];}?>" style="width:200px;"/>
    </p>
	<?php /*?>
    <p>
    	<label for="coupon_duration">Duration</label>
        <input type="text" name="coupon_duration" id="coupon_duration_id" value="<?php if(isset($_POST['coupon_duration'])){echo $_POST['coupon_duration'];}else{echo $couponInfo['coupon_duration'];}?>"/>&nbsp;
        <select name="coupon_duration_type" id="coupon_duration_type_id" class="select310" style="width:80px;">
             <option value="0" <?php if($couponInfo['coupon_duration_type'] == "0") { echo " selected=\"selected\"";} ?>>Days</option>
             <option value="1" <?php if($couponInfo['coupon_duration_type'] == "1") { echo " selected=\"selected\"";} ?>>Weeks</option>
             <option value="2" <?php if($couponInfo['coupon_duration_type'] == "2") { echo " selected=\"selected\"";} ?>>Months</option>
             <option value="3" <?php if($couponInfo['coupon_duration_type'] == "3") { echo " selected=\"selected\"";} ?>>Years</option>
        </select>
    </p>
    <p>
    	<label for="coupon_loyalty">Duration</label>
        <input type="text" name="coupon_loyalty" id="coupon_loyalty_id" value="<?php if(isset($_POST['coupon_loyalty'])){echo $_POST['coupon_loyalty'];}else{echo $couponInfo['coupon_loyalty'];}?>"/>&nbsp;
        <select name="coupon_loyalty_type" id="coupon_loyalty_type_id" class="select310" style="width:80px;">
             <option value="0" <?php if($couponInfo['coupon_loyalty_type'] == "0") { echo " selected=\"selected\"";} ?>>Days</option>
             <option value="1" <?php if($couponInfo['coupon_loyalty_type'] == "1") { echo " selected=\"selected\"";} ?>>Weeks</option>
             <option value="2" <?php if($couponInfo['coupon_loyalty_type'] == "2") { echo " selected=\"selected\"";} ?>>Months</option>
             <option value="3" <?php if($couponInfo['coupon_loyalty_type'] == "3") { echo " selected=\"selected\"";} ?>>Years</option>
        </select>
    </p>
	<?php */?>
    <p>
    	<label for="coupon_takeup">Total Takeup</label>
        <input type="text" name="coupon_takeup" id="coupon_takeup_id" value="<?php if(isset($_POST['coupon_takeup'])){echo $_POST['coupon_takeup'];}else{echo $couponInfo['coupon_takeup'];}?>" />&nbsp;
        <span class="error" id="coupon_takeup_errorid"><?php if(array_key_exists('coupon_takeup_error', $form_array)) echo $form_array['coupon_takeup_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
    	<label for="coupon_desc">Description</label>
        <textarea type="text" name="coupon_desc" id="coupon_desc_id"  onkeydown="chkblnkTxtError('coupon_desc_id', 'coupon_desc_errorid');" onkeyup="chkblnkTxtError('coupon_desc_id', 'coupon_desc_errorid');" /><?php if(isset($_POST['coupon_desc'])){echo $_POST['coupon_desc'];}else{echo $couponInfo['coupon_desc'];}?></textarea>
        &nbsp;<span class="error" id="coupon_desc_errorid"><?php if(array_key_exists('coupon_desc_id', $form_array)) echo $form_array['coupon_desc_error'];?></span>
    </p> 
    <p>
        <label for="status">Active</label>
        <select name="status" id="status_id" class="select216">
            <option value="0" <?php if($couponInfo['status'] == 0) {echo "selected=\"selected\"";} ?> >No</option>
            <option value="1" <?php if($couponInfo['status'] == 1) {echo "selected=\"selected\"";} ?> >Yes</option>
        </select>
        <br /><span class="error" id="status_errorid"> <?php if(array_key_exists('status_error', $form_array)) echo $form_array['status_error'];?></span>
    </p>
    <p>
        <label>&nbsp;</label>
        <a href="<?php echo "admin-restaurant-coupons.php?rest_id=".$rest_id."&back_url=".$_GET['back_url']; ?>" class="button-grey">Cancel</a>&nbsp;<a href="javascript:void(0);" onclick="return validatefrm();" class="button-red">Edit Now</a>
    </p>
</fieldset>
</form>
<?php
} else {
?>
<div class="floatRight pad-top5 pad-btm5" align="right">
    <a href="admin-restaurant-coupons.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Back to Coupon List</a>&nbsp;
</div>
<form name="frmCoupon" id="frmCoupon" method="post" action="admin-restaurant-coupons.php?sec=add" enctype="multipart/form-data">
<input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("ADDCOUPON"); ?>" />
<input type="hidden" name="rest_id" id="rest_id_id" value="<?php echo $rest_id; ?>">
<input type="hidden" name="coupon_auto_distributed" id="coupon_auto_distributed_id" value="0">
<input type="hidden" name="back_url" id="back_url" value="<?php echo $_GET['back_url']; ?>">
<fieldset>
<legend>Add Coupon</legend>
    <p>
    	<label for="coupon_name">Coupon Name</label>
        <input type="text" name="coupon_name" id="coupon_name_id" value="<?php if(isset($_POST['coupon_name'])){echo $_POST['coupon_name'];}else{echo $couponInfo['coupon_name'];}?>" onkeydown="chkblnkTxtError('coupon_name_id', 'coupon_name_errorid');" onkeyup="chkblnkTxtError('coupon_name_id', 'coupon_name_errorid');" />&nbsp;
        <span class="error" id="coupon_name_errorid"><?php if(array_key_exists('coupon_name_error', $form_array)) echo $form_array['coupon_name_error'];?></span>
    </p>
    <p>
    	<label for="coupon_code">Coupon Code</label>
        <input type="text" name="coupon_code" id="coupon_code_id" value="<?php if(isset($_POST['coupon_code'])){echo $_POST['coupon_code'];}else{echo $couponInfo['coupon_code'];}?>" onkeydown="chkblnkTxtError('coupon_code_id', 'coupon_code_errorid');" onkeyup="chkblnkTxtError('coupon_code_id', 'coupon_code_errorid');" />&nbsp;
        <span class="error" id="coupon_code_errorid"><?php if(array_key_exists('coupon_code_error', $form_array)) echo $form_array['coupon_code_error'];?></span>
    </p>
    <p>
        <label for="coupon_discount">Coupon Discount</label>
        <input type="text" name="coupon_discount" id="coupon_discount_id" value="<?php if(isset($_POST['coupon_discount'])){echo $_POST['coupon_discount'];}else{echo $couponInfo['coupon_discount'];}?>"/>&nbsp;
        <select name="coupon_discount_type" id="coupon_discount_type_id" class="select310" style="width:60px;">
             <option value="0" <?php if($couponInfo['coupon_discount_type'] == "0") { echo " selected=\"selected\"";} ?>>%</option>
             <option value="1" <?php if($couponInfo['coupon_discount_type'] == "1") { echo " selected=\"selected\"";} ?>>$</option>
        </select>
    </p>
    <p>
        <label for="coupon_type">Coupon Type</label>
        <select name="coupon_type" id="coupon_type_id" class="select310">
             <option value="0" <?php if($couponInfo['coupon_type'] == "0") { echo " selected=\"selected\"";} ?>>Generic</option>
             <option value="1" <?php if($couponInfo['coupon_type'] == "1") { echo " selected=\"selected\"";} ?>>Specific</option>
        </select>
    </p>
    <p>
        <label for="coupon_pre_tax">Pre-Tax</label>
        <select name="coupon_pre_tax" id="coupon_pre_tax_id" class="select310">
             <option value="0" <?php if($couponInfo['coupon_pre_tax'] == "0") { echo " selected=\"selected\"";} ?>>No</option>
             <option value="1" <?php if($couponInfo['coupon_pre_tax'] == "1") { echo " selected=\"selected\"";} ?>>Yes</option>
        </select>
    </p>

    <p>
        <label for="coupon_start_date">Start Date</label>
        <input type="text" name="coupon_start_date" id="start_date" class="inpuTxt510" placeholder="yyyy-mm-dd" value="<?php if(isset($_POST['coupon_start_date'])){echo $_POST['coupon_start_date'];}else{echo $couponInfo['coupon_start_date'];}?>" style="width:200px;"/>
    </p>
    <p>
        <label for="coupon_end_date">End Date</label>
        <input type="text" name="coupon_end_date" id="end_date" class="inpuTxt510" placeholder="yyyy-mm-dd" value="<?php if(isset($_POST['coupon_end_date'])){echo $_POST['coupon_end_date'];}else{echo $couponInfo['coupon_end_date'];}?>" style="width:200px;"/>
    </p>
	<?php /*?>
    <p>
    	<label for="coupon_duration">Duration</label>
        <input type="text" name="coupon_duration" id="coupon_duration_id" value="<?php if(isset($_POST['coupon_duration'])){echo $_POST['coupon_duration'];}else{echo $couponInfo['coupon_duration'];}?>"/>&nbsp;
        <select name="coupon_duration_type" id="coupon_duration_type_id" class="select310" style="width:80px;">
             <option value="0" <?php if($couponInfo['coupon_duration_type'] == "0") { echo " selected=\"selected\"";} ?>>Days</option>
             <option value="1" <?php if($couponInfo['coupon_duration_type'] == "1") { echo " selected=\"selected\"";} ?>>Weeks</option>
             <option value="2" <?php if($couponInfo['coupon_duration_type'] == "2") { echo " selected=\"selected\"";} ?>>Months</option>
             <option value="3" <?php if($couponInfo['coupon_duration_type'] == "3") { echo " selected=\"selected\"";} ?>>Years</option>
        </select>
    </p>
    <p>
    	<label for="coupon_loyalty">Duration</label>
        <input type="text" name="coupon_loyalty" id="coupon_loyalty_id" value="<?php if(isset($_POST['coupon_loyalty'])){echo $_POST['coupon_loyalty'];}else{echo $couponInfo['coupon_loyalty'];}?>"/>&nbsp;
        <select name="coupon_loyalty_type" id="coupon_loyalty_type_id" class="select310" style="width:80px;">
             <option value="0" <?php if($couponInfo['coupon_loyalty_type'] == "0") { echo " selected=\"selected\"";} ?>>Days</option>
             <option value="1" <?php if($couponInfo['coupon_loyalty_type'] == "1") { echo " selected=\"selected\"";} ?>>Weeks</option>
             <option value="2" <?php if($couponInfo['coupon_loyalty_type'] == "2") { echo " selected=\"selected\"";} ?>>Months</option>
             <option value="3" <?php if($couponInfo['coupon_loyalty_type'] == "3") { echo " selected=\"selected\"";} ?>>Years</option>
        </select>
    </p>
	<?php */?>
    <p>
    	<label for="coupon_takeup">Total Takeup</label>
        <input type="text" name="coupon_takeup" id="coupon_takeup_id" value="<?php if(isset($_POST['coupon_takeup'])){echo $_POST['coupon_takeup'];}else{echo $couponInfo['coupon_takeup'];}?>" />&nbsp;
        <span class="error" id="coupon_takeup_errorid"><?php if(array_key_exists('coupon_takeup_error', $form_array)) echo $form_array['coupon_takeup_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
    	<label for="coupon_desc">Description</label>
        <textarea type="text" name="coupon_desc" id="coupon_desc_id"  onkeydown="chkblnkTxtError('coupon_desc_id', 'coupon_desc_errorid');" onkeyup="chkblnkTxtError('coupon_desc_id', 'coupon_desc_errorid');" /><?php if(isset($_POST['coupon_desc'])){echo $_POST['coupon_desc'];}else{echo $couponInfo['coupon_desc'];}?></textarea>
        &nbsp;<span class="error" id="coupon_desc_errorid"><?php if(array_key_exists('coupon_desc_id', $form_array)) echo $form_array['coupon_desc_error'];?></span>
    </p> 
    <p>
        <label for="status">Active</label>
        <select name="status" id="status_id" class="select216">
            <option value="0" <?php if($couponInfo['status'] == 0) {echo "selected=\"selected\"";} ?> >No</option>
            <option value="1" <?php if($couponInfo['status'] == 1) {echo "selected=\"selected\"";} ?> >Yes</option>
        </select>
        <br /><span class="error" id="status_errorid"> <?php if(array_key_exists('status_error', $form_array)) echo $form_array['status_error'];?></span>
    </p>
    <p>
        <label>&nbsp;</label>
        <a href="<?php echo "admin-restaurant-coupons.php?rest_id=".$rest_id."&back_url=".$_GET['back_url']; ?>" class="button85x30-grey">Cancel</a>&nbsp;<a href="javascript:void(0);" onclick="return validatefrm();" class="button85x30-red">Add Now</a>
    </p>
</fieldset>
</form>
<?php
}
?>