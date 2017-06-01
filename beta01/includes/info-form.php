<?php
$rest_id  = $_REQUEST['rest_id'];
$restInfo = $restObj->fun_getRestaurantInfo($rest_id);
$restConf = $restObj->fun_getRestaurantConf($rest_id);
if($restInfo['rest_latitude'] !="" && $restInfo['rest_longitude'] !="") {
    $rest_latitude       = $restInfo['rest_latitude'];
    $rest_longitude      = $restInfo['rest_longitude'];
    $rest_map_zoom_level = $restInfo['rest_map_zoom_level'];
} else {
    // Location info
    // Restaurant address
    $restLocInfoArr = $restObj->fun_getRestaurantLocInfoArr($rest_id);
    $rest_address   = $rest_address1;
    if(isset($rest_address2) && $rest_address2 !="")
    $rest_address .= ", " .$rest_address2;
    if(isset($restLocInfoArr['city_name']) && $restLocInfoArr['city_name'] !="")
    $rest_address .= ", " .ucwords($restLocInfoArr['city_name']);
    if(isset($restLocInfoArr['state_name']) && $restLocInfoArr['state_name'] !="")
    $rest_address .= ", " .ucwords($restLocInfoArr['state_name']);
    if(isset($restInfo['rest_zip']) && $restInfo['rest_zip'] !="")
    $rest_address .= ", " .$restInfo['rest_zip'];
}
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
<div class="panel panel-default">
    <div class="panel-heading"><h3>Add / Edit Info</h3></div>
    <div class="panel-body">
        <div class="cols-md-12">
            <ul class="list-unstyled pull-right list-inline">
                <li><a href="manager-restaurants.php?sec=edit&rest_id=<?php echo $rest_id;?>" class="btn btn-default">Details</a></li>
                <li><a href="manager-restaurants-info.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo base64_encode("manager-restaurants.php?sec=edit&rest_id=$rest_id");?>" class="btn btn-danger">Restaurant Info</a></li>
                <li><a href="manager-restaurants-menu.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo base64_encode("manager-restaurants.php?sec=edit&rest_id=$rest_id");?>" class="btn btn-default">Menus</a></li>
                <li><a href="manager-restaurants-order.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo base64_encode("manager-restaurants.php?sec=edit&rest_id=$rest_id");?>" class="btn btn-default">Orders</a></li>
                <li><a href="manager-restaurants-alert.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo base64_encode("manager-restaurants.php?sec=edit&rest_id=$rest_id");?>" class="btn btn-default">Notification</a></li>
                <li><a href="manager-restaurants-coupons.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo base64_encode("manager-restaurants.php?sec=edit&rest_id=$rest_id");?>" class="btn btn-default">Coupons</a></li>
                <li><a href="manager-restaurants.php" class="btn btn-success">Back to list</a></li>
            </ul>
        </div>
        <div class="clearfix"><br><br></div>
        <div class="cols-md-12">
        <form name="frmRestaurant" id="frmRestaurant" method="post" action="manager-restaurants-info.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url'];?>" enctype="multipart/form-data">
            <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITRESTAURANTINFO"); ?>">
            <input type="hidden" name="rest_id" id="rest_id" value="<?php echo $rest_id; ?>">
            <input type="hidden" name="conf_id" id="conf_id" value="<?php echo $restConf['conf_id']; ?>">
            <input type="hidden" name="back_url" id="back_url" value="<?php echo $_GET['back_url']; ?>">
            <input type="hidden" name="map_type" id="map_type" value="G_HYBRID_MAP" />
            <input type="hidden" name="rest_latitude" id="rest_latitude" value="<?php if(isset($rest_latitude) && $rest_latitude !=""){echo $rest_latitude;} else {echo "38.886757140695906";} ?>">
            <input type="hidden" name="rest_longitude" id="rest_longitude" value="<?php if(isset($rest_longitude) && $rest_longitude !=""){echo $rest_longitude;} else {echo "22.3187255859375";} ?>">
            <input type="hidden" name="rest_map_zoom_level" id="rest_map_zoom_level" value="<?php if(isset($rest_map_zoom_level)) {echo $rest_map_zoom_level;} else {echo "8";}?>" />
            <div class="cols-md-12">
                <br>
                <h4 class="text-danger">Edit Ordering Info</h4>
                <br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="online_order">Online Ordering</label>
                    <div class="col-sm-9">
                        <ul class="list-unstyled list-inline">
                            <li><input type="radio" name="online_order" id="online_order_id2" value="1" <?php if(!isset($restConf['online_order']) || $restConf['online_order'] =="1"){echo 'checked="checked"';}?> /> <label for="online_order"> Yes</label></li>
                            <li><input type="radio" name="online_order" id="online_order_id1" value="0" <?php if(isset($restConf['online_order']) && $restConf['online_order'] =="0"){echo 'checked="checked"';}?> /> <label for="online_order"> No</label></li>
                        </ul>
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="online_order">Payment Options</label>
                    <div class="col-sm-9">
                        <ul class="list-unstyled list-inline">
                            <li><label for="payment_cash"> Cash Payment</label><input class="checkbox" type="checkbox" name="payment_cash" id="payment_cash_id" value="1" <?php if(isset($restConf['payment_cash']) && $restConf['payment_cash'] =="1"){echo 'checked="checked"';}?> /></li>
                            <li><label for="payment_cc"> CC Payment</label><input class="checkbox" type="checkbox" name="payment_cc" id="payment_cc_id" value="1" <?php if(isset($restConf['payment_cc']) && $restConf['payment_cc'] =="1"){echo 'checked="checked"';}?> /></li>
                            <li><label for="payment_oo"> Online Payment</label><input class="checkbox" type="checkbox" name="payment_oo" id="payment_oo_id" value="1" <?php if(isset($restConf['payment_oo']) && $restConf['payment_oo'] =="1"){echo 'checked="checked"';}?> /></li>
                        </ul>
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="currency_id">Currency</label>
                    <div class="col-sm-9">
                        <select class="col-sm-4" name="currency_id" id="currency_id">
                            <option value="4" <?php if(isset($restConf['currency_id']) && $restConf['currency_id'] =="4") {echo "selected=\"selected\"";} ?> >Indian Rupee (INR)</option>
                            <option value="1" <?php if(isset($restConf['currency_id']) && $restConf['currency_id'] =="1") {echo "selected=\"selected\"";} ?> >American Dollar (USD)</option>
                        </select>
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="paypal_id">PayPal Id</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="paypal_id" id="paypal_id_id" value="<?php echo $restConf['paypal_id'];?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="phone">Contact</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="phone" id="phone_id" value="<?php echo $restConf['phone'];?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="fax">Fax</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="fax" id="fax_id" value="<?php echo $restConf['fax'];?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="tax">Tax</label>
                    <div class="col-sm-9">
                        <input type="text" class="col-sm-2" name="tax" id="tax_id" value="<?php echo $restConf['tax'];?>" /> %
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="min_order">Min Order</label>
                    <div class="col-sm-9">
                        <input type="text" class="col-sm-2" name="min_order" id="min_order_id" value="<?php echo $restConf['min_order'];?>" />&#8377;
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="delivery_type">Delivery Type</label>
                    <div class="col-sm-9">
                        <ul class="list-unstyled list-inline">
                            <li><input type="radio" name="delivery_type" id="delivery_type_id0" value="0" <?php if(!isset($restConf['delivery_type']) || $restConf['delivery_type'] =="0" || $restConf['delivery_type'] ==""){echo 'checked="checked"';}?> /> Pickup Only</li>
                            <li><input type="radio" name="delivery_type" id="delivery_type_id0" value="1" <?php if(isset($restConf['delivery_type']) && $restConf['delivery_type'] =="1"){echo 'checked="checked"';}?> /> Pickup and Delivery</li>
                        </ul>
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="book_table">Book Table</label>
                    <div class="col-sm-9">
                        <ul class="list-unstyled list-inline">
                            <li><input type="radio" name="book_table" id="book_table_id0" value="0" <?php if(!isset($restConf['book_table']) || $restConf['book_table'] =="0" || $restConf['book_table'] ==""){echo 'checked="checked"';}?> /> No </li>
                            <li><input type="radio" name="book_table" id="book_table_id1" value="1" <?php if(isset($restConf['book_table']) && $restConf['book_table'] =="1"){echo 'checked="checked"';}?> /> Yes </li>
                        </ul>
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="delivery_charge">Delivery Fee</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="delivery_charge" id="delivery_charge_id" value="<?php echo $restConf['delivery_charge'];?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="extra_charge">Processing Fee</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="extra_charge" id="extra_charge_id" value="<?php echo $restConf['extra_charge'];?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="delivery_hrs_mon">Delivery Mon</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="delivery_hrs_mon" id="delivery_hrs_mon_id" value="<?php echo $restConf['delivery_hrs_mon'];?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="delivery_hrs_tue">Delivery Tue</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="delivery_hrs_tue" id="delivery_hrs_tue_id" value="<?php echo $restConf['delivery_hrs_tue'];?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="delivery_hrs_wed">Delivery Wed</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="delivery_hrs_wed" id="delivery_hrs_wed_id" value="<?php echo $restConf['delivery_hrs_wed'];?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="delivery_hrs_thu">Delivery Thu</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="delivery_hrs_thu" id="delivery_hrs_thu_id" value="<?php echo $restConf['delivery_hrs_thu'];?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="delivery_hrs_fri">Delivery Fri</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="delivery_hrs_fri" id="delivery_hrs_fri_id" value="<?php echo $restConf['delivery_hrs_fri'];?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="delivery_hrs_sat">Delivery Sat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="delivery_hrs_sat" id="delivery_hrs_sat_id" value="<?php echo $restConf['delivery_hrs_sat'];?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="delivery_hrs_sun">Delivery Sun</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="delivery_hrs_sun" id="delivery_hrs_sun_id" value="<?php echo $restConf['delivery_hrs_sun'];?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="delivery_area_note">Delivery Area Note</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="delivery_area_note" id="delivery_area_note_id"><?php echo $restConf['delivery_area_note']; ?></textarea>
                    </div>
                </div>
                <br><br><br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="serving_note">Serving Note</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="serving_note" id="serving_note_id"><?php echo $restConf['serving_note']; ?></textarea>
                    </div>
                </div>
                <br><br><br><br>


                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-10">
                        <button type="submit" class="btn btn-danger col-md-4">Edit Now</button>
                    </div>
                </div>
                <div class="clearfix"><br><br></div>
            </div>
        </div>
        </form>
    </div>
