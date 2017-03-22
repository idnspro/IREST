<?php
$rest_id 	= $_REQUEST['rest_id'];
$rest_name 	= $restObj->fun_getRestaurantNameById($rest_id);
$manager_id = $restObj->fun_getRestaurantManagerId($rest_id);
?>
<script type="text/javascript" language="javascript">
	function validatefrm(){
		if(document.getElementById("manager_id_id").value == "0") {
			document.getElementById("manager_id_errorid").innerHTML = "Manager required";
			document.getElementById("manager_id_id").focus();
			return false;
		}
		document.frmUsers.submit();
	}
</script>
<form name="frmUsers" id="frmUsers" method="post" action="admin-user.php?sec=manager" enctype="multipart/form-data">
<input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("ADDRESTMANAGER"); ?>">
<input type="hidden" name="rest_id" id="rest_id_id" value="<?php echo $rest_id; ?>">
<input type="hidden" name="back_url" id="back_url" value="<?php echo $_GET['back_url']; ?>">
<fieldset>
<legend>Select manager</legend>
    <p>
        <label for="rest_name">Restaurant name</label>
        <input type="text" name="rest_name" id="rest_name_id" value="<?php echo $rest_name;?>" disabled="disabled" />
    </p>
    <p>
        <label for="manager_id">Manager's List</label>
        <select name="manager_id" id="manager_id_id" class="select310">
            <option value="0" selected>Select Manager... </option>
            <?php 
                $usersObj->fun_getManagerOptionsList($manager_id, '');
            ?>
        </select>
        <span class="error" id="manager_id_errorid"><?php if(array_key_exists('manager_id_error', $form_array)) echo $form_array['manager_id_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
        <label>&nbsp;</label>
        <a href="admin-user.php?sec=add&type=manager&rest_id=<?php echo $rest_id; ?>" style="text-decoration:none;" class="blue-link">Add New Manager</a>&nbsp;|&nbsp;<a href="admin-user.php?sec=notify&rest_id=<?php echo $rest_id; ?>" style="text-decoration:none;" class="blue-link">Notify Manager</a>
    </p>
    <p>&nbsp;</p>
    <p>
        <label>&nbsp;</label>
        <a href="<?php echo base64_decode($_GET['back_url']); ?>" class="button85x30-grey">Cancel</a>&nbsp;<a href="javascript:void(0);" onclick="return validatefrm();" class="button85x30-red">Save</a>
    </p>
</fieldset>
</form>
