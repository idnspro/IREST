<?php
if(isset($site_variable_id) && $site_variable_id !=""){
	$siteVariableInfoArr 	= $systemObj->fun_getSiteVariableInfo($site_variable_id);
?>
<script type="text/javascript" language="javascript">
	function validatefrm(){
		if(document.getElementById("site_variable_value_id").value == "") {
			document.getElementById("site_variable_value_errorid").innerHTML = "Setting value required";
			document.getElementById("site_variable_value_id").focus();
			return false;
		}
		document.frmSettings.submit();
	 }
</script>
<div class="floatRight pad-top5 pad-btm5" align="right">
    <a href="admin-settings.php" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
</div>
<form name="frmSettings" id="frmSettings" method="post" action="admin-settings.php">
    <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("SITEVARIABLES");?>">
    <input type="hidden" name="site_variable_id" id="site_variable_id_id" value="<?php echo $siteVariableInfoArr['site_variable_id']; ?>">
    <fieldset>
    <legend>Manage Settings</legend>
    <p>
        <label>Setting name</label>
        <input type="text" name="site_variable_value" id="site_variable_value_id" value="<?php echo $siteVariableInfoArr['site_variable_name']; ?>" disabled="disabled" />
    </p>
    <p>
        <label for="site_variable_value">Setting value</label>
        <input type="text" name="site_variable_value" id="site_variable_value_id" value="<?php echo $siteVariableInfoArr['site_variable_value']; ?>" />
        &nbsp;<span class="error" id="site_variable_value_errorid"><?php if(array_key_exists('site_variable_value_error', $form_array)) echo $form_array['site_variable_value_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
        <label>&nbsp;</label>
        <a href="javascript:void(0);" onclick="return validatefrm();" class="button-red">Update Now</a> </p>
    </fieldset>
</form>
<?php
}
?>
