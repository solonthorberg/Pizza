<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h3><a href="index.php" class="logo">PIZZAHÚSIÐ</a></h3>
</body>
<body>
<center>
<link rel="stylesheet" href="style.css">

    <h2><center>Login</center></h2>
    <form action="loginin.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <br>
        <input type="submit" value="Login">
    </form>
</center>
</body>
</html>
