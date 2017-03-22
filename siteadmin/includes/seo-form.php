<script type="text/javascript" language="javascript">
	function chkblnkTxtError(strFieldId, strErrorFieldId){
		if(document.getElementById(strFieldId).value != ""){
			document.getElementById(strErrorFieldId).innerHTML = "";
		}
	}

	function validatefrm(){
		if(document.getElementById("seo_url_id").value == "") {
			document.getElementById("seo_url_errorid").innerHTML = "SEO link required";
			document.getElementById("seo_url_id").focus();
			return false;
		}
		if(document.getElementById("seo_title_id").value == "") {
			document.getElementById("seo_title_errorid").innerHTML = "SEO title required";
			document.getElementById("seo_title_id").focus();
			return false;
		}
		if(document.getElementById("seo_keywords_id").value == "") {
			document.getElementById("seo_keywords_errorid").innerHTML = "SEO keywords required";
			document.getElementById("seo_keywords_id").focus();
			return false;
		}

		if(document.getElementById("seo_description_id").value == "") {
			document.getElementById("seo_description_errorid").innerHTML = "SEO description required";
			document.getElementById("seo_description_id").focus();
			return false;
		}
		document.frmSEO.submit();
	}
</script>
<?php
if(isset($seo_id) && $seo_id !=""){
	$seoInfo 	= $seoObj->fun_getSeoInfo($seo_id);
	?>
    <form name="frmSEO" id="frmSEO" method="post" action="admin-settings.php?sec=seo&action=edit&seo_id=<?php echo $seo_id;?>">
        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITSEO"); ?>">
        <input type="hidden" name="seo_id" id="seo_id_id" value="<?php echo $seo_id; ?>">
        <fieldset>
        <legend>Edit SEO</legend>
        <div class="floatRight pad-top5 pad-btm5" align="right">
            <a href="admin-settings.php?sec=seo" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
        </div>
        <p>
            <label for="seo_url">Url</label>
            <input type="text" name="seo_url" id="seo_url_id" value="<?php if(isset($_POST['seo_url'])){echo $_POST['seo_url'];} else if(isset($seoInfo['seo_url'])){echo $seoInfo['seo_url'];}?>" onkeydown="chkblnkTxtError('seo_url_id', 'seo_url_errorid');" onkeyup="chkblnkTxtError('seo_url_id', 'seo_url_errorid');" />
            &nbsp;<span class="error" id="seo_url_errorid"><?php if(array_key_exists('seo_url_error', $form_array)) echo $form_array['seo_url_error'];?> </span>
        </p>
        <p>
            <label for="seo_title">Title</label>
            <input type="text" name="seo_title" id="seo_title_id" value="<?php if(isset($_POST['seo_title'])){echo $_POST['seo_title'];} else if(isset($seoInfo['seo_title'])){echo $seoInfo['seo_title'];}?>" onkeydown="chkblnkTxtError('seo_title_id', 'seo_title_errorid');" onkeyup="chkblnkTxtError('seo_title_id', 'seo_title_errorid');" />
            &nbsp;<span class="error" id="seo_title_errorid"><?php if(array_key_exists('seo_title_error', $form_array)) echo $form_array['seo_title_error'];?> </span>
        </p>
        <p>
            <label for="seo_keywords">Keywords</label>
            <input type="text" name="seo_keywords" id="seo_keywords_id" value="<?php if(isset($_POST['seo_keywords'])){echo $_POST['seo_keywords'];} else if(isset($seoInfo['seo_keywords'])){echo $seoInfo['seo_keywords'];}?>" onkeydown="chkblnkTxtError('seo_keywords_id', 'seo_keywords_errorid');" onkeyup="chkblnkTxtError('seo_keywords_id', 'seo_keywords_errorid');" />
            &nbsp;<span class="error" id="seo_keywords_errorid"><?php if(array_key_exists('seo_keywords_error', $form_array)) echo $form_array['seo_keywords_error'];?> </span>
        </p>
        <p>
            <label for="seo_description">Description</label>
            <input type="text" name="seo_description" id="seo_description_id" value="<?php if(isset($_POST['seo_description'])){echo $_POST['seo_description'];} else if(isset($seoInfo['seo_description'])){echo $seoInfo['seo_description'];}?>" onkeydown="chkblnkTxtError('seo_description_id', 'seo_description_errorid');" onkeyup="chkblnkTxtError('seo_description_id', 'seo_description_errorid');" />
            &nbsp;<span class="error" id="seo_description_errorid"><?php if(array_key_exists('seo_description_error', $form_array)) echo $form_array['seo_description_error'];?> </span>
        </p>
        <p>&nbsp;</p>
        <p>
            <label for="active">Active</label>
            <select name="active" id="active_id" class="select216">
                <option value="0" <?php if($seoInfo['active'] == 0) {echo "selected=\"selected\"";} ?> >No</option>
                <option value="1" <?php if($seoInfo['active'] == 1) {echo "selected=\"selected\"";} ?> >Yes</option>
            </select>
            <br /><span class="error" id="active_errorid"> <?php if(array_key_exists('active_error', $form_array)) echo $form_array['active_error'];?></span>
        </p>
        <p>&nbsp;</p>
        <p>
            <label>&nbsp;</label>
            <a href="admin-settings.php?sec=seo" class="button-grey">Cancel</a>&nbsp;<a href="javascript:void(0);" onclick="return validatefrm();" class="button-red">Edit Now</a>
        </p>
        </fieldset>
    </form>
<?php
} else {
?>
    <form name="frmSEO" id="frmSEO" method="post" action="admin-settings.php?sec=seo&action=add">
        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("ADDSEO"); ?>">
        <input type="hidden" name="active" id="active" value="1">
        <fieldset>
        <legend><?php echo $addtitle; ?></legend>
        <div class="floatRight pad-top5 pad-btm5" align="right">
            <a href="admin-settings.php?sec=seo" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
        </div>
        <p>
            <label for="seo_url">Url</label>
            <input type="text" name="seo_url" id="seo_url_id" value="<?php if(isset($_POST['seo_url'])){echo $_POST['seo_url'];}?>" onkeydown="chkblnkTxtError('seo_url_id', 'seo_url_errorid');" onkeyup="chkblnkTxtError('seo_url_id', 'seo_url_errorid');" />
            &nbsp;<span class="error" id="seo_url_errorid"><?php if(array_key_exists('seo_url_error', $form_array)) echo $form_array['seo_url_error'];?> </span>
        </p>
        <p>
            <label for="seo_title">Title</label>
            <input type="text" name="seo_title" id="seo_title_id" value="<?php if(isset($_POST['seo_title'])){echo $_POST['seo_title'];}?>" onkeydown="chkblnkTxtError('seo_title_id', 'seo_title_errorid');" onkeyup="chkblnkTxtError('seo_title_id', 'seo_title_errorid');" />
            &nbsp;<span class="error" id="seo_title_errorid"><?php if(array_key_exists('seo_title_error', $form_array)) echo $form_array['seo_title_error'];?> </span>
        </p>
        <p>
            <label for="seo_keywords">Keywords</label>
            <input type="text" name="seo_keywords" id="seo_keywords_id" value="<?php if(isset($_POST['seo_keywords'])){echo $_POST['seo_keywords'];}?>" onkeydown="chkblnkTxtError('seo_keywords_id', 'seo_keywords_errorid');" onkeyup="chkblnkTxtError('seo_keywords_id', 'seo_keywords_errorid');" />
            &nbsp;<span class="error" id="seo_keywords_errorid"><?php if(array_key_exists('seo_keywords_error', $form_array)) echo $form_array['seo_keywords_error'];?> </span>
        </p>
        <p>
            <label for="seo_description">Description</label>
            <input type="text" name="seo_description" id="seo_description_id" value="<?php if(isset($_POST['seo_description'])){echo $_POST['seo_description'];}?>" onkeydown="chkblnkTxtError('seo_description_id', 'seo_description_errorid');" onkeyup="chkblnkTxtError('seo_description_id', 'seo_description_errorid');" />
            &nbsp;<span class="error" id="seo_description_errorid"><?php if(array_key_exists('seo_description_error', $form_array)) echo $form_array['seo_description_error'];?> </span>
        </p>
        <p>&nbsp;</p>
        <p>
            <label>&nbsp;</label>
            <a href="javascript:void(0);" onclick="return validatefrm();" class="button-red">Add Now</a>
        </p>
        </fieldset>
    </form>
<?php
}
?>