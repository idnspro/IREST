<?php
class Countries{
	var $dbObj;
	
	function Countries(){ // class constructor
		$this->dbObj = new DB();
		$this->dbObj->fun_db_connect();
	} 
	
	function fun_getCountriesInfo($conID=''){
		$coutriesArray = array();
		$sql = "SELECT * FROM " . TABLE_COUNTRY . " WHERE country_id='".(int)fun_db_input($conID)."'";
		$result = $this->dbObj->fun_db_query($sql);
		if($this->dbObj->fun_db_get_num_rows($result) > 0){
			$rowsArray = $this->dbObj->fun_db_fetch_rs_object($result);
			$coutriesArray['country_id'] = fun_db_output($rowsArray->country_id);
			$coutriesArray['country_name'] = fun_db_output($rowsArray->country_name);
			$coutriesArray['country_iso_code_2'] = fun_db_output($rowsArray->country_iso_code_2);
			$coutriesArray['country_iso_code_3'] = fun_db_output($rowsArray->country_iso_code_3);
		}
		$this->dbObj->fun_db_free_resultset($result);
		return $coutriesArray;
	}
	
	function fun_getCountriesListOptions($conID=''){		
		$selected = "";
		/*if($conID==''){
			$conID = 13;
		}*/
		$sql = trim($sql);
		$sql = "SELECT * FROM " . TABLE_COUNTRY. " ORDER BY country_name";
		$result = $this->dbObj->fun_db_query($sql);
		while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result)){
			if($rowsCon->country_id == $conID  && $conID!=''){
				$selected = "selected";
			}else{
				$selected = "";
			}
			echo "<option value=\"".fun_db_output($rowsCon->country_id)."\" " .$selected. ">";
			echo fun_db_output($rowsCon->country_name);
			echo "</option>\n";
		}
		$this->dbObj->fun_db_free_resultset($result);
	}
	
	function fun_get_num_rows($sql){
		$totalRows = 0;
		$selected = "";
		$sql = trim($sql);
		if($sql==""){
			die("<font color='#ff0000' face='verdana' face='2'>Error: Query is Empty!</font>");
			exit;
		}
		$result = $this->dbObj->fun_db_query($sql);
		$totalRows = $this->dbObj->fun_db_get_num_rows($result);
		$this->dbObj->fun_db_free_resultset($result);
		return $totalRows;
	}
}
?>