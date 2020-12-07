<style>
    /*.tb-dataorder tbody tr{cursor: pointer}*/
    .tb-dataorder tbody tr td{vertical-align: middle;word-break:break-word}
    .tb-dataorder tbody tr td:first-child { background-color:#ececec;}
    .tb-dataorder{margin-top:50px}
    .luar-jakarta{background-color:#ffc7c7}
    .modal-id-order{background-color:#b5f3f9;border-radius: 20px;padding: 5px;}
	.status-paid{background-color:#baffc2}
	.status-finish{background-color:#baccff}

	@media print{.container{width:100%}
		.btn{display: none;}
		.footer{display: none;}
		.header{display: none;}
		.header-top{display: none;}
		.no-print{display: none;}
	}
</style>

<div class="container" style="margin-top:25px;margin-bottom:25px">
	<div class="row no-print">
        <form method="POST">
            <div class="col-md-2">
                <input class="form-control" value="<?= $from ?>" id="from" placeholder='From' type="text" name='from' required>
            </div>
            <div class="col-md-2">
                <input class="form-control" value="<?= $to ?>" id="to" placeholder='To' type="text" name='to' required>
            </div>
            <div class="col-md-1">
                <button class="btn btn-info" type="submit" name='search'><span class="glyphicon glyphicon-search"></span></button>
            </div>
        </form>
		<form method="POST">
			<div class="col-md-2">
				<select class='form-control' name='order' required>
					<option <?= $order == "" ? 'selected' : '' ?> value=''>- Sort By -</option>
					<option <?= $order == "1" ? 'selected' : '' ?> value=1>Jumlah Terjual</option>
					<option <?= $order == "2" ? 'selected' : '' ?> value=2>Harga</option>
					<option <?= $order == "3" ? 'selected' : '' ?> value=3>Stok</option>
				</select>
			</div>
			<div class="col-md-2">
				<select class='form-control' name='jenis' required>				
					<option <?= $jenis == "ASC" ? 'selected' : '' ?> value="ASC">Ascending</option>
					<option <?= $jenis == "DESC" ? 'selected' : '' ?> value="DESC">Descending</option>
				</select>
			</div>
			<div class="col-md-1">
				<button class="btn btn-warning" type="submit" name='sort'><span class='glyphicon glyphicon-sort'></span></button>
			</div>
		</form>
		<div class="col-md-1 pull-right">
            <a href="#" onclick="window.print();" class="btn btn-primary"><span class='glyphicon glyphicon-print'></span></a>
        </div>
	</div>
    <table class="table table-hover tb-dataorder">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kopi</th>
                <th style="text-align: center;">Jumlah Terjual (Gram)</th>
                <th style="text-align: right;">Harga (100 Gram)</th>
                <th style="text-align: right;">Sub Total</th>
                <th style="text-align: center;">Sisa Stok (Gram)</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
                foreach($data as $d){
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $d['nama_kopi'] ?></td>
                <td style="text-align: center;"><?= $d['qty_jual'] ?></td>
                <td style="text-align: right;"><?= number_format($d['harga'], 2,",",".") ?></td>
                <td style="text-align: right;"><?= number_format($d['subtotal_jual'], 2,",",".") ?></td>
                <td style="text-align: center;"><?= $d['stok'] ?></td>
            </tr>
            <?php $no++;} ?>
        </tbody>
    </table>
</div>

<script>
    $("#from").datepicker({
        //monthNames: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
        //monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agust", "Sep", "Okt", "Nov", "Des"],
        //minDate: new Date(),
        format: "dd-mm-yyyy",
        //changeYear: true,
        //changeMonth: true,
        yearRange: "-0:+10",
    });

    $("#to").datepicker({
        //monthNames: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
        //monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agust", "Sep", "Okt", "Nov", "Des"],
        //minDate: new Date(),
        format: "dd-mm-yyyy",
        //changeYear: true,
        //changeMonth: true,
        yearRange: "-0:+10",
    });
</script>