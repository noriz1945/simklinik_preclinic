<?php
class Usergp extends MX_controller
{
    var $session_name='sgs';

    function __construct()
    {
        parent::__construct();
        $this->load->model('Models_usergp');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
    }

    function readdata_user(){
        $username	= @$this->session->userdata['sgs']->username;
        $userData = $this->Models_usergp->user_data($username);
        
         $data = array(
            'userData'       => $userData
        );

         $this->load->view('v_user_form',$data);
     }    


     function updatedata_user(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $data = array(
            'password' => md5($password)
        );
    
        $whereu = array(
            'username' => $username
        );
    
        $this->Models_usergp->update_data($whereu,$data,' ihospitalsupport_mst_user');
       redirect('usergp/usergp/readdata_user');
    }
     
}
?>