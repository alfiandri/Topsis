
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Topsis</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<br />


					<div class="row">
						<div id="series_chart_div" style=" height: 500px;"></div>
					</div>

					<?php
					function showt($gdarray)
					{
						echo '<div class="table table-responsive">';
						echo '<table  class="table">';
						for ($i=0;$i<count($gdarray);$i++)
						{
							echo '<tr>';
							for ($j=0;$j<count($gdarray[$i]);$j++)
							{
								echo '<td>'.$gdarray[$i][$j].'</td>';
							}
							echo '</tr>';
						}
						echo '</table>';
						echo '</div>';
					}

					function showb($gdarray)
					{
						echo '<div class="table table-responsive">';
						echo '<table class="table table-bordered">';
						echo '<tr>';
						for ($i=0;$i<count($gdarray);$i++)
						{
							echo '<td>'.$gdarray[$i].'</td>';
						}
						echo "</tr>";
						echo '</table>';
						echo '</div>';
					}

					function showk($gdarray)
					{
						echo '<div class="table table-responsive">';
						echo '<table class="table">';
						for ($i=0;$i<count($gdarray);$i++)
						{
							echo '<tr>';
							echo '<td>'.$gdarray[$i].'</td>';
							echo "</tr>";
						}
						echo '</table>';
						echo '</div>';
					}

					$dosen = array(); 

					$i=0;
					foreach ($gdosen->result_array()  as $datadosen) :
						$dosen[$i] = $datadosen['user_nama'];
						$i++;
					endforeach;

					$kriteria = array(); 

					$kriteria_attribute = array();

					$kriteria_bobot = array(); 

					$i=0;
					foreach ($gkriteria->result_array()  as $datakriteria) :

						$kriteria[$i] = $datakriteria['kriteria_nama'];
						$kriteria_attribute[$i] = $datakriteria['kriteria_attribute'];
						$kriteria_bobot[$i] = $datakriteria['kriteria_bobot'];
						$i++;
					endforeach;

					$dosenkriteria = array();


					$i=0;
					foreach ($gdosen->result_array()  as $datadosen) :
						$datadosen1=$datadosen['user_nip'];
						$j=0;
						foreach ($gkriteria->result_array()  as $datakriteria) :
							$datakriteria1=$datakriteria['kriteria_id'];

							$querydosenkriteria=$this->m_padmin->get_alter_kriter($datadosen1,$datakriteria1);
							$datadosenkriteria=$querydosenkriteria->row_array() ;


							$dosenkriteria[$i][$j] = $datadosenkriteria['nilai_nilai'];
							$j++;
						endforeach;
						$i++;
					endforeach;

					$pembagi = array();

					for ($i=0;$i<count($kriteria);$i++)
					{
						$pembagi[$i] = 0;
						for ($j=0;$j<count($dosen);$j++)
						{
							$pembagi[$i] = $pembagi[$i] + ($dosenkriteria[$j][$i] * $dosenkriteria[$j][$i]);
						}
						$pembagi[$i] = sqrt($pembagi[$i]);
					}

					$normalisasi = array();

					for ($i=0;$i<count($dosen);$i++)
					{
						for ($j=0;$j<count($kriteria);$j++)
						{
							$normalisasi[$i][$j] = $dosenkriteria[$i][$j] / $pembagi[$j];
						}
					}

					$terbobot = array();

					for ($i=0;$i<count($dosen);$i++)
					{
						for ($j=0;$j<count($kriteria);$j++)
						{
							$terbobot[$i][$j] = $normalisasi[$i][$j] * $kriteria_bobot[$j];
						}
					}	

					$aplus = array();

					for ($i=0;$i<count($kriteria);$i++)
					{
						if ($kriteria_attribute[$i] == 'Cost')
						{
							for ($j=0;$j<count($dosen);$j++)
							{
								if ($j == 0) 
								{ 
									$aplus[$i] = $terbobot[$j][$i];
								}
								else 
								{
									if ($aplus[$i] > $terbobot[$j][$i])
									{
										$aplus[$i] = $terbobot[$j][$i];
									}
								}
							}
						}
						else 
						{
							for ($j=0;$j<count($dosen);$j++)
							{
								if ($j == 0) 
								{ 
									$aplus[$i] = $terbobot[$j][$i];
								}
								else 
								{
									if ($aplus[$i] < $terbobot[$j][$i])
									{
										$aplus[$i] = $terbobot[$j][$i];
									}
								}
							}
						}
					}

					$amin = array();

					for ($i=0;$i<count($kriteria);$i++)
					{
						if ($kriteria_attribute[$i] == 'Cost')
						{
							for ($j=0;$j<count($dosen);$j++)
							{
								if ($j == 0) 
								{ 
									$amin[$i] = $terbobot[$j][$i];
								}
								else 
								{
									if ($amin[$i] < $terbobot[$j][$i])
									{
										$amin[$i] = $terbobot[$j][$i];
									}
								}
							}
						}
						else 
						{
							for ($j=0;$j<count($dosen);$j++)
							{
								if ($j == 0) 
								{ 
									$amin[$i] = $terbobot[$j][$i];
								}
								else 
								{
									if ($amin[$i] > $terbobot[$j][$i])
									{
										$amin[$i] = $terbobot[$j][$i];
									}
								}
							}
						}
					}

					$dplus = array();

					for ($i=0;$i<count($dosen);$i++)
					{
						$dplus[$i] = 0;
						for ($j=0;$j<count($kriteria);$j++)
						{
							$dplus[$i] = $dplus[$i] + (($aplus[$j] - $terbobot[$i][$j]) * ($aplus[$j] - $terbobot[$i][$j]));
						}
						$dplus[$i] = sqrt($dplus[$i]);
					}

					$dmin = array();

					for ($i=0;$i<count($dosen);$i++)
					{
						$dmin[$i] = 0;
						for ($j=0;$j<count($kriteria);$j++)
						{
							$dmin[$i] = $dmin[$i] + (($terbobot[$i][$j] - $amin[$j]) * ($terbobot[$i][$j] - $amin[$j]));
						}
						$dmin[$i] = sqrt($dmin[$i]);
					}


					$hasil = array();

					for ($i=0;$i<count($dosen);$i++)
					{
						$hasil[$i] = $dmin[$i] / ($dmin[$i] + $dplus[$i]);
					}	

					$dosenrangking = array();
					$hasilrangking = array();

					for ($i=0;$i<count($dosen);$i++)
					{
						$hasilrangking[$i] = $hasil[$i];
						$dosenrangking[$i] = $dosen[$i];
					}

					for ($i=0;$i<count($dosen);$i++)
					{
						for ($j=$i;$j<count($dosen);$j++)
						{
							if ($hasilrangking[$j] > $hasilrangking[$i])
							{
								$tmphasil = $hasilrangking[$i];
								$tmpdosen = $dosenrangking[$i];
								$hasilrangking[$i] = $hasilrangking[$j];
								$dosenrangking[$i] = $dosenrangking[$j];
								$hasilrangking[$j] = $tmphasil;
								$dosenrangking[$j] = $tmpdosen;
							}
						}
					}
					?>

					<table id="datatable-keytable" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Ranking</th>
								<th>Dosen</th>
								<th>Nilai</th>
							</tr>
						</thead>
						<tbody>
							<?php
							for ($i=0;$i<count($hasilrangking);$i++)
							{	
								?>
								<tr>
									<td><?php echo ($i+1); ?></td>
									<td><?php echo $dosenrangking[$i]; ?></td>
									<td><?php echo $hasilrangking[$i]; ?></td>
								</tr>
								<?php
							}
							?>
						</tbody>
					</table>

					<div class="alert alert-info col-md-12" >
						<span>
							<h3>
								Nilai Tertinggi adalah : 
								<strong class="text-danger">
									<?php echo $hasilrangking[0]; ?>
								</strong>
							</h3>
							<strong class="text-danger">
								<?php echo $dosenrangking[0]; ?>		
							</strong> 
							Merupakan Dosen yang memiliki nilai tersebut, sehingga  
							<strong class="text-danger">
								<?php echo $dosenrangking[0]; ?>		
							</strong> 
							merupakan pilihan dosen yang paling tepat
						</span>
						<button type="button" class="btn btn-warning pull-right" href="#myModaltambah" class="btn btn-default" id="custId" data-toggle="modal"><span aria-hidden="true">View Detail</span>
						</button>
					</div>
				</div>
			</div>

		</div> 

	</div>
