<script type="text/javascript" language="javascript">
   
   function returnfrm(){
		if(document.getElementById("discount_name_id").value == "") {
			document.getElementById("discount_name_errorid").innerHTML = "Discount Name required";
			document.getElementById("discount_name_id").focus();
			return false;
		}
		if(document.getElementById("discount_value_id").value == "") {
			document.getElementById("discount_value_errorid").innerHTML = "Discount value required";
			document.getElementById("discount_value_id").focus();
			return false;
		}
		if(document.getElementById("discount_type_id").value == "") {
			document.getElementById("discount_value_errorid").innerHTML = "Discount Type required";
			document.getElementById("discount_type_id").focus();
			return false;
		}
		if(document.getElementById("discount_min_amt_id").value == "") {
			document.getElementById("discount_min_amt_errorid").innerHTML = "Min.Amounts required";
			document.getElementById("discount_min_amt_id").focus();
			return false;
		}
		if(document.getElementById("arrival_date").value == "") {
			document.getElementById("discount_start_date_errorid").innerHTML = "Start date required";
			document.getElementById("arrival_date").focus();
			return false;
		}
		if(document.getElementById("departure_date").value == "") {
			document.getElementById("discount_end_date_errorid").innerHTML = "End date required";
			document.getElementById("departure_date").focus();
			return false;
		}
		
		if(document.getElementById("discount_comments_id").value == "") {
			document.getElementById("discount_comments_errorid").innerHTML = "Discount Notes required";
			document.getElementById("discount_comments_id").focus();
			return false;
		}
		
      document.frmDiscount.submit();	
	}
	function chkblnkTxtError(strFieldId, strErrorFieldId) {
		if(document.getElementById(strFieldId).value != "") {
			document.getElementById(strErrorFieldId).innerHTML = "";
		}
	}
