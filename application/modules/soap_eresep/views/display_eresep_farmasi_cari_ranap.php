<!doctype html>
<html>

<head>
  <?php $this->theme->head('theme_default'); ?>
  <style>
	tbody tr td:last-child {
		text-align: left;
	}
	thead tr th:last-child {
		text-align: left;
	}	
  </style>
  
</head>
<?php $this->theme->wrapper_open('theme_default',$breadcrumb); ?>
<div class="container-fluid">

	<div class="row" style="margin-top:15px;">
    <div class="col-sm-12">
      <div class="form-group">

        <form id="form1" name="form1" method="post" action="<?php echo base_url('soap_eresep/display_eresep_farmasi_cari_ranap') ?>"
          class="form-inline">
          <div class="form-group">
          	<h5>Pencarian pasien :&nbsp;&nbsp;</h5> 
          </div>
          <div class="form-group">
            <input type="text" name="id_pasien_cari" id="id_pasien_cari" class="form-control" placeholder="No. RM Pasien"
              value="<?php echo $id_pasien_cari; ?>">
          </div> &nbsp&nbsp&nbsp
          <div class="form-group">
            <input type="text" name="nama_pasien_cari" id="nama_pasien_cari" class="form-control" placeholder="Nama Pasien"
              value="<?php echo $nama_pasien_cari; ?>">
          </div>&nbsp&nbsp&nbsp
          <input class="btn btn-secondary" type="submit" name="button" value="Tampilkan">
        </form>
        
      </div>
    </div>
  </div>

	<hr>
  
  <div class="card-body" id="box_data_reg">
  	<div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">No RM</th>
            <th scope="col">Nama Pasien</th>
            <th scope="col">No.Reg</th>
            <th scope="col">Tgl.Reg</th>
            <!-- <th scope="col">Dokter</th> -->
            <th scope="col">Id eResep</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
        $i=1;
        foreach($rs as $v)
        {
          $id_pasien = $v['id_pasien'];

      ?>
          <!--<tr class="table-row" data-href="">-->
          <tr data-toggle="collapse" data-target="#accordion<?php echo $i; ?>" class="clickable" data-href="#">
            <td>
              <?php echo $i; ?>
            </td>
            <td>
              <?php echo $v['id_pasien']; ?>
            </td>
            <td>
              <?php echo $v['pasien']; ?>
            </td>
            <td><?php echo $v['id_reg']; ?></td>
            <td><?php echo $v['regdate']; ?></td>
            <!-- <td><#?php echo $v['dokter']; ?></td> -->
            <td align="center"><?php echo $v['id_eresep']; ?></td>
            <td align="center"><a href="#" onClick="javascript: print_eresep('<?php echo $v['id_eresep']; ?>'); ">[ Print eResep ]</a></td>
          </tr>
          <?php
        $i++;
        }
      ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<?php $this->theme->script('theme_default'); ?>
<script language="javascript">
var popupWindow = null;
function centeredPopup(url,winName,w,h,scroll)
{
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
	settings =
	'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
	popupWindow = window.open(url,winName,settings)
}
function print_eresep(id_eresep)
{
	var url = '<?php echo base_url() ?>' + '/soap_eresep/print_eresep/' + id_eresep;
	var winName = 'Print eResep';
	var w	= '800';
	var h = '500';
	//var scroll = 'true';
	centeredPopup(url,winName,w,h,'yes')
}
</script>

</body>
</html>