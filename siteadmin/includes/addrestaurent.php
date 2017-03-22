<?php
$restInfo 	= $restObj->fun_getRestaurantInfo($restaurent_id="1");
//print_r($restInfo); 
?>

<div id="accordion" class="ui-accordion ui-widget ui-helper-reset ui-accordion-icons" role="tablist">
    <h3 class="ui-accordion-header question"><a  href="">
        <h5>Add Restaurent Information</h5>
        </a></h3>
    <div class="ui-accordion-content " role="tabpanel">
        <table width="443" border="0" cellspacing="5" cellpadding="5" align="center">
            <tr>
                <?php require_once('addnewrestaurant.php'); ?>
            </tr>
        </table>
    </div>
    <h3 class="ui-accordion-header question" role="tab" aria-expanded="false" tabindex="-1"><a href="#">
        <h5>Welcome Message</h5>
        </a></h3>
    <div class="ui-accordion-content">
        <?php require_once('addMessage.php'); ?>
    </div>
    <h3 class="ui-accordion-header question"><a  style="color:#92d050" href="">
        <h5>Restaurant Logo</h5>
        </a></h3>
    <div class="ui-accordion-content " role="tabpanel"><img src="images/rest_logo3.gif" alt="" /></div>
    <h3 class="ui-accordion-header question" role="tab" aria-expanded="false" tabindex="-1"> <a href="#">
        <h5>Picture Gallery uses collection</h5>
        </a></h3>
    <div class="ui-accordion-content">
        <?php require_once('admin-restaurant-photos.php'); ?>
    </div>
    <!--accordian content -->
    <h3 class="ui-accordion-header question"><a  style="color:#92d050" href="">
        <h5>Restaurant Location</h5>
        </a></h3>
    <div class="ui-accordion-content "role="tabpane -l">
        <div class="edit_hours-area">
            <?php require_once('restaurantlocation.php'); ?>
        </div>
    </div>
    <!--content -->
</div>
