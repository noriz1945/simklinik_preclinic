<?php

defined('BASEPATH') or exit('No direct script access allowed');

/* Author : Sarkodan 2018-12-10 */

class DbConnector {

	public function __construct()

  {		

		$CI =& get_instance();

		$DB1 = $CI->load->database('default', TRUE);

		$DB2 = $CI->load->database('default2', TRUE);

		$DB3 = $CI->load->database('default3', TRUE);



		$CI->db 	= $DB1;

		$CI->dbsupp = $DB1;

		

		$CI->db2 	= $DB2;

		$CI->dbinova = $DB2;



		$CI->db3 	= $DB3;

		$CI->dbhis  = $DB3;

	}

}

?>