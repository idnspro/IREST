<script type="text/javascript" language="javascript">
function chkblnkTxtError(strFieldId, strErrorFieldId){
	if(document.getElementById(strFieldId).value != ""){
	  document.getElementById(strErrorFieldId).innerHTML = "";
	}
}

function validatefrm(){
	var alreadyFocussed = false;
	document.frmstate.state_desc_id.value = tinyMCE.get('state_desc_id').getContent();

	if(document.getElementById("state_name_id").value == "") {
		document.getElementById("state_name_errorid").innerHTML = "state name required";
		document.getElementById("state_name_id").focus();
		return false;
	}

	if(document.frmstate.state_desc_id.value == "") {
		document.getElementById("state_desc_errorid").innerHTML = "Page description required";
		document.getElementById("state_desc_id").focus();
		if(!alreadyFocussed){
			document.frmstate.state_desc_id.focus();
			alreadyFocussed = true;
		}
		return false;
	}

	document.frmstate.submit();
}
</script>
<!-- TinyMCE -->
<script type="text/javascript" src="../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
    tinyMCE.init({
        mode : "exact",
        elements : "state_desc_id",
        theme : "advanced",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        
    });

    function myHandleEvent(e){
        if(e.type=="keyup"){
            chkblnkEditorTxtError("state_desc_id", "state_desc_errorid");	
        }
        return true;
    }
