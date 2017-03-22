<script language="javascript" type="text/javascript">
		var req = new XMLHttpRequest();
	
		function chkSelectCountry1() {
			var getID=document.getElementById("txtRestCountryId1").value;
			if(getID !="" && getID != "0"){
				sendAreaRequest1(getID);
				document.getElementById("txtRestAreaId1").value = "0";
			}
			if(getID == "0" || getID =="") {
				document.getElementById("txtRestCountryId1").value = "0";
				document.getElementById("txtRestAreaId1").value = "0";
			}
		}

		function chkSelectArea1() {
			var getID=document.getElementById("txtRestAreaId1").value;
			if(getID !="" && getID != "0"){
				sendRegionRequest1(getID);
				document.getElementById("txtRestRegionId1").value = "0";
			}
			if(getID == "0" || getID =="") {
				document.getElementById("txtRestAreaId1").value = "0";
				document.getElementById("txtRestRegionId1").value = "0";
			}
		}
		


		function chkSelectArea1() {
//			var getID=document.getElementById("txtRestRegionId1").value;
//			
//			if(getID !="" && getID != "0"){
//				sendSubRegionRequest(getID);
//				document.getElementById("txtRestSubRegionId").value = "0";
//				document.getElementById("txtRestLocationId").value = "0";
//			}
//			if(getID == "0" || getID =="") {
//				document.getElementById("txtRestRegionId1").value = "0";
//				document.getElementById("txtRestSubRegionId").value = "0";
//				document.getElementById("txtRestLocationId").value = "0";
//				document.getElementById("txtRestSubRegionId").style.display = "none";
//				document.getElementById("txtRestLocationId").style.display = "none";
//			}
		}
		




		function chkSelectSubRegion() {
			var getID=document.getElementById("txtPropertySubRegionId").value;
			if(getID !="" && getID != "0"){
				sendLocationRequest(getID);
				document.getElementById("txtPropertyLocationId").value = "0";
			}
			if(getID == "0" || getID =="") {
				document.getElementById("txtPropertySubRegionId").value = "0";
				document.getElementById("txtPropertyLocationId").value = "0";
				document.getElementById("txtPropertyLocationId").style.display = "none";
			}
		}
	
		function sendAreaRequest1(id) { 
			req.open('get', '<?php echo SITE_URL;?>selectAreaXml.php?id=' + id); 
			req.onreadystatechange = handleAreaResponse1; 
			req.send(null); 
		} 
		
		function sendRegionRequest1(id) { 
			req.open('get', '<?php echo SITE_URL;?>selectRegionXml.php?id=' + id); 
			req.onreadystatechange = handleRegionResponse1; 
			req.send(null); 
		} 
		
		
		
		function handleAreaResponse1() { 
			var arrayOfId = new Array();
			var arrayOfNames = new Array();
			if(req.readyState == 4) { 
				var response = req.responseText; 
				xmlDoc=req.responseXML;
				var root = xmlDoc.getElementsByTagName('ntowns')[0];
				if(root != null) {
					document.getElementById("txtRestAreaId1").style.display = "block";
					var items = root.getElementsByTagName("ntown");
					for (var i = 0 ; i < items.length ; i++) {
						var item = items[i];
						var id = item.getElementsByTagName("id")[0].firstChild.nodeValue;
						arrayOfId[i] = id;
						var name = item.getElementsByTagName("name")[0].firstChild.nodeValue;

						arrayOfNames[i] = name;
					}
					if( arrayOfId.length > 0) {
						var p_city=document.getElementById("txtRestAreaId1");
						p_city.length=0;
						p_city.options[0]=new Option("Please Select...","");
						for(var j=0; j<arrayOfId.length; j++) {
							p_city.options[j+1]=new Option(arrayOfNames[j], arrayOfId[j]);
						}
					}
				}
			} 
		} 
		
		function handleRegionResponse1() { 
			var arrayOfId = new Array();
			var arrayOfNames = new Array();
			if(req.readyState == 4) { 
				var response = req.responseText; 
				xmlDoc=req.responseXML;
				var root = xmlDoc.getElementsByTagName('ntowns')[0];
				//alert(root);
				if(root != null) {
					document.getElementById("txtRestRegionId1").style.display = "block";
					document.getElementById("txtRestSubRegionId").style.display = "none";
					var items = root.getElementsByTagName("ntown");
					for (var i = 0 ; i < items.length ; i++) {
						var item = items[i];
						var id = item.getElementsByTagName("id")[0].firstChild.nodeValue;
						arrayOfId[i] = id;
						var name = item.getElementsByTagName("name")[0].firstChild.nodeValue;
						arrayOfNames[i] = name;
					}
					if( arrayOfId.length > 0) {
	
						var p_city=document.getElementById("txtRestRegionId1");
	
						p_city.length=0;
						p_city.options[0]=new Option("Please Select...","");
						for(var j=0; j<arrayOfId.length; j++) {
							p_city.options[j+1]=new Option(arrayOfNames[j],arrayOfId[j]);
						}
	//					sendSubRegionRequest(1);
					} else {
						document.getElementById("txtRestRegionId1").style.display = "none";
		//				sendLocationRequest(document.getElementById("txtRegionId").value);
					}
				} else {
					document.getElementById("txtRestRegionId1").style.display = "none";
					//document.getElementById("txtRestSubRegionId").style.display = "none";
				}
			} 
		} 
		
		
		/*
		* For location : End here
		*/
