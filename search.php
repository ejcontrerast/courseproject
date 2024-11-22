<?php
session_start();

if (filter_input (INPUT_COOKIE, 'auth') == session_id()) {
    $displayBlock = "<h3>Welcome ".$_SESSION['firstname']." ".$_SESSION['lastname']."!</h3>";
        
    $name = $_POST['search'];
    $filter = $_POST['option'];
    
    if($filter==""){
        $filter= "title";
    }
    
    $mysqli = mysqli_connect("localhost", "cs213user", "letmein", "library");
    $sql = "SELECT * FROM books WHERE $filter like '%$name%' ORDER BY id;";
    
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
    
    if (mysqli_num_rows($result)< 1){
        header ("Location: search.php");
        $resultstr = mysqli_query($mysqli, $sql);
        echo $resultstr;
    }
    else {
        $resultstr = '<pre><table class="center">';
        $resultstr .="<tr><th>Book ID</th><th>Title</th><th>Year</th>"
                . "<th>Author</th></tr>";
        
        while($row=mysqli_fetch_array($result)) {
        $resultstr .= sprintf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>",
            $row["id"],
            $row["title"],
            $row["year"],
            $row["author"]);
        }
        $resultstr .= "<table></pre>";
?>

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
            <ul>
                <li ><a href="index.php">Home</a></li>
                <li class="active"><a href="search.php">Search</a></li>
                <li ><a href="myreservations.php">Reservations</a></li>
                <li ><a href="newreservation.php">Reserve</a></li>
                <li class="logout"><a href="logout.php">LogOut</a></li>
            </ul>
        </div>
    </header>
    <main>
        <div class="maincontent">
        <?php
            echo $displayBlock;
        ?>
        <br>
        <form action="search.php" method="POST">
            <select id="option" name="option">
                <option value="">Select an option</option>
                <option value="title">Title</option>
                <option value="author">Author</option>
            </select>
            <input type="text" name="search" width="100px" font-size="14px" placeholder="Search by Title or Author">
            <button id="btn" >Search</button>
        </form>
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
} //else  
    
    $mysqlDB->close();
    } else {
	//redirect back to login form if not authorized
	header("Location: login.html");
	exit;
}
?>