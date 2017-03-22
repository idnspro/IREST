<?php 
  $PreTax_Order_Amount = array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60','61','62','63','64','65','66','67','68','69','70','71','72','73','74','75','76','77','78','79','80','81','82','83','84','85','86','87','88','89','90','91','92','93','94','95','96','97','98','99','100');
  $customer_gets 	= array('10', '20' ,'30', '40', '50', '60', '70', '80', '90', '100', '110', '120', '130', '140', '150', '160', '170', '180', '190', '200', '210', '220', '230', '240', '250', '260', '270', '280', '290','300', '310', '320', '330', '340', '350', '360', '370', '380', '390', '400', '410', '420', '430', '440', '450', '460', '470', '480', '490', '500', '510', '520', '530', '540', '550', '560', '570', '580', '590','600', '610', '620', '630', '640', '650', '660', '670', '680', '690', '700', '710', '720', '730', '740', '750', '760', '770', '780', '790', '800', '810', '820', '830', '840', '850', '860', '870', '880', '890', '900', '910','920','930','940','950','960', '970', '980', '990', '1000');
?>
<script type="text/javascript" language="javascript">
   function chkblnkTxtError(strFieldId, strErrorFieldId) {
		if(document.getElementById(strFieldId).value != "") {
			document.getElementById(strErrorFieldId).innerHTML = "";
		}
	}
   function returnvalidate(){
		if(document.getElementById("loyality1_id").value == "0") {
			document.getElementById("loyality1_errorid").innerHTML = "A required field is missing for Rule.";
			document.getElementById("loyality1_id").focus();
			return false;
		}
		if(document.getElementById("loyality2_id").value == "0") {
			document.getElementById("loyality1_errorid").innerHTML = "A required field is missing for Rule.";
			document.getElementById("loyality2_id").focus();
			return false;
		}
		if(document.getElementById("loyality3_id").value == "0") {
			document.getElementById("loyality1_errorid").innerHTML = "A required field is missing for Rule.";
			document.getElementById("loyality3_id").focus();
			return false;
		}
		   document.frmLoyality.submit();	
	}
</script>
<form name="frmLoyality" id="frmLoyality" method="post" action="">
 <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5("ADDLOYALITY"); ?>">
  <fieldset>
      <legend>Loyality Points</legend>
       <p><strong>Rules to Earn Loyalty Points</strong></p>
       <strong><span class="error" id="loyality1_errorid"><?php if(array_key_exists('loyality1', $form_array)) echo $form_array['loyality1'];?></span></strong>
         <p>
             <div>
                <input name="" id="" type="checkbox" class="inpuTxt55"/>  For every new order, the customer is credited with PreTax Order Amount x
                 <select name="loyality1" id="loyality1_id" class="select80" onkeydown="chkblnkTxtError('loyality1_id', 'loyality1_errorid');" onkeyup="chkblnkTxtError('loyality1_id', 'loyality1_errorid');">
                    <option value="0">- - -</option>
                        <?
                          foreach($PreTax_Order_Amount as $key => $value)	{
                        ?>
                          <option value="<?php echo $value;?>"><?php echo ($key+1)?></option>
                        <?
                          }
                        ?>
                </select>  Loyalty Points.
                
            </div>
            </p>
            <p>
             <div>
                <input name="" id="" type="checkbox" class="inpuTxt55"/>  For the first order, the customer gets
                 <select name="loyality2" id="loyality2_id" class="select80">
                    <option value="0">- - -</option>
                        <?
                          foreach($customer_gets as $key => $value)	{
                        ?>
                          <option value="<?php echo $key;?>"><?php echo ($value)?></option>
                        <?
                          }
                        ?>
                </select>  Loyalty Points.
             </div>
            </p>
            <p>
             <div>
                <input name="" id="" type="checkbox" class="inpuTxt55"/>  For every Order the customer is credited with
                 <select name="loyality3" id="loyality3_id" class="select80">
                    <option value="0">- - -</option>
                        <?
                          foreach($customer_gets as $key => $value)	{
                        ?>
                          <option value="<?php echo $key;?>"><?php echo ($value)?></option>
                        <?
                          }
                        ?>
                </select>  Loyalty Points.
             </div>
            </p>
         <p><label>&nbsp;</label> <a href="javascript:void(0);" style="text-decoration:none;"><img src="<?php echo SITE_ADMIN_IMAGES;?>save-btn.gif" border="0" onclick="returnvalidate();" /></a></p>
    </fieldset>
</form>
