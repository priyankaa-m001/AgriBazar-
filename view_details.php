<?php 
	require_once "config.php"; // provides $pdo
	session_start();
	
	include "cart.class.php";
	$cart=new Cart();
	
	if(isset($_POST["submit"])){
		$item=[
			"id"=>$_POST["pid"],
			"name"=>$_POST["product"],
			"price"=>$_POST["price"],
			"qty"=>$_POST["qty"],
			"total"=>($_POST["qty"]*$_POST["price"]),
			"img"=>$_POST["img"],
		];
		$cart->add_to_cart($item);
		header("location:view_cart.php");
		exit();
	}
	
	$data=[];
	$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
	if ($id > 0) {
		$stmt = $pdo->prepare("SELECT * FROM products WHERE PID = :id");
		$stmt->execute(['id' => $id]);
		$row = $stmt->fetch();
		if ($row) {
			$data = $row;
		}
	}
?>
<html>
	<head>
        <title>Products Details</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    </head>
    <body>
	<?php include "navbar.php"; ?>
        <div class='container mt-5'>
			<div class='row'>
				<div class='col-md-9 mx-auto'>
					<h2 class='text-muted mb-4'>Product Details</h2><hr>
					<?php if(!empty($data)): ?>
					<div class='row mt-5'>
						<div class='col-md-4'>
							  <img src="images/<?php echo htmlspecialchars($data["IMAGE"], ENT_QUOTES, 'UTF-8'); ?>" class='img-thumbnail'>
						</div>	
						<div class='col-md-8'>
							<h2 class='text-muted'><?php echo htmlspecialchars($data["PRODUCT"], ENT_QUOTES, 'UTF-8'); ?></h2>
							<p class="font-weight-bold">Price &#8377; <?php echo htmlspecialchars($data["PRICE"], ENT_QUOTES, 'UTF-8'); ?></p>
							<p><?php echo htmlspecialchars($data["DESCRIPTION"], ENT_QUOTES, 'UTF-8'); ?></p>
							
							<form method='post' action='<?php echo htmlspecialchars($_SERVER["REQUEST_URI"], ENT_QUOTES, 'UTF-8');?>'>
								<input type='hidden' name='pid' value='<?php echo htmlspecialchars($data["PID"], ENT_QUOTES, 'UTF-8'); ?>'>
								<input type='hidden' name='product' value='<?php echo htmlspecialchars($data["PRODUCT"], ENT_QUOTES, 'UTF-8'); ?>'>
								<input type='hidden' name='price' value='<?php echo htmlspecialchars($data["PRICE"], ENT_QUOTES, 'UTF-8'); ?>'>
								<input type='hidden' name='img' value='<?php echo htmlspecialchars($data["IMAGE"], ENT_QUOTES, 'UTF-8'); ?>'>
									<p><input type='number' min='1' value='1' name='qty' required class='form-control col-md-5'></p>
								<input type='submit' name='submit' value='Add To Cart' class='btn btn-primary'>
							</form>
						</div>
					</div>
					<?php else: ?>
					<div class='alert alert-danger mt-5'>Product not found.</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
    </body>
</html>
