<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->theme->head('theme_default'); ?>
<title>SIMKLINIK</title>
</head>


<body>
<?php $this->theme->wrapper_open('theme_default'); ?>
<div class="loader-bg">
<div class="loader-bar"></div>
</div>

<div id="pcoded" class="pcoded">
<div class="pcoded-overlay-box"></div>
<div class="pcoded-container navbar-wrapper">

<div class="pcoded-main-container">
<div class="pcoded-wrapper">

<div class="pcoded-content">

<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<i class="feather icon-book bg-c-blue"></i>
<div class="d-inline">
<h5>Master Data</h5>

<span>Menu</span>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class=" breadcrumb breadcrumb-title">
<li class="breadcrumb-item">
<a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a>
</li>
<li class="breadcrumb-item">
<a href="<?php echo base_url('soap_menu/'); ?>">List Menu</a>
</li>
</ul>
</div>
</div>
</div>
</div>

<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">

<div class="page-body">
<div class="row">
<div class="col-sm-12">

<div class="card">

<div class="container-fluid">

    <!-- Main content -->

<div class="" style="">
<div class="col-md-12 box-shadow--16dp" style="margin-top:30px;">
<h2 class="bg-primary text-center" style="border-radius:5px;">List User</h2>

  <div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
    	<?php echo anchor(site_url('mst_nav_user/create'),'Tambah Data', 'class="btn btn-primary"'); ?>            
		</div>
      <div class="col-md-4 text-center">
        <div style="margin-top: 8px" id="message">
					<!--<?php #echo $this->session->userdata("message") <> "" ? $this->session->userdata("message") : ""; ?>-->
				</div>
      </div>
    <div class="col-md-1 text-right"></div>
    <div class="col-md-3 text-right">
      <form action="<?php echo site_url('mst_nav_user/index'); ?>" class="form-inline" method="get">
        <div class="input-group">
          <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
          <span class="input-group-btn">
						<?php 
								if ($q <> "")
								{
										?>
										<a href="<?php echo site_url('mst_nav_user'); ?>" class="btn btn-default">Reset</a>
										<?php
								}
						?>
          	<button class="btn btn-primary" type="submit">Cari</button>
          </span>
        </div>
      </form>
    </div>
  </div>
	
  <div class="table-responsive">      
    <table class="table table-bordered table-hover table-striped table-responsive">
      <tbody>
        <tr>
          <th scope="col">NO</th>
          <th scope="col">Aktif</th>
          <!--<th scope="col">Created</th>-->
          <!--<th scope="col">Creator</th>-->
          <th scope="col">Id Dokter</th>
          <th scope="col">Role</th>
          <th scope="col">Login Name</th>
          <!-- <th scope="col">Login Pass</th> -->
          <th scope="col">Name</th>
          <th scope="col">SIP/STR</th>
          <!--<th scope="col">Updated</th>-->
          <!--<th scope="col">Updater</th>-->
					<th scope="col">ACTION</th>
        </tr>
				<?php
						#print_r($mst_nav_user_data);
            foreach ($mst_nav_user_data as $mst_nav_user)
            {
        ?>
        <tr>
					<td width="80px"><?php echo ++$start ?></td>
							<td><?php echo $mst_nav_user->aktif ?></td>
							<!--<td><#?php echo $mst_nav_user->created ?></td>
							<td><#?php echo $mst_nav_user->creator ?></td>-->
							<td><?php echo $mst_nav_user->id_dokter ?></td>
							<td><?php echo $mst_nav_user->nama_role ?></td>
              <td><?php echo $mst_nav_user->login_name ?></td>
							<!-- <td><?php #echo $mst_nav_user->login_pass ?></td> -->
							<td><?php echo $mst_nav_user->name ?></td>
              <td><?php echo $mst_nav_user->sip_str ?></td>
							<!--<td><#?php echo $mst_nav_user->updated ?></td>
							<td><#?php echo $mst_nav_user->updater ?></td>-->
          <td nowrap>
							<?php  
								#echo anchor(site_url("mst_nav_user/read/".$mst_nav_user->login_name),"<img src=\"".base_url('assets/img/doc_read.png')."\" style=\"max-height:20px;\">") . " &nbsp; ";
								echo anchor(site_url("mst_nav_user/update/".$mst_nav_user->login_name),"<img src=\"".base_url('assets/img/doc_edit.png')."\" style=\"max-height:20px;\">") . " &nbsp; ";
								echo anchor(site_url("mst_nav_user/delete/".$mst_nav_user->login_name),"<img src=\"".base_url('assets/img/doc_delete.png')."\" style=\"max-height:20px;\">","onclick=\"javasciprt: return confirm('Yakin hapus ?');\"");
							?>
					</td>
        
				</tr>
				<?php
        	}
        ?>
      </tbody>
    </table>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="#" class="btn btn-primary">Total Data : <?php echo $total_rows ?></a>
						
        </div>
        <div class="col-md-6 text-right">
            <?php echo $pagination ?>           
        </div>
    </div>
</div>
</div>

    <!-- /.content -->
		
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
</body>
</html>
