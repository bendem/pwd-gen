# PwdGenerator

## Description

PwdGenerator est une classe php permettant de générer des mots de passe aléatoires.

**Cette classe utilise des fonctionnalités de php 5.5.x !**

## Utilisation

Commencez par inclure la classe :

	require 'pwd-gen.php';

Instanciez un nouveau générateur :

	$pwdGenerator = new PwdGenerator();

Définissez la taille du mot de passe (10 par défaut) :

	$pwdGenerator->setLength(11);

Définissez les caractères utilisés pour générer le mot de passe

Soit avec un intervalle :

	$pwdGenerator->addIntervalToCharlist('a', 'z');
	$pwdGenerator->addIntervalToCharlist('A', 'Z');
	$pwdGenerator->addIntervalToCharlist('0', '9');

Soit en spécifiant directement les caractères :

	$pwdGenerator->addToCharlist('@&*-/+');   // Avec une chaine de caractères
	$pwdGenerator->addToCharlist('$');        // Avec un caractère simple
	$pwdGenerator->addToCharlist(['(', ')']); // Avec un tableau

Les mots de passe sont généré sous la forme d'un générateur, pour plus d'informations voyez la [doc php](http://php.net/manual/fr/language.generators.syntax.php)

Afficher les mots de passe générés :

	foreach ($pwdGenerator->generate(30) as $pwd) {
		echo $pwd;
	}

ou :

	echo $pwdGenerator->generate()->current();
