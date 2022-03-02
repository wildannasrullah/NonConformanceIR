<div class='page-header'>
  <div class='page-header-title'>
    <h4>User Management
    </h4>
    <span>User
    </span>
  </div>
  <div class='page-header-breadcrumb'>
    <ul class='breadcrumb-title'>
      <li class='breadcrumb-item'>
        <a href='index.html'>
          <i class='icofont icofont-home'>
          </i>
        </a>
      </li>
      <li class='breadcrumb-item'>
        <a href='#!'>Master User Management
        </a>
      </li>
      <li class='breadcrumb-item'>
        <a href='#!'>User
        </a>
      </li>
    </ul>
  </div>
</div>

<?php
$aksi="modul/master/aksi_user.php";

if($_GET[act]=='edit'){
$q = mysqli_query($conn, "SELECT * FROM muser m left join departemenrole d on m.idDep=d.idDep where m.idUser = $_GET[no]");
$t = mysqli_fetch_array($q);
echo"
<div class='page-body'>
  <div class='row'>

	<div class='col-sm-12'>
      <div class='card'>
        <div class='card-block'>
          <h4 class='sub-title'>User Management
          </h4>
		  <form method='post' action='$aksi?n=user-management&act=edit'>
		  <input type='hidden' class='form-control' name='id' value='$t[idUser]'>
            <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Fullname
              </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='fullname' placeholder='Full Name...' required value='$t[fullName]' autofocus>
              </div>
			 </div>
			 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Username
              </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='username' placeholder='User Name...' required value='$t[username]' autofocus>
              </div>
			 </div>
			 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Password
              </label>
              <div class='col-sm-6'>
                <input type='password' class='form-control' name='password' placeholder='Password...' required value='$t[password]' autofocus>
              </div>
			 </div>
			 
			 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Role
              </label>
              <div class='col-sm-4'>
			  <select name='role' class='form-control' required>
					  <option value='#'>---Pilih Role User---
					  </option>";
					  $t2 = mysqli_query($conn, "select *from departemenrole order by 2 ASC");
					  while($y = mysqli_fetch_array($t2)){
						  if($t[idDep]==$y[idDep]){
							echo " <option value='$y[idDep]' selected>$y[depName]</option>";
						  }else{
							echo " <option value='$y[idDep]'>$y[depName]</option>";
						  }
					  }
					  echo"
					</select>
              </div>
			 </div>
			 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Jabatan
              </label>
              <div class='col-sm-4'>
				<select name='jabatan' class='form-control' required>
					<option value='#'>---Pilih Jabatan---</option>";
					if($t[jabatan]=='Superadmin'){
						echo"
							<option value='Superadmin' selected>Superadmin</option>
							<option value='Manager'>Manager</option>
							<option value='Non Manager'>Chief/Head/Staff</option>";
					}else if($t[jabatan]=='Manager'){
						echo"
							<option value='Superadmin'>Superadmin</option>
							<option value='Manager' selected>Manager</option>
							<option value='Non Manager'>Chief/Head/Staff</option>";
					}else if($t[jabatan]=='Non Manager'){
						echo"
							<option value='Superadmin'>Superadmin</option>
							<option value='Manager'>Manager</option>
							<option value='Non Manager' selected>Chief/Head/Staff</option>";
					}else{
						echo"
							<option value='Superadmin'>Superadmin</option>
							<option value='Manager'>Manager</option>
							<option value='Non Manager'>Chief/Head/Staff</option>";
					}
					echo"
				</select>
              </div>
			 </div>
			 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Level
              </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='level' placeholder='Level...' required value='$t[level]' autofocus>
              </div>
			 </div>
            <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Email
              </label>
              <div class='col-sm-10'>
                <input type='email' class='form-control' placeholder='Email Addresss...' name='email' value='$t[email]'>
              </div>
			  <br><br>
			<br>
			<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>
			
          </form>
		  ";
		  ?>
		  
		  <button type='button' class='btn btn-primary btn-danger btn-block' onclick="window.location.href='?n=user-management'">RESET</button>
  <?php	
}else{
echo"
<div class='page-body'>
  <div class='row'>

	<div class='col-sm-12'>
      <div class='card'>
        <div class='card-block'>
          <h4 class='sub-title'>User Management
          </h4>
		  <form method='post' action='$aksi?n=user-management&act=input'>
            <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Fullname
              </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='fullname' placeholder='Full Name...' required autofocus>
              </div>
			 </div>
			 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Username
              </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='username' placeholder='User Name...' required >
              </div>
			 </div>
			 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Password
              </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='password' placeholder='Password...' required >
              </div>
			 </div>
			 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Role
              </label>
              <div class='col-sm-4'>
			  <select name='role' class='form-control' required>
					  <option value='#'>---Pilih Role User---
					  </option>";
					  $t = mysqli_query($conn, "select *from departemenrole order by 2 ASC");
					  while($y = mysqli_fetch_array($t)){
						 echo " <option value='$y[idDep]'>$y[depName]</option>";
					  }
					  echo"
					</select>
              </div>
			 </div>
			 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Jabatan
              </label>
              <div class='col-sm-4'>
				<select name='jabatan' class='form-control' required>
					<option value='#'>---Pilih Jabatan---</option>
					
							<option value='Superadmin'>Superadmin</option>
							<option value='Manager'>Manager</option>
							<option value='Non Manager'>Chief/Head/Staff</option>
				</select>
              </div>
			 </div>
			 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Level
              </label>
              <div class='col-sm-4'>
			  <select name='level' class='form-control' required>
					  <option value='#'>---Pilih Level User---</option> 
					  <option value='admin'>Admin</option>
					  <option value='user'>User</option>
					</select>
              </div>
			 </div>
            <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Email
              </label>
              <div class='col-sm-10'>
                <input type='email' class='form-control' placeholder='Email Addresss...' name='email' >
              </div>
			  <br><br>
			<br>
			<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>
          </form>
  ";
}
?>  
    </div>
  </div>
</div>
</div>
</div>
</div>

<div class='page-body'>
  <div class='row'>
    <div class='col-sm-12'>
	<div class="card">

<div class="card-block">
<div class="dt-responsive table-responsive">
<table id="footer-search" class="table table-striped table-bordered nowrap">
<thead>
<tr>
<th width='25%'>FullName</th>
<th>Username</th>
<th>Password</th>
<th>Role</th>
<th>Level</th>
<th>Email</th>
<th width='5%'>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$sq = mysqli_query($conn, "SELECT * FROM muser m left join departemenrole d on m.idDep=d.idDep");
while($r = mysqli_fetch_array($sq)){
	?>
<tr>
<td><?php echo "$r[fullName]";?></td>
<td><?php echo "$r[username]";?></td>
<td><?php echo "********";?></td>
<td><?php echo "$r[depName]";?></td>
<td><?php echo "$r[level]";?></td>
<td><?php echo "$r[email]";?></td>
<td><?php echo "<a href='?n=user-management&act=edit&no=$r[idUser]'>
		<button type='button' class='btn btn-primary btn-mini'>Edit</button>
	</a>
	&nbsp;
	<a href='$aksi?n=user-management&act=delete&id=$r[idUser]'>
		<button type='button' class='btn btn-danger btn-mini'>Delete</button>
	</a>";?></td>
</tr>
<?php
}
?>
</tbody>
<tfoot>
<tr>
<th>Fullname</th>
<th>Username</th>
<th>Password</th>
<th>Role</th>
<th>Level</th>
<th>Email</th>
<th style='display:none;'>&nbsp;</th>
</tr>
</tfoot>
</table>
</div>
</div>
</div>
</div>

