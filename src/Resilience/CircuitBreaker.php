<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Resilience;

final class CircuitBreaker
{
    private const STATE_CLOSED = 'closed';
    private const STATE_OPEN = 'open';
    private const STATE_HALF_OPEN = 'half_open';

    private string $state = self::STATE_CLOSED;
    private int $failureCount = 0;

    public function __construct(
        private readonly int $threshold = 5,
        private readonly int $timeout = 60,
    ) {
    }

    public function call(callable $callback): mixed
    {
        if ($this->state === self::STATE_OPEN) {
            throw new \RuntimeException('Circuit breaker is open');
        }

        try {
            $result = $callback();
            $this->onSuccess();
            return $result;
        } catch (\Throwable $e) {
            $this->onFailure();
            throw $e;
        }
    }

    private function onSuccess(): void
    {
        $this->failureCount = 0;
        $this->state = self::STATE_CLOSED;
    }

    private function onFailure(): void
    {
        $this->failureCount++;
        
        if ($this->failureCount >= $this->threshold) {
            $this->state = self::STATE_OPEN;
        }
    }

    public function isOpen(): bool
    {
        return $this->state === self::STATE_OPEN;
    }
}
