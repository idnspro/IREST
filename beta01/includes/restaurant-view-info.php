<?php
if(is_array($restConf) && !empty($restConf)) {
	echo '<div id="rest-info">';
	// For Google Map
	if(isset($rest_latitude) && $rest_latitude !="" && isset($rest_longitude) && $rest_longitude !="" && isset($rest_map_zoom_level) && $rest_map_zoom_level !="") {
	?>
	<div id="map" style="overflow:hidden;width:583px;height:400px;border:1px solid #999999;"></div>
    <div class="clearfix"></div>
    <br />
	<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript">
		var map;
		var strlatitude = <?php echo $rest_latitude; ?>;;
		var strlongitude = <?php echo $rest_longitude; ?>;
		var zoomLevel = <?php echo $rest_map_zoom_level; ?>;
		var image = new google.maps.MarkerImage('<?php echo SITE_IMAGES;?>markers/marker.png', new google.maps.Size(20, 34), new google.maps.Point(0,0), new google.maps.Point(0,32));
		var shadow = new google.maps.MarkerImage('<?php echo SITE_IMAGES;?>markers/shadow.png', new google.maps.Size(37, 32), new google.maps.Point(0,0), new google.maps.Point(0, 32));
	
		function initialize() {
		var Latlng = new google.maps.LatLng(strlatitude, strlongitude);
		var Options = {
		  zoom: zoomLevel,
		  center: Latlng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById('map'), Options);
		
		var marker = new google.maps.Marker({
			position: Latlng, 
			map: map,
			shadow: shadow,
			icon: image,
			title:"<?php echo $property_name; ?>"
		});   
		}
		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
	<!-- Map code: End here -->
	<?php
	}
	//For about restaurant
	echo '<h1>About '.$rest_name.'</h1>';
	echo '<div class="pad-top5 pad-btm15">'.$page_discription.'</div>';

	//Delivery Area
	if(isset($restConf['delivery_area_note']) && $restConf['delivery_area_note'] !="") {
		echo '<h1>Delivery Area</h1>';
		echo '<div class="pad-top5 pad-btm15">'.$restConf['delivery_area_note'].'</div>';
	}
	//Delivery Hours
	echo '<h1>Delivery Hours</h1>';
	echo '<div class="pad-top5 pad-btm15 font12">';
	echo '<table width="100%" border="0">';
	echo '<tr><td style="width:40px; color:#a70100; padding-right:5px;"><strong>Mon</strong></td><td>: '.$restConf['delivery_hrs_mon'].'</td></tr>';
	echo '<tr><td style="width:40px; color:#a70100; padding-right:5px;"><strong>Tue</strong></td><td>: '.$restConf['delivery_hrs_tue'].'</td></tr>';
	echo '<tr><td style="width:40px; color:#a70100; padding-right:5px;"><strong>Wed</strong></td><td>: '.$restConf['delivery_hrs_wed'].'</td></tr>';
	echo '<tr><td style="width:40px; color:#a70100; padding-right:5px;"><strong>Thu</strong></td><td>: '.$restConf['delivery_hrs_thu'].'</td></tr>';
	echo '<tr><td style="width:40px; color:#a70100; padding-right:5px;"><strong>Fri</strong></td><td>: '.$restConf['delivery_hrs_fri'].'</td></tr>';
	echo '<tr><td style="width:40px; color:#a70100; padding-right:5px;"><strong>Sat</strong></td><td>: '.$restConf['delivery_hrs_sat'].'</td></tr>';
	echo '<tr><td style="width:40px; color:#a70100; padding-right:5px;"><strong>Sun</strong></td><td>: '.$restConf['delivery_hrs_sun'].'</td></tr>';
	echo '</table>';
	echo '</div>';
	
	//Ordering Info
	echo '<h1>Ordering Info</h1>';
	echo '<div class="pad-top5 pad-btm15 font12">';
	echo '<table width="100%" border="0">';
	echo '<tr><td style="width:110px; color:#a70100; padding-right:5px;" align="right"><strong>Min Order</strong>:</td><td>'.$currency_symbol.$restConf['min_order'].'</td></tr>';
	echo '<tr><td style="width:110px; color:#a70100; padding-right:5px;" align="right"><strong>Delivery Fee</strong>:</td><td>'.$currency_symbol.$restConf['delivery_charge'].'</td></tr>';
	echo '<tr><td style="width:110px; color:#a70100; padding-right:5px;" align="right"><strong>Contact</strong>:</td><td>'.$restConf['phone'].'</td></tr>';
	echo '<tr><td style="width:110px; color:#a70100; padding-right:5px;" align="right"><strong>Serving</strong>:</td><td>'.$restConf['serving_note'].'</td></tr>';
	echo '</table>';
	echo '</div>';
	
	echo '</div>';
?>
<?php
}

