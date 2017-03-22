<script type="text/javascript" language="javascript">
	var req = ajaxFunction();

	function chkSelectCountry() {
		var getID = document.getElementById("rest_country_id_id").value;
		if(getID !="" && getID != "0"){
			sendStateRequest(getID);
			document.getElementById("rest_city_id_id").value = "0";
		}
		if(getID == "0" || getID =="") {
			document.getElementById("rest_state_id_id").value = "0";
			document.getElementById("rest_city_id_id").value = "0";
		}
	}

	function chkSelectState() {
		var getID = document.getElementById("rest_state_id_id").value;
		if(getID !="" && getID != "0"){
			sendCityRequest(getID);
		}
		if(getID == "0" || getID =="") {
			document.getElementById("rest_city_id_id").value = "0";
		}
	}

	function sendStateRequest(id) { 
		req.open('get', '../selectStateXml.php?id='+id); 
		req.onreadystatechange = handleStateResponse; 
		req.send(null); 
	} 

	function sendCityRequest(id) { 
		req.open('get', '../selectCityXml.php?id=' + id); 
		req.onreadystatechange = handleCityResponse; 
		req.send(null); 
	} 

	function handleStateResponse() { 
		var arrayOfId = new Array();
		var arrayOfNames = new Array();
		if(req.readyState == 4) { 
			var response = req.responseText; 
			xmlDoc=req.responseXML;
			var root = xmlDoc.getElementsByTagName('states')[0];
			if(root != null) {
				var items = root.getElementsByTagName("state");
				for (var i = 0 ; i < items.length ; i++) {
					var item = items[i];
					var id = item.getElementsByTagName("id")[0].firstChild.nodeValue;
					arrayOfId[i] = id;
					var name = item.getElementsByTagName("name")[0].firstChild.nodeValue;
					arrayOfNames[i] = name;
					//alert("item #" + i + ": ID=" + id + " Name=" + name);
				}
				if( arrayOfId.length > 0) {
					var rest_state = document.getElementById("rest_state_id_id");
					rest_state.length = 0;
					rest_state.options[0] = new Option("Please Select...", "");
					for(var j=0; j<arrayOfId.length; j++) {
						rest_state.options[j+1]=new Option(arrayOfNames[j], arrayOfId[j]);
					}
				} else {
					// For State
					var rest_state = document.getElementById("rest_state_id_id");
					rest_state.length = 0;
					rest_state.options[0] = new Option("Please Select...", "");

					// For City
					var rest_city = document.getElementById("rest_city_id_id");
					rest_city.length = 0;
					rest_city.options[0] = new Option("Please Select...", "0");
				}
			} else {
				// For State
				var rest_state = document.getElementById("rest_state_id_id");
				rest_state.length = 0;
				rest_state.options[0] = new Option("Please Select...", "");

				// For City
				var rest_city = document.getElementById("rest_city_id_id");
				rest_city.length = 0;
				rest_city.options[0] = new Option("Please Select...", "0");
			}
		} 
	} 

	function handleCityResponse() { 
		var arrayOfId = new Array();
		var arrayOfNames = new Array();
		if(req.readyState == 4) { 
			var response = req.responseText; 
			xmlDoc=req.responseXML;
			var root = xmlDoc.getElementsByTagName('cities')[0];
			if(root != null) {
				var items = root.getElementsByTagName("city");
				for (var i = 0 ; i < items.length ; i++) {
					var item = items[i];
					var id = item.getElementsByTagName("id")[0].firstChild.nodeValue;
					arrayOfId[i] = id;
					var name = item.getElementsByTagName("name")[0].firstChild.nodeValue;
					arrayOfNames[i] = name;
					//alert("item #" + i + ": ID=" + id + " Name=" + name);
				}
				if( arrayOfId.length > 0) {
					var rest_city = document.getElementById("rest_city_id_id");
					rest_city.length = 0;
					rest_city.options[0] = new Option("Please Select...","0");
					for(var j=0; j<arrayOfId.length; j++) {
						rest_city.options[j+1] = new Option(arrayOfNames[j],arrayOfId[j]);
					}
				} else {
					var rest_city = document.getElementById("rest_city_id_id");
					rest_city.length = 0;
					rest_city.options[0] = new Option("Please Select...", "0");
				}
			} else {
				var rest_city = document.getElementById("rest_city_id_id");
				rest_city.length = 0;
				rest_city.options[0] = new Option("Please Select...", "0");
			}
		} 
	} 

	function chkblnkTxtError(strFieldId, strErrorFieldId){
		if(document.getElementById(strFieldId).value != ""){
			document.getElementById(strErrorFieldId).innerHTML = "";
		}
	}

	function validatefrm(){
		if(document.getElementById("rest_name_id").value == "") {
			document.getElementById("rest_name_errorid").innerHTML = "Name required";
			document.getElementById("rest_name_id").focus();
			return false;
		}
		if(document.getElementById("rest_country_id_id").value == "") {
			document.getElementById("rest_country_id_errorid").innerHTML = "Country required";
			document.getElementById("rest_country_id_id").focus();
			return false;
		}
		if(document.getElementById("rest_state_id_id").value == "") {
			document.getElementById("rest_state_id_errorid").innerHTML = "State required";
			document.getElementById("rest_state_id_id").focus();
			return false;
		}
		if(document.getElementById("rest_city_id_id").value == "") {
			document.getElementById("rest_city_id_errorid").innerHTML = "City required";
			document.getElementById("rest_city_id_id").focus();
			return false;
		}
		if(document.getElementById("rest_address1_id").value == "") {
			document.getElementById("rest_address1_errorid").innerHTML = "Address required";
			document.getElementById("rest_address1_id").focus();
			return false;
		}
		if(document.getElementById("rest_zip_id").value == "") {
			document.getElementById("rest_zip_errorid").innerHTML = "Zip Code required";
			document.getElementById("rest_zip_id").focus();
			return false;
		}
		document.frmRestaurant.submit();
	 }

	function updateRestDesc() {
		if(document.getElementById("rest_title_id").value == "") {
			document.getElementById("rest_title_errorid").innerHTML = "Restaurant title required";
			document.getElementById("rest_title_id").focus();
			return false;
		}

		if(document.getElementById("rest_short_desc_id").value == "") {
			document.getElementById("rest_short_desc_errorid").innerHTML = "Welcome message required";
			document.getElementById("rest_short_desc_id").focus();
			return false;
		}

		if(document.getElementById("page_discription_id").value == "") {
			document.getElementById("page_discription_errorid").innerHTML = "About restaurant required";
			document.getElementById("page_discription_id").focus();
			return false;
		}

		document.getElementById("securityKey").value = '<?php echo md5("UPDATERESTDESC"); ?>';
		document.frmRestaurant.submit();
	}
	
	function uploadLogo() {
		document.getElementById("securityKey").value = '<?php echo md5("UPLOADRESTAURANTLOGO"); ?>';
		document.frmRestaurant.submit();
	}

	function uploadPhotos() {
		document.getElementById("securityKey").value = '<?php echo md5("UPLOADRESTAURANTPHOTOS"); ?>';
		document.frmRestaurant.submit();
	}

	function closeWindow(){	
		document.getElementById("picture_delete").style.display="none";
	}

    function sbmtPictureDelete(){
		document.getElementById("securityKey").value = "<?php echo md5('PHOTODELETE'); ?>";
		document.frmRestaurant.submit();
	}

	function delReview (review_id) {
		var r = confirm("Are you sure? You want to delete this review.");
		if(r == true) {
			req.onreadystatechange = handleDeleteReviewResponse;
			req.open('get', 'includes/ajax/admin-reviewdeleteXml.php?review_id='+review_id); 
			req.send(null);   
		} else {
			return false;
		}
	}

	function handleDeleteReviewResponse(){
		if(req.readyState == 4){
			var response = req.responseText;
			xmlDoc = req.responseXML;
			var root = xmlDoc.getElementsByTagName('reviews')[0];
			if(root != null){
				var items = root.getElementsByTagName("review");
				for (var i = 0 ; i < items.length ; i++){
					var item = items[i];
					var reviewstatus = item.getElementsByTagName("reviewstatus")[0].firstChild.nodeValue;
					if(reviewstatus == "review deleted."){
						window.location = location.href;
					}
				}
			}
		}
	}

	function approveReview (review_id) {
		req.onreadystatechange = handleApproveReviewResponse;
		req.open('get', 'includes/ajax/admin-reviewapproveXml.php?review_id='+review_id); 
		req.send(null);   
	}

	function handleApproveReviewResponse(){
		if(req.readyState == 4){
			var response = req.responseText;
			xmlDoc = req.responseXML;
			var root = xmlDoc.getElementsByTagName('reviews')[0];
			if(root != null){
				var items = root.getElementsByTagName("review");
				for (var i = 0 ; i < items.length ; i++){
					var item = items[i];
					var reviewstatus = item.getElementsByTagName("reviewstatus")[0].firstChild.nodeValue;
					if(reviewstatus == "Approved"){
						window.location = location.href;
					}
				}
			}
		}
	}
	function delRestPhoto(id) {
		var r = confirm("Are you sure? You want to delete this photo.");
		if(r == true) {
			req.onreadystatechange = handleDeleteResponse;
			req.open('get', 'includes/ajax/admin-restphotodeleteXml.php?photo_id='+id); 
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
<?php
	if(isset($rest_id) && $rest_id !=""){
	$restInfo 	    = $restObj->fun_getRestaurantInfo($rest_id);
	$manager_id     = $restObj->fun_getRestaurantManagerId($rest_id);
	$rest_manager 	= $usersObj->fun_getUserNameById($manager_id);
	$restPhotoArr 	= $restObj->fun_getRestPhotosGallary($rest_id);
	$reviewArr 		= $restObj->fun_getPendingApprovalRestaurantReviewsArr(" WHERE A.rest_id='".$rest_id."' ");
?>
<form name="frmRestaurant" id="frmRestaurant" method="post" action="admin-restaurant.php?sec=edit&rest_id=<?php echo $rest_id;?>" enctype="multipart/form-data">
    <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITRESTAURANTDETAILS"); ?>">
    <input type="hidden" name="rest_id" id="rest_id" value="<?php echo $rest_id; ?>">
    <input type="hidden" name="photo_id" id="photo_id" value="">
    <fieldset>
    <legend>Edit Restaurant</legend>
    <div class="floatRight pad-top5 pad-btm5" align="right">
        <?php
		if(isset($manager_id) && $manager_id != "") {
			/*
			echo '<a href="admin-restaurant-menu.php?user_id='.$manager_id.'&rest_id='.$rest_id.'&back_url='.base64_encode("admin-restaurant-menu.php?sec=edit&rest_id=$rest_id").'" style="text-decoration:none;"><img src="'.SITE_ADMIN_IMAGES.'menu_btn.gif" border="0" /></a>';
			echo '&nbsp;';
			echo '<a href="admin-restaurant-coupons.php?user_id='.$manager_id.'&rest_id='.$rest_id.'&back_url='.base64_encode("admin-restaurant-coupons.php?sec=edit&rest_id=$rest_id").'" style="text-decoration:none;"><img src="'.SITE_ADMIN_IMAGES.'coupons.gif" border="0" /></a>';
			echo '&nbsp;';
			echo '<a href="admin-restaurant-discount.php?user_id='.$manager_id.'&rest_id='.$rest_id.'&back_url='.base64_encode("admin-restaurant.php?sec=edit&rest_id=$rest_id").'" style="text-decoration:none;"><img src="'.SITE_ADMIN_IMAGES.'dis_btn.gif" border="0" /></a>';
			echo '&nbsp;';
			echo '<a href="admin-restaurant-unlike-coupons.php?user_id='.$manager_id.'&rest_id='.$rest_id.'&back_url='.base64_encode("admin-restaurant.php?sec=edit&rest_id=$rest_id").'" style="text-decoration:none;"><img src="'.SITE_ADMIN_IMAGES.'un_coupons.gif" border="0" /></a>';
			echo '&nbsp;';
			echo '<a href="admin-restaurant-loyality-points.php?sec=edit&rest_id='.$rest_id.'&back_url='.base64_encode("admin-restaurant-loyality-points.php?sec=edit&rest_id=$rest_id").'" style="text-decoration:none;"><img src="'.SITE_ADMIN_IMAGES.'loyalty_pts.gif" border="0" /></a>';
			echo '&nbsp;';
			echo '<a href="admin-user.php?sec=edit&user_id='.$manager_id.'&rest_id='.$rest_id.'&back_url='.base64_encode("admin-restaurant.php?sec=edit&rest_id=$rest_id").'" style="text-decoration:none;"><img src="'.SITE_ADMIN_IMAGES.'view_manager.gif" border="0" /></a>';
			*/

			echo '<a href="admin-restaurant-coupons.php?rest_id='.$rest_id.'&back_url='.base64_encode("admin-restaurant.php?sec=edit&rest_id=$rest_id").'" class="button-blue" style="text-decoration:none;">Coupons</a>';
			echo '&nbsp;';
			echo '<a href="admin-restaurant-info.php?rest_id='.$rest_id.'&back_url='.base64_encode("admin-restaurant.php?sec=edit&rest_id=$rest_id").'" class="button-blue" style="text-decoration:none;">Restaurant Info</a>';
			echo '&nbsp;';
			echo '<a href="admin-restaurant-menu.php?rest_id='.$rest_id.'&back_url='.base64_encode("admin-restaurant.php?sec=edit&rest_id=$rest_id").'" class="button-blue" style="text-decoration:none;">Menus</a>';
			echo '&nbsp;';
		    echo '<a href="admin-user.php?sec=manager&rest_id='.$rest_id.'&back_url='.base64_encode("admin-restaurant.php?sec=edit&rest_id=$rest_id").'" class="button-blue" style="text-decoration:none;">Edit Manager</a>';
			echo '&nbsp;';
		    echo '<a href="admin-restaurant.php" class="button-blue" style="text-decoration:none;">Back to list</a>';
		} else {
		    echo '<a href="admin-user.php?sec=manager&rest_id='.$rest_id.'&back_url='.base64_encode("admin-restaurant.php?sec=edit&rest_id=$rest_id").'" class="button-blue" style="text-decoration:none;">Add Manager</a>';
		}
		?>
    </div>
    <div id="accordion" role="tablist">
        <h3 class="ui-accordion-header question"><a href="#">Restaurant Details</a></h3>
        <div class="ui-accordion-content" role="tabpanel">
			<?php
            if(isset($manager_id) && $manager_id != "") {
            ?>
            <p>
                <label for="rest_name">Restaurant Manager</label>
                <input type="text" name="rest_manager" id="rest_manager_id" value="<?php echo $rest_manager;?>" disabled="disabled" />
            </p>
			<?php
            }
            ?>
            <p>
                <label for="rest_name">Restaurant name</label>
                <input type="text" name="rest_name" id="rest_name_id" value="<?php if(isset($_POST['rest_name'])){echo $_POST['rest_name'];} else {echo $restInfo['rest_name'];}?>" onkeydown="chkblnkTxtError('rest_name_id', 'rest_name_errorid');" onkeyup="chkblnkTxtError('rest_name_id', 'rest_name_errorid');" />
                &nbsp;<span class="error" id="rest_name_errorid"><?php if(array_key_exists('rest_name_error', $form_array)) echo $form_array['rest_name_error'];?></span>
            </p>
            <p class="pad-btm5">
                <label for="rest_country_id">Country</label>
                <select name="rest_country_id" id="rest_country_id_id" class="select310" onchange="chkSelectCountry();">
                    <option value="0" selected>Select ... </option>
                    <?php 
				    	$locationObj->fun_getCountryOptionsList(((isset($_POST['rest_country_id']) && ($_POST['rest_country_id'] != "" || $_POST['rest_country_id'] != "0"))?$_POST['rest_country_id']:((isset($restInfo['rest_country_id']) && ($restInfo['rest_country_id'] != "" || $restInfo['rest_country_id'] != "0"))?$restInfo['rest_country_id']:223)), '');
					?>
                </select>
                <span class="error" id="rest_country_id_errorid"><?php if(array_key_exists('rest_country_id_error', $form_array)) echo $form_array['rest_country_id_error'];?></span>
            </p>
            <p>
                <label for="rest_state_id">State / Province</label>
                <select name="rest_state_id" id="rest_state_id_id" class="select310" onchange="chkSelectState();">
                    <option value="0" selected>Select ... </option>
                    <?php 
					   $locationObj->fun_getStateOptionsListByCountryId(((isset($_POST['rest_state_id']) && ($_POST['rest_state_id'] != "" || $_POST['rest_state_id'] != "0"))?$_POST['rest_state_id']:$restInfo['rest_state_id']), ((isset($_POST['rest_country_id']) && ($_POST['rest_country_id'] != "" || $_POST['rest_country_id'] != "0"))?$_POST['rest_country_id']:((isset($restInfo['rest_country_id']) && ($restInfo['rest_country_id'] != "" || $restInfo['rest_country_id'] != "0"))?$restInfo['rest_country_id']:223)));
					?>
                </select>
                <span class="error" id="rest_state_id_errorid">
                <?php if(array_key_exists('rest_state_id_error', $form_array)) echo $form_array['rest_state_id_error'];?>
                </span>
            </p>
            <p>
                <label for="rest_city_id">City</label>
                <select name="rest_city_id" id="rest_city_id_id" class="select310" >
                    <option value="0" selected>Select ... </option>
                    <?php 
					   $locationObj->fun_getCityOptionsListByStateId($restInfo['rest_city_id'], $restInfo['rest_state_id']);
					?>
                </select>
                <span class="error" id="rest_city_id_errorid">
                <?php if(array_key_exists('rest_city_id_error', $form_array)) echo $form_array['rest_city_id_error'];?>
                </span>
            </p>
            <p>
                <label for="rest_address1">Street address</label>
                <input type="text" name="rest_address1" id="rest_address1_id" value="<?php if(isset($_POST['rest_address1'])){echo $_POST['rest_address1'];}else{echo $restInfo['rest_address1'];}?>" onkeydown="chkblnkTxtError('rest_address1_id', 'rest_address1_errorid');" onkeyup="chkblnkTxtError('rest_address1_id', 'rest_address1_errorid');" />
                &nbsp;<span class="error" id="rest_address1_errorid"><?php if(array_key_exists('rest_address1_error', $form_array)) echo $form_array['rest_address1_error'];?></span>
            </p>
            <p>
                <label for="rest_address2">&nbsp;</label>
                <input type="text" name="rest_address2" id="rest_address2_id" value="<?php if(isset($_POST['rest_address2'])){echo $_POST['rest_address2'];}else{echo $restInfo['rest_address2'];}?>" />
                &nbsp;
            </p>
            <p>
                <label for="rest_zip">Zip / Postal code</label>
                <input type="text" name="rest_zip" id="rest_zip_id" value="<?php if(isset($_POST['rest_zip'])){echo $_POST['rest_zip'];}else{echo $restInfo['rest_zip'];}?>" onkeydown="chkblnkTxtError('rest_zip_id', 'rest_zip_errorid');" onkeyup="chkblnkTxtError('rest_zip_id', 'rest_zip_errorid');" />
                &nbsp;<span class="error" id="rest_zip_errorid">
                <?php if(array_key_exists('rest_zip_error', $form_array)) echo $form_array['rest_zip_error'];?>
                </span>
            </p>
            <p>&nbsp;</p>
            <p>
            	<label for="active">Active</label>
                <select name="active" id="active_id" class="select216">
                    <option value="0" <?php if($restInfo['active'] == 0) {echo "selected=\"selected\"";} ?> >No</option>
                    <option value="1" <?php if($restInfo['active'] == 1) {echo "selected=\"selected\"";} ?> >Yes</option>
                </select>
                <br /><span class="error" id="active_errorid"> <?php if(array_key_exists('active_error', $form_array)) echo $form_array['active_error'];?></span>
            </p>
            <p>&nbsp;</p>
            <p>
                <label>&nbsp;</label>
                <a href="javascript:void(0);" onclick="return validatefrm();" class="button85x30-red">Edit Now</a>
            </p>
        </div>
        <h3 class="ui-accordion-header question" role="tab" aria-expanded="false" tabindex="-1"><a href="#">Welcome Message</a></h3>
        <div class="ui-accordion-content" role="tabpanel">
            <p>
                <label for="rest_title">Title</label>
                <input type="text" name="rest_title" id="rest_title_id" value="<?php if(isset($_POST['rest_title'])){echo $_POST['rest_title'];} else {echo $restInfo['rest_title'];}?>" onkeydown="chkblnkTxtError('rest_title_id', 'rest_title_errorid');" onkeyup="chkblnkTxtError('rest_title_id', 'rest_title_errorid');" />
                &nbsp;<span class="error" id="rest_title_errorid"><?php if(array_key_exists('rest_title_error', $form_array)) echo $form_array['rest_title_error'];?></span>
            </p>
            <p>&nbsp;</p>
            <p>
                <label for="rest_short_desc">Welcome Message</label>
                <textarea name="rest_short_desc" id="rest_short_desc_id" cols="" rows="" style="width:440px; height:150px;"><?php echo $restInfo['rest_short_desc']; ?></textarea>
                &nbsp;<span class="error" id="rest_short_desc_errorid"><?php if(array_key_exists('rest_short_desc_error', $form_array)) echo $form_array['rest_short_desc_error'];?></span>
            </p>
            <p>&nbsp;</p>
            <p>
                <label for="page_discription">About Restaurant</label>
                <textarea name="page_discription" id="page_discription_id" cols="" rows="" style="width:440px; height:150px;"><?php echo $restInfo['page_discription']; ?></textarea>
                &nbsp;<span class="error" id="page_discription_errorid"><?php if(array_key_exists('page_discription_error', $form_array)) echo $form_array['page_discription_error'];?></span>
            </p>
            <p>&nbsp;</p>
            <p>
                <label>&nbsp;</label>
                <a href="javascript:void(0);" onclick="return updateRestDesc();" class="button85x30-red">Update Now</a>
            </p>
        </div>
        <h3 class="ui-accordion-header question" role="tab" aria-expanded="false" tabindex="-1"><a href="#">Restaurant Logo & Banners</a></h3>
        <div class="ui-accordion-content" role="tabpanel">
            <p>&nbsp;</p>
            <p>
                <label>Restaurant logo</label>
                <img src="<?php echo RESTAURANT_IMAGES_LOGO_PATH.$restInfo['rest_logo'];?>" border="0" width="100px" height="100px" onError="this.src='<?php echo RESTAURANT_IMAGES_LOGO_PATH;?>no-img.gif';" />
            </p>
            <p>
                <label for="rest_logo">&nbsp;</label>
                <span class="font10"><em>**Dimension 100px X 100px</em></span><br />
                <input type="file" name="rest_logo" id="rest_logo_id" value="" class="inpuTxt"/>
                &nbsp;<span class="error" id="rest_logo_errorid"><?php if(array_key_exists('rest_logo_error', $form_array)) echo $form_array['rest_logo_error'];?></span>
            </p>
            <p>&nbsp;</p>
            <p>
                <label>Restaurant Photo</label>
                <img src="<?php echo RESTAURANT_IMAGES_LARGE_PATH.$restInfo['rest_photo'];?>" border="0" width="168px" onError="this.src='<?php echo RESTAURANT_IMAGES_THUMB168x126_PATH;?>no-img.gif';" />
            </p>
            <p>
                <label for="rest_photo">&nbsp;</label>
                <span class="font10"><em>**Dimension 550px × 170px</em></span><br />
                <input type="file" name="rest_photo" id="rest_photo_id" value="" class="inpuTxt"/>
                &nbsp;<span class="error" id="rest_photo_errorid"><?php if(array_key_exists('rest_photo_error', $form_array)) echo $form_array['rest_photo_error'];?></span>
            </p>
            <p>&nbsp;</p>
            <p>
                <label>&nbsp;</label>
                <a href="javascript:void(0);" onclick="return uploadLogo();" class="button85x30-red">Upload Now</a>
            </p>
        </div>
        <h3 class="ui-accordion-header question" role="tab" aria-expanded="false" tabindex="-1"><a href="#">Picture Gallery</a></h3>
        <div class="ui-accordion-content" role="tabpanel">
            <div class="pic-galery">
				<?php
                if(is_array($restPhotoArr) && count($restPhotoArr) > 0) {
                    echo '<ul>';
                    for($i=0; $i < count($restPhotoArr); $i++){
                        $photo_id      = $restPhotoArr[$i]['photo_id'];
                        $photo_thumb   = $restPhotoArr[$i]['photo_thumb'];
                        $photo_caption = $restPhotoArr[$i]['photo_caption'];
                        $photo_url 	   = RESTAURANT_IMAGES_THUMB168x126_PATH.$photo_thumb;

                        echo '<li>';
                        echo '<img src="'.$photo_url.'" /><br>';
                        echo ''.$photo_caption.'';
                        echo '<p align="center"><a class="red" href="javascript:void(0);" onclick="return delRestPhoto('.$photo_id.');" >Detele</a></p>';
                        echo '</li>';
                     }
                    echo '</ul>';
                } else {
                    echo '<span class="red font14">Please add new photo!</span>';
                }
                ?>
            </div>
            <div class="pic-upload-sec">
                <h4>Add a new photo</h4>
                &nbsp;<span class="error" id="photo_thumb_errorid"><?php if(array_key_exists('photo_thumb_error', $form_array)) echo $form_array['photo_thumb_error'];?></span>
                <input type="file" name="photo_thumb" id="photo_thumb_id" value="" class="inpuTxt"/>
                <input  type="text" name="photo_caption" id="photo_caption_id" value="" class="inpuTxt250" style="margin-top:20px; margin-right:10px;" />
                <a href="javascript:void(0);" style="text-decoration:none;" onclick="return uploadPhotos();" class="button-red">Upload</a>
            </div>
        </div>
		<?php /*?>
        <h3 class="ui-accordion-header question" role="tab" aria-expanded="false" tabindex="-1"><a href="#">Restaurant Info</a></h3>
        <div class="ui-accordion-content" role="tabpanel">
            <?php require_once('restaurant-form-info.php'); ?>
        </div>
		<?php */?>
        <h3 class="ui-accordion-header question" role="tab" aria-expanded="false" tabindex="-1"><a href="#">Reviews & Ratings</a></h3>
        <div class="ui-accordion-content" role="tabpanel">
            <div id="rest-review">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <?php
                    if(count($reviewArr) < 1) {
                    ?>
                    <tr>
                        <td align="left" valign="top" class="pad-top10">
                            <h1>This restaurant has not yet been reviewed</h1>
                        </td>
                    </tr>
                    <?php
                    } else {
                        ?>
                        <tr><td height="10" style="border-bottom:thin #CCCCCC dotted;"></td></tr>
                        <?php
                        for($i =0; $i < count($reviewArr); $i++) {
                            $review_id 		= $reviewArr[$i]['review_id'];
                            $user_rating 	= $reviewArr[$i]['rest_rating'];
                            $review_title 	= $reviewArr[$i]['review_title'];
                            $review_txt 	= $reviewArr[$i]['review_txt'];
                            $created_on 	= date('M j, Y', $reviewArr[$i]['created_on']);
                            $user_fname 	= $reviewArr[$i]['user_fname'];
                            $user_lname 	= $reviewArr[$i]['user_lname'];
                            $user_name 		= ucwords($user_fname." ".$user_lname);
                            $country_name	= $locationObj->fun_getCountryNameById($reviewArr[$i]['user_country']);
                            $txtCreateBy 	= "<strong>Added by :</strong> ".$user_name." <strong>Date added :</strong> ".$created_on.". <strong>Country :</strong> ".$country_name;
                            $status 		= $reviewArr[$i]['status'];
                            $active 		= $reviewArr[$i]['active'];
                        ?>
                        <tr>
                            <td align="left" valign="top" class="pad-btm10 pad-top15">
                            <?php 
                            for($j=0; $j < 5; $j++) {
                                if($j < $user_rating) {
                                    echo "<img src=\"".SITE_IMAGES."star-rated.gif\" alt=\"Star\" />&nbsp;";
                                } else {
                                    echo "<img src=\"".SITE_IMAGES."star-notrated.gif\" alt=\"Star\" />&nbsp;";
                                }
                            }
                            ?>
                            </td>
                        </tr>
                        <tr><td align="left" valign="top" class="font16 red"><?php echo ucfirst($review_title); ?></td></tr>
                        <tr><td align="left" valign="top" class="font11 pad-btm10 pad-top5"><?php echo $txtCreateBy; ?></td></tr>
                        <tr><td align="left" valign="top" class="font12 pad-btm10"><?php echo $review_txt; ?></td></tr>
                        <tr>
                        	<td align="left" valign="top" class="font12 pad-btm10">
                        	<strong>Status</strong>&nbsp;:<?php echo ($status==2)?"Approved&nbsp;[ <a href=\"javascript:void(0);\" onclick=\"delReview(".$review_id.");\" class=\"blue-link\">Delete</a> ]":"Pending Approval&nbsp;[ <a href=\"javascript:void(0);\" onclick=\"approveReview(".$review_id.");\" class=\"blue-link\">Approve now</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"javascript:void(0);\" onclick=\"delReview(".$review_id.");\" class=\"blue-link\">Delete</a> ]"; ?>
                            </td>
                        </tr>
                        <tr><td height="10" style="border-bottom:thin #CCCCCC dotted;"></td></tr>
                        <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div id="picture_delete" style="display:none; position:absolute; background:transparent; left:350px; top:450px;">
        <div style="position:relative; z-index:111;left:0px;width:250px;height:170px;">
            <table width="230" border="0" cellspacing="0" cellpadding="0" >
                <tr>
                    <td align="right"><img src="<?php echo SITE_IMAGES;?>poplefttop.png" alt="ANP" height="10" width="10" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo SITE_IMAGES;?>poplefttop.png', sizingMethod='scale');" /></td>
                    <td class="topp"></td>
                    <td><img src="<?php echo SITE_IMAGES;?>poprighttop1.png" alt="ANP"  height="10" width="15" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo SITE_IMAGES;?>poprighttop1.png', sizingMethod='scale');"/></td>
                </tr>
                <tr>
                    <td class="leftp"></td>
                    <td width="220" align="left" valign="top" bgcolor="#FFFFFF" style="padding:12px;">
                        <table width="220" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="left" valign="top" class="head"><span class="pink14arial">Are you sure?</span></td>
                                <td width="15" align="right" valign="top"><a href="javascript:closeWindow();void(0);" ><img src="<?php echo SITE_IMAGES;?>Pop-Up-Cross.gif" alt="Close" title="Close" border="0" /></a></td>
                            </tr>
                            <tr>
                                <td  align="left" valign="top" class="PopTxt">
                                    <table width="98%" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="pad-right10 pad-top5"><strong>You will be delete the Picture & information related to this Restaurant's Food Photos Listing !</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="pad-top10">
                                                <div class="FloatLft"><a href="javascript:closeWindow();void(0);" ><img src="<?php echo SITE_IMAGES;?>cancel-admin.png" alt="Keep it" border="0" /></a></div>
                                                <div class="FloatLft pad-lft5"><a href="javascript:sbmtPictureDelete();"><img src="<?php echo SITE_IMAGES;?>delete-admin.gif" alt="Delete it" border="0" onmouseover="this.src='<?php echo SITE_IMAGES; ?>delete-admin.gif'" onmouseout="this.src='<?php echo SITE_IMAGES; ?>delete-admin.gif'" /></a></div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td  align="left" valign="top" class="PopTxt">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                    <td class="rightp" width="15"></td>
                </tr>
                <tr>
                    <td align="right"><img src="<?php echo SITE_IMAGES;?>popleftbtm.png" alt="ANP" /></td>
                    <td width="270" class="bottomp"></td>
                    <td align="left"><img src="<?php echo SITE_IMAGES;?>poprightbtm1.png" alt="ANP"/></td>
                </tr>
            </table>
        </div>
    </div>
    </fieldset>
</form>
<?php
} else {
?>
<form name="frmRestaurant" id="frmRestaurant" method="post" action="admin-restaurant.php" enctype="multipart/form-data">
    <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("ADDNEWRESTAURANT"); ?>">
    <fieldset>
    <legend>Add Restaurant</legend>
    <div id="accordion" class="ui-accordion ui-widget ui-helper-reset ui-accordion-icons" role="tablist">
        <h3 class="ui-accordion-header question"><a href="#">Restaurant Details</a></h3>
        <div class="ui-accordion-content" role="tabpanel">
            <p>
                <label for="rest_name">Restaurant name</label>
                <input type="text" name="rest_name" id="rest_name_id" value="<?php if(isset($_POST['rest_name'])){echo $_POST['rest_name'];} else {echo $restInfo['rest_name'];}?>" onkeydown="chkblnkTxtError('rest_name_id', 'rest_name_errorid');" onkeyup="chkblnkTxtError('rest_name_id', 'rest_name_errorid');" />
                &nbsp;<span class="error" id="rest_name_errorid"><?php if(array_key_exists('rest_name_error', $form_array)) echo $form_array['rest_name_error'];?></span>
            </p>
            <p class="pad-btm5">
                <label for="rest_country_id">Country</label>
                <select name="rest_country_id" id="rest_country_id_id" class="select310" onchange="chkSelectCountry();">
                    <option value="0" selected>Select ... </option>
                    <?php 
				    	$locationObj->fun_getCountryOptionsList(((isset($_POST['rest_country_id']) && ($_POST['rest_country_id'] != "" || $_POST['rest_country_id'] != "0"))?$_POST['rest_country_id']:((isset($restInfo['rest_country_id']) && ($restInfo['rest_country_id'] != "" || $restInfo['rest_country_id'] != "0"))?$restInfo['rest_country_id']:223)), '');
					?>
                </select>
                <span class="error" id="rest_country_id_errorid"><?php if(array_key_exists('rest_country_id_error', $form_array)) echo $form_array['rest_country_id_error'];?></span>
            </p>
            <p>
                <label for="rest_state_id">State / Province</label>
                <select name="rest_state_id" id="rest_state_id_id" class="select310" onchange="chkSelectState();">
                    <option value="0" selected>Select ... </option>
                    <?php 
					   $locationObj->fun_getStateOptionsListByCountryId(((isset($_POST['rest_state_id']) && ($_POST['rest_state_id'] != "" || $_POST['rest_state_id'] != "0"))?$_POST['rest_state_id']:$restInfo['rest_state_id']), ((isset($_POST['rest_country_id']) && ($_POST['rest_country_id'] != "" || $_POST['rest_country_id'] != "0"))?$_POST['rest_country_id']:((isset($restInfo['rest_country_id']) && ($restInfo['rest_country_id'] != "" || $restInfo['rest_country_id'] != "0"))?$restInfo['rest_country_id']:223)));
					?>
                </select>
                <span class="error" id="rest_state_id_errorid">
                <?php if(array_key_exists('rest_state_id_error', $form_array)) echo $form_array['rest_state_id_error'];?>
                </span>
            </p>
            <p>
                <label for="rest_city_id">City</label>
                <select name="rest_city_id" id="rest_city_id_id" class="select310" >
                    <option value="0" selected>Select ... </option>
                </select>
                <span class="error" id="rest_city_id_errorid">
                <?php if(array_key_exists('rest_city_id_error', $form_array)) echo $form_array['rest_city_id_error'];?>
                </span>
            </p>
            <p>
                <label for="rest_address1">Street address</label>
                <input type="text" name="rest_address1" id="rest_address1_id" value="<?php if(isset($_POST['rest_address1'])){echo $_POST['rest_address1'];}else{echo $restInfo['rest_address1'];}?>" onkeydown="chkblnkTxtError('rest_address1_id', 'rest_address1_errorid');" onkeyup="chkblnkTxtError('rest_address1_id', 'rest_address1_errorid');" />
                &nbsp;<span class="error" id="rest_address1_errorid"><?php if(array_key_exists('rest_address1_error', $form_array)) echo $form_array['rest_address1_error'];?></span>
            </p>
            <p>
                <label for="rest_address2">&nbsp;</label>
                <input type="text" name="rest_address2" id="rest_address2_id" value="<?php if(isset($_POST['rest_address2'])){echo $_POST['rest_address2'];}else{echo $restInfo['rest_address2'];}?>" />
                &nbsp;
            </p>
            <p>
                <label for="rest_zip">Zip / Postal code</label>
                <input type="text" name="rest_zip" id="rest_zip_id" value="<?php if(isset($_POST['rest_zip'])){echo $_POST['rest_zip'];}else{echo $restInfo['rest_zip'];}?>" onkeydown="chkblnkTxtError('rest_zip_id', 'rest_zip_errorid');" onkeyup="chkblnkTxtError('rest_zip_id', 'rest_zip_errorid');" />
                &nbsp;<span class="error" id="rest_zip_errorid">
                <?php if(array_key_exists('rest_zip_error', $form_array)) echo $form_array['rest_zip_error'];?>
                </span>
            </p>
            <p>&nbsp;</p>
            <p>
                <label>&nbsp;</label>
                <a href="javascript:void(0);" onclick="return validatefrm();" class="button85x30-red">Add Now</a>
            </p>
        </div>
        <h3 class="ui-accordion-header question" role="tab" aria-expanded="false" tabindex="-1"><a href="#">Welcome Message</a></h3>
        <div class="ui-accordion-content" role="tabpanel"><span class="red">Add Restaurant Details First!</span></div>
        <h3 class="ui-accordion-header question" role="tab" aria-expanded="false" tabindex="-1"><a href="#">Restaurant Logo & Banners</a></h3>
        <div class="ui-accordion-content" role="tabpanel"><span class="red">Add Restaurant Details First!</span></div>
        <h3 class="ui-accordion-header question" role="tab" aria-expanded="false" tabindex="-1"><a href="#">Picture Gallery</a></h3>
        <div class="ui-accordion-content" role="tabpanel"><span class="red">Add Restaurant Details First!</span></div>
        <h3 class="ui-accordion-header question" role="tab" aria-expanded="false" tabindex="-1"><a href="#">Restaurant Info</a></h3>
        <div class="ui-accordion-content" role="tabpanel"><span class="red">Add Restaurant Details First!</span></div>
        <h3 class="ui-accordion-header question" role="tab" aria-expanded="false" tabindex="-1"><a href="#">Reviews & Ratings</a></h3>
        <div class="ui-accordion-content" role="tabpanel"><span class="red">Add Restaurant Details First!</span></div>
    </div>
    </fieldset>
</form>
<?php
}
?>
