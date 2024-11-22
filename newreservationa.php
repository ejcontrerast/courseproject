<?php
session_start();
if((filter_input(INPUT_COOKIE, 'auth') == session_id())){


$server = "localhost";
$suser = "cs213user";
$passcode = "letmein";
$databs = "library";

//check for required fields from the form

//connect to server and select database
$mysqli = mysqli_connect($server, $suser, $passcode, $databs);

//create and issue the query
$targetbookid = filter_input(INPUT_POST, 'bookid');
$targetuserid = $_SESSION['id'];
$targetdate = filter_input(INPUT_POST, 'bookdate');

$checkBook = "SELECT id from books WHERE id = '".$targetbookid."'";
$bookname = "SELECT title from books WHERE id = '".$targetbookid."'";
$userfullname = "SELECT CONCAT(firstname,' ', lastname) As fullname from user WHERE id = '".$targetuserid."'";

$sql = "INSERT INTO reservations (userid, bookid, date) VALUES ('".$targetuserid."','".$targetbookid."','".$targetdate."')";

$checkbookpt2 = mysqli_query($mysqli, $checkBook) or die(mysqli_error($mysqli));
$checknamept2 = mysqli_query($mysqli, $userfullname) or die(mysqli_error($mysqli));
$checkbookname = mysqli_query($mysqli, $bookname) or die(mysqli_error($mysqli));

    if (mysqli_num_rows($checkbookpt2) < 1) {
            echo "<script type='text/javascript'>alert('No Books Found'); "
                    . "document.location='newreservation.php'</script>";
    } else {

    if (mysqli_num_rows($checknamept2) > 0) {
            $nameinfo = mysqli_fetch_array($checknamept2);               
            $usernome = stripslashes($nameinfo['fullname']);
    }
    
    if (mysqli_num_rows($checkbookname) > 0) {

            $bookinfo = mysqli_fetch_array($checkbookname);               
            $booknome = stripslashes($bookinfo['title']);
    }
   
   

    
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
        echo "<script type='text/javascript'>alert('New Reservation Completed'); "
                    . "document.location='newreservation.php'</script>";        
        $mysqlDB->close();
    }   
}

?>
<html>
<head>
<title>New Reservation</title>
</head>
<body>
</body>
</html>
