<?php
$rest_id 	= $_REQUEST['rest_id'];
$rest_name 	= $restObj->fun_getRestaurantNameById($rest_id);
$restConf 	= $restObj->fun_getRestaurantConf($rest_id);
?>
<script type="text/javascript" language="javascript">
	function chkblnkTxtError(strFieldId, strErrorFieldId){
		if(document.getElementById(strFieldId).value != ""){
			document.getElementById(strErrorFieldId).innerHTML = "";
		}
	}

	function checkSpecialPrice () {
		if(document.getElementById("base_price_enabled").checked == true) {
			//alert("checked");
			document.getElementById("base_price_id").disabled = false;
			document.getElementById("spacial_price_enabled").style.display = "none";
		} else {
			//alert("unchecked");
			document.getElementById("base_price_id").value = "";
			document.getElementById("base_price_id").disabled = true;
			document.getElementById("spacial_price_enabled").style.display = "block";
			//document.getElementById("spacial_price_enabled").innerHTML = "";

		}
	}

	function validatefrm(){
		var alreadyFocussed = false;
		//document.frmMenu.menu_desc_id.value = tinyMCE.get('menu_desc_id').getContent();

		/*
		if(document.getElementById("base_price_id").value == "") {
			document.getElementById("base_price_errorid").innerHTML = "Base price required";
			document.getElementById("base_price_id").focus();
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
		*/
		document.frmMenu.submit();
	}
