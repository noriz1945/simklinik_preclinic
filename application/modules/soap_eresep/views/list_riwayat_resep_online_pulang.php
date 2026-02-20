
  <h5 class="p-20 z-depth-0" style="margin:5px 0 0 0; padding:5px;background:#00ced1;color:white;"> List Riwayat eResep : </h5>
  <div class="table-responsive" style="border:#CCC thin solid;">
    <table class="table table-bordered table-responsive styled-table">
    	<thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Tanggal e-Resep</th>
          <th scope="col">Jenis Rawat</th>
          <th scope="col">Id.Reg</th>
          <th scope="col">Dokter</th>
          <th scope="col">Fungsi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach($rs_eresep as $k => $v)
        {
        ?>
        <tr id="tr_riw_<?php echo $v['id_eresep']; ?>" bgcolor="<?php echo $v['bgcolor_riw_eresep']; ?>">
          <td><a href="#" onClick="javascript: load_eresep_detail(<?php echo $v['id_eresep'] ?>); return false;"><?php echo $no; ?></a></td>
          <td><a href="#" onClick="javascript: load_eresep_detail(<?php echo $v['id_eresep'] ?>); return false;"><?php echo $v['eresepdate'] ?></a></td>
          <td><a href="#" onClick="javascript: load_eresep_detail(<?php echo $v['id_eresep'] ?>); return false;"><?php echo $v['tipe_rawat'] ?></a></td>
          <td><a href="#" onClick="javascript: load_eresep_detail(<?php echo $v['id_eresep'] ?>); return false;"><?php echo $v['id_reg'] ?></a></td>
          
          <td><a href="#" onClick="javascript: load_eresep_detail(<?php echo $v['id_eresep'] ?>); return false;"><?php echo $v['nama_dokter'] ?></a></td>
          
          <td><?php echo $v['fungsi'] ?></td>
        </tr>
        <?php
        $no++;
        }
        ?>
      </tbody>
    </table>
  </div>    

	

<div style="" id="box_list_riwayat_eresep_online_det"></div>
<script>
  
function load_eresep_detail(id_eresep)
{
	$("#box_list_riwayat_eresep_online_det" ).load( "<?php echo base_url('soap_eresep/list_riwayat_resep_online_det_v2/'); ?>" + id_eresep ,function(){
			//alert('loaded');
		});
}

/*
$('.cb_eresep_pulang').click(function(e) {
	var id_eresep = 
  inner_loader('<?php #echo base_url('soap_eresep/list_riwayat_resep_online_det/') ?>' + data_id_eresep[i] + '/false/t' , '#box_eresep_pulang', false, '');
});
*/

function set_resep_pulang(id_eresep,new_val)
{
  
	//var x = document.getElementById("myCheck").checked;
	//if(x===true)
	//alert('test : ' + new_val + ' ; id_eresep :' + id_eresep );
	//inner_loader('<?php echo base_url('soap_eresep/set_resep_pulang/'.$id_reg.'/') ?>' + id_eresep + '/' + new_val , '#box_eresep_pulang', false, '');
	
	$.get('<?php echo base_url('soap_eresep/set_resep_pulang/'.$id_reg.'/') ?>' + id_eresep + '/' + new_val , function( data ) 
	{
		if(data == 'ok')
		{
			$.get('<?php echo base_url('soap_eresep/get_data_resep_pulang/'.$id_reg) ?>', function( data_id_eresep ) {
				var data_id_eresep = data_id_eresep;
			});
			
			for(i=0;i<data_id_eresep.length;i++)
			{
				inner_loader('<?php echo base_url('soap_eresep/list_riwayat_resep_online_det/') ?>' + data_id_eresep[i] + '/false/t' , '#box_eresep_pulang', false, '');
			}
		}
	});
}

</script>
