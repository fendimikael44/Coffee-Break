<?php
//include('connection.php');
		
class order{
	public function action($action){
		if($action == null){
			$this->view();
		}
		else{
			$this->$action();
		}
	}
		
	private function view(){
		$conn = new connection(); 
		ob_start(); 
		
        //pagingnation
		// $query_pagingLink = "SELECT id_kopi FROM bijih_kopi WHERE status = 1 ORDER BY id_kopi DESC";
		// $pagingLink = $conn->getRows($query_pagingLink);
		
		// if(isset($_GET['paging'])){
		// 	$mulai = $_GET['paging'];
		// 	$sql = "select * from bijih_kopi where status = 1 AND id_kopi <= ".$mulai." ORDER BY id_kopi DESC LIMIT 15";
		// }else{
		// 	$sql = "select * from bijih_kopi where status = 1 ORDER BY id_kopi DESC LIMIT 15";
		// }
		
		$paging = "";
		$page=intval(isset($_GET['halaman']) ? $_GET['halaman'] : 1);
		$totalPerPage = 15;

		$sql = "select * from bijih_kopi where status = 1 ORDER BY id_kopi DESC";
		$data = $conn->getRowsPaging($sql, $page, $totalPerPage, $paging, "?menu=order");
        
		ob_get_contents();
		ob_end_clean();
		
		include('pages/order.php');
		
	}
    
    private function updateCartAdmin(){
	  $idKopi = $_POST['id_kopi'];
	  $subtotal = $_POST['subtotal'];
	  $jumlah = $_POST['jumlah'];
	  
	  //cari index array yang mau diupdate
	  $key = array_search($idKopi, array_column($_SESSION['cartadmin']['items'], 'id_kopi'));
	  //$updateCart = $_SESSION['cart']['items'];
	  
	  //hapus total harga, untuk kemudian diupdate
	  $_SESSION['cartadmin']['totalHarga'] = $_SESSION['cartadmin']['totalHarga'] - $_SESSION['cartadmin']['items'][$key]['subtotal'];
	  //update totalharga dengan harga terbaru
	  $_SESSION['cartadmin']['totalHarga'] = $_SESSION['cartadmin']['totalHarga'] + $subtotal;
	  
	  
	  //update data
	  $_SESSION['cartadmin']['items'][$key]['subtotal'] = $subtotal;
	  $_SESSION['cartadmin']['items'][$key]['jumlah'] = $jumlah;
	  
	  die('{"success":true,"totalHarga":'.Json_encode($_SESSION['cartadmin']['totalHarga'] ).'}');
	}
    
    private function adminCart(){
      $conn = new connection(); 
	  ob_start();
        
      if(empty($_SESSION['cartadmin']['items'])){
         header("Location: ?menu=order");
      }else{
         if(isset($_POST['order'])){
            
            //post data
            $tglOrder = date("Y-m-d");
			$nama = $_SESSION["username"]." (offline)";
			$telp = "-";
			$kota = 2;//untuk kota, 1 => jakarta, 2 => luar jakarta
			$alamat = "Pembelian di toko";
			$status = 3;// status pembelian langsung di toko
            
			//session data
			$totalBerat = 0;
			foreach($_SESSION['cartadmin']['items'] as $ses){
			   $totalBerat += $ses['jumlah'];
			}
			
			$totalBerat = ceil($totalBerat / 1000);
			//cek biaya perngiriman, jika diluar jakarta ,set biaya 0
			if($kota == 1){
			   $biayaPengiriman = $totalBerat * 8000;
			}else{
			   $biayaPengiriman = 0;
			}
			$grandTotal = $_SESSION['cartadmin']['totalHarga'] + $biayaPengiriman;
			
			//save data header
			$sql = "INSERT INTO order_header (tgl_order, nama_customer, telp, alamat, biaya_pengiriman, total, total_berat, status)
				    VALUES ('".$tglOrder."','".$nama."', '".$telp."', '".$alamat."', '".$biayaPengiriman."', '".$grandTotal."', '".$totalBerat."', '".$status."')";
			$insertHdr = $conn->executeQuery($sql);
			
			$saveError = false;
			if($insertHdr){
			   $idOrder = $this->getLastIdOrder();
			   
			   //save data detail
			   foreach($_SESSION['cartadmin']['items'] as $itm){
				  $sql = "INSERT INTO order_detail (id_order_hdr, id_kopi, jumlah, subtotal)
						  VALUES ('".$idOrder."', '".$itm['id_kopi']."', '".$itm['jumlah']."', '".$itm['subtotal']."')";
				  $insertDtl = $conn->executeQuery($sql);
				  
				  if($insertDtl){
					 $stockGudang = $this->getCurStock($itm['id_kopi']);
					 $jmlhOrder = $stockGudang - $itm['jumlah'];
					 
					 $sql = "UPDATE bijih_kopi SET stok = '".$jmlhOrder."' WHERE id_kopi = '".$itm['id_kopi']."'";
					 $updateStock = $conn->executeQuery($sql);
					 if(!$updateStock){die("error update stok");}
				  }
			   }
			}else{
			   $saveError = true;
			}
			
			//if success redirect to afterOrder
			if($saveError == false){
			   unset($_SESSION['cartadmin']);
			   header("Location: ?menu=order&&action=finishOrderAdmin&&noOrder=".$idOrder);
               die("sukses");
			}else{
			   die("terjadi error ketika save");
			}
         }
         $data = $_SESSION['cartadmin']['items'];
      }
      ob_get_contents();
      ob_end_clean();
      
      include('pages/cart.php');
    }
    
