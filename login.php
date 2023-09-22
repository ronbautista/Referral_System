<?php
session_start();

if (!isset($_SESSION["first_account"])) {
  header("Location: fclt_login.php"); // Redirect to the login page for the first account
  exit();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="css/login.css?v=<?php echo time();?>">
    <title>Document</title>
</head>
<style>

</style>
<body>

<form action="includes/login.inc.php" method="post">
<h2>STAFF LOGIN</h2>
<div class="mb-3">
    <input type="text" class="form-control" name="uid" placeholder="Facility Name/ID">
  </div>
  <div class="mb-3">
    <input type="password" class="form-control" name="pwd" placeholder="Password">
  </div>
<center>
    <a class="btn btn-outline-primary" href="signup.php" role="button">Sign Up</a>
    <button class="btn btn-outline-primary" type="submit" name="submit">Login</button>
</center>
       <br>

       <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "emptyinput"){
                echo '<div class="alert alert-danger" role="alert">
                Fill in all fields!
              </div> ';
            }else if($_GET["error"] == "wronglogin"){
                echo '<div class="alert alert-danger" role="alert">Incorrect login Information!</div>';
            }
        }
    ?>
    </form>
</body>
</html>
