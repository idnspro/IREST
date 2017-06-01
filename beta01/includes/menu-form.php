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
    function validatefrm(){
        var alreadyFocussed = false;
        document.frmMenu.menu_desc_id.value = tinyMCE.get('menu_desc_id').getContent();
        if(document.getElementById("menu_name_id").value == "") {
            document.getElementById("menu_name_errorid").innerHTML = "Menu Name required";
            document.getElementById("menu_name_id").focus();
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
        document.frmMenu.submit();
    }
</script>
<!-- TinyMCE -->
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
    mode : "exact",
    elements : "menu_desc_id",
    theme : "advanced",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",

});

function myHandleEvent(e){
    if(e.type=="keyup"){
        chkblnkEditorTxtError("menu_desc_id", "menu_desc_errorid");	
    }
    return true;
}
</script>
<!-- /TinyMCE -->
<div class="panel panel-default">
    <div class="panel-heading"><h3>Add / Edit Menu</h3></div>
    <div class="panel-body">
        <?php
        if(isset($menu_id) && $menu_id !=""){
            $menuInfo  = $restObj->fun_getMenuInfoById($menu_id);
            //$item_id = $restObj->fun_getMenuItemId($menu_id);
        ?>
        <div class="cols-md-12">
            <ul class="list-unstyled pull-right list-inline">
                <li><a href="manager-restaurants-menu.php?sec=price&menu_id=<?php echo $menu_id;?>&rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="btn btn-default">Menu Price</a></li>
                <li><a href="manager-restaurants-menu.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="btn btn-success">Back to Menu List</a></li>
                <li><a href="manager-restaurants.php" class="btn btn-success">Back to restaurant list</a></li>
            </ul>
        </div>
        <div class="clearfix"><br><br></div>
        <div class="cols-md-12">
                <form name="frmMenu" id="frmMenu" method="post" action="manager-restaurants-menu.php?sec=edit&menu_id=<?php echo $menu_id;?>&rest_id=<?php echo $rest_id;?>" enctype="multipart/form-data">
                <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITMENU"); ?>" />
                <input type="hidden" name="rest_id" id="rest_id_id" value="<?php echo $rest_id; ?>">
                <input type="hidden" name="menu_id" id="menu_id_id" value="<?php echo $menu_id; ?>">
                <input type="hidden" name="active" id="active" value="1">
                <input type="hidden" name="back_url" id="back_url" value="<?php echo $_GET['back_url']; ?>">
                    <br>
                    <h4 class="text-danger">Edit Menu</h4>
                    <br>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="rest_name">Restaurant name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="rest_name" id="rest_name_id" value="<?php echo $rest_name;?>" disabled="disabled" />
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="category_id">Menu Category</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="category_id" id="category_id_id">
                                <option value="0">Select ... </option>
                                <?php $restObj->fun_getMenuCategoyChildParentOptionsList($menuInfo['category_id']); ?> 
                            </select>
                            <span><a href="manager-settings.php?sec=category" class="text-success">Add New Category</a></span>
                        </div>
                    </div>
                    <br><br><br>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="menu_name">Menu Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="menu_name" id="menu_name_id" value="<?php if(isset($_POST['menu_name'])){echo $_POST['menu_name'];}else{echo $menuInfo['menu_name'];}?>" />
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="menu_desc">Description</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control" name="menu_desc" id="menu_desc_id" /><?php if(isset($_POST['menu_desc'])){echo $_POST['menu_desc'];}else{echo $menuInfo['menu_desc'];}?></textarea>
                        </div>
                    </div>
                    <br><br><br><br>
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
        ?>
        <div class="cols-md-12">
            <ul class="list-unstyled pull-right list-inline">
                <li><a href="manager-restaurants-menu.php?rest_id=<?php echo $rest_id;?>&back_url=<?php echo $_GET['back_url']; ?>" class="btn btn-success">Back to Menu List</a></li>
                <li><a href="manager-restaurants.php" class="btn btn-success">Back to restaurant list</a></li>
            </ul>
        </div>
        <div class="clearfix"><br><br></div>
        <div class="cols-md-12">
                <form name="frmMenu" id="frmMenu" method="post" action="manager-restaurants-menu.php?sec=add" enctype="multipart/form-data">
                <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("ADDMENU"); ?>" />
                <input type="hidden" name="rest_id" id="rest_id_id" value="<?php echo $rest_id; ?>">
                <input type="hidden" name="active" id="active" value="1">
                <input type="hidden" name="back_url" id="back_url" value="<?php echo $_GET['back_url']; ?>">
                <br>
                <h4 class="text-danger">Add Menu</h4>
                <br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="rest_name">Restaurant name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="rest_name" id="rest_name_id" value="<?php echo $rest_name;?>" disabled="disabled" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="category_id">Menu Category</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="category_id" id="category_id_id">
                            <option value="0">Select ... </option>
                            <?php $restObj->fun_getMenuCategoyChildParentOptionsList($menuInfo['category_id']); ?> 
                        </select>
                        <span><a href="manager-settings.php?sec=category" class="text-success">Add New Category</a></span>
                    </div>
                </div>
                <br><br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="menu_name">Menu Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="menu_name" id="menu_name_id" value="<?php if(isset($_POST['menu_name'])){echo $_POST['menu_name'];}else{echo $menuInfo['menu_name'];}?>" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="menu_desc">Description</label>
                    <div class="col-sm-9">
                        <textarea type="text" class="form-control" name="menu_desc" id="menu_desc_id" /><?php if(isset($_POST['menu_desc'])){echo $_POST['menu_desc'];}else{echo $menuInfo['menu_desc'];}?></textarea>
                    </div>
                </div>
                <br><br><br><br>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-10">
                        <a href="<?php echo "manager-restaurants-menu.php?rest_id=1&back_url=".$_GET['back_url']; ?>" class="btn btn-default">Cancel</a> <a href="javascript:void(0);" onclick="return validatefrm();" class="btn btn-success">Add Now</a>
                    </div>
                </div>
                <div class="clearfix"><br><br></div>
            </form>
        </div>
        <?php
        }
        ?>
    </div>
</div>
