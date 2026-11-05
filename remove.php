<?php
  // This file removes one item from the cart.
  // I used $id here to know which product to remove, from the link like remove.php?id=3.
  session_start();
  if (isset($_GET["id"])) {
      $id = $_GET["id"];
      include "cart.class.php";
      $cart = new Cart();
      $cart->remove($id);
  }
  header("location:view_cart.php");
?>