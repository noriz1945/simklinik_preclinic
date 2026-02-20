<?php
class Mst extends MX_controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('D_Mst');
    $this->load->helper('url');
    $this->load->helper('html');
    $this->load->library('encryption');
  }
  function escape($text)
  {
    return str_replace(array(","), array(""), $text);
  }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////mst header
    function mst_header(){
      $datalist       = $this->D_Mst->list_header();
      $data = array(
        'datalist'  => $datalist
      );
      $this->load->view('mst_header', $data);
    }
    function save_header(){
      $username                      = @$this->session->userdata['sp']->login_name;
      $nama_header_set               = $this->input->post('nama_header');
      $data_id_set                   = $this->input->post('data_id');
      $grup_id_set                   = $this->input->post('grup_id');
      $datetime                      = date('Y-m-d H:i:s');

        $datains = array(
          'name'              =>   $nama_header_set,
          'data_id'           =>   $data_id_set,
          'grup_id'           =>   $grup_id_set,
          'created'           =>   $datetime,
          'created_by'        =>   $username
        );
        $this->D_Mst->ins1($datains, 'cafe_headermenu');
        redirect('cafe/mst/mst_header/');
    }
    function edit_header(){
      $id         = $this->input->post('id');
      $datasett   = $this->D_Mst->edit_header($id);
      $row_0      = $id;
      $row_1      = $datasett->name;
      $row_2      = $datasett->data_id;
      $row_3      = $datasett->grup_id;
      $data = array(
        'row_0'     => $row_0,
        'row_1'     => $row_1,
        'row_2'     => $row_2,
        'row_3'     => $row_3
      );
      $dataset = json_encode($data);
      echo $dataset;
    }
    function editthis_header(){
      $username                      = @$this->session->userdata['sp']->login_name;
      $id_header_set                 = $this->input->post('id');
      $nama_header_set               = $this->input->post('nama_header_edt');
      $data_id_set                   = $this->input->post('data_id_edt');
      $grup_id_set                   = $this->input->post('grup_id_edt');
      $datetime                      = date('Y-m-d H:i:s');
      $dataupd = array(
        'name'              =>   $nama_header_set,
        'data_id'           =>   $data_id_set,
        'grup_id'           =>   $grup_id_set,
        'updated'           =>   $datetime,
        'updated_by'        =>   $username
      );
      $dataupd_where = array(
        'id'                => $id_header_set
      );
      $this->D_Mst->update_data($dataupd_where, $dataupd, 'cafe_headermenu');
      redirect('cafe/mst/mst_header/');
    }
    function deleteitempo_header(){
      $username   = @$this->session->userdata['sp']->login_name;
      $datetime   = date('Y-m-d H:i:s');
      $id         = $this->input->post('id');
      $sql        = "UPDATE cafe_headermenu SET aktif = '1',created='$datetime',created_by='$username' WHERE id='$id'; ";
      $this->db->query($sql);
      $data = "ok";
      $dataset = json_encode($data);
      echo $dataset;
    }
    function aktifasiitempo_header(){
      $username   = @$this->session->userdata['sp']->login_name;
      $datetime   = date('Y-m-d H:i:s');
      $id         = $this->input->post('id');
      $sql        = "UPDATE  cafe_headermenu SET aktif = '0',created='$datetime',created_by='$username' WHERE id='$id'; ";
      $this->db->query($sql);
      $data = "ok";
      $dataset = json_encode($data);
      echo $dataset;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////End mst header

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////mst item
    function mst_item(){
      $datalist           = $this->D_Mst->list_item();
      $data_mst_header    = $this->D_Mst->mst_header();
      $data = array(
        'datalist'         => $datalist,
        'data_mst_header'  => $data_mst_header
      );
      $this->load->view('mst_item', $data);
    }
    function save_item(){
      $username                      = @$this->session->userdata['sp']->login_name;
      $id_header_set                 = $this->input->post('id_header');
      $nama_produk_set               = $this->input->post('nama_produk');
      $keterangan_produk_set         = $this->input->post('keterangan_produk');
      $harga_set                     = $this->input->post('harga_produk');
      $datetime                      = date('Y-m-d H:i:s');

      //UPLOAD SECTION 
          $size_file                      = "5120";
          $allow_file                     = "jpg|png|jpeg";
          $strtime                        = strtotime("now");
    
          // Start uploading file
          //files dok 1
          $file_dok_upl = $this->config->item('upload_path') . "./assets/app_hn/dshomecafe/cafecss/img";

          if (!file_exists($file_dok_upl)) mkdir($file_dok_upl, 0777, true);

          $config_1 = array( 'upload_path' => $file_dok_upl, 'allowed_types' => $allow_file, 'max_size' => $size_file, 'file_name' => $strtime ); $this->load->library('upload', $config_1);

          if (!$this->upload->do_upload('nama_file')) { //nothing
            $datains = array(
              'id_header'              =>   $id_header_set,
              'nama_produk'            =>   $nama_produk_set,
              'keterangan_produk'      =>   $keterangan_produk_set,
              'harga'                  =>   $harga_set,
              'created'                =>   $datetime,
              'created_by'             =>   $username
            );
            $this->D_Mst->ins1($datains, 'cafe_itemmenu');
          }else{
          $file = $this->upload->data();
          $datains = array(
            'id_header'              =>   $id_header_set,
            'nama_produk'            =>   $nama_produk_set,
            'keterangan_produk'      =>   $keterangan_produk_set,
            'harga'                  =>   $harga_set,
            'nama_file'              =>   $strtime.$file['file_ext'],
            'created'                =>   $datetime,
            'created_by'             =>   $username
          );
          $this->D_Mst->ins1($datains, 'cafe_itemmenu');
          }
          //end files dok 1
      //END UPLOAD SECTION


        redirect('cafe/mst/mst_item/');
    }
    function edit_item(){
      $id         = $this->input->post('id');
      $datasett   = $this->D_Mst->edit_item($id);
      $row_0      = $id;
      $row_1      = $datasett->id_header;
      $row_2      = $datasett->nama_produk;
      $row_3      = $datasett->keterangan_produk;
      $row_4      = $datasett->harga;
      $row_5      = $datasett->nama_file;
      $data = array(
        'row_0'     => $row_0,
        'row_1'     => $row_1,
        'row_2'     => $row_2,
        'row_3'     => $row_3,
        'row_4'     => $row_4,
        'row_5'     => $row_5
      );
      $dataset = json_encode($data);
      echo $dataset;
    }
    function editthis_item(){
      $username                      = @$this->session->userdata['sp']->login_name;
      $id_set                        = $this->input->post('id');
      $id_header_set                 = $this->input->post('id_header_edt');
      $nama_produk_set               = $this->input->post('nama_produk_edt');
      $keterangan_set                = $this->input->post('keterangan_produk_edt');
      $harga_set                     = $this->input->post('harga_produk_edt');
      $datetime                      = date('Y-m-d H:i:s');


      //UPLOAD SECTION 
          $size_file                      = "5120";
          $allow_file                     = "jpg|png|jpeg";
          $strtime                        = strtotime("now");
    
          // Start uploading file
          //files dok 1
          $file_dok_upl = $this->config->item('upload_path') . "./assets/app_hn/dshomecafe/cafecss/img";

          if (!file_exists($file_dok_upl)) mkdir($file_dok_upl, 0777, true);

          $config_1 = array( 'upload_path' => $file_dok_upl, 'allowed_types' => $allow_file, 'max_size' => $size_file, 'file_name' => $strtime ); $this->load->library('upload', $config_1);

          if (!$this->upload->do_upload('nama_file_edt')) { //nothing
            $dataupd = array(
              'id_header'         =>   $id_header_set,
              'nama_produk'       =>   $nama_produk_set,
              'keterangan_produk' =>   $keterangan_set,
              'harga'             =>   $harga_set,
              'updated'           =>   $datetime,
              'updated_by'        =>   $username
            );
            $dataupd_where = array(
              'id'                => $id_set
            );
            $this->D_Mst->update_data($dataupd_where, $dataupd, 'cafe_itemmenu');
          }else{
          $file = $this->upload->data();
          $dataupd = array(
            'id_header'         =>   $id_header_set,
            'nama_produk'       =>   $nama_produk_set,
            'keterangan_produk' =>   $keterangan_set,
            'harga'             =>   $harga_set,
            'nama_file'         =>   $strtime.$file['file_ext'],
            'updated'           =>   $datetime,
            'updated_by'        =>   $username
          );
          $dataupd_where = array(
            'id'                => $id_set
          );
          $this->D_Mst->update_data($dataupd_where, $dataupd, 'cafe_itemmenu');
          }
          //end files dok 1
      //END UPLOAD SECTION

      redirect('cafe/mst/mst_item/');
    }
    function deleteitempo_item(){
      $username   = @$this->session->userdata['sp']->login_name;
      $datetime   = date('Y-m-d H:i:s');
      $id         = $this->input->post('id');
      $sql        = "UPDATE cafe_itemmenu SET aktif = '1',created='$datetime',created_by='$username' WHERE id='$id'; ";
      $this->db->query($sql);
      $data = "ok";
      $dataset = json_encode($data);
      echo $dataset;
    }
    function aktifasiitempo_item(){
      $username   = @$this->session->userdata['sp']->login_name;
      $datetime   = date('Y-m-d H:i:s');
      $id         = $this->input->post('id');
      $sql        = "UPDATE  cafe_itemmenu SET aktif = '0',created='$datetime',created_by='$username' WHERE id='$id'; ";
      $this->db->query($sql);
      $data = "ok";
      $dataset = json_encode($data);
      echo $dataset;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////End mst item
}
