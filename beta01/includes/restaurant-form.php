<script type="text/javascript" src="<?php echo SITE_URL;?>jquery/js/jquery.ui.accordion.js"></script>
<script>
    $(function() {
        $( "#accordion" ).accordion({
            autoHeight: false,
            navigation: true
        });
    });
</script>
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
</script>
<style type="text/css">
.ui-icon {
    display: none;
    text-indent: -99999px;
    overflow: hidden;
    background-repeat: no-repeat;
}
.ui-accordion {
    width: 650px;
}
.ui-accordion .ui-accordion-header {
    cursor: pointer;
    position: relative;
    margin-top: 4px;
    zoom: 1;
    border:1px solid #b5b3b3;
    background:#e9e6e6;
}
.ui-accordion .ui-accordion-li-fix {
    display: inline;
}
.ui-accordion .ui-accordion-header-active {
    border-bottom: 0 !important;
}
.ui-accordion .ui-accordion-header a {
    display: block;
    font-size: 1.25em;
    padding: .5em .5em .5em .0em;
}
.ui-accordion-icons .ui-accordion-header a {
}
.ui-accordion .ui-accordion-header .ui-icon {
    position: absolute;
    left: .7em;
    top: 50%;
    margin-top: -8px;
}
element-style {
    height:auto;
}
.ui-accordion .ui-accordion-content {
    position: relative;
    top: 0px;
    height:auto;
    padding:0px 0px 0px 5px;
    overflow:hidden;
    zoom: 1;
    border:1px solid #b5b3b3;
    border-top:0px;
}
.ui-accordion-content {
    background:#FFFFFF;
}
.ui-accordion .ui-accordion-content-active {
    display:block;
}
.ui-menu {
    list-style:none;
    padding: 2px;
    margin: 0;
    display:block;
    float: left;
}
.ui-menu .ui-menu {
    margin-top: -3px;
}
.ui-menu .ui-menu-item {
    margin:0;
    padding: 0;
    zoom: 1;
    float: left;
    clear: left;
    width:670px;
}
.ui-menu .ui-menu-item a {
    text-decoration:none;
    display:block;
    padding:.2em .4em;
    line-height:1.4;
    zoom:1;
    color:#33CC33;
}
.ui-menu .ui-menu-item a.ui-state-hover, .ui-menu .ui-menu-item a.ui-state-active {
    font-weight: normal;
    margin: -1px;
    color:#33CC33
}
.question a {
    margin-left:5px;
    color:#747474;
    text-decoration:none;
}
.question a:hover {
    color:#FF0000;
    text-decoration:none;
}
.list-1 {
    padding:0px 5px 5px 0px;
}
.list-1 ul {
    margin:0;
    padding:10px 0px 0px 0px;
    list-style: none;
}
.list-1 ul li {
    padding-right:15px;
    margin:0px;
    display:inline;
    width:200px;
}
.pic-galery {
    width:670px;
    padding:4px 4px 4px 4px;
}
.pic-galery ul {
    margin-left:5px;
    width: 660px;
    height:auto;
}
.pic-galery li {
    float:left;
    display:inline;
    list-style: none;
    text-align:center;
    margin-top:5px;
    margin-bottom:5px;
    margin-right:10px;
    border:1px solid #666;
    padding:5px;
}
.pic-galery li img {
    width:168px;
    height:126px;
    margin-top:5px;
    margin-bottom:5px;
    text-align:center;
}
.pic-upload-sec {
    width:632px;
    margin:0 auto;
    padding:4px 4px 4px 8px;
    border-top:2px solid #e9e6e6;
    clear:both;
}
.pic-upload-sec input {
    background:url(../images/input-bg.gif) repeat-x;
    height:26px;
    border:1px solid #b5b3b3;
}

