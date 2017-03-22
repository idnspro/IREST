<script type="text/javascript" language="javascript">
function chkblnkTxtError(strFieldId, strErrorFieldId){
	if(document.getElementById(strFieldId).value != ""){
	  document.getElementById(strErrorFieldId).innerHTML = "";
	}
}

function validatefrm(){
	var alreadyFocussed = false;
	document.frmPage.page_discription_id.value = tinyMCE.get('page_discription_id').getContent();

	if(document.getElementById("page_title_id").value == "") {
		document.getElementById("page_title_errorid").innerHTML = "Page title required";
		document.getElementById("page_title_id").focus();
		return false;
	}

	if(document.getElementById("page_content_title_id").value == "") {
		document.getElementById("page_content_title_errorid").innerHTML = "Page content title required";
		document.getElementById("page_content_title_id").focus();
		return false;
	}


	if(document.getElementById("page_seo_title_id").value == "") {
		document.getElementById("page_seo_title_errorid").innerHTML = "SEO title required";
		document.getElementById("page_seo_title_id").focus();
		return false;
	}

	if(document.getElementById("page_seo_keyword_id").value == "") {
		document.getElementById("page_seo_keyword_errorid").innerHTML = "SEO keyword required";
		document.getElementById("page_seo_keyword_id").focus();
		return false;
	}

	if(document.getElementById("page_seo_discription_id").value == "") {
		document.getElementById("page_seo_discription_errorid").innerHTML = "SEO discription required";
		document.getElementById("page_seo_discription_id").focus();
		return false;
	}

	if(document.frmPage.page_discription_id.value == "") {
		document.getElementById("page_discription_errorid").innerHTML = "Page description required";
		document.getElementById("page_discription_id").focus();
		if(!alreadyFocussed){
			document.frmPage.page_discription_id.focus();
			alreadyFocussed = true;
		}
		return false;
	}

	document.frmPage.submit();
}
</script>
<!-- TinyMCE -->
<script type="text/javascript" src="../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
    tinyMCE.init({
        mode : "exact",
        elements : "page_discription_id",
        theme : "advanced",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        
    });

    function myHandleEvent(e){
        if(e.type=="keyup"){
            chkblnkEditorTxtError("page_discription_id", "page_discription_errorid");	
        }
        return true;
    }
