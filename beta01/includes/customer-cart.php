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
<form name="frmDelFromCart" id="frmDelFromCart" method="post" action="<?php echo SITE_URL;?>restaurant-view-cart-Ajax.php" onSubmit="Post.Send(this); return false;" >
<input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("DELFROMCART"); ?>" />
<input type="hidden" name="rest_id" id="rest_id_id" value="<?php echo $rest_id; ?>">
<input type="hidden" name="user_basket_id" id="user_basket_id_id" value="">
</form>
<div class="register">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td valign="top">
                <div class="box-checkout-left">
                    <div id="sectionId2" class="box-checkout-left-wrapper">
                    <!-- checkout info -->
                        <h1>My Cart</h1>
                        <?php
                        if($restObj->fun_checkCartNoEmpty($user_id) == true) {
                            $final_price = $restObj->fun_getCheckoutCartAmt($user_id);
                            $currency_id = 1;
                        ?>
                        <br><br>
                        <span class="font12">Check your cart item in right panel & checkout here.</span> &nbsp;
                        <a href="<?php echo SITE_URL;?>checkout.php" class="button-blue">Checkout</a>
                        <br><br>
                        <?php
                        } else {
                            //display message
                            echo '<br><br><span class="font12 red">Your cart is empty!</span><br><br>';
                        }
                        ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="box-checkout-right">
                    <div class="box-checkout-right-wrapper">
                        <!-- order info -->
                        <link rel="stylesheet" type="text/css" href="<?php echo SITE_CSS_INCLUDES_PATH;?>cart.css" />
                        <h4>Your Cart</h4>
                        <div id="cart">
                            <?php
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
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </td>
        </tr>
    </table>
    <div class="clearfix"> </div>
</div>

