<select class="col-sm-3 form-control form-control-sm" id="dokter">
<option> - Pilih Dokter -</option>
	<?php 
            foreach($dokter as $row)
            { 
              echo '<option value="'.$row->id_dokter.'">'.$row->name.'</option>';
            }
            ?>
</select>
