<?php
class connection{
	private $host="localhost";
	private $user="root";
	private $pass="";
	private $database="coffee";
	
      private $con;
      
      public function __construct(){
		$this->con= new mysqli($this->host, $this->user, $this->pass, $this->database);
				
		if(!$this->con){
			throw new Exception(mysqli_error($this->con), "2".mysqli_errno($this->con));
		}
	}
	
	public function executeQuery($query){
		$result=$this->con->query($query);
		return $result;
	}
	
	public function getLastInsertedID(){
		$row = $this->getData("SELECT max(id_order_detail) id FROM order_detail");

		return $row[0]['id'];
	}
	
	public function getRow($query){
		$data = array();
		$result=$this->con->query($query);
		if($result){
			$data = $result->fetch_assoc();
		}

		return $data;
	}
	
	public function getRows($query){
		$data = array();
		$result=$this->con->query($query);
		if($result){
			while($rows = $result->fetch_assoc()){
				$data[] = $rows;
			}
		}
		
		return $data;
	}
	
	public function totalRows($query){
		$result=$this->con->query($query);
		if($result == null){
			return mysqli_affected_rows($this->con);
		}
		else{
			return mysqli_num_rows($result);
		}
	}
	
	function escapeString($string){
		return mysqli_real_escape_string($this->con, $string);
	}

	public function getRowsPaging($query, $page, $limit, &$paging, $link){
		$data = array();
		$criteria = "";
		
		if($page != "" && $limit != ""){
			$mulai = ($page>1) ? ($page * $limit) - $limit : 0;
			$criteria =  " LIMIT ".($mulai).", ".$limit;
		}
		
		$result=$this->executeQuery($query.$criteria);
		
		if($result){
			while($rows = $result->fetch_assoc()){
				$data[] = $rows;
			}
		}
		$totalRows = $this->totalRows($query);
		
		$paging = $this->createPaging($totalRows, $page, $limit, $link);
		return $data;
	}
	
	public function createPaging($total_data, $get_halaman, $max_halaman = 5, $link){		   
		$jumlah_paging = ceil($total_data / $max_halaman);
		$page = isset($get_halaman) ? (int)$get_halaman : 1;
		$mulai = ($page>1) ? ($page * $max_halaman) - $max_halaman : 0;
						
		$search_qs="";
		$paging = "";
		
		if($jumlah_paging > 1){
			  $paging .= '<div class="box-footer clearfix"><ul class="pagination pagination-sm no-margin">';
			  $paging .= '<li><a href="'.$link.$search_qs.'&halaman=1">&laquo;</a></li>';
			  
			  for($i=1;$i<=$jumlah_paging;$i++){
					$paging .= '<li '.(($i==$page) ? 'class="active"' : '').'><a href="'.$link.$search_qs.'&halaman='.$i.'">'.$i.'</a></li>';
			  }
			  $paging .= '<li><a href="'.$link.$search_qs.'&halaman='.$jumlah_paging.'" >&raquo;</a></li>';						
			  $paging .= '</ul></div>';
		}
		  
		return $paging;
	}
	
      public function close(){
		/*
		if(!mysqli::close($this->con)){
			throw new Exception(mysqli_error($this->con), "2".mysqli_errno($this->con));
		}
		*/
	}
}
?>