<?php
class Restaurant{
	var $dbObj;
	
	function Restaurant(){ // class constructor
		$this->dbObj = new DB();
		$this->dbObj->fun_db_connect();
	}

/*
* Restaurant functions : Start here
*/
	// This function will Return Restaurant information in array with front end data	
	function fun_getRestaurantInfo($rest_id){	
		$restInfoArray 	= array();		
		$sql 			= "SELECT * FROM " . TABLE_RESTAURANT . " WHERE rest_id='".$rest_id."'";
		$result 		= $this->dbObj->fun_db_query($sql);
		if($this->dbObj->fun_db_get_num_rows($result) > 0){
			$rowsArray = $this->dbObj->fun_db_fetch_rs_object($result);
			$restInfoArray['rest_id'] 		       = fun_db_output($rowsArray->rest_id);
			$restInfoArray['rest_name'] 		   = fun_db_output($rowsArray->rest_name);
			$restInfoArray['rest_title'] 	       = fun_db_output($rowsArray->rest_title);
			$restInfoArray['rest_short_desc'] 	   = fun_db_output($rowsArray->rest_short_desc);
			$restInfoArray['page_discription'] 	   = fun_db_output($rowsArray->page_discription);
			$restInfoArray['rest_logo'] 	       = fun_db_output($rowsArray->rest_logo);
			$restInfoArray['rest_photo'] 	       = fun_db_output($rowsArray->rest_photo);
			$restInfoArray['rest_bg'] 			   = fun_db_output($rowsArray->rest_bg);
			$restInfoArray['rest_country_id'] 	   = fun_db_output($rowsArray->rest_country_id);
			$restInfoArray['rest_state_id'] 	   = fun_db_output($rowsArray->rest_state_id);
			$restInfoArray['rest_city_id'] 		   = fun_db_output($rowsArray->rest_city_id);
			$restInfoArray['rest_address1'] 	   = fun_db_output($rowsArray->rest_address1);
			$restInfoArray['rest_address2'] 	   = fun_db_output($rowsArray->rest_address2);
			$restInfoArray['rest_zip'] 		       = fun_db_output($rowsArray->rest_zip);
			$restInfoArray['rest_latitude'] 	   = fun_db_output($rowsArray->rest_latitude);
			$restInfoArray['rest_longitude'] 	   = fun_db_output($rowsArray->rest_longitude);
			$restInfoArray['rest_map_zoom_level']  = fun_db_output($rowsArray->rest_map_zoom_level);
			$restInfoArray['status'] 		       = fun_db_output($rowsArray->status);
			$restInfoArray['statuschanged_on'] 	   = fun_db_output($rowsArray->statuschanged_on);
			$restInfoArray['active_on'] 		   = fun_db_output($rowsArray->active_on);
			$restInfoArray['active_by'] 		   = fun_db_output($rowsArray->active_by);
			$restInfoArray['created_on'] 		   = fun_db_output($rowsArray->created_on);
			$restInfoArray['created_by'] 		   = fun_db_output($rowsArray->created_by);
			$restInfoArray['updated_on'] 		   = fun_db_output($rowsArray->updated_on);
			$restInfoArray['updated_by'] 		   = fun_db_output($rowsArray->updated_by);
			$restInfoArray['active'] 			   = fun_db_output($rowsArray->active);
		}
		
		$this->dbObj->fun_db_free_resultset($result);
		return $restInfoArray;
	}

	// This function will Return Restaurant conf in array with front end data	
	function fun_getRestaurantConf($rest_id){	
		$restConfArray 	= array();		
		$sql 			= "SELECT * FROM " . TABLE_RESTAURANT_CONFIGURATION . " WHERE rest_id='".$rest_id."'";
		$result 		= $this->dbObj->fun_db_query($sql);
		if($this->dbObj->fun_db_get_num_rows($result) > 0){
			$rowsArray = $this->dbObj->fun_db_fetch_rs_object($result);
			$restConfArray['conf_id'] 		       	= fun_db_output($rowsArray->conf_id);
			$restConfArray['rest_id'] 		       	= fun_db_output($rowsArray->rest_id);
			$restConfArray['online_order'] 		   	= fun_db_output($rowsArray->online_order);
			$restConfArray['payment_cash'] 		   	= fun_db_output($rowsArray->payment_cash);
			$restConfArray['payment_cc'] 	       	= fun_db_output($rowsArray->payment_cc);
			$restConfArray['payment_oo'] 	   		= fun_db_output($rowsArray->payment_oo);
			$restConfArray['currency_id'] 	   		= fun_db_output($rowsArray->currency_id);
			$restConfArray['paypal_id'] 	   		= fun_db_output($rowsArray->paypal_id);
			$restConfArray['phone'] 	   			= fun_db_output($rowsArray->phone);
			$restConfArray['fax'] 	   				= fun_db_output($rowsArray->fax);
			$restConfArray['tax'] 	   				= fun_db_output($rowsArray->tax);
			$restConfArray['min_order'] 	       	= fun_db_output($rowsArray->min_order);
			$restConfArray['delivery_type'] 	    = fun_db_output($rowsArray->delivery_type);
			$restConfArray['book_table'] 	    	= fun_db_output($rowsArray->book_table);
			$restConfArray['delivery_charge'] 	    = fun_db_output($rowsArray->delivery_charge);
			$restConfArray['extra_charge'] 	    	= fun_db_output($rowsArray->extra_charge);
			$restConfArray['delivery_hrs_mon'] 		= fun_db_output($rowsArray->delivery_hrs_mon);
			$restConfArray['delivery_hrs_tue'] 	   	= fun_db_output($rowsArray->delivery_hrs_tue);
			$restConfArray['delivery_hrs_wed'] 	   	= fun_db_output($rowsArray->delivery_hrs_wed);
			$restConfArray['delivery_hrs_thu'] 		= fun_db_output($rowsArray->delivery_hrs_thu);
			$restConfArray['delivery_hrs_fri'] 	   	= fun_db_output($rowsArray->delivery_hrs_fri);
			$restConfArray['delivery_hrs_sat'] 	   	= fun_db_output($rowsArray->delivery_hrs_sat);
			$restConfArray['delivery_hrs_sun'] 		= fun_db_output($rowsArray->delivery_hrs_sun);
			$restConfArray['delivery_area_note'] 	= fun_db_output($rowsArray->delivery_area_note);
			$restConfArray['serving_note'] 	   		= fun_db_output($rowsArray->serving_note);
			$restConfArray['created_on'] 		   	= fun_db_output($rowsArray->created_on);
			$restConfArray['created_by'] 		   	= fun_db_output($rowsArray->created_by);
			$restConfArray['updated_on'] 		   	= fun_db_output($rowsArray->updated_on);
			$restConfArray['updated_by'] 		   	= fun_db_output($rowsArray->updated_by);
		}
		
		$this->dbObj->fun_db_free_resultset($result);
		return $restConfArray;
	}

	// Function for restaurant array
	function fun_getRestaurantArr($parameter = ''){
		$sql = "SELECT * FROM " . TABLE_RESTAURANT . " AS A";
		if($parameter != ""){
			$sql .= $parameter;
		} else {
			$sql .= " ORDER BY A.updated_on DESC";		
		}
		return $rs = $this->dbObj->createRecordset($sql);
	}


	//Return restuarant name: Start Here
	function fun_getRestaurantNameById($rest_id = '') {
		if($rest_id == '') {
			return false;
		} else {
			return $this->dbObj->getField(TABLE_RESTAURANT, "rest_id", $rest_id, "rest_name");
		}
	}
	//Return restuarant name: End Here

	//Return restuarant id: Start Here
	function fun_getRestIdByOrderId($order_id = '') {
		if($order_id == '') {
			return false;
		} else {
			return $this->dbObj->getField(TABLE_ORDERS_PRODUCTS, "order_id", $order_id, "rest_id");
		}
	}
	//Return restuarant id: End Here

	// Function for restaurant option list
	function fun_getRestaurantOptionsList($rest_id='', $parameter=''){
		$selected 	= "";
		$sql = "SELECT A.rest_id, A.rest_name FROM " . TABLE_RESTAURANT . " AS A";
		if($parameter != ""){
			$sql .= $parameter;
		} else {
			$sql .= " ORDER BY A.rest_id DESC";		
		}
		//echo $sql;
		$result = $this->dbObj->fun_db_query($sql);
		while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result)){
			if($rowsCon->rest_id == $rest_id  && $rest_id!=''){
				$selected = "selected";
			} else {
				$selected = "";
			}
			echo "<option value=\"".fun_db_output($rowsCon->rest_id)."\" " .$selected. ">";
			echo $rowsCon->rest_id." - ".fun_db_output(ucwords($rowsCon->rest_name));
			echo "</option>\n";
		}
		$this->dbObj->fun_db_free_resultset($result);
	}

	//Return restuarant location array: Start Here
	function fun_getRestaurantLocInfoArr($rest_id = ''){
		if($rest_id =='') {
			return false;
		} else {
			$sqlLoc = "SELECT 
					A.rest_country_id, 
					A.rest_state_id, 
					A.rest_city_id,
					B.country_name,
					C.state_name,
					D.city_name,
					D.status AS city_status
					FROM " . TABLE_RESTAURANT . " AS A  
					INNER JOIN " . TABLE_COUNTRY . " AS B ON B.country_id = A.rest_country_id 
					INNER JOIN " . TABLE_STATE . " AS C ON C.state_id = A.rest_state_id 
					INNER JOIN " . TABLE_CITY . " AS D ON D.city_id = A.rest_city_id 
					WHERE A.rest_id ='".$rest_id."'";
	
			$rsLoc 		= $this->dbObj->createRecordset($sqlLoc);
			$arrLoc 	= $this->dbObj->fetchAssoc($rsLoc);
			return $arrLoc[0];
		}
	}
	//Return restuarant location array: End Here
	//Function to create edit cuisines section for restaurant: Start here
	function fun_createRestaurantCuisinesEditView($rest_id) {
		if($rest_id == ''){
			return false;
		} else {
			$strHTML 		= '';
			$cuisines_ids 	= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "cuisines_ids");
			$cuisinesArr 	= explode(",", $cuisines_ids);
			$sql 			= "SELECT * FROM " . TABLE_CUISINES . " ORDER BY cuisines_name";
			$rs 			= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr 	= $this->dbObj->fetchAssoc($rs);
				//print_r($arr);
				$strHTML .= '<table width="500" border="0" cellpadding="3" cellspacing="0" class="dyn-row">';
				for($i=0; $i < count($arr); $i=$i+3) {
					$checked0 	= (array_search($arr[$i+0]['cuisines_id'], $cuisinesArr) === false)?"":"checked";
					$checked1 	= (array_search($arr[$i+1]['cuisines_id'], $cuisinesArr) === false)?"":"checked";
					$checked2 	= (array_search($arr[$i+2]['cuisines_id'], $cuisinesArr) === false)?"":"checked";
					$strHTML 	.= '<tr>';
					$strHTML 	.= '<td align="left"><input type="checkbox" name="cuisines_id[]" value="'. $arr[$i+0]['cuisines_id'] .'" ' .$checked0. ' style="width:13px; height:13px;" />&nbsp;' .ucwords($arr[$i+0]['cuisines_name']). '&nbsp;</td>';
					if(isset($arr[$i+1]['cuisines_id']) && $arr[$i+1]['cuisines_id'] !="") {
						$strHTML 	.= '<td align="left"><input type="checkbox" name="cuisines_id[]" value="'. $arr[$i+1]['cuisines_id'] .'" ' .$checked1. ' style="width:13px; height:13px;" />&nbsp;' .ucwords($arr[$i+1]['cuisines_name']). '&nbsp;</td>';
					} else {
						$strHTML 	.= '<td align="left">&nbsp;</td>';
					}
					if(isset($arr[$i+2]['cuisines_id']) && $arr[$i+2]['cuisines_id'] !="") {
						$strHTML 	.= '<td align="left"><input type="checkbox" name="cuisines_id[]" value="'. $arr[$i+2]['cuisines_id'] .'" ' .$checked2. ' style="width:13px; height:13px;" />&nbsp;' .ucwords($arr[$i+2]['cuisines_name']). '&nbsp;</td>';
					} else {
						$strHTML 	.= '<td align="left">&nbsp;</td>';
					}
					$strHTML 	.= '</tr>';
				}
                $strHTML .= "</table>";
			}
			echo $strHTML;
		}
	}
	//Function to create edit cuisines section for restaurant: Start here
	//Function to create edit feature section for restaurant: Start here
	function fun_createRestaurantFeaturesEditView($rest_id) {
		if($rest_id == ''){
			return false;
		} else {
			$strHTML 		= '';
			$feature_ids 	= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "feature_ids");
			$featureArr 	= explode(",", $feature_ids);
			$sql 			= "SELECT * FROM " . TABLE_FEATURES . " ORDER BY feature_name";
			$rs 			= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr 	= $this->dbObj->fetchAssoc($rs);
				//print_r($arr);
				$strHTML .= '<table width="500" border="0" cellpadding="3" cellspacing="0" class="dyn-row">';
				for($i=0; $i < count($arr); $i=$i+3) {
					$checked0 	= (array_search($arr[$i+0]['feature_id'], $featureArr) === false)?"":"checked";
					$checked1 	= (array_search($arr[$i+1]['feature_id'], $featureArr) === false)?"":"checked";
					$checked2 	= (array_search($arr[$i+2]['feature_id'], $featureArr) === false)?"":"checked";
					$strHTML 	.= '<tr>';
					$strHTML 	.= '<td align="left"><input type="checkbox" name="feature_id[]" value="'. $arr[$i+0]['feature_id'] .'" ' .$checked0. ' style="width:13px; height:13px;" />&nbsp;' .ucwords($arr[$i+0]['feature_name']). '&nbsp;</td>';
					if(isset($arr[$i+1]['feature_id']) && $arr[$i+1]['feature_id'] !="") {
						$strHTML 	.= '<td align="left"><input type="checkbox" name="feature_id[]" value="'. $arr[$i+1]['feature_id'] .'" ' .$checked1. ' style="width:13px; height:13px;" />&nbsp;' .ucwords($arr[$i+1]['feature_name']). '&nbsp;</td>';
					} else {
						$strHTML 	.= '<td align="left">&nbsp;</td>';
					}
					if(isset($arr[$i+2]['feature_id']) && $arr[$i+2]['feature_id'] !="") {
						$strHTML 	.= '<td align="left"><input type="checkbox" name="feature_id[]" value="'. $arr[$i+2]['feature_id'] .'" ' .$checked2. ' style="width:13px; height:13px;" />&nbsp;' .ucwords($arr[$i+2]['feature_name']). '&nbsp;</td>';
					} else {
						$strHTML 	.= '<td align="left">&nbsp;</td>';
					}
					$strHTML 	.= '</tr>';
				}
                $strHTML .= "</table>";
			}
			echo $strHTML;
		}
	}
	//Function to create edit feature section for restaurant: Start here

	//Return restuarant id by name: Start Here
	function fun_getRestaurantIdByName($rest_name) {
		if($rest_name == ''){
			return false;
		} else {
			if($this->dbObj->getField(TABLE_RESTAURANT, "REPLACE(REPLACE(REPLACE(LOWER(rest_name), '&', ''), '-', ''), \"\'\", \"-\")", strtolower(str_replace("'", "-", $rest_name)), "rest_id") != "") {
				$rest_id = $this->dbObj->getField(TABLE_RESTAURANT, "REPLACE(REPLACE(REPLACE(LOWER(rest_name), '&', ''), '-', ''), \"\'\", \"-\")", strtolower(str_replace("'", "-", $rest_name)), "rest_id");
			} else if($this->dbObj->getField(TABLE_RESTAURANT, "REPLACE(REPLACE(REPLACE(LOWER(rest_name), '&', ''), '-', ''), \"\\\'\", \"-\")", strtolower(str_replace("'", "-", $rest_name)), "rest_id") != "") {
				$rest_id = $this->dbObj->getField(TABLE_RESTAURANT, "REPLACE(REPLACE(REPLACE(LOWER(rest_name), '&', ''), '-', ''), \"\\\'\", \"-\")", strtolower(str_replace("'", "-", $rest_name)), "rest_id");
			} else if($this->dbObj->getField(TABLE_RESTAURANT, "REPLACE(REPLACE(REPLACE(LOWER(rest_name), '&', ''), '-', ''), \"\'\", \"-\")", strtolower(str_replace("\'", "-", $rest_name)), "rest_id") != "") {
				$rest_id = $this->dbObj->getField(TABLE_RESTAURANT, "REPLACE(REPLACE(REPLACE(LOWER(rest_name), '&', ''), '-', ''), \"\'\", \"-\")", strtolower(str_replace("\'", "-", $rest_name)), "rest_id");
			} else if($this->dbObj->getField(TABLE_RESTAURANT, "REPLACE(REPLACE(REPLACE(LOWER(rest_name), '&', ''), '-', ''), \"\\\'\", \"-\")", strtolower(str_replace("\'", "-", $rest_name)), "rest_id") != "") {
				$rest_id = $this->dbObj->getField(TABLE_RESTAURANT, "REPLACE(REPLACE(REPLACE(LOWER(rest_name), '&', ''), '-', ''), \"\\\'\", \"-\")", strtolower(str_replace("\'", "-", $rest_name)), "rest_id");
			}
			return $rest_id;
		}
	}
	//Return restuarant id by name: End Here

	//Return restuarant id by friendly url: Start Here
	function fun_getRestaurantIdByFriendlyURL($friendly_link) {
		if($friendly_link == ''){
			return false;
		} else {
			if($this->dbObj->getField(TABLE_RESTAURANT, "REPLACE(REPLACE(LOWER(friendly_link), '&', ''), \"\'\", \"-\")", strtolower(str_replace("'", "-", $friendly_link)), "rest_id") != "") {
				$rest_id = $this->dbObj->getField(TABLE_RESTAURANT, "REPLACE(REPLACE(LOWER(friendly_link), '&', ''), \"\'\", \"-\")", strtolower(str_replace("'", "-", $friendly_link)), "rest_id");
			} else if($this->dbObj->getField(TABLE_RESTAURANT, "REPLACE(REPLACE(LOWER(friendly_link), '&', ''), \"\\\'\", \"-\")", strtolower(str_replace("'", "-", $friendly_link)), "rest_id") != "") {
				$rest_id = $this->dbObj->getField(TABLE_RESTAURANT, "REPLACE(REPLACE(LOWER(friendly_link), '&', ''), \"\\\'\", \"-\")", strtolower(str_replace("'", "-", $friendly_link)), "rest_id");
			} else if($this->dbObj->getField(TABLE_RESTAURANT, "REPLACE(REPLACE(LOWER(friendly_link), '&', ''), \"\'\", \"-\")", strtolower(str_replace("\'", "-", $friendly_link)), "rest_id") != "") {
				$rest_id = $this->dbObj->getField(TABLE_RESTAURANT, "REPLACE(REPLACE(LOWER(friendly_link), '&', ''), \"\'\", \"-\")", strtolower(str_replace("\'", "-", $friendly_link)), "rest_id");
			} else if($this->dbObj->getField(TABLE_RESTAURANT, "REPLACE(REPLACE(LOWER(friendly_link), '&', ''), \"\\\'\", \"-\")", strtolower(str_replace("\'", "-", $friendly_link)), "rest_id") != "") {
				$rest_id = $this->dbObj->getField(TABLE_RESTAURANT, "REPLACE(REPLACE(LOWER(friendly_link), '&', ''), \"\\\'\", \"-\")", strtolower(str_replace("\'", "-", $friendly_link)), "rest_id");
			}
			return $rest_id;
		}
	}
	//Return restuarant id by friendly url: End Here

	//Return restuarant friendly url by id : Start Here
	function fun_getRestaurantFriendlyLink($rest_id) {
		if($rest_id == ''){
			return false;
		} else {
			return $friendly_link = $this->dbObj->getField(TABLE_RESTAURANT, "rest_id", $rest_id, "friendly_link");
		}
	}
	//Return restuarant friendly url by id : End Here

	//Add New restaurant, and return restaurant id (rest_id)
	function fun_addRestaurant($rest_name, $rest_country_id ='', $rest_state_id ='', $rest_city_id ='', $rest_address1 ='', $rest_address2 ='', $rest_zip =''){
		if($rest_name == '') {
			return false;
		} else {
			$status = "2";
			$active = "0";
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
	
			$field_names  	= array("rest_name", "rest_country_id", "rest_state_id", "rest_city_id", "rest_address1", "rest_address2", "rest_zip", "status", "statuschanged_on", "created_on", "created_by", "updated_on", "updated_by", "active");
			$field_values 	= array(fun_db_input($rest_name), $rest_country_id, $rest_state_id, $rest_city_id, fun_db_input($rest_address1), fun_db_input($rest_address2), $rest_zip, $status, $cur_unixtime, $cur_unixtime, $cur_user_id, $cur_unixtime, $cur_user_id, $active);
			$this->dbObj->insertFields(TABLE_RESTAURANT, $field_names, $field_values);
			$rest_id 		= $this->dbObj->getIdentity();
			return $rest_id;
		}
	}

	//Edit restaurant information
	function fun_editRestaurant($rest_id){
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

		if($rest_id =="") {
			return false;
		} else {
			//Upadate updated by, updated on
			$sqlUpdate = "UPDATE " . TABLE_RESTAURANT . " SET updated_on='" . $cur_unixtime . "', updated_by='" . $cur_user_id . "' WHERE rest_id='".(int)$rest_id."'";
			$this->dbObj->mySqlSafeQuery($sqlUpdate);

			// Updates from details page
			if($_POST['securityKey']==md5("EDITRESTAURANTDETAILS")){		
				// Step I : if general details available update it
				$rest_name			= $_POST['rest_name'];
				//$rest_title			= $_POST['rest_title'];
				//$rest_short_desc	= $_POST['rest_short_desc'];
				//$page_discription	= $_POST['page_discription'];
				//$rest_logo			= $_POST['rest_logo'];
				$rest_country_id	= $_POST['rest_country_id'];
				$rest_state_id		= $_POST['rest_state_id'];
				$rest_city_id		= $_POST['rest_city_id'];
				$rest_address1		= $_POST['rest_address1'];
				$rest_address2		= $_POST['rest_address2'];
				$rest_zip			= $_POST['rest_zip'];
				$active				= $_POST['active'];

				$restArray = array(							
					"rest_name" 		=> $rest_name,
					"rest_country_id" 	=> $rest_country_id,
					"rest_state_id" 	=> $rest_state_id,
					"rest_city_id" 		=> $rest_city_id,
					"rest_address1" 	=> $rest_address1,
					"rest_address2" 	=> $rest_address2,
					"rest_zip" 			=> $rest_zip,
					"active" 			=> $active,
					"updated_on" 		=> $cur_unixtime,
					"updated_by" 		=> $cur_user_id
				);
		
				$fields = "";
				foreach($restArray as $keys => $vals){
					$fields .= $keys . "='" . fun_db_input($vals). "', ";
				}
				if($fields!=""){
					$fields = substr($fields,0,strlen($fields)-2);
					$sqlUpdate = "UPDATE " . TABLE_RESTAURANT . " SET " . $fields . " WHERE rest_id='".(int)$rest_id."'";
					$this->dbObj->mySqlSafeQuery($sqlUpdate);
				}
			}

			// Updates from restaurant welcome message
			if($_POST['securityKey']==md5("UPDATERESTDESC")){		
				// Step I : if general details available update it
				$rest_title 		= $_POST['rest_title'];
				$rest_short_desc 	= $_POST['rest_short_desc'];
				$page_discription 	= $_POST['page_discription'];
			
				$restArray = array(							
					"rest_title" 		=> $rest_title,
					"rest_short_desc" 	=> $rest_short_desc,
					"page_discription" 	=> $page_discription,
					"updated_on" 		=> $cur_unixtime,
					"updated_by" 		=> $cur_user_id
				);
			
				$fields = "";
				foreach($restArray as $keys => $vals){
					$fields .= $keys . "='" . fun_db_input($vals). "', ";
				}
				if($fields!=""){
					$fields = substr($fields,0,strlen($fields)-2);
					$sqlUpdate = "UPDATE " . TABLE_RESTAURANT . " SET " . $fields . " WHERE rest_id='".(int)$rest_id."'";
					$this->dbObj->mySqlSafeQuery($sqlUpdate);
				}
			}

			// Updates from restaurant configuration
			if($_POST['securityKey']==md5("EDITRESTAURANTINFO")){		
				// Step I : if map details available update it
				$rest_latitude 			= $_POST['rest_latitude'];
				$rest_longitude 		= $_POST['rest_longitude'];
				$rest_map_zoom_level 	= $_POST['rest_map_zoom_level'];
                if(isset($rest_latitude) && $rest_latitude !="" && isset($rest_longitude) && $rest_longitude !="" && isset($rest_map_zoom_level) && $rest_map_zoom_level !="") {
                    $strUpdateQuery = "UPDATE " . TABLE_RESTAURANT . " SET rest_latitude='".$rest_latitude."', rest_longitude='".$rest_longitude."', rest_map_zoom_level='".$rest_map_zoom_level."', updated_on='".$cur_unixtime."', updated_by='".$cur_user_id."' WHERE rest_id='".(int)$rest_id."'";
                    $this->dbObj->mySqlSafeQuery($strUpdateQuery);
                }

				// Step II : if ordering details available update it
                if(isset($_POST['conf_id']) && $_POST['conf_id']!="") { // Edit
                    $conf_id 			= $_POST['conf_id'];
                    $rest_id 			= $_POST['rest_id'];
                    $online_order 		= $_POST['online_order'];
                    $payment_cash 		= $_POST['payment_cash'];
                    $payment_cc 		= $_POST['payment_cc'];
                    $payment_oo 		= $_POST['payment_oo'];
                    $currency_id 		= $_POST['currency_id'];
                    $paypal_id 			= $_POST['paypal_id'];
                    $phone 				= $_POST['phone'];
				    $fax 				= $_POST['fax'];
				    $tax 				= $_POST['tax'];
                    $min_order 			= $_POST['min_order'];
                    $delivery_type 		= $_POST['delivery_type'];
                    $book_table 		= $_POST['book_table'];
                    $delivery_charge 	= $_POST['delivery_charge'];
                    $extra_charge 		= $_POST['extra_charge'];
                    $delivery_hrs_mon 	= $_POST['delivery_hrs_mon'];
                    $delivery_hrs_tue 	= $_POST['delivery_hrs_tue'];
                    $delivery_hrs_wed 	= $_POST['delivery_hrs_wed'];
                    $delivery_hrs_thu 	= $_POST['delivery_hrs_thu'];
                    $delivery_hrs_fri 	= $_POST['delivery_hrs_fri'];
                    $delivery_hrs_sat 	= $_POST['delivery_hrs_sat'];
                    $delivery_hrs_sun 	= $_POST['delivery_hrs_sun'];
                    $delivery_area_note = $_POST['delivery_area_note'];
                    $serving_note 		= $_POST['serving_note'];
					if(isset($_POST['cuisines_id']) && is_array($_POST['cuisines_id'])){
						$cuisines_ids = implode(",", $_POST['cuisines_id']);
					} else {
						$cuisines_ids = "";
					}
					if(isset($_POST['feature_id']) && is_array($_POST['feature_id'])){
						$feature_ids = implode(",", $_POST['feature_id']);
					} else {
						$feature_ids = "";
					}

                    $restConfArray = array(							
                        "rest_id" 			=> $rest_id,
                        "online_order" 		=> $online_order,
                        "payment_cash" 		=> $payment_cash,
                        "payment_cc" 		=> $payment_cc,
                        "payment_oo" 		=> $payment_oo,
                        "currency_id" 		=> $currency_id,
                        "paypal_id" 		=> $paypal_id,
                        "phone" 			=> $phone,
						"fax" 			    => $fax,
						"tax" 			    => $tax,
                        "min_order" 		=> $min_order,
                        "delivery_type" 	=> $delivery_type,
                        "book_table" 		=> $book_table,
                        "delivery_charge" 	=> $delivery_charge,
                        "extra_charge" 		=> $extra_charge,
                        "delivery_hrs_mon" 	=> $delivery_hrs_mon,
                        "delivery_hrs_tue" 	=> $delivery_hrs_tue,
                        "delivery_hrs_wed" 	=> $delivery_hrs_wed,
                        "delivery_hrs_thu" 	=> $delivery_hrs_thu,
                        "delivery_hrs_fri" 	=> $delivery_hrs_fri,
                        "delivery_hrs_sat" 	=> $delivery_hrs_sat,
                        "delivery_hrs_sun" 	=> $delivery_hrs_sun,
                        "delivery_area_note"=> $delivery_area_note,
                        "serving_note" 		=> $serving_note,
                        "cuisines_ids" 		=> $cuisines_ids,
                        "feature_ids" 		=> $feature_ids,
                        "updated_on" 		=> $cur_unixtime,
                        "updated_by" 		=> $cur_user_id
                    );
                
                    $fields = "";
                    foreach($restConfArray as $keys => $vals){
                        $fields .= $keys . "='" . fun_db_input($vals). "', ";
                    }
                    if($fields!=""){
                        $fields = substr($fields,0,strlen($fields)-2);
                        $sqlUpdate = "UPDATE " . TABLE_RESTAURANT_CONFIGURATION . " SET " . $fields . " WHERE conf_id='".(int)$conf_id."'";
                        $this->dbObj->mySqlSafeQuery($sqlUpdate);
                    }
                } else {
                    $rest_id 			= $_POST['rest_id'];
                    $online_order 		= $_POST['online_order'];
                    $payment_cash 		= $_POST['payment_cash'];
                    $payment_cc 		= $_POST['payment_cc'];
                    $payment_oo 		= $_POST['payment_oo'];
                    $currency_id 		= $_POST['currency_id'];
                    $paypal_id 			= $_POST['paypal_id'];
                    $phone 				= $_POST['phone'];
					$fax 				= $_POST['fax'];
					$tax 				= $_POST['tax'];
                    $min_order 			= $_POST['min_order'];
                    $book_table 		= $_POST['book_table'];
                    $delivery_type 		= $_POST['delivery_type'];
                    $delivery_charge 	= $_POST['delivery_charge'];
                    $extra_charge 		= $_POST['extra_charge'];
                    $delivery_hrs_mon 	= $_POST['delivery_hrs_mon'];
                    $delivery_hrs_tue 	= $_POST['delivery_hrs_tue'];
                    $delivery_hrs_wed 	= $_POST['delivery_hrs_wed'];
                    $delivery_hrs_thu 	= $_POST['delivery_hrs_thu'];
                    $delivery_hrs_fri 	= $_POST['delivery_hrs_fri'];
                    $delivery_hrs_sat 	= $_POST['delivery_hrs_sat'];
                    $delivery_hrs_sun 	= $_POST['delivery_hrs_sun'];
                    $delivery_area_note = $_POST['delivery_area_note'];
                    $serving_note 		= $_POST['serving_note'];
					if(isset($_POST['cuisines_id']) && is_array($_POST['cuisines_id'])){
						$cuisines_ids = implode(",", $_POST['cuisines_id']);
					} else {
						$cuisines_ids = "";
					}
					if(isset($_POST['feature_id']) && is_array($_POST['feature_id'])){
						$feature_ids = implode(",", $_POST['feature_id']);
					} else {
						$feature_ids = "";
					}

                    $field_names  	= array("rest_id", "online_order", "payment_cash", "payment_cc", "payment_oo", "currency_id", "paypal_id", "phone", "fax", "tax", "min_order", "delivery_type", "book_table", "delivery_charge", "extra_charge", "delivery_hrs_mon", "delivery_hrs_tue", "delivery_hrs_wed", "delivery_hrs_thu", "delivery_hrs_fri", "delivery_hrs_sat", "delivery_hrs_sun", "delivery_area_note", "serving_note", "cuisines_ids", "feature_ids", "created_on", "created_by", "updated_on", "updated_by");
                    $field_values 	= array(fun_db_input($rest_id), $online_order, $payment_cash, $payment_cc, $payment_oo, $currency_id, fun_db_input($paypal_id), fun_db_input($phone), fun_db_input($fax), fun_db_input($tax), fun_db_input($min_order), $delivery_type, $book_table, fun_db_input($delivery_charge), fun_db_input($extra_charge), fun_db_input($delivery_hrs_mon), fun_db_input($delivery_hrs_tue), fun_db_input($delivery_hrs_wed), fun_db_input($delivery_hrs_thu), fun_db_input($delivery_hrs_fri), fun_db_input($delivery_hrs_sat), fun_db_input($delivery_hrs_sun), fun_db_input($delivery_area_note), fun_db_input($serving_note), fun_db_input($cuisines_ids), fun_db_input($feature_ids), $cur_unixtime, $cur_user_id, $cur_unixtime, $cur_user_id);
                    $this->dbObj->insertFields(TABLE_RESTAURANT_CONFIGURATION, $field_names, $field_values);
                    $conf_id 		= $this->dbObj->getIdentity();
                }
			}

			// Updates from restaurant alerts
			if($_POST['securityKey']==md5("EDITRESTAURANTALERT")){		
				//Step I: delete / update mobile number details
				$strDelMobileNumbersQuery = "DELETE FROM " . TABLE_RESTAURANT_MOBILE_ALERTS . " WHERE rest_id='".$rest_id."'";
				$this->dbObj->mySqlSafeQuery($strDelMobileNumbersQuery); // delete previous relations
			
				$mobile_countryid_arr		= $_POST['mobile_countryid'];
				$mobile_number_arr 			= $_POST['mobile_number'];
				$mobile_number_show_arr 	= 1;
			
				if(is_array($mobile_number_arr) &&  count($mobile_number_arr) > 0){
					for($i=0; $i<count($mobile_number_arr); $i++){
						$mobile_countryid 		= $mobile_countryid_arr[$i];
						$mobile_number 			= $mobile_number_arr[$i];
						$mobile_number_show 	= 1;
						if($mobile_number != ""){
							$strInsMobileNumbersQuery = "INSERT INTO " . TABLE_RESTAURANT_MOBILE_ALERTS . "(id, rest_id, mobile_countryid, mobile_number, mobile_number_show, created_on, created_by, updated_on, updated_by) ";
							$strInsMobileNumbersQuery .= "VALUES(null, '".$rest_id."', '".$mobile_countryid."', '".$mobile_number."', '".$mobile_number_show."', '".$cur_unixtime."', '".$cur_user_id."', '".$cur_unixtime."', '".$cur_user_id."')";
							$this->dbObj->mySqlSafeQuery($strInsMobileNumbersQuery);
						}
					}
				}
			
				//Step I: delete / update email details
				$strDelEmailsQuery 	= "DELETE FROM " . TABLE_RESTAURANT_EMAIL_ALERTS . " WHERE rest_id='".$rest_id."'";
				$this->dbObj->mySqlSafeQuery($strDelEmailsQuery); // delete previous relations
				$email_address_arr 		= $_POST['email_address'];
			
				if(is_array($email_address_arr) &&  count($email_address_arr) > 0){
					for($i=0; $i<count($email_address_arr); $i++){
						$email_address 			= $email_address_arr[$i];
						if($email_address != ""){
							$strInsEmailQuery = "INSERT INTO " . TABLE_RESTAURANT_EMAIL_ALERTS . "(id, rest_id, email_address, created_on, created_by, updated_on, updated_by) ";
							$strInsEmailQuery .= "VALUES(null, '".$rest_id."', '".$email_address."', '".$cur_unixtime."', '".$cur_user_id."', '".$cur_unixtime."', '".$cur_user_id."')";
							$this->dbObj->mySqlSafeQuery($strInsEmailQuery);
						}
					}
				}
			}
			return true;
		}
	}

	// Function	for updating restaurant logo
	function fun_editRestaurantLogo($rest_id, $rest_logo){
		if($rest_id == '' || $rest_logo == ''){
			return false;
		} else {
			$cur_unixtime 		= time ();
			if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !="") {
				$cur_user_id 	= $_SESSION['ses_admin_id'];
			} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_modarator_id'];
			} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !="") {
				$cur_user_id 	= $_SESSION['ses_user_id'];
			} else {
				$cur_user_id 	= "";
			}

			$strUpdateQuery = "UPDATE " . TABLE_RESTAURANT . " SET rest_logo='".$rest_logo."', updated_on='".$cur_unixtime."', updated_by='".$cur_user_id."' WHERE rest_id='".(int)$rest_id."'";
			$this->dbObj->mySqlSafeQuery($strUpdateQuery);
			return true;
		}
	}

	// Function	for updating restaurant logo
	function fun_editRestaurantPhoto($rest_id, $rest_photo){
		if($rest_id == '' || $rest_photo == ''){
			return false;
		} else {
			$cur_unixtime 		= time ();
			if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !="") {
				$cur_user_id 	= $_SESSION['ses_admin_id'];
			} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_modarator_id'];
			} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !="") {
				$cur_user_id 	= $_SESSION['ses_user_id'];
			} else {
				$cur_user_id 	= "";
			}

			$strUpdateQuery = "UPDATE " . TABLE_RESTAURANT . " SET rest_photo='".$rest_photo."', updated_on='".$cur_unixtime."', updated_by='".$cur_user_id."' WHERE rest_id='".(int)$rest_id."'";
			$this->dbObj->mySqlSafeQuery($strUpdateQuery);
			return true;
		}
	}

	// Function	for updating restaurant friendly URL
	function fun_generateFriendlyLink($rest_id, $friendly_link){
		$friendly_link = replace_NonAlphaNumChars($friendly_link, TABLE_RESTAURANT, "rest_id", $rest_id, "friendly_link");
		$this->dbObj->updateField(TABLE_RESTAURANT, "rest_id", $rest_id, "friendly_link", $friendly_link);
	}

	// Function	for add restaurant photos main
	function fun_addRestaurantPhotos($rest_id){
		if($rest_id == ''){
			return false;
		} else {
			$photo_caption 		= $_POST['photo_caption'];
			$photo_url 			= "";
			$photo_thumb 		= "";
			$photo_main 		= "0";
			$cur_unixtime 		= time ();
			if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_admin_id'];
			} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_modarator_id'];
			} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_user_id'];
			} else {
				$cur_user_id 	= "";
			}
	
			$field_names  	= array("rest_id", "photo_caption", "photo_url", "photo_thumb", "created_on", "created_by", "updated_on", "updated_by", "photo_main");
			$field_values 	= array($rest_id, fun_db_input($photo_caption), $photo_url, $photo_thumb, $cur_unixtime, $cur_user_id, $cur_unixtime, $cur_user_id, $photo_main);
			$this->dbObj->insertFields(TABLE_RESTAURANT_PHOTO_ALL, $field_names, $field_values);
			$photo_id 		= $this->dbObj->getIdentity();
			return $photo_id;
		}
	}

	// Function	for updating restaurant photos main
	function fun_updateRestaurantPhotos($rest_id, $photo_id, $photo_caption = '', $photo_main = '', $photo_thumb = ''){
		if($rest_id == '' || $photo_id == ''){
			return false;
		} else {
			$strUpdateQuery = "UPDATE " . TABLE_RESTAURANT_PHOTO_ALL . " SET photo_caption='".$photo_caption."', photo_url='".$photo_main."', photo_thumb='".$photo_thumb."' WHERE photo_id='".(int)$photo_id."' AND rest_id='".(int)$rest_id."'";
			$this->dbObj->mySqlSafeQuery($strUpdateQuery);
			return true;
		}
	}

	// Function	for updating restaurant status
	function fun_updateRestaurantLastUpdate($rest_id){
		if($rest_id == ''){
			return false;
		} else {
			$cur_unixtime 		= time ();
			if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !="") {
				$cur_user_id 	= $_SESSION['ses_admin_id'];
			} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_modarator_id'];
			} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !="") {
				$cur_user_id 	= $_SESSION['ses_user_id'];
			} else {
				$cur_user_id 	= "";
			}

			$strUpdateQuery = "UPDATE " . TABLE_RESTAURANT . " SET updated_on='".$cur_unixtime."', updated_by='".$cur_user_id."' WHERE rest_id='".(int)$rest_id."'";
			$this->dbObj->mySqlSafeQuery($strUpdateQuery);
			return true;
		}
	}

	//Function for get manager id by restaurant id
	function fun_getRestaurantManagerId($rest_id){
		if($rest_id =="") {
			return false;
		} else {
			$manager_id	= $this->dbObj->getField(TABLE_RESTAURANT_MANAGER_RELATIONS, "rest_id", $rest_id, "manager_id");
			return $manager_id;
		}
	}

	// Function for assigning restaurant
	function fun_assignRestaurantToManager($rest_id, $manager_id){
		if($rest_id == '' || $manager_id == '') {
			return false;
		} else {
			$this->dbObj->insertOrUpdateFields(TABLE_RESTAURANT_MANAGER_RELATIONS, "rest_id", $rest_id, array("rest_id", "manager_id"),  array($rest_id, $manager_id));
			return true;
		}
	}

	// This function will Return Restaurant Photos for the gallary
	function fun_getRestPhotosGallary($rest_id){		
		$sql = "SELECT 
				A.photo_id,
		        A.rest_id,
				A.photo_caption,
				A.photo_url,
		        A.photo_thumb,
		        A.photo_main
				FROM " . TABLE_RESTAURANT_PHOTO_ALL . " AS A  
				INNER JOIN " . TABLE_RESTAURANT . " AS B ON A.rest_id = B.rest_id
				WHERE A.rest_id ='".(int)$rest_id."'";
		$rs = $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0) {
			return $arr = $this->dbObj->fetchAssoc($rs);
		} else {
			return false;
		}
	}

	// Function for restaurant search
	function fun_getRestaurantSearchArr($rest_country_id='', $rest_state_id='', $rest_city_id='', $rest_zip= '', $address= '', $book_table= '', $dtypeids= '', $distanceids= '', $cuisinesids= '', $featureids= '', $priceids= '', $paymethodids= '', $schedule= '', $parameter= ''){
		$restaurant_ids = $this->fun_getRestaurantIdsByCriteria($rest_country_id, $rest_state_id, $rest_city_id, $rest_zip, $address, $book_table, $dtypeids, $distanceids, $cuisinesids, $featureids, $priceids, $paymethodids, $schedule, $parameter);
		if(isset($restaurant_ids) && $restaurant_ids !="") {
			$sql = "SELECT distinct A.* 
					FROM " . TABLE_RESTAURANT . " AS A 
					WHERE A.active='1' AND A.status ='2' AND A.rest_id IN (".$restaurant_ids.") ";
			if($parameter != ""){
				$sql .= $parameter;
			} else {
				$sql .= " ORDER BY A.updated_on DESC";		
			}
				//echo $sql;
			return $rs = $this->dbObj->createRecordset($sql);
		} else {
			return false;
		}
	}

	// Function for restaurant search by criteria
	function fun_getRestaurantIdsByCriteria($rest_country_id='', $rest_state_id='', $rest_city_id='', $rest_zip='', $address='', $book_table= '', $dtypeids='', $distanceids='', $cuisinesids='', $featureids='', $priceids='', $paymethodids='', $schedule='', $parameter=''){
		$restaurantIdArr =  array();
		$where 			 = array();
		if (isset($rest_country_id) && $rest_country_id != "") {
			array_push($where, " A.rest_country_id='".$rest_country_id."'");
		}

		if (isset($rest_state_id) && $rest_state_id != "") {
			array_push($where, " A.rest_state_id='".$rest_state_id."'");
		}
		
		if (isset($rest_city_id) && $rest_city_id != "") {
			array_push($where, " A.rest_city_id='".$rest_city_id."'");
		}
		
		if (isset($rest_zip) && $rest_zip != "") {
			array_push($where, " A.rest_zip='".$rest_zip."'");
		}
		
		if(sizeof($where) > 0){
			$where_clause = " WHERE ".join($where, " AND ");
		}

		$sql		= "SELECT A.rest_id AS rest_id FROM " . TABLE_RESTAURANT . " AS A ".$where_clause." ";
		//echo $sql;
		$rs 		= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0) {
			$arr = $this->dbObj->fetchAssoc($rs);
			for($i = 0; $i < count($arr); $i++) {
				array_push($restaurantIdArr, "'".$arr[$i]['rest_id']."'");
			}
		}
		
		//As per address
		if(isset($address) && $address !="") {
			$restaurantIdByAdrArr = array();
			$strQuery = "SELECT A.rest_id AS rest_id 
			FROM " . TABLE_RESTAURANT . " AS A  
			WHERE A.active='1' ";
			$bolExecute = false;
			if (isset($address) && $address!='' ) {
				$arrAdr = explode(" " ,$address);
				for ($intCounter=0; $intCounter<=count($arrAdr)-1; $intCounter++){
					if (strlen(trim($arrAdr[$intCounter])) > 0 )
					$address1Query = $address1Query . " A.rest_address1 LIKE '%" . $arrAdr[$intCounter] . "%' OR ";
					$address2Query = $address2Query . " A.rest_address2 LIKE '%" . $arrAdr[$intCounter] . "%' OR ";
				}
				$strQuery 	= $strQuery . " AND (" . substr($address1Query,0,strlen($address1Query)-4) . ") OR (" . substr($address2Query,0,strlen($address2Query)-4) . ")";
				$bolExecute = true;
			}	
			
            $rsQuery 	= $this->dbObj->createRecordset($strQuery);
			if($this->dbObj->getRecordCount($rsQuery) > 0){
				$arr = $this->dbObj->fetchAssoc($rsQuery);
			}
			for($j = 0; $j < count($arr); $j++) {
				array_push($restaurantIdByAdrArr, "'".$arr[$j]['rest_id']."'");
			}
		}

		//As per book table
		if(isset($book_table) && $book_table > 0) {
			$restaurantIdByBookTable 	= array();
			$sql						= "SELECT A.rest_id AS rest_id FROM " . TABLE_RESTAURANT_CONFIGURATION . " AS A WHERE A.book_table='".$book_table."' ";
			//echo $sql;
			$rs 						= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0) {
				$arr = $this->dbObj->fetchAssoc($rs);
				for($i = 0; $i < count($arr); $i++) {
					array_push($restaurantIdByBookTable, "'".$arr[$i]['rest_id']."'");
				}
			}
		}

		//As per order type
		if(is_array($dtypeids) && count($dtypeids) > 0) {
			//echo "I am here";
			//print_r(array_keys($dtypeids));

			$restaurantIdByOrderType 	= array();
			$delivery_type 				= (in_array(2, array_keys($dtypeids)))?"1":"0";
			$sql						= "SELECT A.rest_id AS rest_id FROM " . TABLE_RESTAURANT_CONFIGURATION . " AS A WHERE A.delivery_type='".$delivery_type."' ";
			echo $sql;
			$rs 						= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0) {
				$arr = $this->dbObj->fetchAssoc($rs);
				for($i = 0; $i < count($arr); $i++) {
					array_push($restaurantIdByOrderType, "'".$arr[$i]['rest_id']."'");
				}
			}
			//echo count($restaurantIdByOrderType);
		}

		//As per distanceids
		if(isset($rest_zip) && $rest_zip !="" && isset($distanceids) && $distanceids > 0) {
			$restaurantIdByDistance 	= array();
			$lat 	= $this->dbObj->getField(TABLE_ZIP, "zipcode", $rest_zip, "lat");
			$lon 	= $this->dbObj->getField(TABLE_ZIP, "zipcode", $rest_zip, "lon");
			$sql 	= "SELECT A.rest_id AS rest_id	FROM " . TABLE_RESTAURANT . " AS A 
			WHERE (POW((69.1*(A.`rest_latitude`-\"$lon\")*cos($lat/57.3)),\"2\")+POW((69.1*(A.`rest_longitude`-\"$lat\")),\"2\"))<($distanceids*$distanceids)";
			//echo $sql;
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0) {
				$arr = $this->dbObj->fetchAssoc($rs);
				for($i = 0; $i < count($arr); $i++) {
					array_push($restaurantIdByDistance, "'".$arr[$i]['rest_id']."'");
				}
			}
		}

		//As per cuisine type
		if(isset($cuisinesids) && $cuisinesids > 0) {
			$restaurantIdByCuisineType 	= array();
			//$cuisines_ids 	= implode("-", $cuisinesids);
			$cuisinesArr 	= explode("-", $cuisinesids);
			//echo $cuisinesids;
			$cuisines_where = array();
			for($i = 0; $i < count($cuisinesArr); $i++) {
				$cuisines_id = $cuisinesArr[$i];
				array_push($cuisines_where, "((A.cuisines_ids like '%,".$cuisines_id .",%') OR (A.cuisines_ids like '".$cuisines_id .",%') OR (A.cuisines_ids like '%,".$cuisines_id ."'))");
			}
			if(sizeof($cuisines_where) > 0){
				$cuisines_where_clause = " WHERE ".join($cuisines_where, " AND ");
			}

			$sql	= "SELECT A.rest_id AS rest_id FROM " . TABLE_RESTAURANT_CONFIGURATION . " AS A ".$cuisines_where_clause." ";
			//echo $sql;
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0) {
				$arr = $this->dbObj->fetchAssoc($rs);
				for($i = 0; $i < count($arr); $i++) {
					array_push($restaurantIdByCuisineType, "'".$arr[$i]['rest_id']."'");
				}
			}
		}

		//As per feature
		if(isset($featureids) && $featureids > 0) {
			$restaurantIdByFeature 	= array();
			//$feature_ids 	= implode("-", $featureids);
			$featureArr 	= explode("-", $featureids);

			$feature_where = array();
			for($i = 0; $i < count($featureArr); $i++) {
				$feature_id = $featureArr[$i];
				array_push($feature_where, "((A.feature_ids like '%,".$feature_id .",%') OR (A.feature_ids like '".$feature_id .",%') OR (A.feature_ids like '%,".$feature_id ."'))");
			}
			if(sizeof($feature_where) > 0){
				$feature_where_clause = " WHERE ".join($feature_where, " AND ");
			}

			$sql	= "SELECT A.rest_id AS rest_id FROM " . TABLE_RESTAURANT_CONFIGURATION . " AS A ".$feature_where_clause." ";
			//echo $sql;
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0) {
				$arr = $this->dbObj->fetchAssoc($rs);
				for($i = 0; $i < count($arr); $i++) {
					array_push($restaurantIdByFeature, "'".$arr[$i]['rest_id']."'");
				}
			}
		}

		//As per price
		if(isset($priceids) && $priceids > 0) {
			$restaurantIdByPrice 	= array();
			$priceArr 	= explode("-", $priceids);
			//find max
			$min = 0;
			$max = (pow(10, max($priceArr))-1);

			$sql	= "SELECT distinct A.rest_id FROM " . TABLE_MENU . " AS A WHERE A.menu_id IN (SELECT distinct menu_id FROM " . TABLE_MENU_PRICE_RELATION . " WHERE price > ".$min." AND price < ".$max.") ";
			//echo $sql;
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0) {
				$arr = $this->dbObj->fetchAssoc($rs);
				for($i = 0; $i < count($arr); $i++) {
					array_push($restaurantIdByPrice, "'".$arr[$i]['rest_id']."'");
				}
			}
		}

		//As per paymethod
		if(isset($paymethodids) && $paymethodids> 0) {
			$restaurantIdByPaymethod 	= array();
			$paymethodArr 	= explode("-", $paymethodids);

			$paymethod_where = array();
			if(in_array(1, $paymethodArr)) {array_push($paymethod_where, "(A.payment_oo = '1')");}
			if(in_array(2, $paymethodArr)) {array_push($paymethod_where, "(A.payment_cash = '1')");}
			if(in_array(3, $paymethodArr)) {array_push($paymethod_where, "(A.payment_cc = '1')");}
			if(in_array(4, $paymethodArr)) {array_push($paymethod_where, "(A.payment_cc = '1')");}

			if(sizeof($paymethod_where) > 0){
				$paymethod_where_clause = " WHERE ".join($paymethod_where, " AND ");
			}

			$sql	= "SELECT A.rest_id AS rest_id FROM " . TABLE_RESTAURANT_CONFIGURATION . " AS A ".$paymethod_where_clause." ";
			//echo $sql;
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0) {
				$arr = $this->dbObj->fetchAssoc($rs);
				for($i = 0; $i < count($arr); $i++) {
					array_push($restaurantIdByPaymethod, "'".$arr[$i]['rest_id']."'");
				}
			}
		}

		if(is_array($restaurantIdByAdrArr) && count($restaurantIdByAdrArr) > 0) {
			$restaurantIdArr 	= array_intersect($restaurantIdArr, $restaurantIdByAdrArr);
		}

		if(is_array($restaurantIdByBookTable) && count($restaurantIdByBookTable) > 0) {
			$restaurantIdArr 	= array_intersect($restaurantIdArr, $restaurantIdByBookTable);
		}

		if(is_array($restaurantIdByOrderType) && count($restaurantIdByOrderType) > 0) {
			$restaurantIdArr 	= array_intersect($restaurantIdArr, $restaurantIdByOrderType);
		}

		if(is_array($restaurantIdByDistance) && count($restaurantIdByDistance) > 0) {
			$restaurantIdArr = ($restaurantIdArr + $restaurantIdByDistance);
			$restaurantIdArr = array_unique($restaurantIdArr);
		}

		//if(is_array($restaurantIdByCuisineType) && count($restaurantIdByCuisineType) > 0) {
		if(is_array($restaurantIdByCuisineType)) {
			$restaurantIdArr 	= array_intersect($restaurantIdArr, $restaurantIdByCuisineType);
		}

		//if(is_array($restaurantIdByFeature) && count($restaurantIdByFeature) > 0) {
		if(is_array($restaurantIdByFeature)) {
			$restaurantIdArr 	= array_intersect($restaurantIdArr, $restaurantIdByFeature);
		}

		//if(is_array($restaurantIdByPrice) && count($restaurantIdByPrice) > 0) {
		if(is_array($restaurantIdByPrice)) {
			$restaurantIdArr 	= array_intersect($restaurantIdArr, $restaurantIdByPrice);
		}

		//if(is_array($restaurantIdByPaymethod) && count($restaurantIdByPaymethod) > 0) {
		if(is_array($restaurantIdByPaymethod)) {
			$restaurantIdArr 	= array_intersect($restaurantIdArr, $restaurantIdByPaymethod);
		}

		if(count($restaurantIdArr) > 0) {
			$restaurant_ids 	= implode(",", array_keys(array_flip($restaurantIdArr)));
			//echo $restaurant_ids;
			return $restaurant_ids;
		} else {
			return false;
		}
	}

	// Function for manager restaurant array
	function fun_getManagerRestaurantArr($user_id){
		$sql = "SELECT A.rest_id, B.rest_name FROM " . TABLE_RESTAURANT_MANAGER_RELATIONS . " AS A  INNER JOIN " . TABLE_RESTAURANT . " AS B ON A.rest_id = B.rest_id WHERE A.manager_id='".$user_id."' ORDER BY A.rest_id";
		$rs = $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0) {
			return $arr = $this->dbObj->fetchAssoc($rs);
		} else {
			return false;
		}
	}

	// This function will Return Restaurant Menu Photos
	function fun_getRestMenuPhotos($rest_id){
		$sql = "SELECT * FROM " . TABLE_RESTAURANT_MENU_PHOTO . " WHERE rest_id ='".(int)$rest_id."' ORDER BY photo_order";
		$rs = $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0) {
			return $arr = $this->dbObj->fetchAssoc($rs);
		} else {
			return false;
		}
	}

	// Function	for add restaurant menu photos
	function fun_addRestMenuPhotos($rest_id){
		if($rest_id == ''){
			return false;
		} else {
			$photo_caption 		= $_POST['photo_caption'];
			$photo_url 			= "";
			$photo_thumb 		= "";
			$cur_unixtime 		= time ();
			if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_admin_id'];
			} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_modarator_id'];
			} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_user_id'];
			} else {
				$cur_user_id 	= "";
			}

			$photo_order = $this->dbObj->getField(TABLE_RESTAURANT_MENU_PHOTO, "rest_id", $rest_id, "MAX(photo_order)");
			if(isset($photo_order) && $photo_order != "") {
				$photo_order = ($photo_order+1);
			} else {
				$photo_order = "1";
			}
			$field_names  	= array("rest_id", "photo_caption", "photo_url", "photo_thumb", "photo_order", "created_on", "created_by", "updated_on", "updated_by");
			$field_values 	= array($rest_id, fun_db_input($photo_caption), $photo_url, $photo_thumb, $photo_order, $cur_unixtime, $cur_user_id, $cur_unixtime, $cur_user_id);
			$this->dbObj->insertFields(TABLE_RESTAURANT_MENU_PHOTO, $field_names, $field_values);
			$photo_id 		= $this->dbObj->getIdentity();
			return $photo_id;
		}
	}

	// Function	for updating restaurant menu photos
	function fun_updateRestMenuPhotos($rest_id, $photo_id, $photo_caption = '', $photo_main = '', $photo_thumb = ''){
		if($rest_id == '' || $photo_id == ''){
			return false;
		} else {
			$strUpdateQuery = "UPDATE " . TABLE_RESTAURANT_MENU_PHOTO . " SET photo_caption='".$photo_caption."', photo_url='".$photo_main."', photo_thumb='".$photo_thumb."' WHERE photo_id='".(int)$photo_id."' AND rest_id='".(int)$rest_id."'";
			$this->dbObj->mySqlSafeQuery($strUpdateQuery);
			return true;
		}
	}

	function fun_delRestMenuPhotoById($photo_id = ''){
		if($photo_id == ''){
			return false;
		} else {
            $this->dbObj->deleteRow(TABLE_RESTAURANT_MENU_PHOTO, "photo_id", $photo_id);
			return true;
		}
	}

	// This function will Return Restaurant Menu PDF
	function fun_getRestMenuPDF($rest_id){
		$sql = "SELECT * FROM " . TABLE_RESTAURANT_MENU_PDF . " WHERE rest_id ='".(int)$rest_id."'";
		$rs = $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0) {
			return $arr = $this->dbObj->fetchAssoc($rs);
		} else {
			return false;
		}
	}

	// Function	for add restaurant menu PDF
	function fun_addRestMenuPDF($rest_id){
		if($rest_id == ''){
			return false;
		} else {
			$pdf_caption 		= $_POST['photo_caption'];
			$pdf_url 			= "";
			$cur_unixtime 		= time ();
			if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_admin_id'];
			} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_modarator_id'];
			} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_user_id'];
			} else {
				$cur_user_id 	= "";
			}

			$field_names  	= array("rest_id", "pdf_caption", "pdf_url", "created_on", "created_by", "updated_on", "updated_by");
			$field_values 	= array($rest_id, fun_db_input($pdf_caption), $pdf_url, $cur_unixtime, $cur_user_id, $cur_unixtime, $cur_user_id);
			$this->dbObj->insertFields(TABLE_RESTAURANT_MENU_PDF, $field_names, $field_values);
			$pdf_id 		= $this->dbObj->getIdentity();
			return $pdf_id;
		}
	}

	// Function	for updating restaurant menu PDF
	function fun_updateRestMenuPDF($rest_id, $pdf_id, $pdf_caption = '', $pdf_url = ''){
		if($rest_id == '' || $pdf_id == ''){
			return false;
		} else {
			$strUpdateQuery = "UPDATE " . TABLE_RESTAURANT_MENU_PDF . " SET pdf_caption='".$pdf_caption."', pdf_url='".$pdf_url."' WHERE pdf_id='".(int)$pdf_id."' AND rest_id='".(int)$rest_id."'";
			$this->dbObj->mySqlSafeQuery($strUpdateQuery);
			return true;
		}
	}

	function fun_delRestMenuPDFById($pdf_id = ''){
		if($pdf_id == ''){
			return false;
		} else {
            $this->dbObj->deleteRow(TABLE_RESTAURANT_MENU_PDF, "pdf_id", $pdf_id);
			return true;
		}
	}

	//Function to create refine cuisines section: Start here
	function fun_createRefineCuisineHTML() {
		$strHTML 		= '';
		$sql 			= "SELECT * FROM " . TABLE_CUISINES . " WHERE cuisines_id NOT IN (29,21,30,13,67) ORDER BY cuisines_name";
		$rs 			= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			//print_r($arr);
			//$strHTML .= '<span class="red"><strong>Cuisines</strong></span>';
			$strHTML .= '<table width="100%" border="0" cellpadding="2" cellspacing="0" class="font12">';
			for($i=4; $i < count($arr); $i=$i+4) {
				$strHTML 	.= '<tr>';
				$strHTML 	.= '<td align="left" valign="top"><input type="checkbox" name="cuisine_type['.$arr[$i]['cuisines_id'].']" id="cuisine_type_id'.($arr[$i]['cuisines_id']).'" value="'.$arr[$i]['cuisines_id'].'" class="checkbox" onclick="chkNonMutualCriteria(\'cuisinesids\', this.id, this.value);void(0);"></td>';
				$strHTML 	.= '<td align="left" valign="top"><label for="cuisine_type_id'.($arr[$i]['cuisines_id']).'" style="margin:0px; padding:0px; width:70px;text-align:left;font-size:11px;">'.ucwords($arr[$i]['cuisines_name']).'</label></td>';
				$strHTML 	.= '<td align="left" valign="top" width="16px">&nbsp;</td>';
				if(isset($arr[$i+1]['cuisines_id']) && $arr[$i+1]['cuisines_id'] !="") {
				$strHTML 	.= '<td align="left" valign="top"><input type="checkbox" name="cuisine_type['.$arr[$i+1]['cuisines_id'].']" id="cuisine_type_id'.($arr[$i+1]['cuisines_id']).'" value="'.$arr[$i+1]['cuisines_id'].'" class="checkbox" onclick="chkNonMutualCriteria(\'cuisinesids\', this.id, this.value);void(0);"></td>';
				$strHTML 	.= '<td align="left" valign="top"><label for="cuisine_type_id'.($arr[$i+1]['cuisines_id']).'" style="margin:0px; padding:0px; width:70px;text-align:left;font-size:11px;">'.ucwords($arr[$i+1]['cuisines_name']).'</label></td>';
				$strHTML 	.= '<td align="left" valign="top" width="16px">&nbsp;</td>';
				}
				if(isset($arr[$i+2]['cuisines_id']) && $arr[$i+2]['cuisines_id'] !="") {
				$strHTML 	.= '<td align="left" valign="top"><input type="checkbox" name="cuisine_type['.$arr[$i+2]['cuisines_id'].']" id="cuisine_type_id'.($arr[$i+2]['cuisines_id']).'" value="'.$arr[$i+2]['cuisines_id'].'" class="checkbox" onclick="chkNonMutualCriteria(\'cuisinesids\', this.id, this.value);void(0);"></td>';
				$strHTML 	.= '<td align="left" valign="top"><label for="cuisine_type_id'.($arr[$i+2]['cuisines_id']).'" style="margin:0px; padding:0px; width:70px;text-align:left;font-size:11px;">'.ucwords($arr[$i+2]['cuisines_name']).'</label></td>';
				$strHTML 	.= '<td align="left" valign="top" width="16px">&nbsp;</td>';
				}
				if(isset($arr[$i+3]['cuisines_id']) && $arr[$i+3]['cuisines_id'] !="") {
				$strHTML 	.= '<td align="left" valign="top"><input type="checkbox" name="cuisine_type['.$arr[$i+3]['cuisines_id'].']" id="cuisine_type_id'.($arr[$i+3]['cuisines_id']).'" value="'.$arr[$i+3]['cuisines_id'].'" class="checkbox" onclick="chkNonMutualCriteria(\'cuisinesids\', this.id, this.value);void(0);"></td>';
				$strHTML 	.= '<td align="left" valign="top"><label for="cuisine_type_id'.($arr[$i+3]['cuisines_id']).'" style="margin:0px; padding:0px; width:70px;text-align:left;font-size:11px;">'.ucwords($arr[$i+3]['cuisines_name']).'</label></td>';
				$strHTML 	.= '<td align="left" valign="top" width="16px">&nbsp;</td>';
				}
				$strHTML 	.= '</tr>';
			}
			//$strHTML 	.= '<tr><td align="left" valign="top" colspan="2"><a href="'.SITE_URL.'includes/ajax/get-refine-cuisines-items-Ajax.php" class="blue refine-list-item">more...</a></td></tr>';
			$strHTML .= '</table>';
		}
		echo $strHTML;
	}
	//Function to create refine cuisines section: Start here

	//Function to create refine cuisines section: Start here
	function fun_createRefineCuisineView() {
		$strHTML 		= '';
		$sql 			= "SELECT * FROM " . TABLE_CUISINES . " WHERE cuisines_id IN (29,21,30,13,67) ORDER BY cuisines_name LIMIT 0, 4";
		$rs 			= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			//print_r($arr);
			$strHTML .= '<span class="red"><strong>Cuisines</strong></span>';
			$strHTML .= '<table width="100%" border="0" cellpadding="2" cellspacing="0" class="pad-top5">';
			for($i=0; $i < count($arr); $i++) {
				$strHTML 	.= '<tr>';
				$strHTML 	.= '<td align="left" valign="top"><input type="checkbox" name="cuisine_type['.$arr[$i]['cuisines_id'].']" id="cuisine_type_id'.($arr[$i]['cuisines_id']).'" value="'.$arr[$i]['cuisines_id'].'" class="checkbox" onclick="chkNonMutualCriteria(\'cuisinesids\', this.id, this.value);refineCriteria();void(0);"></td>';
				$strHTML 	.= '<td align="left" valign="top"><label for="cuisine_type_id'.($arr[$i]['cuisines_id']).'" style="margin:0px; padding:0px; width:70px;text-align:left;font-size:11px;">'.ucwords($arr[$i]['cuisines_name']).'</label></td>';
				$strHTML 	.= '</tr>';
			}
			$strHTML .= '<tr><td align="left" valign="top" colspan="2"><a href="'.SITE_URL.'includes/ajax/get-refine-cuisines-items-Ajax.php" class="blue refine-list-item">more...</a></td></tr>';
			$strHTML .= '</table>';
		}
		echo $strHTML;
	}
	//Function to create refine cuisines section: Start here

	//Function to create refine feature section: Start here
	function fun_createRefineFeatureHTML() {
		$strHTML 		= '';
		$sql 			= "SELECT * FROM " . TABLE_FEATURES . " WHERE feature_id NOT IN (1,2,6,7,8) ORDER BY feature_name";
		$rs 			= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			//print_r($arr);
			//$strHTML .= '<span class="red"><strong>Feature</strong></span>';
			$strHTML .= '<table width="100%" border="0" cellpadding="2" cellspacing="0" class="font12">';
			for($i=0; $i < count($arr); $i=$i+4) {
				$strHTML 	.= '<tr>';
				$strHTML 	.= '<td align="left" valign="top"><input type="checkbox" name="rest_feature['.$arr[$i]['feature_id'].']" id="rest_feature_id'.($arr[$i]['feature_id']).'" value="'.$arr[$i]['feature_id'].'" class="checkbox" onclick="chkNonMutualCriteria(\'featureids\', this.id, this.value);void(0);"></td>';
				$strHTML 	.= '<td align="left" valign="top"><label for="rest_feature_id'.($arr[$i]['feature_id']).'" style="margin:0px; padding:0px; width:110px;text-align:left;font-size:11px;">'.ucwords($arr[$i]['feature_name']).'</label></td>';
				$strHTML 	.= '<td align="left" valign="top" width="16px">&nbsp;</td>';
				if(isset($arr[$i+1]['feature_id']) && $arr[$i+1]['feature_id'] !="") {
				$strHTML 	.= '<td align="left" valign="top"><input type="checkbox" name="rest_feature['.$arr[$i+1]['feature_id'].']" id="rest_feature_id'.($arr[$i+1]['feature_id']).'" value="'.$arr[$i+1]['feature_id'].'" class="checkbox" onclick="chkNonMutualCriteria(\'featureids\', this.id, this.value);void(0);"></td>';
				$strHTML 	.= '<td align="left" valign="top"><label for="rest_feature_id'.($arr[$i+1]['feature_id']).'" style="margin:0px; padding:0px; width:110px;text-align:left;font-size:11px;">'.ucwords($arr[$i+1]['feature_name']).'</label></td>';
				$strHTML 	.= '<td align="left" valign="top" width="16px">&nbsp;</td>';
				}
				if(isset($arr[$i+2]['feature_id']) && $arr[$i+2]['feature_id'] !="") {
				$strHTML 	.= '<td align="left" valign="top"><input type="checkbox" name="rest_feature['.$arr[$i+2]['feature_id'].']" id="rest_feature_id'.($arr[$i+2]['feature_id']).'" value="'.$arr[$i+2]['feature_id'].'" class="checkbox" onclick="chkNonMutualCriteria(\'featureids\', this.id, this.value);void(0);"></td>';
				$strHTML 	.= '<td align="left" valign="top"><label for="rest_feature_id'.($arr[$i+2]['feature_id']).'" style="margin:0px; padding:0px; width:110px;text-align:left;font-size:11px;">'.ucwords($arr[$i+2]['feature_name']).'</label></td>';
				$strHTML 	.= '<td align="left" valign="top" width="16px">&nbsp;</td>';
				}
				if(isset($arr[$i+3]['feature_id']) && $arr[$i+3]['feature_id'] !="") {
				$strHTML 	.= '<td align="left" valign="top"><input type="checkbox" name="rest_feature['.$arr[$i+3]['feature_id'].']" id="rest_feature_id'.($arr[$i+3]['feature_id']).'" value="'.$arr[$i+3]['feature_id'].'" class="checkbox" onclick="chkNonMutualCriteria(\'featureids\', this.id, this.value);void(0);"></td>';
				$strHTML 	.= '<td align="left" valign="top"><label for="rest_feature_id'.($arr[$i+3]['feature_id']).'" style="margin:0px; padding:0px; width:110px;text-align:left;font-size:11px;">'.ucwords($arr[$i+3]['feature_name']).'</label></td>';
				$strHTML 	.= '<td align="left" valign="top" width="16px">&nbsp;</td>';
				}
				$strHTML 	.= '</tr>';
			}
			$strHTML .= '</table>';
		}
		echo $strHTML;
	}
	//Function to create refine feature section: End here

	//Function to create refine feature section: Start here
	function fun_createRefineFeatureView() {
		$strHTML 		= '';
		$sql 			= "SELECT * FROM " . TABLE_FEATURES . " WHERE feature_id IN (1,2,6,7,8) ORDER BY feature_name LIMIT 0, 4";
		$rs 			= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			//print_r($arr);
			$strHTML .= '<span class="red"><strong>Feature</strong></span>';
			$strHTML .= '<table width="100%" border="0" cellpadding="2" cellspacing="0" class="pad-top5">';
			for($i=0; $i < count($arr); $i++) {
				$strHTML 	.= '<tr>';
				$strHTML 	.= '<td align="left" valign="top"><input type="checkbox" name="rest_feature['.$arr[$i]['feature_id'].']" id="rest_feature_id'.($arr[$i]['feature_id']).'" value="'.$arr[$i]['feature_id'].'" class="checkbox" onclick="chkNonMutualCriteria(\'featureids\', this.id, this.value);refineCriteria();void(0);"></td>';
				$strHTML 	.= '<td align="left" valign="top"><label for="rest_feature_id'.($arr[$i]['feature_id']).'" style="margin:0px; padding:0px; width:70px;text-align:left;font-size:11px;">'.ucwords($arr[$i]['feature_name']).'</label></td>';
				$strHTML 	.= '</tr>';
			}
			$strHTML .= '<tr><td align="left" valign="top" colspan="2"><a href="'.SITE_URL.'includes/ajax/get-refine-feature-items-Ajax.php" class="blue refine-list-item">more...</a></td></tr>';
			$strHTML .= '</table>';
		}
		echo $strHTML;
	}
	//Function to create refine feature section: End here

/*
* Restaurant functions : End here
*/

/*
* Menus Functions: Start Here
*/

	// Function for Menu info	
	function fun_getMenuInfoById($menu_id){
		$sql 		= "SELECT * FROM " . TABLE_MENU . " AS A WHERE A.menu_id='".$menu_id."'";
		$rs 		= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			return $arr[0];
		} else {
			return false;
		}
	}

	// Function for menu array
	function fun_getMenusArr($parameter=''){
		$sql = "SELECT 	A.menu_id, 
						A.rest_id,
						A.category_id, 
						A.menu_name,
						A.menu_desc,
						A.active
				FROM " . TABLE_MENU . " AS A ";

		if($parameter!=""){
			$sql .= $parameter;
		} else{
			$sql .= " ORDER BY A.menu_id";		
		}
		return $rs = $this->dbObj->createRecordset($sql);
	}

    //Add a new Menu
	function fun_addMenu($rest_id, $category_id, $menu_name, $menu_desc ='', $active =''){
		if($rest_id == '' || $category_id == '' || $menu_name == '') {
			return false;
		} else {
			$cur_unixtime 		= time ();
			if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_admin_id'];
			} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_modarator_id'];
			} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_user_id'];
			} else {
				$cur_user_id 	= "";
			}
	
			$field_names 		= array("rest_id", "category_id", "menu_name", "menu_desc", "created_on", "created_by", "updated_on", "updated_by", "active");
			$field_values 		= array($rest_id, $category_id, fun_db_input($menu_name), fun_db_input($menu_desc), $cur_unixtime, $cur_user_id, $cur_unixtime, $cur_user_id, $active);
			$this->dbObj->insertFields(TABLE_MENU, $field_names, $field_values);
			$menu_id 			= $this->dbObj->getIdentity();
			return $menu_id;
		}
	}
	
	function fun_editMenu($menu_id){
		if($menu_id == "") {
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

			//Upadate updated by, updated on
			$sqlUpdate = "UPDATE " . TABLE_MENU . " SET updated_on='" . $cur_unixtime . "', updated_by='" . $cur_user_id . "' WHERE menu_id='".(int)$menu_id."'";
			$this->dbObj->mySqlSafeQuery($sqlUpdate);

			// Updates from details page
			if($_POST['securityKey'] == md5('EDITMENU')){
				// Step I : if general details available update it
				$menu_id        = $_POST['menu_id'];
				$rest_id        = $_POST['rest_id'];
				$category_id 	= $_POST['category_id'];
				$menu_name 	    = $_POST['menu_name'];
				$menu_desc 	    = $_POST['menu_desc'];
				$active 	    = $_POST['active'];

				$menuArray = array(							
					"rest_id" 		=> $rest_id,
					"category_id" 	=> $category_id,
					"menu_name" 	=> $menu_name,
					"menu_desc" 	=> $menu_desc,
					"updated_on" 	=> $cur_unixtime,
					"updated_on" 	=> $cur_user_id,
					"active" 		=> $active
				);
		
				$fields = "";
				foreach($menuArray as $keys => $vals){
					$fields .= $keys . "='" . fun_db_input($vals). "', ";
				}
				if($fields!=""){
					$fields = substr($fields,0,strlen($fields)-2);
					$sqlUpdate = "UPDATE " . TABLE_MENU . " SET " . $fields . " WHERE menu_id='".(int)$menu_id."'";
					$this->dbObj->mySqlSafeQuery($sqlUpdate);
				}
			}
			return true;
		}
	}

	// This function will Return currency info of restaurant
	function fun_getRestaurantCurrencyInfo($rest_id) {
		if($rest_id !=""){
			$currency_id = $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "currency_id");
			$sql 	= "SELECT * FROM " . TABLE_CURRENCIES . " WHERE currency_id='".$currency_id."'";
			$rs 	= $this->dbObj->createRecordset($sql);
			$arr 	= $this->dbObj->fetchAssoc($rs);
			return $arr[0];
		} else {
			global $ipcountry;
			if(isset($ipcountry) && ($ipcountry == "IND")) {
				$currency_id = '4';
			} else {
				$currency_id = '5';
			}

			$sql 	= "SELECT * FROM " . TABLE_CURRENCIES . " WHERE currency_id='".$currency_id."'";
			$rs 	= $this->dbObj->createRecordset($sql);
			$arr 	= $this->dbObj->fetchAssoc($rs);
			return $arr[0];
		}
	}

	// Function for Menu Option Info
	function fun_getMenuOptionInfoById($option_id){
		$sql 		= "SELECT * FROM " . TABLE_MENU_OPTION . " AS A WHERE A.option_id='".$option_id."'";
		$rs 		= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			return $arr[0];
		} else {
			return false;
		}
	}

	// Function for menu option array
	function fun_getMenuOptionArr($parameter = ''){
		$sql = "SELECT * FROM " . TABLE_MENU_OPTION . " AS A";
		if($parameter != ""){
			$sql .= $parameter;
		} else {
			$sql .= " ORDER BY A.option_name DESC";		
		}
		return $rs = $this->dbObj->createRecordset($sql);
	}

	// Function for Menu Option add
	function fun_addOption($category_id, $option_name) {
		if($category_id == '' || $option_name == '') {
			return false;
		} else {
			$strInsQuery = "INSERT INTO " . TABLE_MENU_OPTION . " (option_id, category_id, option_name) VALUES(null, '".$category_id."', '".fun_db_input($option_name)."')";
			$this->dbObj->mySqlSafeQuery($strInsQuery);
			return $this->dbObj->getIdentity();
		}
	}

	// Function for Menu Option edit
	function fun_editOption($option_id, $category_id, $option_name) {
		if($option_id == '' || $category_id == '' || $option_name == '') {
			return false;
		} else {
			$sqlUpdateQuery = "UPDATE " . TABLE_MENU_OPTION . " SET option_name = '".fun_db_input($option_name)."' WHERE category_id='".$category_id."' AND option_id='".$option_id."' ";
            $this->dbObj->mySqlSafeQuery($sqlUpdateQuery);
            return true;
		}
	}

	// Function for deleting menu: End Here
	function fun_delMenu($menu_id){
			if($menu_id == ''){
			return false;
		} else {
			// Delete from TABLE_MENU
			$strDelQuery = "DELETE FROM " . TABLE_MENU . " WHERE menu_id='".$menu_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations
			return true;
		}
	}
	// Function for deleting menu: End Here


	// Function for Menu Option Category add
	function fun_addOptionCategory($category_name, $menu_catids, $display_type) {
		if($category_name == '') {
			return false;
		} else {
			$strInsQuery = "INSERT INTO " . TABLE_MENU_OPTION_CATEGORY . " (category_id, category_name,  display_type, menu_catids) VALUES(null, '".fun_db_input($category_name)."', '".$display_type."', '".implode(",", $menu_catids)."')";
			$this->dbObj->mySqlSafeQuery($strInsQuery);
			return $this->dbObj->getIdentity();
		}
	}

	// Function for Menu Option Category edit
	function fun_editOptionCategory($category_id, $category_name, $menu_catids, $display_type) {
		if($category_id == '' || $category_name == '') {
			return false;
		} else {
 			$sqlUpdateQuery = "UPDATE " . TABLE_MENU_OPTION_CATEGORY . " SET category_name = '".fun_db_input($category_name)."', display_type = '".$display_type."', menu_catids = '".implode(",", $menu_catids)."' WHERE category_id='".$category_id."'";
            $this->dbObj->mySqlSafeQuery($sqlUpdateQuery);
            return true;
		}
	}
	// Function for creating optionlist for menu categories if category_id is available it must be selected multiple
	function fun_getMenuOptionMenuCategoryOptionsList($category_ids='', $queryparameters=''){
		$category_idsArr = explode(",", $category_ids);
		$selected 	= "";
		$sql 		= "SELECT * FROM " . TABLE_MENU_CATEGORY. " ";
		if($queryparameters !=""){
			$sql .= " ".$queryparameters." ";
		} else {
			$sql .= " ORDER BY category_pid, category_name";
		}
		$result = $this->dbObj->fun_db_query($sql);
		while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result)){
			if(is_array($category_idsArr) && (array_search($rowsCon->category_id, $category_idsArr) !== false)){
				$selected 	= "selected";
				$style 		= "style=\"background:#ccc;\"";
			} else {
				$selected 	= "";
				$style 		= "";
			}
			echo "<option value=\"".fun_db_output($rowsCon->category_id)."\" " .$style. " " .$selected. ">";
			if(isset($rowsCon->category_pid) && $rowsCon->category_pid =="0") {
				echo '<strong>'.fun_db_output(ucwords($rowsCon->category_name)).'</strong>';
			} else {
				$category_pname = $this->fun_getMenuCategoryNameById($rowsCon->category_pid);
				echo '<strong>'.ucwords($category_pname).'</strong>&nbsp;&nbsp;&gt;&gt;&nbsp;&nbsp;'.fun_db_output(ucwords($rowsCon->category_name));
			}
			echo "</option>\n";
		}
		$this->dbObj->fun_db_free_resultset($result);
	}

	// Function for Menu Option Category Info
	function fun_getMenuOptionCategoryInfoById($category_id){
		$sql 		= "SELECT * FROM " . TABLE_MENU_OPTION_CATEGORY . " AS A WHERE A.category_id='".$category_id."'";
		$rs 		= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			return $arr[0];
		} else {
			return false;
		}
	}

	// Function for menu option category array
	function fun_getMenuOptionCategoryArr($parameter = ''){
		$sql = "SELECT * FROM " . TABLE_MENU_OPTION_CATEGORY . " AS A";
		if($parameter != ""){
			$sql .= $parameter;
		} else {
			$sql .= " ORDER BY A.category_id DESC";		
		}
		return $rs = $this->dbObj->createRecordset($sql);
	}

	//function for get menu option category name: Start Here
	function fun_getMenuOptionCategoryNameById($category_id = '') {
		if($category_id == '') {
			return false;
		} else {
			return $this->dbObj->getField(TABLE_MENU_OPTION_CATEGORY, "category_id", $category_id, "category_name");
		}
	}
	//function for get menu option category name: End Here

	// Function for Menu Category add
	function fun_addMenuCategory($category_pid, $category_name) {
		if($category_pid == '' ||  $category_name == '') {
			return false;
		} else {
			$strInsQuery = "INSERT INTO " . TABLE_MENU_CATEGORY . " (category_id, category_pid, category_name) VALUES(null, '".$category_pid."', '".fun_db_input($category_name)."')";
			$this->dbObj->mySqlSafeQuery($strInsQuery);
			return $this->dbObj->getIdentity();
		}
	}

	// Function for Menu Category edit
	function fun_editMenuCategory($category_id, $category_pid, $category_name) {
		if($category_id == '') {
			return false;
		} else {
			$sqlUpdateQuery = "UPDATE " . TABLE_MENU_CATEGORY . " SET category_pid = '".$category_pid."', category_name = '".fun_db_input($category_name)."' WHERE category_id='".$category_id."'";
            $this->dbObj->mySqlSafeQuery($sqlUpdateQuery);
            return true;
		}
	}

	// Function for Menu Category Info
	function fun_getMenuCategoryInfoById($category_id){
		$sql 		= "SELECT * FROM " . TABLE_MENU_CATEGORY . " AS A WHERE A.category_id='".$category_id."'";
		$rs 		= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			return $arr[0];
		} else {
			return false;
		}
	}

	// Function for creating optionlist for menu categories if category_id is available it must be selected
	function fun_getMenuCategoryOptionsList($category_id='', $queryparameters=''){		
		$selected 	= "";
		$sql 		= "SELECT * FROM " . TABLE_MENU_CATEGORY. " ";
		if($queryparameters !=""){
			$sql .= " ".$queryparameters." ";
		} else {
			$sql .= " ORDER BY category_name";
		}
		$result = $this->dbObj->fun_db_query($sql);
		while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result)){
			if($rowsCon->category_id == $category_id  && $category_id!=''){
				$selected = "selected";
			} else {
				$selected = "";
			}
			echo "<option value=\"".fun_db_output($rowsCon->category_id)."\" " .$selected. ">";
			echo fun_db_output(ucwords($rowsCon->category_name));
			echo "</option>\n";
		}
		$this->dbObj->fun_db_free_resultset($result);
	}

	// Function for menu category array
	function fun_getMenuCategoryArr($parameter = ''){
		$sql = "SELECT * FROM " . TABLE_MENU_CATEGORY . " AS A";
		if($parameter != ""){
			$sql .= $parameter;
		} else {
			$sql .= " ORDER BY A.category_pid, A.category_name DESC";		
		}
		return $rs = $this->dbObj->createRecordset($sql);
	}

	//function for get menu category name: Start Here
	function fun_getMenuCategoryNameById($category_id = '') {
		if($category_id == '') {
			return false;
		} else {
			return $this->dbObj->getField(TABLE_MENU_CATEGORY, "category_id", $category_id, "category_name");
		}
	}
	//function for get menu category name: End Here

	// Function for creating optionlist for menu category if category_id is available it must be selected
	function fun_getMenuCategoyChildParentOptionsList($category_id=''){		
		$selected 	= "";
		$sql1 		= "SELECT * FROM " . TABLE_MENU_CATEGORY. " ";
		$sql1 		.= " WHERE category_pid='0' ORDER BY category_pid, category_name";
		$result1 = $this->dbObj->fun_db_query($sql1);
		while($rowsCon1 = $this->dbObj->fun_db_fetch_rs_object($result1)){
			if($rowsCon1->category_id == $category_id  && $category_id!=''){
				$selected = "selected";
			} else {
				$selected = "";
			}
			echo "<option value=\"".fun_db_output($rowsCon1->category_id)."\" " .$selected. " disabled=\"disabled\">";
			echo "<strong>";
			echo fun_db_output(ucwords($rowsCon1->category_name));
			echo "</strong>";
			echo "</option>\n";
			$sql2 		= "SELECT * FROM " . TABLE_MENU_CATEGORY. " ";
			$sql2 		.= " WHERE category_pid='".$rowsCon1->category_id."'  ORDER BY category_name";
			$result2 = $this->dbObj->fun_db_query($sql2);
			while($rowsCon2 = $this->dbObj->fun_db_fetch_rs_object($result2)){
				if($rowsCon2->category_id == $category_id  && $category_id!=''){
					$selected = "selected";
				} else {
					$selected = "";
				}
				echo "<option value=\"".fun_db_output($rowsCon2->category_id)."\" " .$selected. ">";
				echo str_repeat("-", 2)."&nbsp;";
				echo fun_db_output(ucwords($rowsCon2->category_name));
				echo "</option>\n";
			}
		}
		$this->dbObj->fun_db_free_resultset($result1);
		$this->dbObj->fun_db_free_resultset($result2);
	}

	// Function	for updating Menu Photo
	function fun_editMenuPhoto($menu_id, $photo_thumb, $photo_caption){
		if($menu_id == '' || $photo_thumb == '' || $photo_caption == ''){
			return false;
		} else {
			$cur_unixtime 		= time ();
			if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !="") {
				$cur_user_id 	= $_SESSION['ses_admin_id'];
			} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_modarator_id'];
			} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !="") {
				$cur_user_id 	= $_SESSION['ses_user_id'];
			} else {
				$cur_user_id 	= "";
			}

			$strUpdateQuery = "UPDATE " . TABLE_MENU . " SET photo_thumb='".$photo_thumb."', photo_caption='".$photo_caption."' WHERE menu_id='".(int)$menu_id."'";
			$this->dbObj->mySqlSafeQuery($strUpdateQuery);
			return true;
		}
	}

	//Add New Menu Item
	function fun_addMenuItem($menu_id , $rest_id, $item_name, $menu_catid, $item_prices, $item_desc){
		if($item_name == '') {
			return false;
		} else {
			$active = "0";
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
	
			$field_names 		= array("menu_id", "rest_id","item_name", "menu_catid", "item_prices", "item_desc", "created_on", "created_by", "updated_on", "updated_by", "active");
			$field_values 		= array($menu_id , $rest_id, $item_name, $menu_catid, $item_prices, $item_desc, $cur_unixtime, $cur_user_id, $cur_unixtime, $cur_user_id, $active);
			$this->dbObj->insertFields(TABLE_MENU_ITEM_RELATION, $field_names, $field_values);
			$item_id 			= $this->dbObj->getIdentity();
			return $item_id;
		}
	}

	function fun_editMenuPrice($menu_id){
		if($menu_id == "") {
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

			// Updates from details page
			if($_POST['securityKey'] == md5('EDITMENUPRICE')){
				// Step I : if general details available update it
				//print_r($_POST);
				$menu_id        	= $_POST['menu_id'];
				$rest_id        	= $_POST['rest_id'];
				$base_price 		= $_POST['base_price'];
				$base_price_enabled = $_POST['base_price_enabled'];
				$currency_id 		= $_POST['currency_id'];
				$quantity_id 		= $_POST['quantity_id'];
				$options_category 	= $_POST['options_category'];
				$options 	    	= $_POST['options'];
				$options_value 	    = $_POST['options_value'];
				if(is_array($options) && !empty($options)) {
					$option_ids = implode(",", $options);
				}
				
				$prices 	    	= $_POST['prices'];
				$prices_value 	    = $_POST['prices_value'];
				if(is_array($prices) && !empty($prices)) {
					$price_ids = implode(",", $prices);
				}

				//Step I: update menu base_price & currency_id
				//Upadate base_price, currency, updated by, updated on
				$sqlUpdate = "UPDATE " . TABLE_MENU . " SET base_price='" . $base_price . "', currency_id='" . $currency_id . "', quantity_id='" . $quantity_id . "', updated_on='" . $cur_unixtime . "', updated_by='" . $cur_user_id . "' WHERE menu_id='".(int)$menu_id."'";
				$this->dbObj->mySqlSafeQuery($sqlUpdate);
	
				//Step II: delete old data of menu option
				$strDelOptionQuery = "DELETE FROM " . TABLE_MENU_OPTION_RELATION . " WHERE menu_id='".$menu_id."'";
				$this->dbObj->mySqlSafeQuery($strDelOptionQuery); // delete previous relations

				//Step II: delete old data of menu price
				$strDelOptionQuery = "DELETE FROM " . TABLE_MENU_PRICE_RELATION . " WHERE menu_id='".$menu_id."'";
				$this->dbObj->mySqlSafeQuery($strDelOptionQuery); // delete previous relations

				//Step III: update menu option
				if(is_array($options_category) && !empty($options_category)) {
					for($i=0; $i < count($options_category); $i++) {
						$category_id = $options_category[$i];
						$sql 	= "SELECT option_id FROM " . TABLE_MENU_OPTION . " WHERE category_id='".$category_id."' AND option_id IN (".$option_ids.")";
						$rs 	= $this->dbObj->createRecordset($sql);
						if($this->dbObj->getRecordCount($rs) > 0){
							$arr = $this->dbObj->fetchAssoc($rs);
							for($j=0; $j < count($arr); $j++) {
								if(isset($options_value[$arr[$j]['option_id']]) && $options_value[$arr[$j]['option_id']] != "") {
									//Insert it in TABLE_MENU_OPTION_RELATION
									$strInsQuery = "INSERT INTO " . TABLE_MENU_OPTION_RELATION . "(id, menu_id, option_id, price, created_on, created_by, updated_on, updated_by) ";
									$strInsQuery .= "VALUES(null, '".$menu_id."', '".$arr[$j]['option_id']."', '".$options_value[$arr[$j]['option_id']]."', '".$cur_unixtime."', '".$cur_user_id."', '".$cur_unixtime."', '".$cur_user_id."')";
									$this->dbObj->mySqlSafeQuery($strInsQuery);
								}
							}
						}
					}
				}

				//Step IV: update menu price
				if(is_array($prices_value) && !empty($prices_value) && $base_price_enabled !="1") {
					$sql 	= "SELECT price_id FROM " . TABLE_MENU_PRICE . " WHERE category_id='1' AND price_id IN (".$price_ids.")";
					$rs 	= $this->dbObj->createRecordset($sql);
					if($this->dbObj->getRecordCount($rs) > 0){
						$arr = $this->dbObj->fetchAssoc($rs);
						for($j=0; $j < count($arr); $j++) {
							if(isset($prices_value[$arr[$j]['price_id']]) && $prices_value[$arr[$j]['price_id']] != "") {
								//Insert it in TABLE_MENU_PRICE_RELATION
								$strInsQuery = "INSERT INTO " . TABLE_MENU_PRICE_RELATION . "(id, menu_id, price_id, price, created_on, created_by, updated_on, updated_by) ";
								$strInsQuery .= "VALUES(null, '".$menu_id."', '".$arr[$j]['price_id']."', '".$prices_value[$arr[$j]['price_id']]."', '".$cur_unixtime."', '".$cur_user_id."', '".$cur_unixtime."', '".$cur_user_id."')";
								$this->dbObj->mySqlSafeQuery($strInsQuery);
							}
						}
					}
				}

			}
			return true;
		}
	}

	// Function for menu price array by menu id
	function fun_getMenuPriceArrByMenuId($menu_id){
		if($menu_id == "") {
			return false;
		} else {
			$sql = "SELECT 	A.price_id, A.price, B.price_name FROM " . TABLE_MENU_PRICE_RELATION . " AS A 
			INNER JOIN " . TABLE_MENU_PRICE . " AS B ON A.price_id = B.price_id 
			WHERE A.menu_id='".$menu_id."' ORDER BY A.price_id";
			$rs = $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr = $this->dbObj->fetchAssoc($rs);
				return $arr;
			}
		}
	}

	//Function to create edit option section for menu
	function fun_createMenuEditOptionView($menu_id) {
		if($menu_id == ''){
			return false;
		} else {
			$arrAddedOptions 		= array(); // create array of added options
			$arrAddedOptionValues 	= array(); // create array of added option values
			$sql 	= "SELECT * FROM " . TABLE_MENU_OPTION_RELATION . " WHERE menu_id='".$menu_id."'";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr = $this->dbObj->fetchAssoc($rs);
				for($i=0; $i < count($arr); $i++) {
					if(isset($arr[$i]['price']) && $arr[$i]['price'] != "") {
						array_push($arrAddedOptions, $arr[$i]['option_id']);
						$arrAddedOptionValues[$arr[$i]['option_id']]= $arr[$i]['price'];
					}
				}
			}

			//Step II: get menu cat id and find option categories 
			$menu_catid 		= $this->dbObj->getField(TABLE_MENU, "menu_id", $menu_id, "category_id");
			$sqlMenuOptCat 		= "SELECT A.category_id, A.category_name FROM " . TABLE_MENU_OPTION_CATEGORY . " AS A  WHERE (A.menu_catids='".$menu_catid."') OR (A.menu_catids like '%,".$menu_catid.",%') OR (A.menu_catids like '".$menu_catid.",%') OR (A.menu_catids like '%,".$menu_catid."')";
			$rsMenuOptCat 		= $this->dbObj->createRecordset($sqlMenuOptCat);
			if($this->dbObj->getRecordCount($rsMenuOptCat) > 0) {
				$arrMenuOptCat 	= $this->dbObj->fetchAssoc($rsMenuOptCat);
				for($counter = 0; $counter < count($arrMenuOptCat); $counter++) {
					$category_id 	= $arrMenuOptCat[$counter]['category_id'];
					$category_name 	= $arrMenuOptCat[$counter]['category_name'];
					$display_type 	= $arrMenuOptCat[$counter]['display_type'];
				
					//Step II: create html code for menu options
					//For Add Extra 
					//check if this option opted
					$category_checked 	= false;
					$sqlchk 			= "SELECT A.option_id, B.category_id  FROM " . TABLE_MENU_OPTION . " AS A
					INNER JOIN " . TABLE_MENU_OPTION_CATEGORY . " AS B ON B.category_id = A.category_id
					WHERE A.option_id IN (SELECT option_id  FROM " . TABLE_MENU_OPTION_RELATION . ") AND B.category_id='".$category_id."'";
					$rschk 				= $this->dbObj->createRecordset($sqlchk);
					if($this->dbObj->getRecordCount($rschk) > 0){
						$category_checked 	= true;
					}
					
					echo '<p>';
					echo '<label>'.ucwords($category_name).'</label>';
					if($category_checked == true) {
						echo '<input type="checkbox" name="options_category[]" id="options_category_id'.$category_id.'" value="'.$category_id.'" checked="checked" style="width:13px; height:13px; margin-top:22px;" /><br />';
					} else {
						echo '<input type="checkbox" name="options_category[]" id="options_category_id'.$category_id.'" value="'.$category_id.'" style="width:13px; height:13px; margin-top:22px;" /><br />';
					}
					echo '<div class="list-1" style="width:500px; margin-left:144px; margin-top:10px; border:thin #CCCCCC solid; padding:5px;">';
					echo '<table width="500" border="0" cellpadding="0" cellspacing="0" class="dyn-row">';
					echo '<tr>';
					echo '<td width="30px" class="pad-top5 pad-lft5 pad-btm5"><strong>Add</strong></td>';
					echo '<td width="120px" class="pad-top5 pad-lft5 pad-btm5"><strong>Options</strong></td>';
					echo '<td class="pad-top5 pad-lft5 pad-btm5"><strong>Price</strong></td>';
					echo '</tr>';
		
					$sql 		= "SELECT A.option_id, A.option_name  FROM " . TABLE_MENU_OPTION . " AS A WHERE A.category_id='".$category_id."'";
					$rs 		= $this->dbObj->createRecordset($sql);
					if($this->dbObj->getRecordCount($rs) > 0){
						$arr 	= $this->dbObj->fetchAssoc($rs);
						for($j=0; $j < count($arr); $j++) {
							if(array_search($arr[$j]['option_id'], $arrAddedOptions) === false){
								echo '<tr>';
								echo '<td align="center" valign="middle"><input type="checkbox" name="options[]" id="add_extra_id'.$arr[$j]['option_id'].'" value="'.$arr[$j]['option_id'].'" style="width:13px; height:13px;" /></td>';
								echo '<td align="left" valign="middle" class="pad-lft5 pad-top10">'.ucwords($arr[$j]['option_name']).'</td>';
								echo '<td align="left" valign="middle" class="pad-lft5 pad-btm5"><input type="text" name="options_value['.$arr[$j]['option_id'].']" id="options_value_id'.$arr[$j]['option_id'].'" value="" style="width:45px;" />$</td>';
								echo '</tr>';
							} else {
								echo '<tr>';
								echo '<td align="center" valign="middle"><input type="checkbox" name="options[]" id="add_extra_id'.$arr[$j]['option_id'].'" value="'.$arr[$j]['option_id'].'" checked="checked" style="width:13px; height:13px;" /></td>';
								echo '<td align="left" valign="middle" class="pad-lft5 pad-top10">'.ucwords($arr[$j]['option_name']).'</td>';
								echo '<td align="left" valign="middle" class="pad-lft5 pad-btm5"><input type="text" name="options_value['.$arr[$j]['option_id'].']" id="options_value_id'.$arr[$j]['option_id'].'" value="'.$arrAddedOptionValues[$arr[$j]['option_id']].'" style="width:45px;" />$</td>';
								echo '</tr>';
							}
						}
					}
					echo '</table>';
					echo '</div>';
					echo '</p>';
					echo '<p style="clear:both;">&nbsp;</p>';
				}
			}
		}
	}

	//Function to create edit option section for menu
	function fun_htmlMenuEditOptionView($menu_id) {
		if($menu_id == ''){
			return false;
		} else {
			$arrAddedOptions 		= array(); // create array of added options
			$arrAddedOptionValues 	= array(); // create array of added option values
			$sql 	= "SELECT * FROM " . TABLE_MENU_OPTION_RELATION . " WHERE menu_id='".$menu_id."'";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr = $this->dbObj->fetchAssoc($rs);
				for($i=0; $i < count($arr); $i++) {
					if(isset($arr[$i]['price']) && $arr[$i]['price'] != "") {
						array_push($arrAddedOptions, $arr[$i]['option_id']);
						$arrAddedOptionValues[$arr[$i]['option_id']]= $arr[$i]['price'];
					}
				}
			}

			//Step II: get menu cat id and find option categories 
			$menu_catid 		= $this->dbObj->getField(TABLE_MENU, "menu_id", $menu_id, "category_id");
			$sqlMenuOptCat 		= "SELECT A.category_id, A.category_name FROM " . TABLE_MENU_OPTION_CATEGORY . " AS A  WHERE (A.menu_catids='".$menu_catid."') OR (A.menu_catids like '%,".$menu_catid.",%') OR (A.menu_catids like '".$menu_catid.",%') OR (A.menu_catids like '%,".$menu_catid."')";
			$rsMenuOptCat 		= $this->dbObj->createRecordset($sqlMenuOptCat);
			if($this->dbObj->getRecordCount($rsMenuOptCat) > 0) {
				$arrMenuOptCat 	= $this->dbObj->fetchAssoc($rsMenuOptCat);
				for($counter = 0; $counter < count($arrMenuOptCat); $counter++) {
					$category_id 	= $arrMenuOptCat[$counter]['category_id'];
					$category_name 	= $arrMenuOptCat[$counter]['category_name'];
					$display_type 	= $arrMenuOptCat[$counter]['display_type'];
				
					//Step II: create html code for menu options
					//For Add Extra 
					//check if this option opted
					$category_checked 	= false;
					$sqlchk 			= "SELECT A.option_id, B.category_id  FROM " . TABLE_MENU_OPTION . " AS A
					INNER JOIN " . TABLE_MENU_OPTION_CATEGORY . " AS B ON B.category_id = A.category_id
					WHERE A.option_id IN (SELECT option_id  FROM " . TABLE_MENU_OPTION_RELATION . ") AND B.category_id='".$category_id."'";
					$rschk 				= $this->dbObj->createRecordset($sqlchk);
					if($this->dbObj->getRecordCount($rschk) > 0){
						$category_checked 	= true;
					}
					
					echo '<div class="form-group">';
					echo '<label class="control-label col-sm-3">'.ucwords($category_name).'</label>';
					echo '<div class="col-sm-9">';
                                        //echo '<p>';
					//echo '<label>'.ucwords($category_name).'</label>';
					if($category_checked == true) {
						echo '<input type="checkbox" name="options_category[]" id="options_category_id'.$category_id.'" value="'.$category_id.'" checked="checked" style="width:13px; height:13px; margin-top:22px;" /><br />';
					} else {
						echo '<input type="checkbox" name="options_category[]" id="options_category_id'.$category_id.'" value="'.$category_id.'" style="width:13px; height:13px; margin-top:22px;" /><br />';
					}
					echo '<table class="table table-hover">';
					echo '<thead>';
					echo '<tr>';
					echo '<th class="col-md-1 text-center" align="center">Add</th>';
					echo '<th class="col-md-4">Options</th>';
					echo '<th class="col-md-4">Price</th>';
					echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					$sql 		= "SELECT A.option_id, A.option_name  FROM " . TABLE_MENU_OPTION . " AS A WHERE A.category_id='".$category_id."'";
					$rs 		= $this->dbObj->createRecordset($sql);
					if($this->dbObj->getRecordCount($rs) > 0){
						$arr 	= $this->dbObj->fetchAssoc($rs);
						for($j=0; $j < count($arr); $j++) {
							if(array_search($arr[$j]['option_id'], $arrAddedOptions) === false){
								echo '<tr>';
								echo '<td align="center" valign="middle"><input type="checkbox" name="options[]" id="add_extra_id'.$arr[$j]['option_id'].'" value="'.$arr[$j]['option_id'].'" style="width:13px; height:13px;" /></td>';
								echo '<td align="left" valign="middle">'.ucwords($arr[$j]['option_name']).'</td>';
								echo '<td align="left" valign="middle"><input type="text" name="options_value['.$arr[$j]['option_id'].']" id="options_value_id'.$arr[$j]['option_id'].'" value="" style="width:45px;" />$</td>';
								echo '</tr>';
							} else {
								echo '<tr>';
								echo '<td align="center" valign="middle"><input type="checkbox" name="options[]" id="add_extra_id'.$arr[$j]['option_id'].'" value="'.$arr[$j]['option_id'].'" checked="checked" style="width:13px; height:13px;" /></td>';
								echo '<td align="left" valign="middle">'.ucwords($arr[$j]['option_name']).'</td>';
								echo '<td align="left" valign="middle"><input type="text" name="options_value['.$arr[$j]['option_id'].']" id="options_value_id'.$arr[$j]['option_id'].'" value="'.$arrAddedOptionValues[$arr[$j]['option_id']].'" style="width:45px;" />$</td>';
								echo '</tr>';
							}
						}
					}
					echo '</table>';
					//echo '</div>';
					//echo '</p>';
					//echo '<p style="clear:both;">&nbsp;</p>';
					echo '</div>';
					echo '</div>';
					echo '<br>';
				}
			}
		}
	}

	//Function to create option section for menu in order page
	function fun_createMenuOptionView($menu_id) {
		if($menu_id == ''){
			return false;
		} else {
			$arrAddedOptions 		= array(); // create array of added options
			$arrAddedOptionValues 	= array(); // create array of added option values
			$sql 	= "SELECT * FROM " . TABLE_MENU_OPTION_RELATION . " WHERE menu_id='".$menu_id."'";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr = $this->dbObj->fetchAssoc($rs);
				for($i=0; $i < count($arr); $i++) {
					if(isset($arr[$i]['price']) && $arr[$i]['price'] != "") {
						array_push($arrAddedOptions, $arr[$i]['option_id']);
						$arrAddedOptionValues[$arr[$i]['option_id']]= $arr[$i]['price'];
					}
				}
			}

			//Step II: get menu cat id and find option categories 
			$menu_catid 		= $this->dbObj->getField(TABLE_MENU, "menu_id", $menu_id, "category_id");
			$option_ids 		= implode(",", $arrAddedOptions);

			$sqlMenuOptCat 		= "SELECT A.category_id, A.category_name, A.display_type
			FROM " . TABLE_MENU_OPTION_CATEGORY . " AS A  
			WHERE ((A.menu_catids='".$menu_catid."') OR (A.menu_catids like '%,".$menu_catid.",%') OR (A.menu_catids like '".$menu_catid.",%') OR (A.menu_catids like '%,".$menu_catid."')) 
			AND A.category_id IN (SELECT category_id  FROM " . TABLE_MENU_OPTION . " WHERE option_id IN (".$option_ids.") GROUP BY category_id)";
			$rsMenuOptCat 		= $this->dbObj->createRecordset($sqlMenuOptCat);
			if($this->dbObj->getRecordCount($rsMenuOptCat) > 0) {
				$arrMenuOptCat 	= $this->dbObj->fetchAssoc($rsMenuOptCat);
				for($counter = 0; $counter < count($arrMenuOptCat); $counter++) {
					$category_id 	= $arrMenuOptCat[$counter]['category_id'];
					$category_name 	= $arrMenuOptCat[$counter]['category_name'];
					$display_type 	= $arrMenuOptCat[$counter]['display_type'];
				
					//Step II: create html code for menu options
					/*
					//For Add Extra 
					//check if this option opted
					$category_checked 	= false;
					$sqlchk 			= "SELECT A.option_id, B.category_id  FROM " . TABLE_MENU_OPTION . " AS A
					INNER JOIN " . TABLE_MENU_OPTION_CATEGORY . " AS B ON B.category_id = A.category_id
					WHERE A.option_id IN (SELECT option_id  FROM " . TABLE_MENU_OPTION_RELATION . ") AND B.category_id='".$category_id."'";
					$rschk 				= $this->dbObj->createRecordset($sqlchk);
					if($this->dbObj->getRecordCount($rschk) > 0){
						$category_checked 	= true;
					}
					*/

					echo '<tr>';
					echo '<td style="padding-top:5px; padding-bottom:5px;"><strong>'.ucwords($category_name).'</strong></td>';
					echo '<td style="padding-top:5px; padding-bottom:5px;">';
					switch($display_type) {
						case '0': //radio option
							echo '<div class="node-options">';
							echo '<ul>';
							$sql 		= "SELECT A.option_id, A.option_name  FROM " . TABLE_MENU_OPTION . " AS A WHERE A.category_id='".$category_id."' AND A.option_id IN (".$option_ids.") ";
							$rs 		= $this->dbObj->createRecordset($sql);
							if($this->dbObj->getRecordCount($rs) > 0){
								$arr 	= $this->dbObj->fetchAssoc($rs);
								for($j=0; $j < count($arr); $j++) {
									echo '<li><input type="radio" class="radio" name="radio_options['.$category_id.']" id="radio_options_id'.$arr[$j]['option_id'].'" value="'.$arr[$j]['option_id'].'">&nbsp;<a href="javascript:void(0);" title="'.ucwords($arr[$j]['option_name']).'">'.ucwords($arr[$j]['option_name']).'</a></li>';
								}
							}
							echo '</ul>';
							echo '</div>';
						break;
						case '1': //drop down list
							echo '<div class="node-options">';
							echo '<ul>';
							$sql 		= "SELECT A.option_id, A.option_name  FROM " . TABLE_MENU_OPTION . " AS A WHERE A.category_id='".$category_id."' AND A.option_id IN (".$option_ids.") ";
							$rs 		= $this->dbObj->createRecordset($sql);
							if($this->dbObj->getRecordCount($rs) > 0){
								$arr 	= $this->dbObj->fetchAssoc($rs);
								echo '<select name="select_options['.$category_id.']" id="select_options_id'.$arr[$j]['option_id'].'" class="select310" >';
								for($j=0; $j < count($arr); $j++) {
									echo '<option value="'.$arr[$j]['option_id'].'">'.ucwords($arr[$j]['option_name']).'</li>';
								}
								echo "</select>";
							}
							echo '</ul>';
							echo '</div>';
						break;
						case '2': //checkbox
							echo '<div class="node-options">';
							echo '<ul>';
							$sql 		= "SELECT A.option_id, A.option_name  FROM " . TABLE_MENU_OPTION . " AS A WHERE A.category_id='".$category_id."' AND A.option_id IN (".$option_ids.") ";
							$rs 		= $this->dbObj->createRecordset($sql);
							if($this->dbObj->getRecordCount($rs) > 0){
								$arr 	= $this->dbObj->fetchAssoc($rs);
								for($j=0; $j < count($arr); $j++) {
									if(isset($arrAddedOptionValues[$arr[$j]['option_id']]) && $arrAddedOptionValues[$arr[$j]['option_id']] !="") {
										$title = '$'.$arrAddedOptionValues[$arr[$j]['option_id']].' extra';
									} else {
										$title = '';
									}
									echo '<li><input type="checkbox" class="checkbox" name="options['.$arr[$j]['option_id'].']" id="options_id'.$arr[$j]['option_id'].'" value="'.$arr[$j]['option_id'].'">&nbsp;<a href="javascript:void(0);" title="'.$title.'">'.ucwords($arr[$j]['option_name']).'</a></li>';
								}
							}
							echo '</ul>';
							echo '</div>';
						break;
						default: //checkbox
							echo '<div class="node-options">';
							echo '<ul>';
							$sql 		= "SELECT A.option_id, A.option_name  FROM " . TABLE_MENU_OPTION . " AS A WHERE A.category_id='".$category_id."' AND A.option_id IN (".$option_ids.") ";
							$rs 		= $this->dbObj->createRecordset($sql);
							if($this->dbObj->getRecordCount($rs) > 0){
								$arr 	= $this->dbObj->fetchAssoc($rs);
								for($j=0; $j < count($arr); $j++) {
									if(isset($arrAddedOptionValues[$arr[$j]['option_id']]) && $arrAddedOptionValues[$arr[$j]['option_id']] !="") {
										$title = '$'.$arrAddedOptionValues[$arr[$j]['option_id']].' extra';
									} else {
										$title = '';
									}
									echo '<li><input type="checkbox" class="checkbox" name="options['.$arr[$j]['option_id'].']" id="options_id'.$arr[$j]['option_id'].'" value="'.$arr[$j]['option_id'].'">&nbsp;<a href="javascript:void(0);" title="'.$title.'">'.ucwords($arr[$j]['option_name']).'</a></li>';
								}
							}
							echo '</ul>';
							echo '</div>';
					}
					/*
					echo '<p>';
					echo '<label>'.ucwords($category_name).'</label>';
					if($category_checked == true) {
						echo '<input type="checkbox" name="options_category[]" id="options_category_id'.$category_id.'" value="'.$category_id.'" checked="checked" style="width:13px; height:13px; margin-top:22px;" /><br />';
					} else {
						echo '<input type="checkbox" name="options_category[]" id="options_category_id'.$category_id.'" value="'.$category_id.'" style="width:13px; height:13px; margin-top:22px;" /><br />';
					}
					echo '<div class="list-1" style="width:500px; margin-left:144px; margin-top:10px; border:thin #CCCCCC solid; padding:5px;">';
					echo '<table width="500" border="0" cellpadding="0" cellspacing="0" class="dyn-row">';
					echo '<tr>';
					echo '<td width="30px" class="pad-top5 pad-lft5 pad-btm5"><strong>Add</strong></td>';
					echo '<td width="120px" class="pad-top5 pad-lft5 pad-btm5"><strong>Options</strong></td>';
					echo '<td class="pad-top5 pad-lft5 pad-btm5"><strong>Price</strong></td>';
					echo '</tr>';
		
					$sql 		= "SELECT A.option_id, A.option_name  FROM " . TABLE_MENU_OPTION . " AS A WHERE A.category_id='".$category_id."'";
					$rs 		= $this->dbObj->createRecordset($sql);
					if($this->dbObj->getRecordCount($rs) > 0){
						$arr 	= $this->dbObj->fetchAssoc($rs);
						for($j=0; $j < count($arr); $j++) {
							if(array_search($arr[$j]['option_id'], $arrAddedOptions) === false){
								echo '<tr>';
								echo '<td align="center" valign="middle"><input type="checkbox" name="options[]" id="add_extra_id'.$arr[$j]['option_id'].'" value="'.$arr[$j]['option_id'].'" style="width:13px; height:13px;" /></td>';
								echo '<td align="left" valign="middle" class="pad-lft5 pad-top10">'.ucwords($arr[$j]['option_name']).'</td>';
								echo '<td align="left" valign="middle" class="pad-lft5 pad-btm5"><input type="text" name="options_value['.$arr[$j]['option_id'].']" id="options_value_id'.$arr[$j]['option_id'].'" value="" style="width:45px;" />$</td>';
								echo '</tr>';
							} else {
								echo '<tr>';
								echo '<td align="center" valign="middle"><input type="checkbox" name="options[]" id="add_extra_id'.$arr[$j]['option_id'].'" value="'.$arr[$j]['option_id'].'" checked="checked" style="width:13px; height:13px;" /></td>';
								echo '<td align="left" valign="middle" class="pad-lft5 pad-top10">'.ucwords($arr[$j]['option_name']).'</td>';
								echo '<td align="left" valign="middle" class="pad-lft5 pad-btm5"><input type="text" name="options_value['.$arr[$j]['option_id'].']" id="options_value_id'.$arr[$j]['option_id'].'" value="'.$arrAddedOptionValues[$arr[$j]['option_id']].'" style="width:45px;" />$</td>';
								echo '</tr>';
							}
						}
					}
					echo '</table>';
					echo '</div>';
					echo '</p>';
					echo '<p style="clear:both;">&nbsp;</p>';
					*/
					echo '</td>';
					echo '</tr>';
					echo '<tr><td colspan="2" style="border-bottom:thin #ccc dotted; height:3px;"></td></tr>';
				}
			}
		}
	}

/*
* For Menu Price: Start here
*/
	//Function to create edit price section for menu
	function fun_createMenuEditPriceView($menu_id) {
		if($menu_id == ''){
			return false;
		} else {
			$arrAddedPrices 		= array(); // create array of added prices
			$arrAddedPriceValues 	= array(); // create array of added price values
			$sql 	= "SELECT * FROM " . TABLE_MENU_PRICE_RELATION . " WHERE menu_id='".$menu_id."'";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr = $this->dbObj->fetchAssoc($rs);
				for($i=0; $i < count($arr); $i++) {
					if(isset($arr[$i]['price']) && $arr[$i]['price'] != "") {
						array_push($arrAddedPrices, $arr[$i]['price_id']);
						$arrAddedPriceValues[$arr[$i]['price_id']]= $arr[$i]['price'];
					}
				}
			}

			//Step II: create html code for menu prices
			//For Add Extra 
			$sql 		= "SELECT A.price_id, A.price_name  FROM " . TABLE_MENU_PRICE . " AS A WHERE A.category_id='1'";
			$rs 		= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr 	= $this->dbObj->fetchAssoc($rs);
				echo '<table width="500" border="0" cellpadding="0" cellspacing="0" class="dyn-row">';
				for($j=0; $j < count($arr); $j++) {
					echo '<tr>';
					echo '<td align="left" valign="middle" class="pad-lft5 pad-top5" width="15%"><input type="hidden" name="prices[]" id="price_id'.$arr[$j]['price_id'].'" value="'.$arr[$j]['price_id'].'" />'.ucwords($arr[$j]['price_name']).'</td>';
					echo '<td align="left" valign="middle" class="pad-lft5 pad-btm5"><input type="text" name="prices_value['.$arr[$j]['price_id'].']" id="prices_value_id'.$arr[$j]['price_id'].'" value="'.$arrAddedPriceValues[$arr[$j]['price_id']].'" style="width:45px;" />$</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
		}
	}

/*
* For Menu Price: End here
*/

	// Function for menu category array having menu for the provided restaurant id
	function fun_getRestaurantMenuCatArrHavingMenu($rest_id){
		if($rest_id == "") {
			return false;
		} else {
			$sql = "SELECT 	A.category_id, 
							A.category_name
					FROM " . TABLE_MENU_CATEGORY . " AS A 
					WHERE A.category_id IN (SELECT category_id FROM " . TABLE_MENU . " WHERE rest_id='".$rest_id."' AND active='1' GROUP BY category_id)";
			$rs = $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr = $this->dbObj->fetchAssoc($rs);
				return $arr;
			}
		}
	}

	// Function for menu array restaurant id and cat id
	function fun_getRestaurantMenuArrByCatId($rest_id, $category_id){
		if($rest_id == "" || $category_id == "") {
			return false;
		} else {
			$sql = "SELECT 	A.* FROM " . TABLE_MENU . " AS A WHERE A.rest_id='".$rest_id."' AND A.category_id='".$category_id."' AND A.active='1'";
			$rs = $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr = $this->dbObj->fetchAssoc($rs);
				return $arr;
			}
		}
	}


/*
* Menus Functions: End Here
*/
/*
* Booktable Functions: start Here
*/ 	
	// Function for Bookings array
	function fun_getBookingsArr($parameter=''){
		$sql = "SELECT 	A.* FROM " . TABLE_RESTAURANT_BOOKING . " AS A ";

		if($parameter!=""){
			$sql .= $parameter;
		} else{
			$sql .= " ORDER BY A.booking_id";		
		}
		return $rs = $this->dbObj->createRecordset($sql);
	}

	function fun_getManagerBookingsArr($user_id, $parameter=''){
		//Step I: find restaurant id of this manager
		$sql 		= "SELECT rest_id FROM " . TABLE_RESTAURANT_MANAGER_RELATIONS . " WHERE manager_id='".$user_id."'";
		$rs 		= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			$restArr = array();
			for($i=0; $i< count($arr); $i++) {
				array_push($restArr, $arr[$i]['rest_id']);
			}
			
			$strRest = implode(",", $restArr);
			$sql = "SELECT 	A.* FROM " . TABLE_RESTAURANT_BOOKING . " AS A WHERE A.rest_id IN (".$strRest.") ";
	
			if($parameter!=""){
				$sql .= $parameter;
			} else{
				$sql .= " ORDER BY A.booking_id";		
			}
			return $rs = $this->dbObj->createRecordset($sql);
		}
	}

	// Get Booking Info by booking id
	function fun_getBookInfoById($booking_id){
		$sql 		= "SELECT A.* FROM " . TABLE_RESTAURANT_BOOKING . " AS A WHERE A.booking_id='".$booking_id."'";
		$rs 		= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			return $arr[0];
		} else {
			return false;
		}
	}

	//Add New book a table, and return booking id (booking_id)
	function fun_addBookTable($booking_id ='', $user_id, $rest_id, $phone ='', $total_bookings ='', $schedule ='', $instructions ='', $total_amount ='', $currency_id ='', $pay_method ='', $payment_status ='', $status ='', $active =''){
		$cur_unixtime 		= time ();
		if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
			$cur_user_id 	= $_SESSION['ses_admin_id'];
		} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !=""){
			$cur_user_id 	= $_SESSION['ses_modarator_id'];
		} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !=""){
			$cur_user_id 	= $_SESSION['ses_user_id'];
		} else {
			$cur_user_id 	= "";
		}

		if($booking_id > 0) {
            $sqlUpdateQuery = "UPDATE " . TABLE_RESTAURANT_BOOKING . " SET 
            user_id = '".$user_id."',
            rest_id = '".$rest_id."',
            phone = '".$phone."',
            total_bookings = '".$total_bookings."',
            schedule = '".$schedule."',
            instructions = '".$instructions."',
            total_amount = '".$total_amount."',
            currency_id = '".$currency_id."',
            pay_method = '".$pay_method."',
            payment_status = '".$payment_status."',
            status = '".$status."',
            updated_on = '".$cur_unixtime."',
            updated_by = '".$cur_user_id."',
            active = '".$active."'
            WHERE booking_id='".$booking_id."'";
            $this->dbObj->mySqlSafeQuery($sqlUpdateQuery);
            return $booking_id;
		} else {
			$view_status 	= "0";
			$delete_status 	= "0";
			$field_names  	= array("user_id", "rest_id", "phone", "total_bookings", "schedule", "instructions", "total_amount", "currency_id", "pay_method", "payment_status", "status", "created_on", "created_by", "updated_on", "updated_by", "view_status", "delete_status", "active");
			$field_values 	= array($user_id, $rest_id, $phone, $total_bookings, $schedule, fun_db_input($instructions), $total_amount, $currency_id, $pay_method, $payment_status, $status, $cur_unixtime, $cur_user_id, $cur_unixtime, $cur_user_id, $view_status, $delete_status, $active);
			$this->dbObj->insertFields(TABLE_RESTAURANT_BOOKING, $field_names, $field_values);
			$booking_id 	= $this->dbObj->getIdentity();
			return $booking_id;
		}
	}

	function fun_editBookTable($booking_id ='', $user_id, $rest_id, $phone, $total_bookings, $schedule, $instructions ='', $total_amount ='', $currency_id ='', $pay_method ='', $payment_status ='', $status ='', $active =''){
		if($booking_id == "") {
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

            $sqlUpdateQuery = "UPDATE " . TABLE_RESTAURANT_BOOKING . " SET 
            user_id = '".$user_id."',
            rest_id = '".$rest_id."',
            phone = '".$phone."',
            total_bookings = '".$total_bookings."',
            schedule = '".$schedule."',
            instructions = '".$instructions."',
            total_amount = '".$total_amount."',
            currency_id = '".$currency_id."',
            pay_method = '".$pay_method."',
            payment_status = '".$payment_status."',
            status = '".$status."',
            updated_on = '".$cur_unixtime."',
            updated_by = '".$cur_user_id."',
            active = '".$active."'
            WHERE booking_id='".$booking_id."'";
            $this->dbObj->mySqlSafeQuery($sqlUpdateQuery);
			return true;
		}
	}

	// Function	for activate booking
	function fun_activateBooking($booking_id) {
		if($booking_id == '') {
			return false;
		} else {
			$this->dbObj->updateField(TABLE_RESTAURANT_BOOKING, "booking_id", $booking_id, "active", "1");
			return true;
		}
	}

	function fun_addUserBookingRelation($booking_id, $user_id, $active ='') {
        if($booking_id =="" || $user_id =="") {
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

			if(($user_booking_array = $this->fun_findRestaurantRelationInfo(TABLE_USER_BOOKING_RELATIONS, " WHERE user_id='".$user_id."' AND booking_id='".$booking_id."'")) && (is_array($user_booking_array))){
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

	function fun_sendBookingNotification($booking_id) {
		if($booking_id == false) {
			return false;		
		} else {
			$usersObj 			= new Users();
			$bookingInfoArr 	= $this->fun_getBookInfoById($booking_id);
			$user_id 			= $bookingInfoArr['user_id'];
			$rest_id 			= $bookingInfoArr['rest_id'];
			$phone 				= $bookingInfoArr['phone'];
			$total_bookings 	= $bookingInfoArr['total_bookings'];
			$schedule 			= $bookingInfoArr['schedule'];
			$instructions 		= $bookingInfoArr['instructions'];
			$total_amount 		= $bookingInfoArr['total_amount'];
			$currency_code 		= $bookingInfoArr['currency_code'];
			$pay_method 		= $bookingInfoArr['pay_method'];
			$payment_status 	= $bookingInfoArr['payment_status'];
			$status 			= $bookingInfoArr['status'];
			$view_status 		= $bookingInfoArr['view_status'];
			$delete_status 		= $bookingInfoArr['delete_status'];
			$active 			= $bookingInfoArr['active'];
			$created_on	 		= $bookingInfoArr['created_on'];

			$bookingUserInfoArr = $usersObj->fun_getUsersInfo($user_id);
			$user_fname 		= $bookingUserInfoArr['user_fname'];
			$user_lname 		= $bookingUserInfoArr['user_lname'];
			$user_email 		= $bookingUserInfoArr['user_email'];
			$user_name			= $user_fname." ".$user_lname;

			$manager_id 		= $this->dbObj->getField(TABLE_RESTAURANT_MANAGER_RELATIONS, "rest_id", $rest_id, "manager_id");
			$manager_email 		= $this->dbObj->getField(TABLE_USERS, "user_id", $manager_id, "user_email");

			$restInfoArr 		= $this->fun_getRestaurantInfo($rest_id);
			if(is_array($restInfoArr) && count($restInfoArr) > 0) {
				$booking_html 		= "";
				$booking_html_mgr 	= "";
				$booking_html_usr 	= "";
				$rest_name			= $restInfoArr['rest_name'];
				$rest_logo 			= RESTAURANT_IMAGES_LOGO_PATH.$restInfoArr['rest_logo'];
				$restLocInfoArr 	= $this->fun_getRestaurantLocInfoArr($rest_id);
				$propLoc = "";
				if($restLocInfoArr['country_name'] !=""){
					$propLoc .= "<a href=\"".SITE_URL."restaurants/".str_replace("/", "_", str_replace(" ", "-", strtolower($restLocInfoArr['country_name'])))."\" >".ucwords($restLocInfoArr['country_name'])."</a> > ";
				}
				if($restLocInfoArr['state_name'] !=""){
					$propLoc .= "<a href=\"".SITE_URL."restaurants/".str_replace("/", "_", str_replace(" ", "-", strtolower($restLocInfoArr['state_name'])))."\" >".ucwords($restLocInfoArr['state_name'])."</a> > ";
				}
				if($restLocInfoArr['city_name'] !=""){
					$propLoc .= "<a href=\"".SITE_URL."restaurants/".str_replace("/", "_", str_replace(" ", "-", strtolower($restLocInfoArr['city_name'])))."\" >".ucwords($restLocInfoArr['city_name'])."</a> > ";
				}
				$propLoc .= ucfirst($rest_name)." ref:".fill_zero_left($rest_id, "0", (6-strlen($rest_id)));
			
				$fr_url = $this->fun_getRestaurantFriendlyLink($rest_id);
				if(isset($fr_url) && $fr_url != "") {
					$restaurant_link 	= SITE_URL."restaurant/".strtolower($fr_url);
				} else {
					if(isset($restLocInfoArr['city_name']) && $restLocInfoArr['city_name'] != "") {
						$restaurant_link = SITE_URL."restaurant/".str_replace(" ", "-", strtolower($restLocInfoArr['city_name']))."/".fill_zero_left($rest_id, "0", (6-strlen($rest_id)));
					} else {
						$restaurant_link = SITE_URL."restaurant/".str_replace(" ", "-", strtolower($restLocInfoArr['state_name']))."/".fill_zero_left($rest_id, "0", (6-strlen($rest_id)));
					}
				}

				$booking_html .= "<table width=\"490\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
				$booking_html .= "<tr>";
				$booking_html .= "<td width=\"96\" valign=\"top\"><strong>Reservation ID</strong></td>";
				$booking_html .= "<td width=\"390\" valign=\"top\">".fill_zero_left($booking_id, "0", (9-strlen($booking_id)))."</td>";
				$booking_html .= "</tr>";
				$booking_html .= "<tr>";
				$booking_html .= "<td valign=\"top\"><strong>From</strong></td>";
				$booking_html .= "<td valign=\"top\">".$user_name."</td>";
				$booking_html .= "</tr>";
				$booking_html .= "<tr>";
				$booking_html .= "<td valign=\"top\"><strong>Phone</strong></td>";
				$booking_html .= "<td valign=\"top\">".$phone."</td>";
				$booking_html .= "</tr>";
				$booking_html .= "<tr>";
				$booking_html .= "<td valign=\"top\"><strong>Email</strong></td>";
				$booking_html .= "<td valign=\"top\"><a href=\"mailto:".$user_email."\" style=\"color:#357bdc; text-decoration: none;\" >".$user_email."</a></td>";
				$booking_html .= "</tr>";
				$booking_html .= "<tr>";
				$booking_html .= "<td valign=\"top\"><strong>Restaurant ID</strong></td>";
				$booking_html .= "<td valign=\"top\">".fill_zero_left($rest_id, "0", (6-strlen($rest_id)))."</td>";
				$booking_html .= "</tr>";
				$booking_html .= "<tr>";
				$booking_html .= "<td valign=\"top\"><strong>Restaurant name</strong></td>";
				$booking_html .= "<td valign=\"top\"><a href=\"".$restaurant_link."\" style=\"color:#357bdc; text-decoration: none;\" >".ucfirst($rest_name)."</a></td>";
				$booking_html .= "</tr>";
				$booking_html .= "<tr>";
				$booking_html .= "<td valign=\"top\"><strong>Schedule At</strong></td>";
				$booking_html .= "<td valign=\"top\">".date('M j, Y H:i:s', strtotime($schedule))."</td>";
				$booking_html .= "</tr>";
				$booking_html .= "<tr>";
				$booking_html .= "<td valign=\"top\"><strong>Number in party</strong></td>";
				$booking_html .= "<td valign=\"top\">".$total_bookings."</td>";
				$booking_html .= "</tr>";
				$booking_html .= "<tr>";
				$booking_html .= "<td valign=\"top\">&nbsp;</td>";
				$booking_html .= "<td valign=\"top\">&nbsp;</td>";
				$booking_html .= "</tr>";
				$booking_html .= "<td valign=\"top\"><strong>Special requests</strong></td>";
				$booking_html .= "<td valign=\"top\">".$instructions."</td>";
				$booking_html .= "</tr>";
				$booking_html .= "</table>";
				
				$booking_html_mgr .= "<table width=\"80%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
				$booking_html_mgr .= "<tr>";
				$booking_html_mgr .= "<td valign=\"top\">";
				$booking_html_mgr .= "<strong>Dear Manager, <br>You've just received a new table reservation.</strong><br><br>";
				$booking_html_mgr .= "<strong>Reservation details are:</strong><br><br>";
				$booking_html_mgr .= $booking_html;
				$booking_html_mgr .= "Regards,<br>The ".$_SERVER["SERVER_NAME"]." Team<br><br><hr>";
				$booking_html_mgr .= "</td>";
				$booking_html_mgr .= "</tr>";
				$booking_html_mgr .= "</table>";

				$booking_html_usr .= "<table width=\"80%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
				$booking_html_usr .= "<tr>";
				$booking_html_usr .= "<td valign=\"top\">";
				$booking_html_usr .= "<strong>Dear ".$user_fname.", <br>Thanks for using ".$_SERVER["SERVER_NAME"].".</strong><br><br>";
				$booking_html_usr .= "<strong>Below is a copy of your restaurant reservation.</strong><br>";
				$booking_html_usr .= "Please keep this email and the Reservation ID for future reference. We will need this information if you ever need to contact us about your reservation.<br><br>";
				$booking_html_usr .= "Restaurant managers are pretty good at getting in touch so keep an eye on your inbox. If they do not respond then try calling them using the contact number quoted on restaurant details.<br><br>";
				$booking_html_usr .= "Regards,<br>The ".$_SERVER["SERVER_NAME"]." Team<br><br><hr><br>";
				$booking_html_usr .= $booking_html;
				$booking_html_usr .= "</td>";
				$booking_html_usr .= "</tr>";
				$booking_html_usr .= "</table>";

				//Notification to user
				if(isset($user_email) && $user_email != "") {
					//$emailObj = new Email($user_email, SITE_ADMIN_EMAIL, "Your reservation has been sent on ".$_SERVER["SERVER_NAME"], $booking_html_usr, SITE_ADMIN_EMAIL);
					$emailObj = new Email($user_email, SITE_ADMIN_EMAIL, "Your reservation has been sent on ".$_SERVER["SERVER_NAME"], $booking_html_usr);
					$emailObj->sendEmail();
				}
				//Notification to manager
				if(isset($manager_email) && $manager_email != "") {
					//$emailObj = new Email($manager_email, SITE_ADMIN_EMAIL, "You've just received a new table reservation on ".$_SERVER["SERVER_NAME"], $booking_html_mgr, SITE_ADMIN_EMAIL);
					$emailObj1 = new Email($manager_email, SITE_ADMIN_EMAIL, "You've just received a new table reservation on ".$_SERVER["SERVER_NAME"], $booking_html_mgr);
					$emailObj1->sendEmail();
				}
				
				//Notification to admin (manager copy)
				$emailObj2 = new Email("admin@unitedrestaurants.com", SITE_ADMIN_EMAIL, "You've just received a new table reservation on ".$_SERVER["SERVER_NAME"], $booking_html_mgr);
				$emailObj2->sendEmail();

				//Notification to admin (user copy)
				$emailObj3 = new Email("admin@unitedrestaurants.com", SITE_ADMIN_EMAIL, "Your reservation has been sent on ".$_SERVER["SERVER_NAME"], $booking_html_usr);
				$emailObj3->sendEmail();
			}
			return true;
		}
	}

	// Function for deleting Booking
	function fun_delBooking($booking_id){
			if($rest_id == ''){
			return false;
		} else {
			//Step 1 : Delete any relational data available
			// Delete from TABLE_RESTAURANT_BOOKING
			$strDelQuery = "DELETE FROM " . TABLE_RESTAURANT_BOOKING . " WHERE booking_id='".$booking_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations
			return true;
		}
	}
	// Function for deleting user: End Here

	// Function for SMS Notification of book table: Start Here
	function fun_sendRestBookTableSMSsg($rest_id, $booking_id) {
        if($rest_id == "" || $booking_id == "") {
            return false;
        } else {
			//Step I: find owner sms setting and their sms number
			$sql 	= "SELECT A.* FROM " . TABLE_RESTAURANT_BOOKING . " AS A
			INNER JOIN " . TABLE_USERS . " AS B ON B.user_id = A.user_id 
			WHERE booking_id='".$booking_id."' ";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr 					= $this->dbObj->fetchAssoc($rs);
				$user_id 				= $arr[0]['user_id'];
				$user_fname 			= $arr[0]['user_fname'];
				$user_lname 			= $arr[0]['user_lname'];
				$user_email 			= $arr[0]['user_email'];
				$rest_id 				= $arr[0]['rest_id'];
				$phone 					= $arr[0]['phone'];
				$total_bookings 		= $arr[0]['total_bookings'];
				$schedule 				= $arr[0]['schedule'];
				$instructions 			= $arr[0]['instructions'];
				$total_amount 			= $arr[0]['total_amount'];
				$currency_id 			= $arr[0]['currency_id'];
				$pay_method 			= $arr[0]['pay_method'];
				$payment_status			= $arr[0]['payment_status'];
				$status 				= $arr[0]['status'];

				if(isset($payment_method) && $payment_method != "") {
					switch($payment_method) {
						case '1':
							$payment_method_name = "Cash";
						break;
						case '2':
							$payment_method_name = "PayPal";
						break;
						case '3':
							$payment_method_name = "Credit Card";
						break;
						default:
							$payment_method_name = "Cash";
					}
				} else {
					$payment_method_name = "Cash";
				}

				$body_sms = 'New table booking has been placed with booking id #'.fill_zero_left($booking_id, "0", (6-strlen($booking_id))).', below are the details of the booking,';
				$body_sms .= 'Booking for :'.$total_bookings.' person; Customer Name:'.ucwords($user_fname.' '.$user_lname).'; Email: '.$user_email.'; Phone: '.$phone.';';

				//Step II: Find number details
				$sqlSMS 	= "SELECT B.country_isd_code, A.mobile_number FROM " . TABLE_RESTAURANT_MOBILE_ALERTS . " AS A LEFT JOIN " . TABLE_COUNTRY . " AS B ON A.mobile_countryid = B.country_id WHERE A.rest_id ='".$rest_id."' ";
				$rsSMS 		= $this->dbObj->createRecordset($sqlSMS);
				if($this->dbObj->getRecordCount($rsSMS) > 0){
					$arrSMS 			= $this->dbObj->fetchAssoc($rsSMS);
					$destination_arr	= array();
					for($i = 0; $i < count($arrSMS); $i++) {
						$country_isd_code	= $arrSMS[$i]['country_isd_code'];
						$mobile_number		= $arrSMS[$i]['mobile_number'];
						//$mobile 			= fill_zero_left($country_isd_code, "0", (4-strlen($country_isd_code)))."".$mobile_number;
						//$mobile 			= $country_isd_code.$mobile_number;
						if(substr($mobile_number, 0, 2) == "65") {
							$mobile 		= $mobile_number;
						} else {
							$mobile 		= $country_isd_code.$mobile_number;
						}

						array_push($destination_arr, $mobile);
					}
					$destination= implode(",", $destination_arr);
					//$destination= "6590662340";

					$username 	= "smartren";
					$password 	= "newcspl13";
					

					$body 		= urlencode($body_sms);
					//echo "<br><br>";
					//echo "Body Msg: ".$body;

					$baseurl 	= "http://www.sms.sg";
					$url 		= "$baseurl/http/sendmsg?user=$username&pwd=$password&option=send&to=%2B$destination&msg=$body";
					//http://www.sms.sg/http/sendmsg?user=test&pwd=test&option=send&to=%2B6591234567,987654321,91239123,91111111,91234455&msg= This%20is%20a%20Test
					//echo "SMS URL: ".$url;
					//die();
					//send sms now
					$ch 		= curl_init();
					curl_setopt($ch, CURLOPT_USERAGENT, 'Firefox (WindowsXP) - Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_FAILONERROR, true);
					curl_setopt($ch, CURLOPT_AUTOREFERER, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
					curl_setopt($ch, CURLOPT_TIMEOUT, 45);
					$html 		= curl_exec($ch);
					if (!$html) {
						echo "<br />cURL error number:" .curl_errno($ch);
						echo "<br />cURL error:" . curl_error($ch);
						exit;
					}
					curl_close($ch);
				}
				if(isset($phone) && $phone != "") {
					$destination= $phone;
					//$destination= "9971740974";

					$restInfoArr		= $this->fun_getRestaurantInfo($rest_id);
					$Arr 				= array();
					array_push($Arr, $restInfoArr['rest_name']." - ".$restInfoArr['rest_address1']." ".$restInfoArr['rest_address2']);
					if(isset($restInfoArr['rest_city_id']) && $restInfoArr['rest_city_id'] !="") {
						$city_name = $this->dbObj->getField(TABLE_CITY, "city_id", $restInfoArr['rest_city_id'], "city_name");
						array_push($Arr, $city_name);
					}
					if(isset($restInfoArr['rest_state_id']) && $restInfoArr['rest_state_id'] !="") {
						$state_name = $this->dbObj->getField(TABLE_STATE, "state_id", $restInfoArr['rest_state_id'], "state_name");
						array_push($Arr, $state_name);
					}
					if(isset($restInfoArr['rest_country_id']) && $restInfoArr['rest_country_id'] !="") {
						$country_name = $this->dbObj->getField(TABLE_COUNTRY, "country_id", $restInfoArr['rest_country_id'], "country_name");
						array_push($Arr, $country_name);
					}
					if(isset($restInfoArr['rest_zip']) && $restInfoArr['rest_zip'] !="") {
						array_push($Arr, $restInfoArr['rest_zip']);
					}
					$rest_phone = $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "phone");
		
					if(isset($rest_phone) && $rest_phone !="") {
						array_push($Arr, "Phone: ".$rest_phone);
					}
		
					$strRest 			= implode(", ", $Arr);

					$username 	= "smartren";
					$password 	= "newcspl13";
					$body_customer_sms 	= 'Your booking id #'.fill_zero_left($booking_id, "0", (6-strlen($booking_id))).', dated '.date("Y-m-d").' has been forwarded to '.$strRest.' for '.$total_bookings.' person';
					$body 		= urlencode($body_customer_sms);
					//$body 		= $body_sms;
					//echo "<br><br>";
					//echo "Body Msg: ".$body;

					$baseurl 	= "http://www.sms.sg";
					$url 		= "$baseurl/http/sendmsg?user=$username&pwd=$password&option=send&to=%2B$destination&msg=$body";
					//http://www.perfectbulksms.com/Sendsmsapi.aspx?USERID=username&PASSWORD=password&SENDERID=ABC&TO=9999999999,9899999999&MESSAGE=Good Morning
					//http://www.perfectbulksms.com/Sendsmsapi.aspx?USERID=Eatonline&PASSWORD=eatindia13&SENDERID=EATONL&TO=9971740974&MESSAGE=Good Morning
					//echo "SMS URL: ".$url;
					//die();
					//send sms now
					$ch 		= curl_init();
					curl_setopt($ch, CURLOPT_USERAGENT, 'Firefox (WindowsXP) - Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_FAILONERROR, true);
					curl_setopt($ch, CURLOPT_AUTOREFERER, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
					curl_setopt($ch, CURLOPT_TIMEOUT, 45);
					$html 		= curl_exec($ch);
					if (!$html) {
						echo "<br />cURL error number:" .curl_errno($ch);
						echo "<br />cURL error:" . curl_error($ch);
						exit;
					}
					curl_close($ch);
				}
				return true;
			} else {
				return false;
			}
        }
	}

	function fun_sendRestBookTableSMSsd($rest_id, $booking_id) {
        if($rest_id == "" || $booking_id == "") {
            return false;
        } else {
			//Step I: find owner sms setting and their sms number
			$sql 	= "SELECT A.* FROM " . TABLE_RESTAURANT_BOOKING . " AS A
			INNER JOIN " . TABLE_USERS . " AS B ON B.user_id = A.user_id 
			WHERE booking_id='".$booking_id."' ";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr 					= $this->dbObj->fetchAssoc($rs);
				$user_id 				= $arr[0]['user_id'];
				$user_fname 			= $arr[0]['user_fname'];
				$user_lname 			= $arr[0]['user_lname'];
				$user_email 			= $arr[0]['user_email'];
				$rest_id 				= $arr[0]['rest_id'];
				$phone 					= $arr[0]['phone'];
				$total_bookings 		= $arr[0]['total_bookings'];
				$schedule 				= $arr[0]['schedule'];
				$instructions 			= $arr[0]['instructions'];
				$total_amount 			= $arr[0]['total_amount'];
				$currency_id 			= $arr[0]['currency_id'];
				$pay_method 			= $arr[0]['pay_method'];
				$payment_status			= $arr[0]['payment_status'];
				$status 				= $arr[0]['status'];

				if(isset($payment_method) && $payment_method != "") {
					switch($payment_method) {
						case '1':
							$payment_method_name = "Cash";
						break;
						case '2':
							$payment_method_name = "PayPal";
						break;
						case '3':
							$payment_method_name = "Credit Card";
						break;
						default:
							$payment_method_name = "Cash";
					}
				} else {
					$payment_method_name = "Cash";
				}

				$body_sms = 'New table booking has been placed with booking id #'.fill_zero_left($booking_id, "0", (6-strlen($booking_id))).', below are the details of the booking,';
				$body_sms .= 'Booking for :'.$total_bookings.' person; Customer Name:'.ucwords($user_fname.' '.$user_lname).'; Email: '.$user_email.'; Phone: '.$phone.';';

				//Step II: Find number details
				$sqlSMS 	= "SELECT B.country_isd_code, A.mobile_number FROM " . TABLE_RESTAURANT_MOBILE_ALERTS . " AS A LEFT JOIN " . TABLE_COUNTRY . " AS B ON A.mobile_countryid = B.country_id WHERE A.rest_id ='".$rest_id."' ";
				$rsSMS 		= $this->dbObj->createRecordset($sqlSMS);
				if($this->dbObj->getRecordCount($rsSMS) > 0){
					$arrSMS 			= $this->dbObj->fetchAssoc($rsSMS);
					$destination_arr	= array();
					for($i = 0; $i < count($arrSMS); $i++) {
						$country_isd_code	= $arrSMS[$i]['country_isd_code'];
						$mobile_number		= $arrSMS[$i]['mobile_number'];
						//$mobile 			= fill_zero_left($country_isd_code, "0", (4-strlen($country_isd_code)))."".$mobile_number;
						//$mobile 			= $country_isd_code.$mobile_number;
						if(substr($mobile_number, 0, 2) == "91") {
							$mobile 		= $mobile_number;
						} else {
							$mobile 		= $country_isd_code.$mobile_number;
						}
						array_push($destination_arr, $mobile);
					}
					$destination= implode(",", $destination_arr);
					//$destination= "6590662340";

					$username 	= "Eatonline";
					$password 	= "eatindia13";
					
					$body 		= urlencode($body_sms);
					//$body 		= $body_sms;
					//echo "<br><br>";
					//echo "Body Msg: ".$body;

					$baseurl 	= "http://www.perfectbulksms.com";
					$url 		= "$baseurl//Sendsmsapi.aspx?USERID=$username&PASSWORD=$password&SENDERID=EATONL&TO=$destination&MESSAGE=$body";
					//http://www.perfectbulksms.com/Sendsmsapi.aspx?USERID=username&PASSWORD=password&SENDERID=ABC&TO=9999999999,9899999999&MESSAGE=Good Morning
					//http://www.perfectbulksms.com/Sendsmsapi.aspx?USERID=Eatonline&PASSWORD=eatindia13&SENDERID=EATONL&TO=9971740974&MESSAGE=Good Morning
					//echo "SMS URL: ".$url;
					//die();
					//send sms now
					$ch 		= curl_init();
					curl_setopt($ch, CURLOPT_USERAGENT, 'Firefox (WindowsXP) - Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_FAILONERROR, true);
					curl_setopt($ch, CURLOPT_AUTOREFERER, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
					curl_setopt($ch, CURLOPT_TIMEOUT, 45);
					$html 		= curl_exec($ch);
					if (!$html) {
						echo "<br />cURL error number:" .curl_errno($ch);
						echo "<br />cURL error:" . curl_error($ch);
						exit;
					}
					curl_close($ch);
				}
				if(isset($phone) && $phone != "") {
					$destination= $phone;
					//$destination= "9971740974";

					$restInfoArr		= $this->fun_getRestaurantInfo($rest_id);
					$Arr 				= array();
					array_push($Arr, $restInfoArr['rest_name']." - ".$restInfoArr['rest_address1']." ".$restInfoArr['rest_address2']);
					if(isset($restInfoArr['rest_city_id']) && $restInfoArr['rest_city_id'] !="") {
						$city_name = $this->dbObj->getField(TABLE_CITY, "city_id", $restInfoArr['rest_city_id'], "city_name");
						array_push($Arr, $city_name);
					}
					if(isset($restInfoArr['rest_state_id']) && $restInfoArr['rest_state_id'] !="") {
						$state_name = $this->dbObj->getField(TABLE_STATE, "state_id", $restInfoArr['rest_state_id'], "state_name");
						array_push($Arr, $state_name);
					}
					if(isset($restInfoArr['rest_country_id']) && $restInfoArr['rest_country_id'] !="") {
						$country_name = $this->dbObj->getField(TABLE_COUNTRY, "country_id", $restInfoArr['rest_country_id'], "country_name");
						array_push($Arr, $country_name);
					}
					if(isset($restInfoArr['rest_zip']) && $restInfoArr['rest_zip'] !="") {
						array_push($Arr, $restInfoArr['rest_zip']);
					}
					$rest_phone = $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "phone");
		
					if(isset($rest_phone) && $rest_phone !="") {
						array_push($Arr, "Phone: ".$rest_phone);
					}
		
					$strRest 			= implode(", ", $Arr);

					$username 	= "Eatonline";
					$password 	= "eatindia13";
					$body_customer_sms 	= 'Your booking id #'.fill_zero_left($booking_id, "0", (6-strlen($booking_id))).', dated '.date("Y-m-d").' has been forwarded to '.$strRest.' for '.$total_bookings.' person';
					$body 		= urlencode($body_customer_sms);
					$baseurl 	= "http://www.perfectbulksms.com";
					$url 		= "$baseurl//Sendsmsapi.aspx?USERID=$username&PASSWORD=$password&SENDERID=EATONL&TO=$destination&MESSAGE=$body";
					//http://www.perfectbulksms.com/Sendsmsapi.aspx?USERID=username&PASSWORD=password&SENDERID=ABC&TO=9999999999,9899999999&MESSAGE=Good Morning
					//http://www.perfectbulksms.com/Sendsmsapi.aspx?USERID=Eatonline&PASSWORD=eatindia13&SENDERID=EATONL&TO=9971740974&MESSAGE=Good Morning
					//echo "SMS URL: ".$url;
					//die();
					//send sms now
					$ch 		= curl_init();
					curl_setopt($ch, CURLOPT_USERAGENT, 'Firefox (WindowsXP) - Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_FAILONERROR, true);
					curl_setopt($ch, CURLOPT_AUTOREFERER, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
					curl_setopt($ch, CURLOPT_TIMEOUT, 45);
					$html 		= curl_exec($ch);
					if (!$html) {
						echo "<br />cURL error number:" .curl_errno($ch);
						echo "<br />cURL error:" . curl_error($ch);
						exit;
					}
					curl_close($ch);
				}
				return true;
			} else {
				return false;
			}
        }
	}


	// Function for SMS Notification of book table: End Here

/*
* Booktable Functions: End Here
*/

/*
* Restaurant Coupons Functions: Start Here
*/
	// Function for Coupon info	
	function fun_getCouponInfoById($coupon_id){
		$sql 		= "SELECT * FROM " . TABLE_RESTAURANT_COUPON . " AS A WHERE A.coupon_id='".$coupon_id."'";
		$rs 		= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			return $arr[0];
		} else {
			return false;
		}
	}


    //This function will return coupon information in array with front end data	
	function fun_getCouponInfoByCode($coupon_code){		
		$sql 	= "SELECT * FROM " . TABLE_RESTAURANT_COUPON . " WHERE coupon_code='".$coupon_code."'";
		$rs 	= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			return $arr[0];
		} else {
			return false;
		}
	}

    //This function will return coupon information in array with front end data	
	function fun_countCouponUserCode($coupon_code, $user_id = '') {
		$sql 	= "SELECT coupon_code FROM " .TABLE_USER_COUPON_CODE. " WHERE coupon_code = '".$coupon_code."' AND status = '1' ";
		if(isset($user_id) && $user_id != "") {
			$sql 	.= "AND user_id = '".$user_id."'";
		}
		$rs 	= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			return $this->dbObj->getRecordCount($rs);
		} else {
			return "0";
		}
	}

	// Function for Coupon array
	function fun_getCouponArr($parameter=''){
		$sql = "SELECT 	* FROM " . TABLE_RESTAURANT_COUPON . " AS A ";
		if($parameter != ""){
			$sql .= $parameter;
		} else{
			$sql .= " ORDER BY A.coupon_id";		
		}
		//echo $sql;
		return $rs = $this->dbObj->createRecordset($sql);
	}

    //Add a new Coupon
	function fun_addCoupon($rest_id, $coupon_name, $coupon_type, $coupon_auto_distributed = '', $coupon_code, $coupon_discount, $coupon_discount_type, $coupon_pre_tax, $coupon_start_date, $coupon_end_date, $coupon_duration = '', $coupon_duration_type = '', $coupon_loyalty = '', $coupon_loyalty_type = '', $coupon_takeup = '', $coupon_desc = '', $status){
		if($rest_id == '' || $coupon_name == '') {
			return false;
		} else {
			$cur_unixtime 		= time ();
			if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_admin_id'];
			} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_modarator_id'];
			} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_user_id'];
			} else {
				$cur_user_id 	= "";
			}
			$field_names 		= array("rest_id", "coupon_name", "coupon_type", "coupon_auto_distributed", "coupon_code", "coupon_discount", "coupon_discount_type", "coupon_pre_tax", "coupon_start_date", "coupon_end_date", "coupon_duration", "coupon_duration_type", "coupon_loyalty", "coupon_loyalty_type", "coupon_takeup", "coupon_desc", "created_on", "created_by", "updated_on", "updated_by", "status");
			$field_values 		= array($rest_id, fun_db_input($coupon_name), fun_db_input($coupon_type), fun_db_input($coupon_auto_distributed), fun_db_input($coupon_code), fun_db_input($coupon_discount), fun_db_input($coupon_discount_type), fun_db_input($coupon_pre_tax), fun_db_input($coupon_start_date), fun_db_input($coupon_end_date), fun_db_input($coupon_duration), fun_db_input($coupon_duration_type), fun_db_input($coupon_loyalty), fun_db_input($coupon_loyalty_type), fun_db_input($coupon_takeup), fun_db_input($coupon_desc), fun_db_input($cur_unixtime), fun_db_input($cur_user_id), fun_db_input($cur_unixtime), fun_db_input($cur_user_id), fun_db_input($status));
			$this->dbObj->insertFields(TABLE_RESTAURANT_COUPON, $field_names, $field_values);
			$coupon_id 			= $this->dbObj->getIdentity();
			return $coupon_id;
		}
	}
	
	function fun_editcoupon($coupon_id){
		if($coupon_id == "") {
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

			//Upadate updated by, updated on
			$sqlUpdate = "UPDATE " . TABLE_RESTAURANT_COUPON . " SET updated_on='" . $cur_unixtime . "', updated_by='" . $cur_user_id . "' WHERE coupon_id='".(int)$coupon_id."'";
			$this->dbObj->mySqlSafeQuery($sqlUpdate);

			// Updates from details page
			if($_POST['securityKey'] == md5('EDITCOUPON')){
				// Step I : if general details available update it
				$coupon_id				= $_POST['coupon_id'];
				$rest_id 				= $_POST['rest_id'];
				$coupon_name			= $_POST['coupon_name'];
				$coupon_type 			= $_POST['coupon_type'];
				$coupon_auto_distributed= $_POST['coupon_auto_distributed'];
				$coupon_code			= $_POST['coupon_code'];
				$coupon_discount		= $_POST['coupon_discount'];
				$coupon_discount_type	= $_POST['coupon_discount_type'];
				$coupon_pre_tax 		= $_POST['coupon_pre_tax'];
				$coupon_start_date		= $_POST['coupon_start_date'];
				$coupon_end_date 		= $_POST['coupon_end_date'];
				$coupon_duration 		= $_POST['coupon_duration'];
				$coupon_duration_type	= $_POST['coupon_duration_type'];
				$coupon_loyalty 		= $_POST['coupon_loyalty'];
				$coupon_loyalty_type	= $_POST['coupon_loyalty_type'];
				$coupon_takeup			= $_POST['coupon_takeup'];
				$coupon_desc			= $_POST['coupon_desc'];
				$status					= $_POST['status'];

				$couponArray = array(							
					"rest_id"					=> $rest_id,
					"coupon_name"				=> fun_db_input($coupon_name),
					"coupon_type"				=> $coupon_type,
					"coupon_auto_distributed"	=> $coupon_auto_distributed,
					"coupon_code"				=> $coupon_code,
					"coupon_discount"			=> $coupon_discount,
					"coupon_discount_type"		=> $coupon_discount_type,
					"coupon_pre_tax"			=> $coupon_pre_tax,
					"coupon_start_date"			=> $coupon_start_date,
					"coupon_end_date"			=> $coupon_end_date,
					"coupon_duration"			=> $coupon_duration,
					"coupon_duration_type"		=> $coupon_duration_type,
					"coupon_loyalty"			=> $coupon_loyalty,
					"coupon_loyalty_type"		=> $coupon_loyalty_type,
					"coupon_takeup"				=> $coupon_takeup,
					"coupon_desc"				=> fun_db_input($coupon_desc),
					"updated_on"				=> $cur_unixtime,
					"updated_on"				=> $cur_user_id,
					"status"					=> $status
				);
		
				$fields = "";
				foreach($couponArray as $keys => $vals){
					$fields .= $keys . "='" . fun_db_input($vals). "', ";
				}
				if($fields!=""){
					$fields = substr($fields,0,strlen($fields)-2);
					$sqlUpdate = "UPDATE " . TABLE_RESTAURANT_COUPON . " SET " . $fields . " WHERE coupon_id='".(int)$coupon_id."'";
					$this->dbObj->mySqlSafeQuery($sqlUpdate);
				}
			}
			return true;
		}
	}

	// Function assign promo code to user
	function fun_addCouponUserTakeup($coupon_code, $user_id, $order_id) {
		if($coupon_code == '' || $user_id == '' || $order_id == '') {
			return false;
		} else {
			$cur_unixtime 		= time ();
			if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_admin_id'];
			} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_modarator_id'];
			} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_user_id'];
			} else {
				$cur_user_id 	= "";
			}

			$active = "0";

			$strInsQuery = "INSERT INTO " . TABLE_USER_COUPON_CODE . " 
			(id, coupon_code, user_id, order_id, created_on, created_by, updated_on, updated_by, active) 
			VALUES(null, '".$coupon_code."', '".$user_id."', '".$order_id."', '".$cur_unixtime."', '".$cur_user_id."', '".$cur_unixtime."', '".$cur_user_id."', '".$active."')";
			$this->dbObj->fun_db_query($strInsQuery);
            return true;
		}
	}

	// Function assign promo code to user
	function fun_updateCouponUserTakeupStatusByOrderId($order_id, $active) {
		if($order_id == '' || $active == '' ) {
			return false;
		} else {
			$cur_unixtime 		= time ();
			if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_admin_id'];
			} else if(isset($_SESSION['ses_modarator_id']) && $_SESSION['ses_modarator_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_modarator_id'];
			} else if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !=""){
				$cur_user_id 	= $_SESSION['ses_user_id'];
			} else {
				$cur_user_id 	= "";
			}
			//Upadate active updated by, updated on
			$sqlUpdate = "UPDATE " . TABLE_USER_COUPON_CODE . " SET active='" . $active . "', updated_on='" . $cur_unixtime . "', updated_by='" . $cur_user_id . "' WHERE order_id='".(int)$order_id."'";
			$this->dbObj->mySqlSafeQuery($sqlUpdate);
            return true;
		}
	}

	// Function	for delete Coupon takeup
	function fun_delCouponUserTakeupByOrderId($order_id = ''){
		if($order_id == ''){
			return false;
		} else {
			$strDelteQuery = "DELETE FROM " . TABLE_USER_COUPON_CODE . " WHERE order_id='$order_id'";
			$this->dbObj->mySqlSafeQuery($strDelteQuery);
			return true;
		}
	}

	// Function	for delete Promo
	function fun_delCoupon($coupon_id = ''){
		if($coupon_id == ''){
			return false;
		} else {
			$strDelteQuery = "DELETE FROM " . TABLE_RESTAURANT_COUPON . " WHERE coupon_id='$coupon_id'";
			$this->dbObj->mySqlSafeQuery($strDelteQuery);
			return true;
		}
	}

/*
* Restaurant Coupons Functions: End Here
*/

/*
* Restaurant reviews specific functions : start here
*/
	function fun_addRestaurantReview($review_id, $rest_id, $rest_rating = '', $review_title = '', $review_txt = '', $user_fname = '', $user_lname = '', $user_email = '', $user_country = '', $status = '') {
		if($rest_id == '') {
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

			if($review_id != ""){
				$sqlUpdateQuery = "UPDATE " . TABLE_RESTAURANT_USER_REVIEW_RELATIONS . " SET 
				rest_id = '".$rest_id."',
				rest_rating = '".$rest_rating."',
				review_title = '".fun_db_input($review_title)."',
				review_txt = '".fun_db_input($review_txt)."',
				user_fname = '".$user_fname."',
				user_lname = '".$user_lname."',
				user_email = '".$user_email."',
				user_country = '".$user_country."',
				status = '".$status."',
				updated_on = '".$cur_unixtime."',
				updated_by = '".$cur_user_id."'
				WHERE review_id='".$review_id."'";
				$this->dbObj->mySqlSafeQuery($sqlUpdateQuery);
				return true;
			} else {
				if($this->fun_verifyRestaurantReviewUserEmail($rest_id, $user_email) == true) {
				// do nothing
				
				} else {
					$strInsQuery = "INSERT INTO " . TABLE_RESTAURANT_USER_REVIEW_RELATIONS . " 
					(review_id, rest_id, rest_rating, review_title, review_txt, user_fname, user_lname, user_email, user_country, status, active_on, active_by, created_on, created_by, updated_on, updated_by, active)
					VALUES(null, '".$rest_id."', '".$rest_rating."', '".fun_db_input($review_title)."', '".fun_db_input($review_txt)."', '".$user_fname."', '".$user_lname."', '".$user_email."', '".$user_country."', '".$status."', '".$cur_unixtime."', '".$cur_user_id."', '".$cur_unixtime."', '".$cur_user_id."', '".$cur_unixtime."', '".$cur_user_id."', '0')";
					$this->dbObj->mySqlSafeQuery($strInsQuery);
					$review_id 		= $this->dbObj->getIdentity();
					$this->sendReviewEmailNotification($review_id);
				}
				return true;
			}
		}
	}

	//function to verify review email
	function fun_verifyRestaurantReviewUserEmail($rest_id, $strEmail){		
		$usersFound = false;
		$sqlCheck = "SELECT * FROM " . TABLE_RESTAURANT_USER_REVIEW_RELATIONS . " WHERE user_email='".trim($strEmail)."' AND rest_id='".$rest_id."'";		
		if($this->fun_get_num_rows($sqlCheck) > 0){
			$usersFound = true;
		}
		return $usersFound;
	}

	// Function to get restaurant reviews array
	function fun_getRestaurantReviewsArr($rest_id = ''){	
		if($rest_id == ''){
			return false;
		} else {
			if(($reviews_array = $this->fun_findRestaurantRelationInfo(TABLE_RESTAURANT_USER_REVIEW_RELATIONS , " WHERE rest_id='".$rest_id."' AND status ='2'")) && (is_array($reviews_array))){
				return $reviews_array;
			} else {
				return false;
			}
		}
	}

	// Function	for delete review
	function fun_delRestaurantReview($review_id = ''){
		if($review_id == ''){
			return false;
		} else {
            $this->dbObj->deleteRow(TABLE_RESTAURANT_USER_REVIEW_RELATIONS, "review_id", $review_id);
			return true;
		}
	}

	function fun_delRestPhotoById($photo_id = ''){
		if($photo_id == ''){
			return false;
		} else {
            $this->dbObj->deleteRow(TABLE_RESTAURANT_PHOTO_ALL, "photo_id", $photo_id);
			return true;
		}
	}

	function fun_approveRestaurantReview($review_id = '') {
		if($review_id == ''){
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
			$sqlUpdateQuery = "UPDATE " . TABLE_RESTAURANT_USER_REVIEW_RELATIONS . " SET status = '2', active_on = '".$cur_unixtime."', active_by = '".$cur_user_id."', active = '1' WHERE review_id='".$review_id."'";
			$this->dbObj->mySqlSafeQuery($sqlUpdateQuery);
			return true;
		}
	}


	// Function for restaurant review array
	function fun_getPendingApprovalRestaurantReviewsArr($parameter=''){
		$sql = "SELECT 	A.review_id, 
						A.rest_id,
						A.rest_rating,
						A.review_title,
						A.user_fname,
						A.user_lname,
						A.user_email,
						A.user_country,
						A.status,
						A.created_on,
						A.active
				FROM " . TABLE_RESTAURANT_USER_REVIEW_RELATIONS . " AS A ";
		if($parameter!=""){
			$sql .= $parameter;
		} else {
			$sql .= " ORDER BY A.rest_id";		
		}
		$rs = $this->dbObj->createRecordset($sql);
        return $arr = $this->dbObj->fetchAssoc($rs);
	}

	// Function to get restaurant reviews array
	function fun_getRestaurantReviewsArr4RestaurantPreview($rest_id = '', $status = ''){	
		if($rest_id == ''){
			return false;
		} else {
            $sql 	= "SELECT * FROM ". TABLE_RESTAURANT_USER_REVIEW_RELATIONS ." WHERE rest_id='".(int)$rest_id."' AND status ='2' AND active ='1' ";
			if($status != "") {
				$sql 	.= "AND status ='".$status."' ";
			}
            $sql 	.= "ORDER BY updated_on DESC";
			$rs 	= $this->dbObj->createRecordset($sql);
			$arr 	= $this->dbObj->fetchAssoc($rs);
			if(is_array($arr)){
				return $arr;
			} else {
				return false;
			}
		}
	}

	// Function for deleting restaurant
	function fun_delRestaurant($rest_id){
		if($rest_id == ''){
			return false;
		} else {
			//Step 1 : Delete any relational data available
			// Delete from TABLE_RESTAURANT_CONFIGURATION
			$strDelQuery = "DELETE FROM " . TABLE_RESTAURANT_CONFIGURATION . " WHERE rest_id='".$rest_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			// Delete from TABLE_RESTAURANT_MANAGER_RELATIONS
			$strDelQuery = "DELETE FROM " . TABLE_RESTAURANT_MANAGER_RELATIONS . " WHERE rest_id='".$rest_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			// Delete from TABLE_RESTAURANT_PHOTO_ALL
			$strDelQuery = "DELETE FROM " . TABLE_RESTAURANT_PHOTO_ALL . " WHERE rest_id='".$rest_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			// Delete from TABLE_RESTAURANT_PRESS_REVIEW_RELATIONS
			$strDelQuery = "DELETE FROM " . TABLE_RESTAURANT_PRESS_REVIEW_RELATIONS . " WHERE rest_id='".$rest_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			// Delete from TABLE_USER_CART
			$strDelQuery = "DELETE FROM " . TABLE_RESTAURANT_USER_REVIEW_RELATIONS . " WHERE rest_id='".$rest_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			// Delete from TABLE_USER_CHECKLIST_SETTINGS
			$strDelQuery = "DELETE FROM " . TABLE_RESTAURANT_ZONE_RELATIONS . " WHERE rest_id='".$rest_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			// Delete from TABLE_RESTAURANT_BOOKING
			$strDelQuery = "DELETE FROM " . TABLE_RESTAURANT_BOOKING . " WHERE rest_id='".$rest_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			// Delete from TABLE_USER_FAVOURITE_RESTAURANTS
			$strDelQuery = "DELETE FROM " . TABLE_USER_FAVOURITE_RESTAURANTS . " WHERE restaurant_id='".$rest_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			// Delete from TABLE_MENU
			$strDelQuery = "DELETE FROM " . TABLE_MENU . " WHERE rest_id='".$rest_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			// Delete from TABLE_MENU_ITEM_RELATION
			$strDelQuery = "DELETE FROM " . TABLE_MENU_ITEM_RELATION . " WHERE rest_id='".$rest_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete previous relations

			// Delete from TABLE_RESTAURANT
			$strDelQuery = "DELETE FROM " . TABLE_RESTAURANT . " WHERE rest_id='".$rest_id."'";
			$this->dbObj->mySqlSafeQuery($strDelQuery);
			return true;
		}
	}
	// Function for deleting restaurant: End Here

	function fun_createRestaurantReviewAvgScore($rest_id) {
		if($rest_id == ''){
			return false;
		} else {
            $sql 	= "SELECT rest_rating FROM ". TABLE_RESTAURANT_USER_REVIEW_RELATIONS ." WHERE rest_id='".(int)$rest_id."' AND status ='2' AND active ='1' ";
			$rs 	= $this->dbObj->createRecordset($sql);
			$arr 	= $this->dbObj->fetchAssoc($rs);
			if(is_array($arr) && count($arr) > 0){
				$total_reviews 		= count($arr);
				$total_reviews_txt 	= ($total_reviews > 1)?$total_reviews." reviews":$total_reviews." review";
				$total_score 		= 0;
				foreach($arr as $value) {
					$total_score += (int)$value['rest_rating'];
				}
				$avg_score = (int)($total_score/$total_reviews);
				$percent_score = round(((($total_score/$total_reviews)/5)*100), 1);
				echo "<span class=\"font12\"><strong>Average customer rating</strong></span>";
				echo "<span class=\"pad-lft10 pad-top5\">";
				for ($k=0; $k < $avg_score; $k++ ) {
					echo "<img src=\"".SITE_IMAGES."star-rated.gif\" /> ";
				}
				for ($l = $avg_score; $l < 5; $l++ ) {
					echo "<img src=\"".SITE_IMAGES."star-notrated.gif\" /> ";
				}
				echo "</span>";
				if($total_reviews > 0 ) {
					echo "<span class=\"font12 red pad-left5\">".$percent_score."% (".$total_reviews_txt.")</span>";
				} else {
					echo "<span class=\"pad-left5\"> Not yet reviewed</span>";
				}
			} else {
				return false;
			}
		}
	}

	function fun_createRestaurantCustomerRating($rest_id) {
		if($rest_id == ''){
			return false;
		} else {
            $sql 	= "SELECT rest_rating FROM ". TABLE_RESTAURANT_USER_REVIEW_RELATIONS ." WHERE rest_id='".(int)$rest_id."' AND status ='2' AND active ='1' ";
			$rs 	= $this->dbObj->createRecordset($sql);
			$arr 	= $this->dbObj->fetchAssoc($rs);
			if(is_array($arr) && count($arr) > 0){
				$total_reviews 		= count($arr);
				$total_reviews_txt 	= ($total_reviews > 1)?$total_reviews." reviews":$total_reviews." review";
				$total_score 		= 0;
				foreach($arr as $value) {
					$total_score += (int)$value['rest_rating'];
				}
				$avg_score = (int)($total_score/$total_reviews);
				$percent_score = round(((($total_score/$total_reviews)/5)*100), 1);
				echo "<div class=\"FloatLft\"><strong>Customer Reviews =</strong></div>";
				echo "<div class=\"FloatLft pad-lft10\">";
				for ($k=0; $k < $avg_score; $k++ ) {
					echo "<img src=\"".SITE_IMAGES."star-rated.gif\" /> ";
				}
				for ($l = $avg_score; $l < 5; $l++ ) {
					echo "<img src=\"".SITE_IMAGES."star-notrated.gif\" /> ";
				}
				echo "</div>";
				
			} else {
				echo "<div class=\"FloatLft\"><strong>Customer Reviews =</strong></div>";
				echo "<div class=\"FloatLft pad-lft10\">";
				for ($l = 0; $l < 5; $l++ ) {
					echo "<img src=\"".SITE_IMAGES."star-notrated.gif\" /> ";
				}
				echo "</div>";
				//echo "<span class=\"pad-left3\"> Not yet reviewed</span>";
//				return false;
			}
		}
	}

	function fun_createRestaurantCustomerReview($rest_id) {
		if($rest_id == ''){
			return false;
		} else {
            $sql 	= "SELECT rest_rating FROM ". TABLE_RESTAURANT_USER_REVIEW_RELATIONS ." WHERE rest_id='".(int)$rest_id."' AND status ='2' AND active ='1' ";
			$rs 	= $this->dbObj->createRecordset($sql);
			$arr 	= $this->dbObj->fetchAssoc($rs);
			if(is_array($arr) && count($arr) > 0){
				$total_reviews 		= count($arr);
				$total_reviews_txt 	= ($total_reviews > 1)?$total_reviews." reviews":$total_reviews." review";
				$total_score 		= 0;
				foreach($arr as $value) {
					$total_score += (int)$value['rest_rating'];
				}
				$avg_score = (int)($total_score/$total_reviews);
				$percent_score = round(((($total_score/$total_reviews)/5)*100), 1);
				echo "<div class=\"FloatLft\"> ";
				for ($k=0; $k < $avg_score; $k++ ) {
					echo "<span><img src=\"".SITE_IMAGES."t.gif\" class=\"gui-icon-star gui-icon-sr-1\" /></span>\n";
				}
				for ($l = $avg_score; $l < 5; $l++ ) {
					echo "<span><img src=\"".SITE_IMAGES."t.gif\" class=\"gui-icon-star gui-icon-sr-2\" /></span>\n";
				}
				echo "</div>";
				if($total_reviews > 0 ) {
//					echo "<div class=\"FloatLft\"><span class=\"gray16Arial pad-left3\"> ".$percent_score."% </span><a href=\"holiday-restaurant-preview.php?pid=".$rest_id."#showSectionTop\" class=\"blue-link\">[".$total_reviews_txt."]</a></div>";
				} else {
//					echo "<span class=\"pad-left3 font11\"> Not yet reviewed</span>";
				}
			} else {
				echo "<div class=\"FloatLft\"> ";
				for ($l = 0; $l < 5; $l++ ) {
					echo "<span><img src=\"".SITE_IMAGES."t.gif\" class=\"gui-icon-star gui-icon-sr-2\" /></span>\n";
				}
				echo "</div>";
				
			}
		}
	}

	function fun_createRestaurantCustomerWriteReview($rest_id) {
		if($rest_id == ''){
			return false;
		} else {
			$strHTML = '';
            $sql 	= "SELECT rest_rating FROM ". TABLE_RESTAURANT_USER_REVIEW_RELATIONS ." WHERE rest_id='".(int)$rest_id."' AND status ='2' AND active ='1' ";
			$rs 	= $this->dbObj->createRecordset($sql);
			$arr 	= $this->dbObj->fetchAssoc($rs);
			if(is_array($arr) && count($arr) > 0){
				$restLocInfoArr 	= $this->fun_getRestaurantLocInfoArr($rest_id);
				$fr_url = $this->fun_getRestaurantFriendlyLink($rest_id);
				if(isset($fr_url) && $fr_url != "") {
					$restaurant_link 		= SITE_URL."vacation-rentals/".strtolower($fr_url);
				} else {
					if(isset($restLocInfoArr['city_name']) && $restLocInfoArr['city_name'] != "") {
						$restaurant_link = SITE_URL."restaurant/".str_replace(" ", "-", strtolower($restLocInfoArr['city_name']))."/".fill_zero_left($rest_id, "0", (6-strlen($rest_id)));
					} else {
						$restaurant_link = SITE_URL."restaurant/".str_replace(" ", "-", strtolower($restLocInfoArr['state_name']))."/".fill_zero_left($rest_id, "0", (6-strlen($rest_id)));
					}
				}
				$total_reviews 		= count($arr);
				$total_reviews_txt 	= ($total_reviews > 1)?$total_reviews." reviews":$total_reviews." review";
				$total_score 		= 0;
				foreach($arr as $value) {
					$total_score += (int)$value['rest_rating'];
				}
				$avg_score = (int)($total_score/$total_reviews);
				$percent_score = round(((($total_score/$total_reviews)/5)*100), 1);
				if($total_reviews > 0 ) {
					$strHTML .= '<div class="clear" style="width:98px;" align="left"><div style="background-image:url('.SITE_IMAGES.'review-bacground.gif); display:block; width:98px; height:38px; line-height:38px; text-align:center;"><span class="review-count"><a href="'.$restaurant_link.'#showSectionTop" class="blue-link">'.$total_reviews.'</a></span><span class="review-text"><a href="'.$restaurant_link.'#showSectionTop" class="blue-link">Read<br>Reviews</a></span></div></div>';
				} else {
					$strHTML .= '';
				}
			} else {
				$strHTML .= '';
			}
			echo $strHTML;
		}
	}

	// This function will Return Review information in array with front end data	
	function fun_getRestaurantReviewInfo($review_id){		
		$sql 	= "SELECT * FROM " . TABLE_RESTAURANT_USER_REVIEW_RELATIONS . " WHERE review_id='".$review_id."'";
		$rs 	= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			return $arr[0];
		} else {
			return false;
		}
	}

	function sendReviewEmailNotification($review_id) {
		if($review_id == false) {
			return false;		
		} else {
			//Step I: Collect review details by id
			//$usersObj 			= new Users();
			$reviewInfoArr 	= $this->fun_getRestaurantReviewInfo($review_id);
			$rest_id	 		= $reviewInfoArr['rest_id'];
			$rest_rating	 	= $reviewInfoArr['rest_rating'];
			$review_title	 	= $reviewInfoArr['review_title'];
			//$review_txt	 		= $reviewInfoArr['review_txt'];
			$user_fname	 		= $reviewInfoArr['user_fname'];
			$user_lname	 		= $reviewInfoArr['user_lname'];
			$user_name	 		= $user_fname." ".$user_lname;
			$user_email	 		= $reviewInfoArr['user_email'];
			//$user_country	 	= $reviewInfoArr['user_country'];
			//$status	 			= $reviewInfoArr['status'];
			//$active_on	 		= $reviewInfoArr['active_on'];
			//$active_by	 		= $reviewInfoArr['active_by'];
			//$created_on	 		= $reviewInfoArr['created_on'];
			//$created_by	 		= $reviewInfoArr['created_by'];
			//$updated_on	 		= $reviewInfoArr['updated_on'];
			//$updated_by	 		= $reviewInfoArr['updated_by'];
			//$active	 			= $reviewInfoArr['active'];

			$restInfoArr 		= $this->fun_getRestaurantInfo($rest_id);
			if(is_array($restInfoArr) && count($restInfoArr) > 0) {
				$review_html 		= "";
				$rest_name			= $restInfoArr['rest_name'];
				$restLocInfoArr 	= $this->fun_getRestaurantLocInfoArr($rest_id);
				$propLoc = "";
				if($restLocInfoArr['country_name'] !=""){
					$propLoc .= "<a href=\"".SITE_URL."restaurants/".str_replace("/", "_", str_replace(" ", "-", strtolower($restLocInfoArr['country_name'])))."\" >".ucwords($restLocInfoArr['country_name'])."</a> > ";
				}
				if($restLocInfoArr['state_name'] !=""){
					$propLoc .= "<a href=\"".SITE_URL."restaurants/".str_replace("/", "_", str_replace(" ", "-", strtolower($restLocInfoArr['state_name'])))."\" >".ucwords($restLocInfoArr['state_name'])."</a> > ";
				}
				if($restLocInfoArr['city_name'] !=""){
					$propLoc .= "<a href=\"".SITE_URL."restaurants/".str_replace("/", "_", str_replace(" ", "-", strtolower($restLocInfoArr['city_name'])))."\" >".ucwords($restLocInfoArr['city_name'])."</a> > ";
				}
				$propLoc .= ucfirst($rest_name)." ref:".fill_zero_left($rest_id, "0", (6-strlen($rest_id)));
			
				$fr_url = $this->fun_getRestaurantFriendlyLink($rest_id);
				if(isset($fr_url) && $fr_url != "") {
					$restaurant_link 	= SITE_URL."restaurant/".strtolower($fr_url);
				} else {
					if(isset($restLocInfoArr['city_name']) && $restLocInfoArr['city_name'] != "") {
						$restaurant_link = SITE_URL."restaurant/".str_replace(" ", "-", strtolower($restLocInfoArr['city_name']))."/".fill_zero_left($rest_id, "0", (6-strlen($rest_id)));
					} else {
						$restaurant_link = SITE_URL."restaurant/".str_replace(" ", "-", strtolower($restLocInfoArr['state_name']))."/".fill_zero_left($rest_id, "0", (6-strlen($rest_id)));
					}
				}

				$review_html .= "<table width=\"490\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
				$review_html .= "<tr>";
				$review_html .= "<td colspan\"2\">New user review submitted for <strong>".$rest_name." (".fill_zero_left($rest_id, "0", (6-strlen($rest_id))).")</strong>, details are as below:</td>";
				$review_html .= "</tr>";
				$review_html .= "<tr>";
				$review_html .= "<td width=\"96\" valign=\"top\"><strong>Review ID</strong></td>";
				$review_html .= "<td width=\"390\" valign=\"top\">".fill_zero_left($review_id, "0", (6-strlen($review_id)))."</td>";
				$review_html .= "</tr>";
				$review_html .= "<tr>";
				$review_html .= "<td valign=\"top\"><strong>Title</strong></td>";
				$review_html .= "<td valign=\"top\">".$review_title."</td>";
				$review_html .= "</tr>";
				$review_html .= "<tr>";
				$review_html .= "<tr>";
				$review_html .= "<td valign=\"top\"><strong>From</strong></td>";
				$review_html .= "<td valign=\"top\">".$user_name."</td>";
				$review_html .= "</tr>";
				$review_html .= "<tr>";
				$review_html .= "<td valign=\"top\"><strong>Email</strong></td>";
				$review_html .= "<td valign=\"top\"><a href=\"mailto:".$user_email."\" style=\"color:#357bdc; text-decoration: none;\" >".$user_email."</a></td>";
				$review_html .= "</tr>";
				$review_html .= "<td valign=\"top\">&nbsp;</td>";
				$review_html .= "</table>";
				
				$body = "<table width=\"80%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
				$body .= "<tr>";
				$body .= "<td valign=\"top\">";
				$body .= "<strong>Dear Admin, <br>You've just received a new user review.</strong><br><br>";
				$body .= $review_html;
				$body .= "Regards,<br>The ".$_SERVER["SERVER_NAME"]." Team<br><br><hr>";
				$body .= "</td>";
				$body .= "</tr>";
				$body .= "</table>";

				//Notification to admin
				$emailObj = new Email("admin@unitedrestaurants.com", SITE_ADMIN_EMAIL, "You've just received a new user review on ".$_SERVER["SERVER_NAME"], $body);
				$emailObj->sendEmail();
			}
			return true;
		}
	}

/*
* Restaurant reviews specific functions : end here
*/

	// Function for creating Numeric Select field for various restaurant attributes
	function fun_createSelectNumField($name='', $id='', $class='', $selected='', $onchange='', $from='', $to=''){		
		echo "<select name='".$name."' id='".$id."' class='".$class."'  onchange='".$onchange."' >";
		echo "<option value=\"\">---</option>";
		for($i=$from; $i <= $to; $i++){
			if($i == $selected){
				echo "<option value='$i' selected>$i</option>";
			} else {
				echo "<option value='$i'>$i</option>";
			}
		}
		echo "</select>";
	}

	// Function for creating Pieces Select field for various restaurant attributes
	function fun_createSelectPiecesField($name='', $id='', $class='', $selected='', $onchange='', $from='', $to=''){		
		echo "<select name='".$name."' id='".$id."' class='".$class."'  onchange='".$onchange."' >";
		echo "<option value=\"\">---</option>";
		for($i=$from; $i <= $to; $i++){
			if($i == $selected){
				echo "<option value='$i' selected>$i</option>";
			} else {
				echo "<option value='$i'>$i</option>";
			}
		}
		echo "</select>";
	}

	// Function for creating Pieces Select field for various restaurant attributes
	function fun_createSelectSMLField($name='', $id='', $class='', $selected='', $onchange=''){		
		echo "<select name='".$name."' id='".$id."' class='".$class."'  onchange='".$onchange."' >";
		//echo "<option value=\"\">---</option>";
		//1=small, 2=medium, 3=large
		echo "<option value='1' ".(($selected == "1")?'selected':'').">Small</option>";
		echo "<option value='2' ".(($selected == "2")?'selected':'').">Medium</option>";
		echo "<option value='3' ".(($selected == "3")?'selected':'').">Large</option>";
		echo "</select>";
	}

	// Function for creating Pieces Select field for various restaurant attributes
	function fun_createSelectSDField($name='', $id='', $class='', $selected='', $onchange=''){		
		echo "<select name='".$name."' id='".$id."' class='".$class."'  onchange='".$onchange."' >";
		//echo "<option value=\"\">---</option>";
		//1=small, 2=medium, 3=large
		echo "<option value='1' ".(($selected == "1")?'selected':'').">Single</option>";
		echo "<option value='2' ".(($selected == "2")?'selected':'').">Double</option>";
		echo "</select>";
	}


	// Function for creating Yes / No Select field for various restaurant attributes
	function fun_createSelectYesNoField($name='', $id='', $class='', $selected='', $onchange=''){		
		echo "<select name='".$name."' id='".$id."' class='".$class."'  onchange='".$onchange."' >";
			if($selected == "1"){
				echo "<option value='1' selected>Yes</option>";
				echo "<option value='0'>No</option>";
			} else {
				echo "<option value='1'>Yes</option>";
				echo "<option value='0' selected>No</option>";
			}
		echo "</select>";
	}

/*
* order functions : start here
*/	
	// Function for Order Info
	function fun_getOrderInfoById($order_id){
		$sql 		= "SELECT * FROM " . TABLE_ORDERS . " AS A WHERE A.order_id='".$order_id."'";
		$rs 		= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			return $arr[0];
		} else {
			return false;
		}
	}

	// Function for orders array
	function fun_getOrderArr($parameter = ''){
		$sql = "SELECT * FROM " . TABLE_ORDERS . " AS A";
		if($parameter != ""){
			$sql .= $parameter;
		} else {
			$sql .= " ORDER BY A.order_id DESC";		
		}
		return $rs = $this->dbObj->createRecordset($sql);
	}

	function fun_getNewOrderByRestId($rest_id) {
        if($rest_id == "") {
            return false;
        } else {
			//Step I: find order details
			$sql 	= "SELECT A.order_id FROM " . TABLE_ORDERS . " AS A 
			WHERE A.orders_status='1' 
			AND A.order_id IN (SELECT order_id FROM " . TABLE_ORDERS_PRODUCTS . " WHERE rest_id='".$rest_id."' GROUP BY order_id) ";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr 		= $this->dbObj->fetchAssoc($rs);
				$order_id	= $arr[0]['order_id'];
				return $order_id;
			} else {
				return false;
			}
        }
	}

	// Function for orders array
	function fun_getManagerOrderArr($user_id, $parameter = ''){
		//Step I: find restaurant id of this manager
		$sql 		= "SELECT A.order_id  FROM " . TABLE_ORDERS_PRODUCTS . " AS A WHERE A.rest_id IN (SELECT rest_id FROM " . TABLE_RESTAURANT_MANAGER_RELATIONS . " WHERE manager_id='".$user_id."') GROUP BY A.order_id";
		$rs 		= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			$ordArr = array();
			for($i=0; $i< count($arr); $i++) {
				array_push($ordArr, $arr[$i]['order_id']);
			}
			
			$strOrd = implode(",", $ordArr);
			$sqlOrd = "SELECT * FROM " . TABLE_ORDERS . " AS A WHERE A.order_id IN (".$strOrd.") ";
			if($parameter != ""){
				$sqlOrd .= $parameter;
			} else {
				$sqlOrd .= " ORDER BY A.order_id DESC";		
			}
			//echo $sqlOrd;
			return $rsOrd = $this->dbObj->createRecordset($sqlOrd);
		} else {
			return false;
		}
	}

	//Function to create order view
	function fun_createOrderView($order_id) {
		$sql 	= "SELECT * FROM " . TABLE_ORDERS . " WHERE order_id='".$order_id."'";
		$rs 	= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 					= $this->dbObj->fetchAssoc($rs);
			$user_id 				= $arr[0]['user_id'];
			$delivery_fname 		= $arr[0]['delivery_fname'];
			$delivery_lname 		= $arr[0]['delivery_lname'];
			$delivery_address1 		= $arr[0]['delivery_address1'];
			$delivery_address2 		= $arr[0]['delivery_address2'];
			$delivery_city 			= $arr[0]['delivery_city'];
			$delivery_state 		= $arr[0]['delivery_state'];
			$delivery_country 		= $arr[0]['delivery_country'];
			$delivery_zip 			= $arr[0]['delivery_zip'];
			$delivery_phone 		= $arr[0]['delivery_phone'];
			$dtype 					= $arr[0]['dtype'];
			$schedule 				= $arr[0]['schedule'];
			$order_comments 		= $arr[0]['order_comments'];
			$payment_method 		= $arr[0]['payment_method'];
			$cc_type 				= $arr[0]['cc_type'];
			$cc_owner 				= $arr[0]['cc_owner'];
			$cc_number 				= $arr[0]['cc_number'];
			$cc_expires 			= $arr[0]['cc_expires'];
			$final_price 			= $arr[0]['final_price'];
			$currency_id 			= $arr[0]['currency_id'];
			$last_modified 			= $arr[0]['last_modified'];
			$date_purchased 		= $arr[0]['date_purchased'];
			$orders_status 			= $arr[0]['orders_status'];
			$orders_date_finished 	= $arr[0]['orders_date_finished'];

			$delivery_name 			= ucwords($delivery_fname.' '.$delivery_lname);
			$addressArr 			= array();
			if($delivery_address1 != "") {
				array_push($addressArr, $delivery_address1);
			}
			if($delivery_address2 != "") {
				array_push($addressArr, $delivery_address2);
			}
			if($delivery_city != "") {
				array_push($addressArr, $delivery_city);
			}
			if($delivery_state != "") {
				array_push($addressArr, $delivery_state);
			}
			if($delivery_zip != "") {
				array_push($addressArr, $delivery_zip);
			}
			$address 				= implode(", ", $addressArr);
			$schedule_for 			= $schedule.' ['.ucfirst($dtype).']';
			if(isset($orders_status) && $orders_status != "") {
				switch($orders_status) {
					case '1':
						$status = "New order";
					break;
					case '2':
						$status = "Pending";
					break;
					case '3':
						$status = "PayPal Preparation";
					break;
					case '4':
						$status = "Complete";
					break;
					case '5':
						$status = "Cancel";
					break;
					default:
						$status = "New order";
				}
			} else {
				$status = "New order";
			}

			if(isset($payment_method) && $payment_method != "") {
				switch($payment_method) {
					case '1':
						$payment_method_name = "Cash";
					break;
					case '2':
						$payment_method_name = "PayPal";
					break;
					case '3':
						$payment_method_name = "Credit Card";
					break;
					default:
						$payment_method_name = "Cash";
				}
			} else {
				$payment_method_name = "Cash";
			}
			$currencyRateArr 	= $this->fun_findCurrencyRate();
			$currencyArr		= $this->fun_getCurrencyInfo($currency_id);
			$currency_symbol	= $currencyArr['currency_symbol'];
			$currency_code		= $currencyArr['currency_code'];
			$rest_id 			= $this->fun_getRestIdByOrderId($order_id);
			$restInfoArr		= $this->fun_getRestaurantInfo($rest_id);
			$Arr 				= array();
			array_push($Arr, $restInfoArr['rest_name'].", ".$restInfoArr['rest_address1']." ".$restInfoArr['rest_address2']);
			if(isset($restInfoArr['rest_city_id']) && $restInfoArr['rest_city_id'] !="") {
				$city_name = $this->dbObj->getField(TABLE_CITY, "city_id", $restInfoArr['rest_city_id'], "city_name");
				array_push($Arr, $city_name);
			}
			if(isset($restInfoArr['rest_state_id']) && $restInfoArr['rest_state_id'] !="") {
				$state_name = $this->dbObj->getField(TABLE_STATE, "state_id", $restInfoArr['rest_state_id'], "state_name");
				array_push($Arr, $state_name);
			}
			if(isset($restInfoArr['rest_country_id']) && $restInfoArr['rest_country_id'] !="") {
				$country_name = $this->dbObj->getField(TABLE_COUNTRY, "country_id", $restInfoArr['rest_country_id'], "country_name");
				array_push($Arr, $country_name);
			}
			if(isset($restInfoArr['rest_zip']) && $restInfoArr['rest_zip'] !="") {
				array_push($Arr, $restInfoArr['rest_zip']);
			}
			$rest_phone = $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "phone");

			if(isset($rest_phone) && $rest_phone !="") {
				array_push($Arr, "Phone: ".$rest_phone);
			}

			$strRest 			= implode(", ", $Arr);

			$strHTML = '';
			$strHTML .= '<div style="padding:5px; border:thin #ccc solid;">';
			$strHTML .= '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
			$strHTML .= '<tr><td colspan="2">'.$strRest.'</td></tr>';
			$strHTML .= '<tr><td colspan="2" style="height:3px; border-bottom:thin #ccc dotted;"></td></tr>';
			$strHTML .= '<tr>';
			$strHTML .= '<td width="25%" align="right" valign="top" class="pad-top5 pad-btm5 pad-rgt5"><strong>Order ID</strong></td>';
			$strHTML .= '<td width="75%" align="left" valign="top" class="pad-top5 pad-btm5 pad-lft5">: '.fill_zero_left($order_id, "0", (6-strlen($order_id))).'</td>';
			$strHTML .= '</tr>';
			$strHTML .= '<tr><td colspan="2" style="height:3px; border-bottom:thin #ccc dotted;"></td></tr>';
			$strHTML .= '<tr>';
			$strHTML .= '<td align="right" valign="top" class="pad-top5 pad-btm5 pad-rgt5"><strong>Order Datetime</strong></td>';
			$strHTML .= '<td align="left" valign="top" class="pad-top5 pad-btm5 pad-lft5">: '.date('Y-m-d H:i:s', $date_purchased).'</td>';
			$strHTML .= '</tr>';
			$strHTML .= '<tr><td colspan="2" style="height:3px; border-bottom:thin #ccc dotted;"></td></tr>';
			$strHTML .= '<tr>';
			$strHTML .= '<td align="right" valign="top" class="pad-top5 pad-btm5 pad-rgt5"><strong>Customer Name</strong></td>';
			$strHTML .= '<td align="left" valign="top" class="pad-top5 pad-btm5 pad-lft5">: '.$delivery_name.'</td>';
			$strHTML .= '</tr>';
			$strHTML .= '<tr><td colspan="2" style="height:3px; border-bottom:thin #ccc dotted;"></td></tr>';
			$strHTML .= '<tr>';
			$strHTML .= '<td align="right" valign="top" class="pad-top5 pad-btm5 pad-rgt5"><strong>Phone</strong></td>';
			$strHTML .= '<td align="left" valign="top" class="pad-top5 pad-btm5 pad-lft5">: '.$delivery_phone.'</td>';
			$strHTML .= '</tr>';
			$strHTML .= '<tr><td colspan="2" style="height:3px; border-bottom:thin #ccc dotted;"></td></tr>';
			$strHTML .= '<tr>';
			$strHTML .= '<td align="right" valign="top" class="pad-top5 pad-btm5 pad-rgt5"><strong>Address</strong></td>';
			$strHTML .= '<td align="left" valign="top" class="pad-top5 pad-btm5 pad-lft5">: '.$address.'</td>';
			$strHTML .= '</tr>';
			$strHTML .= '<tr><td colspan="2" style="height:3px; border-bottom:thin #ccc dotted;"></td></tr>';
			$strHTML .= '<tr>';
			$strHTML .= '<td align="right" valign="top" class="pad-top5 pad-btm5 pad-rgt5"><strong>Schedule For</strong></td>';
			$strHTML .= '<td align="left" valign="top" class="pad-top5 pad-btm5 pad-lft5">: '.$schedule_for.'</td>';
			$strHTML .= '</tr>';
			$strHTML .= '<tr><td colspan="2" style="height:3px; border-bottom:thin #ccc dotted;"></td></tr>';
			$strHTML .= '<tr>';
			$strHTML .= '<td align="right" valign="top" class="pad-top5 pad-btm5 pad-rgt5"><strong>Order Price</strong></td>';
			$strHTML .= '<td align="left" valign="top" class="pad-top5 pad-btm5 pad-lft5">: '.$currency_symbol.number_format($final_price, 2).'</td>';
			$strHTML .= '</tr>';
			$strHTML .= '<tr><td colspan="2" style="height:3px; border-bottom:thin #ccc dotted;"></td></tr>';
			$strHTML .= '<tr>';
			$strHTML .= '<td align="right" valign="top" class="pad-top5 pad-btm5 pad-rgt5"><strong>Payment Method</strong></td>';
			$strHTML .= '<td align="left" valign="top" class="pad-top5 pad-btm5 pad-lft5">: '.$payment_method_name.'</td>';
			$strHTML .= '</tr>';
			$strHTML .= '<tr><td colspan="2" style="height:3px; border-bottom:thin #ccc dotted;"></td></tr>';
			$strHTML .= '<tr>';
			$strHTML .= '<td align="right" valign="top" class="pad-top5 pad-btm5 pad-rgt5"><strong>Status</strong></td>';
			$strHTML .= '<td align="left" valign="top" class="pad-top5 pad-btm5 pad-lft5">: '.$status.'</td>';
			$strHTML .= '</tr>';
			$strHTML .= '<tr><td colspan="2" style="height:3px; border-bottom:thin #ccc dotted;"></td></tr>';
			$strHTML .= '<tr>';
			$strHTML .= '<td align="right" valign="top" class="pad-top5 pad-btm5 pad-rgt5"><strong>Comments</strong></td>';
			$strHTML .= '<td align="left" valign="top" class="pad-top5 pad-btm5 pad-lft5">: '.$order_comments.'</td>';
			$strHTML .= '</tr>';
			$strHTML .= '<tr><td colspan="2" style="height:3px; border-bottom:thin #ccc dotted;"></td></tr>';
			$strHTML .= '<tr>';
			$strHTML .= '<td align="right" valign="top" class="pad-top5 pad-btm5 pad-rgt5"><strong>Details</strong></td>';
			$strHTML .= '<td align="left" valign="top" class="pad-top5 pad-btm5 pad-lft5">';
				//Order menu details
				$sqlOdr 	= "SELECT * FROM " . TABLE_ORDERS_PRODUCTS . " WHERE order_id='".$order_id."'";
				$rsOdr 	= $this->dbObj->createRecordset($sqlOdr);
				if($this->dbObj->getRecordCount($rsOdr) > 0){
					$arrOdr 		= $this->dbObj->fetchAssoc($rsOdr);
					$sub_total 	= 0;
					$tax 		= 0;
					$rest_id 	= $arrOdr[0]['rest_id'];
					$rest_name 	= $this->dbObj->getField(TABLE_RESTAURANT, "rest_id", $rest_id, "rest_name");
					//display cart items
					$strHTML .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="dyn-row">';
					$strHTML .= '<tr>';
					$strHTML .= '<td colspan="4" class="pad-top5 pad-btm5 pad-lft5" style="color:#0000ff;"><strong>Restaurant: '.ucwords($rest_name).'</strong></td>';
					$strHTML .= '</tr>';
					$strHTML .= '<tr>';
					$strHTML .= '<td width="5%" class="pad-top5 pad-btm5 pad-lft5">&nbsp;</td>';
					$strHTML .= '<td width="70%" class="pad-top5 pad-btm5 pad-lft5"><strong>Menu</strong></td>';
					$strHTML .= '<td width="10%" class="pad-top5 pad-btm5 pad-lft5"><strong>Qty</strong></td>';
					$strHTML .= '<td width="15%" class="pad-top5 pad-btm5 pad-lft5"><strong>Price</strong></td>';
					$strHTML .= '</tr>';
					for($i=0; $i < count($arrOdr); $i++) {
						$orders_products_id 	= $arrOdr[$i]['orders_products_id'];
						$order_id 				= $arrOdr[$i]['order_id'];
						$product_id 			= $arrOdr[$i]['product_id'];
						$rest_id 				= $arrOdr[$i]['rest_id'];
						$products_price 		= $arrOdr[$i]['products_price'];
						$final_price 			= $arrOdr[$i]['final_price'];
						$products_tax 			= $arrOdr[$i]['products_tax'];
						$quantity 				= $arrOdr[$i]['quantity'];
						$comment 				= $arrOdr[$i]['comment'];
						$menu_name 				= $this->dbObj->getField(TABLE_MENU, "menu_id", $product_id, "menu_name");
	
						$strHTML .= '<tr>';
						$strHTML .= '<td valign="top" class="pad-top5 pad-btm5 pad-lft5"><strong>('.($i+1).')</strong></td>';
						$strHTML .= '<td class="pad-top5 pad-btm5 pad-lft5">';
						$strHTML .= '<strong>'.$menu_name.'</strong><br><b>Instructions:</b><em>'.$comment.'</em><br><br>';
						//menu option will be here
						// Step I: get option array of order proucts
						$sqlOpt 	= "SELECT product_option_id FROM " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " WHERE orders_products_id='".$orders_products_id."'";
						$rsOpt 		= $this->dbObj->createRecordset($sqlOpt);
						if($this->dbObj->getRecordCount($rsOpt) > 0){
							$optionsArr = array();
							$arrOpt = $this->dbObj->fetchAssoc($rsOpt);
							for($j=0; $j < count($arrOpt); $j++) {
								array_push($optionsArr, $arrOpt[$j]['product_option_id']);
							}
							// Step II: get category array of having those options
							$option_ids 	= implode(",", $optionsArr);
							$sqlOrderOptCat = "SELECT A.category_id, A.category_name, A.display_type
							FROM " . TABLE_MENU_OPTION_CATEGORY . " AS A  
							WHERE A.category_id IN (SELECT category_id  FROM " . TABLE_MENU_OPTION . " WHERE option_id IN (".$option_ids.") GROUP BY category_id)";
							$rsOrderOptCat 		= $this->dbObj->createRecordset($sqlOrderOptCat);
							if($this->dbObj->getRecordCount($rsOrderOptCat) > 0) {
								$arrOrderOptCat 	= $this->dbObj->fetchAssoc($rsOrderOptCat);
								for($counter = 0; $counter < count($arrOrderOptCat); $counter++) {
									$category_id 	= $arrOrderOptCat[$counter]['category_id'];
									$category_name 	= $arrOrderOptCat[$counter]['category_name'];
									$display_type 	= $arrOrderOptCat[$counter]['display_type'];
									$strHTML .= '<span style="width:auto;margin:0px; padding-right:5px; background-color:#fdf095;"><strong>'.ucwords($category_name).'</strong>:</span>';
									$strHTML .= '<ul style="list-style:none; display:inline; margin-left:-35px; padding-right:5px;">';
									$sql 			= "SELECT A.option_id, A.option_name  FROM " . TABLE_MENU_OPTION . " AS A WHERE A.category_id='".$category_id."' AND A.option_id IN (".$option_ids.") ";
									$rs 			= $this->dbObj->createRecordset($sql);
									if($this->dbObj->getRecordCount($rs) > 0){
										$arr 		= $this->dbObj->fetchAssoc($rs);
										for($k=0; $k < count($arr); $k++) {
											$strHTML .= '<li style="display:inline; width:auto;">&bull;&nbsp;'.ucwords($arr[$k]['option_name']).' </li>';
										}
									}
									$strHTML .= '<li style="list-style:none;display:inline;"><strong>;</strong></li>';
									$strHTML .= '</ul>';
								}
							}
						}
						$strHTML .= '</td>';
						$strHTML .= '<td class="pad-top5 pad-btm5 pad-lft5">'.$quantity.'</td>';
						$strHTML .= '<td class="pad-top5 pad-btm5 pad-lft5">'.$currency_symbol.number_format($final_price, 2).'</td>';
						$strHTML .= '</tr>';
					}
					$strHTML .= '</table>';
				}
			$strHTML .= '</td>';
			$strHTML .= '</tr>';
			$strHTML .= '<tr><td colspan="2" style="height:3px; border-bottom:thin #ccc dotted;"></td></tr>';

			$strHTML .= '<tr><td colspan="2">&nbsp;</td></tr>';
			$strHTML .= '</table>';
			$strHTML .= '</div>';
			return $strHTML;
		} else {
			return false;
		}
	}

	//Function to create order view for printer
	function fun_createOrderViewPrinter($order_id) {
		$sql 	= "SELECT * FROM " . TABLE_ORDERS . " WHERE order_id='".$order_id."' AND orders_status NOT IN (4,5) ";
		$rs 	= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$str = '#';
			$arr 					= $this->dbObj->fetchAssoc($rs);
			$user_id 				= $arr[0]['user_id'];
			$delivery_fname 		= $arr[0]['delivery_fname'];
			$delivery_lname 		= $arr[0]['delivery_lname'];
			$delivery_address1 		= $arr[0]['delivery_address1'];
			$delivery_address2 		= $arr[0]['delivery_address2'];
			$delivery_city 			= $arr[0]['delivery_city'];
			$delivery_state 		= $arr[0]['delivery_state'];
			$delivery_country 		= $arr[0]['delivery_country'];
			$delivery_zip 			= $arr[0]['delivery_zip'];
			$dtype 					= $arr[0]['dtype'];
			$schedule 				= $arr[0]['schedule'];
			$order_comments 		= $arr[0]['order_comments'];
			$payment_method 		= $arr[0]['payment_method'];
			$cc_type 				= $arr[0]['cc_type'];
			$cc_owner 				= $arr[0]['cc_owner'];
			$cc_number 				= $arr[0]['cc_number'];
			$cc_expires 			= $arr[0]['cc_expires'];
			$final_price 			= $arr[0]['final_price'];
			$currency_id 			= $arr[0]['currency_id'];
			$last_modified 			= $arr[0]['last_modified'];
			$date_purchased 		= $arr[0]['date_purchased'];
			$orders_status 			= $arr[0]['orders_status'];
			$orders_date_finished 	= $arr[0]['orders_date_finished'];

			$delivery_name 			= ucwords($delivery_fname.' '.$delivery_lname);
			$addressArr 			= array();
			if($delivery_address1 != "") {
				array_push($addressArr, $delivery_address1);
			}
			if($delivery_address2 != "") {
				array_push($addressArr, $delivery_address2);
			}
			if($delivery_city != "") {
				array_push($addressArr, $delivery_city);
			}
			if($delivery_state != "") {
				array_push($addressArr, $delivery_state);
			}
			if($delivery_zip != "") {
				array_push($addressArr, $delivery_zip);
			}
			$address 				= implode(", ", $addressArr);
			$schedule_for 			= $schedule.' ['.ucfirst($dtype).']';
			if(isset($orders_status) && $orders_status != "") {
				switch($orders_status) {
					case '1':
						$status = "New order";
					break;
					case '2':
						$status = "Pending";
					break;
					case '3':
						$status = "PayPal Preparation";
					break;
					case '4':
						$status = "Complete";
					break;
					case '5':
						$status = "Cancel";
					break;
					default:
						$status = "New order";
				}
			} else {
				$status = "New order";
			}

			if(isset($payment_method) && $payment_method != "") {
				switch($payment_method) {
					case '1':
						$payment_method_name = "Cash";
					break;
					case '2':
						$payment_method_name = "PayPal";
					break;
					case '3':
						$payment_method_name = "Credit Card";
					break;
					default:
						$payment_method_name = "Cash";
				}
			} else {
				$payment_method_name = "Cash";
			}
			//Order menu details
			$sqlOdr 	= "SELECT * FROM " . TABLE_ORDERS_PRODUCTS . " WHERE order_id='".$order_id."'";
			$rsOdr 	= $this->dbObj->createRecordset($sqlOdr);
			if($this->dbObj->getRecordCount($rsOdr) > 0){
				$arrOdr 		= $this->dbObj->fetchAssoc($rsOdr);
				$sub_total 	= 0;
				$tax 		= 0;
				$rest_id 	= $arrOdr[0]['rest_id'];
				$rest_name 	= $this->dbObj->getField(TABLE_RESTAURANT, "rest_id", $rest_id, "rest_name");
				$rest_name 	= $this->dbObj->getField(TABLE_RESTAURANT, "rest_id", $rest_id, "rest_name");

				$delivery_charge= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "delivery_charge");
				if(!is_numeric($delivery_charge)) {
					$delivery_charge = 0;
				}

				//display cart items
				$delivery_type = ($dtype="pickup")?2:1;
				$str .= $rest_id.'*'.$delivery_type.'*'.fill_zero_left($order_id, "0", (6-strlen($order_id)));
				//$str .= $rest_id."*".$delivery_type."*".fill_zero_left($order_id, "0", (6-strlen($order_id))).'*'.$delivery_name.';'.$address.';*'.$schedule_for.'*$'.number_format($final_price, 2).';'.$payment_method_name.';'.$order_comments.';';
				//$str .= '\rRestaurant:\r'.ucwords($rest_name).';';
				for($i=0; $i < count($arrOdr); $i++) {
					$orders_products_id 	= $arrOdr[$i]['orders_products_id'];
					$order_id 				= $arrOdr[$i]['order_id'];
					$product_id 			= $arrOdr[$i]['product_id'];
					$rest_id 				= $arrOdr[$i]['rest_id'];
					$products_price 		= $arrOdr[$i]['products_price'];
					$final_price 			= $arrOdr[$i]['final_price'];
					$products_tax 			= $arrOdr[$i]['products_tax'];
					$quantity 				= $arrOdr[$i]['quantity'];
					$comment 				= $arrOdr[$i]['comment'];
					$menu_name 				= $this->dbObj->getField(TABLE_MENU, "menu_id", $product_id, "menu_name");
					$str .= '*'.$quantity.';'.$menu_name.';$'.number_format($final_price, 2).';';

					//menu option will be here
					// Step I: get option array of order proucts
					$sqlOpt 	= "SELECT product_option_id FROM " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " WHERE orders_products_id='".$orders_products_id."'";
					$rsOpt 		= $this->dbObj->createRecordset($sqlOpt);
					if($this->dbObj->getRecordCount($rsOpt) > 0){
						$comment = '';
						$optionsArr = array();
						$arrOpt = $this->dbObj->fetchAssoc($rsOpt);
						for($j=0; $j < count($arrOpt); $j++) {
							array_push($optionsArr, $arrOpt[$j]['product_option_id']);
						}
						// Step II: get category array of having those options
						$option_ids 	= implode(",", $optionsArr);
						$sqlOrderOptCat = "SELECT A.category_id, A.category_name, A.display_type
						FROM " . TABLE_MENU_OPTION_CATEGORY . " AS A  
						WHERE A.category_id IN (SELECT category_id  FROM " . TABLE_MENU_OPTION . " WHERE option_id IN (".$option_ids.") GROUP BY category_id)";
						$rsOrderOptCat 		= $this->dbObj->createRecordset($sqlOrderOptCat);
						if($this->dbObj->getRecordCount($rsOrderOptCat) > 0) {
							$arrOrderOptCat 	= $this->dbObj->fetchAssoc($rsOrderOptCat);
							for($counter = 0; $counter < count($arrOrderOptCat); $counter++) {
								$category_id 	= $arrOrderOptCat[$counter]['category_id'];
								$category_name 	= $arrOrderOptCat[$counter]['category_name'];
								$display_type 	= $arrOrderOptCat[$counter]['display_type'];
								$comment .= '*'.ucwords($category_name).':';
								$sql 			= "SELECT A.option_id, A.option_name  FROM " . TABLE_MENU_OPTION . " AS A WHERE A.category_id='".$category_id."' AND A.option_id IN (".$option_ids.") ";
								$rs 			= $this->dbObj->createRecordset($sql);
								if($this->dbObj->getRecordCount($rs) > 0){
									$arr 		= $this->dbObj->fetchAssoc($rs);
									for($k=0; $k < count($arr); $k++) {
										$comment .= ucwords($arr[$k]['option_name']).',';
									}
								}
							}
						}
					}
				}
				$str .= '*'.$$delivery_charge.'*0;$'.number_format($final_price, 2).';4;'.$delivery_name.';'.$address.';'.$schedule_for.';;7;cod:;;';
				$str .= '*'.$comment;
			}
			$str .= '#';
			ob_start();
			ob_clean();
			echo $str;
			ob_end_flush();
			flush();
		} else {
			return false;
		}
	}

	// Function for add new order
	function fun_addNewOrder($user_id, $delivery_fname = '', $delivery_lname = '', $delivery_address1 = '', $delivery_address2 = '', $delivery_city = '', $delivery_state = '', $delivery_country = '', $delivery_zip = '', $delivery_phone = '', $dtype = '', $schedule = '', $order_comments = '', $payment_method = '', $cc_type = '', $cc_owner = '', $cc_number = '', $cc_expires = '', $final_price = '', $currency_id = '', $orders_status = ''){
		if($user_id == "") {
			return false;
		} else {
			if($this->fun_checkCartNoEmpty($user_id) == true) {
				$cur_unixtime 		= time ();
				//Step I: add new order
				$strInsQuery 	= "INSERT INTO " . TABLE_ORDERS . "(order_id, user_id, delivery_fname, delivery_lname, delivery_address1, delivery_address2, delivery_city, delivery_state, delivery_country, delivery_zip, delivery_phone, dtype, schedule, order_comments, payment_method, cc_type, cc_owner, cc_number, cc_expires, final_price, currency_id, last_modified, date_purchased, orders_status, orders_date_finished) ";
				$strInsQuery 	.= "VALUES(null, '".$user_id."', '".$delivery_fname."', '".$delivery_lname."', '".$delivery_address1."', '".$delivery_address2."', '".$delivery_city."', '".$delivery_state."', '".$delivery_country."', '".$delivery_zip."', '".$delivery_phone."', '".$dtype."', '".$schedule."', '".$order_comments."', '".$payment_method."', '".$cc_type."', '".$cc_owner."', '".$cc_number."', '".$cc_expires."', '".$final_price."', '".$currency_id."', '".$cur_unixtime."', '".$cur_unixtime."', '".$orders_status."', '".$orders_date_finished."')";
				$this->dbObj->mySqlSafeQuery($strInsQuery);
				$order_id 		= $this->dbObj->getIdentity();

				//Step II: find rest_id, tex and delivery charges
				$rest_id	= $this->dbObj->getField(TABLE_USER_CART, "user_id", $user_id, "rest_id");
				$tax 		= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "tax");
				if(!is_numeric($tax)) {
					$tax 	= 0;
				}
				$delivery_charge= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "delivery_charge");
				if(!is_numeric($delivery_charge) || ($dtype =="pickup")) {
					$delivery_charge = 0;
				}

				//Step II: add products in ires_orders_products
				$sql 			= "SELECT * FROM " . TABLE_USER_CART . " WHERE user_id='".$user_id."'";
				$rs 			= $this->dbObj->createRecordset($sql);
				if($this->dbObj->getRecordCount($rs) > 0){
					$sub_total 					= '';
					$arr 						= $this->dbObj->fetchAssoc($rs);
					for($i=0; $i < count($arr); $i++) {
						$user_basket_id 		= $arr[$i]['user_basket_id'];
						$user_id 				= $arr[$i]['user_id'];
						$product_id 			= $arr[$i]['product_id'];
						$rest_id 				= $arr[$i]['rest_id'];
						$quantity 				= $arr[$i]['user_basket_quantity'];
						$final_price 			= $arr[$i]['final_price'];
						$sub_total 				= ($sub_total+$final_price);
						$comment 				= $arr[$i]['comment'];
						$menu_price 			= $this->dbObj->getField(TABLE_USER_CART_PRICES, "user_basket_id", $user_basket_id, "SUM(product_price_value)");
						if(!isset($menu_price) || $menu_price =="") {
							$products_price 	= $menu_price;
						} else {
							$products_price 	= $this->dbObj->getField(TABLE_MENU, "menu_id", $product_id, "base_price");
						}

						$products_tax 			= '';

						$strInsQuery 	= "INSERT INTO " . TABLE_ORDERS_PRODUCTS . "(orders_products_id, order_id, product_id, rest_id, products_price, final_price, products_tax, quantity, comment) ";
						$strInsQuery 	.= "VALUES(null, '".$order_id."', '".$product_id."', '".$rest_id."', '".$products_price."', '".$final_price."', '".$products_tax."', '".$quantity."', '".$comment."')";
						$this->dbObj->mySqlSafeQuery($strInsQuery);
						$orders_products_id		= $this->dbObj->getIdentity();

						//Step III: add products attributes in ires_orders_products_attributes
						$sqlAtr 			= "SELECT * FROM " . TABLE_USER_CART_ATTRIBUTES . " WHERE user_basket_id='".$user_basket_id."'";
						$rsAtr 				= $this->dbObj->createRecordset($sqlAtr);
						if($this->dbObj->getRecordCount($rsAtr) > 0){
							$arrAtr						= $this->dbObj->fetchAssoc($rsAtr);
							for($j=0; $j < count($arrAtr); $j++) {
								$product_option_id 		= $arrAtr[$j]['product_option_id'];
								$product_option_value 	= $arrAtr[$j]['product_option_value'];

								$strInsQuery 	= "INSERT INTO " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . "(orders_products_attributes_id, orders_products_id, product_option_id, product_option_value) ";
								$strInsQuery 	.= "VALUES(null, '".$orders_products_id."', '".$product_option_id."', '".$product_option_value."')";
								$this->dbObj->mySqlSafeQuery($strInsQuery);
								$orders_products_attributes_id		= $this->dbObj->getIdentity();
							}
						}
						//Step IV: empty cart table for the user
						$this->fun_delCartItem($user_basket_id);
					}
				}
				//$sub_total 	= ($sub_total+(($sub_total*$tax)/100)+$delivery_charge);
				//Step V: update final_price in ires_orders
				//$this->dbObj->updateField(TABLE_ORDERS, "order_id", $order_id, "final_price", $sub_total);
				//Step V: update final_price in ires_orders
				return $order_id;
			}
		}
	}

	// Function for order edit
	function fun_editOrder($order_id, $user_id, $delivery_fname = '', $delivery_lname = '', $delivery_address1 = '', $delivery_address2 = '', $delivery_city = '', $delivery_state = '', $delivery_country = '', $delivery_zip = '', $delivery_phone = '', $dtype = '', $schedule = '', $order_comments = '', $payment_method = '', $cc_type = '', $cc_owner = '', $cc_number = '', $cc_expires = '', $final_price = '', $currency_id = '', $orders_status = '') {
		if($order_id == '' || $user_id == '') {
			return false;
		} else {
			$cur_unixtime 		= time ();
			$sqlUpdateQuery = "UPDATE " . TABLE_ORDERS . " SET 
			delivery_fname = '".fun_db_input($delivery_fname)."', 
			delivery_lname = '".fun_db_input($delivery_lname)."', 
			delivery_address1 = '".fun_db_input($delivery_address1)."', 
			delivery_address2 = '".fun_db_input($delivery_address2)."', 
			delivery_city = '".fun_db_input($delivery_city)."', 
			delivery_state = '".fun_db_input($delivery_state)."', 
			delivery_country = '".$delivery_country."', 
			delivery_zip = '".$delivery_zip."', 
			delivery_phone = '".$delivery_phone."', 
			dtype = '".$dtype."', 
			schedule = '".$schedule."', 
			order_comments = '".fun_db_input($order_comments)."', 
			payment_method = '".$payment_method."', 
			cc_type = '".$cc_type."', 
			cc_owner = '".$cc_owner."', 
			cc_number = '".$cc_number."', 
			cc_expires = '".$cc_expires."', 
			final_price = '".$final_price."', 
			currency_id = '".$currency_id."', 
			last_modified = '".$cur_unixtime."', 
			orders_status = '".$orders_status."' 
			WHERE order_id='".$order_id."'";
            $this->dbObj->mySqlSafeQuery($sqlUpdateQuery);
			if(isset($orders_status) && $orders_status =="4") {
				$this->dbObj->updateField(TABLE_ORDERS, "order_id", $order_id, "orders_date_finished", $cur_unixtime);
			}
            return true;
		}
	}

	// This function will add an order status products history
	function fun_addOrderStatusHistory($order_id, $order_status_id, $date_added = '', $customer_notified = '', $comments = '') {
		if($order_id == '' || $order_status_id == '') {
			return false;
		} else {
			$strInsQuery = "INSERT INTO " . TABLE_ORDERS_STATUS_HISTORY . " 
			(order_status_history_id, order_id, order_status_id, date_added, customer_notified, comments) 
			VALUES(null, '".$order_id."', '".$order_status_id."', '".$date_added."', '".$customer_notified."', '".$comments."')";
			$this->dbObj->mySqlSafeQuery($strInsQuery);
			return true;
		}
	}

	function fun_getOrderFinalPrice($order_id){
		if($order_id == "") {
			return false;
		} else {
			$final_price = $this->dbObj->getField(TABLE_ORDERS, "order_id", $order_id, "final_price");
			if(is_float($final_price)) {
				return $final_price;
			} else {
				return number_format($final_price, 2);
			}
		}
	}

	// This function will update order status
	function fun_updateOrderStatus($order_id, $orders_status, $date_added = '') {
		if($order_id == '' || $orders_status == '') {
			return false;
		} else {
			$sqlUpdateQuery = "UPDATE " . TABLE_ORDERS . " SET orders_status = '".$orders_status."', orders_date_finished = '".$date_added."' WHERE order_id='".$order_id."'";
			$this->dbObj->mySqlSafeQuery($sqlUpdateQuery);
			return true;
		}
	}

/*
* order functions : end here
*/	

/*
* cart functions : start here
*/	
	//Function to get user cart amount
	function fun_getCheckoutCartAmt($user_id) {
		if($user_id == ''){
			return false;
		} else {
			$sub_total	= $this->dbObj->getField(TABLE_USER_CART, "user_id", $user_id, "SUM(final_price)");
			return $sub_total;
		}
	}

	//Function to check if cart not empty
	function fun_checkCartNoEmpty($user_id) {
		if($user_id != ''){ // from database
			$total_cart_items = $this->dbObj->getField(TABLE_USER_CART, "user_id", $user_id, "count(*)");
			if(isset($total_cart_items) && $total_cart_items > 0) {
				return true;
			} else {
				return false;
			}
		} else { // from session
			if(is_array($_SESSION['cart']) && !empty($_SESSION['cart'])){
				return true;
			} else {
				return false;
			}
		}
	}

	// Function for currency rates
	function fun_findCurrencyRate(){		
		$currencyRate 	= array();		
		$sql 	= "SELECT * FROM " . TABLE_CURRENCIES. " ORDER BY currency_name";
		$rs 	= $this->dbObj->createRecordset($sql);
		$arr 	= $this->dbObj->fetchAssoc($rs);
		
		for($i=0; $i < count($arr); $i++) {
			$currencyRate[$arr[$i]['currency_code']] = $arr[$i]['currency_rate'];
		}
		return $currencyRate;		
	}

	// This function will Return Currency information in array with front end data	
	function fun_getCurrencyInfo($currency_id){
		$sql 	= "SELECT * FROM " . TABLE_CURRENCIES . " WHERE currency_id='".$currency_id."'";
		$rs 	= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			return $arr[0];
		} else {
			return false;
		}
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

	//Function to create cart view for menu page
	function fun_createCartView($user_id = '') {
		if($user_id != ''){ // From database
			$sql 	= "SELECT * FROM " . TABLE_USER_CART . " WHERE user_id='".$user_id."'";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr 			= $this->dbObj->fetchAssoc($rs);
				$sub_total 		= 0;
				$tax 			= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "tax");
				if(!is_numeric($tax)) {
					$tax 		= 0;
				}
				$delivery_charge= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_charge");
				if(!is_numeric($delivery_charge) || ($_COOKIE['cook_dtype'] =="pickup")) {
					$delivery_charge = 0;
				}
				$extra_charge 		= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "extra_charge");
				if(!is_numeric($extra_charge)) {
					$extra_charge 	= 0;
				}
				
				$delivery_type 			= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_type");
				$min_order 				= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "min_order");

				$currencyRateArr= $this->fun_findCurrencyRate();

				$userCurrencyArr		= $this->fun_getUserCurrencyInfo($user_id);
				$users_currency_id		= $userCurrencyArr['currency_id'];
				$users_currency_code 	= $userCurrencyArr['currency_code'];
				$users_currency_symbol 	= $userCurrencyArr['currency_symbol'];
				$users_currency_rate 	= $userCurrencyArr['currency_rate'];
				$users_currency_name 	= $userCurrencyArr['currency_name'];
			
				// Restaurant currency info
				$currencyArr			= $this->fun_getRestaurantCurrencyInfo($arr[0]['rest_id']);
				$rest_currency_id		= $currencyArr['currency_id'];
				$rest_currency_code 	= $currencyArr['currency_code'];
				$rest_currency_symbol 	= $currencyArr['currency_symbol'];
				$rest_currency_rate 	= $currencyArr['currency_rate'];
				$rest_currency_name 	= $currencyArr['currency_name'];
				$currency_symbol		= ($users_currency_symbol == "")?$rest_currency_symbol:$users_currency_symbol;
				$currency_code			= ($users_currency_code == "")?$rest_currency_code:$users_currency_code;
				
				//print_r($userCurrencyArr);
				//display cart items
				//echo 'cook: '.$_COOKIE['cook_dtype'];
				echo '<div id="title_item" class="cart_title">Item</div>';
				echo '<div id="title_qtd" class="cart_title">Qty</div>';
				echo '<div id="title_price" class="cart_title">Price</div>';
				echo '<div id="title_del" class="cart_title">Del</div>';
				for($i=0; $i < count($arr); $i++) {
					$user_basket_id 		= $arr[$i]['user_basket_id'];
					$user_id 				= $arr[$i]['user_id'];
					$product_id 			= $arr[$i]['product_id'];
					$rest_id 				= $arr[$i]['rest_id'];

					$user_basket_quantity 	= $arr[$i]['user_basket_quantity'];
					$final_price 			= $arr[$i]['final_price'];
					$sub_total 				= ($sub_total+$final_price);
					$comment 				= $arr[$i]['comment'];
					$menu_name 				= $this->dbObj->getField(TABLE_MENU, "menu_id", $product_id, "menu_name");
					echo '<div class="cart_info">';
					echo '<span class="info_item cart_info_all">';
					echo '<strong>'.ucwords($menu_name).'</strong>';
					echo '</span>';
					echo '<span class="info_qtd cart_info_all"><strong>'.$user_basket_quantity.'</strong></span>';
					echo '<span class="info_price cart_info_all">'.number_format((($final_price/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</span>';
					echo '<span class="info_del cart_info_all"><a href="javascript:void(0);" class="del_item" onclick="return del_item('.$user_basket_id.')" title="Delete"> <img src="'.SITE_IMAGES.'icon_x_red.png" alt="Delete" border="0" height="8" width="8"> </a> </span>';
					echo '<span class="info_desc cart_info_all"><b>Instructions:</b> '.$comment.'</span>';
					echo '</div>';
				}
				echo '<div class="cartHr"></div>';
				echo '<span class="sumary_title">Subtotal: </span>';
				echo '<span class="sumary">'.number_format((($sub_total/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</span>';
				if(isset($tax) && $tax > 0) {
					echo '<span class="sumary_title">Tax: </span>';
					echo '<span class="sumary">'.number_format((((($sub_total/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code])*$tax)/100), 2).'</span>';
				} else {
					$tax = 0;
				}
				if((!isset($_COOKIE['cook_dtype']) || $_COOKIE['cook_dtype'] =="delivery") && isset($delivery_type) && $delivery_type == "1") {
					echo '<span class="sumary_title">Delivery Fee: </span>';
					echo '<span class="sumary"><span class="sumary_red">'.(($delivery_charge == 0)?'0.00':number_format((($delivery_charge/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2)).'</span></span>';
				} else {
					$delivery_charge = 0;
				}

				if(isset($extra_charge) && $extra_charge > 0) {
					echo '<span class="sumary_title">Processing Fee: </span>';
					echo '<span class="sumary"><span class="sumary_red">'.(($extra_charge == 0)?'0.00':number_format((($extra_charge/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2)).'</span></span>';
				} else {
					$extra_charge 	= 0;
				}
				echo '<div id="total">';
				echo '<span>Total: &nbsp;</span> <span>'.$users_currency_symbol.number_format(((($sub_total+(($sub_total*$tax)/100)+$delivery_charge+$extra_charge)/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</span>';
				echo '</div>';
				echo '<div id="delivery_order">';
				if(isset($delivery_type) && $delivery_type == "1") {
					echo '<div class="radio_dtype_cart radio_pickup_cart">';
					echo '<table width="100%" border="0" cellpadding="0" cellspacing="2">';
					echo '<tr>';
					echo '<td valign="middle" height="30px" class="pad-btm15 pad-rgt5"><input name="dtype" id="pickup" value="pickup" onclick="change_dtype(this.value);" '.((isset($_COOKIE['cook_dtype']) && $_COOKIE['cook_dtype'] =="pickup")?' checked="checked"':'').' type="radio" class="radio_cart"></td>';
					echo '<td valign="middle" height="30px">PICKUP</td>';
					echo '<td valign="middle" height="30px"><img src="'.SITE_IMAGES.'delivery_bagN.png" alt="Pickup" border="0" height="27" width="31"></td>';
					echo '</tr>';
					echo '</table>';
					echo '</div>';
					echo '<div class="radio_dtype_cart radio_delivery_cart">';
					echo '<table width="100%" border="0" cellpadding="0" cellspacing="2">';
					echo '<tr>';
					echo '<td valign="middle" height="30px" class="pad-btm15 pad-rgt5"><input name="dtype" id="delivery" value="delivery" onclick="change_dtype(this.value);" '.((!isset($_COOKIE['cook_dtype']) || $_COOKIE['cook_dtype'] =="delivery")?' checked="checked"':'').' type="radio" class="radio_cart"></td>';
					echo '<td valign="middle" height="30px">DELIVERY</td>';
					echo '<td valign="middle" height="30px"><img src="'.SITE_IMAGES.'delivery_carN.png" alt="Delivery" border="0" height="27" width="31"></td>';
					echo '</tr>';
					echo '</table>';
					echo '</div>';
				} else {
					echo '<div class="radio_dtype_cart radio_pickup_cart">';
					echo '<table width="100%" border="0" cellpadding="0" cellspacing="2">';
					echo '<tr>';
					echo '<td valign="middle" height="30px" class="pad-btm15 pad-rgt5"><input name="dtype" id="pickup" value="pickup" checked="checked" type="radio" class="radio_cart"></td>';
					echo '<td valign="middle" height="30px">PICKUP</td>';
					echo '<td valign="middle" height="30px"><img src="'.SITE_IMAGES.'delivery_bagN.png" alt="Pickup" border="0" height="27" width="31"></td>';
					echo '</tr>';
					echo '</table>';
					echo '</div>';
				}
				echo '</div>';
				echo '<div id="max_order"> <span id="small_msg"> The minimum order for delivery is: '.$users_currency_symbol.((isset($min_order) && $min_order !="")?number_format((($min_order/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2):"00.00").' <br>No minimum on Pickup orders </span> </div>';
				if((!isset($_COOKIE['cook_dtype']) || $_COOKIE['cook_dtype'] =="delivery") && (isset($min_order) && number_format((($min_order/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2) > number_format(((($sub_total+(($sub_total*$tax)/100))/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2))) {
					echo '<div id="checkout_btn"> <a href="javascript:void(0);" title="Check Out"> <img src="'.SITE_IMAGES.'checkout_greyN2.png" alt="Check Out" border="0" height="37" width="291"> </a> </div>';
				} else {
					echo '<div id="checkout_btn"> <a href="'.SITE_URL.'checkout" title="Check Out"> <img src="'.SITE_IMAGES.'checkout_buttonN1.png" alt="Check Out" border="0" height="37" width="291"> </a> </div>';
				}
			}
		} else { // From session
			if(is_array($_SESSION['cart']) && !empty($_SESSION['cart'])){
				//display cart items
				$arr 		= $_SESSION['cart'];
				//print_r($arr);
				$sub_total 	= 0;
				$tax 			= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "tax");
				if(!is_numeric($tax)) {
					$tax 		= 0;
				}
				$delivery_charge= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_charge");
				if(!is_numeric($delivery_charge) || ($_COOKIE['cook_dtype'] =="pickup")) {
					$delivery_charge = 0;
				}
				$extra_charge 		= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "extra_charge");
				if(!is_numeric($extra_charge)) {
					$extra_charge 	= 0;
				}

				$delivery_type 			= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_type");
				$min_order 				= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "min_order");

				$currencyRateArr= $this->fun_findCurrencyRate();

				$userCurrencyArr		= $this->fun_getUserCurrencyInfo();
				$users_currency_id		= $userCurrencyArr['currency_id'];
				$users_currency_code 	= $userCurrencyArr['currency_code'];
				$users_currency_symbol 	= $userCurrencyArr['currency_symbol'];
				$users_currency_rate 	= $userCurrencyArr['currency_rate'];
				$users_currency_name 	= $userCurrencyArr['currency_name'];
			
				// Restaurant currency info
				$currencyArr			= $this->fun_getRestaurantCurrencyInfo($arr[0]['rest_id']);
				$rest_currency_id		= $currencyArr['currency_id'];
				$rest_currency_code 	= $currencyArr['currency_code'];
				$rest_currency_symbol 	= $currencyArr['currency_symbol'];
				$rest_currency_rate 	= $currencyArr['currency_rate'];
				$rest_currency_name 	= $currencyArr['currency_name'];
				$currency_symbol		= ($users_currency_symbol == "")?$rest_currency_symbol:$users_currency_symbol;
				$currency_code			= ($users_currency_code == "")?$rest_currency_code:$users_currency_code;
				//print_r($userCurrencyArr);

				//display cart items
				//echo 'Cook: '.$_COOKIE['cook_dtype'];
				echo '<div id="title_item" class="cart_title">Item</div>';
				echo '<div id="title_qtd" class="cart_title">Qty</div>';
				echo '<div id="title_price" class="cart_title">Price</div>';
				echo '<div id="title_del" class="cart_title">Del</div>';
				for($i=0; $i < count($arr); $i++) {
					$item_id 				= $arr[$i]['item_id'];
					$rest_id 				= $arr[$i]['rest_id'];
					$menu_id 				= $arr[$i]['menu_id'];
					$menu_price_id 			= $arr[$i]['menu_price_id'];
					$quantity 				= $arr[$i]['quantity'];
					$order_comment 			= $arr[$i]['order_comment'];
					$options 				= $arr[$i]['options'];
					$radio_options 			= $arr[$i]['radio_options'];
					$select_options 		= $arr[$i]['select_options'];

					if(!isset($menu_price_id) || $menu_price_id =="") {
						$menu_price 		= $this->dbObj->getField(TABLE_MENU, "menu_id", $menu_id, "base_price");
					} else {
						$menu_price 		= $this->dbObj->getField(TABLE_MENU_PRICE_RELATION, array("menu_id", "price_id"), array($menu_id, $menu_price_id), "price");
					}
					if($quantity > 1) {
						$final_price 	= ($quantity*$menu_price);
					} else {
						$final_price 	= $menu_price;
					}

					if(is_array($options) && !empty($options)) { // for checkboxes
						foreach($options as $key => $value) {
							$option_id 		= $key;
							$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
							if(isset($addon_price) && $addon_price !="") {
								if($quantity > 1) {
									$final_price = ($final_price+($quantity*$addon_price));
								} else {
									$final_price = ($final_price+$addon_price);
								}
							}
						}
					}
		
					if(is_array($select_options) && !empty($select_options)) { // for select
						foreach($select_options as $key => $value) {
							$option_id 		= $value;
							$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
							if(isset($addon_price) && $addon_price !="") {
								if($quantity > 1) {
									$final_price = ($final_price+($quantity*$addon_price));
								} else {
									$final_price = ($final_price+$addon_price);
								}
							}
						}
					}
		
					if(is_array($radio_options) && !empty($radio_options)) { // for radio
						foreach($radio_options as $key => $value) {
							$option_id 		= $value;
							$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
							if(isset($addon_price) && $addon_price !="") {
								if($quantity > 1) {
									$final_price = ($final_price+($quantity*$addon_price));
								} else {
									$final_price = ($final_price+$addon_price);
								}
							}
						}
					}
					$sub_total 				= ($sub_total+$final_price);
					$menu_name 				= $this->dbObj->getField(TABLE_MENU, "menu_id", $menu_id, "menu_name");
					echo '<div class="cart_info">';
					echo '<span class="info_item cart_info_all">';
					echo '<strong>'.ucwords($menu_name).'</strong>';
					echo '</span>';
					echo '<span class="info_qtd cart_info_all"><strong>'.$quantity.'</strong></span>';
					echo '<span class="info_price cart_info_all">'.number_format((($final_price/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</span>';
					echo '<span class="info_del cart_info_all"><a href="javascript:void(0);" class="del_item" onclick="return ses_del_cart_item(\''.$i.'\')" title="Delete"> <img src="'.SITE_IMAGES.'icon_x_red.png" alt="Delete" border="0" height="8" width="8"> </a> </span>';
					echo '<span class="info_desc cart_info_all"><b>Instructions:</b> '.$order_comment.'</span>';
					echo '</div>';
				}
				echo '<div class="cartHr"></div>';
				echo '<span class="sumary_title">Subtotal: </span>';
				echo '<span class="sumary">'.number_format((($sub_total/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</span>';
				if(isset($tax) && $tax > 0) {
					echo '<span class="sumary_title">Tax: </span>';
					echo '<span class="sumary">'.number_format((((($sub_total/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code])*$tax)/100), 2).'</span>';
				} else {
					$tax = 0;
				}
				if((!isset($_COOKIE['cook_dtype']) || $_COOKIE['cook_dtype'] =="delivery") && isset($delivery_type) && $delivery_type == "1") {
					echo '<span class="sumary_title">Delivery Fee: </span>';
					echo '<span class="sumary"><span class="sumary_red">'.(($delivery_charge == 0)?'0.00':number_format((($delivery_charge/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2)).'</span></span>';
				} else {
					$delivery_charge = 0;
				}

				if(isset($extra_charge) && $extra_charge > 0) {
					echo '<span class="sumary_title">Processing Fee: </span>';
					echo '<span class="sumary"><span class="sumary_red">'.(($extra_charge == 0)?'0.00':number_format((($extra_charge/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2)).'</span></span>';
				} else {
					$extra_charge 	= 0;
				}
				echo '<div id="total">';
				echo '<span>Total: &nbsp;</span> <span>'.$users_currency_symbol.number_format(((($sub_total+(($sub_total*$tax)/100)+$delivery_charge+$extra_charge)/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</span>';
				echo '</div>';
				echo '<div id="delivery_order">';
				if(isset($delivery_type) && $delivery_type == "1") {
					echo '<div class="radio_dtype_cart radio_pickup_cart">';
					echo '<table width="100%" border="0" cellpadding="0" cellspacing="2">';
					echo '<tr>';
					echo '<td valign="middle" height="30px" class="pad-btm15 pad-rgt5"><input name="dtype" id="pickup" value="pickup" onclick="change_dtype(this.value);" '.((isset($_COOKIE['cook_dtype']) && $_COOKIE['cook_dtype'] =="pickup")?' checked="checked"':'').' type="radio" class="radio_cart"></td>';
					echo '<td valign="middle" height="30px">PICKUP</td>';
					echo '<td valign="middle" height="30px"><img src="'.SITE_IMAGES.'delivery_bagN.png" alt="Pickup" border="0" height="27" width="31"></td>';
					echo '</tr>';
					echo '</table>';
					echo '</div>';
					echo '<div class="radio_dtype_cart radio_delivery_cart">';
					echo '<table width="100%" border="0" cellpadding="0" cellspacing="2">';
					echo '<tr>';
					echo '<td valign="middle" height="30px" class="pad-btm15 pad-rgt5"><input name="dtype" id="delivery" value="delivery" onclick="change_dtype(this.value);" '.((!isset($_COOKIE['cook_dtype']) || $_COOKIE['cook_dtype'] =="delivery")?' checked="checked"':'').' type="radio" class="radio_cart"></td>';
					echo '<td valign="middle" height="30px">DELIVERY</td>';
					echo '<td valign="middle" height="30px"><img src="'.SITE_IMAGES.'delivery_carN.png" alt="Delivery" border="0" height="27" width="31"></td>';
					echo '</tr>';
					echo '</table>';
					echo '</div>';
				} else {
					echo '<div class="radio_dtype_cart radio_pickup_cart">';
					echo '<table width="100%" border="0" cellpadding="0" cellspacing="2">';
					echo '<tr>';
					echo '<td valign="middle" height="30px" class="pad-btm15 pad-rgt5"><input name="dtype" id="pickup" value="pickup" checked="checked" type="radio" class="radio_cart"></td>';
					echo '<td valign="middle" height="30px">PICKUP</td>';
					echo '<td valign="middle" height="30px"><img src="'.SITE_IMAGES.'delivery_bagN.png" alt="Pickup" border="0" height="27" width="31"></td>';
					echo '</tr>';
					echo '</table>';
					echo '</div>';
				}
				echo '</div>';
				echo '<div id="max_order"> <span id="small_msg"> The minimum order for delivery is: '.$users_currency_symbol.((isset($min_order) && $min_order !="")?number_format((($min_order/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2):"00.00").' <br>No minimum on Pickup orders </span> </div>';
				// If selected delivery and total cost is less than minimum order delivery for delivery
				if((!isset($_COOKIE['cook_dtype']) || $_COOKIE['cook_dtype'] =="delivery") && (isset($min_order) && number_format((($min_order/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2) > number_format(((($sub_total+(($sub_total*$tax)/100))/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2))) {
					echo '<div id="checkout_btn"> <a href="javascript:void(0);" title="Check Out"> <img src="'.SITE_IMAGES.'checkout_greyN2.png" alt="Check Out" border="0" height="37" width="291"> </a> </div>';
				} else {
					echo '<div id="checkout_btn"> <a href="'.SITE_URL.'checkout" title="Check Out"> <img src="'.SITE_IMAGES.'checkout_buttonN1.png" alt="Check Out" border="0" height="37" width="291"> </a> </div>';
				}
			}
		}
	}
        //new function 
	//Function to create cart view for menu page
	function fun_getCartView($user_id = '') {
            if($user_id != ''){ // From database
                $sql = "SELECT * FROM " . TABLE_USER_CART . " WHERE user_id='".$user_id."'";
                $rs  = $this->dbObj->createRecordset($sql);
                if($this->dbObj->getRecordCount($rs) > 0){
                    $arr             = $this->dbObj->fetchAssoc($rs);
                    $sub_total       = 0;
                    $tax             = $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "tax");
                    $delivery_charge = $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_charge");
                    $extra_charge    = $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "extra_charge");
                    if(!is_numeric($tax)) {
                        $tax             = 0;
                    }
                    if(!is_numeric($delivery_charge) || ($_COOKIE['cook_dtype'] =="pickup")) {
                        $delivery_charge = 0;
                    }
                    if(!is_numeric($extra_charge)) {
                        $extra_charge    = 0;
                    }
                    $delivery_type         = $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_type");
                    $min_order             = $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "min_order");
                    $currencyRateArr       = $this->fun_findCurrencyRate();
                    $userCurrencyArr       = $this->fun_getUserCurrencyInfo($user_id);
                    $users_currency_id     = $userCurrencyArr['currency_id'];
                    $users_currency_code   = $userCurrencyArr['currency_code'];
                    $users_currency_symbol = $userCurrencyArr['currency_symbol'];
                    $users_currency_rate   = $userCurrencyArr['currency_rate'];
                    $users_currency_name   = $userCurrencyArr['currency_name'];
                    // Restaurant currency info
                    $currencyArr           = $this->fun_getRestaurantCurrencyInfo($arr[0]['rest_id']);
                    $rest_currency_id      = $currencyArr['currency_id'];
                    $rest_currency_code    = $currencyArr['currency_code'];
                    $rest_currency_symbol  = $currencyArr['currency_symbol'];
                    $rest_currency_rate    = $currencyArr['currency_rate'];
                    $rest_currency_name    = $currencyArr['currency_name'];
                    $currency_symbol       = ($users_currency_symbol == "")?$rest_currency_symbol:$users_currency_symbol;
                    $currency_code         = ($users_currency_code == "")?$rest_currency_code:$users_currency_code;
                    //print_r($userCurrencyArr);
                    //display cart items
                    //echo 'cook: '.$_COOKIE['cook_dtype'];
                    echo '<div class="panel panel-default">';
                    echo '<div class="panel-body">';
                    echo '<table class="table table-hover">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th class="col-md-8">Item</th>';
                    echo '<th class="col-md-1">Qty</th>';
                    echo '<th class="col-md-2">Price</th>';
                    echo '<th class="text-right">Del</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    for($i=0; $i < count($arr); $i++) {
                        $user_basket_id       = $arr[$i]['user_basket_id'];
                        $user_id              = $arr[$i]['user_id'];
                        $product_id           = $arr[$i]['product_id'];
                        $rest_id              = $arr[$i]['rest_id'];
                        $user_basket_quantity = $arr[$i]['user_basket_quantity'];
                        $final_price          = $arr[$i]['final_price'];
                        $sub_total            = ($sub_total+$final_price);
                        $comment              = $arr[$i]['comment'];
                        $menu_name            = $this->dbObj->getField(TABLE_MENU, "menu_id", $product_id, "menu_name");
                        echo '<tr>';
                        echo '<td><strong>'.ucwords($menu_name).'</strong></td>';
                        echo '<td><strong>'.$user_basket_quantity.'</strong></td>';
                        echo '<td>'.number_format((($final_price/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</td>';
                        echo '<td><a href="javascript:void(0);" class="del_item" onclick="return del_item('.$user_basket_id.')" title="Delete"> <img src="'.SITE_IMAGES.'icon_x_red.png" alt="Delete" border="0" height="8" width="8"> </a> </td>';
                        echo '</tr>';
                        echo '<tr><td colspan="4"><p class="text-center text-danger"><strong>Instructions:</strong> '.$comment.'</p></td></tr>';
                    }
                    echo '</tbody>';
                    echo '<tfoot>';
                    echo '<tr>';
                    echo '<td colspan="2">Subtotal:</td>';
                    echo '<td>'.number_format((($sub_total/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</td>';
                    echo '<td>&nbsp;</td>';
                    echo '</tr>';
                    if(isset($tax) && $tax > 0) {
                    echo '<tr>';
                    echo '<td colspan="2">Tax:</td>';
                    echo '<td>'.number_format((((($sub_total/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code])*$tax)/100), 2).'</td>';
                    echo '<td>&nbsp;</td>';
                    echo '</tr>';
                    }
                    if((!isset($_COOKIE['cook_dtype']) || $_COOKIE['cook_dtype'] =="delivery") && isset($delivery_type) && $delivery_type == "1") {
                    echo '<tr>';
                    echo '<td colspan="2">Delivery Fee:</td>';
                    echo '<td>'.(($delivery_charge == 0)?'0.00':number_format((($delivery_charge/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2)).'</td>';
                    echo '<td>&nbsp;</td>';
                    echo '</tr>';
                    }
                    if(isset($extra_charge) && $extra_charge > 0) {
                    echo '<tr>';
                    echo '<td colspan="2">Processing Fee:</td>';
                    echo '<td>'.(($extra_charge == 0)?'0.00':number_format((($extra_charge/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2)).'</td>';
                    echo '<td>&nbsp;</td>';
                    echo '</tr>';
                    }
                    echo '</tfoot>';
                    echo '</table>';
                    echo '<table class="table table-hover">';
                    echo '<tbody>';
                    echo '<tr>';
                    echo '<td class="col-md-9"><strong>Total:</strong></td>';
                    echo '<td><strong>'.$users_currency_symbol.number_format(((($sub_total+(($sub_total*$tax)/100)+$delivery_charge+$extra_charge)/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</strong></td>';
                    echo '</tr>';
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="col-sm-12" id="delivery_order">';
                    if(isset($delivery_type) && $delivery_type == "1") {
                        echo '<label class="radio-inline">';
                        echo '<input name="dtype" id="pickup" value="pickup" onclick="change_dtype(this.value);" '.((isset($_COOKIE['cook_dtype']) && $_COOKIE['cook_dtype'] =="pickup")?' checked="checked"':'').' type="radio" >PICKUP';
                        echo '</label>';
                        echo '<label class="radio-inline">';
                        echo '<input name="dtype" id="delivery" value="delivery" onclick="change_dtype(this.value);" '.((!isset($_COOKIE['cook_dtype']) || $_COOKIE['cook_dtype'] =="delivery")?' checked="checked"':'').' type="radio">DELIVERY';
                        echo '</label>';
                    } else {
                        echo '<label class="radio-inline">';
                        echo '<input name="dtype" id="pickup" checked="checked" value="pickup" type="radio">PICKUP';
                        echo '</label>';
                    }
                    echo '</div>';
                    echo '<div  class="col-sm-12" id="max_order"> <span id="small_msg"> The minimum order for delivery is: '.$users_currency_symbol.((isset($min_order) && $min_order !="")?number_format((($min_order/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2):"00.00").' <br>No minimum on Pickup orders </span> </div>';
                    echo '<div  class="row" id="checkout_btn">';
                    echo '<p class="text-center">';
                    if((!isset($_COOKIE['cook_dtype']) || $_COOKIE['cook_dtype'] =="delivery") && (isset($min_order) && number_format((($min_order/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2) > number_format(((($sub_total+(($sub_total*$tax)/100))/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2))) {
                        echo '<button class="btn btn-danger" type="button">Check Out</button>';
                    } else {
                        echo '<a href="'.SITE_URL.'checkout" title="Check Out"><button class="btn btn-danger" type="button" id="checkout_btn">Check Out</button></a>';
                    }
                    echo '</p>';
                    echo '</div>';
                }
            } else { // From session
                if(is_array($_SESSION['cart']) && !empty($_SESSION['cart'])){
                    //display cart items
                    $arr             = $_SESSION['cart'];
                    $sub_total       = 0;
                    $tax             = $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "tax");
                    $delivery_charge = $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_charge");
                    $extra_charge    = $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "extra_charge");
                    if(!is_numeric($tax)) {
                        $tax             = 0;
                    }
                    if(!is_numeric($delivery_charge) || ($_COOKIE['cook_dtype'] =="pickup")) {
                        $delivery_charge = 0;
                    }
                    if(!is_numeric($extra_charge)) {
                        $extra_charge    = 0;
                    }
                    $delivery_type         = $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_type");
                    $min_order             = $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "min_order");
                    $currencyRateArr       = $this->fun_findCurrencyRate();
                    $userCurrencyArr       = $this->fun_getUserCurrencyInfo();
                    $users_currency_id     = $userCurrencyArr['currency_id'];
                    $users_currency_code   = $userCurrencyArr['currency_code'];
                    $users_currency_symbol = $userCurrencyArr['currency_symbol'];
                    $users_currency_rate   = $userCurrencyArr['currency_rate'];
                    $users_currency_name   = $userCurrencyArr['currency_name'];
                    // Restaurant currency info
                    $currencyArr           = $this->fun_getRestaurantCurrencyInfo($arr[0]['rest_id']);
                    $rest_currency_id      = $currencyArr['currency_id'];
                    $rest_currency_code    = $currencyArr['currency_code'];
                    $rest_currency_symbol  = $currencyArr['currency_symbol'];
                    $rest_currency_rate    = $currencyArr['currency_rate'];
                    $rest_currency_name    = $currencyArr['currency_name'];
                    $currency_symbol       = ($users_currency_symbol == "")?$rest_currency_symbol:$users_currency_symbol;
                    $currency_code         = ($users_currency_code == "")?$rest_currency_code:$users_currency_code;
                    //display cart items
                    echo '<div class="panel panel-default">';
                    echo '<div class="panel-body">';
                    echo '<table class="table table-hover">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th class="col-md-8">Item</th>';
                    echo '<th class="col-md-1">Qty</th>';
                    echo '<th class="col-md-2">Price</th>';
                    echo '<th class="text-right">Del</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    for($i=0; $i < count($arr); $i++) {
                        $item_id              = $arr[$i]['item_id'];
                        $rest_id              = $arr[$i]['rest_id'];
                        $menu_id              = $arr[$i]['menu_id'];
                        $menu_price_id        = $arr[$i]['menu_price_id'];
                        $quantity             = $arr[$i]['quantity'];
                        $order_comment        = $arr[$i]['order_comment'];
                        $options              = $arr[$i]['options'];
                        $radio_options        = $arr[$i]['radio_options'];
                        $select_options       = $arr[$i]['select_options'];
                        if(!isset($menu_price_id) || $menu_price_id =="") {
                            $menu_price  = $this->dbObj->getField(TABLE_MENU, "menu_id", $menu_id, "base_price");
                        } else {
                            $menu_price  = $this->dbObj->getField(TABLE_MENU_PRICE_RELATION, array("menu_id", "price_id"), array($menu_id, $menu_price_id), "price");
                        }
                        if($quantity > 1) {
                            $final_price = ($quantity*$menu_price);
                        } else {
                            $final_price = $menu_price;
                        }
                        if(is_array($options) && !empty($options)) { // for checkboxes
                            foreach($options as $key => $value) {
                                $option_id   = $key;
                                $addon_price = $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
                                if(isset($addon_price) && $addon_price !="") {
                                    if($quantity > 1) {
                                        $final_price = ($final_price+($quantity*$addon_price));
                                    } else {
                                        $final_price = ($final_price+$addon_price);
                                    }
                                }
                            }
                        }
                        if(is_array($select_options) && !empty($select_options)) { // for select
                                foreach($select_options as $key => $value) {
                                        $option_id 		= $value;
                                        $addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
                                        if(isset($addon_price) && $addon_price !="") {
                                                if($quantity > 1) {
                                                        $final_price = ($final_price+($quantity*$addon_price));
                                                } else {
                                                        $final_price = ($final_price+$addon_price);
                                                }
                                        }
                                }
                        }
                        if(is_array($radio_options) && !empty($radio_options)) { // for radio
                            foreach($radio_options as $key => $value) {
                                $option_id   = $value;
                                $addon_price = $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
                                if(isset($addon_price) && $addon_price !="") {
                                    if($quantity > 1) {
                                        $final_price = ($final_price+($quantity*$addon_price));
                                    } else {
                                        $final_price = ($final_price+$addon_price);
                                    }
                                }
                            }
                        }
                        $sub_total = ($sub_total+$final_price);
                        $menu_name = $this->dbObj->getField(TABLE_MENU, "menu_id", $menu_id, "menu_name");
                        echo '<tr>';
                        echo '<td><strong>'.ucwords($menu_name).'</strong></td>';
                        echo '<td><strong>'.$quantity.'</strong></td>';
                        echo '<td>'.number_format((($final_price/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</td>';
                        echo '<td><a href="javascript:void(0);" class="del_item" onclick="return ses_del_cart_item(\''.$i.'\')" title="Delete"> <img src="'.SITE_IMAGES.'icon_x_red.png" alt="Delete" border="0" height="8" width="8"> </a> </td>';
                        echo '</tr>';
                        echo '<tr><td colspan="4"><p class="text-center text-danger"><strong>Instructions:</strong> '.$order_comment.'</p></td></tr>';
                    }
                    echo '</tbody>';
                    echo '<tfoot>';
                    echo '<tr>';
                    echo '<td colspan="2">Subtotal:</td>';
                    echo '<td>'.number_format((($sub_total/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</td>';
                    echo '<td>&nbsp;</td>';
                    echo '</tr>';
                    if(isset($tax) && $tax > 0) {
                    echo '<tr>';
                    echo '<td colspan="2">Tax:</td>';
                    echo '<td>'.number_format((((($sub_total/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code])*$tax)/100), 2).'</td>';
                    echo '<td>&nbsp;</td>';
                    echo '</tr>';
                    }
                    if((!isset($_COOKIE['cook_dtype']) || $_COOKIE['cook_dtype'] =="delivery") && isset($delivery_type) && $delivery_type == "1") {
                    echo '<tr>';
                    echo '<td colspan="2">Delivery Fee:</td>';
                    echo '<td>'.(($delivery_charge == 0)?'0.00':number_format((($delivery_charge/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2)).'</td>';
                    echo '<td>&nbsp;</td>';
                    echo '</tr>';
                    }
                    if(isset($extra_charge) && $extra_charge > 0) {
                    echo '<tr>';
                    echo '<td colspan="2">Processing Fee:</td>';
                    echo '<td>'.(($extra_charge == 0)?'0.00':number_format((($extra_charge/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2)).'</td>';
                    echo '<td>&nbsp;</td>';
                    echo '</tr>';
                    }
                    echo '</tfoot>';
                    echo '</table>';
                    echo '<table class="table table-hover">';
                    echo '<tbody>';
                    echo '<tr>';
                    echo '<td class="col-md-9"><strong>Total:</strong></td>';
                    echo '<td><strong>'.$users_currency_symbol.number_format(((($sub_total+(($sub_total*$tax)/100)+$delivery_charge+$extra_charge)/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</strong></td>';
                    echo '</tr>';
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="col-sm-12" id="delivery_order">';
                    if(isset($delivery_type) && $delivery_type == "1") {
                        echo '<label class="radio-inline">';
                        echo '<input name="dtype" id="pickup" value="pickup" onclick="change_dtype(this.value);" '.((isset($_COOKIE['cook_dtype']) && $_COOKIE['cook_dtype'] =="pickup")?' checked="checked"':'').' type="radio" >PICKUP';
                        echo '</label>';
                        echo '<label class="radio-inline">';
                        echo '<input name="dtype" id="delivery" value="delivery" onclick="change_dtype(this.value);" '.((!isset($_COOKIE['cook_dtype']) || $_COOKIE['cook_dtype'] =="delivery")?' checked="checked"':'').' type="radio">DELIVERY';
                        echo '</label>';
                    } else {
                        echo '<label class="radio-inline">';
                        echo '<input name="dtype" id="pickup" checked="checked" value="pickup" type="radio">PICKUP';
                        echo '</label>';
                    }
                    echo '</div>';
                    echo '<div  class="col-sm-12" id="max_order"> <span id="small_msg"> The minimum order for delivery is: '.$users_currency_symbol.((isset($min_order) && $min_order !="")?number_format((($min_order/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2):"00.00").' <br>No minimum on Pickup orders </span> </div>';
                    echo '<div  class="row" id="checkout_btn">';
                    echo '<p class="text-center">';
                    if((!isset($_COOKIE['cook_dtype']) || $_COOKIE['cook_dtype'] =="delivery") && (isset($min_order) && number_format((($min_order/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2) > number_format(((($sub_total+(($sub_total*$tax)/100))/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2))) {
                        echo '<button class="btn btn-danger" type="button">Check Out</button>';
                    } else {
                        echo '<a href="'.SITE_URL.'checkout" title="Check Out"><button class="btn btn-danger" type="button" id="checkout_btn">Check Out</button></a>';
                    }
                    echo '</p>';
                    echo '</div>';

                }
            }
	}

	//Function to create cart view for menu page
	function fun_createCheckoutCartView($user_id = '') {
		if($user_id != ''){ // From database
			$sql 	= "SELECT * FROM " . TABLE_USER_CART . " WHERE user_id='".$user_id."'";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr 			= $this->dbObj->fetchAssoc($rs);
				$sub_total 		= 0;
				$tax 			= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "tax");
				if(!is_numeric($tax)) {
					$tax 		= 0;
				}
				$delivery_charge= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_charge");
				if(!is_numeric($delivery_charge) || ($_COOKIE['cook_dtype'] =="pickup")) {
					$delivery_charge = 0;
				}
				$extra_charge 	= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "extra_charge");
				if(!is_numeric($extra_charge)) {
					$extra_charge 	= 0;
				}
				$delivery_type 			= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_type");
				$min_order 				= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "min_order");

				$currencyRateArr= $this->fun_findCurrencyRate();

				$userCurrencyArr		= $this->fun_getUserCurrencyInfo($user_id);
				$users_currency_id		= $userCurrencyArr['currency_id'];
				$users_currency_code 	= $userCurrencyArr['currency_code'];
				$users_currency_symbol 	= $userCurrencyArr['currency_symbol'];
				$users_currency_rate 	= $userCurrencyArr['currency_rate'];
				$users_currency_name 	= $userCurrencyArr['currency_name'];
			
				// Restaurant currency info
				$currencyArr			= $this->fun_getRestaurantCurrencyInfo($arr[0]['rest_id']);
				$rest_currency_id		= $currencyArr['currency_id'];
				$rest_currency_code 	= $currencyArr['currency_code'];
				$rest_currency_symbol 	= $currencyArr['currency_symbol'];
				$rest_currency_rate 	= $currencyArr['currency_rate'];
				$rest_currency_name 	= $currencyArr['currency_name'];
				$currency_symbol		= ($users_currency_symbol == "")?$rest_currency_symbol:$users_currency_symbol;
				$currency_code			= ($users_currency_code == "")?$rest_currency_code:$users_currency_code;

				$rest_id 	= $arr[0]['rest_id'];
				$rest_name 	= $this->dbObj->getField(TABLE_RESTAURANT, "rest_id", $rest_id, "rest_name");
				//display cart items
				//echo 'Cook: '.$_COOKIE['cook_dtype'];
				echo '<span id="cart_rest_name">'.$rest_name.'</span>';
				echo '<div id="title_item" class="cart_title">Item</div>';
				echo '<div id="title_qtd" class="cart_title">Qty</div>';
				echo '<div id="title_price" class="cart_title">Price</div>';
				//echo '<div id="title_del" class="cart_title">Del</div>';
				for($i=0; $i < count($arr); $i++) {
					$user_basket_id 		= $arr[$i]['user_basket_id'];
					$user_id 				= $arr[$i]['user_id'];
					$product_id 			= $arr[$i]['product_id'];
					$rest_id 				= $arr[$i]['rest_id'];
					$user_basket_quantity 	= $arr[$i]['user_basket_quantity'];
					$final_price 			= $arr[$i]['final_price'];
					$sub_total 				= ($sub_total+$final_price);
					$comment 				= $arr[$i]['comment'];
					$menu_name 				= $this->dbObj->getField(TABLE_MENU, "menu_id", $product_id, "menu_name");
					echo '<div class="cart_info">';
					echo '<span class="info_item cart_info_all">';
					echo '<strong>'.ucwords($menu_name).'</strong>';
					echo '</span>';
					echo '<span class="info_qtd cart_info_all"><strong>'.$user_basket_quantity.'</strong></span>';
					echo '<span class="info_price cart_info_all">'.number_format((($final_price/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</span>';
					//echo '<span class="info_del cart_info_all"><a href="javascript:void(0);" class="del_item" onclick="return del_item('.$user_basket_id.')" title="Delete"> <img src="'.SITE_IMAGES.'icon_x_red.png" alt="Delete" border="0" height="8" width="8"> </a> </span>';
					echo '<span class="info_desc cart_info_all"><b>Instructions:</b> '.$comment.'</span>';
					echo '</div>';
				}
				echo '<div class="cartHr"></div>';
				echo '<span class="sumary_title">Subtotal: </span>';
				echo '<span class="sumary">'.number_format((($sub_total/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</span>';
				if(isset($tax) && $tax > 0) {
					echo '<span class="sumary_title">Tax: </span>';
					echo '<span class="sumary">'.number_format((((($sub_total/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code])*$tax)/100), 2).'</span>';
				} else {
					$tax = 0;
				}
				if((!isset($_COOKIE['cook_dtype']) || $_COOKIE['cook_dtype'] =="delivery") && isset($delivery_type) && $delivery_type == "1") {
					echo '<span class="sumary_title">Delivery Fee: </span>';
					echo '<span class="sumary"><span class="sumary_red">'.(($delivery_charge == 0)?'0.00':number_format((($delivery_charge/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2)).'</span></span>';
				} else {
					$delivery_charge = 0;
				}
				if(isset($extra_charge) && $extra_charge > 0) {
					echo '<span class="sumary_title">Processing Fee: </span>';
					echo '<span class="sumary"><span class="sumary_red">'.(($extra_charge == 0)?'0.00':number_format((($extra_charge/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2)).'</span></span>';
				} else {
					$extra_charge 	= 0;
				}
				echo '<div id="total">';
				echo '<span>Total: &nbsp;</span> <span>'.$users_currency_symbol.number_format(((($sub_total+(($sub_total*$tax)/100)+$delivery_charge+$extra_charge)/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</span>';
				echo '</div>';
				echo '<div style="clear:both;">&nbsp;</div>';
				$fr_url 	= $this->fun_getRestaurantFriendlyLink($rest_id);
				if(isset($fr_url) && $fr_url != "") {
					$restaurant_link 	= SITE_URL."restaurant/".strtolower($fr_url);
					echo '<div id="backtomenu_btn" align="center"> <a href="'.$restaurant_link.'" title="Back to Menu" class="button-red"> Back to Menu </a> </div>';
				}
			}
		} else { // From session
			if(is_array($_SESSION['cart']) && !empty($_SESSION['cart'])){
				//display cart items
				$arr 		= $_SESSION['cart'];
				$sub_total 	= 0;
				$tax 			= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "tax");
				if(!is_numeric($tax)) {
					$tax 		= 0;
				}
				$delivery_charge= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_charge");
				if(!is_numeric($delivery_charge) || ($_COOKIE['cook_dtype'] =="pickup")) {
					$delivery_charge = 0;
				}
				$extra_charge 	= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "extra_charge");
				if(!is_numeric($extra_charge)) {
					$extra_charge 	= 0;
				}
				$delivery_type 			= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_type");
				$min_order= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "min_order");

				$currencyRateArr= $this->fun_findCurrencyRate();

				$userCurrencyArr		= $this->fun_getUserCurrencyInfo();
				$users_currency_id		= $userCurrencyArr['currency_id'];
				$users_currency_code 	= $userCurrencyArr['currency_code'];
				$users_currency_symbol 	= $userCurrencyArr['currency_symbol'];
				$users_currency_rate 	= $userCurrencyArr['currency_rate'];
				$users_currency_name 	= $userCurrencyArr['currency_name'];
			
				// Restaurant currency info
				$currencyArr			= $this->fun_getRestaurantCurrencyInfo($arr[0]['rest_id']);
				$rest_currency_id		= $currencyArr['currency_id'];
				$rest_currency_code 	= $currencyArr['currency_code'];
				$rest_currency_symbol 	= $currencyArr['currency_symbol'];
				$rest_currency_rate 	= $currencyArr['currency_rate'];
				$rest_currency_name 	= $currencyArr['currency_name'];
				$currency_symbol		= ($users_currency_symbol == "")?$rest_currency_symbol:$users_currency_symbol;
				$currency_code			= ($users_currency_code == "")?$rest_currency_code:$users_currency_code;
				//print_r($userCurrencyArr);

				$rest_id 	= $arr[0]['rest_id'];
				$rest_name 	= $this->dbObj->getField(TABLE_RESTAURANT, "rest_id", $rest_id, "rest_name");

				//display cart items
				//echo 'Cook: '.$_COOKIE['cook_dtype'];
				echo '<span id="cart_rest_name">'.$rest_name.'</span>';
				echo '<div id="title_item" class="cart_title">Item</div>';
				echo '<div id="title_qtd" class="cart_title">Qty</div>';
				echo '<div id="title_price" class="cart_title">Price</div>';
				//echo '<div id="title_del" class="cart_title">Del</div>';
				for($i=0; $i < count($arr); $i++) {
					$item_id 				= $arr[$i]['item_id'];
					$rest_id 				= $arr[$i]['rest_id'];
					$menu_id 				= $arr[$i]['menu_id'];
					$menu_price_id 			= $arr[$i]['menu_price_id'];
					$quantity 				= $arr[$i]['quantity'];
					$order_comment 			= $arr[$i]['order_comment'];
					$options 				= $arr[$i]['options'];
					$radio_options 			= $arr[$i]['radio_options'];
					$select_options 		= $arr[$i]['select_options'];

					if(!isset($menu_price_id) || $menu_price_id =="") {
						$menu_price 		= $this->dbObj->getField(TABLE_MENU, "menu_id", $menu_id, "base_price");
					} else {
						$menu_price 		= $this->dbObj->getField(TABLE_MENU_PRICE_RELATION, array("menu_id", "price_id"), array($menu_id, $menu_price_id), "price");
					}
					if($quantity > 1) {
						$final_price 	= ($quantity*$menu_price);
					} else {
						$final_price 	= $menu_price;
					}

					if(is_array($options) && !empty($options)) { // for checkboxes
						foreach($options as $key => $value) {
							$option_id 		= $key;
							$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
							if(isset($addon_price) && $addon_price !="") {
								if($quantity > 1) {
									$final_price = ($final_price+($quantity*$addon_price));
								} else {
									$final_price = ($final_price+$addon_price);
								}
							}
						}
					}
		
					if(is_array($select_options) && !empty($select_options)) { // for select
						foreach($select_options as $key => $value) {
							$option_id 		= $value;
							$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
							if(isset($addon_price) && $addon_price !="") {
								if($quantity > 1) {
									$final_price = ($final_price+($quantity*$addon_price));
								} else {
									$final_price = ($final_price+$addon_price);
								}
							}
						}
					}
		
					if(is_array($radio_options) && !empty($radio_options)) { // for radio
						foreach($radio_options as $key => $value) {
							$option_id 		= $value;
							$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
							if(isset($addon_price) && $addon_price !="") {
								if($quantity > 1) {
									$final_price = ($final_price+($quantity*$addon_price));
								} else {
									$final_price = ($final_price+$addon_price);
								}
							}
						}
					}
					$sub_total 				= ($sub_total+$final_price);
					$menu_name 				= $this->dbObj->getField(TABLE_MENU, "menu_id", $menu_id, "menu_name");
					echo '<div class="cart_info">';
					echo '<span class="info_item cart_info_all">';
					echo '<strong>'.ucwords($menu_name).'</strong>';
					echo '</span>';
					echo '<span class="info_qtd cart_info_all"><strong>'.$quantity.'</strong></span>';
					echo '<span class="info_price cart_info_all">'.number_format((($final_price/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</span>';
					//echo '<span class="info_del cart_info_all"><a href="javascript:void(0);" class="del_item" onclick="return ses_del_cart_item(\''.$i.'\')" title="Delete"> <img src="'.SITE_IMAGES.'icon_x_red.png" alt="Delete" border="0" height="8" width="8"> </a> </span>';
					echo '<span class="info_desc cart_info_all"><b>Instructions:</b> '.$order_comment.'</span>';
					echo '</div>';
				}
				echo '<div class="cartHr"></div>';
				echo '<span class="sumary_title">Subtotal: </span>';
				echo '<span class="sumary">'.number_format((($sub_total/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</span>';
				if(isset($tax) && $tax > 0) {
					echo '<span class="sumary_title">Tax: </span>';
					echo '<span class="sumary">'.number_format((((($sub_total/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code])*$tax)/100), 2).'</span>';
				} else {
					$tax = 0;
				}
				if((!isset($_COOKIE['cook_dtype']) || $_COOKIE['cook_dtype'] =="delivery") && isset($delivery_type) && $delivery_type == "1") {
					echo '<span class="sumary_title">Delivery Fee: </span>';
					echo '<span class="sumary"><span class="sumary_red">'.(($delivery_charge == 0)?'0.00':number_format((($delivery_charge/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2)).'</span></span>';
				} else {
					$delivery_charge = 0;
				}
				if(isset($extra_charge) && $extra_charge > 0) {
					echo '<span class="sumary_title">Processing Fee: </span>';
					echo '<span class="sumary"><span class="sumary_red">'.(($extra_charge == 0)?'0.00':number_format((($extra_charge/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2)).'</span></span>';
				} else {
					$extra_charge 	= 0;
				}
				echo '<div id="total">';
				echo '<span>Total: &nbsp;</span> <span>'.$users_currency_symbol.number_format(((($sub_total+(($sub_total*$tax)/100)+$delivery_charge+$extra_charge)/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</span>';
				echo '</div>';
				$fr_url 	= $this->fun_getRestaurantFriendlyLink($rest_id);
				if(isset($fr_url) && $fr_url != "") {
					$restaurant_link 	= SITE_URL."restaurant/".strtolower($fr_url);
					echo '<div id="backtomenu_btn" align="center"> <a href="'.$restaurant_link.'" title="Back to Menu" class="button-red"> Back to Menu </a> </div>';
				}
			}
		}
	}

	function fun_addCartItem($user_id, $rest_id, $menu_id, $quantity, $order_comment, $menu_price_id, $options, $radio_options, $select_options){
		if($rest_id == "" || $menu_id == "" || $quantity == "") {
			return false;
		} else {
			//Step I: Check and delete other restaurant menu id added for this customer
			$strDelQuery = "DELETE FROM " . TABLE_USER_CART . " WHERE user_id='".$user_id."' AND rest_id NOT IN (".$rest_id.")";
			$this->dbObj->mySqlSafeQuery($strDelQuery); // delete any other restaurant's item
			$cur_unixtime 		= time ();
			if(!isset($menu_price_id) || $menu_price_id =="") {
				$menu_price 		= $this->dbObj->getField(TABLE_MENU, "menu_id", $menu_id, "base_price");
			} else {
				$menu_price 		= $this->dbObj->getField(TABLE_MENU_PRICE_RELATION, array("menu_id", "price_id"), array($menu_id, $menu_price_id), "price");
			}
			if($quantity > 1) {
				$final_price 	= ($quantity*$menu_price);
			} else {
				$final_price 	= $menu_price;
			}

			//Step I: add item in ires_user_basket
			$strInsQuery 	= "INSERT INTO " . TABLE_USER_CART . "(user_basket_id, user_id, product_id, rest_id, user_basket_quantity, final_price, comment, user_basket_date_added, user_basket_date_expire, payment_status) ";
			$strInsQuery 	.= "VALUES(null, '".$user_id."', '".$menu_id."', '".$rest_id."', '".$quantity."', '".$final_price."', '".$order_comment."', '".$cur_unixtime."',  '',  '1')";
			$this->dbObj->mySqlSafeQuery($strInsQuery);
			$user_basket_id = $this->dbObj->getIdentity();

			//Step II: add item in ires_user_basket_prices
			if(isset($menu_price_id) && $menu_price_id !="") { // for select
				$price 			= $this->dbObj->getField(TABLE_MENU_PRICE_RELATION, array("menu_id", "price_id"), array($menu_id, $menu_price_id), "price");
				$strInsQuery 	= "INSERT INTO " . TABLE_USER_CART_PRICES . "(user_basket_prices_id, user_basket_id, product_price_id, product_price_value) ";
				$strInsQuery 	.= "VALUES(null, '".$user_basket_id."', '".$menu_price_id."', '".$price."')";
				$this->dbObj->mySqlSafeQuery($strInsQuery);
			}

			//Step II: add item in ires_user_basket_attributes
			if(is_array($options) && !empty($options)) { // for checkboxes
				foreach($options as $key => $value) {
					$option_id 		= $key;
					$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
					if(isset($addon_price) && $addon_price !="") {
						if($quantity > 1) {
							$final_price = ($final_price+($quantity*$addon_price));
						} else {
							$final_price = ($final_price+$addon_price);
						}
					}

					$strInsQuery 	= "INSERT INTO " . TABLE_USER_CART_ATTRIBUTES . "(user_basket_attributes_id, user_basket_id, product_option_id, product_option_value) ";
					$strInsQuery 	.= "VALUES(null, '".$user_basket_id."', '".$option_id."', '".$addon_price."')";
					$this->dbObj->mySqlSafeQuery($strInsQuery);
				}
			}
			if(is_array($select_options) && !empty($select_options)) { // for select
				foreach($select_options as $key => $value) {
					$option_id 		= $value;
					$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
					if(isset($addon_price) && $addon_price !="") {
						if($quantity > 1) {
							$final_price = ($final_price+($quantity*$addon_price));
						} else {
							$final_price = ($final_price+$addon_price);
						}
					}

					$strInsQuery 	= "INSERT INTO " . TABLE_USER_CART_ATTRIBUTES . "(user_basket_attributes_id, user_basket_id, product_option_id, product_option_value) ";
					$strInsQuery 	.= "VALUES(null, '".$user_basket_id."', '".$option_id."', '".$addon_price."')";
					$this->dbObj->mySqlSafeQuery($strInsQuery);
				}
			}
			if(is_array($radio_options) && !empty($radio_options)) { // for select
				foreach($radio_options as $key => $value) {
					$option_id 		= $value;
					$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
					if(isset($addon_price) && $addon_price !="") {
						if($quantity > 1) {
							$final_price = ($final_price+($quantity*$addon_price));
						} else {
							$final_price = ($final_price+$addon_price);
						}
					}

					$strInsQuery 	= "INSERT INTO " . TABLE_USER_CART_ATTRIBUTES . "(user_basket_attributes_id, user_basket_id, product_option_id, product_option_value) ";
					$strInsQuery 	.= "VALUES(null, '".$user_basket_id."', '".$option_id."', '".$addon_price."')";
					$this->dbObj->mySqlSafeQuery($strInsQuery);
				}
			}
			/*
			$tax 			= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "tax");
			if(!is_numeric($tax)) {
				$tax 		= 0;
			}
			$delivery_charge= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "delivery_charge");
			if(!is_numeric($delivery_charge) || ($_COOKIE['cook_dtype'] =="pickup")) {
				$delivery_charge = 0;
			}
			*/
			//delivery charge and tex not applied here
			$delivery_charge 	= 0;
			$tax 				= 0;
			$final_price 	= number_format(($final_price+(($final_price*$tax)/100)+$delivery_charge), 2);
			$this->dbObj->updateField(TABLE_USER_CART, "user_basket_id", $user_basket_id, "final_price", $final_price);
			return $user_basket_id;
		}
	}

	function fun_updateUserCartFromSesCart($user_id){
		if($user_id == "") {
			return false;
		} else {
			$cur_unixtime 		= time ();
			$max 				= count($_SESSION['cart']);
			for($i=0; $i<$max; $i++){
				$rest_id 		= $_SESSION['cart'][$i]['rest_id'];
				$menu_id 		= $_SESSION['cart'][$i]['menu_id'];
				$menu_price_id	= $_SESSION['cart'][$i]['menu_price_id'];
				$quantity 		= $_SESSION['cart'][$i]['quantity'];
				$order_comment 	= $_SESSION['cart'][$i]['order_comment'];
				$options 		= $_SESSION['cart'][$i]['options'];
				$radio_options 	= $_SESSION['cart'][$i]['radio_options'];
				$select_options = $_SESSION['cart'][$i]['select_options'];

				if(!isset($menu_price_id) || $menu_price_id =="") {
					$menu_price 		= $this->dbObj->getField(TABLE_MENU, "menu_id", $menu_id, "base_price");
				} else {
					$menu_price 		= $this->dbObj->getField(TABLE_MENU_PRICE_RELATION, array("menu_id", "price_id"), array($menu_id, $menu_price_id), "price");
				}
				if($quantity > 1) {
					$final_price 	= ($quantity*$menu_price);
				} else {
					$final_price 	= $menu_price;
				}
	
				//Step I: add item in ires_user_basket
				$strInsQuery 	= "INSERT INTO " . TABLE_USER_CART . "(user_basket_id, user_id, product_id, rest_id, user_basket_quantity, final_price, comment, user_basket_date_added, user_basket_date_expire, payment_status) ";
				$strInsQuery 	.= "VALUES(null, '".$user_id."', '".$menu_id."', '".$rest_id."', '".$quantity."', '".$menu_price."', '".$order_comment."', '".$cur_unixtime."',  '',  '1')";
				$this->dbObj->mySqlSafeQuery($strInsQuery);
				$user_basket_id = $this->dbObj->getIdentity();

				//Step II: add item in ires_user_basket_attributes
				if(is_array($options) && !empty($options)) { // for checkboxes
					foreach($options as $key => $value) {
						$option_id 		= $key;
						$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
						if(isset($addon_price) && $addon_price !="") {
							if($quantity > 1) {
								$final_price = ($final_price+($quantity*$addon_price));
							} else {
								$final_price = ($final_price+$addon_price);
							}
						}
	
						$strInsQuery 	= "INSERT INTO " . TABLE_USER_CART_ATTRIBUTES . "(user_basket_attributes_id, user_basket_id, product_option_id, product_option_value) ";
						$strInsQuery 	.= "VALUES(null, '".$user_basket_id."', '".$option_id."', '".$addon_price."')";
						$this->dbObj->mySqlSafeQuery($strInsQuery);
					}
				}
				if(is_array($select_options) && !empty($select_options)) { // for select
					foreach($select_options as $key => $value) {
						$option_id 		= $value;
						$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
						if(isset($addon_price) && $addon_price !="") {
							if($quantity > 1) {
								$final_price = ($final_price+($quantity*$addon_price));
							} else {
								$final_price = ($final_price+$addon_price);
							}
						}
	
						$strInsQuery 	= "INSERT INTO " . TABLE_USER_CART_ATTRIBUTES . "(user_basket_attributes_id, user_basket_id, product_option_id, product_option_value) ";
						$strInsQuery 	.= "VALUES(null, '".$user_basket_id."', '".$option_id."', '".$addon_price."')";
						$this->dbObj->mySqlSafeQuery($strInsQuery);
					}
				}
				if(is_array($radio_options) && !empty($radio_options)) { // for select
					foreach($radio_options as $key => $value) {
						$option_id 		= $value;
						$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
						if(isset($addon_price) && $addon_price !="") {
							if($quantity > 1) {
								$final_price = ($final_price+($quantity*$addon_price));
							} else {
								$final_price = ($final_price+$addon_price);
							}
						}
	
						$strInsQuery 	= "INSERT INTO " . TABLE_USER_CART_ATTRIBUTES . "(user_basket_attributes_id, user_basket_id, product_option_id, product_option_value) ";
						$strInsQuery 	.= "VALUES(null, '".$user_basket_id."', '".$option_id."', '".$addon_price."')";
						$this->dbObj->mySqlSafeQuery($strInsQuery);
					}
				}
				/*
				$tax 			= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "tax");
				if(!is_numeric($tax)) {
					$tax 		= 0;
				}
				$delivery_charge= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "delivery_charge");
				if(!is_numeric($delivery_charge) || ($_COOKIE['cook_dtype'] =="pickup")) {
					$delivery_charge = 0;
				}
				*/
	
				$delivery_charge = 0;
				$tax 		= 0;
				$final_price 	= number_format(($final_price+(($final_price*$tax)/100)+$delivery_charge), 2);
				$this->dbObj->updateField(TABLE_USER_CART, "user_basket_id", $user_basket_id, "final_price", $final_price);
			}
			unset($_SESSION['cart']);
			return true;
		}
	}

	// This function will empty cart having user_id
	function fun_emptyUserCart($user_id){
		if($user_id == '') {
			return false;
		} else {
			$sql 	= "SELECT * FROM " . TABLE_USER_CART . " WHERE user_id='".$user_id."'";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr= $this->dbObj->fetchAssoc($rs);
				for($i=0; $i < count($arr); $i++) {
					$user_basket_id = $arr[$i]['user_basket_id'];
					$this->dbObj->deleteRow(TABLE_USER_CART_ATTRIBUTES, "user_basket_id", $user_basket_id);
					$this->dbObj->deleteRow(TABLE_USER_CART, "user_basket_id", $user_basket_id);
				}
			}
			return true;
		}
	}

	// This function will delete cart item from user basket
	function fun_delCartItem($user_basket_id){
		if($user_basket_id == '') {
			return false;
		} else {
			$this->dbObj->deleteRow(TABLE_USER_CART_ATTRIBUTES, "user_basket_id", $user_basket_id);
			$this->dbObj->deleteRow(TABLE_USER_CART, "user_basket_id", $user_basket_id);
			return true;
		}
	}

	// This function will delete cart item option from user basket
	function fun_delCartItemOption($user_basket_attributes_id){
		if($user_basket_attributes_id == '') {
			return false;
		} else {
			$this->dbObj->deleteRow(TABLE_USER_CART_ATTRIBUTES, "user_basket_attributes_id", $user_basket_attributes_id);
			return true;
		}
	}


/*
* cart functions : end here
*/	

/*
* Custom function: start here
*/
	// Function for creating optionlist for countries if country_id is available it must be selected
	function fun_getCountriesISDOptionsList($country_id='', $queryparameters=''){		
		$selected = "";
		$sql = "SELECT * FROM " . TABLE_COUNTRY. " ";
		if($queryparameters !=""){
			$sql .= " ".$queryparameters." ";
		} else {
			$sql .= " ORDER BY country_name";
		}
		$result = $this->dbObj->fun_db_query($sql);
		while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result)){
			if($rowsCon->country_id == $country_id  && $country_id!=''){
				$selected = " selected";
			}else{
				$selected = "";
			}
			echo "<option value=".fun_db_output($rowsCon->country_id)."" .$selected. ">";
			echo fun_db_output(ucwords($rowsCon->country_name));
			if($rowsCon->country_isd_code != "0"){
				echo " (+".fun_db_output(ucwords($rowsCon->country_isd_code)).")";
			}
			echo "</option>";
		}
		$this->dbObj->fun_db_free_resultset($result);
	}

	// Function for restaurant email array
	function fun_getRestEmailAlertsArr($rest_id){
		if($rest_id == '') {
			return false;
		} else {
			$sql 	= "SELECT * FROM " . TABLE_RESTAURANT_EMAIL_ALERTS . " WHERE rest_id='".$rest_id."' ";
			$sql 	.= " ORDER BY id DESC";		
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0) {
				return $arr = $this->dbObj->fetchAssoc($rs);
			} else {
				return false;
			}
		}
	}

	// Function for restaurant mobile array
	function fun_getRestMobileAlertsArr($rest_id){
		if($rest_id == '') {
			return false;
		} else {
			$sql 	= "SELECT * FROM " . TABLE_RESTAURANT_MOBILE_ALERTS . " WHERE rest_id='".$rest_id."' ";
			$sql 	.= " ORDER BY id DESC";		
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0) {
				return $arr = $this->dbObj->fetchAssoc($rs);
			} else {
				return false;
			}
		}
	}

	// function for get Customer SMS Body
	function fun_sendRestOrderCustomerSMSBody($rest_id, $order_id) {
        if($rest_id == "" || $order_id == "") {
            return false;
        } else {
			//Step I: find owner sms setting and their sms number
			$sql 	= "SELECT * FROM " . TABLE_ORDERS . " WHERE order_id='".$order_id."' ";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$body_sms = 'Dear Customer, ';
				$arr 					= $this->dbObj->fetchAssoc($rs);
				$user_id 				= $arr[0]['user_id'];
				$delivery_fname 		= $arr[0]['delivery_fname'];
				$delivery_lname 		= $arr[0]['delivery_lname'];
				$delivery_address1 		= $arr[0]['delivery_address1'];
				$delivery_address2 		= $arr[0]['delivery_address2'];
				$delivery_city 			= $arr[0]['delivery_city'];
				$delivery_state 		= $arr[0]['delivery_state'];
				$delivery_country 		= $arr[0]['delivery_country'];
				$delivery_zip 			= $arr[0]['delivery_zip'];
				$delivery_phone			= $arr[0]['delivery_phone'];
				$dtype 					= $arr[0]['dtype'];
				$schedule 				= $arr[0]['schedule'];
				$order_comments 		= $arr[0]['order_comments'];
				$payment_method 		= $arr[0]['payment_method'];
				$cc_type 				= $arr[0]['cc_type'];
				$cc_owner 				= $arr[0]['cc_owner'];
				$cc_number 				= $arr[0]['cc_number'];
				$cc_expires 			= $arr[0]['cc_expires'];
				$final_price 			= $arr[0]['final_price'];
				$currency_id 			= $arr[0]['currency_id'];
				$last_modified 			= $arr[0]['last_modified'];
				$date_purchased 		= $arr[0]['date_purchased'];
				$orders_status 			= $arr[0]['orders_status'];
				$orders_date_finished 	= $arr[0]['orders_date_finished'];
	
				$delivery_name 			= ucwords($delivery_fname.' '.$delivery_lname);
				$delivery_email 		= $this->dbObj->getField(TABLE_USERS, "user_id", $user_id, "user_email");

				$addressArr 			= array();
				if($delivery_address1 != "") {
					array_push($addressArr, $delivery_address1);
				}
				if($delivery_address2 != "") {
					array_push($addressArr, $delivery_address2);
				}
				if($delivery_city != "") {
					array_push($addressArr, $delivery_city);
				}
				if($delivery_state != "") {
					array_push($addressArr, $delivery_state);
				}
				if($delivery_zip != "") {
					array_push($addressArr, $delivery_zip);
				}
				$address 				= implode(", ", $addressArr);
				$schedule_for 			= $schedule.' ['.ucfirst($dtype).']';
				if(isset($orders_status) && $orders_status != "") {
					switch($orders_status) {
						case '1':
							$status = "New order";
						break;
						case '2':
							$status = "Pending";
						break;
						case '3':
							$status = "PayPal Preparation";
						break;
						case '4':
							$status = "Complete";
						break;
						case '5':
							$status = "Cancel";
						break;
						default:
							$status = "New order";
					}
				} else {
					$status = "New order";
				}
	
				if(isset($payment_method) && $payment_method != "") {
					switch($payment_method) {
						case '1':
							$payment_method_name = "Cash";
						break;
						case '2':
							$payment_method_name = "PayPal";
						break;
						case '3':
							$payment_method_name = "Credit Card";
						break;
						default:
							$payment_method_name = "Cash";
					}
				} else {
					$payment_method_name = "Cash";
				}
				//Order menu details
				$sqlOdr 	= "SELECT * FROM " . TABLE_ORDERS_PRODUCTS . " WHERE order_id='".$order_id."'";
				$rsOdr 	= $this->dbObj->createRecordset($sqlOdr);
				if($this->dbObj->getRecordCount($rsOdr) > 0){
					$arrOdr 		= $this->dbObj->fetchAssoc($rsOdr);
					$sub_total 	= 0;
					$tax 		= 0;
					$rest_id 	= $arrOdr[0]['rest_id'];
					$currencyArr			= $this->fun_getRestaurantCurrencyInfo($rest_id);
					$rest_currency_id		= $currencyArr['currency_id'];
					$rest_currency_code 	= $currencyArr['currency_code'];
					$rest_currency_symbol 	= $currencyArr['currency_symbol'];
					$rest_currency_rate 	= $currencyArr['currency_rate'];
					$rest_currency_name 	= $currencyArr['currency_name'];

					$restInfoArr		= $this->fun_getRestaurantInfo($rest_id);
					$Arr 				= array();
					array_push($Arr, $restInfoArr['rest_name']." - ".$restInfoArr['rest_address1']." ".$restInfoArr['rest_address2']);
					if(isset($restInfoArr['rest_city_id']) && $restInfoArr['rest_city_id'] !="") {
						$city_name = $this->dbObj->getField(TABLE_CITY, "city_id", $restInfoArr['rest_city_id'], "city_name");
						array_push($Arr, $city_name);
					}
					if(isset($restInfoArr['rest_state_id']) && $restInfoArr['rest_state_id'] !="") {
						$state_name = $this->dbObj->getField(TABLE_STATE, "state_id", $restInfoArr['rest_state_id'], "state_name");
						array_push($Arr, $state_name);
					}
					if(isset($restInfoArr['rest_country_id']) && $restInfoArr['rest_country_id'] !="") {
						$country_name = $this->dbObj->getField(TABLE_COUNTRY, "country_id", $restInfoArr['rest_country_id'], "country_name");
						array_push($Arr, $country_name);
					}
					if(isset($restInfoArr['rest_zip']) && $restInfoArr['rest_zip'] !="") {
						array_push($Arr, $restInfoArr['rest_zip']);
					}
					$rest_phone = $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "phone");
		
					if(isset($rest_phone) && $rest_phone !="") {
						array_push($Arr, "Phone: ".$rest_phone);
					}
		
					$strRest 			= implode(", ", $Arr);

					$delivery_charge= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "delivery_charge");
					if(!is_numeric($delivery_charge)) {
						$delivery_charge = 0;
					}
	
					//display cart items
					//$delivery_type = ($dtype="pickup")?2:1;
					//$str .= $rest_id.'*'.$delivery_type.'*'.fill_zero_left($order_id, "0", (6-strlen($order_id)));
					//$str .= $rest_id."*".$delivery_type."*".fill_zero_left($order_id, "0", (6-strlen($order_id))).'*'.$delivery_name.';'.$address.';*'.$schedule_for.'*$'.number_format($final_price, 2).';'.$payment_method_name.';'.$order_comments.';';
					$body_sms .= '	your order numbered #'.fill_zero_left($order_id, "0", (6-strlen($order_id))).', dated '.date("Y-m-d").' has been forwarded to '.$strRest.' for ';
					//$body_sms .= 'Order type:'.$dtype.';';
					/*
					for($i=0; $i < count($arrOdr); $i++) {
						$orders_products_id 	= $arrOdr[$i]['orders_products_id'];
						$order_id 				= $arrOdr[$i]['order_id'];
						$product_id 			= $arrOdr[$i]['product_id'];
						$rest_id 				= $arrOdr[$i]['rest_id'];
						$products_price 		= $arrOdr[$i]['products_price'];
						$final_price 			= $arrOdr[$i]['final_price'];
						$products_tax 			= $arrOdr[$i]['products_tax'];
						$quantity 				= $arrOdr[$i]['quantity'];
						$comment 				= $arrOdr[$i]['comment'];
						$menu_name 				= $this->dbObj->getField(TABLE_MENU, "menu_id", $product_id, "menu_name");
						$base_price				= $this->dbObj->getField(TABLE_MENU, "menu_id", $product_id, "base_price");

						// Restaurant currency info
						$currencyArr			= $this->fun_getRestaurantCurrencyInfo($rest_id);
						$rest_currency_id		= $currencyArr['currency_id'];
						$rest_currency_code 	= $currencyArr['currency_code'];
						$rest_currency_symbol 	= $currencyArr['currency_symbol'];
						$rest_currency_rate 	= $currencyArr['currency_rate'];
						$rest_currency_name 	= $currencyArr['currency_name'];

						//$str .= '*'.$quantity.';'.$menu_name.';$'.number_format($final_price, 2).';';
						//$body_sms .= ($i+1).') '.$menu_name.'('.$quantity.' x '.$rest_currency_code.''.number_format($base_price, 2).') '.$rest_currency_code.''.number_format(($quantity*$base_price), 2).';';
	
						//menu option will be here
						// Step I: get option array of order proucts
						$sqlOpt 	= "SELECT product_option_id FROM " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " WHERE orders_products_id='".$orders_products_id."'";
						$rsOpt 		= $this->dbObj->createRecordset($sqlOpt);
						if($this->dbObj->getRecordCount($rsOpt) > 0){
							$comment = '';
							$optionsArr = array();
							$arrOpt = $this->dbObj->fetchAssoc($rsOpt);
							for($j=0; $j < count($arrOpt); $j++) {
								array_push($optionsArr, $arrOpt[$j]['product_option_id']);
							}
							// Step II: get category array of having those options
							$option_ids 	= implode(",", $optionsArr);
							$sqlOrderOptCat = "SELECT A.category_id, A.category_name, A.display_type
							FROM " . TABLE_MENU_OPTION_CATEGORY . " AS A  
							WHERE A.category_id IN (SELECT category_id  FROM " . TABLE_MENU_OPTION . " WHERE option_id IN (".$option_ids.") GROUP BY category_id)";
							$rsOrderOptCat 		= $this->dbObj->createRecordset($sqlOrderOptCat);
							if($this->dbObj->getRecordCount($rsOrderOptCat) > 0) {
								$arrOrderOptCat 	= $this->dbObj->fetchAssoc($rsOrderOptCat);
								for($counter = 0; $counter < count($arrOrderOptCat); $counter++) {
									$category_id 	= $arrOrderOptCat[$counter]['category_id'];
									$category_name 	= $arrOrderOptCat[$counter]['category_name'];
									$display_type 	= $arrOrderOptCat[$counter]['display_type'];
									$comment .= '*'.ucwords($category_name).':';
									$sql 			= "SELECT A.option_id, A.option_name  FROM " . TABLE_MENU_OPTION . " AS A WHERE A.category_id='".$category_id."' AND A.option_id IN (".$option_ids.") ";
									$rs 			= $this->dbObj->createRecordset($sql);
									if($this->dbObj->getRecordCount($rs) > 0){
										$arr 		= $this->dbObj->fetchAssoc($rs);
										for($k=0; $k < count($arr); $k++) {
											$comment .= ucwords($arr[$k]['option_name']).',';
										}
									}
								}
							}
						}
					}
					*/

					$body_sms .= $rest_currency_code.''.number_format($final_price, 2).'. You will receive confirmation details from the restaurant sooner or later.  Thanks, www.unitedrestaurants.com';
					//$body_sms .= 'Total Amount: '.$rest_currency_symbol.''.number_format($final_price, 2).';';
					//$body_sms .= 'Total Amount: '.$rest_currency_code.''.number_format($final_price, 2).';';
					//$body_sms .= 'Customer: '.$delivery_name.';'.$address.';Contact: '.$delivery_phone.';Email : '.$delivery_email.' ';
				}
				//$body_sms .= 'Regards, www.unitedrestaurants.com';
				return $body_sms;
			} else {
				return false;
			}
		}
	}

	// function for get SMS Body
	function fun_sendRestOrderSMSBody($rest_id, $order_id) {
        if($rest_id == "" || $order_id == "") {
            return false;
        } else {
			//Step I: find owner sms setting and their sms number
			$sql 	= "SELECT * FROM " . TABLE_ORDERS . " WHERE order_id='".$order_id."' ";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$body_sms = 'Dear admin, ';
				$arr 					= $this->dbObj->fetchAssoc($rs);
				$user_id 				= $arr[0]['user_id'];
				$delivery_fname 		= $arr[0]['delivery_fname'];
				$delivery_lname 		= $arr[0]['delivery_lname'];
				$delivery_address1 		= $arr[0]['delivery_address1'];
				$delivery_address2 		= $arr[0]['delivery_address2'];
				$delivery_city 			= $arr[0]['delivery_city'];
				$delivery_state 		= $arr[0]['delivery_state'];
				$delivery_country 		= $arr[0]['delivery_country'];
				$delivery_zip 			= $arr[0]['delivery_zip'];
				$delivery_phone			= $arr[0]['delivery_phone'];
				$dtype 					= $arr[0]['dtype'];
				$schedule 				= $arr[0]['schedule'];
				$order_comments 		= $arr[0]['order_comments'];
				$payment_method 		= $arr[0]['payment_method'];
				$cc_type 				= $arr[0]['cc_type'];
				$cc_owner 				= $arr[0]['cc_owner'];
				$cc_number 				= $arr[0]['cc_number'];
				$cc_expires 			= $arr[0]['cc_expires'];
				$final_price 			= $arr[0]['final_price'];
				$currency_id 			= $arr[0]['currency_id'];
				$last_modified 			= $arr[0]['last_modified'];
				$date_purchased 		= $arr[0]['date_purchased'];
				$orders_status 			= $arr[0]['orders_status'];
				$orders_date_finished 	= $arr[0]['orders_date_finished'];
	
				$delivery_name 			= ucwords($delivery_fname.' '.$delivery_lname);
				$delivery_email 		= $this->dbObj->getField(TABLE_USERS, "user_id", $user_id, "user_email");

				$addressArr 			= array();
				if($delivery_address1 != "") {
					array_push($addressArr, $delivery_address1);
				}
				if($delivery_address2 != "") {
					array_push($addressArr, $delivery_address2);
				}
				if($delivery_city != "") {
					array_push($addressArr, $delivery_city);
				}
				if($delivery_state != "") {
					array_push($addressArr, $delivery_state);
				}
				if($delivery_zip != "") {
					array_push($addressArr, $delivery_zip);
				}
				$address 				= implode(", ", $addressArr);
				$schedule_for 			= $schedule.' ['.ucfirst($dtype).']';
				if(isset($orders_status) && $orders_status != "") {
					switch($orders_status) {
						case '1':
							$status = "New order";
						break;
						case '2':
							$status = "Pending";
						break;
						case '3':
							$status = "PayPal Preparation";
						break;
						case '4':
							$status = "Complete";
						break;
						case '5':
							$status = "Cancel";
						break;
						default:
							$status = "New order";
					}
				} else {
					$status = "New order";
				}
	
				if(isset($payment_method) && $payment_method != "") {
					switch($payment_method) {
						case '1':
							$payment_method_name = "Cash";
						break;
						case '2':
							$payment_method_name = "PayPal";
						break;
						case '3':
							$payment_method_name = "Credit Card";
						break;
						default:
							$payment_method_name = "Cash";
					}
				} else {
					$payment_method_name = "Cash";
				}
				//Order menu details
				$sqlOdr 	= "SELECT * FROM " . TABLE_ORDERS_PRODUCTS . " WHERE order_id='".$order_id."'";
				$rsOdr 	= $this->dbObj->createRecordset($sqlOdr);
				if($this->dbObj->getRecordCount($rsOdr) > 0){
					$arrOdr 		= $this->dbObj->fetchAssoc($rsOdr);
					$sub_total 	= 0;
					$tax 		= 0;
					$rest_id 	= $arrOdr[0]['rest_id'];
					$rest_name 	= $this->dbObj->getField(TABLE_RESTAURANT, "rest_id", $rest_id, "rest_name");
					$rest_name 	= $this->dbObj->getField(TABLE_RESTAURANT, "rest_id", $rest_id, "rest_name");
	
					$delivery_charge= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "delivery_charge");
					if(!is_numeric($delivery_charge)) {
						$delivery_charge = 0;
					}
	
					//display cart items
					$delivery_type = ($dtype="pickup")?2:1;
					//$str .= $rest_id.'*'.$delivery_type.'*'.fill_zero_left($order_id, "0", (6-strlen($order_id)));
					//$str .= $rest_id."*".$delivery_type."*".fill_zero_left($order_id, "0", (6-strlen($order_id))).'*'.$delivery_name.';'.$address.';*'.$schedule_for.'*$'.number_format($final_price, 2).';'.$payment_method_name.';'.$order_comments.';';
	
					$body_sms .= 'new order has been placed with voucher numbered #'.fill_zero_left($order_id, "0", (6-strlen($order_id))).', below are the details of the order,';
					$body_sms .= 'Order type:'.$dtype.'; Schedule for: '.$schedule.';';

					for($i=0; $i < count($arrOdr); $i++) {
						$orders_products_id 	= $arrOdr[$i]['orders_products_id'];
						$order_id 				= $arrOdr[$i]['order_id'];
						$product_id 			= $arrOdr[$i]['product_id'];
						$rest_id 				= $arrOdr[$i]['rest_id'];
						$products_price 		= $arrOdr[$i]['products_price'];
						$final_price 			= $arrOdr[$i]['final_price'];
						$products_tax 			= $arrOdr[$i]['products_tax'];
						$quantity 				= $arrOdr[$i]['quantity'];
						$comment 				= $arrOdr[$i]['comment'];
						$menu_name 				= $this->dbObj->getField(TABLE_MENU, "menu_id", $product_id, "menu_name");
						$base_price				= $this->dbObj->getField(TABLE_MENU, "menu_id", $product_id, "base_price");

						// Restaurant currency info
						$currencyArr			= $this->fun_getRestaurantCurrencyInfo($rest_id);
						$rest_currency_id		= $currencyArr['currency_id'];
						$rest_currency_code 	= $currencyArr['currency_code'];
						$rest_currency_symbol 	= $currencyArr['currency_symbol'];
						$rest_currency_rate 	= $currencyArr['currency_rate'];
						$rest_currency_name 	= $currencyArr['currency_name'];

						//$str .= '*'.$quantity.';'.$menu_name.';$'.number_format($final_price, 2).';';
						$body_sms .= ($i+1).') '.$menu_name.'('.$quantity.' x '.$rest_currency_code.''.number_format($base_price, 2).') '.$rest_currency_code.''.number_format(($quantity*$base_price), 2).';';
	
						//menu option will be here
						// Step I: get option array of order proucts
						$sqlOpt 	= "SELECT product_option_id FROM " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " WHERE orders_products_id='".$orders_products_id."'";
						$rsOpt 		= $this->dbObj->createRecordset($sqlOpt);
						if($this->dbObj->getRecordCount($rsOpt) > 0){
							$comment = '';
							$optionsArr = array();
							$arrOpt = $this->dbObj->fetchAssoc($rsOpt);
							for($j=0; $j < count($arrOpt); $j++) {
								array_push($optionsArr, $arrOpt[$j]['product_option_id']);
							}
							// Step II: get category array of having those options
							$option_ids 	= implode(",", $optionsArr);
							$sqlOrderOptCat = "SELECT A.category_id, A.category_name, A.display_type
							FROM " . TABLE_MENU_OPTION_CATEGORY . " AS A  
							WHERE A.category_id IN (SELECT category_id  FROM " . TABLE_MENU_OPTION . " WHERE option_id IN (".$option_ids.") GROUP BY category_id)";
							$rsOrderOptCat 		= $this->dbObj->createRecordset($sqlOrderOptCat);
							if($this->dbObj->getRecordCount($rsOrderOptCat) > 0) {
								$arrOrderOptCat 	= $this->dbObj->fetchAssoc($rsOrderOptCat);
								for($counter = 0; $counter < count($arrOrderOptCat); $counter++) {
									$category_id 	= $arrOrderOptCat[$counter]['category_id'];
									$category_name 	= $arrOrderOptCat[$counter]['category_name'];
									$display_type 	= $arrOrderOptCat[$counter]['display_type'];
									$comment .= '*'.ucwords($category_name).':';
									$sql 			= "SELECT A.option_id, A.option_name  FROM " . TABLE_MENU_OPTION . " AS A WHERE A.category_id='".$category_id."' AND A.option_id IN (".$option_ids.") ";
									$rs 			= $this->dbObj->createRecordset($sql);
									if($this->dbObj->getRecordCount($rs) > 0){
										$arr 		= $this->dbObj->fetchAssoc($rs);
										for($k=0; $k < count($arr); $k++) {
											$comment .= ucwords($arr[$k]['option_name']).',';
										}
									}
								}
							}
						}
					}
					$body_sms .= 'Total Amount: '.$rest_currency_code.''.number_format($final_price, 2).' '.$comment.' '.$order_comments.' ';
					//$body_sms .= 'Total Amount: '.$rest_currency_symbol.''.number_format($final_price, 2).';';
					//$body_sms .= 'Total Amount: '.$rest_currency_code.''.number_format($final_price, 2).';';
					$body_sms .= 'Customer: '.$delivery_name.';'.$address.';Contact: '.$delivery_phone.';Email : '.$delivery_email.' ';
				}
				$body_sms .= 'Thanks, www.unitedrestaurants.com';
				return $body_sms;
			} else {
				return false;
			}
		}
	}

	// function for delete user SMS number
	function fun_sendRestOrderSMSsg($rest_id, $order_id) {
        if($rest_id == "" || $order_id == "") {
            return false;
        } else {
			//Step I: find owner sms setting and their sms number
			$sql 	= "SELECT * FROM " . TABLE_ORDERS . " WHERE order_id='".$order_id."' ";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr 					= $this->dbObj->fetchAssoc($rs);
				$user_id 				= $arr[0]['user_id'];
				$delivery_fname 		= $arr[0]['delivery_fname'];
				$delivery_lname 		= $arr[0]['delivery_lname'];
				$delivery_address1 		= $arr[0]['delivery_address1'];
				$delivery_address2 		= $arr[0]['delivery_address2'];
				$delivery_city 			= $arr[0]['delivery_city'];
				$delivery_state 		= $arr[0]['delivery_state'];
				$delivery_country 		= $arr[0]['delivery_country'];
				$delivery_zip 			= $arr[0]['delivery_zip'];
				$delivery_phone			= $arr[0]['delivery_phone'];
				$dtype 					= $arr[0]['dtype'];
				$schedule 				= $arr[0]['schedule'];
				$order_comments 		= $arr[0]['order_comments'];
				$payment_method 		= $arr[0]['payment_method'];
				$final_price 			= $arr[0]['final_price'];
				$currency_id 			= $arr[0]['currency_id'];
				$delivery_name 			= ucwords($delivery_fname.' '.$delivery_lname);
				$addressArr 			= array();
				if($delivery_address1 != "") { array_push($addressArr, $delivery_address1); }
				if($delivery_address2 != "") { array_push($addressArr, $delivery_address2); }
				if($delivery_city != "") { array_push($addressArr, $delivery_city); }
				if($delivery_state != "") { array_push($addressArr, $delivery_state); }
				if($delivery_zip != "") { array_push($addressArr, $delivery_zip); }
				$address 				= implode(", ", $addressArr);
				$schedule_for 			= $schedule.' ['.ucfirst($dtype).']';
				if(isset($orders_status) && $orders_status != "") {
					switch($orders_status) {
						case '1':
							$status = "New order";
						break;
						case '2':
							$status = "Pending";
						break;
						case '3':
							$status = "PayPal Preparation";
						break;
						case '4':
							$status = "Complete";
						break;
						case '5':
							$status = "Cancel";
						break;
						default:
							$status = "New order";
					}
				} else {
					$status = "New order";
				}
	
				if(isset($payment_method) && $payment_method != "") {
					switch($payment_method) {
						case '1':
							$payment_method_name = "Cash";
						break;
						case '2':
							$payment_method_name = "PayPal";
						break;
						case '3':
							$payment_method_name = "Credit Card";
						break;
						default:
							$payment_method_name = "Cash";
					}
				} else {
					$payment_method_name = "Cash";
				}
				//$body_sms .= fill_zero_left($order_id, "0", (6-strlen($order_id))).'*'.$delivery_name.';'.$address.';*'.$schedule_for.'*$'.number_format($final_price, 2).';'.$payment_method_name.';'.$order_comments.';';
				//$body_sms .= fill_zero_left($order_id, "0", (6-strlen($order_id))).' from: '.$delivery_name.' of Amount: '.number_format($final_price, 2).'';
				//$body_sms .= fill_zero_left($order_id, "0", (6-strlen($order_id))).' from: '.$delivery_name.'';
				$body_sms = $this->fun_sendRestOrderSMSBody($rest_id, $order_id);

				//Step II: Find number details
				$sqlSMS 	= "SELECT B.country_isd_code, A.mobile_number FROM " . TABLE_RESTAURANT_MOBILE_ALERTS . " AS A LEFT JOIN " . TABLE_COUNTRY . " AS B ON A.mobile_countryid = B.country_id WHERE A.rest_id ='".$rest_id."' ";
				$rsSMS 		= $this->dbObj->createRecordset($sqlSMS);
				if($this->dbObj->getRecordCount($rsSMS) > 0){
					$arrSMS 			= $this->dbObj->fetchAssoc($rsSMS);
					$destination_arr	= array();
					for($i = 0; $i < count($arrSMS); $i++) {
						$country_isd_code	= $arrSMS[$i]['country_isd_code'];
						$mobile_number		= $arrSMS[$i]['mobile_number'];
						//$mobile 			= fill_zero_left($country_isd_code, "0", (4-strlen($country_isd_code)))."".$mobile_number;
						//$mobile 			= $country_isd_code.$mobile_number;
						$mobile 			= "65".$mobile_number;
						array_push($destination_arr, $mobile);
					}
					$destination= implode(",", $destination_arr);
					//$destination= "6590662340";

					$username 	= "smartren";
					$password 	= "newcspl13";
					

					$body 		= urlencode($body_sms);
					//echo "<br><br>";
					//echo "Body Msg: ".$body;

					$baseurl 	= "http://www.sms.sg";
					$url 		= "$baseurl/http/sendmsg?user=$username&pwd=$password&option=send&to=%2B$destination&msg=$body";
					//http://www.sms.sg/http/sendmsg?user=test&pwd=test&option=send&to=%2B6591234567,987654321,91239123,91111111,91234455&msg= This%20is%20a%20Test
					//echo "SMS URL: ".$url;
					//die();
					//send sms now
					$ch 		= curl_init();
					curl_setopt($ch, CURLOPT_USERAGENT, 'Firefox (WindowsXP) - Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_FAILONERROR, true);
					curl_setopt($ch, CURLOPT_AUTOREFERER, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
					curl_setopt($ch, CURLOPT_TIMEOUT, 45);
					$html 		= curl_exec($ch);
					if (!$html) {
						echo "<br />cURL error number:" .curl_errno($ch);
						echo "<br />cURL error:" . curl_error($ch);
						exit;
					}
					curl_close($ch);
				}
				if(isset($delivery_phone) && $delivery_phone != "") {
					$destination= $delivery_phone;
					//$destination= "9971740974";
					$username 	= "smartren";
					$password 	= "newcspl13";
					$body_customer_sms = $this->fun_sendRestOrderCustomerSMSBody($rest_id, $order_id);
					$body 		= urlencode($body_customer_sms);
					//$body 		= $body_sms;
					//echo "<br><br>";
					//echo "Body Msg: ".$body;

					$baseurl 	= "http://www.sms.sg";
					$url 		= "$baseurl/http/sendmsg?user=$username&pwd=$password&option=send&to=%2B$destination&msg=$body";
					//http://www.perfectbulksms.com/Sendsmsapi.aspx?USERID=username&PASSWORD=password&SENDERID=ABC&TO=9999999999,9899999999&MESSAGE=Good Morning
					//http://www.perfectbulksms.com/Sendsmsapi.aspx?USERID=Eatonline&PASSWORD=eatindia13&SENDERID=EATONL&TO=9971740974&MESSAGE=Good Morning
					//echo "SMS URL: ".$url;
					//die();
					//send sms now
					$ch 		= curl_init();
					curl_setopt($ch, CURLOPT_USERAGENT, 'Firefox (WindowsXP) - Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_FAILONERROR, true);
					curl_setopt($ch, CURLOPT_AUTOREFERER, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
					curl_setopt($ch, CURLOPT_TIMEOUT, 45);
					$html 		= curl_exec($ch);
					if (!$html) {
						echo "<br />cURL error number:" .curl_errno($ch);
						echo "<br />cURL error:" . curl_error($ch);
						exit;
					}
					curl_close($ch);
				}
				return true;
			} else {
				return false;
			}
        }
	}

	// function for delete user SMS number
	function fun_sendRestOrderSMSsd($rest_id, $order_id) {
        if($rest_id == "" || $order_id == "") {
            return false;
        } else {
			//Step I: find owner sms setting and their sms number
			$sql 	= "SELECT * FROM " . TABLE_ORDERS . " WHERE order_id='".$order_id."' ";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr 					= $this->dbObj->fetchAssoc($rs);
				$user_id 				= $arr[0]['user_id'];
				$delivery_fname 		= $arr[0]['delivery_fname'];
				$delivery_lname 		= $arr[0]['delivery_lname'];
				$delivery_address1 		= $arr[0]['delivery_address1'];
				$delivery_address2 		= $arr[0]['delivery_address2'];
				$delivery_city 			= $arr[0]['delivery_city'];
				$delivery_state 		= $arr[0]['delivery_state'];
				$delivery_country 		= $arr[0]['delivery_country'];
				$delivery_zip 			= $arr[0]['delivery_zip'];
				$delivery_phone			= $arr[0]['delivery_phone'];
				$dtype 					= $arr[0]['dtype'];
				$schedule 				= $arr[0]['schedule'];
				$order_comments 		= $arr[0]['order_comments'];
				$payment_method 		= $arr[0]['payment_method'];
				$final_price 			= $arr[0]['final_price'];
				$currency_id 			= $arr[0]['currency_id'];
				$delivery_name 			= ucwords($delivery_fname.' '.$delivery_lname);
				$addressArr 			= array();
				if($delivery_address1 != "") { array_push($addressArr, $delivery_address1); }
				if($delivery_address2 != "") { array_push($addressArr, $delivery_address2); }
				if($delivery_city != "") { array_push($addressArr, $delivery_city); }
				if($delivery_state != "") { array_push($addressArr, $delivery_state); }
				if($delivery_zip != "") { array_push($addressArr, $delivery_zip); }
				$address 				= implode(", ", $addressArr);
				$schedule_for 			= $schedule.' ['.ucfirst($dtype).']';
				if(isset($orders_status) && $orders_status != "") {
					switch($orders_status) {
						case '1':
							$status = "New order";
						break;
						case '2':
							$status = "Pending";
						break;
						case '3':
							$status = "PayPal Preparation";
						break;
						case '4':
							$status = "Complete";
						break;
						case '5':
							$status = "Cancel";
						break;
						default:
							$status = "New order";
					}
				} else {
					$status = "New order";
				}
	
				if(isset($payment_method) && $payment_method != "") {
					switch($payment_method) {
						case '1':
							$payment_method_name = "Cash";
						break;
						case '2':
							$payment_method_name = "PayPal";
						break;
						case '3':
							$payment_method_name = "Credit Card";
						break;
						default:
							$payment_method_name = "Cash";
					}
				} else {
					$payment_method_name = "Cash";
				}
				//$body_sms .= fill_zero_left($order_id, "0", (6-strlen($order_id))).'*'.$delivery_name.';'.$address.';*'.$schedule_for.'*$'.number_format($final_price, 2).';'.$payment_method_name.';'.$order_comments.';';
				//$body_sms .= fill_zero_left($order_id, "0", (6-strlen($order_id))).' from: '.$delivery_name.' of Amount: '.number_format($final_price, 2).'';
				//$body_sms .= fill_zero_left($order_id, "0", (6-strlen($order_id))).' from: '.$delivery_name.'';
				$body_sms = $this->fun_sendRestOrderSMSBody($rest_id, $order_id);
				//echo $body_sms;

				//Step II: Find number details
				$sqlSMS 	= "SELECT B.country_isd_code, A.mobile_number FROM " . TABLE_RESTAURANT_MOBILE_ALERTS . " AS A LEFT JOIN " . TABLE_COUNTRY . " AS B ON A.mobile_countryid = B.country_id WHERE A.rest_id ='".$rest_id."' ";
				$rsSMS 		= $this->dbObj->createRecordset($sqlSMS);
				if($this->dbObj->getRecordCount($rsSMS) > 0){
					$arrSMS 			= $this->dbObj->fetchAssoc($rsSMS);
					$destination_arr	= array();
					for($i = 0; $i < count($arrSMS); $i++) {
						$country_isd_code	= $arrSMS[$i]['country_isd_code'];
						$mobile_number		= $arrSMS[$i]['mobile_number'];
						//$mobile 			= fill_zero_left($country_isd_code, "0", (4-strlen($country_isd_code)))."".$mobile_number;
						$mobile 			= $mobile_number;
						array_push($destination_arr, $mobile);
					}
					$destination= implode(",", $destination_arr);
					//$destination= "00919971740974";
					//$destination= "9971740974";

					$username 	= "Eatonline";
					$password 	= "eatindia13";
					
					$body 		= urlencode($body_sms);
					//$body 		= $body_sms;
					//echo "<br><br>";
					//echo "Body Msg: ".$body;

					$baseurl 	= "http://www.perfectbulksms.com";
					$url 		= "$baseurl//Sendsmsapi.aspx?USERID=$username&PASSWORD=$password&SENDERID=EATONL&TO=$destination&MESSAGE=$body";
					//http://www.perfectbulksms.com/Sendsmsapi.aspx?USERID=username&PASSWORD=password&SENDERID=ABC&TO=9999999999,9899999999&MESSAGE=Good Morning
					//http://www.perfectbulksms.com/Sendsmsapi.aspx?USERID=Eatonline&PASSWORD=eatindia13&SENDERID=EATONL&TO=9971740974&MESSAGE=Good Morning
					//echo "SMS URL: ".$url;
					//die();
					//send sms now
					$ch 		= curl_init();
					curl_setopt($ch, CURLOPT_USERAGENT, 'Firefox (WindowsXP) - Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_FAILONERROR, true);
					curl_setopt($ch, CURLOPT_AUTOREFERER, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
					curl_setopt($ch, CURLOPT_TIMEOUT, 45);
					$html 		= curl_exec($ch);
					if (!$html) {
						echo "<br />cURL error number:" .curl_errno($ch);
						echo "<br />cURL error:" . curl_error($ch);
						exit;
					}
					curl_close($ch);
				}

				if(isset($delivery_phone) && $delivery_phone != "") {
					$destination= $delivery_phone;
					//$destination= "9971740974";
					$username 	= "Eatonline";
					$password 	= "eatindia13";
					$body_customer_sms = $this->fun_sendRestOrderCustomerSMSBody($rest_id, $order_id);
					$body 		= urlencode($body_customer_sms);
					//$body 		= $body_sms;
					//echo "<br><br>";
					//echo "Body Msg: ".$body;

					$baseurl 	= "http://www.perfectbulksms.com";
					$url 		= "$baseurl//Sendsmsapi.aspx?USERID=$username&PASSWORD=$password&SENDERID=EATONL&TO=$destination&MESSAGE=$body";
					//http://www.perfectbulksms.com/Sendsmsapi.aspx?USERID=username&PASSWORD=password&SENDERID=ABC&TO=9999999999,9899999999&MESSAGE=Good Morning
					//http://www.perfectbulksms.com/Sendsmsapi.aspx?USERID=Eatonline&PASSWORD=eatindia13&SENDERID=EATONL&TO=9971740974&MESSAGE=Good Morning
					//echo "SMS URL: ".$url;
					//die();
					//send sms now
					$ch 		= curl_init();
					curl_setopt($ch, CURLOPT_USERAGENT, 'Firefox (WindowsXP) - Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_FAILONERROR, true);
					curl_setopt($ch, CURLOPT_AUTOREFERER, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
					curl_setopt($ch, CURLOPT_TIMEOUT, 45);
					$html 		= curl_exec($ch);
					if (!$html) {
						echo "<br />cURL error number:" .curl_errno($ch);
						echo "<br />cURL error:" . curl_error($ch);
						exit;
					}
					curl_close($ch);
				}
				return true;
			} else {
				return false;
			}
        }
	}


	// function for send order notification
	function fun_sendRestOrderNotification($rest_id, $order_id) {
        if($rest_id == "" || $order_id == "") {
            return false;
        } else {
			$body 			= $this->fun_createOrderView($order_id);
			$rest_name 		= $this->dbObj->getField(TABLE_RESTAURANT, "rest_id", $rest_id, "rest_name");
			$manager_id 	= $this->dbObj->getField(TABLE_RESTAURANT_MANAGER_RELATIONS, "rest_id", $rest_id, "manager_id");
			$user_id 		= $this->dbObj->getField(TABLE_ORDERS, "order_id", $order_id, "user_id");
			$manager_email 	= $this->dbObj->getField(TABLE_USERS, "user_id", $manager_id, "user_email");
			$user_email 	= $this->dbObj->getField(TABLE_USERS, "user_id", $user_id, "user_email");

			$order_html_mgr .= "<table width=\"80%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
			$order_html_mgr .= "<tr>";
			$order_html_mgr .= "<td valign=\"top\">";
			$order_html_mgr .= "<strong>Dear Admin, <br>You have received the following order from ".$user_email.".</strong><br><br>";
			$order_html_mgr .= "<strong>Order details are:</strong><br><br><hr><br>";
			$order_html_mgr .= $body;
			$order_html_mgr .= "<br><hr><br><strong>Kindly proceed to serve the client</strong><br><br>";
			$order_html_mgr .= "Thanks,<br>".$_SERVER["SERVER_NAME"]."<br><br>";
			$order_html_mgr .= "</td>";
			$order_html_mgr .= "</tr>";
			$order_html_mgr .= "</table>";

			$order_html_usr .= "<table width=\"80%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
			$order_html_usr .= "<tr>";
			$order_html_usr .= "<td valign=\"top\">";
			$order_html_usr .= "<strong>Thank you very much for your order, ".$user_email.".</strong> This email contains important information regarding your recent Eatonline purchase-please save it for reference.";
			$order_html_usr .= "<strong>Below is a copy of your online food order:</strong><br><br><hr><br>";
			$order_html_usr .= $body;
			$order_html_usr .= "<br><hr><br>You will get a confirmation from the restaurant via sms/email<br><br>";
			$order_html_usr .= "In case you do not get a confirmation you can contact the restaurant directly quoting your transaction id. Or our confirmation number.<br><br>";
			$order_html_usr .= "The orders are non refundable in any circumstance other than a valid reason as agreed by the restaurant,however all refunds will incur a charge of 10%.<br><br>";
			$order_html_usr .= "We look forward to your repeat orders, enjoy and happy eating experience.<br><br>";
			$order_html_usr .= "<strong>Prices are current as of ".date("m/d/Y").", and may be changed without notice.</strong><br><br>";
			$order_html_usr .= "<strong>Third-party marks and logos are registered trademarks of their respective owners. All rights reserved.</strong><br><br>";
			$order_html_usr .= "Thanks,<br>".$_SERVER["SERVER_NAME"]."<br><br>";
			$order_html_usr .= "</td>";
			$order_html_usr .= "</tr>";
			$order_html_usr .= "</table>";

			//Step I: send notification to user
			if(isset($user_email) && $user_email != "") {
				$emailObj = new Email($user_email, SITE_ADMIN_EMAIL, "Your online food order has been sent on ".$_SERVER["SERVER_NAME"], $order_html_usr);
				$emailObj->sendEmail();
			}

			//Step II: send notification to manager
			if(isset($manager_email) && $manager_email != "") {
				$emailObj1 = new Email($manager_email, SITE_ADMIN_EMAIL, "You've just received a new online food order ".$_SERVER["SERVER_NAME"], $order_html_mgr);
				$emailObj1->sendEmail();
			}

			//Notification to admin (manager copy)
			$emailObj2 = new Email("admin@unitedrestaurants.com", SITE_ADMIN_EMAIL, "You've just received a new online food order ".$_SERVER["SERVER_NAME"], $order_html_mgr);
			$emailObj2->sendEmail();
			return true;
        }
	}

	//For Restaurant visit : Start Here
	function fun_addRestVisit($rest_id) {
        if($rest_id == "") {
        	return false;
        } else {
			$visiter_ip 	= $_SERVER['REMOTE_ADDR'];
			$visiter_data 	= implode("; ", $_SERVER)."::".implode("; ", $_REQUEST)."::".implode("; ", $_COOKIE);
			$created_on 	= time ();
		
			$field_names 	= array("rest_id", "visiter_ip", "visiter_data", "created_on");
			$field_values 	= array($rest_id, $visiter_ip, fun_db_input($visiter_data), $created_on);
			$this->dbObj->insertFields(TABLE_RESTAURANT_VISIT_RELATIONS, $field_names, $field_values);
			//$id 			= $this->dbObj->getIdentity();
        	return true;
        }
	}
	//For Restaurant visit : End Here

	// Function for get rest ids sort by total visit
	function fun_getRestIdsByVisitSort($dr = ''){
		$sql = "SELECT 	A.rest_id, COUNT(*) AS total_reviews FROM " . TABLE_RESTAURANT_VISIT_RELATIONS . " AS A  GROUP BY A.rest_id ";
		if($dr!=""){
			$sql .= " ORDER BY total_reviews ".$dr;
		} else {
			$sql .= " ORDER BY total_reviews ";		
		}
		//echo $sql;
		
		$rs = $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0) {
			$arr = $this->dbObj->fetchAssoc($rs);
			$idsArray =  array();
			for($i = 0; $i < count($arr); $i++) {
				array_push($idsArray, $arr[$i]['rest_id']);
			}
			return $idsArray;
		} else {
			return false;
		}
	}

	// Function for get rest ids sort by total reviews
	function fun_getRestIdsByReviewsSort($dr = ''){
		$sql = "SELECT 	A.rest_id, COUNT(*) AS total_reviews FROM " . TABLE_RESTAURANT_USER_REVIEW_RELATIONS . " AS A  WHERE A.status='2' GROUP BY A.rest_id ";
		if($dr!=""){
			$sql .= " ORDER BY total_reviews ".$dr;
		} else {
			$sql .= " ORDER BY total_reviews ";		
		}
		//echo $sql;
		
		$rs = $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0) {
			$arr = $this->dbObj->fetchAssoc($rs);
			$idsArray =  array();
			for($i = 0; $i < count($arr); $i++) {
				array_push($idsArray, $arr[$i]['rest_id']);
			}
			return $idsArray;
		} else {
			return false;
		}
	}

	// Function for get rest ids sort by minimum order
	function fun_getRestIdsByMinOrderSort($dr = ''){
		$sql = "SELECT A.rest_id FROM " . TABLE_RESTAURANT_CONFIGURATION . " AS A WHERE A.min_order !='' ";
		if($dr!=""){
			$sql .= " ORDER BY CAST(A.min_order AS DECIMAL(10,2)) ".$dr;
		} else {
			$sql .= " ORDER BY CAST(A.min_order AS DECIMAL(10,2))";		
		}
		//echo $sql;
		
		$rs = $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0) {
			$arr = $this->dbObj->fetchAssoc($rs);
			$idsArray =  array();
			for($i = 0; $i < count($arr); $i++) {
				array_push($idsArray, $arr[$i]['rest_id']);
			}
			return $idsArray;
		} else {
			return false;
		}
	}

	/*
	* Custom function: end here
	*/

	// This function will Return data in array
	function fun_findRestaurantRelationInfo($table, $criteria){		
		$sql = "SELECT * FROM " .$table. " " .$criteria. "";
		//echo($sql);
		$rs = $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			return $arr = $this->dbObj->fetchAssoc($rs);	
		} else {
			return false;
		}
	}

	/**
	* Site functionality 2017: Start Here
	*/
	function fun_getViewRestaurantCustomerReview( $rest_id ) {
		if ( $rest_id == '' ) {
			return false;
		} else {
            $sql 	= "SELECT rest_rating FROM ". TABLE_RESTAURANT_USER_REVIEW_RELATIONS ." WHERE rest_id='".(int)$rest_id."' AND status ='2' AND active ='1' ";
			$rs 	= $this->dbObj->createRecordset( $sql );
			$arr 	= $this->dbObj->fetchAssoc( $rs );
			if ( is_array( $arr ) && count( $arr ) > 0 ) {
				$total_reviews 		= count( $arr );
				$total_reviews_txt 	= ( $total_reviews > 1 ) ? $total_reviews . " ratings" : $total_reviews . " rating" ;
				$total_score 		= 0;
				foreach( $arr as $value ) {
					$total_score += (int)$value['rest_rating'];
				}
				
				if($total_reviews > 0 ) {
					$avg_score = (int)($total_score/$total_reviews);
					$percent_score = round(((($total_score/$total_reviews)/5)*100), 1);
					echo '<span>'.$total_reviews_txt.'</span>';
					echo '<a href="restaurant.php?id='.$rest_id.'"> <img src="'.SITE_IMAGES.'star'.$avg_score.'.png" class="img-responsive" alt="">('.$percent_score.'%)</a>';
				} else {
					echo '<span>Not yet reviewed</span>';
				}
			} else {
				//echo '<span>Not yet reviewed</span>';
			}
		}
	}


	/**
	* Site functionality 2017: End Here
	*/

	/*
	* Mobile site functionality: Start Here
	*/
	function fun_MobCreateRestaurantCustomerReview($rest_id) {
		if($rest_id == ''){
			return false;
		} else {
            $sql 	= "SELECT rest_rating FROM ". TABLE_RESTAURANT_USER_REVIEW_RELATIONS ." WHERE rest_id='".(int)$rest_id."' AND status ='2' AND active ='1' ";
			$rs 	= $this->dbObj->createRecordset($sql);
			$arr 	= $this->dbObj->fetchAssoc($rs);
			$strHTML= '';
			if(is_array($arr) && count($arr) > 0){
				$total_reviews 		= count($arr);
				$total_reviews_txt 	= ($total_reviews > 1)?$total_reviews." reviews":$total_reviews." review";
				$total_score 		= 0;
				foreach($arr as $value) {
					$total_score += (int)$value['rest_rating'];
				}
				$avg_score = (int)($total_score/$total_reviews);
				$percent_score = round(((($total_score/$total_reviews)/5)*100), 1);
				for ($k=0; $k < $avg_score; $k++ ) {
					$strHTML .= '<a href="#" data-role="button" data-icon="star" data-iconpos="notext" data-theme="b" data-inline="true">Star</a>';
				}
				for ($l = $avg_score; $l < 5; $l++ ) {
					$strHTML .= '<a href="#" data-role="button" data-icon="star" data-iconpos="notext" data-theme="a" data-inline="true">Star</a>';
				}
				if($total_reviews > 0 ) {
					//echo "<div class=\"FloatLft\"><span class=\"gray16Arial pad-left3\"> ".$percent_score."% </span><a href=\"holiday-restaurant-preview.php?pid=".$rest_id."#showSectionTop\" class=\"blue-link\">[".$total_reviews_txt."]</a></div>";
				} else {
					//echo "<span class=\"pad-left3 font11\"> Not yet reviewed</span>";
				}
			} else {
				for ($l = 0; $l < 5; $l++ ) {
					$strHTML .= '<a href="#" data-role="button" data-icon="star" data-iconpos="notext" data-theme="a" data-inline="true">Star</a>';
				}
			}
			return $strHTML;
		}
	}

	// Function for creating Numeric Select field for various restaurant attributes
	function fun_MobCreateSelectNumField($name='', $id='', $class='', $selected='', $onchange='', $from='', $to=''){		
		echo '<div data-role="fieldcontain">';
		echo '<select name="'.$name.'" id="'.$id.'" data-mini="'.$class.'" onchange="'.$onchange.'">';
		for($i=$from; $i <= $to; $i++){
			if($i == $selected){
				echo '<option value="'.$i.'" selected>'.$i.'</option>';
			} else {
				echo '<option value="'.$i.'">'.$i.'</option>';
			}
		}
		echo '</select>';
		echo '</div>';
	}

	// Function for creating Pieces Select field for various restaurant attributes
	function fun_MobCreateSelectPiecesField($name='', $id='', $class='', $selected='', $onchange='', $from='', $to=''){		
		echo '<div data-role="fieldcontain">';
		echo '<select name="'.$name.'" id="'.$id.'" data-mini="'.$class.'" onchange="'.$onchange.'">';
		for($i=$from; $i <= $to; $i++){
			if($i == $selected){
				echo '<option value="'.$i.'" selected>'.$i.'</option>';
			} else {
				echo '<option value="'.$i.'">'.$i.'</option>';
			}
		}
		echo '</select>';
		echo '</div>';
	}

	// Function for creating Pieces Select field for various restaurant attributes
	function fun_MobCreateSelectSMLField($name='', $id='', $class='', $selected='', $onchange=''){		
		echo '<div data-role="fieldcontain">';
		echo '<select name="'.$name.'" id="'.$id.'" data-mini="'.$class.'" onchange="'.$onchange.'">';
		echo "<option value='1' ".(($selected == "1")?'selected':'').">Small</option>";
		echo "<option value='2' ".(($selected == "2")?'selected':'').">Medium</option>";
		echo "<option value='3' ".(($selected == "3")?'selected':'').">Large</option>";
		echo '</select>';
		echo '</div>';
	}

	// Function for creating Pieces Select field for various restaurant attributes
	function fun_MobCreateSelectSDField($name='', $id='', $class='', $selected='', $onchange=''){		
		echo '<div data-role="fieldcontain">';
		echo '<select name="'.$name.'" id="'.$id.'" data-mini="'.$class.'" onchange="'.$onchange.'">';
		echo "<option value='1' ".(($selected == "1")?'selected':'').">Single</option>";
		echo "<option value='2' ".(($selected == "2")?'selected':'').">Double</option>";
		echo '</select>';
		echo '</div>';
	}

	// Function for creating Yes / No Select field for various restaurant attributes
	function fun_MobCreateSelectYesNoField($name='', $id='', $class='', $selected='', $onchange=''){		
		echo '<div data-role="fieldcontain">';
		echo '<select name="'.$name.'" id="'.$id.'" data-mini="'.$class.'" onchange="'.$onchange.'">';
		if($selected == "1"){
			echo "<option value='1' selected>Yes</option>";
			echo "<option value='0'>No</option>";
		} else {
			echo "<option value='1'>Yes</option>";
			echo "<option value='0' selected>No</option>";
		}
		echo '</select>';
		echo '</div>';
	}

	//Function to create option section for menu in order page
	function fun_MobCreateMenuOptionView($menu_id) {
		if($menu_id == ''){
			return false;
		} else {
			$strHTML = '';
			$arrAddedOptions 		= array(); // create array of added options
			$arrAddedOptionValues 	= array(); // create array of added option values
			$sql 	= "SELECT * FROM " . TABLE_MENU_OPTION_RELATION . " WHERE menu_id='".$menu_id."'";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr = $this->dbObj->fetchAssoc($rs);
				for($i=0; $i < count($arr); $i++) {
					if(isset($arr[$i]['price']) && $arr[$i]['price'] != "") {
						array_push($arrAddedOptions, $arr[$i]['option_id']);
						$arrAddedOptionValues[$arr[$i]['option_id']]= $arr[$i]['price'];
					}
				}
			}

			//Step II: get menu cat id and find option categories 
			$menu_catid 		= $this->dbObj->getField(TABLE_MENU, "menu_id", $menu_id, "category_id");
			$option_ids 		= implode(",", $arrAddedOptions);

			$sqlMenuOptCat 		= "SELECT A.category_id, A.category_name, A.display_type
			FROM " . TABLE_MENU_OPTION_CATEGORY . " AS A  
			WHERE ((A.menu_catids='".$menu_catid."') OR (A.menu_catids like '%,".$menu_catid.",%') OR (A.menu_catids like '".$menu_catid.",%') OR (A.menu_catids like '%,".$menu_catid."')) 
			AND A.category_id IN (SELECT category_id  FROM " . TABLE_MENU_OPTION . " WHERE option_id IN (".$option_ids.") GROUP BY category_id)";
			$rsMenuOptCat 		= $this->dbObj->createRecordset($sqlMenuOptCat);
			if($this->dbObj->getRecordCount($rsMenuOptCat) > 0) {
				$arrMenuOptCat 	= $this->dbObj->fetchAssoc($rsMenuOptCat);
				for($counter = 0; $counter < count($arrMenuOptCat); $counter++) {
					$category_id 	= $arrMenuOptCat[$counter]['category_id'];
					$category_name 	= $arrMenuOptCat[$counter]['category_name'];
					$display_type 	= $arrMenuOptCat[$counter]['display_type'];
				
					//Step II: create html code for menu options
					$strHTML .= '<tr>';
					$strHTML .= '<td>'.ucwords($category_name).'</td>';
					$strHTML .= '<td align="left">';
					switch($display_type) {
						case '0': //radio option
							$strHTML .= '<fieldset data-role="controlgroup" data-mini="true" class="cart-content">';
							$sql 		= "SELECT A.option_id, A.option_name  FROM " . TABLE_MENU_OPTION . " AS A WHERE A.category_id='".$category_id."' AND A.option_id IN (".$option_ids.") ";
							$rs 		= $this->dbObj->createRecordset($sql);
							if($this->dbObj->getRecordCount($rs) > 0){
								$arr 	= $this->dbObj->fetchAssoc($rs);
								for($j=0; $j < count($arr); $j++) {
									$strHTML .= '<input type="radio" name="radio_options['.$category_id.']" id="radio_options_id'.$arr[$j]['option_id'].'" value="'.$arr[$j]['option_id'].'" title="'.ucwords($arr[$j]['option_name']).'">';
									$strHTML .= '<label for="radio_options_id'.$arr[$j]['option_id'].'">'.ucwords($arr[$j]['option_name']).'</label>';
				
								}
							}
							$strHTML .= '</fieldset>';
						break;
						case '1': //drop down list
							$strHTML .= '<div data-role="controlgroup" data-mini="true">';
							$sql 		= "SELECT A.option_id, A.option_name  FROM " . TABLE_MENU_OPTION . " AS A WHERE A.category_id='".$category_id."' AND A.option_id IN (".$option_ids.") ";
							$rs 		= $this->dbObj->createRecordset($sql);
							if($this->dbObj->getRecordCount($rs) > 0){
								$arr 	= $this->dbObj->fetchAssoc($rs);
								$strHTML .= '<select name="select_options['.$category_id.']" id="select_options_id'.$arr[$j]['option_id'].'">';
								for($j=0; $j < count($arr); $j++) {
									$strHTML .= '<option value="'.$arr[$j]['option_id'].'">'.ucwords($arr[$j]['option_name']).'</li>';
								}
								$strHTML .= '</select>';
							}
							$strHTML .= '</div>';
						break;
						case '2': //checkbox
							$strHTML .= '<fieldset data-role="controlgroup" data-mini="true">';
							$sql 		= "SELECT A.option_id, A.option_name  FROM " . TABLE_MENU_OPTION . " AS A WHERE A.category_id='".$category_id."' AND A.option_id IN (".$option_ids.") ";
							$rs 		= $this->dbObj->createRecordset($sql);
							if($this->dbObj->getRecordCount($rs) > 0){
								$arr 	= $this->dbObj->fetchAssoc($rs);
								for($j=0; $j < count($arr); $j++) {
									if(isset($arrAddedOptionValues[$arr[$j]['option_id']]) && $arrAddedOptionValues[$arr[$j]['option_id']] !="") {
										$title = '$'.$arrAddedOptionValues[$arr[$j]['option_id']].' extra';
									} else {
										$title = '';
									}
									$strHTML .= '<input type="checkbox" name="options['.$arr[$j]['option_id'].']" id="options_id'.$arr[$j]['option_id'].'" value="'.$arr[$j]['option_id'].'" title="'.$title.'">';
									$strHTML .= '<label for="options_id'.$arr[$j]['option_id'].'">'.ucwords($arr[$j]['option_name']).'</label>';
								}
							}
							$strHTML .= '</fieldset>';
						break;
						default: //checkbox
							$strHTML .= '<fieldset data-role="controlgroup" data-mini="true">';
							$sql 		= "SELECT A.option_id, A.option_name  FROM " . TABLE_MENU_OPTION . " AS A WHERE A.category_id='".$category_id."' AND A.option_id IN (".$option_ids.") ";
							$rs 		= $this->dbObj->createRecordset($sql);
							if($this->dbObj->getRecordCount($rs) > 0){
								$arr 	= $this->dbObj->fetchAssoc($rs);
								for($j=0; $j < count($arr); $j++) {
									if(isset($arrAddedOptionValues[$arr[$j]['option_id']]) && $arrAddedOptionValues[$arr[$j]['option_id']] !="") {
										$title = '$'.$arrAddedOptionValues[$arr[$j]['option_id']].' extra';
									} else {
										$title = '';
									}
									$strHTML .= '<input type="checkbox" name="options['.$arr[$j]['option_id'].']" id="options_id'.$arr[$j]['option_id'].'" value="'.$arr[$j]['option_id'].'" title="'.$title.'">';
									$strHTML .= '<label for="options_id'.$arr[$j]['option_id'].'">'.ucwords($arr[$j]['option_name']).'</label>';
								}
							}
							$strHTML .= '</fieldset>';
					}
					$strHTML .= '</td>';
					$strHTML .= '</tr>';
				}
			}
			return $strHTML;
		}
	}

	function fun_MobUpdateUserCartFromSesCart($user_id){
		if($user_id == "") {
			return false;
		} else {
			$cur_unixtime 		= time ();
			$max 				= count($_SESSION['cart']);
			for($i=0; $i<$max; $i++){
				$rest_id 		= $_SESSION['cart'][$i]['rest_id'];
				$menu_id 		= $_SESSION['cart'][$i]['menu_id'];
				$menu_price_id	= $_SESSION['cart'][$i]['menu_price_id'];
				$quantity 		= $_SESSION['cart'][$i]['quantity'];
				$order_comment 	= $_SESSION['cart'][$i]['order_comment'];
				$options 		= $_SESSION['cart'][$i]['options'];
				$radio_options 	= $_SESSION['cart'][$i]['radio_options'];
				$select_options = $_SESSION['cart'][$i]['select_options'];

				if(!isset($menu_price_id) || $menu_price_id =="") {
					$menu_price 		= $this->dbObj->getField(TABLE_MENU, "menu_id", $menu_id, "base_price");
				} else {
					$menu_price 		= $this->dbObj->getField(TABLE_MENU_PRICE_RELATION, array("menu_id", "price_id"), array($menu_id, $menu_price_id), "price");
				}
				if($quantity > 1) {
					$final_price 	= ($quantity*$menu_price);
				} else {
					$final_price 	= $menu_price;
				}
	
				//Step I: add item in ires_user_basket
				$strInsQuery 	= "INSERT INTO " . TABLE_USER_CART . "(user_basket_id, user_id, product_id, rest_id, user_basket_quantity, final_price, comment, user_basket_date_added, user_basket_date_expire, payment_status) ";
				$strInsQuery 	.= "VALUES(null, '".$user_id."', '".$menu_id."', '".$rest_id."', '".$quantity."', '".$menu_price."', '".$order_comment."', '".$cur_unixtime."',  '',  '1')";
				$this->dbObj->mySqlSafeQuery($strInsQuery);
				$user_basket_id = $this->dbObj->getIdentity();

				//Step II: add item in ires_user_basket_attributes
				if(is_array($options) && !empty($options)) { // for checkboxes
					foreach($options as $key => $value) {
						$option_id 		= $key;
						$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
						if(isset($addon_price) && $addon_price !="") {
							if($quantity > 1) {
								$final_price = ($final_price+($quantity*$addon_price));
							} else {
								$final_price = ($final_price+$addon_price);
							}
						}
	
						$strInsQuery 	= "INSERT INTO " . TABLE_USER_CART_ATTRIBUTES . "(user_basket_attributes_id, user_basket_id, product_option_id, product_option_value) ";
						$strInsQuery 	.= "VALUES(null, '".$user_basket_id."', '".$option_id."', '".$addon_price."')";
						$this->dbObj->mySqlSafeQuery($strInsQuery);
					}
				}
				if(is_array($select_options) && !empty($select_options)) { // for select
					foreach($select_options as $key => $value) {
						$option_id 		= $value;
						$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
						if(isset($addon_price) && $addon_price !="") {
							if($quantity > 1) {
								$final_price = ($final_price+($quantity*$addon_price));
							} else {
								$final_price = ($final_price+$addon_price);
							}
						}
	
						$strInsQuery 	= "INSERT INTO " . TABLE_USER_CART_ATTRIBUTES . "(user_basket_attributes_id, user_basket_id, product_option_id, product_option_value) ";
						$strInsQuery 	.= "VALUES(null, '".$user_basket_id."', '".$option_id."', '".$addon_price."')";
						$this->dbObj->mySqlSafeQuery($strInsQuery);
					}
				}
				if(is_array($radio_options) && !empty($radio_options)) { // for select
					foreach($radio_options as $key => $value) {
						$option_id 		= $value;
						$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
						if(isset($addon_price) && $addon_price !="") {
							if($quantity > 1) {
								$final_price = ($final_price+($quantity*$addon_price));
							} else {
								$final_price = ($final_price+$addon_price);
							}
						}
	
						$strInsQuery 	= "INSERT INTO " . TABLE_USER_CART_ATTRIBUTES . "(user_basket_attributes_id, user_basket_id, product_option_id, product_option_value) ";
						$strInsQuery 	.= "VALUES(null, '".$user_basket_id."', '".$option_id."', '".$addon_price."')";
						$this->dbObj->mySqlSafeQuery($strInsQuery);
					}
				}
				/*
				$tax 			= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "tax");
				if(!is_numeric($tax)) {
					$tax 		= 0;
				}
				$delivery_charge= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $rest_id, "delivery_charge");
				if(!is_numeric($delivery_charge) || ($_COOKIE['cook_dtype'] =="pickup")) {
					$delivery_charge = 0;
				}
				*/
	
				$delivery_charge = 0;
				$tax 		= 0;
				$final_price 	= number_format(($final_price+(($final_price*$tax)/100)+$delivery_charge), 2);
				$this->dbObj->updateField(TABLE_USER_CART, "user_basket_id", $user_basket_id, "final_price", $final_price);
			}
			unset($_SESSION['cart']);
			//return true;
		}
	}

	// Function for creating cart nav
	function fun_MobCreateCartNavView($user_id){
		$strHTML = '';
		if($user_id != ''){ // From database
			$sql 	= "SELECT * FROM " . TABLE_USER_CART . " WHERE user_id='".$user_id."'";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr 		= $this->dbObj->fetchAssoc($rs);
				$sub_total 	= 0;
				$tax 			= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "tax");
				if(!is_numeric($tax)) {
					$tax 		= 0;
				}
				$delivery_charge= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_charge");
				$delivery_type 	= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_type");
				if(!is_numeric($delivery_charge) || ($_COOKIE['cook_dtype'] =="pickup") || !isset($delivery_type) || $delivery_type == "0") {
					$delivery_charge = 0;
				}
				$extra_charge 		= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "extra_charge");
				if(!is_numeric($extra_charge)) {
					$extra_charge 	= 0;
				}

				$min_order 				= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "min_order");

				$currencyRateArr= $this->fun_findCurrencyRate();

				$userCurrencyArr		= $this->fun_getUserCurrencyInfo($user_id);
				$users_currency_id		= $userCurrencyArr['currency_id'];
				$users_currency_code 	= $userCurrencyArr['currency_code'];
				$users_currency_symbol 	= $userCurrencyArr['currency_symbol'];
				$users_currency_rate 	= $userCurrencyArr['currency_rate'];
				$users_currency_name 	= $userCurrencyArr['currency_name'];
			
				// Restaurant currency info
				$currencyArr			= $this->fun_getRestaurantCurrencyInfo($arr[0]['rest_id']);
				$rest_currency_id		= $currencyArr['currency_id'];
				$rest_currency_code 	= $currencyArr['currency_code'];
				$rest_currency_symbol 	= $currencyArr['currency_symbol'];
				$rest_currency_rate 	= $currencyArr['currency_rate'];
				$rest_currency_name 	= $currencyArr['currency_name'];
				$currency_symbol		= ($users_currency_symbol == "")?$rest_currency_symbol:$users_currency_symbol;
				$currency_code			= ($users_currency_code == "")?$rest_currency_code:$users_currency_code;

				$rest_id 	= $arr[0]['rest_id'];
				$rest_name 	= $this->dbObj->getField(TABLE_RESTAURANT, "rest_id", $rest_id, "rest_name");
				for($i=0; $i < count($arr); $i++) {
					$user_basket_id 		= $arr[$i]['user_basket_id'];
					$user_id 				= $arr[$i]['user_id'];
					$product_id 			= $arr[$i]['product_id'];
					$rest_id 				= $arr[$i]['rest_id'];
					$user_basket_quantity 	= $arr[$i]['user_basket_quantity'];
					$final_price 			= $arr[$i]['final_price'];
					$sub_total 				= ($sub_total+$final_price);
					$comment 				= $arr[$i]['comment'];
					$menu_name 				= $this->dbObj->getField(TABLE_MENU, "menu_id", $product_id, "menu_name");
				}
				$strHTML .= '<div data-role="navbar">';
				$strHTML .= '<ul>';
				$strHTML .= '<li><a href="index.php#mycart">My Cart<br>'.$users_currency_symbol.number_format(((($sub_total+(($sub_total*$tax)/100)+$delivery_charge+$extra_charge)/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</a></li>';
				$strHTML .= '<li><a href="index.php#checkout" class="ui-btn-active" data-icon="arrow-r" data-iconpos="right">Checkout<br>Now</a></li>';
				$strHTML .= '</ul>';
				$strHTML .= '</div>';
			}
		} else { // From session
			if(is_array($_SESSION['cart']) && !empty($_SESSION['cart'])){
				//display cart items
				$arr 		= $_SESSION['cart'];
				$sub_total 	= 0;
				$tax 			= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "tax");
				if(!is_numeric($tax)) {
					$tax 		= 0;
				}
				$delivery_charge= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_charge");
				$delivery_type 	= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_type");
				if(!is_numeric($delivery_charge) || ($_COOKIE['cook_dtype'] =="pickup") || !isset($delivery_type) || $delivery_type == "0") {
					$delivery_charge = 0;
				}
				$extra_charge 		= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "extra_charge");
				if(!is_numeric($extra_charge)) {
					$extra_charge 	= 0;
				}

				$min_order= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "min_order");

				$currencyRateArr= $this->fun_findCurrencyRate();

				$userCurrencyArr		= $this->fun_getUserCurrencyInfo();
				$users_currency_id		= $userCurrencyArr['currency_id'];
				$users_currency_code 	= $userCurrencyArr['currency_code'];
				$users_currency_symbol 	= $userCurrencyArr['currency_symbol'];
				$users_currency_rate 	= $userCurrencyArr['currency_rate'];
				$users_currency_name 	= $userCurrencyArr['currency_name'];
			
				// Restaurant currency info
				$currencyArr			= $this->fun_getRestaurantCurrencyInfo($arr[0]['rest_id']);
				$rest_currency_id		= $currencyArr['currency_id'];
				$rest_currency_code 	= $currencyArr['currency_code'];
				$rest_currency_symbol 	= $currencyArr['currency_symbol'];
				$rest_currency_rate 	= $currencyArr['currency_rate'];
				$rest_currency_name 	= $currencyArr['currency_name'];
				$currency_symbol		= ($users_currency_symbol == "")?$rest_currency_symbol:$users_currency_symbol;
				$currency_code			= ($users_currency_code == "")?$rest_currency_code:$users_currency_code;
				//print_r($userCurrencyArr);

				$rest_id 	= $arr[0]['rest_id'];
				$rest_name 	= $this->dbObj->getField(TABLE_RESTAURANT, "rest_id", $rest_id, "rest_name");

				for($i=0; $i < count($arr); $i++) {
					$item_id 				= $arr[$i]['item_id'];
					$rest_id 				= $arr[$i]['rest_id'];
					$menu_id 				= $arr[$i]['menu_id'];
					$menu_price_id 			= $arr[$i]['menu_price_id'];
					$quantity 				= $arr[$i]['quantity'];
					$order_comment 			= $arr[$i]['order_comment'];
					$options 				= $arr[$i]['options'];
					$radio_options 			= $arr[$i]['radio_options'];
					$select_options 		= $arr[$i]['select_options'];

					if(!isset($menu_price_id) || $menu_price_id =="") {
						$menu_price 		= $this->dbObj->getField(TABLE_MENU, "menu_id", $menu_id, "base_price");
					} else {
						$menu_price 		= $this->dbObj->getField(TABLE_MENU_PRICE_RELATION, array("menu_id", "price_id"), array($menu_id, $menu_price_id), "price");
					}
					if($quantity > 1) {
						$final_price 	= ($quantity*$menu_price);
					} else {
						$final_price 	= $menu_price;
					}

					if(is_array($options) && !empty($options)) { // for checkboxes
						foreach($options as $key => $value) {
							$option_id 		= $key;
							$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
							if(isset($addon_price) && $addon_price !="") {
								if($quantity > 1) {
									$final_price = ($final_price+($quantity*$addon_price));
								} else {
									$final_price = ($final_price+$addon_price);
								}
							}
						}
					}
		
					if(is_array($select_options) && !empty($select_options)) { // for select
						foreach($select_options as $key => $value) {
							$option_id 		= $value;
							$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
							if(isset($addon_price) && $addon_price !="") {
								if($quantity > 1) {
									$final_price = ($final_price+($quantity*$addon_price));
								} else {
									$final_price = ($final_price+$addon_price);
								}
							}
						}
					}
		
					if(is_array($radio_options) && !empty($radio_options)) { // for radio
						foreach($radio_options as $key => $value) {
							$option_id 		= $value;
							$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
							if(isset($addon_price) && $addon_price !="") {
								if($quantity > 1) {
									$final_price = ($final_price+($quantity*$addon_price));
								} else {
									$final_price = ($final_price+$addon_price);
								}
							}
						}
					}
					$sub_total 	= ($sub_total+$final_price);
					$menu_name 	= $this->dbObj->getField(TABLE_MENU, "menu_id", $menu_id, "menu_name");
				}
				$strHTML .= '<div data-role="navbar">';
				$strHTML .= '<ul>';
				$strHTML .= '<li><a href="index.php#login">My Cart<br>'.$users_currency_symbol.number_format(((($sub_total+(($sub_total*$tax)/100)+$delivery_charge+$extra_charge)/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</a></li>';
				$strHTML .= '<li><a href="index.php#login" class="ui-btn-active" data-icon="arrow-r" data-iconpos="right">Checkout<br>Now</a></li>';
				$strHTML .= '</ul>';
				$strHTML .= '</div>';
			}
		}
		return $strHTML;
	}

	//Function to create cart view for menu page
	function fun_MobCreateCartView($user_id = '') {
		$strHTML = '';
		if($user_id != ''){ // From database
			$sql 	= "SELECT * FROM " . TABLE_USER_CART . " WHERE user_id='".$user_id."'";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr 		= $this->dbObj->fetchAssoc($rs);
				$sub_total 	= 0;
				$tax 			= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "tax");
				if(!is_numeric($tax)) {
					$tax 		= 0;
				}
				$delivery_charge= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_charge");
				if(!is_numeric($delivery_charge) || ($_COOKIE['cook_dtype'] =="pickup")) {
					$delivery_charge = 0;
				}
				$extra_charge 		= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "extra_charge");
				if(!is_numeric($extra_charge)) {
					$extra_charge 	= 0;
				}
				
				$delivery_type 			= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_type");
				$min_order 				= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "min_order");

				$currencyRateArr= $this->fun_findCurrencyRate();

				$userCurrencyArr		= $this->fun_getUserCurrencyInfo($user_id);
				$users_currency_id		= $userCurrencyArr['currency_id'];
				$users_currency_code 	= $userCurrencyArr['currency_code'];
				$users_currency_symbol 	= $userCurrencyArr['currency_symbol'];
				$users_currency_rate 	= $userCurrencyArr['currency_rate'];
				$users_currency_name 	= $userCurrencyArr['currency_name'];
			
				// Restaurant currency info
				$currencyArr			= $this->fun_getRestaurantCurrencyInfo($arr[0]['rest_id']);
				$rest_currency_id		= $currencyArr['currency_id'];
				$rest_currency_code 	= $currencyArr['currency_code'];
				$rest_currency_symbol 	= $currencyArr['currency_symbol'];
				$rest_currency_rate 	= $currencyArr['currency_rate'];
				$rest_currency_name 	= $currencyArr['currency_name'];
				$currency_symbol		= ($users_currency_symbol == "")?$rest_currency_symbol:$users_currency_symbol;
				$currency_code			= ($users_currency_code == "")?$rest_currency_code:$users_currency_code;

				$rest_id 	= $arr[0]['rest_id'];
				$rest_name 	= $this->dbObj->getField(TABLE_RESTAURANT, "rest_id", $rest_id, "rest_name");
				//display cart items
				$strHTML .= '<p><a href="restaurant.php?rest_id='.$rest_id.'" data-role="button" data-mini="true" data-inline="true" data-icon="back" data-theme="e">Back to Menu</a></p>';
				$strHTML .= '<p class="jqm-intro"><strong>'.$rest_name.'</strong></p>';
				$strHTML .= '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cart-content">';
				//$strHTML .= '<table data-role="table" id="table-column-toggle" data-mode="columntoggle" class="ui-responsive table-stroke">';
				$strHTML .= '<thead>';
				$strHTML .= '<tr>';
				$strHTML .= '<th align="left">Item</th>';
				$strHTML .= '<th align="center">Qty</th>';
				$strHTML .= '<th align="right">Price</th>';
				$strHTML .= '<th align="right">Del</th>';
				$strHTML .= '</tr>';
				$strHTML .= '</thead>';
				$strHTML .= '<tbody>';
				$strHTML .= '<tr>';
				$strHTML .= '<td colspan="4"><hr><br></td>';
				$strHTML .= '</tr>';
				for($i=0; $i < count($arr); $i++) {
					$user_basket_id 		= $arr[$i]['user_basket_id'];
					$user_id 				= $arr[$i]['user_id'];
					$product_id 			= $arr[$i]['product_id'];
					$rest_id 				= $arr[$i]['rest_id'];
					$user_basket_quantity 	= $arr[$i]['user_basket_quantity'];
					$final_price 			= $arr[$i]['final_price'];
					$sub_total 				= ($sub_total+$final_price);
					$comment 				= $arr[$i]['comment'];
					$menu_name 				= $this->dbObj->getField(TABLE_MENU, "menu_id", $product_id, "menu_name");

					$strHTML .= '<tr>';
					$strHTML .= '<td align="left"><strong>'.ucwords($menu_name).'</strong></td>';
					$strHTML .= '<td align="center">'.$user_basket_quantity.'</td>';
					$strHTML .= '<td align="right">'.number_format((($final_price/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</td>';
					$strHTML .= '<td align="right"><a href="javascript:return del_item('.$user_basket_id.');void(0);" data-role="button" data-icon="delete" data-iconpos="notext" data-theme="c" data-inline="true">Delete</a></td>';
					$strHTML .= '</tr>';
					$strHTML .= '<tr>';
					$strHTML .= '<td colspan="4" align="left" style="border-bottom: dashed thin #CCCCCC; padding-bottom:5px;">';
					if(isset($comment) && $comment !="") {
						$strHTML .= 'Instructions: '.$comment.'';
					}
					$strHTML .= '</td>';
					$strHTML .= '</tr>';
				}
				$strHTML .= '<tr>';
				$strHTML .= '<td colspan="4">&nbsp;</td>';
				$strHTML .= '</tr>';

				$strHTML .= '<tr>';
				$strHTML .= '<td align="right">Subtotal: </td>';
				$strHTML .= '<td colspan="3" align="right">'.number_format((($sub_total/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</td>';
				$strHTML .= '</tr>';

				if(isset($tax) && $tax > 0) {
					$strHTML .= '<tr>';
					$strHTML .= '<td align="right">Tax: </td>';
					$strHTML .= '<td colspan="3" align="right">'.number_format((((($sub_total/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code])*$tax)/100), 2).'</td>';
					$strHTML .= '</tr>';
				} else {
					$tax = 0;
				}
				if((!isset($_COOKIE['cook_dtype']) || $_COOKIE['cook_dtype'] =="delivery") && isset($delivery_type) && $delivery_type == "1") {
					$strHTML .= '<tr>';
					$strHTML .= '<td align="right">Delivery Fee: </td>';
					$strHTML .= '<td colspan="3" align="right">'.(($delivery_charge == 0)?'0.00':number_format((($delivery_charge/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2)).'</td>';
					$strHTML .= '</tr>';
				} else {
					$delivery_charge = 0;
				}
				if(isset($extra_charge) && $extra_charge > 0) {
					$strHTML .= '<tr>';
					$strHTML .= '<td align="right">Processing Fee: </td>';
					$strHTML .= '<td colspan="3" align="right">'.(($extra_charge == 0)?'0.00':number_format((($extra_charge/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2)).'</td>';
					$strHTML .= '</tr>';
				} else {
					$extra_charge 	= 0;
				}

				$strHTML .= '<tr>';
				$strHTML .= '<td colspan="4"><hr><br></td>';
				$strHTML .= '</tr>';

				$strHTML .= '<tr>';
				$strHTML .= '<td align="right"><strong>Total: </strong></td>';
				$strHTML .= '<td colspan="3" align="right"><strong>'.$users_currency_symbol.number_format(((($sub_total+(($sub_total*$tax)/100)+$delivery_charge+$extra_charge)/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</strong></td>';
				$strHTML .= '</tr>';
				$strHTML .= '</tbody>';
				$strHTML .= '</table>';
			}
		} else { // From session
			if(is_array($_SESSION['cart']) && !empty($_SESSION['cart'])){
				//display cart items
				$arr 		= $_SESSION['cart'];
				$sub_total 	= 0;
				$tax 			= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "tax");
				if(!is_numeric($tax)) {
					$tax 		= 0;
				}
				$delivery_charge= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_charge");
				if(!is_numeric($delivery_charge) || ($_COOKIE['cook_dtype'] =="pickup")) {
					$delivery_charge = 0;
				}
				$extra_charge 		= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "extra_charge");
				if(!is_numeric($extra_charge)) {
					$extra_charge 	= 0;
				}

				$delivery_type 			= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "delivery_type");
				$min_order 				= $this->dbObj->getField(TABLE_RESTAURANT_CONFIGURATION, "rest_id", $arr[0]['rest_id'], "min_order");

				$currencyRateArr= $this->fun_findCurrencyRate();

				$userCurrencyArr		= $this->fun_getUserCurrencyInfo();
				$users_currency_id		= $userCurrencyArr['currency_id'];
				$users_currency_code 	= $userCurrencyArr['currency_code'];
				$users_currency_symbol 	= $userCurrencyArr['currency_symbol'];
				$users_currency_rate 	= $userCurrencyArr['currency_rate'];
				$users_currency_name 	= $userCurrencyArr['currency_name'];
			
				// Restaurant currency info
				$currencyArr			= $this->fun_getRestaurantCurrencyInfo($arr[0]['rest_id']);
				$rest_currency_id		= $currencyArr['currency_id'];
				$rest_currency_code 	= $currencyArr['currency_code'];
				$rest_currency_symbol 	= $currencyArr['currency_symbol'];
				$rest_currency_rate 	= $currencyArr['currency_rate'];
				$rest_currency_name 	= $currencyArr['currency_name'];
				$currency_symbol		= ($users_currency_symbol == "")?$rest_currency_symbol:$users_currency_symbol;
				$currency_code			= ($users_currency_code == "")?$rest_currency_code:$users_currency_code;
				//print_r($userCurrencyArr);

				$rest_id 	= $arr[0]['rest_id'];
				$rest_name 	= $this->dbObj->getField(TABLE_RESTAURANT, "rest_id", $rest_id, "rest_name");
				//display cart items
				$strHTML .= '<p><a href="restaurant.php?rest_id='.$rest_id.'" data-role="button" data-mini="true" data-inline="true" data-icon="back" data-theme="e">Back to Menu</a></p>';
				$strHTML .= '<p class="jqm-intro"><strong>'.$rest_name.'</strong></p>';
				$strHTML .= '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cart-content">';
				//$strHTML .= '<table data-role="table" id="table-column-toggle" data-mode="columntoggle" class="ui-responsive table-stroke">';
				$strHTML .= '<thead>';
				$strHTML .= '<tr>';
				$strHTML .= '<th align="left">Item</th>';
				$strHTML .= '<th align="center">Qty</th>';
				$strHTML .= '<th align="right">Price</th>';
				$strHTML .= '<th align="right">Del</th>';
				$strHTML .= '</tr>';
				$strHTML .= '</thead>';
				$strHTML .= '<tbody>';
				$strHTML .= '<tr>';
				$strHTML .= '<td colspan="4"><hr><br></td>';
				$strHTML .= '</tr>';
				for($i=0; $i < count($arr); $i++) {
					$item_id 				= $arr[$i]['item_id'];
					$rest_id 				= $arr[$i]['rest_id'];
					$menu_id 				= $arr[$i]['menu_id'];
					$menu_price_id 			= $arr[$i]['menu_price_id'];
					$quantity 				= $arr[$i]['quantity'];
					$order_comment 			= $arr[$i]['order_comment'];
					$options 				= $arr[$i]['options'];
					$radio_options 			= $arr[$i]['radio_options'];
					$select_options 		= $arr[$i]['select_options'];

					if(!isset($menu_price_id) || $menu_price_id =="") {
						$menu_price 		= $this->dbObj->getField(TABLE_MENU, "menu_id", $menu_id, "base_price");
					} else {
						$menu_price 		= $this->dbObj->getField(TABLE_MENU_PRICE_RELATION, array("menu_id", "price_id"), array($menu_id, $menu_price_id), "price");
					}
					if($quantity > 1) {
						$final_price 	= ($quantity*$menu_price);
					} else {
						$final_price 	= $menu_price;
					}

					if(is_array($options) && !empty($options)) { // for checkboxes
						foreach($options as $key => $value) {
							$option_id 		= $key;
							$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
							if(isset($addon_price) && $addon_price !="") {
								if($quantity > 1) {
									$final_price = ($final_price+($quantity*$addon_price));
								} else {
									$final_price = ($final_price+$addon_price);
								}
							}
						}
					}
		
					if(is_array($select_options) && !empty($select_options)) { // for select
						foreach($select_options as $key => $value) {
							$option_id 		= $value;
							$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
							if(isset($addon_price) && $addon_price !="") {
								if($quantity > 1) {
									$final_price = ($final_price+($quantity*$addon_price));
								} else {
									$final_price = ($final_price+$addon_price);
								}
							}
						}
					}
		
					if(is_array($radio_options) && !empty($radio_options)) { // for radio
						foreach($radio_options as $key => $value) {
							$option_id 		= $value;
							$addon_price 	= $this->dbObj->getField(TABLE_MENU_OPTION_RELATION, array("menu_id", "option_id"), array($menu_id, $option_id) , "price");
							if(isset($addon_price) && $addon_price !="") {
								if($quantity > 1) {
									$final_price = ($final_price+($quantity*$addon_price));
								} else {
									$final_price = ($final_price+$addon_price);
								}
							}
						}
					}
					$sub_total 				= ($sub_total+$final_price);
					$menu_name 				= $this->dbObj->getField(TABLE_MENU, "menu_id", $menu_id, "menu_name");
					$strHTML .= '<tr>';
					$strHTML .= '<td align="left"><strong>'.ucwords($menu_name).'</strong></td>';
					$strHTML .= '<td align="center">'.$user_basket_quantity.'</td>';
					$strHTML .= '<td align="right">'.number_format((($final_price/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</td>';
					$strHTML .= '<td align="right"><a href="javascript:return del_item('.$user_basket_id.');void(0);" data-role="button" data-icon="delete" data-iconpos="notext" data-theme="c" data-inline="true">Delete</a></td>';
					$strHTML .= '</tr>';
					$strHTML .= '<tr>';
					$strHTML .= '<td colspan="4" align="left" style="border-bottom: dashed thin #CCCCCC; padding-bottom:5px;">';
					if(isset($comment) && $comment !="") {
						$strHTML .= 'Instructions: '.$comment.'';
					}
					$strHTML .= '</td>';
					$strHTML .= '</tr>';
				}
				$strHTML .= '<tr>';
				$strHTML .= '<td colspan="4">&nbsp;</td>';
				$strHTML .= '</tr>';

				$strHTML .= '<tr>';
				$strHTML .= '<td align="right">Subtotal: </td>';
				$strHTML .= '<td colspan="3" align="right">'.number_format((($sub_total/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</td>';
				$strHTML .= '</tr>';

				if(isset($tax) && $tax > 0) {
					$strHTML .= '<tr>';
					$strHTML .= '<td align="right">Tax: </td>';
					$strHTML .= '<td colspan="3" align="right">'.number_format((((($sub_total/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code])*$tax)/100), 2).'</td>';
					$strHTML .= '</tr>';
				} else {
					$tax = 0;
				}
				if((!isset($_COOKIE['cook_dtype']) || $_COOKIE['cook_dtype'] =="delivery") && isset($delivery_type) && $delivery_type == "1") {
					$strHTML .= '<tr>';
					$strHTML .= '<td align="right">Delivery Fee: </td>';
					$strHTML .= '<td colspan="3" align="right">'.(($delivery_charge == 0)?'0.00':number_format((($delivery_charge/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2)).'</td>';
					$strHTML .= '</tr>';
				} else {
					$delivery_charge = 0;
				}
				if(isset($extra_charge) && $extra_charge > 0) {
					$strHTML .= '<tr>';
					$strHTML .= '<td align="right">Processing Fee: </td>';
					$strHTML .= '<td colspan="3" align="right">'.(($extra_charge == 0)?'0.00':number_format((($extra_charge/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2)).'</td>';
					$strHTML .= '</tr>';
				} else {
					$extra_charge 	= 0;
				}

				$strHTML .= '<tr>';
				$strHTML .= '<td colspan="4"><hr><br></td>';
				$strHTML .= '</tr>';

				$strHTML .= '<tr>';
				$strHTML .= '<td align="right"><strong>Total: </strong></td>';
				$strHTML .= '<td colspan="3" align="right"><strong>'.$users_currency_symbol.number_format(((($sub_total+(($sub_total*$tax)/100)+$delivery_charge+$extra_charge)/$currencyRateArr[$rest_currency_code])*$currencyRateArr[$users_currency_code]), 2).'</strong></td>';
				$strHTML .= '</tr>';
				$strHTML .= '</tbody>';
				$strHTML .= '</table>';
			}
		}
		return $strHTML;
	}

	// Function for orders list for mobile
	function fun_MobCreateUserOrderListView($user_id){
        if($user_id == "") {
            return 'Invalid input.';
        } else {
			$sql = "SELECT * FROM " . TABLE_ORDERS . " AS A WHERE A.user_id='".$user_id."' ORDER BY A.order_id DESC";
			$rs 	= $this->dbObj->createRecordset($sql);
			if($this->dbObj->getRecordCount($rs) > 0){
				$arr 		= $this->dbObj->fetchAssoc($rs);
				$strHTML = '';
				$strHTML .= '<p class="jqm-intro">Orders list:</p>';
				$strHTML .= '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="order-content">';
				$strHTML .= '<thead>';
				$strHTML .= '<tr>';
				$strHTML .= '<th align="left">Order ID</th>';
				$strHTML .= '<th align="right">Price</th>';
				$strHTML .= '<th align="center">Status</th>';
				$strHTML .= '</tr>';
				$strHTML .= '</thead>';
				$strHTML .= '<tbody>';
				$strHTML .= '<tr>';
				$strHTML .= '<td colspan="3"><hr></td>';
				$strHTML .= '</tr>';
				for($i=0; $i < count($arr); $i++) {
					$order_id 				= $arr[$i]['order_id'];
					$user_id 				= $arr[$i]['user_id'];
					$delivery_fname 		= $arr[$i]['delivery_fname'];
					$delivery_lname 		= $arr[$i]['delivery_lname'];
					$delivery_address1 		= $arr[$i]['delivery_address1'];
					$delivery_address2 		= $arr[$i]['delivery_address2'];
					$delivery_city 			= $arr[$i]['delivery_city'];
					$delivery_state 		= $arr[$i]['delivery_state'];
					$delivery_country 		= $arr[$i]['delivery_country'];
					$delivery_zip 			= $arr[$i]['delivery_zip'];
					$dtype 					= $arr[$i]['dtype'];
					$schedule 				= $arr[$i]['schedule'];
					$order_comments 		= $arr[$i]['order_comments'];
					$payment_method 		= $arr[$i]['payment_method'];
					$cc_type 				= $arr[$i]['cc_type'];
					$cc_owner 				= $arr[$i]['cc_owner'];
					$cc_number 				= $arr[$i]['cc_number'];
					$cc_expires 			= $arr[$i]['cc_expires'];
					$final_price 			= $arr[$i]['final_price'];
					$currency_id 			= $arr[$i]['currency_id'];
					$last_modified 			= $arr[$i]['last_modified'];
					$date_purchased 		= $arr[$i]['date_purchased'];
					$orders_status 			= $arr[$i]['orders_status'];
					$orders_date_finished 	= $arr[$i]['orders_date_finished'];
					
					$delivery_name 			= ucwords($delivery_fname.' '.$delivery_lname);
					$addressArr 			= array();
					if($delivery_address1 != "") {
						array_push($addressArr, $delivery_address1);
					}
					if($delivery_address2 != "") {
						array_push($addressArr, $delivery_address2);
					}
					if($delivery_city != "") {
						array_push($addressArr, $delivery_city);
					}
					if($delivery_state != "") {
						array_push($addressArr, $delivery_state);
					}
					if($delivery_zip != "") {
						array_push($addressArr, $delivery_zip);
					}
					$address 				= implode(", ", $addressArr);
					$schedule_for 			= $schedule.' ['.ucfirst($dtype).']';
					if(isset($orders_status) && $orders_status != "") {
						switch($orders_status) {
							case '1':
								$status = "Pending";
							break;
							case '2':
								$status = "Pending";
							break;
							case '3':
								$status = "PayPal Preparation";
							break;
							case '4':
								$status = "Complete";
							break;
							case '5':
								$status = "Cancel";
							break;
							default:
								$status = "Pending";
						}
					} else {
						$status = "Pending";
					}
					$currencyArr		= $this->fun_getCurrencyInfo($currency_id);
					$currency_symbol	= $currencyArr['currency_symbol'];
					$currency_code		= $currencyArr['currency_code'];
					
					$strHTML .= '<tr  height="30">';
					$strHTML .= '<td align="left">'.fill_zero_left($order_id, "0", (6-strlen($order_id))).'</td>';
					$strHTML .= '<td align="right">'.$currency_symbol.number_format($final_price, 2).'</td>';
					$strHTML .= '<td align="center">'.$status.'</td>';
					$strHTML .= '</tr>';
				}
				$strHTML .= '<tr>';
				$strHTML .= '<td colspan="3"><hr></td>';
				$strHTML .= '</tr>';
				$strHTML .= '</tbody>';
				$strHTML .= '</table>';
				return $strHTML;
			} else {
				return 'No Orders available!';
			}
		}
	}

	/*
	* Mobile site functionality: Start Here
	*/


	function fun_get_num_rows($sql){
		$totalRows 	= 0;
		$selected 	= "";
		$sql = trim($sql);
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