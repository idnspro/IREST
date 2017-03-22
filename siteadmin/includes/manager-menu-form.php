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
		document.frmMenu.menu_desc_id.value = tinyMCE.get('menu_desc_id').getContent();

		if(document.getElementById("menu_name_id").value == "") {
			document.getElementById("menu_name_errorid").innerHTML = "Menu Name required";
			document.getElementById("menu_name_id").focus();
			return false;
		}

		if(document.getElementById("category_id_id").value == "0") {
			document.getElementById("category_id_errorid").innerHTML = "Menu Category required";
			document.getElementById("category_id_id").focus();
			return false;
		}

		if(document.frmMenu.menu_desc_id.value == "") {
			document.getElementById("menu_desc_errorid").innerHTML = "Description required";
			document.getElementById("menu_desc_id").focus();
			if(!alreadyFocussed){
				document.frmMenu.menu_desc_id.focus();
				alreadyFocussed = true;
			}
			return false;
		}
		document.frmMenu.submit();
	}
</script>
<!-- TinyMCE -->
<script type="text/javascript" src="../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
    tinyMCE.init({
        mode : "exact",
        elements : "menu_desc_id",
        theme : "advanced",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        
    });

    function myHandleEvent(e){
        if(e.type=="keyup"){
            chkblnkEditorTxtError("menu_desc_id", "menu_desc_errorid");	
        }
        return true;
    }
