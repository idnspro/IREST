
<script type="text/javascript" language="javascript">
  function chkblnkTxtError(strFieldId, strErrorFieldId){
	if(document.getElementById(strFieldId).value != ""){
	  document.getElementById(strErrorFieldId).innerHTML = "";
	}
  }
 function editPhotos() {
		document.getElementById("securityKey").value = '<?php echo md5("EDITRESTAURANTPHOTOS"); ?>';
		document.frmRestaurant.submit();
	}
</script>
<?php
    $rest_id   = $_REQUEST['rest_id'];
	$photo_id  = $_REQUEST['photo_id'];
	    
	$restInfo 	    = $restObj->fun_getRestaurantInfo($photo_id);
	$restPhotoArr 	= $restObj->fun_getRestPhotosGallary($rest_id);
?>
<form name="frmRestaurant" id="frmRestaurant" method="post" action="admin-restaurant-photos-edit.php?sec=photo&rest_id=<?php echo $rest_id;?>" enctype="multipart/form-data">
    <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITRESTAURANTDETAILS"); ?>">
    <input type="hidden" name="photo_id" id="photo_id" value="<?php echo $photo_id; ?>">
    <fieldset>
    <legend>Edit Photo</legend>
    <div id="accordion" class="ui-accordion ui-widget ui-helper-reset ui-accordion-icons" role="tablist">
        <h3 class="ui-accordion-header question" role="tab" aria-expanded="false" tabindex="-1"><a href="#">Picture Gallery</a></h3>
        <div class="ui-accordion-content" role="tabpanel">
             <p>
                <label for="photo_thumb" style="text-align:center;"> <img src="<?php echo RESTAURANT_IMAGES_THUMB168x126_PATH.$restInfo['photo_thumb'];?>" border="0" width="145px" height="100px" onError="this.src='<?php echo RESTAURANT_IMAGES_THUMB168x126_PATH;?>no-img.gif';" /><br />
                    <strong>Restaurant Photo</strong><br />
                    **Dimension 145px X 100px </label>
                   </p>
                <p>
                <div class="pic-upload-sec">
                <input type="file" name="photo_thumb" id="photo_thumb_id" value="" class="inpuTxt"/>&nbsp;<span class="error" id="photo_thumb_errorid"><?php if(array_key_exists('photo_thumb_error', $form_array)) echo $form_array['photo_thumb_error'];?></span>
               </p>
               <p>
                <input align="bottom" type="text" name="photo_caption" class="inpuTxt110" value="<?php if(isset($_POST['photo_caption'])){echo $_POST['photo_caption'];}else{echo $restInfo['photo_caption'];}?>"/><a href="javascript:void(0);" style="text-decoration:none;"><img src="<?php echo SITE_ADMIN_IMAGES;?>upload-btn.gif" border="0" onclick="return editPhotos();" /></a>
            </div>
           </p>
        </div>
    </div>
    </fieldset>
</form>


