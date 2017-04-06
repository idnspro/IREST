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
				<?php
				// For Google Map
				if ( ! empty( $rest_latitude ) && ! empty( $rest_longitude ) && ! empty( $rest_map_zoom_level ) ) {
				?>
				<div id="map" style="overflow:hidden;width:100%;height:364px;border:1px solid #999999;"></div>
				<div class="clearfix"></div>
				<script>
					var map;
					var strlatitude = <?php echo $rest_latitude; ?>;;
					var strlongitude = <?php echo $rest_longitude; ?>;
					var zoomLevel = <?php echo $rest_map_zoom_level; ?>;
					var image = new google.maps.MarkerImage('<?php echo SITE_IMAGES;?>markers/marker.png', new google.maps.Size(20, 34), new google.maps.Point(0,0), new google.maps.Point(0,32));
					var shadow = new google.maps.MarkerImage('<?php echo SITE_IMAGES;?>markers/shadow.png', new google.maps.Size(37, 32), new google.maps.Point(0,0), new google.maps.Point(0, 32));
					function initMap() {
						var Latlng = {lat: strlatitude, lng: strlongitude};
						var map = new google.maps.Map(document.getElementById('map'), {
							zoom: zoomLevel,
							center: Latlng,
							mapTypeId: google.maps.MapTypeId.ROADMAP
						});
						var marker = new google.maps.Marker({
							position: Latlng,
							map: map,
							shadow: shadow,
							icon: image,

						});
					}
				</script>
				<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFDOhwKxKihkT7_kPrQbMuR78gwj6U3S0&callback=initMap"></script>
				<?php
				}
				?>
				<?php
				echo '<hr>';
				$restObj->fun_getViewRestaurantCustomerReview($rest_id);
				?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="restaurant-section-desc">
	<div class="container">
		<div class="wow bounceInLeft" data-wow-delay="0.4s">
			<?php
			echo $page_discription;
			echo '<hr>';
			?>
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
