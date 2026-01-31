<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Context;

final class ServiceContext
{
    private ?string $currentService = null;
    private array $metadata = [];

    public function setCurrentService(string $serviceName): void
    {
        $this->currentService = $serviceName;
    }

    public function getCurrentService(): ?string
    {
        return $this->currentService;
    }

    public function setMetadata(string $key, mixed $value): void
    {
        $this->metadata[$key] = $value;
    }

    public function getMetadata(string $key): mixed
    {
        return $this->metadata[$key] ?? null;
    }
}
