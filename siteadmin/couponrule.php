<form>
    <table border="0" cellpadding="1" cellspacing="1" width="100%" style="background-color: #CCCCCC">
        <tr>
            <td align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td align="left"> </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <div id="vsCoupons" class="ErrorSummaryClass" style="color:Red;width:100%;display:none;"> </div>
                        </td>
                    </tr>
                </table>
                <table border="0" class="SolidBorderBlack LightYellowBG" cellpadding="0" cellspacing="2" width="100%">
                    <tr>
                        <td  align="left"><h3>Coupon Rules</h3> </td>
                    </tr>
                </table>
                <table border="0" class="SolidBorderBlack LighterPurpleBG" cellpadding="0" style="border-top-width:0" cellspacing="0" width="100%" >
                    <tr>
                        <td>
                            <div id="pnlCanEditPrivileges">
                                <div id="divRule1">
                                    <table border="0" cellpadding="0" cellspacing="2" width="100%">
                                        <tr>
                                            <td valign="top" align="left" nowrap style="width:4px">
                                                <input type="hidden" name="hRule1LookupCouponId" id="hRule1LookupCouponId" value="1" />
                                                <span class="GrayBoldText">
                                                <input id="rbRule1" type="radio" name="Rule" value="rbRule1" checked="checked" />
                                                </span> </td>
                                            <td align="left"> <span id="Label1" class="BlackNormalText8pt">Coupon can be used for any order amount</span> </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="divRule2">
                                    <table border="0" cellpadding="0" cellspacing="2" width="100%">
                                        <tr>
                                            <td valign="top" align="left" nowrap style="width:4px">
                                                <input type="hidden" name="hRule2LookupCouponId" id="hRule2LookupCouponId" value="2" />
                                                <span class="GrayBoldText">
                                                <input id="rbRule2" type="radio" name="Rule" value="rbRule2" checked="checked" />
                                                </span> </td>
                                            <td align="left"> <span id="Label2" class="BlackNormalText8pt">Coupon can be used for order amounts > </span>
                                                <input name="txtAmtRule2" type="text" value="20.0000" maxlength="6" id="txtAmtRule2" class="TextBoxW60" onkeypress="if(!checkNegativeDecimalFormat(event)){return false}" />
                                                <span id="RangeValidator8" style="color:Red;display:none;"></span> </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <table border="0" cellpadding="0" cellspacing="2" width="100%">
                                <tr>
                                    <td align="left" colspan="2">
                                        <table border="0" cellpadding="0" cellspacing="8" width="100%">
                                            <tr>
                                                <td colspan="2">
                                                    <hr />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left"> <img src="images/canc_btn.gif" /></td>
                                                <td align="right"><img src="images/conf_btn.gif" /></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td style="height:5px"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>
