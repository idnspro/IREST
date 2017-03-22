<?php
$rest_id 	= $_REQUEST['rest_id'];
$restInfo 	= $restObj->fun_getRestaurantInfo($rest_id);
$restConf 	= $restObj->fun_getRestaurantConf($rest_id);
//print_r($restConf);
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
/*
$restConf['conf_id']	
$restConf['payment_cash']
$restConf['payment_cc']
$restConf['payment_oo']
$restConf['paypal_id']
$restConf['phone']
$restConf['min_order']
$restConf['delivery_charge']
$restConf['delivery_hrs_mon']
$restConf['delivery_hrs_tue']
$restConf['delivery_hrs_wed']
$restConf['delivery_hrs_thu']
$restConf['delivery_hrs_fri']
$restConf['delivery_hrs_sat']
$restConf['delivery_hrs_sun']
$restConf['delivery_area_note']
$restConf['serving_note']
*/

?>
<script type="text/javascript" language="javascript">
	function chkblnkTxtError(strFieldId, strErrorFieldId){
		if(document.getElementById(strFieldId).value != ""){
			document.getElementById(strErrorFieldId).innerHTML = "";
		}
	}

	function validatefrm(){
		/*
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
		*/
		document.frmRestaurant.submit();
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
<div class="floatRight pad-top5 pad-btm5" align="right">
    <a href="<?php echo base64_decode($_GET['back_url']); ?>" class="button-blue" style="text-decoration:none;">Back to Restaurant</a>
</div>
<form name="frmRestaurant" id="frmRestaurant" method="post" action="admin-restaurant-info.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url'];?>" enctype="multipart/form-data">
    <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITRESTAURANTINFO"); ?>">
    <input type="hidden" name="rest_id" id="rest_id" value="<?php echo $rest_id; ?>">
    <input type="hidden" name="conf_id" id="conf_id" value="<?php echo $restConf['conf_id']; ?>">
    <input type="hidden" name="back_url" id="back_url" value="<?php echo $_GET['back_url']; ?>">
    <input type="hidden" name="map_type" id="map_type" value="G_HYBRID_MAP" />
    <input type="hidden" name="rest_latitude" id="rest_latitude" value="<?php if(isset($rest_latitude) && $rest_latitude !=""){echo $rest_latitude;} else {echo "38.886757140695906";} ?>">
    <input type="hidden" name="rest_longitude" id="rest_longitude" value="<?php if(isset($rest_longitude) && $rest_longitude !=""){echo $rest_longitude;} else {echo "22.3187255859375";} ?>">
    <input type="hidden" name="rest_map_zoom_level" id="rest_map_zoom_level" value="<?php if(isset($rest_map_zoom_level)) {echo $rest_map_zoom_level;} else {echo "8";}?>" />
<fieldset>
<legend>Add / Edit Info</legend>
    <p>&nbsp;</p>
    <p><strong>Ordering Info</strong></p>
    <p>
        <label>Online Ordering</label>
        <div class="list-1" style="width:100%; margin-left:140px; clear:both;">
            <ul>
                <li><input type="radio" name="online_order" id="online_order_id2" value="1" <?php if(!isset($restConf['online_order']) || $restConf['online_order'] =="1"){echo 'checked="checked"';}?> style="width:13px; height:13px;" />&nbsp;Yes&nbsp;</li>
                <li><input type="radio" name="online_order" id="online_order_id1" value="0" <?php if(isset($restConf['online_order']) && $restConf['online_order'] =="0"){echo 'checked="checked"';}?> style="width:13px; height:13px;" />&nbsp;No&nbsp;</li>
            </ul>
        </div>
    </p>
    <p>
        <label>Payment Options</label>
        <div class="list-1" style="width:100%; margin-left:140px; clear:both;">
            <ul>
                <li><input type="checkbox" name="payment_cash" id="payment_cash_id" value="1" <?php if(isset($restConf['payment_cash']) && $restConf['payment_cash'] =="1"){echo 'checked="checked"';}?> style="width:13px; height:13px;" />&nbsp;Cash Payment&nbsp;</li>
                <li><input type="checkbox" name="payment_cc" id="payment_cc_id" value="1" <?php if(isset($restConf['payment_cc']) && $restConf['payment_cc'] =="1"){echo 'checked="checked"';}?> style="width:13px; height:13px;" />&nbsp;CC Payment&nbsp;</li>
                <li><input type="checkbox" name="payment_oo" id="payment_oo_id" value="1" <?php if(isset($restConf['payment_oo']) && $restConf['payment_oo'] =="1"){echo 'checked="checked"';}?> style="width:13px; height:13px;" />&nbsp;Online Payment&nbsp;</li>
            </ul>
        </div>
    </p>
    <p>
        <label for="currency_id">Currency</label>
        <select name="currency_id" id="currency_id" class="select216">
            <option value="4" <?php if(isset($restConf['currency_id']) && $restConf['currency_id'] =="4") {echo "selected=\"selected\"";} ?> >Indian Rupee (INR)</option>
            <option value="1" <?php if(isset($restConf['currency_id']) && $restConf['currency_id'] =="1") {echo "selected=\"selected\"";} ?> >American Dollar (USD)</option>
        </select>
    </p>
    <p>
        <label for="paypal_id">PayPal Id</label>
        <input type="text" name="paypal_id" id="paypal_id_id" value="<?php echo $restConf['paypal_id'];?>" />
    </p>
    <p>
        <label for="phone">Contact</label>
        <input type="text" name="phone" id="phone_id" value="<?php echo $restConf['phone'];?>" />
    </p>
    <p>
        <label for="fax">Fax</label>
        <input type="text" name="fax" id="fax_id" value="<?php echo $restConf['fax'];?>" />
    </p>
    <p>
        <label for="tax">Tax</label>
        <input type="text" name="tax" id="tax_id" value="<?php echo $restConf['tax'];?>" />%
    </p>
    <p>
        <label for="min_order">Min Order</label>
        <input type="text" name="min_order" id="min_order_id" value="<?php echo $restConf['min_order'];?>" />&#8377;
    </p>
    <p>
        <label for="delivery_type">Delivery Type</label>
        <div class="list-1" style="width:100%; margin-left:140px;">
            <ul>
                <li><input type="radio" name="delivery_type" id="delivery_type_id0" value="0" <?php if(!isset($restConf['delivery_type']) || $restConf['delivery_type'] =="0" || $restConf['delivery_type'] ==""){echo 'checked="checked"';}?> style="width:13px; height:13px;" />&nbsp;Pickup Only&nbsp;</li>
                <li><input type="radio" name="delivery_type" id="delivery_type_id0" value="1" <?php if(isset($restConf['delivery_type']) && $restConf['delivery_type'] =="1"){echo 'checked="checked"';}?> style="width:13px; height:13px;" />&nbsp;Pickup and Delivery&nbsp;</li>
            </ul>
        </div>
    </p>
    <p>
        <label for="book_table">Book Table</label>
        <div class="list-1" style="width:100%; margin-left:140px;">
            <ul>
                <li><input type="radio" name="book_table" id="book_table_id0" value="0" <?php if(!isset($restConf['book_table']) || $restConf['book_table'] =="0" || $restConf['book_table'] ==""){echo 'checked="checked"';}?> style="width:13px; height:13px;" />&nbsp;No&nbsp;</li>
                <li><input type="radio" name="book_table" id="book_table_id0" value="1" <?php if(isset($restConf['book_table']) && $restConf['book_table'] =="1"){echo 'checked="checked"';}?> style="width:13px; height:13px;" />&nbsp;Yes&nbsp;</li>
            </ul>
        </div>
    </p>
    <p style="clear:both;">&nbsp;</p>
    <p>
        <label for="delivery_charge">Delivery Fee</label>
        <input type="text" name="delivery_charge" id="delivery_charge_id" value="<?php echo $restConf['delivery_charge'];?>" />
    </p>
    <p>
        <label for="extra_charge">Processing Fee</label>
        <input type="text" name="extra_charge" id="extra_charge_id" value="<?php echo $restConf['extra_charge'];?>" />
    </p>
    <p>
        <label for="delivery_hrs_mon">Delivery Mon</label>
        <input type="text" name="delivery_hrs_mon" id="delivery_hrs_mon_id" value="<?php echo $restConf['delivery_hrs_mon'];?>" />
    </p>
    <p>
        <label for="delivery_hrs_tue">Delivery Tue</label>
        <input type="text" name="delivery_hrs_tue" id="delivery_hrs_tue_id" value="<?php echo $restConf['delivery_hrs_tue'];?>" />
    </p>
    <p>
        <label for="delivery_hrs_wed">Delivery Wed</label>
        <input type="text" name="delivery_hrs_wed" id="delivery_hrs_wed_id" value="<?php echo $restConf['delivery_hrs_wed'];?>" />
    </p>
    <p>
        <label for="delivery_hrs_thu">Delivery Thu</label>
        <input type="text" name="delivery_hrs_thu" id="delivery_hrs_thu_id" value="<?php echo $restConf['delivery_hrs_thu'];?>" />
    </p>
    <p>
        <label for="delivery_hrs_fri">Delivery Fri</label>
        <input type="text" name="delivery_hrs_fri" id="delivery_hrs_fri_id" value="<?php echo $restConf['delivery_hrs_fri'];?>" />
    </p>

    <p>
        <label for="delivery_hrs_sat">Delivery Sat</label>
        <input type="text" name="delivery_hrs_sat" id="delivery_hrs_sat_id" value="<?php echo $restConf['delivery_hrs_sat'];?>" />
    </p>

    <p>
        <label for="delivery_hrs_sun">Delivery Sun</label>
        <input type="text" name="delivery_hrs_sun" id="delivery_hrs_sun_id" value="<?php echo $restConf['delivery_hrs_sun'];?>" />
    </p>
    <p>&nbsp;</p>
    <p>
        <label for="delivery_area_note">Delivery Area Note</label>
        <textarea name="delivery_area_note" id="delivery_area_note_id" cols="" rows="" style="width:440px; height:150px;"><?php echo $restConf['delivery_area_note']; ?></textarea>
    </p>
    <p>&nbsp;</p>
    <p>
        <label for="serving_note">Serving Note</label>
        <textarea name="serving_note" id="serving_note_id" cols="" rows="" style="width:440px; height:150px;"><?php echo $restConf['serving_note']; ?></textarea>
    </p>
    <p>
        <label><strong>Cuisines</strong></label>
        <div class="list-2" style="width:100%; margin-left:140px; clear:both;">
			<?php $restObj->fun_createRestaurantCuisinesEditView($rest_id); ?>
        </div>
    </p>
    <p>
        <label><strong>Features</strong></label>
        <div class="list-2" style="width:100%; margin-left:140px; clear:both;">
			<?php $restObj->fun_createRestaurantFeaturesEditView($rest_id); ?>
        </div>
    </p>
    <p>&nbsp;</p>
    <p align="center"><hr style="color:#999999; width:680px;" /></p>
    <p>
    <!-- THIS TABLE IS FOR SHOW GOOGLE MAP: START HERE -->
    <table width="690" border="0" cellspacing="0" cellpadding="0">
        <tr><td align="left" valign="top" class="font14 pad-btm10"><strong>Now find the restaurant on the google map</strong></td></tr>
        <tr>
        <td align="left" valign="top">
        <div style="height:60px; width:570px; margin-bottom:5px; vertical-align:middle;" >
			<script language="javascript" type="text/javascript">
            function showLatLonFrm() {
                document.getElementById("findMapFrm").style.display = "block";
            }
            </script>
                <a href="javascript:void(0);" onclick="showLatLonFrm();">Know Latitude and Longitude?</a>
                <span id="findMapFrm" style="display:none;">
                    Latitude&nbsp;<input name="txtLat" id="txtLatId" type="text" class="txtBox75" value="<?php echo $rest_latitude; ?>" />
                    &nbsp;&nbsp;
                    Longitude&nbsp;<input name="txtLon" id="txtLonId" type="text" class="txtBox75" value="<?php echo $rest_longitude; ?>" />
                    &nbsp;&nbsp;
                    Zoom level&nbsp;<?php $systemObj->fun_createSelectNumField("txtZoom", "txtZoomId", "select60", $rest_map_zoom_level, "", 1, 20); ?>
                    &nbsp;&nbsp;
                    <a href="javascript:void(0);" onclick="findOnMap();" class="button-red" style="text-decoration:none;">Find Now</a>
                </span>
        </div>
        <div id="map" style="width: 650px; height:450px; border:1px solid #999999; text-align:center;"></div>
        </td>
        </tr>
        <tr><td align="left" valign="top" class="font12 red"><em>To move the pin to the exact location of restaurant just click and hold on the marker drag it to the exact position and drop it</em></td></tr>
    </table>
    <!-- THIS TABLE IS FOR SHOW GOOGLE MAP: END HERE -->
    </p>
    <p>&nbsp;</p>
    <p>
        <label>&nbsp;</label>
        <a href="<?php echo base64_decode($_GET['back_url']); ?>" class="button85x30-grey">Cancel</a>&nbsp;<a href="javascript:void(0);" onclick="return validatefrm();" class="button85x30-red">Save Now</a>
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

	function showLocation() {
		var address = "<?php echo $rest_address; ?>";
		geocoder.geocode({ 'address': address}, addAddressToMap);  
	}
	
	function findOnMap() {
		clearOverlays();
		var image = new google.maps.MarkerImage('<?php echo SITE_IMAGES;?>markers/marker.png', new google.maps.Size(20, 34), new google.maps.Point(0,0), new google.maps.Point(0,32));
		var shadow = new google.maps.MarkerImage('<?php echo SITE_IMAGES;?>markers/shadow.png', new google.maps.Size(37, 32), new google.maps.Point(0,0), new google.maps.Point(0, 32));
		var Latlng = new google.maps.LatLng(document.getElementById('txtLatId').value, document.getElementById('txtLonId').value, document.getElementById('txtZoomId').value);
		var zoomLevel = parseInt(document.getElementById("txtZoomId").value);
		document.getElementById("rest_latitude").value = document.getElementById('txtLatId').value;
		document.getElementById("rest_longitude").value = document.getElementById('txtLonId').value;
		document.getElementById("rest_map_zoom_level").value = document.getElementById('txtZoomId').value;

		map.setCenter(Latlng);
		map.setZoom(zoomLevel);
		map.setMapTypeId(google.maps.MapTypeId.HYBRID);
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
