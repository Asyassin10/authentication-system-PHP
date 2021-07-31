<?php
session_start();
if(isset($_SESSION['user'])){

    echo '
    
<form method="POST" class="m-3">
    <label class="form-label"><b>Fullname :<b></label>
    <br>
    <input type="text" name="name" class="form-control" value='.$_SESSION['user']->name.'>
    <br>
    <label class="form-label">Age :</label>
    <br>
    <input type="date" name="age" class="form-control" value='.$_SESSION['user']->age.'>
    <br>
    <label class="form-label">Password :</label>
    <br>
    <input type="password" name="password" class="form-control" value='.$_SESSION['user']->password.'>
    <br>
    <br>
    <button type="submit" class="btn btn-primary" name="update" value='.$_SESSION['user']->id.'>Edit your information</button>
    <button type="submit" class="btn btn-danger" name="home">Back home</button>
</form>';
if(isset($_POST['home'])){
    header("Location:home.php");
}
if(isset($_POST['update'])){
    $username = "yassin";
    $password = "KVBXY8FDKZ"; 
    $database = new PDO("mysql:host=localhost;dbname=project;charset=utf8",$username,$password);
    $update = $database->prepare("UPDATE user SET name = :name , password = :password , age = :age WHERE id=:id ");
    $name = $_POST['name'];
    $age = $_POST['age'];
    $password = $_POST['password'];
    $id = $_POST['update'];
    $update->bindParam("name",$name);
    $update->bindParam("password",$password);
    $update->bindParam("age",$age);
    $update->bindParam("id", $id);
    if($update->execute()){
      echo '<div class="alert alert-success" role="alert">
      Successfully update
    </div>';
}

}
}
else{ header("Location:../login.php",true);}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">