<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/phpico.jpg" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Password Reset</title>
</head>

<body>
    <?php
      require_once("nav.php"); 
      ?>
    <main class="contanier  m-auto " style="max-width:720px; margin-top:50px !important; text-align: center; ">
        <?php
        if(!isset($_GET['code'])){
        echo ' <form method="POST">
            <label>Email :</label>
            <br>
            <input type="email" name="email" class="form-control"">
           
            <button type="submit" name="resert"  class="btn btn-warning mt-3 w-100">Resert Password</button>';
            }
            elseif (isset($_GET['code']) && isset($_GET['email'])){
            echo ' <form method="POST">
                <label>Enter new password :</label>
                <br>
                <input type="password" name="password" class="form-control">
             
                <button type="submit" name="newpassword"  class="btn btn-warning mt-3 w-100">Resert Password</button>';

                }
                ?> <?php

    if(isset($_POST['resert'])){
    $username="yassin" ;
    $password="KVBXY8FDKZ" ; 
    $database=new PDO("mysql:host=localhost;dbname=project;charset=utf8",$username,$password);
          
    $checkemail=$database->prepare("SELECT * FROM user WHERE email = :email");
    $email = $_POST['email'];
    $checkemail->bindParam("email",$email);
    $checkemail->execute();
    if($checkemail->rowCount()>0){
    require_once("mailer/mail.php");
    $user = $checkemail->fetchObject();
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = '<h1> Reset password from this linkا</h1>'
    . "<div> link:" . "<div>" .
            "<a href='https://localhost/Project/resert.php?email=".$email  . "&code=".$user->SECURITY_CODE  . "'>
                " . "https://localhost/Project/resert.php?email=".$email . "&code=".$user->SECURITY_CODE . "</a>";
            ;
            $mail->setFrom("asyasson07@gmail.com", "yassin");
            $mail->send();
            echo '<div class="alert alert-success" role="alert">
                We have sent you to set a password in your email
            </div>';

            }
            else{
            echo'<div class="alert alert-danger" role="alert">
                Sorry this email not exist
            </div>';
            }
            }
            ?> <?php
    
if(isset($_POST['newpassword'])){
    $username = "yassin";
    $password = "KVBXY8FDKZ"; 
    $database = new PDO("mysql:host=localhost;dbname=project;charset=utf8",$username,$password);
    $updatepass = $database->prepare("UPDATE user SET password = :password WHERE email = :email");
    $password= sha1($_POST['password']);
    $email = $_GET['email'];
    $updatepass->bindParam("password",$password);
    $updatepass->bindParam("email", $email);
    if($updatepass->execute()){
       echo '<div class="alert alert-success" role="alert">
       The password has been reset
       </div>';
       header("Location:login.php");
    }
    else {
        'no';
    }
}
?>
    </main>
</body>

</html>