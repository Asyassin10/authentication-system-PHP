<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="image/phpico.jpg" type="image/gif" sizes="16x16">
    <title>Login</title>
</head>

<body>
    <?php
    require_once("nav.php");
    ?>
    <main class="contanier  m-auto " style="max-width:1500px; margin-top:50px !important; text-align: center; ">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card border-0 shadow rounded-3 my-5">
                        <div class="card-body p-4 p-sm-5">
                            <h6 class="card-title text-center mb-5 fw-light fs-5">
                                <img src="image/download.png" style="height: 150px;">
                            </h6>
                            <form method="POST">
                                <label for=" floatingInput">Email address</label>
                                <div class="form-floating mb-3">

                                    <input type="email" class="form-control" name="email">

                                </div>
                                <label for="floatingPassword">Password</label>
                                <div class="form-floating mb-3">

                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                </div>
                                <div class="d-grid"><br>
                                    <a href="resert.php">forgot password?</a>

                                    <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit"
                                        name="login" style="width: 360px;">Sign
                                        in</button> <br>
                                    <a href=" index.php">
                                        <button type="button" class="btn btn-outline-primary"
                                            style="width: 360px;">Create
                                            an
                                            account
                                        </button>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
<?php
$username = "yassin";
$password = "KVBXY8FDKZ";
$database = new PDO("mysql:host=localhost;dbname=project;charset=utf8", $username, $password);

if (isset($_POST['login'])) {
    $log = $database->prepare("SELECT * FROM user WHERE email = :email  AND password = :password");
    $email = $_POST['email'];
    $password =sha1($_POST['password']);
    $log->bindParam("email", $email);
    $log->bindParam("password", $password);
    $log->execute();
    if ($log->rowCount() === 1) {
        $user = $log->fetchObject();
        if ($user->ACTIVATED == true) {
            session_start();
            $_SESSION['user'] = $user;
            if($user->role == "admin" ){
                header("Location:admin/home.php",true);
            }
            elseif($user->role == "user" ){
                header("Location:user/home.php",true);
            }
            elseif($user->role == "director" ){
                header("Location:director/home.php",true);
            }
              
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Sorry you need to active your account
           </div>';
            
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">
     sorry email or password not found
    </div>';
    }
}
?>