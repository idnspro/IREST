<?php if ( count( $restListArr ) > 0 ) : ?>
<div class="Popular-Restaurants-grids">
	<div class="container">
	<?php
	for( $i =0; $i < count( $restListArr ); $i++ ) {
		$rest_id 				= $restListArr[$i]['rest_id'];
		$rest_name 				= $restListArr[$i]['rest_name'];
		$rest_title 			= $restListArr[$i]['rest_title'];
		$rest_logo 				= RESTAURANT_IMAGES_LOGO_PATH.$restListArr[$i]['rest_logo'];
		$description			= ucfirst(substr($restListArr[$i]['rest_short_desc'], 0, 210));
		$currencyArr			= $restObj->fun_getRestaurantCurrencyInfo($rest_id);
		$rest_currency_id		= $currencyArr['currency_id'];
		$rest_currency_code 	= $currencyArr['currency_code'];
		$rest_currency_symbol 	= $currencyArr['currency_symbol'];
		$rest_currency_rate 	= $currencyArr['currency_rate'];
		$rest_currency_name 	= $currencyArr['currency_name'];
		$currency_symbol		= ($users_currency_symbol == "")?$rest_currency_symbol:$users_currency_symbol;
		$currency_code			= ($users_currency_code == "")?$rest_currency_code:$users_currency_code;
		$restLocInfoArr 		= $restObj->fun_getRestaurantLocInfoArr($rest_id);
		$propLoc = "";
		if($restLocInfoArr['country_name'] !=""){
			$propLoc .= "<a href=\"".SITE_URL."restaurants/".str_replace("/", "_", str_replace(" ", "-", strtolower($restLocInfoArr['country_name'])))."\" >".ucwords($restLocInfoArr['country_name'])."</a> > ";
		}
		if($restLocInfoArr['state_name'] !=""){
			$propLoc .= "<a href=\"".SITE_URL."restaurants/".str_replace("/", "_", str_replace(" ", "-", strtolower($restLocInfoArr['state_name'])))."\" >".ucwords($restLocInfoArr['state_name'])."</a> > ";
		}
		if($restLocInfoArr['city_name'] !=""){
			$propLoc .= "<a href=\"".SITE_URL."restaurants/".str_replace("/", "_", str_replace(" ", "-", strtolower($restLocInfoArr['city_name'])))."\" >".ucwords($restLocInfoArr['city_name'])."</a> > ";
		}
		$propLoc .= ucfirst($rest_name)." ref:".fill_zero_left($rest_id, "0", (6-strlen($rest_id)));

		$fr_url = $restObj->fun_getRestaurantFriendlyLink($rest_id);
		if(isset($fr_url) && $fr_url != "") {
			$restaurant_link 	= SITE_URL."restaurant/".strtolower($fr_url);
		} else {
			if(isset($restLocInfoArr['city_name']) && $restLocInfoArr['city_name'] != "") {
				$restaurant_link = SITE_URL."restaurant/".str_replace(" ", "-", strtolower($restLocInfoArr['city_name']))."/".fill_zero_left($rest_id, "0", (6-strlen($rest_id)));
			} else {
				$restaurant_link = SITE_URL."restaurant/".str_replace(" ", "-", strtolower($restLocInfoArr['state_name']))."/".fill_zero_left($rest_id, "0", (6-strlen($rest_id)));
			}
		}
		?>
		<div class="Popular-Restaurants-grid wow fadeInRight" data-wow-delay="0.4s">
			<div class="col-md-3 restaurent-logo">
				<a href="<?php echo $restaurant_link; ?>" onclick="saveSearch();" title="<?php echo $rest_name.": ".$rest_title;?>"><img src="<?php echo $rest_logo;?>" class="img-responsive" onerror="this.src='<?php echo SITE_IMAGES;?>no-img.gif';" /></a>
			</div>
			<div class="col-md-7 restaurent-title">
				<div class="logo-title">
				<h4><a href="<?php echo $restaurant_link; ?>"><?php echo $rest_name ?></a></h4>
				</div>
				<div class="rating">
				<?php $restObj->fun_getViewRestaurantCustomerReview($rest_id); ?>
				</div>
			</div>
			<div class="col-md-2 buy">
				<!-- <span>$45</span> --> 
				<a href="<?php echo $restaurant_link; ?>"><input type="button" value="View Details"></a>
			</div>
			<div class="clearfix"></div>
		</div>

	<?php /* ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listingTable">
        <tr>
            <td valign="top" class="pad-btm10 pad-top5 pad-lft5 pad-rgt5">
                <div class="font12 white nav8 pad-btm5"><?php echo tranText('location'); ?>:&nbsp;<span><?php echo $propLoc; ?></span></div>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="120px" valign="top"><a href="<?php echo $restaurant_link; ?>" onclick="saveSearch();" title="<?php echo $rest_name.": ".$rest_title;?>"><img src="<?php echo $rest_logo;?>" width="100" onerror="this.src='<?php echo SITE_IMAGES;?>no-image-small.gif';" style="border:5px #999999 solid" /></a></td>
                        <td valign="top" class="pad-lft10 pad-rgt10">
                            <div class="pad-btm5">
                                <h5><?php echo $rest_name ?></h5>
                                <p class="font12 white"><?php echo $description."<br>"; ?></p>
                            </div>
                            <div class="pad-top5 font12 white">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="30px"><img src="<?php echo SITE_IMAGES;?>t.gif" class="gui-icon-review gui-icon-rw" /></td>
                                        <td width="55px"><?php echo tranText('reviews'); ?></td>
                                        <td><?php $restObj->fun_createRestaurantCustomerReview($rest_id); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td width="170px" valign="bottom" align="right">
                            <a href="<?php echo $restaurant_link; ?>" onclick="saveSearch();" style="text-decoration:none;" class="button-blue"><?php echo tranText('view_menu'); ?></a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
	<?php */ ?>

	<?php } ?>
	</div>