</script>
<!-- /TinyMCE -->
<?php
if(isset($page_id) && $page_id !=""){
	$pageInfo 	    = $cmsObj->fun_getPageInfo($page_id);
	$page_type 		= $pageInfo['page_type'];
	?>
    <form name="frmPage" id="frmPage" method="post" action="admin-content.php?sec=edit&page_id=<?php echo $page_id;?>" enctype="multipart/form-data">
        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITPAGE"); ?>">
        <input type="hidden" name="page_id" id="page_id" value="<?php echo $page_id; ?>">
        <input type="hidden" name="page_type" id="page_type" value="<?php echo $page_type; ?>">
        <fieldset>
        <legend>Edit Page</legend>
            <p><label for="page_title">Page Title</label><input type="text" name="page_title" id="page_title_id" value="<?php if(isset($_POST['page_title'])){echo $_POST['page_title'];}else{echo $pageInfo['page_title'];}?>" onkeydown="chkblnkTxtError('page_title_id', 'page_title_errorid');" onkeyup="chkblnkTxtError('page_title_id', 'page_title_errorid');" />&nbsp;<span class="error" id="page_title_errorid"><?php if(array_key_exists('page_title_error', $form_array)) echo $form_array['page_title_error'];?> </span></p>
            <p><label for="page_content_title">Page Content Title</label><input type="text" name="page_content_title" id="page_content_title_id" value="<?php if(isset($_POST['page_content_title'])){echo $_POST['page_content_title'];}else{echo $pageInfo['page_content_title'];}?>" onkeydown="chkblnkTxtError('page_content_title_id', 'page_content_title_errorid');" onkeyup="chkblnkTxtError('page_content_title_id', 'page_content_title_errorid');" />&nbsp;<span class="error" id="page_content_title_errorid"><?php if(array_key_exists('page_content_title_error', $form_array)) echo $form_array['page_content_title_error'];?> </span></p>
            <p><label for="page_seo_title">SEO Title</label><input type="text" name="page_seo_title" id="page_seo_title_id" value="<?php if(isset($_POST['page_seo_title'])){echo $_POST['page_seo_title'];}else{echo $pageInfo['page_seo_title'];}?>" onkeydown="chkblnkTxtError('page_seo_title_id', 'page_seo_title_errorid');" onkeyup="chkblnkTxtError('page_seo_title_id', 'page_seo_title_errorid');" />&nbsp;<span class="error" id="page_seo_title_errorid"><?php if(array_key_exists('page_seo_title_error', $form_array)) echo $form_array['page_seo_title_error'];?> </span></p>
            <p><label for="page_seo_keyword">SEO Keyword</label><input type="text" name="page_seo_keyword" id="page_seo_keyword_id" value="<?php if(isset($_POST['page_seo_keyword'])){echo $_POST['page_seo_keyword'];}else{echo $pageInfo['page_seo_keyword'];}?>" onkeydown="chkblnkTxtError('page_seo_keyword_id', 'page_seo_keyword_errorid');" onkeyup="chkblnkTxtError('page_seo_keyword_id', 'page_seo_keyword_errorid');" />&nbsp;<span class="error" id="page_seo_keyword_errorid"><?php if(array_key_exists('page_seo_keyword_error', $form_array)) echo $form_array['page_seo_keyword_error'];?> </span></p>
            <p><label for="page_seo_discription">SEO Description</label><input type="text" name="page_seo_discription" id="page_seo_discription_id" value="<?php if(isset($_POST['page_seo_discription'])){echo $_POST['page_seo_discription'];}else{echo $pageInfo['page_seo_discription'];}?>" onkeydown="chkblnkTxtError('page_seo_discription_id', 'page_seo_discription_errorid');" onkeyup="chkblnkTxtError('page_seo_discription_id', 'page_seo_discription_errorid');" />&nbsp;<span class="error" id="page_seo_discription_errorid"><?php if(array_key_exists('page_seo_discription_error', $form_array)) echo $form_array['page_seo_discription_error'];?> </span></p>
            <p>&nbsp;</p>
            <p><label for="page_discription">Page Discription</label><textarea type="text" name="page_discription" id="page_discription_id" onkeydown="chkblnkTxtError('page_discription_id', 'page_discription_errorid');" onkeyup="chkblnkTxtError('page_discription_id', 'page_discription_errorid');" class="txtarea_540x300" /><?php if(isset($_POST['page_discription'])){echo $_POST['page_discription'];}else{echo $pageInfo['page_discription'];}?></textarea> <br /><span class="error" id="page_discription_errorid"> <?php if(array_key_exists('page_discription_error', $form_array)) echo $form_array['page_discription_error'];?></span></p>
            <p><label>&nbsp;</label> <a href="javascript:void(0);" style="text-decoration:none;"><img src="<?php echo SITE_ADMIN_IMAGES;?>edit_btn.gif" border="0" onclick="return validatefrm();" /></a></p>
        </fieldset>
    </form>
<?php
} else {
?>
    <form name="frmPage" id="frmPage" method="post" action="admin-content.php?sec=add" enctype="multipart/form-data">
        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("ADDPAGE"); ?>">
        <input type="hidden" name="page_type" id="page_type" value="1">
        <fieldset>
        <legend>Add a New Page</legend>
            <p><label for="page_title">Page Title</label><input type="text" name="page_title" id="page_title_id" value="<?php if(isset($_POST['page_title'])){echo $_POST['page_title'];}?>" onkeydown="chkblnkTxtError('page_title_id', 'page_title_errorid');" onkeyup="chkblnkTxtError('page_title_id', 'page_title_errorid');" />&nbsp;<span class="error" id="page_title_errorid"><?php if(array_key_exists('page_title_error', $form_array)) echo $form_array['page_title_error'];?> </span></p>
            <p><label for="page_content_title">Page Content Title</label><input type="text" name="page_content_title" id="page_content_title_id" value="<?php if(isset($_POST['page_content_title'])){echo $_POST['page_content_title'];}?>" onkeydown="chkblnkTxtError('page_content_title_id', 'page_content_title_errorid');" onkeyup="chkblnkTxtError('page_content_title_id', 'page_content_title_errorid');" />&nbsp;<span class="error" id="page_content_title_errorid"><?php if(array_key_exists('page_content_title_error', $form_array)) echo $form_array['page_content_title_error'];?> </span></p>
            <p><label for="page_seo_title">SEO Title</label><input type="text" name="page_seo_title" id="page_seo_title_id" value="<?php if(isset($_POST['page_seo_title'])){echo $_POST['page_seo_title'];}?>" onkeydown="chkblnkTxtError('page_seo_title_id', 'page_seo_title_errorid');" onkeyup="chkblnkTxtError('page_seo_title_id', 'page_seo_title_errorid');" />&nbsp;<span class="error" id="page_seo_title_errorid"><?php if(array_key_exists('page_seo_title_error', $form_array)) echo $form_array['page_seo_title_error'];?> </span></p>
            <p><label for="page_seo_keyword">SEO Keyword</label><input type="text" name="page_seo_keyword" id="page_seo_keyword_id" value="<?php if(isset($_POST['page_seo_keyword'])){echo $_POST['page_seo_keyword'];}?>" onkeydown="chkblnkTxtError('page_seo_keyword_id', 'page_seo_keyword_errorid');" onkeyup="chkblnkTxtError('page_seo_keyword_id', 'page_seo_keyword_errorid');" />&nbsp;<span class="error" id="page_seo_keyword_errorid"><?php if(array_key_exists('page_seo_keyword_error', $form_array)) echo $form_array['page_seo_keyword_error'];?> </span></p>
            <p><label for="page_seo_discription">SEO Description</label><input type="text" name="page_seo_discription" id="page_seo_discription_id" value="<?php if(isset($_POST['page_seo_discription'])){echo $_POST['page_seo_discription'];}?>" onkeydown="chkblnkTxtError('page_seo_discription_id', 'page_seo_discription_errorid');" onkeyup="chkblnkTxtError('page_seo_discription_id', 'page_seo_discription_errorid');" />&nbsp;<span class="error" id="page_seo_discription_errorid"><?php if(array_key_exists('page_seo_discription_error', $form_array)) echo $form_array['page_seo_discription_error'];?> </span></p>
            <p>&nbsp;</p>
            <p><label for="page_discription">Page Discription</label><textarea type="text" name="page_discription" id="page_discription_id"  onkeydown="chkblnkTxtError('page_discription_id', 'page_discription_errorid');" onkeyup="chkblnkTxtError('page_discription_id', 'page_discription_errorid');" class="txtarea_540x300" /><?php if(isset($_POST['page_discription'])){echo $_POST['page_discription'];}?></textarea> &nbsp;<span class="error" id="page_discription_errorid"> <?php if(array_key_exists('page_discription_error', $form_array)) echo $form_array['page_discription_error'];?></span></p>
            <p><label>&nbsp;</label> <a href="javascript:void(0);" style="text-decoration:none;"><img src="<?php echo SITE_ADMIN_IMAGES;?>addnow_btn.gif" border="0" onclick="return validatefrm();" /></a></p>
        </fieldset>
    </form>
<?php
}
?>
