<?php
defined('BASEPATH') or exit('No direct script access allowed');
/* Author : Sarkodan 2023-12-18 */

require 'vendor/autoload.php';
		use PhpOffice\PhpSpreadsheet\Spreadsheet;
		use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
		use PhpOffice\PhpSpreadsheet\Shared\Font;
		
class Exportir {
	var $db;
	var $db2;
	var $CI;
	public function __construct()
	{
		$CI =& get_instance();
		$this->CI = $CI;

		$this->db = $CI->db;
	}
	
	function export_to_spreadsheet($title=array(),$rs=array())
	{
		#echo APPPATH.'vendor/autoload.php';
		#die();
		$title_num = array_values($title);
		
		#Font::setTrueTypeFontPath('C:/Windows/Fonts/');
		#Font::setAutoSizeMethod(Font::AUTOSIZE_METHOD_EXACT);
		
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		### --- HEADER col style -------------------------------------------------------------------
		$style_col = [
			'font' 		=> ['bold' => true],
			'alignment' => [
				'horizontal' 	=> \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical'		=> \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
			],
			'borders' 	=> [
				'top' 		=> ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				'right' 	=> ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				'bottom' 	=> ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				'left' 		=> ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
				]
		];

		### --- HEADER row style -------------------------------------------------------------------
		$style_row = [
			'alignment' 	=> [
				'vertical' 	=> \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
			],
			'borders' => [
				'top' 		=> ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				'right' 	=> ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				'bottom' 	=> ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				'left' 		=> ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
			]
		];

		### --- START title ------------------------------------------------------------------
		$x = 'A' ;
		$y =  1  ;
		foreach($title as $key => $val)
		{
			$sheet->setCellValue(($x.$y), $key); $x++; 
			$sheet->setCellValue(($x.$y), $val);
			
			$x='A';
			$y++;
		}
		$y++;
		
		#$sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
		#$sheet->getStyle('A1')->getFont()->setBold(true);
		
		### --- START header table ------------------------------------------------------------------
		$sheet->setCellValue(($x.$y), "NO"); 
		$sheet->getStyle(($x.$y))->applyFromArray($style_col);
		$x++;
		if(is_array($rs) && !empty($rs))
		{
			  foreach($rs[0] as $key => $val)
			  {
				  $sheet->setCellValue(($x.$y), $key); 
				  $sheet->getStyle(($x.$y))->applyFromArray($style_col);
				  $x++;
			  }
	    }
		$x='A';
		$y++;
		
		### --- START content table ------------------------------------------------------------------
		$no = 1;
		if(is_array($rs) && !empty($rs))
		{
			  foreach ($rs as $data) 
			  {
				  $sheet->setCellValue(($x.$y), $no); 
				  $sheet->getStyle($x.$y)->applyFromArray($style_row);
				  $sheet->getColumnDimension($x)->setAutoSize(true);
				  $x++;
				  foreach ($data as $cellval) 
				  {
					  $sheet->setCellValue(($x.$y), $cellval);
					  $sheet->getStyle($x.$y)->applyFromArray($style_row);
					  $sheet->getColumnDimension($x)->setAutoSize(true);
					  $x++;
				  }
				  $no++;
				  $y++;
				  $x='A';
			  }
	    }
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$sheet->getDefaultRowDimension()->setRowHeight(-1);

		// Set orientasi kertas jadi LANDSCAPE
		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT);

		// Set judul file excel nya
		$sheet->setTitle($title_num[0]);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'.$title_num[0].'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->setOffice2003Compatibility(true);
		$writer->save('php://output');
		
	}
}