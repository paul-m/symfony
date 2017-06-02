<?php

namespace Symfony\Bridge\PhpUnit\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Bridge\PhpUnit\SymfonyTestsListener;

/**
 * This test must never be run in an isolated process.
 */
class ProcessIsolationTest extends TestCase
{
    public function testIsolation() {
        require_once __DIR__ . '/Fixture/ProcessIsolationTestFixture.php';
        $test = new Fixture\ProcessIsolationTestFixture();
        $test->setRunTestInSeparateProcess(TRUE);

        // Since there's no forward-compatibility for
        // \PHPUnit_Framework_TestResult, we have to use reflection to generate
        // one.
        $ref_create = new \ReflectionMethod($test, 'createResult');
        $ref_create->setAccessible(TRUE);
        $result = $ref_create->invoke($test);
        $listener = new SymfonyTestsListener();
        $result->addListener($listener);

        $test->run($result);

        $this->assertEquals(1, $result->riskyCount());
    }
}
