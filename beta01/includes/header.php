<div class="container">
	<div class="top-header">
		<div class="logo">
			<a href="<?php echo SITE_URL; ?>" title="<?php if(isset($sitetitle) && $sitetitle !=""){echo $sitetitle;} else {echo "Online Food Ordering System ...";}?>"><img src="<?php echo SITE_IMAGES;?>logo.png" class="img-responsive" alt="<?php if(isset($sitetitle) && $sitetitle !=""){echo $sitetitle;}?>" /></a>
		</div>
		<div class="queries">
			<p>Questions? Call us Toll-free!<span>1800-0000-7777 </span><label>(11AM to 11PM)</label></p>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="menu-bar">
	<div class="container">
		<div class="top-menu">
			<ul>
				<li class="active"><a href="<?php echo SITE_URL; ?>" class="scroll">Home</a></li>|
				<li><a href="<?php echo SITE_URL.'restaurants.php'; ?>">Top Restaurants</a></li>|
				<li><a href="<?php echo SITE_URL.'index.php'; ?>">Order</a></li>|
				<li><a href="<?php echo SITE_URL.'contact.php'; ?>">Contact</a></li>
				<div class="clearfix"></div>
			</ul>
		</div>
		<div class="login-section">
			<ul>
				<?php
				if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] != "") {
					if(isset($_SESSION['ses_user_home']) && $_SESSION['ses_user_home'] != "") {
						if($_SESSION['ses_user_home'] == SITE_URL."manager-home.php") {
							$help_page = SITE_URL."manager-help.php";
							$fav_page = SITE_URL."manager-favourities.php";
						} else {
							$help_page = SITE_URL."help.php";
							$fav_page = SITE_URL."favourities.php";
						}
						?>
						<li>Welcome <?php echo $_SESSION["ses_user_fname"]; ?> :<a href="<?php echo $_SESSION["ses_user_home"]; ?>" title="my account">My Account</a> </li> |
						<li><a href="<?php echo SITE_URL.'logout.php'; ?>">Logout</a> </li> |
						<li><a href="<?php echo $help_page; ?>">Help</a></li>
						<?php
					} else {
						?>
						<li>Welcome <?php echo $_SESSION["ses_user_fname"]; ?> :<a href="<?php echo $_SESSION["ses_user_home"]; ?>" title="my account">My Account</a> </li> |
						<li><a href="<?php echo SITE_URL.'logout.php'; ?>">Logout</a> </li> |
						<li><a href="<?php echo SITE_URL.'help.php'; ?>">Help</a></li>
						<?php
					}
				} else {
					?>
					<?php /* ?>
					<li><a href="<?php echo SITE_URL.'login.php'; ?>">Customer Login</a> </li> |
					<li><a href="<?php echo SITE_URL.'manager-login.php'; ?>">Manager Login</a> </li> |
					<?php */ ?>
					<li><a href="<?php echo SITE_URL.'login.php'; ?>">Login</a> </li> |
					<li><a href="<?php echo SITE_URL.'register.php'; ?>">Register</a> </li> |
					<li><a href="<?php echo SITE_URL.'help.php'; ?>">Help</a></li>
					<?php
				}
				?>
				<div class="clearfix"></div>
			</ul>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
