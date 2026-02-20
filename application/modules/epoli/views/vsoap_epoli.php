<!doctype html>
<html>

<head>
  <?php $this->theme->head('theme_default'); ?>
</head>
<?php $this->theme->wrapper_open('theme_default', $breadcrumb); ?>

<div class="container-fluid">
  <div id="accordion">

    <div class="card">
      <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseOne">
            SOAP
          </button>
        </h5>
      </div>

      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
          ini adalah halaman Soap
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
            aria-controls="collapseTwo">
            Resep
          </button>
        </h5>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
          ini adalah halaman Resep
        </div>
      </div>
    </div>

  </div>

  <p>
    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapse_rad"
      aria-expanded="false" aria-controls="collapseExample">
      Order Radiologi
    </button>

    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapse_lab"
      aria-expanded="false" aria-controls="collapseExample">
      Order Laboratorium
    </button>

    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapse_rehab"
      aria-expanded="false" aria-controls="collapseExample">
      Order Rehab Medis
    </button>
  </p>
  <div class="collapse" id="collapse_rad">
    <div class="card card-body">
      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim
      keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
    </div>
  </div>

  <div class="collapse" id="collapse_lab">
    <div class="card card-body">
      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim
      keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
    </div>
  </div>

  <div class="collapse" id="collapse_rehab">
    <div class="card card-body">
      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim
      keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
    </div>
  </div>
</div>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>

</body>

</html>