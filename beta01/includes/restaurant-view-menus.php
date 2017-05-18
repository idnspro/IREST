<?php
//echo "I am here";

$restMenuCatArr       = $restObj->fun_getRestaurantMenuCatArrHavingMenu($rest_id);
//print_r($restMenuCatArr);
$currencyArr          = $restObj->fun_getRestaurantCurrencyInfo($rest_id);
$rest_currency_id     = $currencyArr['currency_id'];
$rest_currency_code   = $currencyArr['currency_code'];
$rest_currency_symbol = $currencyArr['currency_symbol'];
$rest_currency_rate   = $currencyArr['currency_rate'];
$rest_currency_name   = $currencyArr['currency_name'];

if (is_array($restMenuCatArr) && !empty($restMenuCatArr)) {
?>
<script type="text/javascript">
    jQuery(function($){
        $('a.menu-list-item').click(function(e){
            e.preventDefault();
            var uid = $(this).data('id');
            var title = $(this).data('name');
            var menu_url = "<?php echo SITE_URL; ?>get-menu-items-Ajax.php?menu_id=" + uid + "&dtype='<?php echo ((isset($_COOKIE['cook_dtype']) && $_COOKIE['cook_dtype'] !="")?$_COOKIE['cook_dtype']:"delivery"); ?>'";
            $.get( menu_url, function(html){
                $('#menuModal .modal-title').html(title);
                $('#menuModal .modal-body').html(html);
                $('#menuModal').modal('show', {backdrop:'static',keyboard:false, show:true});
                $('#AddToCartID').click(function(){
                    Post.Send(document.getElementById('frmAddToCart'));
                    $('#menuModal').modal('hide');
                });
            });
        });
    });
</script>
<div id="rest-menu" class="row">
    <ul class="list-group">
    <?php
    for ($i=0; $i < count($restMenuCatArr); $i++) {
        $category_id   = $restMenuCatArr[$i]['category_id'];
        $category_name = $restMenuCatArr[$i]['category_name'];
        $restMenuArr   = $restObj->fun_getRestaurantMenuArrByCatId($rest_id, $category_id);
        echo '<li class="list-group-item">';
        echo '<a href="#" class="menu-head">'.ucwords($category_name).'</a>';
        echo '<div class="menu-content">';
        echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
        if (is_array($restMenuArr) && !empty($restMenuArr)) {
            for ($j=0; $j < count($restMenuArr); $j++) {
                $menu_id        = $restMenuArr[$j]['menu_id'];
                $menu_name      = $restMenuArr[$j]['menu_name'];
                $menu_desc      = $restMenuArr[$j]['menu_desc'];
                $base_price     = $restMenuArr[$j]['base_price'];
                $menu_price_arr = $restObj->fun_getMenuPriceArrByMenuId($menu_id);
                $price_arr      = array();
                $price_str      = '';
                if (is_array($menu_price_arr) && !empty($menu_price_arr)) {
                    for ($k=0; $k < count($menu_price_arr); $k++) {
                        array_push($price_arr, $menu_price_arr[$k]['price']);
                        $price_str    .= $menu_price_arr[$k]['price_name']." - ".$users_currency_symbol.(number_format(($menu_price_arr[$k]['price']/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code], 2))."\n";
                    }
                }
                echo '<tr>';
                echo '<td align="left" valign="top" class="pad-top5 pad-btm5" style="border-bottom:thin #ccc dotted;">';
                if (isset($restConf['online_order']) && $restConf['online_order'] =="1") {
                    echo '<a data-id="'.$menu_id.'" data-name="'.ucwords($menu_name).'" class="menu-list-item" style="text-decoration:none;">';
                    echo '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="font12">';
                    echo '<tr>';
                    echo '<td align="left" valign="top">';
                    echo '<span style="color:#03145f;"><strong>'.ucwords($menu_name).'</strong></span>';
                    echo '<br />';
                    echo '<span style="color:#666666; font-size:11px;">'.ucfirst($menu_desc).'</span>';
                    echo '</td>';
                    if (!isset($base_price) || (isset($base_price) && $base_price > 0) || (isset($base_price) && $base_price !="")) {
                        echo '<td align="right" valign="top" width="10%" style="background:url(../images/plus.gif) top right no-repeat; padding-right:30px;"><span style="color:#666666; font-size:16px; font-weight:bold;">'.$users_currency_symbol.(number_format(($base_price/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code], 2)).'</span></td>';
                    } else {
                        echo '<td align="right" valign="top" width="10%" style="background:url(../images/plus.gif) top right no-repeat; padding-right:30px;"><span style="color:#666666; font-size:16px; font-weight:bold;" title="'.$price_str.'">'.$users_currency_symbol.((is_array($price_arr) && !empty($price_arr))?(number_format((min($price_arr)/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code], 2)):(number_format(($base_price/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code], 2))).'</span></td>';
                    }
                    echo '</tr>';
                    echo '</table>';
                    echo '</a>';
                } else {
                    //echo '<a class="menu-list-item" href="'.SITE_URL.'get-menu-items-Ajax.php?menu_id='.$menu_id.'&dtype='.((isset($_COOKIE['cook_dtype']) && $_COOKIE['cook_dtype'] !="")?$_COOKIE['cook_dtype']:"delivery").'" style="text-decoration:none;">';
                    echo '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="font12">';
                    echo '<tr>';
                    echo '<td align="left" valign="top">';
                    echo '<span style="color:#03145f;"><strong>'.ucwords($menu_name).'</strong></span>';
                    echo '<br />';
                    echo '<span style="color:#666666; font-size:11px;">'.ucfirst($menu_desc).'</span>';
                    echo '</td>';
                    if (!isset($base_price) || (isset($base_price) && $base_price > 0) || (isset($base_price) && $base_price !="")) {
                        echo '<td align="right" valign="top" width="10%"><span style="color:#666666; font-size:16px; font-weight:bold;">'.$users_currency_symbol.(number_format(($base_price/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code], 2)).'</span></td>';
                    } else {
                        echo '<td align="right" valign="top" width="10%"><span style="color:#666666; font-size:16px; font-weight:bold;" title="'.$price_str.'">'.$users_currency_symbol.((is_array($price_arr) && !empty($price_arr))?(number_format((min($price_arr)/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code], 2)):(number_format(($base_price/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code], 2))).'</span></td>';
                    }
                    echo '</tr>';
                    echo '</table>';
                    //echo '</a>';
                }
                echo '</td>';
                echo '</tr>';
            }
        }
        echo '</table>';
        echo '</div>';
        echo '</li>';
    }
    ?>
    </ul>
</div>
<?php
}
?>
