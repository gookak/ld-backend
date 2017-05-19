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

}