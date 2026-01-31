<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Tests\Unit\Resilience;

use PHPUnit\Framework\TestCase;
use Syeedalireza\ServiceMeshBundle\Resilience\CircuitBreaker;

final class CircuitBreakerTest extends TestCase
{
    public function testCallSucceeds(): void
    {
        $cb = new CircuitBreaker(threshold: 3);
        
        $result = $cb->call(fn() => 'success');

        $this->assertEquals('success', $result);
        $this->assertFalse($cb->isOpen());
    }

    public function testCircuitOpensAfterThreshold(): void
    {
        $cb = new CircuitBreaker(threshold: 2);

        try {
            $cb->call(fn() => throw new \Exception('fail'));
        } catch (\Exception $e) {}

        try {
            $cb->call(fn() => throw new \Exception('fail'));
        } catch (\Exception $e) {}

        $this->assertTrue($cb->isOpen());
    }
}
