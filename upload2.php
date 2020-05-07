<?php session_start(); ?>
<?php
	// include database connection file
	require_once'conn.php';
	if(isset($_POST['upload'])){

		// Posted Values  
		$folder="images/";

		$kos=$_SESSION['logged-in']['idkos'];
		$nama=$_POST['nama'];
		$harga=$_POST['harga'];
		$luas=$_POST['luas'];
		$fasil=$_POST['fasil'];
		$dir=$folder.basename($_FILES["gambar"]["name"]);
		move_uploaded_file($_FILES["gambar"]["tmp_name"], $dir);
		

		// Query for Insertion
		$sql="INSERT INTO ruangan(fk_kos,r_namaruang,r_ukuran_kmr,r_harga_kmr,r_fasil,r_gambar) VALUES(:ko,:fn,:eml,:ln,:cno,:gam)";
		//Prepare Query for Execution
		$query = $db->prepare($sql);
		// Bind the parameters
		$query->bindParam(':ko',$kos,PDO::PARAM_STR);
		$query->bindParam(':fn',$nama,PDO::PARAM_STR);
		$query->bindParam(':ln',$harga,PDO::PARAM_STR);
		$query->bindParam(':eml',$luas,PDO::PARAM_STR);
		$query->bindParam(':cno',$fasil,PDO::PARAM_STR);
		$query->bindParam(':gam',$dir,PDO::PARAM_STR);
		
		// Query Execution
		$query->execute();
		// Check that the insertion really worked. If the last inserted id is greater than zero, the insertion worked.
		$lastInsertId = $db->lastInsertId();
		if($lastInsertId){
			// Message for successfull insertion
			echo "<script>alert('Kamar Sukses Ditambahkan');</script>";
			echo "<script>window.location.href='kelolaKamar.php'</script>"; 
		}
		else {
			// Message for unsuccessfull insertion
			echo "<script>alert('Something went wrong. Please try again');</script>";
			echo "<script>window.location.href='tambah_kamar.php'</script>"; 
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>SIKos | Pembayaran</title>
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
	$result=$query->fetchAll(PDO::FETCH_ASSOC); 
	
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
											<li><a href="kamarku.php">Kamarku</a></li>
                                            <li class="active">
                                                <a href="upload.php">Pembayaran</a>
                                            </li>
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
					<div class="products_title">Upload Bukti Pembayaran</div>
				</div>
			</div>
			
			<div class="product_details">
				<div class="container">
                    <div class="row details_row2">

                        <!-- Product Image -->
                        <div class="col-lg-6">
                            <div style="height: 400px; width: 100%;border: 1px solid #000; margin-top: 30px;">
                                <form action="#" method="POST" enctype="multipart/form-data" style="padding: 150px">
                                    <table>
                                        <h5>Upload bukti pembayaran anda kesini</h5>
                                        <tr><td><td><td><input type="file" name="gambar" value="upload"/></td></tr>
                                    </table>
                                </form>
				            </div>
                        </div>             
                        <!-- Product Content -->
                        <div class="col-lg-6">
                        <?php foreach ($result as $row): ?>
                            <div class="details_content2">
                                <div class="details_name2">Nama:</div>
                                <div class="details_name"><span style="padding-left:5em"><?php echo $_SESSION['logged-in']['user'] ?></span></div>
                                <div class="details_name2">Kewajiban Bayar:</div>
                                <div class="details_name"><span style="padding-left:5em">Rp <?php echo number_format($row['r_harga_kmr'],2,",",".") ?></span></div>
                            </div>
                            <div class="text-center">
                                <div class="button cart_button" name="upload"><a href="#">Kirim Bukti Pembayaran</a></div>
                            </div>
                        <?php endforeach; ?>
                        <?php if(empty($result)): ?>
                            <div class="details_content2">
								<div class="details_name2">Nama:</div>
								<div class="details_name"><span style="padding-left:5em"><?php echo $_SESSION['logged-in']['user'] ?></span></div>
								<div class="details_name2">Kewajiban Bayar:</div>
								<div class="details_name"><span style="padding-left:5em">-</span></div>
                            </div>
                        <?php endif; ?>
                        </div>
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
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/cart.js"></script>
</body>
</html>