<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php
if (isset($_GET['code'])) {

  $username = "yassin";
  $password = "KVBXY8FDKZ";
  $database = new PDO("mysql:host=localhost;dbname=project;charset=utf8", $username, $password);

  $checkCode = $database->prepare("SELECT SECURITY_CODE FROM user WHERE SECURITY_CODE = :SECURITY_CODE");
  $checkCode->bindParam("SECURITY_CODE", $_GET['code']);
  $checkCode->execute();
  if ($checkCode->rowCount()>0) {

    $update = $database->prepare("UPDATE user SET SECURITY_CODE = :NEWSECURITY_CODE ,
   ACTIVATED=true WHERE SECURITY_CODE = :SECURITY_CODE");
    $securityCode = md5(date("h:i:s"));
    $update->bindParam("NEWSECURITY_CODE", $securityCode);
    $update->bindParam("SECURITY_CODE", $_GET['code']);


    if ($update->execute()) {
      echo '<div class="alert alert-success" role="alert">
  تم تحقق من حسابك بنجاح
  </div>';
      echo '<a class="btn btn-warning" href="login.php">تسجيل دخول</a>';
    }
  }
   else {
    echo '<div class="alert alert-danger" role="alert">
    هذا كود لم يعد صالحا للأستخدام
  </div>';
  }
}