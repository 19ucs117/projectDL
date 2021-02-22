<?php
session_start();
if (!$_SESSION['uname']) {
  header("location: index.php");
  return;
}
require_once 'config.php';
$valid_pass = 0;
$_SESSION['kiln']=$_SESSION['uname'];
$sql = "SELECT * FROM student WHERE UserName=:kname";
$query = $pdo->prepare($sql);
$query->execute(array(':kname' => $_SESSION['uname'] ));
$row = $query->fetch(PDO::FETCH_ASSOC);
$_SESSION['departNumb'] = $row['DepartmentNumber'];
$_SESSION['stdName'] = $row['Name'];
$_SESSION['stdImage'] = $row['Image'];
$_SESSION['stdEmail'] = $row['Email'];
$_SESSION['stdMobile'] = $row['MobileNo'];
$_SESSION['stdPassword'] = $row['Password'];

if (isset($_POST['user_update'])) {
  $newName = $_POST['name'];
  $newEmail = $_POST['email'];
  $newMobile = $_POST['mobile'];
  $sql_user_update = "UPDATE student SET Name=:name, Email=:email, MobileNo=:mobileno WHERE UserName=:DeptUpdated";
  $sql_query_update = $pdo->prepare($sql_user_update);
  $sql_update_execution = $sql_query_update->execute(array(':name' => $newName, ':email' => $newEmail, ':mobileno' => $newMobile, ':DeptUpdated' => $_SESSION['kiln']));


  if ($sql_update_execution) {
    echo '<script>alert("User Details Updated")</script>';
  }
  else {
    echo '<script>alert("User Details Not Updated")</script>';
  }
}

if(isset($_POST['sub'])){
  $newcPassword = $_POST['cpassword'];
  $newPassword = $_POST['password'];
  if($newcPassword == $newPassword) {
    $sql_user_passupdate = "UPDATE student SET Password=:newpasword WHERE UserName=:DeptUpdated";
    $sqlupdate = $pdo->prepare($sql_user_passupdate);
    $sql_update_passexecution = $sqlupdate->execute(array(':newpasword' => $newPassword, ':DeptUpdated' => $_SESSION['kiln']));

    if($sql_update_passexecution){
      echo '<script>alert("Password Updated")</script>';
    }
    else{
      echo '<script>alert("Password Not Updated")</script>';
    }
  }
  else {
    echo '<script>alert("Password does not match")</script>';
  }
}
if(isset($_POST['fsubmit'])) {
  $folder ="upload/";
  $image = $_FILES['fileToUpload']['name'];
  $path = $folder.$image ;
  $target_file = $folder.basename($_FILES["fileToUpload"]["name"]);
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  $allowed = array('jpeg','png' ,'jpg'); $filename=$_FILES['fileToUpload']['name'];
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  if(!in_array($ext,$allowed) ){
    echo "Sorry, only JPG, JPEG, PNG & GIF  files are allowed.";
  }
  else{
    move_uploaded_file( $_FILES['fileToUpload'] ['tmp_name'], $path);
    $sql_image_update = $pdo->prepare("UPDATE student SET Image=:newImg WHERE UserName=:DeptUpdated");
    $sql_update_passexecution = $sql_image_update->execute(array(':newImg' => $image, ':DeptUpdated' => $_SESSION['kiln']));
    $valid_pass = 1;
  }
  if ($valid_pass==1) {
    echo '<script>alert("Image Updated")</script>';
  }
  else {
    echo '<script>alert("Image Not Updated")</script>';
  }

}



?>

<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Required meta tags -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="https://iqac.loyolacollege.edu/academic/assets/img/favicon.png">

    <title>Edit Profile</title>

    <!-- vendor css -->
    <link href="all.min.css" rel="stylesheet">
    <link href="ionicons.min.css" rel="stylesheet">

    <!-- DashForge CSS -->

    <link rel="stylesheet" href="dashforge.css">
    <link rel="stylesheet" href="dashforge.profile.css">
    <link rel="stylesheet" href="dashforge.filemgr.css">
    <link href="animate.min.css" rel="stylesheet">
    
    <script src="fontawesome.js"></script>

    <style>
      .upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;

}
.blurshadow{
  box-shadow: 3px 3px 10px #b5b5b5;
}
 #html5-watermark {
       display:none !important;
    }
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;

}


