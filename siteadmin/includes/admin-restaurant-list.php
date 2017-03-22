<?
$restaurantListArr	= $restObj->fun_getRestaurant($user_id);
//print_r($restaurantListArr);
if(is_array($restaurantListArr) && count($restaurantListArr) > 0){
?>
<div class="right-area-title">
    <div class="title">
        <h1>Restaurant Listing</h1>
    </div>
    <!--title -->
    <div class="title-search">
        <table width="220" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="61">
                    <h2>Search</h2>
                </td>
                <td width="159">
                    <input name="" type="text" />
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="right-area-listing">
    <div class="right-area-listing-txt">
    <table>
        <tr>
            <td valign="top">Total Restourant: <?php echo count($restaurantListArr); ?>-<?php echo count($restaurantListArr); ?> of <?php echo count($restaurantListArr); ?></td>
            <td align="right" valign="top" class="Paging">
            </td>
        </tr>
    </table>
    </div>
    <div class="prev-nxt"><a href="#">Previous</a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="#">Next</a></div>
</div>
<div class="right-area-table">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="2" valign="top">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="EventListing">
                    <tr>
                        <td colspan="4" style="background:url(images/glossyback.gif) repeat-x">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>
                                        <h4>Restaurant Logo</h4>
                                    </td>
                                    <td>
                                        <h4>Restaurant Name</h4>
                                    </td>
                                    <td>
                                        <h4>Restaurant Address</h4>
                                    </td>
                                    <td>
                                        <h4>Active / Inactive</h4>
                                    </td>
                                   
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tbody>
                        <?php
							for($i=0; $i < count($restaurantListArr); $i++) {
     						$restid     	= $restaurantListArr[$i]['rest_id'];
							$strRestName 	= $restaurantListArr[$i]['rest_name'];
							$thumb			= $restaurantListArr[$i]['rest_thumb'];
							$txtAdd1 		= $restaurantListArr[$i]['rest_address1'];
							$txtAdd2 		= $restaurantListArr[$i]['rest_address2'];
							$zip 			= $restaurantListArr[$i]['rest_zip'];
							$status 		= $restaurantListArr[$i]['status'];
							$active 	    = $restaurantListArr[$i]['active'];
							
							$strUnixDateFrom 		= strtotime($strDateFrom);
							$strUnixDateTo	 		= strtotime($strDateTo);
							$strUnixDateCur 		= time ();
							
							
							if($status) {
							switch($status) {
							case '0':
							$strStatus = "Inactive";
							break;
							case '1':
							$strStatus = "<span class=\"pink12\">Active</span>";
							break;
							}
							} else {
							$strStatus = "Inactive";
							}
							//$strThumbArr = $propertyObj->fun_getRestaurantMainThumb($restid);
							//print_r($strThumbArr);
							//if(is_array($strThumbArr)) {
							//	$strThumbUrl = PROPERTY_IMAGES_THUMB88x66_PATH.$strThumbArr[0]['photo_thumb'];
							//	$strThumbCap = $strThumbArr[0]['photo_caption'];
							//} else {
							//	$strThumbUrl = PROPERTY_IMAGES_THUMB88x66_PATH."no-image-small.gif";
							//	$strThumbCap = "No Image";
							//}
							//$strPropLocArr = $propertyObj->fun_getPropertyLocInfoArr($txtPrpertyRef);
							?>
                        <tr>
                            <td colspan="4" style="border-bottom:1px solid #fff; padding:20px 5px;">
                                <table cellpadding="0" border="0" cellspacing="0">
                                    <tr>
                                        <td width="200"><img src="images/rest_logo1.gif" alt="" /></td>
                                        <td width="160"><?php echo $strRestName; ?></td>
                                        <td width="220"><?php echo $txtAdd1; ?> <?php echo $txtAdd2; ?> <br /><?php echo $zip; ?></td>
                                        <td width="140"><?php echo $strStatus; ?></td>
                                        
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <?php
						}
						?>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</div>
<?php
} else {
?>
<div class="right-area-title">
    <div class="title">
        <h1>Restaurant Listing</h1>
    </div>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td valign="top">No Restaurant available!</td>
    </tr>
</table>
<?php
}
?>
