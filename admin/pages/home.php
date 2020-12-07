<style>
    .tb-dataorder tbody tr{cursor: pointer}
    .tb-dataorder tbody tr td{vertical-align: middle;word-break:break-word}
    .tb-dataorder tbody tr td:first-child { background-color:#ececec;}
    .tb-dataorder{margin-top:50px}
    .luar-jakarta{background-color:#ffc7c7}
    .modal-id-order{background-color:#b5f3f9;border-radius: 20px;padding: 5px;}
	.status-paid{background-color:#baffc2}
	.status-finish{background-color:#baccff}
</style>
<?php
    if(!isset($_GET['paging'])){
        $activePaging = 1;
    }else{
        $activePaging = $_GET['paging'];
    }
		
?>

<div class="container" style="margin-top:25px;margin-bottom:25px">
    
	<?php if(empty($dataOrder)){
			echo "<center><h2>Tidak Ada Data</h2><hr></center>";
		}else{
			echo "<center><h2>List Order Online</h2><hr></center>";
		}
	?>
	<?php if(isset($alert)){ ?>
	<div class="col-md-12">
		<div class="alert <?= $alert ?>" style="text-align:center">
			<?= $messages ?>
		</div>
	</div>
	<?php } ?>
	<div class="row">
		<form method="POST">
			<div class="col-md-2">
				<input class="form-control" placeholder='search No Order' type="text" name='idOrder' required>
			</div>
			<div class="col-md-1">
				<button class="btn btn-info" type="submit" name='search'><span class="glyphicon glyphicon-search"></span></button>
			</div>
		</form>
		<form method="POST">
			<div class="col-md-2 col-md-offset-6">
				<select class='form-control' name='status' required>
					<option value=''>- Search By -</option>
					<option value='all'>All</option>
					<option value=1>New Order</option>
					<option value=2>Paid</option>
					<option value=4>Finish</option>
				</select>
			</div>
			<div class="col-md-1">
				<button class="btn btn-warning" type="submit" name='sort'><span class='glyphicon glyphicon-sort'></span></button>
			</div>
		</form>
	</div>
    <table class="table table-hover tb-dataorder">
        <thead>
            <tr>
                <th style="width: 8%;">No Order</th>
                <th style="width: 10%;">Tgl Order</th>
                <th style="width: 10%;">Customer</th>
                <th style="width: 12%;">Telp</th>
                <th style="width: 30%;">Alamat</th>
                <th style="width: 15%;">Biaya Pengiriman</th>
                <th style="width: 15%;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
                foreach($dataOrder as $key =>$do){
            ?>
            <tr onclick="orderItem(<?= $key ?>)" class="<?= ($do['status'] == 2)? "status-paid":($do['status'] == 4? "status-finish":"") ?>">
                <td><b>#<?= str_pad($do['id_order_hdr'], 5, '0', STR_PAD_LEFT) ?></b></td>
                <td><?= date("d, M Y",strtotime($do['tgl_order'])) ?></td>
                <td><?= $do['nama_customer'] ?></td>
                <td><?= $do['telp'] ?></td>
                <td><?= $do['alamat'] ?></td>
                <td class='<?= ($do['biaya_pengiriman'] == 0)? "luar-jakarta" : "" ?>'><?= ($do['biaya_pengiriman'] == 0)? "Luar Jakarta" : "Rp <span class='pull-right'>".number_format($do['biaya_pengiriman'], 0,",",".")."</span>" ?></td>
                <td>Rp <span class="pull-right"><?= number_format($do['total'], 0,",",".") ?></span></td>
            </tr>
            <?php $no++;} ?>
        </tbody>
    </table>
    <center>	
        <?= $paging ?>
    </center>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">No Order: <span class="modal-id-order"></span></h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
    var dataOrder = <?= json_encode($dataOrder) ?>;
    //console.log(dataOrder);
    function orderItem(idOrder){
        console.log(dataOrder[idOrder]);
        var itemContent = "";
        $("#myModal").modal();
        
        $(".modal-title span").text("#"+String("00000" + idOrder).slice(-5));
        if(dataOrder[idOrder]['status'] == 2){
			itemContent += "<div class='row'>"+
						   "	<div class='col-md-offset-2 col-md-8'>"+
						   "		<img class='img-responsive' src='../"+dataOrder[idOrder]['foto_struk']+"'>"+
						   "	</div>"+
						   "</div>"+
						   "<form method='POST'><div class='row'>"+
						   "	<center><input class='btn btn-success' type='submit' name='finish'></center>"+
						   "	<input class='form-control' style='display:none' name='idOrder' value='"+idOrder+"' required>"+
						   "</div></form>";
		}else{
			 itemContent +=  "<table class='table table-hover'>"+
							 "<thead><tr><th>Kopi</th><th>Jumlah</th><th>Subtotal</th></tr></thead><tbody>";
        
			$.each( dataOrder[idOrder]['items'], function( key, value ) {
			   itemContent += "<tr>"+
							  "     <td>"+value['nama_kopi']+"</td>"+
							  "     <td>"+value['jumlah']+" gram</td>"+
							  "     <td>"+value['subtotal']+"</td>"+
							  "<tr>";
			});        
			itemContent += "</tbody></table>";
			//itemContent += "<button class='btn'>asd</button>";
			
			if(dataOrder[idOrder]['biaya_pengiriman'] == 0){
				itemContent += "<form method='POST'>"+
							   "	<div class='row'>"+
							   "		<div class='col-md-4 col-md-offset-5'>"+
							   "			<input class='form-control' placeholder='biaya pengiriman' name='biayaPengiriman' required>"+
							   "			<input class='form-control' style='display:none' name='idOrder' value='"+idOrder+"' required>"+
							   "		</div>"+
							   "		<div class='col-md-3'>"+
							   "			<input class='btn btn-success' type='submit' value='save'>"+
							   "		</div>"+
							   "	</div>"+
							   "</form>";
			}
		}
       
		
        $(".modal-body").empty();
        $(".modal-body").append(itemContent);
    }
  
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