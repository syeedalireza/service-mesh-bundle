<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Discovery;

final class ServiceRegistry
{
    private array $services = [];

    public function register(string $name, string $address): void
    {
        $this->services[$name] = $address;
    }

    public function discover(string $name): ?string
    {
        return $this->services[$name] ?? null;
    }

    public function deregister(string $name): void
    {
        unset($this->services[$name]);
    }

    public function listServices(): array
    {
        return array_keys($this->services);
    }
}
