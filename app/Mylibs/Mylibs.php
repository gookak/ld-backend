<?php

namespace App\Mylibs;

use Carbon\Carbon;

class Mylibs {

	public static function datetimeToDB($date) {
		// return ex 2017-05-20 14:00
		return ($date !== null && $date !== '') ? Carbon::createFromFormat('d/m/Y H:i', $date)->subYears(543) : null;
	}

	public static function datetimeToView($date) {
		// return ex 20/05/2560 14:00
		Carbon::setToStringFormat('d/m/Y H:i');
		return $date !== null ? Carbon::createFromFormat('d/m/Y H:i', trim($date))->addYears(543) : null;
	}

	public static function dateToView($date) {
		// return ex 20/05/2560
		Carbon::setToStringFormat('d/m/Y');
		return $date !== null ? Carbon::createFromFormat('d/m/Y', trim($date))->addYears(543) : null;
	}


	public static function getNumDay($startdate, $enddate) {

		// $d1="2017-02-25";
		// $d2="2017-03-01";

		$date = strtotime("$enddate") - strtotime("$startdate");
		$numday = floor($date / 86400);
		return $numday +1;








		/*-----------get Num Day-------------
		# Format : getNumDay(BeginDate,EndDate)
		# Ex: getNumDay("yyyy-mm-dd","yyyy-mm-dd")
		-------------------------------------*/

		// $dArr1    = preg_split("/-/", $d1);
		// list($year1, $month1, $day1) = $dArr1;
		// $Day1 =  mktime(0,0,0,$month1,$day1,$year1);

		// $dArr2    = preg_split("/-/", $d2);
		// list($year2, $month2, $day2) = $dArr2;
		// $Day2 =  mktime(0,0,0,$month2,$day2,$year2);
		// return round(abs( $Day2 - $Day1 ) / 86400 )+1;
	}



}