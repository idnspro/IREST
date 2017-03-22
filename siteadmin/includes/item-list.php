<?php
	$rest_id = $_REQUEST['rest_id'];
	$menu_id = $_REQUEST['menu_id'];
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
		case 1: $sortField  = "A.menu_name"; $orderDir = "ASC"; break;
		default: $sortField = "A.updated_on"; $orderDir = "DESC"; break;
	}
	
	$seo_friendly 		= SITE_URL."accommodation"; // for seo friendly urls
	
	if(isset($_COOKIE['cook_records_per_page']) && $_COOKIE['cook_records_per_page'] != "") {
		$records_per_page = $_COOKIE['cook_records_per_page'];
	} else {
		$records_per_page = GLOBAL_RECORDS_PER_PAGE;
	}
	
	$strQueryParameter		= " WHERE rest_id='".(int)$rest_id."'  ORDER BY " . $sortField . " " . $orderDir. " LIMIT ".(int)(($page-1)*(int)$records_per_page).", ".$records_per_page;
	$strQueryCountParameter	= " ORDER BY " . $sortField . " " . $orderDir;
	
	$rsQuery				= $restObj->fun_getMenuItemArr($strQueryParameter);
	$rsQueryCount			= $restObj->fun_getMenuItemArr($strQueryCountParameter);
	
	$sort_query   = "sortby=" . html_escapeURL($sortby) ."&sortdir=" . html_escapeURL($sortdir);

    if($dbObj->getRecordCount($rsQueryCount) > 0) {

	$ItemListArr 				= $dbObj->fetchAssoc($rsQuery);
	$total_menu 			    = $dbObj->getRecordCount($rsQueryCount);
	// Determine the pagination
	// $return_query 		= $search_query."&".$sort_query."&page=$page";
	$return_query 		= $search_query."&page=$page";
	$pag 				= new Pagination($rsQueryCount, $search_query, $records_per_page);
	$pag->current_page 	= $page;
	$pagination  		= $pag->Process();
?>
<h1>Item Listing</h1>
<div class="right-area-listing">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="left">
            <div class="showing1 nav8">
                <table width="98%" border="0" cellspacing="2" cellpadding="0">
                    <tr>
                        <td width="76%">
                            <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." menus";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." menus";} ?></strong>
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
        <td colspan="2" align="left" valign="top" class="pad-top2">
            <div class="right-area-table">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="black12arial">
                    <tr style="background:url(images/glossyback.gif) repeat-x; height:35px;">
                        <td width="10%" align="center"><strong>Item Id</strong></td>
                        <td width="10%" align="center"><strong>Item Name</strong></td>
                        <td width="10%" align="center"><strong>Categories</strong></td>
                        <td width="15%" align="center"><strong>Description</strong></td>
                        <td width="15%" align="center"><strong>Status</strong></td>
                    </tr>
					<?php
					for($i=0; $i < count($ItemListArr); $i++) {
                        $item_id     	= $ItemListArr[$i]['item_id'];
                        $item_name 		= $ItemListArr[$i]['item_name'];
                        $menu_catid		= $ItemListArr[$i]['menu_catid'];
						$item_desc		= $ItemListArr[$i]['item_desc'];
                        $active 		= $ItemListArr[$i]['active'];
						
						 if($status) {
                                switch($status) {
                                    case '0':
                                        $strStatus = '<img src="images/inactive.gif" width="15" height="15" border="0" />';
                                    break;
                                    case '1':
                                        $strStatus = '<img src="images/active.gif" width="15" height="15" border="0" />';
                                    break;
                                }
                            } else {
                                $strStatus = '<img src="images/inactive.gif" width="15" height="15" border="0" />';
                            }
					?>
                        <tr>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><a href="admin-restaurant-menu-item.php?sec=edit&item_id=<?php echo $item_id; ?>&rest_id=<?php echo $rest_id;?>" style="text-decoration:none"><?php echo fill_zero_left($item_id, "0", (6-strlen($item_id)));?></a></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $item_name; ?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $menu_catid; ?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $item_desc; ?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $strStatus;?></td>
                        </tr>
                        <tr><td colspan="5" class="dash">&nbsp;</td></tr>
					<?php
                    }
                    ?>
                </table>
            </div>
        </td>
    </tr>
    <tr><td class="pad-top10"><a href="admin-restaurant-menu-item.php?sec=add&menu_id=<?php echo $menu_id;?>&rest_id=<?php echo $rest_id;?>" style="text-decoration:none">Create New Item</a>&nbsp;&nbsp;<img src="images/active.gif" width="15" height="15" border="0" />&nbsp;Active Menu&nbsp;&nbsp;<img src="images/inactive.gif" width="15" height="15" border="0" />&nbsp;Inactive Menu</td></tr>
    <tr>
        <td colspan="2" align="left" valign="bottom">
            <div class="showing1 nav8">
                <table width="98%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="76%">
                            <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." menus";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." menus";} ?></strong>
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
<h1>Item Listing</h1>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td valign="top">No Item available!</td>
    </tr>
     <tr><td><a href="admin-restaurant-menu-item.php?sec=add&rest_id=<?php echo $rest_id;?>?menu_id=<?php echo $menu_id;?>" style="text-decoration:none">Create New Item</a></td></tr>
</table>
<?php
}
?>
