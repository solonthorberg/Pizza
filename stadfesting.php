<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pöntun hefur verið send inn!</title>
</head>
<body>

<center>
  <h2 class="h22">Komið!</h2>
  <link rel="stylesheet" href="style.css">
  <table>
    <tr>
        
      <td><p>Nafn:</p></td> 
      <td>
        <?php 
        if (empty($_POST["nafn"])) {
           echo "<h4 style=\"color:Tomato;\">Ekkert nafn skráð</h4>";
           $_nafn = "";
        } else {
          $_nafn = $_POST["nafn"]; 
          echo "<p>" . $_POST["nafn"] . "</p>";
        }
        ?>
      </td> 
    </tr>
    <tr>
      <td><p>Heimilisfang:</p></td> 
      <td>
        <?php 
        if (empty($_POST["heimilisfang"])) {
           echo "<h4 style=\"color:Tomato;\">Ekkert heimilisfang skráð</h4>";
           $_heimilisfang = "";
        } else {
          $_heimilisfang = $_POST["heimilisfang"]; 
          echo "<p>" . $_POST["heimilisfang"] . "</p>";
        }
        ?>
      </td> 
    </tr>
    <tr>
      <td><p>Sími:</p></td> 
      <td>
        <?php 
        if (empty($_POST["simi"])) {
           echo "<h4 style=\"color:Tomato;\">Ekkert símanúmer skráð</h4>";
           $_simi = "";
        } else {
          $_simi = $_POST["simi"]; 
          echo "<p>" . $_POST["simi"] . "</p>";
        }
        ?>
      </td> 
    </tr>

    <tr>
      <td><p>Sending:</p></td> 
      <td>
        <?php 
        if (empty($_POST["sending"])) {
           echo "<h4 style=\"color:Tomato;\">Ekkert sendingarval skráð</h4>";
           $_sending = "";
        } else {
          $_sending = $_POST["sending"]; 
          echo "<p>" . $_POST["sending"] . "</p>";
        }
        ?>
      </td> 
    </tr>
  </table>
  <br>
  <h3 class="kom">Pöntun móttekin!</h3>
</center>

<?php
session_start();

$Size2 = $_SESSION['Sizes'];
$Alegg2 = $_SESSION['Alegg'];
$Drykkir2 = $_SESSION['Drykkir'];
$Hvit2 = $_SESSION['Hvit'];
$Verd2 = $_SESSION['totalPrice'];

try {
  $myDBConnection = new PDO('sqlite:C:\\xampp\\htdocs\\PizzaDatabase.db');
  $myDBConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $statement = $myDBConnection->prepare("INSERT INTO Pantanir (Sizes, Alegg, Drykkir, Hvitlauksolia, Nafn, Heimilisfang, Simi, Sending, Verd) VALUES (:Sizes, :Alegg, :Drykkir, :Hvit, :nafn, :heimilisfang, :simi, :sending, :Verd)");

  $statement->bindParam(':Sizes', $Size2);
  $statement->bindParam(':Alegg', $Alegg2);
  $statement->bindParam(':Drykkir', $Drykkir2);
  $statement->bindParam(':Hvit', $Hvit2);
  $statement->bindParam(':nafn', $_nafn);
  $statement->bindParam(':heimilisfang', $_heimilisfang);
  $statement->bindParam(':simi', $_simi);
  $statement->bindParam(':sending', $_sending);
  $statement->bindParam(':Verd', $Verd2);

  $statement->execute();
  if ($_sending == 'Sótt') { 
    echo "<p class='texti'>Pizzan er kominn í ofninn og verður tilbúin eftir 15 mínútur. Þú munt fá sms í eftirfarandi síma $_simi þegar pizzan er tilbúin!</p>";
} else { // Changed colon to curly braces
    echo "<p class='texti'>Þú færð pizzuna heimsenda eftir 45 mín á heimilisfangið þitt: $_heimilisfang</p>";
}
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
?>
</body>
<body>
    <h3><a href="index.php" class="logo">PIZZAHÚSIÐ</a></h3>
</body>
</html>
