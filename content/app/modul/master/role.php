<div class='page-header'>
  <div class='page-header-title'>
    <h4>Departemen Role
    </h4>
    <span>Role
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
        <a href='#!'>Master Role
        </a>
      </li>
      <li class='breadcrumb-item'>
        <a href='#!'>Role
        </a>
      </li>
    </ul>
  </div>
</div>

<?php
$aksi="modul/master/aksi_role.php";

if($_GET[act]=='edit'){
$q = mysqli_query($conn, "SELECT * FROM departemenrole where idDep = $_GET[no]");
$t = mysqli_fetch_array($q);
echo"
<div class='page-body'>
  <div class='row'>

	<div class='col-sm-12'>
      <div class='card'>
        <div class='card-block'>
          <h4 class='sub-title'>Role
          </h4>
		  <form method='post' action='$aksi?n=role&act=edit'>
		  <input type='hidden' class='form-control' name='id' value='$t[idDep]'>
            <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Nama Role
              </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='nama_role' placeholder='Nama Role...' required value='$t[depName]' autofocus>
              </div>
			 </div>
			 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Departemen
              </label>
              <div class='col-sm-6'>
				 <select name='dept' class='form-control form-control-primary' title='Departemen'>
					<option value='#'>---Pilih Departemen---
					</option>";
					$td = mysqli_query($conn, "select *from departemen");
					while($r = mysqli_fetch_array($td)){
						if($t[idDepart]==$r[idDepart]){
							echo"
								<option value='$r[idDepart]' selected>$r[departName]
								</option>";
						}else{
							echo"
								<option value='$r[idDepart]'>$r[departName]
								</option>";
						}
					
					}
					echo"
				  </select>
			   </div>
			 </div>
            <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Keterangan
              </label>
              <div class='col-sm-10'>
                <input type='text' class='form-control' placeholder='Keterangan' name='ket_role' value='$t[ketDep]'>
              </div>
			  <br><br>
			<br>
			<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>
          </form>
 ";
		  ?>
		  
		  <button type='button' class='btn btn-primary btn-danger btn-block' onclick="window.location.href='?n=role'">RESET</button>
  <?php		
}else{
echo"
<div class='page-body'>
  <div class='row'>

	<div class='col-sm-12'>
      <div class='card'>
        <div class='card-block'>
          <h4 class='sub-title'>Role
          </h4>
		  <form method='post' action='$aksi?n=role&act=input'>
            <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Nama Role
              </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='nama_role' placeholder='Nama Role...' required autofocus>
              </div>
			 </div>
			 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Departemen
              </label>
              <div class='col-sm-6'>
				 <select name='dept' class='form-control form-control-primary' title='Departemen'>
					<option value='#'>---Pilih Departemen---
					</option>";
					$t = mysqli_query($conn, "select *from departemen");
					while($r = mysqli_fetch_array($t)){
						
							echo"
								<option value='$r[idDepart]'>$r[departName]
								</option>";
					}
					echo"
				  </select>
			   </div>
			 </div>
            <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Keterangan
              </label>
              <div class='col-sm-10'>
                <input type='text' class='form-control' placeholder='Keterangan Role' name='ket_role'>
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
<th width='15%'>ID</th>
<th>Nama Role</th>
<th>Departemen</th>
<th>Keterangan</th>
<th width='5%'>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$sq = mysqli_query($conn, "SELECT * FROM departemenrole d left join departemen dd on d.idDepart=dd.idDepart");
while($r = mysqli_fetch_array($sq)){
	?>
<tr>
<td><?php echo "ROL-$r[idDep]";?></td>
<td><?php echo "$r[depName]";?></td>
<td><?php echo "$r[departName]";?></td>
<td><?php echo "$r[ketDep]";?></td>
<td><?php echo "<a href='?n=role&act=edit&no=$r[idDep]'>
		<button type='button' class='btn btn-primary btn-mini'>Edit</button>
	</a>
	&nbsp;
	<a href='$aksi?n=role&act=delete&id=$r[idDep]'>
		<button type='button' class='btn btn-danger btn-mini'>Delete</button>
	</a>";?></td>
</tr>
<?php
}
?>
</tbody>
<tfoot>
<tr>
<th>ID</th>
<th>Nama Role</th>
<th>Keterangan</th>
<th style='display:none;'>&nbsp;</th>
</tr>
</tfoot>
</table>
</div>
</div>
</div>
</div>

