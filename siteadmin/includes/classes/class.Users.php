<?php
class Users{
	var $dbObj;
	function Users(){ // class constructor
		$this->dbObj = new DB();
		$this->dbObj->fun_db_connect();
	}
	function fun_getUsersInfo($usersID=0, $usersLogin=''){
		$usersArray = array();
		$sql = "SELECT * FROM " . TABLE_USERS . " WHERE ";
		if($usersLogin!=""){
			$sql .= "user_login='".fun_db_input($usersLogin)."' ";
		}else{
			$sql .= "user_id='".(int)fun_db_input($usersID)."' ";
		}
		$result = $this->dbObj->fun_db_query($sql);
		if($this->dbObj->fun_db_get_num_rows($result) > 0){
			$rowsArray = $this->dbObj->fun_db_fetch_rs_object($result);
			$usersArray['user_id'] 		= fun_db_output($rowsArray->user_id);
			$usersArray['user_login'] 	= fun_db_output($rowsArray->user_login);
			$usersArray['user_pass'] 	= fun_db_output($rowsArray->user_pass);
			$usersArray['user_fname'] 	= fun_db_output($rowsArray->user_fname);
			$usersArray['user_lname'] 	= fun_db_output($rowsArray->user_lname);
			$usersArray['user_email'] 	= fun_db_output($rowsArray->user_email);
			$usersArray['user_dob'] 	= fun_db_output($rowsArray->user_dob);
			$usersArray['user_country'] = fun_db_output($rowsArray->user_country);
			$usersArray['user_state'] 	= fun_db_output($rowsArray->user_state);
			$usersArray['user_city'] 	= fun_db_output($rowsArray->user_city);
			$usersArray['user_address1']= fun_db_output($rowsArray->user_address1);
			$usersArray['user_address2']= fun_db_output($rowsArray->user_address2);
			$usersArray['user_zip'] 	= fun_db_output($rowsArray->user_zip);
			$usersArray['user_ip'] 		= fun_db_output($rowsArray->user_ip);			
			$usersArray['is_admin'] 	= fun_db_output($rowsArray->is_admin);
			$usersArray['is_moderator'] = fun_db_output($rowsArray->is_moderator);
			$usersArray['is_manager'] 	= fun_db_output($rowsArray->is_manager);
			$usersArray['created_on'] 	= fun_db_output($rowsArray->created_on);
			$usersArray['updated_on'] 	= fun_db_output($rowsArray->updated_on);
			$usersArray['user_status'] 	= fun_db_output($rowsArray->user_status);
		}
		$this->dbObj->fun_db_free_resultset($result);
		return $usersArray;
	}
	
	//Return user name: Start Here
	function fun_getUserNameById($user_id = '') {
		if($user_id == '') {
			return false;
		} else {
			return $this->dbObj->getField(TABLE_USERS, "user_id", $user_id, "CONCAT_WS(' ', user_fname, user_lname)");
		}
	}
	//Return user name: End Here

	function fun_checkEmailAddress($emailID, $memID = ''){
		$emailFound = false;
		$sqlCheck = "SELECT user_email FROM " . TABLE_USERS . " WHERE user_email = '".fun_db_input($emailID)."' ";
		if($memID !="" && $memID > 0){
			$sqlCheck .= " AND user_id = '".fun_db_input($memID)."'";
		}				
		if($this->fun_get_num_rows($sqlCheck) > 0){
			$emailFound = true;
		}
		return $emailFound;
	}
	
