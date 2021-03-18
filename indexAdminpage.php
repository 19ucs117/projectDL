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
    <style>
      .bottom-grid-item .responsive_iframe{
         min-height: 600px;
      }
    </style>
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
                <a href="#" class="hrefMenu">
                  <img  src="user-icon.png" alt="Workplace" usemap="#workmap" width="80" height="80"/>
                  <map name="workmap">
                    <area shape="circle" coords="40,40,38" alt="ImageFile" id="editProfile" href="editProfile.php" target="right">
                  </map>
                  <br>
                  <span class="user_info" style="padding-bottom: 9px;">
                    <span size="30" style="float: left; color: yellow; font-size: 16px;">
                      <b>
                        <font size="4px">WELCOME</font>
                      </b>
                      <?php session_start(); echo $_SESSION['studName']; ?>
                    </span>
                  </span>

                </a>
              </li>
              <li><a class="herfMenu" href="Home.html" id="Home" target="right">Home</a></li>
              <li class="sub-menu"><a id="Admin">Admin<span class="sub-arrow"></span></a>
                <ul>
                  <li><a class="herfMenu" href="NewUserApproval.html" id="NewUserApproval" target="right">New User Approval</a></li>
                  <li><a class="herfMenu" href="UserUpdate.html" id="UserUpdate" target="right">User Update</a></li>
                  <li><a class="herfMenu" href="UserDelete.html" id="UserDelete" target="right">User Delete</a></li>
                  <li><a class="herfMenu" href="DomainCreation.html" id="DomainCreation" target="right">Domain Creation</a></li>
                  <li><a class="herfMenu" href="DomainUpdate.html" id="DomainUpdate" target="right">Domain Update</a></li>
                  <li><a class="herfMenu" href="CollectionCreation.html" id="CollectionCreation" target="right">Collection Creation</a></li>
                  <li><a class="herfMenu" href="CollectionUpdate.html" id="CollectionUpdate" target="right">Collection Update</a></li>
                  <li><a class="herfMenu" href="NewEntryApproval.html" id="NewEntryApproval" target="right">New Entry Approval</a></li>
                  <li><a class="herfMenu" href="DocumentUpdate.html" id="DocumentUpdate" target="right">Document Update</a></li>
                  <li><a class="herfMenu" href="DocumentDelete.html" id="DocumentDelete" target="right">Document Delete</a></li>
                </ul>
              </li>
              <li class="sub-menu"><a id="NewSubmission">New Submission<span class="sub-arrow"></span></a>
                <ul>
                  <li><a class="herfMenu" href="ResourceSubmission.html" id="ResourceSubmission" target="right">Resource Submission</a></li>
                  <li><a class="herfMenu" href="ResourceEdit.html" id="ResourceEdit" target="right">Resource Edit</a></li>
                </ul>
              </li>
              <li class="sub-menu"><a id="BookSearch">Book Search<span class="sub-arrow"></span></a>
                <ul>
                  <li><a class="herfMenu" href="NewArrivals.html" id="NewArrivals" target="right">New Arrivals</a></li>
                  <li><a class="herfMenu" href="AdvancedSearch.html" id="AdvancedSearch" target="right">Advanced Search</a></li>
                  <li><a class="herfMenu" href="SimpleSearch.html" id="SimpleSearch" target="right">Simple Search</a></li>
                </ul>
              </li>
              <li class="sub-menu"><a id="Journals">Journals<span class="sub-arrow"></span></a>
                <ul>
                  <li><a class="herfMenu" href="JournalsEntry.html" id="JournalsEntry" target="right">Journal Entry</a></li>
                  <li><a class="herfMenu" href="JournalsUpdate.html" id="JournalsUpdate" target="right">Journal Update</a></li>
                  <li><a class="herfMenu" href="JournalSearch.html" id="JournalSearch" target="right">Journal Search</a></li>
                </ul>
              </li>
              <li class="sub-menu"><a id="PublicWebsites">Public Websites<span class="sub-arrow"></span></a>
                <ul>
                  <li><a class="herfMenu" href="PublicWebsitesEntry.html" id="PublicWebsitesEntry" target="right">Public Websites Entry</a></li>
                  <li><a class="herfMenu" href="PublicWebsitesUpdate.html" id="PublicWebsitesUpdate" target="right">Public Websites Update</a></li>
                  <li><a class="herfMenu" href="PublicWebsitesSearch.html" id="PublicWebsitesSearch" target="right">Public Websites Search</a></li>
                </ul>
              </li>
              <li class="sub-menu"><a id="Database">Database<span class="sub-arrow"></span></a>
                <ul>
                  <li><a class="herfMenu" href="DatabaseWebsitesEntry.html" id="DatabaseWebsitesEntry" target="right">Database Websites Entry</a></li>
                  <li><a class="herfMenu" href="DatabaseWebsitesUpdate.html" id="DatabaseWebsitesUpdate" target="right">Database Websites Update</a></li>
                  <li><a class="herfMenu" href="DatabaseSearch.html" id="DatabaseSearch" target="right">Database Search</a></li>
                </ul>
              </li>
              <li><a class="herfMenu" href="logout.php" id="Logout" onclick="return confirm('Do you want to logout ?')">Logout</a></li>
            </ul>
          </nav>

        <div class="bottom-grid-item" align="justify">
          <div class="btn">
            <span id="button" class="fa fa-bars"></span>
          </div>
          <iframe align="justify" class="responsive_iframe" src="Home.html" width="100%" name="right" style="border:0">
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
