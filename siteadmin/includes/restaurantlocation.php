<?php
if($restInfo['rest_latitude'] !="" && $restInfo['rest_longitude'] !="") {
	$restaurantLatitude 	= $restInfo['rest_latitude'];
	$restaurantLongitude 	= $restInfo['rest_longitude'];
	$mapZoomLevel 		    = $restInfo['rest_map_zoom_level'];
} else {
//	$restaurantLatitude 	= "-33.893217379440884";
//	$restaurantLongitude 	= "18.4625244140625";
	$mapZoomLevel 		    = 10;
}

$detail_array = array();
?>
<!-- TinyMCE -->
<script type="text/javascript" src="../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "exact",
		elements : "textPropertyLocationGuideNoteId, textPropertyAreaNoteId",
		theme : "simple"
/*
		setup: function(ed) {
			// Force Paste-as-Plain-Text
			ed.onPaste.add( function(ed, e, o) {
				ed.execCommand('mcePasteText', true);
				return tinymce.dom.Event.cancel(e);
			});
		}
*/
	});
</script>
<script type="text/javascript" language="javascript">	
	function changeDistance(strId) {
		if(strId !="") {
			var strDistance = (strId == "k")?'km':'miles';
		} else {
			var strDistance = "miles";
		}

		var countLandmark = document.getElementsByName("txtLandmarkId[]").length;
		for(var i=0; i < parseInt(countLandmark); i++) {
			var cellId = "landMarkCellId"+i;
			document.getElementById(cellId).innerHTML = strDistance;
		}

		var countExtrAshokdmark = document.getElementsByName("txtExtraLandmarks[]").length;
		for(var j=0; j < parseInt(countExtrAshokdmark); j++) {
			var cellId = "extraLandMarkCellId"+j;
			document.getElementById(cellId).innerHTML = strDistance;
		}
	}

		
	window.onload=function() {
//		document.getElementById("myTable").style.display = "none";
	}

	function addEvent() {
		var strTable1 = "";
		var ni = document.getElementById('myDiv1');
		var numi = document.getElementById('theValue');
		var num = (document.getElementById("theValue").value -1)+ 2;
		var distanceType = document.getElementById('txtDistanceTypeId').value;
		var strDistanceType = (distanceType == "k")?'km':'miles';
		numi.value = num;
		//alert(num);
		var divIdName = "my"+num+"Div";
		var newdiv = document.createElement('div');
		newdiv.setAttribute("id",divIdName);
		newdiv.setAttribute("style", "padding: 0px 10px 5px 5px;");
		strTable1 += "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"pad-top2\">";
		strTable1 += "<tr>";
		strTable1 += "<td height=\"25\"><input type=\"text\" style=\"width:147px; border: solid 1px #9F9F9F; font-size:12px; padding-top:2px; padding-bottom:2px; padding-left:5px;\" name=\"txtExtraLandmarks[]\" id=\"txtExtraLandmarks"+num+"\" value=\"\" /></td>";
		strTable1 += "<td>&nbsp;is &nbsp;</td>";
		strTable1 += "<td><input type=\"text\" style=\"width:49px; border: solid 1px #9F9F9F; font-size:12px; padding-top:2px; padding-bottom:2px; text-align:center;\" name=\"txtExtrAshokdmarkDist[]\" id=\"txtExtrAshokdmarkDist"+num+"\" maxlength=\"5\" value=\"\" /></td>";
		strTable1 += "<td style=\"width:380px;\">&nbsp; <span id='extraLandMarkCellId"+(parseInt(num)-2)+"'>"+strDistanceType+"</span> from my property</td>";
		strTable1 += "<td><a href=\"JavaScript:void(0);\" onClick=\"JavaScript:removeElement('"+divIdName+"');\" class=\"delete-photo\">Delete</a></td>";
		strTable1 += "</tr>";
		strTable1 += "</table>";
		newdiv.innerHTML = strTable1;
		ni.appendChild(newdiv);
	}

	function removeElement(divNum) {
		var d = document.getElementById('myDiv1');
		var olddiv = document.getElementById(divNum);
		d.removeChild(olddiv);
	} 

