

function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
	
}
function validate() {
	
	if(document.contactForm1.certificate.value == '')
	{
		alert("Please Enter Certificate");
		document.contactForm1.certificate.focus();
		return false;
	}

	
	document.contactForm1.action="process2.php";
	return true;
}
    
	
	
	
	
    
	