<?php
define('INDEX', 1);

try{
	//  BUKA KONEKSI DATABASE
	include('class/connection.php');
	$conn = new connection();
	
	// Start session
	session_start();
	
	if(!isset($_SESSION['userid'])){
		include("login.php");
	}
	else{
		// JIKA MELAKUKAN LOGOUT
		if(isset($_GET["logout"])){
			unset($_SESSION['id_admin']);
			unset($_SESSION['nama']);
			unset($_SESSION['username']);
			unset($_SESSION['id_role']);
			unset($_SESSION['role']);
			//unset($_SESSION['group']);
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
	}
	
	// Write session
	session_write_close();
	
	// Close database connection
	$conn->close();
}
catch(Exception $e){
	echo $e;
}
?>