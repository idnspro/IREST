<script type="text/javascript" language="javascript">
function chkblnkTxtError(strFieldId, strErrorFieldId){
	if(document.getElementById(strFieldId).value != ""){
	  document.getElementById(strErrorFieldId).innerHTML = "";
	}
}

function validatefrm(){
	if(document.getElementById("category_name_id").value == "") {
		document.getElementById("category_name_errorid").innerHTML = "category name required";
		document.getElementById("category_name_id").focus();
		return false;
	}
	document.frmCat.submit();
}
</script>
<?php
if(isset($category_id) && $category_id !=""){
	$catInfo = $restObj->fun_getMenuCategoryInfoById($category_id);
	?>
    <form name="frmCat" id="frmCat" method="post" action="admin-settings.php?sec=category&action=edit&category_id=<?php echo $category_id;?>" enctype="multipart/form-data">
        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITMENUCATEGORY"); ?>">
        <input type="hidden" name="category_id" id="category_id_id" value="<?php echo $category_id; ?>">
        <fieldset>
        <legend><?php echo $addtitle; ?></legend>
            <div class="floatRight pad-top5 pad-btm5" align="right">
                <a href="admin-settings.php?sec=category" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
            </div>
            <p>
                <label for="category_pid">Parent Category</label>
                <select name="category_pid" id="category_pid_id" class="select310">
                    <option value="0" selected>Select ... </option>
                    <?php 
				    	$restObj->fun_getMenuCategoryOptionsList($catInfo['category_pid'], 'WHERE category_pid=0 ORDER BY category_name');
					?>
                </select>
                <span class="error" id="category_pid_errorid">&nbsp;</span>
            </p>
            <p>
                <label for="category_name">Category Name</label>
                <input type="text" name="category_name" id="category_name_id" value="<?php if(isset($_POST['category_name'])){echo $_POST['category_name'];}else{echo $catInfo['category_name'];}?>" onkeydown="chkblnkTxtError('category_name_id', 'category_name_errorid');" onkeyup="chkblnkTxtError('category_name_id', 'category_name_errorid');" />
                &nbsp;<span class="error" id="category_name_errorid"><?php if(array_key_exists('category_name_error', $form_array)) echo $form_array['category_name_error'];?> </span>
            </p>
            <p style="clear:both; height:10px;">&nbsp;</p>
            <p>
                <label>&nbsp;</label>
                <a href="javascript:void(0);" onclick="return validatefrm();" class="button-red">Edit Now</a>
            </p>
        </fieldset>
    </form>
<?php
} else {
?>
    <form name="frmCat" id="frmCat" method="post" action="admin-settings.php?sec=category&action=add" enctype="multipart/form-data">
        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("ADDMENUCATEGORY"); ?>">
        <fieldset>
        <legend><?php echo $addtitle; ?></legend>
            <div class="floatRight pad-top5 pad-btm5" align="right">
                <a href="admin-settings.php?sec=category" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
            </div>
            <p>
                <label for="category_pid">Parent Category</label>
                <select name="category_pid" id="category_pid_id" class="select310">
                    <option value="0" selected>Select ... </option>
                    <?php 
				    	$restObj->fun_getMenuCategoryOptionsList('', 'WHERE category_pid=0 ORDER BY category_name');
					?>
                </select>
                <span class="error" id="category_pid_errorid">&nbsp;</span>
            </p>
            <p>
                <label for="category_name">Category Name</label>
                <input type="text" name="category_name" id="category_name_id" value="<?php if(isset($_POST['category_name'])){echo $_POST['category_name'];}?>" onkeydown="chkblnkTxtError('category_name_id', 'category_name_errorid');" onkeyup="chkblnkTxtError('category_name_id', 'category_name_errorid');" />
                &nbsp;<span class="error" id="category_name_errorid"><?php if(array_key_exists('category_name_error', $form_array)) echo $form_array['category_name_error'];?> </span>
            </p>
            <p>&nbsp;</p>
            <p style="clear:both; height:10px;">&nbsp;</p>
            <p>
                <label>&nbsp;</label>
                <a href="javascript:void(0);" onclick="return validatefrm();" class="button-red">Add Now</a>
            </p>
        </fieldset>
    </form>
<?php
}
?>
