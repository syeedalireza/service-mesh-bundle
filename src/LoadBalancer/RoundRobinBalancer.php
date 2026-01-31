<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\LoadBalancer;

/**
 * Round-robin load balancing strategy.
 */
final class RoundRobinBalancer
{
    private int $currentIndex = 0;

    public function __construct(
        private array $nodes = [],
    ) {
    }

    public function addNode(string $node): void
    {
        $this->nodes[] = $node;
    }

    public function getNext(): ?string
    {
        if (empty($this->nodes)) {
            return null;
        }

        $node = $this->nodes[$this->currentIndex];
        $this->currentIndex = ($this->currentIndex + 1) % count($this->nodes);

        return $node;
    }

    public function getNodes(): array
    {
        return $this->nodes;
    }
}
