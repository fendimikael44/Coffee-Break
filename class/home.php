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
		
		$sql = "SELECT bk.*, art.deskripsi FROM bijih_kopi bk
				INNER JOIN artikel art ON art.id_kopi = bk.id_kopi
				WHERE bk.status = 1
				ORDER BY bk.id_kopi DESC
				LIMIT 5";
		$data = $conn->getRows($sql);
		
		//echo "<pre>";print_r($data);die;
		
		ob_get_contents();
		ob_end_clean();
		
		include('pages/home.php');
		
	}
}
?>