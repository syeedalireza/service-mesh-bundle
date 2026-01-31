<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Grpc;

final class GrpcServer
{
    private array $handlers = [];

    public function __construct(
        private readonly int $port = 50051,
    ) {
    }

    public function registerHandler(string $service, callable $handler): void
    {
        $this->handlers[$service] = $handler;
    }

    public function start(): void
    {
        // Start gRPC server
        // In production, this would start actual gRPC server
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getHandlers(): array
    {
        return $this->handlers;
    }
}
