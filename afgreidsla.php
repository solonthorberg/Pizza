<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afgreiðsla</title>
</head>
<body>
    <h3><a href="index.php" class="logo">PIZZAHÚSIÐ</a></h3>
</body>
<html>
    <body>
        <table>
        <link rel="stylesheet" href="style.css">
            <tr>
                <td  class="column1">
                <h2>Pöntunin þín</h2>
<?php
session_start();

try {
    $myDBConnection = new PDO('sqlite:C:\\xampp\\htdocs\\PizzaDatabase.db');
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

$totalPrice = 0; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['Size'])) {
        echo "<h4 style=\"color:Tomato;\">Engin stærð valinn</h4>";
        $_SESSION['Sizes'] = "";   
    } else {
        $Size = $_POST['Size']; 
        echo "<p> Þú valdir $Size pizzu. </p><br>";
        $_SESSION['Sizes'] = $Size;
    }

    if (empty($_POST['Alegg'])) {
        echo "<h4 style=\"color:Tomato;\">Ekkert álegg var skráð</h4>";
        $_SESSION['Alegg'] = "";   
    } else {
        $Alegg = $_POST['Alegg']; 
        $_SESSION['Alegg'] = implode(", ", $Alegg);
        $N = count($Alegg);
        echo "<p> Þú valdir $N. álegg á pizzuna þína: </p><br>";
        
        foreach ($Alegg as $key => $value) {
            echo "<p class='bob'>$value</p>" . "<br>";
        }
    }

    if (empty($_POST['Drykkir'])) {
        echo "<h4 style=\"color:Tomato;\">Enginn drykkur valinn</h4>";
        $_SESSION['Drykkir'] = "";   
    } else {
        $Drykkir = $_POST['Drykkir']; 
        $_SESSION['Drykkir'] = implode(", ", $Drykkir);
        $N = count($Drykkir);
        echo "<p> Drykkir valdnir með pöntunni þinni: </p><br>";

        foreach ($Drykkir as $key => $value) {
            echo "<p class='bob'>$value</p>" . "<br>";
        }
    }

    if (empty($_POST['Hvit'])) {
        echo "<h4 style=\"color:Tomato;\">Engin hvítlauksolia valinn</h4>";
        $_SESSION['Hvit'] = "";   
    } else {
        $Hvit = $_POST['Hvit']; 
        $_SESSION['Hvit'] = implode(", ", $Hvit);
        $N = count($Hvit);
        echo "<p> Þú valdir hvítlauksolíu með pöntunninni þinni</p> <br>";
    }

    if (!empty($_POST['Size'])) {
        $query = "SELECT Verd FROM Alegg WHERE Sizes = :size;";
        $stmt = $myDBConnection->prepare($query);
        $stmt->bindParam(':size', $_POST['Size']);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $totalPrice += $row['Verd'];
        }
    }

    if (!empty($_POST['Alegg'])) {
        foreach ($_POST['Alegg'] as $selectedAlegg) {
            $query = "SELECT Verd FROM Alegg WHERE Alegg = :alleg;";
            $stmt = $myDBConnection->prepare($query);
            $stmt->bindParam(':alleg', $selectedAlegg);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $totalPrice += $row['Verd'];
            }
        }
    }

    if (!empty($_POST['Drykkir'])) {
        foreach ($_POST['Drykkir'] as $selectedDrykkir) {
            $query = "SELECT Verd FROM Alegg WHERE Drykkir = :drykk;";
            $stmt = $myDBConnection->prepare($query);
            $stmt->bindParam(':drykk', $selectedDrykkir);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $totalPrice += $row['Verd'];
            }
        }
    }

    if (!empty($_POST['Hvit'])) {
        foreach ($_POST['Hvit'] as $selectedHvit) {
            $query = "SELECT Verd FROM Alegg WHERE Hvitlauksolia = :hvit;";
            $stmt = $myDBConnection->prepare($query);
            $stmt->bindParam(':hvit', $selectedHvit);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $totalPrice += $row['Verd'];
            }
        }
    }

    echo "<h3> Samtals: $totalPrice kr </h3> <br>";
    $_SESSION['totalPrice'] = $totalPrice;
    
    
}
?>
<button><a href="pizzapontun.php" class="buttonlitur"> Breyta pöntun </button></h1>

<body>
<center>
</td>
<td class="column1">
<h2>Þínar upplýsingar</h2>
<link rel="stylesheet" href="style.css">
<form method="post" action="stadfesting.php"> 
    <table class="hagri">
        <tr>
            <td>
                <p>Nafn:</p>
            </td>
            <td><input type="text" name="nafn"></td>
        </tr>
        <tr>
            <td>
                <p>Heimilisfang:</p>
            </td>
            <td><input type="text" name="heimilisfang"></td>
        </tr>
        <tr>
            <td>
                <p>Sími:</p>
            </td>
            <td><input type="text" name="simi"></td>
        </tr>
        <tr>
        <td>
            <p>Afhendingarmáti:</p>
        </td>
        </tr>

        <tr>
            <td>
                <input type="radio" id="heimsent" name="sending" value="Heimsent" checked='checked'>
                <label for="heimsent">Heimsent</label><br>
                <input type="radio" id="sott" name="sending" value="Sótt">
                <label for="sott">Sækja</label><br>
            </td>
        </tr>
    </table>
    <br>
    <input type="submit" value="Staðfesta pöntun">
    <input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>"> <!-- Add hidden input for total price -->
</form>
</center>
</td>
</tr>
</body>
</html>
