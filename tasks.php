<?php

class Answers {
	
	function task_1(array $array): array
	{
		$arrLength = count($array);
		
		for($i = 0; $i < $arrLength / 2; $i++) {
			$tmp = $array[$i];
			$array[$i] = $array[$arrLength - 1 - $i];
			$array[$arrLength - 1 - $i] = $tmp;
		}
		
		return $array;
	}
	
	function task_2(array $array1, array $array2): bool
	{
		$array1 = array_unique($array1);
		$array2 = array_unique($array2);
		
		if(count($array1) != count($array2)){
			return false;
		}
		
		sort($array1);
		sort($array2);
		
		for($i = 0; $i < count($array1); $i++){
			if($array1[$i] !== $array2[$i]){
				return false;
			}
		}
		
		return true;
	}
	
	function task_3(array $array): array
	{
		$sortedItems = [];
		$returnArray = [];
		foreach($array as $item){
			if(!in_array($item['value'], $sortedItems[$item['id']] ?? [])){
				$sortedItems[$item['id']][] = $item['value'];
			}
		}
		
		foreach($sortedItems as $id => $values){
			$number = 0;
			$string = 0;
			foreach($values as $value){
				if(is_int($value)){
					$number++;
				} else {
					$string++;
				}
			}
			$returnArray[] = ['id' => $id, 'number' => $number, 'string' => $string];
		}
		
		return $returnArray;
	}
	
	function task_4(array $numbers): int
	{
		$sumEven = 0;
		$sumOdd = 0;
		
		foreach($numbers as $key => $number){
			if($key % 2 == 0){
				$sumEven += $number;
			} else {
				$sumOdd += $number;
			}
		}
		
		return $sumEven - $sumOdd;
	}
	
	function task_5(string $string, string $letter): array
	{
		$returnArray = [];
		
		foreach(str_split($string) as $key => $arrayLetter){
			if($letter === $arrayLetter){
				$returnArray[] = $key;
			}	
		}
		
		return $returnArray;
	}
	
	function task_6(string $string, string $letter): int
	{
		return substr_count($string, $letter);
	}
	
	function task_7(array $array): array
	{
		$currencySums = [];
		foreach($array as $item){
			if(!isset($currencySums[$item['currency']])){
				$currencySums[$item['currency']] = 0;
			}
			
			$currencySums[$item['currency']] += (double) $item['value'];
		}
		
		$returnArray = [];
		foreach($currencySums as $key => $currencySum){
			$returnArray[] = $key . ':' . $currencySum;
		}
		
		return $returnArray;
	}
	
	function task_8(array $array): string
	{
		$string = '';
		
		foreach($array as $item){
			if(ctype_alnum((string) $item) || $item == ' '){
				$string .= (string) $item;
			}
		}
		
		return $string;
	}
	
	function task_9(array $array): bool
	{
		foreach($array as $item){
			if($item['done'] === false){
				return false;
			}
		}
		
		return true;
	}
	
	function task_10(string $string, int $shiftNumber): string
	{
		$shiftNumber *= -1;
		$lowerCase = range('a', 'z');
		$upperCase = range('A', 'Z');
		
		$arrayedString = str_split($string);
		
		foreach($arrayedString as $key => $letter){
			if(in_array($letter, $lowerCase) || in_array($letter, $upperCase)){
				if(in_array($letter, $lowerCase)){
					$searchArray = $lowerCase;
				}
				if(in_array($letter, $upperCase)){
					$searchArray = $upperCase;
				}
				
				$searchArray = array_flip($searchArray);
				
				$returnIndex = $searchArray[$letter] + $shiftNumber;
			
				while($returnIndex > 25){
		        	$returnIndex -= 26;
		        }
				
				while($returnIndex < 0){
		        	$returnIndex += 26;
		        }
				
				$searchArray = array_flip($searchArray);
				
				$arrayedString[$key] = $searchArray[$returnIndex];	
			}
		}
		
		return implode($arrayedString);
	}
}

$class = new Answers;
ReflectionClass::export($class);