</div>
<?php else : ?>
<center><h1>No records found!</h1></center>
<?php endif; ?>


<?php /* ?>
<div class="Popular-Restaurants-grids">
	<div class="container">
		<div class="Popular-Restaurants-grid wow fadeInRight" data-wow-delay="0.4s">
			<div class="col-md-3 restaurent-logo">
				<img src="<?php echo SITE_IMAGES; ?>restaurent-logo1.jpg" class="img-responsive" alt="" />
			</div>
			<div class="col-md-2 restaurent-title">
				<div class="logo-title">
					<h4><a href="#">pizza hut</a></h4>
				</div>
				<div class="rating">
					<span>ratings</span>
					<a href="#"> <img src="<?php echo SITE_IMAGES; ?>star1.png" class="img-responsive" alt="">(004)</a>
				</div>
			</div>
			<div class="col-md-7 buy">
				<span>$45</span>
				<input type="button" value="buy">
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="Popular-Restaurants-grid wow fadeInLeft" data-wow-delay="0.4s">
			<div class="col-md-3 restaurent-logo">
				<img src="<?php echo SITE_IMAGES; ?>restaurent-logo2.jpg" class="img-responsive" alt="" />
			</div>
			<div class="col-md-2 restaurent-title">
				<div class="logo-title logo-title-1">
					<h4><a href="#">Subway</a></h4>
				</div>
				<div class="rating">
					<span>ratings</span>
					<a href="#"> <img src="<?php echo SITE_IMAGES; ?>star2.png" class="img-responsive" alt="">(005)</a>
				</div>
			</div>
			<div class="col-md-7 buy">
				<span>$45</span>
				<input type="button" value="buy">
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="Popular-Restaurants-grid wow fadeInRight" data-wow-delay="0.4s">
			<div class="col-md-3 restaurent-logo">
				<img src="<?php echo SITE_IMAGES; ?>restaurent-logo3.jpg" class="img-responsive" alt="" />
			</div>
			<div class="col-md-2 restaurent-title">
				<div class="logo-title logo-title-2">
					<h4><a href="#">Barista</a></h4>
				</div>
				<div class="rating">
					<span>ratings</span>
					<a href="#"> <img src="<?php echo SITE_IMAGES; ?>star1.png" class="img-responsive" alt="">(004)</a>
				</div>
			</div>
			<div class="col-md-7 buy">
				<span>$45</span>
				<input type="button" value="buy">
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="Popular-Restaurants-grid wow fadeInLeft" data-wow-delay="0.4s">
			<div class="col-md-3 restaurent-logo">
				<img src="<?php echo SITE_IMAGES; ?>restaurent-logo4.jpg" class="img-responsive" alt="" />
			</div>
			<div class="col-md-2 restaurent-title">
				<div class="logo-title logo-title-3">
					<h4><a href="#">papa johns</a></h4>
				</div>
				<div class="rating">
					<span>ratings</span>
					<a href="#"> <img src="<?php echo SITE_IMAGES; ?>star2.png" class="img-responsive" alt="">(005)</a>
				</div>
			</div>
			<div class="col-md-7 buy">
				<span>$45</span>
				<input type="button" value="buy">
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="Popular-Restaurants-grid wow fadeInRight" data-wow-delay="0.4s">
			<div class="col-md-3 restaurent-logo">
				<img src="<?php echo SITE_IMAGES; ?>restaurent-logo5.jpg" class="img-responsive" alt="" />
			</div>
			<div class="col-md-2 restaurent-title">
				<div class="logo-title logo-title-4">
					<h4><a href="#">Domino's pizza</a></h4>
				</div>
				<div class="rating">
					<span>ratings</span>
					<a href="#"> <img src="<?php echo SITE_IMAGES; ?>star1.png" class="img-responsive" alt="">(004)</a>
				</div>
			</div>
			<div class="col-md-7 buy">
				<span>$45</span>
				<input type="button" value="buy">
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="Popular-Restaurants-grid wow fadeInLeft" data-wow-delay="0.4s">
			<div class="col-md-3 restaurent-logo">
				<img src="<?php echo SITE_IMAGES; ?>restaurent-logo6.jpg" class="img-responsive" alt="" />
			</div>
			<div class="col-md-2 restaurent-title">
				<div class="logo-title logo-title-5">
					<h4><a href="#">kfc</a></h4>
				</div>
				<div class="rating">
					<span>ratings</span>
					<a href="#"> <img src="<?php echo SITE_IMAGES; ?>star2.png" class="img-responsive" alt="">(005)</a>
				</div>
			</div>
			<div class="col-md-7 buy">
				<span>$45</span>
				<input type="button" value="buy">
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<?php */ ?>
