    <!--banner-starts-->
	<div class="banner">
		<div class="container">
			<div class="banner-top">
				<!--<div class="banner-text">-->
				<!--	<!--<h2>Aliquam erat</h2>-->
				<!--	<h1>Tentang Kami</h1>-->
				<!--	<div class="banner-btn">-->
				<!--		<a href="single.html">Read More</a>-->
				<!--	</div>-->
				<!--</div>-->
			</div>
		</div>
	</div>
	<!--banner-end-->
	<!--about-starts-->
	<div class="about">
		<div class="container">
			<div class="about-main">
				<div class="col-md-8 about-left">
					<div class="about-one">
						<!--<p>Find The Most</p>-->
						<h3>Keunggulan Kami</h3>
					</div>
					<div class="about-two">
						<a href="single.html"><img src="images/c-1.jpg" alt="" /></a>
						<p>
						   <b>Nama Toko</b> Kopi memiliki berbagai jenis kopi dari berbagai daerah yang sudah cukup terkenal baik di dalam
						   negeri hingga mancanegara dari jenis Arabica maupun Robusta, seperti kopi Aceh Gayo, Toraja Sapan, Bali
						   Kintamani, Java Preanger, Lampung, Mandheling, Lintong, Bengkulu, dan Papua Wamena. Kopi yang kami jual
						   merupakan biji kopi pilihan terbaik yang telah kami seleksi dari berbagai supplier kami dengan grade terbaik,
						   specialty grade, yang biasa menjadi standard kopi ekspor ke luar negeri.
						</p>
						<p>
							Kami menjual berbagai single origin coffee, yaitu kopi asli daerah dari berbagai lokasi di Indonesia.
							Kami menyediakan dalam bentuk biji kopi mentah (green bean coffee) maupun yang sudah roast (whole beans).
							Nikmatnya kopi Nusantara hanya ada di <b>Nama Toko</b> kopi.
						</p>
					
						<!--<ul>-->
						<!--	<li><p>Share : </p></li>-->
						<!--	<li><a href="#"><span class="fb"> </span></a></li>-->
						<!--	<li><a href="#"><span class="twit"> </span></a></li>-->
						<!--	<li><a href="#"><span class="pin"> </span></a></li>-->
						<!--	<li><a href="#"><span class="rss"> </span></a></li>-->
						<!--	<li><a href="#"><span class="drbl"> </span></a></li>-->
						<!--</ul>-->
					</div>	
					<div class="about-tre">
						<div class="a-1">
							<div class="col-md-6 abt-left">
								<img src="images/c-3.jpg" alt="" />
								<h3><a href="single.html">Lorem ipsum</a></h3>
								<p>Vivamus interdum diam diam, non faucibus tortor consequat vitae. Proin sit amet augue sed massa pellentesque viverra. Suspendisse iaculis purus eget est pretium aliquam ut sed diam.</p>
							</div>
							<div class="col-md-6 abt-left">
								<img src="images/c-4.jpg" alt="" />
								<h3><a href="single.html">Lorem ipsum</a></h3>
								<p>Vivamus interdum diam diam, non faucibus tortor consequat vitae. Proin sit amet augue sed massa pellentesque viverra. Suspendisse iaculis purus eget est pretium aliquam ut sed diam.</p>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>	
				</div>
				<div class="col-md-4 about-right heading">
					<div class="abt-1">
						<h3>About Us</h3>
						<div class="abt-one">
							<img src="images/c-2.jpg" alt="" />
							<p>
								<b>Nama Toko Kopi</b> adalah toko kopi online, supplier cafe untuk coffee shop, dan distributor dari Kopi
								Nusantara Indonesia yang menjual berbagai produk kopi terbaik nusantara secara eceran dengan harga
								grosir dan murah.
							</p>
						</div>
					</div>
					<div class="abt-2">
						<h3>NEW PRODUCT</h3>
						<?php foreach($data as $dt){ ?>
						<div class="might-grid">
							<div class="grid-might">
								<a href="?menu=product&&action=productDetail&&id_product=<?= $dt['id_kopi'] ?>"><img src="<?= $dt['foto_produk'] ?>" class="img-responsive" alt=""> </a>
							</div>
							<div class="might-top">
								<h4><?= $dt['nama_kopi'] ?></h4>
								<p><?= substr($dt['deskripsi'],0,94) . '...<a href="?menu=product&&action=productDetail&&id_product='.$dt['id_kopi'].'"> [More]</a>' ?></p> 
							</div>
							<div class="clearfix"></div>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="clearfix"></div>			
			</div>		
		</div>
	</div>
	<!--about-end-->
	<!-- JANGAN DIHAPUSSSSSS SLIDER -->
	<!--slide-starts-->
<!--	<div class="slide">-->
<!--		<div class="container">-->
<!--			<div class="fle-xsel gallery">-->
<!--			<ul id="flexiselDemo3">-->
<!--				<li>-->
<!--					<a href="images/s-1.jpg">-->
<!--						<div class="banner-1">-->
<!--							<img src="images/s-1.jpg" class="img-responsive" alt="">-->
<!--						</div>-->
<!--					</a>-->
<!--				</li>-->
<!--				<li>-->
<!--					<a href="#">-->
<!--						<div class="banner-1">-->
<!--							<img src="images/s-2.jpg" class="img-responsive" alt="">-->
<!--						</div>-->
<!--					</a>-->
<!--				</li>			-->
<!--				<li>-->
<!--					<a href="#">-->
<!--						<div class="banner-1">-->
<!--							<img src="images/s-3.jpg" class="img-responsive" alt="">-->
<!--						</div>-->
<!--					</a>-->
<!--				</li>		-->
<!--				<li>-->
<!--					<a href="#">-->
<!--						<div class="banner-1">-->
<!--							<img src="images/s-4.jpg" class="img-responsive" alt="">-->
<!--						</div>-->
<!--					</a>-->
<!--				</li>	-->
<!--				<li>-->
<!--					<a href="#">-->
<!--						<div class="banner-1">-->
<!--							<img src="images/s-5.jpg" class="img-responsive" alt="">-->
<!--						</div>-->
<!--					</a>-->
<!--				</li>	-->
<!--				<li>-->
<!--					<a href="#">-->
<!--						<div class="banner-1">-->
<!--							<img src="images/s-6.jpg" class="img-responsive" alt="">-->
<!--						</div>-->
<!--					</a>-->
<!--				</li>				-->
<!--			</ul>-->
<!--							-->
<!--            <script type="text/javascript">-->
<!--               $(window).load(function() {-->
<!--                   -->
<!--                   $("#flexiselDemo3").flexisel({-->
<!--                       visibleItems: 5,-->
<!--                       animationSpeed: 1000,-->
<!--                       autoPlay: true,-->
<!--                       autoPlaySpeed: 3000,    		-->
<!--                       pauseOnHover: true,-->
<!--                       enableResponsiveBreakpoints: true,-->
<!--                       responsiveBreakpoints: { -->
<!--                           portrait: { -->
<!--                               changePoint:480,-->
<!--                               visibleItems: 2-->
<!--                           }, -->
<!--                           landscape: { -->
<!--                               changePoint:640,-->
<!--                               visibleItems: 3-->
<!--                           },-->
<!--                           tablet: { -->
<!--                               changePoint:768,-->
<!--                               visibleItems: 3-->
<!--                           }-->
<!--                       }-->
<!--                   });-->
<!--                   -->
<!--               });-->
<!--               </script>-->
<!--               <script type="text/javascript" src="js/jquery.flexisel.js"></script>-->
<!--			   <div class="clearfix"> </div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>	-->
	<!--slide-end-->
	