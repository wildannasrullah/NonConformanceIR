<?php
$aksi = "modul/master/aksi_menu.php";
?>
<div class='page-header'>
  <div class='page-header-title'>
    <h4>Menu Management
    </h4>
    <span>Pengaturan Menu
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
        <a href='#!'>Master
        </a>
      </li>
      <li class='breadcrumb-item'>
        <a href='#!'>Menu Management
        </a>
      </li>
    </ul>
  </div>
</div>

<!-- FORM INPUT -->

<div class='page-body'>
  <div class='row'>
    <div class='col-sm-4'>
	
	<div class='card'>
	<div class='card-header'>
<div class='card-header-left'>
</div>
<div class='row'>
<?php
echo"
<form method='POST' action='$aksi?n=menumanagement&act=input'>
  <div class='col-sm-12 col-xl-12 m-b-30'>
  <select class='form-control form-control-primary' name='idDep' required >
    <option value='#'>----------------------Role-----------------------
    </option>
	";
	$e = mysqli_query($conn, "select *from departemenrole order by depName asc");
	while($d = mysqli_fetch_array($e)){
		echo "<option value='$d[idDep]'>$d[depName]</option>";
	}
	?>
  </select>

    <h4 class='sub-title'>
    </h4>
	<?php
	$w = mysqli_query($conn, "select *from menu m group by idMenu");
	while($u=mysqli_fetch_array($w)){
							$t = mysqli_query($conn, "select *from menu m left join menugroup1 mg on m.idMenu=mg.idMenu where m.idMenu = '$u[idMenu]'");
							while($h = mysqli_fetch_array($t)){
								if($h[subMenu]==NULL){
									echo"&nbsp;&nbsp;<input type='checkbox' name='submenu[]' value='$u[idMenu]' /> $u[menuName]  <br />";
								}else{
									echo"&nbsp;&nbsp;<input type='checkbox' name='submenu[]' value='$h[idSubMenu]' /> $u[menuName] - $h[subMenu] <br />";
								}
							}
						}
	?>
    
  </div>
  
  <p align='center'><button class='btn btn-primary'>Simpan</button></p>
  </div>
</div>

          
    </div>
</p>
</div>

<div class='col-sm-8'>
	
	<div class='card'>
	<div class='card-header'>
<div class='card-header-left'>
</div>
<table id='footer-search' class='table table-striped table-bordered nowrap'>
					<thead>
					<tr>
					<th width='20%'>Role</th>
					<th width='25%'>Menu List</th>
					<th width='25%'>Sub Menu</th>
					<th width='13%'>Main</th>
					<th width='13%'>#</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$q = mysqli_query($conn, "select ms.idmsrole, d.depName, m.menuName, mg.subMenu, m.main 
										FROM departemenrole d 
										left join menusubrole ms on d.idDep=ms.idDep 
										left join menu m on ms.idMenu=m.idMenu 
										left join menugroup1 mg on ms.idSubMenu=mg.idSubMenu 
										order by main asc");
					while($i = mysqli_fetch_array($q)){
					echo"
						<tr>
						<td><b>$i[depName]</b></td>
						<td>$i[menuName]</td>
						<td>$i[subMenu]</td>
						<td>$i[main]</td>
						<td><a href='modul/master/aksi_menu.php?n=menumanagement&act=delete&id=$i[idmsrole]'><button type='button' class='btn btn-sm btn-danger'>Delete</button></a></td>
						</tr>";
					}
					?>
					</tbody>
					<tfoot>
					<tr>
					<th >Role</th>
					<th>Menu</th>
					<th>Sub</th>
					<th>Main</th>
					<th>#</th>
					</tr>
					</tfoot>
					</table>
    </div>
</p>
</div>
</div>
</div>
</div>


