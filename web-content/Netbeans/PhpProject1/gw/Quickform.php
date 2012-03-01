<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>QuickForm</title>
</head>
<body>
<?php # Script 12.4 - quickform.php
require_once ('../includes/app_top.php');

/*	This page creates a registration form.
 *	This page requires the PEAR HTML_QuickForm package.
 *	This version adds a filter and validation rules.
 */
 
// Include the class definition:
require_once ('HTML/QuickForm.php');

// Create the form object:
$form = new HTML_QuickForm();

// Add a header:
$form->addElement('header', NULL, 'Registration Form');

$form->addElement('text', 'user_name', 'Enter a Username: ');
// Ask for an email address:
$form->addElement('text', 'email', 'Enter Email: ', array('size' => 30, 'maxlength' => 100));
//$form->addElement('text', 'email', 'Confirm Email: ', array('size' => 30, 'maxlength' => 100));

//$form->addElement('text', 'last_name', 'Last Name: ');


// Ask for a password:
$form->addElement('password', 'pass1', 'Password: ');
$form->addElement('password', 'pass2', 'Confirm Password: ');

// Ask for the person's name:
$form->addElement('select', 'salutation', 'Salutation: ',  array(
	'Mr.' => 'Mr.', 
	'Miss' => 'Miss', 
	'Mrs.' => 'Mrs.', 
	'Dr.' => 'Dr.')
);

// Add the submit button:
$form->addElement('submit', 'submit', 'Register!');

// Apply the filter:
$form->applyFilter('__ALL__', 'trim');

// Add the rules:
$form->addRule('user_name', 'Please enter your Username.', 'required', NULL, 'client');
$form->addRule('last_name', 'Please enter your last name.', 'required', NULL, 'client');
$form->addRule('email', 'Please enter your email address.', 'email', NULL, 'client');
$form->addRule('pass1', 'Please enter a password.', 'required', NULL, 'client');
$form->addRule(array('pass1', 'pass2'), 'Please make sure the two passwords are the same.', 'compare', NULL, 'client');

// Display the form:
$form->display();

// Delete the object:
unset($form);
?>
</body>
</html>
