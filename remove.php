<?php 
  session_start();
  if (isset($_GET["id"])) {
      $id = $_GET["id"];
      include "cart.class.php";
      $cart = new Cart();
      $cart->remove($id);
  }
  header("location:view_cart.php");
?>