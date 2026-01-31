<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\LoadBalancer;

/**
 * Weighted load balancing strategy.
 */
final class WeightedBalancer
{
    /** @var array<string, int> */
    private array $weights = [];

    public function addNode(string $node, int $weight = 1): void
    {
        $this->weights[$node] = $weight;
    }

    public function getNext(): ?string
    {
        if (empty($this->weights)) {
            return null;
        }

        $totalWeight = array_sum($this->weights);
        $random = mt_rand(1, $totalWeight);

        $currentWeight = 0;
        foreach ($this->weights as $node => $weight) {
            $currentWeight += $weight;
            if ($random <= $currentWeight) {
                return $node;
            }
        }

        return array_key_first($this->weights);
    }
}
