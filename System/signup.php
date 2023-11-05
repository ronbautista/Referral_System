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
<body>
<form action="includes/signup.inc.php" method="post">
<h2>Sign Up</h2>
  <div class="mb-3">
    <input class="form-control" type="text" name="name" placeholder="Full Name">
  </div>
  <div class="mb-3">
    <input class="form-control" type="email" name="email" placeholder="Email">
  </div>
  <div class="mb-3">
    <input class="form-control" type="text" name="uid" placeholder="Username">
  </div>
  <div class="mb-3">
    <input type="password" class="form-control" name="pwd" placeholder="Password">
  </div>
  <div class="mb-3">
    <input type="password" name="pwdrepeat" placeholder="Repeat Password" class="form-control">
  </div>
  <div class="mb-3">
    <input type="text" name="id" placeholder="Facility ID" class="form-control">
  </div>
  <center>
    <a class="btn btn-outline-primary" href="login.php" role="button">Login</a>
    <button class="btn btn-outline-primary" type="submit" name="submit">Sign In</button>
 </center>
<br>
        <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "emptyinput"){
                echo '<div class="alert alert-danger" role="alert">Fill in all fields!</div>';
            }else if($_GET["error"] == "invaliduid"){
                echo '<div class="alert alert-danger" role="alert">Choose a proper username!</div>';
            }else if($_GET["error"] == "invalidemail"){
                echo '<div class="alert alert-danger" role="alert">Choose a proper email!</div>';
            }else if($_GET["error"] == "passwordsdontmatch"){
                echo '<div class="alert alert-danger" role="alert">Passowrds does not match!</div>';
            }else if($_GET["error"] == "stmtfailed"){
                echo '<div class="alert alert-danger" role="alert">Something went wrong, try again!</div>';
            }else if($_GET["error"] == "usernametaken"){
                echo '<div class="alert alert-danger" role="alert">Username already taken!</div>'; 
            }else if($_GET["error"] == "none"){
                header("Location:login.php");
                exit();
            }
        }
    ?>
    </form>
    
</body>
</html>
