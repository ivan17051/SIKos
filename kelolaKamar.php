<?php
// include database connection file
require_once'conn.php';

// Code for record deletion
if(isset($_REQUEST['del'])){
	//Get row id
	$uid=intval($_GET['del']);
	//Qyery for deletion
	$sql = "DELETE FROM ruangan WHERE  id_ruangan=:id";
	// Prepare query for execution
	$query = $db->prepare($sql);
	// bind the parameters
	$query-> bindParam(':id',$uid, PDO::PARAM_STR);
	// Query Execution
	$query -> execute();
	// Mesage after updation
	echo "<script>alert('Kamar Sukses Dihapus');</script>";
	// Code for redirection
	echo "<script>window.location.href='kelolaKamar.php'</script>"; 
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
	<?php require_once 'conn.php'?>
	<?php
		$query = $db->prepare('SELECT r.*, p.u_username, a.p_username FROM ruangan r, pencari p, pemilik a 
			WHERE r.fk_kos=a.p_id AND r.fk_user=p.u_id AND a.p_id='.$_SESSION['logged-in']['idkos']);
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
							<div class="logo"><a href="indexP.php">SIKos</a></div>
							<nav class="main_nav">
								<?php if(isset($_SESSION['logged-in'])): ?>
								<ul>
									<li><a href="indexP.php">Home</a></li>
									<li class="active">
										<a href="kelolaKamar.php">Kelola Kamar</a>
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
							<div class="cart_item_image">
								<div><img src="<?php echo $row['r_gambar']?>" alt=""></div>
							</div>
							<div class="cart_item_name_container">
								<div class="cart_item_name"><a href="#">Kamar <?php echo $row['r_namaruang']; ?></a></div>
							</div>
						</div>
                        <!-- Price -->
                        
						<div class="cart_item_price">Disewa Oleh:<p class="nama"><?php echo $row['u_username']?></p></div>
						<div class="cart_item_price">Sampai Tanggal:<p class="nama"><?php if(empty($row['r_masa'])) echo "-";
							else echo $row['r_masa']?></p></div>
                                    
						<!-- Quantity -->
						
						<!-- Total -->
						<div class="cart_item_total">
                            <div class="button clear_cart_button"><a href="edit_kamar.php?id=<?php echo $row['id_ruangan']?>">Ubah</a></div>
							<?php if(!empty($row['fk_user'])): ?>
                            	<div class="button clear_cart_button"><a href="upload.php">Pembayaran</a></div>
							<?php else: ?>
                            	<div class="button clear_cart_button" onclick="openForm()"><a href="#" >Pendaftar</a></div>
								<div class="form-popup" id="myForm">
									<form action="/action_page.php" class="form-container">
									<div class="cart-item-name">Login</div>

										<label for="email"><b>Email</b></label>
										<input type="text" placeholder="Enter Email" name="email" required>

										<label for="psw"><b>Password</b></label>
										<input type="password" placeholder="Enter Password" name="psw" required>

										<button type="submit" class="btn">Terima</button>
										<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
									</form>
								</div>
							
							<div class="button clear_cart_button"><a href="kelolaKamar.php?del=<?php echo $row['id_ruangan']?>" onClick="return confirm('Apakah Anda Yakin?')">Hapus</a></div>
							<?php endif; ?>
                        </div>
					</div>
					
				</div>
			
			</div>
			<?php endforeach; ?>
			
			<div class="button clear_cart_button"><a href="tambah_kamar.php">Tambah Kamar</a></div>
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
<script>
	function openForm() {
	document.getElementById("myForm").style.display = "block";
	}

	function closeForm() {
	document.getElementById("myForm").style.display = "none";
	}
</script>
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