<?php # Registration Script - Register.php

/* 
 *	This is the main page.
 *	This page includes the configuration file, 
 *	the templates, and any content-specific modules.
 */

	// Require the configuration file before any PHP code:
	require_once ('../includes/config.inc.php');
	require_once ('../includes/app_top.php');

	// session_destroy();
	// session_start();
//	session_register("start");
//	$start = time();
//	$sessionId = session_id();
	
	$dsn = 'mysql://gabakah_access:gullyw00d@localhost/gabakah_gwdb';
	$db = & DB::connect($dsn);
	// set fetchmode
	$db->setFetchMode(DB_FETCHMODE_ASSOC);
	
	// All options:
	// Use specific username and password columns.
	// Use SHA1() to encrypt the passwords.
	// Retrieve all fields.
	$options = array(
		'dsn' => $dsn,
		'table' => 'users',
		'usernamecol' => 'username',
		'passwordcol' => 'password',
		'cryptType' => 'sha1',
		'db_fields' => '*'
	);

	// Create the Auth object:
	$auth = new Auth('DB', $options, 'show_register_form');
	show_register_form();
//	$sdbc = mysql_connect ('localhost', 'gabakah_access', 'gullyw00d', 'gabakah_gwdb') OR die ('Cannot connect to the database.');
?>
<?php
// Function for showing a registration form
function show_register_form()
{
	echo "	<div id=\"rgStep1\">";
	echo "			<form id=\"LoginForm\" action=\"Register.php\"  method=\"post\" name=\"LoginForm\">";
	echo "				<br />";
	echo "				<label for=\"rgRegistration\" class=\"rgRegistration\">REGISTRATION :: Step 1 of 2</label><br />";
	echo "				<label for=\"rgMessage\" class=\"rgMessage\">To start your FREE trial, please fill in the information below.</label><label for=\"step2AlreadyMember\" class=\"step2AlreadyMember\"> Already a member? </label><label for=\"step2AlreadyMemberClickHere\" class=\"step2AlreadyMemberClickHere\"><a href=\"http://www.gullywood.com/gw/Login.html\">Click here</a></label><br />";
	echo "				<label for=\"rgRequired\" class=\"rgRequired\">*Required fields.</label><br />";
	echo "				<label for=\"rgUsername\" class=\"rgUsername\">* Enter a Username: </label><input type=\"text\" id=\"rgUsername\" placeholder=\"JPublicXYZ\" name=\"rgUsername\" size=\"30\" onchange=\"check_username(this.form.rgUsername.value)\"/><span id=\"username_label\"></span><br />";
	echo "				<label for=\"rgAssistance\" class=\"rgAssistance\">Minimum of 6 characters</label><br />";
	echo "				<label for=\"rgEmail\" class=\"rgEmail\">* Enter Email: </label><input id=\"rgEmail\" type=\"text\" placeholder=\"me@mymail.com\" name=\"rgEmail\" size=\"30\" /><br />";
	echo "				<label for=\"rgAssistance\" class=\"rgAssistance\">Example: me@mymail.com</label><br />";
	echo "				<label for=\"rgConfirmEmail\" class=\"rgConfirmEmail\">* Confirm Email: </label><input id=\"rgConfirmEmail\" type=\"text\" placeholder=\"me@mymail.com\" name=\"rgConfirmEmail\" size=\"30\" /><br />";
	echo "				<label for=\"rgPassword\" class=\"rgPassword\">* Password: </label><input id=\"rgPassword\" type=\"password\" placeholder=\"Passwords can be 6 to 20 characters.\" name=\"rgPassword\" size=\"30\" /><br />";
	echo "				<label for=\"rgConfirmPassword\" class=\"rgConfirmPassword\">* Confirm password: </label><input id=\"rgConfirmPassword\" type=\"password\" placeholder=\"Passwords can be 6 to 20 characters.\" name=\"rgConfirmPassword\" size=\"30\" /><br />";
	echo "				<label for=\"rgSecurityQuestion\" class=\"rgSecurityQuestion\">* Security Question: </label>";
	echo "				<select id=\"rgSecurityQuestion\" name=\"rgSecurityQuestion\" size=\"1\">";
	echo "					<option value=\"\" selected=\"selected\">Please Choose a question below</option>";
	echo "					<option value=\"What is your mothers maiden name?\">What is your mothers maiden name?</option>";
	echo "					<option value=\"What is your favorite color?\">What is your favorite color?</option>";
	echo "					<option value=\"Where did you attend school?\">Where did you attend school?</option>";
	echo "				</select><br />";
	echo "				<label for=\"rgSecurityAnswer\" class=\"rgSecurityAnswer\">* Security Answer: </label><input id=\"rgSecurityAnswer\" type=\"text\" name=\"rgSecurityAnswer\" size=\"30\" /><br />";
	echo "				<br />";
	echo "				<textarea id=\"rgTermsOfUse\" name=\"rgTermsOfUse\" rows=\"7\" cols=\"72\" readonly=\"readonly\"></textarea><br />";
	echo "				<input id=\"rgCheckBox\" class=\"rgCheckBox\" type=\"checkbox\" name=\"chxTermsOfUse\" value=\"chxTermsOfUse\"/><label for=\"rgTermsOfUse\" class=\"rgTermsOfUse\">By checking here, I am agreeing to Gullywood Terms Of Use &amp; Privacy Policy.</label><br />";
	echo "				<button name=\"nextPageButton\" type=\"button\" class=\"buttonSignIn\" onclick=\"return formValidatorStep1();\">Continue</button>";
	echo "				<br />";
	echo "				<br />";
	echo "		</div>";
	echo "		<div id=\"rgStep2\">";
	echo "				<br />";
	echo "				<label for=\"step2Registration\" class=\"step2Registration\">REGISTRATION :: Step 2 of 2</label><br />";
	echo "				<label for=\"step2Required\" class=\"rgRequired\">*Required fields.</label><br />";
	echo "				<br />";
	echo "				<label for=\"step2FirstName\" class=\"step2FirstName\">* First Name: </label><input id=\"rgFirstName\" type=\"text\" name=\"rgFirstName\" size=\"30\" /><br />";
	echo "				<label for=\"step2LastName\" class=\"step2LastName\">* Last Name: </label><input id=\"rgLastName\" type=\"text\" name=\"rgLastName\" size=\"30\" /><br />";
	echo "				<label for=\"step2HomePhone\" class=\"step2HomePhone\">* Home Phone: </label><input id=\"rgPhoneNumber\" type=\"text\" name=\"rgPhoneNumber\" size=\"30\" /><br />";
	echo "				<label for=\"step2BirthDate\" class=\"step2BirthDate\">* Birth Date: </label>";
	echo "				<select id=\"rgBirthMonth\" name=\"rgBirthMonth\" size=\"1\">";
	echo "					<option value=\"\" selected=\"selected\">Month</option>";
	echo "					<option value=\"0\">January</option>";
	echo "					<option value=\"1\">February</option>";
	echo "					<option value=\"2\">March</option>";
	echo "					<option value=\"3\">April</option>";
	echo "					<option value=\"4\">May</option>";
	echo "					<option value=\"5\">June</option>";
	echo "					<option value=\"6\">July</option>";
	echo "					<option value=\"7\">August</option>";
	echo "					<option value=\"8\">September</option>";
	echo "					<option value=\"9\">October</option>";
	echo "					<option value=\"10\">November</option>";
	echo "					<option value=\"11\">December</option>";
	echo "				</select>";
	echo "				<select id=\"rgBirthDay\" name=\"rgBirthDay\" size=\"1\">";
	echo "					<option value=\"\" selected=\"selected\">Day</option>";
	echo "				</select>";
	echo "				<select id=\"rgBirthYear\" name=\"rgBirthYear\" size=\"1\">";
	echo "					<option value=\'1900\'>1900</option>";
	echo "			<option value=\'1901\'>1901</option>";
	echo "			<option value=\'1902\'>1902</option>";
	echo "			<option value=\'1903\'>1903</option>";
	echo "			<option value=\'1904\'>1904</option>";
	echo "			<option value=\'1905\'>1905</option>";
	echo "			<option value=\'1906\'>1906</option>";
	echo "			<option value=\'1907\'>1907</option>";
	echo "			<option value=\'1908\'>1908</option>";
	echo "			<option value=\'1909\'>1909</option>";
	echo "			<option value=\'1910\'>1910</option>";
	echo "			<option value=\'1911\'>1911</option>";
	echo "			<option value=\'1912\'>1912</option>";
	echo "			<option value=\'1913\'>1913</option>";
	echo "			<option value=\'1914\'>1914</option>";
	echo "			<option value=\'1915\'>1915</option>";
	echo "			<option value=\'1916\'>1916</option>";
	echo "			<option value=\'1917\'>1917</option>";
	echo "			<option value=\'1918\'>1918</option>";
	echo "			<option value=\'1919\'>1919</option>";
	echo "			<option value=\'1920\'>1920</option>";
	echo "			<option value=\'1921\'>1921</option>";
	echo "			<option value=\'1922\'>1922</option>";
	echo "			<option value=\'1923\'>1923</option>";
	echo "			<option value=\'1924\'>1924</option>";
	echo "			<option value=\'1925\'>1925</option>";
	echo "			<option value=\'1926\'>1926</option>";
	echo "			<option value=\'1927\'>1927</option>";
	echo "			<option value=\'1928\'>1928</option>";
	echo "			<option value=\'1929\'>1929</option>";
	echo "			<option value=\'1930\'>1930</option>";
	echo "			<option value=\'1931\'>1931</option>";
	echo "			<option value=\'1932\'>1932</option>";
	echo "			<option value=\'1933\'>1933</option>";
	echo "			<option value=\'1934\'>1934</option>";
	echo "			<option value=\'1935\'>1935</option>";
	echo "			<option value=\'1936\'>1936</option>";
	echo "			<option value=\'1937\'>1937</option>";
	echo "			<option value=\'1938\'>1938</option>";
	echo "			<option value=\'1939\'>1939</option>";
	echo "			<option value=\'1940\'>1940</option>";
	echo "			<option value=\'1941\'>1941</option>";
	echo "			<option value=\'1942\'>1942</option>";
	echo "			<option value=\'1943\'>1943</option>";
	echo "			<option value=\'1944\'>1944</option>";
	echo "			<option value=\'1945\'>1945</option>";
	echo "			<option value=\'1946\'>1946</option>";
	echo "			<option value=\'1947\'>1947</option>";
	echo "			<option value=\'1948\'>1948</option>";
	echo "			<option value=\'1949\'>1949</option>";
	echo "			<option value=\'1950\'>1950</option>";
	echo "			<option value=\'1951\'>1951</option>";
	echo "			<option value=\'1952\'>1952</option>";
	echo "			<option value=\'1953\'>1953</option>";
	echo "			<option value=\'1954\'>1954</option>";
	echo "			<option value=\'1955\'>1955</option>";
	echo "			<option value=\'1956\'>1956</option>";
	echo "			<option value=\'1957\'>1957</option>";
	echo "			<option value=\'1958\'>1958</option>";
	echo "			<option value=\'1959\'>1959</option>";
	echo "			<option value=\'1960\'>1960</option>";
	echo "			<option value=\'1961\'>1961</option>";
	echo "			<option value=\'1962\'>1962</option>";
	echo "			<option value=\'1963\'>1963</option>";
	echo "			<option value=\'1964\'>1964</option>";
	echo "			<option value=\'1965\'>1965</option>";
	echo "			<option value=\'1966\'>1966</option>";
	echo "			<option value=\'1967\'>1967</option>";
	echo "			<option value=\'1968\'>1968</option>";
	echo "			<option value=\'1969\'>1969</option>";
	echo "			<option value=\'1970\'>1970</option>";
	echo "			<option value=\'1971\'>1971</option>";
	echo "			<option value=\'1972\'>1972</option>";
	echo "			<option value=\'1973\'>1973</option>";
	echo "			<option value=\'1974\'>1974</option>";
	echo "			<option value=\'1975\'>1975</option>";
	echo "			<option value=\"\" selected=\"selected\">Year</option>";
	echo "			<option value=\'1976\'>1976</option>";
	echo "			<option value=\'1977\'>1977</option>";
	echo "			<option value=\'1978\'>1978</option>";
	echo "			<option value=\'1979\'>1979</option>";
	echo "			<option value=\'1980\'>1980</option>";
	echo "			<option value=\'1981\'>1981</option>";
	echo "			<option value=\'1982\'>1982</option>";
	echo "			<option value=\'1983\'>1983</option>";
	echo "			<option value=\'1984\'>1984</option>";
	echo "			<option value=\'1985\'>1985</option>";
	echo "			<option value=\'1986\'>1986</option>";
	echo "			<option value=\'1987\'>1987</option>";
	echo "			<option value=\'1988\'>1988</option>";
	echo "			<option value=\'1989\'>1989</option>";
	echo "			<option value=\'1990\'>1990</option>";
	echo "			<option value=\'1991\'>1991</option>";
	echo "			<option value=\'1992\'>1992</option>";
	echo "			<option value=\'1993\'>1993</option>";
	echo "			<option value=\'1994\'>1994</option>";
	echo "			<option value=\'1995\'>1995</option>";
	echo "			<option value=\'1996\'>1996</option>";
	echo "			<option value=\'1997\'>1997</option>";
	echo "			<option value=\'1998\'>1998</option>";
	echo "			<option value=\'1999\'>1999</option>";
	echo "			<option value=\'2000\'>2000</option>";
	echo "			<option value=\'2001\'>2001</option>";
	echo "			<option value=\'2002\'>2002</option>";
	echo "			<option value=\'2003\'>2003</option>";
	echo "			<option value=\'2004\'>2004</option>";
	echo "			<option value=\'2005\'>2005</option>";
	echo "			<option value=\'2006\'>2006</option>";
	echo "			<option value=\'2007\'>2007</option>";
	echo "		</select><br />";
	echo "		<br />";
	echo "		<label for=\"step2Membership\" class=\"step2Membership\">* Membership: </label>";
	echo "		<select id=\"rgMembership\" name=\"rgMembership\" size=\"1\">";
	echo "			<option value=\"\" selected=\"selected\">Select Membership Plan</option>";
	echo "			<option value=\'12\' >$16.95/mo - 3 out (Standard Monthly)</option>";
	echo "			<option value=\'10\' >$24.95/mo - 3 out (Premium Monthly)</option>";
	echo "			<option value=\'24\' >$47.88/yr - 1 out (Starter SuperPass)</option>";
	echo "			<option value=\'20\' >$99/yr - 2 out (Bronze SuperPass)</option>";
	echo "			<option value=\'21\' >$143/yr - 3 out - (Silver SuperPass)</option>";
	echo "			<option value=\'25\' >$71.88/yr - 1 out (Starter Premium SuperPass)</option>";
	echo "			<option value=\'22\' >$143/yr - 2 out (Gold SuperPass)</option>";
	echo "			<option value=\'23\'>$177/yr - 3 out (Platninum SuperPass)</option>";
	echo "			<option value=\'99\' >No Monthly Fees - Pay per Rental</option>";
	echo "		</select><br />";
	echo "		<br />";
	echo "		<label for=\"step2MailingAddress\" class=\"step2MailingAddress\">Mailing Address</label><br />";
	echo "		<label for=\"step2Address\" class=\"step2Address\">* Address: </label><input id=\"rgMailingAddress\" type=\"text\" name=\"rgMailingAddress\" size=\"39\" /><br />";
	echo "		<label for=\"step2Address2\" class=\"step2Address2\">Address 2 (optional): </label><input id=\"rgMailingAddress2\" type=\"text\" name=\"rgMailingAddress2\" size=\"39\" /><br />";
	echo "		<label for=\"step2City\" class=\"step2City\">* City: </label><input id=\"rgMailingCity\" type=\"text\" name=\"rgMailingCity\" size=\"24\" /><br />";
	echo "		<label for=\"step2State\" class=\"step2State\">* State: </label>";
	echo "		<select id=\"rgMailingState\" name=\"rgMailingState\" size=\"1\">";
	echo "			<option value=\"\" selected=\"selected\">Select State</option>";
	echo "			<option value=\'AL\'>Alabama</option>";
	echo "			<option value=\'AK\'>Alaska</option>";
	echo "			<option value=\'AZ\'>Arizona</option>";
	echo "			<option value=\'AR\'>Arkansas</option>";
	echo "			<option value=\'CA\'>California</option>";
	echo "			<option value=\'CO\'>Colorado</option>";
	echo "			<option value=\'CT\'>Connecticut</option>";
	echo "			<option value=\'DE\'>Delaware</option>";
	echo "			<option value=\'DC\'>District of Columbia</option>";
	echo "			<option value=\'FL\'>Florida</option>";
	echo "			<option value=\'GA\'>Georgia</option>";
	echo "			<option value=\'GU\'>Guam</option>";
	echo "			<option value=\'HI\'>Hawaii</option>";
	echo "			<option value=\'ID\'>Idaho [ID]</option>";
	echo "			<option value=\'IL\'>Illinois</option>";
	echo "			<option value=\'IN\'>Indiana</option>";
	echo "			<option value=\'IA\'>Iowa</option>";
	echo "			<option value=\'KS\'>Kansas</option>";
	echo "			<option value=\'KY\'>Kentucky</option>";
	echo "			<option value=\'LA\'>Louisiana</option>";
	echo "			<option value=\'ME\'>Maine</option>";
	echo "			<option value=\'MD\'>Maryland</option>";
	echo "			<option value=\'MA\'>Massachusetts</option>";
	echo "			<option value=\'MI\'>Michigan</option>";
	echo "			<option value=\'MN\'>Minnesota</option>";
	echo "			<option value=\'MS\'>Mississippi</option>";
	echo "			<option value=\'MO\'>Missouri</option>";
	echo "			<option value=\'MT\'>Montana</option>";
	echo "			<option value=\'NE\'>Nebraska</option>";
	echo "			<option value=\'NV\'>Nevada</option>";
	echo "			<option value=\'NH\'>New Hampshire</option>";
	echo "			<option value=\'NJ\'>New Jersey</option>";
	echo "			<option value=\'NM\'>New Mexico</option>";
	echo "			<option value=\'NY\'>New York</option>";
	echo "			<option value=\'NC\'>North Carolina</option>";
	echo "			<option value=\'ND\'>North Dakota</option>";
	echo "			<option value=\'OH\'>Ohio</option>";
	echo "			<option value=\'OK\'>Oklahoma</option>";
	echo "			<option value=\'OR\'>Oregon</option>";
	echo "			<option value=\'PA\'>Pennsylvania</option>";
	echo "			<option value=\'RI\'>Rhode Island</option>";
	echo "			<option value=\'SC\'>South Carolina</option>";
	echo "			<option value=\'SD\'>South Dakota</option>";
	echo "			<option value=\'TN\'>Tennessee</option>";
	echo "			<option value=\'TX\'>Texas</option>";
	echo "			<option value=\'UT\'>Utah</option>";
	echo "			<option value=\'VT\'>Vermont</option>";
	echo "			<option value=\'VA\'>Virginia</option>";
	echo "			<option value=\'WA\'>Washington</option>";
	echo "			<option value=\'WV\'>West Virginia</option>";
	echo "			<option value=\'WI\'>Wisconsin</option>";
	echo "			<option value=\'WY\'>Wyoming</option>";
	echo "		</select><br />";
	echo "		<label for=\"step2Zip\" class=\"step2Zip\">* Zip Code: </label><input id=\"rgMailingZipCode\" type=\"text\" name=\"rgMailingZipCode\" size=\"15\" /><br />";
	echo "		<br />";
	echo "		<label for=\"step2BillingInfo\" class=\"step2BillingInfo\">Billing Address</label><br />";
	echo "		<input class=\"step2CheckBox\" type=\"checkbox\" name=\"checkboxName\" value=\"checkboxValue\" onclick=\"return sameAddress()\" checked=\"checked\"/><label for=\"step2BillingMailingAddress\" class=\"step2BillingMailingAddress\">My Billing Address is the same as my Mailing Address</label><br />";
	echo "		<label for=\"step2Address\" class=\"step2Address\">* Address: </label><input id=\"rgBillingAddress\" type=\"text\" name=\"rgBillingAddress\" size=\"39\" /><br />";
	echo "		<label for=\"step2City\" class=\"step2City\">* City: </label><input id=\"rgBillingCity\" type=\"text\" name=\"rgBillingCity\" size=\"39\" /><br />";
	echo "		<label for=\"step2State\" class=\"step2State\">* State: </label>";
	echo "		<select id=\"rgBillingState\" name=\"rgBillingState\" size=\"1\">";
	echo "			<option value=\"\" selected=\"selected\">Select State</option>";
	echo "			<option value=\'AL\'>Alabama</option>";
	echo "			<option value=\'AK\'>Alaska</option>";
	echo "			<option value=\'AZ\'>Arizona</option>";
	echo "			<option value=\'AR\'>Arkansas</option>";
	echo "			<option value=\'CA\'>California</option>";
	echo "			<option value=\'CO\'>Colorado</option>";
	echo "			<option value=\'CT\'>Connecticut</option>";
	echo "			<option value=\'DE\'>Delaware</option>";
	echo "			<option value=\'DC\'>District of Columbia</option>";
	echo "			<option value=\'FL\'>Florida</option>";
	echo "			<option value=\'GA\'>Georgia</option>";
	echo "			<option value=\'GU\'>Guam</option>";
	echo "			<option value=\'HI\'>Hawaii</option>";
	echo "			<option value=\'ID\'>Idaho [ID]</option>";
	echo "			<option value=\'IL\'>Illinois</option>";
	echo "			<option value=\'IN\'>Indiana</option>";
	echo "			<option value=\'IA\'>Iowa</option>";
	echo "			<option value=\'KS\'>Kansas</option>";
	echo "			<option value=\'KY\'>Kentucky</option>";
	echo "			<option value=\'LA\'>Louisiana</option>";
	echo "			<option value=\'ME\'>Maine</option>";
	echo "			<option value=\'MD\'>Maryland</option>";
	echo "			<option value=\'MA\'>Massachusetts</option>";
	echo "			<option value=\'MI\'>Michigan</option>";
	echo "			<option value=\'MN\'>Minnesota</option>";
	echo "			<option value=\'MS\'>Mississippi</option>";
	echo "			<option value=\'MO\'>Missouri</option>";
	echo "			<option value=\'MT\'>Montana</option>";
	echo "			<option value=\'NE\'>Nebraska</option>";
	echo "			<option value=\'NV\'>Nevada</option>";
	echo "			<option value=\'NH\'>New Hampshire</option>";
	echo "			<option value=\'NJ\'>New Jersey</option>";
	echo "			<option value=\'NM\'>New Mexico</option>";
	echo "			<option value=\'NY\'>New York</option>";
	echo "			<option value=\'NC\'>North Carolina</option>";
	echo "			<option value=\'ND\'>North Dakota</option>";
	echo "			<option value=\'OH\'>Ohio</option>";
	echo "			<option value=\'OK\'>Oklahoma</option>";
	echo "			<option value=\'OR\'>Oregon</option>";
	echo "			<option value=\'PA\'>Pennsylvania</option>";
	echo "			<option value=\'RI\'>Rhode Island</option>";
	echo "			<option value=\'SC\'>South Carolina</option>";
	echo "			<option value=\'SD\'>South Dakota</option>";
	echo "			<option value=\'TN\'>Tennessee</option>";
	echo "			<option value=\'TX\'>Texas</option>";
	echo "			<option value=\'UT\'>Utah</option>";
	echo "			<option value=\'VT\'>Vermont</option>";
	echo "			<option value=\'VA\'>Virginia</option>";
	echo "			<option value=\'WA\'>Washington</option>";
	echo "			<option value=\'WV\'>West Virginia</option>";
	echo "			<option value=\'WI\'>Wisconsin</option>";
	echo "			<option value=\'WY\'>Wyoming</option>";
	echo "		</select><br />";
	echo "		<label for=\"step2Zip\" class=\"step2Zip\">* Zip Code: </label><input id=\"rgBillingZipCode\" type=\"text\" name=\"rgBillingZipCode\" size=\"15\" /><br />";
	echo "		<br />";
	echo "		<label for=\"step2CCInfo\" class=\"step2CCInfo\">Credit Card Info</label><br />";
	echo "		<label for=\"step2CCType\" class=\"step2CCType\">* Credit Card Type: </label>";
	echo "		<select id=\"rgCreditCardType\" name=\"rgCreditCardType\" size=\"1\">";
	echo "			<option value=\"\" selected=\"selected\">Select Credit Card</option>";
	echo "			<option value=\'Discover\'>Discover</option>";
	echo "			<option value=\'VISA\'>VISA</option>";
	echo "			<option value=\'Mastercard\'>Mastercard</option>";
	echo "			<option value=\'American Express\'>American Express</option>";
	echo "		</select><br />";
	echo "		<label for=\"step2CCNumber\" class=\"step2CCNumber\">* Card Number: </label><input id=\"rgCreditCardNumber\" type=\"text\" name=\"rgCreditCardNumber\" size=\"24\" /><br />";
	echo "		<label for=\"step2CCExpiration\" class=\"step2CCExpiration\">* Expiration Date: </label><input id=\"rgCreditCardExpirationDate\" type=\"text\" name=\"rgCreditCardExpirationDate\" placeholder=\"MM/DD/YEAR\"size=\"24\" /><br />";
	echo "		<label for=\"step2CCV2\" class=\"step2CCV2\">* CVV2 Number: </label><input id=\"rgCreditCardCVV2\" type=\"text\" name=\"rgCreditCardCVV2\" size=\"24\" /><br />";
	echo "		<br />";
	echo "		<input type=\"submit\" name=\"rgSubmitButton\" class=\"buttonSignIn\" value=\"Register\" onclick=\"return formValidatorStep2()\"/><br />";
	echo "	</form>";
	echo "</div>";		// End of show_register_form() function
}

