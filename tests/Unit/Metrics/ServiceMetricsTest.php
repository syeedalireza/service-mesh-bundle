<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Tests\Unit\Metrics;

use PHPUnit\Framework\TestCase;
use Syeedalireza\ServiceMeshBundle\Metrics\ServiceMetrics;

final class ServiceMetricsTest extends TestCase
{
    public function testRecordRequest(): void
    {
        $metrics = new ServiceMetrics();
        
        $metrics->recordRequest('user-service', true, 0.5);
        $metrics->recordRequest('user-service', true, 0.3);
        $metrics->recordRequest('user-service', false, 1.0);

        $data = $metrics->getMetrics('user-service');

        $this->assertEquals(3, $data['total_requests']);
        $this->assertEquals(2, $data['successful_requests']);
        $this->assertEquals(1, $data['failed_requests']);
    }

    public function testGetSuccessRate(): void
    {
        $metrics = new ServiceMetrics();
        
        $metrics->recordRequest('service-a', true, 0.1);
        $metrics->recordRequest('service-a', true, 0.1);
        $metrics->recordRequest('service-a', false, 0.1);

        $this->assertEquals(2/3, $metrics->getSuccessRate('service-a'), '', 0.01);
    }
}
