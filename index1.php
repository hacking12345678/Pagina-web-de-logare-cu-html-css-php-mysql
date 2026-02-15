<!DOCTYPE html>
<html lang="ro">
<meta charset="UTP-8">
<head>
    <title>MITM</title>
    <link rel="icon" href="mitm.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d3dbf71096.js" crossorigin="anonymous"></script>
</head>
<html>
<body>
<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
                    <li><a href="logout.php">Iesire</a></li>
</body>
<?php
      require 'database.php';
      $rows = mysqli_query($conn, "SELECT * FROM users");
      ?>
       <?php foreach($rows as $row) : ?>
        <h1>Visitor <?php echo $row["id"]; ?></h1>
<?php endforeach; ?>body>
<style>
    body{
        background-color: #000000;
    }
</style>
</html>