<div class="register">
    <form> 
        <div class="register-top-grid">
            <h3>PERSONAL INFORMATION</h3>
            <div class="wow fadeInLeft" data-wow-delay="0.4s">
                <span>First Name<label>*</label></span>
                <input type="text"> 
            </div>
            <div class="wow fadeInRight" data-wow-delay="0.4s">
                <span>Last Name<label>*</label></span>
                <input type="text"> 
            </div>
            <div class="wow fadeInRight" data-wow-delay="0.4s">
                <span>Email Address<label>*</label></span>
                <input type="text"> 
            </div>
            <div class="clearfix"> </div>
            <a class="news-letter" href="#">
                <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up for Newsletter</label>
            </a>
        </div>
        <div class="register-bottom-grid">
            <h3>LOGIN INFORMATION</h3>
             <div class="wow fadeInLeft" data-wow-delay="0.4s">
                <span>Password<label>*</label></span>
                <input type="text">
             </div>
             <div class="wow fadeInRight" data-wow-delay="0.4s">
                <span>Confirm Password<label>*</label></span>
                <input type="text">
             </div>
        </div>
    </form>
    <div class="clearfix"> </div>
    <div class="register-but">
    <form>
        <input type="submit" value="submit">
        <div class="clearfix"> </div>
    </form>
    </div>
</div>

