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
	<div class="col-sm-12">
    <?php
    echo '<span id="cart_rest_name">'.$rest_name.'</span>';
	if($restObj->fun_checkCartNoEmpty($user_id) == true) {
		$restObj->fun_createCartView($user_id);
	} else {
		//display empty cart
	?>
        <div id="title_item" class="cart_title">Item</div>
        <div id="title_qtd" class="cart_title">Qty</div>
        <div id="title_price" class="cart_title">Price</div>
        <div id="title_del" class="cart_title">Del</div>
        <div class="cart_empty">Your cart is empty</div>
        <div class="cartHr"></div>
        <span class="sumary_title">Subtotal: </span>
        <span class="sumary">0.00</span>
        <span class="sumary_title">Tax: </span>
        <span class="sumary">0.00</span>
        <span class="sumary_title">Delivery Fee: </span>
        <span class="sumary"><span class="sumary_red">0.00</span></span>
    
        <div id="total">
            <span>Total: &nbsp;</span> <span><?php echo $currency_symbol;?>0.00</span>
        </div>
        <div id="delivery_order">
            <?php
			if(isset($restConf['delivery_type']) && $restConf['delivery_type'] == "1") {
			?>
            <div class="radio_dtype_cart radio_pickup_cart">
            <table width="100%" border="0" cellpadding="0" cellspacing="2">
                <tr>
                    <td valign="middle" height="30px" class="pad-btm15 pad-rgt5"><input name="dtype" id="pickup" value="pickup" type="radio" class="radio_cart"></td>
                    <td valign="middle" height="30px">PICKUP</td>
                    <td valign="middle" height="30px"><img src="<?php echo SITE_IMAGES; ?>delivery_bagN.png" alt="Pickup" border="0" height="27" width="31"></td>
                </tr>
            </table>
            </div>
            <div class="radio_dtype_cart radio_delivery_cart">
            <table width="100%" border="0" cellpadding="0" cellspacing="2">
                <tr>
                    <td valign="middle" height="30px" class="pad-btm15 pad-rgt5"><input name="dtype" id="delivery" checked="checked" value="delivery" type="radio" class="radio_cart"></td>
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
                    <td valign="middle" height="30px" class="pad-btm15 pad-rgt5"><input name="dtype" id="pickup" checked="checked" value="pickup" type="radio" class="radio_cart"></td>
                    <td valign="middle" height="30px">PICKUP</td>
                    <td valign="middle" height="30px"><img src="<?php echo SITE_IMAGES; ?>delivery_bagN.png" alt="Pickup" border="0" height="27" width="31"></td>
                </tr>
            </table>
            </div>
            <?php
			}
			?>
        </div>
        <div id="max_order"> <span id="small_msg"> The minimum order for delivery is: <?php echo $currency_symbol.((isset($restConf['min_order']) && $restConf['min_order'] !="")?$restConf['min_order']:"00.00");?> <br>No minimum on Pickup orders </span> </div>
        <div id="checkout_btn"> <a href="javascript:void(0);" title="Check Out"> <img src="<?php echo SITE_IMAGES; ?>checkout_greyN2.png" alt="Check Out" border="0" height="37" width="291"> </a> </div>
    <?php
	}
    ?>
	</div>
</div>
