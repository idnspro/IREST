   <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAAypZhfTxw4x2j67RNkEOYpRRgzjoFnYGaQyI36iGW7gvrUwNyahTQtAvrSV1b9ZrcuBkI2ZECCm3XgQ" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo SITE_JS_INCLUDES_PATH;?>ClusterMarker.js"></script>
    <script type="text/javascript">
    if(window.addEventListener){
        window.addEventListener( "load", myOnload, false );
    } else {
        window.attachEvent( "onload", myOnload );
    }
    
    if(window.addEventListener){
        window.addEventListener( "unload", GUnload, false );
    } else {
        window.attachEvent( "onunload", GUnload );
    }
    
    function showClusterMarker(){
        for(i=eventListeners.length-1; i>=0; i--){
            GEvent.removeListener(eventListeners[i]);
        }
        eventListeners=[];
        // I need to create json array with all property list
        var marker, title, iconCluster, id, name, location, lat, lng, urlMap, urlResult, total_properties, markerHTML;
            markersArray=[];
            <?php
            for($j = 0; $j < count($propListAreaWiseArr); $j++) {
                $area_id			= $propListAreaWiseArr[$j]['area_id'];
                $areaInfoArr		= $locationObj->fun_getAreaShortInfoById($area_id);
                $area_name			= $areaInfoArr['destination_name'];
                $area_lat			= $areaInfoArr['destination_lat'];
                $area_lon			= $areaInfoArr['destination_lon'];
                $total_properties	= $propListAreaWiseArr[$j]['total_properties'];
                $result_link 		= SITE_URL."accommodation/in.".str_replace(" ", "^", strtolower($area_name))."/";
                $map_link 			= SITE_URL."map.accommodation/in.".str_replace(" ", "^", strtolower($area_name))."/";
                ?>
    
                id = "<?php echo $area_id; ?>"; // Property Id
                name = "<?php echo $area_name; ?>"; // Property Name
                title = "<?php echo addslashes($area_name); ?> - click for details"; // Property short description
                location = "<?php echo $area_name; ?>"; // Property location
                lat = "<?php echo $area_lat; ?>"; // Property Latitude
                lng = "<?php echo $area_lon; ?>"; // Property Longitude
                total_properties = "<?php echo $total_properties; ?>"; // Property images
    
                urlMap = "<?php echo $map_link; ?>"; // Map URL
                urlResult = "<?php echo $result_link; ?>"; // Map URL
    
                if(lat != "" && lng != "") {
                    iconCluster = new GIcon();
                    iconCluster.image = '<?php echo SITE_URL; ?>images/markers/cluster-active.png';
                    iconCluster.iconSize = new GSize(30, 27);
                    iconCluster.shadow  = '<?php echo SITE_URL; ?>images/markers/cluster-shadow.png';
                    iconCluster.shadowSize = new GSize(44, 27);
                    iconCluster.iconAnchor = new GPoint(10, 30);
                    iconCluster.infoWindowAnchor = new GPoint(10, 8);
                    strhtml = '<div><div style="width: 160px; overflow: hidden; height: 50px; float: left; padding-left: 10px; margin-right: 10px; line-height: normal; font-size: 9pt; text-align: left;"><div style="line-height: normal; font-size: 9pt; font-weight: bold; height: 16px; color:#531A03;">'+name+' ('+total_properties+')<\/div><div style="line-height: normal; font-size: 9pt; font-weight: normal; height: 16px; overflow: hidden;"><a href="'+urlMap+'" style="text-decoration:none; color:#531A03;">View on map</a> &nbsp;/&nbsp; <a href="'+urlResult+'" style="text-decoration:none; color:#531A03;">View as list</a><\/div><\/div><\/div>';
                    newMarker(new GLatLng(lat, lng), title, strhtml, iconCluster);
                }
            <?php
            }
        ?>
    }
    
    function showPropertyMarker(){
    //	markersArray=[];
        for(i=eventListeners.length-1; i>=0; i--){
            GEvent.removeListener(eventListeners[i]);
        }
        eventListeners=[];
        // I need to create json array with all property list
        var marker, title, iconActive, id, name, location, lat, lng, img, bed, bath, price, url, markerHTML;
            markersArray=[];
            <?php
            for($j = 0; $j < count($propListArr); $j++) {
                $property_id			= $propListArr[$j]['property_id'];
                $property_name 			= ucfirst($propListArr[$j]['property_name']);
                $property_title			= ucfirst($propListArr[$j]['property_title']);
                //for location
                $propLocInfoArr 		= $propertyObj->fun_getPropertyLocInfoArr($property_id);
                $strLocArr 				= array();
                if($propLocInfoArr['location_name'] !=""){
                    array_push($strLocArr, ucwords($propLocInfoArr['location_name']));
                }
                if($propLocInfoArr['subregion_name'] !=""){
                    array_push($strLocArr, ucwords($propLocInfoArr['subregion_name']));
                }
                if($propLocInfoArr['region_name'] !=""){
                    array_push($strLocArr, ucwords($propLocInfoArr['region_name']));
                }
                if($propLocInfoArr['area_name'] !=""){
                    array_push($strLocArr, ucwords($propLocInfoArr['area_name']));
                }
                $strLoc 				= implode(", ", $strLocArr);
                $propLatLonArr 			= $propertyObj->fun_getPropertyLatLong($property_id);
                $latitude				= $propLatLonArr[0]['latitude'];
                $longitude				= $propLatLonArr[0]['longitude'];
                $propertyMImgInfo		= $propertyObj->fun_getPropertyMainThumb($property_id);
                $propMImg 				= $propertyMImgInfo[0]['photo_thumb'];
                $propBedInfoArr 		= $propertyObj->fun_getPropertyBedAllInfoArr($property_id);
                // For bedrooms
                if(is_array($propBedInfoArr) && (count($propBedInfoArr) > 0)){
                    if($propBedInfoArr[0]['total_beds'] > 0) {
                        $total_beds 	= $propBedInfoArr[0]['total_beds']." Bedrooms";
                    }
                } else {
                    $total_beds 	= "";
                }
                // For bathrooms
                $propBathInfoArr 	= $propertyObj->fun_getPropertyBathAllInfoArr($property_id);
                if(is_array($propBathInfoArr) && (count($propBathInfoArr) > 0) && ($propBathInfoArr[0]['total_bathrooms'] > 0)){
                    $total_bathrooms= $propBathInfoArr[0]['total_bathrooms']." Bathrooms";
                } else {
                    $total_bathrooms= "";
                }
    
                $propPoolInfo	 	= $propertyObj->fun_verifyPropertyByPropertyFacility($property_id, "15");
                if($propPoolInfo) {
                    $show_swimming 	= "Swimming pool";
                } else {
                    $show_swimming 	= "";
                }
    
                // For Prices
                $propPriceInfoArr	= $propertyObj->fun_getPropertyPriceFromInfoArr($property_id);
        
                if(is_array($propPriceInfoArr) && (count($propPriceInfoArr) > 0)){
                    $users_currency_symbol	= $propertyObj->fun_findPropertyCurrencySymbol($property_id);
                    if($propPriceInfoArr['min_per_night_price'] > 0 && $propPriceInfoArr['max_per_night_price'] > 0 && $propPriceInfoArr['min_per_night_price'] != $propPriceInfoArr['max_per_night_price']) {
                        $min_per_night_price 	= number_format($propPriceInfoArr['min_per_night_price']);
                        $max_per_night_price 	= number_format($propPriceInfoArr['max_per_night_price']);
                        $price_txt 				= "From ".$users_currency_symbol."".$min_per_night_price." per night";
                    } else if($propPriceInfoArr['min_per_week_price'] > 0 && $propPriceInfoArr['max_per_week_price'] > 0 && $propPriceInfoArr['min_per_week_price'] != $propPriceInfoArr['max_per_week_price']) {
                        $min_per_week_price 	= number_format($propPriceInfoArr['min_per_week_price']);
                        $max_per_week_price 	= number_format($propPriceInfoArr['max_per_week_price']);
                        $price_txt 				= "From ".$users_currency_symbol."".$min_per_week_price." per week";
                    } else if($propPriceInfoArr['min_per_night_price'] > 0) {
                        $min_per_night_price 	= number_format($propPriceInfoArr['min_per_night_price']);
                        $price_txt 				= "From ".$users_currency_symbol."".$min_per_night_price." per night";
                    } else if($propPriceInfoArr['min_per_week_price'] > 0) {
                        $min_per_week_price 	= number_format($propPriceInfoArr['min_per_week_price']);
                        $price_txt 				= "From ".$users_currency_symbol."".$min_per_week_price." per week";
                    } else {
                        $price_txt 				= "";
                    }
                } else {
                    $price_txt 		= "";
                }
        
                $fr_url = $propertyObj->fun_getPropertyFriendlyLink($property_id);
                if(isset($fr_url) && $fr_url != "") {
                    $property_link = SITE_URL."accommodation/".strtolower($fr_url);
                } else {
                    if(isset($propLocInfoArr['location_name']) && $propLocInfoArr['location_name'] != "") {
                        $property_link = SITE_URL."accommodation/in.".str_replace(" ", "^", strtolower($propLocInfoArr['location_name']))."/".fill_zero_left($property_id, "0", (6-strlen($property_id)));
                    } else {
                        $property_link = SITE_URL."accommodation/in.".str_replace(" ", "^", strtolower($propLocInfoArr['region_name']))."/".fill_zero_left($property_id, "0", (6-strlen($property_id)));
                    }
                }
                ?>
                id = "<?php echo $property_id; ?>"; // Property Id
        //		alert(id);
                name = "<?php echo $property_name; ?>"; // Property Name
                title = "<?php echo addslashes($property_title); ?> - click for details"; // Property short description
                location = "<?php echo $strLoc; ?>"; // Property location
                lat = "<?php echo $latitude; ?>"; // Property Latitude
                lng = "<?php echo $longitude; ?>"; // Property Longitude
                img = "<?php echo $propMImg; ?>"; // Property images
                bed = "<?php echo $total_beds; ?>"; // Property bedroom
                bath = "<?php echo $total_bathrooms; ?>"; // Property Bathroom
                swimming = "<?php echo $show_swimming; ?>"; // Property swimming pool
    
                price = "<?php echo $price_txt; ?>"; // Property Price
                url = "<?php echo $property_link; ?>"; // Property Price
                if(lat != "" && lng != "") {
                    iconActive=new GIcon();
                    iconActive.image = '<?php echo SITE_URL; ?>images/markers/house-active.png';
                    iconActive.iconSize=new GSize(22, 27);
                    iconActive.shadow  = '<?php echo SITE_URL; ?>images/markers/house-shadow.png';
                    iconActive.shadowSize = new GSize(36, 27);
                    iconActive.iconAnchor=new GPoint(10, 30);
                    iconActive.infoWindowAnchor=new GPoint(10, 8);
            strhtml = '<div><div style="float: left; padding-right: 5px; width: 178px;"><a href="javascript:void(0);" onclick="showProperty(\''+url+'\');" style="text-decoration:none;"><img src="<?php echo PROPERTY_IMAGES_THUMB168x126_PATH; ?>'+img+'" width="168" height="126" style="filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=<?php echo PROPERTY_IMAGES_THUMB168x126_PATH; ?>'+img+', sizingMethod=scale);" border="0" alt="Holiday Rentals - 700keys Rental & Apartments" /></a><\/div><div style="width: 160px; overflow: hidden; height: 126px; float: left; padding-left: 5px; margin-right: 10px; text-align: left;"><div style="font-size: 15px; font-family: Arial, Helvetica, sans-serif; color: #4c72aa; background-color: #FFFFFF; text-align: left; line-height: 18px; font-weight: bold; overflow: hidden;"><a  href="javascript:void(0);" onclick="showProperty(\''+url+'\');" style="font-size: 15px; font-family: Arial, Helvetica, sans-serif; color: #4c72aa; background-color: #FFFFFF; text-align: left; line-height: 18px; font-weight: bold;" onmouseover="this.style.textDecoration=\'underline\';" onmouseout="this.style.textDecoration=\'none\';">'+name+'</a><\/div><div id="max-gmapLocation"><div style="font-size: 11px; font-family: Arial, Helvetica, sans-serif; color: #666666; background-color: #FFFFFF; text-align: left; line-height: 14px;">'+location+'<\/div><div id="max-gmapPrice"><div style="font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #000000; background-color: #FFFFFF; text-align: left; line-height: 18px; font-weight: bold;">'+price+'<\/div><\/div><div id="max-gmapBeds" style="font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #666666; background-color: #FFFFFF; text-align: left; line-height: 18px;">'+bed+'<\/div><div id="max-gmapBaths" style="font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #666666; background-color: #FFFFFF; text-align: left; line-height: 18px;">'+bath+'<\/div><div id="max-gmapBaths" style="font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #666666; background-color: #FFFFFF; text-align: left; line-height: 18px;">'+swimming+'<\/div><\/div><\/div><div style="clear: both;"><\/div>';
                    marker=newMarker(new GLatLng(lat, lng), title, strhtml, iconActive);
                    markersArray.push(marker);
                }
            <?php
            }
        ?>
        cluster.removeMarkers();
        cluster.addMarkers(markersArray);
    //	cluster.fitMapToMarkers();
        cluster.refresh(true);
    }
    
    function showRefinePropertyMarker(txt){
    //	markersArray=[];
        for(i=eventListeners.length-1; i>=0; i--){
            GEvent.removeListener(eventListeners[i]);
        }
        eventListeners=[];
        // I need to create json array with all property list
        var marker, title, iconActive, id, name, location, lat, lng, img, bed, bath, price, url, markerHTML;
        markersArray=[];
        var propListArr = txt.split(':::');
        for(var cnt = 1; cnt < propListArr.length; cnt++) {
            var propInfo =	propListArr[cnt];
            var propInfoListArr = propInfo.split('~~~');
            //alert(propInfoListArr[0]);
            id = propInfoListArr[0]; // Property Id
            lat = propInfoListArr[1]; // Property Latitude
            lng = propInfoListArr[2]; // Property Longitude
            title = propInfoListArr[3]; // Property title
            strhtml = propInfoListArr[4]; // Property info
            if(lat != "" && lng != "") {
                iconActive=new GIcon();
                iconActive.image = '<?php echo SITE_URL; ?>images/markers/house-active.png';
                iconActive.iconSize=new GSize(22, 27);
                iconActive.shadow  = '<?php echo SITE_URL; ?>images/markers/house-shadow.png';
                iconActive.shadowSize = new GSize(36, 27);
                iconActive.iconAnchor=new GPoint(10, 30);
                iconActive.infoWindowAnchor=new GPoint(10, 8);
                marker=newMarker(new GLatLng(lat, lng), title, strhtml, iconActive);
                markersArray.push(marker);
            }
        }
        cluster.removeMarkers();
        cluster.addMarkers(markersArray);
    //	cluster.fitMapToMarkers();
        cluster.refresh(true);
    }
    
    var map, cluster, eventListeners=[], markersArray=[], icon;
    
    function myOnload() {
        if (GBrowserIsCompatible()) {
            var geocoder = new GClientGeocoder();
            map=new GMap2(document.getElementById('map'));
            <?php 
                if(isset($mapLatitude) && $mapLatitude != "" && isset($mapLongitude) && $mapLongitude != "") {
                ?>
                    map.setCenter(new GLatLng(<?php echo $mapLatitude; ?>, <?php echo $mapLongitude; ?>), <?php if($mapZoomLevel){ echo $mapZoomLevel;} else {echo "3";} ?>, G_HYBRID_MAP);
                    map.setUIToDefault();
                <?php
                } else if(isset($destinations) && $destinations != "") {
                ?>
                    geocoder.getLocations("<?php echo ucfirst($destinations); ?>", addAddressToMap);
                    map.setUIToDefault();
                    map.setMapType(G_HYBRID_MAP);
                <?php
                } else {
                ?>
                    map.setCenter(new GLatLng(31.052934, 10.546875), 2, G_HYBRID_MAP);
                    map.setUIToDefault();
                <?php
                }
            ?>
            GEvent.addListener(map, 'zoomend', function() { map.closeInfoWindow(); });
    
            //	create a ClusterMarker
            var iconCluster=new GIcon();
            iconCluster.image = '<?php echo SITE_URL; ?>images/markers/cluster-active.png';
            iconCluster.iconSize =new GSize(27, 27);
            iconCluster.shadow  = '<?php echo SITE_URL; ?>images/markers/cluster-shadow.png';
            iconCluster.shadowSize = new GSize(41, 27);
            iconCluster.iconAnchor=new GPoint(10, 30);
            iconCluster.infoWindowAnchor=new GPoint(10, 8);
    
            cluster=new ClusterMarker(map, {clusterMarkerTitle:'Click to see %count property locations', clusterMarkerIcon:iconCluster });
    //		cluster.fitMapToMarkers();
    
            <?php
    /*
            if((isset($txtlocationids) && $txtlocationids !="") || (isset($txtsubregionids) && $txtsubregionids !="") || (isset($txtregionids) && $txtregionids !="") || (isset($txtareaids) && $txtareaids !="")) {
            ?>
                //	create a PropertyMarker
                showPropertyMarker();
            <?php
            } else {
            ?>
                //	create a ClusterMarker
                showClusterMarker();
            <?php
            }
    */
            ?>
            showPropertyMarker();
        }
    }
    
    function addAddressToMap(response) {
        if (!response || response.Status.code != 200) {
    //		geocoder.getLocations("Cape Town, South Africa", addAddressToMap);
    //		alert("Sorry, we were unable to geocode that address");
        } else {
            place = response.Placemark[0];
            point = new GLatLng(place.Point.coordinates[1], place.Point.coordinates[0]);
            map.setCenter(point, 10);
        }
    }
    
    function newMarker(markerLocation, title, strhtml, markerIcon) {
        var marker=new GMarker(markerLocation, {title:title, icon:markerIcon});
        eventListeners.push(GEvent.addListener(marker, 'click', function() {
            marker.openInfoWindowHtml('<p>'+strhtml+'</p>');
        }));
        return marker;
    //	map.addOverlay(marker);
    }
    
    function toggleClustering() {
        cluster.clusteringEnabled=!cluster.clusteringEnabled;
        cluster.refresh(true);
    }
    </script>
 <p><span id="ctl00_CPHContent_lblRestaurantName" class="GrayNormalText8pt" style="font-weight: bold; font-size: 12px;">Restaurant Name:...</span></p>
     <div id="area">     
        <div class="text">Delivery Area Charges</div>
         <div class="fixed2"><input name="ctl00$CPHContent$cbxZone1" checked="checked" onClick="Check_cbxZone1();" type="checkbox">
	     <p class="zone">Zone-1</p></div>
                <div class="zone_input"><input name="ctl00$CPHContent$txtZone1Price" value="5.00" maxlength="5" id="ctl00_CPHContent_txtZone1Price" type="text"></div>
               
        <div class="fixed3"><input id="ctl00_CPHContent_cbxZone2" name="ctl00$CPHContent$cbxZone2" checked="checked" onClick="Check_cbxZone2();" type="checkbox">
        <p class="zone1">Zone-2</p></div>
                <div class="zone1_input"><input name="ctl00$CPHContent$txtZone2Price" value="6.00" maxlength="5" id="ctl00_CPHContent_txtZone2Price" type="text"></div>
   
   
        <div class="fixed4"><input id="ctl00_CPHContent_cbxZone3" name="ctl00$CPHContent$cbxZone3" checked="checked" onClick="Check_cbxZone3();" type="checkbox">
        <p class="zone2">Zone-3</p></div>                
        <div class="zone2_input"><input name="ctl00$CPHContent$txtZone3Price" value="7.00" maxlength="5" id="ctl00_CPHContent_txtZone3Price" type="text"></div>
   
        <p class="zone3">Reset</p>
        <div class="options"><select class="options" name="ctl00$CPHContent$ddlZoneNumber" onChange="javascript:if (ResetZone(this.id)==false)return false;setTimeout('__doPostBack(\'ctl00$CPHContent$ddlZoneNumber\',\'\')', 0);setTimeout('__doPostBack(\'ctl00$CPHContent$ddlZoneNumber\',\'\')', 0)" id="ctl00_CPHContent_ddlZoneNumber">
            <option selected="selected" value="0">Select Zone</option>
            <option value="1">Zone-1</option>
            <option value="2">Zone-2</option>
            <option value="3">Zone-3</option>
        </select>
        </div>
    </div> 
     <div class="map" id="map" style="width: 665px; height:450px; float:left; border:1px solid #999999;  text-align:center;"></div>       
    <div style="clear:both;"></div>
    <div>   
        <input name="ctl00$CPHContent$btnCancel" value="Cancel" id="ctl00_CPHContent_btnCancel" style="color: Black; background-color: rgb(255, 204, 0); font-size: 11px; font-weight: bold; width: 90px; height:30px;" type="submit">
        <input name="ctl00$CPHContent$btnSave" value="Save" onClick="javascript:return ValidateZoneCharges();" id="ctl00_CPHContent_btnSave" style="color: Black; background-color: rgb(255, 204, 0); font-size: 11px; font-weight: bold; width: 90px; height:30px;" type="submit">
    </div>
<br />
<br />


