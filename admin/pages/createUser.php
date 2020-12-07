<style>
   .row{margin-top:15px; margin-bottom:15px}
</style>
<div class="container">
   <?php if(isset($alert)){ ?>
   <div class="col-md-12">
      <div class="alert <?= $alert ?>" style="text-align:center">
         <?= $messages ?>
	  </div>
   </div>
   <?php } ?>
   <center><h2>Create User</h2><hr></center>
   <form method="POST">
      <div class="row">
         <div class="col-md-3 col-md-offset-2 text-right" required>
            Nama
         </div>
         <div class="col-md-3">
            <input class="form-control" name="user[nama]" type="text" required>
         </div>
      </div>
      <div class="row">
         <div class="col-md-3 col-md-offset-2 text-right">
            Username
         </div>
         <div class="col-md-3">
            <input class="form-control" name="user[username]" type="text" required>
         </div>
      </div>
      <div class="row">
         <div class="col-md-3 col-md-offset-2 text-right">
            Password
         </div>
         <div class="col-md-3">
            <input class="form-control" name="user[password]" type="password" required>
         </div>
      </div>
      <div class="row">
         <div class="col-md-3 col-md-offset-2 text-right">
            Role
         </div>
         <div class="col-md-3">
            <select class="form-control" name="user[id_role]" required>
               <?php foreach($role as $rl){ ?>
               <option value="<?= $rl['id_role'] ?>"><?= $rl['role'] ?></option>
               <?php } ?>
            </select>
         </div>
      </div>
      <div class="row">
         <div class="col-md-5 col-md-offset-4 text-center">
            <button class="btn btn-success" type="submit">Create</button>
         </div>
      </div>
   </form>
</div>