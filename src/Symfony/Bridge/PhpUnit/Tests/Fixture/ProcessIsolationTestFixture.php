<?php

namespace Symfony\Bridge\PhpUnit\Tests\Fixture;

use PHPUnit\Framework\TestCase;

/**
 * Fixture test which is expected to be run in an isolated process.
 *
 * @group legacy
 *
 * @see Symfony\Bridge\PhpUnit\Tests\ProcessIsolationTest
 */
class ProcessIsolationTestFixture extends TestCase
{
    /**
     * @expectedDeprecation Test
     */
    public function testIsolation() {
        $this->triggerDeprecation();
        $this->assertTrue(TRUE);
    }

    protected function triggerDeprecation() {
        @trigger_error('Test', E_USER_DEPRECATED);
    }
}
