<?php

function main() {
  $tests = simpletest_test_get_all();
  $tests_to_run = array();
  $springboard_path = 'sites/all/modules/springboard';

  foreach ($tests as $module_name => $classes) {
    foreach ($classes as $test => $info) {
      $rows = db_select('registry', 'r')
        ->fields('r', array('filename', 'module'))
        ->condition('name', $test)
        ->condition('type', 'class')
        ->execute();
      foreach ($rows as $row) {
        $module = $row->module;
        $path = $row->filename;
        if (strpos($path, $springboard_path) !== FALSE) {
            $tests_to_run[] = $test;
        }
      }
    }
  }
  print implode(',', $tests_to_run);
}

main();
