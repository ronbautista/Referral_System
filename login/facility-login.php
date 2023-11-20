<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../bootstrap_cdn/bootstrap.min.css">
    <script defer src="../bootstrap_cdn/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/facility-login.css">
    <title>Document</title>
</head>
<style>

</style>
<body>
  <div class="container">
  <h1>Facility login</h1>
  <div class="cards-container">
      <div class="image">
        <img src="../assets/facility.jpg" alt="">
      </div>
      <div class="form">
        <h1>Login in your account</h1>
        <form action="includes/login.inc.php" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Facility ID</label>
            <input type="text" class="form-control" name="uid" id="uid">
        </div>
        <div class="mb-3">
        <label for="pwd" class="form-label">Password</label>
            <input type="password" class="form-control" name="pwd" id="pwd">
        </div>
        <button class="btn btn-primary" type="submit" name="submit">Login</button>
         <a class="btn btn-outline-primary" href="fclt_signup.php" role="button">Sign Up</a> 
        </form>
        </div>
        </div>
</div>
</body>
</html>
