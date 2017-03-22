<?php
$rest_id 	= $_REQUEST['rest_id'];
$rest_name 	= $restObj->fun_getRestaurantNameById($rest_id);
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#arrival_date").datepicker({ dateFormat: 'yy-mm-dd' });
	});
	$(document).ready(function(){
		$("#departure_date").datepicker({ dateFormat: 'yy-mm-dd' });
	});
</script>

<script type="text/javascript" language="javascript">
	function chkblnkTxtError(strFieldId, strErrorFieldId){
		if(document.getElementById(strFieldId).value != ""){
			document.getElementById(strErrorFieldId).innerHTML = "";
		}
	}

	function validatefrm(){
		var alreadyFocussed = false;
		document.frmBook.instructions_id.value = tinyMCE.get('instructions_id').getContent();

		if(document.getElementById("name_id").value == "") {
			document.getElementById("name_errorid").innerHTML = " Name required";
			document.getElementById("name_id").focus();
			return false;
		}

		if(document.getElementById("email_id").value == "0") {
			document.getElementById("email_errorid").innerHTML = " email required";
			document.getElementById("email_id").focus();
			return false;
		}

		if(document.frmBook.instructions_id.value == "") {
			document.getElementById("instructions_errorid").innerHTML = "instructions required";
			document.getElementById("instructions_id").focus();
			if(!alreadyFocussed){
				document.frmBook.instructions_id.focus();
				alreadyFocussed = true;
			}
			return false;
		}
		document.frmBook.submit();
	}
</script>
<!-- TinyMCE -->
<script type="text/javascript" src="../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
    tinyMCE.init({
        mode : "exact",
        elements : "instructions_id",
        theme : "advanced",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        
    });

    function myHandleEvent(e){
        if(e.type=="keyup"){
            chkblnkEditorTxtError("instructions_id", "instructions_errorid");	
        }
        return true;
    }
</script>
<!-- /TinyMCE -->
<?php
if(isset($booking_id) && $booking_id !=""){
   $bookInfo 	= $restObj->fun_getBookInfoById($booking_id);
   //$item_id     = $restObj->fun_getMenuItemId($menu_id);
?>
<form name="frmBook" id="frmBook" method="post" action="admin-book.php?sec=edit&booking_id=<?php echo $booking_id;?>&rest_id=<?php echo $rest_id;?>" enctype="multipart/form-data">
<input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITBOOK"); ?>" />
<input type="hidden" name="rest_id" id="rest_id_id" value="<?php echo $rest_id; ?>">
<input type="hidden" name="booking_id" id="booking_id_id" value="<?php echo $booking_id; ?>">
<input type="hidden" name="active" id="active" value="1">
<input type="hidden" name="back_url" id="back_url" value="<?php echo $_GET['back_url']; ?>">
<fieldset>
<legend>Edit Booktable</legend>
    <p>
        <label for="arrival_date">Start Date</label>
        <input type="text" name="arrival_date" id="arrival_date" class="inpuTxt510" placeholder="yyyy-mm-dd" value="<?php if(isset($_POST['arrival_date'])){echo $_POST['arrival_date'];}else{echo $bookInfo['arrival_date'];}?>" style="width:200px;"/>
    </p>
    <p>
        <label for="departure_date">End Date</label>
        <input type="text" name="departure_date" id="departure_date" class="inpuTxt510" placeholder="yyyy-mm-dd" value="<?php if(isset($_POST['departure_date'])){echo $_POST['departure_date'];}else{echo $bookInfo['departure_date'];}?>" style="width:200px;"/>
    </p>
    <p>
    	<label for="name">Name</label>
        <input type="text" name="name" id="name_id" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}else{echo $bookInfo['name'];}?>" onkeydown="chkblnkTxtError('name_id', 'name_errorid');" onkeyup="chkblnkTxtError('name_id', 'name_errorid');" />&nbsp;
        <span class="error" id="name_errorid"><?php if(array_key_exists('name_error', $form_array)) echo $form_array['name_error'];?></span>
    </p>
            <p>
                <label for="schedule">Schedule for</label>
                <input type="text" name="schedule" id="schedule_id" value="<?php if(isset($_POST['schedule'])){echo $_POST['schedule'];}else{echo $bookInfo['schedule'];}?>"onkeydown="chkblnkTxtError('schedule_id', 'schedule_errorid');" onkeyup="chkblnkTxtError('schedule_id', 'schedule_errorid');"  />
                &nbsp;<span class="error" id="schedule_errorid"><?php if(array_key_exists('schedule_error', $form_array)) echo $form_array['schedule_error'];?> </span>
            </p>
    <p>
    	<label for="name">Email</label>
        <input type="text" name="email" id="email_id" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}else{echo $bookInfo['email'];}?>" onkeydown="chkblnkTxtError('email_id', 'email_errorid');" onkeyup="chkblnkTxtError('email_id', 'email_errorid');" />&nbsp;
        <span class="error" id="email_errorid"><?php if(array_key_exists('email_error', $form_array)) echo $form_array['email_error'];?></span>
    </p>
    <p>&nbsp;</p>
    
    <p>
    	<label for="amount">Amount</label>
        <input type="text" name="total_amount" id="amount_id" value="<?php if(isset($_POST['total_amount'])){echo $_POST['total_amount'];}else{echo $bookInfo['total_amount'];}?>" onkeydown="chkblnkTxtError('total_amount_id', 'total_amount_errorid');" onkeyup="chkblnkTxtError('total_amount_id', 'total_amount_errorid');" />&nbsp;
        <span class="error" id="total_amount_errorid"><?php if(array_key_exists('total_amount_error', $form_array)) echo $form_array['total_amount_error'];?></span>
    </p>
    <p>&nbsp;</p>
    
    <p>
    	<label for="instructions">Instructions</label>
        <input type="text" name="instructions" id="instructions_id" value="<?php if(isset($_POST['instructions'])){echo $_POST['instructions'];}else{echo $bookInfo['instructions'];}?>" onkeydown="chkblnkTxtError('instructions_id', 'instructions_errorid');" onkeyup="chkblnkTxtError('instructions_id', 'instructions_errorid');" />&nbsp;
        <span class="error" id="instructions_errorid"><?php if(array_key_exists('instructions_error', $form_array)) echo $form_array['instructions_error'];?></span>
    </p>
    <p>
        <label>&nbsp;</label>
        <a href="<?php echo "admin-book.php?rest_id=1&back_url=".$_GET['back_url']; ?>" class="button85x30-grey">Cancel</a>&nbsp;<a href="javascript:void(0);" onclick="return validatefrm();" class="button85x30-red">Edit Now</a>
    </p>
