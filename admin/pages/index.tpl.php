<!DOCTYPE html>
<html>
<head>
	<title>Coffee Break a Blog Category Flat Bootstarp responsive Website Template | Home :: w3layouts</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Coffee Break Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="../css/style.css" rel='stylesheet' type='text/css' />
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap-datepicker.min.js"></script>
	<!---- start-smoth-scrolling---->
	<script type="text/javascript" src="../js/move-top.js"></script>
	<script type="text/javascript" src="../js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
	</script>
	<!--script-->
	<!-- about -->
	<script src="../js/modernizr.custom.97074.js"></script>
	<script src="../js/jquery.chocolat.js"></script>
	<link rel="stylesheet" href="../css/chocolat.css" type="text/css" media="screen" charset="utf-8">
	<!--light-box-files -->
	<script type="text/javascript" charset="utf-8">
		$(function() {
			$('.gallery a').Chocolat();
		});
	</script>
	<script type="text/javascript" src="../js/jquery.hoverdir.js"></script>
	<style>
		/*.cart-items a:hover{color: #fff;border:#3d1a1b solid 1px;background-color:#3d1a1b;border-radius:25px}*/
		#total-cart{display:inline-block}
		.btn-logout{background-color:#3d1a1b;color:#fff}
		.btn-logout:hover {color:#d11212}
		/* color: #d11212 */
		/*.cart:hover .cart-items{display:block}*/
	</style>

	<link rel="stylesheet" href="../css/bootstrap-datepicker3.css" type="text/css" media="screen" charset="utf-8">
</head>
<body>
	<!--header-top-starts-->
	<div class="header-top">
		<div class="container">
			<div class="head-main">
				<a href="?menu=home"><img src="../images/logo-1.png" alt="" /></a>
			</div>
		</div>
	</div>
	<!--header-top-end-->
	<!--start-header-->
	<div class="header">
		<div class="container">
			<div class="head">
				<div class="navigation">
					<span class="menu"></span> 
					<ul class="navig">
						<?php if($_SESSION['id_role'] == 2){ ?>
							<li><a href="?menu=home" class="<?= ($_GET['menu'] == "home" || !isset($_GET['menu']))? "active":"" ?>">Data Order Online</a></li>
							<li><a href="?menu=productList" class="<?= ($_GET['menu'] == "productList")? "active":"" ?>">Data Product</a></li>
							<li><a href="?menu=createUser" class="<?= ($_GET['menu'] == "createUser")? "active":"" ?>">Create User</a></li>
							<li><a href="?menu=report" class="<?= ($_GET['menu'] == "report")? "active":"" ?>">Report</a></li>
						<?php } ?>
						<li><a href="?menu=order" class="<?= ($_GET['menu'] == "order")? "active":"" ?>">Form Order</a></li>
					</ul>
				</div>
				<div class="header-right cart-items col-md-2">
					<a href="index.php?logout=true"><button class="btn btn-logout">Logout &nbsp;(<?= $_SESSION['username'] ?>)</button></a>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>	
	<!-- script-for-menu -->
	<!-- script-for-menu -->
	<script>
		$("span.menu").click(function(){
			$(" ul.navig").slideToggle("slow" , function(){
			});
		});
	</script>
	<!-- script-for-menu -->

<?php
    echo $content;
?>
	<!--footer-starts-->
	<div class="footer">
		<div class="container">
			<div class="footer-text">
				<p>© 2018 <b>Nama Toko Kopi</b> All Rights Reserved</p>
			</div>
		</div>
	</div>
	<!--footer-end-->
</body>
</html>