<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Terbilang Helper
 *
 * @package	CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author	Gede Lumbung
 * @link	http://gedelumbung.com
 */
/* Modifier : Sarkodan 2023-11-25 */

class Terbilang {
	#var $CI;
	public function __construct()
	{
		#$CI =& get_instance();
		#$this->CI = $CI;
	}
	
	function number_to_words($number)
	{
		$before_comma = trim($this->to_word($number));
		$after_comma = trim($this->comma($number));
		return ucwords($results = $before_comma.' rupiah ');
	}

	function to_word($number)
	{
		$words = "";
		$arr_number = array(
		"",
		"satu",
		"dua",
		"tiga",
		"empat",
		"lima",
		"enam",
		"tujuh",
		"delapan",
		"sembilan",
		"sepuluh",
		"sebelas");

		if($number<12)
		{
			$words = " ".$arr_number[$number];
		}
		else if($number<20)
		{
			$words = $this->to_word($number-10)." belas";
		}
		else if($number<100)
		{
			$words = $this->to_word($number/10)." puluh ".$this->to_word($number%10);
		}
		else if($number<200)
		{
			$words = "seratus ".$this->to_word($number-100);
		}
		else if($number<1000)
		{
			$words = $this->to_word($number/100)." ratus ".$this->to_word($number%100);
		}
		else if($number<2000)
		{
			$words = "seribu ".$this->to_word($number-1000);
		}
		else if($number<1000000)
		{
			$words = $this->to_word($number/1000)." ribu ".$this->to_word($number%1000);
		}
		else if($number<1000000000)
		{
			$words = $this->to_word($number/1000000)." juta ".$this->to_word($number%1000000);
		}
		else
		{
			$words = "undefined";
		}
		return $words;
	}

	function comma($number)
	{
		$after_comma = stristr($number,',');
		$arr_number = array(
		"nol",
		"satu",
		"dua",
		"tiga",
		"empat",
		"lima",
		"enam",
		"tujuh",
		"delapan",
		"sembilan");

		$results = "";
		$length = strlen($after_comma);
		$i = 1;
		while($i<$length)
		{
			$get = substr($after_comma,$i,1);
			$results .= " ".$arr_number[$get];
			$i++;
		}
		return $results;
	}
}
