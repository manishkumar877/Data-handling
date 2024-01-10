<?php
// Initialize variables to null.
$f_nameError ="";
$l_nameError ="";
$genderError ="";
$interestError ="";
// On submitting form below function will execute.
if(isset($_POST['submit'])){
if (empty($_POST[" f_name"])) {
$nameError = " First Name is required";
} else {
$name = test_input($_POST["f_name"]);
// check name only contains letters and whitespace
if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
$nameError = "Only letters and white space allowed";
}
}
if (empty($_POST[" l_name"])) {
$nameError = " Last Name is required";
} else {
$name = test_input($_POST["l_name"]);
// check name only contains letters and whitespace
if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
$nameError = "Only letters and white space allowed";
}
}

if (empty($_POST["gender"])) {
$genderError = "Gender is required";
} else {
$gender = test_input($_POST["gender"]);
}
}

if (empty($_POST["interest"])) {
$genderError = "Interest is required";
} else {
$gender = test_input($_POST["interest"]);
}
}
function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
//php code ends here
?>