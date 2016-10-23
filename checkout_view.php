<!DOCTYPE html>
<html lang="en-US">
<!-- Marquardt 'Cube' Snell -->
<!-- www.tadaatiedye.com -->
<!-- Checkout.php -->
<!-- 8/2/16: validater.w3.org -->
<!-- Document checking completed. No errors or warnings to show. -->

<head>
	<title>Ta Daa Tie Dye: Checkout	</title>
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
			<h1>Checkout</h1>
			<p>	
			<form method="post" id="myContainer" action="https://www.sandbox.paypal.com/cgi-bin/webscr?sandbox=1&direct=0&returnurl=tadaatiedye.com/Cart/CheckoutComplete&cancelurl=tadaatiedye.com/Cart/CheckoutCancelled">
			<input type="hidden" name="cmd" value="_cart">
			<input type="hidden" name="upload" value="1">
			<input type="hidden" name="business" value="cube-facilitator@tadaatiedye.com">
			<input type="hidden" name="currency_code" value="USD">
			
				<table class="cart">
					<thead>
						<tr>
							<th>Item #</th>
							<th>Item</th>
							<th>Item Cost</th>
							<th>Quantity</th>
							<th >Item Total</th>
						</tr>
					</thead>

				<?php $cart = $cartobj->getCart();
					$total = 0.00;
					$lineNumber = 0;
					foreach ($cart as $key => $item) :
					$itemID = $key;
					$itemName = $item['itemName'];
					$price = $item['price'];
					$qty = $item['qty'];
					$subTotal = ($item['price'] * $item['qty']);
					$total += $subTotal;
					$lineNumber += 1;
				?>
				
					<tr>
						<th>
							<?php echo $itemID; ?>
							<input type="hidden" name="item_number_<?php echo $lineNumber ?>" value="<?php echo $itemID; ?>">
						</th>
						<td>
							<?php echo $itemName; ?>
							<input type="hidden" name="item_name_<?php echo $lineNumber ?>" value="<?php echo $itemName; ?>">
						</td>
						<td>$
							<?php echo number_format($price, 2); ?>
							<input type="hidden" name="amount_<?php echo $lineNumber ?>" value="<?php echo $price; ?>">
						</td>
						<td>
							<?php echo number_format($qty, 0); ?>
							<input type="hidden" name="quantity_<?php echo $lineNumber ?>" value="<?php echo $qty; ?>">
						</td>
						<td>$
							<?php echo number_format($subTotal, 2); ?>
						</td>
					</tr>
					<?php endforeach; ?>
					<tr>
						<td></td><td></td>
						<td colspan="2">Total:</td>
						<td>$<?php echo number_format($total, 2); ?></td>
					</tr>
				</table>
			</form>
		</section>
		
		<section>
			<h2>
				<a href="<?php $temp = (isset($_SESSION['sender'])) ? $_SESSION['sender'] : '../index.php'; echo $temp ?>">Continue Shopping</a>
			</h2>
				<script>
   window.paypalCheckoutReady = function () {
       paypal.checkout.setup('TBZYYR9QUA6H8', {
         environment: 'sandbox',
         container: 'myContainer'
       });
  };
</script>
  <script async src="//www.paypalobjects.com/api/checkout.js" ></script>
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
	