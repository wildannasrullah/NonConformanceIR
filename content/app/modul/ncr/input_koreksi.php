
<div class='page-header'>
  <div class='page-header-title'>
    <h4>Non Conformance Report
    </h4>
    <span>Laporan Ketidaksesuaian 
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
<h5>KETIDAKSESUAIAN</h5>

<?php
error_reporting(1);
$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
$e = mysqli_fetch_array($u);
$d = mysqli_query($conn, "select *from departemenrole where idDep='$e[idDep]'");
$de = mysqli_fetch_array($d);

$aksi = "modul/ncr/aksi_ncr.php";
$p = mysqli_query($conn, "select *from ncr_inspection where ncrCode='$_GET[no]'");
$g = mysqli_fetch_array($p);
$re = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ApproveNCRCorrection' and value_set='$de[depName]'");
$correction = mysqli_query($conn, "select *from ncr_correction where ncrCode='$_GET[no]'");
$correct = mysqli_fetch_array($correction);
	if(mysqli_num_rows($re)>0){
		if($_GET[k]==1 AND $correct[ApprovedBy]==NULL){
			echo"<form method='POST' action='$aksi?n=input-correction&act=approve'>
					<input type='hidden' class='form-control' name='no_ncr' value='$g[ncrCode]'>
					<input type='hidden' class='form-control' name='no_cor' value='$_GET[cor]'>
					<button class='btn btn-primary'>Approve</button></div>
				</form>";
		}
		else if($correct[ApprovedBy]!=NULL){
			echo"
				<form method='POST' action='$aksi?n=input-correction&act=disapproved'>
					<input type='hidden' class='form-control' name='no_ncr' value='$g[ncrCode]'>
					<input type='hidden' class='form-control' name='no_cor' value='$_GET[cor]'>
					<button class='btn btn-danger'>Disapproved</button></div>
				</form>";
				$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
				$read = mysqli_fetch_array($u);
				$go = mysqli_query($conn, "select *from departemenrole where idDep='$read[idDep]'");
				$ar = mysqli_fetch_array($go);
				$sem_pre = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
										  where m.name_set='PrintNCR' and value_set='$ar[depName]'"); 
				//SELEKSI SETTING
				
				if(mysqli_num_rows($sem_pre)>0){

				$p = mysqli_query($conn, "select *from ncr_correction where idCorNcr='$_GET[cor]'");
				$gv = mysqli_fetch_array($p);
						//SELEKSI Approved atau tidak
						
						$n = mysqli_query($conn, "SELECT *from ncr_correction where ncrCode = '$i[ncrCode]'");
						$rf = mysqli_fetch_array($n);
						echo"<button type='button' class='btn btn-success' title='Sudah Dikoreksi' ><i class='fa fa-check'></i></button>
							
							&nbsp;<button type='button' class='btn btn-inverse' title='Cetak' onclick='print_d()'><i class='fa fa-print'></i> Cetak</button>
							";
							?>
							<script type="text/javascript">
								function print_d(){
									window.open("<?php echo "modul/ncr/print/print.php?cor=$_GET[cor]&s=finish&k=1"?>","target=_blank");
								}
							</script>
					<?php
				}
				else{
					
				}
		}
		else{
		echo"<button class='btn btn-default' disabled='disabled'>Approve</button></div>";
		}
	}



?>
</div>

