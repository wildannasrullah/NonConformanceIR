<div class='page-header'>
  <div class='page-header-title'>
    <h4>Non Conformance Inspection Report
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
        <a href='#!'>NCIR
        </a>
      </li>
    </ul>
  </div>
</div>

<!-- FORM INPUT -->
<style>
/* The container */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
<div class='page-body'>
  <div class='row'>
    <div class='col-sm-12'>
	
	<div class='card'>
	<div class='card-header'>
<div class='card-header-left'>
<h5>KETIDAKSESUAIAN</h5>
</div>
<div class='card-header-right'>
<?php
$aksi = "modul/ncir/aksi_ncir.php";
$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
$e = mysqli_fetch_array($u);
$d = mysqli_query($conn, "select *from departemenrole where idDep='$e[idDep]'");
$de = mysqli_fetch_array($d);
$re = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ApproveNCIRCorrection' and value_set='$de[depName]'");
$p = mysqli_query($conn, "select *from ncir_correction where idCor='$_GET[coir]'");
$g = mysqli_fetch_array($p);
	if(mysqli_num_rows($re)>0){
		if($_GET[k]==1 AND $g[ApprovedBy]==NULL){
			echo"<form method='POST' action='$aksi?n=input-correction&act=approve'>
					<input type='hidden' class='form-control' name='no_ncir' value='$_GET[no]'>
					<input type='hidden' class='form-control' name='no_coir' value='$_GET[coir]'>
					<button class='btn btn-primary'>Approve</button></div>
				</form>";
		}
		else if($g[ApprovedBy]!=NULL){
			echo"
				<form method='POST' action='$aksi?n=input-correction&act=disapproved'>
					<input type='hidden' class='form-control' name='no_ncir' value='$_GET[no]'>
					<input type='hidden' class='form-control' name='no_coir' value='$_GET[coir]'>
					<button class='btn btn-danger'>Disapproved</button></div>
				</form>";
		}
		else{
		echo"<button class='btn btn-default' disabled='disabled'>Approve</button></div>";
		}
	}
	$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
$e = mysqli_fetch_array($u);
$d = mysqli_query($conn, "select *from departemenrole where idDep='$e[idDep]'");
$de = mysqli_fetch_array($d);
$re = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='PrintNCIR' and value_set='$de[depName]'");
//SELEKSI SETTING
if(mysqli_num_rows($re)>0){

$p = mysqli_query($conn, "select *from ncir_correction where idCor='$_GET[coir]'");
$g = mysqli_fetch_array($p);
		//SELEKSI Approved atau tidak
		
		$n = mysqli_query($conn, "SELECT *from ncir_correction where ncirCode = '$i[ncirCode]'");
		$rf = mysqli_fetch_array($n);
		echo"<button type='button' class='btn btn-success' title='Sudah Dikoreksi' ><i class='fa fa-check'></i></button>
			
			&nbsp;<button type='button' class='btn btn-inverse' title='Cetak' onclick='print_d()'><i class='fa fa-print'></i> Cetak</button>
			";
			?>
			<script type="text/javascript">
				function print_d(){
					window.open("<?php echo "modul/ncir/print/print.php?coir=$_GET[coir]&s=finish&k=1"?>","target=_blank");
				}
			</script>
	<?php
}
else{
	
}
?>
</div>
	<div class='card-block'>
  <div class='card-block accordion-block'>