</script>
<script language="javascript" type="text/javascript">
		var req = new XMLHttpRequest();
		/*
		* For location : Start here
		*/

		function chkSelectCountry() {
			var getID=document.getElementById("txtPropertyCountryId").value;
			if(getID !="" && getID != "0"){
				sendAreaRequest(getID);
				document.getElementById("txtPropertyAreaId").value = "0";
			}
			if(getID == "0" || getID =="") {
			document.getElementById("txtPropertyCountryId").value = "0";
				document.getElementById("txtPropertyAreaId").value = "0";
			}
		}

		function chkSelectArea() {
/*
			var getID=document.getElementById("txtPropertyAreaId").value;
			if(getID !="" && getID != "0"){
				sendRegionRequest(getID);
				document.getElementById("txtRestRegionId").value = "0";
				document.getElementById("txtPropertySubRegionId").value = "0";
				document.getElementById("txtRestLocationId").value = "0";
			}
			if(getID == "0" || getID =="") {
				document.getElementById("txtPropertyAreaId").value = "0";
				document.getElementById("txtRestRegionId").value = "0";
				document.getElementById("txtPropertySubRegionId").value = "0";
				document.getElementById("txtRestLocationId").value = "0";
				document.getElementById("txtPropertySubRegionId").style.display = "none";
				document.getElementById("txtRestLocationId").style.display = "none";
			}
*/

		}
		
		
	
		function sendAreaRequest(id) { 
			req.open('get', '<?php echo SITE_URL;?>selectAreaXml.php?id=' + id); 
			req.onreadystatechange = handleAreaResponse; 
			req.send(null); 
		} 
		
		function sendRegionRequest(id) { 
			req.open('get', '<?php echo SITE_URL;?>selectRegionXml.php?id=' + id); 
			req.onreadystatechange = handleRegionResponse; 
			req.send(null); 
		} 
		function handleAreaResponse() { 
			var arrayOfId = new Array();
			var arrayOfNames = new Array();
			if(req.readyState == 4) { 
				var response = req.responseText; 
				xmlDoc=req.responseXML;
			var root = xmlDoc.getElementsByTagName('ntowns')[0];
				//alert(root);
				if(root != null) {
					document.getElementById("txtPropertyAreaId").style.display = "block";
//					document.getElementById("txtRestRegionId").style.display = "none";
//					document.getElementById("txtPropertySubRegionId").style.display = "none";
//					document.getElementById("txtRestLocationId").style.display = "none";
					var items = root.getElementsByTagName("ntown");
					for (var i = 0 ; i < items.length ; i++) {
						var item = items[i];
						var id = item.getElementsByTagName("id")[0].firstChild.nodeValue;
						arrayOfId[i] = id;
						var name = item.getElementsByTagName("name")[0].firstChild.nodeValue;

						arrayOfNames[i] = name;
						//alert("item #" + i + ": ID=" + id + " Name=" + name);
					}
					if( arrayOfId.length > 0) {
						var p_city=document.getElementById("txtPropertyAreaId");
						p_city.length=0;
						p_city.options[0]=new Option("Please Select...","");
						for(var j=0; j<arrayOfId.length; j++) {
							p_city.options[j+1]=new Option(arrayOfNames[j], arrayOfId[j]);
						}
					}
				}
			} 
		} 
		function frmSubmit(){
			document.frmProperty.submit();
		}

		function deleteExtraLandmark(strLandmarkId) {
			req.onreadystatechange = handleDeleteResponse;
			req.open('get', '<?php echo SITE_URL;?>extralandmarkdeleteXml.php?id='+strLandmarkId); 
			req.send(null);   
		}
		function handlechangeDistanceResponse() {
			if(req.readyState == 4) {
				var response=req.responseText;
				document.getElementById("showDistances").innerHTML = "";
				document.getElementById("showDistances").innerHTML = response;
			}
		}
