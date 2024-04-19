<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

$dbFile = 'C:\\xampp\\htdocs\\PizzaDatabase.db';

try {
    $db = new PDO('sqlite:' . $dbFile);
    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $db->prepare('SELECT * FROM Pantanir ORDER BY Id DESC');
    $stmt->execute();
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $db = null;
    
    echo '<!DOCTYPE html>';
    echo '<html>';
    echo '<head>';
    echo '<link rel="stylesheet" href="style.css">';
    echo '<title>Pantanir</title>';
    echo '</head>';
    echo '<body>';
    echo '<h2 class="pp">Pantanir</h2>';
    echo '<table border="1" class="tabbi">';
    echo '<tr><th><p class="los">Id</p></th><th><p class="los">Sizes</p></th><th><p class="los">Alegg</p></th><th><p class="los">Drykkir</p></th><th><p class="los">Hvitlauksolia</p></th><th><p class="los">Nafn</p></th><th><p class="los">Heimilisfang</p></th><th><p class="los">Simi</p></th><th><p class="los">Sending</p></th><th><p class="los">Verd</p></th><th><p class="los">Stada</p></th></tr>';
    foreach ($results as $row) {
        echo '<tr>';
        echo '<td><p>' . $row['Id'] . '</p></td>';
        echo '<td><p>' . $row['Sizes'] . '</p></td>';
        echo '<td><p>' . $row['Alegg'] . '</p></td>';
        echo '<td><p>' . $row['Drykkir'] . '</p></td>';
        echo '<td><p>' . $row['Hvitlauksolia'] . '</p></td>';
        echo '<td><p>' . $row['Nafn'] . '</p></td>';
        echo '<td><p>' . $row['Heimilisfang'] . '</p></td>';
        echo '<td><p>' . $row['Simi'] . '</p></td>';
        echo '<td><p>' . $row['Sending'] . '</p></td>';
        echo '<td><p>' . $row['Verd'] . '</p></td>';
        echo '<td><p>' . $row['Stada'] . '</p></td>';
        echo '<td>';
        echo '<form class="update-form" method="post" action="update_status.php">';
        echo '<input type="hidden" name="id" value="' . $row['Id'] . '">';
        echo '<button type="submit" name="submit">Afgreitt</button>';
        echo '</form>';
        echo '</td>'; 
        echo '</tr>';
    }
    echo '</table>';
    echo '</body>';
    echo '</html>';
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
<html>
<body>
    <h3><a href="index.php" class="logo">PIZZAHÚSIÐ</a></h3>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('.update-form').submit(function(event){
        event.preventDefault();
        var form = $(this);
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            success: function(data){
        
                location.reload();
            },
            error: function(xhr, textStatus, errorThrown){
                console.log('Error:', errorThrown);
            }
        });
    });
});
</script>

</body>
</html>
