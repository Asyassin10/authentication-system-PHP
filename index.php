<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <?php
    require_once("nav.php");
    ?>
    <div class="container m-3">
        <form method="POST">
            <label class="form-label"><b>Fullname :<b></label>
            <br>
            <input type="text" name="name" class="form-control">
            <br>
            <label class="form-label">Age :</label>
            <br>
            <input type="date" name="age" class="form-control">
            <br>
            <label class="form-label">email :</label>
            <br>
            <input type="email" name="email" class="form-control">
            <br>
            <label class="form-label">Password :</label>
            <br>
            <input type="password" name="password" class="form-control">
            <br>
            <br>
            <select class="form-select" aria-label="Default select example" name="role">
                <option value="user">user</option>
                <option value="admin">admin</option>
                <option value="director">director</option>
            </select>
            <br>
            <button type="submit" class="btn btn-primary" name="Register">Register</button>
        </form>
    </div>
</body>

</html>

<?php
$username = "yassin";
$password = "KVBXY8FDKZ"; 
$database = new PDO("mysql:host=localhost;dbname=project;charset=utf8",$username,$password);
if(isset($_POST['Register'])){
$checkemail = $database->prepare("SELECT * FROM user WHERE email = :email");
$email = $_POST['email'];
$checkemail->bindParam("email",$email);
$checkemail->execute();
if($checkemail->rowCount()>0){
    echo'<div class="alert alert-danger" role="alert">
    Sorry this email has already been created!
  </div>';
}
else{
    $name= $_POST['name'];
    $age = $_POST['age'];
    $password =sha1($_POST['password']);
    $role = $_POST['role'];
    $SECURITY_CODE = md5(date("h:i:s"));
    $adduser = $database->prepare("INSERT INTO user(name,age,email,password,SECURITY_CODE,role) VALUES(:name,:age,:email,:password,:SECURITY_CODE,:role)");
    $adduser->bindParam("name",$name);
    $adduser->bindParam("age",$age);
    $adduser->bindParam("email",$email);
    $adduser->bindParam("password",$password);
    $adduser->bindParam("SECURITY_CODE",$SECURITY_CODE);
    $adduser->bindParam("role",$role);
    if($adduser->execute()){
      echo '<div class="alert alert-success" role="alert">
      Successfully registered,Enter your email to activate the account
    </div>';
    
    require_once 'mailer/mail.php';

    $mail->addAddress($email);
    $mail->Subject = "Email verification code";
    $mail->Body = '<h1> ا</h1>'
    . "<div>link check account" . "<div>" . 
    "<a href='https://localhost/Project/active.php?code=".$SECURITY_CODE  . "'>
     " . "https://localhost/Project/active.php?code=" .$SECURITY_CODE . "</a>";
    ;
    $mail->setFrom("asyasson07@gmail.com", "yassin");
    $mail->send();


  }else{
      echo '<div class="alert alert-danger" role="alert">
      An unexpected error occurred    </div>';
  }
  
    

}
}


?>