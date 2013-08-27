<?php

require 'libs' . DIRECTORY_SEPARATOR . 'pwd-gen.php';

$chars = '@&*-/+';

$pwdGenerator = new PwdGen();
$pwdGenerator->addIntervalToCharlist('a', 'z');
$pwdGenerator->addIntervalToCharlist('A', 'Z');
$pwdGenerator->addIntervalToCharlist('0', '9');
$pwdGenerator->addToCharlist($chars);

header("Content-type: text/plain");
foreach ($pwdGenerator->generate(50) as $pwd) {
	echo $pwd . "\n";
}
