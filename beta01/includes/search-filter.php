<style>
.search-filter {
	border-top: 3px solid #5BBD50;
	background-color:#359935;
}
.search-filter-info{
	padding-top:1em;
	position: relative;
}
.search-filter-info-head {
	color:#ffffff;
	padding-bottom:1em;
}
.form-list ul li{
	display:inline-block;
	width: 30%;
}
.form-list input.text{
	width:92%;
	padding:0.6em 0.5em;
	border:none;
	outline:none;
	color:#C0C0C0;
	font-weight:400;
	margin-top: 7px;
	font-size:16px;
	border-radius:5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	-o-border-radius: 5px;
}
.form-list span{
	color:#FFFFFF;
	font-size:19px;
	font-weight:700;
	display:block;
}

</style>
<div class="search-filter wow fadeInUp" data-wow-delay="0.4s" id="SearchForm">
	<div class="container">
		<div class="search-filter-info">
			<div class="search-filter-info-head">
			<h2><?php echo $total_restaurants; ?> restaurants found...</h2>
			</div>
			<form name="frmRefineSearch" id="frmRefineSearch" action="<?php echo SITE_URL."restaurants.php"; ?>" method="post">
			<input type="hidden" name="securityKey" value="<?php echo md5("REFINESEARCH")?>">
			<input type="hidden" name="sortby" id="sortby" value="<?php if(isset($sortby) && $sortby !="") {echo $sortby;} else {echo "0";}?>">
			<input type="hidden" name="dtype" id="dtype" value="<?php if(isset($dtype) && $dtype !="") {echo $dtype;} else {echo "delivery";}?>">
			<input type="hidden" name="country_id" id="country_id" value="<?php echo $country_id;?>">
			<input type="hidden" name="state_id" id="state_id" value="<?php echo $state_id;?>">
			<input type="hidden" name="city_id" id="city_id" value="<?php echo $city_id;?>">
			<input type="hidden" name="cuisinesids" id="cuisinesids" value="<?php if(isset($cuisinesids) && $cuisinesids !="") {echo $cuisinesids;}?>">
			<input type="hidden" name="featureids" id="featureids" value="<?php if(isset($featureids) && $featureids !="") {echo $featureids;}?>">
			<input type="hidden" name="dtypeids" id="dtypeids" value="<?php if(isset($dtypeids) && $dtypeids !="") {echo $dtypeids;}?>">
			<input type="hidden" name="priceids" id="priceids" value="<?php if(isset($priceids) && $priceids !="") {echo $priceids;}?>">
			<input type="hidden" name="paymethodids" id="paymethodids" value="<?php if(isset($paymethodids) && $paymethodids !="") {echo $paymethodids;}?>">
			<input type="hidden" name="distanceids" id="distanceids" value="<?php if(isset($distanceids) && $distanceids !="") {echo $distanceids;}?>">
			<div class="form-list">
				<ul class="navmain">
					<li>
						<span>Location*</span>
						<input type="text" name="address" id="address" class="text" value="<?php if(isset($address) && $address !="") {echo $address;}?>" placeholder="Secunderabad">
					</li>
					<li>
						<span>Restaurant</span>
						<input type="text" name="restaurant" id="restaurant" class="text" value="<?php if(isset($restaurant) && $restaurant !="") {echo $restaurant;}?>" placeholder="Swagath Grand">
					</li>
					<li>
						<span>Cuisine</span>
						<input type="text" name="cuisine" id="cuisine" class="text" value="<?php if(isset($cuisine) && $cuisine !="") {echo $cuisine;}?>" placeholder="Chicken Biriyani">
					</li>
				</ul>
			</div>
			<div class="srch"><button type="submit"></button></div>
			</form>
		</div>
	</div>
</div>

