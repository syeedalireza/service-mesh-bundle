# Service Discovery

## Overview

Service discovery allows microservices to find each other dynamically.

## Using Service Registry

```php
use Syeedalireza\ServiceMeshBundle\Discovery\ServiceRegistry;

$registry = new ServiceRegistry();

// Register a service
$registry->register('user-service', 'user-api:50051');
$registry->register('order-service', 'order-api:50051');

// Discover a service
$address = $registry->discover('user-service');
// Returns: 'user-api:50051'

// List all services
$services = $registry->listServices();
```

## Consul Integration

For production, use Consul:

```yaml
service_mesh:
    discovery:
        provider: consul
        consul:
            host: consul
            port: 8500
```

## Health Checks

Services should register with health check URLs:

```php
$registry->register('user-service', [
    'address' => 'user-api:50051',
    'health_check' => 'http://user-api:8080/health',
]);
```

## Best Practices

- Always implement health checks
- Use service names, not IP addresses
- Handle service unavailability gracefully
- Implement service deregistration on shutdown
