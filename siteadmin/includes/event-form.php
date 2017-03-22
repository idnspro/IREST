<?php
if(isset($event_id) && $event_id !=""){
$eventInfoArr 	= $eventObj->fun_getEventInfo($event_id);
?>
<h1><?php echo $addtitle;?></h1>
<form name="frmEvent" id="frmEvent" action="admin-event.php??<?php (isset($rest_id) && $rest_id !="")?"sec=edit&rest_id=".$rest_id:"sec=add" ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="securityKey" id="securityKey" value="<?php if(isset($rest_id) && $rest_id !=""){ echo md5("EDITEVENT"); } else { echo md5("ADDEVENT"); } ?>">
<input type="hidden" name="txtEventId" id="txtEventId" value="<?php echo $eventInfoArr['event_id']; ?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td colspan="2">
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
                <tr>
                    <td width="153" align="right" valign="middel">First name</td>
                    <td valign="top"><input name="txtEventOwnerFName" id="txtEventOwnerFNameId" type="text" class="inpuTxt260" value="<?php echo $eventInfoArr['event_owner_fname']; ?>" onkeydown="chkblnkTxtError('txtEventOwnerFNameId', 'txtEventOwnerFNameErrorId');" onkeyup="chkblnkTxtError('txtEventOwnerFNameId', 'txtEventOwnerFNameErrorId');" /><span class="pdError1 pad-lft10" id="txtEventOwnerFNameErrorId"></span></td>
                </tr>
                <tr>
                    <td align="right" valign="middel">Last name</td>
                    <td  valign="top"><input name="txtEventOwnerLName" id="txtEventOwnerLNameId" type="text" class="inpuTxt260" value="<?php echo $eventInfoArr['event_owner_lname']; ?>" onkeydown="chkblnkTxtError('txtEventOwnerLNameId', 'txtEventOwnerLNameErrorId');" onkeyup="chkblnkTxtError('txtEventOwnerLNameId', 'txtEventOwnerLNameErrorId');" /><span class="pdError1" id="txtEventOwnerLNameErrorId"></span></td>
                </tr>
                
                <?php /*?><tr>
                    <td align="right" valign="middel">Location</td>
                    <td  valign="top">
                    <div id="showtxtlocationcombo">
                    <?php
                        if(isset($eventInfoArr['event_area_id']) && ($eventInfoArr['event_area_id'] != "" || $eventInfoArr['event_area_id'] != "0")) {
                            $event_area_id = $eventInfoArr['event_area_id'];
                            ?>
                            <select name="txtAddEventArea" id="txtAddEventAreaId" onchange="return chkSelectArea4AddEvent();" style="display:block;" class="select216">
                                <?php 
                                    $locationObj->fun_getAreaListOptions($event_area_id, '193');
                                ?>
                            </select>
                            <?php
                            if(isset($eventInfoArr['event_region_id']) && ($eventInfoArr['event_region_id'] != "0" || $eventInfoArr['event_region_id'] != "")) {
                                $event_region_id = $eventInfoArr['event_region_id'];
                            ?>
                            <select name="txtAddEventRegion" id="txtAddEventRegionId" onchange="return chkSelectRegion4AddEvent();" style="display:block;" class="select216">
                                <option value="0">All Areas ...</option>
                                <?php 
                                    $locationObj->fun_getRegionListOptions($event_region_id, '0', $event_area_id);
                                ?>
                            </select>
                            <?php
                                if(isset($eventInfoArr['event_sub_region_id']) && ($eventInfoArr['event_sub_region_id'] != "0") && ($eventInfoArr['event_sub_region_id'] != "")) {
                                    $event_sub_region_id = $eventInfoArr['event_sub_region_id'];
                                    ?>
                                    <select name="txtAddEventSubRegion" id="txtAddEventSubRegionId" onchange="return chkSelectSubRegion4AddEvent();" style="display:block;" class="select216">
                                        <option value="0">All Areas ...</option>
                                        <?php 
                                            $locationObj->fun_getRegionListOptions($event_sub_region_id, $event_region_id, $event_area_id);
                                        ?>
                                    </select>
                                    <?php
                                } else {
                                    ?>
                                    <select name="txtAddEventSubRegion" id="txtAddEventSubRegionId" onchange="return chkSelectSubRegion4AddEvent();" style="display:<?php if(($event_region_id !="" && $event_region_id > 0) && (!isset($eventInfoArr['event_location_id']) || ($eventInfoArr['event_location_id'] == "0") || ($eventInfoArr['event_location_id'] == "")) && ($locationObj->fun_countSubRegionByRegionid($event_region_id) > 0)){echo "block";} else {echo "none";} ?>;" class="select216">
                                        <option value="0">All Areas ...</option>
                                        <?php 
                                        if(($event_region_id !="" && $event_region_id > 0) && (!isset($eventInfoArr['event_location_id']) || ($eventInfoArr['event_location_id'] == "0") || ($eventInfoArr['event_location_id'] == ""))){
                                            $locationObj->fun_getRegionListOptions('', $event_region_id, $event_area_id);
                                        }
                                        ?>
                                    </select>
                                    <?php
                                }
                                if(isset($eventInfoArr['event_location_id']) && ($eventInfoArr['event_location_id'] != "0") && ($eventInfoArr['event_location_id'] != "")) {
                                    $event_location_id = $eventInfoArr['event_location_id'];
                                    ?>
                                    <select name="txtAddEventLocation" id="txtAddEventLocationId" onchange="return chkSelectLocation4AddEvent();" style="display:block;" class="select216">
                                        <option value="0">All Areas ...</option>
                                        <?php
                                            $locationObj->fun_getLocationListOptions($event_location_id);
                                        ?>
                                    </select>
                                    <?php
                                } else {
                                    ?>
                                    <select name="txtAddEventLocation" id="txtAddEventLocationId" onchange="return chkSelectLocation4AddEvent();" style="display:<?php if(((!isset($event_sub_region_id) || ($event_sub_region_id =="0")) && ($event_region_id !="") && ($event_region_id > 0) && ($locationObj->fun_countLocationsByRegionid($event_region_id) > 0)) || (($event_sub_region_id !="") && ($event_sub_region_id > 0) && ($locationObj->fun_countLocationsByRegionid($event_sub_region_id) > 0))){echo "block";} else {echo "none";} ?>;" class="select216">
                                        <option value="0">All Areas ...</option>
                                        <?php
                                        if(($event_sub_region_id !="") && ($event_sub_region_id > 0) && ($locationObj->fun_countLocationsByRegionid($event_sub_region_id) > 0)) {
                                            $locationObj->fun_getLocationListOptions('', $event_sub_region_id);
                                        } else if(($event_region_id !="") && ($event_region_id > 0) && ($locationObj->fun_countLocationsByRegionid($event_region_id) > 0)) {
                                            $locationObj->fun_getLocationListOptions('', $event_region_id);
                                        }
                                        ?>
                                    </select>
                                    <?php
                                }
                            }
                        }
                    ?>
                    </div>
                    <span class="pdError1" id="txtAddEventLocationErrorId"></span>                                            </td>
                </tr><?php */?>
                <tr>
                    <td align="right" valign="middel">Event / listing title</td>
                    <td  valign="top"><input name="txtEventName" id="txtEventNameId" class="inpuTxt260" value="<?php if(isset($eventInfoArr['event_name']) && $eventInfoArr['event_name'] !="") { echo $eventInfoArr['event_name'];} else { echo "This will appear on search listings"; } ?>" type="text" onclick="return bnkEventTitle();" onblur="return restoreEventTitle();"  onkeydown="chkblnkTxtError('txtEventNameId', 'txtEventNameErrorId');" onkeyup="chkblnkTxtError('txtEventNameId', 'txtEventNameErrorId');" /></td>
                </tr>
                <tr>
                    <td align="right" valign="middel">Event / listing category</td>
                    <td  valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <?php
                            if(isset($eventInfoArr['event_cat_ids']) && ($eventInfoArr['event_cat_ids'] != "")) {
                                $eventCatArr = explode(",", $eventInfoArr['event_cat_ids']);
                                if(is_array($eventCatArr)) {
                                    for($i = 0; $i < count($eventCatArr); $i++) {
                                        $cat_id = $eventCatArr[$i];
                                        if($i == (count($eventCatArr)-1)) {
                                        ?>
                                            <tr id="rowAddNewEventCategoryId<?php echo $i; ?>">
                                                <td valign="top">
                                                    <select class="select250" name="txtEventCategory[]" id="txtEventCategoryId<?php echo $i; ?>" onChange="chkblnkTxtError('txtEventCategoryId<?php echo $i; ?>', 'txtEventCategoryErrorId');">
                                                        <option value="">Select...</option>
                                                        <?php echo $eventObj->fun_getEventCategoryTypeOptionsList($cat_id); ?>
                                                    </select>                                                        
                                                </td>
                                                <td valign="top" width="9"></td>
                                                <td class="pd-top1" valign="top"><span class="pdError1" id="txtEventCategoryErrorId"></span></td>
                                            </tr>
                                        <?php
                                        } else {
                                        ?>
                                            <tr id="rowAddNewEventCategoryId<?php echo $i; ?>">
                                                <td valign="top">
                                                    <select class="select250" name="txtEventCategory[]" id="txtEventCategoryId<?php echo $i; ?>" onChange="chkblnkTxtError('txtEventCategoryId<?php echo $i; ?>', 'txtEventCategoryErrorId');">
                                                        <option value="">Select...</option>
                                                        <?php echo $eventObj->fun_getEventCategoryTypeOptionsList($cat_id); ?>
                                                    </select>                                                        
                                                </td>
                                                <td valign="top" width="9"></td>
                                                <td class="pd-top1" valign="top"></td>
                                            </tr>
                                        <?php
                                        }
                                    }
                                }
                            } else {
                            ?>
                            <tr id="rowAddNewEventCategoryId0">
                                <td valign="top">
                                    <select class="select250" name="txtEventCategory[]" id="txtEventCategoryId0" onChange="chkblnkTxtError('txtEventCategoryId0', 'txtEventCategoryErrorId');">
                                        <option value="">Select...</option>
                                        <?php echo $eventObj->fun_getEventCategoryTypeOptionsList(); ?>
                                    </select>                                        
                                </td>
                                <td valign="top" width="9"></td>
                                <td class="pd-top1" valign="top"><span class="pdError1" id="txtEventCategoryErrorId"></span></td>
                            </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="3">
                                    <input type="hidden" value="0" id="theValue" />
                                    <div id="myDiv1"> </div>									
                                </td>
                            </tr>
                            <tr>
                                <td class="pad-btm15 pad-left7" colspan="3" valign="top">
                                    <a href="javascript:void(0);" onClick="addEvent1();" class="add-photo">Add another category </a> (Useful for events that fit into more than one category)														</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="right" valign="middel">Is it open all year round?</td>
                    <td  valign="top">
                        <?php 
                            if(isset($eventInfoArr['event_year_around']) && ($eventInfoArr['event_year_around'] == "1")) { 
                        ?>
                        <span><input type="radio" class="radio" name="txtYearRound" id="txtYearRoundId1" value="1" onclick="hideField('tblShwDateId');void(0);" checked="checked" /></span>
                        <span><strong>YES</strong></span>
                        <span class="pad-lft20"><input type="radio" class="radio" name="txtYearRound" id="txtYearRoundId2" value="0" onclick="showField('tblShwDateId');void(0);" /></span>
                        <span><strong>NO</strong></span>									
                        <?php
                            } else { 
                        ?>
                        <span><input type="radio" class="radio" name="txtYearRound" id="txtYearRoundId1" value="1" onclick="hideField('tblShwDateId');void(0);" /></span>
                        <span><strong>YES</strong></span>
                        <span class="pad-lft20"><input type="radio" class="radio" name="txtYearRound" id="txtYearRoundId2" value="0" onclick="showField('tblShwDateId');void(0);" checked="checked" /></span>
                        <span><strong>NO</strong></span>									
                        <?php
                            } 
                        ?>
                        <span class="pdError1" id="txtYearRoundErrorId"></span>                                            </td>
                </tr>
                <tr>
                    <td valign="top" colspan="2"  style="padding-left:30px;">
                        <table id="tblShwDateId" border="0" width="100%" cellspacing="0"  cellpadding="0"  style="display:<?php if((isset($eventInfoArr['event_year_around']) && ($eventInfoArr['event_year_around'] != "1")) || !isset($eventInfoArr['event_year_around'])) { echo "block";} else { echo "none";} ?>;">
                            <tr>
                                <td align="right" valign="middel" >Event / listing start date<span class="red">*</span></td>
                                <td  valign="top">
                                    <?php
                                        if(isset($eventInfoArr['event_start_date']) && ($eventInfoArr['event_start_date'] != "")) {
                                            $fromDateArr 		= explode("-", $eventInfoArr['event_start_date']);
                                            $txtDayFrom1 		= $fromDateArr[2];
                                            $txtMonthFrom1 		= $fromDateArr[1];
                                            $txtYearFrom1 		= $fromDateArr[0];
//											echo $txtDayFrom1."tsjkjsdkj<br>";
                                            /*
                                            foreach($monthname as $key => $value)
                                            {
                                                echo $key."<br>";
                                            }
                                            */

                                        }
                                    ?>
                                    <table border="0" cellpadding="2" cellspacing="0">
                                        <tr>
                                            <td>
                                            <select name="txtDayFrom1" id="txtDayFrom1" class="PricesDate">
                                                <option value=""> - - </option>
                                                <?
                                                foreach($dayname as $key => $value)
                                                {
                                                ?>
                                                    <option value="<?=$value?>" <? if(isset($txtDayFrom1) && ($value==$txtDayFrom1)){echo "selected";}else{echo "";}?>><?=($key+1)?></option>
                                                <?
                                                }
                                                ?>
                                            </select>															
                                            </td>
                                            <td>
                                            <select name="txtMonthFrom1" id="txtMonthFrom1" class="select60">										
                                                <option value=""> - - </option>
                                                <?
                                                foreach ($monthname as $key => $value) 
                                                {
                                                ?>
                                                    <option value="<?=$key?>" <? if(isset($txtMonthFrom1) && ($key==$txtMonthFrom1)){echo "selected";}else{echo "";}?>><?=$value?></option>
                                                <?
                                                }
                                                ?>
                                            </select>															
                                            </td>
                                            <td align="right">
                                            <select name="txtYearFrom1" id="txtYearFrom1" class="PricesDate" style="width:65px;">										
                                                <option value=""> - - </option>
                                                <?
                                                foreach ($yearname as $value) 
                                                {
                                                ?>
                                                    <option value="<?=$value?>" <? if(isset($txtYearFrom1) && ($value==$txtYearFrom1)){echo "selected";}else{echo "";}?>><?=$value?></option>
                                                <?
                                                }
                                                ?>
                                            </select>															
                                            </td>
                                            <td align="right"><a href="JavaScript:find_cal(<?php echo time()?>,'From1');"><img src="<?php echo SITE_IMAGES;?>calender.gif" alt="calendar" /></a></td>
                                        </tr>
                                    </table>
                                    <span class="pdError1" id="txtDateFromErrorId"></span>														</td>
                            </tr>
                            <tr>
                                <td align="right" valign="middel">Event / listing end date</td>
                                <td  valign="top">
                                    <?php
                                        if(isset($eventInfoArr['event_end_date']) && ($eventInfoArr['event_end_date'] != "")) {
                                            $toDateArr 		= explode("-", $eventInfoArr['event_end_date']);
                                            $txtDayTo1 		= $toDateArr[2];
                                            $txtMonthTo1 	= $toDateArr[1];
                                            $txtYearTo1 	= $toDateArr[0];
//																	echo $txtMonthTo1."tsjkjsdkj<br>";
                                            /*
                                            echo $txtMonthTo1."tsjkjsdkj<br>";
                                            foreach($monthname as $key => $value)
                                            {
                                                echo $key."<br>";
                                            }
                                            */
                                        }
                                    ?>
                                    <table border="0" cellpadding="2" cellspacing="0">
                                        <tr>
                                            <td>
                                                <select name="txtDayTo1" id="txtDayTo1" class="PricesDate">
                                                    <option value=""> - - </option>
                                                    <?
                                                    foreach($dayname as $key => $value)
                                                    {
                                                    ?>
                                                        <option value="<?=$value?>" <? if(isset($txtDayTo1) && ($value == $txtDayTo1)){echo "selected";}else{echo "";}?>><?=($key+1)?></option>
                                                    <?
                                                    }
                                                    ?>
                                                </select>															
                                            </td>
                                            <td>
                                                <select name="txtMonthTo1" id="txtMonthTo1" class="select60">										
                                                    <option value=""> - - </option>
                                                    <?
                                                    foreach ($monthname as $key => $value) 
                                                    {
                                                    ?>
                                                        <option value="<?=$key?>" <? if(isset($txtMonthTo1) && ($key==$txtMonthTo1)){echo "selected";}else{echo "";}?>><?=$value?></option>
                                                    <?
                                                    }
                                                    ?>
                                                </select>															
                                            </td>
                                            <td align="right">
                                                <select name="txtYearTo1" id="txtYearTo1" class="PricesDate" style="width:65px;">										
                                                    <option value=""> - - </option>
                                                    <?
                                                    foreach ($yearname as $value) 
                                                    {
                                                    ?>
                                                        <option value="<?=$value?>" <? if(isset($txtYearTo1) && ($value==$txtYearTo1)){echo "selected";}else{echo "";}?>><?=$value?></option>
                                                    <?
                                                    }
                                                    ?>
                                                </select>															
                                            </td>
                                            <td align="right"><a href="JavaScript:find_cal(<?php echo time()?>,'To1');"><img src="<?php echo SITE_IMAGES;?>calender.gif" alt="calendar" /></a></td>
                                        </tr>
                                    </table>
                                    <span class="pdError1" id="txtDateToErrorId"></span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="right" valign="middel">Times</td>
                    <td valign="top"><input name="txtEventTime" id="txtEventTimeId" class="inpuTxt260" value="<?php if(isset($eventInfoArr['event_time']) && $eventInfoArr['event_time'] !="") { echo $eventInfoArr['event_time'];} else { echo "eg opening times or show times"; } ?>" type="text" onclick="return bnkEventTime();" onblur="return restoreEventTime();" /></td>
                </tr>
                <tr>
                    <td align="right" valign="middel">Prices</td>
                    <td valign="top"><input name="txtEventPrice" id="txtEventPriceId" class="inpuTxt260" value="<?php if(isset($eventInfoArr['event_price']) && $eventInfoArr['event_price'] !="") { echo $eventInfoArr['event_price'];} else { echo "These will appear exactly as typed"; } ?>" type="text" onclick="return bnkEventPrice();" onblur="return restoreEventPrice();"  /></td>
                </tr>
                <tr>
                    <td align="right" valign="middel">Venue</td>
                    <td valign="top">
                        <textarea name="txtEventVenue" id="txtEventVenueId" class="textarea240"><?php echo $eventInfoArr['event_venue']; ?></textarea>
                        <span class="pdError1" id="txtEventVenueErrorId"></span>											
                    </td>
                </tr>
                <tr>
                    <td align="right" valign="middel">Phone Number</td>
                    <td  valign="top"><input name="txtEventPhone" id="txtEventPhoneId" class="inpuTxt260" value="<?php echo $eventInfoArr['event_phone']; ?>" type="text" onkeydown="chkblnkTxtError('txtEventPhoneId', 'txtEventPhoneErrorId');" onkeyup="chkblnkTxtError('txtEventPhoneId', 'txtEventPhoneErrorId');"/><span class="pdError1" id="txtEventPhoneErrorId"></span></td>
                </tr>
                <tr>
                    <td align="right" valign="middel">Email</td>
                    <td  valign="top"><input name="txtEventEmail" id="txtEventEmailId" class="inpuTxt260" value="<?php echo $eventInfoArr['event_email']; ?>" type="text" onkeydown="chkblnkTxtError('txtEventEmailId', 'txtEventEmailErrorId');" onkeyup="chkblnkTxtError('txtEventEmailId', 'txtEventEmailErrorId');" /></td>
                </tr>
                <tr>
                    <td align="right" valign="middel">Website</td>
                    <td  valign="top"><input name="txtEventWebsite" id="txtEventWebsiteId" class="inpuTxt260" value="<?php echo $eventInfoArr['event_website']; ?>" type="text" /></td>
                </tr>
                <tr>
                    <td align="right" valign="middel">Description</td>
                    <td valign="top">
                        <textarea name="txtEventDesc" id="txtEventDescId" class="textArea450" onkeydown="chkblnkTxtError('txtEventDescId', 'txtEventDescErrorId');" onkeyup="chkblnkTxtError('txtEventDescId', 'txtEventDescErrorId');" ><?php echo $eventInfoArr['event_description']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td align="right" valign="middel">Picture</td>
                    <td  valign="top" style="padding:0px;">
                        <script language="javascript" src="<?php echo SITE_JS_INCLUDES_PATH;?>si.files.js" type="text/javascript"></script>
                        <script type="text/javascript" language="javascript">
                            function uploadFile(obj, val) {
                                fileVal 		= "txtFile"+val;
                                filePhotoVal	= "txtPhoto"+val;
                                photoError		= "photoError"+val;
                                fileUrl 		= document.getElementById(fileVal).value;
                                fileUrl				= rm_trim(fileUrl);
                                if(fileUrl == ""){
                                    document.getElementById(photoError).innerHTML = "<font color='#FFFFFF' size='2'><strong>Please select a photo to upload</strong></font>";
                                    document.getElementById(filePhotoVal).focus();
                                    return false;

                                }
                                else{
                                    document.getElementById(photoError).innerHTML = "";
                                    document.getElementById("securityKey").value = "<?php echo md5('EVENTPHOTOSUPLOAD')?>";
                                    obj.enctype = "multipart/form-data";
                                    obj.submit();
                                }	
                            }        
                        
                            function showValue(val){		
                                var filePath = "txtFile"+val;
                                var file_photo = "txtPhoto"+val;
                                document.getElementById(file_photo).value = document.getElementById(filePath).value;
                            }
                        </script>
                        <style type="text/css" title="text/css">
                        .SI-FILES-STYLIZED label.cabinet{
                            width: 57px;
                            height: 23px;
                            background-image: url(images/browse.gif);
                            background-repeat: no-repeat;
                            display: block;
                            overflow: hidden;
                            cursor: pointer;
                            position: relative;
                        }
                        .SI-FILES-STYLIZED label.cabinet input.file{
                            position: relative;
                            width: auto;
                            height: 100%;
                            _display: block;
                            _float: right;
                            _height: 23px;
                            _width: 57px;
                            opacity: 0;
                            -moz-opacity: 0;
                            filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);
                        }
                        </style>
                        <table border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                            <tr>
                                <td>
                                <?php 
                                if($eventInfoArr['event_thumb'] != "") {
                                    $event_thumb 		= EVENT_IMAGES_THUMB168x127_PATH.$eventInfoArr['event_thumb'];
                                    $evntPhotoCaption	= $eventInfoArr['event_img_caption'];
                                    $evntPhotoBy		= $eventInfoArr['event_img_by'];
                                    $evntPhotoLink		= $eventInfoArr['event_img_link'];
                                } else {
                                    $event_thumb = EVENT_IMAGES_THUMB168x127_PATH."your-picture.gif";
                                    $evntPhotoCaption	= "Add caption for image ...";
                                    $evntPhotoCaption	.= "\nLeave blank if not required";
                                    $evntPhotoBy		= "Photo by";
                                    $evntPhotoLink		= "http://";
                                }
                                ?>
                                <img src="<?php echo $event_thumb; ?>" name="PreviewImage0" width="199" height="149" class="photo-add" id="PreviewImage0" />														</td>
                                <td align="left" valign="top" class="pad-right10">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td colspan="3" style="padding-top:13px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="padding-top:13px;">
                                                <div style="width: 57px; height:23px; overflow: hidden;">
                                                    <label class="cabinet">
                                                        <input type="file" name="txtFile" id="txtFile0" class="file" value="" onchange="return showValue('0');"/>
                                                    </label>
                                                </div>
                                            </td>
                                            <td style="padding-top:13px;"><input name="txtPhoto" type="text" id="txtPhoto0"  style="width:140px; height:17px; border: solid 1px #aeaeae; padding-top:2px; padding-bottom:2px; padding-left:5px;" value="" /></td>
                                            <td style="padding-top:13px;"><img src="<?php echo SITE_IMAGES;?>upload.gif" alt="upload" onclick="return uploadFile(document.frmEvent, '0');" /></td>
                                        </tr>
                                        <tr>
                                            <td style="padding-top:16px; padding-left:10px;" colspan="3">
                                                <textarea name="txtEvntPhotoCaption" id="txtEvntPhotoCaptionId" class="textArea260x60" onclick="return bnkEvntImgCaption();" onblur="return restoreEvntImgCaption();" ><?php echo $evntPhotoCaption; ?></textarea>                                                    
                                                <div style=" padding-bottom:10px;">
                                                <input name="txtEvntPhotoBy" id="txtEvntPhotoById" class="inpuTxt270" value="<?php if(isset($evntPhotoBy) && $evntPhotoBy !="") { echo $evntPhotoBy;} else { echo "Photo by"; } ?>" type="text" onclick="return bnkEvntPhotoBy();" onblur="return restoreEvntPhotoBy();"  onkeydown="chkblnkTxtError('txtEvntPhotoById', 'photoError0');" onkeyup="chkblnkTxtError('txtEvntPhotoById', 'photoError0');" />
                                                </div>
                                                <input name="txtEvntPhotoLink" id="txtEvntPhotoLinkId" class="inpuTxt270" value="<?php if(isset($evntPhotoLink) && $evntPhotoLink !="") { echo $evntPhotoLink;} else { echo "http://"; } ?>" type="text" onclick="return bnkEvntPhotoLink();" onblur="return restoreEvntPhotoLink();"  onkeydown="chkblnkTxtError('txtEvntPhotoLinkId', 'photoError0');" onkeyup="chkblnkTxtError('txtEvntPhotoLinkId', 'photoError0');" />
                                                <p style="float:left; font-size:12px; padding-top:10px;"><strong>Not happy with this picture ? Just<a href="javascript:void(0);" class="blue-link"> Browse</a> and <a href="javascript:void(0);" class="blue-link">Upload</a> again</strong></p>

                                                <script type="text/javascript" language="javascript">
                                                // <![CDATA[
                                                
                                                SI.Files.stylizeAll();
                                                
                                                /*
                                                --------------------------------
                                                Known to work in:
                                                --------------------------------
                                                - IE 5.5+
                                                - Firefox 1.5+
                                                - Safari 2+
                                                --------------------------------
                                                Known to degrade gracefully in:
                                                --------------------------------
                                                - Opera
                                                - IE 5.01
                                                --------------------------------
                                                Optional configuration:
                                                
                                                Change before making method calls.
                                                --------------------------------
                                                SI.Files.htmlClass = 'SI-FILES-STYLIZED';
                                                SI.Files.fileClass = 'file';
                                                SI.Files.wrapClass = 'cabinet';
                                                
                                                --------------------------------
                                                Alternate methods:
                                                --------------------------------
                                                SI.Files.stylizeById('input-id');
                                                SI.Files.stylize(HTMLInputNode);
                                                
                                                --------------------------------
                                                */
                                                // ]]>
                                                </script>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <table cellpadding="0" cellspacing="0" width="100%" border="0">
                                                    <tr>
                                                        <td width="240" valign="bottom"><div id="photoError0"></div></td>
                                                        <td align="right" style="padding-top:20px;">
                                                            <div id="delRow1">
                                                            <table cellpadding="0" cellspacing="0" border="0">
                                                                <tr><td>&nbsp;</td></tr>
                                                            </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="right" valign="middel">Receive newsletters</td>
                    <td  valign="top">
                        <span><input name="txtNewsLetterChk" id="txtNewsLetterChkId" type="radio" class="radio" value="1" <?php if(isset($_POST['txtNewsLetterChk']) && $_POST['txtNewsLetterChk'] == "1") {echo "checked";} ?> /></span>
                        <span class="pad-left3"><strong>YES</strong></span>
                        <span class="pad-lft20"><input name="txtNewsLetterChk" id="txtNewsLetterChkId" type="radio" class="radio" value="0" <?php if((isset($_POST['txtNewsLetterChk']) && $_POST['txtNewsLetterChk'] == "0") || (!isset($_POST['txtNewsLetterChk']))) {echo "checked";} ?> /></span>
                        <span class="pad-left3"><strong>NO</strong></span>											</td>
                </tr>
                <tr>
                    <td colspan="2" align="right" valign="top" class="header">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>Reference ID : <?php echo $eventInfoArr['event_code']; ?></td>
                                <td align="right" valign="bottom"><a href="javascript: showEventPreview(<?php echo $eventInfoArr['event_id']; ?>);" style="text-decoration:none;"><img src="<?php echo SITE_IMAGES;?>previewN.png" alt="Preview" width="71" height="21" border="0" /></a>&nbsp;<a href="admin-pending-approval.php?sec=event" style="text-decoration:none;"><img src="<?php echo SITE_IMAGES;?>cancelChangesN.png" alt="Cancel" width="119" height="21" /></a>&nbsp;<a href="javascript:void(0);" onclick="frmValidateAddEvent();" style="text-decoration:none;"><img src="<?php echo SITE_IMAGES;?>saveChangesN.png" alt="Save Approve" width="108" height="21" border="0" /></a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top">
            <div id="event-pop" class="box cursor1" style="display:none; position:relative; z-index:5; left:0px; top:0px;">
            <!--[if IE]><iframe id="iframe" frameborder="0" style="position:relative; top:-405px; left:205px; width:332px; height:200px;"></iframe><![endif]-->
            <div class="content">
            <div onMouseDown="dragStart(event, 'event-pop');" style="position:absolute; z-index:999; top:-410px; left:200px;width:350px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="right"><img src="<?php echo SITE_IMAGES;?>poplefttop.png" alt="ANP" height="10" width="10" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/poplefttop.png', sizingMethod='scale');" /></td>
                    <td class="topp"></td>
                    <td><img src="<?php echo SITE_IMAGES;?>poprighttop1.png" alt="ANP"  height="10" width="15" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/poprighttop1.png', sizingMethod='scale');"/></td>
                </tr>
                <tr>
                    <td class="leftp"></td>
                    <td align="left" valign="top" bgcolor="#FFFFFF" style="padding:6px;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="375" align="left" valign="top" class="head">Add an event</td>
                                <td width="15" align="right" valign="top"><a href="#" onclick="javascript:toggleLayer1('event-pop');"><img src="<?php echo SITE_IMAGES;?>Pop-Up-Cross.gif" alt="Close" title="Close" border="0" /></a></td>
                            </tr>
                            <tr>
                                <td  align="left" valign="top" class="PopTxt pad-top10">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="135" valign="top" class="pad-right10 pad-btm15">Type of user</td>
                                            <td valign="top" class="pad-btm15 pad-top2">
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td valign="middle" class="pad-btm10"><input name="radio" type="radio" class="radio" id="radio" value="radio" checked="checked" /></td>
                                                        <td valign="top" class="pad-left3 pad-btm10">FREE</td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="middle" class="pad-btm10"><input name="radio" type="radio" class="radio" id="radio2" value="radio" /></td>
                                                        <td valign="top" class="pad-left3 pad-btm10">Featured</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" class="pad-right10 pad-btm10">Event title</td>
                                            <td align="right" valign="top" class="pad-btm10"><input name="textfield3" type="text" class="Textfield195" id="textfield3" /></td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" class="pad-right10">Category</td>
                                            <td align="left" valign="top">
                                                <select name="select8" class="Listmenu170" id="select3">
                                                    <option>Art &amp; Culture</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pad-right10">&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td class="pad-right10">&nbsp;</td>
                                            <td align="right"><span class="pad-right10"> <a href="#" onclick="javascript:toggleLayer1('event-pop');" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image26','','images/Cancel-48x21-over.gif',1)"><img src="<?php echo SITE_IMAGES;?>Cancel-48x21-normal.gif" alt="Cancel" name="Image26" width="48" height="21" border="0" id="Image26" /></a></span><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image27','','images/add-event-over.gif',1)"><img src="<?php echo SITE_IMAGES;?>add-event-out.gif" alt="Add event" name="Image27" width="84" height="21" border="0" id="Image27" /></a></td>
                                        </tr>
                                    </table>
                                </td>
                                <td  align="left" valign="top" class="PopTxt">&nbsp;</td>
                            </tr>
                            <tr><td colspan="2" align="left" valign="top" height="8"></td></tr>
                        </table>
                    </td>
                    <td class="rightp" width="10"></td>
                </tr>
                <tr>
                    <td align="right"><img src="<?php echo SITE_IMAGES;?>popleftbtm.png" alt="ANP" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/popleftbtm.png', sizingMethod='crop');" width="10" height="10"/></td>
                    <td  class="bottomp"></td>
                    <td align="left"><img src="<?php echo SITE_IMAGES;?>poprightbtm1.png" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/poprightbtm1.png', sizingMethod='crop');" width="15" height="10" alt="ANP"/></td>
                </tr>
            </table>
            </div>
            </div>
            </div>
        </td>
    </tr>
