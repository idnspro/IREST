<div class="header-left"><img src="<?php echo SITE_ADMIN_IMAGES;?>header-left.gif" /></div>
<div class="header-bg">
    <div class="logo"><img src="<?php echo SITE_ADMIN_IMAGES;?>logo.gif" /></div>
    <div id="header-content">
        <div class="login-area">Welcome <span class="yellow-text"><?php echo $_SESSION['ses_admin_fname']; ?>!</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin-home.php" style="color:#FFFFFF;">My Account</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="admin-logout.php" style="color:#FFFFFF;">Logout</a></div>
        <div class="top-nav">
            <table width="858" height="10" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><a class="icon1" href="admin-home.php"><span>Dashboard</span></a></td>
                    <td><a class="icon2" href="admin-content.php"><span>Content</span></a></td>
                    <td><a class="icon3" href="admin-restaurant.php"><span>Restaurants</span></a></td>
                    <td><a class="icon4" href="admin-user.php"><span>Users</span></a></td>
                    <!--<td><a class="icon5" href="admin-event.php?sec=add"><span>Events</span></a></td>-->
                    <td><a class="icon6" href="admin-report.php"><span>Orders</span></a></td>
                    <td><a class="icon7" href="admin-newsletter.php"><span>Newsletter</span></a></td>
                    <td><a class="icon8" href="admin-settings.php"><span>Settings</span></a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="header-right"><img src="<?php echo SITE_ADMIN_IMAGES;?>header-right.gif" /> </div>