<?php /* ?>
<div class="box-user-left">
	<?php require_once(SITE_INCLUDES_PATH.'user-left-links.php'); ?>
    <div class="clearfix"></div>
</div>
<div class="box-user-right">
    <div class="box-user-right-wrapper font12">
		<script type="text/javascript" language="javascript">
			var req = ajaxFunction();
			function chkSelectCountry() {
				var getID = document.getElementById("user_country_id").value;
				if(getID !="" && getID != "0"){
					sendStateRequest(getID);
				}
				if(getID == "0" || getID =="") {
					document.getElementById("user_state_id").value = "0";
				}
			}
		
			function sendStateRequest(id) { 
				req.open('get', 'selectStateXml.php?id='+id); 
				req.onreadystatechange = handleStateResponse; 
				req.send(null); 
			} 
		
			function handleStateResponse() { 
				var arrayOfId = new Array();
				var arrayOfNames = new Array();
				if(req.readyState == 4) { 
					var response = req.responseText; 
					xmlDoc=req.responseXML;
					var root = xmlDoc.getElementsByTagName('states')[0];
					if(root != null) {
						var items = root.getElementsByTagName("state");
						for (var i = 0 ; i < items.length ; i++) {
							var item = items[i];
							var id = item.getElementsByTagName("id")[0].firstChild.nodeValue;
							arrayOfId[i] = id;
							var name = item.getElementsByTagName("name")[0].firstChild.nodeValue;
							arrayOfNames[i] = name;
							//alert("item #" + i + ": ID=" + id + " Name=" + name);
						}
						if( arrayOfId.length > 0) {
							var user_state = document.getElementById("user_state_id");
							user_state.length = 0;
							user_state.options[0] = new Option("Please Select...", "");
							for(var j=0; j<arrayOfId.length; j++) {
								user_state.options[j+1]=new Option(arrayOfNames[j], arrayOfId[j]);
							}
						} else {
							// For State
							var user_state = document.getElementById("user_state_id");
							user_state.length = 0;
							user_state.options[0] = new Option("Please Select...", "");
						}
					} else {
						// For State
						var user_state = document.getElementById("user_state_id");
						user_state.length = 0;
						user_state.options[0] = new Option("Please Select...", "");
					}
				} 
			} 
	
            function chkblnkTxtError(strFieldId, strErrorFieldId){
                if(document.getElementById(strFieldId).value != ""){
                    document.getElementById(strErrorFieldId).innerHTML = "";
                }
            }
        
            function validateeditfrm(){
                if(document.getElementById("user_fname_id").value == "") {
                    document.getElementById("user_fname_errorid").innerHTML = "First Name required";
                    document.getElementById("user_fname_id").focus();
                    return false;
                }
                if(document.getElementById("user_lname_id").value == "") {
                    document.getElementById("user_lname_errorid").innerHTML = "Last Name required";
                    document.getElementById("user_lname_id").focus();
                    return false;
                }
        
                if(document.getElementById("user_email_id").value == "") {
                    document.getElementById("user_email_errorid").innerHTML = "Enter valid email address";
                    document.getElementById("user_email_id").focus();
                    return false;
                } else {
                    var emailRegxp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    var txtemail = document.getElementById("user_email_id").value;
                    if (emailRegxp.test(txtemail)!= true){
                        document.getElementById("user_email_errorid").innerHTML = "Enter valid email address";
                        document.getElementById("user_email_id").value = "";
                        document.getElementById("user_email_id").focus();
                        return false;
                    }
                }
//                if(document.getElementById("user_login_id").value == "") {
//                    document.getElementById("user_login_errorid").innerHTML = "Login id required";
//                    document.getElementById("user_login_id").focus();
//                    return false;
//                }
      
                if(document.getElementById("user_address1_id").value == "") {
                    document.getElementById("user_address1_errorid").innerHTML = "Address required";
                    document.getElementById("user_address1_id").focus();
                    return false;
                }
                
                if(document.getElementById("user_city_id").value == "") {
                    document.getElementById("user_city_errorid").innerHTML = "City required";
                    document.getElementById("user_city_id").focus();
                    return false;
                }
        
                if(document.getElementById("user_state_id").value == "") {
                    document.getElementById("user_state_id_errorid").innerHTML = "State required";
                    document.getElementById("user_state_id").focus();
                    return false;
                }
        
                if(document.getElementById("user_zip_id").value == "") {
                    document.getElementById("user_zip_errorid").innerHTML = "Zip Code required";
                    document.getElementById("user_zip_id").focus();
                    return false;
                }
        
                if(document.getElementById("user_country_id").value == "") {
                    document.getElementById("user_country_id_errorid").innerHTML = "Country required";
                    document.getElementById("user_country_id").focus();
                    return false;
                }
                document.frmUser.submit();
            }
        
            function validateaddfrm(){
                if(document.getElementById("user_fname_id").value == "") {
                    document.getElementById("user_fname_errorid").innerHTML = "First Name required";

                    document.getElementById("user_fname_id").focus();
                    return false;
                }
                if(document.getElementById("user_lname_id").value == "") {
                    document.getElementById("user_lname_errorid").innerHTML = "Last Name required";
                    document.getElementById("user_lname_id").focus();
                    return false;
                }
        
                if(document.getElementById("user_email_id").value == "") {
                    document.getElementById("user_email_errorid").innerHTML = "Enter valid email address";
                    document.getElementById("user_email_id").focus();
                    return false;
                } else {
                    var emailRegxp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    var txtemail = document.getElementById("user_email_id").value;
                    if (emailRegxp.test(txtemail)!= true){
                        document.getElementById("user_email_errorid").innerHTML = "Enter valid email address";
                        document.getElementById("user_email_id").value = "";
                        document.getElementById("user_email_id").focus();
                        return false;
                    }
                }
//                if(document.getElementById("user_login_id").value == "") {
//                    document.getElementById("user_login_errorid").innerHTML = "Login id required";
//                    document.getElementById("user_login_id").focus();
//                    return false;
//                }
        
//                if(document.getElementById("user_pass_id").value == "") {
//                    document.getElementById("user_pass_errorid").innerHTML = "Password required";
//                    document.getElementById("user_pass_id").focus();
//                    return false;
//                }
      
                document.frmUser.submit();
            }

			function showChangePassword(str) {
				var str = str;
				if(str == 1){
					document.getElementById("showchangepassLinkId").style.display = "none";
					document.getElementById("showchangepassId").style.display = "block";
				} else if(str == 0){
					document.getElementById("showchangepassLinkId").style.display = "block";
					document.getElementById("showchangepassId").style.display = "none";
				}
			}

			function changePassword(){
				var strOldPassword = document.getElementById("txtOldPasswordId").value;
				var strNewPassword = document.getElementById("txtNewPasswordId").value;
				var strConfirmPassword = document.getElementById("txtConfirmPasswordId").value;
				var strUserId = document.getElementById("user_id").value;
				if(document.getElementById("txtOldPasswordId").value == ""){
					document.getElementById("showErrorOldPassword").innerHTML = "Incorrect old password: Passwords do not match, please try again";
					document.getElementById("txtOldPasswordId").focus();
					return false;
				}
				if(document.getElementById("txtNewPasswordId").value == ""){
					document.getElementById("showErrorConfirmPassword").innerHTML = "New passwords is blank: Passwords do not match, please try again";
					document.getElementById("txtNewPasswordId").focus();
					return false;
				}
				if(document.getElementById("txtNewPasswordId").value.length < 6){
					document.getElementById("showErrorConfirmPassword").innerHTML = "New passwords can not be less than six character, please try again";
					document.getElementById("txtNewPasswordId").focus();
					return false;
				}
				if(document.getElementById("txtConfirmPasswordId").value == ""){
					document.getElementById("showErrorConfirmPassword").innerHTML = "Confirm passwords do not match: Passwords do not match, please try again";
					document.getElementById("txtConfirmPasswordId").focus();
					return false;
				}
				if(document.getElementById("txtConfirmPasswordId").value != document.getElementById("txtNewPasswordId").value){
					document.getElementById("showErrorConfirmPassword").innerHTML = "Confirm password not matched";
					document.getElementById("txtConfirmPasswordId").focus();
					return false;
				}
				sendChangePasswordRequest(strUserId, strOldPassword, strNewPassword);
				return false;
			}
		
			function sendChangePasswordRequest(strUserId, strOldPassword, strNewPassword) { 
				req.open('get', '<?php echo SITE_URL;?>includes/ajax/changeuserpasswordAjax.php?usr=' + strUserId + '&oldpass=' + strOldPassword + '&newpass=' + strNewPassword); 
				req.onreadystatechange = handleChangePasswordResponse; 
				req.send(null); 
			} 
		
			function handleChangePasswordResponse() { 
				var arrayOfUserStatus = new Array();
				if(req.readyState == 4)	{
					var response = req.responseText; 
					xmlDoc = req.responseXML;
					var root = xmlDoc.getElementsByTagName('users')[0];
					if(root != null) {
						var items = root.getElementsByTagName("user");
						for (var i = 0 ; i < items.length ; i++) {
							var item = items[i];
							var status = item.getElementsByTagName("status")[0].firstChild.nodeValue;
							arrayOfUserStatus[i] = status;
						}
						if(arrayOfUserStatus[0] == "password changed") {
							showChangePassword(0);
							document.getElementById("showchangepassLinkId1").innerHTML="Password changed successfully";
							return false;
						} else if(arrayOfUserStatus[0] == "password wrong") {
							document.getElementById("showErrorConfirmPassword").innerHTML="Incorrect old password: Passwords do not match, please try again";
						} else if(arrayOfUserStatus[0] == "failed") {
							document.getElementById("showErrorConfirmPassword").innerHTML="New passwords do not match: Passwords do not match, please try again";
						}
					} else {
						document.getElementById("showErrorConfirmPassword").innerHTML="New passwords do not match: Passwords do not match, please try again";
					}
				} else {
					document.getElementById("showErrorConfirmPassword").innerHTML="Please wait...";
				}
			} 
        
        </script>
        <form name="frmUser" id="frmUser" method="post" action="profile-settings.php?sec=edit&user_id=<?php echo $user_id;?>">
            <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("EDITUSER");?>">
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="user_login" id="user_login_id" value="<?php echo $userInfoArr['user_login']; ?>" />
            <fieldset>
            <legend>Profile & Settings</legend>
            <p>
                <label for="user_fname">First name</label>
                <input type="text" name="user_fname" id="user_fname_id" value="<?php if(isset($_POST['user_fname'])){echo $_POST['user_fname'];}else{echo $userInfoArr['user_fname'];}?>" onkeydown="chkblnkTxtError('user_fname_id', 'user_fname_errorid');" onkeyup="chkblnkTxtError('user_fname_id', 'user_fname_errorid');" />
                &nbsp;<span class="error" id="user_fname_errorid"><?php if(array_key_exists('user_fname_error', $form_array)) echo $form_array['user_fname_error'];?></span>
            </p>
            <p>
                <label for="user_lname">Last name</label>
                <input type="text" name="user_lname" id="user_lname_id" value="<?php if(isset($_POST['user_lname'])){echo $_POST['user_lname'];}else{echo $userInfoArr['user_lname'];}?>" onkeydown="chkblnkTxtError('user_lname_id', 'user_lname_errorid');" onkeyup="chkblnkTxtError('user_lname_id', 'user_lname_errorid');" />
                &nbsp;<span class="error" id="user_lname_errorid"><?php if(array_key_exists('user_lname_error', $form_array)) echo $form_array['user_lname_error'];?></span>
            </p>
            <p>
                <label for="user_email">Email address</label>
                <input type="text" name="user_email" id="user_email_id" value="<?php if(isset($_POST['user_email'])){echo $_POST['user_email'];}else{echo $userInfoArr['user_email'];}?>" onkeydown="chkblnkTxtError('user_email_id', 'user_email_errorid');" onkeyup="chkblnkTxtError('user_email_id', 'user_email_errorid');" />
                &nbsp;<span class="error" id="user_email_errorid"><?php if(array_key_exists('user_email_error', $form_array)) echo $form_array['user_email_error'];?></span>
            </p>
			<!--
            <p>
                <label for="user_login">Login Id</label>
                <input type="text" name="user_login" id="user_login_id" value="<?php if(isset($_POST['user_login'])){echo $_POST['user_login'];}else{echo $userInfoArr['user_login'];}?>" onkeydown="chkblnkTxtError('user_login_id', 'user_login_errorid');" onkeyup="chkblnkTxtError('user_login_id', 'user_login_errorid');" />
                &nbsp;<span class="error" id="user_login_errorid"><?php if(array_key_exists('user_login_error', $form_array)) echo $form_array['user_login_error'];?></span>
            </p>
			-->
            <p>
            <div id="showchangepassLinkId" style="display:block;">
                <label for="user_pass">Password</label>
                <input type="password" name="user_pass" id="user_pass_id" value="*****" />
                &nbsp;<div id="showchangepassLinkId1" align="left" style="float:right; padding-top:15px;"><a href="javascript:showChangePassword(1);" class="blue">Change Password</a></div>
                </div>
            </p>
            <p>
                <div id="showchangepassId" style="display:none; padding-left:0px; background:#f7f7f7;">
                    <table width="100%" border="0" cellspacing="5" cellpadding="5">
                        <tr>
                            <td width="177" align="right" valign="middle"><?php echo tranText('Current Password'); ?></td>
                            <td width="245" valign="top"><input name="txtOldPassword" id="txtOldPasswordId" type="password" value="" onkeydown="chkblnkTxtError('txtOldPasswordId', 'showErrorOldPassword');" onkeyup="chkblnkTxtError('txtOldPasswordId', 'showErrorOldPassword');" /></td>
                            <td valign="top"><span class="error" id="showErrorOldPassword">&nbsp;</span></td>
                        </tr>
                        <tr>
                            <td align="right" valign="middle"><?php echo tranText('New Password'); ?></td>
                            <td valign="top"><input name="txtNewPassword" id="txtNewPasswordId" type="password" value="" onkeydown="chkblnkTxtError('txtNewPasswordId', 'showErrorNewPassword');" onkeyup="chkblnkTxtError('txtNewPasswordId', 'showErrorNewPassword');" /></td>
                            <td valign="top"><span class="error" id="showErrorNewPassword">&nbsp;</span></td>
                        </tr>
                        <tr>
                            <td align="right" valign="middle"><?php echo tranText('Repeat New Password'); ?></td>
                            <td valign="top"><input name="txtConfirmPassword" id="txtConfirmPasswordId" type="password" value="" onkeydown="chkblnkTxtError('txtConfirmPasswordId', 'showErrorConfirmPassword');" onkeyup="chkblnkTxtError('txtConfirmPasswordId', 'showErrorConfirmPassword');" /></td>
                            <td valign="top"><span class="error" id="showErrorConfirmPassword">&nbsp;</span></td>
                        </tr>
                        <tr>
                            <td align="right" valign="middle">&nbsp;</td>
                            <td colspan="2" valign="top">
                                <a href="javascript:showChangePassword(0);" class="button-grey" style="text-decoration:none;">Cancel</a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="return changePassword(0);" class="button-red" style="text-decoration:none;">Submit</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </p>
            <p>
                <label for="rest_address1">Street address</label>
                <input type="text" name="user_address1" id="user_address1_id" value="<?php if(isset($_POST['user_address1'])){echo $_POST['user_address1'];}else{echo $userInfoArr['user_address1'];}?>" onkeydown="chkblnkTxtError('user_address1_id', 'user_address1_error');" onkeyup="chkblnkTxtError('user_address1_id', 'user_address1_error');" />
                &nbsp;<span class="error" id="user_address1_errorid"><?php if(array_key_exists('user_address1_error', $form_array)) echo $form_array['user_address1_error'];?></span>
            </p>
            <p>
                <label for="user_address2">&nbsp;</label>
                <input type="text" name="user_address2" id="user_address2_id" value="<?php if(isset($_POST['user_address2'])){echo $_POST['user_address2'];}else{echo $userInfoArr['user_address2'];}?>" />
                &nbsp;
            </p>
             <p class="pad-btm5">
                <label for="rest_country_id">Country</label>
                <select name="user_country" id="user_country_id" class="select310" onchange="chkSelectCountry();">
                    <option value="0" selected>Select ... </option>
					<?php 
					$locationObj->fun_getCountryOptionsList(((isset($_POST['user_country']) && ($_POST['user_country'] != "" || $_POST['user_country'] != "0"))?$_POST['user_country']:((isset($userInfoArr['user_country']) && ($userInfoArr['user_country'] != "" || $userInfoArr['user_country'] != "0"))?$userInfoArr['user_country']:223)), '');
                    ?>
                </select>
                <span class="error" id="user_country_id_errorid"><?php if(array_key_exists('user_country_id_error', $form_array)) echo $form_array['user_country_id_error'];?></span>
            </p>
            <p>
                <label for="rest_state_id">State / Province</label>
                <select name="user_state" id="user_state_id" class="select310">
                    <option value="0" selected>Select ... </option>
					<?php 
                    $locationObj->fun_getStateOptionsListByCountryId(((isset($_POST['user_state']) && ($_POST['user_state'] != "" || $_POST['user_state'] != "0"))?$_POST['user_state']:$userInfoArr['user_state']), ((isset($_POST['user_country']) && ($_POST['user_country'] != "" || $_POST['user_country'] != "0"))?$_POST['user_country']:((isset($userInfoArr['user_country']) && ($userInfoArr['user_country'] != "" || $userInfoArr['user_country'] != "0"))?$userInfoArr['user_country']:223)));
                    ?>
                </select>
                <span class="error" id="user_state_id_errorid"><?php if(array_key_exists('user_state_id_error', $form_array)) echo $form_array['user_state_id_error'];?></span>
            </p>
            <p>
                <label for="user_city">City</label>
                <input type="text" name="user_city" id="user_city_id" value="<?php if(isset($_POST['user_city'])){echo $_POST['user_city'];}else{echo $userInfoArr['user_city'];}?>" onkeydown="chkblnkTxtError('user_city_id', 'user_city_errorid');" onkeyup="chkblnkTxtError('user_city_id', 'user_city_errorid');" />
                &nbsp;<span class="error" id="user_city_errorid"><?php if(array_key_exists('user_city_error', $form_array)) echo $form_array['user_city_error'];?></span>
            </p>
            <p>
                <label for="user_zip">Zip / Postal code</label>
                <input type="text" name="user_zip" id="user_zip_id" value="<?php if(isset($_POST['user_zip'])){echo $_POST['user_zip'];}else{echo $userInfoArr['user_zip'];}?>" onkeydown="chkblnkTxtError('user_zip_id', 'user_zip_errorid');" onkeyup="chkblnkTxtError('user_zip_id', 'user_zip_errorid');" />
                &nbsp;<span class="error" id="user_zip_errorid"><?php if(array_key_exists('user_zip_error', $form_array)) echo $form_array['user_zip_error'];?></span>
            </p>
            <p>&nbsp;</p>
            <p>
                <label>&nbsp;</label>
                <a href="javascript:void(0);" onclick="return validateeditfrm();" class="button-red">Edit Now</a>
            </p>
            </fieldset>
        </form>
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<?php */ ?>