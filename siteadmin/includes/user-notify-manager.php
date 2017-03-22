<?php
$rest_id 	= $_REQUEST['rest_id'];
$rest_name 	= $restObj->fun_getRestaurantNameById($rest_id);
$manager_id = $restObj->fun_getRestaurantManagerId($rest_id);
$managerInfo= $usersObj->fun_getUsersInfo($manager_id);
$user_login = $managerInfo['user_login'];
$user_email = $managerInfo['user_email'];
$user_fname = $managerInfo['user_fname'];
$user_lname = $managerInfo['user_lname'];
$user_name 	= $user_fname." ".$user_lname;

?>
<script type="text/javascript" language="javascript">
	var req = ajaxFunction();

	function notify(){
		var user_id = document.getElementById("manager_id").value;
		var user_name = document.getElementById("user_name").value;
		var user_email = document.getElementById("user_email").value;
		var user_login = document.getElementById("user_login").value;
		var user_pass = document.getElementById("user_pass").value;
		if(user_id !="" && user_pass != "") {
			alert('includes/ajax/admin-notifymanagerXml.php?user_id='+user_id+'&user_name='+user_name+'&user_login='+user_login+'&user_pass='+user_pass+'&user_email='+user_email);
			req.open('get', 'includes/ajax/admin-notifymanagerXml.php?user_id='+user_id+'&user_name='+user_name+'&user_login='+user_login+'&user_pass='+user_pass+'&user_email='+user_email); 
			req.onreadystatechange = handleNotifyResponse; 
			req.send(null); 
		}
	}

	function handleNotifyResponse(){
		if(req.readyState == 4){
			var response = req.responseText;
			xmlDoc = req.responseXML;
			var root = xmlDoc.getElementsByTagName('acts')[0];
			if(root != null){
				var items = root.getElementsByTagName("act");
				for (var i = 0 ; i < items.length ; i++){
					var item = items[i];
					var status = item.getElementsByTagName("status")[0].firstChild.nodeValue;
					if(status == "success"){
						window.location = location.href;
					}
				}
			}
		}
	}

</script>
<form name="frmUsers" id="frmUsers" method="post" action="admin-user.php?sec=notify">
<input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("NOTIFYMANAGER"); ?>">
<input type="hidden" name="rest_id" id="rest_id_id" value="<?php echo $rest_id; ?>">
<input type="hidden" name="manager_id" id="manager_id" value="<?php echo $manager_id; ?>">
<input type="hidden" name="user_email" id="user_email" value="<?php echo $user_email; ?>">
<input type="hidden" name="back_url" id="back_url" value="<?php echo $_GET['back_url']; ?>">
<fieldset>
<legend>Notify manager</legend>
    <p>
        <label for="rest_name">Restaurant name</label>
        <input type="text" name="rest_name" id="rest_name" value="<?php echo $rest_name;?>" disabled="disabled" />
    </p>
    <p>
        <label for="manager_id">Manager name</label>
        <input type="text" name="user_name" id="user_name" value="<?php echo $user_name;?>" disabled="disabled" />
    </p>
    <p>
        <label for="manager_id">Login id</label>
        <input type="text" name="user_login" id="user_login" value="<?php echo $user_login;?>" disabled="disabled" />
    </p>
    <p>
        <label for="manager_id">Password</label>
        <input type="text" name="user_pass" id="user_pass" value="" />
    </p>
    <p>&nbsp;</p>
    <p>
        <label>&nbsp;</label>
        <a href="javascript:void(0);" onclick="return notify();" class="button85x30-red">Notify</a>
    </p>
</fieldset>
</form>
