<?php
	//form submission
	$form_array = array();
	$errorMsg 	= "no";
	
	// Edit banner : Start here 
	if($_POST['securityKey']==md5("IMPORTREST")){	
		if($errorMsg == 'no' && $errorMsg != 'yes') {
			if(isset($_FILES['import_rest']) && ($_FILES['import_rest']['name'] !="")) {
				$fext 				= basename($_FILES['import_rest']['name']);
				$extn 				= @split("\.",$fext);
				if(isset($extn[1]) && $extn[1] == 'csv') {
					$import_rest 		= "import.".$extn[1];
					$uploadimportdir 	= '../upload/data';
					$uploadimportfile 	= $uploadimportdir ."/". $import_rest;
					@move_uploaded_file($_FILES['import_rest']['tmp_name'], $uploadimportfile);
					if (($handle = fopen($uploadimportfile, "r")) !== FALSE) {
						$i = 0;
						while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
							if($i>0) {
								//print_r($data);
								//echo "<br><br>";
								$rest_name 				= $data[0];
								$rest_title 			= $data[1];
								$rest_description 		= $data[2];
								$rest_address1 			= $data[3];
								$rest_address2 			= $data[4];
								$rest_zip 				= $data[5];
								$rest_latitude 			= $data[6];
								$rest_longitude 		= $data[7];
								$phone 					= $data[8];
								$fax 					= $data[9];
								$rest_city 				= $data[10];
								$rest_state 			= $data[11];
								$payment_cash 			= $data[12];
								$payment_cc 			= $data[13];
								$payment_oo 			= $data[14];
								$paypal_id 				= $data[15];
								$min_order 				= $data[16];
								$delivery_charge 		= $data[17];
								$delivery_hrs_mon 		= $data[18];
								$delivery_hrs_tue 		= $data[19];
								$delivery_hrs_wed 		= $data[20];
								$delivery_hrs_thu 		= $data[21];
								$delivery_hrs_fri 		= $data[22];
								$delivery_hrs_sat 		= $data[23];
								$delivery_hrs_sun 		= $data[24];
								$delivery_area_note 	= $data[25];
								$serving_note 			= $data[26];

								if(isset($rest_state) && $rest_state != "") {
									$rest_state_id 			= $dbObj->getField(TABLE_STATE, "LOWER(state_name)", strtolower($rest_state), "state_id");
									$rest_country_id 		= $locationObj->fun_getStateCountryIdById($rest_state_id);
								}
								if(isset($rest_city) && $rest_city != "") {
									$rest_city_id 			= $dbObj->getField(TABLE_CITY, "LOWER(city_name)", strtolower($rest_city), "city_id");
								}
								if (isset($rest_name) && $rest_name !="") {
									$rest_id 				= $restObj->fun_addRestaurant($rest_name, $rest_country_id, $rest_state_id, $rest_city_id, $rest_address1, $rest_address2, $rest_zip);
									// update friendly_link
									$restObj->fun_generateFriendlyLink($rest_id, $rest_name);
									$cur_unixtime 	= time ();
									$cur_user_id 	= $_SESSION['ses_admin_id'];

									$field_names  	= array("rest_latitude", "rest_longitude", "updated_on", "updated_by");
									$field_values 	= array($rest_latitude, $rest_longitude, $cur_unixtime, $cur_user_id);
									$dbObj->updateFields(TABLE_RESTAURANT, "rest_id", $rest_id, $field_names, $field_values);

									//for restaurant configuration
									$field_names  	= array("rest_id", "payment_cash", "payment_cc", "payment_oo", "paypal_id", "phone", "fax", "tax", "min_order", "delivery_charge", "delivery_hrs_mon", "delivery_hrs_tue", "delivery_hrs_wed", "delivery_hrs_thu", "delivery_hrs_fri", "delivery_hrs_sat", "delivery_hrs_sun", "delivery_area_note", "serving_note", "created_on", "created_by", "updated_on", "updated_by");
									$field_values 	= array($rest_id, $payment_cash, $payment_cc, $payment_oo, fun_db_input($paypal_id), fun_db_input($phone), fun_db_input($fax), fun_db_input($tax), fun_db_input($min_order), fun_db_input($delivery_charge), fun_db_input($delivery_hrs_mon), fun_db_input($delivery_hrs_tue), fun_db_input($delivery_hrs_wed), fun_db_input($delivery_hrs_thu), fun_db_input($delivery_hrs_fri), fun_db_input($delivery_hrs_sat), fun_db_input($delivery_hrs_sun), fun_db_input($delivery_area_note), fun_db_input($serving_note), $cur_unixtime, $cur_user_id, $cur_unixtime, $cur_user_id);
									$dbObj->insertFields(TABLE_RESTAURANT_CONFIGURATION, $field_names, $field_values);
								}
							}
							$i++;
						}
					}
					fclose($handle);
					echo '<p align="center" class="red font14">'.$i.' New restaurant(s) recorded!</p><br><br>';
				} else {
					$form_array['error_msg'] = "Error: Please submit your form again!";
				}
			} else {
				$form_array['error_msg'] = "Error: Please submit your form again!";
			}
		} else {
			$form_array['error_msg'] = "Error: Please submit your form again!";
		}	
	}
	// Edit banner submit : End here 
?>
<script type="text/javascript" language="javascript">
	function validatefrm(){
		document.frmImport.submit();
	}
</script>
<form name="frmImport" id="frmImport" method="post" action="admin-settings.php?sec=import" enctype="multipart/form-data">
    <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("IMPORTREST"); ?>">
    <fieldset>
    <legend><?php echo $addtitle; ?></legend>
        <div class="floatRight pad-top5 pad-btm5" align="right">
            <!--
            <a href="admin-settings.php?sec=banner" class="button-blue" style="text-decoration:none;">Back to List</a>&nbsp;
            -->
        </div>
        <p>
            <label for="banner_pid">Import File</label>
            <input type="file" name="import_rest" id="import_rest_id" style="width:200px; height:30px;">
        </p>
        <p style="clear:both; height:10px;">&nbsp;</p>
        <p>
            <label>&nbsp;</label>
            <a href="javascript:void(0);" onclick="return validatefrm();" class="button-red">Import Now</a>
        </p>
    </fieldset>
</form>
