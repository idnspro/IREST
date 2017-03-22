<table>
   <tr>
        <td colspan="2" align="left" valign="top" class="pad-top2">
            <div class="right-area-table">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="EventListing">
                    <tr style="background:url(images/glossyback.gif) repeat-x">
                        <td width="10%" align="left"><h4>Code</h4></td>
                        <td width="10%" align="left"><h4>Discount</h4></td>
                        <td width="10%" align="left"><h4>Date</h4></td>
                        <td width="15%" align=""><h4>Duration</h4></td>
                        <td width="" align="left"><h4>Loyalty Points</h4></td>
                        <td width="" align="left"><h4>Pre-Tax</h4></td>
                        <td width="" align="left"><h4>Coupon Rule</h4></td>
                        <td width="" align="left"><h4>Status</h4></td>
                        
                    </tr>
					<?php
					for($i=0; $i < count($discountListArr); $i++) {
					    $discount_id           = $discountListArr[$i]['discount_id'];
                        
						
					?>
                        <tr>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $discount_name; ?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $discount_value; ?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $discount_min_amt; ?></td>
                            <td align="left"><? echo date('M j, Y', $discount_start_date);?><br>To<br><? echo date('M j, Y', $discount_end_date);?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5"></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $status; ?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $discount_service_type; ?></td>
                            <td class="pad-top5 pad-rgt5 pad-btm5 pad-lft5" align="center"><?php echo $discount_comments; ?></td>
                        </tr>
                        <tr><td colspan="4" class="dash">&nbsp;</td></tr>
					<?php
                    }
                    ?>
                </table>
            </div>
        </td>
    </tr>
</table>