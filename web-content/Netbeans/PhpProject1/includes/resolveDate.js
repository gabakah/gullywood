window.onload = initForm;

function initForm() {
	document.getElementById("rgBirthMonth").selectedIndex = 0;
	document.getElementById("rgBirthMonth").onchange = populateDays;
}

function populateDays() {
//	var birthDate = new Date();
//	var birthYear = birthDate.getFullYear();
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