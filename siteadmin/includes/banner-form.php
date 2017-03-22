<script type="text/javascript">
	$(document).ready(function(){
		$("#start_date").datepicker({ dateFormat: 'yy-mm-dd' });
	});
	$(document).ready(function(){
		$("#end_date").datepicker({ dateFormat: 'yy-mm-dd' });
	});
</script>
<script type="text/javascript" language="javascript">
	function chkblnkTxtError(strFieldId, strErrorFieldId){
		if(document.getElementById(strFieldId).value != ""){
		  document.getElementById(strErrorFieldId).innerHTML = "";
		}
	}

	function validatefrm(){
		<?php
		if($_GET['action'] =="add") {
		?>
		if(document.getElementById("banner_img_id").value == "") {
			document.getElementById("banner_img_errorid").innerHTML = "Banner image required";
			document.getElementById("banner_img_id").focus();
			return false;
		}
		<?php
		}
		?>

		if(document.getElementById("banner_title_id").value == "") {
			document.getElementById("banner_title_errorid").innerHTML = "Banner title required";
			document.getElementById("banner_title_id").focus();
			return false;
		}
	
		if(document.getElementById("banner_desc_id").value == "") {
			document.getElementById("banner_desc_errorid").innerHTML = "Banner Description required";
			document.getElementById("banner_desc_id").focus();
			return false;
		}
	
		/*
		if(document.getElementById("start_date_id").value == "") {
			document.getElementById("start_date_errorid").innerHTML = "SEO title required";
			document.getElementById("start_date_id").focus();
			return false;
		}
	
		if(document.getElementById("end_date_id").value == "") {
			document.getElementById("end_date_errorid").innerHTML = "SEO keyword required";
			document.getElementById("end_date_id").focus();
			return false;
		}
		*/
	
		if(document.getElementById("banner_link_id").value == "") {
			document.getElementById("banner_link_errorid").innerHTML = "Banner link required";
			document.getElementById("banner_link_id").focus();
			return false;
		}
		document.frmBanner.submit();
	}
