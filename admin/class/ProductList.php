<?php
//include('connection.php');
		
class productList{
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
		$totalPerPage = 6;

		$sql = "select * from bijih_kopi where status = 1 ORDER BY id_kopi DESC";
		$data = $conn->getRowsPaging($sql, $page, $totalPerPage, $paging, "?menu=productList");
		
		ob_get_contents();
		ob_end_clean();
		
		include('pages/productList.php');
		
	}
    
    private function productUpdate(){
        $conn = new connection(); 
		ob_start();
        $target_dir = "../images/produk/";
		$alert = false;
		$alertMsg = "";
        
        $idKopi = $_GET['id_product'];
        
        $sql = "SELECT foto_produk FROM bijih_kopi WHERE id_kopi = ".$idKopi;
        $oldFoto = $conn->getRow($sql);
        
        if(isset($_POST['kopi'])){
            $namaKopi = $_POST['kopi']['nama_kopi'];
            $harga = $_POST['kopi']['harga'];
            $deskripsi = $_POST['kopi']['deskripsi'];
            $target_file = $oldFoto['foto_produk'];
			$fileName = explode("/",$oldFoto['foto_produk']);
			$fileName = "images/produk/".end($fileName);
			
			if(empty($_POST['kopi']['reStock'])){
				$stok = $_POST['kopi']['curStok'];
			}else{
				$stok = $_POST['kopi']['curStok'] + $_POST['kopi']['reStock'];
			}
            //move img if exist and update foto_produk
            if($_FILES['foto_produk']['tmp_name'] != ''){
				
                $imageFileType = pathinfo($_FILES['foto_produk']['name'],PATHINFO_EXTENSION);
                $target_file = $target_dir."kopi_".$idKopi.".".$imageFileType;
                $fileName = "images/produk/kopi_".$idKopi.".".$imageFileType;
                
                //move_uploaded_file($_FILES["foto_produk"]["tmp_name"], $target_file);
                if (!move_uploaded_file($_FILES["foto_produk"]["tmp_name"], $target_file)) {
                    $alertMsg = "<strong>Error System</strong> Foto gagal diupdate";
                    $alert=true;
                } 
            }
            
            //update produk dan artikel
            $sql = "UPDATE bijih_kopi SET nama_kopi = '".$namaKopi."', harga = '".$harga."', stok = '".$stok."', foto_produk = '".$fileName."'
                    WHERE id_kopi = ".$idKopi;
            
            $updatePrd= $conn->executeQuery($sql);
            
            if($updatePrd){
                $sql = "UPDATE artikel SET deskripsi = '".$deskripsi."' WHERE id_kopi = ".$idKopi;
                $updateArt= $conn->executeQuery($sql);
               
                if($updateArt){
                    $alertMsg = "<strong>Sukses</strong> Data Berhasil diupdate";
                    $sukses = "alert-success";
                    $alert=true;
                    //header("Refresh:0");
                }else{
                    $alertMsg = "<strong>Gagal!</strong> {update artikel}";
                    $alert=true;
                }
            }else{
                $alertMsg = "<strong>Gagal!</strong> {update produk}";
                $alert=true;
            }
        }
        
        $sql = "SELECT bk.id_kopi, bk.nama_kopi, bk.harga, bk.stok, bk.foto_produk, art.id_artikel, art.deskripsi FROM bijih_kopi bk
				LEFT JOIN artikel art on art.id_kopi = bk.id_kopi
				WHERE bk.id_kopi = ".$idKopi;
		$data = $conn->getRow($sql);
        
		ob_get_contents();
		ob_end_clean();
		
		include('pages/productUpdate.php');
    }
	
	private function inputProduct(){
		$conn = new connection(); 
		ob_start();
		$alert="";

		if(isset($_POST['kopi'])){
			
            $namaKopi = $_POST['kopi']['nama_kopi'];
            $harga = $_POST['kopi']['harga'];
            $deskripsi = $_POST['kopi']['deskripsi'];
			$fileName = $_FILES['foto_produk']['name'];

			$sql = "INSERT INTO bijih_kopi (nama_kopi, harga, foto_produk)
					VALUES ('".$namaKopi."', '".$harga."', '".$fileName."')";
			$insertPrd = $conn->executeQuery($sql);
			
			if($insertPrd){
				$idKopi = $this->getLastId("bijih_kopi");
				
				if($_FILES['foto_produk']['tmp_name'] != ''){
					$imageFileType = pathinfo($_FILES['foto_produk']['name'],PATHINFO_EXTENSION);
					$fileName = "kopi_".$idKopi.".".$imageFileType;
					$target_file = "../images/produk/kopi_".$idKopi.".".$imageFileType;
					
					$moveFile = $this->saveImage($target_file, $_FILES, $idKopi, $fileName);
					
					if($moveFile == true){
						$sql = "INSERT INTO artikel (id_kopi, deskripsi)
								VALUES ('".$idKopi."', '".$deskripsi."')";
						$insertArt = $conn->executeQuery($sql);
						
						if($insertArt){
							header("Location: ?menu=productList&action=productUpdate&id_product=".$idKopi."&saved=true");
						}else{
							die("false save artikel");
						}
					}else{
						die("false move file");
					}
				}
			}
		}
		
		ob_get_contents();
		ob_end_clean();
		
		include('pages/inputProduct.php');
	}
	
	function getLastId($tableName){
	  $conn = new connection();
	  ob_start();
	  
	  $sql = "SELECT max(id_kopi) as maxId from ".$tableName;
	  $maxId = $conn->getRow($sql);
	  
	  return $maxId['maxId'];
	  
	  ob_get_contents();
      ob_end_clean();
	}
	
	function saveImage($target_file, $fileProduk, $idKopi, $fileName){
		$conn = new connection(); 
		if (!move_uploaded_file($fileProduk["foto_produk"]["tmp_name"], $target_file)) {
			return false;
		}else{
			$sql = "UPDATE bijih_kopi SET foto_produk = 'images/produk/".$fileName."' WHERE id_kopi = ".$idKopi;
            $updatePrd= $conn->executeQuery($sql);
			if($updatePrd){
				return true;
			}
			
		}
	}
}
?>