</script>
<!--Location Content Starts Here -->
<form name="frmProperty" id="frmPropertyId" method="post" action="<?php echo $_SERVER['PHP_SELF']."?sec=add&rid=".$txtRestaurantId;?>">
    <input type="hidden" name="p_map_zoom" value="<?php if(isset($mapZoomLevel)) {echo $mapZoomLevel;} else {echo "10";}?>" id="p_map_zoom" />
    <input type="hidden" name="p_map_map_type" value="G_HYBRID_MAP" id="p_map_map_type" />
    <input type="hidden" name="p_map_latitude" id="p_map_latitude" value="<?php if(isset($restaurantLatitude) && $restaurantLatitude !=""){echo $restaurantLatitude;} else {echo "-33.893217379440884";} ?>">
    <input type="hidden" name="p_map_longitude" id="p_map_longitude" value="<?php if(isset($restaurantLongitude) && $restaurantLongitude !=""){echo $restaurantLongitude;} else {echo "18.4625244140625";} ?>">
    <div class="pad-top15">
    <table width="100%" border="0"  cellspacing="0" cellpadding="0">
       <tr>
           <td align="left" valign="top"> <strong>Search Resataurant</strong></td>
         </tr> 
         <tr> <td align="left" valign="top">&nbsp;</td></tr>  
        <tr>
            <td align="center" valign="top">
                <table width="100%" border="0" cellspacing="0" cellpadding="3">
                <tr>
						<td align="left" valign="middle">Rest. Name</td>
						<td align="left" valign="top">
							<input name="txtRestName" id="txtRestNameId" class="inpuTxt260" style="display:block;">
						</td>
					</tr>
					<tr>
						<td align="left" valign="middle" width="105px">Country<span class="pink">*</span></td>
						<td align="left" valign="top">
							<select name="txtPropertyCountry" id="txtPropertyCountryId" onchange="return chkSelectCountry();" style="display:block; height:27px;" >
								<option value="">Please Select...</option>
								<?php $locationObj->fun_getCountryOptionsList($restInfo['country_id'], " WHERE country_id in (".$locationObj->fun_getCountryIdHavingArea().")");?>
							</select>
						</td>
						<td align="left" valign="top">&nbsp;</td>
					</tr>
					<tr>
						<td align="left" valign="middle">State<span class="pink">*</span></td>
						<td align="left" valign="top">
							<select name="txtPropertyArea" id="txtPropertyAreaId" onchange="chkSelectArea();" style="display:block;  height:27px;" >
								<option value="0">Please Select...</option>
								<?php 
									//$locationObj->fun_getAreaListOptions($propertyInfo['area_id'], $propertyInfo['country_id']);
								?>
							</select>
						</td>
						<td align="left" valign="top">&nbsp;</td>
					</tr>

					<tr>
						<td align="left" valign="middle">City<span class="pink">*</span></td>
						<td align="left" valign="top" class="pad-btm5">
							<input name="txtRestRegion" id="txtRestRegionId" class="inpuTxt260" style="display:block;" value="<?php echo ucwords(strtolower($locationObj->fun_getRegionNameById($propertyInfo['region_id']))); ?>">
						</td>
						<td align="left" valign="top">&nbsp;</td>
					</tr>
					<tr>
						<td align="left" valign="middle">Specific location</td>
						<td align="left" valign="top" class="pad-btm5">
							<input name="txtRestLocation" id="txtRestLocationId" class="inpuTxt260" style="display:block;" value="<?php echo ucwords(strtolower($locationObj->fun_getLocationNameById($propertyInfo['location_id']))); ?>">
						</td>
						<td align="left" valign="top"><span style="color:#333333; font-size:11px;">eg. Village or nearest named location</span></td>
					</tr>
					<tr>
						<td align="left" valign="middle">Zip code</span></td>
						<td align="left" valign="top" class="pad-btm15">
							<input name="txtRestZipcode" id="txtRestZipcodeId" class="inpuTxt260" style="display:block;" value="<?php echo $propertyInfo['zip']; ?>">
						</td>
						<td align="left" valign="top"><span style="color:#333333; font-size:11px;"><strong>NOTE:</strong> Please use the <strong>FULL post code / zip code</strong> for the Restaurant. This may include international and regional codes.</span></td>
					</tr>
					<tr>
						<td align="left" valign="top">&nbsp;</td>
						<td align="right" valign="top" class="pad-btm5 pad-right5">
							<a href="javascript:void(0);" onclick="return showRestOnMap();"><img src="<?php echo SITE_IMAGES;?>findpropertyonmap.gif" alt="Find Restaurant on Map" border="0" /></a>
						</td>
						<td align="left" valign="top">
							<div class="FloatLft">
								 <span class="error" id="showErrorPropertyLocationId"><?php if(array_key_exists('txtRestLocation', $detail_array)) echo $detail_array['txtRestLocation'];?></span>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>

        <tr>
            <td align="left" valign="top" style="padding-top:20px;">
                <!-- THIS TABLE IS FOR SHOW GOOGLE MAP: START HERE -->
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="left" valign="top">
                            <div id="p_map_map" style="width: 670px; height:450px; float:left; border:1px solid #999999; text-align:center;"></div>
						</td>
					</tr>
                </table>
                <!-- THIS TABLE IS FOR SHOW GOOGLE MAP: END HERE -->
            </td>
        </tr>
        
      
		</table>
       
	</div>
	<div class="dash41"></div>
	<div>
		<div class="FloatRight"  style=" padding-bottom:20px;">
        <a href="#" onclick="return frmSubmit();"><img src="images/save-btn.gif" alt="save" border="0" /></a>
        </div>
	</div>
