<?php
if($restInfo['rest_latitude'] !="" && $restInfo['rest_longitude'] !="") {
	$rest_latitude 			= $restInfo['rest_latitude'];
	$rest_longitude 		= $restInfo['rest_longitude'];
	$rest_map_zoom_level 	= $restInfo['rest_map_zoom_level'];
} else {
	// Location info
	$restLocInfoArr 		= $restObj->fun_getRestaurantLocInfoArr($rest_id);
	// Restaurant address
	$rest_address 			= $rest_address1;
	if(isset($rest_address2) && $rest_address2 !="")
	$rest_address 			.= ", " .$rest_address2;
	if(isset($restLocInfoArr['city_name']) && $restLocInfoArr['city_name'] !="")
	$rest_address 			.= ", " .ucwords($restLocInfoArr['city_name']);
	if(isset($restLocInfoArr['state_name']) && $restLocInfoArr['state_name'] !="")
	$rest_address 			.= ", " .ucwords($restLocInfoArr['state_name']);
	if(isset($restInfo['rest_zip']) && $restInfo['rest_zip'] !="")
	$rest_address 			.= ", " .$restInfo['rest_zip'];
}


?>
<!-- For Restaurant info: Start Here -->
    <input type="hidden" name="map_type" id="map_type" value="G_HYBRID_MAP" />
    <input type="hidden" name="rest_latitude" id="rest_latitude" value="<?php if(isset($rest_latitude) && $rest_latitude !=""){echo $rest_latitude;} else {echo "38.886757140695906";} ?>">
    <input type="hidden" name="rest_longitude" id="rest_longitude" value="<?php if(isset($rest_longitude) && $rest_longitude !=""){echo $rest_longitude;} else {echo "22.3187255859375";} ?>">
    <input type="hidden" name="rest_map_zoom_level" id="rest_map_zoom_level" value="<?php if(isset($rest_map_zoom_level)) {echo $rest_map_zoom_level;} else {echo "8";}?>" />
    <!-- THIS TABLE IS FOR SHOW GOOGLE MAP: START HERE -->
    <table width="690" border="0" cellspacing="0" cellpadding="0">
        <tr><td align="left" valign="top" class="font14">Now find it on the google map</td></tr>
        <tr><td align="left" valign="top" class="font12 red"><em>To move the pin to the exact location of restaurant just click and hold on the marker drag it to the exact position and drop it</em></td></tr>
        <tr><td align="left" valign="top"><div id="map" style="width: 650px; height:450px; border:1px solid #999999; text-align:center;"></div></td></tr>
    </table>
    <!-- THIS TABLE IS FOR SHOW GOOGLE MAP: END HERE -->
</form>
<!-- For Restaurant info: End Here -->
<!-- Map code: Start here -->
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
	var map;
	var marker;
	var markersArray = [];
	var Options = [];
	var geocoder;

	function showLocation() {
		var address = "<?php echo $rest_address; ?>";
		geocoder.geocode({ 'address': address}, addAddressToMap);  
	}
	
	function showRestaurantOnMap() {
		var address = "<?php echo $rest_address; ?>";
		geocoder.geocode({ 'address': address}, addAddressToMap);  
	}

	function addAddressToMap(results, status) {
		clearOverlays();
		if (status == google.maps.GeocoderStatus.OK) {
			var image = new google.maps.MarkerImage('<?php echo SITE_IMAGES;?>markers/marker.png', new google.maps.Size(20, 34), new google.maps.Point(0,0), new google.maps.Point(0,32));
			var shadow = new google.maps.MarkerImage('<?php echo SITE_IMAGES;?>markers/shadow.png', new google.maps.Size(37, 32), new google.maps.Point(0,0), new google.maps.Point(0, 32));
			var zoomLevel = parseInt(document.getElementById("rest_map_zoom_level").value);
			map.setCenter(results[0].geometry.location);
			map.setZoom(zoomLevel);
			map.setMapTypeId(google.maps.MapTypeId.HYBRID);
			marker = new google.maps.Marker({
				position: results[0].geometry.location, 
				map: map,
				shadow: shadow,
				icon: image,
				draggable: true,
				title:"<?php echo $restInfo['rest_name']; ?>"
			});   
		
			google.maps.event.addListener(map, 'zoom_changed', function() {
				zoomLevel = map.getZoom();
				lz = document.getElementById("rest_map_zoom_level");
				lz.value = zoomLevel; 
				if (zoomLevel == 0) {
					map.setZoom(10);
				}
			});
		
			google.maps.event.addListener(marker, 'dragend', function(event) {
				var point = marker.getPosition();
				var c = new google.maps.LatLng(point.lat(), point.lng());
				map.panTo(c); 
				la = document.getElementById("rest_latitude"); 
				la.value = c.lat(); 
				lo = document.getElementById("rest_longitude"); 
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
		if((isset($rest_latitude) && $rest_latitude !="") && (isset($rest_longitude) && $rest_longitude !="")){
		?>
			var strrest_latitude = <?php echo $rest_latitude; ?>;
			var strrest_longitude = <?php echo $rest_longitude; ?>;
			var zoomLevel = <?php echo $rest_map_zoom_level; ?>;
			var image = new google.maps.MarkerImage('<?php echo SITE_IMAGES;?>markers/marker.png', new google.maps.Size(20, 34), new google.maps.Point(0,0), new google.maps.Point(0,32));
			var shadow = new google.maps.MarkerImage('<?php echo SITE_IMAGES;?>markers/shadow.png', new google.maps.Size(37, 32), new google.maps.Point(0,0), new google.maps.Point(0, 32));
			var Latlng = new google.maps.LatLng(strrest_latitude, strrest_longitude);

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
				title:"<?php echo $restInfo['rest_name']; ?>"
			});   
			google.maps.event.addListener(map, 'zoom_changed', function() {
				zoomLevel = map.getZoom();
				lz = document.getElementById("rest_map_zoom_level");
				lz.value = zoomLevel; 
				if (zoomLevel == 0) {
					map.setZoom(10);
				}
			});
		
			google.maps.event.addListener(marker, 'dragend', function(event) {
				var point = marker.getPosition();
				var c = new google.maps.LatLng(point.lat(), point.lng());
				map.panTo(c); 
				la = document.getElementById("rest_latitude"); 
				la.value = c.lat(); 
				lo = document.getElementById("rest_longitude"); 
				lo.value = c.lng();
				marker.setPoint(c); 
			}); 
			markersArray.push(marker);
		<?php
		} else {
		?>
			var zoomLevel = 8;
			var address = "<?php echo $rest_address; ?>";
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