</script>
<!-- /TinyMCE -->
<?php
if(isset($state_id) && $state_id !=""){
	$stateInfo 	    = $locationObj->fun_getStateInfoById($state_id);
	?>
    <form name="frmstate" id="frmstate" method="post" action="admin-settings.php?sec=location&show=state&action=edit&state_id=<?php echo $state_id;?>&country_id=<?php echo $country_id;?>" enctype="multipart/form-data">
        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITSTATE"); ?>">
        <input type="hidden" name="state_id" id="state_id_id" value="<?php echo $state_id; ?>">
        <input type="hidden" name="zoom_level" id="zoom_level_id" value="<?php if(isset($stateInfo['zoom_level'])) {echo $stateInfo['zoom_level'];} else {echo "10";}?>" />
        <input type="hidden" name="map_type"  id="map_type_id" value="G_HYBRID_MAP"/>
        <input type="hidden" name="latitude" id="latitude_id" value="<?php if(isset($stateInfo['latitude']) && $stateInfo['latitude'] !=""){echo $stateInfo['latitude'];} else {echo "38.886757140695906";} ?>">
        <input type="hidden" name="longitude" id="longitude_id" value="<?php if(isset($stateInfo['longitude']) && $stateInfo['longitude'] !=""){echo $stateInfo['longitude'];} else {echo "22.3187255859375";} ?>">
        <fieldset>
        <legend><?php echo $addtitle; ?></legend>
            <div class="floatRight pad-top5 pad-btm5" align="right">
                <a href="admin-settings.php?sec=location&show=state&country_id=<?php echo $stateInfo['country_id'];?>" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
            </div>
            <p>
                <label for="state_name">Country</label>
                <select name="country_id" id="country_id_id" class="select310">
                    <option value="0" selected>Select ... </option>
                    <?php 
				    	$locationObj->fun_getCountryOptionsList($stateInfo['country_id'], '');
					?>
                </select>
                <span class="error" id="country_id_errorid"><?php if(array_key_exists('country_id_error', $form_array)) echo $form_array['country_id_error'];?></span>
            </p>
            <p><label for="state_name">State Name</label><input type="text" name="state_name" id="state_name_id" value="<?php if(isset($_POST['state_name'])){echo $_POST['state_name'];}else{echo $stateInfo['state_name'];}?>" onkeydown="chkblnkTxtError('state_name_id', 'state_name_errorid');" onkeyup="chkblnkTxtError('state_name_id', 'state_name_errorid');" />&nbsp;<span class="error" id="state_name_errorid"><?php if(array_key_exists('state_name_error', $form_array)) echo $form_array['state_name_error'];?> </span></p>
            <p>&nbsp;</p>
            <p><label for="state_desc">Description</label><textarea type="text" name="state_desc" id="state_desc_id" onkeydown="chkblnkTxtError('state_desc_id', 'state_desc_errorid');" onkeyup="chkblnkTxtError('state_desc_id', 'state_desc_errorid');" class="txtarea_540x300" /><?php if(isset($_POST['state_desc'])){echo $_POST['state_desc'];}else{echo $stateInfo['state_desc'];}?></textarea> <br /><span class="error" id="state_desc_errorid"> <?php if(array_key_exists('state_desc_error', $form_array)) echo $form_array['state_desc_error'];?></span></p>
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
                        Latitude&nbsp;<input name="txtLat" id="txtLatId" type="text" class="txtBox75" value="<?php echo $stateInfo['latitude']; ?>" />
                        &nbsp;&nbsp;
                        Longitude&nbsp;<input name="txtLon" id="txtLonId" type="text" class="txtBox75" value="<?php echo $stateInfo['longitude']; ?>" />
                        &nbsp;&nbsp;
                        Zoom level&nbsp;<?php $systemObj->fun_createSelectNumField("txtZoom", "txtZoomId", "select60", $stateInfo['zoom_level'], "", 1, 10); ?>
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
			title:"<?php echo $stateInfo['state_name']; ?>"
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
				title:"<?php echo $stateInfo['state_name']; ?>"
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
		if((isset($stateInfo['latitude']) && $stateInfo['latitude'] !="") && (isset($stateInfo['longitude']) && $stateInfo['longitude'] !="")){
		?>
			var strlatitude = <?php echo $stateInfo['latitude']; ?>;
			var strlongitude = <?php echo $stateInfo['longitude']; ?>;
			var zoomLevel = <?php echo $stateInfo['zoom_level']; ?>;
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
				title:"<?php echo $stateInfo['state_name']; ?>"
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
		} else if(isset($stateInfo['state_name']) && $stateInfo['state_name'] != ""){
		?>
			var zoomLevel = <?php echo $stateInfo['zoom_level']; ?>;
			var address = "<?php echo ucwords($stateInfo['state_name']); ?>";
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
?>
    <form name="frmstate" id="frmstate" method="post" action="admin-settings.php?sec=location&show=state&action=add&country_id=<?php echo $country_id;?>" enctype="multipart/form-data">
        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("ADDSTATE"); ?>">
        <input type="hidden" name="zoom_level" id="zoom_level_id" value="5" />
        <input type="hidden" name="map_type"  id="map_type_id" value="G_HYBRID_MAP"/>
        <input type="hidden" name="latitude" id="latitude_id" value="37.09024">
        <input type="hidden" name="longitude" id="longitude_id" value="-95.71289">
        <fieldset>
        <legend><?php echo $addtitle; ?></legend>
            <div class="floatRight pad-top5 pad-btm5" align="right">
                <a href="admin-settings.php?sec=location&show=state&country_id=<?php echo $country_id;?>" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
            </div>
            <p>
                <label for="state_name">Country</label>
                <select name="country_id" id="country_id_id" class="select310">
                    <option value="0" selected>Select ... </option>
                    <?php 
				    	$locationObj->fun_getCountryOptionsList($country_id, '');
					?>
                </select>
                <span class="error" id="country_id_errorid"><?php if(array_key_exists('country_id_error', $form_array)) echo $form_array['country_id_error'];?></span>
            </p>
            <p><label for="state_name">State Name</label><input type="text" name="state_name" id="state_name_id" value="<?php if(isset($_POST['state_name'])){echo $_POST['state_name'];}?>" onkeydown="chkblnkTxtError('state_name_id', 'state_name_errorid');" onkeyup="chkblnkTxtError('state_name_id', 'state_name_errorid');" />&nbsp;<span class="error" id="state_name_errorid"><?php if(array_key_exists('state_name_error', $form_array)) echo $form_array['state_name_error'];?> </span></p>
            <p>&nbsp;</p>
            <p><label for="state_desc">Description</label><textarea type="text" name="state_desc" id="state_desc_id" onkeydown="chkblnkTxtError('state_desc_id', 'state_desc_errorid');" onkeyup="chkblnkTxtError('state_desc_id', 'state_desc_errorid');" class="txtarea_540x300" /><?php if(isset($_POST['state_desc'])){echo $_POST['state_desc'];}?></textarea> <br /><span class="error" id="state_desc_errorid"> <?php if(array_key_exists('state_desc_error', $form_array)) echo $form_array['state_desc_error'];?></span></p>
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
                        Latitude&nbsp;<input name="txtLat" id="txtLatId" type="text" class="txtBox75" value="37.09024" />
                        &nbsp;&nbsp;
                        Longitude&nbsp;<input name="txtLon" id="txtLonId" type="text" class="txtBox75" value="-95.71289" />
                        &nbsp;&nbsp;
                        Zoom level&nbsp;<?php $systemObj->fun_createSelectNumField("txtZoom", "txtZoomId", "select60", 6, "", 1, 10); ?>
                        &nbsp;&nbsp;
                        <a href="javascript:void(0);" onclick="findOnMap();" class="button85x30-blue" style="text-decoration:none;">Find Now</a>
                    </div>
                </div>
                <div id="map" style="width:540px; height:400px; float:right; border:1px solid #999999;"></div>
            </p>
            <p style="clear:both; height:10px;">&nbsp;</p>
            <p>
                <label>&nbsp;</label>
                <a href="javascript:void(0);" onclick="return validatefrm();" class="button85x30-red">Add Now</a>
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
			title:"<?php echo $country_name; ?>"
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
				title:"<?php echo $country_name; ?>"
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
		if(isset($country_name) && $country_name != ""){
		?>
			var zoomLevel = 5;
			var address = "<?php echo ucwords($country_name); ?>";
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
}
?>