</form>
<!--Location Content Ends Here -->

<!-- Map code: Start here -->
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAAypZhfTxw4x2j67RNkEOYpRRgzjoFnYGaQyI36iGW7gvrUwNyahTQtAvrSV1b9ZrcuBkI2ZECCm3XgQ" type="text/javascript"></script>
<script type="text/javascript">
// <![CDATA[
var p_map_map;
var p_map_marker;
var geocoder;
var country4map;
var area4map;
var town4map;
var region4map;
var subregion4map;
var location4map;
var zip4map;

function showLocation() {
//	area4map = document.getElementById('txtPropertyAreaId')[document.getElementById('txtPropertyAreaId').selectedIndex].innerHTML;
//	region4map= document.getElementById('txtRestRegionId')[document.getElementById('txtRestRegionId').selectedIndex].innerHTML;
//	subregion4map = document.getElementById('txtPropertySubRegionId')[document.getElementById('txtPropertySubRegionId').selectedIndex].innerHTML;
	location4map = document.getElementById('txtRestLocationId')[document.getElementById('txtRestLocationId').selectedIndex].innerHTML;
//	alert(location4map);
	var address = location4map;
	address += ", Cape Town, South Africa";
	geocoder.getLocations(address, addAddressToMap);  
}

function showSubRegion() {

	subregion4map = document.getElementById('txtPropertySubRegionId')[document.getElementById('txtPropertySubRegionId').selectedIndex].innerHTML;
//	alert(subregion4map);
	var address = subregion4map;
	address += ", Cape Town, South Africa";
	geocoder.getLocations(address, addAddressToMap);  
}

function showRegion() {
	region4map = document.getElementById('txtRestRegionId')[document.getElementById('txtRestRegionId').selectedIndex].innerHTML;
//	alert(region4map);
	var address = region4map;
	address += ", Cape Town, South Africa";
	geocoder.getLocations(address, addAddressToMap);  
}

function showArea() {
	area4map = document.getElementById('txtPropertyAreaId')[document.getElementById('txtPropertyAreaId').selectedIndex].innerHTML;
	var address = area4map;
	address += ", South Africa";
	geocoder.getLocations(address, addAddressToMap);  
}

function showRestOnMap() {
	if(document.getElementById("txtPropertyCountryId").value == "") {
		document.getElementById("showErrorPropertyLocationId").innerHTML = "Please select country name";
		return false;
	}
	if(document.getElementById("txtPropertyAreaId").value == "") {
		document.getElementById("showErrorPropertyLocationId").innerHTML = "Please select state name";
		return false;
	}


	document.getElementById("showErrorPropertyLocationId").innerHTML = "";
	country4map = document.getElementById('txtPropertyCountryId')[document.getElementById('txtPropertyCountryId').selectedIndex].innerHTML;
	area4map = document.getElementById('txtPropertyAreaId')[document.getElementById('txtPropertyAreaId').selectedIndex].innerHTML;
//	town4map = document.getElementById('txtRestRegionId').value;
//	location4map = document.getElementById('txtRestLocationId').value;
	zip4map = document.getElementById('txtRestZipcodeId').value;

//76 9th Avenue, New York City, NY
/*
	if(town4map != "") {
		if(location4map != "") {
			var address = location4map+", "+town4map+", "+area4map;
		} else {
			var address = town4map+", "+area4map;
		}
	} else {
		var address = area4map;
	}
*/

	var address = area4map;
	address += ", "+country4map+". "+zip4map;
	geocoder.getLocations(address, addAddressToMap);  
}