    private function showSession(){
    	echo "<pre>";
    	print_r($_SESSION);
    	DIE;
    }

    private function removeItem(){
	  $idKopi = $_POST['id_kopi'];
	  
	  //cari index array yang mau diupdate
	  $key = array_search($idKopi, array_column($_SESSION['cartadmin']['items'], 'id_kopi'));
	  // echo "idkopi: ".$idKopi." ==> ".$key;die;
	  $_SESSION['cartadmin']['totalHarga'] = $_SESSION['cartadmin']['totalHarga'] - $_SESSION['cartadmin']['items'][$key]['subtotal'];
	  
	  unset($_SESSION['cartadmin']['items'][$key]);
	  $_SESSION['cartadmin']['items'] = array_values($_SESSION['cartadmin']['items']);
	  
	  die('{"success":true,"totalHarga":'.Json_encode($_SESSION['cartadmin']['totalHarga'] ).'}');
	}
    
    private function addCartAdmin(){
      $conn = new connection();
      
      $idKopi = $_POST['id_kopi'];
      $sql = "SELECT * FROM bijih_kopi WHERE id_kopi = ".$idKopi;
      $dataKopi = $conn->getRow($sql);
      
      $harga = $dataKopi['harga'];
      $hargaPerGram = $dataKopi['harga']/100;
      $namaKopi = $dataKopi['nama_kopi'];
      $fotoProduk= "../".$dataKopi['foto_produk'];
      
      $_SESSION['cartadmin']['totalHarga'] = 0;
      if(!isset($_SESSION['cartadmin']['items'])){
          $_SESSION['cartadmin']['items'][0]['id_kopi']= $idKopi;
          $_SESSION['cartadmin']['items'][0]['jumlah']= 100;
          $_SESSION['cartadmin']['items'][0]['harga']= $harga;
          $_SESSION['cartadmin']['items'][0]['harga_per_gram']= $hargaPerGram;
          $_SESSION['cartadmin']['items'][0]['subtotal']= $_SESSION['cartadmin']['items'][0]['harga_per_gram'] * $_SESSION['cartadmin']['items'][0]['jumlah'];
          $_SESSION['cartadmin']['items'][0]['nama_kopi']= $namaKopi;
          $_SESSION['cartadmin']['items'][0]['foto_produk']= $fotoProduk;
          
          $_SESSION['cartadmin']['totalHarga'] += $_SESSION['cartadmin']['items'][0]['subtotal'];

      }else{
          $key = count($_SESSION['cartadmin']['items']);
          $sameId = false;
          
          foreach($_SESSION['cartadmin']['items'] as $idx=>$cart){
              if($cart['id_kopi'] == $idKopi && $sameId == false){
                  $sameId = true;
                  //$key = $idx;
                  $_SESSION['cartadmin']['items'][$idx]['jumlah'] += 100;
                  $_SESSION['cartadmin']['items'][$idx]['subtotal']= $_SESSION['cartadmin']['items'][$idx]['harga_per_gram'] * $_SESSION['cartadmin']['items'][$idx]['jumlah'];
              }
              $_SESSION['cartadmin']['totalHarga'] += $_SESSION['cartadmin']['items'][$idx]['subtotal'];
          }
          if($sameId == false){
              $_SESSION['cartadmin']['items'][$key]['id_kopi']= $idKopi;
              $_SESSION['cartadmin']['items'][$key]['jumlah']= 100;
              $_SESSION['cartadmin']['items'][$key]['harga']= $harga;
              $_SESSION['cartadmin']['items'][$key]['harga_per_gram']= $hargaPerGram;
              $_SESSION['cartadmin']['items'][$key]['subtotal']= $_SESSION['cartadmin']['items'][$key]['harga_per_gram'] * $_SESSION['cartadmin']['items'][$key]['jumlah'];
              $_SESSION['cartadmin']['items'][$key]['nama_kopi']= $namaKopi;
              $_SESSION['cartadmin']['items'][$key]['foto_produk']= $fotoProduk;
              
              $_SESSION['cartadmin']['totalHarga'] += $_SESSION['cartadmin']['items'][$key]['subtotal'];
          }
      }
      //echo "<pre>";print_r($_SESSION);
      die('{"success":true,"totalHarga":'.Json_encode($_SESSION['cartadmin']['totalHarga'] ).'}');
	}
    
    
    private function finishOrderAdmin(){
      $conn = new connection();
      ob_start();
      
      $idOrder = $_GET['noOrder'];
	  
	  $sql = "SELECT * from order_header WHERE id_order_hdr = ".$idOrder;
	  $data_hdr = $conn->getRow($sql);
	  
	  $sql = "SELECT dtl.*, bk.* from order_detail dtl
			  INNER JOIN bijih_kopi bk ON bk.id_kopi = dtl.id_kopi
			  WHERE id_order_hdr = ".$idOrder;
	  $data_dtl = $conn->getRows($sql);
      
      ob_get_contents();
      ob_end_clean();
      include('pages/finishOrderAdmin.php');
      
    }
    
    function getLastIdOrder(){
	  $conn = new connection();

	  $sql = "SELECT max(id_order_hdr) as maxId from order_header";
	  $maxId = $conn->getRow($sql);
	  
	  return $maxId['maxId'];
	}
    
    private function getCurStock($idKopi){
	  $conn = new connection();
	  
	  $sql = "SELECT stok FROM bijih_kopi WHERE id_kopi = '".$idKopi."'";
	  $data = $conn->getRow($sql);
	  
	  return $data['stok'];
	}
}
?>