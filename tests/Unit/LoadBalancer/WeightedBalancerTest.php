<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Tests\Unit\LoadBalancer;

use PHPUnit\Framework\TestCase;
use Syeedalireza\ServiceMeshBundle\LoadBalancer\WeightedBalancer;

final class WeightedBalancerTest extends TestCase
{
    public function testAddNode(): void
    {
        $balancer = new WeightedBalancer();
        $balancer->addNode('node1', 10);
        $balancer->addNode('node2', 5);

        $node = $balancer->getNext();
        
        $this->assertContains($node, ['node1', 'node2']);
    }

    public function testReturnsNullWhenEmpty(): void
    {
        $balancer = new WeightedBalancer();

        $this->assertNull($balancer->getNext());
    }
}
