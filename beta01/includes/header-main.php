<div class="container">
    <div class="top-header">
        <div class="logo">
            <a href="<?php echo SITE_URL; ?>" title="<?php if ( ! empty( $sitetitle ) ) { echo $sitetitle; } else { echo SITE_GLOBAL_LOGO_TITLE; } ?>"><img src="<?php echo SITE_IMAGES;?>logo.png" class="img-responsive" alt="<?php if ( ! empty( $sitetitle ) ) {echo $sitetitle;} else { echo SITE_GLOBAL_LOGO_NAME; } ?>" /></a>
        </div>
        <div class="queries">
            <p>Questions? Call us Toll-free!<span>1800-0000-7777 </span><label>(11AM to 11PM)</label></p>
            <p class="text-right text-danger"><?php if( ! empty( $_SESSION["ses_user_fname"] ) ) { echo 'Welcome ' . $_SESSION["ses_user_fname"] . '!'; } ?></p>
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
                <li><a href="<?php echo SITE_URL.'order.php'; ?>">Order</a></li>|
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
<div class="banner wow fadeInUp" data-wow-delay="0.4s" id="Home">
    <div class="container">
        <div class="banner-info">
            <form action="restaurants.php" method="POST">
            <div class="banner-info-head text-center wow fadeInLeft" data-wow-delay="0.5s">
                <h1>Order Food Delivery</h1>
                <div class="line">
                    <h2>From Your Favorite Restaurants</h2>
                </div>
            </div>
            <div class="form-list wow fadeInRight" data-wow-delay="0.5s">
                <input name="dtype" id="pickup" value="pickup" type="hidden">
                <?php /* ?>
                <input name="dtype" id="delivery" checked="" value="delivery" type="radio">
                <input name="book_table" id="book_table" value="1" type="radio">
                <?php */ ?>
                <ul class="navmain">
                    <li>
                        <span>Location*</span>
                        <input type="text" name="address" id="address" class="text" value="" placeholder="Secunderabad">
                    </li>
                    <li>
                        <span>Restaurant</span>
                        <input type="text" name="restaurant" id="restaurant" class="text" value="" placeholder="Swagath Grand">
                    </li>
                    <li>
                        <span>Cuisine</span>
                        <input type="text" name="cuisine" id="cuisine" class="text" value="" placeholder="Chicken Biriyani">
                    </li>
                </ul>
            </div>
            <div class="srch"><button type="submit"></button></div>
            </form>
        </div>
    </div>
</div>
