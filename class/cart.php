<?php
//include('connection.php');
		
class cart{
   public function action($action){
      if($action == null){
         $this->view();
      }
      else{
         $this->$action();
      }
   }
   
   function showSession(){
	  echo "<pre>";
	  print_r($_SESSION);DIE;
   }
		
   private function view(){
      $conn = new connection(); 
      ob_start();
	  
      if(empty($_SESSION['cart']['items'])){
         header("Location: ?menu=product");
      }else{
         if(isset($_POST['order'])){
			
			//post data
			$tglOrder = date("Y-m-d");
			$nama = $_POST['order']['nama'];
			$telp = $_POST['order']['telp'];
			$kota = $_POST['order']['kota'];//untuk kota, 1 => jakarta, 2 => luar jakarta
			$alamat = $_POST['order']['alamat'];
			
			//session data
			$totalBerat = 0;
			foreach($_SESSION['cart']['items'] as $ses){
			   $totalBerat += $ses['jumlah'];
			}
			
			$totalBerat = ceil($totalBerat / 1000);
			//cek biaya perngiriman, jika diluar jakarta ,set biaya 0
			if($kota == 1){
			   $biayaPengiriman = $totalBerat * 8000;
			}else{
			   $biayaPengiriman = 0;
			}
			$grandTotal = $_SESSION['cart']['totalHarga'] + $biayaPengiriman;
			
			//save data header
			$sql = "INSERT INTO order_header (tgl_order, nama_customer, telp, alamat, biaya_pengiriman, total, total_berat)
				    VALUES ('".$tglOrder."','".$nama."', '".$telp."', '".$alamat."', '".$biayaPengiriman."', '".$grandTotal."', '".$totalBerat."')";
			$insertHdr = $conn->executeQuery($sql);
			
			$saveError = false;
			if($insertHdr){
			   $idOrder = $this->getLastIdOrder();
			   
			   //save data detail
			   foreach($_SESSION['cart']['items'] as $itm){
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
			   unset($_SESSION['cart']);
			   header("Location: ?menu=cart&&action=finishOrder&&noOrder=".$idOrder);
			}else{
			   die("terjadi error ketika save");
			}
			
		 }
         $data = $_SESSION['cart']['items'];

         ob_get_contents();
         ob_end_clean();
         
         include('pages/cart.php');
      }
	}
	
   private function finishOrder(){
	  $conn = new connection(); 
      ob_start();
	  
	  $idOrder = $_GET['noOrder'];
	  
	  $sql = "SELECT * from order_header WHERE id_order_hdr = ".$idOrder;
	  $data_hdr = $conn->getRow($sql);
	  
	  $sql = "SELECT dtl.*, bk.* from order_detail dtl
			  INNER JOIN bijih_kopi bk ON bk.id_kopi = dtl.id_kopi
			  WHERE id_order_hdr = ".$idOrder;
	  $data_dtl = $conn->getRows($sql);
	  
	  //echo "<pre>";print_r($data_hdr);print_r($data_dtl);die;
	  
	  ob_get_contents();
	  ob_end_clean();
	  
	  include('pages/finishOrder.php');
	}
	
   function getLastIdOrder(){
	  $conn = new connection();

	  $sql = "SELECT max(id_order_hdr) as maxId from order_header";
	  $maxId = $conn->getRow($sql);
	  
	  return $maxId['maxId'];
	}
	
   private function updateCart(){
	  $idKopi = $_POST['id_kopi'];
	  $subtotal = $_POST['subtotal'];
	  $jumlah = $_POST['jumlah'];
	  
	  //cari index array yang mau diupdate
	  $key = array_search($idKopi, array_column($_SESSION['cart']['items'], 'id_kopi'));
	  //$updateCart = $_SESSION['cart']['items'];
	  
	  //hapus total harga, untuk kemudian diupdate
	  $_SESSION['cart']['totalHarga'] = $_SESSION['cart']['totalHarga'] - $_SESSION['cart']['items'][$key]['subtotal'];
	  //update totalharga dengan harga terbaru
	  $_SESSION['cart']['totalHarga'] = $_SESSION['cart']['totalHarga'] + $subtotal;
	  
	  
	  //update data
	  $_SESSION['cart']['items'][$key]['subtotal'] = $subtotal;
	  $_SESSION['cart']['items'][$key]['jumlah'] = $jumlah;
	  
	  die('{"success":true,"totalHarga":'.Json_encode($_SESSION['cart']['totalHarga'] ).'}');
	}
   private function removeItem(){
	  $idKopi = $_POST['id_kopi'];
	  
	  //cari index array yang mau diupdate
	  $key = array_search($idKopi, array_column($_SESSION['cart']['items'], 'id_kopi'));
	  
	  $_SESSION['cart']['totalHarga'] = $_SESSION['cart']['totalHarga'] - $_SESSION['cart']['items'][$key]['subtotal'];
	  
	  unset($_SESSION['cart']['items'][$key]);
	  
	  die('{"success":true,"totalHarga":'.Json_encode($_SESSION['cart']['totalHarga'] ).'}');
	}
   private function getCurStock($idKopi){
	  $conn = new connection();
	  
	  $sql = "SELECT stok FROM bijih_kopi WHERE id_kopi = '".$idKopi."'";
	  $data = $conn->getRow($sql);
	  
	  return $data['stok'];
   }
   private function checkStock(){
	  $arrIdKopi = array();
	  $stockHabis = 'false';
	  foreach($_SESSION['cart']['items'] as $itm){
		 $curStock = $this->getCurStock($itm['id_kopi']);
		 
		 if($curStock < $itm['jumlah']){
			$stockHabis = 'true';
			$arrIdKopi[$itm['id_kopi']]['stok'] = $curStock;
		 }
	  }
	  die('{"success":true,"stockHabis":'.$stockHabis.',"alert":'.Json_encode($arrIdKopi).'}');
	  echo "<pre>";print_r($arrIdKopi);die;
   }
}
?>