</style>
<?php
if(isset($rest_id) && $rest_id !=""){
    $restInfo     = $restObj->fun_getRestaurantInfo($rest_id);
    $manager_id   = $restObj->fun_getRestaurantManagerId($rest_id);
    $rest_manager = $usersObj->fun_getUserNameById($manager_id);
    $restPhotoArr = $restObj->fun_getRestPhotosGallary($rest_id);
?>
<div class="panel panel-default">
    <div class="panel-heading"><h3>Edit Restaurant</h3></div>
    <div class="panel-body">
        <?php if ( ! empty( $manager_id ) ) : ?>
        <div class="cols-md-12">
            <ul class="list-unstyled pull-right list-inline">
                <li><a href="manager-restaurants.php?sec=edit&rest_id=<?php echo $rest_id;?>" class="btn btn-danger">Details</a></li>
                <li><a href="manager-restaurants-info.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo base64_encode("manager-restaurants.php?sec=edit&rest_id=$rest_id");?>" class="btn btn-default">Restaurant Info</a></li>
                <li><a href="manager-restaurants-menu.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo base64_encode("manager-restaurants.php?sec=edit&rest_id=$rest_id");?>" class="btn btn-default">Menus</a></li>
                <li><a href="manager-restaurants-order.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo base64_encode("manager-restaurants.php?sec=edit&rest_id=$rest_id");?>" class="btn btn-default">Orders</a></li>
                <li><a href="manager-restaurants-alert.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo base64_encode("manager-restaurants.php?sec=edit&rest_id=$rest_id");?>" class="btn btn-default">Notification</a></li>
                <li><a href="manager-restaurants-coupons.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo base64_encode("manager-restaurants.php?sec=edit&rest_id=$rest_id");?>" class="btn btn-default">Coupons</a></li>
                <li><a href="manager-restaurants.php" class="btn btn-success">Back to list</a></li>
            </ul>
        </div>
        <?php endif; ?>
        <div class="clearfix"><br><br></div>
        <div class="cols-md-12">
        <form name="frmRestaurant" id="frmRestaurant" class="form-horizontal" method="post" action="manager-restaurants.php?sec=edit&rest_id=<?php echo $rest_id;?>" enctype="multipart/form-data">
            <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITRESTAURANTDETAILS"); ?>">
            <input type="hidden" name="rest_id" id="rest_id" value="<?php echo $rest_id; ?>">
            <input type="hidden" name="photo_id" id="photo_id" value="">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#address" aria-controls="address" role="tab" data-toggle="tab">Address</a></li>
                <li role="presentation"><a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">Summary</a></li>
                <li role="presentation"><a href="#logo" aria-controls="logo" role="tab" data-toggle="tab">Logo & Banners</a></li>
                <li role="presentation"><a href="#gallery" aria-controls="gallery" role="tab" data-toggle="tab">Picture Gallery</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="address">
                    <br>
                    <h4 class="text-danger">Edit Restaurant Address</h4>
                    <br>
                    <?php if( ! empty($manager_id) ) : ?>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="rest_manager">Restaurant Manager</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="rest_manager" id="rest_manager_id" value="<?php echo $rest_manager;?>" disabled="disabled" />
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="rest_name">Restaurant name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="rest_name" id="rest_name_id" value="<?php if(isset($_POST['rest_name'])){echo $_POST['rest_name'];} else {echo $restInfo['rest_name'];}?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="rest_country_id">Country</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="rest_country_id" id="rest_country_id_id" onchange="chkSelectCountry();">
                                <option value="0" selected>Select ... </option>
                                <?php 
                                    $locationObj->fun_getCountryOptionsList(((isset($_POST['rest_country_id']) && ($_POST['rest_country_id'] != "" || $_POST['rest_country_id'] != "0"))?$_POST['rest_country_id']:((isset($restInfo['rest_country_id']) && ($restInfo['rest_country_id'] != "" || $restInfo['rest_country_id'] != "0"))?$restInfo['rest_country_id']:223)), '');
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="rest_state_id">State / Province</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="rest_state_id" id="rest_state_id_id" class="select310" onchange="chkSelectState();">
                                <option value="0" selected>Select ... </option>
                                <?php 
                                    $locationObj->fun_getStateOptionsListByCountryId(((isset($_POST['rest_state_id']) && ($_POST['rest_state_id'] != "" || $_POST['rest_state_id'] != "0"))?$_POST['rest_state_id']:$restInfo['rest_state_id']), ((isset($_POST['rest_country_id']) && ($_POST['rest_country_id'] != "" || $_POST['rest_country_id'] != "0"))?$_POST['rest_country_id']:((isset($restInfo['rest_country_id']) && ($restInfo['rest_country_id'] != "" || $restInfo['rest_country_id'] != "0"))?$restInfo['rest_country_id']:223)));
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="rest_city_id">City</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="rest_city_id" id="rest_city_id_id" class="select310" >
                                <option value="0" selected>Select ... </option>
                                <?php 
                                $locationObj->fun_getCityOptionsListByStateId($restInfo['rest_city_id'], $restInfo['rest_state_id']);
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="rest_address1">Street address</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="rest_address1" id="rest_address1_id" value="<?php if(isset($_POST['rest_address1'])){echo $_POST['rest_address1'];}else{echo $restInfo['rest_address1'];}?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="rest_address2">&nbsp;</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="rest_address2" id="rest_address2_id" value="<?php if(isset($_POST['rest_address2'])){echo $_POST['rest_address2'];}else{echo $restInfo['rest_address2'];}?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="rest_zip">Zip / Postal code</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="rest_zip" id="rest_zip_id" value="<?php if(isset($_POST['rest_zip'])){echo $_POST['rest_zip'];}else{echo $restInfo['rest_zip'];}?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="active">Active</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="active" id="active_id">
                                <option value="0" <?php if($restInfo['active'] == 0) {echo "selected=\"selected\"";} ?> >No</option>
                                <option value="1" <?php if($restInfo['active'] == 1) {echo "selected=\"selected\"";} ?> >Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-10">
                            <button type="submit" class="btn btn-danger col-md-4">Edit Now</button>
                        </div>
                    </div>
                    <div class="clearfix"><br><br></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="summary">
                    <br>
                    <h4 class="text-danger">Edit Restaurant Summary</h4>
                    <br>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="rest_title">Title</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="rest_title" id="rest_title_id" value="<?php if(isset($_POST['rest_title'])){echo $_POST['rest_title'];} else {echo $restInfo['rest_title'];}?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="rest_short_desc">Welcome Message</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="rest_short_desc" id="rest_short_desc_id" ><?php echo $restInfo['rest_short_desc']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="page_discription">About Restaurant</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="page_discription" id="page_discription_id"><?php echo $restInfo['page_discription']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-10">
                            <button type="button" class="btn btn-danger col-md-4" onclick="return updateRestDesc();">Update now</button>
                        </div>
                    </div>
                    <div class="clearfix"><br><br></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="logo">
                    <br>
                    <h4 class="text-danger">Edit Restaurant Logo & Photos</h4>
                    <br>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td align="center" valign="center">Logo<br><span class="text-danger"><em>**Dimension 100px X 100px</em></span></td>
                                <td align="center"><img src="<?php echo RESTAURANT_IMAGES_LOGO_PATH.$restInfo['rest_logo'];?>" border="0" width="100px" height="100px" onError="this.src='<?php echo RESTAURANT_IMAGES_LOGO_PATH;?>no-img.gif';" /></td>
                                <td align="center"><input type="file" name="rest_logo" id="rest_logo_id" value="" class="btn btn-success" /></td>
                            </tr>
                            <tr>
                                <td align="center" valign="center">Main Photo<br><span class="text-danger"><em>**Dimension 550px 240px</em></span></td>
                                <td align="center"><img src="<?php echo RESTAURANT_IMAGES_LARGE_PATH.$restInfo['rest_photo'];?>" border="0" width="168px" onError="this.src='<?php echo RESTAURANT_IMAGES_THUMB168x126_PATH;?>no-img.gif';" /></td>
                                <td align="center"><input type="file" name="rest_photo" id="rest_photo_id" value="" class="btn btn-success" /></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-10">
                            <button type="button" class="btn btn-danger col-md-4" onclick="return uploadLogo();">Upload Now</button>
                        </div>
                    </div>
                    <div class="clearfix"><br><br></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="gallery">
                    <div class="cols-md-10">
                        <?php
                        if(is_array($restPhotoArr) && count($restPhotoArr) > 0) {
                            echo '<ul class="list-unstyled list-inline">';
                            for($i=0; $i < count($restPhotoArr); $i++){
                                $photo_id      = $restPhotoArr[$i]['photo_id'];
                                $photo_thumb   = $restPhotoArr[$i]['photo_thumb'];
                                $photo_caption = $restPhotoArr[$i]['photo_caption'];
                                $photo_url 	   = RESTAURANT_IMAGES_THUMB168x126_PATH.$photo_thumb;
                                echo '<li class="cols-md-3 text-center" style="padding:5px;">';
                                echo '<img src="'.$photo_url.'" /><br>';
                                echo $photo_caption;
                                //echo '<p align="center"><a href="admin-restaurant-photos-edit.php?sec=photo&subsec=det&rest_id='.$rest_id.'&photo_id='.$photo_id.'">Edit</a>&nbsp;&nbsp;&nbsp;<a class="red" href="javascript:toggleLayer1(\'picture_delete\');">Detele</a></p>';
                                echo '</li>';
                             }
                            echo '</ul>';
                        } else {
                            echo '<span class="text-danger">Please add new photo!</span>';
                        }
                        ?>
                    </div>
                    <div class="cols-md-10">
                            <div class="col-sm-offset-2 col-sm-10">
                                <br>
                                <h4 class="text-danger">Add a new photo</h4>
                                <br>
                            </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="photo_thumb">Photo</label>
                            <div class="col-sm-6">
                                <input type="file" name="photo_thumb" id="photo_thumb_id" value="" class="btn btn-success"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="photo_thumb">Caption</label>
                            <div class="col-sm-6">
                                <input  type="text" name="photo_caption" id="photo_caption_id" value="" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">
                                <button type="button" class="btn btn-danger col-md-4" onclick="return uploadPhotos();" >Upload</button>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"><br><br></div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
<?php
}
?>
