<?php
//include('connection.php');
		
class createUser{
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
      
      $sql = "SELECT * FROM role";
      $role = $conn->getrows($sql);
      
      if(isset($_POST['user'])){
         $username = $_POST['user']['username'];
         $nama = $_POST['user']['nama'];
         $password = $_POST['user']['password'];
         $idRole = $_POST['user']['id_role'];
         
         $sql = "INSERT INTO admin (username, nama, password, id_role)
                    VALUES ('".$username."', '".$nama."', '".md5($password)."', '".$idRole."')";
         $createUser = $conn->executeQuery($sql);
         if($createUser){
           $idNewUser = $this->getLastAdmin();
           $alert = "alert-success";
           $messages = "create user Berhasil dibuat";
         }else{
           $alert = "alert-danger";
           $messages = "Gagal!!!";
         }
      }
   
      ob_get_contents();
      ob_end_clean();
      
      include('pages/createUser.php');
		
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