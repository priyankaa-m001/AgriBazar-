<?php 
	require_once "config.php"; // provides $pdo
	session_start();
	
	include "cart.class.php";
	$cart=new Cart();
	
	if($cart->get_cart_count() == 0){
		header("location:view_cart.php");
		exit();
	}

	if (empty($_SESSION['csrf_token'])) {
		$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
	}

	$errors = [];

	if(isset($_POST["submit"])){

		if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
			$errors[] = "Your session expired, please try again.";
		}

		$name=trim($_POST["name"] ?? "");
		$email=trim($_POST["email"] ?? "");
		$contact=trim($_POST["contact"] ?? "");
		$address=trim($_POST["address"] ?? "");
		$city=trim($_POST["city"] ?? "");
		$pincode=trim($_POST["pincode"] ?? "");

		#server-side validation
		if ($name === "" || mb_strlen($name) < 2) {
			$errors[] = "Please enter a valid name.";
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Please enter a valid email address.";
		}
		if (!preg_match('/^[0-9]{10}$/', $contact)) {
			$errors[] = "Contact number must be 10 digits.";
		}
		if ($address === "") {
			$errors[] = "Please enter your address.";
		}
		if ($city === "") {
			$errors[] = "Please enter your city.";
		}
		if (!preg_match('/^[0-9]{6}$/', $pincode)) {
			$errors[] = "Pincode must be 6 digits.";
		}

		if (empty($errors)) {
			try {
				$pdo->beginTransaction();

				#Look up user by email first so returning customers don't get duplicated
				$stmt = $pdo->prepare("SELECT ID FROM users WHERE EMAIL = :email LIMIT 1");
				$stmt->execute(['email' => $email]);
				$existing = $stmt->fetch();

				if ($existing) {
					$uid = $existing['ID'];
					$stmt = $pdo->prepare(
						"UPDATE users SET NAME = :name, CONTACT = :contact, ADDRESS = :address, CITY = :city, PINCODE = :pincode WHERE ID = :id"
					);
					$stmt->execute([
						'name' => $name,
						'contact' => $contact,
						'address' => $address,
						'city' => $city,
						'pincode' => $pincode,
						'id' => $uid,
					]);
				} else {
					$stmt = $pdo->prepare(
						"INSERT INTO users (NAME, EMAIL, CONTACT, ADDRESS, CITY, PINCODE) VALUES (:name, :email, :contact, :address, :city, :pincode)"
					);
					$stmt->execute([
						'name' => $name,
						'email' => $email,
						'contact' => $contact,
						'address' => $address,
						'city' => $city,
						'pincode' => $pincode,
					]);
					$uid = $pdo->lastInsertId();
				}

				#insert Order information — unguessable order number instead of rand()
				$order_no = strtoupper(bin2hex(random_bytes(6)));
				$total_amt = $cart->get_cart_total();
				$stmt = $pdo->prepare(
					"INSERT INTO orders (ORDER_NO, ORDER_DATE, UID, TOTAL_AMT) VALUES (:order_no, NOW(), :uid, :total_amt)"
				);
				$stmt->execute(['order_no' => $order_no, 'uid' => $uid, 'total_amt' => $total_amt]);
				$oid = $pdo->lastInsertId();

				#insert Order Item Details
				$stmt = $pdo->prepare(
					"INSERT INTO order_details (OID, PID, PNAME, PRICE, QTY, TOTAL) VALUES (:oid, :pid, :pname, :price, :qty, :total)"
				);
				foreach ($cart->get_all_items() as $item) {
					$stmt->execute([
						'oid' => $oid,
						'pid' => $item["id"],
						'pname' => $item["name"],
						'price' => $item["price"],
						'qty' => $item["qty"],
						'total' => $item["total"],
					]);
				}

				$pdo->commit();
				$cart->destroy();
				header("location:complete.php?order_no={$order_no}");
				exit();
			} catch (PDOException $e) {
				$pdo->rollBack();
				error_log("Checkout failed: " . $e->getMessage());
				$errors[] = "Something went wrong placing your order. Please try again.";
			}
		}
	}
?>
<html>
	<head>
        <title>Checkout</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    </head>
    <body>
		<?php include "navbar.php"; ?>
        <div class='container mt-5'>
			<h2 class='text-muted mb-4'>Delivery Details</h2>
			<div class='row'>
				<div class='col-md-6 mx-auto'>
					<?php if (!empty($errors)): ?>
						<div class="alert alert-danger">
							<ul class="mb-0">
								<?php foreach ($errors as $error): ?>
									<li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
					<form method='post' action='<?php echo htmlspecialchars($_SERVER["REQUEST_URI"], ENT_QUOTES, 'UTF-8');?>' autocomplete="off">
						<input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
						<div class='form-group'>
							<label>Name</label>
							<input type='text' name='name' class='form-control' required placeholder='User Name' value="<?php echo htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
						</div>
						<div class='form-group'>
							<label>Email</label>
							<input type='email' name='email' class='form-control' required placeholder='User Name' value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
						</div>
						<div class='form-group'>
							<label>Contact</label>
							<input type='text' name='contact' class='form-control' required placeholder='Contact No' value="<?php echo htmlspecialchars($_POST['contact'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
						</div>
						<div class='form-group'>
							<label>Address</label>
							<textarea class='form-control' required name='address'><?php echo htmlspecialchars($_POST['address'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
						</div>
						<div class='form-group'>
							<label>City</label>
							<input type='text' name='city' class='form-control' required placeholder='City' value="<?php echo htmlspecialchars($_POST['city'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
						</div>
						<div class='form-group'>
							<label>Pincode</label>
							<input type='text' name='pincode' class='form-control' required placeholder='Pincode' value="<?php echo htmlspecialchars($_POST['pincode'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
						</div>
						<input type='submit' name='submit' value='Checkout' class='btn btn-primary'>
					</form>
				</div>
			</div>
		</div>
    </body>
</html>
