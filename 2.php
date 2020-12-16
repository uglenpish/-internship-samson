<?php
/*- функцию convertString($a, $b). Результат ее выполнение: если в строке $a содержится 2 и более подстроки $b, то во втором месте заменить подстроку $b на инвертированную подстроку.*/

function convertString($a, $b)
{
	$pos = -1;
	$result = [];

	//находим все вхождения подстроки и записываем позициии в массив
	while(($pos = strpos($a, $b, $pos+1))!==false) {
	  $result[] = $pos;
	}
	//проверяем если длинна массива больше 1
	if(count($result) > 1){
		//заменяем второе вхождение на инвертированную подстроку
		return substr_replace($a, strrev($b), $result[1], strlen ($b));
	}
}

$str = 'piu-piu-pam-pam-tutu-pam-trach';
$last = 'pam';
$result = convertString($str, $last);

print_r($result);

echo "<br>";
