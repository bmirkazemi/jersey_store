<?php
require('connect.php');
require('nav.php');
if (!isset($_SESSION['active'])) {
	header("Location:./home.php");
}
if (isset($_POST['action'])) {
	if ($_POST['action'] == 'Empty') {
		$_SESSION['cart'] = [];
	}
	if ($_POST['action'] == 'Update') {
		foreach ($_POST as $key_prod_id=>$qnty) {
			$qnty = htmlspecialchars($qnty);
			if(array_key_exists($key_prod_id, $_SESSION['cart'])) {
				$_SESSION['cart'][$key_prod_id] = $qnty;
			}
		}
	}
}	
	
if (isset($_POST['store_prod_id'])) {
	$prod_id = sanitize($_POST['store_prod_id']);
	$sql = "SELECT * FROM Products WHERE prod_id = '{$prod_id}'";
	if (($result = ($db->query($sql))) == TRUE) {
		$added_product_id = $prod_id;
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = [];
		}
		$_SESSION['cart'][$added_product_id] = isset($_SESSION['cart'][$added_product_id]) ? $_SESSION['cart'][$added_product_id]+1 : 1;
	}
}
?>
<center>
<h1><font color='#38A2C3'>Shopping Cart</font></h1>
<div class = 'form'>
<?PHP
if (isset($_SESSION['cart'])) {
	$cart_total = 0.0;
?>
<form action='cart.php' method='POST'>
<?PHP
    foreach ($_SESSION['cart'] as $prod_id => $cartQnty) {
		$sql = "SELECT prod_name, prod_sku, prod_price FROM Products WHERE prod_id = '{$prod_id}'";
		$result = $db->query($sql);
		if (($result = ($db->query($sql))) == TRUE) {
            while ($row = ($result->fetch_assoc())) {
                echo "<center>";
                echo $row['prod_name']." Jersey<br>";
				echo "<input type ='number' name='".$prod_id."' min = 0 value='".$cartQnty."'>"; 
                echo "$".money_format('%(#10n',($row['prod_price'] * $cartQnty))."<br>";
                echo "<br>";
				$cart_total += ($row['prod_price'] * $cartQnty);	
			}
		} else {
			echo "Failure to query";
			exit(1);
		}
	}
	echo "<br><br>Total: $".money_format('%(#10n', $cart_total);	
?>
<br>
<br>
<input type = 'submit' name = 'action' value ='Update'>
<input type = 'submit' name = 'action' value ='Empty'>
</form>
</div>
<?PHP
} else {
	echo "<h3>Cart is empty</h3>";
}
	?>

