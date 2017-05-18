<?php
require_once __DIR__ . '/includes/application-top.php';
require_once SITE_CLASSES_PATH . 'class.Users.php';
require_once SITE_CLASSES_PATH . 'class.Restaurant.php';
$usersObj = new Users();
$restObj  = new Restaurant();
if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !=""){
    $user_id          = $_SESSION['ses_user_id'];
    $userInfoArr      = $usersObj->fun_getUsersInfo($user_id);
    $users_first_name = $userInfoArr['user_fname'];
    $users_last_name  = $userInfoArr['user_lname'];
    $users_email_id   = $userInfoArr['user_email'];
    $user_full_name   = ucwords($users_first_name." ".$users_last_name);
    $country_id       = $userInfoArr['user_country'];
}
$userCurrencyArr       = $usersObj->fun_getUserCurrencyInfo($user_id);
$users_currency_id     = $userCurrencyArr['currency_id'];
$users_currency_code   = $userCurrencyArr['currency_code'];
$users_currency_symbol = $userCurrencyArr['currency_symbol'];
$users_currency_rate   = $userCurrencyArr['currency_rate'];
$users_currency_name   = $userCurrencyArr['currency_name'];

if(isset($_REQUEST['rest_id']) && $_REQUEST['rest_id'] !="") {
    $rest_id              = $_REQUEST['rest_id'];
    $rest_name            = $restObj->fun_getRestaurantNameById($rest_id);
    $currencyArr          = $restObj->fun_getRestaurantCurrencyInfo($rest_id);
    $rest_currency_id     = $currencyArr['currency_id'];
    $rest_currency_code   = $currencyArr['currency_code'];
    $rest_currency_symbol = $currencyArr['currency_symbol'];
    $rest_currency_rate   = $currencyArr['currency_rate'];
    $rest_currency_name   = $currencyArr['currency_name'];
    $currency_symbol      = ($users_currency_symbol == "")?$rest_currency_symbol:$users_currency_symbol;
    $currency_code        = ($users_currency_code == "")?$rest_currency_code:$users_currency_code;
    $restConf             = $restObj->fun_getRestaurantConf($rest_id);
}

//Case I: if user id available insert it in database
// Add new restaurant submit : Start here 
if($_POST['securityKey']==md5("ADDTOCART")){
    if(isset($user_id) && ($user_id != '') && isset($_POST['rest_id']) && ($_POST['rest_id'] != '') && isset($_POST['menu_id']) && ($_POST['menu_id'] != '') && isset($_POST['quantity']) && ($_POST['quantity'] != '')) {
        $rest_id        = $_POST['rest_id'];
        $menu_id        = $_POST['menu_id'];
        $menu_price_id  = $_POST['menu_price_id'];
        $quantity       = $_POST['quantity'];
        $order_comment  = $_POST['order_comment'];
        $radio_options  = $_POST['radio_options'];
        $select_options = $_POST['select_options'];
        $options        = $_POST['options'];
        $restObj->fun_addCartItem($user_id, $rest_id, $menu_id, $quantity, $order_comment, $menu_price_id, $options, $radio_options, $select_options);
    } else if(($_POST['rest_id'] != '') && isset($_POST['menu_id']) && ($_POST['menu_id'] != '') && isset($_POST['quantity']) && ($_POST['quantity'] != '')) {
        $rest_id        = $_POST['rest_id'];
        $menu_id        = $_POST['menu_id'];
        $menu_price_id  = $_POST['menu_price_id'];
        $quantity       = $_POST['quantity'];
        $order_comment  = $_POST['order_comment'];
        $radio_options  = $_POST['radio_options'];
        $select_options = $_POST['select_options'];
        $options        = $_POST['options'];
        ses_add_cart_item($rest_id, $menu_id, $quantity, $order_comment, $menu_price_id, $options, $radio_options, $select_options);
    }	
}

if($_POST['securityKey'] == md5("DELFROMCART")){
    if(isset($_POST['user_basket_id']) && ($_POST['user_basket_id'] != '')) {
        $user_basket_id = $_POST['user_basket_id'];
        $restObj->fun_delCartItem($user_basket_id);
    }	
}

if($_POST['securityKey'] == md5("DELFROMSESCART")){
    if(isset($_POST['user_basket_id']) && ($_POST['user_basket_id'] != '')) {
        $user_basket_id = $_POST['user_basket_id'];
        ses_del_cart_item($user_basket_id);
    }	
}

//Case II: if user id not available insert it in session, each item will have a ses_basket_id
?>
<?php
echo '<span id="cart_rest_name">For '.$rest_name.':</span>';
if($restObj->fun_checkCartNoEmpty($user_id) == true) {
    $restObj->fun_getCartView($user_id);
} else {
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
