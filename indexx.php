<?php

session_start();
if (isset($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register & Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">

  <style>

         /* General body and container setup */
body {
  font-family: Arial, sans-serif;
  background-color: #f0f0f0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
}

.container {
  background: #fff;
  padding: 40px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
}

.form-title {
  font-size: 24px;
  margin-bottom: 20px;
  color: #333;
  text-align: center;
}

/* Input Group Style */
.input-group {
  position: relative;
  margin-bottom: 20px;
}

.input-group input {
  width: 100%;
  padding: 10px 40px 10px 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
  color: #333;
}

.input-group i {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  color: #888;
  font-size: 18px; /* Increase font size */
  font-weight: bold; /* Make the icon bold */
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); /* Optional: Add text shadow for a bolder effect */
}

/* Email Field and Icon */
.input-group.email {
  margin-bottom: 30px; /* Add more space between the email field and the next element */
}

.input-group.email i {
  left: 15px; /* Position the icon to the left */
  padding-right: 5px; /* Add space between the icon and the email input */
}

.input-group.email input {
  padding-left: 35px; /* Increase padding to make space between the email icon and input field */
}

/* Password Field and Icon */
.input-group.password {
  margin-bottom: 30px; /* Add more space between the password field and the next element */
}

.input-group.password i {
  left: 15px; /* Position the icon to the left */
  padding-right: 5px; /* Add space between the icon and the password input */
}

.input-group.password input {
  padding-left: 35px; /* Increase padding to make space between the lock icon and input field */
}

/* Error message style */
.error-main, .error {
  background-color: #ffdddd;
  color: #d8000c;
  padding: 10px;
  border-radius: 5px;
  margin-top: 5px;
}

.error-main p, .error p {
  margin: 0;
}

/* Password Eye Icon */
#eye {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  color: #888;
  font-size: 18px; /* Increase font size */
  font-weight: bold; /* Make the icon bold */
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); /* Optional: Add text shadow for a bolder effect */
}

/* "Sign In" Button */
.btn {
  width: 100%;
  padding: 12px;
  background-color: #28a745; /* Green color */
  color: #fff;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn:hover {
  background-color: #218838; /* Darker green for hover effect */
}

/* Recover Password link */
.recover {
  text-align: center;
  margin-top: 10px;
}

.recover a {
  color: #007bff;
  text-decoration: none;
}

.recover a:hover {
  text-decoration: underline;
}

/* Social Media Icons */
.icons {
  text-align: center;
  margin: 20px 0;
}

.icons i {
  font-size: 24px;
  margin: 0 10px;
  cursor: pointer;
  transition: color 0.3s ease;
}

.icons i:hover {
  color: #007bff;
}

/* "Sign Up" Link */
.links {
  text-align: center;
}

.links p {
  font-size: 14px;
  color: #555;
}

.links a {
  color: #007bff;
  text-decoration: none;
}

.links a:hover {
  text-decoration: underline;
}

.or {
  text-align: center;
  margin: 20px 0;
  color: #888;
  font-weight: bold;
}

/* Media Query for Responsiveness */
@media (max-width: 480px) {
  .container {
    padding: 20px;
    width: 90%;
  }

  .form-title {
    font-size: 20px;
  }

  .input-group input {
    font-size: 14px;
  }

  .btn {
    font-size: 14px;
  }
}


    </style>
</head>

<body>

  <div class="container" id="signIn">
    <h1 class="form-title">Log In</h1>
    <?php
    if (isset($errors['login'])) {
      echo '<div class="error-main">
                    <p>' . $errors['login'] . '</p>
                    </div>';
      unset($errors['login']);
    }
    ?>
     
    <form method="POST" action="user-account.php">
         
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <?php
        if (isset($errors['email'])) {
          echo ' <div class="error">
                    <p>' . $errors['email'] . '</p>
                </div>';
        }
        ?>
      </div>
      <div class="input-group password">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <i id="eye" class="fa fa-eye"></i>
        <?php
        if (isset($errors['password'])) {
          echo ' <div class="error">
                    <p>' . $errors['password'] . '</p>
                </div>';
        }
        ?>
      </div>
      
      <input type="submit" class="btn" value="Sign In" name="signin">
    </form>
    <p class="or">
      ----------or--------
    </p>
    <div class="icons">
      <i class="fab fa-google"></i>
      <i class="fab fa-facebook"></i>
    </div>
    <div class="links">
      <p>Don't have account yet?</p>
      <a href="register.php">Sign Up</a>
    </div>
  </div>
  <script src="scripts.js"></script>
</body>

</html>
<?php
if (isset($_SESSION['errors'])) {
  unset($_SESSION['errors']);
}
?>