</script>
<?php
if(isset($menu_id) && $menu_id !=""){
   $menuInfo 	= $restObj->fun_getMenuInfoById($menu_id);
?>
<div class="floatRight pad-top5 pad-btm5" align="right">
    <a href="admin-restaurant-menu.php?sec=price&menu_id=<?php echo $menu_id;?>&rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Menu Price</a>&nbsp;
	<?php /*?>
    <a href="admin-restaurant-menu.php?sec=add&rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Add a new Menu</a>&nbsp;
	<?php */?>
    <a href="admin-restaurant-menu.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Back to Menu List</a>&nbsp;
</div>
<form name="frmMenu" id="frmMenu" method="post" action="admin-restaurant-menu.php?sec=price&menu_id=<?php echo $menu_id;?>&rest_id=<?php echo $rest_id;?>" enctype="multipart/form-data">
<input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITMENUPRICE"); ?>" />
<input type="hidden" name="rest_id" id="rest_id_id" value="<?php echo $rest_id; ?>">
<input type="hidden" name="menu_id" id="menu_id_id" value="<?php echo $menu_id; ?>">
<input type="hidden" name="currency_id" id="currency_id_id" value="<?php if(isset($restConf['currency_id']) && $restConf['currency_id']!=""){ echo $restConf['currency_id'];} else {echo "4";} ?>">
<input type="hidden" name="back_url" id="back_url" value="<?php echo $_GET['back_url']; ?>">
<fieldset>
<legend>Edit Menu Price</legend>
    <p>
        <label for="rest_name">Restaurant name</label>
        <input type="text" name="rest_name" id="rest_name_id" value="<?php echo $rest_name;?>" disabled="disabled" />
    </p>
    <p>
    	<label for="base_price">Menu Name</label>
        <input type="text" name="menu_name" id="menu_name_id" value="<?php echo $menuInfo['menu_name'];?>" disabled="disabled" />
    </p>
    <p style="border:thin dashed #CCCCCC; padding:5px; margin:5px;">
    	<label for="base_price">Menu Base Price</label>
        <input type="text" name="base_price" id="base_price_id" value="<?php if(isset($_POST['base_price'])){echo $_POST['base_price'];}else{echo $menuInfo['base_price'];}?>" onkeydown="chkblnkTxtError('base_price_id', 'base_price_errorid');" onkeyup="chkblnkTxtError('base_price_id', 'base_price_errorid');" <?php if(!isset($menuInfo['base_price']) || (isset($menuInfo['base_price']) && $menuInfo['base_price'] > 0) || (isset($menuInfo['base_price']) && $menuInfo['base_price'] !="")){echo'';}else{echo ' disabled="disabled"';}?> />&nbsp;
        <span class="error" id="base_price_errorid"><?php if(array_key_exists('base_price_error', $form_array)) echo $form_array['base_price_error'];?></span>
        <input type="checkbox" name="base_price_enabled" id="base_price_enabled" value="1" style="width:13px; height:13px; margin-top:22px;" <?php if(!isset($menuInfo['base_price']) || (isset($menuInfo['base_price']) && $menuInfo['base_price'] > 0) || (isset($menuInfo['base_price']) && $menuInfo['base_price'] !="")){echo' checked="checked"';}else{echo '';}?> onclick="checkSpecialPrice();" />&nbsp; <span class="font11"><em>Unchecked this if any special pricing.</em></span>
        <br />
        <div id="spacial_price_enabled" style="display:<?php if(isset($menuInfo['base_price']) && $menuInfo['base_price'] !=""){echo'none';}else{echo 'block';}?>;">
            <label for="price_category_id">Price by</label>
            <select name="price_category_id" id="price_category_id_id" class="select310" >
                <option value="1" <?php if(isset($menuInfo['price_category_id']) && $menuInfo['price_category_id'] =="1") {echo 'selected';}?>>Size (small, medium, large)</option>
            </select>
            <div class="list-1" id="spacial_price_id" style="width:500px; margin-left:144px; margin-top:10px; border:thin #CCCCCC solid; padding:5px;">
			<?php $restObj->fun_createMenuEditPriceView($menu_id); ?>
            </div>
        </div>
    </p>
    <p style="clear:both;">&nbsp;</p>
    <p>
    	<label for="quantity_id">Quantity Type</label>
        <select name="quantity_id" id="quantity_id_id" class="select310" >
            <option value="1" <?php if(isset($menuInfo['quantity_id']) && $menuInfo['quantity_id'] =="1") {echo 'selected';}?>>Quantity (in terms of numbers)</option>
            <option value="2" <?php if(isset($menuInfo['quantity_id']) && $menuInfo['quantity_id'] =="2") {echo 'selected';}?>>Quantity (in terms of pieces)</option>
            <option value="3" <?php if(isset($menuInfo['quantity_id']) && $menuInfo['quantity_id'] =="3") {echo 'selected';}?>>Quantity (small, medium, large)</option>
            <option value="4" <?php if(isset($menuInfo['quantity_id']) && $menuInfo['quantity_id'] =="4") {echo 'selected';}?>>Quantity (single, six pack beers)</option>
            <option value="5" <?php if(isset($menuInfo['quantity_id']) && $menuInfo['quantity_id'] =="5") {echo 'selected';}?>>Quantity (single, double)</option>
        </select>
    </p>
	<?php
    $restObj->fun_createMenuEditOptionView($menu_id);
    ?>
	<?php /*?>
    <p>
    	<label>Add Extra</label>
        <input type="checkbox" name="options_category[]" id="options_category_id1" value="21" style="width:13px; height:13px; margin-top:22px;" /><br />
        <div class="list-1" style="width:500px; margin-left:144px; margin-top:10px; border:thin #CCCCCC solid; padding:5px;">
            <table width="500" border="0" cellpadding="0" cellspacing="0" class="dyn-row">
                <tr bgcolor="#CCCCCC">
                    <td width="30px" class="pad-top5 pad-lft5 pad-btm5"><strong>Add</strong></td>
                    <td width="120px" class="pad-top5 pad-lft5 pad-btm5"><strong>Options</strong></td>
                    <td class="pad-top5 pad-lft5 pad-btm5"><strong>Price</strong></td>
                </tr>
                <tr>
                    <td align="center" valign="middle"><input type="checkbox" name="options[]" id="add_extra_id150" value="150" style="width:13px; height:13px;" /></td>
                    <td align="left" valign="middle" class="pad-lft5 pad-top10">Jelly</td>
                    <td align="left" valign="middle" class="pad-lft5 pad-btm5"><input type="text" name="options_value[150]" id="options_value_id150" value="" style="width:45px;" />$</td>
                </tr>
                <tr>
                    <td align="center" valign="middle"><input type="checkbox" name="options[]" id="add_extra_id151" value="151" style="width:13px; height:13px;" /></td>
                    <td align="left" valign="middle" class="pad-lft5 pad-top10">Egg</td>
                    <td align="left" valign="middle" class="pad-lft5 pad-btm5"><input type="text" name="options_value[151]" id="options_value_id151" value="" style="width:45px;" />$</td>
                </tr>
            </table>
        </div>
    </p>
    <p style="clear:both;">&nbsp;</p>
	<?php */?>
    <p style="clear:both;">&nbsp;</p>
    <p>&nbsp;</p>
    <p>
        <label>&nbsp;</label>
        <a href="<?php echo "admin-restaurant-menu.php?rest_id=1&back_url=".$_GET['back_url']; ?>" class="button85x30-grey">Cancel</a>&nbsp;<a href="javascript:void(0);" onclick="return validatefrm();" class="button85x30-red">Edit Now</a>
    </p>
</fieldset>
</form>
<?php
} else {
?>
<?php /*?>
<div class="floatRight pad-top5 pad-btm5" align="right">
    <a href="admin-restaurant-menu.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Back to Menu List</a>&nbsp;
</div>
<form name="frmMenu" id="frmMenu" method="post" action="admin-restaurant-menu.php?sec=add" enctype="multipart/form-data">
<input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("ADDMENUPRICE"); ?>" />
<input type="hidden" name="rest_id" id="rest_id_id" value="<?php echo $rest_id; ?>">
<input type="hidden" name="active" id="active" value="1">
<input type="hidden" name="back_url" id="back_url" value="<?php echo $_GET['back_url']; ?>">
<fieldset>
<legend>Add Menu Price</legend>
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
    	<label for="base_price">Menu Name</label>
        <input type="text" name="base_price" id="base_price_id" value="<?php if(isset($_POST['base_price'])){echo $_POST['base_price'];}else{echo $menuInfo['base_price'];}?>" onkeydown="chkblnkTxtError('base_price_id', 'base_price_errorid');" onkeyup="chkblnkTxtError('base_price_id', 'base_price_errorid');" />&nbsp;
        <span class="error" id="base_price_errorid"><?php if(array_key_exists('base_price_error', $form_array)) echo $form_array['base_price_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
    	<label for="menu_desc">Description</label>
        <textarea type="text" name="menu_desc" id="menu_desc_id"  onkeydown="chkblnkTxtError('menu_desc_id', 'menu_desc_errorid');" onkeyup="chkblnkTxtError('coupon_desc_id', 'menu_desc_errorid');" /><?php if(isset($_POST['menu_desc'])){echo $_POST['menu_desc'];}else{echo $menuInfo['menu_desc'];}?></textarea>
        &nbsp;<span class="error" id="menu_desc_errorid"><?php if(array_key_exists('menu_desc_error', $form_array)) echo $form_array['menu_desc_error'];?></span>
    </p> 
    <p>
        <label>&nbsp;</label>
        <a href="<?php echo "admin-restaurant-menu.php?rest_id=1&back_url=".$_GET['back_url']; ?>" class="button85x30-grey">Cancel</a>&nbsp;<a href="javascript:void(0);" onclick="return validatefrm();" class="button85x30-red">Add Now</a>
    </p>
</fieldset>
</form>
<?php */?>
<?php
}
?>