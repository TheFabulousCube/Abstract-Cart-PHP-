<?php
/*** Marquardt 'Cube' Snell -->
/*** www.tadaatiedye.com ***/
/*** cart_controller.php ***/
/*** Shopping cart controller ***/
	if (!isset($_SESSION)) session_start();
require_once './cart_model.php';
require_once '../db_utils/utils.php';  

global $cartobj;

	if (!isset($cartobj))
	{
		$cartobj = (isset($_SESSION['user'])) ? new DBCart() : new SessionCart();
	}

switch ($_POST['action'])
	{
		case add:
			{
				$cartobj->addtocart($_POST['itemID'], $_POST['qty']);
				include './cart_view.php';
				break;
			}
		case Remove:
			{
				$cartobj->removefromcart($_POST['item']);
				include 'cart_view.php';
				break;
			}
		case Update:
			{
				$qty = ($_POST['qty'] >= 0) ? $_POST['qty'] : 0;
				$cartobj->updatecart($_POST['item'], $qty);
				include 'cart_view.php';
				break;
			}
		case view_cart:
			{
				$cartobj->getcart();
				include './cart_view.php';
				break;
			}
		default:
	}


?>