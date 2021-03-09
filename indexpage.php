<?php
session_start();
if (!$_SESSION['uname']) {
  header("location: index.php");
  return;
}
require_once 'config.php';
$sql = "SELECT * FROM student WHERE UserName=:kname";
$query = $pdo->prepare($sql);
$query->execute(array(':kname' => $_SESSION['uname'] ));
$row = $query->fetch(PDO::FETCH_ASSOC);
$_SESSION['departNum'] = $row['DepartmentNumber'];
$_SESSION['studName'] = $row['Name'];
$_SESSION['studImage'] = $row['Image'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="https://iqac.loyolacollege.edu/academic/assets/img/favicon.png">
    <title>Loyola Digial Library</title>
    <link rel="stylesheet" href="indexpage.css">
    <link rel="stylesheet" href="nav.css">
    <script type="text/javascript" src="jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="nav.js"></script>
    <script type="text/javascript" src="indexpage.js"></script>
    <script src="fontawesome.js"></script>
    <script>
      $(window).on("load",function(){
        $(".loader").fadeOut("slow");
      });
    </script>
  </head>
  <body>
    <iframe class="loader" src="preload.html" width="100%" height="1000px" style="border:0;"></iframe>
    <div class="main">
      <div class="logo">
        <center>
          <div class="logo-inner-image">
            <img style="height: 70%;float:left;" src="logo2.png"  alt="NO IMAGE FOUND">
          </div>
        </center>
          <div class="logo-inner-text">
            <h1 id="content">DIGITAL LIBRARY</h1>
          </div>
      </div>
      <div class="top">
        <div class="top__contents">
          <h1>Digital Library</h1>
          <p class=""><span class="Home">Home</span></p>
        </div>
      </div>
      <div class="bottom-grid">
        <nav class="main-nav">
            <ul class="main-nav-ul">
              <li>
                <a href="#">
                  <center>
                    <img src="<?php session_start(); echo $_SESSION['studImage']; ?>" style="height: auto;max-width: 100%;width: 100px;width: 100px !important;min-height: 100px;height: 100px;border-radius: 50% !important; margin-left:-30px;" alt="Workplace" usemap="#workmap">
                    <map name="workmap">
                      <area shape="circle" coords="50,50,50" alt="ImageFile" id="editProfile" href="editProfile.php" target="right">
                    </map>
                  </center>
                  <div align="center" class="user_info" style="background-color: #FBF702; border-radius: 20px;height: 70px; width: 100%; margin-top:10px;">
                    <span class="user_info">
                      <span size="30" style="float: left; color: black; font-size: 16px;">
                        <b>
                          <font size="4px">WELCOME</font><br>
                        </b>&nbsp;&nbsp; <?php session_start(); echo $_SESSION['studName']; ?>
                      </span>
                      <span style="float: left; color: black; font-size: 16px;">&nbsp;&nbsp;
                        Dept.No:- <?php session_start(); echo $_SESSION['departNum']; ?>
                      </span>
                    </span>
                  </div>
                  <br>
                </a>
              </li>
              <li><a href="Home.html" id="Home" target="right">Home</a></li>
              <li class="sub-menu"><a id="BookSearch">Book Search<span class="sub-arrow"></span></a>
                <ul>
                  <li><a href="AdvancedSearch.html" id="AdvancedSearch" target="right">Advanced Search</a></li>
                  <li><a href="SimpleSearch.html" id="SimpleSearch" target="right">Simple Search</a></li>
                </ul>
              </li>
              <li class="sub-menu"><a id="Journals">Journals<span class="sub-arrow"></span></a>
                <ul>

                  <li><a href="JournalSearch.html" id="JournalSearch" target="right">Journal Search</a></li>

                </ul>
              </li>
              <li class="sub-menu"><a id="PublicWebsites">Public Websites<span class="sub-arrow"></span></a>
                <ul>

                  <li><a href="PublicWebsitesSearch.html" id="PublicWebsitesSearch" target="right">Public Websites Search</a></li>
                </ul>
              </li>
              <li class="sub-menu"><a id="Database">Database<span class="sub-arrow"></span></a>
                <ul>

                  <li><a href="DatabaseSearch.html" id="DatabaseSearch" target="right">Database Search</a></li>
                </ul>
              </li>
              <li><a href="logout.php" id="Logout" onclick="return confirm('Do you want to logout ?')">Logout</a></li>
            </ul>
          </nav>

        <div class="bottom-grid-item" align="justify">
          <div class="btn">
            <span id="button" class="fa fa-bars"></span>
          </div>
          <iframe align="justify" class="responsive_iframe" src="Home.html" width="100%" height="600px" name="right" style="border:0">
          </iframe>
        </div>
      </div>
      <div class="footer">
        <div class="footer__contents">
          <div id="footer_a" class="footer__list">
              <h3>QUICK LINKS</h3>
              <p> Home</p>
              <p> About Us</p>
              <p> Jesuits</p>
              <p> Administration</p>
              <p> Admission</p>
          </div>
          <div id="footer_a" class="footer__list">
              <br />
              <p> Alumni</p>
              <p> Gallery</p>
              <p> News</p>
              <p> Results</p>
              <p> Downloads</p>
          </div>
          <div id="footer_b" class="footer__list">
              <h3>FACILITIES</h3>
              <p> Infrastructure Facilities</p>
              <p> Instructional Facilities</p>
              <p> ICT Facilities</p>
              <p> Library Facilities</p>
              <p> Recreational Facilities</p>
              <p> Additional Facilities</p>
          </div>
          <div id="footer_b" class="footer__list">
              <h3>CONTACT</h3>
              <p>Central Library,</p>
              <p>Loyola College, Pb 3301,</p>
              <p>Sterling Road,</p>
              <p>Nungambakkam,</p>
              <p>Chennai-600034,</p>
              <p>Tel: +91-44-281782000,</p>
              <p>library@loyolacollege.edu.</p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
