<script type="text/javascript" language="javascript">
	var req = ajaxFunction();
	function chkblnkTxtError(strFieldId, strErrorFieldId){
		if(document.getElementById(strFieldId).value != ""){
			document.getElementById(strErrorFieldId).innerHTML = "";
		}
	}
	function chkSelectCountry() {
		var getID = document.getElementById("resource_country_id_id").value;
		if(getID !="" && getID != "0"){
			sendStateRequest(getID);
			document.getElementById("resource_city_id_id").value = "0";
		}
		if(getID == "0" || getID =="") {
			document.getElementById("resource_state_id_id").value = "0";
			document.getElementById("resource_city_id_id").value = "0";
		}
	}

	function chkSelectState() {
		var getID = document.getElementById("resource_state_id_id").value;
		if(getID !="" && getID != "0"){
			sendCityRequest(getID);
		}
		if(getID == "0" || getID =="") {
			document.getElementById("resource_city_id_id").value = "0";
		}
	}

	function sendStateRequest(id) { 
		req.open('get', '<?php echo SITE_URL;?>selectStateXml.php?id='+id); 
		req.onreadystatechange = handleStateResponse; 
		req.send(null); 
	} 

	function sendCityRequest(id) { 
		req.open('get', '<?php echo SITE_URL;?>selectCityXml.php?id=' + id); 
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
					var rest_state = document.getElementById("resource_state_id_id");
					rest_state.length = 0;
					rest_state.options[0] = new Option("Please Select...", "");
					for(var j=0; j<arrayOfId.length; j++) {
						rest_state.options[j+1]=new Option(arrayOfNames[j], arrayOfId[j]);
					}
				} else {
					// For State
					var rest_state = document.getElementById("resource_state_id_id");
					rest_state.length = 0;
					rest_state.options[0] = new Option("Please Select...", "");

					// For City
					var rest_city = document.getElementById("resource_city_id_id");
					rest_city.length = 0;
					rest_city.options[0] = new Option("Please Select...", "0");
				}
			} else {
				// For State
				var rest_state = document.getElementById("resource_state_id_id");
				rest_state.length = 0;
				rest_state.options[0] = new Option("Please Select...", "");

				// For City
				var rest_city = document.getElementById("resource_city_id_id");
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
					var rest_city = document.getElementById("resource_city_id_id");
					rest_city.length = 0;
					rest_city.options[0] = new Option("Please Select...","0");
					for(var j=0; j<arrayOfId.length; j++) {
						rest_city.options[j+1] = new Option(arrayOfNames[j],arrayOfId[j]);
					}
				} else {
					var rest_city = document.getElementById("resource_city_id_id");
					rest_city.length = 0;
					rest_city.options[0] = new Option("Please Select...", "0");
				}
			} else {
				var rest_city = document.getElementById("resource_city_id_id");
				rest_city.length = 0;
				rest_city.options[0] = new Option("Please Select...", "0");
			}
		} 
	} 
	function validatefrm(){
		if(document.getElementById("resource_link_id").value == "") {
			document.getElementById("resource_link_errorid").innerHTML = "Resource link required";
			document.getElementById("resource_link_id").focus();
			return false;
		}

		if(document.getElementById("resource_name_id").value == "") {
			document.getElementById("resource_name_errorid").innerHTML = "Resource name required";
			document.getElementById("resource_name_id").focus();
			return false;
		}

		if(document.getElementById("resource_description_id").value == "") {
			document.getElementById("resource_description_id_errorid").innerHTML = "Resource Rescription required";
			document.getElementById("resource_description_id").focus();
			return false;
		}
		document.frmResource.submit();
	}
