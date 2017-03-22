<script type="text/javascript" language="javascript">
function chkblnkTxtError(strFieldId, strErrorFieldId){
	if(document.getElementById(strFieldId).value != ""){
	  document.getElementById(strErrorFieldId).innerHTML = "";
	}
}

function validatefrm(){
	var alreadyFocussed = false;
	document.frmCountry.country_desc_id.value = tinyMCE.get('country_desc_id').getContent();

	if(document.getElementById("country_name_id").value == "") {
		document.getElementById("country_name_errorid").innerHTML = "Country name required";
		document.getElementById("country_name_id").focus();
		return false;
	}

	if(document.frmCountry.country_desc_id.value == "") {
		document.getElementById("country_desc_errorid").innerHTML = "Page description required";
		document.getElementById("country_desc_id").focus();
		if(!alreadyFocussed){
			document.frmCountry.country_desc_id.focus();
			alreadyFocussed = true;
		}
		return false;
	}

	document.frmCountry.submit();
}
</script>
<!-- TinyMCE -->
<script type="text/javascript" src="../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
    tinyMCE.init({
        mode : "exact",
        elements : "country_desc_id",
        theme : "advanced",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        
    });

    function myHandleEvent(e){
        if(e.type=="keyup"){
            chkblnkEditorTxtError("country_desc_id", "country_desc_errorid");	
        }
        return true;
    }
