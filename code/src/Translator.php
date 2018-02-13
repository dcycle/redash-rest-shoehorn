<?php

namespace myproject;

/**
 * Translator to Redash format.
 */
abstract class Translator {

  abstract public function applies(array $decoded) : bool;

  abstract public function translate(array $decoded) : array;

}
