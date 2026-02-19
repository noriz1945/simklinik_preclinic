<style type="text/css">
.btn-link {
  cursor: pointer;
  width: 100%;
  text-align: left;
  font-size: 16px;
}
</style>

<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">

      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
          aria-expanded="true" aria-controls="collapseOne">
          <div class="row">
            <div class="col-sm-12">
              <i class="fa fa-angle-down rotate-icon"></i> Data Pasien :
              <?php echo $rs['nama_pasien']; ?> / 
              <?php echo $rs['id_pasien']; ?> /
              <?php echo $rs['id_reg']; ?> /
              <?php echo $rs['gender']; ?> /
              <?php echo $rs['umur1']; ?> 

            </div>
          </div>
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <!-- Form Header Start -->
        <div class="container-fluid bg-white">
          <div class="row">
            <div class="col-sm-5">
              <div class="row">
                <label class="col-sm-3 col-form-label">No. RM</label>
                <label class="col-sm-9 col-form-label">:
                  <?php echo $rs['id_pasien']; ?></label>
              </div>
              <div class="row">
                <label class="col-sm-3 col-form-label">Nama Pasien</label>
                <label class="col-sm-9 col-form-label">:
                  <?php echo $rs['nama_pasien']; ?></label>
              </div>
              <div class="row">
                <label class="col-sm-3 col-form-label">NIK</label>
                <label class="col-sm-9 col-form-label">:
                  <?php echo $rs['pid_num']; ?></label>
              </div>
              <div class="row">
                <label class="col-sm-3 col-form-label">TTL / Umur</label>
                <label class="col-sm-9 col-form-label">:
                  <?php echo $rs['tgl_lahir']; ?> /
                  <?php echo $rs['umur2']; ?> </label>
              </div>
              <div class="row">
                <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                <label class="col-sm-9 col-form-label">:
                  <?php echo $rs['gender']; ?></label>
              </div>
              <div class="row">
                <label class="col-sm-3 col-form-label">Alamat</label>
                <label class="col-sm-9 col-form-label">:
                  <?php echo $rs['address']; ?></label>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="row">
                <label class="col-sm-3 col-form-label">No. Registrasi</label>
                <label class="col-sm-9 col-form-label">:
                  <?php echo $rs['id_reg']; ?></label>
              </div>
              <div class="row">
                <label class="col-sm-3 col-form-label">Regdate</label>
                <label class="col-sm-9 col-form-label">:
                  <?php echo $rs['regdate']; ?></label>
              </div>
              <div class="row">
                <label class="col-sm-3 col-form-label">Kelas/Ruangan</label>
                <label class="col-sm-9 col-form-label">:
                  <?php echo $rs['kelas']; ?> / <?php echo $rs['kamar']; ?> <?php echo $rs['no_kamar']; ?></label>
              </div>
              <div class="row">
                <label class="col-sm-3 col-form-label">Dokter</label>
                <label class="col-sm-9 col-form-label">:
                  <?php echo $rs['dokter']; ?></label>
              </div>
              <div class="row">
                <label class="col-sm-3 col-form-label">Asuransi</label>
                <label class="col-sm-9 col-form-label">:
                  <?php echo $rs['company']; ?></label>
              </div>
            </div>
          </div>
        </div>
        <!-- Form Header End -->
      </div>
    </div>
  </div>
</div>
