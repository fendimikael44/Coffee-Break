<?php
//include('connection.php');
		
class report{
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
      
      	$order_by = " a.id_kopi";

      	$where = "";
      	$order = "0";
      	$jenis = "ASC";
      	$from= "";
      	$to= "";

      	if(isset($_POST['search'])){
      		$from = $_POST['from'];
      		$to = $_POST['to'];
      		$s_from = date("Y-m-d", strtotime($_POST['from']));
      		$s_to = date("Y-m-d", strtotime($_POST['to']));
      		
      		$where = " WHERE hdr.tgl_order BETWEEN '".$s_from."' AND '".$s_to."' ";
      	}

      	if(isset($_POST['sort'])){
      		$order = $_POST['order'];
      		$jenis = $_POST['jenis'];

      		if($order == "1"){
      			$order_by = " SUM(COALESCE(b.jumlah, 0)) ".$jenis;
      		}
      		else if($order == "2"){
      			$order_by = " a.harga ".$jenis;
      		}
      		else if($order == "3"){
      			$order_by = " a.stok ".$jenis;
      		}
      	}

      	$sql = "SELECT 
					a.id_kopi,
					a.nama_kopi,
					a.harga,
					a.foto_produk,
					a.stok,
					SUM(COALESCE(b.jumlah, 0)) qty_jual,
					SUM(COALESCE(b.subtotal, 0)) subtotal_jual
				FROM
					bijih_kopi a
					LEFT JOIN (
						SELECT
							dtl.id_kopi,
							dtl.jumlah,
							dtl.subtotal
						FROM
							order_header hdr
							INNER JOIN order_detail dtl
								ON dtl.id_order_hdr = hdr.id_order_hdr
						".$where."
					) b
						ON b.id_kopi = a.id_kopi
				WHERE
					1=1
				GROUP BY
					a.id_kopi
				ORDER BY
					".$order_by;
				
		$data = $conn->getRows($sql);
   		
      	ob_get_contents();
      	ob_end_clean();
      
      	include('pages/report.php');
	}

    function getLastAdmin(){
	  $conn = new connection();
	  ob_start();
	  
	  $sql = "SELECT max(id_admin) as maxId from admin";
	  $maxId = $conn->getRow($sql);
	  
      $sql = "SELECT username from admin WHERE id_admin = ".$maxId['maxId'];
      $username = $conn->getRow($sql);
	  return $username['username'];
	  
	  ob_get_contents();
      ob_end_clean();
	}
	
}
?>