<?php

class PwdGenerator {

	protected $_default = ['length' => 10, 'charlist' => []];
	protected $_options = [];

	/**
	 * Copie les options par défaut
	 */
	public function __construct() {
		$this->_options = $this->_default;
	}

	/**
	 * Défini la taille du mdp généré
	 * @param int $length
	 * @throws IllegalArgumentException
	 */
	public function setLength($length) {
		if(!is_int($length) || $length < 1) {
			throw new IllegalArgumentException('$length doit être un entier plus grand que 0');
		}

		$this->_options['length'] = $length;
	}

	/**
	 * Ajoute des caractères à la liste de caractères utilisés pour la génération du pwd
	 * @param char   $value Un caractère simple
	 * @param string $value Une chaine de caractères
	 * @param array  $value Un tableau de caractères
	 */
	public function addToCharlist($value) {
		if(is_array($value)) {
			$this->_addArrayToCharlist($value);
		} elseif (is_string($value)) {
			if(strlen($value) == 1) {
				$this->_addCharToCharlist($value);
			} else {
				$this->_addStringToCharlist($value);
			}
		}
	}

	/**
	 * Ajoute un interval de caractères à la liste
	 * @param char $first Premier caractère
	 * @param char $last  Dernier caractère
	 * @throws IllegalArgumentException
	 */
	public function addIntervalToCharlist($first, $last) {
		if(!is_string($first) || !is_string($last)) {
			throw new IllegalArgumentException('$first and $last should be strings');
		}

		$this->_addIntervalToCharlist($first, $last);
	}

	/**
	 * Génère une liste de mot de passe
	 * @param  integer $count Nombre de mot de passe à générer
	 * @return Generator
	 * @see    http://php.net/manual/fr/language.generators.syntax.php
	 */
	public function generate($count = 1) {
		$charlist_length = count($this->_options['charlist']);
		$ret = [];
		for ($j = 0; $j < $count; $j++) {
			$pwd = '';
			for ($i = 0; $i < $this->_options['length']; $i++) {
				$pwd .= $this->_options['charlist'][rand(0, $charlist_length - 1)];
			}

			yield $pwd;
		}
	}

	protected function _addStringToCharlist($string) {
		for ($i = 0; $i < strlen($string); $i++) {
			$this->_addCharToCharlist($string[$i]);
		}
	}

	protected function _addArrayToCharlist(array $array) {
		if(is_array($value)) {
			foreach ($value as $v) {
				if(!in_array($value, $this->_options['charlist'])) {
					$this->_addCharToCharlist($value);
				}
			}
		}
	}

	protected function _addCharToCharlist($value) {
		if(!in_array($value, $this->_options['charlist'])) {
			$this->_options['charlist'][] = $value;
		}
	}

	protected function _addIntervalToCharlist($first, $last) {
		$charlist = [];
		for ($i = ord($first); $i <= ord($last); $i++) {
			$this->_addCharToCharlist(chr($i));
		}
	}

}
