<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Tests\Unit\LoadBalancer;

use PHPUnit\Framework\TestCase;
use Syeedalireza\ServiceMeshBundle\LoadBalancer\RoundRobinBalancer;

final class RoundRobinBalancerTest extends TestCase
{
    public function testRoundRobinDistribution(): void
    {
        $balancer = new RoundRobinBalancer(['node1', 'node2', 'node3']);

        $this->assertEquals('node1', $balancer->getNext());
        $this->assertEquals('node2', $balancer->getNext());
        $this->assertEquals('node3', $balancer->getNext());
        $this->assertEquals('node1', $balancer->getNext()); // Wraps around
    }

    public function testAddNode(): void
    {
        $balancer = new RoundRobinBalancer();
        $balancer->addNode('node1');

        $this->assertCount(1, $balancer->getNodes());
    }
}
