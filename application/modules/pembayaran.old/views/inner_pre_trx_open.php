																		<table class="table table-bordered table-stripedx">
																			<thead>
																				<tr>
																					<th scope="col">Pilih</th>
																					<th scope="col">Item</th>
																					<th scope="col" style="text-align: right;">Harga Satuan</th>
																					<th scope="col" style="text-align: right;">Jumlah</th>
																					<th scope="col" style="text-align: right;">Tuslah</th>
																					<th scope="col" style="text-align: right;">Subtotal</th>
																					<td nowrap></td>
																					
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																				#$arr_status = array('Open','Closed');
																				$no = 0;
																				$pre_subtotal = 0;
																				$curr_grup = "";
																				foreach ($data_trx_open as $k => $v)
																				{
																					if($curr_grup != $v->grup)
																					{
																						echo '	<tr class="table-secondary tr_'.$no,'">			
																									<td colspan="7" nowrap=""><span class="row_header_inv">'.$v->grup.'</span></td>		
																								</tr>';
																						$curr_grup = $v->grup;
																					}
																				?> 
																				
																				<tr class="tr_<?php echo $no; ?>">
																					<td nowrap> 
																						<input type="checkbox" id="chk_id_trx[<?php echo $no ?>]" name="chk_id_trx[]" value="<?php echo $v->id_trx ?>" checked onclick="javascript : return cek_is_paket('<?php echo $v->is_paket ?>');" />
																						<input type="hidden" id="val_id_act[<?php echo $no ?>]" name="val_id_act[]" value="<?php echo $v->id_act ?>" />
																						<input type="hidden" id="val_id_group[<?php echo $no ?>]" name="val_id_group[]" value="<?php echo $v->id_group ?>" />
																						<input type="hidden" id="val_grup[<?php echo $no ?>]" name="val_grup[]" value="<?php echo $v->grup ?>" />
																						<input type="hidden" id="is_paket[<?php echo $no ?>]" name="is_paket[]" value="<?php echo $v->is_paket ?>" />
																						<input type="hidden" id="is_farmasi[<?php echo $no ?>]" name="is_farmasi[]" value="<?php echo $v->is_farmasi ?>" />
																					</td>
																					
																					<td id="td_name_<?php echo $no; ?>"><?php echo $v->name ?> <a href="<?php echo base_url('treatment/index/'.$id_reg) ?>"><?php echo $v->nakes_1 ?><?php echo $v->nakes_2 ?><?php echo $v->nakes_3 ?></a></td>
																					<td id="td_price_<?php echo $no; ?>" style="text-align: right;"><?php echo number_format($v->price,0,",",".") ?></td>
																					<td id="td_qty_<?php echo $no; ?>" style="text-align: right;"><?php echo $v->qty ?></td>
																					<td id="td_tuslah_<?php echo $no; ?>" style="text-align: right;"><?php echo number_format($v->tuslah,0,",",".") ?></td>
																					<td id="td_total_<?php echo $no; ?>" style="text-align: right;"><?php echo number_format($v->total,0,",",".") ?></td>
																					<td>
																						<button type="button" class="btn btn-danger waves-effect delset_tindakan <?php echo (strtoupper($v->grup)=='FARMASI' || $v->is_paket==1)?'d-none':''; ?>" onclick="javascript : delete_pre_act('<?php echo $v->id_trx ?>','<?php echo addslashes($v->name) ?>');"><i class="fa fa-trash"></i></button>
																					</td>
																					
																				</tr> 
																				<?php
																				$pre_subtotal += $v->total;
																				$no++;
																				}
																				?>
																			</tbody>
																			<tfoot>
																				<tr>
																				
																					<td colspan=4></td>
																					<td align="right"><span class="row_header_inv">Total</span></td>
																					<td align="right" id="pre_subtotal"><?php echo number_format($pre_subtotal,0,",",".") ?></td>
																					<td nowrap></td>
																				</tr>
																			</tfoot>
																		</table>
																	