.zoom {

  transition: transform .1s;

}

.zoom:hover {
  -ms-transform: scale(1.05); /* IE 9 */
  -webkit-transform: scale(1.05); /* Safari 3-8 */
  transform: scale(1.05);

}



@keyframes blink {
   0% { color: gold; }
  100% { color: midnightblue; }
}
@-webkit-keyframes blink {
  0% { color: gold; }
  100% { color: midnightblue; }
}
.blink {
  -webkit-animation: blink 1s linear infinite;
  -moz-animation: blink 1s linear infinite;
  animation: blink 1s linear infinite;
}



    </style>
  <link rel="stylesheet" href="fontello.css" type="text/css"></head>
  <body class="bg-gray-100">

 <!-- content -->
     <div class="content">
      <div class="container-fluid pd-x-0 pd-lg-x-0 pd-xl-x-0">

        <!--******************************** FEED *************************************-->


<script src="jquery-3.5.1.min.js"></script>

            <script>
            $(function(){
                $("#file-upload").change(function(){
                $("#file-name").text(this.files[0].name);
                  });
                })
         </script>


<div class="row">
  <div class="col-md-9">


<div class="card blurshadow">
  <div class="card-header tx-center tx-bold">
      Update User Details
    </div>
  <div class="card-body">
    <form method="post" action="editProfile.php">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label class="tx-bold">Name</label>
        <input type="text" name="name" class="form-control" value="<?php session_start(); echo $_SESSION['stdName']; ?>">
      </div>

      <div class="form-group col-md-6">
        <label class="tx-bold">D.O.B</label>
        <input type="date" name="dob" class="form-control" value="">
      </div>

    </div>

     <div class="form-row">
      <div class="form-group col-md-6">
        <label class="tx-bold">Email</label>
        <input type="text" name="email" class="form-control" value="<?php session_start(); echo $_SESSION['stdEmail']; ?>">
      </div>

      <div class="form-group col-md-6">
        <label class="tx-bold">Mobile Number</label>
        <input type="number" name="mobile" class="form-control" value="<?php session_start(); echo $_SESSION['stdMobile']; ?>">
      </div>

    </div>
    <div class="card-footer">
      <center><button class="btn btn-dark" type="submit" name="user_update">Submit</button></center>

    </div>
  </form>
  </div>
</div>


<script src="editProfile.js"></script>

<div class="card mg-t-20 blurshadow">
              <div class="card-header tx-center tx-bold">
                    Update Password
                </div>
            <div class="card-body">
<form method="post" action="editProfile.php">
  <div class="form-row">
      <div class="form-group col-md-6">
    <label for="formGroupExampleInput" class="d-block tx-bold">Password</label>
    <input type="password" class="form-control" name="cpassword" placeholder="Enter new password" required="">
  </div>
  <div class="form-group col-md-6">
    <label for="formGroupExampleInput2" class="d-block tx-bold">Confirm Password</label>
    <div class="input-group" id="show_hide_password">
      <input type="password" placeholder="Enter Password To Confirm" name="password" class="form-control" required="">
      <div class="input-group-append">
        <span class="input-group-text">
          <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
        </span>
      </div>
    </div>
  </div>
  </div>
  <div class="card-footer">
     <center><button class="btn btn-dark" type="submit" name="sub">Submit</button></center>
  </div>
  </form></div>

</div>
  </div>
  <div class="col-md-3">

 <div class="card blurshadow rounded-10">
                  <div class="card-header tx-center tx-bold">Update Profile Picture</div>
  <div class="card-body">
      <center><img src="<?php session_start(); echo $_SESSION['stdImage']; ?>" class="img-fluid wd-200 ht-200 rounded-circle"> </center>
  </div>
  <div class="card-footer">
      <form method="post" action="editProfile.php" enctype="multipart/form-data">
          <div class="custom-file mg-b-20">
  <input type="file" class="custom-file-input" id="file-upload" name="fileToUpload">
  <label class="custom-file-label" for="customFile" id="file-name">Select Profile Picture</label>
</div>

      <center><input type="submit" name="fsubmit" value="Upload" class="btn btn-dark"></center>
      </form>
  </div>
</div>

  </div>
</div>
<!--******************************** FEED *************************************-->
      </div><!-- container -->
    </div><!-- content -->
<div class="backdrop"></div></body></html>
