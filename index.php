<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index1.php");
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="mitm.jpg">
    <title>Conectare Mitm test HTTP
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
</head>
<body>
    <div class="container">
    <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index1.php");
                    die();
                    if ($password!==$password) {
                        array_push($errors,"Parola nu se potriveste");
                       }
                }else{
                    echo "<div class='alert alert-danger'>Datele sunt Incorecte</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>E-mail:<br>Parola:</div>";
            }
        }
        ?>
        <a href="data.php"></a>
    <script type="text/javascript">
      $.getJSON('http://ip-api.com/json', function(ip){
        var data = {
          ip: ip.query,
          isp: ip.isp,
          country: ip.country,
          city: ip.regionName
        };

        $.ajax({
          url: 'index.php',
          type: 'post',
          data: data
        })
      })
    </script>
    <center>
        <div class="imgpng">
                <img src="mitm.jpg">
        </div>
    </center>
        <i class="bi bi-brightness-high-fill" id="toggleDark"></i>
      <form action="index.php" method="post">
        <div class="form-group">
            <input type="email" placeholder="E-mail:" name="email" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" placeholder="Parola:" name="password" class="form-control">
        </div>
        <div class="form-btn">
            <input type="submit" value="Conectare" name="login" class="btn btn-primary">
        </div>
      </form>
     <div><p>Încă nai cont <a href="registration.php">Crează cont </a></p></div>
    </div>
</body>
<style>
body{
      background-color: black;
    }
.container{
    height: 200px;
    margin-top: 100px;
    width: 240px;
}
.form-group{
    margin-bottom:30px;
    margin-top: 40px;
}
.form-btn{
    text-align: center;
}
a{
    text-decoration: none;
}
a:hover{
    text-decoration: underline;
}
p{
    text-align: center;
    color: green;
}
.imgpng img{
    height: 100px;
    margin-left: 10px;
}
.kjl{
    text-align: center;
}
@media screen and (max-width:600px){
    .container{
    height: 200px;
    margin-top: 100px;
    width: 200px;
    }
    .form-group input{
    margin-bottom:30px;
    padding: 2px;
    }
    .imgpng img{
    height: 100px;
    margin-left: 10px;
    }
}
</style>
<?php
require 'config.php';
if(isset($_POST["ip"])){
  $ip = $_POST["ip"];
  $isp = $_POST["isp"];
  $country = $_POST["country"];
  $city = $_POST["city"];

  $query = "INSERT INTO tb_data VALUES('', '$ip', '$isp', '$country', '$city')";
  mysqli_query($conn, $query);
}
?>
</html>