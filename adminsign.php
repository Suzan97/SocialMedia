<html>
    <head>
        <title>Tukutane</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <script type="text/javascript" href="js/text.js"></script>
        <link rel="shortcut icon" href="css/Images/hoe1.png" type="image/x-icon">
        </head>
        <body>
            <div class="loginbox">
                <img src="css/Images/avatar.png" class="avatar">
                <h1>Login</h1>
                <form method="POST" action="adminverify.php" >
                    <p>Admin name</p>
                    <input type="text" name="adminname" placeholder="Enter admin name" required pattern="[a-z]{1,15}"title="Admin name should only contain lowercase letters. ">
                    <p>Password</p>
                    <input type="password" name="password" placeholder="Enter password" >
                    <input type="submit" name=""  value="Login">


                </form>
            </div>
        </body>
</html>
