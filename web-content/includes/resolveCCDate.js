window.onload = initForm;

function initForm()
{
	document.getElementById("rgBirthMonth").selectedIndex = 0;
	document.getElementById("rgBirthMonth").onchange = populateDays;
	document.getElementById("rgExpireMonth").selectedIndex = 0;
	document.getElementById("rgExpireMonth").onchange = populateCCDays;
	document.getElementById('step2CheckBox').onclick = isBillAddressChecked;
}

function populateDays()
{
	var birthYear = document.getElementById("rgBirthYear").selectedIndex.value;
	if((birthYear % 4) > 0){
		var monthDays = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
	} else {
		var monthDays = new Array(31,29,31,30,31,30,31,31,30,31,30,31);
	}
	var monthStr = this.options[this.selectedIndex].value;
	
	if (monthStr != "") {
		var theMonth = parseInt(monthStr);
		
		document.getElementById("rgBirthDay").options.length = 0;
		for(var i=0; i<monthDays[theMonth]; i++) {
			document.getElementById("rgBirthDay").options[i] = new Option(i+1);
		}
	}
}

function populateCCDays()
{
	var ExpireYear = document.getElementById("rgExpireYear").selectedIndex.value;
	if((ExpireYear % 4) > 0){
		var monthDays = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
	} else {
		var monthDays = new Array(31,29,31,30,31,30,31,31,30,31,30,31);
	}
	var monthStr = this.options[this.selectedIndex].value;
	
	if (monthStr != "") {
		var theMonth = parseInt(monthStr);
		
		document.getElementById("rgExpireDay").options.length = 0;
		for(var i=0; i<monthDays[theMonth]; i++) {
			document.getElementById("rgExpireDay").options[i] = new Option(i+1);
		}
	}
}

function isBillAddressChecked()
{
	var user_input = "";
	user_input = document.getElementById('step2CheckBox').checked;
	if(user_input)
	{
		document.getElementById('step2CheckBox').checked = true;
		document.getElementById('rgBillingAddress').value = document.getElementById('rgMailingAddress').value;
		document.getElementById('rgBillingCity').value = document.getElementById('rgMailingCity').value;
		document.getElementById('rgBillingState').value = document.getElementById('rgMailingState').value;
		document.getElementById('rgBillingZipCode').value = document.getElementById('rgMailingZipCode').value;
	}
}
