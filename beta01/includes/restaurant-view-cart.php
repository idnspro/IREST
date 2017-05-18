<script language="javascript" type="text/javascript">
    function del_item(user_basket_id) {
        //alert(user_basket_id);
        document.getElementById("user_basket_id_id").value = user_basket_id;
        Post.Send(document.getElementById('frmDelFromCart'));
        document.getElementById("user_basket_id_id").value = "";
    }
    function ses_del_cart_item(user_basket_id) {
        //alert(user_basket_id);
        document.getElementById("securityKey").value = '<?php echo md5("DELFROMSESCART");?>';
        document.getElementById("user_basket_id_id").value = user_basket_id;
        Post.Send(document.getElementById('frmDelFromCart'));
        document.getElementById("user_basket_id_id").value = "";
    }
</script>
<div class="row">
    <form name="frmDelFromCart" id="frmDelFromCart" method="post" action="<?php echo SITE_URL;?>restaurant-view-cart-Ajax.php" onSubmit="Post.Send(this); return false;" >
    <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("DELFROMCART"); ?>" />
    <input type="hidden" name="rest_id" id="rest_id_id" value="<?php echo $rest_id; ?>">
    <input type="hidden" name="user_basket_id" id="user_basket_id_id" value="">
    </form>
    <div class="col-sm-12"><h4>Shopping cart</h4></div>
    <div id="cart" class="col-sm-12">
    <?php
    echo '<span id="cart_rest_name">For '.$rest_name.':</span>';
    if($restObj->fun_checkCartNoEmpty($user_id) == true) {
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
        <div class="col-sm-12" id="delivery_order">
            <?php
            if(isset($restConf['delivery_type']) && $restConf['delivery_type'] == "1") {
            ?>
            <label class="radio-inline">
                <input name="dtype" id="pickup" value="pickup" type="radio" >PICKUP
            </label>
            <label class="radio-inline">
                <input name="dtype" id="delivery" checked="checked" value="delivery" type="radio">DELIVERY
            </label>
            <?php
            } else {
            ?>
            <label class="radio-inline">
                <input name="dtype" id="pickup" checked="checked" value="pickup" type="radio">PICKUP
            </label>
            <?php
            }
            ?>
        </div>
        <div  class="col-sm-12" id="max_order"> <span id="small_msg"> The minimum order for delivery is: <?php echo $currency_symbol.((isset($restConf['min_order']) && $restConf['min_order'] !="")?$restConf['min_order']:"00.00");?> <br>No minimum on Pickup orders </span> </div>
        <div  class="row" id="checkout_btn">
            <p class="text-center">
                <button class="btn btn-danger" type="button">Check Out</button>
            </p>
        </div>
    <?php
    }
    ?>
    </div>
</div>
<div class="clearfix">&nbsp;</div>
