<?php

	function getYears(){
		$years = array(1973, 1974, 1975, 1976, 1977, 1978, 1979,
				   	   1980, 1981, 1982, 1983, 1984);
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