var Post = new Object();
Post.Send = function(form){
	var query = Post.buildQuery(form);
	var domain = "http://" + window.location.toString().split("//")[1].split("/")[0] + "/";
        //alert( domain );
	domain += "irest/beta01/";
	Ajax.Request(form.method, domain+"restaurant-view-cart-Ajax.php", query, Post.OnResponse);
}

Post.OnResponse = function(txt){
	document.getElementById("cart").innerHTML = txt;
}

Post.buildQuery = function(form){
	var query = "";
	for(var i=0; i<form.elements.length; i++){
		var key = form.elements[i].name;
		var value = Post.getElementValue(form.elements[i]);
		if(key && value){
			query += key +"="+ value +"&";
		}
	}
	return query;
}

Post.getElementValue = function(formElement){
	if(formElement.length != null) var type = formElement[0].type;
	if((typeof(type) == 'undefined') || (type == 0)) var type = formElement.type;

	switch(type){
		case 'undefined': return;

		case 'radio':
			if(formElement.checked == true) {
				return formElement.value;
			}
			/*
			for(var x=0; x < formElement.length; x++) {
				if(formElement[x].checked == true) {
					return formElement[x].value;
				}
			}
			*/
		case 'select-multiple':
			var myArray = new Array();
			for(var x=0; x < formElement.length; x++) 
				if(formElement[x].selected == true)
					myArray[myArray.length] = formElement[x].value;
			return myArray;

		case 'checkbox': return formElement.checked;
	
		default: return formElement.value;
	}
}