<?php session_start(); ?>
<?php
	// include database connection file
	require_once 'conn.php';
	if(isset($_REQUEST['cari'])){

		// Posted Values  
		$cari=strval($_GET['search']);

		$kos=$_SESSION['logged-in']['idkos'];
		$nama=$_POST['nama'];
		$harga=$_POST['harga'];
		$luas=$_POST['luas'];
		$fasil=$_POST['fasil'];

		// Query for Insertion
		$sql="SELECT d.*, p.p_id, p.p_namakos FROM pemilik p, datakos d WHERE d.fk_pemilik=p.p_id AND d.dk_alamat LIKE '%keputih%'";
		//Prepare Query for Execution
		$query = $db->prepare($sql);
		// Bind the parameters
		
		$query->bindParam(':car',$cari,PDO::PARAM_STR);
		
		// Query Execution
		// $query->execute();
		// $result = $query->fetchAll(PDO::FETCH_ASSOC);
		
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Product</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Sublime project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/product.css">
<link rel="stylesheet" type="text/css" href="styles/product_responsive.css">
</head>
<body>
<?php 
	require_once 'conn.php';

	$query = $db->prepare('SELECT d.*, p.p_id, p.p_namakos FROM pemilik p, datakos d
		WHERE d.fk_pemilik=p.p_id');
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
											<!-- <li class="active"> -->
											<li><a href="kamarku.php">Kamarku</a></li>
											<!-- </li> -->
											<li><a href="upload.php">Pembayaran</a></li>
										</ul>
									<?php elseif($_SESSION['logged-in']['rights']==3): ?>
										<ul>
											<!-- <li class="active"> -->
											<li><a href="index.php">Verifikasi</a></li>
											<!-- </li> -->
											<li><a href="upload.php">Pembayaran</a></li>
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

		<!-- Social -->
		
	</header>

	<!-- Menu -->

	<!-- Products -->

	<div class="products">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="products_title">List Tempat Kos</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					
					<div class="product_grid">
					<?php foreach($result as $row): ?>
						<!-- Product -->
						<div class="product">
							<div class="product_image"><img src="images/kost.jpeg" alt=""></div>
							<?php if($row['dk_jenis']=="Putra"):?>
							<div class="product_extra product_putra"><a href="#">Putra</a></div>
							<?php elseif($row['dk_jenis']=="Putri"):?>
								<div class="product_extra product_putri"><a href="#">Putri</a></div>
							<?php else:?>
								<div class="product_extra product_campur"><a href="#">Campur</a></div>
							<?php endif; ?>
							<div class="product_content">
								<div class="product_title"><a href="detailKos.php?id=<?php echo $row['p_id'] ?>"><?php echo $row['p_namakos']?></a></div>
								<div class="product_price">Harga Mulai Rp 670.000</div>
								<div class="product_description">Alamat: <?php echo $row['dk_alamat']?></div>
							</div>
						</div>

					<?php endforeach; ?>	
					</div>
				</div>
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
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/product.js"></script>
</body>
</html>