/*
for($i =0; $i < count($restListArr); $i++) {
	$rest_id 				= $restListArr[$i]['rest_id'];
	$rest_name 				= $restListArr[$i]['rest_name'];
	$rest_title 			= $restListArr[$i]['rest_title'];
	$rest_logo 				= RESTAURANT_IMAGES_LOGO_PATH.$restListArr[$i]['rest_logo'];
	$description			= ucfirst(substr($restListArr[$i]['rest_short_desc'], 0, 210));
	$currencyArr			= $restObj->fun_getRestaurantCurrencyInfo($rest_id);
	$rest_currency_id		= $currencyArr['currency_id'];
	$rest_currency_code 	= $currencyArr['currency_code'];
	$rest_currency_symbol 	= $currencyArr['currency_symbol'];
	$rest_currency_rate 	= $currencyArr['currency_rate'];
	$rest_currency_name 	= $currencyArr['currency_name'];
	$currency_symbol		= ($users_currency_symbol == "")?$rest_currency_symbol:$users_currency_symbol;
	$currency_code			= ($users_currency_code == "")?$rest_currency_code:$users_currency_code;
	$restLocInfoArr 		= $restObj->fun_getRestaurantLocInfoArr($rest_id);
	$propLoc = "";
	if($restLocInfoArr['country_name'] !=""){
		$propLoc .= "<a href=\"".SITE_URL."restaurants/".str_replace("/", "_", str_replace(" ", "-", strtolower($restLocInfoArr['country_name'])))."\" >".ucwords($restLocInfoArr['country_name'])."</a> > ";
	}
	if($restLocInfoArr['state_name'] !=""){
		$propLoc .= "<a href=\"".SITE_URL."restaurants/".str_replace("/", "_", str_replace(" ", "-", strtolower($restLocInfoArr['state_name'])))."\" >".ucwords($restLocInfoArr['state_name'])."</a> > ";
	}
	if($restLocInfoArr['city_name'] !=""){
		$propLoc .= "<a href=\"".SITE_URL."restaurants/".str_replace("/", "_", str_replace(" ", "-", strtolower($restLocInfoArr['city_name'])))."\" >".ucwords($restLocInfoArr['city_name'])."</a> > ";
	}
	$propLoc .= ucfirst($rest_name)." ref:".fill_zero_left($rest_id, "0", (6-strlen($rest_id)));

	$fr_url = $restObj->fun_getRestaurantFriendlyLink($rest_id);
	if(isset($fr_url) && $fr_url != "") {
		$restaurant_link 	= SITE_URL."restaurant/".strtolower($fr_url);
	} else {
		if(isset($restLocInfoArr['city_name']) && $restLocInfoArr['city_name'] != "") {
			$restaurant_link = SITE_URL."restaurant/".str_replace(" ", "-", strtolower($restLocInfoArr['city_name']))."/".fill_zero_left($rest_id, "0", (6-strlen($rest_id)));
		} else {
			$restaurant_link = SITE_URL."restaurant/".str_replace(" ", "-", strtolower($restLocInfoArr['state_name']))."/".fill_zero_left($rest_id, "0", (6-strlen($rest_id)));
		}
	}
?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listingTable">
        <tr>
            <td valign="top" class="pad-btm10 pad-top5 pad-lft5 pad-rgt5">
                <div class="font12 white nav8 pad-btm5"><?php echo tranText('location'); ?>:&nbsp;<span><?php echo $propLoc; ?></span></div>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="120px" valign="top"><a href="<?php echo $restaurant_link; ?>" title="<?php echo $rest_name.": ".$rest_title;?>"><img src="<?php echo $rest_logo;?>" width="100" onerror="this.src='<?php echo SITE_IMAGES;?>no-image-small.gif';" style="border:5px #999999 solid" /></a></td>
                        <td valign="top" class="pad-lft10 pad-rgt10">
                            <div class="pad-btm5">
                                <h5><?php echo $rest_name ?></h5>
                                <p class="font12 white"><?php echo $description."<br>"; ?></p>
                            </div>
                            <div class="pad-top5 font12 white">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="30px"><img src="<?php echo SITE_IMAGES;?>t.gif" class="gui-icon-review gui-icon-rw" /></td>
                                        <td width="55px"><?php echo tranText('reviews'); ?></td>
                                        <td><?php $restObj->fun_createRestaurantCustomerReview($rest_id); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td width="170px" valign="bottom" align="right">
                            <a href="<?php echo $restaurant_link; ?>" style="text-decoration:none;" class="button-blue"><?php echo tranText('view_menu'); ?></a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
<?php
}
*/
?>
