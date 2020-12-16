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

/*- функию mySortForKey($a, $b). $a – двумерный массив вида [['a'=>2,'b'=>1],['a'=>1,'b'=>3]], $b – ключ вложенного массива. Результат ее выполнения: двумерном массива $a отсортированный по возрастанию значений для ключа $b. В случае отсутствия ключа $b в одном из вложенных массивов, выбросить ошибку класса Exception с индексом неправильного массива.*/

function mySortForKey($a, $b)
{
	$sortArr = [];
  foreach($a as $key=>$val){
  	if(!array_key_exists($b, $val)){
  		throw new Exception("Массив с индексом $key не содержит ключь $b");
  	}
    $sortArr[$key] = $val[$b];
  }

  array_multisort($sortArr, $a);

  return $a;
}

$arr = [['a'=>2,'b'=>1], ['a'=>1,'b'=>3], ['a'=>7,'b'=>2]];
$key = 'a';

print_r(mySortForKey($arr, $key));

$arr = [['a'=>2,'b'=>1], ['b'=>3], ['a'=>7,'b'=>2]];
$key = 'a';

print_r(mySortForKey($arr, $key));