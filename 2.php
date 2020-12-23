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

// $arr = [['a'=>2,'b'=>1], ['b'=>3], ['a'=>7,'b'=>2]];
// $key = 'a';

// print_r(mySortForKey($arr, $key));

echo "<br>";
// $host = '127.0.0.1';
// $mysqli = new mysqli($host, 'root', 'root', 'test_samson', 3306, 'utf8');
// if(mysqli_connect_errno()){
// 	echo "No connect" . mysqli_connect_errno();
// }

try {
  $host = '127.0.0.1';
  $db = 'test_samson';
  $user = 'root';
  $pass = 'root';
  $charset = 'utf8';

  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
  $opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
  ];
  $pdo = new PDO($dsn, $user, $pass, $opt);
  // $dbs = $pdo->query('SELECT * FROM a_product')->fetchAll();
  // echo "<pre>" . print_r($dbs, true) . "</pre>";
} catch (\Exception $e) {
  echo $e->getMessage();
}



function importXml($a){
	global $pdo;
	$fileData = file_get_contents($a);
	$xml = simplexml_load_string($fileData);


	foreach ($xml->xpath("//Товар") as $segment) {
	  $row = $segment->attributes();
	  // echo "<pre>";
	  // print_r($segment);

	  $code = $row{'Код'};
	  $title = $row{'Название'};
	  $product = $pdo->query("INSERT INTO a_product (product_code, product_title) VALUES ($code, '$title');");
	  if(!$product){
	  	echo $mysqli->error;
	  }
	  $productId = $pdo->lastInsertId();

	  foreach ($segment->{'Цена'} as $value) {
	  	$priceTitle = $value->attributes();
	  	$price = $value;
			$prices = $pdo->query("INSERT INTO a_price (product_id, price_title, price) VALUES ($productId, '$priceTitle', $price);");
			if(!$prices){
		  	echo $mysqli->error;
		  }
	  }

	  foreach ($segment->{'Свойства'} as $descript) {
	  	// echo "<pre>";
	  	// print_r($descript);
	  	foreach ($descript as $key => $val) {
	  		echo "<pre>";
	  		// print($key);
	  		// print($val);
	  		$properties = $pdo->query("INSERT INTO a_property (product_id, property_title, property_value) VALUES ($productId, '$key', '$val');");
				if(!$properties){
		  		echo $mysqli->error;
		  	}
	  	}
	  }
	  foreach ($segment->{'Разделы'}->{'Раздел'} as $value) {
			echo "<pre>";
			print($value);
			$text = $pdo->query("SELECT category_id FROM a_category WHERE '$value' = category_title ")->fetchAll();
		
			print_r($text[0]{'category_id'});
			$categoryId = $text[0]{'category_id'};
			$pdo->query("INSERT INTO a_product_category (product_id, category_id) VALUES ($productId, $categoryId);");
		}
	}
}

importXml('1.xml');
