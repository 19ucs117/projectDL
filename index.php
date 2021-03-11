<?php
session_start();
require_once 'config.php';
$counter = 1;

if (isset($_POST['uname']) && isset($_POST['pswd'])) {

  $sql = "SELECT username, password FROM student WHERE UserName=:fname AND Password=:fpass";
  $query = $pdo->prepare($sql);
  $query->execute(array(':fname' => $_POST['uname'],':fpass' => $_POST['pswd'] ));
  $row = $query->fetch(PDO::FETCH_ASSOC);

  if($row != false || $row != ''){
    $adminUserName = strtolower($_POST['uname']);
    if ($adminUserName == 'admin') {      
      $_SESSION['success'] = "success";
      $_SESSION['account'] = $row['UserName'];
      $_SESSION['uname'] = $_POST['uname'];
      header("location: indexAdminpage.php");
      return;
    }

    else{
      
      $_SESSION['success'] = "success";
      $_SESSION['account'] = $row['UserName'];
      $_SESSION['uname'] = $_POST['uname'];
      header("location: indexpage.php");
      return;
    }

  }
  else {
    $error = "<center><b><font color=#002567>Invalid userName or password</font></b></center>";
    $_SESSION['error'] = $error;
    $counter = 0;
  }

}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="shortcut icon" type="image/x-icon" href="https://iqac.loyolacollege.edu/academic/assets/img/favicon.png">
    <title>Loyola Digital Library</title>
    <script type="text/javascript" src="gs://projectdl-2c51c.appspot.com"></script>
    <link rel="stylesheet" href="index_page.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=G-N7ZGZZF5B1"></script>

<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());

  gtag('config', 'G-N7ZGZZF5B1');

</script>
    <a href="#">
      <img src="loyola_icon.png" alt="hpage">
    </a>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  </head>
  <body>
    <div class="login">
      <h1>Digital Library Login Page</h1>
      <form name="myForm" action="index.php" method="POST">
        <p>Username: <input type="text" name="uname" value=""></p>
        <p>Password: <input type="password" name="pswd" value=""></p>
        <p align="center"><input type="submit" id="submit" value="Login"></p>
      </form>
      <div class="error">
        <?php
        if ($counter==0) {
          echo "<br>";
          echo ($_SESSION['error']);
        }
        ?>
      </div>
    </div>
    

    <div class="login-help">      
      <p>Forgot your password? <a href="reset.html">Click here to reset it</a>.</p>
    </div>
    
     </body>

</html>
