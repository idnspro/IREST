<?php
if($_POST['securityKey']==md5("ADDCOUPONCODE")){
    $coupon_code = trim($_POST['coupon_code']);
    if($coupon_code != "" && $coupon_code != "Enter coupon code here") {
        $couponInfoArr             = $restObj->fun_getCouponInfoByCode($coupon_code);
        //print_r($couponInfoArr);
        $coupon_id                 = $couponInfoArr['coupon_id'];
        $coupon_name               = $couponInfoArr['coupon_name'];
        $coupon_type               = $couponInfoArr['coupon_type'];
        //$coupon_auto_distributed = $couponInfoArr['coupon_auto_distributed'];
        $coupon_code               = $couponInfoArr['coupon_code'];
        $coupon_discount           = $couponInfoArr['coupon_discount'];
        $coupon_discount_type      = $couponInfoArr['coupon_discount_type'];
        $coupon_pre_tax            = $couponInfoArr['coupon_pre_tax'];
        $coupon_start_date         = $couponInfoArr['coupon_start_date'];
        $coupon_end_date           = $couponInfoArr['coupon_end_date'];
        //$coupon_duration         = $couponInfoArr['coupon_duration'];
        //$coupon_duration_type    = $couponInfoArr['coupon_duration_type'];
        //$coupon_loyalty          = $couponInfoArr['coupon_loyalty'];
        //$coupon_loyalty_type     = $couponInfoArr['coupon_loyalty_type'];
        $coupon_takeup             = $couponInfoArr['coupon_takeup'];
        $coupon_by_quantity        = $couponInfoArr['coupon_by_quantity'];
        //$coupon_desc             = $couponInfoArr['coupon_desc'];
        //$created_on              = $couponInfoArr['created_on'];
        //$created_by              = $couponInfoArr['created_by'];
        //$updated_on              = $couponInfoArr['updated_on'];
        //$updated_by              = $couponInfoArr['updated_by'];
        $status                    = $couponInfoArr['status'];
        $cur_time                  = time();
        $userCouponCount           = $restObj->fun_countCouponUserCode($coupon_code, $user_id);
        $applycoupon               = false;
        if($coupon_by_quantity == "0" && strtotime($coupon_start_date) <= $cur_time && $cur_time <= strtotime($coupon_end_date)) {
            $applycoupon = true;
        } else if($coupon_by_quantity == "1" && $coupon_takeup > 0  && strtotime($coupon_start_date) <= $cur_time && $cur_time <= strtotime($coupon_end_date) && $userCouponCount < 1) {
            $applycoupon = true;
        }
    }
}
?>
<script language="javascript" type="text/javascript">
    var req = ajaxFunction();
    function chkCouponCode() {
        var coupon_code = "coupon_code";
        if(document.getElementById(coupon_code).value != "" || document.getElementById(coupon_code).value != "Enter coupon code here") {
            var coupon_code = document.getElementById(coupon_code).value;
            var user_id = '<?php echo $user_id; ?>';
            var rest_id = '<?php echo $rest_id; ?>';
            req.onreadystatechange = handleChkCouponCodeResponse;
            req.open('get', 'includes/ajax/chekcouponcodeXml.php?rest_id='+rest_id+'&user_id='+user_id+'&coupon_code='+coupon_code); 
            req.send(null);   
        }
    }

    function handleChkCouponCodeResponse(){
        if(req.readyState == 4){
            var response = req.responseText;
            xmlDoc = req.responseXML;
            //alert(req.responseText);
            var root = xmlDoc.getElementsByTagName('itms')[0];
            if(root != null){
                var items = root.getElementsByTagName("itm");
                var item = items[0];
                var itmstatus = item.getElementsByTagName("itmstatus")[0].firstChild.nodeValue;
                if(itmstatus == "available."){
                    addCouponCode();
                } else {
                    document.getElementById("coupon_code_errorid").innerHTML = "Invalid Coupon code.";
                }
            }
        }
    }

    function addCouponCode() {
        var strGetId = "coupon_code";
        var strPutId = "coupon_codes";
        var txtGetCodes = document.getElementById(strGetId).value;
        //var txtPutCodes = document.getElementById(strPutId).value;
        document.getElementById(strPutId).value = txtGetCodes;
    }

    function calculateCouponDiscount(){
        document.getElementById("securityKey").value = "<?php echo md5('ADDCOUPONCODE')?>";
        document.frmCheckout.submit();
    }
