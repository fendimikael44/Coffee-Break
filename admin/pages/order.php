<style>
   .da-thumbs li{width:19%}
   .da-thumbs li a div h5 {margin: 2.5em 0 0 0;}
   .da-thumbs li{text-align: center}
   .namaKopi{word-wrap:break-word}
</style>
<div class="container">
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
               <a href="?menu=order&action=adminCart"><h3>Checkout</h3></a>
           </div>
           <section>
               <ul id="da-thumbs" class="da-thumbs">
                   <?php foreach($data as $dt){ ?>
                   <li>
                       <a href="#" onclick="addCart(<?= $dt['id_kopi'] ?>)" class="b-link-stripe b-animate-go  thickbox">
                           <img src="../<?= $dt['foto_produk'] ?>" alt="" />
                           <div>
                               <h5><?= $dt['nama_kopi'] ?></h5>
                               <!--<span>ASD 1</span>-->
                           </div>
                       </a>
                       <span class="col-md-12 namaKopi"><?= $dt['nama_kopi'] ?></span><br>
                       <span>Rp <?= number_format($dt['harga'], 0,".",".") ?></span><br>
                       <span class="label <?= ($dt['stok'] < 10000)? "label-danger":"label-primary" ?>"><?= number_format($dt['stok'], 0,".",".") ?> Gram</span>
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
        Number.prototype.formatMoney = function(decPlaces, thouSeparator, decSeparator, currencySymbol) {
         var n = this,
             decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
             decSeparator = decSeparator == undefined ? "." : decSeparator,
             thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
             currencySymbol = currencySymbol == undefined ? "" : currencySymbol,
             sign = n < 0 ? "-" : "",
             i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
             j = (j = i.length) > 3 ? j % 3 : 0;
         return sign + currencySymbol + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
      };
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
      function addCart(idKopi){
         $.ajax({
            type: "POST",
            url: "?menu=order&action=addCartAdmin",
            data:{id_kopi:idKopi},
            dataType:"json",
            success: function(data){
               var totalHarga = data.totalHarga;
               alert("item telah dimasukan ke keranjang");
    
               $("#total-cart").text(data.totalHarga.formatMoney(2, '.', ','));
            }
         });
      }
      
      $( ".da-thumbs li a" ).click(function( event ) {
         event.preventDefault();
      });
   </script>
</div>