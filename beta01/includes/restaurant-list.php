<?php
/*
* Pagination : Start here
*/
$page    = form_int("page",1)+0;
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
    case 0: $sortField  = "A.updated_on"; $orderDir = "DESC"; break;
    case 1: $sortField  = "A.rest_name"; $orderDir = "ASC"; break;
    default: $sortField = "A.updated_on"; $orderDir = "DESC"; break;
}
//if(isset($_REQUEST['page_type']) && $_REQUEST['page_type'] != "") { $page_type = form_text("page_type"); $page_type = stripslashes($page_type); }
//if(isset($page_type) && $page_type != "") { $search_query .= "&page_type=" . html_escapeURL($page_type); }
if(isset($_COOKIE['cook_records_per_page']) && $_COOKIE['cook_records_per_page'] != "") {
    $records_per_page = $_COOKIE['cook_records_per_page'];
} else {
    $records_per_page = GLOBAL_RECORDS_PER_PAGE;
}
$where = array();
if($user_id) {
    array_push($where, " A.rest_id IN (SELECT rest_id FROM ".TABLE_RESTAURANT_MANAGER_RELATIONS." WHERE manager_id='".$user_id."') ");
}
if(sizeof($where) > 0){
    $where_clause = " WHERE ".join($where, " AND ");
}
$strQueryParameter      = $where_clause." ORDER BY " . $sortField . " " . $orderDir. " LIMIT ".(int)(($page-1)*(int)$records_per_page).", ".$records_per_page;
$strQueryCountParameter = $where_clause." ORDER BY " . $sortField . " " . $orderDir;
$rsQuery                = $restObj->fun_getRestaurantArr($strQueryParameter);
$rsQueryCount           = $restObj->fun_getRestaurantArr($strQueryCountParameter);
$sort_query             = "sortby=" . html_escapeURL($sortby) ."&sortdir=" . html_escapeURL($sortdir);
if($dbObj->getRecordCount($rsQueryCount) > 0) {
    $restListArr       = $dbObj->fetchAssoc($rsQuery);
    $total_restaurants = $dbObj->getRecordCount($rsQueryCount);
    // Determine the pagination
    //	$return_query  = $search_query."&".$sort_query."&page=$page";
    $return_query      = $search_query."&page=$page";
    $pag               = new Pagination($rsQueryCount, $search_query, $records_per_page);
    $pag->current_page = $page;
    $pagination        = $pag->Process();
?>
<div class="panel panel-default">
    <div class="panel-heading"><h3>Restaurant Listing</h3></div>
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="col-md-1 text-center">ID</th>
                    <th class="col-md-2 text-center">Logo</th>
                    <th class="col-md-2">Name</th>
                    <th class="col-md-4">Address</th>
                    <th class="col-md-1">Active</th>
                    <th class="col-md-2 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            for($i=0; $i < count($restListArr); $i++) {
                $rest_id       = $restListArr[$i]['rest_id'];
                $rest_name     = $restListArr[$i]['rest_name'];
                $rest_logo     = $restListArr[$i]['rest_logo'];
                $logo_url      = RESTAURANT_IMAGES_LOGO_PATH.$rest_logo;
                $rest_address1 = $restListArr[$i]['rest_address1'];
                $rest_address2 = $restListArr[$i]['rest_address2'];
                $rest_zip      = $restListArr[$i]['rest_zip'];
                $rest_address  = $rest_address1.", ".$rest_address2." ".$rest_zip;
                $status        = (isset($restListArr[$i]['active']) && $restListArr[$i]['active']=="1")?"Yes":"No";
            ?>
                <tr>
                    <td align="center"><a href="manager-restaurants.php?sec=edit&rest_id=<?php echo $rest_id; ?>" class="text-success"><?php echo fill_zero_left($rest_id, "0", (6-strlen($rest_id)));?></a></td>
                    <td align="center"><img src="<?php echo $logo_url; ?>" onerror="this.src='<?php echo RESTAURANT_IMAGES_LOGO_PATH.'no-img80X60.gif';?>'" width="80" height="60" border="0" /></td>
                    <td><?php echo $rest_name; ?></td>
                    <td><?php echo $rest_address;?></td>
                    <td><?php echo $status;?></td>
                    <td align="center"><a href="manager-restaurants.php?sec=edit&rest_id=<?php echo $rest_id; ?>" class="btn btn-success">Edit</a></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
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
    <div class="panel-heading"><h3>Restaurant Listing</h3></div>
    <div class="panel-body">
        <p class="text-warning">No Restaurant available!</p>
    </div>
</div>
<?php
}
?>
