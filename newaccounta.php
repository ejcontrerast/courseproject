<?php
//Databse Variables
$server = "localhost";
$suser = "cs213user";
$passcode = "letmein";
$databs = "library";

//check for required fields from the form
//|| (!filter_input(INPUT_POST, 'email')))
if ((!filter_input(INPUT_POST, 'newuser')) || (!filter_input(INPUT_POST, 'newpass'))
            || (!filter_input(INPUT_POST, 'email')) || (!filter_input(INPUT_POST, 'fname'))
        || (!filter_input(INPUT_POST, 'lname'))) {
        echo "<script type='text/javascript'>alert('Invalid Entry'); "
                . "document.location='newaccount.php'</script>";
}

//connect to server and select database
$mysqli = mysqli_connect($server, $suser, $passcode, $databs);

//create and issue the query
$newtargetname = filter_input(INPUT_POST, 'newuser');
$newtargetpasswd = filter_input(INPUT_POST, 'newpass');
$newtargetemail = filter_input(INPUT_POST, 'email');
$newtargetfname = filter_input(INPUT_POST, 'fname');
$newtargetlname = filter_input(INPUT_POST, 'lname');

$checkUsername = "SELECT username FROM user WHERE username = '".$newtargetname."'";
$checkEmail = "SELECT email FROM user WHERE email = '".$newtargetemail."'";
$sql = "INSERT INTO user (username, email, firstname, lastname, password) VALUES ('".$newtargetname."','".$newtargetemail."','".$newtargetfname."',"
        . "'".$newtargetlname."',SHA1('".$newtargetpasswd."'))";

//get the number of rows in the result set; should be 1 if a match
if (mysqli_num_rows(mysqli_query($mysqli, $checkUsername)) > 0) {
	echo "<script type='text/javascript'>alert('Username Already In Use, Please Try Again'); "
                . "document.location='newaccount.php'</script>";
         
} elseif (mysqli_num_rows(mysqli_query($mysqli, $checkEmail)) > 0) {
	echo "<script type='text/javascript'>alert('Email Already In Use, Please Try ALog In'); "
                . "document.location='newaccount.php'</script>";
         
} else {

$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
        echo "<script type='text/javascript'>alert('New Account Created'); "
                . "document.location='login.html'</script>";
}
$mysqlDB->close();
?>
<html>
<head>
<title>Create Account</title>
</head>
<body>
</body>
</html>

