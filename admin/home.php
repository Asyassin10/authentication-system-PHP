<?php
session_start();
if(isset($_SESSION['user'])){
    {
        if($_SESSION['user']->role == "admin"){
            
            echo '<nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
           <img src="../image/phpico.jpg" alt="logo" width="55px" height="55px" class="d-inline-block align-text-top">
              <a class="navbar-brand" href="#">
              PHP
              </a>
              
            </div>
          </nav>
          <div class="shadow p-3 mb-1 bg-white rounded " style="text-align: center" ><b>Welcom mr '.$_SESSION['user']->name.'<b> </div>'.'
            <form method="GET"> <center><button type="submit"  style="width :500px;"class="btn btn-danger" name="logout">Logout</button><button type="submit"  style="width :500px;"class="btn btn-danger" name="update">Edite</button></center></form>';
        }

    }  

    
}
else{
    header("Location:https://localhost/Project/login.php",true);
     die("");
 }
    
 if(isset($_GET['logout'])){      
    session_unset();
    session_destroy();
    header("Location:https://localhost/Project/login.php",true);
    
    
}
if(isset($_GET['update'])){      
    header("Location:https://localhost/Project/admin/profile.php",true);
    
    }

      
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">