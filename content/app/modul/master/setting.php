<div class='page-header'>
  <div class='page-header-title'>
    <h4>Setting
    </h4>
    <span>Setting
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
        <a href='#!'>Master System
        </a>
      </li>
      <li class='breadcrumb-item'>
        <a href='#!'>Setting
        </a>
      </li>
    </ul>
  </div>
</div>

<?php
$aksi="modul/master/aksi_setting.php";

if($_GET[act]=='edit'){
$q = mysqli_query($conn, "SELECT * FROM msetting where idSetting = $_GET[no]");
$t = mysqli_fetch_array($q);
$var = htmlentities($t[value_set],ENT_QUOTES);
echo"
<div class='page-body'>
  <div class='row'>

	<div class='col-sm-6'>
      <div class='card'>
        <div class='card-block'>
          <h4 class='sub-title'>Name
          </h4>
		  <form method='post' action='$aksi?n=msetting&act=edit'>
		  <input type='hidden' class='form-control' name='id' value='$t[idSetting]'>
            <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Name Setting
              </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='name_setting' placeholder='Name...' required value='$t[name_set]' readonly='readonly'>
              </div>
			 </div>
			
			  <br><br>
			<br>
			<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>
			
          </form>
		  ";
		  ?>
		  
		  <button type='button' class='btn btn-primary btn-danger btn-block' onclick="window.location.href='?n=setting'">RESET</button>
  <?php	
}else{
echo"
<div class='page-body'>
  <div class='row'>

	<div class='col-sm-12'>
      <div class='card'>
        <div class='card-block'>
          <h4 class='sub-title'>Name
          </h4>
		  <form method='post' action='$aksi?n=msetting&act=input'>
            <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Name
              </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='name_setting' placeholder='Name...' required autofocus>
              </div>
			 </div>
			<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>
          </form>
  ";
}
?>  
<?php
if($_GET[act]=='add_value'){
$q = mysqli_query($conn, "SELECT * FROM msetting where idSetting = $_GET[no]");
$t = mysqli_fetch_array($q);
$var = htmlentities($t[value_set],ENT_QUOTES);
echo"
<div class='page-body'>
  <div class='row'>

	<div class='col-sm-12'>
      <div class='card'>
	  <br>
	  <form method='POST' action='$aksi?n=setting&act=jumlah&no=$_GET[no]'  >
			<table align='right' width='20%'>
				<tr><td width='100%'><input type='number' name='j' value='$_GET[j]' class='form-control' placeholder='0'></td>
					<td align='right'><button type='submit' class='btn btn-info'>Jumlah Value</button></td>
				</tr>
			</table>
		 </form>
        <div class='card-block'>
          <h4 class='sub-title'>Value
          </h4>
		  <form method='post' action='$aksi?n=msetting&act=valuenya&j=$_GET[j]' enctype='multipart/form-data'>
		  <input type='hidden' class='form-control' name='id' value='$t[idSetting]'>
            <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Name Setting
              </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='name_setting' placeholder='Name...' required value='$t[name_set]' readonly='readonly'>
              </div>
			 </div>
			 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>
			  Value
              </label>
              <div class='col-sm-6'>";
			  if($_GET[j]==0){
				$j=1;
			  }else{
				  $j=$_GET[j];
			  }
				for($i=1;$i<=$j;$i++){
					echo"<input type='hidden' class='form-control' name='id[$i]' value='$_GET[no]' >";
					echo"<input type='text' class='form-control' name='value_setting[$i]' placeholder='Value...' >";
				}
				$ds = mysqli_query($conn, "SELECT * FROM msetting_value mv where idSetting = '$_GET[no]'");
				while($sd = mysqli_fetch_array($ds)){
						echo "$sd[value_set] <font color='red'>| <a href='$aksi?n=value&act=delete&id_v=$sd[idValue]&no=$_GET[no]&j=$_GET[j]'>Delete</a></font><br>";
				}
				echo"
			  </div>
			 </div>
			<button type='submit' class='btn btn-warning btn-block'>SIMPAN</button>
			
          </form>
		  ";
}
?>  
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
<th width='25%'>Name</th>
<th>Value</th>
<th width='5%'>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$sq = mysqli_query($conn, "SELECT * FROM msetting m order by name_set ASC");
while($r = mysqli_fetch_array($sq)){
	?>
<tr>
<td><?php echo "$r[name_set]";?></td>
<td><?php
	$sq1 = mysqli_query($conn, "SELECT * FROM msetting_value mv where idSetting = '$r[idSetting]'");
	while($r1 = mysqli_fetch_array($sq1)){
			echo "$r1[value_set], ";
	}
?></td>
<td><?php echo "
	<a href='?n=setting&act=add_value&no=$r[idSetting]&j=1'>
		<button type='button' class='btn btn-info btn-mini'>Set Value</button>
	</a>
	&nbsp;
	<a href='$aksi?n=setting&act=delete&id=$r[idSetting]'>
		<button type='button' class='btn btn-danger btn-mini'>Delete</button>
	</a>";?></td>
</tr>
<?php
}
?>
</tbody>
<tfoot>
<tr>
<th>Name Setting</th>
<th>Value</th>
<th style='display:none;'>&nbsp;</th>
</tr>
</tfoot>
</table>

</div>
</div>
</div>
</div>

