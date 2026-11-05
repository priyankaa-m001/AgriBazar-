<?php
// This is the My Account page after login.
// I used $_SESSION['user'] here to check if someone is logged in.
// If there is no user in the session, I send them back to index.php, because
// this page is only for logged-in users. I used $user here to store that
// logged-in user's name and email, so I can show them on this page.
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