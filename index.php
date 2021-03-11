<?php
session_start();
require_once 'config.php';
$counter = 1;
date_default_timezone_set("Asia/Calcutta");
$TodaysDate = date("Y-m-d");
$sqlCounter = "SELECT * FROM Analytics ORDER BY SNo DESC LIMIT 1";
$queryCounter = $pdo->query($sqlCounter);
$rowCounter = $queryCounter->fetch();
$_SESSION['counterNo'] = $rowCounter['NoOfViews'];
$_SESSION['counterSNo'] = $rowCounter['SNo'];

$sqlCounterZero = "SELECT DATE(Date) as DATE from Analytics WHERE SNO=:countersno";
$queryCounterZero = $pdo->prepare($sqlCounterZero);
$queryCounterZero -> execute(array(':countersno' => $_SESSION['counterSNo'] ));
$rowCounterZero = $queryCounterZero->fetch(PDO::FETCH_ASSOC);
$_SESSION['counterNoZero'] = $rowCounterZero['DATE'];

if (date("Y-m-d")!=$_SESSION['counterNoZero']) {
  $sqlCounterInsert = "INSERT INTO Analytics(Date) VALUES(CONVERT_TZ(CURRENT_TIMESTAMP(), @@global.time_zone, '+05:30'))";
  $pdo->exec($sqlCounterInsert);
  $_SESSION['counterSNo'] = ($rowCounter['SNo'] + 1);
}


if (isset($_POST['uname']) && isset($_POST['pswd'])) {

  $sql = "SELECT username, password FROM student WHERE UserName=:fname AND Password=:fpass";
  $query = $pdo->prepare($sql);
  $query->execute(array(':fname' => $_POST['uname'],':fpass' => $_POST['pswd'] ));
  $row = $query->fetch(PDO::FETCH_ASSOC);

  if($row != false || $row != ''){
    $adminUserName = strtolower($_POST['uname']);
    if ($adminUserName == 'admin') {
      $sqlCounterUpdate = "UPDATE Analytics SET NoOfViews=:noofviews WHERE SNo=:serialNoOfcounter";
      $queryCounterUpdate = $pdo->prepare($sqlCounterUpdate);
      $updatedCounter = $queryCounterUpdate -> execute(array(':noofviews' => ($_SESSION['counterNo']+1), ':serialNoOfcounter' => $_SESSION['counterSNo'] ));

      $_SESSION['success'] = "success";
      $_SESSION['account'] = $row['UserName'];
      $_SESSION['uname'] = $_POST['uname'];
      header("location: indexAdminpage.php");
      return;
    }

    else{
      $sqlCounterUpdate = "UPDATE Analytics SET NoOfViews=:noofviews WHERE SNo=:serialNoOfcounter";
      $queryCounterUpdate = $pdo->prepare($sqlCounterUpdate);
      $updatedCounter = $queryCounterUpdate -> execute(array(':noofviews' => ($_SESSION['counterNo']+1), ':serialNoOfcounter' => $_SESSION['counterSNo'] ));
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
    <center>
    <div style="padding:10px;width: 300px;background-color: #ffde59;color: #002147;border-radius: 10px;">
      <b>
        <svg class="bi bi-bar-chart-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <rect width="4" height="5" x="1" y="10" rx="1"></rect>
          <rect width="4" height="9" x="6" y="6" rx="1"></rect>
          <rect width="4" height="14" x="11" y="1" rx="1"></rect>
        </svg>
        &nbsp;&nbsp;Today's View Count&nbsp;:-&nbsp;&nbsp;
        <?php session_start(); echo $_SESSION['counterNo']; ?>
      </b>
    </div>
    </center>
  </body>

</html>
