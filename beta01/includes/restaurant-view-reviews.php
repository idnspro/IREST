<?php
    if(isset($_GET['review']) && $_GET['review'] =="all") {
        $show_reviews = $total_reviews;
    } else {
        $show_reviews = ($total_reviews > 5)?'5':$total_reviews;
    }
    if(is_array($reviewArr)) {
        foreach($reviewArr as $key => $value) {
            $reviewerUserEmailsArr[$key] = $value['user_email'];
        }
    }
?>
<div id="rest-review">
    <?php if(count($reviewArr) < 1) : ?>
        <p class="text-danger push-top15 push-btm15"><br><strong>This restaurant has not yet been reviewed!</strong><br></p>
        <p><a href="<?php echo SITE_URL; ?>restaurant-write-review.php?rest_id=<?php echo $rest_id;?>&review=compose" class="btn btn-success col-md-3">Write a Review</a></p>
    <?php  else : ?>
        <p class="text-danger push-top15 push-btm15">
            <?php $restObj->fun_createRestaurantReviewAvgScore($rest_id); ?>
        </p>
        <?php if( !is_array($reviewerUserEmailsArr) && ! in_array($users_email_id, $reviewerUserEmailsArr)) : ?>
            <p><a href="<?php echo SITE_URL; ?>restaurant-write-review.php?rest_id=<?php echo $rest_id;?>&review=compose" class="btn btn-success col-md-3">Write a Review</a></p>
        <?php endif; ?>
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
                $voter_ids  = $voteArr['voter_ids'];
                $total_vote = $voteArr['total_vote'];
                $yes_vote   = $voteArr['yes_vote'];
                if($total_vote > 0) {
                    $txtHelpful  = $yes_vote." out of ".$total_vote." people found this review helpful";
                    $vote_unit   = (int)(($total_vote*100) / 5);
                    $review_rank = (int)(($yes_vote*100) / $vote_unit);
                } else {
                    $txtHelpful  = "&nbsp;";
                    $review_rank = 0;
                }
            }
            */
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="text-warning"><?php echo ucfirst($review_title); ?></h2>
                </div>
                <div class="panel-body">
                    <p class="push-btm15">
                        <span>
                            <?php if ( ! empty( $user_rating ) ) : ?>
                                <img src="<?php echo SITE_IMAGES . 'star' . $user_rating .'.png'; ?>" class="img-responsive" />
                            <?php else: ?>
                                <img src="<?php echo SITE_IMAGES . 'star0.png'; ?>" class="img-responsive" />
                            <?php endif; ?>
                        </span>
                        <br>
                        <span class="text-primary">
                            <?php echo $txtCreateBy; ?>
                        </span>
                        <br>
                        <br><span><?php echo $review_txt; ?></span><br>
                    </p>
                </div>
            </div>
            <div class="clearfix"></div>
        <?php } ?>
    <?php endif; ?>
</div>
