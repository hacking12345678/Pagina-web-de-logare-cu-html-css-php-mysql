<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="mitm.jpg">
    <title>Crează cont</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
           $fullName = $_POST["fullname"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["repeat_password"];
        
           $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
           if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"Toate cîmpurile:");
           }
           if ($password!==$passwordRepeat) {
            array_push($errors,"Parola nu se potriveste");
           }
           require_once "database.php";
           $sql = "SELECT * FROM users WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"E-mail deja este");
           }
           if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
            array_push($errors,"Parola trebuie să conțină cel puțin o literă");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
        
            $sql = "INSERT INTO users (full_name, email, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>Ai creat cont nou mergi la conectare.</div>";
            }else{
                die("Something went wrong");
            }
           }
        }
        ?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Numele:">
            </div>
            <div class="form-group">
                <input type="emamil" class="form-control" name="email" placeholder="E-mail:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Parola:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repetare Parola:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Crează cont" name="submit">
            </div>
        </form>
        <div>
        <div><a href="index.php">Conectare</a></div>
      </div>
    </div>
</body>
<style>
body{
    background-color: black;
}
.container{
    height: 200px;
    margin-top: 100px;
    width: 300px;
}
.form-group{
    margin-bottom:30px;
    margin-top: 40px;
}
.form-btn{
    text-align: center;
}
.form-group input{
    margin-bottom:30px;
}
a{
    text-decoration: none;
}
a{
    text-align: center;
}
a:hover{
    text-decoration: underline;
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

}
</style>
</html>