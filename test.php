<?php

/**
 * @file
 * The PHP page that serves all page requests on a Drupal installation.
 *
 * All Drupal code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt files in the "core" directory.
 */

use Drupal\Core\DrupalKernel;
use Symfony\Component\HttpFoundation\Request;

$autoloader = require_once 'autoload.php';

$kernel = new DrupalKernel('prod', $autoloader);

$request = Request::createFromGlobals();
$response = $kernel->handle($request);

  $query = db_select('taxonomy_term_field_data','ttfd')
    ->fields('ttfd',array('tid'))
    ->condition('name', 'NFL');
  $query->join('taxonomy_term_hierarchy','tth','ttfd.tid = tth.tid');
  $query
    ->fields('tth',array('parent'));
  $parent = $query->execute();
  $parent = $parent->fetchField();

  print_r($parent);
