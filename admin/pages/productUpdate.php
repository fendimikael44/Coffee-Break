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
<?php }else if(isset($_GET['saved'])){ ?>
   <div class="alert alert-success">
        <center><b>Sukses!</b> Produk berhasil diinput!</center>
    </div>
<?php } ?>
<div class="container" style="margin-top: 50px;margin-bottom: 50px;">
    <form method="POST"  enctype="multipart/form-data">
        <div class="row"style="margin-bottom: 20px;">
            <label class="col-md-4 col-md-offset-4 text-center">Nama Kopi</label>
            <div class="col-md-4 col-md-offset-4"><input class="form-control" value="<?= $data['nama_kopi'] ?>" name="kopi[nama_kopi]"></div>
        </div>
        <div class="col-md-12">
          <center>
             <img class="img-responsive" id="img-preview" src="../<?= $data['foto_produk'] ?>">
          </center>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div>
                    <input type="file" class="btn btn-cart margin-auto" name="foto_produk" id="fotoProduk">
                </div>
            </div>
            <div class="row" style="margin-top:15px">
                <div class="col-md-1 col-md-offset-2 text-right" style="margin-top:5px">
                  <label>Rp</label>
                </div>
                <div class="col-md-2">
                  <input class="form-control" value="<?= $data['harga'] ?>" name="kopi[harga]">
                </div>
                <div class="col-md-2 text-right" style="margin-top:5px">
                  <label class="label label-info" style="font-size:15px">Stok <?= number_format($data['stok'], 0,".",".") ?> gram</label>
                </div>
                <div class="col-md-2">
                  <input value="<?= $data['stok'] ?>" name="kopi[curStok]" style="display:none">
                  <input class="form-control" placeholder="restock. . ." name="kopi[reStock]">
                </div>
            </div>
        </div>
        <div class="col-md-12 artikel">
            <textarea class="form-control" rows=8  name="kopi[deskripsi]"><?= $data['deskripsi'] ?></textarea>
        </div>
        <center>
            <input type="submit" class="btn btn-success" value="update" name="submit">
        </center>
    </form>
</div>
<script>
    var curFoto = "../<?= $data['foto_produk'] ?>";
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