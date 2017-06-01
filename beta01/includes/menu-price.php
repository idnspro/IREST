<?php
$rest_id   = $_REQUEST['rest_id'];
$rest_name = $restObj->fun_getRestaurantNameById($rest_id);
?>
<script type="text/javascript" language="javascript">
    function chkblnkTxtError(strFieldId, strErrorFieldId){
        if(document.getElementById(strFieldId).value != ""){
            document.getElementById(strErrorFieldId).innerHTML = "";
        }
    }
    function checkSpecialPrice () {
        if(document.getElementById("base_price_enabled").checked == true) {
            //alert("checked");
            document.getElementById("base_price_id").disabled = false;
            document.getElementById("spacial_price_enabled").style.display = "none";
        } else {
            //alert("unchecked");
            document.getElementById("base_price_id").value = "";
            document.getElementById("base_price_id").disabled = true;
            document.getElementById("spacial_price_enabled").style.display = "block";
            //document.getElementById("spacial_price_enabled").innerHTML = "";
        }
    }
    function validatefrm(){
        var alreadyFocussed = false;
        //document.frmMenu.menu_desc_id.value = tinyMCE.get('menu_desc_id').getContent();
        /*
        if(document.getElementById("base_price_id").value == "") {
            document.getElementById("base_price_errorid").innerHTML = "Base price required";
            document.getElementById("base_price_id").focus();
            return false;
        }
        if(document.getElementById("category_id_id").value == "0") {
            document.getElementById("category_id_errorid").innerHTML = "Menu Category required";
            document.getElementById("category_id_id").focus();
            return false;
        }
        if(document.frmMenu.menu_desc_id.value == "") {
            document.getElementById("menu_desc_errorid").innerHTML = "Description required";
            document.getElementById("menu_desc_id").focus();
            if(!alreadyFocussed){
                document.frmMenu.menu_desc_id.focus();
                alreadyFocussed = true;
            }
            return false;
        }
        */
        document.frmMenu.submit();
    }
