<?php
//include('connection.php');
		
class payment{
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
		
		$target_dir = "images/struk/";
		$alert = false;
		$alertMsg = "";
		
		ob_start(); 
		
		if(isset($_POST['payment'])){
			$idOrder = ltrim($_POST['payment']['id_order_hdr'], '0');
			$tglPembayaran = $_POST['payment']['tgl_pembayaran'];
			$dariBank = $_POST['payment']['dari_bank'];
			$atasNama = $_POST['payment']['atas_nama'];
			
			$sql = "SELECT count(*) as cekId from order_header where id_order_hdr = ".$idOrder;
			$checkIdOrder = $conn->getRow($sql);
			
			if($checkIdOrder['cekId'] == 0){
				$alert = true;
				$alertMsg = "<strong>No Order tidak ditemukan</strong>";
			}else{
				$sql = "SELECT count(*) as cekbayar from pembayaran where id_order_hdr = ".$idOrder;
				$checkPembayaran = $conn->getRow($sql);
				
				if($checkPembayaran['cekbayar'] > 0){
					$alert = true;
					$alertMsg = "<strong>No Order sudah pernah dikonfirmasi</strong>";
				}else{
					if($_FILES["foto_struk"]["tmp_name"] != ""){
						
						$imageFileType = pathinfo($_FILES["foto_struk"]['name'],PATHINFO_EXTENSION);
						$target_file = $target_dir."payment_".$idOrder.$imageFileType;//GANTI JANGAN TEMBAK JPG

						//get file ext
						
						// Check if image file is a actual image or fake image
						$check = getimagesize($_FILES["foto_struk"]["tmp_name"]);
						
						if($imageFileType != "jpg" && $imageFileType != "jpeg") {
						   $alertMsg = "<strong>Gagal!</strong> File harus JPG atau JPEG";
						   $alert=true;
						}	
					 
						if (move_uploaded_file($_FILES["foto_struk"]["tmp_name"], $target_file)) {
							$sql = "INSERT INTO pembayaran (id_order_hdr, tgl_pembayaran, dari_bank, atas_nama, foto_struk)
									VALUES ('".$idOrder."', '".$tglPembayaran."', '".$dariBank."', '".$atasNama."', '".$target_file."')";
							
							$insert = $conn->executeQuery($sql);
							if($insert){
								$sql = "UPDATE order_header SET status = '2'
										WHERE id_order_hdr = ".$idOrder;
								
								$updateOrderHdr= $conn->executeQuery($sql);
								
								$alertMsg = "<strong>Sukses</strong> Konfirmasi Pembayaran sukses";
								$sukses = "alert-success";
								$alert=true;
							}
						} else {
							$alertMsg = "<strong>Error System</strong> Foto gagal diupload";
							$alert=true;
						}
					}
				}
			}
			
		}
		ob_get_contents();
		ob_end_clean();
		
		include('pages/payment.php');
		
	}
}
?>