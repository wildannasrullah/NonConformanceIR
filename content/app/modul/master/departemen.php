<div class='page-header'>
  <div class='page-header-title'>
    <h4>Departemen 
    </h4>
    <span>Depratemen
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
        <a href='#!'>Departemen
        </a>
      </li>
    </ul>
  </div>
</div>

<?php
$aksi="modul/master/aksi_bagian.php";

if($_GET[act]=='edit'){
$q = mysqli_query($conn, "SELECT * FROM departemenmain where idDepMain = '$_GET[no]'");
$t = mysqli_fetch_array($q);
echo"
<div class='page-body'>
  <div class='row'>

	<div class='col-sm-12'>
      <div class='card'>
        <div class='card-block'>
          <h4 class='sub-title'>Departemen
          </h4>
		  <form method='post' action='$aksi?n=departemen&act=edit'>
		  <input type='hidden' class='form-control' name='id' value='$t[idDepMain]'>
            <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Nama Departemen
              </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='nama_dept' placeholder='Nama Departemen...' required value='$t[DepMain]' autofocus>
              </div>
			 </div>
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
          <h4 class='sub-title'>Departemen 
          </h4>
		  <form method='post' action='$aksi?n=departemen&act=input'>
            <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Nama Departemen
              </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='nama_dept' placeholder='Nama Departemen...' required autofocus>
              </div>
			 </div>
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
<th>Nama Departemen</th>
<th width='5%'>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$sq = mysqli_query($conn, "SELECT * FROM departemenmain");
while($r = mysqli_fetch_array($sq)){
	?>
<tr>
<td><?php echo "DEPT-$r[idDepMain]";?></td>
<td><?php echo "$r[DepMain]";?></td>
<td><?php echo "<a href='?n=departemen&act=edit&no=$r[idDepMain]'>
		<button type='button' class='btn btn-primary btn-mini'>Edit</button>
	</a>
	&nbsp;
	<a href='$aksi?n=departemen&act=delete&id=$r[idDepMain]'>
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
<th style='display:none;'>&nbsp;</th>
</tr>
</tfoot>
</table>
</div>
</div>
</div>
</div>

