<?php

namespace myproject;

use myproject\traits\Environment;
use myproject\traits\Singleton;

/**
 * Encapsulated code for the application.
 */
class App {

  use Environment;
  use Singleton;

  /**
   * Prints the square root of the number of files in a directory.
   *
   * This method is admittedly useless, but it is meant to demonstrate how
   * a method which uses externalities via the Environment trait can be
   * tested.
   *
   * @throws \Exception
   */
  public function printSquareRootOfNumberOfFilesInDirectory() {
    $directory = $this->getEnv('DIRECTORY');
    if (!$directory) {
      throw new \Exception('Please set the DIRECTORY environment variable.');
    }
    $files = $this->scanDir($directory);
    $sqrt = $this->squareRoot(count($files));
    $this->print($sqrt);
  }

  /**
   * Returns the square root of a number.
   *
   * This is added to show an example of how the associated test code
   * (see ./code/test/AppTest.php) works for a pure function with no
   * externalities.
   *
   * @param float $a
   *   The number whose square root we want to get.
   *
   * @return float
   *   The square root.
   *
   * @throws \Exception
   */
  public function squareRoot(float $a) : float {
    if ($a < 0) {
      throw new \Exception('No square root for negative numbers.');
    }
    return sqrt($a);
  }

}