</script>
<script type="text/javascript" src="<?php echo SITE_URL;?>jquery/js/jquery.ui.timepicker.addon.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#schedule_id').datetimepicker({
            controlType: 'select',
            dateFormat: 'yy-mm-dd',
            timeFormat: 'HH:mm:ss'
        });
    });
</script>
<script language="javascript" type="text/javascript">
    function chkblnkTxtError(strFieldId, strErrorFieldId) {
        if(document.getElementById(strFieldId).value != "") {
            document.getElementById(strErrorFieldId).innerHTML = "";
        }
    }
    function validatefrm(){
        var payment_method_id1 = document.getElementById("payment_method_id1");
        var payment_method_id2 = document.getElementById("payment_method_id2");
        if(document.getElementById("delivery_fname_id").value == "") {
            document.getElementById("delivery_fname_errorid").innerHTML = "First name required";
            document.getElementById("delivery_fname_id").focus();
            return false;
        }
        if(document.getElementById("delivery_lname_id").value == "") {
            document.getElementById("delivery_lname_errorid").innerHTML = "Last name required";
            document.getElementById("delivery_lname_id").focus();
            return false;
        }
        if(document.getElementById("delivery_phone_id").value == "") {
            document.getElementById("delivery_phone_errorid").innerHTML = "Phone required";
            document.getElementById("delivery_phone_id").focus();
            return false;
        }
        if(document.getElementById("delivery_address1_id").value == "") {
            document.getElementById("delivery_address1_errorid").innerHTML = "Address required";
            document.getElementById("delivery_address1_id").focus();
            return false;
        }
        if(document.getElementById("delivery_city_id").value == "") {
            document.getElementById("delivery_city_errorid").innerHTML = "City required";
            document.getElementById("delivery_city_id").focus();
            return false;
        }
        if(document.getElementById("delivery_zip_id").value == "") {
            document.getElementById("delivery_zip_errorid").innerHTML = "Postal code required";
            document.getElementById("delivery_zip_id").focus();
            return false;
        }
        if(document.getElementById("delivery_country_id").value == "") {
            document.getElementById("delivery_country_errorid").innerHTML = "Country required";
            document.getElementById("delivery_country_id").focus();
            return false;
        }
        if(document.getElementById("schedule_id").value == "") {
            document.getElementById("schedule_errorid").innerHTML = "Schedule required";
            document.getElementById("schedule_id").focus();
            return false;
        }
        if(payment_method_id1 && (payment_method_id1.checked == true)) {
            document.getElementById("securityKey").value = "<?php echo md5('CHECKOUT')?>";
            document.frmCheckout.action = "<?php echo SITE_URL;?>checkout.php?action=process";
            document.frmCheckout.submit();
        } else if(payment_method_id2 && (payment_method_id2.checked == true)) {
            document.getElementById("securityKey").value = "<?php echo md5('CHECKOUT')?>";
            <?php
            if(isset($ipcountry) && ($ipcountry == "IND")) {
            ?>
            document.frmCheckout.action = "<?php echo SITE_URL;?>paypal.php?action=process";
            <?php
            } else {
            ?>
            document.frmCheckout.action = "<?php echo SITE_URL;?>paypal.php?action=process";
            <?php
            }
            ?>
            document.frmCheckout.submit();
        } else {
            document.getElementById("securityKey").value = "<?php echo md5('CHECKOUT')?>";
            <?php
            if(isset($ipcountry) && ($ipcountry == "IND")) {
            ?>
            document.frmCheckout.action = "<?php echo SITE_URL;?>paypal.php?action=process";
            <?php
            } else {
            ?>
            document.frmCheckout.action = "<?php echo SITE_URL;?>paypal.php?action=process";
            <?php
            }
            ?>
            document.frmCheckout.submit();
        }
    }