// addAddressToMap() is called when the geocoder returns an
// answer.  It adds a marker to the map with an open info window
// showing the nicely formatted version of the address and the country code.
function addAddressToMap(response) {
	p_map_map.clearOverlays();
	if (!response || response.Status.code != 200) {
		p_map_map.setCenter(new GLatLng(31.052934, 10.546875), 2, G_NORMAL_MAP);

//		geocoder.getLocations("Cape Town, South Africa", addAddressToMap);
		document.getElementById("p_map_latitude").value = "31.052934";
		document.getElementById("p_map_longitude").value = "10.546875";
//		alert("Sorry, we were unable to geocode that address");
	} else {
		place = response.Placemark[0];
		point = new GLatLng(place.Point.coordinates[1], place.Point.coordinates[0]);
		p_map_map.setCenter(point, 10);
		if(document.getElementById("p_map_zoom").value != "") {
			var zoomLevel = parseInt(document.getElementById("p_map_zoom").value);
			p_map_map.setZoom(zoomLevel);
		}
		p_map_map.setMapType(G_NORMAL_MAP);
		GEvent.addListener(p_map_map, "click", function(marker, point) { if(marker!=null) return false; c=new GLatLng(point.lat(), point.lng()); p_map_map.panTo(c); la=document.getElementById("p_map_latitude"); la.value=c.lat(); lo=document.getElementById("p_map_longitude"); lo.value=c.lng(); p_map_marker.setPoint(c); });
		GEvent.addListener(p_map_map, "zoomend", function(oldlevel, newlevel) { lz=document.getElementById("p_map_zoom"); lz.value=newlevel; });
		GEvent.addListener(p_map_map, "maptypechanged", function() { lm=document.getElementById("p_map_map_type"); t=p_map_map.getCurrentMapType(); if(t==G_NORMAL_MAP) lm.value="Normal"; else { if(t==G_HYBRID_MAP) lm.value="Satellite"; else { if(t==G_HYBRID_MAP) lm.value = "Hybrid"; } } });
		var p_map_icon0=new GIcon();
		p_map_icon0.image= '<?php echo SITE_URL; ?>images/maps/marker/marker.png';
		p_map_icon0.shadow= '<?php echo SITE_URL; ?>images/maps/marker/shadow.png';
		p_map_icon0.iconSize=new GSize(20,34);
		p_map_icon0.shadowSize=new GSize(37,32);
		p_map_icon0.iconAnchor=new GPoint(16,32);
		p_map_icon0.infoWindowAnchor=new GPoint(16,1);
		p_map_marker=new GMarker(p_map_map.getCenter(), { draggable: true , icon: p_map_icon0 });
		GEvent.addListener(p_map_marker, "dragend", function(marker) { var point=p_map_marker.getPoint(); var c=new GLatLng(point.lat(), point.lng()); p_map_map.panTo(c); la=document.getElementById("p_map_latitude"); la.value=c.lat(); lo=document.getElementById("p_map_longitude"); lo.value=c.lng(); p_map_marker.setPoint(c); });
		p_map_map.addOverlay(p_map_marker);

		var str = String(place.Point.coordinates);		
		var distBody = str.split(",");		
		var lonVal = distBody[0];
		var latVal = distBody[1];
		document.getElementById("p_map_latitude").value = latVal;
		document.getElementById("p_map_longitude").value = lonVal;
	}
}

