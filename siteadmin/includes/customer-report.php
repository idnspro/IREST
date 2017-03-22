
<h1>Customer Order</h1>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
                        <td width="80%" height="30">
                            <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." restaurants";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." restaurant";} ?></strong>
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
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="EventListing">
                    <tr style="background:url(images/glossyback.gif) repeat-x">
                        <td width="10%" align="left"><h4>First Name</h4></td>
                        <td width="15%" align="left"><h4>Last Name</h4></td>
                        <td width="20%" align="left"><h4>Telephone</h4></td>
                        <td width="20%" align="left"><h4>Email</h4></td>
                        <td width="10%" align="left"><h4>Loyalty</h4></td>
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
						
						
                       $status 		= (isset($userListArr[$i]['is_manager']) && $userListArr[$i]['is_manager']=="1")?"Yes":"No";
					?>
                    <tr>
                        <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5"><a href="admin-user.php?sec=edit&user_id=<?php echo $user_id; ?>" class="link" style="text-decoration:none;"><?php echo fill_zero_left($user_id, "0", (6-strlen($user_id)));?></a></td>
                        <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5"><?php echo $user_name; ?></td>
                        <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5"><?php echo $user_email; ?></td>
                        <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5"><?php echo $user_address; ?></td>
                        <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $status; ?></td>
                    </tr>
                    <tr><td colspan="4" class="dash">&nbsp;</td></tr>
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
                            <strong><?php if(isset($pagination['total_rows']) && $pagination['total_rows'] > 1) { echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." restaurants";} else if(isset($pagination['total_rows']) && $pagination['total_rows'] == 1){echo "Showing ".$pagination['first_row']." to ".$pagination['last_row']." of ".$pagination['total_rows']." restaurant";} ?></strong>
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
