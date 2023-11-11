<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="css/signup.css?v=<?php echo time();?>">
    <title>Document</title>
</head>
<style>

</style>
<body>
<div class="container">
  <h1>Facility Signup</h1>
  <div class="cards-container">
      <div class="image">
        <img src="images/facility.jpg" alt="">
      </div>
      <div class="form">
        <h1>Sign in account</h1>
<form action="includes/fclt_signup.inc.php" method="post">
<div class="row">
  <div class="col-6">
  <label for="name" class="form-label">Facility Name</label>
    <input class="form-control" type="text" name="name" id="name">
  </div>
  <div class="col-6">
  <label for="pwd" class="form-label">Password</label>
    <input type="password" class="form-control" name="pwd" id="pwd">
  </div>
  <div class="col-6">
  <label for="pwdrepeat" class="form-label">Repeat Password</label>
    <input type="password" name="pwdrepeat" id="pwdrepeat"class="form-control">
  </div>
  <div class="col-6">
  <label for="id" class="form-label">Facility ID</label>
    <input type="text" name="id" id="id"class="form-control">
  </div>
  <div class="col-6">
  <label for="address" class="form-label">Address</label>
  <input type="text" name="address" id="address" class="form-control">
  </div>
  <div class="col-6">
  <label for="facility" class="form-label">Select facility</label>
  <select class="form-select" name="facility" id ="facility" aria-label="Default select example">
        <option selected>Select Facility</option>
        <option value="Birthing Home">Birthing Home</option>
        <option value="Hospital">Hospital</option>
    </select>
  </div>
  <div class="col-6">
  <label for="formFile" class="form-label">Profile Picture</label>
  <input class="form-control" type="file" id="formFile">
</div>
        <div class="alert">
        <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "emptyinput"){
              echo '<div class="alert alert-danger" role="alert">Fill in all fields!</div>';
            }else if($_GET["error"] == "invalidfacilityname"){
              echo '<div class="alert alert-danger" role="alert">Invalid facility Name, try again!</div>';
            }else if($_GET["error"] == "passwordsdontmatch"){
              echo '<div class="alert alert-danger" role="alert">Passowrds does not match!</div>';
            }else if($_GET["error"] == "stmtfailed"){
              echo '<div class="alert alert-danger" role="alert">Something went wrong, try again!</div>';
            }else if($_GET["error"] == "none"){
                header("Location:fclt_login.php");
                exit();
            }
        }
    ?>
</div>
</div>
<center>
  <button class="btn btn-primary" type="submit" name="submit">Sign In</button>
  <a class="btn btn-outline-primary" href="fclt_login.php" role="button">Login</a>
</center>
</form>
</div>
</div>
</div>
</body>
</html>