</fieldset>
</form>
<?php
} else {
?>
<div class="floatRight pad-top5 pad-btm5" align="right">
    <a href="admin-book.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Back to Book List</a>&nbsp;
</div>
<form name="frmBook" id="frmBook" method="post" action="admin-book.php?sec=add" enctype="multipart/form-data">
<input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("ADDBOOK"); ?>" />
<input type="hidden" name="rest_id" id="rest_id_id" value="<?php echo $rest_id; ?>">
<input type="hidden" name="active" id="active" value="1">
<input type="hidden" name="back_url" id="back_url" value="<?php echo $_GET['back_url']; ?>">
<fieldset>
<legend>Add Book Table</legend>
    <p>
        <label for="arrival_date">Start Date</label>
        <input type="text" name="arrival_date" id="arrival_date" class="inpuTxt510" placeholder="yyyy-mm-dd" value="<?php if(isset($_POST['arrival_date'])){echo $_POST['arrival_date'];}else{echo $bookInfo['arrival_date'];}?>" style="width:200px;"/>
    </p>
    <p>
        <label for="departure_date">End Date</label>
        <input type="text" name="departure_date" id="departure_date" class="inpuTxt510" placeholder="yyyy-mm-dd" value="<?php if(isset($_POST['departure_date'])){echo $_POST['departure_date'];}else{echo $bookInfo['departure_date'];}?>" style="width:200px;"/>
    </p>
    <p>
    	<label for="name">Name</label>
        <input type="text" name="name" id="name_id" placeholder="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}else{echo $bookInfo['name'];}?>">&nbsp;
        <span class="error" id="name_errorid"><?php if(array_key_exists('name_error', $form_array)) echo $form_array['name_error'];?></span>
    </p>
            <p>
                <label for="schedule">Schedule for</label>
                <input type="text" name="schedule" id="schedule_id" placeholder="timing" value="<?php if(isset($_POST['schedule'])){echo $_POST['schedule'];}else{echo $bookInfo['schedule'];}?>"onkeydown="chkblnkTxtError('schedule_id', 'schedule_errorid');" onkeyup="chkblnkTxtError('schedule_id', 'schedule_errorid');"  />
                &nbsp;<span class="error" id="schedule_errorid"><?php if(array_key_exists('schedule_error', $form_array)) echo $form_array['schedule_error'];?> </span>
            </p>
    <p>
    	<label for="name">Email</label>
        <input type="text" name="email" id="email_id" placeholder="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}else{echo $bookInfo['email'];}?>" onkeydown="chkblnkTxtError('email_id', 'email_errorid');" onkeyup="chkblnkTxtError('email_id', 'email_errorid');" />&nbsp;
        <span class="error" id="email_errorid"><?php if(array_key_exists('email_error', $form_array)) echo $form_array['email_error'];?></span>
    </p>
    <p>&nbsp;</p>
 <p>
    	<label for="amount">Total Amount</label>
        <input type="text" name="total_amount" id="amount_id" placeholder="amount" value="<?php if(isset($_POST['total_amount'])){echo $_POST['total_amount'];}else{echo $bookInfo['total_amount'];}?>" onkeydown="chkblnkTxtError('total_amount_id', 'total_amount_errorid');" onkeyup="chkblnkTxtError('total_amount_id', 'total_amount_errorid');" />&nbsp;
        <span class="error" id="total_amount_errorid"><?php if(array_key_exists('total_amount_error', $form_array)) echo $form_array['total_amount_error'];?></span>
    </p>
    <p>&nbsp;</p>

    <p>
    	<label for="instructions">Instructions</label>
        <input type="text" name="instructions" id="instructions_id"  value="<?php if(isset($_POST['instructions'])){echo $_POST['instructions'];}else{echo $bookInfo['instructions'];}?>" onkeydown="chkblnkTxtError('instructions_id', 'instructions_errorid');" onkeyup="chkblnkTxtError('instructions_id', 'instructions_errorid');" />&nbsp;
        <span class="error" id="instructions_errorid"><?php if(array_key_exists('instructions_error', $form_array)) echo $form_array['instructions_error'];?></span>
    </p>
    <p>
        <label>&nbsp;</label>
        <a href="<?php echo "admin-book.php?rest_id=1&back_url=".$_GET['back_url']; ?>" class="button85x30-grey">Cancel</a>&nbsp;<a href="javascript:void(0);" onclick="return validatefrm();" class="button85x30-red">Add Now</a>
    </p>
</fieldset>
</form>
<?php
}
?>