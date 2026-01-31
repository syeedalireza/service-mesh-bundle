<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Health;

final class HealthChecker
{
    private array $healthChecks = [];

    public function register(string $serviceName, callable $check): void
    {
        $this->healthChecks[$serviceName] = $check;
    }

    public function check(string $serviceName): bool
    {
        if (!isset($this->healthChecks[$serviceName])) {
            return false;
        }

        try {
            return (bool) $this->healthChecks[$serviceName]();
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function checkAll(): array
    {
        $results = [];
        
        foreach ($this->healthChecks as $serviceName => $check) {
            $results[$serviceName] = $this->check($serviceName);
        }

        return $results;
    }
}
