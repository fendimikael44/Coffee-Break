<style>
		.stok-tipis{background-color:#f7c4c4 !important}
</style>
<?php
		
		if(!isset($_GET['paging'])){
			$activePaging = 1;
		}else{
			$activePaging = $_GET['paging'];
		}
		
	?>
<div class="container" style="margin-top:25px;margin-bottom:25px">
    <div class="col-md-12" style="margin-bottom:25px">
       <a href="?menu=productList&&action=inputProduct"><button class="btn btn-warning">Add Product</button></a> 
    </div>
    <section>
        <ul id="da-thumbs" class="da-thumbs">
            <?php foreach($data as $dt){ ?>
            <li class="<?= ($dt['stok'] <10000)? "stok-tipis":"" ?>">
                <a href="?menu=productList&&action=productUpdate&&id_product=<?= $dt['id_kopi'] ?>"  class="b-link-stripe b-animate-go  thickbox">
                    <img src="../<?= $dt['foto_produk'] ?>" alt="" />
                    <div>
                        <h5><?= $dt['nama_kopi'] ?></h5>
                        <span>Stok: <?= number_format($dt['stok'], 0,".",".") ?> gram</span>
                    </div>
                </a>
            </li>
            <?php } ?>
            
        </ul>
    </section>
    <div class="product" style="">
        <center>
            
            <?= $paging ?>
        </center>
    </div>
</div>
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