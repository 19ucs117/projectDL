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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOYOLA DIGITAL LIBRARY</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://iqac.loyolacollege.edu/academic/assets/img/favicon.png">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="dashforge-iso.css">
    <script src="fontawesome.js"></script> 
    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelector('#search-toggle').onclick = showDiv;
      function showDiv() {
        if (document.querySelector('#search-toggle').onclick) {
          var a = document.querySelector('.bg-text').style.display = "block";
          if (a) {
            b = document.querySelector('#search-toggle').innerHTML="&#10005;&nbsp;Close";
            document.querySelector('.bg-image').style.filter = "blur(8px)";
            document.querySelector('.bg-image').style.webkitFilter = "blur(8px)";

          }
          if (b) {

            document.querySelector('#search-toggle').onclick=function close() {
              document.querySelector('.bg-text').style.display = "none";
              document.querySelector('#search-toggle').innerHTML="Login";
              window.location.reload()
            };
          }
        }
      }
    });
    function hover(x) {
      x.style['background-color']="#202020"
    }
    function outhover(x) {
      x.style="unset !important"
    }
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-N7ZGZZF5B1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-N7ZGZZF5B1');
    </script>
  </head>
  <body>
    <nav class="main-nav">
      <ul class="menu">
        <li style="float: left">
          <a href="https://www.loyolacollege.edu/" class="" rel="home" id="header--wordmark">
            <div class="logo" style="height: 50px;overflow: hidden;justify-content: space-around; width: 400px;margin-left: -75px;margin-top: -15px;padding: 0;background-color: #002567">
              <center>
              <img style="height: 50px !important;display: inline-block; width: auto !important;" src="logo.jpg" alt="logo image missing">
              <label style="display: inline-block;margin-top: 15px;" for="img">LOYOLA DIGITAL LIBRARY</label>
              </CENTER>
            </div>
          </a>
        </li>
        <!-- <li id="" class="">
          <a href="https://www.loyolacollege.edu/students/accomplishment">Students</a>
        </li>
        <li id="" class="">
          <a href="https://www.loyolacollege.edu/staff/accomplishment">Faculty &amp; Staff</a>
        </li>
        <li id="" class="">
          <a href="https://www.loyolaalumni.org/">Alumni</a>
        </li> -->
        <li onMouseOut="outhover(this)" onMouseOver="hover(this)">
          <a href="#">
            <button id="search-toggle" aria-expanded="true"  value="Login">
              Login
            </button>
          </a>
        </li>
      </ul>
    </nav>
    <div class="bg-image">
      <img class="bg-image" src="image.jpg" width="100%" alt="ravikanth wllpaper.jpg">
    </div>

    <div class="bg-text">
      <div class="bootstrap-iso">
        <div class="container" >
          <div class="row">
            <div class="col-sm-4">
              <div class="wd-100p" >
                <div id="error_alert"></div>
                <center>
                <h3 class="mg-b-5 tx-center" style="color: white; align: center;">Sign In</h3>
                </center>
  
                <div class="input-icons">
                  <form name="myForm" method="post" action="index.php">
                    <div class="form-group">
                      <label align="left" class="tx-light" style="color: white;">User Name</label>

                      <input type="text" class="form-control input-field" placeholder="user name" style="background-color: #21201f;color: white" name="uname" required="">
                    </div>
                    <div class="form-group">
                      <div class="d-flex justify-content-between mg-b-5">
                        <label class="mg-b-0-f" style="color: white;">Password</label>
                        <a href="forget_password" class="tx-13 tx-white">
                          <i class="fas fa-lock"></i>&nbsp;&nbsp;&nbsp;&nbsp; Reset Password
                        </a>
                      </div>

                      <input type="password" name="pswd" autocomplete="off" class="form-control input-field" placeholder="********" style="background-color: #21201f;color: white" required="">&nbsp;
                    </div>
                    <button type="submit" name="commit" class="btn btn-block" style="background-color: #01c8ee;">
                      <span class="tx-bold">Sign In</span>
                    </button>
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
                <p class="tx-16 mg-b-10 tx-center" style="color: white; padding:10px;">
                  For Any Queries: digiallibrary@loyolacollege.edu
                </p>
                <center>
                <div style="padding:10px;background-color: #ffde59;color: #002147;border-radius: 10px;">
                  <b>
                    <svg class="bi bi-bar-chart-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <rect width="4" height="5" x="1" y="10" rx="1"></rect>
                      <rect width="4" height="9" x="6" y="6" rx="1"></rect>
                      <rect width="4" height="14" x="11" y="1" rx="1"></rect>
                    </svg>
                    &nbsp;&nbsp;Today's View Count:&nbsp;:-&nbsp;&nbsp;
                    <?php session_start(); echo $_SESSION['counterNo']; ?>
                  </b>
                </div>
                </center>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
