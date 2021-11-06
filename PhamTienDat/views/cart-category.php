<?php 
$cart =loadClass('cart');
if(!isset($_SESSION['user_customer'])){
redirect('index.php?option=customer&cat=login');

}else{
    require_once('views/cart-buy.php');

}
?>