<?php
$rest_id 			= $_REQUEST['rest_id'];
$rest_name 			= $restObj->fun_getRestaurantNameById($rest_id);
$restMenuPDFArr 	= $restObj->fun_getRestMenuPDF($rest_id);
?>
<script type="text/javascript" language="javascript">
	var req = ajaxFunction();
	function uploadPDF() {
		//document.getElementById("securityKey").value = '<?php echo md5("UPLOADRESTAURANTMENUPHOTOS"); ?>';
		if(document.getElementById("pdf_caption_id").value == "" || document.getElementById("pdf_caption_id").value == "Caption...") {
			document.getElementById("pdf_thumb_errorid").innerHTML = "Caption required";
			document.getElementById("pdf_caption_id").focus();
			return false;
		}

		document.frmMenu.submit();
	}

	function delRestPDF(id) {
		var r = confirm("Are you sure? You want to delete this menu pdf.");
		if(r == true) {
			req.onreadystatechange = handleDeleteResponse;
			req.open('get', 'includes/ajax/admin-restmenupdfdeleteXml.php?pdf_id='+id); 
			req.send(null);   
		} else {
			return false;
		}
	}

	function handleDeleteResponse(){
		if(req.readyState == 4){
			var response = req.responseText;
			xmlDoc = req.responseXML;
			var root = xmlDoc.getElementsByTagName('pdfs')[0];
			if(root != null){
				var items = root.getElementsByTagName("pdf");
				for (var i = 0 ; i < items.length ; i++){
					var item = items[i];
					var pdfstatus = item.getElementsByTagName("pdfstatus")[0].firstChild.nodeValue;
					if(pdfstatus == "pdf deleted."){
						window.location = location.href;
					}
				}
			}
		}
	}
</script>
<div class="floatRight pad-top5 pad-btm5" align="right">
    <a href="admin-restaurant-menu.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Back to Menu List</a>&nbsp;
</div>

<form name="frmMenu" id="frmMenu" method="post" action="admin-restaurant-menu.php?sec=pdf" enctype="multipart/form-data">
<input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("UPLOADRESTAURANTMENUPDF"); ?>" />
<input type="hidden" name="rest_id" id="rest_id_id" value="<?php echo $rest_id; ?>">
<input type="hidden" name="back_url" id="back_url" value="<?php echo $_GET['back_url']; ?>">
<fieldset>
    <legend>Add/Edit menu pdf</legend>
        <?php
        if(is_array($restMenuPDFArr) && count($restMenuPDFArr) > 0) {
			echo '<div class="pic-galery">';
            echo '<ul>';
            for($i=0; $i < count($restMenuPDFArr); $i++){
                $pdf_id     = $restMenuPDFArr[$i]['pdf_id'];
                $pdf_caption= $restMenuPDFArr[$i]['pdf_caption'];
                $pdf_url 	= $restMenuPDFArr[$i]['pdf_url'];
                $pdf_url 	= SITE_UPLOAD_PATH."restaurant_files/".$pdf_url;
    
                echo '<li>';
                echo '<a href="'.$pdf_url.'" target="_blank"><img src="'.SITE_IMAGES.'pdf-icon.jpg" /></a><br>';
                echo ''.$pdf_caption.'';
                echo '<p align="center"><a class="red" href="javascript:void(0);" onclick="return delRestPDF('.$pdf_id.');" >Detele</a></p>';
                echo '</li>';
             }
            echo '</ul>';
            echo '</div>';
        } else {
		?>
            <div class="pic-upload-sec">
            &nbsp;<span class="error" id="pdf_thumb_errorid"><?php if(array_key_exists('pdf_thumb_error', $form_array)) echo $form_array['pdf_thumb_error'];?></span>
            <input type="file" name="pdf_thumb" id="pdf_thumb_id" value="" class="inpuTxt" />
            <input  type="text" name="pdf_caption" id="pdf_caption_id" value="" placeholder="Caption..." class="inpuTxt" style="margin-top:20px; margin-right:10px;" />
            <a href="javascript:void(0);" style="text-decoration:none;" onclick="return uploadPDF();" class="button-red">Upload</a>
            </div>
        <?php
        }
        ?>
</fieldset>
</form>