<div id='accordion' role='tablist' aria-multiselectable='true'>
<div class='accordion-panel'>
<div class=' accordion-heading' role='tab' id='headingThree'>
<h3 class='card-title accordion-title'>
<a class='accordion-msg bg-primary b-none' data-toggle='collapse' data-parent='#accordion' href='#collapseThree' aria-expanded='true' aria-controls='collapseThree'>
Data-data Ketidaksesuaian
</a>
</h3>
</div>
<?php
$aksi = "modul/ncir/aksi_ncir.php";
$kor = mysqli_query($conn, "select *from ncir_inspection where ncirCode = '$_GET[no]'");
$g = mysqli_fetch_array($kor);
if($_GET[s]=='finish'){
echo"
<div id='collapseThree' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingThree'>";
}
else{
	echo"
<div id='collapseThree' class='panel-collapse collapse show' role='tabpanel' aria-labelledby='headingThree'>";
}
echo"
<div class='accordion-content accordion-desc'>
<p>
<div class='card-block'>
	
	<div class='row'>
    <div class='col-sm-12 col-xl-12 m-b-30'>
      <h4 class='sub-title' align='left'>$g[ncirCode]
      </h4>
	  <h4 class='sub-title' align='left'>TANGGAL : ".tgl_indo($g[tanggal_ncir])."
      </h4>
    </div>
    
    <div class='col-sm-12 col-xl-6 m-b-30'>
      <h4 class='sub-title'>Penerbit
      </h4>
      <input type='text' name='penerbit' class='form-control' placeholder='Penerbit NCIR.....'  autofocus value='$g[penerbit]' title='Penerbit NCIR'>
    </div>
    <div class='col-sm-12 col-xl-6 m-b-30'>
      <h4 class='sub-title'>Yang Dituju
      </h4>
      <select name='tujuan' class='form-control form-control-primary' title='Tujuan diberikan NCIR'>
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
    
    
  </div>
  <div class='row'>
    <div class='col-sm-12 col-xl-12'>
      <h4 class='sub-title'>inspection
      </h4>
      <div class='form-radio'>";
	  
	 /*  if($g[jenis_inspection]=='Incoming Raw Material'){
           echo" <div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Incoming Raw Material' data-bv-field='member' checked>
                <i class='helper'>
                </i>Incoming Raw Material
              </label>
            </div>
			<div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Inprocess' data-bv-field='member'>
                <i class='helper'>
                </i>Inprocess
              </label>
            </div>
			<div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Finished Good' data-bv-field='member'>
                <i class='helper'>
                </i>Finished Good
              </label>
            </div>";
	  }
	  else if($g[jenis_inspection]=='Inprocess'){
           echo" <div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Incoming Raw Material' data-bv-field='member'>
                <i class='helper'>
                </i>Incoming Raw Material
              </label>
            </div>
			<div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Inprocess' data-bv-field='member' checked>
                <i class='helper'>
                </i>Inprocess
              </label>
            </div>
			<div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Finished Good' data-bv-field='member'>
                <i class='helper'>
                </i>Finished Good
              </label>
            </div>";
	  }else if($g[jenis_inspection]=='Finished Good'){
			echo"<div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Incoming Raw Material' data-bv-field='member'>
                <i class='helper'>
                </i>Incoming Raw Material
              </label>
            </div>
			<div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Inprocess' data-bv-field='member'>
                <i class='helper'>
                </i>Inprocess
              </label>
            </div>
			<div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Finished Good' data-bv-field='member' checked>
                <i class='helper'>
                </i>Finished Good
              </label>
            </div>";
	  }
	  else{
		echo"  <div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Incoming Raw Material' data-bv-field='member'>
                <i class='helper'>
                </i>Incoming Raw Material
              </label>
            </div>
			<div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Inprocess' data-bv-field='member'>
                <i class='helper'>
                </i>Inprocess
              </label>
            </div>
			<div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Finished Good' data-bv-field='member'>
                <i class='helper'>
                </i>Finished Good
              </label>
            </div>";
	  } */
	  echo"
          </div>
    </div>
  </div>

	<div class='col-sm-12'>
      <div class='card'>
        <div class='card-block'>
          <h4 class='sub-title'>Data-data Ketidaksesuaian
          </h4>
            <div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Nama Barang
              </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='nama_barang' placeholder='Nama Barang...' required value='$g[nama_barang]' title='Nama Barang yang di inspeksi'>
              </div>
			  <div class='col-sm-3'>
                <input type='text' class='form-control' name='po_wo' placeholder='PO/WO...' required value='$g[po_wo]' title='No PO atau WO Barang'>
              </div>
            </div>
            <div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Jumlah Ketidaksesuaian dari Jumlah Sample
              </label>
              <div class='col-sm-3'>
                <input type='text' class='form-control' placeholder='Jumlah Ketidaksesuaian' name='tidak_sesuai' value='$g[jum_ketidaksesuian]' title='Jumlah barang yang tidak sesuai'>
              </div>
			  <div class='col-sm-3'>
                <input type='text' class='form-control' placeholder='Jumlah Sample' name='sampel' value='$g[jum_sample]' title='Total keseleuruhan sample'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Keterangan
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' placeholder='Keterangan' name='ket' title='Keterangan NCIR'>$g[keterangan]</textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Jumlah yang dikarantina
              </label>
              <div class='col-sm-3'>
                <input type='text' class='form-control' placeholder='Jumlah yang dikarantina' name='karantina' value='$g[jum_karantina]' title='Jumlah barang yang dikarantina' >
              </div>
            </div>
            <div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Lot
              </label>
              <div class='col-sm-9'>
                <input type='text' class='form-control' name='lot' value='$g[lot]'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  - Nomor Surat Jalan / Mesin & Shift
              </label>
              <div class='col-sm-3'>
                <input type='text' class='form-control' name='no_sj' value='$g[no_suratjalan]'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  - Tanggal Kedatangan / Operator
              </label>
              <div class='col-sm-3'>
                <input type='text' class='form-control' name='tgl_datang' value='$g[tanggal_datang]'>
              </div>
            </div>
            <div class='form-group row'>
              <label class='col-sm-3 col-form-label'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  - Supplier / Supervisi
              </label>
              <div class='col-sm-3'>
                <input type='text' class='form-control' name='supplier' value='$g[supplier]'>
              </div>
            </div>
            <div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Terlampir hasil pemeriksaan tanggal
              </label>
              <div class='col-sm-9'>
                <input type='text' class='form-control' name='hasil_periksa' value='$g[tanggal_hasil]'>
              </div>
            </div>
			<hr>
				<table border='0' width='100%'>
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
</p>
</div>
</div>
</div></div>
<div class='accordion-panel'>
<div class='accordion-heading' role='tab' id='headingOne'>
<h3 class='card-title accordion-title'>
<a class='accordion-msg bg-danger b-none' data-toggle='collapse' data-parent='#accordion' href='#collapseOne' aria-expanded='false' aria-controls='collapseOne'>
Correction
</a>
</h3>
</div>";
if($_GET[s]=='finish'){
	echo"
	<div id='collapseOne' class='panel-collapse collapse show' role='tabpanel' aria-labelledby='headingOne'>";
}
else{
	echo"
	<div id='collapseOne' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>";
}
echo"
<div class='accordion-content accordion-desc'>
<p>
<div class='card-block'>";
if($_GET[k]==1){
	echo"    <form action='$aksi?n=correction&act=edit' method='POST' >";
}else{
	echo"    <form action='$aksi?n=correction&act=input' method='POST' >";
}
echo"
<input type='hidden' class='form-control' value='$_GET[coir]' name='idCor'>
	<input type='hidden' class='form-control' value='$g[ncirCode]' name='kode'>
      <div class='card-block'>
	<div class='row'>
    <div class='col-sm-12 col-xl-12 m-b-30'>
      <h4 class='sub-title' align='left'>$g[ncirCode]
      </h4>
	  <h4 class='sub-title' align='left'>TANGGAL : ".tgl_indo($g[tanggal_ncir])."
      </h4>
    </div>
    
  </div>
  <div class='row'>
    <div class='col-sm-12 col-xl-12'>
      <h4 class='sub-title'>Correction
      </h4>
      <div class='border-checkbox-section'>";
