<div class="register">
    <?php
    if(isset($_GET['sec']) && $_GET['sec'] !="") {
        switch($_GET['sec']) {
            case "view":
                $addtitle = "Order Details";
                $order_id = $_GET['order_id'];
                    require_once SITE_INCLUDES_PATH . 'customer-order-view.php';
            break;
            default:
                $addtitle = "Order History";
                require_once SITE_INCLUDES_PATH . 'customer-order-list.php';
        }
    } else {
        $addtitle = "Order History";
        require_once SITE_INCLUDES_PATH . 'customer-order-list.php';
    }
    ?>
    <div class="clearfix"> </div>
</div>
