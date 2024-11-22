<!DOCTYPE html>
<html>
<head>
	<title>New Account Page</title>
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
                <li class="active"><a href="login.html">Log In</a></li>
            </ul>
        </div>
    </header>
    <main>
        <div class="content">
            <center>
                <form method="POST" action="newaccounta.php">
                    <p>Create New Account</p>
                    <input type="text" id="newuser" name="newuser" placeholder="username" required><br>
                    <input type="password" id="newpass" name="newpass" placeholder="password" required><br>
                    <input type="email" id="email" name="email" placeholder="email" required><br>
                    <input type="text" id="fname" name="fname" placeholder="First Name" required><br>
                    <input type="text" id="lname" name="lname" placeholder="Last Name" required><br>
                    <button type="submit" id="btn" name="submit">Create Account</button>
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
