<?php
define('INDEX', 1);

try{
	//  BUKA KONEKSI DATABASE
	include('class/connection.php');
	$conn = new connection();
	
	// Start session
	session_start();
	
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$query = "SELECT * FROM user_login a INNER JOIN pelanggan b ON b.email = a.username WHERE a.username = '".$username."' AND a.password = MD5('".$password."')";
		$row = $conn->getRow($query);
		
		if($row > 0){
			$_SESSION['userid'] = $row['id_pelanggan'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['group'] = $row['group'];
			$_SESSION['nama'] = $row['nama'];
			
			if($_POST['hid_menu'] != ""){
				if($_POST['hid_menu'] == 'penyewaan'){
					header("location:index.php?menu=order&login=success");
				}
			}
			else{
				header("location:index.php?menu=home&login=success");		
			}
		}
		else{
			header("location:index.php?menu=home&login=failed");
		}
		
		if($_POST['hid_menu'] != ""){
			$_GET['menu'] = $_POST['hid_menu'];
		}
	
		session_write_close();
	}

	if(isset($_POST['register'])){
		$nama = $_POST['username'];
		$alamat = $_POST['alamat'];
		//$email = $_POST['email'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password_conf = $_POST['conf_password'];
		$telp = $_POST['telp'];
		$group = 3;
		// untuk validasi email sudah terdaftar
		$query_cek = "SELECT * FROM `pelanggan` WHERE email = '".$email."'";
		
		$cek = $conn->getRows($query_cek);
		
		if(count($cek) == 0){
			if ($nama != null && $alamat != null && $email != null && $password != null && $password_conf != null && $telp != null){
				if ($password <> $password_conf){ 
					header("location:index.php?menu=home&register=failed1");
				}
				else{
					$pass = hash('md5', $password);
					$query1 = "INSERT INTO `user_login` (`username`, `password`, `group`) VALUES ('".$email."', '".$pass."', ".$group.")";
					
					if($conn->executeQuery($query1)){
						$query2 = "INSERT INTO `pelanggan` (id_pelanggan, nama, alamat, telp, email, image) VALUES ('NULL', '".$nama."', '".$alamat."', '".$telp."', '".$email."', 'images/profile_pictures/profile_picture.jpg')";
						$conn->executeQuery($query2);
						
						header("location:index.php?menu=home&register=success");
						//include('pages/home.php');
					}
					else{
						header("location:index.php?menu=home&register=failed2");
					}
				}
			}
			else{
				header("location:index.php?menu=home&register=failed3");
			}
		}else{
			header("location:index.php?menu=home&register=failed4");
		}
	}
	


		// JIKA MELAKUKAN LOGOUT
		if(isset($_GET["logout"])){
			unset($_SESSION['userid']);
			unset($_SESSION['username']);
			unset($_SESSION['nama']);
			unset($_SESSION['group']);
			session_destroy();
			header("location:index.php");     
		}
		else{
			// TAMPUNG SEMUA OUTPUT
			ob_start();

			// Jika ada request terhadap sebuah halaman
			if(isset($_GET['menu'])){
				$class=$_GET['menu'];
			}
			else{
				$class='home';
			}

			// Include file if exists
			$file_name="class/".$class.".php";
			
			if(file_exists($file_name) && is_file($file_name)){
				include($file_name);

				$object=new $class(); 
				
				if(isset($_GET['action'])){
					$object->action($_GET['action']);
				}
				else{
					$object->action(null);
				}
			}
			else{
				include('pages/404.php');
				$_GET['raw']=1;
			}

			//  MENGAMBIL OUTPUT YANG DITAMPUNG 
			$content=ob_get_contents();

			// Clean the buffer
			ob_end_clean();

			// For raw request, display the content without the main template
			if(isset($_GET['raw'])){
				echo $content;
			}
			else{
				include('pages/index.tpl.php');
			}
		}

	// Close database connection
	$conn->close();
}
catch(Exception $e){
	echo $e;
}
?>