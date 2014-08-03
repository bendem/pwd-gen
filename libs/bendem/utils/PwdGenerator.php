<?php

namespace bendem\utils;

class PwdGenerator {

    protected $_default = ['length' => 10, 'charlist' => []];
    protected $_options = [];

    /**
     * Construct a new generator using the default parameters.
     */
    public function __construct() {
        $this->_options = $this->_default;
    }

    /**
     * Specify the size of the generated password.
     *
     * @param int $length
     * @throws IllegalArgumentException
     */
    public function setLength($length) {
        if(!is_int($length) || $length < 1) {
            throw new IllegalArgumentException('The length should be an int greater than 0');
        }

        $this->_options['length'] = $length;
    }

    /**
     * Add characters to the list used to generate the password.
     *
     * @param char   $value A single character
     * @param string $value A string (all the characters of the string will be added)
     * @param array  $value An array of characters
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
     * Add a character interval to the list of chars used to generate the password.
     *
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
     * Generate a list of password using the options set.
     *
     * @param  int $count Number of passwords to generate
     * @return Generator
     * @see    http://php.net/manual/fr/language.generators.syntax.php
     * @throws IllegalArgumentException
     */
    public function generate($count = 1) {
        if ($count < 1) {
            throw new IllegalArgumentException("You need to generate at least one password")
        }
        $charlist_length = count($this->_options['charlist']);
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
        foreach ($value as $v) {
            if(!in_array($value, $this->_options['charlist'])) {
                $this->_addCharToCharlist($value);
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