</script>
<!-- /TinyMCE -->
<?php
if(isset($country_id) && $country_id !=""){
	$countryInfo 	    = $locationObj->fun_getCountryInfoById($country_id);
	?>
    <form name="frmCountry" id="frmCountry" method="post" action="admin-settings.php?sec=location&action=edit&country_id=<?php echo $country_id;?>" enctype="multipart/form-data">
        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITCOUNTRY"); ?>">
        <input type="hidden" name="country_id" id="country_id_id" value="<?php echo $country_id; ?>">
        <input type="hidden" name="zoom_level" id="zoom_level_id" value="<?php if(isset($countryInfo['zoom_level'])) {echo $countryInfo['zoom_level'];} else {echo "10";}?>" />
        <input type="hidden" name="map_type"  id="map_type_id" value="G_HYBRID_MAP"/>
        <input type="hidden" name="latitude" id="latitude_id" value="<?php if(isset($countryInfo['latitude']) && $countryInfo['latitude'] !=""){echo $countryInfo['latitude'];} else {echo "38.886757140695906";} ?>">
        <input type="hidden" name="longitude" id="longitude_id" value="<?php if(isset($countryInfo['longitude']) && $countryInfo['longitude'] !=""){echo $countryInfo['longitude'];} else {echo "22.3187255859375";} ?>">
        <fieldset>
        <legend><?php echo $addtitle; ?></legend>
            <div class="floatRight pad-top5 pad-btm5" align="right">
                <a href="admin-settings.php?sec=location" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
            </div>
            <p><label for="country_name">Country Name</label><input type="text" name="country_name" id="country_name_id" value="<?php if(isset($_POST['country_name'])){echo $_POST['country_name'];}else{echo $countryInfo['country_name'];}?>" onkeydown="chkblnkTxtError('country_name_id', 'country_name_errorid');" onkeyup="chkblnkTxtError('country_name_id', 'country_name_errorid');" />&nbsp;<span class="error" id="country_name_errorid"><?php if(array_key_exists('country_name_error', $form_array)) echo $form_array['country_name_error'];?> </span></p>
            <p><label for="country_iso_code_2">Country ISO2</label><input type="text" name="country_iso_code_2" id="country_iso_code_2_id" value="<?php if(isset($_POST['country_iso_code_2'])){echo $_POST['country_iso_code_2'];}else{echo $countryInfo['country_iso_code_2'];}?>" onkeydown="chkblnkTxtError('country_iso_code_2_id', 'country_iso_code_2_errorid');" onkeyup="chkblnkTxtError('country_iso_code_2_id', 'country_iso_code_2_errorid');" />&nbsp;<span class="error" id="country_iso_code_2_errorid"><?php if(array_key_exists('country_iso_code_2_error', $form_array)) echo $form_array['country_iso_code_2_error'];?> </span></p>
            <p><label for="country_iso_code_3">Country ISO3</label><input type="text" name="country_iso_code_3" id="country_iso_code_3_id" value="<?php if(isset($_POST['country_iso_code_3'])){echo $_POST['country_iso_code_3'];}else{echo $countryInfo['country_iso_code_3'];}?>" onkeydown="chkblnkTxtError('country_iso_code_3_id', 'country_iso_code_3_errorid');" onkeyup="chkblnkTxtError('country_iso_code_3_id', 'country_iso_code_3_errorid');" />&nbsp;<span class="error" id="country_iso_code_3_errorid"><?php if(array_key_exists('country_iso_code_3_error', $form_array)) echo $form_array['country_iso_code_3_error'];?> </span></p>
            <p><label for="country_isd_code">Country ISD</label><input type="text" name="country_isd_code" id="country_isd_code_id" value="<?php if(isset($_POST['country_isd_code'])){echo $_POST['country_isd_code'];}else{echo $countryInfo['country_isd_code'];}?>" onkeydown="chkblnkTxtError('country_isd_code_id', 'country_isd_code_errorid');" onkeyup="chkblnkTxtError('country_isd_code_id', 'country_isd_code_errorid');" />&nbsp;<span class="error" id="country_isd_code_errorid"><?php if(array_key_exists('country_isd_code_error', $form_array)) echo $form_array['country_isd_code_error'];?> </span></p>
            <p>&nbsp;</p>
            <p><label for="country_desc">Description</label><textarea type="text" name="country_desc" id="country_desc_id" onkeydown="chkblnkTxtError('country_desc_id', 'country_desc_errorid');" onkeyup="chkblnkTxtError('country_desc_id', 'country_desc_errorid');" class="txtarea_540x300" /><?php if(isset($_POST['country_desc'])){echo $_POST['country_desc'];}else{echo $countryInfo['country_desc'];}?></textarea> <br /><span class="error" id="country_desc_errorid"> <?php if(array_key_exists('country_desc_error', $form_array)) echo $form_array['country_desc_error'];?></span></p>
            <p>
                <label>Google Map</label>
                <div style="height:60px; width:540px; float:right; margin-bottom:5px; margin-top:20px; vertical-align:top;" >
					<script language="javascript" type="text/javascript">
                        function showLatLonFrm() {
                            document.getElementById("findMapFrm").style.display = "block";
                        }
                    </script>
                    <a href="javascript:void(0);" onclick="showLatLonFrm();">Know Latitude and Longitude?</a>
                    <div id="findMapFrm" style="display:none; font-size:10px;">
                        Latitude&nbsp;<input name="txtLat" id="txtLatId" type="text" class="txtBox75" value="<?php echo $countryInfo['latitude']; ?>" />
                        &nbsp;&nbsp;
                        Longitude&nbsp;<input name="txtLon" id="txtLonId" type="text" class="txtBox75" value="<?php echo $countryInfo['longitude']; ?>" />
                        &nbsp;&nbsp;
                        Zoom level&nbsp;<?php $systemObj->fun_createSelectNumField("txtZoom", "txtZoomId", "select60", $countryInfo['zoom_level'], "", 1, 10); ?>
                        &nbsp;&nbsp;
                        <a href="javascript:void(0);" onclick="findOnMap();" class="button85x30-blue" style="text-decoration:none;">Find Now</a>
                    </div>
                </div>
                <div id="map" style="width:540px; height:400px; float:right; border:1px solid #999999;"></div>
            </p>
            <p style="clear:both; height:10px;">&nbsp;</p>
            <p>
                <label>&nbsp;</label>
                <a href="javascript:void(0);" onclick="return validatefrm();" class="button85x30-red">Edit Now</a>
            </p>
        </fieldset>
    </form>
<!-- Map code: Start here -->
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
	var map;
	var marker;
	var markersArray = [];
	var Options = [];
	var geocoder;

	function findOnMap() {
		clearOverlays();
		var image = new google.maps.MarkerImage('<?php echo SITE_IMAGES;?>markers/marker.png', new google.maps.Size(20, 34), new google.maps.Point(0,0), new google.maps.Point(0,32));
		var shadow = new google.maps.MarkerImage('<?php echo SITE_IMAGES;?>markers/shadow.png', new google.maps.Size(37, 32), new google.maps.Point(0,0), new google.maps.Point(0, 32));
		var Latlng = new google.maps.LatLng(document.getElementById('txtLatId').value, document.getElementById('txtLonId').value, document.getElementById('txtZoomId').value);
		var zoomLevel = parseInt(document.getElementById("txtZoomId").value);
		document.getElementById("latitude_id").value = document.getElementById('txtLatId').value;
		document.getElementById("longitude_id").value = document.getElementById('txtLonId').value;
		document.getElementById("zoom_level_id").value = document.getElementById('txtZoomId').value;

		map.setCenter(Latlng);
		map.setZoom(zoomLevel);
		map.setMapTypeId(google.maps.MapTypeId.HYBRID);
		marker = new google.maps.Marker({
			position: Latlng, 
			map: map,
			shadow: shadow,
			icon: image,
			draggable: true,
			title:"<?php echo $countryInfo['country_name']; ?>"
		});   

		google.maps.event.addListener(map, 'zoom_changed', function() {
			zoomLevel = map.getZoom();
			lz = document.getElementById("zoom_level_id");
			lz.value = zoomLevel; 
			if (zoomLevel == 0) {
				map.setZoom(10);
			}
		});

		google.maps.event.addListener(marker, 'dragend', function(event) {
			var point = marker.getPosition();
			var c = new google.maps.LatLng(point.lat(), point.lng());
			map.panTo(c); 
			la = document.getElementById("latitude_id"); 
			la.value = c.lat(); 
			lo = document.getElementById("longitude_id"); 
			lo.value = c.lng();
			marker.setPoint(c); 
		}); 
		markersArray.push(marker);
	}

	function addAddressToMap(results, status) {
		clearOverlays();
		if (status == google.maps.GeocoderStatus.OK) {
			var image = new google.maps.MarkerImage('<?php echo SITE_IMAGES;?>markers/marker.png', new google.maps.Size(20, 34), new google.maps.Point(0,0), new google.maps.Point(0,32));
			var shadow = new google.maps.MarkerImage('<?php echo SITE_IMAGES;?>markers/shadow.png', new google.maps.Size(37, 32), new google.maps.Point(0,0), new google.maps.Point(0, 32));
			var zoomLevel = parseInt(document.getElementById("zoom_level_id").value);
			map.setCenter(results[0].geometry.location);
			map.setZoom(zoomLevel);
			map.setMapTypeId(google.maps.MapTypeId.HYBRID);
			marker = new google.maps.Marker({
				position: results[0].geometry.location, 
				map: map,
				shadow: shadow,
				icon: image,
				draggable: true,
				title:"<?php echo $countryInfo['country_name']; ?>"
			});   

			google.maps.event.addListener(map, 'zoom_changed', function() {
				zoomLevel = map.getZoom();
				lz = document.getElementById("zoom_level_id");
				lz.value = zoomLevel; 
				if (zoomLevel == 0) {
					map.setZoom(10);
				}
			});

			google.maps.event.addListener(marker, 'dragend', function(event) {
				var point = marker.getPosition();
				var c = new google.maps.LatLng(point.lat(), point.lng());
				map.panTo(c); 
				la = document.getElementById("latitude_id"); 
				la.value = c.lat(); 
				lo = document.getElementById("longitude_id"); 
				lo.value = c.lng();
				marker.setPoint(c); 
			}); 
			markersArray.push(marker);
		}
	}

	// Removes the overlays from the map, but keeps them in the array
	function clearOverlays() {
	  if (markersArray) {
		for (i in markersArray) {
		  markersArray[i].setMap(null);
		}
	  }
	}

	function initialize() {
		geocoder = new google.maps.Geocoder();
		<?php 
		if((isset($countryInfo['latitude']) && $countryInfo['latitude'] !="") && (isset($countryInfo['longitude']) && $countryInfo['longitude'] !="")){
		?>
			var strlatitude = <?php echo $countryInfo['latitude']; ?>;
			var strlongitude = <?php echo $countryInfo['longitude']; ?>;
			var zoomLevel = <?php echo $countryInfo['zoom_level']; ?>;
			var image = new google.maps.MarkerImage('<?php echo SITE_IMAGES;?>markers/marker.png', new google.maps.Size(20, 34), new google.maps.Point(0,0), new google.maps.Point(0,32));
			var shadow = new google.maps.MarkerImage('<?php echo SITE_IMAGES;?>markers/shadow.png', new google.maps.Size(37, 32), new google.maps.Point(0,0), new google.maps.Point(0, 32));
			var Latlng = new google.maps.LatLng(strlatitude, strlongitude);

			var Options = {
			  zoom: zoomLevel,
			  center: Latlng,
			  mapTypeId: google.maps.MapTypeId.HYBRID
			};
			map = new google.maps.Map(document.getElementById('map'), Options);

			marker = new google.maps.Marker({
				position: Latlng, 
				map: map,
				shadow: shadow,
				icon: image,
				draggable: true,
				title:"<?php echo $countryInfo['country_name']; ?>"
			});   

			google.maps.event.addListener(map, 'zoom_changed', function() {
				zoomLevel = map.getZoom();
				lz = document.getElementById("zoom_level_id");
				lz.value = zoomLevel; 
				if (zoomLevel == 0) {
					map.setZoom(10);
				}
			});

			google.maps.event.addListener(marker, 'dragend', function(event) {
				var point = marker.getPosition();
				var c = new google.maps.LatLng(point.lat(), point.lng());
				map.panTo(c); 
				la = document.getElementById("latitude_id"); 
				la.value = c.lat(); 
				lo = document.getElementById("longitude_id"); 
				lo.value = c.lng();
				marker.setPoint(c); 
			}); 
			markersArray.push(marker);
		<?php
		} else if(isset($countryInfo['country_name']) && $countryInfo['country_name'] != ""){
		?>
			var zoomLevel = <?php echo $countryInfo['zoom_level']; ?>;
			var address = "<?php echo ucwords($countryInfo['country_name']); ?>";
			var Options = {
			  zoom: zoomLevel,
			  mapTypeId: google.maps.MapTypeId.HYBRID
			};
			map = new google.maps.Map(document.getElementById('map'), Options);
			geocoder.geocode( { 'address': address}, addAddressToMap);  
		<?php
		} 
		?>
	}
	google.maps.event.addDomListener(window, 'load', initialize);
</script>
<!-- Map code: End here -->


<?php
} else {
/*
?>
    <form name="frmCountry" id="frmCountry" method="post" action="admin-settings.php?sec=add" enctype="multipart/form-data">
        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("ADDPAGE"); ?>">
        <input type="hidden" name="page_type" id="page_type" value="1">
        <fieldset>
        <legend>Add a New Page</legend>
            <p><label for="country_name">Page Title</label><input type="text" name="country_name" id="country_name_id" value="<?php if(isset($_POST['country_name'])){echo $_POST['country_name'];}?>" onkeydown="chkblnkTxtError('country_name_id', 'country_name_errorid');" onkeyup="chkblnkTxtError('country_name_id', 'country_name_errorid');" />&nbsp;<span class="error" id="country_name_errorid"><?php if(array_key_exists('country_name_error', $form_array)) echo $form_array['country_name_error'];?> </span></p>
            <p><label for="country_iso_code_2">Page Content Title</label><input type="text" name="country_iso_code_2" id="country_iso_code_2_id" value="<?php if(isset($_POST['country_iso_code_2'])){echo $_POST['country_iso_code_2'];}?>" onkeydown="chkblnkTxtError('country_iso_code_2_id', 'country_iso_code_2_errorid');" onkeyup="chkblnkTxtError('country_iso_code_2_id', 'country_iso_code_2_errorid');" />&nbsp;<span class="error" id="country_iso_code_2_errorid"><?php if(array_key_exists('country_iso_code_2_error', $form_array)) echo $form_array['country_iso_code_2_error'];?> </span></p>
            <p><label for="country_iso_code_3">SEO Title</label><input type="text" name="country_iso_code_3" id="country_iso_code_3_id" value="<?php if(isset($_POST['country_iso_code_3'])){echo $_POST['country_iso_code_3'];}?>" onkeydown="chkblnkTxtError('country_iso_code_3_id', 'country_iso_code_3_errorid');" onkeyup="chkblnkTxtError('country_iso_code_3_id', 'country_iso_code_3_errorid');" />&nbsp;<span class="error" id="country_iso_code_3_errorid"><?php if(array_key_exists('country_iso_code_3_error', $form_array)) echo $form_array['country_iso_code_3_error'];?> </span></p>
            <p><label for="country_isd_code">SEO Keyword</label><input type="text" name="country_isd_code" id="country_isd_code_id" value="<?php if(isset($_POST['country_isd_code'])){echo $_POST['country_isd_code'];}?>" onkeydown="chkblnkTxtError('country_isd_code_id', 'country_isd_code_errorid');" onkeyup="chkblnkTxtError('country_isd_code_id', 'country_isd_code_errorid');" />&nbsp;<span class="error" id="country_isd_code_errorid"><?php if(array_key_exists('country_isd_code_error', $form_array)) echo $form_array['country_isd_code_error'];?> </span></p>
            <p><label for="page_seo_discription">SEO Description</label><input type="text" name="page_seo_discription" id="page_seo_discription_id" value="<?php if(isset($_POST['page_seo_discription'])){echo $_POST['page_seo_discription'];}?>" onkeydown="chkblnkTxtError('page_seo_discription_id', 'page_seo_discription_errorid');" onkeyup="chkblnkTxtError('page_seo_discription_id', 'page_seo_discription_errorid');" />&nbsp;<span class="error" id="page_seo_discription_errorid"><?php if(array_key_exists('page_seo_discription_error', $form_array)) echo $form_array['page_seo_discription_error'];?> </span></p>
            <p>&nbsp;</p>
            <p><label for="country_desc">Page Discription</label><textarea type="text" name="country_desc" id="country_desc_id"  onkeydown="chkblnkTxtError('country_desc_id', 'country_desc_errorid');" onkeyup="chkblnkTxtError('country_desc_id', 'country_desc_errorid');" class="txtarea_540x300" /><?php if(isset($_POST['country_desc'])){echo $_POST['country_desc'];}?></textarea> &nbsp;<span class="error" id="country_desc_errorid"> <?php if(array_key_exists('country_desc_error', $form_array)) echo $form_array['country_desc_error'];?></span></p>
            <p><label>&nbsp;</label> <a href="javascript:void(0);" style="text-decoration:none;"><img src="<?php echo SITE_ADMIN_IMAGES;?>addnow_btn.gif" border="0" onclick="return validatefrm();" /></a></p>
        </fieldset>
    </form>
<?php
*/
}
?>
