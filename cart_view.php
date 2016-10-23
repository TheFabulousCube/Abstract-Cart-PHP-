<!DOCTYPE html>
<html lang="en-US">
<!-- Marquardt 'Cube' Snell -->
<!-- www.tadaatiedye.com -->
<!-- Cart.php -->
<!-- Shopping cart! -->
<!-- 8/2/16: validater.w3.org -->
<!-- Document checking completed. No errors or warnings to show. -->
 
<head>
	<title>Ta Daa Tie Dye: Your Cart	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../stylesheets/main.css" />
	<!-- calculates the time of day and assigns a different-->
	<!-- colored style sheet for different times of the day. -->
	<script type="text/JavaScript" src="../javascripts/timeOfDayStyleSheet.js"></script>
	<?php if ($errorMessage) echo '<link rel="stylesheet" type="text/css" href="../admin/red.css">'; ?>
	<?php include '../includes/favicon.php'; ?>
	<?php 
		global $cartobj;
		require_once './cart.php';
		require_once './cart_model.php';
	?>
</head>

<body>
	<header>
		<?php include ('../includes/header.php'); ?> 
	</header>
	
	<nav id="sidebar">
		<?php include ('../includes/sidebar.php'); ?>
	</nav>

	<nav id="topmenu">
		<?php include ('../includes/topmenu.php'); ?>
	</nav>
		<section>
			<h1>Here's your Shopping cart!</h1>
			<table class="cart">
				<thead>
					<tr>
						<th>Item #</th>
						<th>Item</th>
						<th></th>
						<th>Item Cost</th>
						<th>Quantity</th>
						<th></th>
						<th >Item Total</th>
					</tr>
				</thead>



			<?php 
			$cart = $cartobj->getCart();
				$total = 0.00;
				$count = 0;
				foreach ($cart as $key => $item) :
				$itemID = $key;
				$itemName = (is_null($item['itemName'])) ? ($item['catagory']) : ($item['itemName']);
				$itemPicture = $item['picture'];
				$table = $item['catagory'];
				$price = $item['price'];
				$qty = $item['qty'];
				$subTotal = ($item['price'] * $item['qty']);
				$total += $subTotal;
				$count += $qty;
			?>
			<tr class = "line_item">
				<?php echo '<form action="./cart.php" method="post">'.PHP_EOL; ?>
				<th><?php echo $itemID; ?></th>
				<td><?php echo $itemName; ?></td>
				<td><img src="..<?php echo $itemPicture; ?>" style="max-width: 75px; height: auto;"/></td>
				<td><?php echo number_format($price, 2); ?></td>
				<td>
					<input type="number" name="qty" value="<?php echo number_format($qty, 0); ?>">
				</td>
				<td>
					<input type="hidden" name="item" value="<?php echo $itemID; ?>">
					<input class="styled-button" type="submit" name="action" value="Update">
					<input class="styled-button" type="submit" name="action" value="Remove">
				</td>
				<td>$<?php echo number_format($subTotal, 2); ?></td>
				</form>
			</tr>
			<?php endforeach; ?>
			
			<tr>
				<td></td>
				<td></td>
				<td> Item Count:</td>
				<td><?php echo number_format($count, 0); ?></td>
				<td> Subtotal:</td>
				<td>$<?php echo number_format($total, 2); ?></td>
			</tr>
		<tfoot>
			<tr>
				<td>&nbsp;</td>
				<td colspan="4"><?php  echo "$cartobj->message"; ?></td>
				<td>&nbsp;</td>
			</tr>
		</tfoot>
			</table>
			
			<h2>
				<a href="<?php $temp = (isset($_SESSION['sender'])) ? $_SESSION['sender'] : '../index.php'; echo $temp ?>">Continue Shopping</a>
				<a href="./checkout_view.php">Checkout</a>
			</h2>
			<p>

		</section>
		

		
		<div class="errorMessages">
		<p>
		<?php 		
		global $errorMessage;
		if ($errorMessage != '')
			{
				echo "Uh, oh. $errorMessage.";
			} ?>
		</div>
	<footer>
		<?php include ('../includes/footer.php'); ?>
	</footer>
</body>
</html>
	