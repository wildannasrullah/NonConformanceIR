<div class='page-header'>
  <div class='page-header-title'>
    <h4>Non Conformance Report
    </h4>
    <span>Laporan Pemeriksaan Yang Tidak Sesuai
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
        <a href='#!'>Transaction
        </a>
      </li>
      <li class='breadcrumb-item'>
        <a href='#!'>NCR
        </a>
      </li>
    </ul>
  </div>
</div>

<!-- FORM INPUT -->

<div class='page-body'>
  <div class='row'>
    <div class='col-sm-12'>
	
	<div class='card'>
	<div class='card-header'>
<div class='card-header-left'>
<h5>INSPECTION</h5>
</div>
<div class='card-header-right'>
<?php
$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
$e = mysqli_fetch_array($u);

$d = mysqli_query($conn, "select *from departemenrole dr 
											  left join departemen d on dr.idDepart=d.idDepart
											  left join departemenmain dm on d.idDepMain=dm.idDepMain
											  where dr.idDep='$e[idDep]'");
$de = mysqli_fetch_array($d);

$aksi = "modul/ncr/aksi_ncr.php";
$p = mysqli_query($conn, "select *from ncr_inspection where ncrCode='$_GET[no]'");
$g = mysqli_fetch_array($p);
$re = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
							where m.name_set='ApproveNCRInspection' and value_set='$de[depName]'");



if($_GET[st]==1){
	echo"
				<button class='btn btn-default' disabled=''>Approved</button></div>
				";
}else{
	if(mysqli_num_rows($re)>0){
		if($_GET[k]==1 AND $g[approvedBy]==NULL){
			echo"<form method='POST' action='$aksi?n=input-ncr&act=approve' enctype='multipart/form-data'>
					<input type='hidden' class='form-control' name='no_ncr' value='$g[ncrCode]'>
					<button class='btn btn-primary'>Approve</button></div>
				</form>";
		}
		else if($g[approvedBy]!=NULL){
			$cor=mysqli_query($conn,"SELECT * FROM ncr_correction WHERE ncrCode='$g[ncrCode]'");
			$setcor=mysqli_fetch_array($cor);
			if(mysqli_num_rows($cor)>0)
			{
				echo"<button type='button' class='btn btn-success' title='Sudah Dikoreksi' ><i class='fa fa-check'></i></button>
							
							&nbsp;<button type='button' class='btn btn-inverse' title='Cetak' onclick='print_d()'><i class='fa fa-print'></i> Cetak</button>
							";
							?>
							<script type="text/javascript">
								function print_d(){
									window.open("<?php echo "modul/ncr/print/print.php?cor=$setcor[idCorNcr]&s=finish&k=1"?>","target=_blank");
								}
							</script>
					<?php
			}
			else
			{
				echo"
				<form method='POST' action='$aksi?n=input-ncr&act=disapproved' enctype='multipart/form-data'>
					<input type='hidden' class='form-control' name='no_ncr' value='$g[ncrCode]'>
					<button class='btn btn-danger'>Disapproved</button></div>
				</form>";
			}
			
		}
		else{
		echo"<button class='btn btn-default' disabled='disabled'>Approve</button></div>";
		}
	}
}
	


?>
</div>

<?php

echo"
	<div class='card-block'>";
	if($_GET[k]==1){
		echo"<form action='$aksi?n=input-ncr&act=edit' method='POST' enctype='multipart/form-data'>
			 <input type='hidden' class='form-control' name='no_ncr' value='$g[ncrCode]'>";
	}else{
		echo"<form action='$aksi?n=input-ncr&act=input' method='POST' enctype='multipart/form-data'>";
	}
	echo"
      <div class='card-block'>
	<div class='row'>
	<div class='col-sm-6 col-xl-6 m-b-30'>
	  <h4 class='sub-title' align='left'>NO. NCR
      </h4>
		<div class='input-group'>
			<input type='text' class='form-control' placeholder='NCR Code' disabled='disabled' value='$g[ncrCode]' title='Kode NCR otomatis terbentuk'>
			<button type='button' class='btn btn-primary waves-effect md-trigger' data-toggle='modal' data-target='#large-Modal' title='Klik untuk melihat daftar NCR'>...</button>
		</div>
    </div>
    <div class='col-sm-6 col-xl-6 m-b-30'>
	  <h4 class='sub-title' align='left'>TANGGAL
      </h4>";
	  if($_GET[no]==NULL){
		echo "<input type='date' class='form-control' name='tgl_ncr' value='".date('Y-m-d')."' title='Tanggal Pembuatan NCR'>";
	  }
	  else{
		 echo "<input type='date' class='form-control' name='tgl_ncr' value='$g[tanggal_ncr]' title='Tanggal Pembuatan NCR'>"; 
	  }

	  echo"
    </div>
    
    <div class='col-sm-12 col-xl-6 m-b-30'>
      <h4 class='sub-title'>Penerbit
      </h4>
      
			";
  //     $w = mysqli_query($conn, "select *from departemen");
		// while($r = mysqli_fetch_array($w)){
		// 	if($g[penerbit]==$r[idDepart]||$e[idDep]==$r[idDepart]){
		// 		echo"
		// 			<option value='$r[idDepart]' selected>$r[departName]
		// 			</option>";
		// 	}else{
		// 		echo"
		// 			<option value='$r[idDepart]'>$r[departName]
		// 			</option>";
		// 	}
		
		// }
		/* $ss = mysqli_query($conn, "select *from departemen where idDepart=$e[idDepart]");
		$sss=mysqli_fetch_array($ss);
		if(mysqli_num_rows($ss)>0)
		{
			echo "<input name='penerbit' class='form-control' value='$sss[idDepart]' readonly>";
		}
		else
		{ */
			echo "<select name='penerbit' class='form-control' >
					<option value='#'>---Pilih Departemen Anda---
		        	</option>";
		    $w = mysqli_query($conn, "select *from departemen");
			while($r = mysqli_fetch_array($w)){
				if($g[penerbit]==$r[idDepart]||$de[idDepart]==$r[idDepart]){
					echo"
						<option value='$r[idDepart]' selected>$r[departName]
						</option>";
				}else{
					echo"
						<option value='$r[idDepart]'>$r[departName]
						</option>";
				}
			
			}
			echo "</select>";
		/* } */
      echo"
      
    </div>
    <div class='col-sm-12 col-xl-6 m-b-30'>
      <h4 class='sub-title'>Yang Dituju
      </h4>
      <select name='tujuan' class='form-control form-control-primary' title='Tujuan diberikan NCR' required>
        <option value='#'>---Pilih Departemen Tujuan---
        </option>";
		$t = mysqli_query($conn, "select *from departemen");
		while($r = mysqli_fetch_array($t)){
			if($g[tujuan]==$r[idDepart]){
				echo"
					<option value='$r[idDepart]' selected>$r[departName]
					</option>";
			}else{
				echo"
					<option value='$r[idDepart]'>$r[departName]
					</option>";
			}
		
		}
		$select="<option value='Mesin & Perawatan'>Mesin & Perawatan</option>
		<option value='SDM'>SDM</option>
		<option value='Sistem'>Sistem</option>
		<option value='Manajemen'>Manajemen</option>
		<option value='lain-lain'>Lain-Lain</option>";
		$lain="";
		if(is_null($g[jenis_inspection]))
		{}
			else{
				switch($g[jenis_inspection]){
					case 'Mesin & Perawatan':
								$select="
								<option value='Mesin & Perawatan' selected >Mesin & Perawatan</option>
								<option value='SDM'>SDM</option>
								<option value='Sistem'>Sistem</option>
								<option value='Manajemen'>Manajemen</option>
								<option value='lain-lain'>Lain-Lain</option>";
								break;
					case 'SDM':
								$select="<option value='Mesin & Perawatan'>Mesin & Perawatan</option>
								<option value='SDM' selected>SDM</option>
								<option value='Sistem'>Sistem</option>
								<option value='Manajemen'>Manajemen</option>
								<option value='lain-lain'>Lain-Lain</option>";
								break;
					case 'Sistem':
								$select="<option value='Mesin & Perawatan'>Mesin & Perawatan</option>
								<option value='SDM'>SDM</option>
								<option value='Sistem' selected>Sistem</option>
								<option value='Manajemen'>Manajemen</option>
								<option value='lain-lain'>Lain-Lain</option>";
								break;
					case 'Manajemen':
								$select="<option value='Mesin & Perawatan'>Mesin & Perawatan</option>
								<option value='SDM'>SDM</option>
								<option value='Sistem'>Sistem</option>
								<option value='Manajemen' selected>Manajemen</option>
								<option value='lain-lain'>Lain-Lain</option>";
								break;
						
						default:
								$select="<option value='Mesin & Perawatan'>Mesin & Perawatan</option>
								<option value='SDM'>SDM</option>
								<option value='Sistem'>Sistem</option>
								<option value='Manajemen' >Manajemen</option>
								<option value='lain-lain' selected>Lain-Lain</option>";
								$lain=$g[jenis_inspection];
								break;
				}
			}
		
		$display="";
		if($lain=="")
		{
			$display="style='display:none;'";
		
		}
		else
		{
			$display="";
		
		}
		
        echo"
      </select>
    </div>
		
		
    
  
    
    <div class='col-sm-12 col-xl-12  m-b-30'>
      <h4 class='sub-title'>ketidak sesuaian
      </h4>
      
      <select name='inspek' class='form-control form-control-primary' title='Ketidak Sesuaian'  id='inspection'>
					".$select."
			</select>
			<br>
			<br>
			<input name='lain-lain' type='text' class='form-control form-control-primary' ".$display." id='lain-lain' value='$lain'>";

			


	  
	 
	  echo"
	  		
          
          </div>
  </div>
  <div class='row'>
    <div class='col-sm-12 col-xl-12 m-b-30'>
      <h4 class='sub-title'>Uraian Ketidak Sesuaian
      </h4>
      <textarea class='form-control form-control-primary' name='uraian' required>$g[uraian]</textarea>
      ";
	  
		$query_file=mysqli_query($conn,"SELECT * FROM ncr_files WHERE idNcr='".$_GET['no']."'");
		
		$tb="<table border=0><tbody>";
		
		while($rows = mysqli_fetch_array($query_file))
		{
			if($g[approvedBy]==NULL)
			{
				$tb.="<tr>
							<td width='70%'>
							<a href='modul/ncr/print/temp/".$rows['nama']."'>".$rows['nama']."</a>
							</td>
							
							<td>
							<a href='modul/ncr/aksi_ncr.php?n=input-ncr&act=delete-file&id=".$rows['idFileLampiran']."&no=$g[ncrCode]'><span class='btn btn-danger waves-effect md-trigger'>hapus</span>
							</a>
							</td>
						</tr>";
			}
			else
			{
				$tb.="<tr>
							<td width='70%'>
							<a href='modul/ncr/print/temp/".$rows['nama']."'>".$rows['nama']."</a>
							</td>
							
							<td>
							
							</a>
							</td>
						</tr>";
			}
			
		}
		$tb.="</tbody></table>";
	  echo"
          
    </div>
		</div>
		<div class='row'>
			<div class='col-sm-12 col-xl-12 m-b-30'>
				<h4 class='sub-title'>Lampiran Data Pendukung
				</h4>
				<div  id='fileLampiran'>
				".$tb."
				<br>
					<input type='file' class='form-control m-b-30' placeholder='Lampiran' name='lampiran[]' id='lampiran1' accept='image/x-png,image/gif,image/jpeg' multiple>
					
				</div>
		</div>
		<div class='row'>
			<div class='col-sm-12 col-xl-12 m-b-30'>
		<button type='button' class='btn btn-primary waves-effect md-trigger'  title='Klik untuk tambah jumlah file' id='tambah'>+</button>
		<button type='button' class='btn btn-danger waves-effect md-trigger'  title='Klik untuk menghapus' id='kurang'>-</button>
		</div>
		</div>
		</div>
		</div>
    <div class='row'>
    <div class='col-sm-12 col-xl-12 m-b-30'>
    <table border='0'>
				<tr><td><font size='2'>Created By</font></td><td>&nbsp;:</td><td>&nbsp;$g[createdBy]</td></tr>
				<tr><td><font size='2'>Created Date</font></td><td>&nbsp;:</td><td>&nbsp;$g[createdDate]</td></tr>
				<tr><td><font size='2'>Approved By</font></td><td>&nbsp;:</td><td>&nbsp;$g[approvedBy]</td></tr>
				<tr><td><font size='2'>Approved Date</font></td><td>&nbsp;:</td><td>&nbsp;$g[approvedDate]</td></tr>
				<tr><td><font size='2'>Changed By</font></td><td>&nbsp;:</td><td>&nbsp;$g[changedBy]</td></tr>
				<tr><td><font size='2'>Changed Date</font></td><td>&nbsp;:</td><td>&nbsp;$g[changedDate]</td></tr>
			</table>
			</div>
			</div>
  </div>
</div>
  </div>
</div>
</div>

	";
			if($g[approvedBy]==NULL){
				if($_GET[d]==1){
					echo"<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>";
					?>
					<a href='<?php echo "$aksi?n=input-ncr&act=delete&no=$g[ncrCode]";?>' onclick="return confirm('Apakah Anda yakin untuk menghapus dokumen ini?');"><?php
					echo"<button type='button' class='btn btn-warning btn-block'>HAPUS</button></a>";
				}else{
					echo"<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>";
				}
			}else{
				echo"<button type='submit' class='btn btn-default btn-block' disabled='disabled'>SIMPAN</button>";
			}
		echo"
          </form>
          
    </div>
	";
	?>
  </div>
</div>

<div class='modal fade' id='large-Modal' tabindex='-1' role='dialog'>
<div class='modal-dialog modal-lg' role='document'>
<div class='col-sm-12'>
      <div class='card'>
        <div class='card-block'>
	<div class='md-content'>
		<h3>Laporan NCR</h3>
			<div>
					<div class='dt-responsive table-responsive'>
					<table id='footer-search' class='table table-striped table-bordered nowrap'>
					<thead>
					<tr>
					<th width='20%'>No. NCR</th>
					<th width='50%'>Inspeksi</th>
					<th width='20%'>Tujuan</th>
					<th width='10%'>#</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$q = mysqli_query($conn, "select n.* , d.departName from ncr_inspection n left join ncr_correction c on n.ncrCode=c.ncrCode left join departemen d on n.tujuan=d.idDepart where n.penerbit = $de[idDepart] order by n.ncrCode DESC");
					while($i = mysqli_fetch_array($q)){
					echo"
						<tr>
						<td><b>$i[ncrCode]</b></td>
						<td>$i[jenis_inspection]</td>
						<td>$i[departName]</td>
						<td>";
						if($i[approvedBy]==NULL && $i[approvedDate]==NULL){
							echo"<a href='page.php?n=input-ncr&k=1&no=$i[ncrCode]&d=1'>
								<button type='button' class='btn btn-warning '>Open</button>
							</a>";
						}else if($i[CreatedBy]!=NULL){
							echo"<a href='page.php?n=input-ncr&k=1&no=$i[ncrCode]&st=1'>
								<button type='button' class='btn btn-default '>Sent</button>
							</a>";
						}else{
							echo"<a href='page.php?n=input-ncr&k=1&no=$i[ncrCode]'>
								<button type='button' class='btn btn-danger '>Approved</button>
							</a>";
						}
						echo"</td>
						</tr>";
					}
					?>
					</tbody>
					<tfoot>
					<tr>
					<th style='display:none'>No. NCR</th>
					<th style='display:none'>Nama Barang</th>
					<th  style='display:none'></th>
					<th style='display:none'></th>

					</tr>
					</tfoot>
					</table>
					</div>
					</div>
			</div>
</div>

<div class='md-overlay'></div>

