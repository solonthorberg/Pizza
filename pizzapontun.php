
<?php

try {
    $myDBConnection = new PDO('sqlite:C:\\xampp\\htdocs\\PizzaDatabase.db');
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

$totalPrice = 0;

?>
<!DOCTYPE html>
<html>
    <body>
    <h3><a href="index.php" class="logo">PIZZAHÚSIÐ</a></h3>
</body>
<head>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="container">
        <div class="form-container">
        <form action="afgreidsla.php" method="post">
    <h3> Stærð </h3>    
    <?php
    $query = "SELECT Id, Sizes, Verd FROM Alegg WHERE Sizes IS NOT NULL;";
    $result = $myDBConnection->query($query);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<input type='radio' id='size_".$row['Id']."' name='Size' value='".$row['Sizes']."' checked='checked'>";
        echo "<label for='size_".$row['Id']."'>".$row['Sizes'] ." - ".  $row['Verd'] .  " kr</label><br>";
        if (isset($_POST['Size']) && $_POST['Size'] == $row['Sizes']) {
            $totalPrice += $row['Verd'];
        }
    }
    ?>

    <h3> Álegg </h3>
    <?php
    $query = "SELECT Id, Alegg, Verd FROM Alegg WHERE Alegg IS NOT NULL;";
    $result = $myDBConnection->query($query);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<input type='checkbox' id='alegg_".$row['Id']."' name='Alegg[]' value='".$row['Alegg']."'>";
        echo "<label for='alegg_".$row['Id']."'>".$row['Alegg'] ." - ".  $row['Verd'] .  " kr</label><br>";
        if (isset($_POST['Alegg']) && in_array($row['Alegg'], $_POST['Alegg'])) {
            $totalPrice += $row['Verd'];
        }
    }
    ?>

<h3> Drykkir </h3>
<?php
$query = "SELECT Id, Drykkir, Verd FROM Alegg WHERE Drykkir IS NOT NULL;"; 
$result = $myDBConnection->query($query);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "<input type='checkbox' id='drykkir_".$row['Id']."' name='Drykkir[]' value='".$row['Drykkir']."'>";
    echo "<label for='drykkir_".$row['Id']."'>".$row['Drykkir'] ." - ".  $row['Verd'] .  " kr</label><br>";
    if (isset($_POST['Drykkir']) && in_array($row['Drykkir'], $_POST['Drykkir'])) {
        $totalPrice += $row['Verd']; 
    }
}
?>

<h3> Olíur </h3>
<?php
$query = "SELECT Id, Hvitlauksolia, Verd FROM Alegg WHERE Hvitlauksolia IS NOT NULL;"; 
$result = $myDBConnection->query($query);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "<input type='checkbox' id='hvit_".$row['Id']."' name='Hvit[]' value='".$row['Hvitlauksolia']."'>";
    echo "<label for='hvit_".$row['Id']."'>".$row['Hvitlauksolia'] ." - ".  $row['Verd'] .  " kr</label><br>";
    if (isset($_POST['Hvit']) && in_array($row['Hvitlauksolia'], $_POST['Hvit'])) {
        $totalPrice += $row['Verd'];
    }
}
?>

    <input type="submit" value="Skoða pöntun">
    <input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>"> 
    
</form>
</div>
        <div class="image-container">
            <img src="img\\cola.png" class="pizza-image3" alt="Supreme Pizza">
            <img src="img\\Supreme_pizza.jpg" class="pizza-image" alt="Supreme Pizza">
            <img src="img\\pizza.jpg" class="pizza-image2" alt="Supreme Pizza">
        </div>
    </div>
</body>
</html>