$query = "select *from ncir_correction_type where idCor = '$_GET[coir]'";
			$sq = mysqli_query($conn, $query);
			$cek_user = array();
			while($row = mysqli_fetch_assoc($sq)) {
					$cek_user [ $row['jenisCor'] ] = $row['jenisCor'];
			}
            foreach($cek_user as $kode=>$cu) {
						$check_list[]=$cu;
			}  
			$checked= $check_list;
$jk = mysqli_query($conn, "select *from mjeniskoreksi where idKoreksi IN ('1','2','3','4','5') order by idKoreksi ASC");
while($j = mysqli_fetch_array($jk)){
	$checked= $check_list;
	?>
	<input type='checkbox' name='jenis_koreksi[]' value="<?php echo $j[jenisKoreksi]; ?>" style='height:20px;width:20px;background-color:white' <?php in_array ($j[jenisKoreksi], $checked) ? print "checked" : ""; ?>>&nbsp;<?php echo $j[jenisKoreksi];?>&nbsp;&nbsp;
<?php
}
echo"
		</div>
    </div>
  </div>
</div>
  </div>";
  $o = mysqli_query($conn, "select *from ncir_correction where idCor='$_GET[coir]'");
  $h = mysqli_fetch_array($o);
echo"
	<div class='col-sm-12'>
      <div class='card'>
        <div class='card-block'>
            
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Root Cause
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' placeholder='Root Cause...' name='root'>$h[rootCause]</textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Corrective Action
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' placeholder='Corrective Action...' name='correct' >$h[correctiveAct]</textarea>
              </div>
            </div>
            <div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Hasil Verfikasi
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' placeholder='Verify Result...' name='hasil'>$h[hasil_verifikasi]</textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>1. Hasil Baik
              </label>
              <div class='col-sm-3'>
                <input type='text' class='form-control' placeholder='Hasil Baik' name='hasil_baik' value='$h[hasil_baik]'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>2. Hasil Rusak
              </label>
              <div class='col-sm-3'>
                <input type='text' class='form-control' placeholder='Hasil Rusak' name='hasil_rusak' value='$h[hasil_rusak]'>
              </div>
            </div>
			<br>
			
          <hr>
				<table border='0' width='30%'>
				<tr><td><font size='2'>Created By</font></td><td>&nbsp;:</td><td>&nbsp;$h[CreatedBy]</td></tr>
				<tr><td><font size='2'>Created Date</font></td><td>&nbsp;:</td><td>&nbsp;$h[CreatedDate]</td></tr>
				<tr><td><font size='2'>Approved By</font></td><td>&nbsp;:</td><td>&nbsp;$h[ApprovedBy]</td></tr>
				<tr><td><font size='2'>Approved Date</font></td><td>&nbsp;:</td><td>&nbsp;$h[ApprovedDate]</td></tr>
				<tr><td><font size='2'>Changed By</font></td><td>&nbsp;:</td><td>&nbsp;$h[ChangedBy]</td></tr>
				<tr><td><font size='2'>Changed Date</font></td><td>&nbsp;:</td><td>&nbsp;$h[ChangedDate]</td></tr>
				</table>
				<br><br>
			";
			if($h[ApprovedBy]==NULL AND $g[approvedBy] != NULL){
				
				echo"
				<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>";
			}else{
				echo"<font color='red'><b>WARNING : Inspection not yet approved by QC Chief (Inspeksi belum disetujui oleh QC Chief)</font><br><br></b>
				<button type='submit' class='btn btn-default btn-block' disabled='disabled'>SIMPAN</button>";
			}
		echo"
          </form>
    </div>
</p>
</div>
</div>
</div>
</div>
</div>
";
?>


