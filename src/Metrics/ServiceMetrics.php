<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Metrics;

final class ServiceMetrics
{
    private array $metrics = [];

    public function recordRequest(string $serviceName, bool $success, float $duration): void
    {
        if (!isset($this->metrics[$serviceName])) {
            $this->metrics[$serviceName] = [
                'total_requests' => 0,
                'successful_requests' => 0,
                'failed_requests' => 0,
                'total_duration' => 0.0,
            ];
        }

        $this->metrics[$serviceName]['total_requests']++;
        
        if ($success) {
            $this->metrics[$serviceName]['successful_requests']++;
        } else {
            $this->metrics[$serviceName]['failed_requests']++;
        }

        $this->metrics[$serviceName]['total_duration'] += $duration;
    }

    public function getMetrics(string $serviceName): ?array
    {
        return $this->metrics[$serviceName] ?? null;
    }

    public function getSuccessRate(string $serviceName): float
    {
        $metrics = $this->getMetrics($serviceName);

        if (!$metrics || $metrics['total_requests'] === 0) {
            return 0.0;
        }

        return $metrics['successful_requests'] / $metrics['total_requests'];
    }
}
