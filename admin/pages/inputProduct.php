<style>
   .artikel{margin:20px 0px}
   .artikel p{text-align: justify;line-height:2}
   .btn-cart{color: #fff;background-color: #443005;border-color: #443005;}
   .btn-cart:hover{color: #000;background-color: #e4ddcd; transition: background-color 0.5s ease;}
   .btn-cart:focus{color:#fff}
   #img-preview{max-width:400px;max-height:300px}
   .margin-auto{margin-left: auto;margin-right: auto;}
</style>
<?php if($alert == true){ ?>
    <div class="alert <?= (isset($sukses))? $sukses:"alert-danger" ?>">
        <center><?= $alertMsg ?></center>
    </div>
<?php } ?>
<div class="container" style="margin-top: 50px;margin-bottom: 50px;">
    <form method="POST"  enctype="multipart/form-data">
        <div class="row"style="margin-bottom: 20px;">
            <label class="col-md-4 col-md-offset-4 text-center">Nama Kopi</label>
            <div class="col-md-4 col-md-offset-4"><input class="form-control" placeholder="Nama Kopi. . ." name="kopi[nama_kopi]" required></div>
        </div>
        <div class="col-md-12">
          <center>
             <img class="img-responsive" id="img-preview" src="../images/400x300.png">
          </center>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div>
                     <br/>
                    <input type="file" class="btn btn-cart margin-auto" name="foto_produk" id="fotoProduk" required>
                     <br/>
                    <!--<button class="btn btn-cart" >add to cart</button><br><span>Rp <?= number_format($data['harga'], 0,".",".") ?> /100 gram</span>-->
                </div>
            </div>
            <div class="row">
                <div class="col-md-1 col-md-offset-4 text-right" style="margin-top:5px">
                  <label>Rp</label>
                </div>
                <div class="col-md-2">
                  <input class="form-control" placeholder="Harga Kopi /100 grm" name="kopi[harga]" required>
                  <?php // number_format($data['harga'], 0,".",".") ?>
                </div>
            </div>
        </div>
        <div class="col-md-12 artikel">
            <textarea class="form-control" rows=8 placeholder="Deskripsi kopi. . ." name="kopi[deskripsi]" required></textarea>
        </div>
        <center>
            <input type="submit" class="btn btn-success" value="Input" name="submit">
        </center>
    </form>
</div>
<script>
    var curFoto = "../400x300.png";
    $("#fotoProduk").change(function() {
      var file = $(this).val();

      var fileExt = file.split('\\').pop().split(".").pop();
      if(fileExt == "jpg" || fileExt == "jpeg"){
         readURL(this);
      }else{
         $('#img-preview').attr('src',curFoto);
         alert("hanya menerima file jpg");
         $(this).val("");
         return false;
      }
   });
   function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
    
        reader.onload = function(e) {
          $('#img-preview').attr('src', e.target.result);
        }
    
        reader.readAsDataURL(input.files[0]);
      }
   }
</script>