</script>
<?php
if(isset($resource_id) && $resource_id !=""){
	$resourceInfo 	= $resObj->fun_getResourceInfo($resource_id);
	$user_id 		= $dbObj->getField(TABLE_USER_RESOURCES_RELATIONS, "resource_id", $resource_id, "user_id");
	$userInfoArr 	= $usersObj->fun_getUsersInfo($user_id);
	?>
    <form name="frmResource" id="frmResource" method="post" action="admin-settings.php?sec=resource&action=edit&resource_id=<?php echo $resource_id;?>" enctype="multipart/form-data">
        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITRESOURCE"); ?>">
        <input type="hidden" name="resource_id" id="resource_id_id" value="<?php echo $resource_id; ?>">
    <fieldset>
    <legend>Edit Resource</legend>
    <div class="floatRight pad-top5 pad-btm5" align="right">
        <a href="admin-settings.php?sec=resource" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
    </div>
    <p>
        <label for="user_fname">First name</label>
        <input type="text" name="user_fname" id="user_fname_id" value="<?php echo $userInfoArr['user_fname']; ?>" disabled="disabled" />
    </p>
    <p>
        <label for="user_lname">Last name</label>
        <input type="text" name="user_lname" id="user_lname_id" value="<?php echo $userInfoArr['user_lname'];?>" disabled="disabled" />
    </p>
    <p>
        <label for="user_email">Email address</label>
        <input type="text" name="user_email" id="user_email_id" value="<?php echo $userInfoArr['user_email'];?>" disabled="disabled" />
    </p>
    <p>
    	<label for="resource_cat_ids">Choose a category</label>
        <select name="resource_cat_ids" id="resource_cat_ids_id"  class="select310">
            <option value="0">Select ... </option>
            <?php 
             $resObj->fun_getResourcesCatListOptions($resourceInfo['resource_cat_ids']);;
            ?> 
        </select>
        &nbsp;<span class="error" id="resource_cat_ids_errorid"><?php if(array_key_exists('resource_cat_ids_error', $form_array)) echo $form_array['resource_cat_ids_error'];?> </span>
    </p>
    <p>
    	<label for="resource_country_id" style="margin-top:5px;">Your resource would be ideal for people visiting which location</label>
        <select name="resource_country_id" id="resource_country_id_id" class="select310" onchange="chkSelectCountry();">
            <option value="0" selected>Select ... </option>
            <?php 
               $locationObj->fun_getCountryOptionsList($resourceInfo['resource_country_id']);
            ?>
        </select>
        <span class="error" id="resource_country_id_errorid">
        <?php if(array_key_exists('resource_country_id_error', $form_array)) echo $form_array['resource_country_id_error'];?>
        </span>
    </p>
    <p>
    	<label for="resource_state_id">&nbsp;</label>
        <select name="resource_state_id" id="resource_state_id_id" class="select310" onchange="chkSelectState();">
            <option value="0" selected>Select ... </option>
            <?php 
               $locationObj->fun_getStatesOptionsList($resourceInfo['resource_state_id']);
            ?>
        </select>
        <span class="error" id="resource_state_id_errorid">
        <?php if(array_key_exists('resource_state_id_error', $form_array)) echo $form_array['resource_state_id_error'];?>
        </span>
    </p>
    <p>
    	<label for="resource_city_id">&nbsp;</label>
        <select name="resource_city_id" id="resource_city_id_id" class="select310">
            <option value="0" selected>Select ... </option>
            <?php 
               $locationObj->fun_getCitysOptionsList($resourceInfo['resource_city_id']);
            ?>
        </select>
        <span class="error" id="resource_city_id_errorid">
        <?php if(array_key_exists('resource_city_id_error', $form_array)) echo $form_array['resource_city_id_error'];?>
        </span>
    </p>
    <p>
    	<label for="resource_link" style="margin-top:5px;">Where do you want your resource to link to?</label>
        <input type="text" name="resource_link" id="resource_link_id" value="<?php if(isset($resourceInfo['resource_link'])){echo $resourceInfo['resource_link'];} else {echo "http://";}?>" onkeydown="chkblnkTxtError('resource_link_id', 'resource_link_errorid');" onkeyup="chkblnkTxtError('resource_link_id', 'resource_link_errorid');" />&nbsp;
        <span class="error" id="resource_link_errorid"><?php if(array_key_exists('resource_link_error', $form_array)) echo $form_array['resource_link_error'];?></span>
    </p>
    <p>
    	<label for="resource_name">Title of your link</label>
        <input type="text" name="resource_name" id="resource_name_id" value="<?php if(isset($resourceInfo['resource_name'])){echo $resourceInfo['resource_name'];}?>" onkeydown="chkblnkTxtError('resource_name_id', 'resource_name_errorid');" onkeyup="chkblnkTxtError('resource_name_id', 'resource_name_errorid');" />&nbsp;
        <span class="error" id="resource_name_errorid"><?php if(array_key_exists('resource_name_error', $form_array)) echo $form_array['resource_name_error'];?></span>
    </p>
    <p>
    	<label for="resource_description">Description</label>
        <textarea type="text" name="resource_description" id="resource_description_id" style="width:420px; height:150px; margin-left:143px; margin-top:-15px;" /><?php echo $resourceInfo['resource_description'];?></textarea>
        &nbsp;<span class="error" id="resource_description_errorid"><?php if(array_key_exists('resource_description_error', $form_array)) echo $form_array['resource_description_error'];?></span>
    </p> 
    <p>
    	<label for="resource_mc_link" style="margin-top:5px;">Where will our link appear on your website?</label>
        <input type="text" name="resource_mc_link" id="resource_mc_link_id" value="<?php if(isset($resourceInfo['resource_mc_link'])){echo $resourceInfo['resource_mc_link'];} else {echo "http://";}?>" onkeydown="chkblnkTxtError('resource_mc_link_id', 'resource_mc_link_errorid');" onkeyup="chkblnkTxtError('resource_mc_link_id', 'resource_mc_link_errorid');" />&nbsp;
        <span class="error" id="resource_mc_link_errorid"><?php if(array_key_exists('resource_mc_link_error', $form_array)) echo $form_array['resource_mc_link_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
        <label for="active">Active</label>
        <select name="active" id="active_id" class="select216">
            <option value="0" <?php if($resourceInfo['active'] == 0) {echo "selected=\"selected\"";} ?> >No</option>
            <option value="1" <?php if($resourceInfo['active'] == 1) {echo "selected=\"selected\"";} ?> >Yes</option>
        </select>
        <br /><span class="error" id="active_errorid"> <?php if(array_key_exists('active_error', $form_array)) echo $form_array['active_error'];?></span>
    </p>
    <p>&nbsp;</p>
    <p>
        <label>&nbsp;</label>
        <a href="<?php echo SITE_URL."resources"; ?>" class="button85x30-grey">Cancel</a>&nbsp;<a href="javascript:void(0);" onclick="return validatefrm();" class="button85x30-red">Edit Now</a>
    </p>
    </fieldset>
    </form>
<?php
} else {
?>
<fieldset>
    <legend><?php echo $addtitle; ?></legend>
    <div class="floatRight pad-top5 pad-btm5" align="right">
        <a href="admin-settings.php?sec=resource" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
    </div>
    <p>No Resource Selected!</p>
</fieldset>
<?php
}
?>
