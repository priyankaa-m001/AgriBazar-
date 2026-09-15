<?php
session_start();
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];

}else{
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - AgriBazaar</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="user-details">
        <p>Logged in user</p>
        <?php
        echo '<p>Email: ' . htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') . '</p><br>';

        echo '<p> Name: ' . htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') . '</p>';

        ?>
        <a href="logout.php">Logout</a>

    </div>


</body>

</html>