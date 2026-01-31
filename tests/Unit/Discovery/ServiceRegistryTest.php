<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Tests\Unit\Discovery;

use PHPUnit\Framework\TestCase;
use Syeedalireza\ServiceMeshBundle\Discovery\ServiceRegistry;

final class ServiceRegistryTest extends TestCase
{
    public function testRegisterAndDiscover(): void
    {
        $registry = new ServiceRegistry();
        $registry->register('user-service', 'localhost:50051');

        $address = $registry->discover('user-service');

        $this->assertEquals('localhost:50051', $address);
    }

    public function testDiscoverReturnsNullForUnknownService(): void
    {
        $registry = new ServiceRegistry();

        $this->assertNull($registry->discover('unknown-service'));
    }

    public function testListServices(): void
    {
        $registry = new ServiceRegistry();
        $registry->register('service-a', 'host-a:50051');
        $registry->register('service-b', 'host-b:50052');

        $services = $registry->listServices();

        $this->assertCount(2, $services);
        $this->assertContains('service-a', $services);
        $this->assertContains('service-b', $services);
    }
}
