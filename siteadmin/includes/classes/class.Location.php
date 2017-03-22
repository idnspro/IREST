<?php
class Location{
	var $dbObj;
	
	function Location(){ // class constructor
		$this->dbObj = new DB();
		$this->dbObj->fun_db_connect();
	} 

/*
* All Country functions: Start Here
*/
	// Function for country info	
	function fun_getCountryInfoById($country_id){
		$sql 		= "SELECT * FROM " . TABLE_COUNTRY . " AS A WHERE A.country_id='".$country_id."'";
		$rs 		= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			return $arr[0];
		} else {
			return false;
		}
	}

	// Function for countries array
	function fun_getCountriesArr($parameter=''){
		$sql = "SELECT 	A.country_id, 
						A.country_name,
						A.country_iso_code_3,
						A.country_isd_code,
						A.latitude, 
						A.longitude,
						A.zoom_level
				FROM " . TABLE_COUNTRY . " AS A ";

		if($parameter!=""){
			$sql .= $parameter;
		} else{
			$sql .= " ORDER BY A.country_id";		
		}
		return $rs = $this->dbObj->createRecordset($sql);
	}

	// Function for a country add
	function fun_addCountry($country_name, $country_iso_code_2, $country_iso_code_3, $country_isd_code, $country_desc, $latitude, $longitude, $zoom_level) {
		if($country_name == '' ||  $country_iso_code_3 == '' ||  $country_isd_code == '') {
			return false;
		} else {
			$strInsQuery = "INSERT INTO " . TABLE_COUNTRY . " 
			(country_id, country_name, country_iso_code_2, country_iso_code_3, country_isd_code, country_desc, latitude, longitude, zoom_level) 
			VALUES(null, '".$country_name."', '".$country_iso_code_2."', '".$country_iso_code_3."', '".$country_isd_code."', '".$country_desc."', '".$latitude."', '".$longitude."', '".$zoom_level."')";
			$this->dbObj->fun_db_query($strInsQuery);
			return $this->dbObj->getIdentity();
		}
	}

	// Function for a country edit
	function fun_editCountry($country_id, $country_name, $country_iso_code_2, $country_iso_code_3, $country_isd_code, $country_desc, $latitude, $longitude, $zoom_level) {
		if($country_id == '') {
			return false;
		} else {
            $sqlUpdateQuery = "UPDATE" . TABLE_COUNTRY . " SET 
            country_name = '".$country_name."',
            country_iso_code_2 = '".$country_iso_code_2."',
            country_iso_code_3 = '".$country_iso_code_3."',
            country_isd_code = '".$country_isd_code."',
            country_desc = '".$country_desc."',
            latitude = '".$latitude."',
            longitude = '".$longitude."',
            zoom_level = '".$zoom_level."' WHERE country_id='".$country_id."'";
            $this->dbObj->mySqlSafeQuery($sqlUpdateQuery);
            return true;
		}
	}

	// Function for del country by country id
	function fun_delCountryById($country_id){
		$this->dbObj->deleteRow(TABLE_COUNTRY, "country_id", $country_id);
		return true;
	}

	// Function for country id by state id
	function fun_getStateCountryIdById($state_id){
		return $this->dbObj->getField(TABLE_STATE, "state_id", $state_id, "country_id");
	}

	// Function for country id by state id
	function fun_getCountryIdHavingState() {
		$countryArray 	= array();
		$sql 			= "SELECT country_id FROM " . TABLE_STATE . " GROUP BY country_id";
		$rs 			= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr = $this->dbObj->fetchAssoc($rs);
			foreach ($arr as $value) {
				$strId = $value['country_id'];
				array_push($countryArray, $strId);
			}
			return implode(",", $countryArray);
		} else {
			return false;
		}
	}

	// Function for creating optionlist for countries if country_id is available it must be selected
	function fun_getCountryOptionsList($country_id='', $queryparameters=''){		
		$selected 	= "";
		$sql 		= "SELECT * FROM " . TABLE_COUNTRY. " ";
		if($queryparameters !=""){
			$sql .= " ".$queryparameters." ";
		} else {
			$sql .= " ORDER BY country_name";
		}
		$result = $this->dbObj->fun_db_query($sql);
		while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result)){
			if($rowsCon->country_id == $country_id  && $country_id!=''){
				$selected = "selected";
			} else {
				$selected = "";
			}
			echo "<option value=\"".fun_db_output($rowsCon->country_id)."\" " .$selected. ">";
			echo fun_db_output(ucwords($rowsCon->country_name));
			echo "</option>\n";
		}
		$this->dbObj->fun_db_free_resultset($result);
	}

	// Function for creating optionlist for countries with isd if country_id is available it must be selected
	function fun_getCountriesISDOptionsList($country_id='', $queryparameters=''){		
		$selected 	= "";
		$sql 		= "SELECT * FROM " . TABLE_COUNTRY. " ";
		if($queryparameters !=""){
			$sql .= " ".$queryparameters." ";
		} else {
			$sql .= " ORDER BY country_name";
		}
		$result = $this->dbObj->fun_db_query($sql);
		while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result)){
			if($rowsCon->country_id == $country_id  && $country_id!=''){
				$selected = "selected";
			} else {
				$selected = "";
			}
			echo "<option value=\"".fun_db_output($rowsCon->country_id)."\" " .$selected. ">";
			echo fun_db_output(ucwords($rowsCon->country_name));
			echo " (+".fun_db_output(ucwords($rowsCon->country_isd_code)).")";
			echo "</option>\n";
		}
		$this->dbObj->fun_db_free_resultset($result);
	}

	//Return country name: Start Here
	function fun_getCountryNameById($country_id = '') {
		if($country_id == '') {
			return false;
		} else {
			return $this->dbObj->getField(TABLE_COUNTRY, "country_id", $country_id, "country_name");
		}
	}
	//Return country name: End Here
