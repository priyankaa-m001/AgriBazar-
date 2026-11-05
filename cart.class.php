<?php
// I made this Cart class so I do not have to write cart code again on every page.
// I used $cart_items to store all the items in the cart.
// I kept the cart in $_SESSION, so the cart does not get empty when the user goes to another page.
if(!session_id()){
	session_start();
}

/*
 * @package     PHP Shopping Cart Library 
 * @author      VR Soft Tech Team
 * @link        https://vrsofttech.com/
 */
 
	class Cart{
		
		// I used $cart_items as an array, because one cart can have many products.
		protected $cart_items=array();
		
		public function __construct(){
			
			// I used $_SESSION["cart"] here because I want the cart to stay saved
			// even if the user refreshes the page or goes to checkout.
			if(!isset($_SESSION["cart"])){
				$_SESSION["cart"]=[];
			}
			
			$this->cart_items=$_SESSION["cart"];
		}
		
		#get all ids of items
		public function get_ids(){
			$ids=[];
			foreach($this->cart_items as $item){
				$ids[]=$item["id"];
			}
			return $ids;
		}
		
		
		#add item to cart
		public function add_to_cart($item=[]){
			// I used $item here because one item has id, name, price, qty and total together.
			// I first check if the product is already in the cart, so I only increase its qty
			// instead of adding the same product again as a new row.
			if(isset($item["id"],$item["name"],$item["price"],$item["qty"],$item["total"])){
				
				#Check Product already exists
				$ids=$this->get_ids();
				if(in_array($item["id"],$ids)){
					
					#update qty and total
					$this->cart_items[$item["id"]]["qty"]+=$item["qty"];
					$this->cart_items[$item["id"]]["total"]=$this->cart_items[$item["id"]]["qty"]*$item["price"];
				}else{
					
					#add item to cart
					$this->cart_items[$item["id"]]=$item;
				}
				
				$this->commit();
				return true;
			}else{
				return false;
			}
		}
		
		#update cart qty
		public function update_cart($item=[]){
			$this->cart_items[$item["id"]]["qty"]=$item["qty"];
			$this->cart_items[$item["id"]]["total"]=$this->cart_items[$item["id"]]["qty"]*$this->cart_items[$item["id"]]["price"];
			$this->commit();
			return true;
		}
		
		#remove item from cart
		public function remove($id){
			unset($this->cart_items[$id]);
			$this->commit();
		}
		
		#get cart total
		public function get_cart_total(){
			#update cart total
			// I used $sum here because I need to add the total of every item in the cart.
			$sum=0;
			foreach($this->cart_items as $item){
				$sum+=$item["total"];
			}
			return $sum;
		}
		
		#get cart item count
		public function get_cart_count(){
			return count($this->cart_items);
		}
		
		#update values to session
		public function commit(){
			// I used commit() here because after every change I have to save
			// $cart_items back into $_SESSION, or the change will be lost.
			$_SESSION["cart"]=$this->cart_items;
		}
		
		#destroy cart
		public function destroy(){
			$this->cart_items = [];
			unset($_SESSION["cart"]);
		}
		
		#get single item from cart
		public function get_item($id){
			return $this->cart_items[$id];
		}
		
		#get all items from cart
		public function get_all_items(){
			return $this->cart_items;
		}
	}

/*
Functions in Cart Library:

	add_to_cart() 	- Add/Update Item to Cart.
	remove()		- Remove Specific item from Cart.
	get_item()		- Get Single items from Cart.
	get_all_items()	- Get all items from Cart.
	get_cart_total() - Get Cart total Amount.
	get_cart_count() - Get Cart items count.
	destroy()		 - Remove all items from Cart.
 */
?>