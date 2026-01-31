# Service Mesh Bundle

gRPC-based service mesh for Symfony microservices with service discovery, circuit breaker, and load balancing.

## Features

- gRPC client/server integration
- Service discovery (Consul)
- Circuit breaker pattern
- Retry with exponential backoff
- Request timeout management
- Health check endpoints
- Load balancing strategies
- Service registry

## Installation

```bash
composer require syeedalireza/service-mesh-bundle
```

## Configuration

```yaml
service_mesh:
    grpc:
        enabled: true
        port: 50051
    discovery:
        provider: consul
        consul:
            host: consul
            port: 8500
    resilience:
        circuit_breaker:
            threshold: 5
            timeout: 60
```

## Usage

```php
// Register service
$serviceRegistry->register('user-service', 'localhost:50051');

// Call remote service with circuit breaker
$response = $grpcClient->call('user-service', 'GetUser', $request);
```
