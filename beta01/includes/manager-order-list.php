<?php
/*
* Pagination : Start here
*/
$page	 = form_int("page",1)+0;
$sortby  = form_int("sortby",0,0,7);
$sortdir = form_int("sortdir",0,0,1);
if (form_isset("reverse")) {
    $sortdir = 1-$sortdir;
}
switch($sortdir) {
    case 0 : $orderDir = "ASC"; break;
    case 1 : $orderDir = "DESC"; break;
}
switch($sortby) {
    case 0: $sortField  = "A.order_id"; $orderDir = "ASC"; break;
    case 1: $sortField  = "A.order_id"; $orderDir = "DESC"; break;
    default: $sortField = "A.order_id"; $orderDir = "ASC"; break;
}
if(isset($user_id) && $user_id != "") { $search_query .= "&user_id=" . html_escapeURL($user_id); }
if(isset($_COOKIE['cook_records_per_page']) && $_COOKIE['cook_records_per_page'] != "") {
    $records_per_page = $_COOKIE['cook_records_per_page'];
} else {
    $records_per_page = GLOBAL_RECORDS_PER_PAGE;
}
$where = array();
/*
if($user_id) {
	array_push($where, " A.user_id='".$user_id."'");
}
*/
if(sizeof($where) > 0){
    $where_clause = " WHERE ".join($where, " AND ");
}
$strQueryParameter      = $where_clause." ORDER BY " . $sortField . " " . $orderDir. " LIMIT ".(int)(($page-1)*(int)$records_per_page).", ".$records_per_page;
$strQueryCountParameter = $where_clause." ORDER BY " . $sortField . " " . $orderDir;
$rsQuery                = $restObj->fun_getManagerOrderArr($user_id, $strQueryParameter);
$rsQueryCount           = $restObj->fun_getManagerOrderArr($user_id, $strQueryCountParameter);
$sort_query             = "sortby=" . html_escapeURL($sortby) ."&sortdir=" . html_escapeURL($sortdir);
if($dbObj->getRecordCount($rsQueryCount) > 0) {
    $odrListArr         = $dbObj->fetchAssoc($rsQuery);
    $total_orders       = $dbObj->getRecordCount($rsQueryCount);
    // Determine the pagination
    //	$return_query   = $search_query."&".$sort_query."&page=$page";
    $return_query       = $search_query."&page=$page";
    $pag                = new Pagination($rsQueryCount, $search_query, $records_per_page);
    $pag->current_page  = $page;
    $pagination         = $pag->Process();
?>
<div class="panel panel-default">
    <div class="panel-heading"><h3><?php echo $addtitle; ?></h3></div>
    <div class="panel-body">
        <div class="cols-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-md-1 text-center" align="center">ID</th>
                        <th class="col-md-1">Date/Time</th>
                        <th class="col-md-2">Address</th>
                        <th class="col-md-2">Schedule for</th>
                        <th class="col-md-1">Price</th>
                        <th class="text-center">Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for($i=0; $i < count($odrListArr); $i++) {
                        $order_id           = $odrListArr[$i]['order_id'];
                        $user_id            = $odrListArr[$i]['user_id'];
                        $delivery_fname     = $odrListArr[$i]['delivery_fname'];
                        $delivery_lname     = $odrListArr[$i]['delivery_lname'];
                        $delivery_address1  = $odrListArr[$i]['delivery_address1'];
                        $delivery_address2  = $odrListArr[$i]['delivery_address2'];
                        $delivery_city      = $odrListArr[$i]['delivery_city'];
                        $delivery_state     = $odrListArr[$i]['delivery_state'];
                        $delivery_country   = $odrListArr[$i]['delivery_country'];
                        $delivery_zip       = $odrListArr[$i]['delivery_zip'];
                        $dtype              = $odrListArr[$i]['dtype'];
                        $schedule           = $odrListArr[$i]['schedule'];
                        $order_comments     = $odrListArr[$i]['order_comments'];
                        $payment_method     = $odrListArr[$i]['payment_method'];
                        $cc_type            = $odrListArr[$i]['cc_type'];
                        $cc_owner           = $odrListArr[$i]['cc_owner'];
                        $cc_number          = $odrListArr[$i]['cc_number'];
                        $cc_expires         = $odrListArr[$i]['cc_expires'];
                        $final_price        = $odrListArr[$i]['final_price'];
                        $currency_id        = $odrListArr[$i]['currency_id'];
                        $last_modified      = $odrListArr[$i]['last_modified'];
                        $date_purchased     = $odrListArr[$i]['date_purchased'];
                        $orders_status      = $odrListArr[$i]['orders_status'];
                        $orders_date_finished = $odrListArr[$i]['orders_date_finished'];
                        $delivery_name        = ucwords($delivery_fname.' '.$delivery_lname);
                        $addressArr           = array();
                        if($delivery_address1 != "") {
                            array_push($addressArr, $delivery_address1);
                        }
                        if($delivery_address2 != "") {
                            array_push($addressArr, $delivery_address2);
                        }
                        if($delivery_city != "") {
                            array_push($addressArr, $delivery_city);
                        }
                        if($delivery_state != "") {
                            array_push($addressArr, $delivery_state);
                        }
                        if($delivery_zip != "") {
                            array_push($addressArr, $delivery_zip);
                        }
                        $address      = implode(", ", $addressArr);
                        $schedule_for = $schedule.' ['.ucfirst($dtype).']';
                        if(isset($orders_status) && $orders_status != "") {
                            switch($orders_status) {
                                case '1':
                                    $status = "New order";
                                break;
                                case '2':
                                    $status = "Pending";
                                break;
                                case '3':
                                    $status = "PayPal Preparation";
                                break;
                                case '4':
                                    $status = "Complete";
                                break;
                                case '5':
                                    $status = "Cancel";
                                break;
                                default:
                                    $status = "New order";
                            }
                        } else {
                            $status = "New order";
                        }
                        $currencyArr     = $restObj->fun_getCurrencyInfo($currency_id);
                        $currency_symbol = $currencyArr['currency_symbol'];
                        $currency_code   = $currencyArr['currency_code'];
                    ?>
                    <tr>
                        <td align="center"><?php echo fill_zero_left($order_id, "0", (6-strlen($order_id)));?></td>
                        <td align="center"><?php echo date('Y-m-d H:i:s', $date_purchased); ?></td>
                        <td align="left"><?php echo $address; ?></td>
                        <td align="center"><?php echo $schedule_for; ?></td>
                        <td align="left"><?php echo $currency_symbol.number_format($final_price, 2); ?></td>
                        <td align="center"><?php echo $status; ?></td>
                        <td align="right">
                            <a href="manager-orders.php?sec=edit&order_id=<?php echo $order_id; ?>" class="btn btn-success btn-small">Update</a> <a href="manager-orders.php?sec=view&order_id=<?php echo $order_id; ?>" class="btn btn-success btn-small">View</a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div>
    <div class="col-md-6">
        <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." orders";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." order";} ?></strong>
    </div>
    <div class="col-md-6 text-right">
        <?php if( ! empty($pagination['pages']) ) : ?>
        <ul class="pagination">
            <?php
            if( ! empty($pagination['prev']) ) {
                echo '<li><a href="' . $pagination['prev'] . '">Previous</a></li>';
            }
            if ( ( $pagination['pages'][0]['no']) > 1 ) {
                echo '<li>...</li>';
            }
            foreach($pagination['pages'] as $key => $value) {
                if(isset($value['link']) && $value['link'] != "") {
                    echo '<li><a href="'.$value['link'].'">'.($value['no']).'</a></li>';
                } else {
                    echo '<li>'.($value['no']).'</li>';
                }
            }
            if(($pagination['pages'][count($pagination['pages'])-1]['no']) < ($pagination['total_rows']/GLOBAL_RECORDS_PER_PAGE)) {
                echo '<li>...</li>';
            }
            if(isset($pagination['next']) && $pagination['next'] !="") {
                echo '<li><a href="'.$pagination['next'].'">Next</a></li>';
            }
            ?>
        </ul>
        <?php endif; ?>
    </div>
</div>
<?php
} else {
?>
<div class="panel panel-default">
    <div class="panel-heading"><h3>Manage Orders</h3></div>
    <div class="panel-body">
        <div class="cols-md-12">
            <ul class="list-unstyled pull-right list-inline">
                <li><a href="<?php echo base64_decode($_GET['back_url']); ?>" class="btn btn-success">Back to Restaurant</a></li>
            </ul>
        </div>
        <div class="clearfix"><br><br></div>
        <div class="cols-md-12">
            <p class="text-warning">No Orders available!</p>
        </div>
    </div>
</div>
<?php
}
?>
