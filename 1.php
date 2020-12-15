<?php

/*Реализовать функцию findSimple ($a, $b). $a и $b – целые положительные числа. Результат ее выполнение: массив простых чисел от $a до $b.*/
function is_prime($num)
{
  if ($num == 1)
    return false;
    for ($i = 2; $i <= $num/2; $i++)
    {
      if ($num % $i == 0)
      {
          return false;
      }
    }
  return true;
}

function findSimple ($a, $b)
{
	$arr = [];

	for($i=$a; $i<=$b; $i++) {
		if(is_prime($i)){
			$arr[] = $i;
		}

	}

  return $arr;
}

$r = findSimple (3, 7);
print_r($r);

/*Реализовать функцию createTrapeze($a). $a – массив положительных чисел, количество элементов кратно 3. Результат ее выполнение: двумерный массив (массив состоящий из ассоциативных массива с ключами a, b, c). Пример для входных массива [1, 2, 3, 4, 5, 6] результат [[‘a’=>1,’b’=>2,’с’=>3],[‘a’=>4,’b’=>5 ,’c’=>6]].*/


echo '<br>';

function createTrapeze($a)
{
	$chunks = array_chunk($a, 3);// разбиваем по 3
	$result = array_map(function($item) {
	  return array_combine(['a', 'b', 'c'], $item);
	}, $chunks);// объединяем 2 массива 
	
	return $result;
}



$in = [1, 2, 3, 4, 5, 6];

$arr2 = createTrapeze($in);
 
print_r($arr2);

echo '<br>';

/*Реализовать функцию squareTrapeze($a). $a – массив результата выполнения функции createTrapeze(). Результат ее выполнение: в исходный массив для каждой тройки чисел добавляется дополнительный ключ s, содержащий результат расчета площади трапеции со сторонами a и b, и высотой c.*/

function squareTrapeze($a)
{
	foreach ($a as &$item) {
		$s = &$item['s'];
		$s = ($item['a']+$item['b'])*$item['c']/2;
		// print_r($item);
	}
	return $a;
}
$arr3 = squareTrapeze($arr2);
print_r($arr3);
echo '<br>';

/*Реализовать функцию getSizeForLimit($a, $b). $a – массив результата выполнения функции squareTrapeze(), $b – максимальная площадь. Результат ее выполнение: массив размеров трапеции с максимальной площадью, но меньше или равной $b.*/

function getSizeForLimit($a, $b)
{
	foreach ($a as $key => $value) {
		
		if ($value['s'] <= $b) {
			return ($value);// фильтруем массив
		}
	}
}

print_r(getSizeForLimit($arr3, '15'));
echo '<br>';

/*Реализовать функцию getMin($a). $a – массив чисел. Результат ее выполнения: минимальное числа в массиве (не используя функцию min, ключи массив может быть ассоциативный).*/

function getMin($a)
{
	$min = null;
	foreach ($a as $key => $value) {
		if($value < $min or $min === null){
      $min = $value;
      print_r($min);
    }
	}
	
}

$my_array = ['a' => 3,
             'b' => 34,
              10 => 7,
              -5 => 290];
getMin($my_array);
echo '<br>';
getMin($in);
echo '<br>';

/*Реализовать функцию printTrapeze($a). $a – массив результата выполнения функции squareTrapeze(). Результат ее выполнение: вывод таблицы с размерами трапеций, строки с нечетной площадью трапеции отметить любым способом.*/

function printTrapeze($a)
{
	echo '<table border="2px" style = "border-collapse: collapse">';
		echo '<tr>';
			echo '<td>';
				echo 'a';
			echo '</td>';
			echo '<td>';
				echo 'b';
			echo '</td>';
			echo '<td>';
				echo 'c';
			echo '</td>';
			echo '<td>';
				echo 's';	
			echo '</td>';
		echo '</tr>';
		foreach ($a as $key => $value) {
			echo '<tr>';
			foreach ($value as $key2 => $value2){
				echo '<td>';
				if ($value['s'] % 2 != 0 || !is_int($value['s'])) {
					echo "[$value2]";
				} else {
					echo "$value2";
				}
				echo '</td>';
			}
			echo '</tr>';
		}
	echo '</table>';
}

printTrapeze($arr3);
echo '<br>';

/*Реализовать абстрактный класс BaseMath содержащий 3 метода: exp1($a, $b, $c) и exp2($a, $b, $c),getValue(). Метода exp1 реализует расчет по формуле a*(b^c). Метода exp2 реализует расчет по формуле (a/b)^c. Метод getValue() возвращает результат расчета класса наследника.*/


abstract class BaseMath 
{
	
	public function exp1($a, $b, $c)
	{
		return $a * pow($b, $c);
	}

	public function exp2($a, $b, $c)
	{
		return pow($a / $b, $c);
	}

	abstract function getValue();
}

/*Реализовать класс F1 наследующий методы BaseMath, содержащий конструктор с параметрами ($a, $b, $c) и метод getValue(). Класс реализует расчет по формуле f=(a*(b^c)+(((a/c)^b)%3)^min(a,b,c)).*/


class F1 extends BaseMath
{
	
	public $a;
	public $b;
	public $c;

	public function __construct(int $a, int $b, int $c)
	{
		if(0 === $b) {
      throw new InvalidArgumentException('$b не может быть нулем');
    }

		$this->a = $a;
		$this->b = $b;
		$this->c = $c;
	}

	function getValue()
  {
    return $this->exp1($this->a, $this->b, $this->c) + pow($this->exp2($this->a, $this->b, $this->c) % 3, min($this->a, $this->b,$this->c));
  }
}

$valueF1 = new F1(3,2,2);
echo $valueF1->getValue();
echo "<br>";
echo $valueF1->exp1(10,1,2);
echo "<br>";
echo $valueF1->exp2(10,1,2);
echo "<br>";
$valueF2 = new F1(3,0,2);
