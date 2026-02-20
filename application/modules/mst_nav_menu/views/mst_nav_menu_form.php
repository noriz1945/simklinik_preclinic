<!DOCTYPE html>
<html lang="en">
    <head> 
		<?php $this->theme->head('theme_default'); ?> 
		<title>SIMKLINIK</title>
    </head>
    <body> <?php $this->theme->wrapper_open('theme_default'); ?> <div class="loader-bg">
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
                                                    <a href="
														<?php echo base_url('./'); ?>">
                                                        <i class="feather icon-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="
														<?php echo base_url('mst_nav_menu/'); ?>">List Menu </a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="#">Edit Menu</a>
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
                                                            <h2 class="bg-primary text-center" style="border-radius:5px;"> Buat / Edit Menu </h2>
                                                            <form class="form-horizontal" action="
																<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                                                                
																<!-- RADIO -->
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label">Aktif</label>
                                                                    <div class="col-sm-8"> {radio-aktif} </div>
                                                                </div>
                                                                <!-- TEXT -->
                                                                <div class="form-group">
                                                                    <label for="icon" class="col-sm-4 control-label">Icon</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon" value="<?php echo $icon; ?>" />
                                                                    </div>
                                                                </div>
                                                                <!-- TEXT -->
                                                                <div class="form-group">
                                                                    <label for="menu" class="col-sm-4 control-label">Menu</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="menu" id="menu" placeholder="Menu" value="<?php echo $menu; ?>" />
                                                                    </div>
                                                                </div>
                                                                <!-- NUMERIC -->
                                                                <div class="form-group">
                                                                    <label for="urutan" class="col-sm-4 control-label">Urutan</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="number" class="form-control" name="urutan" id="urutan" placeholder="Urutan" value="<?php echo $urutan; ?>" />
                                                                    </div>
                                                                </div>
																
																<div class="form-group">
                                                                    <label class="col-sm-4 control-label">Opsi Lainnya</label>
                                                                    <div class="col-sm-8"><hr></div>
                                                                </div>
																
																<!-- RADIO -->
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label">Adalah Grup Submenu</label>
                                                                    <div class="col-sm-8"> {radio-is_grup_submenu} </div>
                                                                </div>
																
																<!-- DROPDOWN -->
																<div class="form-group" id="box_menu_parent">
																	<label for="id_menu" class="col-sm-4 control-label">Pilih Menu Utananya</label>
																	<div class="col-sm-8">
																		{dropdown-id_menu_parent}
																	</div>
																</div>
																
                                                                <!-- BUTTON -->
                                                                <!-- Standard button -->
                                                                <div class="form-group">
                                                                    <div class="col-sm-4 col-sm-offset-4">
                                                                        <input type="hidden" name="id_menu" value="
																						<?php echo $id_menu; ?>" />
                                                                        <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                        <button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('mst_nav_menu'); ?>';">Kembali </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <!-- /.content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
		</script>
<script>
function load_unload_parent_menu()
{
	var is_grup_submenu = $('input[name="is_grup_submenu"]:checked').val();
	if(is_grup_submenu==1)
	{
		$('#box_menu_parent').removeClass("d-none");
	}
	else
	{
		$('#box_menu_parent').addClass("d-none");
		$('#box_menu_parent').val("").change();
	}
}
$('#box_menu_parent').addClass("d-none");
load_unload_parent_menu();
</script>

    </body>
</html>