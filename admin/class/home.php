<?php
//include('connection.php');
		
class home{
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
		
		$paging = "";
		$page=intval(isset($_GET['halaman']) ? $_GET['halaman'] : 1);
		$totalPerPage = 10;

		$dataOrder = array();
		$filterStatus = "ohd.status NOT IN(3)";
		$filterNoOrder = "";
		
		//sort by status
		if(isset($_POST['sort'])){
			$selectedStatus = $_POST['status'];
			if($selectedStatus != "all"){
				$filterStatus = "ohd.status = ".$selectedStatus;
			}
		}
		
		//untuk finish order
		if(isset($_POST['finish'])){
			$idOrder = $_POST['idOrder'];
			
			$sql = "UPDATE order_header SET status = '4' WHERE id_order_hdr = ".$idOrder;
			$updateOrderHdr = $conn->executeQuery($sql);
			if($updateOrderHdr){
				$alert = "alert-success";
				$messages = "No Order <b>#".str_pad($idOrder, 5, '0', STR_PAD_LEFT)."</b> telah diproses";
			}
		}
		
		//masukin biaya pengiriman
		if(isset($_POST['biayaPengiriman'])){
			$idOrder = $_POST['idOrder'];
			
			$biayaPengiriman = $_POST['biayaPengiriman'];
			$sql = "UPDATE order_header SET biaya_pengiriman = '".$biayaPengiriman."' WHERE id_order_hdr = ".$idOrder;
			$updateOrderHdr = $conn->executeQuery($sql);
			if($updateOrderHdr){
				$alert = "alert-success";
				$messages = "No Order <b>#".str_pad($idOrder, 5, '0', STR_PAD_LEFT)."</b> telah diupdate";
			}
		}
		
		
		//search nomor order
		if(isset($_POST['search'])){
			$idOrder = ltrim($_POST['idOrder'], '0');
			
			$sql =  "SELECT ohd.*, pmb.id_pembayaran, pmb.tgl_pembayaran, pmb.dari_bank, pmb.atas_nama, pmb.foto_struk,
								sto.status as nama_status FROM order_header ohd
						LEFT JOIN pembayaran pmb ON ohd.id_order_hdr = pmb.id_order_hdr
						LEFT JOIN status_order sto ON ohd.status = sto.id_status
						WHERE ohd.id_order_hdr = ".$idOrder;
		}else{
			//pagination button
			// $query_pagingLink = "SELECT id_order_hdr FROM order_header ohd WHERE ".$filterStatus." ORDER BY id_order_hdr DESC";
			// $pagingLink = $conn->getRows($query_pagingLink);

			//data by paging
			// if(isset($_GET['paging'])){
			// 	$mulai = $_GET['paging'];

			// 	$sql =  "SELECT ohd.*, pmb.id_pembayaran, pmb.tgl_pembayaran, pmb.dari_bank, pmb.atas_nama, pmb.foto_struk,
			// 					sto.status as nama_status FROM order_header ohd
			// 			LEFT JOIN pembayaran pmb ON ohd.id_order_hdr = pmb.id_order_hdr
			// 			LEFT JOIN status_order sto ON ohd.status = sto.id_status
			// 			WHERE ohd.id_order_hdr <= ".$mulai." AND ".$filterStatus." ORDER BY ohd.id_order_hdr DESC LIMIT 10";
			// }else{
			// 	$sql =  "SELECT ohd.*, pmb.id_pembayaran, pmb.tgl_pembayaran, pmb.dari_bank, pmb.atas_nama, pmb.foto_struk,
			// 					sto.status as nama_status FROM order_header ohd
			// 			LEFT JOIN pembayaran pmb ON ohd.id_order_hdr = pmb.id_order_hdr
			// 			LEFT JOIN status_order sto ON ohd.status = sto.id_status
			// 			WHERE ".$filterStatus." ORDER BY id_order_hdr DESC LIMIT 10";
			// }

			$sql = "SELECT ohd.*, pmb.id_pembayaran, pmb.tgl_pembayaran, pmb.dari_bank, pmb.atas_nama, pmb.foto_struk,
			 					sto.status as nama_status FROM order_header ohd
			 			LEFT JOIN pembayaran pmb ON ohd.id_order_hdr = pmb.id_order_hdr
			 			LEFT JOIN status_order sto ON ohd.status = sto.id_status
			 			WHERE ".$filterStatus." ORDER BY id_order_hdr DESC";
		}
		
		// $dataOrderHdr = $conn->getRows($sql);
		$dataOrderHdr = $conn->getRowsPaging($sql, $page, $totalPerPage, $paging, "?menu=home");

		foreach($dataOrderHdr as $hdr){
			$dataOrder[$hdr['id_order_hdr']] = $hdr;
			$sql = "SELECT odt.jumlah, odt.subtotal, bk.nama_kopi FROM order_detail odt
					INNER JOIN bijih_kopi bk ON odt.id_kopi = bk.id_kopi
					WHERE odt.id_order_hdr = ".$hdr['id_order_hdr'];
			
			$dataOrderDtl = $conn->getRows($sql);
			
			$dataOrder[$hdr['id_order_hdr']]['items'] = $dataOrderDtl;
		}
		
		ob_get_contents();
		ob_end_clean();
		
		include('pages/home.php');
		
	}
	
	function showSession(){
		echo "<pre>";
		print_r($_SESSION);
		die;
	}
}
?>