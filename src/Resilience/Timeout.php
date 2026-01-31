<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Resilience;

/**
 * Timeout management for service calls.
 */
final class Timeout
{
    public function __construct(
        private readonly int $timeoutSeconds = 30,
    ) {
    }

    public function execute(callable $callback): mixed
    {
        $startTime = time();

        try {
            return $callback();
        } finally {
            $elapsed = time() - $startTime;
            
            if ($elapsed > $this->timeoutSeconds) {
                throw new \RuntimeException("Operation timed out after {$elapsed} seconds");
            }
        }
    }

    public function getTimeout(): int
    {
        return $this->timeoutSeconds;
    }
}
