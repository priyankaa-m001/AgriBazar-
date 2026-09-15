<?php
require_once "config/auth_db.php"; // provides $pdoAuth (admin_login lives in the accounts DB)
session_start();

if (isset($_SESSION['AdminLoginId'])) {
    header("location: adindex.php");
    exit();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$login_failed = false;

if (isset($_POST['Signin'])) {
    $csrfOk = isset($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);

    if (!$csrfOk) {
        $login_failed = true;
    } else {
        $adminName = $_POST['AdminName'] ?? '';
        $adminPassword = $_POST['AdminPassword'] ?? '';

        $stmt = $pdoAuth->prepare("SELECT * FROM admin_login WHERE AdminName = :name");
        $stmt->execute(['name' => $adminName]);
        $result = $stmt->fetch();

        if ($result && password_verify($adminPassword, $result['AdminPassword'])) {
            session_regenerate_id(true);
            $_SESSION['AdminLoginId'] = $adminName;
            header("location: adindex.php");
            exit();
        } else {
            $login_failed = true;
        }
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
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">

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
