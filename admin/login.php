<?php
	$msg = "";
	if(isset($_POST['username'])){
		//print_r($_POST);
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sql = "SELECT adm.* , r.* FROM admin adm
				INNER JOIN role r ON r.id_role = adm.id_role
				WHERE adm.username = '".$username."'
				AND adm.password = '".md5($password)."'
				AND adm.status = 1";
		$data = $conn->getRow($sql);
		
		//echo "<pre>";print_r($data);die;
		
		//echo $query;
		if(count($data) > 0){  
			$_SESSION['userid'] = $data['id_admin'];
			$_SESSION['username'] = $data['username'];
			$_SESSION['nama'] = $data['nama'];
			//$_SESSION['nama'] = $row['nama_user'];
			$_SESSION['id_role'] = $data['id_role'];
			$_SESSION['role'] = $data['role'];
			//echo "<pre>";print_r($_SESSION);die;
			if($_SESSION['id_role'] == 2){
				header("location:index.php");
			}else{
				header("location:?menu=order");
			}
		}
		else{
			$msg = "Login gagal";      
		}
	}
?>

<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<style>
body {font-family: Arial, Helvetica, sans-serif;}
/*form {border: 3px solid #f1f1f1;}*/

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/*button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}*/

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
.border-div{
    border-style: solid;
    padding: 3%;
    border-width: thin;
}
</style>

<div style="margin-bottom:60px"></div>
<?php if($msg != ""){ ?>
	<center>
		<div class="alert alert-danger col-md-4 col col-md-offset-4" role="alert">
			<?= $msg ?> 
		</div>
	</center>
<?php } ?>
<form method="post">
  <div class="container">
	<div class="col-md-6 col-md-offset-3">
		<!--<label for="uname"><b>Username</b></label>-->
		<input type="text" class="form-control" placeholder="Username" name="username" required>
	
		<!--<label for="psw"><b>Password</b></label>-->
		<input type="password" class="form-control" placeholder="Password" name="password" required>
			
		<button type="submit" class="btn col-md-12"/>Login</button>
		
	</div>
  </div>


</form>

