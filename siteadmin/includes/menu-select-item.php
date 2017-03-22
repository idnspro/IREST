<?
 $menu_id = $_REQUEST['menu_id'];
?>
<script type="text/javascript" language="javascript">
  function chkblnkTxtError(strFieldId, strErrorFieldId){
	if(document.getElementById(strFieldId).value != ""){
	  document.getElementById(strErrorFieldId).innerHTML = "";
	}
  }
function frmvalidate(){
	//if(document.getElementById("menu_id").value == "0") {
//		  document.getElementById("menu_id_errorid").innerHTML = " Menu required";
//		  document.getElementById("menu_id").focus();
//	  return false;
//	  }
	   if(document.getElementById("item_name_id").value =="") {
		  document.getElementById("item_name_errorid").innerHTML = "Item name required";
		  document.getElementById("item_name_id").focus();
	  return false;
	  }
	  if(document.getElementById("menu_catid_id").value == "0") {
		  document.getElementById("menu_catid_errorid").innerHTML = "Menu category required";
		  document.getElementById("menu_catid_id").focus();
	  return false;
	 }
	 if(document.getElementById("item_desc_id").value == "") {
		document.getElementById("item_desc_errorid").innerHTML = "Description required";
		document.getElementById("item_desc_id").focus();
		return false;
	}
  document.frmMenuItem.submit();
 }
</script>

<form name="frmMenuItem" id="frmMenuItem" method="post" action="" enctype="multipart/form-data">
 <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("ADDNEWMENU"); ?>">
	<?php
		if(isset($_GET['type']) && $_GET['type'] != "") {
			echo '<input type="hidden" name="item_type" id="item_type" value="'.$_GET['type'].'">';
		}
		if(isset($_GET['rest_id']) && $_GET['rest_id'] != "") {
			echo '<input type="hidden" name="rest_id" id="rest_id" value="'.$_GET['rest_id'].'">';
		}
		if(isset($_GET['menu_id']) && $_GET['menu_id'] != "") {
			echo '<input type="hidden" name="menu_id" id="menu_id" value="'.$_REQUEST['menu_id'].'">';
		}
    ?>
    <fieldset>
    <legend>Add Item</legend>
        <?php /*?><p><label for="menu">Menu's List</label><select name="menu" id="menu_id" class="select310"><option value="0" selected>Select Menu... </option><?php  $restObj->fun_getMenuSelectList();?></select>&nbsp;<span class="error" id="menu_id_errorid"><?php if(array_key_exists('is_Menu_error', $form_array)) echo $form_array['menu_id_error'];?></span> </p><?php */?>
        <p><label for="item_name">Item name</label> <input type="text" name="item_name" id="item_name_id" value="<?php if(isset($_POST['item_name'])){echo $_POST['item_name'];}else{echo $restInfo['item_name'];}?>" onkeydown="chkblnkTxtError('item_name_id', 'item_name_errorid');" onkeyup="chkblnkTxtError('item_name_id', 'item_name_errorid');" /> &nbsp;<span class="error" id="item_name_errorid"><?php if(array_key_exists('item_name_error', $form_array)) echo $form_array['item_name_error'];?></span></p>
        <p><label for="menu_category">Menu Category</label><select name="menu_catid" id="menu_catid_id"  class="select310"><option value="0">Select ... </option><?php $restObj->fun_getMenuOptionsCategoy($menu_id);?> </select>&nbsp;<span class="error" id="menu_catid_errorid"><?php if(array_key_exists('menu_catid_error', $form_array)) echo $form_array['menu_catid_error'];?> </span> </p>
        <p><label for="item_desc">Description</label><textarea type="text" name="item_desc" id="item_desc_id"  onkeydown="chkblnkTxtError('item_desc_id', 'item_desc_errorid');" onkeyup="chkblnkTxtError('item_desc_id', 'item_desc_errorid');" /><?php if(isset($_POST['item_desc'])){echo $_POST['item_desc'];}else{echo $menuInfo['item_desc'];}?></textarea> &nbsp;<span class="error" id="item_desc_errorid"> <?php if(array_key_exists('item_desc_error', $form_array)) echo $form_array['item_desc_error'];?></span></p>             
        <p><label for="rest_country_id">&nbsp;</label><a href="javascript:void(0);" style="text-decoration:none;"><img src="<?php echo SITE_ADMIN_IMAGES;?>save-btn.gif" border="0" onClick="return frmvalidate();" /></a></p>
    </fieldset>
</form>