</script>
<!-- /TinyMCE -->
<?php
if(isset($menu_id) && $menu_id !=""){
   $menuInfo 	= $restObj->fun_getMenuInfoById($menu_id);
   //$item_id     = $restObj->fun_getMenuItemId($menu_id);
?>
<div class="floatRight pad-top5 pad-btm5" align="right">
    <a href="manager-restaurants-menu.php?sec=price&menu_id=<?php echo $menu_id;?>&rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Menu Price</a>&nbsp;
	<?php /*?>
    <a href="manager-restaurants-menu.php?sec=add&rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Add a new Menu</a>&nbsp;
	<?php */?>
    <a href="manager-restaurants-menu.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Back to Menu List</a>&nbsp;
</div>
<form name="frmMenu" id="frmMenu" method="post" action="manager-restaurants-menu.php?sec=edit&menu_id=<?php echo $menu_id;?>&rest_id=<?php echo $rest_id;?>" enctype="multipart/form-data">
<input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITMENU"); ?>" />
<input type="hidden" name="rest_id" id="rest_id_id" value="<?php echo $rest_id; ?>">
<input type="hidden" name="menu_id" id="menu_id_id" value="<?php echo $menu_id; ?>">
<input type="hidden" name="active" id="active" value="1">
<input type="hidden" name="back_url" id="back_url" value="<?php echo $_GET['back_url']; ?>">
<fieldset>
<legend>Edit Menu</legend>
    <p>
        <label for="rest_name">Restaurant name</label>
        <input type="text" name="rest_name" id="rest_name_id" value="<?php echo $rest_name;?>" disabled="disabled" />
    </p>
    <p>
    	<label for="category_id">Menu Category</label>
        <select name="category_id" id="category_id_id"  class="select310">
            <option value="0">Select ... </option>
            <?php 
             $restObj->fun_getMenuCategoyChildParentOptionsList($menuInfo['category_id']);
            ?> 
        </select>
        &nbsp;<span class="error" id="category_id_errorid"><?php if(array_key_exists('category_id_error', $form_array)) echo $form_array['category_id_error'];?> </span>
    </p>
    <p>&nbsp;</p>
    <p>
        <label>&nbsp;</label>
        <a href="admin-settings.php?sec=category" style="text-decoration:none;" class="blue-link">Add New Category</a>
    </p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>
    	<label for="menu_name">Menu Name</label>
        <input type="text" name="menu_name" id="menu_name_id" value="<?php if(isset($_POST['menu_name'])){echo $_POST['menu_name'];}else{echo $menuInfo['menu_name'];}?>" onkeydown="chkblnkTxtError('menu_name_id', 'menu_name_errorid');" onkeyup="chkblnkTxtError('menu_name_id', 'menu_name_errorid');" />&nbsp;
        <span class="error" id="menu_name_errorid"><?php if(array_key_exists('menu_name_error', $form_array)) echo $form_array['menu_name_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
    	<label for="menu_desc">Description</label>
        <textarea type="text" name="menu_desc" id="menu_desc_id"  onkeydown="chkblnkTxtError('menu_desc_id', 'menu_desc_errorid');" onkeyup="chkblnkTxtError('menu_desc_id', 'menu_desc_errorid');" /><?php if(isset($_POST['menu_desc'])){echo $_POST['menu_desc'];}else{echo $menuInfo['menu_desc'];}?></textarea>
        &nbsp;<span class="error" id="menu_desc_errorid"><?php if(array_key_exists('menu_desc_error', $form_array)) echo $form_array['menu_desc_error'];?></span>
    </p> 
    <p>
        <label>&nbsp;</label>
        <a href="<?php echo "manager-restaurants-menu.php?rest_id=1&back_url=".$_GET['back_url']; ?>" class="button85x30-grey">Cancel</a>&nbsp;<a href="javascript:void(0);" onclick="return validatefrm();" class="button85x30-red">Edit Now</a>
    </p>
</fieldset>
</form>
<?php
} else {
?>
<div class="floatRight pad-top5 pad-btm5" align="right">
    <a href="manager-restaurants-menu.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Back to Menu List</a>&nbsp;
</div>
<form name="frmMenu" id="frmMenu" method="post" action="manager-restaurants-menu.php?sec=add" enctype="multipart/form-data">
<input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("ADDMENU"); ?>" />
<input type="hidden" name="rest_id" id="rest_id_id" value="<?php echo $rest_id; ?>">
<input type="hidden" name="active" id="active" value="1">
<input type="hidden" name="back_url" id="back_url" value="<?php echo $_GET['back_url']; ?>">
<fieldset>
<legend>Add Menu</legend>
    <p>
        <label for="rest_name">Restaurant name</label>
        <input type="text" name="rest_name" id="rest_name_id" value="<?php echo $rest_name;?>" disabled="disabled" />
    </p>
    <p>
    	<label for="category_id">Menu Category</label>
        <select name="category_id" id="category_id_id"  class="select310">
            <option value="0">Select ... </option>
            <?php 
             $restObj->fun_getMenuCategoyChildParentOptionsList($menuInfo['category_id']);
            ?> 
        </select>
        &nbsp;<span class="error" id="category_id_errorid"><?php if(array_key_exists('category_id_error', $form_array)) echo $form_array['category_id_error'];?> </span>
    </p>
    <p>&nbsp;</p>
    <p>
        <label>&nbsp;</label>
        <a href="admin-settings.php?sec=category" style="text-decoration:none;" class="blue-link">Add New Category</a>
    </p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>
    	<label for="menu_name">Menu Name</label>
        <input type="text" name="menu_name" id="menu_name_id" value="<?php if(isset($_POST['menu_name'])){echo $_POST['menu_name'];}else{echo $menuInfo['menu_name'];}?>" onkeydown="chkblnkTxtError('menu_name_id', 'menu_name_errorid');" onkeyup="chkblnkTxtError('menu_name_id', 'menu_name_errorid');" />&nbsp;
        <span class="error" id="menu_name_errorid"><?php if(array_key_exists('menu_name_error', $form_array)) echo $form_array['menu_name_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
    	<label for="menu_desc">Description</label>
        <textarea type="text" name="menu_desc" id="menu_desc_id"  onkeydown="chkblnkTxtError('menu_desc_id', 'menu_desc_errorid');" onkeyup="chkblnkTxtError('menu_desc_id', 'menu_desc_errorid');" /><?php if(isset($_POST['menu_desc'])){echo $_POST['menu_desc'];}else{echo $menuInfo['menu_desc'];}?></textarea>
        &nbsp;<span class="error" id="menu_desc_errorid"><?php if(array_key_exists('menu_desc_error', $form_array)) echo $form_array['menu_desc_error'];?></span>
    </p> 
    <p>
        <label>&nbsp;</label>
        <a href="<?php echo "manager-restaurants-menu.php?rest_id=1&back_url=".$_GET['back_url']; ?>" class="button85x30-grey">Cancel</a>&nbsp;<a href="javascript:void(0);" onclick="return validatefrm();" class="button85x30-red">Add Now</a>
    </p>
</fieldset>
</form>
<?php
}
?>