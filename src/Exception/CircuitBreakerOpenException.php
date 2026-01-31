<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Exception;

final class CircuitBreakerOpenException extends \RuntimeException
{
    public static function forService(string $serviceName): self
    {
        return new self("Circuit breaker is open for service '{$serviceName}'");
    }
}
