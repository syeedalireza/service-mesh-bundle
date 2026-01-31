<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Tests\Unit\Resilience;

use PHPUnit\Framework\TestCase;
use Syeedalireza\ServiceMeshBundle\Resilience\Timeout;

final class TimeoutTest extends TestCase
{
    public function testExecuteSucceedsWithinTimeout(): void
    {
        $timeout = new Timeout(5);
        
        $result = $timeout->execute(fn() => 'success');

        $this->assertEquals('success', $result);
    }

    public function testGetTimeout(): void
    {
        $timeout = new Timeout(30);

        $this->assertEquals(30, $timeout->getTimeout());
    }
}
