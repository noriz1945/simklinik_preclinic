
														<style>
														.table-responsive {
															max-height: 50vh;
														}
														</style>	
														<div class="card">
															<div class="card-header" style="padding:15px 15px 0 15px;">
																<h4>Detail Pembagian Jasa Medis</h4>
															</div>
															<div class="card-block">
																<div class="table-responsive container-fix">
																	<table id="dt_table" class="table table-bordered table-hover table-stripedx">
																		<thead style="position: sticky;top: 0" class="thead-light">
																		<!-- <thead> --> 
																			<tr>
																				
																				<th scope="col">Id Pasien</th>
																				<th scope="col">Id Reg</th>
																				<th scope="col">Pasien</th>
																				<th scope="col">Asuransi</th>
																				<th scope="col">Id Inv</th>
																				<th scope="col">Invdate</th>
																				<th scope="col">Grup Tindakan /<br>Sub Grup Tindakan</th>
																				<th scope="col">Name</th>
																				<th scope="col">Tarif Satuan</th>
																				<th scope="col">Qty</th>
																				<th scope="col">Tarif</th>
																				<th scope="col">Share Vendor</th>
																				<th scope="col">Share Nakes</th>
																				<th scope="col">Share Rs</th>
																			</tr>
																		</thead>
																		<tbody>
																			<?php
																			$i=1;
																			$tarif = 0;
																			$share_vendor = 0;
																			$share_nakes = 0;
																			$share_rs = 0;
																			
																			$subtotal_tarif = 0;
																			$subtotal_share_vendor = 0;
																			$subtotal_share_nakes = 0;
																			$subtotal_share_rs = 0;
																			
																			#$curr_id_reg = @$v_jasmed_data[0]->id_reg;
																			$curr_id_inv = @$v_jasmed_data[0]->id_inv;
																			foreach ($v_jasmed_data as $k => $v_jasmed)
																			{
																			?> 
																			<tr>
																				<td><?php echo $v_jasmed->id_pasien ?></td>
																				<td><?php echo $v_jasmed->id_reg_text ?></td>
																				<td><?php echo $v_jasmed->pasien ?></td>
																				<td><?php echo $v_jasmed->asuransi ?></td>
																				<td><?php echo $v_jasmed->id_inv_text ?></td>
																				<td><?php echo $v_jasmed->tgl_inv ?></td>
																				<td><?php echo $v_jasmed->grup_tindakn ?>/ <br><?php echo $v_jasmed->sub_grup_tindakan ?></td>
																				<td>
																					<input type="checkbox" id="id_trx_<?php echo $v_jasmed->id_trx ?>" name="id_trx[<?php echo $v_jasmed->id_trx ?>]" value="<?php echo $v_jasmed->id_trx ?>" checked onclick="return false">
																					<?php echo $v_jasmed->name ?>
																					<input type="hidden" id="tindakan_<?php echo $v_jasmed->id_trx ?>" name="tindakan[<?php echo $v_jasmed->id_trx ?>]" value="<?php echo $v_jasmed->name ?>">
																					</td>
																				<td><?php echo number_format($v_jasmed->tarif_satuan,0,",",".") ?></td>
																				<td><?php echo $v_jasmed->qty ?></td>
																				<td>
																					<?php echo number_format($v_jasmed->tarif,0,",",".") ?>
																					<input type="hidden" id="tarif_<?php echo $v_jasmed->id_trx ?>" name="tarif[<?php echo $v_jasmed->id_trx ?>]" value="<?php echo $v_jasmed->tarif ?>">
																					</td>
																				<td>
																					<?php echo number_format($v_jasmed->share_vendor,0,",",".") ?>
																					<input type="hidden" id="share_vendor_<?php echo $v_jasmed->id_trx ?>" name="share_vendor[<?php echo $v_jasmed->id_trx ?>]" value="<?php echo $v_jasmed->share_vendor ?>">
																					<input type="hidden" id="persen_vendor_<?php echo $v_jasmed->id_trx ?>" name="persen_vendor[<?php echo $v_jasmed->id_trx ?>]" value="<?php echo $v_jasmed->persen_vendor ?>">
																					</td>
																				<td>
																					<?php echo number_format($v_jasmed->share_nakes,0,",",".") ?>
																					<input type="hidden" id="share_nakes_<?php echo $v_jasmed->id_trx ?>" name="share_nakes[<?php echo $v_jasmed->id_trx ?>]" value="<?php echo $v_jasmed->share_nakes ?>">
																					<input type="hidden" id="persen_nakes_<?php echo $v_jasmed->id_trx ?>" name="persen_nakes[<?php echo $v_jasmed->id_trx ?>]" value="<?php echo $v_jasmed->persen_nakes ?>">
																					</td>
																				<td>
																					<?php echo number_format($v_jasmed->share_rs,0,",",".") ?>
																					<input type="hidden" id="share_rs_<?php echo $v_jasmed->id_trx ?>" name="share_rs[<?php echo $v_jasmed->id_trx ?>]" value="<?php echo $v_jasmed->share_rs ?>">
																					<input type="hidden" id="persen_rs_<?php echo $v_jasmed->id_trx ?>" name="persen_rs[<?php echo $v_jasmed->id_trx ?>]" value="<?php echo $v_jasmed->persen_rs ?>">
																					</td>
																			</tr> 
																			<?php
																				$tarif 					+= $v_jasmed->tarif;
																				$share_vendor 			+= $v_jasmed->share_vendor;
																				$share_nakes 			+= $v_jasmed->share_nakes;
																				$share_rs 				+= $v_jasmed->share_rs;
																				
																				$subtotal_tarif 		+= $v_jasmed->tarif;
																				$subtotal_share_vendor 	+= $v_jasmed->share_vendor;
																				$subtotal_share_nakes 	+= $v_jasmed->share_nakes;
																				$subtotal_share_rs 		+= $v_jasmed->share_rs;
																				
																				#if($curr_id_reg != @$v_jasmed_data[$k+1]->id_reg || empty($v_jasmed_data[$k+1]->id_reg))
																				if($curr_id_inv != @$v_jasmed_data[$k+1]->id_inv || empty($v_jasmed_data[$k+1]->id_inv))
																				{
																					$cetak_subtotal_reg = '
																											<tr class="dnr" style="background-color:#f2f7f7">
																												<td></td>
																												<td></td>
																												<td></td>
																												<td></td>
																												<td></td>
																												<td></td>
																												<td></td>
																												<td></td>
																												<td align="right" style="font-weight: bold;font-style: italic;">Sub Total : </td>
																												<td></td>
																												<td align="right" style="font-weight: bold;font-style: italic;">'.number_format($subtotal_tarif,0,",",".").'</td>
																												<td align="right" style="font-weight: bold;font-style: italic;">'.number_format($subtotal_share_vendor,0,",",".").'</td>
																												<td align="right" style="font-weight: bold;font-style: italic;">'.number_format($subtotal_share_nakes,0,",",".").'</td>
																												<td align="right" style="font-weight: bold;font-style: italic;">'.number_format($subtotal_share_rs,0,",",".").'</td>
																											</tr>
																											';
																					echo $cetak_subtotal_reg;
																					
																					$subtotal_tarif 		= 0;
																					$subtotal_share_vendor 	= 0;
																					$subtotal_share_nakes 	= 0;
																					$subtotal_share_rs 		= 0;
																					
																					#$curr_id_reg = @$v_jasmed_data[$k+1]->id_reg;
																					$curr_id_inv = @$v_jasmed_data[$k+1]->id_inv;
																					$i++;
																				}
																			}
																			?>
																		</tbody>
																		<tfoot style="position: sticky;bottom: 0" class="thead-light">
																			<tr>
																				<th scope="col" colspan="8"></th>
																				<th scope="col" style="font-weight: bold;font-style: italic;">TOTAL : </th>
																				<th scope="col"></th>
																				<th scope="col"><?php echo number_format($tarif,0,",",".") ?></th>
																				<th scope="col"><?php echo number_format($share_vendor,0,",",".") ?></th>
																				<th scope="col"><?php echo number_format($share_nakes,0,",",".") ?></th>
																				<th scope="col"><?php echo number_format($share_rs,0,",",".") ?></th>
																			</tr>
																		</tfoot>
																	</table>
																	<input type="hidden" id="table_total_share_nakes" value="<?php echo $share_nakes ?>">
																</div>
																
															</div>
														
														</div>
														
														<!--
														<div class="card">
															<div class="card-block">
																<div class="col-sm-12">
																	
																</div>
															</div>
														</div>
														-->
