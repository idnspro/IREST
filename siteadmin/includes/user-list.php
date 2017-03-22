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
	case 0: $sortField  = "A.user_id"; $orderDir = "DESC"; break;
	case 1: $sortField  = "A.user_fname"; $orderDir = "ASC"; break;
	default: $sortField = "A.user_id"; $orderDir = "DESC"; break;
}

//if(isset($_REQUEST['is_admin']) && $_REQUEST['is_admin'] != "") { $is_admin = form_text("is_admin"); $is_admin = stripslashes($is_admin); }
//if(isset($_REQUEST['is_moderator']) && $_REQUEST['is_moderator'] != "") { $is_moderator = form_text("is_moderator"); $is_moderator = stripslashes($is_moderator); }
//if(isset($_REQUEST['is_manager']) && $_REQUEST['is_manager'] != "") { $is_manager = form_text("is_manager"); $is_manager = stripslashes($is_manager); }

//if(isset($is_admin) && $is_admin != "") { $search_query .= "&is_admin=" . html_escapeURL($is_admin); }
//if(isset($is_moderator) && $is_moderator != "") { $search_query .= "&is_moderator=" . html_escapeURL($is_moderator); }
//if(isset($is_manager) && $is_manager != "") { $search_query .= "&is_manager=" . html_escapeURL($is_manager); }

if(isset($_COOKIE['cook_records_per_page']) && $_COOKIE['cook_records_per_page'] != "") {
	$records_per_page = $_COOKIE['cook_records_per_page'];
} else {
	$records_per_page = GLOBAL_RECORDS_PER_PAGE;
}

$where = array();
/*
if ($is_admin) {
	array_push($where, " A.is_admin='".$is_admin."'");
}
*/
array_push($where, " A.is_admin='0'");

if(sizeof($where) > 0){
	$where_clause = " WHERE ".join($where, " AND ");
}

$strQueryParameter		= $where_clause." ORDER BY " . $sortField . " " . $orderDir. " LIMIT ".(int)(($page-1)*(int)$records_per_page).", ".$records_per_page;
$strQueryCountParameter	= $where_clause." ORDER BY " . $sortField . " " . $orderDir;

$rsQuery				= $usersObj->fun_getUserArr($strQueryParameter);
$rsQueryCount			= $usersObj->fun_getUserArr($strQueryCountParameter);

$sort_query   = "sortby=" . html_escapeURL($sortby) ."&sortdir=" . html_escapeURL($sortdir);

if($dbObj->getRecordCount($rsQueryCount) > 0) {

	$userListArr 			= $dbObj->fetchAssoc($rsQuery);
	$total_user 			= $dbObj->getRecordCount($rsQueryCount);
	// Determine the pagination
	//		$return_query 		= $search_query."&".$sort_query."&page=$page";
	$return_query 		= $search_query."&page=$page";
	$pag 				= new Pagination($rsQueryCount, $search_query, $records_per_page);
	$pag->current_page 	= $page;
	$pagination  		= $pag->Process();

?>

<script language="javascript" type="text/javascript">
	var req = ajaxFunction();

	function delUser(id) {
		var r = confirm("Are you sure? You want to delete this user.");
		if(r == true) {
			req.onreadystatechange = handleDeleteResponse;
			req.open('get', 'includes/ajax/admin-userdeleteXml.php?user_id='+id); 
			req.send(null);   
		} else {
			return false;
		}
	}

	function handleDeleteResponse(){
		if(req.readyState == 4){
			var response = req.responseText;
			xmlDoc = req.responseXML;
			var root = xmlDoc.getElementsByTagName('users')[0];
			if(root != null){
				var items = root.getElementsByTagName("user");
				for (var i = 0 ; i < items.length ; i++){
					var item = items[i];
					var userstatus = item.getElementsByTagName("userstatus")[0].firstChild.nodeValue;
					if(userstatus == "user deleted."){
						window.location = location.href;
					}
				}
			}
		}
	}
</script>
<div class="right-area-title"><div class="title"><h1>User Listing</h1></div></div>
<div class="right-area-listing">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="left">
            <div class="showing nav8">
                <table width="98%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="80%" height="30">
                            <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." users";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." users";} ?></strong>
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
                        <td width="20%" align="center"><strong>Name</strong></td>
                        <td width="40%" align="center"><strong>Email</strong></td>
                        <td width="10%" align="center"><strong>Type</strong></td>
                        <td width="10%" align="center"><strong>Active</strong></td>
                        <td width="10%" align="center"><strong>Action</strong></td>
                    </tr>
					<?php
					for($i=0; $i < count($userListArr); $i++) {
                        $user_id     	= $userListArr[$i]['user_id'];
                        $user_fname 	= $userListArr[$i]['user_fname'];
                        $user_lname		= $userListArr[$i]['user_lname'];
						$user_email		= $userListArr[$i]['user_email'];
                        $user_country 	= $userListArr[$i]['user_country'];
                        $user_state 	= $userListArr[$i]['user_state'];
						$user_city 	    = $userListArr[$i]['user_city'];
                        $user_address1 	= $userListArr[$i]['user_address1'];
						$user_address2 	= $userListArr[$i]['user_address2'];
                        $user_zip 		= $userListArr[$i]['user_zip'];
                        $user_address 	= $user_address1.", ".$user_address2." ".$user_zip;
						$user_name 	    = $user_fname." ".$user_lname;
						$user_type 		= (isset($userListArr[$i]['is_manager']) && $userListArr[$i]['is_manager']=="1")?"Manager":"Customer";
						$status 		= (isset($userListArr[$i]['user_status']) && $userListArr[$i]['user_status']=="1")?"Yes":"No";

					?>
                    <tr>
                        <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><a href="admin-user.php?sec=edit&user_id=<?php echo $user_id; ?>" class="blue-link font12" style="text-decoration:none;"><?php echo fill_zero_left($user_id, "0", (6-strlen($user_id)));?></a></td>
                        <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $user_name; ?></td>
                        <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $user_email; ?></td>
                        <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $user_type; ?></td>
                        <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $status; ?></td>
                        <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><a href="admin-user.php?sec=edit&user_id=<?php echo $user_id; ?>" class="blue-link font12" style="text-decoration:none;">Edit</a>&nbsp;|&nbsp;<a href="javascript:void(0);" onclick="return delUser('<?php echo $user_id; ?>');" class="blue-link" style="text-decoration:none;">Delete</a></td>
                    </tr>
                    <tr><td colspan="6" class="dash">&nbsp;</td></tr>
					<?php
                    }
                    ?>
                </table>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="left" valign="bottom">
            <div class="showing1 nav8">
                <table width="98%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="76%">
                            <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." users";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." users";} ?></strong>
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
<div class="right-area-title"><div class="title"><h1>User Listing</h1></div></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td valign="top">No User available!</td>
    </tr>
</table>
<?php
}
?>
