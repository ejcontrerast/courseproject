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
//$targetbookid = filter_input(INPUT_POST, 'bookid');
$targetuserid = $_SESSION['id'];
//$targetdate = filter_input(INPUT_POST, 'bookdate');


$sql = "SELECT books.TITLE, CONCAT(user.FIRSTNAME,' ',user.LASTNAME) AS FULLNAME, reservations.DATE"
        . " FROM reservations"
        . " INNER JOIN user ON user.ID = reservations.USERID"
        . " INNER JOIN books ON books.ID = reservations.BOOKID"
        . " WHERE user.id = ".$targetuserid." "
        . " ORDER BY reservations.DATE;";

    
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

    if (mysqli_num_rows($result)< 1){
            $displayBlock = "<br><p>Ups! It looks that you don't have reservations yet.<br> "
                    . "Press <a href='newreservation.php'>here</a> to make your first reservation!</p>"
                    ;
    }else {
        $resultstr = "<pre><table>";
        $resultstr .="<tr><th>Book</th><th>Reserved By</th><th>Date</th>";
        
        while($row=mysqli_fetch_array($result)) {
        $resultstr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>",
                                $row["TITLE"],$row["FULLNAME"],
                                $row["DATE"]);
        }
        $resultstr .= "</table></pre>";
        $resultstr;
    }
?>

<html>
<head>
    <meta charset="UTF-8">
        <title>Reservations</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
		<div class="main">
			<div class="logo">
				<a href="index.php"><img src="logo.jpeg"></a>
			</div>
			<ul>
                            <li ><a href="index.php">Home</a></li>
                            <li ><a href="search.php">Search</a></li>
                            <li class="active"><a href="myreservations.php">Reservations</a></li>
                            <li ><a href="newreservation.php">Reserve</a></li>
                            <li class="logout"><a href="logout.php">LogOut</a></li>
			</ul>
		</div>
        </header>
    <main>
            
           <div class="maincontent">
            <p>Here you can see your reservations anytime.<p>
            <?php
                    echo $displayBlock;
            ?>
           <br>
           
           </div>
           <div class="query">
                <?php
                    echo $resultstr;
                ?>
           </div>
    </main>
    <footer> 
        <img id="madeby" src="footer.jpeg">
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $(document).ready(() =>{
            $('.logout').on('mouseenter', () => {
                $('.logout').animate({
                  fontSize: '+=5px'
                },200);
              }).on('mouseleave', () =>{
                $('.logout').animate({
                  fontSize: '-=5px'
                },200);
              });
             
        });
    </script>
</body>
</html>

<?php
    
    $mysqlDB->close();
} else {
	//redirect back to login form if not authorized
	header("Location: login.html");
	exit;
}
?>