</script>
<form name="frmRestProfile" method="post" action="admin-restaurant.php">
<input type="hidden" name="securityKey" value="<?php echo md5(NEWADDRESTAURANT);?>" />
<input type="hidden" name="txtUserIP" value="<?php echo $_SERVER['REMOTE_ADDR']?>" />
<table  width="100%" style="padding-top:20px;" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="left" valign="top">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tr>
                    <td width="155" align="right" valign="middle">Restaurant name</td>
                    <td width="235" valign="middle"><span class="RegFormRight"><input name="txtRestName" type="text" class="RegFormFld" id="txtRestNameId" value="<?php if(isset($_POST['txtRestName'])){echo $_POST['txtRestName'];}else{echo $restInfo['rest_name'];}?>"  /></span></td>
                    <td width="274" valign="middle"><span class="pdError1" id="showErrorRestNameId"></span></td>
                </tr>
                <tr>
                    <td width="155" align="right" valign="middle">Address</td>
                    <td width="235" valign="middle">
                    <span class="RegFormRight">
                        <div id="showtxtlocationcombo">
                            <select name="txtRestCountry" id="txtRestCountryId1" onchange="return chkSelectCountry1();" style="display:block; height:28px;">
                                <option  value="">Please Select Country...</option>
                                <?php $locationObj->fun_getCountryOptionsList('', " WHERE country_id in (".$locationObj->fun_getCountryIdHavingArea().") ORDER BY country_name");?>
                            </select>

                            <select name="txtRestArea" id="txtRestAreaId1" onchange="return chkSelectArea1();" style="display:none; height:28px;">
                                <option value="0" selected>Please Select ... </option>
                                <?php $locationObj->fun_getStateOptionsList('', " WHERE area_id in (".$locationObj->fun_getStateHavingCity().") ORDER BY area_name");?>
                            </select>
                            <select name="txtRestRegion" id="txtRestRegionId1" onchange="return ();" style="display:none; height:28px;" >
                                <option value="0" selected>Please Select ...</option>
                                
                            </select>
                        </div>									
                    </span>
                    
                    </td>
                    <td width="274" valign="middle"><span class="pdError1" id="showErrorRestAddId"><?php if(array_key_exists('txtPropertyLocation', $detail_array)) echo $detail_array['txtPropertyLocation'];?></span></td>
                </tr>
                <tr>
                    <td width="155" align="right" valign="middle">Zip Code</td>
                    <td width="235" valign="middle"><span class="RegFormRight"><input name="txtRestZip" type="text" class="RegFormFld" id="txtRestZipId"  /></span></td>
                    <td width="274" valign="middle"><span class="pdError1" id="showErrorRestZipId"></span></td>
                </tr>
                
                <tr>
                    <td align="right" valign="middle">&nbsp;</td>
                </tr>
                <tr>
                    <td align="right" valign="middle">&nbsp;</td>
                    <td colspan="2" align="center"><input type="image" src="images/save-btn.gif" alt=" Add Restaurant" style="width:60px; height:30px;" name="Register" border="0" id="RegisterId" style="" onclick="return validateSaveProfile();"></td>
                </tr>
            </table>
        </td>
      </tr>
      
 </table>
                           
</form>