/*
* All Country functions: End Here
*/

/*
* All State functions: Start Here
*/
	// Function for state info
	function fun_getStateInfoById($state_id){
		$sql 		= "SELECT * FROM " . TABLE_STATE . " AS A WHERE A.state_id='".$state_id."'";
		$rs 		= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			return $arr[0];
		} else {
			return false;
		}
	}

	// Function for state array
	function fun_getStateArr($parameter=''){
		$sql = "SELECT 	A.state_id, 
						A.state_name,
						A.latitude, 
						A.longitude,
						A.zoom_level
				FROM " . TABLE_STATE . " AS A ";

		if($parameter!=""){
			$sql .= $parameter;
		} else{
			$sql .= " ORDER BY A.state_id";		
		}
		return $rs = $this->dbObj->createRecordset($sql);
	}

	// Function for a state add
	function fun_addState($country_id, $state_name, $state_desc, $latitude, $longitude, $zoom_level) {
		if($country_id == '' ||  $state_name == '') {
			return false;
		} else {
			$strInsQuery = "INSERT INTO " . TABLE_STATE . " 
			(state_id, country_id, state_name, state_desc, latitude, longitude, zoom_level) 
			VALUES(null, '".$country_id."', '".fun_db_input($state_name)."', '".fun_db_input($state_desc)."', '".$latitude."', '".$longitude."', '".$zoom_level."')";
			$this->dbObj->fun_db_query($strInsQuery);
			return $this->dbObj->getIdentity();
		}
	}

	// Function for a state edit
	function fun_editState($state_id, $country_id, $state_name, $state_desc, $latitude, $longitude, $zoom_level) {
		if($state_id == '') {
			return false;
		} else {
            $sqlUpdateQuery = "UPDATE " . TABLE_STATE . " SET 
            country_id = '".$country_id."',
            state_name = '".fun_db_input($state_name)."',
            state_desc = '".fun_db_input($state_desc)."',
            latitude = '".$latitude."',
            longitude = '".$longitude."',
            zoom_level = '".$zoom_level."' WHERE state_id='".$state_id."'";
            $this->dbObj->mySqlSafeQuery($sqlUpdateQuery);
            return true;
		}
	}

	// Function for del state by state id
	function fun_delStateById($state_id){
		$this->dbObj->deleteRow(TABLE_STATE, "state_id", $state_id);
		return true;
	}

	// Function for state id by city id
	function fun_getCityStateIdById($city_id){
		return $this->dbObj->getField(TABLE_CITY, "city_id", $city_id, "state_id");
	}

	// Function for state id by city id
	function fun_getStateIdHavingCity() {
		$stateArray 	= array();
		$sql 			= "SELECT state_id FROM " . TABLE_CITY . " GROUP BY city_id";
		$rs 			= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr = $this->dbObj->fetchAssoc($rs);
			foreach ($arr as $value) {
				$strId = $value['state_id'];
				array_push($stateArray, $strId);
			}
			return implode(",", $stateArray);
		} else {
			return false;
		}
	}

	// Function for creating optionlist for countries if state_id is available it must be selected
	function fun_getStatesOptionsList($state_id='', $queryparameters=''){		
		$selected 	= "";
		$sql 		= "SELECT * FROM " . TABLE_STATE. " ";
		if($queryparameters !=""){
			$sql .= " ".$queryparameters." ";
		} else {
			$sql .= " ORDER BY state_name";
		}
		$result = $this->dbObj->fun_db_query($sql);
		while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result)){
			if($rowsCon->state_id == $state_id  && $state_id!=''){
				$selected = "selected";
			} else {
				$selected = "";
			}
			echo "<option value=\"".fun_db_output($rowsCon->state_id)."\" " .$selected. ">";
			echo fun_db_output(ucwords($rowsCon->state_name));
			echo "</option>\n";
		}
		$this->dbObj->fun_db_free_resultset($result);
	}

	// Function for creating state option list, if area id is given it must be selected
	function fun_getStateOptionsListByCountryId($state_id='', $country_id=''){		
		$selected = "";
		$where = array();

		$sql = "SELECT state_id, state_name FROM " . TABLE_STATE . " ";
		if($country_id !=""){
			array_push($where, "country_id='".(int)fun_db_input($country_id)."' ");
		}

		if(sizeof($where) > 0){
			$sql .= " WHERE ".join($where, " AND ");
		}

		$sql .= " ORDER BY state_name";

		$result = $this->dbObj->fun_db_query($sql);
		while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result)){
			if($rowsCon->state_id == $state_id  && $state_id!=''){
				$selected = "selected";
			}else{
				$selected = "";
			}
			echo "<option value=\"".fun_db_output($rowsCon->state_id)."\" " .$selected. ">";
			echo fun_db_output(ucwords($rowsCon->state_name));
			echo "</option>\n";
		}		
		$this->dbObj->fun_db_free_resultset($result);
	}

	//function for get state name: Start Here
	function fun_getStateNameById($state_id = '') {
		if($state_id == '') {
			return false;
		} else {
			return $this->dbObj->getField(TABLE_STATE, "state_id", $state_id, "state_name");
		}
	}
	//function for get state name: End Here
