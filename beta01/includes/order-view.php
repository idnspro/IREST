<div class="panel panel-default">
    <div class="panel-heading"><h3>Order Details</h3></div>
    <div class="panel-body">
        <div class="cols-md-12">
            <ul class="list-unstyled pull-right list-inline">
                <li><a href="manager-restaurants-order.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="btn btn-success">Back to Order List</a></li>
                <li><a href="<?php echo base64_decode($_GET['back_url']); ?>" class="btn btn-success">Back to Restaurant</a></li>
            </ul>
        </div>
        <div class="clearfix"><br><br></div>
        <div class="cols-md-12">
            <?php echo $restObj->fun_createOrderView($order_id); ?>
        </div>
    </div>
</div>
