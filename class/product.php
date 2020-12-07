<?php
//include('connection.php');
		
class product{
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
		// 	$sql = "select * from bijih_kopi where status = 1 AND id_kopi <= ".$mulai." ORDER BY id_kopi DESC LIMIT 6";
		// }else{
		// 	$sql = "select * from bijih_kopi where status = 1 ORDER BY id_kopi DESC LIMIT 6";
		// }
		
		$paging = "";
		$page=intval(isset($_GET['halaman']) ? $_GET['halaman'] : 1);
		$totalPerPage = 9;

		$sql = "select * from bijih_kopi where status = 1 ORDER BY id_kopi DESC";
		$data = $conn->getRowsPaging($sql, $page, $totalPerPage, $paging, "?menu=product");
		
		ob_get_contents();
		ob_end_clean();
		
		include('pages/product.php');
		
	}
	private function productDetail(){
		$conn = new connection(); 
		ob_start(); 
		
		$idKopi = $_GET['id_product'];
		
		$sql = "SELECT bk.id_kopi, bk.stok, bk.nama_kopi, bk.harga, bk.foto_produk, art.id_artikel, art.deskripsi FROM bijih_kopi bk
				LEFT JOIN artikel art on art.id_kopi = bk.id_kopi
				WHERE bk.id_kopi = ".$idKopi;
		$data = $conn->getRow($sql);

		//echo "<pre>";print_r($data);die;
		ob_get_contents();
		ob_end_clean();
		
		include('pages/productDetail.php');
		
	}
	
	function addCart(){
		$conn = new connection();
		
		$idKopi = $_POST['id_kopi'];
		$harga = $_POST['harga'];
		$hargaPerGram = $_POST['harga']/100;
		$namaKopi = $_POST['nama_kopi'];
		$fotoProduk= $_POST['foto_produk'];
		
		//$checkStock = $this->checkStock($idKopi);
		//if($checkStock == false){
		//	die('{"success":true,"totalHarga":'.Json_encode($_SESSION['cart']['totalHarga'] ).'}');
		//}
		//$sql = "SELECT stok FROM bijih_kopi WHERE id_kopi = ".$idKopi;
		//$checkStock = $conn->getRows($sql);
		//
		//echo "<pre>";print_r($checkStock);die;
		
		$_SESSION['cart']['totalHarga'] = 0;
		if(!isset($_SESSION['cart']['items'])){
			$_SESSION['cart']['items'][0]['id_kopi']= $idKopi;
			$_SESSION['cart']['items'][0]['jumlah']= 100;
			$_SESSION['cart']['items'][0]['harga']= $harga;
			$_SESSION['cart']['items'][0]['harga_per_gram']= $hargaPerGram;
			$_SESSION['cart']['items'][0]['subtotal']= $_SESSION['cart']['items'][0]['harga_per_gram'] * $_SESSION['cart']['items'][0]['jumlah'];
			$_SESSION['cart']['items'][0]['nama_kopi']= $namaKopi;
			$_SESSION['cart']['items'][0]['foto_produk']= $fotoProduk;
			
			$_SESSION['cart']['totalHarga'] += $_SESSION['cart']['items'][0]['subtotal'];

		}else{
			$key = count($_SESSION['cart']['items']);
			$sameId = false;
			
			foreach($_SESSION['cart']['items'] as $idx=>$cart){
				if($cart['id_kopi'] == $idKopi && $sameId == false){
					$sameId = true;
					//$key = $idx;
					$_SESSION['cart']['items'][$idx]['jumlah'] += 100;
					$_SESSION['cart']['items'][$idx]['subtotal']= $_SESSION['cart']['items'][$idx]['harga_per_gram'] * $_SESSION['cart']['items'][$idx]['jumlah'];
				}
				$_SESSION['cart']['totalHarga'] += $_SESSION['cart']['items'][$idx]['subtotal'];
			}
			if($sameId == false){
				$_SESSION['cart']['items'][$key]['id_kopi']= $idKopi;
				$_SESSION['cart']['items'][$key]['jumlah']= 100;
				$_SESSION['cart']['items'][$key]['harga']= $harga;
				$_SESSION['cart']['items'][$key]['harga_per_gram']= $hargaPerGram;
				$_SESSION['cart']['items'][$key]['subtotal']= $_SESSION['cart']['items'][$key]['harga_per_gram'] * $_SESSION['cart']['items'][$key]['jumlah'];
				$_SESSION['cart']['items'][$key]['nama_kopi']= $namaKopi;
				$_SESSION['cart']['items'][$key]['foto_produk']= $fotoProduk;
				
				$_SESSION['cart']['totalHarga'] += $_SESSION['cart']['items'][$key]['subtotal'];
			}
		}
		//echo "<pre>";print_r($_SESSION);
		die('{"success":true,"totalHarga":'.Json_encode($_SESSION['cart']['totalHarga'] ).'}');
	}
	
	//private function checkStock($idKopi){
	//	$conn = new connection();
	//	
	//	$sql = "SELECT stok FROM bijih_kopi WHERE id_kopi = ".$idKopi;
	//	$curStock = $conn->getRow($sql);
	//	
	//	$checkStock = 
	//}
	
	private function destroySession(){
		session_unset();
		session_destroy();
	}
	
	private function viewSession(){
		echo "<pre>";print_r($_SESSION);die;
	}
}
?>