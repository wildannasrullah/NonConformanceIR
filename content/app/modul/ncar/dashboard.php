<div class='page-header'>
          <div class='page-header-title'>
            <h4>Dashboard
            </h4>
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
                <a href='#!'>Pages
                </a>
              </li>
              <li class='breadcrumb-item'>
                <a href='#!'>Dashboard
                </a>
              </li>
            </ul>
          </div>
        </div>
		<div class='page-body'>
          <div class='row'>
            <div class='col-md-12 col-xl-4'>
              <div class='card table-card widget-primary-card'>
                <div class=''>
                  <div class='row-table'>
                    <div class='col-sm-3 card-block-big'>
                      <i class='icofont icofont-files'>
                      </i>
                    </div>
                    <div class='col-sm-9'><h4>
					<?php
					$j = mysqli_query($conn, "select *from ncir_inspection");
					echo mysqli_num_rows($j);
					  ?>
                      </h4>
                      <h6>Jumlah Dokumen Sampai Saat Ini
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class='page-header'>
</div>

<!-- FORM INPUT -->

<div class='page-body'>
  <div class='row'>
    <div class='col-sm-12'>
	
	<div class='card'>
	<div class='card-header'>
<div class='card-header-left'>
<div class='page-header-title'>
    <h4>Non Conformance Inspection Report
    </h4>
    <span>Laporan Pemeriksaan Yang Tidak Sesuai
    </span>
  </div>
</div>

<div class='card-block'>
<div class='dt-responsive table-responsive'>
<table id='footer-search' class='table table-striped table-bordered nowrap'>
<thead>
<tr>
<th>No. NCIR</th>
<th>Tanggal Inspeksi</th>
<th>Nama Barang</th>
<th>Jenis Inspeksi</th>
<th>Penerbit</th>
<th>PO / WO</th>
<th>Correction</th>
</tr>
</thead>
<tbody>
<?php
$q = mysqli_query($conn, "select *from ncir_inspection order by ncirCode DESC LIMIT 3");
					while($i = mysqli_fetch_array($q)){
echo"
	<tr>
		<td>$i[ncirCode]</td>
		<td>$i[tanggal_ncir]</td>
		<td>$i[nama_barang]</td>
		<td>$i[jenis_inspection]</td>
		<td>$i[penerbit]</td>
		<td>$i[po_wo]</td>
		<td>";
$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
$e = mysqli_fetch_array($u);
$d = mysqli_query($conn, "select *from departemenrole where idDep='$e[idDep]'");
$de = mysqli_fetch_array($d);
$re = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ButtonCorrectionNCIR' and value_set='$de[depName]'");
//SELEKSI SETTING
if(mysqli_num_rows($re)>0){

$p = mysqli_query($conn, "select *from ncir_correction where idCor='$_GET[coir]'");
$g = mysqli_fetch_array($p);
		//SELEKSI Approved atau tidak
		
		$n = mysqli_query($conn, "SELECT *from ncir_correction where ncirCode = '$i[ncirCode]'");
		$rf = mysqli_fetch_array($n);
		if($rf[ApprovedBy]==NULL AND $rf[ApprovedDate]==NULL){
			if(mysqli_num_rows($n)>0){
				echo"<a href='page.php?n=input-correction&no=$i[ncirCode]&coir=$rf[idCor]&s=finish&k=1'>
					<button type='button' class='btn btn-warning '>Menunggu Persetujuan</button>
				</a>";
			}
			else{
				echo"<a href='page.php?n=input-correction&no=$i[ncirCode]'>
					<button type='button' class='btn btn-danger '>Input Correction</button>
				</a>";
			}
		}
		else{
			echo"<a href='page.php?n=input-correction&no=$i[ncirCode]&coir=$rf[idCor]&s=finish&k=1'>
				<button type='button' class='btn btn-success' title='Sudah Dikoreksi' ><i class='fa fa-check'></i></button>
			</a>";
		}
}
else{
	$n = mysqli_query($conn, "SELECT *from ncir_correction where ncirCode = '$i[ncirCode]'");
		$rf = mysqli_fetch_array($n);
		if($rf[ApprovedBy]==NULL AND $rf[ApprovedDate]==NULL){
			if(mysqli_num_rows($n)>0){
				echo"<a href='page.php?n=input-correction&no=$i[ncirCode]&coir=$rf[idCor]&s=finish&k=1'>
					<button type='button' class='btn btn-warning ' disabled='disabled'>Menunggu Persetujuan</button>
				</a>";
			}
			else{
				echo"<a href='page.php?n=input-correction&no=$i[ncirCode]'>
					<button type='button' class='btn btn-danger ' disabled='disabled'>Input Correction</button>
				</a>";
			}
		}
		else{
			echo"<a href='page.php?n=input-correction&no=$i[ncirCode]&coir=$rf[idCor]&s=finish&k=1'>
				<button type='button' class='btn btn-success' title='Sudah Dikoreksi' ><i class='fa fa-check'></i></button>
			</a>
			
			&nbsp;<button type='button' class='btn btn-inverse' title='Cetak' onclick='print_d()'><i class='fa fa-print'></i> Cetak</button>
			";
		}
}
		echo"
		</td>
	</tr>";
					}
?>
</tbody>
<tfoot>
<tr>
<th>No. NCIR</th>
<th>Tanggal Inspeksi</th>
<th>Nama Barang</th>
<th>Jenis Inspeksi</th>
<th>Penerbit</th>
<th>PO / WO</th>
<th style='display:none'>&nbsp;</th>

</tr>
</tfoot>
</table>
</div>
</div>
</div>
  
  </div>
</div>
<script type="text/javascript">
	function print_d(){
		window.open("<?php echo "modul/ncir/print/print.php?coir=$rf[idCor]&s=finish&k=1"?>","target=_blank");
	}
</script>

			
			
          </div>
        </div>