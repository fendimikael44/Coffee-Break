<style>
   .artikel{margin:20px 0px}
   .artikel p{text-align: justify;line-height:2}
   .btn-cart{color: #fff;background-color: #443005;border-color: #443005;}
   .btn-cart:hover{color: #000;background-color: #e4ddcd; transition: background-color 0.5s ease;}
   .btn-cart:focus{color:#fff}
   #img-preview{max-width:400px;max-height:300px}
</style>

<div class="container" style="margin-top: 50px;margin-bottom: 50px;">
   <div class="col-md-12">
      <center>
         <h2><?= $data['nama_kopi'] ?></h2>
      </center>
   </div>
   <div class="col-md-12">
      <center>
         <img class="img-responsive" id="img-preview" src="<?= $data['foto_produk'] ?>">
      </center>
   </div>
   <div class="col-md-12">
      <center>
        <br/>
		 <?php if($data['stok'] == 0){ ?>
			<span class="label label-warning">Stok habis</span>
		 <?php }else{ ?>
			<button class="btn btn-cart" >add to cart</button>
		 <?php } ?>
         <!--<button class="btn btn-cart" >add to cart</button>-->
		 <br>
		 <span>Rp <?= number_format($data['harga'], 0,".",".") ?> /100 gram</span>
      <center>
   </div>
   <div class="col-md-12 artikel">
      <p>
         <?= $data['deskripsi'] ?>
      </p>
   </div>
</div>
<script type="text/javascript">
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
   $(window).load(function() {
       
       $("#flexiselDemo3").flexisel({
           visibleItems: 3,
           animationSpeed: 1000,
           autoPlay: true,
           autoPlaySpeed: 3000,    		
           pauseOnHover: true,
           enableResponsiveBreakpoints: true,
           responsiveBreakpoints: { 
               portrait: { 
                   changePoint:480,
                   visibleItems: 2
               }, 
               landscape: { 
                   changePoint:640,
                   visibleItems: 3
               },
               tablet: { 
                   changePoint:768,
                   visibleItems: 3
               }
           }
       });
       
   });
   $(".btn-cart").click(function(){
      var id_kopi = <?= $data['id_kopi'] ?>;
      var harga = <?= $data['harga'] ?>;
      var nama_kopi = "<?= $data['nama_kopi'] ?>";
      var foto_produk = "<?= $data['foto_produk'] ?>";

      $.ajax({
         type: "POST",
         url: "?menu=product&action=addCart",
         data:{id_kopi:id_kopi,harga:harga,nama_kopi:nama_kopi,foto_produk:foto_produk},
         dataType:"json",
         success: function(data){
            var totalHarga = data.totalHarga;
            alert("item telah dimasukan ke keranjang");
 
            $("#total-cart").text(data.totalHarga.formatMoney(2, '.', ','));
         }
      });
   });
  
   
</script>
<script type="text/javascript" src="js/jquery.flexisel.js"></script>