</div>




<div class="modal fade bs-example-modal-lg" id="myModaltambah" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Detail</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<strong>Nama Dosen</strong>
							<?php showb($dosen); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<strong>Kriteria</strong>
							<?php showb($kriteria); ?>

						</div>

					</div>
					<div class="row">
						<div class="col-md-6">
							<strong>Attribute</strong>
							<?php showb($kriteria_attribute); ?>
						</div>
						<div class="col-md-6">
							<strong>Bobot</strong>
							<?php showb($kriteria_bobot); ?>
						</div>
					</div>

					<div class="row">

						<div class="col-md-12">
							<strong>Penilaian Dosen</strong>
							<?php showt($dosenkriteria); ?>

							<strong>Pembagi</strong>
							<?php showb($pembagi); ?>
							<strong>Normalisasi</strong>
							<?php showt($normalisasi); ?>
							<strong>Normalisasi Terbobot</strong>
							<?php showt($terbobot); ?>
							<strong>Solusi Ideal Positif (A+)</strong>
							<?php showb($aplus); ?>
							<strong>Solusi Ideal Negatif (A-)</strong>
							<?php showb($amin); ?>

						</div>
					</div>

					<div class="row">

						<div class="col-md-6">
							<strong>Jarak Solusi Ideal Positif (D+)</strong>
							<?php showk($dplus); ?>
						</div>			
						<div class="col-md-6">
							<strong>Jarak Solusi Ideal Negatif (D-)</strong>
							<?php showk($dmin); ?>
						</div>
					</div>
					<div class="row">

						<div class="col-md-4">
							<strong>Hasil Preferensi</strong>
							<?php showk($hasil); ?>
						</div>
						<div class="col-md-4">
							<strong>Hasil Ranking</strong>
							<?php showk($hasilrangking); ?>
						</div>
						<div class="col-md-4">
							<strong>Dosen Ranking</strong>
							<?php showk($dosenrangking); ?>
						</div>
					</div>

					<span class="alert alert-info col-md-12">
						Dari data diatas maka didapatkan Dosen terbaik yaitu  <strong><?php echo $dosenrangking[0]; ?></strong>, <strong>dengan nilai terbesar sebanyak <?php echo $hasilrangking[0]; ?></strong>
					</span>

				</div>
			</div>

		</div>
	</div>
</div>


<script type="text/javascript" src="<?php echo base_url()?>assets/backend/vendors/googlechart/loader.js"></script>
<script type="text/javascript">
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawSeriesChart);

	function drawSeriesChart() {

		var data = google.visualization.arrayToDataTable([
			['ID','Ranking','Nilai','Dosen'],
			<?php
			for ($i=0;$i<count($hasilrangking);$i++)
			{	
				?>
				['<?php echo $dosenrangking[$i]; ?>',<?php echo ($i+1); ?>,<?php echo $hasilrangking[$i]; ?>,'<?php echo $dosenrangking[$i]; ?>'],
				<?php
			}
			?>
			]);


		var options = {
			title: 'Hasil Penilaian Dosen',
			hAxis: {
				title: 'Rangking',
				viewWindow: {
					min: -0,
				}
			},
			vAxis: {title: 'Nilai',
			viewWindow: {
				min: -5,
				max: 5
			}},
			width: '100%',
			height: '100%',
			bubble: {textStyle: {fontSize: 11}}

		};

		var chart = new google.visualization.BubbleChart(document.getElementById('series_chart_div'));
		chart.draw(data, options);
	}
</script>

