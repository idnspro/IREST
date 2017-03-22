<style>
.restaurant-section-page {
	padding:3em 0;
}
.restaurant-head h3{
	color:#000000;
	font-size:2.2em;
	font-weight:700;
	font-family: 'Lobster Two', cursive;
}
.restaurant-head p{
	color:#000000;
	font-weight:500;
	font-size:18px;
	margin-bottom:2em;
}
.restaurant-grid h5{
	font-size:1.6em;
	font-weight:700;
	margin-bottom:0.5em;
	font-family: 'Lobster Two', cursive;
}
.restaurant-grid span{
	font-size:16px;
	font-weight:600;
}

/*-- responsive-design --*/
@media screen and (max-width:1366px){
}
@media screen and (max-width:1280px){
}
@media screen and (max-width:1024px){
}
@media screen and (max-width:800px){
}
@media screen and (max-width:768px){
}
@media screen and (max-width:640px){
}
@media screen and (max-width:480px){
}
@media screen and (max-width:320px){
	.restaurant-grids {
		padding: 0;
	}

}
</style>
<div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header"><h4 class="modal-title" id="gridSystemModalLabel">Modal title</h4></div>
			<div class="modal-body">Modal body</div>
			<!--
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary">Save changes</button>
			</div>
			-->
		</div>
	</div>
</div>
<div class="restaurant-section-page">
	<div class="container">
		<div class="restaurant-head text-center wow bounceInLeft" data-wow-delay="0.4s">
			<h1><?php echo $rest_name; ?></h1>
			<p><?php echo $rest_address; ?></p>
		</div>
		<div class="col-md-6 restaurant-grids">
			<div class="wow bounceIn animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: bounceIn;">
				<img src="<?php echo $rest_photo; ?>" class="img-responsive" alt="<?php echo $rest_title; ?>">
			</div>
		</div>
		<div class="col-md-6 restaurant-grids">
			<div class="restaurant-grid  wow fadeInLeft" data-wow-delay="0.4s">
				<h5>About <?php echo $rest_name; ?></h5>
				<?php
				$restObj->fun_getViewRestaurantCustomerReview($rest_id);
				echo '<hr>';
				echo $page_discription;
				?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="restaurant-menu-page">
	<div class="container">
		<div class="col-md-6 menu-grids">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" id="resTabs" role="tablist">
				<li role="presentation" class="active"><a href="#showSectionMenu" aria-controls="showSectionMenu" role="tab" data-toggle="tab">Menu</a></li>
				<li role="presentation"><a href="#showSectionPhotos" aria-controls="showSectionPhotos" role="tab" data-toggle="tab">Photos</a></li>
				<li role="presentation"><a href="#showSectionInfo" aria-controls="showSectionInfo" role="tab" data-toggle="tab">Restaurant Info</a></li>
				<li role="presentation"><a href="#showSectionReview" aria-controls="showSectionReview" role="tab" data-toggle="tab">Customer Review(s)</a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="showSectionMenu">
					<?php require_once(SITE_INCLUDES_PATH.'restaurant-view-menus.php'); ?>
				</div>
				<div role="tabpanel" class="tab-pane" id="showSectionPhotos">
					<?php require_once(SITE_INCLUDES_PATH.'restaurant-view-photos.php'); ?>
				</div>
				<div role="tabpanel" class="tab-pane" id="showSectionInfo">
					<?php require_once(SITE_INCLUDES_PATH.'restaurant-view-info.php'); ?>
				</div>
				<div role="tabpanel" class="tab-pane" id="showSectionReview">
					<?php //require_once(SITE_INCLUDES_PATH.'restaurant-view-reviews.php'); ?>
				</div>
			</div>
		</div>
		<div class="col-md-6 menu-grids">
			<?php
			if(isset($restConf['online_order']) && $restConf['online_order'] =="1") {
				echo '<div class="box-restaurant-right-wrapper">';
				echo '<a name="showSectionCart"></a>';
				require_once(SITE_INCLUDES_PATH.'restaurant-view-cart.php');
				echo '</div>';
			} else {
				echo '<div class="box-restaurants-right-wrapper">';
				require_once(SITE_INCLUDES_PATH.'restaurant-view-right-sidebar.php');
				echo '</div>';
			}
			?>
		</div>
		<div class="clearfix"></div>
	<div>
<div>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$('#resTabs a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
	

	
});
</script>
