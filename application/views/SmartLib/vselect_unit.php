<select class="col-sm-3 form-control form-control-sm" id="poli">
<option> - Pilih Poli -</option>
	<?php 
            foreach($poli as $row)
            { 
              echo '<option value="'.$row->id_unit.'">'.$row->name.'</option>';
            }
            ?>
</select>