</table>
</form>
<?php
} else {
?>
<form name="frmEvent" id="frmEvent" action="admin-event.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="securityKey" id="securityKey" value="<?php if(isset($event_id) && $event_id !=""){ echo md5("ADDEVENT"); } else { echo md5("ADDEVENT"); } ?>">
<input type="hidden" name="txtEventId" id="txtEventId" value="<?php echo $eventInfoArr['event_id']; ?>">
<fieldset>
    <legend>Add Events</legend> 
    <p><label for="event_manager_fname">First name</label><input type="text" name="event_manager_fname" id="event_manager_fname_id" value="<?php if(isset($_POST['event_manager_fname'])){echo $_POST['event_manager_fname'];}else{echo $userInfo['event_manager_fname'];}?>" onkeydown="chkblnkTxtError('event_manager_fname_id', 'event_manager_fname_errorid');" onkeyup="chkblnkTxtError('event_manager_fname_id', 'event_manager_fname_errorid');" />&nbsp;<span class="error" id="event_manager_fname_errorid"><?php if(array_key_exists('event_manager_fname_error', $form_array)) echo $form_array['event_manager_fname_error'];?></span></p>
    <p><label for="event_manager_lname">Last name</label><input type="text" name="event_manager_lname" id="event_manager_lname_id" value="<?php if(isset($_POST['event_manager_lname'])){echo $_POST['event_manager_lname'];}else{echo $userInfo['event_manager_lname'];}?>" onkeydown="chkblnkTxtError('event_manager_lname_id', 'event_manager_lname_errorid');" onkeyup="chkblnkTxtError('event_manager_lname_id', 'event_manager_lname_errorid');" />&nbsp;<span class="error" id="event_manager_lname_errorid"><?php if(array_key_exists('event_manager_lname_error', $form_array)) echo $form_array['event_manager_lname_error'];?></span></p>
    <p><label for="event_email">Email address</label><input type="text" name="event_email" id="event_email_id" value="<?php if(isset($_POST['event_email'])){echo $_POST['event_email'];}else{echo $userInfo['event_email'];}?>" onkeydown="chkblnkTxtError('event_email_id', 'event_email_errorid');" onkeyup="chkblnkTxtError('event_email_id', 'event_email_errorid');" />&nbsp;<span class="error" id="event_email_errorid"><?php if(array_key_exists('event_email_error', $form_array)) echo $form_array['event_email_error'];?></span></p>
    <p><label for="event_name">Event / listing title</label><input type="text" name="event_name" id="event_name_id" value="<?php if(isset($_POST['event_name'])){echo $_POST['event_name'];}else{echo $userInfo['event_name'];}?>" onkeydown="chkblnkTxtError('event_name_id', 'event_name_errorid');" onkeyup="chkblnkTxtError('event_name_id', 'event_name_errorid');" />&nbsp;<span class="error" id="event_name_errorid"><?php if(array_key_exists('event_name_error', $form_array)) echo $form_array['event_name_error'];?></span></p>
   <p><label>Is it open all year round?</label>
   <?php 
	  if(isset($eventInfoArr['event_year_around']) && ($eventInfoArr['event_year_around'] == "1")) { 
	?>
	<span><input type="radio" class="radio" name="txtYearRound" id="txtYearRoundId1" value="1" onclick="hideField('tblShwDateId');void(0);" checked="checked" /></span>
	<span><strong>YES</strong></span>
	<span class="pad-lft20"><input type="radio" class="radio" name="txtYearRound" id="txtYearRoundId2" value="0" onclick="showField('tblShwDateId');void(0);" /></span>
	<span><strong>NO</strong></span>									
	<?php
		} else { 
	?>
	<span><input type="radio" class="radio" name="txtYearRound" id="txtYearRoundId1" value="1" onclick="hideField('tblShwDateId');void(0);" /></span>
	<span><strong>YES</strong></span>
	<span class="pad-lft20"><input type="radio" class="radio" name="txtYearRound" id="txtYearRoundId2" value="0" onclick="showField('tblShwDateId');void(0);" checked="checked" /></span>
	<span><strong>NO</strong></span>									
	<?php
		} 
	?>
    &nbsp;<span class="error" id="event_name_errorid"><?php if(array_key_exists('event_name_error', $form_array)) echo $form_array['event_name_error'];?></span>
   </p>
   <div id="tblShwDateId" style="display:<?php if((isset($eventInfoArr['event_year_around']) && ($eventInfoArr['event_year_around'] != "1")) || !isset($eventInfoArr['event_year_around'])) { echo "block";} else { echo "none";} ?>;">
   <p><label for="event_name">Event / listing start date</label>
       <input type="text" name="arrival_date" id="arrival_date" value="" class="inpuTxt155">
       &nbsp;<span class="error" id="errorid"></span>
   </p>
   <p><label for="event_name">Event / listing end date</label>
      <input type="text" name="departure_date" id="departure_date" value="" class="inpuTxt155">
       &nbsp;<span class="error" id="errorid"></span>
   </p>       
   </div>
       <p><label for="event_time">Times</label><input type="text" name="event_time" id="event_time_id" value="<?php if(isset($_POST['event_time'])){echo $_POST['event_time'];}else{echo $userInfo['event_time'];}?>" onkeydown="chkblnkTxtError('event_time_id', 'event_time_errorid');" onkeyup="chkblnkTxtError('event_time_id', 'event_time_errorid');" />&nbsp;<span class="error" id="event_time_errorid"><?php if(array_key_exists('event_time_error', $form_array)) echo $form_array['event_time_error'];?></span></p>
       <p><label for="event_price">Prices</label><input type="text" name="	event_price" id="	event_price_id" value="<?php if(isset($_POST['event_price'])){echo $_POST['event_price'];}else{echo $userInfo['event_price'];}?>" onkeydown="chkblnkTxtError('event_price_id', 'event_price_errorid');" onkeyup="chkblnkTxtError('event_price_id', 'eevent_price_errorid');" />&nbsp;<span class="error" id="event_price_errorid"><?php if(array_key_exists('event_price_error', $form_array)) echo $form_array['event_price_error'];?></span></p>
       <p><label for="event_venue">Venue</label><input type="text" name="event_venue" id="event_venue_id" value="<?php if(isset($_POST['event_venue'])){echo $_POST['event_venue'];}else{echo $userInfo['event_venue'];}?>" onkeydown="chkblnkTxtError('event_venue_id', 'event_venue_errorid');" onkeyup="chkblnkTxtError('event_venue_id', 'event_venue_errorid');" />&nbsp;<span class="error" id="event_venue_errorid"><?php if(array_key_exists('event_venue_error', $form_array)) echo $form_array['event_venue_error'];?></span></p>

       <p><label for="event_phone">Phone Number</label><input type="text" name="event_phone" id="event_phone_id" value="<?php if(isset($_POST['event_phone'])){echo $_POST['event_phone'];}else{echo $userInfo['event_phone'];}?>" onkeydown="chkblnkTxtError('event_phone_id', 'event_phone_errorid');" onkeyup="chkblnkTxtError('event_phone_id', 'event_phone_errorid');" />&nbsp;<span class="error" id="event_phone_errorid"><?php if(array_key_exists('event_phone_error', $form_array)) echo $form_array['event_phone_error'];?></span></p>
       <p><label for="event_website">Website</label><input type="text" name="event_website" id="event_website_id" value="<?php if(isset($_POST['event_website'])){echo $_POST['event_website'];}else{echo $userInfo['event_website'];}?>" onkeydown="chkblnkTxtError('event_website_id', 'event_website_errorid');" onkeyup="chkblnkTxtError('event_website_id', 'event_website_errorid');" />&nbsp;<span class="error" id="event_website_errorid"><?php if(array_key_exists('event_website_error', $form_array)) echo $form_array['event_website_error'];?></span></p>
       <p><label for="event_description">Description</label><textarea type="text" name="event_description" id="event_description_id" value="" onkeydown="chkblnkTxtError('event_description_id', 'event_description_errorid');" onkeyup="chkblnkTxtError('event_description_id', 'event_description_errorid');" /></textarea>&nbsp;<span class="error" id="event_description_errorid"><?php if(array_key_exists('event_description_error', $form_array)) echo $form_array['event_description_error'];?></span></p>
        <p>
        <label for="rest_thumb" style="text-align:center;">
        <img src="<?php echo RESTAURANT_IMAGES_LOGO_PATH.$restInfo['rest_thumb'];?>" border="0" width="145px" height="100px" onError="this.src='<?php echo RESTAURANT_IMAGES_LOGO_PATH;?>no-img.gif';" /><br />
        </label>
        <input type="file" name="rest_thumb" id="rest_thumb_id" value="" class="inpuTxt"/>&nbsp;<span class="error" id="rest_thumb_errorid"><?php if(array_key_exists('rest_thumb_error', $form_array)) echo $form_array['rest_thumb_error'];?></span>
        </p>
        <p><label>&nbsp;</label><a href="javascript:void(0);" style="text-decoration:none;"><img src="<?php echo SITE_ADMIN_IMAGES;?>upload-btn.gif" border="0" onclick="return uploadLogo();" style="padding-left:115px;" /></a></p>


            
       
</fieldset>
</form>

<?php
}
?>