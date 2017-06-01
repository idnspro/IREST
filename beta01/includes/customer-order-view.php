<div class="panel panel-default">
    <div class="panel-heading"><h3>Order Details</h3></div>
    <div class="panel-body">
        <p class="text-right"><a href="<?php echo SITE_URL; ?>orders.php" class="btn btn-primary" >Back to Order List</a></p>
        <?php echo $restObj->fun_createOrderView($order_id); ?>
    </div>
</div>
