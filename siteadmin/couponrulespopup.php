<?php
   $coupon_id = $_REQUEST['coupon_id'];
   if(isset($coupon_id) && $coupon_id !=""){
?>
<form>
    <table border="0" cellpadding="1" cellspacing="1" width="100%" bgcolor="#CCCCCC" >
            <tr>
                <td align="center">
                    <table border="0" cellpadding="2" cellspacing="2" width="500" >                        
                        <tr>
                            <td><table border="0" class="SolidBorderBlack LighterPurpleBG" cellpadding="0" cellspacing="0" width="100%" >
                                    <tr>
                                        <td>
                                            <div id="divRule1">
                                                <table border="0" cellpadding="0" cellspacing="2" width="100%">
                                                    <tr>
                                                        <td valign="top" align="left" nowrap>
                                                            <input type="hidden" name="hRule1LookupCouponId" id="hRule1LookupCouponId" value="1" />
                                                            <span id="lblRule1">$X OFF</span>
                                                        </td>
                                                        <td  valign="top" align="left">
                                                            <span id="Label1">: Coupon can be used for any order amount </span>
                                                        </td>
                                                    </tr>                                        
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

</form>
<?php
}else{
?>
idfklfdgh
<?php
}
?>