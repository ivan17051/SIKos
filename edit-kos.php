<?php session_start(); ?>
<?php
    // include database connection file
    require_once'conn.php';
    if(isset($_POST['update'])){
        // Get the userid
        $userid=$_SESSION['logged-in']['idkos'];
		// Posted Values  
		$folder="images/";
		
		if($_FILES['image']['type']){
			$nama=$_POST['nama'];
			$alamat=$_POST['alamat'];
			$jenis=$_POST['jenis'];
			$dir="$folder".$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], $dir);
	
			// Query for Query for Updation
			$sql="UPDATE datakos SET dk_alamat=:ln,dk_jenis=:eml,dk_gambar=:gam WHERE fk_pemilik=:id";
			//Prepare Query for Execution
			$query = $db->prepare($sql);
			// Bind the parameters
			$query->bindParam(':fn',$nama,PDO::PARAM_STR);
			$query->bindParam(':ln',$alamat,PDO::PARAM_STR);
			$query->bindParam(':eml',$jenis,PDO::PARAM_STR);
			$query->bindParam(':id',$userid,PDO::PARAM_STR);
			$query->bindParam(':gam',$dir,PDO::PARAM_STR);
			// Query Execution
			$query->execute();
			// Mesage after updation
			echo "<script>alert('Record Updated successfully');</script>";
			// Code for redirection
			echo "<script>window.location.href='kelolaKamar.php'</script>"; 
		}
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Tambah Kamar</title>
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
    // Get the userid
    $userid=$_SESSION['logged-in']['idkos'];
    $sql = "SELECT d.*, p.p_namakos FROM pemilik p, datakos d WHERE d.fk_pemilik=p.p_id AND p.p_id=:id";
    //Prepare the query:
    $query = $db->prepare($sql);
    //Bind the parameters
    $query->bindParam(':id',$userid,PDO::PARAM_STR);
    //Execute the query:
    $query->execute();
    //Assign the data which you pulled from the database (in the preceding step) to a variable.
    $results=$query->fetchAll(PDO::FETCH_OBJ);   
    echo var_dump($results);         
?>
<div class="super_container">

	<!-- Header -->

	<header class="header">
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<div class="logo"><a href="index.html">SIKos</a></div>
							<nav class="main_nav">
								<?php if(isset($_SESSION['logged-in'])): ?>
								<ul>
									<li class="active">
										<a href="indexP.php">Home</a>
									</li>
									<li><a href="kelolaKamar.php">Kelola Kamar</a></li>
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

	</header>

	<!-- Menu -->

	<!--Upload form -->

	<div class="products">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="products_title">Daftarkan Kamar Kost Anda </div>
				</div>
            </div>
            
			<div class="form">
                
				<form method="POST" enctype="multipart/form-data">
			        <fieldset>
			        <legend></legend>
			        <p>
						<b>Nama Kos</b>
			            <span style="padding-left:2em"><input type="text" name="nama" value="<?php echo $results[0]->p_namakos; ?>"></span>
			        </p>
			        <p>
						<b>Alamat</b>
			            <span style="padding-left:3.3em"><input type="text" name="alamat" value="<?php echo $results[0]->dk_alamat?>"></span>
			        </p>
			        <p>
						<b>Jenis</b>
			            <span style="padding-left:4.5em"><input type="text" name="jenis" value="<?php echo $results[0]->dk_jenis?>"></span>
			        </p>
			        <p>
			        	<table>
							<h6>Upload foto kos anda disini</h6>
							<tr><td><td><td><input type="file" name="image" value="upload gambar"/></td></tr>
						</table>
			        </p>
			        <p>
			            <input type="submit" name="update" value="Update">
			        </p>
			        
			        </fieldset>
			    </form>
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
