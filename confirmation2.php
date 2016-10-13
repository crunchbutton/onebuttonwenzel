<?php
	if($_REQUEST['orderString'] == NULL) {
		header("Location: /");
	}
  header("Cache-Control: no-cache, private, must-revalidate, max-age=0");
  header("Pragma: no-cache");
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // A date in the past

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	$timeStr = date('Y/m/d g:i:s A');
	$messageAlphaDelta = $timeStr . "\n\n" . str_replace("*","\n", $_REQUEST['orderString']);	
	$messageAlphaDelta = str_replace("<i>", "", $messageAlphaDelta);
	$messageAlphaDelta = str_replace("</i>", "", $messageAlphaDelta);
	//$messageAlphaDelta = $messageAlphaDelta. "\n Credit: " . ($_REQUEST['ordercredit'] == "ON");
	$headerAlphaDelta = "From: " . "OneButtonWenzel@gmail.com";
	$subjectStr = "Subject: Incoming Order From: OneButtonWenzel.com ". $timeStr;
	//echo "THE CREDIT INFO IS":
	//echo $_REQUEST['ordercredit'];
	//if($_REQUEST['ordercredit']=='Yes') {
	//}
	//else {
	if(strstr($_REQUEST['orderString'], "Cash")) {
    	//mail("onebuttonwenzel@gmail.com", $subjectStr, $messageAlphaDelta, $headerAlphaDelta);
	}

	//}
    
 ?>

<head>
<title>Order Confirmation</title>
<link rel="stylesheet" type="text/css" href="main.css" />
</head>

 <form action="https://checkout.google.com/api/checkout/v2/checkoutForm/Merchant/910190858844300" id="googleform" method="post" name="googleForm" target="_top">
    <input name="_charset_" type="hidden" value="utf-8"/>
   </form>

<body onload="load();">
	<div class="main-content" id="confirm-wrapper">
		<h3>You've been WENZELED!</h3>
		<div id="confirmation">
		</div>
        <div id='bottom-message'>
        <br/>
        To cancel or change your order please call: <b>(203) 309-0549</b>
        </div>
	</div>
</body>
</html>

<script type="text/javascript">

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}

function load() {
	
alert("loading")
	if(readCookie("redirect")) {
		document.location.href = "/";
	}
		
	form = document.getElementById("googleform");
	
	if(readCookie("ordercredit")) {
		//populate and submit the google check out form
		var googleCount = 1;
		var wenzelArr = new Array();
		var wenzelCounts = new Array();

		if(readCookie("curCount")) {
			var countStr = readCookie("curCount");
			wenzelCounts = countStr.split('a');
		}
		if(readCookie("curOrder")) {
			var orderStr = readCookie("curOrder");
			wenzelArr = orderStr.split('{');
		}

		var totalCost = 0;
		for(var i = 0; i < wenzelArr.length; i++) {
			
			var count = wenzelCounts[i];
			if(count > 0) {
				var curCost = 8.75;
				if(wenzelArr[i].indexOf("blue cheese") != -1) {
					curCost = curCost + 0.5;
				}
				if (wenzelArr[i].indexOf("ranch") != -1) {
					curCost = curCost + 0.5;
				}
				if (wenzelArr[i].indexOf("bacon") != -1) {
					curCost = curCost + 1.0;
				}
				if (wenzelArr[i].indexOf("fries") != -1) {
					curCost = curCost + 2.0;
				}
				var cost = curCost;
				totalCost += cost*count;
				form.innerHTML = form.innerHTML + 
								"<input name=\"item_name_" + googleCount + "\" type=\"hidden\"" +
								" value=\"" + wenzelArr[i] + "\"/>" +
							    "<input name=\"item_description_" + googleCount + "\" type=\"hidden\" value=\"\"/>" +
							    "<input name=\"item_quantity_" + googleCount + "\" type=\"hidden\" value=\"" + count + "\"/>" +
							    "<input name=\"item_price_" + googleCount + "\" type=\"hidden\" value=\"" + cost + "\"/>" +
							    "<input name=\"item_currency_" + googleCount + "\" type=\"hidden\" value=\"USD\"/>";
				googleCount++;
			}
		}
		
		form.innerHTML = form.innerHTML + 
		"<input name=\"item_name_" + googleCount + "\" type=\"hidden\"" +
		" value=\"Delivery To: " + readCookie("address") + "\"/>" +
	    "<input name=\"item_description_" + googleCount + "\" type=\"hidden\" value=\"" + readCookie("phone") + "\"/>" +
	    "<input name=\"item_quantity_" + googleCount + "\" type=\"hidden\" value=\"" + 1 + "\"/>" +
	    "<input name=\"item_price_" + googleCount + "\" type=\"hidden\" value=\"" + 0 + "\"/>" +
	    "<input name=\"item_currency_" + googleCount + "\" type=\"hidden\" value=\"USD\"/>"; 

	    googleCount++;
	    var tipAmount = readCookie('tipamount');
	    //alert(tipAmount);
	    tipAmount = (tipAmount/100);
	    //alert(tipAmount);
	    tipAmount = tipAmount * totalCost;
	    //alert(tipAmount);
	   // alert(tipAmount);
	    form.innerHTML = form.innerHTML + 
		"<input name=\"item_name_" + googleCount + "\" type=\"hidden\"" +
		" value=\"Tip:\"/>" +
	    "<input name=\"item_description_" + googleCount + "\" type=\"hidden\" value=\"\"/>" +
	    "<input name=\"item_quantity_" + googleCount + "\" type=\"hidden\" value=\"" + 1 + "\"/>" +
	    "<input name=\"item_price_" + googleCount + "\" type=\"hidden\" value=\"" + tipAmount + "\"/>" +
	    "<input name=\"item_currency_" + googleCount + "\" type=\"hidden\" value=\"USD\"/>"; 
		
		eraseCookie("ordercredit");
		createCookie("redirect", 1, 1);
	    form.submit();
		}

	var confStr = readCookie("confString");
	//var adStr = readCookie("adString");
	//alert(confStr);
	document.getElementById("confirmation").innerHTML = document.getElementById("confirmation").innerHTML
														+ confStr;
}

</script>