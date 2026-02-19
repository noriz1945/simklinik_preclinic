<?php
defined('BASEPATH') or exit('No direct script access allowed'); 
/* Author : Sarkodan 2018-12-10 */
class Theme {
	var $CI;
	var $ihospitalsupport;
	
	var $db;
	var $db2;
	var $db3;

	var $session;
	var $session_name;
	public function __construct()
  {		
		$CI =& get_instance();
		$this->CI = $CI;

		$this->db = $CI->db;
		#$this->ihospitalsupport = $CI->ihospitalsupport;
		
		$this->db2 = $CI->db2;
		#$this->ihospitalsupport = $CI->ihospitalsupport;

		$this->db3 = $CI->db3;
		#$this->ihospitalsupport = $CI->ihospitalsupport;

		$this->session = $CI->session;
		$this->session_name = $CI->session->session_name;
	}
	
	function head($theme='theme_default')
	{
		$this->CI->load->view('../modules/'.$theme.'/views/vhead');
	}
	function wrapper_open($theme='theme_default', $breadcrum=array())
	{	
		if($theme=='theme_portal_pasien')
		{
			$data = array(
				'breadcrum' => $breadcrum,
			);
			$this->CI->load->view('../modules/'.$theme.'/views/vwrapper_open', $data);
			return;
		}
	
		#$this->CI->output->enable_profiler(true);
		$id_role	= $this->session->userdata['sp']->id_role;
		if(!$id_role){
			$this->session->sess_destroy();
			redirect('auth/login');
			//echo $id_role;exit;
		}else{
			#$sql ="SELECT b.* FROM `ihospitalsupport_user_menu` a LEFT JOIN `ihospitalsupport_menu` b ON a.`id_menu` = b.`id_menu` WHERE a.`id_role` = $id_role AND b.`aktif` = 1 ORDER BY b.urutan ASC";
			$sql ="SELECT 	DISTINCT b.* 
					FROM 	`mst_nav_role_menu` a 
							LEFT JOIN `mst_nav_menu` b ON a.`id_menu` = b.`id_menu` 
					WHERE 	a.`id_role` = '".$id_role."' AND b.`aktif` = 1 AND is_grup_submenu=0 
					ORDER BY b.urutan ASC";
			#echo "<pre>".$sql."</pre>";
			$query = $this->db->query($sql);
			$rs = $query->result_array();
				
			foreach($rs as $k => $v){
				$id_menu = $v['id_menu'];
				#$sqlx="SELECT a.* FROM `ihospitalsupport_submenu` a LEFT JOIN `ihospitalsupport_menu` b ON a.`id_menu` = b.`id_menu` WHERE b.`id_menu` = $id_menu AND a.`aktif` = 1 ORDER BY a.urutan ASC";
				$sqlx="	SELECT ax.* FROM (
						SELECT 	DISTINCT a.`menu` AS submenu,'#' AS url,1 AS is_grup_submenu,a.id_menu,a.id_menu_parent,a.urutan
						FROM 	`mst_nav_menu` a , `mst_nav_role_menu` b
						WHERE 	a.`id_menu_parent`=".$id_menu." AND a.`aktif` = 1 
								AND a.`id_menu`=b.`id_menu` AND b.`id_role` = '".$id_role."'
						UNION ALL
						SELECT 	DISTINCT a.`submenu`,a.`url`,NULL AS is_grup_submenu, NULL AS id_menu,NULL AS id_menu_parent,a.no_urut AS urutan
						FROM 	`mst_nav_submenu` a 
						WHERE 	a.`id_menu`=".$id_menu." AND a.`aktif` = 1 
						) ax
						ORDER BY (CASE WHEN COALESCE(ax.`is_grup_submenu`,0)=0 THEN CONCAT('99','.',ax.urutan) 
								ELSE CONCAT((SELECT x.urutan FROM mst_nav_menu x WHERE x.id_menu=ax.id_menu_parent),'.',ax.`urutan`) 
							  END) 
						";
				#echo "<pre>".$sql."</pre>";
				$queryx = $this->db->query($sqlx);
				$rsx = $queryx->result_array();
		
				$rs[$k]['rs_submenu'] = $rsx;
				foreach($rsx as $kk => $vv){
					if($vv['is_grup_submenu']==1)
					{
						$sqly = "SELECT DISTINCT a.`submenu`,a.`url`,NULL AS is_grup_submenu 
								FROM 	`mst_nav_submenu` a 
								WHERE 	a.`id_menu`=".$vv['id_menu']." AND a.`aktif` = 1
								ORDER BY a.no_urut";
						$queryy = $this->db->query($sqly);
						$rsy = $queryy->result_array();
						$rs[$k]['rs_submenu'][$kk]['anak'] = $rsy;
					}
					else
						$rs[$k]['rs_submenu'][$kk]['anak'] = "";
				}
			}
			#print_r($rs);
			$data = array(
				'rs'		=> $rs,
				'breadcrum' => $breadcrum,
			);
				
			$this->CI->load->view('../modules/'.$theme.'/views/vwrapper_open', $data);
		}


	}
	function wrapper_close($theme='theme_default')
	{
		$this->CI->load->view('../modules/'.$theme.'/views/vwrapper_close');
	}
	function footer($theme='theme_default')
	{
		$this->CI->load->view('../modules/'.$theme.'/views/vfooter');
	}
	function script($theme='theme_default')
	{
		$this->CI->load->view('../modules/'.$theme.'/views/vscript');
	}
}
?>