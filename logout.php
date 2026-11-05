<?php
// I used session_destroy() here because logout means I have to clear all the
// saved session data, like the logged-in user and the cart, then go back home.
session_destroy();
header("location: try.html");
exit();
?>