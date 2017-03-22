<table style="border:6px solid #CCCCCC;  background-color:#f6f6f6;" border="0" cellpadding="0" cellspacing="0" width="100%">
     <tr>
        <td>         
          <div style="font-size:30px; padding-left:15px;">Guest Checkout</div>
        </td>
    </tr>
    <tr>
      <td valign="top">
       <div style="width:590px; background-color:#ffffff;">
        narendra singh parmar
        </div>
       </td>
      <td valign="top" class="pad-top30">
      <div id="cart_holder" >
            <!--item-->
            <div class="order_information"   style="border:6px solid #CCCCCC;">
                <div class="icon">Oredr Information</div>
                <div>
                    <table width="100%" border="0" cellspacing="4" cellpadding="2">
                        <tr>
                            <td width="43%" style="background-color:#dfdede;"><b>Item</b></td>
                            <td width="21%" style="background-color:#dfdede; text-align:center"><b>Qty</b></td>
                            <td width="19%" style="background-color:#dfdede; text-align:center"><b>Price</b></td>
                            <td width="17%" style="background-color:#dfdede; text-align:center"><b>Del</b></td>
                        </tr>
                        <?php
						for($j=0; $j < count($getOrderInfo); $j++) { 
							$item_name 		           = $getOrderInfo[$j]['item_name'];
							$customers_basket_id 	   = $getOrderInfo[$j]['customers_basket_id'];
							$ses_id 		           = $getOrderInfo[$j]['ses_id'];
							$products_id 	           = $getOrderInfo[$j]['products_id'];
							$customers_basket_quantity = $getOrderInfo[$j]['customers_basket_quantity'];
							$final_price 	           = $getOrderInfo[$j]['final_price'];
							$products_id 	           = $getOrderInfo[$j]['products_id'];
							
						if(isset($customers_basket_id) && $customers_basket_id !=''){
					  ?>
                        <tr>
                            <td width="43%" style=""><b><?php echo $item_name;?></b></td>
                            <td width="21%" style=" text-align:center"><strong><?php echo $customers_basket_quantity;?></strong> </td>
                            <td width="19%" style=" text-align:center"><strong><?php echo $final_price;?></strong></td>
                            <td width="17%" style=" text-align:center"></a></td>
                        </tr>
                        <?php
					  }else{
				    ?>
                        <tr>
                            <td><span style="font-size:12px; color:#FF0000;"> No Items added yet!</span></td>
                        </tr>
                        <?php
				   }
				  ?>
                        <?php
				   }
				  ?>
                        <input type="hidden" name="basket_id" id="basket_id" value="<?php echo $customers_basket_id; ?>">
                        <tr>
                            <td colspan="4" class="h_bod">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="85%" style="background-color:#fafafb;"><b>Food Weverage Total</b></td>
                                        <td width="15%" style="background-color:#fafafb;"><b>$15.00</b></td>
                                    </tr>
                                    <tr>
                                        <td width="85%" colspan="2" style="line-height:25px; color:#d6383a;" align="center" ><b>Discount: 00.0</b></td>
                                    </tr>
                                    <tr>
                                        <td width="85%" style="background-color:#fafafb; line-height:25px;"><b>Sale Tex</b></td>
                                        <td width="15%" style="background-color:#fafafb;"><b>$15.00</b></td>
                                    </tr>
                                    <tr>
                                        <td width="85%" style="background-color:#fafafb; line-height:25px;"><b>Select Tip Amount</b></td>
                                        <td width="15%" style="background-color:#fafafb;"><b>$15.00</b></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" colspan="4" class="h_bod"> 
                                        &nbsp;
                                            <?php /*?><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td width="85%" style="line-height:25px; color:#d6383a;" ><b>Total</b></td>
                                                    <td width="15%" style="line-height:25px; color:#d6383a;"><b>$12</b></td>
                                                </tr>
                                            </table><?php */?>
                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <td colspan="4" align="center"><img src="<?php echo SITE_IMAGES; ?>icon_arrow_back.png" alt="" /><a href="index.php" class="icon_menu" style="text-decoration:none; vertical-align:top;"> Back to Menu </a> </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        </td>
    </tr>
  </table>