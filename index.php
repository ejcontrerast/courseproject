<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
        <title>Library</title>
	<link rel="stylesheet" href="style.css">

</head>
<body>
	<header>
		<div class="main">
			<div class="logo">
                            <a href="index.php"><img src="logo.jpeg"></a>
			</div>
<?php
   session_start();

    if (filter_input (INPUT_COOKIE, 'auth') == session_id()) {
           echo '<ul>
                <li class="active"><a href="index.php">Home</a></li>
                <li ><a href="search.php">Search</a></li>
                <li ><a href="myreservations.php">Reservations</a></li>
                <li ><a href="newreservation.php">Reserve</a></li>
                <li class="logout"><a href="logout.php">LogOut</a></li>
                </ul>';
    } else{
           echo "<ul>"
                    . "<li class='active'><a href='index.php'>Home</a></li>"
                    . "<li class='login'><a href='login.html'>Log In</a></li>"
            . "</ul>";
    }

?>
</div>
	</header>
    <main>
        <div class="title">
            <image id="logosmall" src="books.jpeg">
            <h1>LIBRARY<br>
                <span>reservation</span>
            </h1>
	</div>
    </main>
    
    <footer> 
        <img id="madeby" src="footer.jpeg">
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $(document).ready(() =>{
            $('.login').on('mouseenter', () => {
                $('.login').animate({
                  fontSize: '+=5px'
                },200);
              }).on('mouseleave', () =>{
                $('.login').animate({
                  fontSize: '15px'
                },200);
              });
              
            $('#logosmall').animate({
                top: '-=100px',
                width: '+=100px',
                height: 'auto'
            });
        });
    </script>
</body>
</html>

