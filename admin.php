<?php
require("connection.php");
session_start();

if (isset($_SESSION['AdminLoginId'])) {
    header("location: adindex.php");
    exit();
}

$login_failed = false;

if(isset($_POST['Signin']))
{
    $adminName = mysqli_real_escape_string($con, $_POST['AdminName']);
    $adminPassword = mysqli_real_escape_string($con, $_POST['AdminPassword']);
    
    $query = "SELECT * FROM `admin_login` WHERE `AdminName` = '$adminName' AND `AdminPassword` = '$adminPassword'";
    $result = mysqli_query($con, $query);
    if($result && mysqli_num_rows($result) == 1)
    {
        $_SESSION['AdminLoginId'] = $_POST['AdminName'];
        header("location: adindex.php");
        exit();
    }
    else
    {
        $login_failed = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="mycss.css">
</head>
<body>
<div class="background">
    <div class="login-form">
          <h2>admin login</h2>
        <form method="POST">
            
              <i class="fa-solid fa-user"></i>
              <input type="text" placeholder="Admin Name" name="AdminName">  

              <i class="fa-solid fa-lock"></i>
              <input type="password" placeholder="Password" name="AdminPassword">
            
            
                <button type="submit" name="Signin">Sign In</button>

            <div class="extra">

                <a href="#">Forgot Password ?</a>
             
            </div>

        </form>
    </div>
  </div>  
    <?php
       if($login_failed)
       {
           echo "<script>alert('incorrect password');</script>";
       }
    ?>
</body>
</html>