function p_map_mapload(){
	if(GBrowserIsCompatible()){
		p_map_map = new GMap2(document.getElementById("p_map_map"));
		geocoder = new GClientGeocoder();
		p_map_map.addControl(new GLargeMapControl());
		p_map_map.addControl(new GMapTypeControl());
//		p_map_map.setUIToDefault();
		<?php 
		if((isset($restaurantLatitude) && $restaurantLatitude !="") && (isset($restaurantLongitude) && $restaurantLongitude !="")){
		?>
			var strlatitude = <?php echo $restaurantLatitude; ?>;
			var strlongitude = <?php echo $restaurantLongitude; ?>;
			var zoomLevel = <?php echo $mapZoomLevel; ?>;
			p_map_map.setCenter(new GLatLng(strlatitude, strlongitude), zoomLevel);
			
			p_map_map.setMapType(G_NORMAL_MAP);
			GEvent.addListener(p_map_map, "click", function(marker, point) { if(marker!=null) return false; c=new GLatLng(point.lat(), point.lng()); p_map_map.panTo(c); la=document.getElementById("p_map_latitude"); la.value=c.lat(); lo=document.getElementById("p_map_longitude"); lo.value=c.lng(); p_map_marker.setPoint(c); });
			GEvent.addListener(p_map_map, "zoomend", function(oldlevel, newlevel) { lz=document.getElementById("p_map_zoom");lz.value=newlevel; });
			GEvent.addListener(p_map_map, "maptypechanged", function() { lm=document.getElementById("p_map_map_type"); t=p_map_map.getCurrentMapType(); if(t==G_NORMAL_MAP) lm.value="Normal"; else { if(t==G_HYBRID_MAP) lm.value="Hybrid"; else { if(t==G_HYBRID_MAP) lm.value = "Satellite"; } } });

			var p_map_icon0=new GIcon();
			p_map_icon0.image= '<?php echo SITE_URL; ?>images/maps/marker/marker.png';
			p_map_icon0.shadow= '<?php echo SITE_URL; ?>images/maps/marker/shadow.png';
			p_map_icon0.iconSize=new GSize(20,34);
			p_map_icon0.shadowSize=new GSize(37,32);
			p_map_icon0.iconAnchor=new GPoint(16,32);
			p_map_icon0.infoWindowAnchor=new GPoint(16,1);
			p_map_marker=new GMarker(p_map_map.getCenter(), { draggable: true , icon: p_map_icon0 });
			GEvent.addListener(p_map_marker, "dragend", function(marker) {var point=p_map_marker.getPoint(); var c=new GLatLng(point.lat(), point.lng()); p_map_map.panTo(c); la=document.getElementById("p_map_latitude"); la.value=c.lat(); lo=document.getElementById("p_map_longitude"); lo.value=c.lng(); p_map_marker.setPoint(c); });
			p_map_map.addOverlay(p_map_marker);
		<?php
		} else {
		?>
			// for address
			country4map = document.getElementById('txtPropertyCountryId')[document.getElementById('txtPropertyCountryId').selectedIndex].innerHTML;
			area4map = document.getElementById('txtPropertyAreaId')[document.getElementById('txtPropertyAreaId').selectedIndex].innerHTML;
//			town4map = document.getElementById('txtRestRegionId').value;
//			location4map = document.getElementById('txtRestLocationId').value;
//			zip4map = document.getElementById('txtRestZipcodeId').value;
			//76 9th Avenue, New York City, NY
/*
			if(town4map != "") {
				if(location4map != "") {
					var address = location4map+", "+town4map+", "+area4map;
				} else {
					var address = town4map+", "+area4map;
				}
			} else {
				var address = area4map;
			}
*/
			var address = area4map;
			address += ", "+country4map;
			//alert(address);
			geocoder.getLocations(address, addAddressToMap);  
		<?php
		} 
		?>
	}	
}
// ]]>
</script>

<script type="text/javascript" language="javascript">
	// This preserves existing onload functions, but adds in the google handler as well
	function WindowOnload(f){
		var prev = window.onload;
		window.onload = function(){
			if(prev)prev();
			f();
		}
	}
	WindowOnload(p_map_mapload);
	onunload = "GUnload";
</script>
<!-- Map code: End here -->
