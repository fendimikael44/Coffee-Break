	<?php
		
		if(!isset($_GET['paging'])){
			$activePaging = 1;
		}else{
			$activePaging = $_GET['paging'];
		}
		
	?>
	<!--gallery-starts-->
	<div class="" style="margin-top:25px">
		<div class="container">
			<div class="gallery-top heading">
				<h3>OUR BEST COFFEE</h3>
			</div>
			<section>
				<ul id="da-thumbs" class="da-thumbs">
					<?php foreach($data as $dt){ ?>
					<li>
						<a href="?menu=product&&action=productDetail&&id_product=<?= $dt['id_kopi'] ?>"  class="b-link-stripe b-animate-go  thickbox">
							<img src="<?= $dt['foto_produk'] ?>" alt="" />
							<div>
								<h5><?= $dt['nama_kopi'] ?></h5>
								<!--<span>ASD 1</span>-->
							</div>
						</a>
					</li>
					<?php } ?>
					<div class="clearfix"> </div>
				</ul>
			</section>
			<div class="product" style="">
				<center>
					
					<?= $paging ?>
				</center>
			</div>
        </div>
	</div>
	<!--gallery-end-->
	<script type="text/javascript">
		$(function() {
		
			$(' #da-thumbs > li ').each( function() { $(this).hoverdir(); } );

		});
		$(document).ready(function() {
			var activePaging = <?= $activePaging ?>;
			if(activePaging == 1){
				$("#"+activePaging).addClass('active');
			}else{
				$(".pagination li a").each(function(){
					var pagingLink = $(this).attr('href')
					var idPaging = pagingLink.substr(pagingLink.length - 1);

					if(idPaging == activePaging){
						$("#"+$(this).text()).addClass('active');
					}
				});
			}
			
			
		});
	</script>
