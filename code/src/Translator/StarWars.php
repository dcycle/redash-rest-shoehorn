<?php

namespace myproject\Translator;

use myproject\Translator;

/**
 * Translator from https://swapi.co/api/people/?format=json to Redash format.
 */
class StarWars {

  public function applies(array $decoded) : bool {
    return !empty($decoded['count']);
  }

  public function translate(array $decoded) : array {
    return [
      'columns' => [
        [
          'name' => 'count',
          'type' => 'integer',
          'fiendly_name' => 'Count',
        ],
      ],
      'rows' => [
        [
          'count' => $decoded['count'],
        ],
      ],
    ];
  }

}
