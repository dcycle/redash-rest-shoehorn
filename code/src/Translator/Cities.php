<?php

namespace myproject\Translator;

use myproject\Translator;

/**
 * Translator from https://api.openaq.org/v1/cities to Redash format.
 */
class Cities {

  public function applies(array $decoded) : bool {
    return !empty($decoded['meta']['found']);
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
          'count' => $decoded['meta']['found'],
        ],
      ],
    ];
  }

}
