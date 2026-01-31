# Circuit Breaker Pattern

## What is Circuit Breaker?

Prevents cascading failures in distributed systems by stopping requests to failing services.

## States

1. **Closed** - Normal operation, requests pass through
2. **Open** - Service is failing, requests are blocked
3. **Half-Open** - Testing if service recovered

## Usage

```php
use Syeedalireza\ServiceMeshBundle\Resilience\CircuitBreaker;

$cb = new CircuitBreaker(threshold: 5, timeout: 60);

try {
    $result = $cb->call(function() {
        return $this->httpClient->request('GET', 'http://api.example.com');
    });
} catch (\RuntimeException $e) {
    // Circuit is open, service is down
    return $this->fallbackResponse();
}
```

## Configuration

```yaml
service_mesh:
    circuit_breaker:
        threshold: 5      # Open after 5 failures
        timeout: 60       # Try again after 60 seconds
```

## Best Practices

- Set appropriate threshold based on service SLA
- Implement fallback responses
- Monitor circuit breaker state
- Log when circuit opens/closes
