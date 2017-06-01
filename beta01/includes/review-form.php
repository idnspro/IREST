<?php
$dayname   = array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');
$monthname = array('01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
$yearname  = array();
$startYear = date('Y') - 100;
$endYear   = date('Y') - 16;
for($counter = $endYear; $counter >= $startYear; $counter--) {
    array_push($yearname, $counter);
}
?>
<script type="text/javascript" language="javascript">
    function chkblnkTxtError(strFieldId, strErrorFieldId) {
        if(document.getElementById(strFieldId).value != "") {
            document.getElementById(strErrorFieldId).innerHTML = "";
        }
    }
    function validatefrm(){
        if(document.getElementById("user_fname_id").value == "") {
            document.getElementById("user_fname_errorid").innerHTML = "First Name required";
            document.getElementById("user_fname_id").focus();
            return false;
        }
        if(document.getElementById("user_lname_id").value == "") {
            document.getElementById("user_lname_errorid").innerHTML = "Last Name required";
            document.getElementById("user_lname_id").focus();
            return false;
        }
        if(document.getElementById("user_email_id").value == "") {
            document.getElementById("user_email_errorid").innerHTML = "Enter valid email address";
            document.getElementById("user_email_id").focus();
            return false;
        }
        if(document.getElementById("review_title_id").value == "") {
            document.getElementById("review_title_errorid").innerHTML = "Title required";
            document.getElementById("review_title_id").focus();
            return false;
        }
        if(document.getElementById("review_txt_id").value == "") {
            document.getElementById("review_txt_errorid").innerHTML = "Review required";
            document.getElementById("review_txt_id").focus();
            return false;
        }
        document.frmAddReview.submit();
    }
</script>
<div class="contact_top">
    <div class="container">
        <div class="col-md-6 contact_left wow fadeInRight" data-wow-delay="0.4s">
            <h2>Write review</h2>
            <?php if( !empty( $form_array['error_msg'] ) ) : ?>
                <div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <span><strong>Error!</strong> <?php echo $form_array['error_msg']; ?></span>
                </div>
            <?php endif; ?>
            <form name="frmAddReview" id="frmAddReview" method="post" action="<?php echo SITE_URL; ?>restaurant-write-review.php?rest_id=<?php echo $rest_id;?>&review=compose">
                <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5(RESTAURANTREVIEW);?>" />
                <input type="hidden" name="rest_id" id="rest_id" value="<?php echo $rest_id;?>" />
                <input type="hidden" name="user_country" id="user_country_id" value="99" />
                <div class="form_details">
                    <div class="text-warning">
                        <br>
                        <h3>Rate this restaurant</h3>
                        <ul class="list-inline lead">
                            <li>Very Poor</li>
                            <li> <label>1</label> <input type="radio" name="rest_rating" id="rest_rating_id1" value="1" <?php if(isset($_POST['rest_rating']) && $_POST['rest_rating'] == "1") {echo "checked=\"checked\"";} ?> /></li>
                            <li> <label>2</label> <input type="radio" name="rest_rating" id="rest_rating_id2" value="2" <?php if(isset($_POST['rest_rating']) && $_POST['rest_rating'] == "2") {echo "checked=\"checked\"";} ?> /></li>
                            <li> <label>3</label> <input type="radio" name="rest_rating" id="rest_rating_id2" value="2" <?php if(isset($_POST['rest_rating']) && $_POST['rest_rating'] == "3") {echo "checked=\"checked\"";} ?> /></li>
                            <li> <label>4</label> <input type="radio" name="rest_rating" id="rest_rating_id2" value="2" <?php if(isset($_POST['rest_rating']) && $_POST['rest_rating'] == "4") {echo "checked=\"checked\"";} ?> /></li>
                            <li> <label>5</label> <input type="radio" name="rest_rating" id="rest_rating_id2" value="2" <?php if(isset($_POST['rest_rating']) && $_POST['rest_rating'] == "5") {echo "checked=\"checked\"";} ?> /></li>
                            <li>Fantastic</li>
                        </ul>
                    </div>
                    <input type="text" name="user_fname" id="user_fname_id" class="text" value="First Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'First Name';}">
                    <input type="text" name="user_lname" id="user_lname_id" class="text" value="Last Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Last Name';}">
                    <input type="text" name="user_email" id="user_email_id" class="text" value="Email Address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email Address';}">
                    <input type="text" class="text" name="review_title" id="review_title_id" value="<?php if ( ! empty( $_POST['review_title'] ) ) { echo $_POST['review_title']; } else { echo 'Title of your review';}?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Title of your review';}">
                    <textarea name="review_txt" id="review_txt_id" value="Write your review" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}"><?php if ( ! empty( $_POST['review_txt'] ) ) { echo $_POST['review_txt']; } else { echo 'Write your review'; } ?></textarea>
                    <div class="clearfix"> </div>
                    <div>
                        <table align="center" border="0" cellpadding="5" cellspacing="0">
                            <tr>
                                <td class="col-md-3" align="right" valign="middle">Type this<label>*</label></td>
                                <td align="left" valign="middle"><img src="../captchacode/securityimage.php?width=120&height=40&characters=5" alt="Word Scramble" class="RegFormScrambleImg" id="image_scode" name="image_scode" /></td>
                                <td align="left" valign="middle"> into this box</td>
                                <td align="left" valign="middle"><input name="image_vcode" id="image_vcode" type="text" value="" maxlength="5" autocomplete="off" /></td>
                                <td align="left" valign="middle"><div class="error" id="showErrorImgVCode"><?php if(array_key_exists('image_vcode', $form_array)) echo $form_array['image_vcode'];?></div></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td align="left" colspan="4"><a href="void(0);" onclick="document.image_scode.src='../captchacode/securityimage.php?width=120&height=40&characters=5&'+Math.random();return false">Refresh this image</a></td>
                            </tr>
                        </table>
                    </div>
                    <div class="sub-button wow swing animated text-center" data-wow-delay= "0.4s">
                        <input name="submit" type="submit" value="Send review">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 company-right wow fadeInLeft" data-wow-delay="0.4s">
            <img src="images/order.jpg" class="img-responsive" />
        </div>
    </div>
</div>