</script>
<script type="text/javascript" language="javascript">
    var req = ajaxFunction();
    function saveSearch() {
        var cook_country_id = document.getElementById("country_id").value;
        var cook_state_id = document.getElementById("state_id").value;
        var cook_city_id = document.getElementById("city_id").value;
        var cook_dtype = document.getElementById("dtype").value;
        var cook_address = document.getElementById("address").value;
        var cook_zip = document.getElementById("zip").value;
        //DelCookie('cook_country_id');
        //DelCookie('cook_state_id');
        //DelCookie('cook_city_id');
        //DelCookie('cook_dtype');
        //DelCookie('cook_address');
        //DelCookie('cook_zip');
        SetCookie('cook_country_id', cook_country_id);
        SetCookie('cook_state_id', cook_state_id);
        SetCookie('cook_city_id', cook_city_id);
        SetCookie('cook_dtype', cook_dtype);
        SetCookie('cook_address', cook_address);
        SetCookie('cook_zip', cook_zip);
    }
    function removeSearch() {
        DelCookie('cook_country_id');
        DelCookie('cook_state_id');
        DelCookie('cook_city_id');
        DelCookie('cook_dtype');
        DelCookie('cook_address');
        DelCookie('cook_zip');
    }
    function change_dtype(cook_dtype) {
        DelCookie('cook_dtype');
        SetCookie('cook_dtype', cook_dtype);
        //SetSession('sess_dtype', cook_dtype);
        document.getElementById("dtype").value = cook_dtype;
    }
    <?php /*?>
    function SetSession(sess_name, sess_value) {
        req.onreadystatechange = function () {
            if(req.readyState == 4){
                var response = req.responseText;
                xmlDoc = req.responseXML;
                var root = xmlDoc.getElementsByTagName('sess')[0];
                if(root != null){
                    var items = root.getElementsByTagName("ses");
                    for (var i = 0 ; i < items.length ; i++){
                        var item = items[i];
                        var status = item.getElementsByTagName("status")[0].firstChild.nodeValue;
                        if(status == "success"){
                            //window.location = location.href;
                        }
                    }
                }
            }
        }
        req.open('get', '<?php echo SITE_URL;?>includes/ajax/sessionAjax.php?mode=add&sess_name='+sess_name+'&sess_value='+sess_value); 
        req.send(null);   
    }
    <?php */?>
