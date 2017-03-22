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

$rsQuery				= $usersObj->fun_getUserNewsLetterArr($strQueryParameter);
$rsQueryCount			= $usersObj->fun_getUserNewsLetterArr($strQueryCountParameter);

$sort_query   = "sortby=" . html_escapeURL($sortby) ."&sortdir=" . html_escapeURL($sortdir);

if($dbObj->getRecordCount($rsQueryCount) > 0) {

	$newsletterListArr 			= $dbObj->fetchAssoc($rsQuery);
	$total_menu 			    = $dbObj->getRecordCount($rsQueryCount);
	// Determine the pagination
	//	$return_query 		= $search_query."&".$sort_query."&page=$page";
	$return_query 		= $search_query."&page=$page";
	$pag 				= new Pagination($rsQueryCount, $search_query, $records_per_page);
	$pag->current_page 	= $page;
	$pagination  		= $pag->Process();
?>
  <h1><?php echo $addtitle;?></h1>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td colspan="2" valign="top">&nbsp;</td></tr>
			<tr>
				<td colspan="2" valign="top">
					<table width="100%" border="0" cellpadding="4" cellspacing="0">
						<thead style="background-color:#CCCCCC;">
							<tr>
								<th width="10%" scope="col"><div>ID</div></th>
								<th width="30%" scope="col"><div>Email address</div></th>
								<th width="15%" scope="col"><div>Added Date</div></th>
								<th width="10%" scope="col"><div>Verified</div></th>
							</tr>
						</thead>
						<tbody>
							<?php
                            for($i=0; $i < count($newsletterListArr); $i++){
                                $id 				= $newsletterListArr[$i]['id'];
                                $user_email 		= $newsletterListArr[$i]['user_email'];
                                $added_date 		= date('d M, Y', $newsletterListArr[$i]['created_on']);
								if($userArr[$i]['active'] == "1") {
									$status 		=  "Yes";
								} else {
									$status 		=  "No";
								}
                            ?>
                                <tr>
                                    <td class="left" style="padding-left:40px;"><?php echo fill_zero_left($id, "0", (6-strlen($id)));?></td>
                                    <td style="padding-left:80px;"><?php echo $user_email; ?></td>
                                    <td style="padding-left:50px;"><?php echo date('M j, Y', strtotime($added_date)); ?></td>
                                    <td class="right" style="padding-left:50px;"><?php echo $status; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
						</tbody>
					</table>
				</td>
			</tr>
			<tr><td colspan="2" valign="top">&nbsp;</td></tr>
		</table>
<?php
} else {
?>
<h1><?php echo $addtitle;?></h1>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr><td valign="top">No email added!</td></tr>
</table>
<?php
}
?>
