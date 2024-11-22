<?php 
session_start();

//Databse Variables
$server = "localhost";
$suser = "cs213user";
$passcode = "letmein";
$databs = "library";


//check for required fields from the form
if ((!filter_input(INPUT_POST, 'username')) || (!filter_input(INPUT_POST, 'password'))) {
	header("Location: login.html");
	exit;
}

//connect to server and select database
$mysqli = mysqli_connect($server, $suser, $passcode, $databs);

//create and issue the query
$targetname = filter_input(INPUT_POST, 'username');
$targetpasswd = filter_input(INPUT_POST, 'password');

$sql = "SELECT * FROM user WHERE username = '".$targetname.
        "' AND password = SHA1('".$targetpasswd."')";

$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

//get the number of rows in the result set; should be 1 if a match
if (mysqli_num_rows($result) == 1) {

	//if authorized, get the values of f_name l_name
	
        $info=mysqli_fetch_array($result);        
	$username = stripslashes($info['username']);
	$id = stripslashes($info['id']);
        $fname = stripslashes($info['firstname']);
        $lname = stripslashes($info['lastname']);
        
        $_SESSION['id']=$id;
        $_SESSION['username']=$username;
        $_SESSION['firstname']=$fname;
        $_SESSION['lastname']=$lname; 
        
        echo "<script type='text/javascript'>document.location='search.php'</script>";
	//set authorization cookie using curent Session ID
	setcookie("auth", session_id(), time()+60*30, "/", "", 0);
        header("Location: search.php");
         
} else {
    
        echo "<script type='text/javascript'>alert('Invalid Username or Password!'); "
                . "document.location='login.html'</script>";
	//redirect back to login form if not authorized
	//header("Location: login.html");
	//exit;
}

$mysqlDB->close();
?>
<html>
<head>
<title>User Login</title>
</head>
<body>
</body>
</html>