/*
* All State functions: End Here
*/


/*
* All City functions: Start Here
*/
	// Function for city info
	function fun_getCityInfoById($city_id){
		$sql 		= "SELECT * FROM " . TABLE_CITY . " AS A WHERE A.city_id='".$city_id."'";
		$rs 		= $this->dbObj->createRecordset($sql);
		if($this->dbObj->getRecordCount($rs) > 0){
			$arr 	= $this->dbObj->fetchAssoc($rs);
			return $arr[0];
		} else {
			return false;
		}
	}

	// Function for city array
	function fun_getCityArr($parameter=''){
		$sql = "SELECT 	A.city_id, 
						A.city_name,
						A.latitude, 
						A.longitude,
						A.zoom_level,
						A.status
				FROM " . TABLE_CITY . " AS A ";

		if($parameter!=""){
			$sql .= $parameter;
		} else{
			$sql .= " ORDER BY A.city_id";		
		}
		return $rs = $this->dbObj->createRecordset($sql);
	}

	// Function for a city add
	function fun_addCity($state_id, $city_name, $city_desc ='', $latitude ='', $longitude ='', $zoom_level ='', $status ='') {
		if($state_id == '' ||  $city_name == '') {
			return false;
		} else {
			$status = "1";
			$strInsQuery = "INSERT INTO " . TABLE_CITY . " 
			(city_id, state_id, city_name, city_desc, latitude, longitude, zoom_level, status) 
			VALUES(null, '".$state_id."', '".fun_db_input($city_name)."', '".fun_db_input($city_desc)."', '".$latitude."', '".$longitude."', '".$zoom_level."', '".$status."')";
			$this->dbObj->fun_db_query($strInsQuery);
			return $this->dbObj->getIdentity();
		}
	}

	// Function for a city edit
	function fun_editCity($city_id, $state_id, $city_name, $city_desc ='', $latitude ='', $longitude ='', $zoom_level ='', $status ='') {
		if($city_id == '') {
			return false;
		} else {
            $sqlUpdateQuery = "UPDATE " . TABLE_CITY . " SET 
            state_id = '".$state_id."',
            city_name = '".fun_db_input($city_name)."',
            city_desc = '".fun_db_input($city_desc)."',
            latitude = '".$latitude."',
            longitude = '".$longitude."',
            zoom_level = '".$zoom_level."',
            status = '".$status."' WHERE city_id='".$city_id."'";
            $this->dbObj->mySqlSafeQuery($sqlUpdateQuery);
            return true;
		}
	}

	// Function for del city by city id
	function fun_delCityById($city_id){
		$this->dbObj->deleteRow(TABLE_CITY, "city_id", $city_id);
		return true;
	}

	// Function for creating optionlist for countries if city_id is available it must be selected
	function fun_getCitysOptionsList($city_id='', $queryparameters=''){		
		$selected 	= "";
		$sql 		= "SELECT * FROM " . TABLE_CITY. " ";
		if($queryparameters !=""){
			$sql .= " ".$queryparameters." ";
		} else {
			$sql .= " ORDER BY city_name";
		}
		$result = $this->dbObj->fun_db_query($sql);
		while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result)){
			if($rowsCon->city_id == $city_id  && $city_id!=''){
				$selected = "selected";
			} else {
				$selected = "";
			}
			echo "<option value=\"".fun_db_output($rowsCon->city_id)."\" " .$selected. ">";
			echo fun_db_output(ucwords($rowsCon->city_name));
			echo "</option>\n";
		}
		$this->dbObj->fun_db_free_resultset($result);
	}

	// Function for creating city option list, if city id is given it must be selected
	function fun_getCityOptionsListByStateId($city_id='', $state_id=''){		
		$selected = "";
		$where = array();

		$sql = "SELECT city_id, city_name FROM " . TABLE_CITY . " ";
		if($state_id !=""){
			array_push($where, "state_id='".(int)fun_db_input($state_id)."' ");
		}

		if(sizeof($where) > 0){
			$sql .= " WHERE ".join($where, " AND ");
		}

		$sql .= " ORDER BY city_name";

		$result = $this->dbObj->fun_db_query($sql);
		while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result)){
			if($rowsCon->city_id == $city_id  && $city_id!=''){
				$selected = "selected";
			}else{
				$selected = "";
			}
			echo "<option value=\"".fun_db_output($rowsCon->city_id)."\" " .$selected. ">";
			echo fun_db_output(ucwords($rowsCon->city_name));
			echo "</option>\n";
		}		
		$this->dbObj->fun_db_free_resultset($result);
	}

	//function for get city name: Start Here
	function fun_getCityNameById($city_id = '') {
		if($city_id == '') {
			return false;
		} else {
			return $this->dbObj->getField(TABLE_CITY, "city_id", $city_id, "city_name");
		}
	}
	//function for get city name: End Here


