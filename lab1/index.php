<?php
require_once './vendor/autoload.php';
require_once './User.php';

use Symfony\Component\Validator\Constraints\{Length, NotBlank};
use Symfony\Component\Validator\Validation;

$validator = Validation::createValidator();

$massName = array("krek", "rar", "AMOGUS_SUUUUUUS",);

for ($i = 0; $i < count($massName); ++$i) {
	$s = $massName[$i];
	echo "Entered '$s' string." . '<br>';

	$errors = $validator->validate($s, [
		new Length(['min' => 5]),
		new NotBlank(),
	]);

	if (count($errors) > 0) {
		foreach ($errors as $violation) {
			echo $violation->getMessage() . '<br>';
		}
	} else {
		echo "Good" . "<br>";
	}
}



$us = new User('192.168.1.1', 'user@mail.ru', '02112000alK');
$us->echoPrint();
echo $us->getCunstDate() . '<br>';
//спецом для демонстрации ошибок
$usserError = new User('19hgf', 'userhgfhfhf.ru', '---------');
$usserError->echoPrint();
echo $usserError->getCunstDate() . '<br>';