if (isset($_POST['rgSubmitButton'])){
	// Set the field names
	$user = $_POST['rgUsername'];
	$password = sha1($_POST['rgPassword']);
	$userEmail = $_POST['rgEmail'];
	$securityQuestion = $_POST['rgSecurityQuestion'];
	$securityAnswer = $_POST['rgSecurityAnswer'];
	$firstName = $_POST['rgFirstName'];
	$lastName = $_POST['rgLastName'];
	$phoneNumber = $_POST['rgPhoneNumber'];
	$membershipPlan = $_POST['rgMembership'];
    $mailingAddress1 = $_POST['rgMailingAddress'];
    $mailingAddress2 = $_POST['rgMailingAddress2'];
    $mailingCity = $_POST['rgMailingCity'];
    $mailingState = $_POST['rgMailingState'];
    $mailingZipcode = $_POST['rgMailingZipCode'];
    $phoneNumber = $_POST['rgPhoneNumber'];
    $billingAddress1 = $_POST['rgBillingAddress'];
    $billingAddress2 = $mailingAddress2;
    $billingCity = $_POST['rgBillingCity'];
    $billingState = $_POST['rgBillingState'];
    $billingZipcode = $_POST['rgBillingZipCode'];
    $ccType = $_POST['rgCreditCardType'];
    $ccNumber = $_POST['rgCreditCardNumber'];
    $ccCode = $_POST['rgCreditCardCVV2'];
    $ccExpiration = $_POST['rgCreditCardExpirationDate'];
       
	// Use PEAR DB to insert data into customer table
	$data = array('customerName' => $user, 'mailingAddress1' => $mailingAddress1, 'mailingAddress2' => $mailingAddress2, 'mailingCity' => $mailingCity,
	'mailingState' => $mailingState, 'mailingZipcode' => $mailingZipcode, 'phoneNumber' => $phoneNumber, 'billingAddress1' => $billingAddress1,
	'billingAddress2' => $mailingAddress2, 'billingCity' => $billingCity, 'billingState' => $billingState, 'billingZipcode' => $billingZipcode,
	'customerStatus' => 'No Status', 'ccType' => $ccType, 'ccNumber' => $ccNumber, 'ccCode' => $ccCode, 'ccExpiration' => $ccExpiration, 'ccValid' => 'True');
	$db->autoExecute('customer', $data, DB_AUTOQUERY_INSERT);
	// get the customer Id
	$customer_query =& $db->query("SELECT customerId FROM customer WHERE customerName ='".$user."'", array());
	$row = array();
	while ( $customer_query->fetchInto( $row ) ) {
			$customerId = $row['customerId'];
	}
	$customer_query->free();
	
	// Use PEAR DB to insert data into myqueue table
	$data = array('myqueueName' => $user);
	$db->autoExecute('myqueue', $data, DB_AUTOQUERY_INSERT);
	// get the myqueue Id
	$myqueue_query =& $db->query("SELECT myqueueId FROM myqueue WHERE myqueueName ='".$user."'", array());
	$myqueue_row = array();
	while ( $myqueue_query->fetchInto( $myqueue_row ) ) {
			$myqueueId = $myqueue_row['myqueueId'];
	}
	$myqueue_query->free();

	
//	session_commit();
	// Add a new user:
	$auth->addUser($user, $password, array('firstName' => $firstName, 'lastName' => $lastName, 'userEmail' => $userEmail,
		'userStatus' => 'Approved', 'phoneNumber' => $phoneNumber, 'memberDOB' => '', 'customerId' => $customerId,
		'myqueueId' => $myqueueId, 'securityQuestion' => $securityQuestion, 'securityAnswer' => $securityAnswer,
		'membershipPlan' => $membershipPlan));

//		header("Location: ../gw/Members.php");

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<meta http-equiv="imagetoolbar" content="no" />
		<meta http-equiv="imagetoolbar" content="false" />
		<title>Gullywood Online :: Register</title>
		<script src="../includes/ajax.js" type="text/javascript" language="javascript"></script>		
		<script src="../includes/checkusername.js" type="text/javascript" language="javascript"></script>		
		<script src="../includes/checkusrform.js" type="text/javascript" language="javascript"></script>		
		<script src="../includes/resolveDate.js" type="text/javascript" language="javascript"></script>		
		<script type="text/javascript">
		<!--

		function  formValidatorStep1(){
		// Make quick references to our fields
				var username = document.getElementById('rgUsername');
				var email = document.getElementById('rgEmail');
				var confirmEmail = document.getElementById('rgConfirmEmail');
				var password = document.getElementById('rgPassword');
				var confirmPassword = document.getElementById('rgConfirmPassword');
				var securityQuestion = document.getElementById('rgSecurityQuestion');
				var securityAnswer = document.getElementById('rgSecurityAnswer');
				var step1 = document.getElementById('rgStep1');
				var step2 = document.getElementById('rgStep2');
				var terms = document.getElementById('chxTermsOfUse');
				// Check the browser type - This is to show or hide the DIVs";
				var browserType;
				if (document.layers) {browserType = "nn4"}
				if (document.all) {browserType = "ie"}
				if (window.navigator.userAgent.toLowerCase().match("gecko"))
				{
			   		browserType= "gecko"
				}
	
				// Check each input in the order that it appears in the form!
				if(lengthRestriction(username, 6, 20, "Username must be 6 to 20 characters long.\n")){
					if(emailValidator(email, "Please enter a valid email address.\n")){
						if(isEmailMatch(confirmEmail, "Email addresses do not match.\n")){
							if(lengthRestriction(password, 6, 20, "Passwords must be 6 to 20 characters.\n")){
								if(isPasswordMatch(confirmPassword, "Passwords do not match.\n")){
									if(madeSelection(securityQuestion, "Please select a question.\n")){
			//							if(isTOUChecked(terms, "Please read Terms Of Use, & check this box.\n")){
											hideVisibility(rgStep1);
											showVisibility(rgStep2);
											return true;
			//							}
									}
								}	
							}
						}
					}
				}
			return false;
		}

		function formValidatorStep2(){
		// Make quick references to our fields
			var fName = document.getElementById('rgFirstName');
			var lName = document.getElementById('rgLastName');
			var homePhone = document.getElementById('rgPhoneNumber');
			var birthMonth = document.getElementById('rgBirthMonth');
			var birthDay = document.getElementById('rgBirthDay');
			var birthYear = document.getElementById('rgBirthYear');
			var membership = document.getElementById('rgMembership');
			var mailingAddress = document.getElementById('rgMailingAddress');
			var mailingCity = document.getElementById('rgMailingCity');
			var mailingState = document.getElementById('rgMailingState');
			var mailingZipCode = document.getElementById('rgMailingZipCode');
			var creditCardType = document.getElementById('rgCreditCardType');
			var creditCardNumber = document.getElementById('rgCreditCardNumber');
			var creditCardExpirationDate = document.getElementById('rgCreditCardExpirationDate');
			var creditCardCVV2 = document.getElementById('rgCreditCardCVV2');
			// Check each input in the order that it appears in the form!
			if(lengthRestriction(fName, 1, 100, "First Name cannot be empty.\n")){
				if(isEmpty(lName, "Last Name cannot be empty.\n")){
					if(isEmpty(homePhone, "Phone number cannot be empty.\n")){
						if(madeSelection(birthMonth, "Please choose a month below.\n")){
	//						if(madeSelection(birthDay, "Please choose a date below.\n")){
								if(madeSelection(birthYear, "Please choose a year below.\n")){
									if(madeSelection(membership, "Please select membership below.\n")){
										if(isEmpty(mailingAddress, "Your address cannot be empty.\n")){
											if(isEmpty(mailingCity, "Please type in the name of your city.\n")){
												if(madeSelection(mailingState, "Please select a state.\n")){
													if(isEmpty(mailingZipCode, "Your zip code cannot be empty.\n")){
														if(madeSelection(creditCardType, "Please select a Credit Card.\n")){
															if(isEmpty(creditCardNumber, "Please enter your Credit Card Number.\n")){
																if(isEmpty(creditCardExpirationDate, "Enter Credit Card expiration date.\n")){
																	if(isEmpty(creditCardCVV2, "Enter CVV2 code.\n")){
																		return true;
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
	//						}
						}
					}
				}
			}	
			return false;
		}		

		function showVisibility(me){
			me.style.visibility="visible";
		}

		function hideVisibility(me){
			me.style.visibility="hidden";
		}

		function sameAddress(){
			if (this.checked) {
				document.getElementById('rgBillingAddress').disabled=true;
				document.getElementById('rgBillingCity').disabled=true;
				document.getElementById('rgBillingState').disabled=true;
				document.getElementById('rgBillingZipCode').disabled=true;
			}
		}

		function isEmpty(elem, helperMsg){
			if(elem.value.length == 0){
				alert(helperMsg);
				elem.focus(); // set the focus to this input
				return false;
			}
			return true;
		}

		function isEmailMatch(elem, helperMsg){
			if(elem.value.match(document.LoginForm.rgEmail.value)){
				return true;
			}else{
				alert(helperMsg);
				elem.focus();
				return false;
			}
		}

		function isPasswordMatch(elem, helperMsg){
			if(elem.value.match(document.LoginForm.rgPassword.value)){
				return true;
			}else{
				alert(helperMsg);
				elem.focus();
				return false;
			}
		}

		function lengthRestriction(elem, min, max, helperMsg){
			var uInput = elem.value;
			if(uInput.length >= min && uInput.length <= max){
				return true;
			}else{
		//		alert(\Please enter between " +min+ " and " +max+ " characters");
				alert(helperMsg);
				elem.focus();
				return false;
			}
		}

		function madeSelection(elem, helperMsg){
			if(elem.value == ""){
				alert(helperMsg);
				elem.focus();
				return false;
			}else{
				return true;
			}
		}

function emailValidator(elem, helperMsg){
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(elem.value.match(emailExp)){
		return true;
	}else{
		alert(helperMsg);
		elem.focus();
		return false;
	}
}
function isTOUChecked(elem, helperMsg){
	var user_input = "";
	user_input = elem.checked;

	if(user_input) {
	document.getElementById(rgCheckBox).checked = true;

//	if(!document.LoginForm.rgCheckBox.checked)
		return true;
	}else{
		alert(helperMsg);
		elem.focus();
		return false;
	}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_showHideLayers() { //v6.0";
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}

document.onkeydown = keyHit;

function keyHit(evt) {
	evt = (evt) ? evt : event;
/*	var hitEnter = 13;
	var macEnter = 3;*/
	var thisKey = (evt) ? evt.which : window.event.keyCode;

	if (thisKey == hitEnter || thisKey == macEnter)
	{
		return formValidatorStep1();
		//return true;
	} else {
		return false;
	}
	return false;
}

-->
</script>		


		<link href="../css/basic.css" rel="stylesheet" type="text/css" media="all" />
		<style type="text/css" media="screen"><!--
			#rgStep1 { background-image: url(http://www.gullywood.com/images/signin.jpg); height: 486px; width: 611px; left: 19px; top: 124px; position: absolute; visibility: visible; }
			#footer { height: 67px; width: 540px; left: 250px; top: 780px; position: absolute; visibility: visible; }
			#userinfo { height: 28px; width: 210px; left: 740px; top: 75px; position: absolute; visibility: visible; }
			#mainmenu { height: 48px; width: 500px; left: 450px; top: 88px; position: absolute; z-index: 1; visibility: visible; }
			#idxSearch { height: 37px; width: 360px; left: 20px; top: 101px; position: absolute; visibility: visible; }
			textarea { width: 372px; margin-left: 30px; }
			#rgStep2 { background-image: url(http://www.gullywood.com/images/signin.jpg); height: 550px; width: 611px; left: 19px; top: 124px; position: absolute; visibility: hidden; }
--></style>
		<meta name="keywords" content="African DVD, African DVD Rental, African Movies, African Netflix, Caribbean Movies, Caribbean Movie Rental, Diaspora movies, Gullywood, Ghana Films, Ghanaian Films, Ghanaian Movies, Kenyan Films, Kenyan Movies, Nigerian Films, Nigerian Movies, Nollywood, Senegalese Films, Senegalese Movies, South African Films, south African Movies, tribal, Witchcraft movies, Yoruba" />
	</head>

	<body leftmargin="0" marginheight="0" marginwidth="0" topmargin="0">
		
		<img src="http://www.gullywood.com/images/bannermenubar.jpg" livesrc="../images/bannermenubar.psd" alt="" width="100%" height="124" border="0" />
		<div id="userinfo">
			<label for="usrinfoSignIn" class="usrinfoSignIn"><a href="/index.php">Home</a></label>
			<label for="usrinfoSlashes" class="usrinfoSlashes">|</label>
			<label for="usrinfoSignIn" class="usrinfoSignIn"><a href="/gw/Login.html">Sign In</a></label>
			<label for="usrinfoSlashes" class="usrinfoSlashes">|</label>
			<label for="usrinfoMyAccount" class="usrinfoMyAccount"><a href="/gw/MyAccount.html">My Account</a></label></div>
		<div id="mainmenu">
			<ul>
				<li><a href="http://www.gullywood.com/gw/Browse.html">Browse DVDs</a></li>
				<li><a href="http://www.gullywood.com/gw/Plans.html">Plans &amp; Prices</a></li>
				<li><a href="http://www.gullywood.com/gw/Testimonials.html">Testimonials</a></li>
				<li><a href="http://www.gullywood.com/gw/Queue.html">Queue</a></li>
				<li><a href="http://www.gullywood.com/gw/Help.html">Help</a></li>
			</ul>
		</div>
		<?php
			// Start the registration
			$auth->start();
		?>		
		<div id="footer">
			<ul>
				<li><a href="http://www.gullywood.com/gw/About.html">About Us</a></li>
				<li><a href="http://www.gullywood.com/gw/TermsOfUse.html">Terms of Use</a></li>
				<li><a href="http://www.gullywood.com/gw/PrivacyPolicy.html">Privacy Policy</a></li>
				<li><a href="http://www.gullywood.com/gw/Contact.html">Contact Us</a></li>
				<li><a href="http://www.gullywood.com/gw/News.html">Media Center</a></li>
				<div class="copyright">Copyright © 2007 Gullywood Enterprise. All rights reserved.</div>
			</ul>
		</div>
		<div id="idxSearch">
			<form id="idxSearchForm" action="(EmptyReference!)" method="get" name="idxSearchForm">
				<label for="q">Search</label>
				<input type="search" placeholder = "Movie, Actor, Country, Director" autosave="com.domain.search" results="10" name="q" size="36" />
			</form>
		</div>
		<input type="hidden" name="hiddenRegister" value="hiddenRegister" />
	</body>

</html>