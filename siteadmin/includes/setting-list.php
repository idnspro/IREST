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
	case 0: $sortField  = "A.site_variable_id"; $orderDir = "ASC"; break;
	case 1: $sortField  = "A.site_variable_id"; $orderDir = "DESC"; break;
	default: $sortField = "A.site_variable_id"; $orderDir = "ASC"; break;
}

//if(isset($_REQUEST['page_type']) && $_REQUEST['page_type'] != "") { $page_type = form_text("page_type"); $page_type = stripslashes($page_type); }
//if(isset($page_type) && $page_type != "") { $search_query .= "&page_type=" . html_escapeURL($page_type); }

if(isset($_COOKIE['cook_records_per_page']) && $_COOKIE['cook_records_per_page'] != "") {
	$records_per_page = $_COOKIE['cook_records_per_page'];
} else {
	$records_per_page = GLOBAL_RECORDS_PER_PAGE;
}

$where = array();
/*
if ($page_type) {
	array_push($where, " A.page_type='".$page_type."'");
}
*/

if(sizeof($where) > 0){
	$where_clause = " WHERE ".join($where, " AND ");
}

$strQueryParameter		= $where_clause." ORDER BY " . $sortField . " " . $orderDir. " LIMIT ".(int)(($page-1)*(int)$records_per_page).", ".$records_per_page;
$strQueryCountParameter	= $where_clause." ORDER BY " . $sortField . " " . $orderDir;

$rsQuery				= $systemObj->fun_getSiteVariableArr($strQueryParameter);
$rsQueryCount			= $systemObj->fun_getSiteVariableArr($strQueryCountParameter);

$sort_query   = "sortby=" . html_escapeURL($sortby) ."&sortdir=" . html_escapeURL($sortdir);

if($dbObj->getRecordCount($rsQueryCount) > 0) {

	$settingListArr 			= $dbObj->fetchAssoc($rsQuery);
	$total_restaurants 		= $dbObj->getRecordCount($rsQueryCount);
	// Determine the pagination
	//	$return_query 		= $search_query."&".$sort_query."&page=$page";
	$return_query 		= $search_query."&page=$page";
	$pag 				= new Pagination($rsQueryCount, $search_query, $records_per_page);
	$pag->current_page 	= $page;
	$pagination  		= $pag->Process();
?>
<div class="right-area-title"><div class="title"><h1>Manage Settings</h1></div></div>
<div class="right-area-listing">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php /*?>
    <tr>
        <td valign="top">
            <div class="floatRight pad-top5 pad-btm5" align="right">
                <a href="admin-settings.php?sec=add" class="button-blue" style="text-decoration:none;">Add New Variables</a>&nbsp;
            </div>
        </td>
    </tr>
	<?php */?>
    <tr>
        <td align="left">
            <div class="showing nav8">
                <table width="98%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="80%" height="30">
                         <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." settings";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." setting";} ?></strong>
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
                        <td width="20%" align="left"><strong>Setting Name</strong></td>
                        <td width="60%" align="left"><strong>Setting Value</strong></td>
                        <td width="10%" align="center"><strong>Action</strong></td>
                    </tr>
					<?php
					for($i=0; $i < count($settingListArr); $i++) {
                        $site_variable_id     	= $settingListArr[$i]['site_variable_id'];
                        $site_variable_name 	= $settingListArr[$i]['site_variable_name'];
                        $site_variable_value	= $settingListArr[$i]['site_variable_value'];
					?>
                        <tr>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><a href="admin-settings.php?action=edit&site_variable_id=<?php echo $site_variable_id; ?>" class="blue-link" style="text-decoration:none;"><?php echo fill_zero_left($site_variable_id, "0", (6-strlen($site_variable_id)));?></a></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="left"><?php echo $site_variable_name; ?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="left"><?php echo $site_variable_value;?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><a href="admin-settings.php?action=edit&site_variable_id=<?php echo $site_variable_id; ?>" class="blue-link" style="text-decoration:none;">Edit</a></td>
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
<div class="right-area-title"><div class="title"><h1>Manage Settings</h1></div></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td valign="top">No Setting available!</td>
    </tr>
</table>
<?php
}
?>
