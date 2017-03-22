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

$strQueryParameter		= $where_clause." ORDER BY " . $sortField . " " . $orderDir. " LIMIT ".(int)(($page-1)*(int)$records_per_page).", ".$records_per_page;
$strQueryCountParameter	= $where_clause." ORDER BY " . $sortField . " " . $orderDir;

$rsQuery				= $restObj->fun_getMenusArr($strQueryParameter);
$rsQueryCount			= $restObj->fun_getMenusArr($strQueryCountParameter);

$sort_query   = "sortby=" . html_escapeURL($sortby) ."&sortdir=" . html_escapeURL($sortdir);

if($dbObj->getRecordCount($rsQueryCount) > 0) {

	$listArr 			= $dbObj->fetchAssoc($rsQuery);
	$total_items 		= $dbObj->getRecordCount($rsQueryCount);
	// Determine the pagination
	//	$return_query 		= $search_query."&".$sort_query."&page=$page";
	$return_query 		= $search_query."&page=$page";
	$pag 				= new Pagination($rsQueryCount, $search_query, $records_per_page);
	$pag->current_page 	= $page;
	$pagination  		= $pag->Process();

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

<div class="right-area-title"><div class="title"><h1><?php echo $addtitle; ?></h1></div></div>
<div class="right-area-listing">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td valign="top">
                <div class="floatRight pad-top5 pad-btm5" align="right">
                    <a href="admin-restaurant-menu.php?sec=photo&rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Add/Edit Photo Menus</a>&nbsp;
                    <a href="admin-restaurant-menu.php?sec=pdf&rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Add/Edit PDF Menus</a>&nbsp;
                    <a href="admin-restaurant-menu.php?sec=add&rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Add a new Menu</a>&nbsp;
                    <a href="<?php echo base64_decode($_GET['back_url']); ?>" class="button-blue" style="text-decoration:none;">Back to Restaurant</a>
                </div>
            </td>
        </tr>
        <tr>
            <td align="left">
                <div class="showing nav8 pad-top5">
                    <table width="98%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="76%" valign="middle">
                             <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." menus";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." menu";} ?></strong>
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
                            <td width="10%" align="center"><strong>ID</strong></td>
                            <td width="60%" align="left"><strong>Name</strong></td>
							<?php /*?>
                            <td width="10%" align="center"><strong>Latitude</strong></td>
							<?php */?>
                            <td width="20%" align="center"><strong>Category</strong></td>
                            <td width="10%" align="center"><strong>Action</strong></td>
                        </tr>
                        <?php
                        for($i=0; $i < count($listArr); $i++) {
                            $menu_id     	= $listArr[$i]['menu_id'];
                            $menu_name 		= $listArr[$i]['menu_name'];
                            $rest_id 		= $listArr[$i]['rest_id'];
                            $category_id 	= $listArr[$i]['category_id'];
                            $category_name 	= $restObj->fun_getMenuCategoryNameById($category_id);
                            $active 		= $listArr[$i]['active'];
                        ?>
                            <tr>
                                <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><a href="admin-restaurant-menu.php?sec=edit&menu_id=<?php echo $menu_id; ?>&rest_id=<?php echo $rest_id; ?>&back_url=<?php echo $_GET['back_url']; ?>" class="blue-link font12" style="text-decoration:none;"><?php echo fill_zero_left($menu_id, "0", (6-strlen($menu_id)));?></a></td>
                                <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="left"><?php echo $menu_name;?></td>
								<?php /*?>
                                <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $rest_id;?></td>
								<?php */?>
                                <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo ucwords($category_name);?></td>
                                <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><a href="admin-restaurant-menu.php?sec=edit&menu_id=<?php echo $menu_id; ?>&rest_id=<?php echo $rest_id; ?>&back_url=<?php echo $_GET['back_url']; ?>" class="blue-link font12" style="text-decoration:none;">Edit</a>&nbsp;|&nbsp;<a href="javascript:void(0);" onclick="return delMenu('<?php echo $menu_id; ?>');" class="blue-link" style="text-decoration:none;">Delete</a></td>
                            </tr>
                            <tr><td colspan="5" class="<?php if($i == (count($listArr)-1)) {echo "pad-top1";} else {echo "dash";} ?>">&nbsp;</td></tr>
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
                                <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." menus";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." menu";} ?></strong>
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
<div class="right-area-title"><div class="title"><h1><?php echo $addtitle; ?></h1></div></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top">
            <div class="floatRight pad-top5 pad-btm5" align="right">
                <a href="admin-restaurant-menu.php?sec=photo&rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Add/Edit Photo Menus</a>&nbsp;
                <a href="admin-restaurant-menu.php?sec=pdf&rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Add/Edit PDF Menus</a>&nbsp;
                <a href="admin-restaurant-menu.php?sec=add&rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Add a new Menu</a>&nbsp;
            </div>
        </td>
	</tr>
	<tr>
		<td valign="top">No menu available!</td>
	</tr>
</table>
<?php
}
?>
