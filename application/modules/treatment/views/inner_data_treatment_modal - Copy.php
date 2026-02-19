
																					<table class="table table-bordered table-striped">
																						<thead>
																							<tr>
																								<th scope="col">Pilih<br>(yang sudah dilakukan)</th>
																								<th scope="col">Item</th>
																								<!-- <th scope="col" style="text-align: right;">Harga Satuan</th> -->
																								<th scope="col" style="text-align: right;">Jumlah</th>
																								<!-- <th scope="col" style="text-align: right;">Subtotal</th> -->
																							</tr>
																						</thead>
																						<tbody>
																							<?php
																							#$arr_status = array('Open','Closed');
																							$no = 0;
																							$pre_subtotal = 0;
																							$curr_grup = "";
																							foreach ($data_treatment as $k => $v)
																							{
																								if($curr_grup != $v->grup)
																								{
																									echo '	<tr class="table-info tr_'.$no,'">			
																												<td colspan="6" nowrap=""><span class="row_header_inv">'.$v->grup.'</span></td>		
																											</tr>';
																									$curr_grup = $v->grup;
																								}
																							?> 
																							
																							<tr class="tr_<?php echo $no; ?>">
																								<td nowrap align="center"> 
																									<input type="checkbox" id="chk_id_trx[<?php echo $no ?>]" name="chk_id_trx[]" value="<?php echo $v->id_trx ?>" <?php echo $v->checked_treatment ?> onClick="javascript: return update_treatment('<?php echo $v->id_trx ?>','<?php echo $v->grup ?>');" disabled />
																									<!-- <input type="checkbox" id="chk_id_trx[<?php echo $no ?>]" name="chk_id_trx[]" value="<?php echo $v->id_trx ?>" <?php echo $v->checked_treatment ?> onClick="javascript: return false;" /> -->
																									<input type="hidden" id="val_id_group[<?php echo $no ?>]" name="val_id_group[]" value="<?php echo $v->id_group ?>" />
																									<input type="hidden" id="val_grup[<?php echo $no ?>]" name="val_grup[]" value="<?php echo $v->grup ?>" />
																								</td>
																								
																								<td id="td_name_<?php echo $no; ?>"><?php echo $v->name ?></td>
																								<!-- <td id="td_price_<?php echo $no; ?>" style="text-align: right;"><?php echo number_format($v->price,0,",",".") ?></td> -->
																								<td id="td_qty_<?php echo $no; ?>" style="text-align: right;"><?php echo $v->qty ?></td>
																								<!-- <td id="td_total_<?php echo $no; ?>" style="text-align: right;"><?php echo number_format($v->total,0,",",".") ?></td> -->
																							</tr> 
																							<?php
																							$pre_subtotal += $v->total;
																							$no++;
																							}
																							?>
																						</tbody>
																						<tfoot>
																							<tr>
																								<td colspan=3></td>
																								<!-- <td align="right"><span class="row_header_inv">Total</span></td> -->
																								<!-- <td align="right" id="pre_subtotal"><?php echo number_format($pre_subtotal,0,",",".") ?></td> -->
																							</tr>
																						</tfoot>
																					</table>
																				
																				