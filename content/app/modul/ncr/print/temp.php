<?php
include('../../../../../config/koneksi.php');
$query = "select * from ncr_correction_type where idCor = '$_GET[cor]'";
            $sq = mysqli_query($conn, $query);
            $rows = mysqli_fetch_array($sq);
			if(mysqli_num_rows($sq)>0)
			{
				$jenisKoreksi=array("penambahan_pembuatan","revisi","training");

				while($jK = $jenisKoreksi)
				{
                    $to=1;
					while($to <= count($rows))
					{
						if($jK == $rows['jenisCor'])
						{
							echo "<input type='checkbox' name='koreksi[]' value=$rows[jenisCor] style='height:16px;width:16px;background-color:none' checked='' >&nbsp;$rows[jenisCor]";
							break;
						}
						else
						{
							echo "<input type='checkbox' name='koreksi[]' value=$rows[jenisCor] style='height:16px;width:16px;background-color:none'>&nbsp;$rows[jenisCor]";
							break;
                        }
                        $to++;
					}
					
				}
			}

?>