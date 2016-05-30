<?php

	function getYears(){
		$years = array(1973, 1974, 1975, 1976, 1977, 1978, 1979,
				   	   1980, 1981, 1982, 1983, 1984, 1985, 1986,
				   	   1987, 1988, 1989, 1990, 1991, 1992, 1993,
				   	   1994, 1995, 1996, 1997, 1998, 1999, 2000,
				   	   2001, 2002, 2003, 2004, 2005, 2006, 2007,
				   	   2008, 2009);
		return $years;
	}

	function getColor($str){

		$value = 0;
		$arr1 = str_split($str);
		
		for ($i=0; $i<sizeof($arr1); $i++){
			$value += ord($arr1[$i]);
		}
		
		return $value%255;
	}

	function RGBToHex($r, $g, $b) {
		$hex = "#";
		$hex.= str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
		$hex.= str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
		$hex.= str_pad(dechex($b), 2, "0", STR_PAD_LEFT);
		return $hex;
	}
	
?>