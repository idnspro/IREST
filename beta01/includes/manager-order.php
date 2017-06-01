<?php
    if(isset($_GET['sec']) && $_GET['sec'] !="") {
        switch($_GET['sec']) {
            case "edit":
                $addtitle = "Order Details";
                $order_id = $_GET['order_id'];
                require_once(SITE_INCLUDES_PATH.'manager-order-form.php');
            break;
            case "view":
                $addtitle = "Order Details";
                $order_id = $_GET['order_id'];
                require_once(SITE_INCLUDES_PATH.'manager-order-view.php');
            break;
            default:
                $addtitle = "Order History";
                require_once(SITE_INCLUDES_PATH.'manager-order-list.php');
        }
    } else {
        $addtitle = "Order History";
        require_once(SITE_INCLUDES_PATH.'manager-order-list.php');
    }
?>