<?php
//-
echo"
	<div class='card-block'>";
	if($_GET[k]==1){
		echo"<form action='$aksi?n=input-correction&act=edit' method='POST' >
			 <input type='hidden' class='form-control' name='no_ncr' value='$g[ncrCode]'>";
	}else{
		echo"<form action='$aksi?n=input-correction&act=input' method='POST' >";
	}
	echo"
      <div class='card-block'>
	<div class='row'>
	<div class='col-sm-6 col-xl-6 m-b-30'>
	  <h4 class='sub-title' align='left'>NO. NCR
      </h4>
		<div class='input-group'>
			<input type='text' class='form-control' placeholder='NCR Code' value='$g[ncrCode]' title='Kode NCR otomatis terbentuk' name='kode' readonly>
			<button type='button' class='btn btn-primary waves-effect md-trigger'  title='Klik untuk melihat daftar NCR'>...</button>
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
      
      <select name='penerbit' class='form-control'>";
      $w = mysqli_query($conn, "select *from departemen");
		while($r = mysqli_fetch_array($w)){
			if($g[penerbit]==$r[idDepart]){
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
    <div class='col-sm-12 col-xl-6 m-b-30'>
      <h4 class='sub-title'>Yang Dituju
      </h4>
      <select name='tujuan' class='form-control form-control-primary' title='Tujuan diberikan NCR'>
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
        echo"
      </select>
    </div>
    
    
  
    
    <div class='col-sm-12 col-xl-12  m-b-30'>
      <h4 class='sub-title'>ketidak sesuaian
      </h4>
      
      <input name='inspek' class='form-control form-control-primary' title='Ketidak Sesuaian' value='$g[jenis_inspection]'>
        ";


	  
	 
	  echo"
	  		
          
          </div>
  </div>
  <div class='row'>
    <div class='col-sm-12 col-xl-12 m-b-30'>
      <h4 class='sub-title'>Uraian Ketidak Sesuaian
      </h4>
      <textarea class='form-control form-control-primary' name='uraian'>$g[uraian]</textarea>
      ";
	  $query_file=mysqli_query($conn,"SELECT * FROM ncr_files WHERE idNcr='".$_GET['no']."'");
		
		$tb="<table border=0><tbody>";
		
		while($rows = mysqli_fetch_array($query_file))
		{
			$tb.="<tr>
							<td width='70%'>
							<a href='modul/ncr/print/temp/".$rows['nama']."'>".$rows['nama']."</a>
							</td>
							
							
						</tr>";
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

	
    
    
  </div>
  ";
	  
	 
	  echo"
          </div>
    </div>
  </div>
</div>
  </div>
</div>
</div>

	<div class='col-sm-12'>
      <div class='card'>
        <div class='card-block'>
            
			
            
<div class='accordion-panel'>
<div class='accordion-heading' role='tab' id='headingOne'>
<h3 class='card-title accordion-title'>
<a class='accordion-msg bg-danger b-none' data-toggle='collapse' data-parent='#accordion' href='#collapseOne' aria-expanded='false' aria-controls='collapseOne'>
Correction
</a>
</h3>
</div>
<input name='idCor' value='$_GET[cor]' style='visibility: collapse;'>
";

if($_GET[s]=='finish'){
	echo"
	<div id='collapseOne' class='panel-collapse collapse show' role='tabpanel' aria-labelledby='headingOne'>";
}
else{
	echo"
	<div id='collapseOne' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>";
}

	$o = mysqli_query($conn, "select *from ncr_correction where idCorNcr='$_GET[cor]'");
	
	$h = mysqli_fetch_array($o);
	$query="SELECT * FROM ncr_correction_type WHERE idCOR='".$_GET['cor']."'";
	$tipe=mysqli_query($conn,$query);
	$tipe2=mysqli_query($conn,$query);
	$chk="";
	$dsk= mysqli_fetch_assoc($tipe);
	
	$jenis=array("penambahan_pembuatan","revisi","training");
	/*while ($row = mysqli_fetch_assoc($tipe)) {
		array_push($in_row, $row['jenisCor']);
	}*/

	if(mysqli_num_rows($tipe2)>0)
	{
		echo"
		<div class='accordion-content accordion-desc'>
				<div class='col-sm-12 col-xl-12'><br>
					<h4 class='sub-title'>Correction
					</h4>
					<div class='border-checkbox-section'>
						";
		
	
		
		
		$num=0;
		foreach ($jenis as $key) {

			
			
			$proc=mysqli_query($conn,"SELECT * FROM ncr_correction_type WHERE idCOR='".$_GET['cor']."'");
			
			$status="";
			while ($kee = mysqli_fetch_array($proc)) {
				if ($key==$kee['jenisCor']) {
					$status="ada";
					break;
				}
				else {
					$status="tidak";
				}
			}
			if ($status=="ada") {
				switch ($key) {
					case 'penambahan_pembuatan':
						echo"<input type='checkbox' style='height:25px;width:23px;border: 20px solid black;' name='koreksi[]' value='penambahan_pembuatan' checked><b><font size='3'> Penambahan / Pembuatan.</font></b>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						break;
					case 'revisi':
						echo"<input type='checkbox' style='height:25px;width:23px;border: 20px solid black;' name='koreksi[]' value='revisi' checked><b><font size='3'> Revisi.</font></b>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						break;
					case 'training':
						echo"<input type='checkbox' style='height:25px;width:23px;border: 20px solid black;' name='koreksi[]' value='training' checked><b><font size='3'> Training</font></b>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						break;
					
					
				}
			}
			else
			{
				switch ($key) {
					case 'penambahan_pembuatan':
						echo"<input type='checkbox' style='height:25px;width:23px;border: 20px solid black;' name='koreksi[]' value='penambahan_pembuatan' ><b><font size='3'> Penambahan / Pembuatan.</font></b>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						break;
					case 'revisi':
						echo"<input type='checkbox' style='height:25px;width:23px;border: 20px solid black;' name='koreksi[]' value='revisi' ><b><font size='3'> Revisi.</font></b>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						break;
					case 'training':
						echo"<input type='checkbox' style='height:25px;width:23px;border: 20px solid black;' name='koreksi[]' value='training' ><b><font size='3'> Training</font></b>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						break;
					
					
				}
			}
			
			
		}
		
		
			echo $chk;
		echo"
		</div>
				</div>
			</div>";
	}
	else
	{
		echo"
		<div class='accordion-content accordion-desc'>
				<div class='col-sm-12 col-xl-12'><br>
					<h4 class='sub-title'>Correction
					</h4>
					<div class='border-checkbox-section'>
						<input type='checkbox' style='height:25px;width:23px;border: 20px solid black;' name='koreksi[]' value='penambahan_pembuatan'><b><font size='3'> Penambahan / Pembuatan.</font></b>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type='checkbox' style='height:25px;width:23px;border: 20px solid black;' name='koreksi[]' value='revisi'><b><font size='3'> Revisi</font></b>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type='checkbox' style='height:25px;width:23px;border: 20px solid black;' name='koreksi[]' value='training'><b><font size='3'> Training / Sosialiasi</font></b>
					</div>
				</div>
			</div>";
	}
echo"
	<div class='col-sm-12'>
      <div class='card'>
        <div class='card-block'>
            
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Root Cause
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' placeholder='Root Cause...' name='root'>$h[rootCouse]</textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Corrective Action
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' placeholder='Corrective Action...' name='correct' >$h[correctiveAction]</textarea>
              </div>
            </div>
			
			
</p>
            
    
			
			<br>
			
          <hr>
				<table border='0' width='30%'>
				<tr><td><font size='2'>Created By</font></td><td>&nbsp;:</td><td>&nbsp;$h[CreatedBy]</td></tr>
				<tr><td><font size='2'>Created Date</font></td><td>&nbsp;:</td><td>&nbsp;$h[createdDate]</td></tr>
				<tr><td><font size='2'>Approved By</font></td><td>&nbsp;:</td><td>&nbsp;$h[ApprovedBy]</td></tr>
				<tr><td><font size='2'>Approved Date</font></td><td>&nbsp;:</td><td>&nbsp;$h[approvedDate]</td></tr>
				<tr><td><font size='2'>Changed By</font></td><td>&nbsp;:</td><td>&nbsp;$h[changedBy]</td></tr>
				<tr><td><font size='2'>Changed Date</font></td><td>&nbsp;:</td><td>&nbsp;$h[changedDate]</td></tr>
				<tr><td><font size='2'></font></td><td></td><td>&nbsp;</td></tr>
				<tr><td><font size='2'><br><b>QF. KOP-QA-8.7-001 REV : 01</b></font></td><td></td><td>&nbsp;</td></tr>
				</table>
				<br><br>
			";
			if($h[ApprovedBy]==NULL){
				echo"<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>";
			}else{
				echo"<button type='submit' class='btn btn-default btn-block' disabled='disabled'>SIMPAN</button>";
			}
		echo"
          </form>
    </div>
</p>
            
    </div>
	";
	?>
  </div>
</div>

<div class='modal fade' id='large-Modal' tabindex='-1' role='dialog'>
<div class='modal-dialog modal-lg' role='document'>
	<div class='md-content'>
		<h3>Laporan NCAR</h3>
			<div>
					<div class='dt-responsive table-responsive'>
					<table id='footer-search' class='table table-striped table-bordered nowrap'>
					<thead>
					<tr>
					<th width='20%'>No. NCAR</th>
					<th width='50%'>Nama Barang</th>
					<th width='10%'>#</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$q = mysqli_query($conn, "select *from ncir_inspection where approvedBy is null and approvedDate is null order by ncrCode DESC");
					while($i = mysqli_fetch_array($q)){
					echo"
						<tr>
						<td><b>$i[ncrCode]</b></td>
						<td>$i[nama_barang]</td>
						<td>
							<a href='page.php?n=input-ncir&k=1&no=$i[ncrCode]'>
								<button type='button' class='btn btn-warning '>Show</button>
							</a>
						</td>
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
</div>

