<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {

        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        
        $dbFile = 'C:\\xampp\\htdocs\\PizzaDatabase.db';
        try {
            $db = new PDO('sqlite:' . $dbFile);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        
            $stmt = $db->prepare("UPDATE Pantanir SET Stada = 'Afgreitt' WHERE Id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            
            $db = null;
            
            
            echo "Update successful";
        } catch (PDOException $e) {
            echo "Update failed: " . $e->getMessage();
        }
    } else {
        echo "ID not set";
    }
} else {
    echo '<link rel="stylesheet" href="style.css">';
    echo "<h2>Invalid request method</h2>";
}
?>
