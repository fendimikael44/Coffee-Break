<!DOCTYPE html>
<html>
<head>
	<title>Coffee Break a Blog Category Flat Bootstarp responsive Website Template | Home :: w3layouts</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Coffee Break Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>
	<!---- start-smoth-scrolling---->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
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
	<script src="js/modernizr.custom.97074.js"></script>
	<script src="js/jquery.chocolat.js"></script>
	<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen" charset="utf-8">
	<!--light-box-files -->
	<script type="text/javascript" charset="utf-8">
		$(function() {
			$('.gallery a').Chocolat();
		});
	</script>
	<script type="text/javascript" src="js/jquery.hoverdir.js"></script>
	<style>
		.cart-items a {color: #3d1a1b;text-decoration:none;padding:5px}
		.cart-items a:hover{color: #fff;border:#3d1a1b solid 1px;background-color:#3d1a1b;border-radius:25px}
		#total-cart{display:inline-block}
		/*.cart:hover .cart-items{display:block}*/
	</style>
</head>
<body>
	<!--header-top-starts-->
	<div class="header-top">
		<div class="container">
			<div class="head-main">
				<a href="?menu=home"><img src="images/logo-1.png" alt="" /></a>
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
						<li><a href="?menu=home" class="<?= ($_GET['menu'] == "home")? "active":"" ?>">Home</a></li>
						<!--<li><a href="?menu=about" class="<?= ($_GET['menu'] == "about")? "active":"" ?>">About</a></li>-->
						<li><a href="?menu=product" class="<?= ($_GET['menu'] == "product")? "active":"" ?>">Product</a></li>
						<li><a href="?menu=payment" class="<?= ($_GET['menu'] == "payment")? "active":"" ?>">Konfirmasi Pembayaran</a></li>
						<!--<li><a href="?menu=typo" class="<?= ($_GET['menu'] == "typo")? "active":"" ?>">Typo</a></li>-->
						<!--<li><a href="?menu=contact" class="<?= ($_GET['menu'] == "contact")? "active":"" ?>">Contact</a></li>-->
					</ul>
				</div>
				<div class="header-right cart-items col-md-2">
					<a href="?menu=cart"><span><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp; Rp <div id="total-cart"><?= (!isset($_SESSION['cart']['totalHarga']))? "0,00":number_format($_SESSION['cart']['totalHarga'], 2,",",".") ?></div></span></a>
					<!--<div class="cart-item">-->
					<!--	asdasdasd-->
					<!--</div>-->
					<!--<img src="images/cart-coffee.png" class="img-responsive">-->
					<!--<div class="search-bar">-->
					<!--	<input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">-->
					<!--	<input type="submit" value="">-->
					<!--</div>-->
					<!--<ul>-->
					<!--	<li><a href="#"><span class="fb"> </span></a></li>-->
					<!--	<li><a href="#"><span class="twit"> </span></a></li>-->
					<!--	<li><a href="#"><span class="pin"> </span></a></li>-->
					<!--	<li><a href="#"><span class="rss"> </span></a></li>-->
					<!--	<li><a href="#"><span class="drbl"> </span></a></li>-->
					<!--</ul>-->
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