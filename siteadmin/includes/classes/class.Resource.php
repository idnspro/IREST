<?php
class Resource{
	var $dbObj;
	
	function Resource(){ // class constructor
		$this->dbObj = new DB();
		$this->dbObj->fun_db_connect();
	}
	
	// Function for resource array
	function fun_getResourceArr($parameter = ''){
		$sql = "SELECT A.* FROM " . TABLE_RESOURCES . " AS A";
		if($parameter != ""){
			$sql .= $parameter;
		} else {
			$sql .= " ORDER BY A.updated_on DESC";		
		}
		//echo $sql;
		return $rs = $this->dbObj->createRecordset($sql);
	}

	// Function for creating Resource category panel
	function fun_createResourceCatLeftPanelById($resources_categories_id = '') {		
		$sql 	= "SELECT resources_categories_id, resources_categories_name FROM " . TABLE_RESOURCES_CATEGORIES . " ORDER BY resources_categories_name";
        $rs 	= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
            $arr = $this->dbObj->fetchAssoc($rs);
            $strlinkclass = "";
            echo '<ul>';
            for($i = 0; $i < count($arr); $i++) {
                $strlinkclass = "";
                if($arr[$i]['resources_categories_id'] == $resources_categories_id  && $resources_categories_id!=''){
					if($i == (count($arr) -1)) {
						$strlinkclass = ' class="font14" style="padding-top:4px; padding-left:15px;"';
					} else {
						$strlinkclass = ' class="font12" style="padding-top:4px; padding-left:10px;"';
					}
                } else {
					if($i == (count($arr) -1)) {
						$strlinkclass = ' class="font14" style="padding-top:4px; padding-left:15px;"';
					} else {
						$strlinkclass = ' class="font12" style="padding-top:4px; padding-left:10px;"';
					}
                }
				$total_resources = $this->fun_countResourcesByCategory($arr[$i]['resources_categories_id']);
				echo '<li '.$strlinkclass.'><a href="'.SITE_URL.'resources.php?resource_cat_ids='.$arr[$i]['resources_categories_id'].'">'.ucfirst($arr[$i]['resources_categories_name']).'<span class="font12"> ('.$total_resources.')</span></a></li>';
            }
            echo '</ul>';
        }        
	}

	// This function will Return Enquiry information in array with front end data
	function fun_countResourcesByCategory($resources_categories_id){
        if($resources_categories_id == "") {
            return "0";
        } else {
			$sql 		= "SELECT A.resource_id FROM " . TABLE_RESOURCES . " AS A WHERE A.resource_cat_ids='".$resources_categories_id."' AND A.active ='1' AND A.status ='2'";
			$rs 		= $this->dbObj->createRecordset($sql);
			return $this->dbObj->getRecordCount($rs);
        }
	}

	// This function will Return Resources information in array with front end data
	function fun_getResourcesByCategoryArr($resource_cat_ids, $parameter = ''){
		$sql 	= "SELECT A.* FROM " . TABLE_RESOURCES . " AS A WHERE A.active ='1' AND A.status ='2'";
        if($resource_cat_ids != "") {
			$sql .= " AND A.resource_cat_ids='".$resource_cat_ids."' ";
        }
		if($parameter != ""){
			$sql .= $parameter;
		} else {
			$sql .= " ORDER BY A.enquiry_id";		
		}
		return $rs = $this->dbObj->createRecordset($sql);
	}

	// Function for creating travel guide option list, if id is given it must be selected
	function fun_getResourcesCatListOptions($resources_categories_id = ''){		
		$selected = "";
		$sql 	= "SELECT resources_categories_id, resources_categories_name FROM " . TABLE_RESOURCES_CATEGORIES . " ORDER BY resources_categories_name";
        $rs 	= $this->dbObj->createRecordset($sql);
        $arr 	= $this->dbObj->fetchAssoc($rs);
        foreach($arr as $value) {
			if($value['resources_categories_id'] == $resources_categories_id  && $resources_categories_id!=''){
				$selected = "selected";
			}else{
				$selected = "";
			}
			echo "<option value=\"".$value['resources_categories_id']."\" " .$selected. ">";
			echo ucwords($value['resources_categories_name']);
			echo "</option>";
        }
	}

	// function for user registration
	function fun_addResource($resource_cat_ids, $resource_name, $resource_description, $resource_country_id, $resource_state_id, $resource_city_id, $resource_link, $resource_mc_link, $active) {
        $status = "1";
        $active = "0";
        $cur_unixtime 			= time ();
		if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
			$cur_user_id 	= $_SESSION['ses_admin_id'];
		} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !=""){
			$cur_user_id 	= $_SESSION['ses_modarator_id'];
		} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !=""){
			$cur_user_id 	= $_SESSION['ses_user_id'];
		} else{
			$cur_user_id 	= "";
		}

        $field_names 			= array("resource_cat_ids", "resource_name", "resource_description", "resource_country_id", "resource_state_id", "resource_city_id", "resource_link", "resource_mc_link", "status", "active_on", "active_by", "created_on", "created_by", "updated_on", "updated_by", "active");
        $field_values 			= array(fun_db_input($resource_cat_ids), fun_db_input($resource_name), fun_db_input($resource_description), fun_db_input($resource_country_id), fun_db_input($resource_state_id), fun_db_input($resource_city_id), fun_db_input($resource_link), fun_db_input($resource_mc_link), fun_db_input($status), fun_db_input($cur_unixtime), fun_db_input($cur_user_id), fun_db_input($cur_unixtime), fun_db_input($cur_user_id), fun_db_input($cur_unixtime), fun_db_input($cur_user_id), fun_db_input($active));
        $this->dbObj->insertFields(TABLE_RESOURCES, $field_names, $field_values);
        $resource_id 			= $this->dbObj->getIdentity();
        return $resource_id;
	}


	function fun_editResource($resource_id, $resource_cat_ids, $resource_name, $resource_description, $resource_country_id, $resource_state_id, $resource_city_id, $resource_link, $resource_mc_link, $active) {
        $status = ($active == "1")?"2":"1";
        $cur_unixtime 		= time ();
		if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !="") {
			$cur_user_id 	= $_SESSION['ses_admin_id'];
		} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !="") {
			$cur_user_id 	= $_SESSION['ses_modarator_id'];
		} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !="") {
			$cur_user_id 	= $_SESSION['ses_user_id'];
		} else {
			$cur_user_id 	= "";
		}

        $field_names 		= array("resource_cat_ids", "resource_name", "resource_description", "resource_country_id", "resource_state_id", "resource_city_id", "resource_link", "resource_mc_link", "status", "active_on", "active_by", "created_on", "created_by", "updated_on", "updated_by", "active");
        $field_values 		= array(fun_db_input($resource_cat_ids), fun_db_input($resource_name), fun_db_input($resource_description), fun_db_input($resource_country_id), fun_db_input($resource_state_id), fun_db_input($resource_city_id), fun_db_input($resource_link), fun_db_input($resource_mc_link), fun_db_input($status), fun_db_input($cur_unixtime), fun_db_input($cur_user_id), fun_db_input($cur_unixtime), fun_db_input($cur_user_id), fun_db_input($cur_unixtime), fun_db_input($cur_user_id), fun_db_input($active));
        $this->dbObj->updateFields(TABLE_RESOURCES, "resource_id", $resource_id, $field_names, $field_values);
        return $resource_id;
	}

	// This function will Return Resource information in array with front end data	
	function fun_getResourceInfo($resource_id){		
		$sql 	= "SELECT * FROM " . TABLE_RESOURCES . " WHERE resource_id='".$resource_id."'";
		//echo $sql;
		$rs 	= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			return $arr[0];
		} else {
			return false;
		}
	}

	// This function will Return Resource information in array with front end data	
	function fun_getResourceUserInfo($resource_id){		
		$sql 	= "SELECT B.user_fname, B.user_lname, B.user_email 
				FROM " . TABLE_USER_RESOURCES_RELATIONS . " AS A 
				INNER JOIN " . TABLE_USERS . " AS B ON A.user_id = B.user_id 
				WHERE A.resource_id='".$resource_id."'";
		$rs 	= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			return $arr[0];
		} else {
			return false;
		}
	}

	function fun_delResource($resource_id){
		$this->dbObj->deleteRow(TABLE_RESOURCES, "resource_id", $resource_id);
		$this->dbObj->deleteRow(TABLE_USER_RESOURCES_RELATIONS, "resource_id", $resource_id);
		return true;
	}

	// Function for new user array
	function fun_getPendingApprovalResourcesArr($parameter=''){
		$sql 		= "SELECT A.resource_id, 
							A.resource_cat_ids, 
							A.resource_name, 
							A.resource_description,
							A.status,
							B.status_name,
							A.created_on,
							A.updated_on,
							A.active
						FROM " . TABLE_RESOURCES . " AS A
						INNER JOIN " . TABLE_RESOURCES_STATUS . " AS B ON A.status = B.status_id 
						";
		if($parameter!=""){
			$sql .= $parameter;
		} else {
			$sql .= " ORDER BY A.updated_on";		
		}
		
		//	echo $sql;
		$rs = $this->dbObj->createRecordset($sql);
        return $arr = $this->dbObj->fetchAssoc($rs);
	}

	function fun_getResourceCatName($resources_categories_id){
		$resources_categories_name = $this->dbObj->getField(TABLE_RESOURCES_CATEGORIES, "resources_categories_id", $resources_categories_id, "resources_categories_name");
		return $resources_categories_name;
	}

	// Function	for activate booking
	function fun_activateResource($resource_id) {
		if($resource_id == '') {
			return false;
		} else {
			$this->dbObj->updateField(TABLE_RESOURCES, "resource_id", $resource_id, "active", "1");
			return true;
		}
	}

	function fun_addUserResourceRelation($resource_id, $user_id, $active ='') {
        if($resource_id =="" || $user_id =="") {
            return false;
        } else {
            $cur_unixtime 		= time ();
            if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
                $cur_user_id 	= $_SESSION['ses_admin_id'];
            } else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !="") {
                $cur_user_id 	= $_SESSION['ses_modarator_id'];
            } else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !="") {
                $cur_user_id 	= $_SESSION['ses_user_id'];
            } else {
                $cur_user_id 	= "";
            }

			if(($user_booking_array = $this->fun_findRelationInfo(TABLE_USER_RESOURCES_RELATIONS, " WHERE user_id='".$user_id."' AND resource_id='".$resource_id."'")) && (is_array($user_booking_array))){
				$user_resource_id 		= $user_booking_array[0]['user_resource_id'];
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

	// function for send resource notification
	function fun_sendResourceNotification($resource_id) {
        if($resource_id == "") {
            return false;
        } else {
			$arrResInfo 	= $this->fun_getResourceInfo($resource_id);
			$arrResUserInfo = $this->fun_getResourceUserInfo($resource_id);
			
			//print_r($arrResInfo);

			//print_r($arrResUserInfo);

			$resource_name 	= $arrResInfo['resource_name'];
			$user_fname 	= $arrResUserInfo['user_fname'];
			$user_lname 	= $arrResUserInfo['user_lname'];
			$user_email 	= $arrResUserInfo['user_email'];

			$res_html .= "<table width=\"80%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
			$res_html .= "<tr>";
			$res_html .= "<td valign=\"top\">";
			$res_html .= "<strong>Dear Admin, <br>You've just received new add resource request - \"".$resource_name." (".fill_zero_left($resource_id, "0", (6-strlen($resource_id))).")\" from ".ucwords($user_fname." ".$user_lname).", Email- ".$user_email.".</strong><br><br>";
			$res_html .= "<strong>Please check this and approve it for publish on website.</strong><br><br>";
			$res_html .= "Regards,<br>The ".$_SERVER["SERVER_NAME"]." Team<br><br><hr>";
			$res_html .= "</td>";
			$res_html .= "</tr>";
			$res_html .= "</table>";
			//echo $res_html;

			//Notification to admin (manager copy)
			$emailObj2 = new Email("ops@idns-technologies.info", SITE_ADMIN_EMAIL, "You've just received new add resource on ".$_SERVER["SERVER_NAME"], $res_html);
			$emailObj2->sendEmail();
			return true;
        }
	}

	// This function will Return data in array
	function fun_findRelationInfo($table, $criteria){		
		$sql = "SELECT * FROM " .$table. " " .$criteria. "";
		$rs = $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			return $arr = $this->dbObj->fetchAssoc($rs);		
		}
		else{
			return false;
		}
	}
}
?>