</script>
<div class="container">
    <div class="login-page">
        <div class="account_grid">
            <div class="col-md-6 login-left wow fadeInLeft" data-wow-delay="0.4s">
                <h3>CHECKOUT</h3>
                <p>&nbsp;</p>
                <?php
                /*
                if($restObj->fun_checkCartNoEmpty($user_id) == true) {
                    $rest_id         = $dbObj->getField(TABLE_USER_CART, "user_id", $user_id, "rest_id");
                    $delivery_type   = $dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "delivery_type");
                    $payment_cash    = $dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "payment_cash");
                    $payment_cc      = $dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "payment_cc");
                    $payment_oo      = $dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "payment_oo");
                    $tax             = $dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "tax");
                    if(!is_numeric($tax)) {
                        $tax = 0;
                    }
                    $delivery_charge = $dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "delivery_charge");
                    if(!is_numeric($delivery_charge) || ($_COOKIE['cook_dtype'] =="pickup")) {
                        $delivery_charge = 0;
                    }
                    $extra_charge    = $dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "extra_charge");
                    if(!is_numeric($extra_charge)) {
                        $extra_charge    = 0;
                    }
                    $cart_price      = $restObj->fun_getCheckoutCartAmt($user_id);
                    $final_price     = ($cart_price+(($cart_price*$tax)/100)+$delivery_charge+$extra_charge);
                    $total_discount  = 0;
                    $total_payble_amt= 0;
                    if($applycoupon == true) {
                        if($coupon_discount_type == "0") {
                            if($coupon_pre_tax == "0") {
                                $total_discount = ($final_price*$coupon_discount)/100;
                            } else {
                                $total_discount = ($cart_price*$coupon_discount)/100;
                            }
                        } else {
                            $total_discount = $coupon_discount;
                        }
                    }
                    // Restaurant currency info
                    $currencyArr          = $restObj->fun_getRestaurantCurrencyInfo($rest_id);
                    $rest_currency_id     = $currencyArr['currency_id'];
                    $rest_currency_code   = $currencyArr['currency_code'];
                    $rest_currency_symbol = $currencyArr['currency_symbol'];
                    $rest_currency_rate   = $currencyArr['currency_rate'];
                    $rest_currency_name   = $currencyArr['currency_name'];
                    $currency_symbol      = ($users_currency_symbol == "")?$rest_currency_symbol:$users_currency_symbol;
                    $currency_code        = ($users_currency_code == "")?$rest_currency_code:$users_currency_code;
                    $currency_id          = ($users_currency_id == "")?$rest_currency_id:$users_currency_id;
                    $final_price          = (($final_price/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]);
                    $total_discount       = (($total_discount/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]);
                    $total_payble_amt     = ($final_price-$total_discount);
                    //print_r($userCurrencyArr);
                    ?>
                    <form name="frmCheckout" id="frmCheckout" method="post" action="checkout">
                        <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("CHECKOUT");?>" />
                        <input type="hidden" name="final_price" id="final_price_id" value="<?php echo $total_payble_amt;?>" />
                        <input type="hidden" name="rest_id" id="rest_id" value="<?php echo $rest_id;?>" />
                        <input type="hidden" name="currency_id" id="currency_id_id" value="<?php echo $currency_id;?>" />
                        <input type="hidden" name="coupon_codes" id="coupon_codes" value="<?php echo $_POST['coupon_codes']; ?>" />
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="font12">
                            <tr>
                                <td align="left" valign="middle" colspan="3" class="pad-rgt5"><strong>Customer Info</strong></td>
                            </tr>
                            <tr><td colspan="3" height="5px" style="border-bottom:thin #999999 solid; clear:both;"></td></tr>
                            <tr>
                                <td width="100" align="right" valign="middle" class="pad-rgt5">First name: </td>
                                <td width="235" valign="middle"><input type="text" name="delivery_fname" id="delivery_fname_id" value="<?php if(isset($_POST['delivery_fname']) && $_POST['delivery_fname']!=""){echo $_POST['delivery_fname'];} else {echo $userInfoArr['user_fname'];} ?>" /></td>
                                <td valign="top"><span class="error" id="delivery_fname_errorid">&nbsp;</span></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle" class="pad-rgt5">Last name: </td>
                                <td valign="middle"><input type="text" name="delivery_lname" id="delivery_lname_id" value="<?php if(isset($_POST['delivery_lname']) && $_POST['delivery_lname']!=""){echo $_POST['delivery_lname'];} else {echo $userInfoArr['user_lname'];} ?>" /></td>
                                <td valign="top"><span class="error" id="delivery_lname_errorid">&nbsp;</span></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle" class="pad-rgt5">Phone: </td>
                                <td valign="middle"><input type="text" name="delivery_phone" id="delivery_phone_id" value="<?php if(isset($_POST['delivery_phone']) && $_POST['delivery_phone']!=""){echo $_POST['delivery_phone'];} ?>" /></td>
                                <td valign="top"><span class="error" id="delivery_phone_errorid">&nbsp;</span></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle" class="pad-rgt5">Address: </td>
                                <td valign="middle"><input type="text" name="delivery_address1" id="delivery_address1_id" value="<?php if(isset($_POST['delivery_address1']) && $_POST['delivery_address1']!=""){echo $_POST['delivery_address1'];} ?>" /></td>
                                <td valign="top"><span class="error" id="delivery_address1_errorid">&nbsp;</span></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">&nbsp;</td>
                                <td valign="middle"><input type="text" name="delivery_address2" id="delivery_address2_id" value="<?php if(isset($_POST['delivery_address2']) && $_POST['delivery_address2']!=""){echo $_POST['delivery_address2'];} ?>" /></td>
                                <td valign="top">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle" class="pad-rgt5">Town / City: </td>
                                <td valign="middle"><input type="text" name="delivery_city" id="delivery_city_id" value="<?php if(isset($_POST['delivery_city']) && $_POST['delivery_city']!=""){echo $_POST['delivery_city'];} ?>" /></td>
                                <td valign="top"><span class="error" id="delivery_city_errorid">&nbsp;</span></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle" class="pad-rgt5">County / State: </td>
                                <td valign="middle"><input type="text" name="delivery_state" id="delivery_state_id" value="<?php if(isset($_POST['delivery_state']) && $_POST['delivery_state']!=""){echo $_POST['delivery_state'];} ?>" /></td>
                                <td valign="top"><span class="error" id="delivery_state_errorid">&nbsp;</span></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle" class="pad-rgt5">Postal code: </td>
                                <td valign="middle"><input type="text" name="delivery_zip" id="delivery_zip_id" value="<?php if(isset($_POST['delivery_zip']) && $_POST['delivery_zip']!=""){echo $_POST['delivery_zip'];} ?>" /></td>
                                <td valign="top"><span class="error" id="delivery_zip_errorid">&nbsp;</span></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle" class="pad-rgt5">Country: </td>
                                <td valign="middle">
                                    <select name="delivery_country" id="delivery_country_id" class="select310">
                                        <option value="0" selected>Select ... </option>
                                        <?php 
                                            $locationObj->fun_getCountryOptionsList($_POST['delivery_country'], '');
                                        ?>
                                    </select>
                                </td>
                                <td valign="top"><span class="error" id="delivery_country_errorid">&nbsp;</span></td>
                            </tr>
                            <tr><td colspan="3" height="5px" style="border-bottom:thin #999999 solid; clear:both;"></td></tr>
                            <tr>
                                <td align="center" valign="middle" colspan="3" class="pad-top5 pad-btm5" style="background-color:#CCCCCC;">
                                <strong>Special Instruction or comments for this order</strong>
                                <br /><br />
                                <textarea name="order_comments" id="order_comments_id" cols="" rows="" style="width:440px; height:80px;"><?php if(isset($_POST['order_comments']) && $_POST['order_comments']!=""){echo $_POST['order_comments'];} ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle" class="pad-rgt5 pad-btm10">Order Type: </td>
                                <td valign="middle">
                                    <div id="delivery_order">
                                        <?php
                                        if(isset($delivery_type) && $delivery_type == "1") {
                                        ?>
                                        <div class="radio_dtype_cart radio_pickup_cart">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="2">
                                            <tr>
                                                <td valign="middle" height="30px" class="pad-btm15 pad-rgt5"><input name="dtype" id="pickup" value="pickup" onclick="change_dtype(this.value);" <?php if(isset($_COOKIE['cook_dtype']) && ($_COOKIE['cook_dtype'] =="pickup")) {echo ' checked="checked"';} ?> type="radio" class="radio_cart"></td>
                                                <td valign="middle" height="30px">PICKUP</td>
                                                <td valign="middle" height="30px"><img src="<?php echo SITE_IMAGES; ?>delivery_bagN.png" alt="Pickup" border="0" height="27" width="31"></td>
                                            </tr>
                                        </table>
                                        </div>
                                        <div class="radio_dtype_cart radio_delivery_cart">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="2">
                                            <tr>
                                                <td valign="middle" height="30px" class="pad-btm15 pad-rgt5"><input name="dtype" id="delivery" value="delivery" onclick="change_dtype(this.value);" <?php if(!isset($_COOKIE['cook_dtype']) || ($_COOKIE['cook_dtype'] =="delivery")) {echo ' checked="checked"';} ?> type="radio" class="radio_cart"></td>
                                                <td valign="middle" height="30px">DELIVERY</td>
                                                <td valign="middle" height="30px"><img src="<?php echo SITE_IMAGES; ?>delivery_carN.png" alt="Delivery" border="0" height="27" width="31"></td>
                                            </tr>
                                        </table>
                                        </div>
                                        <?php
                                        } else {
                                        ?>
                                        <div class="radio_dtype_cart radio_pickup_cart">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="2">
                                            <tr>
                                                <td valign="middle" height="30px" class="pad-btm15 pad-rgt5"><input name="dtype" id="pickup" value="pickup" checked="checked" type="radio" class="radio_cart"></td>
                                                <td valign="middle" height="30px">PICKUP</td>
                                                <td valign="middle" height="30px"><img src="<?php echo SITE_IMAGES; ?>delivery_bagN.png" alt="Pickup" border="0" height="27" width="31"></td>
                                            </tr>
                                        </table>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </td>
                                <td valign="top"><span class="error" id="dtype_errorid">&nbsp;</span></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle" class="pad-rgt5 pad-top10">Schedule for: </td>
                                <td valign="middle"><input type="text" name="schedule" id="schedule_id" value="<?php if(isset($_POST['schedule']) && $_POST['schedule']!=""){echo $_POST['schedule'];} else {echo date('Y-m-d H:i:s');}?>" /></td>
                                <td valign="top"><span class="error" id="schedule_errorid">&nbsp;</span></td>
                            </tr>
                            <tr><td colspan="3" height="5px" style="border-bottom:thin #999999 solid; clear:both;"></td></tr>
                            <tr>
                                <td align="center" valign="middle" colspan="3" class="pad-top5 pad-btm5 pad-lft20 pad-rgt20" style="background-color:#CCCCCC;">
                                    <strong>Please select Payment Method</strong>
                                    <ul style="margin-left:170px;">
                                    <?php
                                    if(isset($payment_cash) && $payment_cash == "1") {
                                        echo '<li style="margin-left:20px; margin-right:20px;"><input name="payment_method" id="payment_method_id1" checked="" value="1" type="radio" class="radio">&nbsp;Cash</li>';
                                    } else {
                                        echo '<input type="hidden" name="payment_method" id="payment_method_id1" value="0">';
                                    }
                                    if((isset($payment_cc) && $payment_cc == "1") || (isset($payment_oo) && $payment_oo == "1")) {
                                        if(isset($ipcountry) && ($ipcountry == "IND")) {
                                            echo '<li style="margin-left:20px; margin-right:20px;"><input name="payment_method" id="payment_method_id2" checked="" value="3" type="radio" class="radio">&nbsp;PayPal</li>';
                                        } else {
                                            echo '<li style="margin-left:20px; margin-right:20px;"><input name="payment_method" id="payment_method_id2" checked="" value="2" type="radio" class="radio">&nbsp;PayPal</li>';
                                        }
                                    } else {
                                        echo '<input type="hidden" name="payment_method" id="payment_method_id2" value="0">';
                                    }
                                    ?>
                                    </ul>
                                </td>
                            </tr>
                            <tr><td colspan="3" height="5px" style="border-bottom:thin #999999 solid; clear:both;"></td></tr>
                            <tr>
                                <td colspan="3" align="right" valign="middle" class="pad-top5 pad-btm5 pad-lft20 pad-rgt20">
                                    <div id="txtCheckoutTotalAmtId">
                                    <?php
                                        if($applycoupon == true && $total_discount > 0) {
                                            echo '<input type="hidden" name="txtCouponApply" id="txtCouponApplyId" value="1" />';
                                            echo '<span class="font18 black"><strong>Total charge: '.$currency_symbol.number_format($total_payble_amt, 2).'</strong></span><br><span class="font12 pink"><strong>This price includes a '.$currency_symbol.number_format($total_discount, 2).' discount</strong></span>';
                                        } else {
                                            echo '<input type="hidden" name="txtCouponApply" id="txtCouponApplyId" value="0" />';
                                            echo '<span class="font18 black"><strong>Total charge: '.$currency_symbol.number_format($final_price, 2).'</strong></span>';
                                        }
                                    ?>
                                    </div>
                                </td>
                            </tr>
                            <tr><td colspan="3" height="5px" style="border-bottom:thin #999999 solid; clear:both;"></td></tr>
                            <tr>
                                <td valign="top" colspan="3">
                                    <div class="box-checkout-left-coupon-wrapper" style="background-color:#CCCCCC;">
                                        <table width="100%" border="0" cellpadding="1" cellspacing="0">
                                            <tr>
                                                <td align="left" valign="middle"><span class="font14 pink">Do you have a coupon code</span></td>
                                                <td align="left" valign="middle"><input name="coupon_code" id="coupon_code" type="text" class="inpuTxt240" placeholder="Enter coupon code here"  onblur="chkCouponCode();" onkeydown="chkblnkTxtError('coupon_code', 'coupon_code_errorid');" onkeyup="chkblnkTxtError('coupon_code', 'coupon_code_errorid');" value="<?php if(isset($_POST['coupon_code']) && $_POST['coupon_code'] !="") { echo $_POST['coupon_code'];}?>" /></td>
                                                <td align="right" valign="middle"><a href="javascript:void(0);" onclick="return calculateCouponDiscount();" class="button-red" style="text-decoration:none;" >Apply Now</a></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr height="40"><td align="left" colspan="3" valign="middle">&nbsp;<div id="coupon_code_errorid" class="error">&nbsp;</div></td></tr>
                            <tr height="40">
                                <td colspan="3" valign="middle" align="center" class="pad-top5 pad-btm5">
                                    <a href="javascript:void(0);" onclick="return validatefrm();" class="button-blue">Submit your Order</a>
                                </td>
                            </tr>
                        </table>
                    </form>
                <?php
                } else {
                    //display message
                    echo $message;
                }
                */
                ?>
            </div>
            <div class="col-md-6 login-right wow fadeInRight" data-wow-delay="0.4s">
                <h3>YOUR ORDER</h3>
                <div id="cart" class="col-sm-12">
                <?php
                if($restObj->fun_checkCartNoEmpty($user_id) == true) {
                    //$restObj->fun_createCheckoutCartView($user_id);
                    $restObj->fun_getCartView($user_id);
                } else {
                //display empty cart
                ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-md-8">Item</th>
                                        <th class="col-md-1">Qty</th>
                                        <th class="col-md-2">Price</th>
                                        <th class="text-right">Del</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td colspan="4"><p class="text-center text-danger">Your cart is empty</p></td></tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Subtotal:</td>
                                        <td>0.00</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Tax:</td>
                                        <td>0.00</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Delivery Fee:</td>
                                        <td>0.00</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td class="col-md-9"><strong>Total:</strong></td>
                                        <td><?php echo $currency_symbol;?>0.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php
                }
                ?>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
