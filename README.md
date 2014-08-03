# PwdGenerator

## Description

PwdGenerator is a php class allowing you to generate large numbers of random characters easily.

**You'll need php 5.5.x or more to use it!**

## Usage

You can use composer to install the lib:

```php
require 'vendor/autoload.php';

use bendem\utils\PwdGenerator;
```

Once this is done, simply create an instance of the generator:

```php
$pwdGenerator = new PwdGenerator();
```

You can set the length of the generated password using:

```php
$pwdGenerator->setLength(11);
```

You can define the characters to use to generate the passwords

either using an interval:

```php
$pwdGenerator->addIntervalToCharlist('a', 'z');
$pwdGenerator->addIntervalToCharlist('A', 'Z');
$pwdGenerator->addIntervalToCharlist('0', '9');
```

or by specifying the characters directly or by using a string or an array of chars:

```php
$pwdGenerator->addToCharlist('@&*-/+');   // Using a string
$pwdGenerator->addToCharlist('$');        // Using a single char
$pwdGenerator->addToCharlist(['(', ')']); // Using an array
```

The passwords are returned as generators, for more informations, refer to the [php documentation](http://php.net/manual/en/language.generators.syntax.php)

Displaying the passwords is as simple as:

```php
foreach ($pwdGenerator->generate(30) as $pwd) {
	echo $pwd;
}
```

or:

```php
echo $pwdGenerator->generate()->current();
```
