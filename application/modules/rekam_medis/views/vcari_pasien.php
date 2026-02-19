<!doctype html>
<html>

<head>
  <?php $this->theme->head('theme_default'); ?>
</head>
<?php $this->theme->wrapper_open('theme_default', $breadcrumb); ?>
<div class="container-fluid">

  <div class="row">
    <div class="col-sm-12">
      <div class="form-group">

        <form name="form1" method="post" action="<?php echo base_url('rekam_medis/rekam_medis/cari_pasien_poli') ?>"
          class="form-inline">
          <div class="form-group">
            <input type="text" name="id_pasien" id="id_pasien" class="form-control" placeholder="No. RM Pasien"
              value="<?php echo $id_pasien; ?>">
          </div> &nbsp&nbsp&nbsp
          <div class="form-group">
            <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="Nama Pasien"
              value="<?php echo $nama_pasien; ?>">
          </div>&nbsp&nbsp&nbsp
          <input class="btn btn-secondary" type="submit" name="button" value="Tampilkan">
        </form>
      </div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">No Reg</th>
          <th scope="col">No RM</th>
          <th scope="col">Regdate</th>
          <th scope="col">Nama Pasien</th>
          <th scope="col">Dokter</th>
          <th scope="col">Asuransi</th>
          <th scope="col">Tipe</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $i=1;
          foreach($rs as $v)
          {
            $id_reg = $v['id_reg'];
            $id_pasien = $v['id_pasien'];

            if($v['jml_soap'] >= 1 || $v['jml_asm'] >= 1)
              $status = '<span class="badge badge-success">Done</span>';
            else
              $status = '<span class="badge badge-danger">Waiting</span>';

            if ($v['tipe'] == 'RAWAT JALAN')
            {
              $action = "soap/epoli/pasien_list/"."$id_reg/".$id_pasien;
            } elseif ($v['tipe'] == 'RAWAT INAP')
            {
              $action = "erm_ranap/main_content/"."$id_reg";
            } else {
              $action = "soap_igd/pasien_detail/"."$id_reg/".$id_pasien;
            }

        ?>
        <tr class="table-row" data-href="">
          <td>
            <?php echo $i; ?>
          </td>
          <td>
            <?php echo $v['id_reg'];	 ?>
          </td>
          <td>
            <?php echo $v['id_pasien']; ?>
          </td>
          <td>
            <?php echo $v['regdate']; ?>
          </td>
          <td>
            <?php echo $v['nama_pasien']; ?>
          </td>
          <td>
            <?php echo $v['dokter']; ?>
          </td>
          <td>
            <?php echo $v['asuransi']; ?>
          </td>
          <td>
            <?php echo $v['tipe']; ?>
          </td>
          <td>
            <?php echo $status; ?>
          </td>
          <td nowrap>
            <!--<?php echo base_url('resume_medis/print_resmed/'.$data_resmed['id_resmed'].'/'.$id_reg.''); ?>-->
           <button type="button" class="btn btn-info " style="font-size:22px" onclick="javascript: centeredPopup('<?php echo site_url("rekam_medis/print_resmed/".$id_reg) ?>','myWindow','1024','600','yes');return false;"><i class="fa fa-check"></i> P R I N T </button>
          </td>
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
<script>

</script>

<script language="javascript">
var popupWindow = null;
function centeredPopup(url,winName,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
popupWindow = window.open(url,winName,settings)
}
</script>

</body>

</html>
