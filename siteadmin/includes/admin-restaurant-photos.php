<script language="javascript" type="text/javascript">
	function uploadFileValidate() {
	//	alert("test");
		document.frmPropertyPhoto.submit();
	}

	function bnkPhotoCaption(strId){
		if((document.getElementById(strId).value == "Photo caption ...") || (document.getElementById(strId).value == "")){
			document.getElementById(strId).value = "";
		}
	}
	
	function restorePhotoCaption(strId){
		if(document.getElementById(strId).value == ""){
			document.getElementById(strId).value = "Photo caption ...";
			return false;
		}
	}
</script>
                <div class="pic-galery">
                    <div class="pic-galery-line1">
                        <div class="food_item">
                            <div class="food_item-pic"><img src="images/food-item1.gif" alt="" /></div>
                            <!--pic -->
                            <p>
                            <h5 align="center">Name of food</h5>
                            </p>
                            <p align="right"><a class="green" href="#">Edit</a>&nbsp;&nbsp;&nbsp;<a class="red" href="#">Detele</a></p>
                        </div>
                        <!--main -->
                        <div class="food_item">
                            <div class="food_item-pic"><img src="images/food-item2.gif" alt="" /></div>
                            <!--pic -->
                            <p>
                            <h5 align="center">Name of food</h5>
                            </p>
                            <p align="right"><a class="green" href="#">Edit</a>&nbsp;&nbsp;&nbsp;<a class="red" href="#">Detele</a></p>
                        </div>
                        <!--main -->
                        <div class="food_item">
                            <div class="food_item-pic"><img src="images/food-item3.gif" alt="" /></div>
                            <!--pic -->
                            <p>
                            <h5 align="center">Name of food</h5>
                            </p>
                            <p align="right"><a class="green" href="#">Edit</a>&nbsp;&nbsp;&nbsp;<a class="red" href="#">Detele</a></p>
                        </div>
                        <!--main -->
                    </div>
                    <!--pic galery line1 -->
                    <div class="pic-galery-line1">
                        <div class="food_item">
                            <div class="food_item-pic"><img src="images/food-item4.gif" alt="" /></div>
                            <!--pic -->
                            <p>
                            <h5 align="center">Name of food</h5>
                            </p>
                            <p align="right"><a class="green" href="#">Edit</a>&nbsp;&nbsp;&nbsp;<a class="red" href="#">Detele</a></p>
                        </div>
                        <!--main -->
                        <div class="food_item">
                            <div class="food_item-pic"><img src="images/food-item5.gif" alt="" /></div>
                            <!--pic -->
                            <p>
                            <h5 align="center">Name of food</h5>
                            </p>
                            <p align="right"><a class="green" href="#">Edit</a>&nbsp;&nbsp;&nbsp;<a class="red" href="#">Detele</a></p>
                        </div>
                        <!--main -->
                        <div class="food_item">
                            <div class="food_item-pic"><img src="images/food-item6.gif" alt="" /></div>
                            <!--pic -->
                            <p>
                            <h5 align="center">Name of food</h5>
                            </p>
                            <p align="right"><a class="green" href="#">Edit</a>&nbsp;&nbsp;&nbsp;<a class="red" href="#">Detele</a></p>
                        </div>
                        <!--main -->
                    </div>
                    <!--pic galery line1 -->
                </div>
                <!--pic gallery -->
                <div class="pic-upload-sec">
                    <table width="683" border="0" cellspacing="0" cellpadding="0" align="center">
                        <tr>
                            <td colspan="2">
                                <h4>Add Edit Photo</h4>
                            </td>
                            <td colspan="2" align="right"><a class="green" href="#">Bulk Upload</a></td>
                        </tr>
                        <tr>
                            <td width="102">
                                <input name="" type="file" onchange="return showValue('<?php echo $i;?>');" width="120"/>
                            </td>
                            <td width="181"></td>
                            <td width="309">
                                <input name="" type="text" style="width:300px;"/>
                            </td>
                            <td width="108"><a href="#"><img src="images/upload-btn.gif" alt="" /></a></td>
                        </tr>
                    </table>
                </div>
                <!--pic upload sec -->