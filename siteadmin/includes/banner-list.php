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
	case 0: $sortField  = "A.banner_id"; $orderDir = "ASC"; break;
	case 1: $sortField  = "A.banner_id"; $orderDir = "DESC"; break;
	default: $sortField = "A.banner_id"; $orderDir = "ASC"; break;
}

if(isset($_REQUEST['banner_type']) && $_REQUEST['banner_type'] != "") { $banner_type = form_text("banner_type"); $banner_type = stripslashes($banner_type); }
if(isset($_REQUEST['sec']) && $_REQUEST['sec'] != "") { $sec = form_text("sec"); $sec = stripslashes($sec); }

if(isset($banner_type) && $banner_type != "") { $search_query .= "&banner_type=" . html_escapeURL($banner_type); }
if(isset($sec) && $sec != "") { $search_query .= "&sec=" . html_escapeURL($sec); }

if(isset($_COOKIE['cook_records_per_page']) && $_COOKIE['cook_records_per_page'] != "") {
	$records_per_page = $_COOKIE['cook_records_per_page'];
} else {
	$records_per_page = GLOBAL_RECORDS_PER_PAGE;
}

$where = array();
if ($banner_type) {
	array_push($where, " A.banner_type='".$banner_type."'");
}

if(sizeof($where) > 0){
	$where_clause = " WHERE ".join($where, " AND ");
}

$strQueryParameter		= $where_clause." ORDER BY " . $sortField . " " . $orderDir. " LIMIT ".(int)(($page-1)*(int)$records_per_page).", ".$records_per_page;
$strQueryCountParameter	= $where_clause." ORDER BY " . $sortField . " " . $orderDir;

$rsQuery				= $bannerObj->fun_getBannerArr($strQueryParameter);
$rsQueryCount			= $bannerObj->fun_getBannerArr($strQueryCountParameter);

$sort_query   = "sortby=" . html_escapeURL($sortby) ."&sortdir=" . html_escapeURL($sortdir);

if($dbObj->getRecordCount($rsQueryCount) > 0) {

	$banListArr 		= $dbObj->fetchAssoc($rsQuery);
	$total_banners 		= $dbObj->getRecordCount($rsQueryCount);
	// Determine the pagination
	//	$return_query 		= $search_query."&".$sort_query."&page=$page";
	$return_query 			= $search_query."&page=$page";
	$pag 				= new Pagination($rsQueryCount, $search_query, $records_per_page);
	$pag->current_page 	= $page;
	$pagination  		= $pag->Process();
?>
<script language="javascript" type="text/javascript">
	var req = ajaxFunction();

	function delItem(strId) {
		var r = confirm("Are you sure? You want to delete this item.");
		if(r == true) {
			document.getElementById("txtDelItem").value = strId;
			delBannerItem();
		} else {
			return false;
		}
	}
	
	function delBannerItem(){
		if(document.getElementById("txtDelItem").value != "") {
			var banner_id = document.getElementById("txtDelItem").value;
			req.onreadystatechange = handleDeleteBannerResponse;
			req.open('get', 'includes/ajax/admin-bannerdeleteXml.php?banner_id='+banner_id); 
			req.send(null);   
		}
	}
	function handleDeleteBannerResponse(){
		if(req.readyState == 4){
			var response = req.responseText;
			xmlDoc = req.responseXML;
			var root = xmlDoc.getElementsByTagName('banners')[0];
			if(root != null){
				var items = root.getElementsByTagName("banner");
				for (var i = 0 ; i < items.length ; i++){
					var item = items[i];
					var bannerstatus = item.getElementsByTagName("bannerstatus")[0].firstChild.nodeValue;
					if(bannerstatus == "banner deleted."){
						window.location = location.href;
					}
				}
			}
		}
	}
</script>
<div class="right-area-title"><div class="title"><h1>Manage Banner</h1></div></div>
<div class="right-area-listing">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td valign="top">
            <div class="floatRight pad-top5 pad-btm5" align="right">
                <a href="admin-settings.php?sec=banner&action=add" class="button-blue" style="text-decoration:none;">Add New Banner</a>&nbsp;
            </div>
        </td>
    </tr>
    <tr>
        <td align="left">
            <div class="showing nav8">
                <table width="98%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="80%" height="30">
                         <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." banners";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." banner";} ?></strong>
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
                <input type="hidden" name="txtDelItem" id="txtDelItem" value="" />
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="black12arial">
                   <tr style="background:url(images/glossyback.gif) repeat-x; height:35px;">
                        <th width="10%" align="center"><strong>ID</strong></th>
                        <th width="25%" align="left"><strong>Title</strong></th>
                        <th width="25%" align="center"><strong>Banner</strong></th>
                        <th width="25%" align="center"><strong>Updated Date</strong></th>
                        <th width="15%" align="center"><strong>Action</strong></th>
                    </tr>
					<?php

					for($i=0; $i < count($banListArr); $i++) {
                        $banner_id    	= $banListArr[$i]['banner_id'];
                        $banner_title   = $banListArr[$i]['banner_title'];
                        $banner_desc    = $banListArr[$i]['banner_desc'];
                        $banner_img    	= SITE_URL."upload/banners-logos/banners/".$banListArr[$i]['banner_img'];
                        $banner_link    = $banListArr[$i]['banner_link'];
                        $banner_type    = $banListArr[$i]['banner_type'];
                        $start_date    	= $banListArr[$i]['start_date'];
                        $end_date    	= $banListArr[$i]['end_date'];
                        $created_on    	= $banListArr[$i]['created_on'];
                        $created_by    	= $banListArr[$i]['created_by'];
                        $updated_on    	= $banListArr[$i]['updated_on'];
                        $updated_by    	= $banListArr[$i]['updated_by'];
                        $active    		= $banListArr[$i]['active'];
						$banner_update  = date("M d, Y", $banListArr[$i]['updated_on']);
					?>
                        <tr>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><a href="admin-settings.php?sec=banner&action=edit&banner_id=<?php echo $banner_id;?>" class="blue-link"><?php echo fill_zero_left($banner_id, "0", (6-strlen($banner_id)));?></a></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="left"><?php echo $banner_title;?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><img src="<?php echo $banner_img;?>" border="0" width="120px"></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $banner_update;?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><a href="admin-settings.php?sec=banner&action=edit&banner_id=<?php echo $banner_id;?>" class="blue-link" style="text-decoration:none;">Edit</a>&nbsp;|&nbsp;<a href="JavaScript:void(0);" onclick="delItem('<?php echo $banner_id; ?>');" class="blue-link">Delete</a></td>
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
<div class="right-area-title"><div class="title"><h1>Manage Banner</h1></div></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td valign="top">
            <div class="floatRight pad-top5 pad-btm5" align="right">
                <a href="admin-settings.php?sec=banner&action=add" class="button-blue" style="text-decoration:none;">Add New Banner</a>&nbsp;
            </div>
        </td>
    </tr>
    <tr>
        <td valign="top">No Menu Category available!</td>
    </tr>
</table>
<?php
}
?>
