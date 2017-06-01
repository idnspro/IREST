<script type="text/javascript" language="javascript">
function chkblnkTxtError(strFieldId, strErrorFieldId){
    if(document.getElementById(strFieldId).value != ""){
        document.getElementById(strErrorFieldId).innerHTML = "";
    }
}

function validatefrm(){
    if(document.getElementById("delivery_fname_id").value == "") {
        document.getElementById("delivery_fname_errorid").innerHTML = "First name required";
        document.getElementById("delivery_fname_id").focus();
        return false;
    }
    document.frmOrd.submit();
}
</script>
<?php
if(isset($order_id) && $order_id !=""){
    $ordInfo           = $restObj->fun_getOrderInfoById($order_id);
    $user_id           = $ordInfo['user_id'];
    $delivery_fname    = $ordInfo['delivery_fname'];
    $delivery_lname    = $ordInfo['delivery_lname'];
    $delivery_address1 = $ordInfo['delivery_address1'];
    $delivery_address2 = $ordInfo['delivery_address2'];
    $delivery_city     = $ordInfo['delivery_city'];
    $delivery_state    = $ordInfo['delivery_state'];
    $delivery_country  = $ordInfo['delivery_country'];
    $delivery_zip      = $ordInfo['delivery_zip'];
    $delivery_phone    = $ordInfo['delivery_phone'];
    $dtype             = $ordInfo['dtype'];
    $schedule          = $ordInfo['schedule'];
    $order_comments    = $ordInfo['order_comments'];
    $payment_method    = $ordInfo['payment_method'];
    $cc_type           = $ordInfo['cc_type'];
    $cc_owner          = $ordInfo['cc_owner'];
    $cc_number         = $ordInfo['cc_number'];
    $cc_expires        = $ordInfo['cc_expires'];
    $final_price       = $ordInfo['final_price'];
    $currency_id       = $ordInfo['currency_id'];
    $orders_status     = $ordInfo['orders_status'];
?>
<div class="panel panel-default">
    <div class="panel-heading"><h3><?php echo $addtitle; ?></h3></div>
    <div class="panel-body">
        <div class="cols-md-12">
            <ul class="list-unstyled pull-right list-inline">
                <li><a href="manager-restaurants-order.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="btn btn-success">Back to Order List</a></li>
            </ul>
        </div>
        <div class="clearfix"><br><br></div>
        <div class="cols-md-12">
            <form name="frmOrd" id="frmOrd" method="post" action="manager-restaurants-order.php?sec=edit&order_id=<?php echo $order_id; ?>&rest_id=<?php echo $rest_id;?>" enctype="multipart/form-data">
                <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITORDER"); ?>">
                <input type="hidden" name="order_id" id="order_id_id" value="<?php echo $order_id; ?>">
                <input type="hidden" name="user_id" id="user_id_id" value="<?php echo $user_id; ?>">
                <input type="hidden" name="cc_type" id="cc_type_id" value="<?php echo $cc_type; ?>">
                <input type="hidden" name="cc_owner" id="cc_owner_id" value="<?php echo $cc_owner; ?>">
                <input type="hidden" name="cc_number" id="cc_number_id" value="<?php echo $cc_number; ?>">
                <input type="hidden" name="cc_expires" id="cc_expires_id" value="<?php echo $cc_expires; ?>">
                <input type="hidden" name="currency_id" id="currency_id" value="<?php echo $currency_id; ?>">
                <input type="hidden" name="back_url" id="back_url" value="<?php echo $_GET['back_url']; ?>">
                <div class="form-group">
                    <label class="control-label col-sm-3" for="delivery_fname">First name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="delivery_fname" id="delivery_fname_id" value="<?php echo $delivery_fname; ?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="delivery_lname">Last name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="delivery_lname" id="delivery_lname_id" value="<?php echo $delivery_lname; ?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="delivery_address1">Address</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="delivery_address1" id="delivery_address1_id" value="<?php echo $delivery_address1; ?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="delivery_address2">&nbsp;</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="delivery_address2" id="delivery_address2_id" value="<?php echo $delivery_address2; ?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="delivery_city">Town / City</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="delivery_city" id="delivery_city_id" value="<?php echo $delivery_city; ?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="delivery_state">County / State</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="delivery_state" id="delivery_state_id" value="<?php echo $delivery_state; ?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="delivery_zip">Postal code</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="delivery_zip" id="delivery_zip_id" value="<?php echo $delivery_zip; ?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="delivery_country">Country</label>
                    <div class="col-sm-9">
                        <select name="delivery_country" id="delivery_country_id" class="form-control">
                            <option value="0" selected>Select ... </option>
                            <?php 
                                $locationObj->fun_getCountryOptionsList($delivery_country, '');
                            ?>
                        </select>
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="dtype">Delivery Type</label>
                    <div class="col-sm-9">
                        <select name="dtype" id="dtype_id" class="form-control">
                            <option value="pickup" <?php if(isset($dtype) && ($dtype =="pickup")) {echo ' selected';} ?> >PICKUP</option>
                            <option value="delivery" <?php if(!isset($dtype) || ($dtype =="delivery")) {echo ' selected';} ?> >DELIVERY</option>
                        </select>
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="schedule">Schedule for</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="schedule" id="schedule_id" value="<?php echo $schedule; ?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="final_price">Final price</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="final_price" id="final_price_id" value="<?php echo $final_price; ?>" />$
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="payment_method">Payment method</label>
                    <div class="col-sm-9">
                        <select name="payment_method" id="payment_method_id" class="form-control">
                            <option value="1" <?php if(isset($payment_method) && ($payment_method =="1")) {echo ' selected';} ?> >Cash</option>
                            <option value="2" <?php if(isset($payment_method) && ($payment_method =="2")) {echo ' selected';} ?> >PayPal</option>
                            <option value="3" <?php if(isset($payment_method) && ($payment_method =="3")) {echo ' selected';} ?> >Credit Card</option>
                        </select>
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="order_comments">Comments</label>
                    <div class="col-sm-9">
                        <textarea type="text" class="form-control" name="order_comments" id="order_comments_id"><?php echo $order_comments; ?></textarea>
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="orders_status">Order Status</label>
                    <div class="col-sm-9">
                        <select name="orders_status" id="orders_status_id" class="form-control">
                            <option value="1" <?php if(isset($orders_status) && ($orders_status =="1")) {echo ' selected';} ?> >New Order</option>
                            <option value="2" <?php if(isset($orders_status) && ($orders_status =="2")) {echo ' selected';} ?> >Pending</option>
                            <option value="3" <?php if(isset($orders_status) && ($orders_status =="3")) {echo ' selected';} ?> >PayPal Preparation</option>
                            <option value="4" <?php if(isset($orders_status) && ($orders_status =="4")) {echo ' selected';} ?> >Complete</option>
                            <option value="5" <?php if(isset($orders_status) && ($orders_status =="5")) {echo ' selected';} ?> >Cancel</option>
                        </select>
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-10">
                        <a href="javascript:void(0);" onclick="return validatefrm();" class="btn btn-success">Update Now</a>
                    </div>
                </div>
                <div class="clearfix"><br><br></div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>
