<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Grpc;

final class GrpcClient
{
    public function __construct(
        private readonly string $host,
        private readonly int $port = 50051,
    ) {
    }

    public function call(string $service, string $method, array $request): array
    {
        // Simplified gRPC call implementation
        // In production, this would use grpc/grpc extension
        
        return [
            'service' => $service,
            'method' => $method,
            'response' => 'success',
        ];
    }

    public function getAddress(): string
    {
        return "{$this->host}:{$this->port}";
    }
}
