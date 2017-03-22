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
	$catInfo = $restObj->fun_getMenuOptionCategoryInfoById($category_id);
	?>
    <form name="frmCat" id="frmCat" method="post" action="admin-settings.php?sec=option&action=edit&category_id=<?php echo $category_id;?>" enctype="multipart/form-data">
        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITOPTCATEGORY"); ?>">
        <input type="hidden" name="category_id" id="category_id_id" value="<?php echo $category_id; ?>">
        <fieldset>
        <legend><?php echo $addtitle; ?></legend>
            <div class="floatRight pad-top5 pad-btm5" align="right">
                <a href="admin-settings.php?sec=option&show=option&category_id=<?php echo $category_id; ?>" class="button-blue" style="text-decoration:none;">View Options</a>&nbsp;
                <a href="admin-settings.php?sec=option" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
            </div>
            <p>
                <label for="category_name">Category Name</label>
                <input type="text" name="category_name" id="category_name_id" value="<?php if(isset($_POST['category_name'])){echo $_POST['category_name'];}else{echo $catInfo['category_name'];}?>" onkeydown="chkblnkTxtError('category_name_id', 'category_name_errorid');" onkeyup="chkblnkTxtError('category_name_id', 'category_name_errorid');" />
                &nbsp;<span class="error" id="category_name_errorid"><?php if(array_key_exists('category_name_error', $form_array)) echo $form_array['category_name_error'];?> </span>
            </p>
            <p>
                <label for="menu_catids">Menu Category<br /><span class="font11 red"><em>(press & hold CTRL key & click on option to choose multiple categories)</em></span></label>
                <select name="menu_catids[]" id="menu_catids_id" class="multiple" multiple="multiple" size="5">
                    <option value="0">Select ... </option>
                    <?php 
				    	$restObj->fun_getMenuOptionMenuCategoryOptionsList($catInfo['menu_catids'], '');
					?>
                </select>
                <span class="error" id="menu_catids_errorid">&nbsp;</span>
            </p>
            <p>
                <label for="display_type">Display Type</label>
                <select name="display_type" id="display_type_id" class="select310">
                    <option value="0" <?php if(isset($catInfo['display_type']) && $catInfo['display_type'] =="0") { echo "selected"; }?> >Radio Option</option>
                    <option value="1" <?php if(isset($catInfo['display_type']) && $catInfo['display_type'] =="1") { echo "selected"; }?> >List Option</option>
                    <option value="2" <?php if(isset($catInfo['display_type']) && $catInfo['display_type'] =="2") { echo "selected"; }?> >Checkbox Option</option>
                </select>
                <span class="error" id="display_type_errorid">&nbsp;</span>
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
    <form name="frmCat" id="frmCat" method="post" action="admin-settings.php?sec=option&action=add" enctype="multipart/form-data">
        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("ADDEDITOPTCATEGORY"); ?>">
        <fieldset>
        <legend><?php echo $addtitle; ?></legend>
            <div class="floatRight pad-top5 pad-btm5" align="right">
                <a href="admin-settings.php?sec=option" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
            </div>
            <p>
                <label for="category_name">Category Name</label>
                <input type="text" name="category_name" id="category_name_id" value="<?php if(isset($_POST['category_name'])){echo $_POST['category_name'];}?>" onkeydown="chkblnkTxtError('category_name_id', 'category_name_errorid');" onkeyup="chkblnkTxtError('category_name_id', 'category_name_errorid');" />
                &nbsp;<span class="error" id="category_name_errorid"><?php if(array_key_exists('category_name_error', $form_array)) echo $form_array['category_name_error'];?> </span>
            </p>
            <p>&nbsp;</p>
            <p>
                <label for="menu_catids">Menu Category<br /><span class="font11 red"><em>(press & hold CTRL key & click on option to choose multiple categories)</em></span></label>
                <select name="menu_catids[]" id="menu_catids_id" class="multiple" multiple="multiple" size="5">
                    <option value="0">Select ... </option>
                    <?php 
				    	$restObj->fun_getMenuOptionMenuCategoryOptionsList('', '');
					?>
                </select>
                <span class="error" id="menu_catids_errorid">&nbsp;</span>
            </p>
            <p>&nbsp;</p>
            <p>
                <label for="display_type">Display Type</label>
                <select name="display_type" id="display_type_id" class="select310">
                    <option value="0">Radio Option</option>
                    <option value="1">List Option</option>
                    <option value="2" selected>Checkbox Option</option>
                </select>
                <span class="error" id="display_type_errorid">&nbsp;</span>
            </p>
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
