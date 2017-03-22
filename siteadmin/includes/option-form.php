<script type="text/javascript" language="javascript">
function chkblnkTxtError(strFieldId, strErrorFieldId){
	if(document.getElementById(strFieldId).value != ""){
	  document.getElementById(strErrorFieldId).innerHTML = "";
	}
}

function validatefrm(){
	if(document.getElementById("option_name_id").value == "") {
		document.getElementById("option_name_errorid").innerHTML = "category name required";
		document.getElementById("option_name_id").focus();
		return false;
	}
	document.frmOpt.submit();
}
</script>
<?php
if(isset($option_id) && $option_id !=""){
	$optInfo = $restObj->fun_getMenuOptionInfoById($option_id);
	?>
    <form name="frmOpt" id="frmOpt" method="post" action="admin-settings.php?sec=option&show=option&action=edit&category_id=<?php echo $category_id;?>&option_id=<?php echo $option_id;?>" enctype="multipart/form-data">
        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITOPT"); ?>">
        <input type="hidden" name="category_id" id="category_id_id" value="<?php echo $category_id; ?>">
        <input type="hidden" name="option_id" id="option_id_id" value="<?php echo $option_id; ?>">
        <fieldset>
        <legend><?php echo $addtitle; ?></legend>
            <div class="floatRight pad-top5 pad-btm5" align="right">
                <a href="admin-settings.php?sec=option&show=option&category_id=<?php echo $category_id; ?>" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
            </div>
            <p>
                <label for="option_name">Option Name</label>
                <input type="text" name="option_name" id="option_name_id" value="<?php if(isset($_POST['option_name'])){echo $_POST['option_name'];}else{echo $optInfo['option_name'];}?>" onkeydown="chkblnkTxtError('option_name_id', 'option_name_errorid');" onkeyup="chkblnkTxtError('option_name_id', 'option_name_errorid');" />
                &nbsp;<span class="error" id="option_name_errorid"><?php if(array_key_exists('option_name_error', $form_array)) echo $form_array['option_name_error'];?> </span>
            </p>
            <p>&nbsp;</p>
            <p>
                <label>&nbsp;</label>
                <a href="javascript:void(0);" onclick="return validatefrm();" class="button-red">Edit Now</a>
            </p>
        </fieldset>
    </form>
<?php
} else {
?>
    <form name="frmOpt" id="frmOpt" method="post" action="admin-settings.php?sec=option&show=option&action=add&category_id=<?php echo $category_id;?>" enctype="multipart/form-data">
        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("ADDOPT"); ?>">
        <input type="hidden" name="category_id" id="category_id_id" value="<?php echo $category_id; ?>">
        <fieldset>
        <legend><?php echo $addtitle; ?></legend>
            <div class="floatRight pad-top5 pad-btm5" align="right">
                <a href="admin-settings.php?sec=option&show=option&category_id=<?php echo $category_id; ?>" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
            </div>
            <p>
                <label for="option_name">Option Name</label>
                <input type="text" name="option_name" id="option_name_id" value="<?php if(isset($_POST['option_name'])){echo $_POST['option_name'];}?>" onkeydown="chkblnkTxtError('option_name_id', 'option_name_errorid');" onkeyup="chkblnkTxtError('option_name_id', 'option_name_errorid');" />
                &nbsp;<span class="error" id="option_name_errorid"><?php if(array_key_exists('option_name_error', $form_array)) echo $form_array['option_name_error'];?> </span>
            </p>
            <p>&nbsp;</p>
            <p>
                <label>&nbsp;</label>
                <a href="javascript:void(0);" onclick="return validatefrm();" class="button-red">Add Now</a>
            </p>
        </fieldset>
    </form>
<?php
}
?>
