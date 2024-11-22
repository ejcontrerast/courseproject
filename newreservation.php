<?php
session_start();

if (filter_input (INPUT_COOKIE, 'auth') == session_id()) {
    
?>

<!DOCTYPE html>
<html>
<head>
	<title>New Reservation Page</title>
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
                <li ><a href="myreservations.php">Reservations</a></li>
                <li class="active"><a href="newreservation.php">Reserve</a></li>
                <li class="logout"><a href="logout.php">LogOut</a></li>
            </ul>
        </div>
    </header>
    <main>
        <div class="content">
            <center>
                <form method="POST" action="newreservationa.php">
                        <p>Reserve a Book</p>
                        <input type="number" id="bookid" name="bookid" required><br>
                        <input type="date" id="bookdate" name="bookdate" required><br>
                        <button type="submit" id="btn" name="submit">Make a Reservation</button>
                </form>
            </center>
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
              
            $('#btn').on('mouseenter', () => {
                $('#btn').animate({
                  fontSize: '+=2px'
                },200);
              }).on('mouseleave', () =>{
                $('#btn').animate({
                  fontSize: '-=2px'
                },200);
              });
        });
    </script>
</body>
</html>

<?php 
} else {
	//redirect back to login form if not authorized
	header("Location: login.html");
	exit;
    }
?>


