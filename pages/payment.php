<style>
   .title{margin-bottom:50px; margin-top:25px}
   .form-payment{margin-top:50px;margin-bottom:50px}
   .form-payment label{margin-top:5px;}
   .form-payment .row{margin-top:20px}
   #preview-img{max-height:250px;margin-left:auto;margin-right:auto}
</style>
<?php if($alert == true){ ?>
      <div class="alert <?= (isset($sukses))? $sukses:"alert-danger" ?>">
          <center><?= $alertMsg ?></center>
      </div>
  <?php } ?>
<div class="container form-payment">
   <center><h2 class="title">Konfirmasi Pembayaran</h2></center>
   <form method="POST" enctype="multipart/form-data"> 
   <div class="row">
      <div class="col-md-2 col-md-offset-1">
         <label class="pull-right">No Order</label>
      </div>
      <div class="col-md-3">
         <input class="form-control" name="payment[id_order_hdr]" required>
      </div>
      
      <div class="col-md-2">
         <label class="pull-right">Tgl Pembayaran</label>
      </div>
      <div class="col-md-3">
         <!--<input class="form-control" name="payment[tgl_pembayaran]">-->
         <div class='input-group date' id='datepicker'>
            <input type='text' class="form-control orderInfo" name="payment[tgl_pembayaran]" id="Tanggal" required>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-2 col-md-offset-1">
         <label class="pull-right">Dari Bank</label>
      </div>
      <div class="col-md-3">
         <input class="form-control" name="payment[dari_bank]" required>
      </div>
      
      <div class="col-md-2">
         <label class="pull-right">Atas Nama</label>
      </div>
      <div class="col-md-3">
         <input class="form-control" name="payment[atas_nama]" required>
      </div>
   </div>
   <div class="row">
      <div class="col-md-2 col-md-offset-1">
         <label class="pull-right">Bukti Transfer</label>
      </div>
      <div class="col-md-3">
         <img id="preview-img" class="img-responsive margin-auto" src="">
         <input class="form-control" id="upload-file" type="file" name="foto_struk" required>
      </div>
      
      <div class="col-md-5">
         <input class="btn pull-right" type="submit" value="submit">
      </div>
   </div>
   </form>
</div>
<script>
   $('#datepicker').datepicker({
      format: "yyyy-mm-dd",
   });
   $("#upload-file").change(function() {
      var file = $(this).val();

      var fileExt = file.split('\\').pop().split(".").pop();
      if(fileExt == "jpg" || fileExt == "jpeg"){
         readURL(this);
      }else{
         $('#preview-img').removeAttr('src');
         alert("hanya menerima file jpg");
         $(this).val("");
         return false;
      }
   });
   function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
    
        reader.onload = function(e) {
          $('#preview-img').attr('src', e.target.result);
        }
    
        reader.readAsDataURL(input.files[0]);
      }
   }
   
</script>