</script>
<?php
   if(isset($desc_id) && $desc_id !=""){
   $discInfo 	= $restObj->fun_getRestaurantInfo($desc_id);
?>
<form name="frmDiscount" id="frmDiscount" method="post" action="admin-restaurant-discount.php?sec=edit&desc_id=<?php echo $desc_id;?>">
<input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITDISCOUNT"); ?>">
 <input type="hidden" name="desc_id" id="desc_id" value="<?php echo $desc_id; ?>">
  <fieldset>
      <legend>Edit Discount</legend>
         <p><label for="discount_name">Discount Name</label><input type="text" name="discount_name" id="discount_name_id" value="<?php if(isset($_POST['discount_name'])){echo $_POST['discount_name'];}else{echo $discInfo['discount_name'];}?>" onkeydown="chkblnkTxtError('user_fname_id', 'discount_name_errorid');" onkeyup="chkblnkTxtError('discount_name_id', 'discount_name_errorid');" />&nbsp;<span class="error" id="discount_name_errorid"><?php if(array_key_exists('discount_name_error', $form_array)) echo $form_array['discount_name_error'];?> </span></p>
         <p><label>Discount</label>
         <input type="text" name="discount_value" id="discount_value_id" class="inpuTxt215"  value="<?php if(isset($_POST['discount_value'])){echo $_POST['discount_value'];}else{echo $discInfo['discount_value'];}?>" onkeydown="chkblnkTxtError('discount_value_id', 'discount_value_errorid');" onkeyup="chkblnkTxtError('discount_value_id', 'discount_value_errorid');" />
          <select name="discount_type" id="discount_type_id" value="<?php if(isset($_POST['discount_type'])){echo $_POST['discount_type'];}else{echo $discInfo['discount_type'];}?>" class="select80">
            <option value="0">%</option>
            <option value="1">$</option>
          </select>
         &nbsp;<span class="error" id="discount_value_errorid"><?php if(array_key_exists('discount_value_error', $form_array)) echo $form_array['discount_value_error'];?></span></p>
         <p><label for="discount_min_amt">Min. Amt</label><input type="text" name="discount_min_amt" id="discount_min_amt_id" value="<?php if(isset($_POST['discount_min_amt'])){echo $_POST['discount_min_amt'];}else{echo $discInfo['discount_min_amt'];}?>" onkeydown="chkblnkTxtError('discount_min_amt_id', 'discount_min_amt_errorid');" onkeyup="chkblnkTxtError('discount_min_amt_id', 'discount_min_amt_errorid');" />&nbsp;<span class="error" id="discount_min_amt_errorid"><?php if(array_key_exists('discount_min_amt_error', $form_array)) echo $form_array['discount_min_amt_error'];?> </span></p>
         <p><label for="discount_service_type">Service Type</label>
         <input type="checkbox" class="checkbox" name="discount_service_type" id="discount_service_type_id" value="0" onclick="" /><strong class="pad-lft20">Pickup</strong>
         <span class="pad-lft20"><input type="checkbox" class="checkbox" name="" id="" value="1" onclick="" /></span> <strong class="pad-lft20">Delivery</strong> 
         
          </p>
         <p><label for="discount_pre_tax">Pre-Tax</label><input type="checkbox" class="checkbox" name="discount_pre_tax" id="discount_pre_tax_id" value="0" onclick="" /></p>
         <p><label for="discount_start_date">start date</label>
            <input type="text" name="arrival_date" id="arrival_date" value="<?php if(isset($_POST['discount_start_date'])){echo $_POST['discount_start_date'];}else{echo $discInfo['discount_start_date'];}?>" class="inpuTxt155">
          &nbsp;<span class="error" id="discount_start_date_errorid"><?php if(array_key_exists('discount_start_date', $form_array)) echo $form_array['discount_start_date'];?></span> 
         </p>
         <p><label for="event_name">end date</label>
             <input type="text" name="departure_date" id="departure_date" value="<?php if(isset($_POST['discount_end_date'])){echo $_POST['discount_end_date'];}else{echo $discInfo['discount_end_date'];}?>" class="inpuTxt155">
          &nbsp;<span class="error" id="discount_end_date_errorid"><?php if(array_key_exists('discount_end_date', $form_array)) echo $form_array['discount_end_date'];?></span> 
        </p>
        <p><label for="discount_comments">Notes</label><textarea type="text" name="discount_comments" id="discount_comments_id" value="" onkeydown="chkblnkTxtError('discount_comments_id', 'discount_comments_errorid');" onkeyup="chkblnkTxtError('discount_comments_id', 'discount_comments_errorid');" /><?php if(isset($_POST['discount_comments'])){echo $_POST['discount_comments'];}else{echo $discInfo['discount_comments'];}?></textarea> &nbsp;<span class="error" id="discount_comments_errorid"> <?php if(array_key_exists('discount_comments_error', $form_array)) echo $form_array['discount_comments_error'];?></span></p>
        <p><label for="status">Status</label>
        <input type="radio" class="radio" name="txtStatus" id="txtStatusId1" value="1" <?php if(isset($discInfo['status']) && $discInfo['status'] == "1") {echo "checked=\"checked\"";} ?> onclick="hideField('tblShwDateId');void(0);"/><strong>Active </strong><span class="pad-lft20">
        
        <input type="radio" class="radio" name="txtStatus" id="txtStatusId2" value="0" <?php if(isset($discInfo['status']) && $discInfo['status'] == "0") {echo "checked=\"checked\"";} ?>/></span> <strong>Disabled</strong></p> 
        <p><label>&nbsp;</label> <a href="javascript:void(0);" style="text-decoration:none;"><img src="<?php echo SITE_ADMIN_IMAGES;?>edit_btn.gif" border="0" onclick="returnfrm();" /></a></p>
    </fieldset>
</form>
<?php
   } else {
?>
<form name="frmDiscount" id="frmDiscount" method="post" action="admin-restaurant-discount.php">
<input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("ADDNEWDISCOUNT"); ?>">
  <fieldset>
      <legend>Add Discount</legend>
         <p><label for="discount_name">Discount Name</label><input type="text" name="discount_name" id="discount_name_id" value="<?php if(isset($_POST['discount_name'])){echo $_POST['discount_name'];}else{echo $discInfo['discount_name'];}?>" onkeydown="chkblnkTxtError('user_fname_id', 'discount_name_errorid');" onkeyup="chkblnkTxtError('discount_name_id', 'discount_name_errorid');" />&nbsp;<span class="error" id="discount_name_errorid"><?php if(array_key_exists('discount_name_error', $form_array)) echo $form_array['discount_name_error'];?> </span></p>
         <p><label>Discount</label>
             <input type="text" name="discount_value" id="discount_value_id" class="inpuTxt215"  value="<?php if(isset($_POST['discount_value'])){echo $_POST['discount_value'];}else{echo $discInfo['discount_value'];}?>" onkeydown="chkblnkTxtError('discount_value_id', 'discount_value_errorid');" onkeyup="chkblnkTxtError('discount_value_id', 'discount_value_errorid');" />
              <select name="discount_type" id="discount_type_id" class="select80">
                <option value="0" selected="selected">%</option>
                <option value="1" selected>$</option>
              </select>
             &nbsp;<span class="error" id="discount_value_errorid"><?php if(array_key_exists('discount_value_error', $form_array)) echo $form_array['discount_value_error'];?></span></p>
         <p><label for="discount_min_amt">Min. Amt</label><input type="text" name="discount_min_amt" id="discount_min_amt_id" value="<?php if(isset($_POST['discount_min_amt'])){echo $_POST['discount_min_amt'];}else{echo $discInfo['discount_min_amt'];}?>" onkeydown="chkblnkTxtError('discount_min_amt_id', 'discount_min_amt_errorid');" onkeyup="chkblnkTxtError('discount_min_amt_id', 'discount_min_amt_errorid');" />&nbsp;<span class="error" id="discount_min_amt_errorid"><?php if(array_key_exists('discount_min_amt_error', $form_array)) echo $form_array['discount_min_amt_error'];?> </span></p>
         <p><label for="discount_service_type">Service Type</label>
         <div>
             <?php
				$restObj->fun_createDiscountStyle($restInfo['rest_id']);
			?>
            </div>
         </p>
         <p><label for="discount_pre_tax">Pre-Tax</label>
            <input type="checkbox" class="checkbox" name="discount_pre_tax" id="discount_pre_tax_id" value="1" onclick="" /></p> 
         <p><label for="discount_start_date">start date</label>
            <input type="text" name="arrival_date" id="arrival_date"  class="inpuTxt155">
            &nbsp;<span class="error" id="discount_start_date_errorid"><?php if(array_key_exists('discount_start_date', $form_array)) echo $form_array['discount_start_date'];?></span> 
         </p>
         <p><label for="event_name">end date</label>
             <input type="text" name="departure_date" id="departure_date"  class="inpuTxt155">
             &nbsp;<span class="error" id="discount_end_date_errorid"><?php if(array_key_exists('discount_end_date', $form_array)) echo $form_array['discount_end_date'];?></span> 
        </p>
        <p><label for="discount_comments">Notes</label><textarea type="text" name="discount_comments" id="discount_comments_id" value="" onkeydown="chkblnkTxtError('discount_comments_id', 'discount_comments_errorid');" onkeyup="chkblnkTxtError('discount_comments_id', 'discount_comments_errorid');" /></textarea> &nbsp;<span class="error" id="discount_comments_errorid"> <?php if(array_key_exists('discount_comments_error', $form_array)) echo $form_array['discount_comments_error'];?></span></p>
        <p><label for="status">Status</label>
            <input type="radio" class="radio" name="txtStatus" id="txtStatusId1" value="1" /><strong>Active </strong><span class="pad-lft20">
            <input type="radio" class="radio" name="txtStatus" id="txtStatusId2" value="0"/></span> <strong>Disabled</strong></p> 
        <p><label>&nbsp;</label> <a href="javascript:void(0);" style="text-decoration:none;"><img src="<?php echo SITE_ADMIN_IMAGES;?>addnow_btn.gif" border="0" onclick="returnfrm();" /></a></p>
    </fieldset>
</form>
<?php
}
?>