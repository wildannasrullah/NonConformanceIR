<div class='page-header'>
  <div class='page-header-title'>
    <h4>Departemen Bagian
    </h4>
    <span>Bagian
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
        <a href='#!'>Master Departemen
        </a>
      </li>
      <li class='breadcrumb-item'>
        <a href='#!'>Bagian
        </a>
      </li>
    </ul>
  </div>
</div>

<?php
$aksi="modul/master/aksi_bagian.php";

if($_GET[act]=='edit'){
$q = mysqli_query($conn, "SELECT * FROM departemen where idDepart = $_GET[no]");
$t = mysqli_fetch_array($q);
echo"
<div class='page-body'>
  <div class='row'>

	<div class='col-sm-12'>
      <div class='card'>
        <div class='card-block'>
          <h4 class='sub-title'>Departemen Bagian
          </h4>
		  <form method='post' action='$aksi?n=bagian&act=edit'>
		  <input type='hidden' class='form-control' name='id' value='$t[idDepart]'>
            <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Nama Bagian
              </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='nama_dept' placeholder='Nama Bagian...' required value='$t[departName]' autofocus>
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
					$tu = mysqli_query($conn, "select *from departemenmain");
					while($r = mysqli_fetch_array($tu)){
						if($t[idDepMain]==$r[idDepMain]){
							echo"
								<option value='$r[idDepMain]' selected>$r[DepMain]
								</option>";
						}else{
							echo"
								<option value='$r[idDepMain]'>$r[DepMain]
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
                <input type='text' class='form-control' placeholder='Keterangan' name='ket' value='$t[ketDepart]'>
              </div>
			  <br><br>
			<br>
			<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>
          </form>
  ";	
  ?>
		  
		  <button type='button' class='btn btn-primary btn-danger btn-block' onclick="window.location.href='?n=bagian'">RESET</button>
  <?php		
}else{
echo"
<div class='page-body'>
  <div class='row'>

	<div class='col-sm-12'>
      <div class='card'>
        <div class='card-block'>
          <h4 class='sub-title'>Departemen Bagian
          </h4>
		  <form method='post' action='$aksi?n=bagian&act=input'>
            <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Nama Bagian
              </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='nama_dept' placeholder='Nama Bagian...' required autofocus>
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
					$t = mysqli_query($conn, "select *from departemenmain");
					while($r = mysqli_fetch_array($t)){
						
							echo"
								<option value='$r[idDepMain]'>$r[DepMain]
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
                <input type='text' class='form-control' placeholder='Keterangan' name='ket'>
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
<th>Nama Bagian</th>
<th>Departemen</th>
<th>Keterangan</th>
<th width='5%'>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$sq = mysqli_query($conn, "SELECT * FROM departemen d left join departemenmain dm on d.idDepMain=dm.idDepMain");
while($r = mysqli_fetch_array($sq)){
	?>
<tr>
<td><?php echo "DEPT-$r[idDepart]";?></td>
<td><?php echo "$r[departName]";?></td>
<td><?php echo "$r[DepMain]";?></td>
<td><?php echo "$r[ketDepart]";?></td>
<td><?php echo "<a href='?n=bagian&act=edit&no=$r[idDepart]'>
		<button type='button' class='btn btn-primary btn-mini'>Edit</button>
	</a>
	&nbsp;
	<a href='$aksi?n=bagian&act=delete&id=$r[idDepart]'>
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
<th>Nama Departemen</th>
<th>Keterangan</th>
<th style='display:none;'>&nbsp;</th>
</tr>
</tfoot>
</table>
</div>
</div>
</div>
</div>

