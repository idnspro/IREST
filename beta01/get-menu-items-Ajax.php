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

if ( ! empty( $_GET['menu_id'] ) ) {
    $menu_id              = $_GET['menu_id'];
    $menuInfo             = $restObj->fun_getMenuInfoById($menu_id);
    $menu_price_arr       = $restObj->fun_getMenuPriceArrByMenuId($menu_id);
    $selected_id          = $menu_price_arr[0]['price_id'];
    $rest_id              = $menuInfo['rest_id'];
    $currencyArr          = $restObj->fun_getRestaurantCurrencyInfo($rest_id);
    $rest_currency_id     = $currencyArr['currency_id'];
    $rest_currency_code   = $currencyArr['currency_code'];
    $rest_currency_symbol = $currencyArr['currency_symbol'];
    $rest_currency_rate   = $currencyArr['currency_rate'];
    $rest_currency_name   = $currencyArr['currency_name'];
    $currency_symbol      = ($users_currency_symbol == "")?$rest_currency_symbol:$users_currency_symbol;
    $currency_code        = ($users_currency_code == "")?$rest_currency_code:$users_currency_code;
    ?>
    <script language="javascript">
    function setPriceId(val) {
        document.getElementById("menu_price_id").value = val;
    }
    </script>
    <style type="text/css">
        #rest-menu-price {
            width:100%;
            height:auto;
            margin:0px;
            padding:0px 5px 0px 5px;
        }
        .head-title {
            width:98%;
            height:28px;
            background-color:#a70100;
            font-size:16px;
            font-weight:bold;
            text-align:center;
            color:#fff;
            margin-bottom:10px;
            padding:5px 5px 5px 5px;
        }
        .menu-title {
            font-size:20px;
            font-weight:normal;
            text-align:left;
            color:#03145f;
            padding:5px 5px 5px 5px;
        }
        .menu-box {
            background-color:#f0f5f8;
            border:thin #ddd solid;
            margin:10px 5px 10px 5px;
            padding:5px 5px 5px 5px;
            -moz-border-radius:5px;
            -webkit-border-radius:5px;
            border-radius:5px;
        }
        .button-grey {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1.2em;
            font-weight: bold;
            text-align:center;
            vertical-align: middle;
            text-decoration:none;
            margin-right:.5em;
            color: #666;
            border:none;
            width:auto;
            height:30px;
            background-color:#2978a3;
            background-image: -moz-linear-gradient(top, #e7e7e7, #dcdcdc);
            border-radius:3px;
            -o-border-radius:3px;
            -moz-border-radius:3px;
            padding:5px 10px 5px 10px;
            cursor:pointer;
        }
        .button-blue {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1.2em;
            font-weight: bold;
            text-align:center;
            vertical-align: middle;
            margin-right:.5em;
            color: #fff;
            border:none;
            width:auto;
            height:30px;
            background-color:#357bdc;
            background-image: -moz-linear-gradient(top, #357bdc, #357bdc);
            border-radius:3px;
            -o-border-radius:3px;
            -moz-border-radius:3px;
            padding:5px 10px 5px 10px;
            cursor:pointer;
        }
        .button-red {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1.2em;
            font-weight: bold;
            text-align:center;
            vertical-align: middle;
            margin-right:.5em;
            color: #fff;
            border:none;
            width:auto;
            height:30px;
            background-color:#ab0101;
            background-image: -moz-linear-gradient(top, #ab0101, #ab0101);
            border-radius:3px;
            -o-border-radius:3px;
            -moz-border-radius:3px;
            padding:5px 10px 5px 10px;
            cursor:pointer;
        }
        .checkbox, .radio {
            height: 13px;
            width: 13px;
            cursor:default;
        }
        select.select310 {
            width:311px;
            height:30px;
            margin: 1em 0 0 0;
            padding:5px;
            border:1px solid #CCCCCC;
            background:url(../../images/input-bg.gif) repeat-x;
        }
        body:first-of-type select.select310 {
            width:311px;
            height:30px;
            margin: 1em 0 0 0;
            padding:5px;
            border:1px solid #CCCCCC;
            background:url(../../images/input-bg.gif) repeat-x;
        }
        select.select80 {
            width:80px;
            height:30px;
            margin: 1em 0 0 0;
            padding:5px;
            border:1px solid #CCCCCC;
            background:url(../../images/input-bg.gif) repeat-x;
        }
        body:first-of-type select.select80 {
            width:80px;
            height:30px;
            margin: 1em 0 0 0;
            padding:5px;
            border:1px solid #CCCCCC;
            background:url(../../images/input-bg.gif) repeat-x;
        }
        textarea.txtarea_500x150 {
            height: 100px;
            width: 100%;
            border: 1px solid #9F9F9F;
            margin: 0px;
            padding: 2px 2px 0px;
            background: #FFFFFF;
            line-height:18px;
        }
        .node-options {
            margin-top:0px;
            margin-bottom:10px;
        }
        .node-options ul {
            margin-bottom:0px;
            margin-top:0px;
            list-style:none;
            width:100%;
        }
        .node-options ul li {
            list-style:none;
            margin:0px;
            width:130px;
            display:inline;
            padding:2px 2px;
            white-space:nowrap;
            list-style-position:outside;
        }
        .node-options a {
            color:#333;
            text-decoration:none;
            font-size:12px;
        }
        .node-options a:visited {
            color:#333;
            text-decoration:none;
            font-size:12px;
        }
        .node-options a:hover {
            color:#333;
            text-decoration:none;
            font-size:12px;
        }
    </style>
    <?php
    echo '<form name="frmAddToCart" id="frmAddToCart" method="post" action="'.SITE_URL.'restaurant-view-cart-Ajax.php" onSubmit="Post.Send(this); return false;" >';
    echo '<input type="hidden" name="securityKey" id="securityKey" value="'.md5("ADDTOCART").'" />';
    echo '<input type="hidden" name="rest_id" id="rest_id_id" value="'.$menuInfo['rest_id'].'">';
    echo '<input type="hidden" name="menu_id" id="menu_id_id" value="'.$menuInfo['menu_id'].'">';
    if(isset($_GET['dtype']) && $_GET['dtype'] =="delivery"){
        echo '<input type="hidden" name="dtype" id="dtype" value="delivery">';
    } else {
        echo '<input type="hidden" name="dtype" id="dtype" value="pickup">';
    }
    if(!isset($menuInfo['base_price']) || (isset($menuInfo['base_price']) && $menuInfo['base_price'] > 0) || (isset($menuInfo['base_price']) && $menuInfo['base_price'] !="")){
        //Nothing
    }else{
        echo '<input type="hidden" name="menu_price_id" id="menu_price_id" value="'.$menu_price_arr[0]['price_id'].'">';
    }
    echo '<div id="rest-menu-price" align="center">';
    echo '<div class="head-title">Add item to Cart</div>';
    //echo '<div class="menu-title">'.ucfirst($menuInfo['menu_name']).'</div>';
    echo '<div class="menu-box">';
    echo '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="font12">';
    echo '<tr>';
    echo '<td width="20%" style="padding-top:5px; padding-bottom:5px;">Price</td>';
    if (!isset($menuInfo['base_price']) || (isset($menuInfo['base_price']) && $menuInfo['base_price'] > 0) || (isset($menuInfo['base_price']) && $menuInfo['base_price'] !="")){
        echo '<td width="80%" style="padding-top:5px; padding-bottom:5px;">'.$users_currency_symbol.(number_format(($menuInfo['base_price']/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code],2)).'</td>';
    } else {
        echo '<td width="80%" style="padding-top:5px; padding-bottom:5px;">';
        echo '<div class="node-options">';
        echo '<ul>';
        for($k=0; $k < count($menu_price_arr); $k++) {
            $selected = ($menu_price_arr[$k]['price_id'] == $selected_id)?' checked="checked" ':'';
            echo '<li><input type="radio" class="radio" name="menu_price" id="menu_price'.$menu_price_arr[$k]['price_id'].'" value="'.$menu_price_arr[$k]['price_id'].'" '.$selected.' onclick="setPriceId(this.value);" >&nbsp;<a href="javascript:void(0);" title="'.ucwords($menu_price_arr[$k]['price_name']).'">'.ucwords($menu_price_arr[$k]['price_name']).' - '.$users_currency_symbol.(number_format(($menu_price_arr[$k]['price']/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code],2)).'</a></li>';
        }
        echo '</ul>';
        echo '</div>';
        echo '</td>';
    }
    echo '</tr>';
    echo '<tr><td colspan="2" style="border-bottom:thin #ccc dotted; height:3px;"></td></tr>';
    echo '<tr>';
    echo '<td style="padding-top:5px; padding-bottom:5px;">Quantity</td>';
    echo '<td style="padding-top:5px; padding-bottom:5px;">';
    switch($menuInfo['quantity_id']) {
        case '1':
            $restObj->fun_createSelectNumField("quantity", "quantity_id", "select80", 1, "1", 1, 20);
        break;
        case '2':
            $restObj->fun_createSelectPiecesField("quantity", "quantity_id", "select80", 1, "1", 1, 20);
        break;
        case '3':
            $restObj->fun_createSelectSMLField("quantity", "quantity_id", "select80", 1, "1");
        break;
        case '4':
            $restObj->fun_createSelectSMLField("quantity", "quantity_id", "select80", 1, "1");
        break;
        case '5':
            $restObj->fun_createSelectSDField("quantity", "quantity_id", "select80", 1, "1");
        break;
        default:
            $restObj->fun_createSelectNumField("quantity", "quantity_id", "select80", 1, "1", 1, 20);
    }
    echo '</td>';
    echo '</tr>';
    echo '<tr><td colspan="2" style="border-bottom:thin #ccc dotted; height:3px;"></td></tr>';
    //For menu options
    $restObj->fun_createMenuOptionView($menu_id);
    echo '<tr>';
    echo '<td align="left" valign="top" style="padding-top:5px; padding-bottom:5px;">Special Instructions</td>';
    echo '<td style="padding-top:5px; padding-bottom:5px;">';
    echo '<textarea type="text" name="order_comment" id="order_comment_id" class="txtarea_500x150"></textarea>';
    echo '<span style="font-size:11px;"><em>Example: hold the onions, etc. Additional charges may apply.</em></span>';
    echo '</td>';
    echo '</tr>';
    echo '<tr><td colspan="2" style="border-bottom:thin #ccc dotted; height:3px;"></td></tr>';
    echo '</table>';
    echo '</div>';
    echo '<div align="center">';
    echo '<a href="javascript:void(0);" id="AddToCartID" class="button-red">Add to cart</a>';
    echo '</div>';
    echo '</div>';
    echo '</form>';
} else {
    echo 'Error: Menu not selected!!';
}
