<script type="text/javascript" language="javascript">
function chkblnkTxtError(strFieldId, strErrorFieldId){
	if(document.getElementById(strFieldId).value != ""){
	  document.getElementById(strErrorFieldId).innerHTML = "";
	}
}

function validatefrm(){
	if(document.getElementById("option_name_id").value == "") {
		document.getElementById("option_name_errorid").innerHTML = "category name required";
		document.getElementById("option_name_id").focus();
		return false;
	}
	document.frmOpt.submit();
}
</script>
<div class="right-area-title"><div class="title"><h1>Order Details</h1></div></div>
<div class="right-area-listing">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td valign="top">
            <div class="floatRight pad-top5 pad-btm10" align="right">
                <a href="admin-report.php" class="button-blue" style="text-decoration:none;">Back to list</a>&nbsp;
            </div>
        </td>
    </tr>
    <tr><td valign="top"><?php echo $restObj->fun_createOrderView($order_id); ?></td></tr>
</table>
</div>