</script>
<?php
if(isset($banner_id) && $banner_id !=""){
	$bannerInfo 	= $bannerObj->fun_getBannerInfo($banner_id);
	$banner_type 	= $bannerInfo['banner_type'];
	?>
    <form name="frmBanner" id="frmBanner" method="post" action="admin-settings.php?sec=banner&action=edit&banner_id=<?php echo $banner_id;?>" enctype="multipart/form-data">
        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITPBANNER"); ?>">
        <input type="hidden" name="banner_id" id="banner_id_id" value="<?php echo $banner_id; ?>">
        <fieldset>
        <legend><?php echo $addtitle; ?></legend>
            <div class="floatRight pad-top5 pad-btm5" align="right">
                <a href="admin-settings.php?sec=banner" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
            </div>
            <p>
                <label for="banner_pid">Banner Image</label>
                <input type="file" name="banner_img" id="banner_img_id" style="width:200px; height:30px;">
                <?php if(isset($bannerInfo['banner_img']) && $bannerInfo['banner_img'] != ''){?>
                <br /><br />
                <img src="<?php echo SITE_URL."upload/banners-logos/banners/".$bannerInfo['banner_img'];?>" border="0" width="200px">
                <?php }?>
            </p>
            <p>
                <label for="banner_title">Banner Title</label>
                <input type="text" name="banner_title" id="banner_title_id" value="<?php if(isset($_POST['banner_title'])){echo $_POST['banner_title'];}else{echo $bannerInfo['banner_title'];}?>" onkeydown="chkblnkTxtError('banner_title_id', 'banner_title_errorid');" onkeyup="chkblnkTxtError('banner_title_id', 'banner_title_errorid');" />
                &nbsp;<span class="error" id="banner_title_errorid"><?php if(array_key_exists('banner_title_error', $form_array)) echo $form_array['banner_title_error'];?> </span>
            </p>
            <p>
                <label for="banner_type">Banner Type</label>
                <select name="banner_type" id="banner_type" style="display:block;" class="select216">
                    <?php /*?>
                    <option value="1" <?php if($bannerInfo['banner_type'] == "1") { echo " selected=\"selected\"";} ?>>Home Promo Panel</option>
                    <option value="2" <?php if($bannerInfo['banner_type'] == "2") { echo " selected=\"selected\"";} ?>>Leaderboard (728 x 90)</option>
                    <option value="3" <?php if($bannerInfo['banner_type'] == "3") { echo " selected=\"selected\"";} ?>>Banner (468 x 60)</option>
                    <option value="4" <?php if($bannerInfo['banner_type'] == "4") { echo " selected=\"selected\"";} ?>>Half Banner (234x60)</option>
                    <option value="5" <?php if($bannerInfo['banner_type'] == "5") { echo " selected=\"selected\"";} ?>>Button (125x125)</option>
                    <option value="6" <?php if($bannerInfo['banner_type'] == "6") { echo " selected=\"selected\"";} ?>>Skyscraper (120x600)</option>
                    <option value="7" <?php if($bannerInfo['banner_type'] == "7") { echo " selected=\"selected\"";} ?>>Wide Skyscraper (160x600)</option>
                    <option value="8" <?php if($bannerInfo['banner_type'] == "8") { echo " selected=\"selected\"";} ?>>Small Rectangle (180x150)</option>
                    <option value="9" <?php if($bannerInfo['banner_type'] == "9") { echo " selected=\"selected\"";} ?>>Vertical Banner (120 x 240)</option>
                    <?php */?>
                    <option value="10" <?php if($bannerInfo['banner_type'] == "10") { echo " selected=\"selected\"";} ?>>Small Square (200 x 200)</option>
                    <?php /*?>
                    <option value="11" <?php if($bannerInfo['banner_type'] == "11") { echo " selected=\"selected\"";} ?>>Square (250 x 250)</option>
                    <option value="12" <?php if($bannerInfo['banner_type'] == "12") { echo " selected=\"selected\"";} ?>>Medium Rectangle (300 x 250)</option>
                    <option value="13" <?php if($bannerInfo['banner_type'] == "13") { echo " selected=\"selected\"";} ?>>Large Rectangle (336 x 280)</option>
                    <?php */?>
                </select>
            </p>
            <p>
                <label for="banner_title">Banner Description</label>
                <textarea name="banner_desc" id="banner_desc_id" style="width:305px; height:90x;" ><?php if(isset($_POST['banner_desc'])){echo $_POST['banner_desc'];}else{echo $bannerInfo['banner_desc'];}?></textarea>
                &nbsp;<span class="error" id="banner_desc_errorid"><?php if(array_key_exists('banner_desc_error', $form_array)) echo $form_array['banner_desc_error'];?></span>
            </p>
            <p>
                <label for="banner_link">Banner Link</label>
                <input type="text" name="banner_link" id="banner_link_id" value="<?php if(isset($_POST['banner_link'])){echo $_POST['banner_link'];}else{echo $bannerInfo['banner_link'];}?>" />
                &nbsp;<span class="error" id="banner_link_errorid"><?php if(array_key_exists('banner_link_error', $form_array)) echo $form_array['banner_link_error'];?> </span>
            </p>
            <p>
                <label for="start_date">Start Date</label>
                <input type="text" name="start_date" id="start_date" class="inpuTxt510" placeholder="yyyy-mm-dd" value="<?php if(isset($_POST['start_date'])){echo $_POST['start_date'];}else{echo $bannerInfo['start_date'];}?>" style="width:200px;"/>
            </p>
            <p>
                <label for="end_date">End Date</label>
                <input type="text" name="end_date" id="end_date" class="inpuTxt510" placeholder="yyyy-mm-dd" value="<?php if(isset($_POST['end_date'])){echo $_POST['end_date'];}else{echo $bannerInfo['end_date'];}?>" style="width:200px;"/>
            </p>
            <p style="clear:both; height:10px;">&nbsp;</p>
            <p>
                <label>&nbsp;</label>
                <a href="javascript:void(0);" onclick="return validatefrm();" class="button-red">Edit Now</a>
            </p>
        </fieldset>
    </form>
<?php
} else {
?>
    <form name="frmBanner" id="frmBanner" method="post" action="admin-settings.php?sec=banner&action=add" enctype="multipart/form-data">
        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("ADDBANNER"); ?>">
        <fieldset>
        <legend><?php echo $addtitle; ?></legend>
            <div class="floatRight pad-top5 pad-btm5" align="right">
                <a href="admin-settings.php?sec=banner" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
            </div>
            <p>
                <label for="banner_pid">Banner Image</label>
                <input type="file" name="banner_img" id="banner_img_id" style="width:200px; height:30px;">
            </p>
            <p>
                <label for="banner_title">Banner Title</label>
                <input type="text" name="banner_title" id="banner_title_id" value="<?php if(isset($_POST['banner_title'])){echo $_POST['banner_title'];}?>" onkeydown="chkblnkTxtError('banner_title_id', 'banner_title_errorid');" onkeyup="chkblnkTxtError('banner_title_id', 'banner_title_errorid');" />
                &nbsp;<span class="error" id="banner_title_errorid"><?php if(array_key_exists('banner_title_error', $form_array)) echo $form_array['banner_title_error'];?> </span>
            </p>
            <p>
                <label for="banner_type">Banner Type</label>
                <select name="banner_type" id="banner_type" style="display:block;" class="select216">
                    <?php /*?>
                    <option value="1" <?php if($bannerInfo['banner_type'] == "1") { echo " selected=\"selected\"";} ?>>Home Promo Panel</option>
                    <option value="2">Leaderboard (728 x 90)</option>
                    <option value="3">Banner (468 x 60)</option>
                    <option value="4">Half Banner (234x60)</option>
                    <option value="5">Button (125x125)</option>
                    <option value="6">Skyscraper (120x600)</option>
                    <option value="7">Wide Skyscraper (160x600)</option>
                    <option value="8">Small Rectangle (180x150)</option>
                    <option value="9">Vertical Banner (120 x 240)</option>
                    <?php */?>
                    <option value="10">Small Square (200 x 200)</option>
                    <?php /*?>
                    <option value="11">Square (250 x 250)</option>
                    <option value="12">Medium Rectangle (300 x 250)</option>
                    <option value="13">Large Rectangle (336 x 280)</option>
                    <?php */?>
                </select>
            </p>
            <p>
                <label for="banner_title">Banner Description</label>
                <textarea name="banner_desc" id="banner_desc_id" style="width:305px; height:90x;" ><?php if(isset($_POST['banner_desc'])){echo $_POST['banner_desc'];}?></textarea>
                &nbsp;<span class="error" id="banner_desc_errorid"><?php if(array_key_exists('banner_desc_error', $form_array)) echo $form_array['banner_desc_error'];?></span>
            </p>
            <p>
                <label for="banner_link">Banner Link</label>
                <input type="text" name="banner_link" id="banner_link_id" value="<?php if(isset($_POST['banner_link'])){echo $_POST['banner_link'];}?>" />
                &nbsp;<span class="error" id="banner_link_errorid"><?php if(array_key_exists('banner_link_error', $form_array)) echo $form_array['banner_link_error'];?> </span>
            </p>
            <p>
                <label for="start_date">Start Date</label>
                <input type="text" name="start_date" id="start_date" class="inpuTxt510" placeholder="yyyy-mm-dd" value="<?php if(isset($_POST['start_date'])){echo $_POST['start_date'];}?>" style="width:200px;"/>
            </p>
            <p>
                <label for="end_date">End Date</label>
                <input type="text" name="end_date" id="end_date" class="inpuTxt510" placeholder="yyyy-mm-dd" value="<?php if(isset($_POST['end_date'])){echo $_POST['end_date'];}?>" style="width:200px;"/>
            </p>
            <p style="clear:both; height:10px;">&nbsp;</p>
            <p>
                <label>&nbsp;</label>
                <a href="javascript:void(0);" onclick="return validatefrm();" class="button-red">Add Now</a>
            </p>
        </fieldset>
    </form>
<?php
}
?>
