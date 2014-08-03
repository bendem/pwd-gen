<?php

require 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use bendem\utils\PwdGenerator;

$pwdGenerator = new PwdGenerator();
$pwdGenerator->setLength(11);
$pwdGenerator->addIntervalToCharlist('a', 'z');
$pwdGenerator->addIntervalToCharlist('A', 'Z');
$pwdGenerator->addIntervalToCharlist('0', '9');

$pwdGenerator->addToCharlist('@&*-/+');

header("Content-type: text/plain");
foreach ($pwdGenerator->generate(50) as $pwd) {
    echo $pwd . "\n";
}
