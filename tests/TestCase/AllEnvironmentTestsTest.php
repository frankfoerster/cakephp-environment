<?php

use Cake\TestSuite\TestSuite;

class AllEnvironmentTestsTest extends TestSuite
{

    /**
     * Defines all tests for this suite.
     *
     * @return TestSuite
     */
    public static function suite()
    {
        $suite = new TestSuite();

        $path = dirname(__FILE__) . DS;
        $suite->addTestDirectoryRecursive($path);

        return $suite;
    }
}
