
<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = "solon";
    $password = "solon123";

    if ($_POST['username'] == $username && $_POST['password'] == $password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php"); // Redirect to dashboard
        exit;
    } else {
        echo '<!DOCTYPE html>';
        echo '<html>';
        echo '<head>';
        echo '<link rel="stylesheet" href="style.css">';
        echo '<title>Pantanir</title>';
        echo '</head>';
        echo '<body>';
        echo "<h1>Invalid username or password</h1>";
        echo '<h3><a href="index.php" class="logo">PIZZAHÚSIÐ</a></h3>';
        echo '</body>';
        echo '</html>';
    }
}
?>
