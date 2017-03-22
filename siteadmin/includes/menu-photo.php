<?php
$rest_id 			= $_REQUEST['rest_id'];
$rest_name 			= $restObj->fun_getRestaurantNameById($rest_id);
$restMenuPhotoArr 	= $restObj->fun_getRestMenuPhotos($rest_id);
?>
<script type="text/javascript" language="javascript">
	var req = ajaxFunction();
	function uploadPhotos() {
		//document.getElementById("securityKey").value = '<?php echo md5("UPLOADRESTAURANTMENUPHOTOS"); ?>';
		if(document.getElementById("photo_caption_id").value == "" || document.getElementById("photo_caption_id").value == "Caption...") {
			document.getElementById("photo_thumb_errorid").innerHTML = "Caption required";
			document.getElementById("photo_caption_id").focus();
			return false;
		}

		document.frmMenu.submit();
	}

	function delRestPhoto(id) {
		var r = confirm("Are you sure? You want to delete this menu photo.");
		if(r == true) {
			req.onreadystatechange = handleDeleteResponse;
			req.open('get', 'includes/ajax/admin-restmenuphotodeleteXml.php?photo_id='+id); 
			req.send(null);   
		} else {
			return false;
		}
	}

	function handleDeleteResponse(){
		if(req.readyState == 4){
			var response = req.responseText;
			xmlDoc = req.responseXML;
			var root = xmlDoc.getElementsByTagName('photos')[0];
			if(root != null){
				var items = root.getElementsByTagName("photo");
				for (var i = 0 ; i < items.length ; i++){
					var item = items[i];
					var photostatus = item.getElementsByTagName("photostatus")[0].firstChild.nodeValue;
					if(photostatus == "photo deleted."){
						window.location = location.href;
					}
				}
			}
		}
	}
</script>
<div class="floatRight pad-top5 pad-btm5" align="right">
    <a href="admin-restaurant-menu.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Back to Menu List</a>&nbsp;
</div>

<form name="frmMenu" id="frmMenu" method="post" action="admin-restaurant-menu.php?sec=photo" enctype="multipart/form-data">
<input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("UPLOADRESTAURANTMENUPHOTOS"); ?>" />
<input type="hidden" name="rest_id" id="rest_id_id" value="<?php echo $rest_id; ?>">
<input type="hidden" name="back_url" id="back_url" value="<?php echo $_GET['back_url']; ?>">
<fieldset>
    <legend>Add menu photo</legend>
    <div class="pic-galery">
        <?php
        if(is_array($restMenuPhotoArr) && count($restMenuPhotoArr) > 0) {
            echo '<ul>';
            for($i=0; $i < count($restMenuPhotoArr); $i++){
                $photo_id      = $restMenuPhotoArr[$i]['photo_id'];
                $photo_thumb   = $restMenuPhotoArr[$i]['photo_thumb'];
                $photo_caption = $restMenuPhotoArr[$i]['photo_caption'];
                $photo_url 	   = RESTAURANT_IMAGES_THUMB168x126_PATH.$photo_thumb;
    
                echo '<li>';
                echo '<img src="'.$photo_url.'" /><br>';
                echo ''.$photo_caption.'';
                echo '<p align="center"><a class="red" href="javascript:void(0);" onclick="return delRestPhoto('.$photo_id.');" >Detele</a></p>';
                echo '</li>';
             }
            echo '</ul>';
        } else {
            echo '<span class="red font14">Please photo menu!</span>';
        }
        ?>
    </div>
    
    <div class="pic-upload-sec">
    &nbsp;<span class="error" id="photo_thumb_errorid"><?php if(array_key_exists('photo_thumb_error', $form_array)) echo $form_array['photo_thumb_error'];?></span>
    <input type="file" name="photo_thumb" id="photo_thumb_id" value="" class="inpuTxt" />
    <input  type="text" name="photo_caption" id="photo_caption_id" value="" placeholder="Caption..." class="inpuTxt" style="margin-top:20px; margin-right:10px;" />
    <a href="javascript:void(0);" style="text-decoration:none;" onclick="return uploadPhotos();" class="button-red">Upload</a>
    </div>
</fieldset>
</form>


<?php /*?>
<form name="frmMenu" id="frmMenu" method="post" action="admin-restaurant-menu.php?sec=photo" enctype="multipart/form-data">
<input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("UPLOADRESTAURANTMENUPHOTOS"); ?>" />
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
        <a href="<?php echo "admin-restaurant-menu.php?rest_id=1&back_url=".$_GET['back_url']; ?>" class="button85x30-grey">Cancel</a>&nbsp;<a href="javascript:void(0);" onclick="return validatefrm();" class="button85x30-red">Add Now</a>
    </p>
</fieldset>
</form>
<?php */?>