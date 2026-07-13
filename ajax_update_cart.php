<?php 
  session_start();
  
  if (isset($_POST["id"]) && isset($_POST["qty"])) {
      $id = $_POST["id"];
      $qty = (int)$_POST["qty"];
      
      include "cart.class.php";
      $cart = new Cart();
      
      $ids = $cart->get_ids();
      if (in_array($id, $ids)) {
          if ($qty > 0) {
              $cart->update_cart(["id" => $id, "qty" => $qty]);
              $row_total = $cart->get_item($id)["total"];
          } else {
              $cart->remove($id);
              $row_total = 0;
          }
          
          $result = [
              "row_total" => $row_total,
              "total" => $cart->get_cart_total(),
          ];
          echo json_encode($result);
      }
  }
?>