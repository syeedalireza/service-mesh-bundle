<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Discovery;

/**
 * Consul-based service registry.
 */
final class ConsulServiceRegistry
{
    public function __construct(
        private readonly string $consulHost = 'localhost',
        private readonly int $consulPort = 8500,
    ) {
    }

    public function register(string $serviceName, string $address, int $port): void
    {
        $payload = json_encode([
            'ID' => $serviceName,
            'Name' => $serviceName,
            'Address' => $address,
            'Port' => $port,
        ]);

        $this->makeConsulRequest('/v1/agent/service/register', $payload);
    }

    public function deregister(string $serviceName): void
    {
        $this->makeConsulRequest("/v1/agent/service/deregister/{$serviceName}");
    }

    public function discover(string $serviceName): array
    {
        $response = $this->makeConsulRequest("/v1/health/service/{$serviceName}");
        
        return json_decode($response, true) ?? [];
    }

    private function makeConsulRequest(string $path, ?string $payload = null): string
    {
        $url = "http://{$this->consulHost}:{$this->consulPort}{$path}";
        
        $ch = curl_init($url);
        if ($payload) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $result = curl_exec($ch);
        curl_close($ch);

        return $result ?: '';
    }
}
