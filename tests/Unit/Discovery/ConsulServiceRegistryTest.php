<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Tests\Unit\Discovery;

use PHPUnit\Framework\TestCase;
use Syeedalireza\ServiceMeshBundle\Discovery\ConsulServiceRegistry;

final class ConsulServiceRegistryTest extends TestCase
{
    public function testRegistryCreation(): void
    {
        $registry = new ConsulServiceRegistry('localhost', 8500);

        $this->assertInstanceOf(ConsulServiceRegistry::class, $registry);
    }
}
