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
	case 1: $sortField  = "A.coupon_name"; $orderDir = "ASC"; break;
	default: $sortField = "A.updated_on"; $orderDir = "DESC"; break;
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

$rsQuery				= $restObj->fun_getCouponArr($strQueryParameter);
$rsQueryCount			= $restObj->fun_getCouponArr($strQueryCountParameter);

$sort_query   = "sortby=" . html_escapeURL($sortby) ."&sortdir=" . html_escapeURL($sortdir);

if($dbObj->getRecordCount($rsQueryCount) > 0) {

	$couponListArr 		= $dbObj->fetchAssoc($rsQuery);
	$total_coupons 		= $dbObj->getRecordCount($rsQueryCount);
	// Determine the pagination
	// $return_query 		= $search_query."&".$sort_query."&page=$page";
	$return_query 		= $search_query."&page=$page";
	$pag 				= new Pagination($rsQueryCount, $search_query, $records_per_page);
	$pag->current_page 	= $page;
	$pagination  		= $pag->Process();

	//print_r($couponListArr);
?>
<div class="right-area-title"><div class="title"><h1><?php echo $addtitle; ?></h1></div></div>
<div class="right-area-listing">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td valign="top">
                <div class="floatRight pad-top5 pad-btm5" align="right">
                    <a href="admin-restaurant-coupons.php?sec=add&rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Add a new coupons</a>&nbsp;
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
                                <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." coupons";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." coupon";} ?></strong>
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
                            <td width="10%" align="center"><strong>Code</strong></td>
                            <td width="30%" align="left"><strong>Name</strong></td>
                            <td width="10%" align="center"><strong>Discount</strong></td>
                            <th width="15%" align="center"><strong>From</strong></th>
                            <td width="15%" align="center"><strong>To</strong></td>
                            <td width="10%" align="center"><strong>Active</strong></td>
                            <td width="10%" align="center"><strong>Action</strong></td>
                        </tr>
                        <?php
                        for($i=0; $i < count($couponListArr); $i++) {
                            $coupon_id     	    = $couponListArr[$i]['coupon_id'];
                            $coupon_name 	    = $couponListArr[$i]['coupon_name'];
                            $coupon_code 	    = $couponListArr[$i]['coupon_code'];
                            $coupon_discount    = $couponListArr[$i]['coupon_discount'].(($couponListArr[$i]['coupon_discount_type'] == "1")?" $":"%");
                            $coupon_start_date  = $couponListArr[$i]['coupon_start_date'];
                            $coupon_end_date   	= $couponListArr[$i]['coupon_end_date'];
                            $status 		    = (isset($couponListArr[$i]['status']) && $couponListArr[$i]['status']=="1")?"Yes":"No";
                        ?>
                        <tr>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><a href="admin-restaurant-coupons.php?sec=edit&coupon_id=<?php echo $coupon_id; ?>&rest_id=<?php echo $rest_id; ?>&back_url=<?php echo $_GET['back_url']; ?>" class="blue-link" style="text-decoration:none;"><?php echo $coupon_code; ?></a></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="left"><?php echo $coupon_name; ?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $coupon_discount;?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo date("M j, Y", strtotime($coupon_start_date));?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo date("M j, Y", strtotime($coupon_end_date));?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $status;?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><a href="admin-restaurant-coupons.php?sec=edit&coupon_id=<?php echo $coupon_id; ?>&rest_id=<?php echo $rest_id; ?>&back_url=<?php echo $_GET['back_url']; ?>" class="blue-link font12" style="text-decoration:none;">Edit</a></td>
                        </tr>
                        <tr><td colspan="5" class="<?php if($i == (count($couponListArr)-1)) {echo "pad-top1";} else {echo "dash";} ?>">&nbsp;</td></tr>
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
                                <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." coupons";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." coupon";} ?></strong>
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
                <a href="admin-restaurant-coupons.php?sec=add&rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="button-blue" style="text-decoration:none;">Add a new coupons</a>&nbsp;
                <a href="<?php echo base64_decode($_GET['back_url']); ?>" class="button-blue" style="text-decoration:none;">Back to Restaurant</a>
            </div>
        </td>
	</tr>
	<tr>
		<td valign="top">No coupon available!</td>
	</tr>
</table>
<?php
}
?>
