<?php
  require_once("includes/application-top-inner.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Admin :: Home</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/accordian-css.css" />
    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css" /><![endif]-->
    <!--[if IE 8]><link rel="stylesheet" type="text/css" href="css/ie8.css" /><![endif]-->
    <script type="text/javascript" language="javascript" src="includes/js/admin.js"></script>
    <script type="text/javascript" language="javascript" src="includes/js/js.js"></script>
    <script type="text/javascript" language="javascript" src="includes/js/ddaccordion.js"></script>
    <script type="text/javascript" language="javascript" src="includes/js/menujs.js"></script>
</head>
<body>
<div id="wrapper-top">
    <!-- header:Start Here -->
    <div id="header"><?php require_once(SITE_ADMIN_INCLUDES_PATH.'admin-header.php'); ?></div>
    <!-- header:End Here -->
    <!-- Main Wrapper: Start Here -->
    <div id="wrapper">
        <!-- Left Part: Start Here -->
        <div id="left-area"><?php require_once(SITE_ADMIN_INCLUDES_PATH.'admin-left.php'); ?></div>
        <!-- Left Part: End Here -->
        <!-- Right Part: Start Here -->
        <div id="right-area">&nbsp;</div>
        <!-- Right Part: End Here -->
    </div>
    <!-- Main Wrapper: End Here -->
    <!-- Footer:Start Here -->
    <div id="footer"><?php require_once(SITE_ADMIN_INCLUDES_PATH.'admin-footer.php'); ?></div>
    <!-- Footer:End Here -->
</div>
</body>
</html>