/*
* All State functions: End Here
*/

	// Function for Destination info
	function fun_getDestinationInfo($destination_name){
		$destinationArray = array();
		if(($country_relation_array = $this->fun_findLocationRelationInfo(TABLE_COUNTRY , " WHERE REPLACE(LOWER(country_name), \"\'\", \"-\")='".strtolower(str_replace("'", "-", $destination_name))."' OR REPLACE(LOWER(country_name), \"\\\'\", \"-\")='".strtolower(str_replace("'", "-", $destination_name))."' ")) && (is_array($country_relation_array))){
			$destinationArray['country_id']		= $country_relation_array[0]['country_id'];
		} else if(($state_relation_array = $this->fun_findLocationRelationInfo(TABLE_STATE , " WHERE REPLACE(LOWER(state_name), \"\'\", \"-\")='".strtolower(str_replace("'", "-", $destination_name))."' OR REPLACE(LOWER(state_name), \"\\\'\", \"-\")='".strtolower(str_replace("'", "-", $destination_name))."' ")) && (is_array($state_relation_array))){
			$destinationArray['country_id']		= $state_relation_array[0]['country_id'];
			$destinationArray['state_id']		= $state_relation_array[0]['state_id'];
		} else if(($city_relation_array = $this->fun_findLocationRelationInfo(TABLE_CITY , " WHERE REPLACE(LOWER(city_name), \"\'\", \"-\")='".strtolower(str_replace("'", "-", $destination_name))."' OR REPLACE(LOWER(city_name), \"\\\'\", \"-\")='".strtolower(str_replace("'", "-", $destination_name))."' ")) && (is_array($city_relation_array))){
			$destinationArray['country_id']		= $this->dbObj->getField(TABLE_STATE, "state_id", $city_relation_array[0]['state_id'], "country_id");
			$destinationArray['state_id']		= $city_relation_array[0]['state_id'];
			$destinationArray['city_id']		= $city_relation_array[0]['city_id'];
		}
		return $destinationArray;
	}

	// This function will Return data in array
	function fun_findLocationRelationInfo($table, $criteria){		
		$sql = "SELECT * FROM " .$table. " " .$criteria. "";
		$rs = $this->dbObj->createRecordset($sql);
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
		if($sql == ""){
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