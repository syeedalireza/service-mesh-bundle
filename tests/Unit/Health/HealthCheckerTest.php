<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Tests\Unit\Health;

use PHPUnit\Framework\TestCase;
use Syeedalireza\ServiceMeshBundle\Health\HealthChecker;

final class HealthCheckerTest extends TestCase
{
    public function testRegisterAndCheck(): void
    {
        $checker = new HealthChecker();
        $checker->register('service-a', fn() => true);

        $this->assertTrue($checker->check('service-a'));
    }

    public function testCheckReturnsFalseForUnknownService(): void
    {
        $checker = new HealthChecker();

        $this->assertFalse($checker->check('unknown'));
    }

    public function testCheckAll(): void
    {
        $checker = new HealthChecker();
        $checker->register('service-a', fn() => true);
        $checker->register('service-b', fn() => false);

        $results = $checker->checkAll();

        $this->assertTrue($results['service-a']);
        $this->assertFalse($results['service-b']);
    }
}
