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
    case 0: $sortField  = "A.menu_name"; $orderDir = "ASC"; break;
    default: $sortField = "A.menu_name"; $orderDir = "ASC"; break;
}
if(isset($_REQUEST['rest_id']) && $_REQUEST['rest_id'] != "") { $rest_id = form_text("rest_id"); $rest_id = stripslashes($rest_id); }
if(isset($_REQUEST['sec']) && $_REQUEST['sec'] != "") { $sec = form_text("sec"); $sec = stripslashes($sec); }
if(isset($rest_id) && $rest_id != "") { $search_query .= "&rest_id=" . html_escapeURL($rest_id); }
if(isset($sec) && $sec != "") { $search_query .= "&sec=" . html_escapeURL($sec); }
if(isset($_COOKIE['cook_records_per_page']) && $_COOKIE['cook_records_per_page'] != "") {
    $records_per_page = $_COOKIE['cook_records_per_page'];
} else {
    $records_per_page = GLOBAL_RECORDS_PER_PAGE;
}
$where = array();
if ($rest_id) {
    array_push($where, " A.rest_id='".$rest_id."'");
}
if(sizeof($where) > 0){
    $where_clause = " WHERE ".join($where, " AND ");
}
$strQueryParameter      = $where_clause." ORDER BY " . $sortField . " " . $orderDir. " LIMIT ".(int)(($page-1)*(int)$records_per_page).", ".$records_per_page;
$strQueryCountParameter = $where_clause." ORDER BY " . $sortField . " " . $orderDir;
$rsQuery                = $restObj->fun_getMenusArr($strQueryParameter);
$rsQueryCount           = $restObj->fun_getMenusArr($strQueryCountParameter);
$sort_query             = "sortby=" . html_escapeURL($sortby) ."&sortdir=" . html_escapeURL($sortdir);
if($dbObj->getRecordCount($rsQueryCount) > 0) {
    $listArr           = $dbObj->fetchAssoc($rsQuery);
    $total_items       = $dbObj->getRecordCount($rsQueryCount);
    // Determine the pagination
    // $return_query   = $search_query."&".$sort_query."&page=$page";
    $return_query      = $search_query."&page=$page";
    $pag               = new Pagination($rsQueryCount, $search_query, $records_per_page);
    $pag->current_page = $page;
    $pagination        = $pag->Process();
?>
<script language="javascript" type="text/javascript">
    var req = ajaxFunction();
    function delMenu(id) {
        var r = confirm("Are you sure? You want to delete this menu.");
        if(r == true) {
            req.onreadystatechange = handleDeleteResponse;
            req.open('get', 'includes/ajax/admin-menudeleteXml.php?menu_id='+id); 
            req.send(null);   
        } else {
            return false;
        }
    }
    function handleDeleteResponse(){
        if(req.readyState == 4){
            var response = req.responseText;
            xmlDoc = req.responseXML;
            var root = xmlDoc.getElementsByTagName('menus')[0];
            if(root != null){
                var items = root.getElementsByTagName("menu");
                for (var i = 0 ; i < items.length ; i++){
                    var item = items[i];
                    var menustatus = item.getElementsByTagName("menustatus")[0].firstChild.nodeValue;
                    if(menustatus == "menu deleted."){
                        window.location = location.href;
                    }
                }
            }
        }
    }
</script>
<div class="panel panel-default">
    <div class="panel-heading"><h3><?php echo $addtitle; ?></h3></div>
    <div class="panel-body">
        <div class="cols-md-12">
            <ul class="list-unstyled pull-right list-inline">
                <li><a href="manager-restaurants-menu.php?sec=add&rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="btn btn-default">Add a new Menu</a></li>
                <li><a href="<?php echo base64_decode($_GET['back_url']); ?>" class="btn btn-success">Back to Restaurant</a></li>
            </ul>
        </div>
        <div class="clearfix"><br><br></div>
        <div class="cols-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-md-1 text-center" align="center">ID</th>
                        <th class="col-md-4">Name</th>
                        <th class="col-md-4">Category</th>
                        <th class="col-md-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                for($i=0; $i < count($listArr); $i++) {
                    $menu_id       = $listArr[$i]['menu_id'];
                    $menu_name     = $listArr[$i]['menu_name'];
                    $rest_id       = $listArr[$i]['rest_id'];
                    $category_id   = $listArr[$i]['category_id'];
                    $category_name = $restObj->fun_getMenuCategoryNameById($category_id);
                    $active        = $listArr[$i]['active'];
                ?>
                    <tr>
                        <td align="center"><a href="manager-restaurants-menu.php?sec=edit&menu_id=<?php echo $menu_id; ?>&rest_id=<?php echo $rest_id; ?>&back_url=<?php echo $_GET['back_url']; ?>" class="text-success"><?php echo fill_zero_left($menu_id, "0", (6-strlen($menu_id)));?></a></td>
                        <td><?php echo $menu_name;?></td>
                        <td><?php echo ucwords($category_name);?></td>
                        <td align="center"><a href="manager-restaurants-menu.php?sec=edit&menu_id=<?php echo $menu_id; ?>&rest_id=<?php echo $rest_id; ?>&back_url=<?php echo $_GET['back_url']; ?>" class="btn btn-success">Edit</a> <a href="javascript:void(0);" onclick="return delMenu('<?php echo $menu_id; ?>');" class="btn btn-danger">Delete</a></td>
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
    <div class="panel-heading"><h3><?php echo $addtitle; ?></h3></div>
    <div class="panel-body">
        <p class="text-warning"><a href="manager-restaurants-menu.php?sec=add&rest_id=<?php echo $rest_id;?>" class="btn btn-success">Add a new Menu</a></p>
        <p class="text-warning">No Restaurant available!</p>
    </div>
</div>
<?php
}
?>
