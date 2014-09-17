<?php

function main() {
    $all_tests_file = __DIR__ . '/../artifacts/all-tests.csv';
    $blacklist_file = __DIR__ . '/tests_blacklist.csv';

    $blt = new blacklistTests($all_tests_file, $blacklist_file);
    print $blt->testsToRun();
}

class blacklistTests {

    protected $all = array();
    protected $blacklist = array();

    public function __construct($all, $blacklist) {
        $this->all = $this->fileToArray($all);
        $this->blacklist = $this->fileToArray($blacklist);
        $this->blacklist[] = '';
    }

    public function fileToArray($path) {
        return explode("\n", file_get_contents($path));
    }

    public function testsToRun() {
        return implode(',', array_diff($this->all, $this->blacklist));
    }
}

main();
