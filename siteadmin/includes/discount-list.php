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
	case 1: $sortField  = "A.rest_name"; $orderDir = "ASC"; break;
	default: $sortField = "A.updated_on"; $orderDir = "DESC"; break;
}

$seo_friendly 		= SITE_URL."accommodation"; // for seo friendly urls

if(isset($_COOKIE['cook_records_per_page']) && $_COOKIE['cook_records_per_page'] != "") {
	$records_per_page = $_COOKIE['cook_records_per_page'];
} else {
	$records_per_page = GLOBAL_RECORDS_PER_PAGE;
}

$strQueryParameter		= " ORDER BY " . $sortField . " " . $orderDir. " LIMIT ".(int)(($page-1)*(int)$records_per_page).", ".$records_per_page;
$strQueryCountParameter	= " ORDER BY " . $sortField . " " . $orderDir;

$rsQuery				= $restObj->fun_getDiscountArr($strQueryParameter);
$rsQueryCount			= $restObj->fun_getDiscountArr($strQueryCountParameter);

$sort_query   = "sortby=" . html_escapeURL($sortby) ."&sortdir=" . html_escapeURL($sortdir);

if($dbObj->getRecordCount($rsQueryCount) > 0) {

	$discountListArr 			= $dbObj->fetchAssoc($rsQuery);
	$total_restaurants 			= $dbObj->getRecordCount($rsQueryCount);
	// Determine the pagination
	//	$return_query 		= $search_query."&".$sort_query."&page=$page";
	$return_query 		= $search_query."&page=$page";
	$pag 				= new Pagination($rsQueryCount, $search_query, $records_per_page);
	$pag->current_page 	= $page;
	$pagination  		= $pag->Process();

?>
<h1>Discount Listing</h1>
<div class="right-area-listing">
<table>
   <tr>
    <td width="80%" height="30">
        <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." Discount";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." Discount";} ?></strong>
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
   <tr>
        <td colspan="2" align="left" valign="top">
            <div class="right-area-table">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="black12arial">
                    <tr style="background:url(images/glossyback.gif) repeat-x; height:35px;">
                    
                    <td width="10%" align="center"><strong>Name</strong></td>
                        <td width="10%" align="center"><strong>Discount</strong></td>
                        <td width="10%" align="center"><strong>Min. Order Amt</strong></td>
                        <td width="15%" align="center"><strong>Start Date</strong></td>
                        <td width="15%" align="center"><strong>End Date</strong></td>
                        <td width="10%" align="center"><strong>Pre-Tax</strong></td>
                        <td width="10%" align="center"><strong>Status</strong></td>
                        <td width="10%" align="center"><strong>Services</strong></td>
                        <td width="10%" align="center"><strong>Notes</strong></td>
                    </tr>
					<?php
					for($i=0; $i < count($discountListArr); $i++) {
					    $discount_id           = $discountListArr[$i]['discount_id'];
                        $discount_name 	       = $discountListArr[$i]['discount_name'];
						$discount_min_amt      = $discountListArr[$i]['discount_min_amt'];
                        $discount_value        = $discountListArr[$i]['discount_value'];
						$discount_service_type = $discountListArr[$i]['discount_service_type'];
                        $discount_comments 	   = $discountListArr[$i]['discount_comments'];
						$discount_start_date   = fun_site_date_format($discountListArr[$i]['discount_start_date']);
                        $discount_end_date     = fun_site_date_format($discountListArr[$i]['discount_end_date']);
						$status                = $discountListArr[$i]['status'];
						
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
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><a href="admin-restaurant-discount.php?sec=edit&desc_id=<?php echo $discount_id?>" style="text-decoration:none"><?php echo $discount_name; ?></a></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $discount_value; ?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $discount_min_amt; ?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $discount_start_date;?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $discount_end_date;?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $strStatus; ?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $discount_service_type; ?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $discount_comments; ?></td>
                        </tr>
                        <tr><td colspan="8" class="dash">&nbsp;</td></tr>
					<?php
                    }
                    ?>
                </table>
            </div>
        </td>
    </tr>
   <tr><td valign="middle" class="pad-top10 pad-btm10"><a href="admin-restaurant-discount.php?sec=add" style="text-decoration:none;">Create New Discount</a>&nbsp;&nbsp;<img src="images/active.gif" width="15" height="15" border="0" />&nbsp;Active Discount&nbsp;&nbsp;<img src="images/inactive.gif" width="15" height="15" border="0" />&nbsp;Inactive Discount</td></tr>
   <tr>
        <td colspan="2" align="left" valign="bottom">
            <div class="showing1 nav8">
                <table width="98%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="76%">
                            <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." Discount";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." Discount";} ?></strong>
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
<h1>Discount Listing</h1>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr><td valign="top">No Coupons available!</td>  </tr>
    <tr><td><a href="admin-restaurant-discount.php?sec=add" style="text-decoration:none;">Create New Discount</a></td></tr>
</table>
<?php
}
?>
