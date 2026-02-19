<?php
/* Author : Sarkodan 2018-12-12 */
ini_set('max_execution_time', 60);
ini_set('memory_limit', '30048M');
defined('BASEPATH') or exit('No direct script access allowed');
class FormGenerator
{
	var $property_id;
	var $CI;
	function __construct()
	{
		#parent::__construct();
		#$this->myload();
		$this->CI =& get_instance();
	}

	/*
	function myload()
	{
		$DB1 = $this->load->database('default', TRUE);
		$DB2 = $this->load->database('default2', TRUE);
		#print_r($DB2);
		$CI =& get_instance();
		$CI->dbsupp = $DB1;
		$CI->dbhis = $DB2;
		#print_r($this->CI->dbxx);
	}
	*/

	function get_dropdown($input_name, $sql, $selected_id = '', $readmode = false, $onChange = '', $selected_db = '')
	{
		if ($selected_db == 'dbhis') {
			$query = $this->CI->dbhis->query($sql);
		} elseif ($selected_db == 'dbsupp') {
			$query = $this->CI->dbsupp->query($sql);
		} else {
			$query = $this->CI->db->query($sql);
		}

		$arr_field = $query->list_fields();
		$options = array('' => '');
		foreach ($query->result_array() as $row) {
			$option_id 	= $row[$arr_field[0]];
			$option_val	= $row[$arr_field[1]];
			$options[$option_id] = $option_val;
		}
		$js = array(
			'id'       		=> $arr_field[0],
			'class'				=> 'form-control',
			'placeholder'	=> 'Pilih',
			'onChange' 		=> $onChange,
			#'style'				=> 'max-width:300px'
		);
		$html = form_dropdown($input_name, $options, $selected_id, $js);
		// -------- READ MODE ---------
		if ($readmode)
			$html = '<fieldset disabled>' . $html . '</fieldset>
					<input type="hidden" name="' . $input_name . '" value="' . $selected_id . '" />
					';
		return $html;
	}

	public function get_checkbox($input_name, $sql, $selected_id = array(), $readmode = false, $onClick = '')
	{
		$query = $this->CI->db->query($sql);
		$arr_field = $query->list_fields();
		$html = '';
		$counter = 0;
		foreach ($query->result_array() as $row) {
			// ------ CHECKBOX ------					
			$data = array(
				'name'          => $input_name . "[]",
				'id'            => $arr_field[0] . $counter,
				'value'         => $row[$arr_field[0]],
				'checked'       => (in_array($row[$arr_field[0]], $selected_id)) ? 'checked' : '',
				'style'         => ''
			);
			$checkbox = form_checkbox($data);

			// ------ LABEL ------
			$text = $row[$arr_field[1]];

			// ------ HTML -------					
			$html .= '<div class="checkbox">
										<label>
											' . $checkbox . '
											' . $text . '
										</label>
									</div>';
			// -------- READ MODE ---------
			if ($readmode)
				$html = '<fieldset disabled>' . $html . '</fieldset>';

			$counter++;
		}
		return $html;
	}

	public function get_radio($input_name, $sql, $selected_id = '', $readmode = false, $onClick = '')
	{
		$query = $this->CI->db->query($sql);
		$arr_field = $query->list_fields();
		$radios = '';
		$counter = 0;
		foreach ($query->result_array() as $row) {
			$radios .= "<label>";
			// ------ RADIO ------					
			$data = array(
				'name'          => $input_name,
				'id'            => $arr_field[0] . $counter,
				'value'         => $row[$arr_field[0]],
				'checked'       => ($selected_id == $row[$arr_field[0]]) ? 'checked' : '',
				'onClick'         => $onClick
			);
			$radios .= "\n";
			$radios .= form_radio($data);

			$radios .= $row[$arr_field[1]];
			$radios .= "</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			$counter++;
		}
		$html = '<div class="radio">
									' . $radios . '
							</div>';

		// -------- READ MODE ---------
		if ($readmode)
			$html = '<fieldset disabled>' . $html . '</fieldset>';
		return $html;
	}

	public function get_selected_checkbox($sql, $search_field_name, $field_value, $ret_field_name)
	{
		#$sql = "SELECT ".$ret_field_name." FROM ".$table." WHERE ".$search_field_name."='".$field_value."'";
		$query = $this->CI->db->query($sql);
		$data = array();
		foreach ($query->result_array() as $row) {
			$data[] = $row[$ret_field_name];
		}
		return $data;
	}

	public function get_selected_dropdown($table, $search_field_name, $field_value, $ret_field_name)
	{
		$sql = "SELECT " . $ret_field_name . " FROM " . $table . " WHERE " . $search_field_name . "='" . $field_value . "'";
		$query = $this->CI->db->query($sql);

		$row = $query->row();
		$data = $row->$ret_field_name;
		return $data;
	}

	public function fo_date_format($date)
	{
		$exp_date = explode(" ", $date);
		$exp_date = explode("-", $exp_date);
		$exp_time = explode("-", $exp_time);
	}

	public function get_course_name($course_id)
	{
		$sql = "SELECT course_name FROM data_course WHERE course_id='" . $course_id . "'";
		$query = $this->CI->db->query($sql);

		$row = $query->row();
		$data = $row->course_name;
		return $data;
	}

	public function read_upload($file_name, $data_start = 1, $dates = array())
	{
		require(FCPATH . '/spreadsheet-reader-master/' . 'php-excel-reader/excel_reader2.php');
		require(FCPATH . '/spreadsheet-reader-master/' . 'SpreadsheetReader.php');
		$reader = new SpreadsheetReader(FCPATH . "/uploaded/" . $file_name);
		$alphabet = $this->createColumnsArray($end_column = 'AZ', $first_letters = '');

		/*
		foreach ($reader as $rownum => $row)
    {
			print_r($row);
		}
		die();
		*/

		foreach ($reader as $rownum => $row) {
			if ($rownum < ($data_start - 1)) continue;
			if ($row[0] == "") break;
			foreach ($row as $collet => $cell) {
				$collet_idx = $alphabet[$collet];
				if (in_array($collet_idx, $dates)) {
					$dt = explode("-", $cell);
					$pre_y = DateTime::createFromFormat('y', $dt[2]);
					if (!$pre_y) {
						print_r($row);
						die();
					}
					$new_y = $pre_y->format('Y');
					#$new_dt = $new_y."-".$dt[1]."-".$dt[0];
					$new_dt = date("Y-m-d", mktime(0, 0, 0, $dt[1], $dt[0], $new_y));
					$cell = $new_dt;
				}
				$data[$rownum][$collet_idx] = $cell;
			}
		}
		#print_r($data);die();
		return $data;
	}

	public function createColumnsArray($end_column = 'ZZ', $first_letters = '')
	{
		$columns = array();
		$length = strlen($end_column);
		$letters = range('A', 'Z');

		// Iterate over 26 letters.
		foreach ($letters as $letter) {
			// Paste the $first_letters before the next.
			$column = $first_letters . $letter;

			// Add the column to the final array.
			$columns[] = $column;

			// If it was the end column that was added, return the columns.
			if ($column == $end_column)
				return $columns;
		}

		// Add the column children.
		foreach ($columns as $column) {
			// Don't itterate if the $end_column was already set in a previous itteration.
			// Stop iterating if you've reached the maximum character length.
			if (!in_array($end_column, $columns) && strlen($column) < $length) {
				$new_columns = $this->createColumnsArray($end_column, $column);
				// Merge the new columns which were created with the final columns array.
				$columns = array_merge($columns, $new_columns);
			}
		}

		return $columns;
	}
}
?>