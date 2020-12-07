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
   .pengiriman{background-color: #e0fff9}
   .total{background-color:#c3e2dc}
   .paragraph{margin:20px 0px}
   .paragraph h1, .paragraph p{text-align: center}
   .paragraph h1{margin-bottom:25px}
   .bank-logo{max-width: 150px;margin: 0px auto;}
   .prd-info{max-width:155px;word-wrap:break-word; }
</style>
<div class="container">
   <div class="row" style="margin-top:25px">
      <div class="col-md-3">
         Tanggal Order: <label class="label label-info" style="font-size:15px"><?= date("d, M Y",strtotime($data_hdr['tgl_order'])) ?></label>
      </div>
   </div>
   <table class="table table-hover cart-item-list">
      <thead>
         <tr>
            <th>#</th>
            <th style="width:15%">Produk</th>
            <th>Jumlah</th>
            <!--<th>Harga/gram</th>-->
            <th>Subtotal</th>
         </tr>
      </thead>
      <tbody>
         <?php $no=1; foreach($data_dtl as $dtl){ ?>
         <tr>
            <td><?= $no ?></td>
            <td><center class="prd-info"><img class="img-responsive" src="../<?= $dtl['foto_produk'] ?>"><?= $dtl['nama_kopi'] ?></center></td>
            <td><center> <?= number_format($dtl['jumlah'], 0,",",".") ?> Gram</center></td>
            <td><center><span>Rp <div class="subtotal"><?= number_format($dtl['subtotal'], 2,",",".") ?></div></span></center></td> 
         </tr>
         <?php $no++;} ?>
         <!--<tr class="pengiriman">-->
         <!--   <td colspan=3><span class="pull-right">Biaya Pengiriman</span></td>-->
         <!--   <td><center><?= ($data_hdr['biaya_pengiriman'] == 0)? "<b>belum termasuk</b>" : "Rp ".number_format($data_hdr['biaya_pengiriman'], 0,",",".") ?> (<?= number_format($data_hdr['total_berat'], 0,",",".") ?> Kg)</center></td>-->
         <!--</tr>-->
         <tr class="total">
            <td colspan=3><span class="pull-right"><b>Total</b></span></td>
            <td><center><b>Rp <?= number_format($data_hdr['total'], 0,",",".") ?></b></center></td>
         </tr>
      </tbody>
   </table>
</div>