<script>
$(document).ready(function() {
	var buttonCommon = {
		exportOptions: {
			format: {
				body: function ( data, rowIdx, column, node ) {
					data = column === 8 ? data.replace( /[.]/g, '' ) : data;
					//data = column === 9 ? data.replace( /[.]/g, '' ) : data;
					data = column === 10 ? data.replace( /[.]/g, '' ) : data;
					data = column === 11 ? data.replace( /[.]/g, '' ) : data;
					data = column === 12 ? data.replace( /[.]/g, '' ) : data;
					data = column === 13 ? data.replace( /[.]/g, '' ) : data;
					
					data = data.replace(/<br\s*\/?>/ig, "\r\n");
					return data;
				},
				footer: function ( data, rowIdx, column, node ) {
					data = data.replace( /[.]/g, '' );
					return data;
				}
			},
			rows: ":not('.dnr')"
		}
	};	

	new DataTable('#dt_table',{
		"pageLength": 50,
		searching: false, paging: false, info: false,"ordering": false,
		
		fixedHeader: true,
		fixedColumns: true,
		dom: 'Bfrtip',
		buttons: [
			//'copy', 'csv', 'excel', 'pdf', 'print',
			//{extend:'print',text:'Print'},
			$.extend( true, {}, buttonCommon, {
				extend: 'excel',text:'Export to Excel',footer: true,
			}),
		]
	});
});
</script>