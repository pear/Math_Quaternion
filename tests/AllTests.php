<?php

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Math_Quaternion_AllTests::main');
}

require_once 'PHPUnit/TextUI/TestRunner.php';

require_once 'Math_QuaternionTest.php';

class Math_Quaternion_AllTests
{
    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('PEAR - Math_Quaternion');

        $suite->addTestSuite('Math_QuaternionTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == 'Math_Quaternion_AllTests::main') {
    Math_Quaternion_AllTests::main();
}
