<?php
// include database connection file
require_once'conn.php';

// Code for record deletion
if(isset($_REQUEST['verif'])){
	//Get row id
	$uid=intval($_GET['verif']);
	//Qyery for deletion
	$sql = "UPDATE pemilik SET p_verif=1 WHERE  p_id=:id";
	// Prepare query for execution
	$query = $db->prepare($sql);
	// bind the parameters
	$query-> bindParam(':id',$uid, PDO::PARAM_STR);
	// Query Execution
	$query -> execute();
	// Mesage after updation
	echo "<script>alert('Akun Pemilik Berhasil diVerifikasi');</script>";
	// Code for redirection
	echo "<script>window.location.href='verifikasi.php'</script>"; 
}


?>

<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>SIKos | Kelola Kamar</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Sublime project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/cart.css">
<link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">
</head>
<body>

<?php require_once 'conn.php';?>
<?php
		$query = $db->prepare('SELECT * FROM pemilik 
			WHERE p_verif=0');
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
								<ul>
									<li><a href="index.php">Home</a></li>
									<li class="active">
										<a href="verifikasi.php">Verifikasi</a>
									</li>
								</ul>
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

	<!-- Home -->

	<div class="home">
		
	</div>

	<!-- Cart Info -->

	<div class="cart_info">
		<div class="container">
		<?php foreach($result as $row): ?>
			<div class="row">
				<div class="col">
					<!-- Column Titles -->
					<div class="cart_info_columns clearfix">
					</div>
				</div>
			</div>
			<div class="row cart_items_row">
			
				<div class="col">
				
					<!-- Cart Item -->
					<div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
						<!-- Name -->
						<div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
							<div class="cart_item_name_container">
								<div class="cart_item_name"><a href="#"><?php echo $row['p_namakos']?></a></div>
							</div>
						</div>
                        <!-- Price -->
                        
                        <div class="cart_item_price">Nama Pemilik:<p class="nama"><?php echo $row['p_username']?></p></div>
                        <div class="cart_item_price">Email:<p class="nama"><?php echo $row['p_email']?></p></div>
                                    
						<!-- Quantity -->
						
						<!-- Total -->
						<div class="cart_item_total">
                            <div class="button clear_cart_button" name="verif"><a href="verifikasi.php?verif=<?php echo $row['p_id']?>">Verifikasi</a></div>
                        </div>
					</div>
				
				</div>
			
			</div>
            <div class="row">
				<div class="col">
					<!-- Column Titles -->
					<div class="cart_info_columns clearfix">
					</div>
				</div>
			</div>
        
		<?php endforeach;?>	
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