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
	case 0: $sortField  = "A.updated_on"; $orderDir = "DESC"; break;
	default: $sortField = "A.updated_on"; $orderDir = "DESC"; break;
}

if(isset($_REQUEST['page_type']) && $_REQUEST['page_type'] != "") { $page_type = form_text("page_type"); $page_type = stripslashes($page_type); }

if(isset($page_type) && $page_type != "") { $search_query .= "&page_type=" . html_escapeURL($page_type); }

if(isset($_COOKIE['cook_records_per_page']) && $_COOKIE['cook_records_per_page'] != "") {
	$records_per_page = $_COOKIE['cook_records_per_page'];
} else {
	$records_per_page = GLOBAL_RECORDS_PER_PAGE;
}

$where = array();
if ($page_type) {
	array_push($where, " A.page_type='".$page_type."'");
}

if(sizeof($where) > 0){
	$where_clause = " WHERE ".join($where, " AND ");
}

$strQueryParameter		= $where_clause." ORDER BY " . $sortField . " " . $orderDir. " LIMIT ".(int)(($page-1)*(int)$records_per_page).", ".$records_per_page;
$strQueryCountParameter	= $where_clause." ORDER BY " . $sortField . " " . $orderDir;

$rsQuery				= $cmsObj->fun_getPageArr($strQueryParameter);
$rsQueryCount			= $cmsObj->fun_getPageArr($strQueryCountParameter);

$sort_query   = "sortby=" . html_escapeURL($sortby) ."&sortdir=" . html_escapeURL($sortdir);

if($dbObj->getRecordCount($rsQueryCount) > 0) {

	$pageListArr 			= $dbObj->fetchAssoc($rsQuery);
	$total_pages 			= $dbObj->getRecordCount($rsQueryCount);
	// Determine the pagination
	//	$return_query 		= $search_query."&".$sort_query."&page=$page";
	$return_query 		= $search_query."&page=$page";
	$pag 				= new Pagination($rsQueryCount, $search_query, $records_per_page);
	$pag->current_page 	= $page;
	$pagination  		= $pag->Process();

?>
<div class="right-area-title"><div class="title"><h1>Page Listing</h1></div></div>
<div class="right-area-listing">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="left">
                <div class="showing nav8 pad-top5">
                    <table width="98%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="76%" valign="middle">
                             <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." pages";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." page";} ?></strong>
                            </td>
                            <td align="right" valign="top" class="paging pad-btm10 pad-left2">
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
            <td colspan="2" align="left" valign="top" class="pad-btm10">
                <div class="right-area-table">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="black12arial">
                       <tr style="background:url(images/glossyback.gif) repeat-x; height:35px;">
                            <td width="10%" align="center"><strong>Edit</strong></td>
                            <td width="70%" align="left"><strong>Title</strong></td>
                            <td width="20%" align="center"><strong>Last updates</strong></td>
                        </tr>
                        <?php
                        for($i=0; $i < count($pageListArr); $i++) {
                            $page_id     	= $pageListArr[$i]['page_id'];
                            $page_title 	= $pageListArr[$i]['page_title'];
                            $updated_on 	= date("Y-d-m", $pageListArr[$i]['updated_on']);
                        ?>
                            <tr>
                                <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><a href="admin-content.php?sec=edit&page_id=<?php echo $page_id; ?>" class="blue-link font12" style="text-decoration:none;">Edit</a></td>
                                <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="left"><?php echo $page_title;?></td>
                                <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $updated_on;?></td>
                            </tr>
                            <tr><td colspan="3" class="<?php if($i == (count($pageListArr)-1)) {echo "pad-top1";} else {echo "dash";} ?>">&nbsp;</td></tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="left" valign="bottom">
                <div class="showing nav8">
                    <table width="98%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="76%">
                                <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." pages";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." page";} ?></strong>
                            </td>
                            <td align="right" valign="top" class="paging pad-btm10 pad-left2">
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
    </table>
</div>
<?php
} else {
?>
<div class="right-area-title"><div class="title"><h1>Page Listing</h1></div></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top">No page available!</td>
	</tr>
</table>
<?php
}
?>
