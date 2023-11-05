<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="css/login.css?v=<?php echo time();?>">
    <title>Document</title>
</head>
<style>

</style>
<body>
  <div class="container">
  <h1>Facility login</h1>
  <div class="cards-container">
      <div class="image">
        <img src="images/facility.jpg" alt="">
      </div>
      <div class="form">
        <h1>Login in your account</h1>
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
        <form action="includes/fclt_login.inc.php" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Facility ID</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="mb-3">
        <label for="pwd" class="form-label">Password</label>
            <input type="password" class="form-control" name="pwd" id="pwd">
        </div>
        <button class="btn btn-primary" type="submit" name="submit">Login</button>
         <a class="btn btn-primary" href="fclt_signup.php" role="button">Sign Up</a> 
            </form>
            </div>
            </div>
</div>
</body>
</html>
