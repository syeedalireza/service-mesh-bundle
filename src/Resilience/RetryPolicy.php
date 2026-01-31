<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Resilience;

final class RetryPolicy
{
    public function __construct(
        private readonly int $maxAttempts = 3,
        private readonly int $baseDelay = 100,
    ) {
    }

    public function execute(callable $callback): mixed
    {
        $attempt = 0;
        
        while (true) {
            try {
                return $callback();
            } catch (\Throwable $e) {
                $attempt++;
                
                if ($attempt >= $this->maxAttempts) {
                    throw $e;
                }
                
                $delay = $this->baseDelay * pow(2, $attempt - 1);
                usleep($delay * 1000);
            }
        }
    }
}
