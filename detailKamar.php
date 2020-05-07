<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>SIKos - Cari Kos Gampang</title>
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
<?php
	require_once 'conn.php';
	$userid=intval($_GET['id']);

	$sql = "SELECT * FROM ruangan
		WHERE id_ruangan=:id";
    //Prepare the query:
	$query = $db->prepare($sql);
    //Bind the parameters
	$query->bindParam(':id',$userid,PDO::PARAM_STR);
    //Execute the query:
	$query->execute();
    //Assign the data which you pulled from the database (in the preceding step) to a variable.
	$result=$query->fetchAll(PDO::FETCH_OBJ); 
	
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

	
	<!-- Home -->

	<div class="home">
		<div class="product_details">
		<div class="container">
			<div class="row details_row">

				<!-- Product Image -->
				<div class="col-lg-12">
					<div class="details_image text-center">
						<div class="details_image_large"><img src="<?php echo $result[0]->r_gambar?>" alt=""></div>
					</div>
				</div>

				
			</div>
		</div>
		</div>
		<div class="product_details">
			<div class="container">
				<div class="row details_row">
					<!-- Product Content -->
					<div class="col">
						<div class="details_content">
							<div class="details_name">Kamar <?php echo $result[0]->r_namaruang?></div>
							<div class="details_price">Rp <?php echo number_format($result[0]->r_harga_kmr,2,",",".") ?></div>

							<!-- In Stock -->
							
						</div>
					</div>
					<!-- Product Content -->
					<div class="col-lg-6">
						<div class="details_content">
							<div class="details_name">Fasilitas</div>
							<ul>
								<li><div class="details_price"><?php echo $result[0]->r_fasil?></div></li>
								<!-- <li><div class="details_price">AC</div></li>
								<li><div class="details_price">TV</div></li> -->
							</ul>

							<div class="details_name">Luas Kamar</div>
							<ul>
								<li><div class="details_price"><?php echo $result[0]->r_ukuran_kmr?></div></li>
							</ul>
						</div>
					</div>
				</div>	
			</div>
			<div class="text-center">
			<?php if(isset($_SESSION['logged-in'])): ?>
				<div class="button"><a href="upload2.php?id=<?php echo $result[0]->id_ruangan ?>">Book Now</a></div>
			<?php else: ?>
				<div class="button"><a href="#">Book Now</a></div>
			<?php endif ?>
			</div>
			
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_border"></div>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="newsletter_content text-center">
						<div class="newsletter_title">Subscribe to our newsletter</div>
						<div class="newsletter_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros</p></div>
						<div class="newsletter_form_container">
							<form action="#" id="newsletter_form" class="newsletter_form">
								<input type="email" class="newsletter_input" required="required">
								<button class="newsletter_button trans_200"><span>Subscribe</span></button>
							</form>
						</div>
					</div>
				</div>
			</div> -->
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
