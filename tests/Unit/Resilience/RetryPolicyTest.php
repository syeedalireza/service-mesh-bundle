<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Tests\Unit\Resilience;

use PHPUnit\Framework\TestCase;
use Syeedalireza\ServiceMeshBundle\Resilience\RetryPolicy;

final class RetryPolicyTest extends TestCase
{
    public function testSuccessfulExecutionOnFirstAttempt(): void
    {
        $retry = new RetryPolicy(maxAttempts: 3);
        
        $result = $retry->execute(fn() => 'success');

        $this->assertEquals('success', $result);
    }

    public function testRetriesOnFailure(): void
    {
        $retry = new RetryPolicy(maxAttempts: 3, baseDelay: 1);
        $attempt = 0;

        $result = $retry->execute(function() use (&$attempt) {
            $attempt++;
            if ($attempt < 3) {
                throw new \RuntimeException('fail');
            }
            return 'success';
        });

        $this->assertEquals('success', $result);
        $this->assertEquals(3, $attempt);
    }
}
