
function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
	
}
function valid_interest() {
	if(document.interestform.name.value == '')
	{
		alert("Please Enter Interest Name");  
		document.interestform.name.focus();
	return false;
	
	}
	
	document.interestform.action="add_interest_process.php";
	return true;
}
    
	
	
	
	
    
	