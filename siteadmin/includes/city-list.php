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
	case 0: $sortField  = "A.city_name"; $orderDir = "ASC"; break;
	default: $sortField = "A.city_name"; $orderDir = "ASC"; break;
}

if(isset($_REQUEST['state_id']) && $_REQUEST['state_id'] != "") { $state_id = form_text("state_id"); $state_id = stripslashes($state_id); }
if(isset($_REQUEST['sec']) && $_REQUEST['sec'] != "") { $sec = form_text("sec"); $sec = stripslashes($sec); }
if(isset($_REQUEST['show']) && $_REQUEST['show'] != "") { $show = form_text("show"); $show = stripslashes($show); }

if(isset($state_id) && $state_id != "") { $search_query .= "&state_id=" . html_escapeURL($state_id); }
if(isset($sec) && $sec != "") { $search_query .= "&sec=" . html_escapeURL($sec); }
if(isset($show) && $show != "") { $search_query .= "&show=" . html_escapeURL($show); }

if(isset($_COOKIE['cook_records_per_page']) && $_COOKIE['cook_records_per_page'] != "") {
	$records_per_page = $_COOKIE['cook_records_per_page'];
} else {
	$records_per_page = GLOBAL_RECORDS_PER_PAGE;
}

$where = array();
if ($state_id) {
	array_push($where, " A.state_id='".$state_id."'");
}

if(sizeof($where) > 0){
	$where_clause = " WHERE ".join($where, " AND ");
}

$strQueryParameter		= $where_clause." ORDER BY " . $sortField . " " . $orderDir. " LIMIT ".(int)(($page-1)*(int)$records_per_page).", ".$records_per_page;
$strQueryCountParameter	= $where_clause." ORDER BY " . $sortField . " " . $orderDir;

$rsQuery				= $locationObj->fun_getCityArr($strQueryParameter);
$rsQueryCount			= $locationObj->fun_getCityArr($strQueryCountParameter);

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
<div class="right-area-title"><div class="title"><h1><?php echo $addtitle; ?></h1></div></div>
<div class="right-area-listing">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td valign="top">
                <div class="floatRight pad-top5 pad-btm5" align="right">
                    <a href="admin-settings.php?sec=location&action=add&show=city&state_id=<?php echo $state_id;?>" class="button-blue" style="text-decoration:none;">Add a new City</a>&nbsp;
                </div>
            </td>
        </tr>
        <tr>
            <td align="left">
                <div class="showing nav8 pad-top5">
                    <table width="98%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="76%" valign="middle">
                             <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." cities";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." city";} ?></strong>
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
                            <td width="10%" align="center"><strong>Latitude</strong></td>
                            <td width="10%" align="center"><strong>Longitude</strong></td>
                            <td width="10%" align="center"><strong>Action</strong></td>
                        </tr>
                        <?php
                        for($i=0; $i < count($listArr); $i++) {
                            $city_id     		= $listArr[$i]['city_id'];
                            $city_name 			= $listArr[$i]['city_name'];
                            $latitude 			= $listArr[$i]['latitude'];
                            $longitude 			= $listArr[$i]['longitude'];
                            $zoom_level 		= $listArr[$i]['zoom_level'];
                        ?>
                            <tr>
                                <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><a href="admin-settings.php?sec=location&show=city&action=edit&city_id=<?php echo $city_id; ?>&state_id=<?php echo $state_id; ?>" class="blue-link font12" style="text-decoration:none;"><?php echo fill_zero_left($city_id, "0", (6-strlen($city_id)));?></a></td>
                                <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="left"><?php echo $city_name;?></td>
                                <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $latitude;?></td>
                                <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $longitude;?></td>
                                <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><a href="admin-settings.php?sec=location&show=city&action=edit&city_id=<?php echo $city_id; ?>&state_id=<?php echo $state_id; ?>" class="blue-link font12" style="text-decoration:none;">Edit</a></td>
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
                                <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." cities";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." city";} ?></strong>
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
                <a href="admin-settings.php?sec=location&action=add&show=city&state_id=<?php echo $state_id;?>" class="button-blue" style="text-decoration:none;">Add a new City</a>&nbsp;
            </div>
        </td>
	</tr>
	<tr>
		<td valign="top">No city available!</td>
	</tr>
</table>
<?php
}
?>
