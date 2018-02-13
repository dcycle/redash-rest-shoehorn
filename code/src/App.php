<?php

namespace myproject;

use myproject\traits\Environment;
use myproject\traits\Singleton;
use myproject\Translator\StarWars;
use myproject\Translator\Cities;

/**
 * Encapsulated code for the application.
 */
class App {

  use Environment;
  use Singleton;

  public function httpQuery($query) {
    // Get cURL resource
    $curl = curl_init();
    // Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $query,
        CURLOPT_USERAGENT => 'Sample cURL Request'
    ));
    // Send the request & save response to $resp
    $resp = curl_exec($curl);
    if (!$resp) {
      throw new \Exception('curl_exec() returned false.');
    }
    // Close request to clear up some resources
    curl_close($curl);
    return $resp;
  }

  public function jsonDecode($json) {
    $return = json_decode($json, TRUE);
    if (!$return) {
      throw new \Exception('json_decode() returned FALSE.');
    }
    return $return;
  }

  public function run($get) {
    try {
      if ($get['source']) {
        $return = $this->translate($get['source']);
      }
      else {
        throw new \Exception('Please specify a source get parameter, for example ?source=' . urlencode('https://swapi.co/api/people/%3Fformat=json') . ', or ?source=' . urlencode('https://api.openaq.org/v1/cities'));
      }
    }
    catch (\Throwable $e) {
      $return = [
        'success' => FALSE,
        $e->getMessage(),
      ];
    }
    return json_encode($return, TRUE);
  }

  public function translate($source) {
    $resp = $this->httpQuery($source);
    $decoded = $this->jsonDecode($resp);

    foreach ($this->translators() as $candidate) {
      if ($candidate->applies($decoded)) {
        return $candidate->translate($decoded);
      }
    }

    throw new \Exception('No translator found for data.');
  }

  public function translators() {
    return [
      new Cities(),
      new StarWars(),
    ];
  }

}