</script>
<div class="panel panel-default">
    <div class="panel-heading"><h3>Add / Edit Menu</h3></div>
    <div class="panel-body">
    <?php
    if(isset($menu_id) && $menu_id !=""){
        $menuInfo 	= $restObj->fun_getMenuInfoById($menu_id);
        $restConf 	= $restObj->fun_getRestaurantConf($rest_id);
    ?>
        <div class="cols-md-12">
            <ul class="list-unstyled pull-right list-inline">
                <li><a href="manager-restaurants-menu.php?sec=price&menu_id=<?php echo $menu_id;?>&rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="btn btn-default">Menu Price</a></li>
                <li><a href="manager-restaurants-menu.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="btn btn-success">Back to Menu List</a></li>
            </ul>
        </div>
        <div class="clearfix"><br><br></div>
        <div class="cols-md-12">
        <form name="frmMenu" id="frmMenu" method="post" action="manager-restaurants-menu.php?sec=price&menu_id=<?php echo $menu_id;?>&rest_id=<?php echo $rest_id;?>" enctype="multipart/form-data">
            <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITMENUPRICE"); ?>" />
            <input type="hidden" name="rest_id" id="rest_id_id" value="<?php echo $rest_id; ?>">
            <input type="hidden" name="menu_id" id="menu_id_id" value="<?php echo $menu_id; ?>">
            <input type="hidden" name="currency_id" id="currency_id_id" value="<?php if(isset($restConf['currency_id']) && $restConf['currency_id']!=""){ echo $restConf['currency_id'];} else {echo "4";} ?>">
            <input type="hidden" name="back_url" id="back_url" value="<?php echo $_GET['back_url']; ?>">
            <br>
            <h4 class="text-danger">Edit Menu Price</h4>
            <br>
            <div class="form-group">
                <label class="control-label col-sm-3" for="rest_name">Restaurant name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="rest_name" id="rest_name_id" value="<?php echo $rest_name;?>" disabled="disabled" />
                </div>
            </div>
            <br><br>
            <div class="form-group">
                <label class="control-label col-sm-3" for="menu_name">Menu Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="menu_name" id="menu_name_id" value="<?php echo $menuInfo['menu_name'];?>" disabled="disabled" />
                </div>
            </div>
            <br><br>
            <div class="form-group">
                <label class="control-label col-sm-3" for="base_price">Menu Base Price</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="base_price" id="base_price_id" value="<?php if(isset($_POST['base_price'])){echo $_POST['base_price'];}else{echo $menuInfo['base_price'];}?>" onkeydown="chkblnkTxtError('base_price_id', 'base_price_errorid');" onkeyup="chkblnkTxtError('base_price_id', 'base_price_errorid');" <?php if(!isset($menuInfo['base_price']) || (isset($menuInfo['base_price']) && $menuInfo['base_price'] > 0) || (isset($menuInfo['base_price']) && $menuInfo['base_price'] !="")){echo'';}else{echo ' disabled="disabled"';}?> />
                    <input type="checkbox" name="base_price_enabled" id="base_price_enabled" value="1" style="width:13px; height:13px; margin-top:22px;" <?php if(!isset($menuInfo['base_price']) || (isset($menuInfo['base_price']) && $menuInfo['base_price'] > 0) || (isset($menuInfo['base_price']) && $menuInfo['base_price'] !="")){echo' checked="checked"';}else{echo '';}?> onclick="checkSpecialPrice();" />&nbsp; <span class="font11"><em>Unchecked this if any special pricing.</em></span>
                    <br />
                </div>
            </div>
            <br><br>
            <div class="form-group" id="spacial_price_enabled" style="display:<?php if(isset($menuInfo['base_price']) && $menuInfo['base_price'] !=""){echo'none';}else{echo 'block';}?>;">
                <label class="control-label col-sm-3" for="price_category_id">Price by</label>
                <div class="col-sm-9">
                    <select class="form-control" name="price_category_id" id="price_category_id_id">
                        <option value="1" <?php if(isset($menuInfo['price_category_id']) && $menuInfo['price_category_id'] =="1") {echo 'selected';}?>>Size (small, medium, large)</option>
                    </select>
                    <br>
                    <div id="spacial_price_id">
                        <?php $restObj->fun_createMenuEditPriceView($menu_id); ?>
                        <div class="clearfix"></div>
                    </div>
                    <br>
                </div>
            </div>
            <br><br>
            <div class="form-group">
                <label class="control-label col-sm-3" for="quantity_id">Quantity Type</label>
                <div class="col-sm-9">
                    <select name="quantity_id" id="quantity_id_id" class="form-control">
                        <option value="1" <?php if(isset($menuInfo['quantity_id']) && $menuInfo['quantity_id'] =="1") {echo 'selected';}?>>Quantity (in terms of numbers)</option>
                        <option value="2" <?php if(isset($menuInfo['quantity_id']) && $menuInfo['quantity_id'] =="2") {echo 'selected';}?>>Quantity (in terms of pieces)</option>
                        <option value="3" <?php if(isset($menuInfo['quantity_id']) && $menuInfo['quantity_id'] =="3") {echo 'selected';}?>>Quantity (small, medium, large)</option>
                        <option value="4" <?php if(isset($menuInfo['quantity_id']) && $menuInfo['quantity_id'] =="4") {echo 'selected';}?>>Quantity (single, six pack beers)</option>
                        <option value="5" <?php if(isset($menuInfo['quantity_id']) && $menuInfo['quantity_id'] =="5") {echo 'selected';}?>>Quantity (single, double)</option>
                    </select>
                </div>
            </div>
            <br><br>
            <?php $restObj->fun_htmlMenuEditOptionView($menu_id); ?>
            <div class="clearfix"></div>
            <br><br><br>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-10">
                    <a href="<?php echo "manager-restaurants-menu.php?rest_id=1&back_url=".$_GET['back_url']; ?>" class="btn btn-default">Cancel</a> <a href="javascript:void(0);" onclick="return validatefrm();" class="btn btn-success">Edit Now</a>
                </div>
            </div>
            <div class="clearfix"><br><br></div>
        </form>
        </div>
    <?php
    } else {
    }
    ?>
    </div>
</div>
