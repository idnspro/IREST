<form name="frmRestProfile" method="post" action="admin-restaurant.php?sec=add&rid=">
    <input type="hidden" name="securityKey" value="<?php echo md5(NEWADDRESTAURANT);?>" />  
      <table width="462" height="250" border="0" cellspacing="5" cellpadding="5" align="center">
        <tr>
            <td width="442">
                <textarea name="txtRestMess" id="txtRestMessId" cols="" rows="" style="width:440px; height:150px;"></textarea>
            </td>
        </tr>
        <tr>
        <td align="right" valign="middle">&nbsp;</td>
        <td colspan="2" valign="middle">
        <input type="image" src="images/save-btn.gif" alt=" Add Restaurant" name="Register" border="0" id="RegisterId" onclick="javascript:void();">
        </td>
    </tr>
    </table>
</form>