	//Add New User
	function fun_addUser($user_login, $user_pass, $user_fname ='', $user_lname ='', $user_email =''){
		if($user_login == '' || $user_pass == '') {
			return false;
		} else {
			$cur_unixtime 			= time ();
			if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_admin_id'];
			} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_modarator_id'];
			} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_user_id'];
			} else {
				$cur_user_id 	= "";
			}
			$user_activation_link 	= 1;
			$user_status 			= 1;
	
			$field_names 		= array("user_login", "user_pass", "user_fname", "user_lname", "user_email", "created_on", "created_by", "updated_on", "updated_by", "user_activation_link", "user_status");
			$field_values 		= array(fun_db_input($user_login), md5($user_pass), fun_db_input($user_fname), fun_db_input($user_lname), fun_db_input($user_email), $cur_unixtime, $cur_user_id, $cur_unixtime, $cur_user_id, $user_activation_link, $user_status);
			$this->dbObj->insertFields(TABLE_USERS, $field_names, $field_values);
			$user_id 			= $this->dbObj->getIdentity();
			return $user_id;
		}
	}

	//Edit existing user information
	function fun_editUser($user_id){
		$cur_unixtime 	= time ();
		if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
			$cur_user_id 	= $_SESSION['ses_admin_id'];
		} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !="") {
			$cur_user_id 	= $_SESSION['ses_modarator_id'];
		} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !="") {
			$cur_user_id 	= $_SESSION['ses_user_id'];
		} else {
			$cur_user_id 	= "";
		}

		if($user_id =="") {
			return false;
		} else {
			//Upadate updated by, updated on
			$sqlUpdate = "UPDATE " . TABLE_USERS . " SET updated_on='" . $cur_unixtime . "', updated_by='" . $cur_user_id . "' WHERE user_id='".(int)$user_id."'";

			$this->dbObj->mySqlSafeQuery($sqlUpdate);
			// Updates from details page
			if($_POST['securityKey']==md5(EDITUSER)){		
				// Step I : if general details available update it
				$user_login		= $_POST['user_login'];
				$user_fname		= $_POST['user_fname'];
				$user_lname		= $_POST['user_lname'];
				$user_email		= $_POST['user_email'];
				$user_country 	= $_POST['user_country'];
				$user_state 	= $_POST['user_state'];
				$user_city		= $_POST['user_city'];
				$user_address1 	= $_POST['user_address1'];
				$user_address2	= $_POST['user_address2'];
				$user_zip 		= $_POST['user_zip'];

				$userArray = array(							
					"user_login" 	=> $user_login,
					"user_fname" 	=> $user_fname,
					"user_lname" 	=> $user_lname,
					"user_email" 	=> $user_email,
					"user_country" 	=> $user_country,
					"user_state" 	=> $user_state,
					"user_city" 	=> $user_city,
					"user_address1" => $user_address1,
					"user_address2" => $user_address2,
					"user_zip" 		=> $user_zip,
					"updated_on" 	=> $cur_unixtime,
					"updated_by" 	=> $cur_user_id
				);
		
				$fields = "";
				foreach($userArray as $keys => $vals){
					$fields .= $keys . "='" . fun_db_input($vals). "', ";
				}
				if($fields!=""){
					$fields = substr($fields,0,strlen($fields)-2);
					$sqlUpdate = "UPDATE " . TABLE_USERS . " SET " . $fields . " WHERE user_id='".(int)$user_id."'";
					$this->dbObj->mySqlSafeQuery($sqlUpdate);
				}
			}
			return true;
		}
	}

	//Update User as manager
	function fun_updateUserAsManager($user_id){
		if($user_id == '') {
			return false;
		} else {
			$is_manager 	= 1;
			$field_names 	= array("is_manager");
			$field_values 	= array($is_manager);
			$this->dbObj->updateFields(TABLE_USERS, "user_id", $user_id, $field_names, $field_values);
			return true;
		}
	}

	// Function for User search list
	function fun_getUserArr($parameter = ''){
		$sql = "SELECT distinct A.user_id, 
			A.user_fname, 
			A.user_lname, 
			A.user_email, 
			A.user_country, 
			A.user_state, 
			A.user_city, 
			A.user_address1, 
			A.user_address2,
			A.user_email, 
			A.user_zip,
			A.is_manager,
			A.user_status
			FROM " . TABLE_USERS . " AS A";
		if($parameter != ""){
			$sql .= $parameter;
		} else {
			$sql .= " ORDER BY A.updated_on DESC";		
		}
		return $rs = $this->dbObj->createRecordset($sql);
	}
	
	// Function for creating optionlist for managers if manager_id is available it must be selected
	function fun_getManagerOptionsList($manager_id='', $queryparameters=''){		
		$selected 	= "";
		$sql 		= "SELECT * FROM " . TABLE_USERS. " AS A WHERE A.is_manager = '1' ";
		if($queryparameters !=""){
			$sql .= " ".$queryparameters." ";
		} else {
			$sql .= " ORDER BY A.user_fname";
		}
		$result = $this->dbObj->fun_db_query($sql);
		while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result)){
			if($rowsCon->user_id == $manager_id  && $manager_id!=''){
				$selected = "selected";
			} else {
				$selected = "";
			}
			echo "<option value=\"".fun_db_output($rowsCon->user_id)."\" " .$selected. ">";
			echo fun_db_output(ucwords(fill_zero_left($rowsCon->user_id, "0", (6-strlen($rowsCon->user_id))). ' - ' .$rowsCon->user_fname. ' ' .$rowsCon->user_lname));
			echo "</option>\n";
		}
		$this->dbObj->fun_db_free_resultset($result);
	}

	// This function will Return currency info of user
	function fun_getUserCurrencyInfo($user_id = '') {
		if(isset($user_id) && $user_id !="") {
			$sql 	= "SELECT currency_id FROM " . TABLE_USER_CURRENCY_SETTINGS . " WHERE user_id='".$user_id."'";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0) {
				$arr = $this->dbObj->fetchAssoc($rs);
				$currency_id = $arr[0]['currency_id'];
			} else {
				global $ipcountry;
				if(isset($ipcountry) && ($ipcountry == "IND")) {
					$currency_id = '4';
				} else {
					$currency_id = '5';
				}
			}
		} else {
			global $ipcountry;
			if(isset($ipcountry) && ($ipcountry == "IND")) {
				$currency_id = '4';
			} else {
				$currency_id = '5';
			}
		}

		$sql 	= "SELECT * FROM " . TABLE_CURRENCIES . " WHERE currency_id='".$currency_id."'";
		$rs 	= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0) {
			$arr = $this->dbObj->fetchAssoc($rs);
			return $arr[0];
		}
	}

	function fun_verifyUsers($login, $pass){		
		$usersFound = false;
		$val = 1;
		$sqlCheck = "SELECT user_login FROM " . TABLE_USERS . " WHERE md5(user_login)='".md5(trim($login))."' ";
		$sqlCheck .= " AND user_pass='".md5($pass)."' AND user_activation_link='".$val."' AND user_status='".$val."'";		
		if($this->fun_get_num_rows($sqlCheck) > 0){
			$usersFound = true;
		}
		return $usersFound;
	}
	

	//function to get user registered for newsletter info array
	function fun_getUser4NewsletterInfo($strEmail){
		$User4NewsletterArray = array();
		$sql = "SELECT * FROM " . TABLE_USER_NEWSLETTER . " WHERE user_email='".trim($strEmail)."'";		
		$result = $this->dbObj->fun_db_query($sql);
		if($this->dbObj->fun_db_get_num_rows($result) > 0){
			$rowsArray = $this->dbObj->fun_db_fetch_rs_object($result);
			$User4NewsletterArray['id'] 		= fun_db_output($rowsArray->id);
			$User4NewsletterArray['user_id'] 	= fun_db_output($rowsArray->user_id);
			$User4NewsletterArray['user_email'] = fun_db_output($rowsArray->user_email);
			$User4NewsletterArray['created_on'] = fun_db_output($rowsArray->created_on);
			$User4NewsletterArray['active'] 	= fun_db_output($rowsArray->active);
		}
		$this->dbObj->fun_db_free_resultset($result);
		return $User4NewsletterArray;
	}

	//function to verify user registered for newsletter
	function fun_verifyUser4Newsletter($strEmail){		
		$usersFound = false;
		$sqlCheck = "SELECT * FROM " . TABLE_USER_NEWSLETTER . " WHERE user_email='".trim($strEmail)."'";		
		if($this->fun_get_num_rows($sqlCheck) > 0){
			$usersFound = true;
		}
		return $usersFound;
	}

	// Function for email users array
	function fun_getUser4NewsLeterListArr(){
        $sql1 	= "SELECT 	* FROM " . TABLE_USERS_NEWSLETTER . " AS A ORDER BY A.created_on";
		$rs1 	= $this->dbObj->createRecordset($sql1);
		$arr1 	= $this->dbObj->fetchAssoc($rs1);


        $sql2 	= "SELECT 	* FROM " . TABLE_USER_NEWSLETTER . " AS A ORDER BY A.created_on";
		$rs2 	= $this->dbObj->createRecordset($sql2);
        $arr2 	= $this->dbObj->fetchAssoc($rs2);

		$j 		= count($arr1);
		for($i = 0; $i < count($arr2); $i++) {
			$arr1[$j] = $arr2[$i];
			$j++;
		}
		return $arr1;
	}

	// Function for email users array
	function fun_delUserNewsLetter($id){
		// Delete from TABLE_USER_NEWSLETTER
		$strDelQuery = "DELETE FROM " . TABLE_USER_NEWSLETTER . " WHERE id='".$id."'";
		$this->dbObj->mySqlSafeQuery($strDelQuery);
		return true;
	}

	// Function for email users array
	function fun_getUserNewsLetterArr($parameter){
        $sql 	= "SELECT A.* FROM " . TABLE_USER_NEWSLETTER . " AS A ";
		if($parameter != ""){
			$sql .= $parameter;
		} else {
			$sql .= " ORDER BY A.id";		
		}

		$rs 	= $this->dbObj->createRecordset($sql);
		$arr 	= $this->dbObj->fetchAssoc($rs);
		return $arr;
	}

	// Function for email users array
	function fun_getNewsLetterArr($parameter){
        $sql 	= "SELECT A.* FROM " . TABLE_NEWSLETTER . " AS A ";
		if($parameter != ""){
			$sql .= $parameter;
		} else {
			$sql .= " ORDER BY A.id";		
		}

		$rs 	= $this->dbObj->createRecordset($sql);
		$arr 	= $this->dbObj->fetchAssoc($rs);
		return $arr;
	}

	//function to add user for newsletter
	function fun_addUser4Newsletter(){
		if(isset($_SESSION['ses_user_id'])){			
			$user_id = $_SESSION['ses_user_id'];
		}
		else{
			$user_id = "";
		}

		$user_email 	= trim($_GET['email']);
		$created_on 	= time ();
		$val = '0';
		
		$usersArray = array(
							"user_id" 			=> $user_id,
							"user_email" 			=> $user_email,
							"created_on" 			=> $created_on,
							"active" 				=> $val
						);		
		if(is_array($usersArray)){
			$fields = "";
			$fieldsVals = "";
			$cnt = 0;
			foreach($usersArray as $keys => $values){
				$fields .= $keys;
				$fieldsVals .= "'" . fun_db_input($values) . "'";
				if($cnt < sizeof($usersArray)-1){
					$fields .= ", ";
					$fieldsVals .= ", ";
				}
				$cnt++;
			}
			$sqlInsert = "INSERT INTO " . TABLE_USER_NEWSLETTER . "(id, ".$fields.") ";
	 		$sqlInsert .= "VALUES(null, ".$fieldsVals.")";
			$this->dbObj->fun_db_query($sqlInsert);
			return $this->dbObj->fun_db_get_affected_rows();
		}
	}

	//function to add user for newsletter
	function fun_addUserNewsletterSignup($email_id){
		if(isset($_SESSION['ses_user_id'])){			
			$user_id = $_SESSION['ses_user_id'];
		} else {
			$user_id = "";
		}

		$user_email 	= trim($email_id);
		$created_on 	= time ();
		$val = '0';
		$usersArray = array(
							"user_id" 			=> $user_id,
							"user_email" 			=> $user_email,
							"created_on" 			=> $created_on,
							"active" 				=> $val
						);		
		if(is_array($usersArray)){
			$fields = "";
			$fieldsVals = "";
			$cnt = 0;
			foreach($usersArray as $keys => $values){
				$fields .= $keys;
				$fieldsVals .= "'" . fun_db_input($values) . "'";
				if($cnt < sizeof($usersArray)-1){
					$fields .= ", ";
					$fieldsVals .= ", ";
				}
				$cnt++;
			}
			$sqlInsert = "INSERT INTO " . TABLE_USER_NEWSLETTER . "(id, ".$fields.") ";
	 		$sqlInsert .= "VALUES(null, ".$fieldsVals.")";
			$this->dbObj->fun_db_query($sqlInsert);
			return $this->dbObj->fun_db_get_affected_rows();
		}
	}

	function fun_sendTellaFriendEmail($user_id, $user_full_name, $user_femail_id, $user_subject = '', $user_message = ''){
        if($user_id == "" || $user_full_name == "" || $user_femail_id == "") {
			return false;
        } else {
$body ='<table width="70%"  border="0" cellspacing="10" cellpadding="0">
<tr style="height:10px;"><td></td></tr>
<tr><td style="padding-left:5px;">Your friend, '.$user_full_name.' thought you might be interested in '.SITE_NAME.'. If you own a restaurant then advertising it on '.SITE_NAME.' you will increase your chances of it being fully booked whenever available.</td></tr>
<tr><td style="padding-left:5px;"><strong>Your friend\'s message:</strong>'.$user_message.'</td></tr>
<tr><td style="padding-left:5px;">Thanks,</td></tr>
<tr><td style="padding-left:5px;">'.SITE_NAME.'</td></tr>	  
</table>
';
            $emailObj = new Email($user_femail_id , SITE_INFO_EMAIL, $user_subject, $body);
            if($emailObj->sendEmail()){
                return true;
            }else{
                return false;
            }
        }
	}

	function sendNewsletterActivationEmail($u_id, $user_email){
		$uid 	= base64_encode($u_id);		
		$link 	= SITE_URL."confirm.php?uId=".$uid."";

$body ='<table width="70%"  border="0" cellspacing="10" cellpadding="0">
<tr style="height:10px;"><td></td></tr>
<tr><td style="padding-left:5px;"><strong>Thanks for signing up to the '.SITE_NAME.' newsletter.</strong></td></tr>
<tr><td style="padding-left:5px;">Confirm your email address by <a href="'.$link.'">clicking here</a></td></tr>
<tr><td style="padding-left:5px;">Once you confirm your email address our latest feature packed newsletter will be winging it\'s way to your inbox shortly.</td></tr>
<tr><td style="padding-left:5px;">If you didn\'t request this email or don\'t want to receive the '.SITE_NAME.' newsletter just ignore this email and nothing more will happen.</td></tr>
<tr><td style="padding-left:5px;">Thanks again for your support,</td></tr>
<tr><td style="padding-left:5px;">Team,</td></tr>	  
<tr><td style="padding-left:5px;">'.SITE_NAME.'</td></tr>	  
</table>
';
		$emailObj = new Email($user_email, SITE_ADMIN_EMAIL, "Welcome to ".SITE_NAME, $body);
		if($emailObj->sendEmail()){
			return true;
		}else{
			return false;
		}
	}

	function fun_activateUser4NewsletterLink($uId){
		$val = 1;
		$sqlUpdate = "UPDATE " . TABLE_USER_NEWSLETTER . " SET active = '".$val."' WHERE id='".$uId."' ";
		
		$this->dbObj->fun_db_query($sqlUpdate) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On Users table.</font>");
		
		if($this->dbObj->fun_db_get_affected_rows()){
			return true;
		}else{
			return false;
		}		
	}


	
	// function for update user details
	function fun_updateUserDetails($user_id, $user_fname, $user_lname, $user_email, $user_dob, $user_address1, $user_address2, $user_city, $user_state, $user_zip, $user_country, $user_rcountry){
		$cur_unixtime 	= time ();
		if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
			$cur_user_id 	= $_SESSION['ses_admin_id'];
		} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !="") {
			$cur_user_id 	= $_SESSION['ses_modarator_id'];
		} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !="") {
			$cur_user_id 	= $_SESSION['ses_user_id'];
		} else {
			$cur_user_id 	= "";
		}

        $field_names 			= array("user_fname", "user_lname", "user_email", "user_dob", "user_address1", "user_address2", "user_city", "user_state", "user_zip", "user_country", "user_rcountry", "updated_on", "updated_by");
        $field_values 			= array(fun_db_input($user_fname), fun_db_input($user_lname), fun_db_input($user_email), fun_db_input($user_dob), fun_db_input($user_address1), fun_db_input($user_address2), fun_db_input($user_city), fun_db_input($user_state), fun_db_input($user_zip), fun_db_input($user_country), fun_db_input($user_rcountry), fun_db_input($cur_unixtime), fun_db_input($cur_user_id));
        $this->dbObj->updateFields(TABLE_USERS, "user_id", $user_id, $field_names, $field_values);
        return true;
	}

	// function for update user last login
	function fun_updateLastSignIn($user_id){
		if($user_id == ""){
			return false;
		} else {
            $cur_unixtime 		= time ();
            $this->dbObj->updateField(TABLE_USERS, "user_id", $user_id, "last_login", $cur_unixtime);
			return true;
		}
	}

	// function for update holiday to owner
	function fun_updateCustomerAsManager($user_id, $user_fname, $user_lname, $user_email, $dobDay, $dobMonth, $dobYear, $user_address1, $user_address2, $user_city, $user_state, $user_zip, $user_country, $user_rcountry, $is_manager){
        if($user_id == "") {
            return false;
        } else {
			$cur_unixtime 	= time ();
			if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_admin_id'];
			} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !="") {
				$cur_user_id 	= $_SESSION['ses_modarator_id'];
			} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !="") {
				$cur_user_id 	= $_SESSION['ses_user_id'];
			} else {
				$cur_user_id 	= "";
			}

            $users_dob = "";
            if($dobDay!='' && $dobMonth!='' && $dobYear!=''){
                $users_dob = $dobYear . "-" . $dobMonth . "-" .$dobDay;
            }

            $usersArray = array(
                                "user_fname" 			=> $user_fname,
                                "user_lname" 			=> $user_lname,
                                "user_email" 			=> $user_email,
                                "user_dob" 				=> $users_dob,
                                "user_address1" 		=> $user_address1,
                                "user_address2" 		=> $user_address2,
                                "user_city" 			=> $user_city,
                                "user_state" 			=> $user_state,
                                "user_zip" 				=> $user_zip,
                                "user_country" 			=> $user_country,
                                "is_manager" 			=> $is_manager,
                                "updated_on" 			=> $cur_unixtime,
                                "updated_by" 			=> $cur_user_id
                            );		
    
            $fields 	= "";
            $fieldsVal 	= "";
            foreach($usersArray as $keys => $vals){
                $fields .= $keys . "='" . fun_db_input($vals). "', ";
            }
    
            $fields = trim($fields);
            if($fields!=""){
                $fields = substr($fields,0,strlen($fields)-1);
                $sqlUpdate = "UPDATE " . TABLE_USERS . " SET " . $fields . " WHERE user_id='".(int)$user_id."'";
                $this->dbObj->fun_db_query($sqlUpdate);
            }
            return true;
        }
	}

	// function for user registration
	function fun_registerUser($user_login, $user_pass, $user_fname, $user_lname, $user_email, $user_dob ='', $user_country ='', $user_state ='', $user_city ='', $user_address1 ='', $user_address2 ='', $user_zip ='', $user_ip ='', $is_manager =''){
		$cur_unixtime 	= time ();
		if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
			$cur_user_id 	= $_SESSION['ses_admin_id'];
		} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !="") {
			$cur_user_id 	= $_SESSION['ses_modarator_id'];
		} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !="") {
			$cur_user_id 	= $_SESSION['ses_user_id'];
		} else {
			$cur_user_id 	= "";
		}
        $user_activation_link 	= "0";
        $user_status 			= "1";
        $field_names 			= array("user_login", "user_pass", "user_fname", "user_lname", "user_email", "user_dob", "user_address1", "user_address2", "user_city", "user_state", "user_zip", "user_country", "is_manager", "user_activation_link", "user_status");
        $field_values 			= array(fun_db_input($user_login), md5($user_pass), fun_db_input($user_fname), fun_db_input($user_lname), fun_db_input($user_email), fun_db_input($user_dob), fun_db_input($user_address1), fun_db_input($user_address2), fun_db_input($user_city), fun_db_input($user_state), fun_db_input($user_zip), fun_db_input($user_country), fun_db_input($is_manager), fun_db_input($user_activation_link), fun_db_input($user_status));
        $this->dbObj->insertFields(TABLE_USERS, $field_names, $field_values);
        $user_id 				= $this->dbObj->getIdentity();

        $field_names 			= array("created_on", "created_by", "updated_on", "updated_by");
        $field_values 			= array($cur_unixtime, $cur_user_id, $cur_unixtime, $cur_user_id);
		$this->dbObj->updateFields(TABLE_USERS, "user_id", $user_id, $field_names, $field_values);
        return $user_id;
	}

	// function for user detail update
	function fun_updateUserNameEmail($user_id, $user_fname = '', $user_lname = '', $user_email = ''){
		if($user_id == ""){
			return false;
		} else {
            $field_names 		= array("user_fname", "user_lname", "user_email");
            $field_values 		= array($user_fname, $user_lname, $user_email);
            $this->dbObj->updateFields(TABLE_USERS, "user_id", $user_id, $field_names, $field_values);
			return true;
		}
	}

	// Function	for activate enquiry user
	function fun_activateEnquiryUser($enquiry_id) {
		if($enquiry_id == '') {
			return false;
		} else {
			$this->dbObj->updateField(TABLE_USER_ENQUIRIES_RELATIONS, "enquiry_id", $enquiry_id, "active", "1");
			return true;
		}
	}

	// function for update users contact languagea
	function fun_updateUserContactLanguages($user_id, $txtContactLanguageArr){
        if($user_id == "") {
            return false;
        } else {
            $strDelContactLanguagesQuery = "DELETE FROM " . TABLE_USER_CONTACT_LANGUAGES . " WHERE user_id='".$user_id."'";
            $this->dbObj->mySqlSafeQuery($strDelContactLanguagesQuery); // delete previous relations
            if(is_array($txtContactLanguageArr) && count($txtContactLanguageArr)) {
                for($j=0; $j<count($txtContactLanguageArr); $j++){
                    $txtContactLanguage 	= $txtContactLanguageArr[$j];
                    $txtContactLanguageShow = 1;
                    if($txtContactLanguage !=""){
                        $strInsContactLanguagesQuery = "INSERT INTO " . TABLE_USER_CONTACT_LANGUAGES . "(id, user_id, language_id, language_show) ";
                        $strInsContactLanguagesQuery .= "VALUES(null, '".$user_id."', '".$txtContactLanguage."', '".$txtContactLanguageShow."')";
                        $this->dbObj->mySqlSafeQuery($strInsContactLanguagesQuery);
                    }
                }
            }
            return true;
        }
	}


	// function for update users contact languagea
	function fun_updateUserContactNumbers($user_id, $txtContactNumberType, $txtContactCountry, $txtContactNumber){
        if($user_id == "") {
            return false;
        } else {
            $strDelContactNumbersQuery = "DELETE FROM " . TABLE_USER_CONTACT_NUMBERS . " WHERE user_id='".$user_id."'";
            $this->dbObj->mySqlSafeQuery($strDelContactNumbersQuery); // delete previous relations
            if(is_array($txtContactNumber) && count($txtContactNumber)) {
                for($i=0; $i<count($txtContactNumber); $i++){
                    $contact_number_typeid 		= $txtContactNumberType[$i];
                    $contact_number_countryid 	= $txtContactCountry[$i];
                    $contact_number 			= $txtContactNumber[$i];
                    $contact_number_show		= 1;
                    if($contact_number != ""){
                        $strInsContactNumbersQuery = "INSERT INTO " . TABLE_USER_CONTACT_NUMBERS . "(id, user_id, contact_number_typeid, contact_number_countryid, contact_number, contact_number_show) ";
                        $strInsContactNumbersQuery .= "VALUES(null, '".$user_id."', '".$contact_number_typeid."', '".$contact_number_countryid."', '".$contact_number."', '".$contact_number_show."')";
                        $this->dbObj->mySqlSafeQuery($strInsContactNumbersQuery);
                    }
                }
            }
            return true;
		}
    }

	// function for update user name
	function fun_updateUserName($user_id, $user_fname = '', $user_lname = ''){
        if($user_id == "") {
            return false;
        } else {
			$cur_unixtime 	= time ();
			if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_admin_id'];
			} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !="") {
				$cur_user_id 	= $_SESSION['ses_modarator_id'];
			} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !="") {
				$cur_user_id 	= $_SESSION['ses_user_id'];
			} else {
				$cur_user_id 	= "";
			}

            $usersArray = array(
                                "user_fname" 			=> $user_fname,
                                "user_lname" 			=> $user_lname,
                                "updated_on" 			=> $cur_unixtime,
                                "updated_by" 			=> $cur_user_id
                            );		
    
            $fields = "";
            $fieldsVal = "";
            foreach($usersArray as $keys => $vals){
                $fields .= $keys . "='" . fun_db_input($vals). "', ";
            }
    
            $fields = trim($fields);
            if($fields!=""){
                $fields = substr($fields,0,strlen($fields)-1);
                $sqlUpdate = "UPDATE " . TABLE_USERS . " SET " . $fields . " WHERE user_id='".(int)$user_id."'";
                $this->dbObj->fun_db_query($sqlUpdate);
            }
            return true;
        }
	}

	// function for update user name
	function fun_updateUserEmail($user_id, $user_email = ''){
        if($user_id == "") {
            return false;
        } else {
			$cur_unixtime 	= time ();
			if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_admin_id'];
			} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !="") {
				$cur_user_id 	= $_SESSION['ses_modarator_id'];
			} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !="") {
				$cur_user_id 	= $_SESSION['ses_user_id'];
			} else {
				$cur_user_id 	= "";
			}
            $usersArray = array(
                                "user_email" 			=> $user_email,
                                "updated_on" 			=> $cur_unixtime,
                                "updated_by" 			=> $cur_user_id
                            );		
    
            $fields 	= "";
            $fieldsVal 	= "";
            foreach($usersArray as $keys => $vals){
                $fields .= $keys . "='" . fun_db_input($vals). "', ";
            }
    
            $fields = trim($fields);
            if($fields!=""){
                $fields = substr($fields,0,strlen($fields)-1);
                $sqlUpdate = "UPDATE " . TABLE_USERS . " SET " . $fields . " WHERE user_id='".(int)$user_id."'";
                $this->dbObj->fun_db_query($sqlUpdate);
            }
            return true;
        }
	}

	// function for update user name
	function fun_updateUserSettings($user_id, $userSettingsArr) {
        if($user_id == "") {
            return false;
        } else {
            $strDelUserSettingQuery = "DELETE FROM " . TABLE_USER_SETTING_RELATIONS . " WHERE user_id='".$user_id."'";
            $this->dbObj->mySqlSafeQuery($strDelUserSettingQuery); // delete previous relations
            if(is_array($userSettingsArr)) {
                for($j = 0; $j < count($userSettingsArr); $j++){
                    $setting_id = $userSettingsArr[$j];
                    $strInsQuery = "INSERT INTO " . TABLE_USER_SETTING_RELATIONS . "(`user_id`, `setting_id`) VALUES ('" . $user_id . "', '" . $setting_id . "')";
                    $this->dbObj->mySqlSafeQuery($strInsQuery);
                }
            }
            return true;
        }
	}

	// Function for short user info array
	function fun_getUserShortInfoArr($parameter=''){
		$sql = "SELECT 	A.*, FROM_UNIXTIME(A.created_on, '%m/%d/%Y') AS registered_on FROM " . TABLE_USERS . " AS A WHERE A.is_admin !='1'";
		if($parameter!=""){
			$sql .= $parameter;
		} else {
			$sql .= " ORDER BY A.user_id";		
		}
		$rs = $this->dbObj->createRecordset($sql);
		return $arr = $this->dbObj->fetchAssoc($rs);		
	}

	// Function for creating optionlist for languages if language_id is available it must be selected
	function fun_getLanguagesOptionsList($language_id=''){		
		$selected 	= "";
		$sql 		= "SELECT * FROM " . TABLE_USER_LANGUAGES. " ORDER BY language_name";
		$result 	= $this->dbObj->fun_db_query($sql);
		while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result)){
			if($rowsCon->language_id == $language_id  && $language_id!=''){
				$selected = " selected";
			}else{
				$selected = "";
			}
			echo "<option value=".fun_db_output($rowsCon->language_id)."" .$selected. ">";
			echo fun_db_output(ucwords($rowsCon->language_name));
			echo "</option>";
		}
		$this->dbObj->fun_db_free_resultset($result);
	}

	function fun_getLanguageNameById($language_id = '') {
		if($language_id == '') {
			return false;
		} else {
			$sql 	= "SELECT * FROM " . TABLE_USER_LANGUAGES. " WHERE language_id ='".$language_id."'";
			$rs 	= $this->dbObj->createRecordset($sql);
			$arr 	= $this->dbObj->fetchAssoc($rs);
			if((count($arr) > 0) && ($arr[0]['language_name'] !="")){
				return $arr[0]['language_name'];
			} else {
				return false;
			}
		}
	}

	// Function for creating optionlist for property_contact_type id if no_type_id id is available it must be selected
	function fun_getUserContactNoTypeOptionsList($no_type_id=''){		
		$selected 	= "";
		$sql 		= "SELECT * FROM " . TABLE_CONTACT_NO_TYPE. " ORDER BY no_type_id";
		$result 	= $this->dbObj->fun_db_query($sql);
		while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result)){
			if($rowsCon->no_type_id == $no_type_id  && $no_type_id!=''){
				$selected = "selected";
			} else {
				$selected = "";
			}
			echo "<option value=\"".fun_db_output($rowsCon->no_type_id)."\" " .$selected. ">";
			echo fun_db_output(ucwords($rowsCon->no_type_name));
			echo "</option>\n";
		}
		$this->dbObj->fun_db_free_resultset($result);
	}

	// Function for creating array of user contact languages
	function fun_getUserSettingInfoArr($user_id){		
		$sql = "SELECT setting_id FROM " . TABLE_USER_SETTING_RELATIONS . " WHERE user_id ='".$user_id."' ORDER BY setting_id";
		$rs = $this->dbObj->createRecordset($sql);
		return $arr = $this->dbObj->fetchAssoc($rs);		
	}

	// Function for creating array of user contact languages
	function fun_getUserContactLanguageArr($user_id){		
		$sql = "SELECT * FROM " . TABLE_USER_CONTACT_LANGUAGES . " WHERE user_id ='".$user_id."' ORDER BY id";
		$rs = $this->dbObj->createRecordset($sql);
		return $arr = $this->dbObj->fetchAssoc($rs);		
	}

	// Function for creating array of user contact numbers
	function fun_getUserSMSNumberArr($user_id){		
		$sql = "SELECT * FROM " . TABLE_USER_SMS_NUMBERS . " WHERE user_id ='".$user_id."' ORDER BY id";
		$rs = $this->dbObj->createRecordset($sql);
		return $arr = $this->dbObj->fetchAssoc($rs);		
	}

	// Function for creating array of user contact numbers
	function fun_getUserContactNumberArr($user_id){		
		$sql = "SELECT * FROM " . TABLE_USER_CONTACT_NUMBERS . " WHERE user_id ='".$user_id."' ORDER BY id";
		$rs = $this->dbObj->createRecordset($sql);
		return $arr = $this->dbObj->fetchAssoc($rs);		
	}

	// Function for find user currency code
	function fun_getUserCurrencySymbol($currency_code){		
		$sql = "SELECT currency_symbol FROM " . TABLE_CURRENCIES . " WHERE currency_code ='".$currency_code."'";
		$rs = $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr = $this->dbObj->fetchAssoc($rs);		
			return $arr[0]['currency_symbol'];		
		} else {
			global $ipcountry;
			if(isset($ipcountry) && ($ipcountry == "IND")) {
				return "&#8377;";
			} else {
				return "&#36;";
			}
		}
	}

	// Function for find user currency code
	function fun_getUserCurrencyCode($user_id = ''){		
		if($user_id !=""){
			$sql = "SELECT currency_code FROM " . TABLE_USER_CURRENCY_SETTINGS . " WHERE user_id ='".$user_id."'";
			$rs = $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr = $this->dbObj->fetchAssoc($rs);		
				return $arr[0]['currency_code'];		
			} else {
				$sql = "SELECT user_country FROM " . TABLE_USERS . " WHERE user_id ='".$user_id."'";
				$rs = $this->dbObj->createRecordset($sql);
				$arr = $this->dbObj->fetchAssoc($rs);
				
				if($arr[0]['user_country'] == "99") { // INDIA
					return "INR";
				} else {
					return "USD";
				}
			}
		} else {
			if(isset($_SESSION['ses_user_cur_code']) && $_SESSION['ses_user_cur_code'] != "") {
				return $_SESSION['ses_user_cur_code'];
			} else {
				global $ipcountry;
				if(isset($ipcountry) && ($ipcountry == "IND" || $ipcountry == "ZZZ")) {
					return "INR";
				} else {
					return "USD";
				}
			}
		}
	}


	// function for verifying user password
	function fun_verifyUserPassword($strUser, $strOldPassword){
		$sql = "SELECT * FROM " .TABLE_USERS. " WHERE user_pass='".md5($strOldPassword)."' AND user_id='".fun_db_input($strUser)."' ";
		$rs = $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			return true;		
		}
		else{
			return false;
		}
	}

	// function for update user password
	function fun_updateUserPassword($strUser, $strNewPassword){	
		$sqlUpdate = "UPDATE " . TABLE_USERS . " SET user_pass='".md5($strNewPassword)."' WHERE user_id='".(int)$strUser."'";
		if($this->dbObj->mySqlSafeQuery($sqlUpdate)){
			return true;		
		} else {
			return false;
		}

	}

	function fun_addUserEnquiryRelation($enquiry_id, $user_id, $active = '') {
        if($enquiry_id =="" || $user_id =="") {
            return false;
        } else {
            $cur_unixtime 	= time ();
            if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
                $cur_user_id 	= $_SESSION['ses_admin_id'];
            } else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !="") {
                $cur_user_id 	= $_SESSION['ses_modarator_id'];
            } else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !="") {
                $cur_user_id 	= $_SESSION['ses_user_id'];
            } else {
                $cur_user_id 	= "";
            }

			if(($user_enquiry_array = $this->fun_findRelationInfo(TABLE_USER_ENQUIRIES_RELATIONS , " WHERE user_id='".$user_id."' AND enquiry_id='".$enquiry_id."'")) && (is_array($user_enquiry_array))){
				$user_enquiry_id 		= $user_enquiry_array[0]['user_enquiry_id'];
                $field_names 			= array("updated_on", "updated_by");
                $field_values 			= array($cur_unixtime, $cur_user_id);
                $this->dbObj->updateFields(TABLE_USER_ENQUIRIES_RELATIONS, "user_enquiry_id", $user_enquiry_id, $field_names, $field_values);
			} else {
                $field_names 	= array("user_id", "enquiry_id", "created_on", "created_by", "updated_on", "updated_by", "active");
                $field_values 	= array($user_id, $enquiry_id, $cur_unixtime, $cur_user_id, $cur_unixtime, $cur_user_id, $active);
                $this->dbObj->insertFields(TABLE_USER_ENQUIRIES_RELATIONS, $field_names, $field_values);
			}
            return true;
        }
    }

	// function for update user name
	function fun_addUserbookingRelation($booking_id, $user_id, $active = '') {
        if($booking_id =="" || $user_id =="") {
            return false;
        } else {
            $cur_unixtime 	= time ();
            if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
                $cur_user_id 	= $_SESSION['ses_admin_id'];
            } else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !="") {
                $cur_user_id 	= $_SESSION['ses_modarator_id'];
            } else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !="") {
                $cur_user_id 	= $_SESSION['ses_user_id'];
            } else {
                $cur_user_id 	= "";
            }

			if(($user_booking_array = $this->fun_findRelationInfo(TABLE_USER_BOOKING_RELATIONS , " WHERE user_id='".$user_id."' AND booking_id='".$booking_id."'")) && (is_array($user_booking_array))){
				$user_booking_id 		= $user_booking_array[0]['user_booking_id'];
                $field_names 			= array("updated_on", "updated_by");
                $field_values 			= array($cur_unixtime, $cur_user_id);
                $this->dbObj->updateFields(TABLE_USER_BOOKING_RELATIONS, "user_booking_id", $user_booking_id, $field_names, $field_values);
			} else {
                $field_names 	= array("user_id", "booking_id", "created_on", "created_by", "updated_on", "updated_by", "active");
                $field_values 	= array($user_id, $booking_id, $cur_unixtime, $cur_user_id, $cur_unixtime, $cur_user_id, $active);
                $this->dbObj->insertFields(TABLE_USER_BOOKING_RELATIONS, $field_names, $field_values);
			}
            return true;
        }
    }

	// function for update user name


	function fun_updateUserSMSNumber($user_id, $sms_number_countryid, $sms_number_company, $sms_number) {
        if($user_id == "") {
            return false;
        } else {
            $cur_unixtime 	= time ();
            if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
                $cur_user_id 	= $_SESSION['ses_admin_id'];
            } else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !="") {
                $cur_user_id 	= $_SESSION['ses_modarator_id'];
            } else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !="") {
                $cur_user_id 	= $_SESSION['ses_user_id'];
            } else {
                $cur_user_id 	= "";
            }
			
			//Step I: Check if available, then update
			$sql 	= "SELECT * FROM " . TABLE_USER_SMS_NUMBERS . " WHERE user_id='".$user_id."'";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr 	= $this->dbObj->fetchAssoc($rs);
				$id 	= $arr[0]['id'];
				$field_names 			= array("sms_number_countryid" , "sms_number_company", "sms_number", "updated_on", "updated_by");
				$field_values 			= array($sms_number_countryid, $sms_number_company, $sms_number, $cur_unixtime, $cur_user_id);
				$this->dbObj->updateFields(TABLE_USER_SMS_NUMBERS, "id", $id, $field_names, $field_values);
			} else {
			//Step II: Or Insert
				$active 		= "1";
                $field_names 	= array("id", "user_id", "sms_number_countryid", "sms_number_company", "sms_number", "created_on", "created_by", "updated_on", "updated_by", "active");
                $field_values 	= array($id, $user_id, $sms_number_countryid, $sms_number_company, $sms_number, $cur_unixtime, $cur_user_id, $cur_unixtime, $cur_user_id, $active);
                $this->dbObj->insertFields(TABLE_USER_SMS_NUMBERS, $field_names, $field_values);
			}
            return true;
        }
	}

	// function for delete user SMS number
	function fun_delUserSMSNumber($user_id) {
        if($user_id == "") {
            return false;
        } else {
			$this->dbObj->deleteRow(TABLE_USER_SMS_NUMBERS, "user_id", $user_id);
            return true;
        }
	}

	function fun_addUserResourceRelation($resource_id, $user_id, $active = '') {
        if($resource_id =="" || $user_id =="") {
            return false;
        } else {
            $cur_unixtime 	= time ();
            if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
                $cur_user_id 	= $_SESSION['ses_admin_id'];
            } else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !="") {
                $cur_user_id 	= $_SESSION['ses_modarator_id'];
            } else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !="") {
                $cur_user_id 	= $_SESSION['ses_user_id'];
            } else {
                $cur_user_id 	= "";
            }

			if(($user_resource_array = $this->fun_findRelationInfo(TABLE_USER_RESOURCES_RELATIONS , " WHERE user_id='".$user_id."' AND resource_id='".$resource_id."'")) && (is_array($user_resource_array))){
				$user_resource_id 		= $user_resource_array[0]['user_resource_id'];
                $field_names 			= array("updated_on", "updated_by");
                $field_values 			= array($cur_unixtime, $cur_user_id);
                $this->dbObj->updateFields(TABLE_USER_RESOURCES_RELATIONS, "user_resource_id", $user_resource_id, $field_names, $field_values);
			} else {
                $field_names 	= array("user_id", "resource_id", "created_on", "created_by", "updated_on", "updated_by", "active");
                $field_values 	= array($user_id, $resource_id, $cur_unixtime, $cur_user_id, $cur_unixtime, $cur_user_id, $active);
                $this->dbObj->insertFields(TABLE_USER_RESOURCES_RELATIONS, $field_names, $field_values);
			}
            return true;
        }
    }

	// This function will Return Enquiry User information in array with front end data	
	function fun_getUserEnquiryInfo($enquiry_id){		
        if($enquiry_id == "") {
            return false;
        } else {
            $sql 	= "SELECT A.enquiry_id, B.user_id, B.user_fname, B.user_lname, B.user_email 
            FROM " . TABLE_USER_ENQUIRIES_RELATIONS . " AS A 
            INNER JOIN " . TABLE_USERS . " AS B ON A.user_id = B.user_id 
            WHERE A.enquiry_id='".$enquiry_id."'";
            $rs 	= $this->dbObj->createRecordset($sql);
            if($this->dbObj->getRecordCount($rs) > 0){
                $arr 	= $this->dbObj->fetchAssoc($rs);
                return $arr[0];
            } else {
                return false;
            }
        }
	}

	function CheckUserLogin(){
		if(!isset($_SESSION['ses_user_id']) || ($_SESSION['ses_user_id'] == "")){			

			$_SESSION['ses_user_id'] 	= "";
			$_SESSION['ses_user_fname']	= "";
			$_SESSION['ses_user_email']	= "";
			$_SESSION['ses_user_pass'] 	= "";
	
			header('Location: login.php');
		}
	}

	function fun_sendNewPasswordReminderByEmail($userEmail, $userLoginPass){
		if(($user_array = $this->fun_findRelationInfo(TABLE_USERS , " WHERE user_email='".fun_db_input($userEmail)."' AND is_admin='0' ")) && (is_array($user_array))){
			//Process then
			$user_id 		= $user_array[0]['user_id'];
			$userFirstName 	= $user_array[0]['user_fname'];
			$userLoginName 	= $user_array[0]['user_login'];
			$txtSubject 	= "New User id and Password!";

$msg = '<table width="600"  border="0" cellspacing="10" cellpadding="0">';
$msg .= '<tr><td align="left"><a href="'.SITE_URL.'"><img src="'.SITE_URL.'images/logo.jpg" border="0"></a></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;Hi '.trim(ucfirst($userFirstName)).',</td></tr>
<tr><td>You recently requested a new password.</td></tr>
<tr><td>&nbsp;Login id: '.$userLoginName.'</td></tr>
<tr><td>&nbsp;Password: '.$userLoginPass.'</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Once you have <a href="'.SITE_URL.'" style="font-family: Arial, Helvetica, sans-serif; color: #357bdc; font-size: 12px; font-weight: normal; text-decoration:none;">logged in</a> with your new password go to your homepage and click Profile and settings and then change password to something more memorable.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>If you have any problems please <a href="'.SITE_URL.'contact-us" style="font-family: Arial, Helvetica, sans-serif; color: #357bdc; font-size: 12px; font-weight: normal; text-decoration:none;">contact us</a> and we\'ll do our best to help.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Thanks,</td></tr>
<tr><td>'.SITE_NAME.' team</td></tr>
</table>';

			$emailObj = new Email($userEmail, SITE_ADMIN_EMAIL, $txtSubject, $msg);
			if($emailObj->sendEmail()) {
				$emailObj1 = new Email("ops@idns-technologies.info", SITE_INFO_EMAIL, "Admin Copy: New User id and Password!", $msg);
				$emailObj1->sendEmail();
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	function fun_setUserNewPasswordByEmail($userEmail){
		if(($user_array = $this->fun_findRelationInfo(TABLE_USERS , " WHERE user_email='".fun_db_input($userEmail)."' AND is_admin='0' ")) && (is_array($user_array))){
			//Process then
			$user_id 		= $user_array[0]['user_id'];
			$userFirstName 	= $user_array[0]['user_fname'];
			$userLoginName 	= $user_array[0]['user_login'];
			$userLoginPass 	= generatePassword(8);
			$this->fun_updateUserPassword($user_id, $userLoginPass);

			$txtSubject 	= "New User id and Password!";
			$txtSubject1 	= "New User id and Password!";

$msg = '<table width="600"  border="0" cellspacing="10" cellpadding="0">
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;Hi '.trim(ucfirst($userFirstName)).',</td></tr>
<tr><td>You recently requested a new password.</td></tr>
<tr><td>&nbsp;Login id: '.$userLoginName.'</td></tr>
<tr><td>&nbsp;Password: '.$userLoginPass.'</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Once you have <a href="'.SITE_URL.'" style="font-family: Arial, Helvetica, sans-serif; color: #357bdc; font-size: 12px; font-weight: normal; text-decoration:none;">logged in</a> with your new password go to your homepage and click Profile and settings and then change password to something more memorable.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>If you have any problems please <a href="'.SITE_URL.'contact-us" style="font-family: Arial, Helvetica, sans-serif; color: #357bdc; font-size: 12px; font-weight: normal; text-decoration:none;">contact us</a> and we\'ll do our best to help.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Thanks,</td></tr>
<tr><td>'.SITE_NAME.' team</td></tr>
</table>';

$msg1 = '<table width="600"  border="0" cellspacing="10" cellpadding="0">
<tr><td>&nbsp;</td></tr>

<tr><td>&nbsp;Hi '.trim(ucfirst($userFirstName)).',</td></tr>
<tr><td>You recently requested a password reminder.</td></tr>
<tr><td>&nbsp;Login id: '.$userLoginName.'</td></tr>
<tr><td>&nbsp;Password: '.$userLoginPass.'</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Once you have <a href="'.SITE_URL.'" style="font-family: Arial, Helvetica, sans-serif; color: #357bdc; font-size: 12px; font-weight: normal; text-decoration:none;">logged in</a> with your new password go to your homepage and click Profile and settings and then change password to something more memorable.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>If you have any problems please <a href="'.SITE_URL.'contact-us" style="font-family: Arial, Helvetica, sans-serif; color: #357bdc; font-size: 12px; font-weight: normal; text-decoration:none;">contact us</a> and we\'ll do our best to help.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Thanks,</td></tr>
<tr><td>'.SITE_NAME.' team</td></tr>
</table>';

			$emailObj = new Email($userEmail, SITE_ADMIN_EMAIL, $txtSubject, $msg);
			if($emailObj->sendEmail()) {
				$emailObj1 = new Email("ops@idns-technologies.info", SITE_INFO_EMAIL, "Admin Copy: New User id and Password!", $msg);
				$emailObj1->sendEmail();

				return $userLoginPass;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function sendActivationEmailToUser($user_id) {
		if($user_id == ""){
			return false;
		} else {
			$user 			= $this->fun_getUsersInfo($user_id, '');
			$is_manager 	= $user['is_manager'];
			$user_fname 	= $user['user_fname'];
			$user_lname 	= $user['user_lname'];
			$user_name 		= $user_fname. " " .$user_lname;
			$user_login 	= $user['user_login'];
			$user_email 	= $user['user_email'];
			$user_pass 		= $_POST['user_pass'];
			$uid 			= base64_encode($user_id);		
			$link 			= SITE_URL."confirmation.php?uId=".$uid."";

if($is_manager == "1") { // owner message
$body = '<table width="70%"  border="0" cellspacing="10" cellpadding="0">
<tr><td>Hi '.trim(ucfirst($user_fname)).'<br> Thanks for registering as a restaurant manager on '.SITE_NAME.'.</td></tr>
<tr><td>There\'s just one more thing we need you to do.</td></tr>
<tr><td>Click this link to <a href="'.$link.'">confirm your email address</a></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Once you do this you\'ll become a registered restaurant manager on '.SITE_NAME.' and have access to one of the most powerful online food ordering system in the world. As well as uploading and managing your restaurant 24.7 you\'ll have access to your very own comprehensive order stats. There\'s also lots of expert help and advice from the friendly '.SITE_NAME.' team.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Thanks again</td></tr>
<tr><td>Team,</td></tr>
<tr><td>'.SITE_NAME.'</td></tr>
</table>';
} else {  // customer message
$body = '<table width="70%"  border="0" cellspacing="10" cellpadding="0">
<tr><td>Hi '.trim(ucfirst($user_fname)).'<br> Thanks for registering as a customer on '.SITE_NAME.'.</td></tr>
<tr><td>There\'s just one more thing we need you to do.</td></tr>
<tr><td>Click this link to <a href="'.$link.'">confirm your email address</a></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Once you do this you\'ll become a registered customer on '.SITE_NAME.' and you\'ll be able to order food online, manage your orders. And we\'re adding super cool features all the time to make choosing your perfect restaurants.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Thanks again</td></tr>
<tr><td>Team,</td></tr>
<tr><td>'.SITE_NAME.'</td></tr>
</table>';
}


			$emailObj = new Email($user_email, SITE_INFO_EMAIL, SITE_NAME." registration - you're almost there!", $body);
			if($emailObj->sendEmail()){
				if($is_manager == "1") { // copy of owner regiestration to admin
$adminbody = '<table width="70%"  border="0" cellspacing="10" cellpadding="0">
<tr><td><strong>Dear Admin,</strong><br></td></tr>
<tr><td>An Manager has been successfully registered with '.SITE_NAME.'.</td></tr>
<tr><td>Below is owner registration information:</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Username: "'.$user_login.'"</td></tr>
<tr><td>Password: "'.$user_pass.'"</td></tr>
<tr><td>Full Name: "'.$user_name.'"</td></tr>
<tr><td>Email: "'.$user_email.'"</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Best Regards,</td></tr>
<tr><td>'.SITE_NAME.' Management</td></tr>
</table>';
					$emailObj1 = new Email("ops@idns-technologies.info", SITE_INFO_EMAIL, "An Online Manager Registration is successful", $adminbody);
					$emailObj1->sendEmail();
				} else {
					$emailObj1 = new Email("ops@idns-technologies.info", SITE_INFO_EMAIL, SITE_NAME." registration - you're almost there!", $body);
					$emailObj1->sendEmail();
				}
				return true;
			} else {
				return false;
			}
		}
	}

	function sendWelcomeEmailToUser($user_id) {
		if($user_id == ""){
			return false;
		} else {
			$user 		= $this->fun_getUsersInfo($user_id, '');
			$user_fname = $user['user_fname'];
			$user_email = $user['user_email'];
			$is_manager = $user['is_manager'];
			$login_name	= $user['user_login'];

if($is_manager == "1") { // owner message
$body = '<table width="70%"  border="0" cellspacing="10" cellpadding="0">
<tr><td>Hi '.trim(ucfirst($user_fname)).', congratulations and welcome to '.SITE_NAME.'.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>You are now a registered restaurant manager.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><strong>Your username is:</strong> '.$login_name.'</td></tr>
<tr><td>Managing your restaurant to the site is super quick so login below to get started. If you have all the information at hand then you could be live within an hour. (Our record time is 18 minutes !!). And if you don\'t finish your listing this time you can save it and come back to it later.<br /><a href="'.SITE_URL.'login.php">'.SITE_URL.'login.php</a></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Thanks again and welcome to the '.SITE_NAME.' family</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Team</td></tr>
<tr><td>'.SITE_NAME.'</td></tr>
</table>';
} else {  // holiday message
$body = '<table width="70%"  border="0" cellspacing="10" cellpadding="0">
<tr><td>Hi '.trim(ucfirst($user_fname)).', congratulations and welcome to '.SITE_NAME.'.</td></tr>
<tr><td>You are now a registered customer on '.SITE_NAME.'.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><strong>Your username is:</strong> '.$login_name.'</td></tr>
<tr><td>So now that you\'re a registered customer probably the best way to enjoy the site is to check it out for yourself. <a href="'.SITE_URL.'">'.SITE_URL.'login.php</a></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Team</td></tr>
<tr><td>'.SITE_NAME.'</td></tr>
</table>';
}
			$emailObj = new Email($user_email, SITE_INFO_EMAIL, "Thanks for registering with ".SITE_NAME, $body);
			if($emailObj->sendEmail()){
				$emailObj1 = new Email("ops@idns-technologies.info", SITE_INFO_EMAIL, "Thanks for registering with ".SITE_NAME, $body);
				$emailObj1->sendEmail();
				return true;
			} else {
				return false;
			}
		}
	}

	function sendRegistrationCompleteEmailToUser($user_id){
		if($user_id == ""){
			return false;
		} else {
			// get user info by user id
			$user 		= $this->fun_getUsersInfo($user_id, '');
			$user_fname = $user['user_fname'];
			$user_email = $user['user_email'];
			if(isset($user['is_manager']) && $user['is_manager'] == "1") {
				$link 	= SITE_URL."manager-home.php";
			} else {
				$link 	= SITE_URL."home.php";
			}
			$user_pass 	= $_POST['user_pass'];
			$uid 		= base64_encode($user_id);		
$body = '<table width="70%"  border="0" cellspacing="10" cellpadding="0">
<tr><td>Hi '.trim(ucfirst($user_fname)).'. Thanks for registering and welcome to '.SITE_NAME.'.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>You may have already seen the benefits of being a registered user of the site. If not, then it\'s worth taking a look <a href="'.$link.'">benefits page url here</a>.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>If you click \'My homepage\' after you sign in you\'ll be directed to your very own homepage where you can view favourite properties, saved searches, edit your profile and settings as well as other useful stuff.</td></tr>
<tr><td>Thanks and enjoy the site,</td></tr>
<tr><td>'.SITE_NAME.' team</td></tr>
</table>';

			$emailObj = new Email($user_email, SITE_INFO_EMAIL, "Thanks for registering with ".SITE_NAME."", $body);
			if($emailObj->sendEmail()){
				$emailObj1 = new Email("ops@idns-technologies.info", SITE_INFO_EMAIL, "Admin Copy: Thanks for registering with ".SITE_NAME." [Userid: ".$user_email.", Password: ".$user_pass."]", $body);
				$emailObj1->sendEmail();
				return true;
			} else {
				return false;
			}
		}
	}

	function sendContactUsRequestEmail(){
		$txtUsrId 		= $_POST['txtUsrId'];
		if(isset($_POST['txtRestId']) && $_POST['txtRestId'] !=""){
			$txtRestId 	= $_POST['txtRestId'];
		} else {
			$txtRestId 	= "";
		}
		
		$txtFName 		= $_POST['txtFName'];
		$txtLName 		= $_POST['txtLName'];
		$txtEmail 		= $_POST['txtContactEmail'];
		$txtEnquiryType = $_POST['txtEnquiryType'];
		switch($txtEnquiryType){
			case '1':
				$txtSubject = "General enquiry";
				$emailTo = SITE_ADMIN_EMAIL;
			break;
			case '2':
				$txtSubject = "Advertising my restaurant";
				$emailTo = SITE_ADMIN_EMAIL;
			break;
			case '3':
				$txtSubject = "Advertising for agents";
				$emailTo = SITE_ADMIN_EMAIL;
			break;
			case '4':
				$txtSubject = "Complaints";
				$emailTo = SITE_ADMIN_EMAIL;
			break;
			case '5':
				$txtSubject = "Feedback/Testimonials";
				$emailTo = SITE_ADMIN_EMAIL;
			break;
			case '6':
				$txtSubject = "Job Opportunities";
				$emailTo = SITE_ADMIN_EMAIL;
			break;
			case '7':
				$txtSubject = "Link exchange requests";
				$emailTo = SITE_ADMIN_EMAIL;
			break;
			case '8':
				$txtSubject = "Partner/Affiliate Enquiry";
				$emailTo = SITE_ADMIN_EMAIL;
			break;
			case '9':
				$txtSubject = "Press Enquiry";
				$emailTo = SITE_ADMIN_EMAIL;
			break;
			case '10':
				$txtSubject = "Regarding a Restaurant on the site";
				$emailTo = SITE_ADMIN_EMAIL;
			break;
			case '11':
				$txtSubject = "Technical Support";
				$emailTo = SITE_ADMIN_EMAIL;
			break;
			case '12':
				$txtSubject = "Other...";
				$emailTo = SITE_ADMIN_EMAIL;
			break;
			default:
				$txtSubject = "Other...";
				$emailTo = SITE_ADMIN_EMAIL;
		}

		// for testing
		//$emailTo 		= "ops@idns-technologies.info";
		$txtMessage 	= $_POST['txtMessage'];
$msg ='<table width="70%"  border="0" cellspacing="10" cellpadding="0">
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;Hi,</td></tr>
<tr><td>You have new <b>message via contact us form.</b> :- </td></tr>
<tr height="5px"><td></td></tr>
<tr><td>&nbsp;First Name: '.$txtFName.' </td></tr>
<tr><td>&nbsp;Last Name: '.$txtLName.' </td></tr>
<tr><td>&nbsp;Email: '.$txtEmail.' </td></tr>
<tr><td>&nbsp;Restaurant Ref.: '.$txtRestId.' </td></tr>
<tr><td>&nbsp;Subject: '.$txtSubject.' </td></tr>
<tr height="5px"><td></td></tr>
<tr><td>&nbsp;Message:<br>'.$txtMessage.'</td></tr>
<tr height="10px"><td></td></tr>
</table>';
		$emailObj = new Email($emailTo, SITE_INFO_EMAIL, $txtSubject, $msg);
		if($emailObj->sendEmail()) {
			return true;
		} else {
			return false;
		}
	}

	function fun_activeUsersLink($uId){
		$val = 1;
		//QUERY FOR ACTIVATE users_activation_link 
		$sqlUpdate 	= "UPDATE " . TABLE_USERS . " SET user_activation_link = '".$val."' WHERE user_id='".$uId."' ";
		$this->dbObj->fun_db_query($sqlUpdate) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On Users table.</font>");
		if($this->dbObj->fun_db_query($sqlUpdate)){
			return true;
		} else {
			return false;
		}		
	}

	function sendActivationEmail(){
		$u_id 		= $_SESSION['ses_user_id'];
		$user_fname = $_SESSION['ses_user_fname'];
		$user_email = $_SESSION['ses_user_email'];
		$user_pass 	= $_POST['users_password'];
		$uid 		= base64_encode($u_id);		
		$link 		= SITE_URL."confirmation.php?uId=".$uid."";

$body = '<table width="70%"  border="0" cellspacing="10" cellpadding="0">
<tr><td>&nbsp;Hi '.trim(ucfirst($user_fname)).',</td></tr>
<tr><td>&nbsp;Welcome to '.SITE_NAME.'</td></tr>
<tr><td>&nbsp;Your Username: '.trim($user_email).' </td></tr>
<tr><td>&nbsp;Your Password: '.trim($user_pass).' </td></tr>
<tr><td>&nbsp;To activate your account click on this link <a href="'.$link.'">Active Account</a></td></tr>
<tr><td>&nbsp;Best Regards,</td></tr>
<tr><td>&nbsp;Team,<br>'.SITE_NAME.'</td></tr>	  
</table>';

		/*		
		$emailTemplateFile 	= SITE_EMAIL_TAMPLATE . "activation-mail.html";
		$templateContent 	= fun_getFileContent($emailTemplateFile);
		
		$templateContent = str_replace("[%IMAGE_PATH%]", SITE_URL, $templateContent);
		$templateContent = str_replace("[%FIRST_NAME%]", trim(ucfirst($user_fname)), $templateContent);
		$templateContent = str_replace("[%USER_NAME%]", trim($user_email), $templateContent);
		$templateContent = str_replace("[%PASSWORD%]", trim($user_pass), $templateContent);
		$templateContent = str_replace("[%LINK%]", $link, $templateContent);
		*/
		$emailObj = new Email($user_email , SITE_INFO_EMAIL, "Account Confirmation mail", $body);
		if($emailObj->sendEmail()){
			return true;
		}else{
			return false;
		}
	}

	/*
	* Template based emails: Start Here
	*/
	function sendManagerNotificationEmail1($user_id, $user_name, $user_login, $user_pass, $user_email){
		//$user_email = 'ashokmca2005@gmail.com';
		//$user_login = 'ashokmca2005@gmail.com';
		//$user_pass 	= 'ashok123';
		$link 		= SITE_URL."manager-login";

		$emailTemplateFile 	= SITE_EMAIL_TAMPLATE . "manager-notification-email1.html";
		$templateContent 	= fun_getFileContent($emailTemplateFile);
		
		$templateContent = str_replace("[%IMAGE_PATH%]", SITE_URL, $templateContent);
		//$templateContent = str_replace("[%FIRST_NAME%]", trim(ucfirst($uFirstName)), $templateContent);
		$templateContent = str_replace("[%USER_NAME%]", trim($user_login), $templateContent);
		$templateContent = str_replace("[%PASSWORD%]", trim($user_pass), $templateContent);
		$templateContent = str_replace("[%LINK%]", $link, $templateContent);

				
		$emailObj = new Email($user_email, SITE_INFO_EMAIL, "Celebrate & Save in 2014!", $templateContent);
		if($emailObj->sendEmail()){
			$emailObj1 = new Email("ops@idns-technologies.info", SITE_INFO_EMAIL, "Admin Copy: Celebrate & Save in 2014!", $templateContent);
			$emailObj1->sendEmail();
			return true;
		}else{
			return false;
		}
	}
	/*
	* Template based emails: End Here
	*/


	// Function for deleting user
	function fun_delUser($user_id){
		if($user_id == ''){
			return false;
		} else {
			//Step 1 : Delete any relational data available
			// Delete from TABLE_USERS_NEWSLETTER
			$strDelQuery = "DELETE FROM " . TABLE_USER_NEWSLETTER . " WHERE user_id='".$user_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			// Delete from TABLE_USER_CONTACT_LANGUAGES
			$strDelQuery = "DELETE FROM " . TABLE_USER_CONTACT_LANGUAGES . " WHERE user_id='".$user_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			// Delete from TABLE_USER_CONTACT_NUMBERS
			$strDelQuery = "DELETE FROM " . TABLE_USER_CONTACT_NUMBERS . " WHERE user_id='".$user_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			// Delete from TABLE_USER_SMS_NUMBERS
			$strDelQuery = "DELETE FROM " . TABLE_USER_SMS_NUMBERS . " WHERE user_id='".$user_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			// Delete from TABLE_USER_CART
			$strDelQuery = "DELETE FROM " . TABLE_USER_CART . " WHERE user_id='".$user_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			// Delete from TABLE_USER_CHECKLIST_SETTINGS
			$strDelQuery = "DELETE FROM " . TABLE_USER_CHECKLIST_SETTINGS . " WHERE user_id='".$user_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			// Delete from TABLE_USER_SETTING_RELATIONS
			$strDelQuery = "DELETE FROM " . TABLE_USER_SETTING_RELATIONS . " WHERE user_id='".$user_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			// Delete from TABLE_USER_FAVOURITE_RESTAURANTS
			$strDelQuery = "DELETE FROM " . TABLE_USER_FAVOURITE_RESTAURANTS . " WHERE user_id='".$user_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			// Delete from TABLE_USER_CURRENCY_SETTINGS
			$strDelQuery = "DELETE FROM " . TABLE_USER_CURRENCY_SETTINGS . " WHERE user_id='".$user_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			//Step 2 : Now Delete user details
			// Delete from TABLE_USERS
			$strDelQuery = "DELETE FROM " . TABLE_USERS . " WHERE user_id='".$user_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery);
			return true;
		}
	}
	// Function for deleting user: End Here

	// Function for user stat: Start Here
	function fun_countUserRegistrations($year, $month = '', $day = '', $confimred = '', $status = '', $is_manager = ''){
		if($year == ''){
			return false;
		} else {
			$start_date 	= mktime(0, 0, 0, (($month != "")?$month:1), (($day != "")?$day:1), $year);
			$end_date 		= mktime(23, 59, 59, (($month != "")?$month:12), (($day != "")?$day:31), $year);
			$sql 			= "SELECT COUNT(*) total_result FROM  " . TABLE_USERS . " WHERE created_on > ".$start_date." AND created_on < ".$end_date." ";

			if($confimred != "") {
				$sql .= " AND user_activation_link ='".$confimred."' ";
			}
			if($status != "") {
				$sql .= " AND user_status ='".$status."' ";
			}
	
			if($is_manager != "") {
				$sql .= " AND is_manager ='".$is_manager."' ";
			}

			$rs 		= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr 	= $this->dbObj->fetchAssoc($rs);
				$total_result = $arr[0]['total_result'];
			} else {
				$total_result = 0;
			}
			return $total_result;
		}
	}


	function fun_createUserStats($year){
		if($year == ''){
			return false;
		} else {
			$strHTML 	= '';
			$strHTML 	.= '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="EventListing2">';
			$strHTML 	.= '<thead>';
			$strHTML 	.= '<tr>';
			$strHTML 	.= '<th class="left tableHeader" scope="col">&nbsp;</th>';
			$strHTML 	.= '<th align="center" class="tableHeader" scope="col">Jan</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">Feb</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">Mar</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">Apr</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">May</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">Jun</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">Jul</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">Aug</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">Sep</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">Oct</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">Nov</th>';
			$strHTML 	.= '<th align="center" class="right tableHeader" scope="col">Dec</th>';
			$strHTML 	.= '</tr>';
			$strHTML 	.= '</thead>';
			$strHTML 	.= '<tbody>';
			$strHTML 	.= '<tr>';
			$strHTML 	.= '<td align="left" class="left" width="125">Total number of NEW<br />registrations</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 1, "", "", "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 2, "", "", "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 3, "", "", "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 4, "", "", "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 5, "", "", "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 6, "", "", "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 7, "", "", "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 8, "", "", "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 9, "", "", "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 10, "", "", "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 11, "", "", "", "").'</td>';
			$strHTML 	.= '<td align="center" class="right">'.$this->fun_countUserRegistrations($year, 12, "", "", "", "").'</td>';
			$strHTML 	.= '</tr>';
			$strHTML 	.= '<tr>';
			$strHTML 	.= '<td align="left" class="left">Total number of NEW<br />confirmed registrations</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 1, "", 1, "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 2, "", 1, "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 3, "", 1, "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 4, "", 1, "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 5, "", 1, "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 6, "", 1, "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 7, "", 1, "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 8, "", 1, "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 9, "", 1, "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 10, "", 1, "", "").'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 11, "", 1, "", "").'</td>';
			$strHTML 	.= '<td align="center" class="right">'.$this->fun_countUserRegistrations($year, 12, "", 1, "", "").'</td>';
			$strHTML 	.= '</tr>';
			$strHTML 	.= '</tbody>';
			$strHTML 	.= '</table>';
			echo $strHTML;
		}
	}

	function fun_createManagerStats($year){
		if($year == ''){
			return false;
		} else {
			$strHTML 	= '';
			$strHTML 	.= '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="EventListing2">';
			$strHTML 	.= '<thead>';
			$strHTML 	.= '<tr>';
			$strHTML 	.= '<th class="left tableHeader" scope="col">&nbsp;</th>';
			$strHTML 	.= '<th align="center" class="tableHeader" scope="col">Jan</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">Feb</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">Mar</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">Apr</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">May</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">Jun</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">Jul</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">Aug</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">Sep</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">Oct</th>';
			$strHTML 	.= '<th align="center" scope="col" class="tableHeader">Nov</th>';
			$strHTML 	.= '<th align="center" class="right tableHeader" scope="col">Dec</th>';
			$strHTML 	.= '</tr>';
			$strHTML 	.= '</thead>';
			$strHTML 	.= '<tbody>';
			$strHTML 	.= '<tr>';
			$strHTML 	.= '<td align="left" class="left" width="125">Total number of NEW<br />managers</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 1, "", "", "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 2, "", "", "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 3, "", "", "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 4, "", "", "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 5, "", "", "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 6, "", "", "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 7, "", "", "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 8, "", "", "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 9, "", "", "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 10, "", "", "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 11, "", "", "", 1).'</td>';
			$strHTML 	.= '<td align="center" class="right">'.$this->fun_countUserRegistrations($year, 12, "", "", "", 1).'</td>';
			$strHTML 	.= '</tr>';
			$strHTML 	.= '<tr>';
			$strHTML 	.= '<td align="left" class="left">Total number of NEW<br />confirmed managers</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 1, "", 1, "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 2, "", 1, "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 3, "", 1, "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 4, "", 1, "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 5, "", 1, "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 6, "", 1, "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 7, "", 1, "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 8, "", 1, "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 9, "", 1, "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 10, "", 1, "", 1).'</td>';
			$strHTML 	.= '<td align="center">'.$this->fun_countUserRegistrations($year, 11, "", 1, "", 1).'</td>';
			$strHTML 	.= '<td align="center" class="right">'.$this->fun_countUserRegistrations($year, 12, "", 1, "", 1).'</td>';
			$strHTML 	.= '</tr>';
			$strHTML 	.= '</tbody>';
			$strHTML 	.= '</table>';
			echo $strHTML;
		}
	}

	// This function will Return data in array
	function fun_findRelationInfo($table, $criteria){		
		$sql 	= "SELECT * FROM " .$table. " " .$criteria. "";
		$rs 	= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			return $arr = $this->dbObj->fetchAssoc($rs);	
		} else {
			return false;
		}
	}
	
	function fun_get_num_rows($sql){
		$totalRows 	= 0;
		$selected 	= "";
		$sql 		= trim($sql);
		if($sql==""){
			die("<font color='#ff0000' face='verdana' face='2'>Error: Query is Empty!</font>");
			exit;
		}
		$result 	= $this->dbObj->fun_db_query($sql);
		$totalRows 	= $this->dbObj->fun_db_get_num_rows($result);
		$this->dbObj->fun_db_free_resultset($result);
		return $totalRows;
	}
}
?>