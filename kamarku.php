<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>SIKos | Kamarku</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Sublime project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/product.css">
<link rel="stylesheet" type="text/css" href="styles/product_responsive.css">
</head>
<body>
	<?php require_once 'conn.php'?>
	<?php
		$condition = "'{$_SESSION['logged-in']['mail']}'";
		$query = $db->prepare('SELECT r.*, p.u_username, a.p_namakos FROM ruangan r, pencari p, pemilik a 
			WHERE r.fk_kos=a.p_id AND r.fk_user=p.u_id AND p.u_email='.$condition);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
	?>

<div class="super_container">

	<!-- Header -->

	<header class="header">
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<div class="logo"><a href="index.php">SIKos</a></div>
							<nav class="main_nav">
								<?php if(isset($_SESSION['logged-in'])): ?>
									<?php if($_SESSION['logged-in']['rights']==1): ?>	
										<ul>
											<li class="active">
												<a href="kamarku.php">Kamarku</a>
											</li>
											<li><a href="upload.php">Pembayaran</a></li>
										</ul>
									<?php elseif($_SESSION['logged-in']['rights']==3): ?>
										<ul>
											<!-- <li class="active"> -->
											<li><a href="index.php">Verifikasi</a></li>
											<!-- </li> -->
											<li><a href="upload.html">Pembayaran</a></li>
										</ul>
									<?php endif ?>
								<?php else: ?>

								<?php endif ?>
							</nav>
							<nav class="main_nav ml-auto">
								<ul>
									<?php if(isset($_SESSION['logged-in'])): ?>
										<li class="hassubs">
											Selamat Datang, <?php echo $_SESSION['logged-in']['user']; ?>
											<ul>
												<li><a href="index.php?logout=1">Log Out</a></li>
											</ul>
										</li>
									<?php else: ?>
										<li class="hassubs">
											<a href="">Login</a>
											<ul>
												<li><a href="login.php">Sebagai Pencari</a></li>
												<li><a href="login2.php">Sebagai Pemilik</a></li>
											</ul>
										</li>
										<li><a href="register1.php">Register</a></li>
									<?php endif; ?>
								</ul>
							</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</header>


	<!-- Cart Info -->
	
	<div class="products">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="products_title">Kamarku</div>
				</div>
			</div>
			
			<div class="product_details">
				<div class="container">
			
					<!-- Product Content -->
					<div class="col-lg-6">
					<?php foreach ($result as $row): ?>
						<div class="details_content">
							<div class="details_name2">Nama<span style="padding-left:6.2em">
								: <?php echo $row['u_username'] ?></span></div>
							<div class="details_name2">Sampai Tanggal<span style="padding-left:1em">
								: <?php echo $row['r_masa'] ?></span></div>
							<div class="details_name2">Nama Kos <span style="padding-left:4.1em">
								: <?php echo $row['p_namakos'] ?></span></div>
							<div class="details_name2">Alamat<span style="padding-left:5.5em">
								: </span> -</div>
							<div class="details_name2">Kamar <span style="padding-left:5.8em">
								: <?php echo $row['r_namaruang'] ?></span></div>
						</div>
					<?php endforeach; ?>
					<?php if(empty($result)): ?>
						<div class="details_content">
							<div class="details_name2">Nama<span style="padding-left:6.2em">
								: <?php echo $_SESSION['logged-in']['user'] ?></span></div>
							<div class="details_name2">Sampai Tanggal<span style="padding-left:1em">
								: </span> -</div>
							<div class="details_name2">Nama Kos <span style="padding-left:4.1em">
								: </span> -</div>
							<div class="details_name2">Alamat<span style="padding-left:5.5em">
								: </span> -</div>
						</div>
					<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="text-center">
			<?php if(empty($result)):?>
					
			<?php else: ?>
				<div class="button cart_button"><a href="">Perpanjang Masa Kos</a></div>
			<?php endif;?>
			</div>
		</div>
	</div>

	<!-- Footer -->
	
	<div class="footer_overlay"></div>
	<footer class="footer">
		<div class="footer_background" style="background-image:url(images/footer.jpg)"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="footer_content d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
						<div class="footer_logo"><a href="#">SIKos</a></div>
						<div class="copyright ml-auto mr-auto"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
						<div class="footer_social ml-lg-auto">
							<ul>
								<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/cart.js"></script>
</body>
</html>