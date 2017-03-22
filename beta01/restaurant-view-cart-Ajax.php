<?php
	if($_SERVER["SERVER_NAME"] == "localhost") {
		require_once($_SERVER["DOCUMENT_ROOT"]."/irest/beta01/includes/application-top.php");
	} else {
		require_once($_SERVER["DOCUMENT_ROOT"]."/projects/wdelivered2/beta01/includes/application-top.php");
	}

	require_once(SITE_CLASSES_PATH."class.Users.php");
	require_once(SITE_CLASSES_PATH."class.Restaurant.php");

	$usersObj 		= new Users();
	$restObj 		= new Restaurant();

	if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !=""){
		$user_id 			= $_SESSION['ses_user_id'];
		$userInfoArr 		= $usersObj->fun_getUsersInfo($user_id);
		$users_first_name 	= $userInfoArr['user_fname'];
		$users_last_name 	= $userInfoArr['user_lname'];
		$users_email_id 	= $userInfoArr['user_email'];
		$user_full_name 	= ucwords($users_first_name." ".$users_last_name);
		$country_id 		= $userInfoArr['user_country'];
	}

	$userCurrencyArr		= $usersObj->fun_getUserCurrencyInfo($user_id);
	$users_currency_id		= $userCurrencyArr['currency_id'];
	$users_currency_code 	= $userCurrencyArr['currency_code'];
	$users_currency_symbol 	= $userCurrencyArr['currency_symbol'];
	$users_currency_rate 	= $userCurrencyArr['currency_rate'];
	$users_currency_name 	= $userCurrencyArr['currency_name'];

	if(isset($_REQUEST['rest_id']) && $_REQUEST['rest_id'] !="") {
		$rest_id			= $_REQUEST['rest_id'];
		$rest_name			= $restObj->fun_getRestaurantNameById($rest_id);

		// Restaurant currency info
		$currencyArr			= $restObj->fun_getRestaurantCurrencyInfo($rest_id);
		$rest_currency_id		= $currencyArr['currency_id'];
		$rest_currency_code 	= $currencyArr['currency_code'];
		$rest_currency_symbol 	= $currencyArr['currency_symbol'];
		$rest_currency_rate 	= $currencyArr['currency_rate'];
		$rest_currency_name 	= $currencyArr['currency_name'];
		$currency_symbol		= ($users_currency_symbol == "")?$rest_currency_symbol:$users_currency_symbol;
		$currency_code			= ($users_currency_code == "")?$rest_currency_code:$users_currency_code;

		$restConf 				= $restObj->fun_getRestaurantConf($rest_id);
	}

	//print_r($_REQUEST);
	//Case I: if user id available insert it in database
	//form submission
	// Add new restaurant submit : Start here 
	if($_POST['securityKey']==md5("ADDTOCART")){
	   if(isset($user_id) && ($user_id != '') && isset($_POST['rest_id']) && ($_POST['rest_id'] != '') && isset($_POST['menu_id']) && ($_POST['menu_id'] != '') && isset($_POST['quantity']) && ($_POST['quantity'] != '')) {
			$rest_id			= $_POST['rest_id'];
			$menu_id			= $_POST['menu_id'];
			$menu_price_id    	= $_POST['menu_price_id'];
			$quantity 	    	= $_POST['quantity'];
			$order_comment		= $_POST['order_comment'];
			$radio_options		= $_POST['radio_options'];
			$select_options		= $_POST['select_options'];
			$options			= $_POST['options'];
			// Add New cart item 
			$restObj->fun_addCartItem($user_id, $rest_id, $menu_id, $quantity, $order_comment, $menu_price_id, $options, $radio_options, $select_options);
		} else if(($_POST['rest_id'] != '') && isset($_POST['menu_id']) && ($_POST['menu_id'] != '') && isset($_POST['quantity']) && ($_POST['quantity'] != '')) {
			$rest_id			= $_POST['rest_id'];
			$menu_id			= $_POST['menu_id'];
			$menu_price_id    	= $_POST['menu_price_id'];
			$quantity 	    	= $_POST['quantity'];
			$order_comment		= $_POST['order_comment'];
			$radio_options		= $_POST['radio_options'];
			$select_options		= $_POST['select_options'];
			$options			= $_POST['options'];
			ses_add_cart_item($rest_id, $menu_id, $quantity, $order_comment, $menu_price_id, $options, $radio_options, $select_options);
			//print_r($_POST);
		}	
		
	}

	if($_POST['securityKey']==md5("DELFROMCART")){
	   if(isset($_POST['user_basket_id']) && ($_POST['user_basket_id'] != '')) {
			$user_basket_id		= $_POST['user_basket_id'];
			// Del a cart item 
			$restObj->fun_delCartItem($user_basket_id);
		}	
	}

	if($_POST['securityKey']==md5("DELFROMSESCART")){
	   if(isset($_POST['user_basket_id']) && ($_POST['user_basket_id'] != '')) {
			$user_basket_id		= $_POST['user_basket_id'];
			// Del a session cart item 
			ses_del_cart_item($user_basket_id);
		}	
	}

//Case II: if user id not available insert it in session, each item will have a ses_basket_id

?>
<?php
echo '<span id="cart_rest_name">'.$rest_name.'</span>';
if($restObj->fun_checkCartNoEmpty($user_id) == true) {
	$restObj->fun_createCartView($user_id);
	//display empty cart
} else {
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
				<td valign="middle" height="30px" class="pad-btm15 pad-rgt5"><input name="dtype" id="pickup" <?php if(isset($_POST['dtype']) && $_POST['dtype'] =="pickup") {echo 'checked="checked" ';}?> value="pickup" onclick="change_cart(this);" type="radio" class="radio_cart"></td>
				<td valign="middle" height="30px">PICKUP</td>
				<td valign="middle" height="30px"><img src="<?php echo SITE_IMAGES; ?>delivery_bagN.png" alt="Pickup" border="0" height="27" width="31"></td>
			</tr>
		</table>
		</div>
		<div class="radio_dtype_cart radio_delivery_cart">
		<table width="100%" border="0" cellpadding="0" cellspacing="2">
			<tr>
				<td valign="middle" height="30px" class="pad-btm15 pad-rgt5"><input name="dtype" id="delivery"  <?php if(!isset($_POST['dtype']) || $_POST['dtype'] =="delivery") {echo 'checked="checked" ';}?> value="delivery" onclick="change_cart(this);" type="radio" class="radio_cart"></td>
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
