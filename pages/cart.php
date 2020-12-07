<style>
   .cart-item-list tbody tr td{vertical-align: middle;}
   .cart-item-list thead tr th{text-align: center;}
   .btn-sm{background-color: #3d1a1b;color:#fff}
   .btn-sm:hover{background-color: #b3a1a2;color:#3d1a1b}
   .subtotal{display:inline-block}
   .section-checkout{margin:25px}
   #title-form{margin:50px 0px;}
   .input-form input, .input-form textarea, .input-form select{margin:15px 0px}
   .ketentuan h3{color: #962020}
   .ketentuan ol li{line-height: 1.5;margin: 10px 0px;}
   #notelp{color:#1e2bc3}
</style>
<div class="container">
   <table class="table table-hover cart-item-list">
      <thead>
         <tr>
            <th>#</th>
            <th style="width:15%">Produk</th>
            <th>Satuan</th>
            <th>Jumlah</th>
            <th>Harga/gram</th>
            <th>Harga</th>
         </tr>
      </thead>
      <tbody>
         <?php $no=1; foreach($data as $dt){ ?>
         <tr id="<?= $dt['id_kopi'] ?>">
            <td><?= $no ?></td>
            <td><center><img class="img-responsive" src="<?= $dt['foto_produk'] ?>"><?= $dt['nama_kopi'] ?></center></td>
            <td>
               <select class="form-control calc" id="satuan-<?= $dt['id_kopi'] ?>">
                  <option value="1">Gram</option>
                  <option value="2">Kilogram</option>
               </select>
            </td>
            <td><input class="form-control calc" id="berat-<?= $dt['id_kopi'] ?>" type="number" step=100 value="<?= $dt['jumlah'] ?>" min=100></td>
            <td>Rp <?= number_format($dt['harga_per_gram'], 2,",",".") ?><input id="hargapergram-<?= $dt['id_kopi'] ?>" style="display:none" value="<?= $dt['harga_per_gram'] ?>"></td>
            <td><span>Rp <div class="subtotal" id="harga-<?= $dt['id_kopi'] ?>"><?= number_format($dt['subtotal'], 2,",",".") ?></div></span></td> 
            <td><button class="btn btn-sm" onclick="removeRow(<?= $dt['id_kopi'] ?>)">x</button></td>
         </tr>
         <?php $no++;} ?>
      </tbody>
   </table>
   <div class="section-checkout">
      <div class="row">
            <div class="col-md-12">
            <button class="btn btn-success pull-right" id="checkout-btn">Checkout</button>
            <button class="btn btn-success pull-right" data-toggle="collapse" id="collapse-btn" data-target="#checkout-form" style="display:none">Checkout</button>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="collapse" id="checkout-form">
               <center id="title-form"><h2>Data Pembelian</h2></center>
               <form method="POST">
                  <div class="col-md-5 input-form">
                     <input type="text" class="form-control" name="order[nama]" placeholder="Nama Anda . . ." required>
                     <input type="text" class="form-control" name="order[telp]" id="number" placeholder="No telp Anda . . ." required>
                     <select class="form-control" name="order[kota]" required>
                        <option value="">- Pilih Kota-</option>
                        <option value="1">Jakarta (Rp. 8.000/kg)</option>
                        <option value="2">Luar Jakarta</option>
                     </select>
                     <textarea class="form-control" rows=5 name="order[alamat]" placeholder="Alamat jelas, beserta kota, kelurahan dan kecamatan . . ." required></textarea>
                     <input type="submit" class="btn btn-warning pull-right col-md-3" name="submit" value="Order" required>
                  </div>
                  <div class="col-md-6 col-md-offset-1 ketentuan">
                     <h3>Beberapa ketentuan untuk pemesanan:</h3>
                     <ol>
                        <li>Kami menggunakan jasa pengantaran JNE, dengan tarif Rp 8.000,00/Kg.</li>
                        <li>Untuk pengirimian di luar jakarta, kami akan menghubungi Anda maksimal 2x24jam setelah data order anda kami terima.</li>
                        <li>Untuk pertanyaan lebih lanjut, anda dapat menghubungi ke nomor <span id="notelp">(021)-999-999-999</span> (office hour: 07:30 - 17:00 WIB).</li>
                     </ol>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!--<div style="margin:50px 0px"></div>-->
</div>
<script>
   $("#checkout-btn").click(function(e){
      $.ajax({
         type: "POST",
         url: "?menu=cart&action=checkStock",
         //data:{subtotal:subtotal,jumlah:jumlah,id_kopi:rowNum},
         dataType:"json",
         success: function(data){

            if(data.stockHabis == true){
               alert('stok tidak mencukupi');
               $.each(data.alert, function( key, value ) {
                  $("#berat-"+key).attr('style','border:1px solid #e69f9f;background-color:#ffd3d3');
               });    
            }else{
               $("#collapse-btn").trigger('click');
            }
         }
      });
      
   })
   $(document).ready(function() {
      
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
      
      $(".calc").change(function(){
         var $id = $(this).attr('id');
         var input = $id.split("-")[0];
         var rowNum = $id.split("-").pop();
         
         if(input == "satuan"){
            calcSatuan(rowNum);
         }else if(input == "berat"){
            calcJumlah(rowNum);
         }else if(input == "remove"){
            removeRow(rowNum);
         }
         //alert(input);
      });
      
      function calcSatuan(rowNum){
         //1 => gram, 2 => kg
         var satuan = $("#satuan-"+rowNum).val();
         var jumlah = $("#berat-"+rowNum).val();
         
         if(satuan == 1){//if gram
            jumlah = jumlah * 1000;
            $("#berat-"+rowNum).attr('step', 100);
            $("#berat-"+rowNum).attr('min', 100);
         }else if(satuan == 2){//if kg
            jumlah = jumlah / 1000;
            $("#berat-"+rowNum).attr('step', 1);
            $("#berat-"+rowNum).attr('min', 1);
         }
         
         $("#berat-"+rowNum).val(jumlah);
      }
      
      function calcJumlah(rowNum){
         var validasiJum = validasiJumlah(rowNum);
         
         if(validasiJum == false){
            alert("minimal pembelian 100 gram");
         }
         
         var satuan = $("#satuan-"+rowNum).val();
         var jumlah = $("#berat-"+rowNum).val();
         var hargapergram = $("#hargapergram-"+rowNum).val();
         var subtotal = 0;
         
         if(satuan == 1){// if gram
            subtotal = jumlah * hargapergram;
         }else if (satuan == 2){//if kg
            jumlah = jumlah * 1000;
            subtotal = jumlah * hargapergram;
         }
         $.ajax({
            type: "POST",
            url: "?menu=cart&action=updateCart",
            data:{subtotal:subtotal,jumlah:jumlah,id_kopi:rowNum},
            dataType:"json",
            success: function(data){
               var totalHarga = data.totalHarga;
               //alert('sukses');
               $("#harga-"+rowNum).text(subtotal.formatMoney(2, '.', ','));
               $("#total-cart").text(data.totalHarga.formatMoney(2, '.', ','));
            }
         });
      }
      $("#number").keypress(function(e){
		 //if the letter is not digit then display error and don't type anything
		 if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			//display error message
			$("#errmsg").html("Harus angka").show().fadeOut("slow");
			return false;
		}
	  });
      function validasiJumlah(rowNum){
         var satuan = $("#satuan-"+rowNum).val();
         var jumlah = $("#berat-"+rowNum).val();
         
         if (satuan == 1){//if gram
            var minJumlahGram = 100;//dalam gram
         }else if (satuan == 2){//if kg
            jumlah = jumlah * 1000;
            var minJumlahGram = 1;//dalam gram
         }

         if(jumlah < 100){
            $("#satuan-"+rowNum).val(1);
            $("#berat-"+rowNum).val(minJumlahGram);
            return false;
         }else{
            return true;
         }
      }
   });
   
   function removeRow(rowNum){
      if(!confirm('Anda Yakin?')){
         //e.preventDefault();
         return false;
      }
      $.ajax({
         type: "POST",
         url: "?menu=cart&action=removeItem",
         data:{id_kopi:rowNum},
         dataType:"json",
         success: function(data){
            var totalHarga = data.totalHarga;
            $("#total-cart").text(data.totalHarga.formatMoney(2, '.', ','));
            if(data.totalHarga == 0){
               window.location = "?menu=product";
            }
            $('#'+rowNum).remove();
         }
      });
   }
</script>