</div>
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




<?php
/*
$rest_id  = $_REQUEST['rest_id'];
$restInfo = $restObj->fun_getRestaurantInfo($rest_id);
$restConf = $restObj->fun_getRestaurantConf($rest_id);
if($restInfo['rest_latitude'] !="" && $restInfo['rest_longitude'] !="") {
    $rest_latitude       = $restInfo['rest_latitude'];
    $rest_longitude      = $restInfo['rest_longitude'];
    $rest_map_zoom_level = $restInfo['rest_map_zoom_level'];
} else {
    // Location info
    // Restaurant address
    $restLocInfoArr = $restObj->fun_getRestaurantLocInfoArr($rest_id);
    $rest_address   = $rest_address1;
    if(isset($rest_address2) && $rest_address2 !="")
    $rest_address .= ", " .$rest_address2;
    if(isset($restLocInfoArr['city_name']) && $restLocInfoArr['city_name'] !="")
    $rest_address .= ", " .ucwords($restLocInfoArr['city_name']);
    if(isset($restLocInfoArr['state_name']) && $restLocInfoArr['state_name'] !="")
    $rest_address .= ", " .ucwords($restLocInfoArr['state_name']);
    if(isset($restInfo['rest_zip']) && $restInfo['rest_zip'] !="")
    $rest_address .= ", " .$restInfo['rest_zip'];
}
?>
<script type="text/javascript" language="javascript">
    function chkblnkTxtError(strFieldId, strErrorFieldId){
        if(document.getElementById(strFieldId).value != ""){
            document.getElementById(strErrorFieldId).innerHTML = "";
        }
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
<form name="frmRestaurant" id="frmRestaurant" method="post" action="manager-restaurants-info.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url'];?>" enctype="multipart/form-data">
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
        <label><strong>Payment Options</strong></label>
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
        <div class="list-1" style="width:100%; margin-left:140px; margin-top:10px;">
            <ul>
                <li><input type="radio" name="delivery_type" id="delivery_type_id0" value="0" <?php if(!isset($restConf['delivery_type']) || $restConf['delivery_type'] =="0" || $restConf['delivery_type'] ==""){echo 'checked="checked"';}?> style="width:13px; height:13px;" />&nbsp;Pickup Only&nbsp;</li>
                <li><input type="radio" name="delivery_type" id="delivery_type_id0" value="1" <?php if(isset($restConf['delivery_type']) && $restConf['delivery_type'] =="1"){echo 'checked="checked"';}?> style="width:13px; height:13px;" />&nbsp;Pickup and Delivery&nbsp;</li>
            </ul>
        </div>
    </p>
    <p style="clear:both;">&nbsp;</p>
    <p>
        <label for="book_table">Book Table</label>
        <div class="list-1" style="width:100%; margin-left:140px; margin-top:10px;">
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
    <p style="clear:both;">&nbsp;</p>
    <p>
        <label for="extra_charge">Processing Fee</label>
        <input type="text" name="extra_charge" id="extra_charge_id" value="<?php echo $restConf['extra_charge'];?>" />
    </p>
    <p style="clear:both;">&nbsp;</p>
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
    <p align="center"><hr style="color:#999999; width:98%;" /></p>
    <p>&nbsp;</p>
    <p>
    <!-- THIS TABLE IS FOR SHOW GOOGLE MAP: START HERE -->
    <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr><td align="left" valign="top" class="font14 pad-btm10"><strong>Now find the restaurant on the google map</strong></td></tr>
        <tr><td align="left" valign="top"><div id="map" style="width: 650px; height:450px; border:1px solid #999999; text-align:center;"></div></td></tr>
        <tr><td align="left" valign="top" class="font12 red"><em>To move the pin to the exact location of restaurant just click and hold on the marker drag it to the exact position and drop it</em></td></tr>
    </table>
    <!-- THIS TABLE IS FOR SHOW GOOGLE MAP: END HERE -->
    </p>
    <p>&nbsp;</p>
    <p>
        <label>&nbsp;</label>
        <a href="<?php echo base64_decode($_GET['back_url']); ?>" class="button-grey">Cancel</a>&nbsp;<a href="javascript:void(0);" onclick="return validatefrm();" class="button-red">Save Now</a>
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

<?php */ ?>