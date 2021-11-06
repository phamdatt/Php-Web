<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
</head>
<link rel="stylesheet" href="public/css/bootstrap.min.css">
<link rel="stylesheet" href="public/css/style.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
<link rel="stylesheet" href="public/css/hover.css" media="all">

<body>

	<section class="clearfix header bg-secondary">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 login my-3">
					<a href="#">0333727182</a>

				</div>
				<div class="col-md-4">

				</div>

				<div class="col-md-2 login">
					<?php if (isset($_SESSION['fullname_customer'])) : ?>


						<div><?php echo $_SESSION['fullname_customer']; ?></div>
						<div class="login"><a href=" index.php?option=customer&cat=logout">Thoat</a> </div>
					<?php else : ?>
						<a href="index.php?option=customer&cat=login"><i class="fas fa-lock"></i>Dang Nhap</a>
						<a href="index.php?option=customer&cat=register">Dang ky</a>

					<?php endif; ?>
				</div>
				<div class="col-md-2">
					<?php
					$sl = 0;
					if (isset($_SESSION['cart'])) {
						$cart = $_SESSION['cart'];
						$sl = count($cart);
					}

					?>
					<div style="font-size:20px;">
						<a href="index.php?option=cart">

							<span class="badge badge-secondary my-3"><i class="fas fa-shopping-bag"></i><sup><?php echo $sl; ?></sup>Giỏ Hàng</span>
						</a>

					</div>
				</div>
			</div>

		</div>
	</section>

	<section class="Menu">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<a href="index.php">
						<img class="img-logo" src="public/images/logo.jpg">
					</a>
				</div>
				<?php $keyword = (isset($_REQUEST['keyword'])) ? $_REQUEST['keyword'] : ''; ?>
				<div class="col-md-5">
					<form class="form-inline py-3 my-lg-0" action="" method="GET">
						<input type="hidden" name="option" value="search" />
						<input class="form-control mr-sm-3 search" type="search" placeholder="Tim Kiem" aria-label="Search" required name="keyword" id="keyword" value="<?php echo $keyword; ?>">
						<button class=" my-2 my-sm-0" type="submit">Search</button>
					</form>
				</div>
				<div class="col-md-3">
					<button class="btn btn-danger">Mua Hàng Trả Góp</button>
				</div>
			</div>
		</div>

	</section>