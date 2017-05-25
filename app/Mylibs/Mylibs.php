<?php

namespace App\Mylibs;

use Carbon\Carbon;

class Mylibs {

	public static function datetimeToDB($date) {
		// return ex 2017-05-20 14:00
		return ($date !== null && $date !== '') ? Carbon::createFromFormat('d/m/Y H:i', $date)->subYears(543) : null;
	}

	public static function dateToDB($date) {
		// return ex 2017-05-20
		return ($date !== null && $date !== '') ? Carbon::createFromFormat('d/m/Y', $date)->subYears(543) : null;
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
	}

	public static function getMonthList() {
		return [
		'01' => 'มกราคม',
		'02' => 'กุมภาพันธ์',
		'03' => 'มีนาคม',
		'04' => 'เมษายน',
		'05' => 'พฤษภาคม',
		'06' => 'มิถุนายน',
		'07' => 'กรกฎาคม',
		'08' => 'สิงหาคม',
		'09' => 'กันยายน',
		'10' => 'ตุลาคม',
		'11' => 'พฤศจิกายน',
		'12' => 'ธันวาคม'
		];
	}

	public static function getYearList() {
		$cur_year = Carbon::now()->addYears(543)->format('Y');
		$topto = $cur_year + 11;
		$downto = $cur_year - 10;
		for ($i = $downto; $i < $topto; $i++) {
			$yearList[$i-543] = $i;
		}
		return $yearList;
	}

	public static function getMonthName($num_month) {
		$months = [
		'01' => 'มกราคม',
		'02' => 'กุมภาพันธ์',
		'03' => 'มีนาคม',
		'04' => 'เมษายน',
		'05' => 'พฤษภาคม',
		'06' => 'มิถุนายน',
		'07' => 'กรกฎาคม',
		'08' => 'สิงหาคม',
		'09' => 'กันยายน',
		'10' => 'ตุลาคม',
		'11' => 'พฤศจิกายน',
		'12' => 'ธันวาคม'
		];
		return array_pull($months, $num_month);
	}

}