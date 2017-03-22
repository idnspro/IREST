<div id="rest-review">
<?php
	if(isset($_GET['review']) && $_GET['review'] =="all") {
		$show_reviews	= $total_reviews;
	} else {
		$show_reviews	= ($total_reviews > 5)?'5':$total_reviews;
	}

	if(is_array($reviewArr)) {
		foreach($reviewArr as $key => $value) {
			$reviewerUserEmailsArr[$key] = $value['user_email'];
		}
	}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <?php
    if(count($reviewArr) < 1) {
    ?>
    <tr>
        <td align="left" valign="top" class="pad-top10">
            <h1>This restaurant has not yet been reviewed</h1>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top" class="pad-top10">
            <p><a href="<?php echo SITE_URL; ?>restaurant-write-review.php?rest_id=<?php echo $rest_id;?>&review=compose" class="button-red">Write a Review</a></p>
        </td>
    </tr>
    <?php
    } else {
		?>
		<tr>
			<td align="left" valign="top" class="pad-top10">
				<div class="pad-top10">
					<?php $restObj->fun_createRestaurantReviewAvgScore($rest_id); ?>
				</div>
				<?php
				if(is_array($reviewerUserEmailsArr) && in_array($users_email_id, $reviewerUserEmailsArr)) {
				// do nothing
				} else {
				?>
                <p align="right"><a href="<?php echo SITE_URL; ?>restaurant-write-review.php?rest_id=<?php echo $rest_id;?>&review=compose" class="button-red">Write a Review</a></p>
				<?php
				}
				?>									
			</td>
		</tr>
		<tr><td height="10" style="border-bottom:thin #CCCCCC dotted;"></td></tr>
		<?php
		for($i =0; $i < $show_reviews; $i++) {
			$review_id 		= $reviewArr[$i]['review_id'];
			$user_rating 	= $reviewArr[$i]['rest_rating'];
			$review_title 	= $reviewArr[$i]['review_title'];
			$review_txt 	= $reviewArr[$i]['review_txt'];
			$created_on 	= date('M j, Y', $reviewArr[$i]['created_on']);
			$user_fname 	= $reviewArr[$i]['user_fname'];
			$user_lname 	= $reviewArr[$i]['user_lname'];
			$user_name 		= ucwords($user_fname." ".$user_lname);
			$country_name	= $locationObj->fun_getCountryNameById($reviewArr[$i]['user_country']);
			$txtCreateBy 	= "<strong>Added by :</strong> ".$user_name." <strong>Date added :</strong> ".$created_on.". <strong>Country :</strong> ".$country_name;
			/*							
			$voteArr = $restObj->fun_getRestaurantReviewsVoteInfo($review_id);
			if(is_array($voteArr)) {
				$voter_ids	 	= $voteArr['voter_ids'];
				$total_vote 	= $voteArr['total_vote'];
				$yes_vote 		= $voteArr['yes_vote'];
				if($total_vote > 0) {
					$txtHelpful = $yes_vote." out of ".$total_vote." people found this review helpful";
					$vote_unit = (int)(($total_vote*100) / 5);
					$review_rank = (int)(($yes_vote*100) / $vote_unit);
				} else {
					$txtHelpful = "&nbsp;";
					$review_rank = 0;
				}
			}
			*/
		?>
		<tr>
			<td align="left" valign="top" class="pad-btm10 pad-top15">
			<?php 
			for($j=0; $j < 5; $j++) {
				if($j < $user_rating) {
					echo "<img src=\"".SITE_IMAGES."star-rated.gif\" alt=\"Star\" />&nbsp;";
				} else {
					echo "<img src=\"".SITE_IMAGES."star-notrated.gif\" alt=\"Star\" />&nbsp;";
				}
			}
			?>
			</td>
		</tr>
		<tr><td align="left" valign="top" class="font16 red"><?php echo ucfirst($review_title); ?></td></tr>
		<tr><td align="left" valign="top" class="font11 pad-btm10 pad-top5"><?php echo $txtCreateBy; ?></td></tr>
		<tr><td align="left" valign="top" class="font12 pad-btm10"><?php echo $review_txt; ?></td></tr>
		<tr><td height="10" style="border-bottom:thin #CCCCCC dotted;"></td></tr>
		<?php
		}
	}
    ?>
</table>
</div>
