<!DOCTYPE html>
<html lang="en">
    <head> 
    <?php $this->theme->head('theme_default'); ?> 
    <style>
    .card {
        margin-bottom: 10px;
    }
    .card .card-header {
        padding: 10px 20px 0 20px;
    }
    .card .card-block {
        padding: 0 20px;
    }
    </style>
    </head>
    <body> 
    <?php $this->theme->wrapper_open('theme_default'); ?> 
        </div>
                            <div class="page-header card">
                                <div class="row align-items-end">
                                    <div class="col-lg-8">
                                        <div class="page-header-title">
                                            <i class="feather icon-book bg-c-red"></i>
                                            <div class="d-inline">
                                                <h5>Mastering tindakan</h5>
                                                <span>Deskripsi</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="page-header-breadcrumb">
                                            <ul class=" breadcrumb breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="<?php echo base_url('./'); ?>">
                                                        <i class="ti ti-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="<?php echo base_url('mst_tindakan/mst_tindakan/'); ?>">Form tindakan </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    <div class="page-wrapper">
                                        <div class="page-body">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>List tindakan</h5>
                                                </div>
                                                <div class="card-block">
                                                    <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#large-Modal">
                                                        <i class="ti ti-plus"></i>tindakan </button>
                                                    <div class="dt-responsive table-responsive">
                                                        <table w-100 id="order-table" class="table w-100 table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Nama tindakan</th>
                                                                    <th>Group</th>
                                                                    <th>Subgroup</th>
                                                                    <th>Type</th>
                                                                    <th>Harga</th>
                                                                    <th>Status</th>
                                                                    <th>
                                                                        <i class="ti ti-edit"></i>
                                                                    </th>
                                                                    <th>
                                                                        <i class="ti ti-trash" style="color:red;"></i>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody> 
                                                                <?php 
                                                                    $no=1; 
                                                                    foreach($datalist as $dt){ 
                                                                        if($dt->aktif==1){ 
                                                                            $stat="Aktif"; 
                                                                            $statcolor="color:green"; 
                                                                        }elseif(
                                                                            $dt->aktif==0){ 
                                                                            $stat="Tidak Aktif"; $statcolor="color:red"; 
                                                                        }else{ 
                                                                            $stat="-"; $statcolor=""; 
                                                                        }?> 
                                                                    <tr>
                                                                    <td> <?php echo $no++; ?> </td>
                                                                    <td> <?php echo $dt->name; ?> </td>
                                                                    <td> <?php echo $dt->grup; ?> </td>
                                                                    <td> <?php echo $dt->subgrup; ?> </td>
                                                                    <td> <?php echo $dt->type; ?> </td>
                                                                    <td> <?php echo number_format($dt->price,2); ?> </td>
                                                                    <td style="<?php echo $statcolor; ?>"> <?php echo $stat; ?> </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-warning waves-effect editset_tindakan" data-toggle="modal" data-target="#large-Modal_edt_1" data-set-id="<?php echo $dt->id_act; ?>" data-set-name="<?php echo $dt->name; ?>">
                                                                            <i class="ti ti-edit"></i>
                                                                        </button>
                                                                    </td> <?php if($dt->aktif==1){ ?> <td>
                                                                        <button type="button" class="btn btn-danger waves-effect delset_tindakan" data-set-id="<?php echo $dt->id_act; ?>" data-set-name="<?php echo $dt->name; ?>">
                                                                            <i class="ti ti-trash"></i>
                                                                        </button>
                                                                    </td> <?php }else{ ?> <td>
                                                                        <button type="button" class="btn btn-success waves-effect atvset_tindakan" data-set-id="<?php echo $dt->id_act; ?>" data-set-name="<?php echo $dt->name; ?>">
                                                                            <i class="fa fa-check"></i>
                                                                        </button>
                                                                    </td> <?php } ?>
                                                                </tr> <?php } ?> </tfoot>
                                                        </table>
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
        <div class="modal fade" id="large-Modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document" style="max-width: 1420px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">INPUT tindakan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url('mst_tindakan/save_tindakan/'); ?>" method="POST" id="form">
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label>Nama tindakan</label>
                                    <input type="text" class="form-control" id="nama_tindakan_set" name="nama_tindakan_set" placeholder="Nama tindakan">
                                </div>
                                <div class="col-sm-4">
                                    <label>Harga</label>
                                    <input type="text" class="form-control" id="harga_tindakan_set" name="harga_tindakan_set" placeholder="Harga tindakan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label>Group</label>
                                    <select class="form-control" id="group_set" name="group_set" required>
                                        <option value="" default >Pilih Group</option> <?php foreach($datalistgroup as $datagroup){ ?> <option value="<?php echo $datagroup->id_group; ?>"> <?php echo $datagroup->name; ?> </option> <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Subgroup</label>
                                    <select class="form-control" id="subgroup_set" name="subgroup_set" required></select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Type</label>
                                    <select class="form-control" id="type_set" name="type_set" required>
                                        <option value="" default>Pilih Type</option> <?php foreach($datalisttype as $datatype){ ?> <option value="<?php echo $datatype->id_type; ?>"> <?php echo $datatype->name; ?> </option> <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label>Share Dokter</label>
                                    <input type="text" class="form-control" id="share_dokter_set" name="share_dokter_set" placeholder="">
                                </div>
                                <div class="col-sm-4">
                                    <label>Share Klinik / RS</label>
                                    <input type="text" class="form-control" id="share_klinikrs_set" name="share_klinikrs_set" placeholder="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" id="del_tindakan">Close</button>
                                <button type="button" class="btn btn-success waves-effect waves-light" id="tindakan">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--edit-->
        <div class="modal fade" id="large-Modal_edt_1" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document" style="max-width: 1420px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="txtedt">EDIT tindakan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url('mst_tindakan/editthis_tindakan/'); ?>" method="POST" id="formedit">
                        <div class="modal-body">
                            <input type="text" class="form-control row_0" id="id" name="id" placeholder="ID" readonly hidden>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label>Nama tindakan</label>
                                    <input type="text" class="form-control row_1" id="edt_nama_tindakan_set" name="edt_nama_tindakan_set" placeholder="Nama tindakan">
                                </div>
                                <div class="col-sm-4">
                                    <label>Harga</label>
                                    <input type="text" class="form-control row_2" id="edt_harga_tindakan_set" name="edt_harga_tindakan_set" placeholder="Harga tindakan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label>Group</label>
                                    <select class="form-control row_3" id="edt_group_set" name="edt_group_set" required>
                                        <option value="" default >Pilih Group</option> <?php foreach($datalistgroup as $datagroup){ ?> <option value="<?php echo $datagroup->id_group; ?>"> <?php echo $datagroup->name; ?> </option> <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Subgroup</label>
                                    <select class="form-control row_4" id="edt_subgroup_set" name="edt_subgroup_set" required></select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Type</label>
                                    <select class="form-control row_5" id="edt_type_set" name="edt_type_set" required>
                                        <option value="" default>Pilih Type</option> <?php foreach($datalisttype as $datatype){ ?> <option value="<?php echo $datatype->id_type; ?>"> <?php echo $datatype->name; ?> </option> <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                            
                             <div class="form-group row">
                                <div class="col-sm-4">
                                    <label>Jenis Nakes / Operator</label>
                                        <?php echo $dropdown_id_jenis ?>
                                </div>
                            </div>
                            
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6>Share Nakes</h6>
                                        </div>
                                        <div class="card-block">
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <label>Share Vendor (%)</label>
                                                    <input type="text" class="form-control row_6 text-center" id="share_dokter_vendor" name="share_dokter_vendor" data-lawan-2="#share_dokter" data-lawan-3="#share_dokter_rs">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>Share Nakes (%)</label>
                                                    <input type="text" class="form-control row_7 text-center" id="share_dokter" name="share_dokter" data-lawan-1="#share_dokter_vendor" data-lawan-3="#share_dokter_rs">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>Share Klinik / RS (%)</label>
                                                    <input type="text" class="form-control row_8 text-center" id="share_dokter_rs" name="share_dokter_rs" placeholder="" readonly>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" id="del_edit_tindakan">Close</button>
                                <button type="button" class="btn btn-success waves-effect waves-light" id="edit_tindakan">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end edit-->
    </body> 
    <?php $this->theme->wrapper_close('theme_default'); ?> 
    <?php $this->theme->script('theme_default'); ?> 
    </script>