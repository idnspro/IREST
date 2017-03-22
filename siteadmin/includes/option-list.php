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
	case 0: $sortField  = "A.option_name"; $orderDir = "ASC"; break;
	case 1: $sortField  = "A.option_name"; $orderDir = "DESC"; break;
	default: $sortField = "A.option_name"; $orderDir = "ASC"; break;
}

if(isset($_REQUEST['category_id']) && $_REQUEST['category_id'] != "") { $category_id = form_text("category_id"); $category_id = stripslashes($category_id); }
if(isset($_REQUEST['sec']) && $_REQUEST['sec'] != "") { $sec = form_text("sec"); $sec = stripslashes($sec); }
if(isset($_REQUEST['show']) && $_REQUEST['show'] != "") { $show = form_text("show"); $show = stripslashes($show); }

if(isset($category_id) && $category_id != "") { $search_query .= "&category_id=" . html_escapeURL($category_id); }
if(isset($sec) && $sec != "") { $search_query .= "&sec=" . html_escapeURL($sec); }
if(isset($show) && $show != "") { $search_query .= "&show=" . html_escapeURL($show); }

if(isset($_COOKIE['cook_records_per_page']) && $_COOKIE['cook_records_per_page'] != "") {
	$records_per_page = $_COOKIE['cook_records_per_page'];
} else {
	$records_per_page = GLOBAL_RECORDS_PER_PAGE;
}

$where = array();
if ($category_id) {
	array_push($where, " A.category_id='".$category_id."'");
}

if(sizeof($where) > 0){
	$where_clause = " WHERE ".join($where, " AND ");
}

$strQueryParameter		= $where_clause." ORDER BY " . $sortField . " " . $orderDir. " LIMIT ".(int)(($page-1)*(int)$records_per_page).", ".$records_per_page;
$strQueryCountParameter	= $where_clause." ORDER BY " . $sortField . " " . $orderDir;

$rsQuery				= $restObj->fun_getMenuOptionArr($strQueryParameter);
$rsQueryCount			= $restObj->fun_getMenuOptionArr($strQueryCountParameter);

$sort_query   = "sortby=" . html_escapeURL($sortby) ."&sortdir=" . html_escapeURL($sortdir);

if($dbObj->getRecordCount($rsQueryCount) > 0) {

	$optListArr 			= $dbObj->fetchAssoc($rsQuery);
	$total_categories 		= $dbObj->getRecordCount($rsQueryCount);
	// Determine the pagination
	//	$return_query 		= $search_query."&".$sort_query."&page=$page";
	$return_query 		= $search_query."&page=$page";
	$pag 				= new Pagination($rsQueryCount, $search_query, $records_per_page);
	$pag->current_page 	= $page;
	$pagination  		= $pag->Process();
?>
<div class="right-area-title"><div class="title"><h1>Manage Option</h1></div></div>
<div class="right-area-listing">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td valign="top">
            <div class="floatRight pad-top5 pad-btm5" align="right">
                <a href="admin-settings.php?sec=option&show=option&action=add&category_id=<?php echo $category_id; ?>" class="button-blue" style="text-decoration:none;">Add New Option</a>&nbsp;
                <a href="admin-settings.php?sec=option&action=edit&category_id=<?php echo $category_id; ?>" class="button-blue" style="text-decoration:none;">Back to Category</a>&nbsp;
            </div>
        </td>
    </tr>
    <tr>
        <td align="left">
            <div class="showing nav8">
                <table width="98%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="80%" height="30">
                         <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." categories";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." category";} ?></strong>
                        </td>
                        <td height="30"class="paging">
                            <?php
                            if(isset($pagination['pages']) && $pagination['pages'] != "") {
                                if(isset($pagination['prev']) && $pagination['prev'] !="") {
                                    echo "<a href=\"".$pagination['prev']."\" class=\"previous\">Previous</a>";
                                }
                                if(($pagination['pages'][0]['no']) > 1) {
                                    echo "<span>...</span>";
                                }
                                foreach($pagination['pages'] as $key => $value) {
                                    if(isset($value['link']) && $value['link'] != "") {
                                        echo "<a href=\"".$value['link']."\">".($value['no'])."</a>";
                                    } else {
                                        echo "<span>".($value['no'])."</span>";
                                    }
                                }
                                if(($pagination['pages'][count($pagination['pages'])-1]['no']) < ($pagination['total_rows']/GLOBAL_RECORDS_PER_PAGE)) {
                                    echo "<span>...</span>";
                                }
                                if(isset($pagination['next']) && $pagination['next'] !="") {
                                    echo "<a href=\"".$pagination['next']."\" class=\"next\">&gt;&gt;Next</a>";
                                }
                            } else {
                                echo "&nbsp;";
                            }
                            ?>
                        </td>
                    </tr>
                </table>
             </div>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="left" valign="top" class="pad-top2">
            <div class="right-area-table">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="black12arial">
                   <tr style="background:url(images/glossyback.gif) repeat-x; height:35px;">
                        <td width="10%" align="center"><strong>ID</strong></td>
                        <td width="80%" align="left"><strong>Option Name</strong></td>
                        <td width="10%" align="center"><strong>Action</strong></td>
                    </tr>
					<?php
					for($i=0; $i < count($optListArr); $i++) {
                        $option_id 		= $optListArr[$i]['option_id'];
                        $category_id    = $optListArr[$i]['category_id'];
                        $option_name	= $optListArr[$i]['option_name'];
					?>
                        <tr>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><a href="admin-settings.php?sec=option&show=option&action=edit&category_id=<?php echo $category_id; ?>&option_id=<?php echo $option_id; ?>" class="blue-link" style="text-decoration:none;"><?php echo fill_zero_left($option_id, "0", (6-strlen($option_id)));?></a></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="left">
								<?php echo '<strong>'.ucwords($option_name).'</strong>'; ?>
                            </td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><a href="admin-settings.php?sec=option&show=option&action=edit&category_id=<?php echo $category_id; ?>&option_id=<?php echo $option_id; ?>" class="blue-link" style="text-decoration:none;">Edit</a></td>
                        </tr>
                        <tr><td colspan="6" class="dash">&nbsp;</td></tr>
					<?php
                    }
                    ?>
                </table>
            </div>
        </td>
    </tr>
</table>
</div>
<?php
} else {
?>
<div class="right-area-title"><div class="title"><h1>Manage Option</h1></div></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td valign="top">
            <div class="floatRight pad-top5 pad-btm5" align="right">
                <a href="admin-settings.php?sec=option&show=option&action=add&category_id=<?php echo $category_id; ?>" class="button-blue" style="text-decoration:none;">Add New Option</a>&nbsp;
            </div>
        </td>
    </tr>
    <tr>
        <td valign="top">No Option available!</td>
    </tr>
</table>
<?php
}
?>
